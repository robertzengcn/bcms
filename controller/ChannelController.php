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
        $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    /**
     * 条件查询
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
     * 删除
     */
    public function del() {
        $this->blindParams($channel = new Channel());
        $result = $this->service->delete($channel);

        echo json_encode($result);
    }

    /**
     * 批量删除
     */
    public function delBatch() {
        $result = $this->service->deleteBatch($_REQUEST['id']);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function save() {
        $this->blindParams($channel = new Channel());
        $result = $this->service->save($channel);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function get() {
        $this->blindParams($channel = new Channel());
        $result = $this->service->get($channel);

        echo json_encode($result);
    }

    /**
     * 更改
     */
    public function update() {
        $this->blindParams($channel = new Channel());
        $result = $this->service->update($channel);

        echo json_encode($result);
    }

    /**
     * 获取自定义字段
     */
    public function getUserVar() {
        $result = $this->service->getUserVar();
        if (sizeof($result->data) <= 0) {
            $result = $this->getVarConfig();
        }

        echo json_encode($result);
    }

    /**
     * 更改自定义字段
     */
    public function updateUserVar() {
        $result = $this->service->updateUserVar();

        echo json_encode($result);
    }

    /**
     * 获取配置变量
     */
    private function getVarConfig() {
        $configFile = ABSPATH . '/tpl/channel/config.json';
        if (file_exists($configFile)) {
            $content = file_get_contents($configFile);
            $config = json_decode($content);

            $result = new Result(true, 0, '', $config);
        } else {
            $result = new Result(false, 33, ErrorMsgs::get(33), Null);
        }

        return $result;
    }
    
    /**
     * 获取静态url列表
     */
    public function getHtmlUrl() {
    
    	$result = $this->service->getHtmlUrl();
    
    	echo json_encode($result);
    }
}
