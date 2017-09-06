<?php
ob_start();
#.装载必须
require_once $_SERVER['DOCUMENT_ROOT'] . '/web-setting.php';
require_once DAOPATH . '/ORMMap.php';
require_once KERNELPATH . '/Result.php';
require_once KERNELPATH . '/ErrorMsgs.php';
require_once KERNELPATH . '/LogMsgs.php';
require_once KERNELPATH . '/FilterService.php';
require_once DAOPATH . '/DTExpression.php';
require_once DAOPATH . '/DTOrder.php';
require_once ABSPATH . '/controller/Controller.php';
class HM {
	
	private $tokenPass = 'hm';
	
	public function __construct(){
		if(!session_id()) session_start();
		spl_autoload_register(array('HM','load'));
		if(!isset($_SESSION['work_id'])||!$_SESSION['work_id']){//如果没有验证过token
			$this->__tokenvalid();
		}
		
		$this->__run();
	}
	
	#.自动加载
	final public function load($class) {
		if (strpos($class, 'Service') !== false) {
			$file_path = KERNELPATH . $class . '.php';
		} elseif (strpos($class, 'DAO') !== false) {
			$file_path = DAOPATH . $class . '.php';
		} elseif (strpos($class, 'Model_') !== false) {
			$file_path = false;
		} elseif (strpos($class, 'Smarty') !== false) {
			$file_path = strtolower(ABSPATH . '/lib/smarty/sysplugins/' . $class . '.php');
		} elseif (strpos($class, 'Tag') !== false && $class == 'Tag') {
			$file_path = ENTITYPATH . $class . '.php';
		} elseif (strpos($class, 'Tag') !== false) {
			$file_path = ABSPATH . '/tagobj/' . $class . '.php';
		} elseif (strpos($class, 'Exception')) {
			$file_path = KERNELPATH . '/exception/' . $class . '.php';
		} else {
			$file_path = ENTITYPATH . $class . '.php';
		}
		if ($file_path) {
			if (file_exists($file_path)) {
				require_once $file_path;
			} else {
				exit($file_path . '文件不存在!');
			}
		}
	}
	
	final public function __token(){		
		if( isset( $_REQUEST['token'] ) && isset( $_REQUEST['time'] )  ){
			$token = trim($_REQUEST['token']);
			$time  = (int)$_REQUEST['time'];
			$roken = md5( $this->tokenPass . $time );
			if( $roken != $token ){
				$this->__msg(1,'token验证不通过',null);
			}
		}else{
			$this->__msg(1,'缺少token参数,token或time参数',null);
		}
	}
	
	final public function __tokenvalid(){
		if(isset($_REQUEST['method'])&&$_REQUEST['method']!='login'){
    		if( isset( $_REQUEST['token'] ) && strlen($_REQUEST['token'])>0 ){
    			$hmtokenser=new HmTokenService();
    			
    			$roken=$hmtokenser->validtoken($_REQUEST['token']);
    			if(!$roken){
    				$this->__msg(1,'token验证不通过',null);
    			}
    			
    		}else{
    			$this->__msg(1,'缺少token参数,token参数',null);
    		}
		}
	}
	
	final public function __run(){
		
		if( isset( $_REQUEST['method'] ) && method_exists( $this ,  '__'.trim( strtolower( $_REQUEST['method'] ) ) ) ) {
			$method = '__'.trim( strtolower( $_REQUEST['method'] ) );
			$this->$method();
		}else{
			
			$this->__msg(1,'缺少method参数或method参数不正确',null);
		}
	}
	
	final public function __msg($code=0,$msg='',$data=null){
		die( json_encode( array('code'=>$code,'msg'=>$msg,'data'=>$data) ) );exit;
	}
	
	#.执行信息输出
	public function msgPut($status,$msg,$data,$code=null){
		die( json_encode( array('status'=>$status,'msg'=>$msg,'data'=>$data,'code'=>$code) ) );
	}
	
	/**
	 * Request数据处理
	* */
	final public function getRequest($name = '', $default = '') {
		if (!empty($name)) {
			if (isset($_REQUEST[$name]) && strlen($_REQUEST[$name])>0) {
				return $_REQUEST[$name];
			} else {
				return $default;
			}
		}
	
		return $_REQUEST;
	}
	
}