<?php

class IntroduceController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new IntroduceService();
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
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    /**
     * 获得医院简介数据
     */
    public function getInfo() {
        $result = $this->service->get();

        echo json_encode($result);
    }

    /**
     * 保存医院简介数据
     */
    public function save() {
        $this->blindParams($introduce = new Introduce());
        $result = $this->service->update($introduce);

        echo json_encode($result);
    }
}
?>