<?php

class SysCloudController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new SysCloudService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    /**
     * 不再提示
     */
    public function synchro() {
        $result = $this->service->synchro();

        echo json_encode($result);
    }

    public function update() {
        $result = $this->service->update();

        echo json_encode($result);
    }
}

