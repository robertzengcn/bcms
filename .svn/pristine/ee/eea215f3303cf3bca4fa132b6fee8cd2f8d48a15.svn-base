<?php
//载入入口文件
include_once 'init.php';

/**
 * 博爱手机端类
 * @author Administrator
 *
 */
class boaiShop extends Shop{
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
	 * 展示首页
	 */
	public function index(){


		$this->smarty->display('Index/index' . TPLSUFFIX );
		
		
	}
	
}
new boaiShop();