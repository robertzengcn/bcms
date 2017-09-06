<?php

class BusinessController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new BusinessService();
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
     * 删除数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $businessArray = $_REQUEST['id'];
        } else {
            $businessArray = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($businessArray);

        echo json_encode($result);
    }

    /**
     * 获得查询的grid数据
     */
    public function query() {
        $result = $this->service->query($_REQUEST);
        $totalRows = $this->service->totalRows($_REQUEST);

        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        ));
    }

    // 获得唯一一笔数据
    public function getOne() {
        $result = $this->service->query($_REQUEST);

        echo json_encode($result);
    }

    /**
     * 获得单笔
     */
    public function get() {
        $this->blindParams($business = new Business());
        $result = $this->service->get($business);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($business = new Business());
        $result = $this->service->update($business);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($business = new Business());
        $result = $this->service->save($business);

        echo json_encode($result);
    }
}

