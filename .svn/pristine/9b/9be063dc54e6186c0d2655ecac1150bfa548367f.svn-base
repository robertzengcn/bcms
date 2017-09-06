<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 先进设备(先进设备)
 * @author Administrator
 *
 */
class deviceMobile extends Mobile {
	
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
	 * 成功案例动态列表
	 */
	public function query() {
		$this->pageSetting( 10 ,'device','device');//分页式列表
		
		$seo = $this->getServiceMethod('Seo','query',array("flag" => "device"));
		
		$this->smarty->assign('seo',$seo->data[0]);
		$this->smarty->display( 'Device/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 成功案例详情
	 */
	public function get() {
		//取推荐阅读
		$this->getRecommend('device','device','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'device' , 'device' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'Device/detail' . TPLSUFFIX );
	}
	
}

new deviceMobile();
?>