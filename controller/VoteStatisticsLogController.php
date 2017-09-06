<?php

class VoteStatisticsLogController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new VoteStatisticsLogService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        return $filterService->execute();
    }

    /**
     * 删除数据
     */
    public function del() {
        $result = $this->service->deleteBatch();

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
     * 投票分布1
     */
    public function distributed() {
        $result = $this->service->distributed();

        echo json_encode($result);
    }

    /**
     * 投票分布2
     */
    public function lineDistributed() {
		$vid = $_REQUEST['vid'];
        $result = $this->service->distributedByLine($vid);
    
        echo json_encode($result);
    }
    /**
     * 投票
     */
    public function voteLineDistributed() {
        $result = $this->service->voteLineDistributed();
    
        echo json_encode($result);
    }
    /**
     * 综合统计数据
     */
    public function getVoteData() {
        $result = $this->service->getVoteData();
        $totalRows = count($result);

        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows
        ));
    }	
}

