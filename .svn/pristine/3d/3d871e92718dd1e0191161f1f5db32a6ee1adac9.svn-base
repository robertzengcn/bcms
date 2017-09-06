<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 环境展示(环境展示)
 * @author Administrator
 *
 */
class environmentMobile extends Mobile {
	
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
	 * 环境展示动态列表
	 */
	public function query() {
		$this->pageSetting( 10 ,'environment','environment');//分页式列表
		$seo = $this->getServiceMethod('Seo','query',array("flag" => "environment"));
		$this->smarty->assign('seo',$seo->data[0]);
		$this->smarty->display( 'Environment/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 环境展示详情
	 */
	public function get() {
		//取推荐阅读
		$this->getRecommend('environment','environment','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'environment' , 'environment' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'Environment/detail' . TPLSUFFIX );
	}
	
}

new environmentMobile();
?>