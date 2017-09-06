<?php

class StatisticsLogController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new StatisticsLogService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
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
     * 添加，判断当受访链接为后台地址时不保存
     */
    public function add() {
    	if(!isset($_REQUEST['ip']) || $_REQUEST['ip'] == ''){
    		$_REQUEST['ip'] = $_SERVER["REMOTE_ADDR"];
    	}
		
		$flag = array('statu'=>false,'code'=>'','msg'=>'','data'=>'');
		//本机ip过滤
		if($_REQUEST['ip'] =='127.0.0.1'){
		    echo json_encode($flag);
			exit;
		}
		
		//已方网站过滤
		$boyicms = 'boyicms.com';
		$fromurl = $_REQUEST["fromurl"] ? $_REQUEST["fromurl"] : '';
		if($fromurl && preg_match("/$boyicms/i", $fromurl)){
		    echo json_encode($flag);
			exit;			
		}
		//内网同一网段过滤
		if(preg_match("/192.168./i", $_REQUEST['ip'])){
			echo json_encode($flag);
			exit;		
		}
		//本站上一级来源为空
		$url = $_SERVER['HTTP_HOST'];
		$fromurl = $_REQUEST["fromurl"] ? $_REQUEST["fromurl"] : '';
		if($fromurl && preg_match("/$url/i", $fromurl)){
			$_REQUEST["fromurl"] = '';
		}		
    	if(isset($_REQUEST['url'])){
    		$tourl=$_REQUEST['url'];
    		if(!strstr($tourl,'controller')||!strstr($tourl,'hcc')){
    			$this->blindParams($statisticsLog = new StatisticsLog());
		        $result = $this->service->save($statisticsLog);
		        echo json_encode($result);
    		}    		
    	}  
    }

    /**
     * 获得统计数据
     */
    public function getStat() {
        $result = $this->service->getStat();

        echo json_encode($result->data);
    }

    /**
     * 本周流量趋势
     */
    public function weekTrend() {
        $starTime = strtotime(date('Y-m-d'));
        $endTime = strtotime(date('Y-m-d', strtotime('+1 day')));

        $s = date('w', $starTime);
        if ($s != 0) {
            $starTime -= 86400 * ($s - 1);
        }
        $s = date('w', $endTime);
        if ($s != 0) {
            $endTime += 86400 * (7 - $s);
        }

        $_REQUEST['star'] = date('Y-m-d', $starTime);
        $_REQUEST['end'] = date('Y-m-d', $endTime);

        $result = $this->service->trend();

        echo json_encode($result);
    }

    /**
     * 流量趋势
     */
    public function trend() {
        $result = $this->service->trend();

        echo json_encode($result);
    }

    /**
     * 本周新老访客分布(按独立访客)
     */
    public function weekDistributed() {
        $starTime = strtotime(date('Y-m-d'));
        $endTime = strtotime(date('Y-m-d', strtotime('+1 day')));

        $s = date('w', $starTime);
        if ($s != 0) {
            $starTime -= 86400 * ($s - 1);
        }
        $s = date('w', $endTime);
        if ($s != 0) {
            $endTime += 86400 * (7 - $s);
        }

        $_REQUEST['star'] = date('Y-m-d', $starTime);
        $_REQUEST['end'] = date('Y-m-d', $endTime);

        $result = $this->service->distributedByLine();

        echo json_encode($result);
    }
    
/**
     * 本月新老访客分布(按独立访客)
     */
    public function mothDistributed() {
        $starTime = strtotime(date('Y-m-d', strtotime('-30 day')));
        $endTime = strtotime(date('Y-m-d'));

        $_REQUEST['star'] = date('Y-m-d', $starTime);
        $_REQUEST['end'] = date('Y-m-d', $endTime);

        $result = $this->service->distributedByLine();

        echo json_encode($result);
    }
    
    /**
     * 新老访客分布(按时间访客)
     */
    public function lineDistributed() {
        $result = $this->service->distributedByLine();
    
        echo json_encode($result);
    }

    /**
     * 新老访客分布(按独立访客)
     */
    public function distributed() {
        $result = $this->service->distributed();

        echo json_encode($result);
    }

    /**
     * 来路域名TOP10(按来访次数)
     */
    public function selFrom() {
        $result = $this->service->selFrom();

        echo json_encode($result);
    }

    /**
     * 受访页面TOP10(按浏览次数)
     */
    public function selTo() {
        $result = $this->service->selTo();

        echo json_encode($result);
    }
}

