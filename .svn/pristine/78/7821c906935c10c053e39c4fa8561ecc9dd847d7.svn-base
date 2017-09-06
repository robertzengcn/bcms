<?php

class SearchController extends Controller {

    private $service;

    /**
     * 构造函数 初始化dao
     */
    function __construct() {
        parent::__construct();
        $this->service = new SearchService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
          $filterService = new FilterService();
          $filterService->addFunc($filterService::$SQLINJECTION);
         //$filterService->addFunc($filterService::$WORKERISLOGIN);
          $filterService->addFunc($filterService::$FILERPLUSHTIME);
        //$filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    function query(){
    	$keyword = $_REQUEST['keyword'];
    	$result = $this->service->query($keyword);
    	 echo json_encode(array(
            'data' => $result,
            'ttl' => count($result),
    	 	'key' => $keyword
        ));
    }
}  