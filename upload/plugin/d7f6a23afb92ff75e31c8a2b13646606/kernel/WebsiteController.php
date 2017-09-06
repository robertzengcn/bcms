<?php

class WebsiteController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new WebsiteService();
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
            $websiteArray = $_REQUEST['id'];
        } else {
            $websiteArray = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($websiteArray);

        echo json_encode($result);
    }
    
    /**
     * 删除内容数据
     */
    public function delContent() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $websiteArray = $_REQUEST['id'];
        } else {
            $websiteArray = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteContentBatch($websiteArray);
    
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
     * 获得单条数据
     */
    public function get() {
        $this->blindParams($website = new Website());
        $result = $this->service->get($website);

        echo json_encode($result);
    } 
    
    /**
     * 获得单条内容数据
     */
    public function getContent() {
        $this->blindParams($websitecontent = new Websitecontent());
        $result = $this->service->getContent($websitecontent);
    
        echo json_encode($result);
    }
    
    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($website = new Website());
        $result = $this->service->update($website);
        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($website = new Website());
        $result = $this->service->save($website);

        echo json_encode($result);
    }
    
    /**
     * 测试连接
     */
    public function testConn() {
        echo $this->service->testConn();
    }
    
    /**
     * 管理站点内容
     * */
    public function manageContent() {
    	$this->blindParams($websitecontent = new Websitecontent());
    	$result = $this->service->manageContent($websitecontent);
    	echo json_encode($result);
    }
    
    /**
     * 获取医院自定义内容
     * */
    public function getContentList() {
        $result = $this->service->getContentList($_REQUEST);
        $totalRows = $this->service->getContentTotalRows($_REQUEST);
        $data = $result->data;
        
        if (isset($_REQUEST['onlycontent']) && $_REQUEST['onlycontent']) {
            $tmpData = array();
            foreach ($data as $k => $v) {
                foreach ($v as $key=>$val) {
                	if ($key == 'content') {
                	    $tmpData[$k][$key] = strip_tags($val);
                	} else {
                	    $tmpData[$k][$key] = $val;
                	}
                	$tmpData[$k]['html'] = $v->content;
                }
            }
        }
        
        fb($tmpData, 'dddd');
        echo json_encode(array(
            'rows' => $tmpData,
            'ttl' => $totalRows->data
        ));
    }
    
    /**
     * 推送文章
     * */
    public function sendArticle() {
        $titles = explode(',', $_REQUEST['titles']);
        $headers = explode(',', $_REQUEST['headers']);
        $footers = explode(',', $_REQUEST['footers']);
        $articleIds = explode(',', $_REQUEST['ids']);
        $hospital = $_REQUEST['hospital'];
        
        //获取文章
        $_REQUEST['ids'] = $articleIds;
        $articleService = new ArticleService();
        $articles = $articleService->getByIds()->data;
        
        $data = array();
        foreach ($articles as $key=>$article) {
            $temp = array();
            foreach ($article as $k => $v) {
            	$temp[$k] = $v;
            }
            
            //随机拼接标题
            $temp['subject'] = $this->joinTitle($article->subject, $titles);
            
            //随机拼接头尾
            $temp['content'] = $this->joinArticle($article->content, $titles, $headers, $footers);
        	$data[$key] = (array)$temp;
        }
        
        //发送到指定医院
    	$result = $this->service->sendArticle($hospital, $data);
    	echo json_encode($result);
    }
    
    /**
     * 拼接文章标题
     * */
    public function joinTitle($title, $titles = array()) {
        //随机取头尾
        $titleIndex = array_rand($titles);
         
        $this->blindParams($websitecontent = new Websitecontent());
        $websitecontent->id = $titles[$titleIndex];
        $titleObj = $this->service->getContent($websitecontent)->data;
    
        return $title . '' . $titleObj->content;
    }
    
    /**
     * 拼接文章头尾
     * */
    public function joinArticle($content, $titles = array(), $headers = array(), $footers = array()) {
    	//随机取头尾
        $titleIndex = array_rand($titles);
    	$headerIndex = array_rand($headers);
    	$footerIndex = array_rand($footers);
    	
    	$this->blindParams($websitecontent = new Websitecontent());
    	$websitecontent->id = $titles[$titleIndex];
    	$titleObj = $this->service->getContent($websitecontent)->data;
    	
    	$this->blindParams($websitecontent = new Websitecontent());
    	$websitecontent->id = $headers[$headerIndex];
        $headerObj = $this->service->getContent($websitecontent)->data;
        
        $this->blindParams($websitecontent = new Websitecontent());
        $websitecontent->id = $footers[$footerIndex];
        $footerObj = $this->service->getContent($websitecontent)->data;
        
        return $headerObj->content . "<br/>" . $content . "<br/>" . $footerObj->content;
    }
    
}

