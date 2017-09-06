<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院介绍
 * @author Administrator
 *
 */
class introduceMobile extends Mobile {
	
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
	 * 获取医院介绍详细信息
	 */
	public function getInfo() {
		$this->smarty->assign( 'data' , $this->result->data );
		//取疾病列表
		$diseases = $this->getServiceMethod('disease','query',array());
		//取医生
		$doctors  = $this->getServiceMethod('doctor','query',array());
		//取特色技术
		$technologys  = $this->getServiceMethod('technology','query',array());	
		//取先进设备
		$devices  = $this->getServiceMethod('device','query',array());		
		//取医院新闻
		$news  = $this->getServiceMethod('news','query',array());	

		//取广告图
		$mobileAd =$this->getServiceMethod('MobilePicManager','getByFlag','mobile_ad');
		$this->smarty->assign('mobileAd',$mobileAd->data);
		//手机模板自定义导航注入		
        $mobileNav= $this->queryByFlag('mobile_nav');
        $this->smarty->assign('mobileNav',$mobileNav);
        
		$this->smarty->assign('diseases',$diseases->data);
		$this->smarty->assign('doctors',$doctors->data);
		$this->smarty->assign('technologys',$technologys->data);
		$this->smarty->assign('devices',$devices->data);
		$this->smarty->assign('news',$news->data);
		$this->smarty->display( 'Introduce/index' . TPLSUFFIX );
	}
}

new introduceMobile();
?>