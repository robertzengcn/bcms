<?php

class UserVarController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new UserVarService();
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
            $userVars = $_REQUEST['id'];
        } else {
            $userVars = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($userVars);

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
     * 获得单笔
     */
    public function get() {
        $this->blindParams($link = new Link());
        $result = $this->service->get($link);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($link = new Link());
        $result = $this->service->update($link);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($link = new Link());
        $result = $this->service->save($link);

        echo json_encode($result);
    }

    /**
     * 获得模板
     */
    public function getTpl() {
        $result = $this->service->getTpl();

        echo json_encode($result);
    }

    /**
     * 获得定制的变量
     */
    public function getUserVar() {
        $result = $this->service->getUserVar();

        echo json_encode($result);
    }
}

