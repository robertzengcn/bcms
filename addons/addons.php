<?php

/**
 * 
 * 初始化基类
 * @author Administrator
 *
 */

abstract class Addons{
	
	#.执行结果
	public $result  = null;
	public $method  = null;	
	#.smarty句柄
	public $smarty  = null;
	
	/**
	 * 构造连接
	 */
	public function __construct() {
		//模拟controller参数
		$self = substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
		$_REQUEST['controller'] = ucfirst( str_replace('.php', '' , strtolower( $self ) ) );
		//如果method不存在，则为query(前提是query也要实现了这个方法才行),如果不存在，则默认执行index方法
		if( ! isset($_REQUEST['method']) || trim( $_REQUEST['method'] ) == '' ) {
			if( method_exists($this,  'query' ) ) {
				$_REQUEST['method'] = 'query';
			}else{
				$_REQUEST['method'] = 'index';
			}
		}		
		//加载controller基类
		require_once ROOTPATH . '/controller/mobile/index.php';
		
		//加载smarty引擎
		require_once ROOTPATH . '/lib/smarty/Smarty.class.php';
		//实例化smarty句柄
		
		$this->smartyInit();
		
	}
	
	/**
	 * 
	 * 执行入口方法
	 */
	public function excute() {		
		//被执行方法
		$this->method = trim( $_REQUEST ['method'] );
		$method = $this->method;
		
		//实例化基类
		$ActionController = new ActionController();
		//执行对应方法
		$this->result = $ActionController->excute();
		
		//错误输出
		if(isset($this->result->statu)){
			//如果错误为找不到方法,则试图调取自身的方法
			if(method_exists($this, $this->method)){
				$this->$method();exit;
			}
			if(!$this->result->statu){
				die( $this->result->msg );
			}
		}
		$this->$method();
	}
	

	/**
	 * 
	 * smarty初始化工作
	 * @info::temp临时解析文件与缓存文件同PC端的放在一起即可,后缀区分
	 */
	private function smartyInit() {
		$this->smarty = new Smarty();
		$this->smarty->setPluginsDir( PLUGINSDIR_SMARTY );
		$this->smarty->setTemplateDir ( $this->setViewPath() );
		$this->smarty->setcompileDir ( COMPILEDIR );
		$this->smarty->setCacheDir ( CACHEDIR );
		$this->smarty->left_delimiter  = LEFT_LIMITER;
		$this->smarty->right_delimiter = RIGHT_LIMITER;
	}
	
	
	/**
	 * 
	 * 设置静态模版路径(常量)
	 * @return boolean
	 */
	private function setViewPath() {
		/**  注入公共变量  **/
		$this->smarty->assign('COMMON' , NETADDRESS . '/'.PROJECT_NAME.'/Market/');//手机页面文件夹地址
		return ROOTPATH . '/'.PROJECT_NAME.'/Market/';
	}
	
	/**
	 * 
	 * 注册其他服务层
	 * @info 由于pc端的控制层大多需要登录才能调取,所以直接载入pc端的服务层
	 *       调取需要的数据
	 * @param string $service 需要被调取的服务前缀
	 * @param string $method 调取方法
	 * @param all    $params 参数
	 */
	public function getServiceMethod($service = '' , $method = '' , $params = null) {
	
		$service = ucfirst( $service );
		$filePath = ROOTPATH . '/kernel/' . $service . 'Service.php';
		if( ! file_exists( $filePath ) ){
			return null;
		}else{
			require_once $filePath;
			$service = $service . 'Service';
			$handler = new $service();
			if( ! is_null($params)) {
				return $handler->$method($params);
			}else{
				return $handler->$method();
			}
			return $execute;
		}
	}
	/**
	 *
	 * 总控用户验证方法
	 *
	 */
	
	public function getuser() {
		
	
		session_start();
		$token = $this->getRequest('token', '');	
		if($token){
			// 			echo '4563';
			// 			echo $_REQUEST['username'];
			// 			exit();
	
			$username = $this->getRequest('username', '');
			$date = $this->getRequest('date', '');
			$website = $this->getRequest('website', '');
			//$token = $this->getRequest('token', '');
			//$token = $_POST['token'];	
			$url = "http://www.boyicms.com/interface/hma/HmaAccountInterface.php?type=logincheck";
			$post_data = array ("username" => $username,"date" => $date,"website"=>$website,"token"=>$token);
			 
			$ch=curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			//curl_setopt($ch,CURLOPT_HEADER,1);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
			$data=curl_exec($ch);
			curl_close($ch);
			$obj=json_decode($data);
	       	$datearray=array('username'=>$obj->data->username);
			if($obj->code==1){
				 
				 
				$result=$this->getServiceMethod( 'Member' , 'getmemberbyname' , $datearray );
				//print_r($result);
				 
				if(!empty($result)){
					 
					 
					$_SESSION['user']=$result['username'];
					$_SESSION['member_id']=$result['id'];
					 
					// 	     	print_r($_SESSION['user']);
					// 	     	exit();
				}else{
					 
					$result=$this->getServiceMethod('Member' , 'addmember' , $datearray );
					 
					$_SESSION['user']=$username;
					$_SESSION['member_id']=$result->data->id;
					 
				}
	
	
	
			}else{
				echo json_encode(array('statu'=>false,'code'=>15,'msg'=>'请重新登录','data'=>array()));
				exit();
			}
			 
	
		}	
	}
	/**
	 * 绑定参数
	 *
	 * @param unknown $entity        	
	 */
	final function blindParams($entity) {
		foreach ( $entity as $key => $value ) {
			if (isset ( $_REQUEST [$key] )) {
				$entity->$key = $_REQUEST [$key];
			}
		}
	}
	/*
	 * 数据处理
	 * */
	
	final public function getRequest($name = '', $default = '') {
		if (!empty($name)) {
			if (isset($_REQUEST[$name]) && $_REQUEST[$name]) {
				return $_REQUEST[$name];
			} else {
				return $default;
			}
		}
	
		return $_REQUEST;
	}
	/**
	 * 
	 * 共用分页数据获取方法
	 * @param int $pageSize 每页多少条
	 * @param string $url 页面路径,用于补全分页路径
	 * @param string $serviceName 需要调取服务层名称
	 * @param array $param 数组参数
	 */
	public function pageSetting( $pageSize , $url , $serviceName = null , $param = array() , $method = 'query' ) {

		if(is_null($serviceName)){
			return false;
		}
		$dataCount = $this->result['ttl'];//总条数
		

		$pageCount =  ceil( $dataCount / $pageSize );//总页数
		if(isset($_REQUEST['page']) && (int)$_REQUEST['page'] >= 1){//读取page
			$page = (int)$_REQUEST['page'];
			if($page >= $pageCount){
				$page = $pageCount;
			}
			if($page <= 0){
				$page = 1;
			}
		}else{
			$page = 1;
		}
		$param = array_merge(array('page'=>$page , 'size'=>$pageSize ),$param);
		$data  = $this->getServiceMethod( $serviceName , $method , $param );

		/** 注入分页参数 **/
		$this->smarty->assign('pageSize',$pageSize);//每页多少条
		$this->smarty->assign('dataCount',$dataCount);//总共多少条数据
		$this->smarty->assign('pageCount',$pageCount);//总共分页数
		$this->smarty->assign('page',$page);//当前页
		$this->smarty->assign('url',$url);//当前页
		$this->smarty->assign('moreParam','');//附加参数
		/** 注入数据 **/

		$this->smarty->assign('list',$data->data);
	}	
}
define('ROOTPATH',rtrim($_SERVER['DOCUMENT_ROOT'],'/'));//根目录
define('PROJECT_NAME',basename(__DIR__));
define('TPLSUFFIX','.html');//模版后缀名
?>