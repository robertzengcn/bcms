<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院动态
 * @author Administrator
 *
 */
class commodityShop extends Shop {
	
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
	 * 医院新闻动态列表
	 */
	public function query() {
		$categories_id=isset($_REQUEST['categories_id'])?(int)$_REQUEST['categories_id']:"";
		
		$this->pageSetting( 10 ,'commodity','commodity',array('categories_id'=>$categories_id));//分页式列表		
		$seo = $this->getServiceMethod('Seo','query',array("flag" => "news"));
		$this->smarty->assign('seo',$seo->data[0]);
		$this->smarty->display( 'Commodity/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 医院动态详情
	 */
	public function get() {
		//取推荐阅读
		//$this->getRecommend('news','news','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'commodity' , 'commodity' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'Commodity/detail' . TPLSUFFIX );
	}
}

new commodityShop();
?>