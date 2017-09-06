<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院荣誉(医院荣誉)
 * @author Administrator
 *
 */
class honorMobile extends Mobile {
	
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
		$this->pageSetting( 10 ,'honor','honor');//分页式列表
		$this->smarty->display( 'Honor/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 医院荣誉详情
	 */
	public function get() {
		//取推荐阅读
		$this->getRecommend('honor','honor','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'honor' , 'honor' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'Honor/detail' . TPLSUFFIX );
	}
	
}

new honorMobile();
?>