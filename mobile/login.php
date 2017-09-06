<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院荣誉(医院荣誉)
 * @author Administrator
 *
 */
class loginMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		//$this->getuser();上线时打开
		$this->excute();
		
	}
	
	/**
	 * 
	 * 医院荣誉列表
	 */
	public function query() {
		if(isset($_SESSION['user'])&&strlen($_SESSION['user'])>0){
			header("Location: /mobile/user.php");
			exit();
		}
		
		$this->smarty->display( 'Login/index' . TPLSUFFIX );
		
	}
		
}

new loginMobile();
?>