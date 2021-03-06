<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院动态
 * @author Administrator
 *
 */
class newsMobile extends Mobile {
	
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
	    $param = array();
	    $param['show_position'] = $this->getShowPositionStr(PROJECT_NAME); //获取特定显示数据
		$this->pageSetting( 10 ,'news','news',$param);//分页式列表
		$this->smarty->display( 'News/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 医院动态详情
	 */
	public function get() {
		//取推荐阅读
		$this->getRecommend('news','news','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'news' , 'news' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'News/detail' . TPLSUFFIX );
	}
}

new newsMobile();
?>