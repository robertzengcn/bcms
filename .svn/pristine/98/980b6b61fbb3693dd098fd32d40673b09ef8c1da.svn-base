<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 专家团队(医生)
 * @author Administrator
 *
 */
class doctorMobile extends Mobile {
	
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
	 * 专家医生团队列出
	 */
	public function query() {
		$this->smarty->assign( 'list' , $this->result['rows']);
		$this->smarty->display( 'Doctor/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 医生详情
	 */
	public function get() {
		//取医生详情
		$this->smarty->assign( 'data' , $this->result->data );
		//取推荐阅读
		$this->getRecommend('doctor','doctor','name');
		//注入上一条与下一条
		$this->getNextAndLast('doctor','doctor','name');
		$this->smarty->display( 'Doctor/detail' . TPLSUFFIX );
	}
	
}

new doctorMobile();
?>