<?php

class WorkerLogHistoryController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new LogService();
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
     *
     * 获取上一次登录时间
     */
    public function lastLogin(){
        $result = $this->service->query($_REQUEST);
        $data = $result->data;
        $i = 0;
        foreach($data as $value){
        	$dataArrays = explode(' ',$value->op);
            $behavior   = $dataArrays[2];
            if($behavior == '登录'){
                $i++;
                if($i == 2){
                    die(json_encode($value->logtime));
                }
            }
        }
    }
    /**
     * 清空数据
     */
    public function clearSys() {
        $result = $this->service->clear();
        $this->service->save(LogMsgs::get($_REQUEST['method']));

        echo json_encode($result);
    }

    /**
     * 开启日志系统
     */
    public function openSys() {
        $configFile = ABSPATH . '/config.json';
        if (file_exists($configFile)) {
            $content = file_get_contents($configFile);
            $config = json_decode($content);
            if (isset($config->openLog) && ! $config->openLog) {
                $config->openLog = true;
                $data = json_encode($config);
                file_put_contents($configFile, $data);
                $this->service->save(LogMsgs::get($_REQUEST['method']));
                $result = new Result(true, 113, ErrorMsgs::get(113), NULL);
            } else {
                $result = new Result(false, 114, ErrorMsgs::get(114), NULL);
            }
        } else {
            $result = new Result(false, 33, ErrorMsgs::get(33), NULL);
        }

        echo json_encode($result);
    }

    /**
     * 关闭日志系统
     */
    public function closeSys() {
        $configFile = ABSPATH . '/config.json';
        if (file_exists($configFile)) {
            $content = file_get_contents($configFile);
            $config = json_decode($content);
            if (isset($config->openLog) && $config->openLog) {
                $config->openLog = false;
                $data = json_encode($config);
                file_put_contents($configFile, $data);
                $result = new Result(true, 115, ErrorMsgs::get(115), NULL);
            } else {
                $result = new Result(false, 116, ErrorMsgs::get(116), NULL);
            }
        } else {
            $result = new Result(false, 33, ErrorMsgs::get(33), NULL);
        }

        echo json_encode($result);
    }

    /**
     * 导出xls数据
     */
    public function csvSys() {
        $fileDateTmp = date('Ymd');
        $configFile = ABSPATH . '/log/' . $fileDateTmp . '.csv';
        $fielUrl = NETADDRESS . '/log/' . $fileDateTmp . '.csv';
        if (! is_writable(ABSPATH . '/log/')) {
            $result = new Result(false, 117, ErrorMsgs::get(117), NULL);
            exit(json_encode($result));
        }

        $headerStr = iconv("utf-8", 'gbk', "用户ID-用户名,用户组,操作时间,操作\n");
        $logs = $this->service->query($_REQUEST);
        $fileStr = '';
        foreach ($logs->data as $key) {
            $group = ($key->group == 1) ? '管理员' : '工作人员';
            $fileStr .= $key->name . ',' . $group . ',' . $key->logtime . ',' . $key->op . "\n";
        }
        $fileStr = iconv("utf-8", 'gbk', $fileStr);

        $size = file_put_contents($configFile, $headerStr . $fileStr);
        if ($size > 0) {
            $result = new Result(true, 0, '生成成功', $fielUrl);
        } else {
            $result = new Result(false, 0, '生成失败', NULL);
        }

        echo json_encode($result);
    }
}
