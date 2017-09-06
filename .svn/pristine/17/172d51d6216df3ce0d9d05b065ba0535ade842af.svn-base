<?php

class ChannelArticleController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new ChannelArticleService();
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
     * 根据channel_id获取对应文章
     */
    public function getByChannelID() {
        $result = $this->service->getByChannelID($_REQUEST);
        $totalRows = $this->service->totalRows($_REQUEST);

        foreach ($result->data as $key) {
        	$key->plushtime = date('Y-m-d', $key->plushtime);
        }
        
        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        ));
    }

    /**
     * 获取>30的随机数
     */
    public function rand() {
        echo json_encode(rand(30, 10000));
    }

    /**
     * 删除
     */
    public function del() {
        $this->blindParams($channelArticle = new ChannelArticle());
        $result = $this->service->delete($channelArticle);

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
        $this->blindParams($channelArticle = new ChannelArticle());
        if (empty($channelArticle->show_position)) {
            $channelArticle->show_position = '0';
        } else {
            $channelArticle->show_position = implode(',', $channelArticle->show_position);
        }
        $result = $this->service->save($channelArticle, $_REQUEST['channel_id']);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function get() {
        $this->blindParams($channelArticle = new ChannelArticle());
        $result = $this->service->get($channelArticle);
        echo json_encode($result);
    }

    /**   获取推荐位 */
    public function getAll() {
        $result = $this->service->getAll();
        echo json_encode($result);
    }    
    
    /**
     * 更改
     */
    public function update() {
        $this->blindParams($channelArticle = new ChannelArticle());
        if (empty($channelArticle->show_position)) {
            $channelArticle->show_position = '0';
        } else {
            $channelArticle->show_position = implode(',', $channelArticle->show_position);
        }
        $result = $this->service->update($channelArticle);

        echo json_encode($result);
    }
    /**
     * 搜索文章
     * */    
    public function query() {
    	$where=array();
    	foreach($_REQUEST as $key=>$val){
    		if(strlen($val)>0){
    			$where[$key]=$val;
    		}
    	}
    	
    	$result = $this->service->query($where);
    	$totalRows = $this->service->totalRows($where);
    
    	echo json_encode(array(
    			'rows' => $result->data,
    			'ttl' => $totalRows->data
    	));
    }

}
