<?php

class MediaReportController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new MediaReportService();
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
            $mediaReports = $_REQUEST['id'];
        } else {
            $mediaReports = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($mediaReports);

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
        $this->blindParams($mediaReport = new MediaReport());
        $result = $this->service->get($mediaReport);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($mediaReport = new MediaReport());
        if (empty($mediaReport->show_position)) {
            $mediaReport->show_position = '0';
        } else {
            $mediaReport->show_position = implode(',', $mediaReport->show_position);
        }
        $result = $this->service->update($mediaReport);

        echo json_encode($result);
    }

    /**
     * 动态
     */
    public function add() {
        $this->blindParams($mediaReport = new MediaReport());
        if (empty($mediaReport->show_position)) {
            $mediaReport->show_position = '0';
        } else {
            $mediaReport->show_position = implode(',', $mediaReport->show_position);
        }
        $result = $this->service->save($mediaReport);

        echo json_encode($result);
    }
}
