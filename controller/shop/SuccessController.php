<?php

/**
 * 
 * 成功案例
 * @author Administrator
 *
 */
class SuccessController extends Controller {
	private $service;
	
	/**
	 * 构造函数 初始化service
	 */
	function __construct() {
		$this->service = new SuccessService ();
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
	 * 查询
	 */
	public function query() {
		$result    = $this->service->query ( $_REQUEST );
		$totalRows = $this->service->totalRows ( $_REQUEST );
		return array (
				'rows' => $result->data,
				'ttl'  => $totalRows->data 
		);
	}
	
	/**
	 * 获得单笔数据
	 */
	public function get() {
		$this->blindParams ( $success = new Success () );
		return $this->service->get ( $success );
	}
}
?>
