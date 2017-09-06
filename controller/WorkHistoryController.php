<?php

class WorkHistoryController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new WorkHistoryService();
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
            $workHistorys = $_REQUEST['id'];
        } else {
            $workHistorys = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($workHistorys);

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
     * 获得医生简历数据
     */
    public function get() {
        $this->blindParams($workHistory = new WorkHistory());
        $result = $this->service->get($workHistory);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($workHistory = new WorkHistory());
        $result = $this->service->update($workHistory);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($workHistory = new WorkHistory());
        $result = $this->service->save($workHistory);

        echo json_encode($result);
    }
}
