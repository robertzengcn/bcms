<?php

/**
 * 
 * 医院动态新闻
 * @author Administrator
 *
 */
class CommodityController extends Controller {
	private $service;
	
	/**
	 * 构造函数 初始化service
	 */
	function __construct() {
		$this->service = new CommodityService ();
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
	 * 获得查询的grid数据
	 */
	public function query() {
		$result   = $this->service->query ( $_REQUEST );
		$totalRows = $this->service->totalRows ( $_REQUEST );
		return array (
				'rows' => $result->data,
				'ttl' => $totalRows->data
		);
	}
	
	/**
	 * 获得单笔
	 */
	public function get() {
		$this->blindParams ( $news = new News () );
		return $this->service->get ( $news );
	}

}

