<?php

class TagController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new TagService();
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
     * 删除单笔数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $tags = $_REQUEST['id'];
        } else {
            $tags = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($tags);

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
     * 获得查询的grid数据
     */
    public function qryArticle() {
        $result = $this->service->queryArticle($_REQUEST);
        $totalRowsArticle = $this->service->totalRowsArticle($_REQUEST);

        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRowsArticle->data
        ));
    }

    /**
     * 获得单笔
     */
    public function get() {
        $this->blindParams($tag = new Tag());
        $result = $this->service->get($tag);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($tag = new Tag());
        $result = $this->service->update($tag);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($tag = new Tag());
        $result = $this->service->save($tag);

        echo json_encode($result);
    }
}
