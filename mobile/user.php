<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院荣誉(医院荣誉)
 * @author Administrator
 *
 */
class userMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		
		$this->excute();
		
	}
	
	/**
	 * 
	 * 医院荣誉列表
	 */
	public function query() {
		if(!isset($_SESSION['user'])&&strlen($_SESSION['user'])<1){
			header("Location: /mobile/login.php");
			exit();
		}				
		$seo = $this->getServiceMethod('Seo','query',array("flag" => "user"));
		if(!empty($seo->data)){
		$this->smarty->assign('seo',$seo->data[0]);
		}
		$this->smarty->display( 'User/index' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 获取个人信息
	 */
	public function get() {
		
		if(!isset($_SESSION['member_id'])&&strlen($_SESSION['member_id'])<1){
			header("Location: /mobile/login.php");
			exit();
		}	
		$memberser=new MemberService();
		$member=new member();
		$member->id=$_SESSION['member_id'];
		$date=$memberser->get($member);
		if($date->data){
			$this->smarty->assign('username',$date->data->username);
			$this->smarty->assign('telephone',$date->data->telephone);
			$this->smarty->display( 'User/detail' . TPLSUFFIX );
		}
		

	}
	
	/*
	*取用户挂号信息
	*/
	public function getmyreser(){
		if(!isset($_SESSION['member_id'])&&strlen($_SESSION['member_id'])<1){
			header("Location: /mobile/login.php");
			exit();
		}
		$this->smarty->display( 'User/myreser' . TPLSUFFIX );
		
		
	}
	

	
}

new userMobile();
?>