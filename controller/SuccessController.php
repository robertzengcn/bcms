<?php

class SuccessController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new SuccessService();
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
            $successArray = $_REQUEST['id'];
        } else {
            $successArray = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($successArray);

        echo json_encode($result);
    }

    /**
     * 查询
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
     * 添加案例
     */
    public function add() {
        $this->blindParams($success = new Success());
        if (empty($success->show_position)) {
            $success->show_position = '0';
        } else {
            $success->show_position = implode(',', $success->show_position);
        }

        $result = $this->service->save($success);

        echo json_encode($result);
    }

    /**
     * 获得单笔数据
     */
    public function get() {
        $this->blindParams($success = new Success());
        $result = $this->service->get($success);

        echo json_encode($result);
    }

    /**
     * 编辑数据
     */
    public function edit() {
        $this->blindParams($success = new Success());
        if (empty($success->show_position)) {
            $success->show_position = '0';
        } else {
            $success->show_position = implode(',', $success->show_position);
        }
        $result = $this->service->update($success);

        echo json_encode($result);
    }
}
?>
