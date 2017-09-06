<?php

/*
 * 登陆页面模块
 * */
if (!defined('Boyiweb')) {
	die('Illegal Access');
}

//ini_set("display_errors", true);
include_once ABSPATH.'/mod/Mod.php';

class Login extends Mod{
	public function __construct() {
		parent::__construct();
		$this->excute();
	}
	
	/**
	 *
	 *登录类方法
	 */
	public function index() {
		
	
		$this->smarty->display( 'login/index'.SUBFIX);
	}
	/**
	 * 登录方法
	 * */
	public function dologin(){
		if(!session_id()) session_start();
		if(!isset($_REQUEST['ckcode'])||strtolower($_SESSION['verify'])!=strtolower($_REQUEST['ckcode'])){
			$array = array('status'=>false,'msg'=>'验证码错误','code'=>10001,'data'=>null);
			$_SESSION['verify']=rand(1,100);//随机生成一个验证码覆盖原来的
			echo json_encode($array);			
			exit();
		}
		
		if(!isset($_REQUEST['tmobile'])||!strlen($_REQUEST['tmobile'])>1){
			$array = array('status'=>false,'msg'=>'缺少mobile参数','code'=>10003,'data'=>null);
			echo json_encode($array);
			exit();
		}
		if(!isset($_REQUEST['tpassword'])||!strlen($_REQUEST['tpassword'])>1){
			$array = array('status'=>false,'msg'=>'缺少password参数','code'=>10004,'data'=>null);
			echo json_encode($array);
			exit();
		}
		

		
		if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}/",$_REQUEST['tmobile'])){
			$array = array('status'=>false,'msg'=>'mobile格式错误','code'=>10003,'data'=>null);
			echo json_encode($array);
			exit();
		}
		
		$memberser=new MemberService();
		$datacheck=array('username'=>$_REQUEST['tmobile'],
				'password'=>$_REQUEST['tpassword']
		);
		
		$result=$memberser->docheck($datacheck);
		
		
		if($result->statu){
			if(isset($_SESSION['validmobile'])){
				array_push($_SESSION['validmobile'],$_REQUEST['tmobile']);
			}else{
				$_SESSION['validmobile']=array();
				array_push($_SESSION['validmobile'],$_REQUEST['tmobile']);
			}
			$this->msgPut(true, 0, null,null);
			//$array = array('status'=>true,'msg'=>null,'code'=>0,'data'=>null);
			//echo json_encode($array);
			//exit();
		}else{	
			$this->msgPut(false, $result->code, $result->msg,null);
// 			$array = array('status'=>false,'msg'=>$result->msg,'code'=>$result->code,'data'=>null);
// 			echo json_encode($array);
// 			exit();
		}
		
	}
	
	/**
	 * 获取token防止二次提交
	 * 
	 * */
	public function gettoken(){
		session_start();
		$_SESSION['lotoken']=md5(time().rand(1,999));//产生一个随机数防止域外提交
		$array = array('status'=>true,'msg'=>null,'code'=>null,'data'=>$_SESSION['lotoken']);
		echo json_encode($array);
		
	}
	
	/**
	 * 判断登入状态
	 */
	public function islogin(){
		session_start();
		
		if (isset($_SESSION['user']) && strlen($_SESSION['user'])>0) {
			$memberser=new MemberService();
		$result=$memberser->getmemberbyname($_SESSION['user']);
		
		
            $data = array(
                'name' => $_SESSION['user'],
            	'id' => $_SESSION['member_id'],
                'date' => date('Y年m月d日 H:i:s')
            );
            $array = array('statu'=>true,'msg'=>null,'code'=>null,'data'=>$data,'member'=>$result);
	    }else{
	    	$array = array('statu'=>false,'msg'=>null,'code'=>null,'data'=>null);
	    }
	    echo json_encode($array);
	}
	
	/**
	 * 注销方法
	 * */
	public function logoff(){
		session_start();
		session_destroy();
		$this->msgPut(true, 0, "",null);
		
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
}
new Login();