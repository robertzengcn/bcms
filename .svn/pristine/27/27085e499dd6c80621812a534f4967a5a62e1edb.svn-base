<?php

/**
 * 
 * 医院介绍
 * @author Administrator
 *
 */
class IntroduceController extends Controller {
	private $service;
	
	/**
	 * 构造函数 初始化service
	 */
	function __construct() {
		parent::__construct();
		$this->service = new IntroduceService ();
	}
	
	/**
	 * 过滤(non-PHPdoc)
	 * 
	 * @see Controller::filter()
	 */
	function filter() {
		$filterService = new FilterService ();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
		return $filterService->execute ();
	}
	
	/**
	 * 获得医院简介数据
	 */
	public function getInfo() {
		return $this->service->get ();
	}
	
}
?>