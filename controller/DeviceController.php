<?php

class DeviceController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new DeviceService();
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
     * 删除数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $devices = $_REQUEST['id'];
        } else {
            $devices = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($devices);

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

    /**
     * 获得单笔设备数据
     */
    public function get() {
        $this->blindParams($device = new Device());
        $result = $this->service->get($device);

        echo json_encode($result);
    }

    /**
     * 编辑设备数据
     */
    public function edit() {
        $this->blindParams($device = new Device());
        $result = $this->service->update($device);

        echo json_encode($result);
    }

    /**
     * 设备添加
     */
    public function add() {
        $this->blindParams($device = new Device());
        $result = $this->service->save($device);

        echo json_encode($result);
    }
}
