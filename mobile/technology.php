<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 特色技术(特色技术)
 * @author Administrator
 *
 */
class technologyMobile extends Mobile {
	
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
	 * 特色技术列表
	 */
	public function query() {
	    $param = array();
	    $param['show_position'] = $this->getShowPositionStr(PROJECT_NAME); //获取特定显示数据
		$this->pageSetting( 10 ,'technology','technology',$param);//分页式列表
		$seo = $this->getServiceMethod('Seo','query',array("flag" => "technology"));
		$this->smarty->assign('seo',$seo->data[0]);
		$this->smarty->display( 'Technology/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 特色技术详情
	 */
	public function get() {
		//取推荐阅读
		$this->getRecommend('technology','technology','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'technology' , 'technology' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'Technology/detail' . TPLSUFFIX );
	}
	
}

new technologyMobile();
?>