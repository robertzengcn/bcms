<?php

class NewsController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new NewsService();
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
            $newsArray = $_REQUEST['id'];
        } else {
            $newsArray = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($newsArray);

        echo json_encode($result);
    }

    /**
     * 获得查询的grid数据
     */
    public function query() {    	
        $result = $this->service->query($_REQUEST);
		
        $totalRows = $this->service->totalRows($_REQUEST);
		
        foreach ($result->data as $key => $value) {
        	$value->plushtime = date('Y-m-d', $value->plushtime);
        }		
        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        ));
    }

    /**
     * 获得单笔
     */
    public function get() {
        $this->blindParams($news = new News());
        $result = $this->service->get($news);

        echo json_encode($result);
    }

    /**   获取推荐位 */
    public function getAll() {
        $result = $this->service->getAll();
        echo json_encode($result);
    }   
    
    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($news = new News());   
        if (empty($news->show_position)) {
            $news->show_position = '0';
        } else {
            $news->show_position = implode(',', $news->show_position);
        }     
        $result = $this->service->update($news);
        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($news = new News());
        if (empty($news->show_position)) {
            $news->show_position = '0';
        } else {
            $news->show_position = implode(',', $news->show_position);
        }
        $result = $this->service->save($news);

        echo json_encode($result);
    }
}

