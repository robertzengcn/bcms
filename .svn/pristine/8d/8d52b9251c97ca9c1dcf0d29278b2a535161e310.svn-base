<?php
/*
 * 用户操作模块
* */


if (!defined('Boyiweb')) {
	die('Illegal Access');
}

//ini_set("display_errors", "0");
include_once ABSPATH.'/mod/Mod.php';

class Users  extends Mod{
	
	function __construct() {

		parent::__construct();
		$this->validuser();
		$this->excute();
	
		

	}
	
	protected function validuser(){
		session_start();
		if(!isset($_SESSION['member_id'])&&strlen($_SESSION['member_id'])<1){
			echo json_encode(array('statu'=>false,'msg'=>'用户未登陆','code'=>1,'data'=>null));
			exit();
		}
	}
	public function change_password() {
		
		
		if(!isset($_REQUEST['ckcode'])||strtolower($_SESSION['verify'])!=strtolower($_REQUEST['ckcode'])){
			$array = array('status'=>false,'msg'=>'验证码错误','code'=>10001,'data'=>null);
			$_SESSION['verify']=rand(1,100);//随机生成一个验证码覆盖原来的
			echo json_encode($array);
			exit();
		}
		
		if(!isset($_REQUEST['password'])||strlen($_REQUEST['password'])<1){
			$this->msgPut(false,4,'password参数缺失');
		}
		if(!isset($_REQUEST['newpassword'])||strlen($_REQUEST['newpassword'])<1){
			$this->msgPut(false,5,'newpassword参数缺失');
		}
		if(!isset($_REQUEST['newpassword2'])||strlen($_REQUEST['newpassword2'])<1){
			$this->msgPut(false,6,'pnewpassword2参数缺失');
		}
		if($_REQUEST['newpassword2']!=$_REQUEST['newpassword']){
			$this->msgPut(false,7,'两次输入密码不一致');
		}
		$memberser=new MemberService();
		
		$result=$memberser->checkaccount(array('username'=>$_SESSION['user'],'password'=>$_REQUEST['password']));
		
		if($result->statu){//如果验证成功
			
			$chresult=$memberser->resetpass($result->data->user_id,$_REQUEST['password'],$_REQUEST['newpassword']);
			
			if($chresult->statu){
				$this->msgPut(true,0,null);
			}else{
				$this->msgPut(false,9,$chresult->msg);
			}
			
		}else{
			$this->msgPut(false,8,$result->msg);
		}
		
		
		
		
		
	}
}
new Users();
?>