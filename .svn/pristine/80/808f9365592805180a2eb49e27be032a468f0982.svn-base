<?php


/**
 * 
 * 手机端初始化基类
 * @author Administrator
 *
 */
require_once 'lib.php';

abstract class Shop extends Lib {
	
	#.执行结果
	public $result  = null;
	public $method  = null;	
	#.smarty句柄
	public $smarty  = null;
	
	/**
	 * 构造连接
	 */
	public function __construct() {
		//ini_set("display_errors", "On");
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
		require_once ROOTPATH . '/controller/shop/index.php';
		
        define ( 'PLUGINSDIR_SMARTY_SECOND', ABSPATH . '/tagobj/cusplugins/' );
		//加载smarty引擎
		require_once ROOTPATH . '/lib/smarty/Smarty.class.php';
		//实例化smarty句柄
		$this->getuser();
		
		$this->smartyInit();
		
		$this->assignPublicData();
		
		
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
		$this->smarty->setPluginsDir( PLUGINSDIR_SMARTY_SECOND );
		$this->smarty->setTemplateDir ( $this->setViewPath() );
		$this->smarty->setcompileDir ( COMPILEDIR );
		$this->smarty->setCacheDir ( CACHEDIR );
		$this->smarty->left_delimiter  = LEFT_LIMITER;
		$this->smarty->right_delimiter = RIGHT_LIMITER;
		
	}
	
	/**
	 *
	 * 总控用户验证方法
	 *
	 */
	
	private function getuser() {

		session_start();
	
		if(!isset($_SESSION['user'])||strlen($_SESSION['user'])<1){

	
			//$username = $this->getRequest('username', '');
			//$date = $this->getRequest('date', '');
			//$website = $this->getRequest('website', '');
			$token = $this->getRequest('token', '');
			if(strlen($token)<1){
				echo json_encode(array('statu'=>false,'code'=>14,'msg'=>'用户未登陆','data'=>null));
				exit();
			}
	
			$url = "http://www.boyicms.com/interface/hma/HmaAccountInterface.php?type=logincheck";
			$post_data = array ("token"=>$token);
	      
			$ch=curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
			$data=curl_exec($ch);
			curl_close($ch);			
	        $obj=json_decode($data);
	       
	        

	       if($obj->code==1){
	       	
	       	$datearray=array('username'=>$obj->data->username);
	       	$result=$this->getServiceMethod( 'Member' , 'getmemberbyname' , $datearray );
	       	
	       	
	     if(!empty($result)){
	     	
	     	
	     	$_SESSION['user']=$result['username'];
	     	$_SESSION['member_id']=$result['id'];
	     	

	     }else{
	     	
	     	$results=$this->getServiceMethod('Member' , 'addmember' , $datearray );
	   	     	
	     	$_SESSION['user']=$results->data->username;
	     	$_SESSION['member_id']=$results->data->id;	     	
	     }
	     
	     /*
	      * 删除url中的token参数
	      * */
	     $urlresult=preg_replace("/token=.*/", "", $_SERVER["REQUEST_URI"]);
	     header("location:".$urlresult);
	     

	     
	   
	     
	       }else{
	       	echo json_encode(array('statu'=>false,'code'=>15,'msg'=>'用户错误','data'=>null));
	       	exit();
	       	//die('用户错误');	       	
	       }
	      
	
		}

	
	
	
		}
	



	
	
	/**
	 * 
	 * 设置静态模版路径(常量)
	 * @return boolean
	 */
	private function setViewPath() {
		$filePath = ROOTPATH . '/'.PROJECT_NAME.'/Tpl/'.'config.ini';
		$content  = file_get_contents($filePath);
		$json     = array(json_decode($content,true));
		/**  注入公共变量  **/
		$this->smarty->assign('RESOURCE' , NETADDRESS . '/'.PROJECT_NAME.'/Tpl/'.$json[0]['view'].'/Public');//网站样式文件夹
		$this->smarty->assign('MOBILE', NETADDRESS . '/' . PROJECT_NAME );//手机页面地址
		/**  注入公共数据  **/
		//$this->assignPublicData();
		return ROOTPATH . '/'.PROJECT_NAME.'/Tpl/'.$json[0]['view'].'/';
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
			$execute = $this->serviceMethodException($service,$handler,$method,$params);
			if( $execute === false ){
				if( ! is_null($params)) {
					return $handler->$method($params);
				}else{
					return $handler->$method();
				}
			}
			return $execute;
		}
	}
	
	
	
	/**
	 * 
	 * 执行函数体执行例外方法执行
	 * @param string $service
	 * @param object $handler
	 * @param string $method
	 * @param array|string  $params
	 */
	private function serviceMethodException( $service , $handler , $method , $params ){
		switch( strtolower( PROJECT_NAME ) ) {
			case 'mobile':$params_cate  = 1;break;
			case 'app'   :$params_cate  = 2;break;
			case 'wechat':$params_cate  = 3;break;
			default     :$params_cate  = 1;break;
		}
		switch( $service ){
			case 'MobilePicManagerService':
				switch( strtolower( $method ) ){
					case 'getbyflag':
						$param = array();
						$param['form'] = 'mobile';
						$param['flag'] = $params;
						$param['cate'] = $params_cate;
						return $handler->$method($param);
						break;
					default:
						return false;
						break;
				}
				break;
			case 'MobileNavigationService':
				switch( strtolower( $method ) ){
					case 'querygroup':
						$params['cate'] = $params_cate;
						return $handler->$method( $params );
						break;
					default:
						return false;
						break;
				}
				break;
			default:
				return false;
				break;
		}
	}
	
}
define('ROOTPATH',rtrim($_SERVER['DOCUMENT_ROOT'],'/'));//根目录
define('TPLSUFFIX','.html');//模版后缀名
?>