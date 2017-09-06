<?php

class ChannelController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new ChannelService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
 		$filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);

        return $filterService->execute();
    }

    /**
     * 条件查询
     */
    public function query() {
        $result = $this->service->query($_REQUEST);
        $totalRows = $this->service->totalRows($_REQUEST);

        return array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        );
    }

 

    /**
     * 编辑
     */
    public function get() {
        $this->blindParams($channel = new Channel());
        $result = $this->service->get($channel);

        return $result;
    }

}
