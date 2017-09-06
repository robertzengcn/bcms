<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 成功案例(康复案例)
 * @author Administrator
 *
 */
class successMobile extends Mobile {
	
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
	    $param = array();
	    $param['show_position'] = $this->getShowPositionStr(PROJECT_NAME); //获取特定显示数据
		$this->pageSetting( 10 ,'success','success',$param);//分页式列表
		$this->smarty->display( 'Success/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 成功案例详情
	 */
	public function get() {
		//取推荐阅读
		$this->getRecommend('success','success','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'success' , 'success' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'Success/detail' . TPLSUFFIX );
	}
	
}

new successMobile();
?>