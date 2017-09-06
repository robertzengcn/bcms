<?php

class CommodityKeyController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new CommodityKeyService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        //$filterService->addFunc($filterService::$WORKERISLOGIN);
        //$filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }    
}

?>
