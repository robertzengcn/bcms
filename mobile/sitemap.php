<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * sitemap
 * @author Administrator
 *
 */
class sitemapMobile extends Mobile {
	
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
	 * 获取sitemap详细信息
	 */
	public function index() {
		$this->smarty->assign( 'data' , $this->result->data );		
		//取广告图
		$mobileAd =$this->getServiceMethod('MobilePicManager','getByFlag','mobile_ad');
		$this->smarty->assign('mobileAd',$mobileAd->data);
		//手机模板自定义导航注入		
        $mobileNav= $this->queryByFlag('mobile_nav');
        $this->smarty->assign('mobileNav',$mobileNav);
        
	        //取科室列表
        $departments = $this->getServiceMethod('department','query',array('page'=>1));
        //取每个科室下的疾病列表
        $diseaseList =array();
        foreach ($departments->data as $v){
            $department_id =  $v->id;
            $disIndep=$this->getServiceMethod('disease','getByDepartmentID',$department_id);
            $diseaseList[] = $disIndep->data;
            	
        }  
        $this->smarty->assign('department',$departments->data);
        $this->smarty->assign('diseaseList',$diseaseList);
        
        $seo = $this->getServiceMethod('Seo','query',array("flag" => "sitemap"));
        $this->smarty->assign('seo',$seo->data[0]);
		$this->smarty->display( 'Sitemap/index' . TPLSUFFIX );
	}
}

new sitemapMobile();
?>