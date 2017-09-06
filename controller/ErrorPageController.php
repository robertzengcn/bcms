<?php

class ErrorPageController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new ErrorPageService();
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
     * 删除数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $errorPages = $_REQUEST['id'];
        } else {
            $errorPages = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($errorPages);

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
        $this->blindParams($errorPage = new ErrorPage());
        $result = $this->service->get($errorPage);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($errorPage = new ErrorPage());
        $errorPage->page = $errorPage->code . '.html';
        $errorPage->defaultpage = $errorPage->page;
        $result = $this->service->update($errorPage);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($errorPage = new ErrorPage());
        $errorPage->page = $errorPage->code . '.html';
        $errorPage->defaultpage = $errorPage->page;
        $result = $this->service->save($errorPage);

        echo json_encode($result);
    }

    /**
     * 获取后台文件夹地址
     */
    public function getUrl() {
        $configFile = ABSPATH . '/config.json';
        if (file_exists($configFile)) {
            $content = file_get_contents($configFile);
            $config = json_decode($content);
            $result = new Result(true, 0, '', $config->hccDir);
        } else {
            $result = new Result(false, 33, ErrorMsgs::get(33), Null);
        }

        echo json_encode($result);
    }

    /**
     * 设置后台文件夹路径
     */
    public function setUrl() {
        $configFile = ABSPATH . '/config.json';
        if (! file_exists($configFile)) {
            exit(json_encode(new result(false, 33, ErrorMsgs::get(33), Null)));
        }

        $content = file_get_contents($configFile);
        $config = json_decode($content);
        $url = ABSPATH . '/' . $config->hccDir;
        if (! file_exists($url)) {
            exit(json_encode(new result(false, 51, ErrorMsgs::get(51), Null)));
        }

        if (rename($url, ABSPATH . '/' . $_REQUEST['url'])) {
            // 更改配置文件
            $config->hccDir = $_REQUEST['url'];
            $url = json_encode($config);
            file_put_contents($configFile, $url);
            // 读取配置文件
            $content = file_get_contents($configFile);
            $config = json_decode($content);
            $url = NETADDresultS . '/' . $_REQUEST['url'];
            $result = new result(true, 0, '', $url);
        } else {
            $result = new result(false, 50, ErrorMsgs::get(50), Null);
        }

        echo json_encode($result);
    }
}

