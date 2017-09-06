<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 检查单
 * @author Administrator
 *
 */
class checklistMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param string $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}
	
	/**
	 * 
	 * 检查单  登入
	 */
	public function index() {
	    $this->smarty->display('Checklist/index' . TPLSUFFIX );
	}
	
	/**
	 * 检查单 列表
	 */
	public function query(){
		$this->smarty->display('Checklist/list' . TPLSUFFIX );
	}
	
	/**
	 * 检查单详细
	 */
	public function get() {
		$this->smarty->display('Checklist/detail' . TPLSUFFIX );
	}
}

new checklistMobile();
?>