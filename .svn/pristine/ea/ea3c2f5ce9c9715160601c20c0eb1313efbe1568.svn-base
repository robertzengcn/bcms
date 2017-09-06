<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 先进设备(先进设备)
 * @author Administrator
 *
 */
class diseaseMobile extends Mobile {
	
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
		if(isset($_REQUEST['disease_id']) && $_REQUEST['disease_id'] != ''){
			$param['disease_id'] = (int)$_REQUEST['disease_id'];
		}
		if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
			$param['department_id'] = (int)$_REQUEST['department_id'];
		}
		$list = $this->getServiceMethod('article','query',$param);
		

		$this->smarty->assign( 'list' , $list->data);
	
		//$this->pageSetting( 10 ,'disease','disease');//分页式列表
		
		
		$this->smarty->display( 'Disease/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 成功案例详情
	 */
	public function get() {
		//取推荐阅读
		$this->getRecommend('disease','disease','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'disease' , 'disease' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'Disease/detail' . TPLSUFFIX );
	}
	
}

new diseaseMobile();
?>