<?php

class CommodityRuleController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service   此积分规则控制器为管理员操作，必须登录管理！
     */
    function __construct() {
        parent::__construct();
        $this->service = new CommodityRuleService();
        
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
        //$filterService->addFunc($filterService::$FILERPLUSHTIME);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    /**
     * 删除单笔数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
        	
            $commoditys= $_REQUEST['id'];
        } else {
        	$arr = explode(',',$_REQUEST['id']);
        	
            $commoditys = $arr;
        }
        
       
        $result = $this->service->deleteBatch($commoditys);

        echo json_encode($result);
    }
    
    public function get_type(){
        $result = $this->service->query($_REQUEST);
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
     * 获得单笔动态数据
     */
    public function get() {
        $this->blindParams($scorerule = new CommodityRule());
        $result = $this->service->get($scorerule);
       
        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($scorerule = new CommodityRule());
        $result = $this->service->update($scorerule);       
        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {    
		$this->blindParams($scorerule = new CommodityRule());
		$result = $this->service->save($scorerule);		
		echo json_encode($result);
    }
    /**
     * 开启
     */
    public function onOffRule() {    
		$arr = array('id'=>$_REQUEST['id'],'status'=>$_REQUEST['status']);
		$result = $this->service->updateon($arr);		
		echo json_encode($result);
    }    


}
