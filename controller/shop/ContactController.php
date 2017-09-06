<?php

/**
 * 
 * 医院联系方式
 * @author Administrator
 *
 */
class ContactController extends Controller {
	private $service;
	
	/**
	 * 构造函数 初始化service
	 */
	function __construct() {
		parent::__construct();
		$this->service = new ContactService ();
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
	 * 根据名称查找
	 */
	public function getByName() {
		$result = $this->service->query ( $_REQUEST );
		return array (
			'rows' => $result->data,
		);
	}
	
	/**
	 * 医院路线
	 */
	public function getRoute() {
		return true;
	}
	
}
