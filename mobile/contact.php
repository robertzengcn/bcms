<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 联系方式(医院)
 * @author Administrator
 *
 */
class contactMobile extends Mobile {
	
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
	 * 医院路线图
	 */
	public function getRoute() {
	    $seo = $this->getServiceMethod('Seo','query',array("flag" => "contact"));
	    
	    $this->smarty->assign('seo',$seo->data[0]);	    
	    
		$this->smarty->display( 'Contact/route' . TPLSUFFIX );
		
		
	}
	/**
	 *
	 * 医院路线图
	 */
	public function index() {
		
		if(!empty($seo->data)){
		$this->smarty->assign('seo',$seo->data[0]);
		}
		$this->smarty->display( 'Contact/index' . TPLSUFFIX );
	
	
	}

	/**
	 * 
	 * 获取医院联系方式
	 */
	public function getByName() {
		$this->smarty->assign( 'info' , $this->result['rows']);
		$this->smarty->display( 'Contact/index' . TPLSUFFIX );
	}
	
}

new contactMobile();
?>