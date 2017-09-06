<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * error
 * @author Administrator
 *
 */
class errorMobile extends Mobile {
	
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
	 * 获取404页面详细信息
	 */
	public function index() {
		$this->smarty->assign( 'data' , $this->result->data );		
		//取广告图
		$mobileAd =$this->getServiceMethod('MobilePicManager','getByFlag','mobile_ad');
		$this->smarty->assign('mobileAd',$mobileAd->data);
		//手机模板自定义导航注入		
        $mobileNav= $this->queryByFlag('mobile_nav');
        $this->smarty->assign('mobileNav',$mobileNav);
        
        //取404信息
        $errorPage = $this->getServiceMethod('errorPage','query',array('code'=>404));
        $this->smarty->assign('errorPage',$errorPage->data[0]);
		
        $seo = $this->getServiceMethod('Seo','query',array("flag" => "404"));
        $this->smarty->assign('seo',$seo->data[0]);
        $this->smarty->display( 'Error/index' . TPLSUFFIX );
	}
}

new errorMobile();
?>