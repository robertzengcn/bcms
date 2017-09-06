<?php

class MovieController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new MovieService();
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
            $movies = $_REQUEST['id'];
        } else {
            $movies = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($movies);

        echo json_encode($result);
    }

    /**
     * 获得查询的grid数据
     */
    public function query() {
        $movies = $this->service->query($_REQUEST);
        $totalRows = $this->service->totalRows($_REQUEST);

        echo json_encode(array(
            'rows' => $movies->data,
            'ttl' => $totalRows->data
        ));
    }

    /**
     * 获得单笔
     */
    public function get() {
        $this->blindParams($movie = new Movie());
        $result = $this->service->get($movie);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($movie = new Movie());
        $result = $this->service->update($movie);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($movie = new Movie());
        $result = $this->service->save($movie);

        echo json_encode($result);
    }
}
