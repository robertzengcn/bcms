<?php

/**
 * 健康体检预约模块流程控制器
 * @author Administrator
 *
 */
class PhysicalexamController extends Controller {

    private $service = null;

    /**
     * 构造方法
     * 实例化基类并实例化service层,并将其赋值给service属性
     */
    public function __construct() {
        parent::__construct();
        $this->service = new PhysicalexamService();
    }

    /**
     * 数据安全验证、登录检测
     *
     * @see controller/Controller::filter()
     */
    public function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        return $filterService->execute();
    }

    public function query() {
    	$result = $this->service->query($_REQUEST);
    	$ttlrows = $this->service->totalRows($_REQUEST);
    	
    	foreach ($result->data as $key => $value) {
    		$value->plushtime = date('Y-m-d', $value->plushtime);
    	}
    	
    	die(json_encode(array(
    			'rows' => $result->data,
    			'ttl' => $ttlrows->data
    	)));
    }
    
    /**
     * 获得单笔体检预约数据
     */
    public function get() {
    	$this->blindParams($device = new Physicalexam());
    	$result = $this->service->get($device);
        
    	$result->data->plushtime = date('Y-m-d', $result->data->plushtime);
    	
    	echo json_encode($result);
    }
    
    /**
     * 编辑体检预约数据
     */
    public function edit() {
    	$this->blindParams($device = new Physicalexam());
    	$result = $this->service->update($device);
    
    	echo json_encode($result);
    }
    
    /**
     * 体检预约添加
     */
    public function add() {
    	$this->blindParams($device = new Physicalexam());
    	$result = $this->service->save($device);
    
    	echo json_encode($result);
    }
    
    /**
     * 删除数据
     */
    public function del() {
    	// 是否单笔删除还是批量删除
    	if (is_array($_REQUEST['id'])) {
    		$devices = $_REQUEST['id'];
    	} else {
    		$devices = array(
    				$_REQUEST['id']
    		);
    	}
    	$result = $this->service->deleteBatch($devices);
    
    	echo json_encode($result);
    }

}

