<?php

/**
 * 
 * @author Administrator
 *
 */
class PatientDataController extends Controller {
    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new PatientDataService();
    }
	
	public function filter() {
        $filterService = new FilterService();
        //$filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        //$filterService->addFunc($filterService::$WORKERLOGHISTORY);
        return $filterService->execute();
    }
}
