<?php

class DrawController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new DrawService();
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
    

    

    /**
     * 获得查询的grid数据
     */
    public function query() {
        $result = $this->service->query($_REQUEST);
     
        $totalRows = $this->service->totalRows($_REQUEST);
        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data[0]->dm
        ));
    }

    
    /**
     * 获得查询的grid数据
     */
    public function querywin() {
    	$winlog=new DrawWinlogService();
    	
    
    	$result = $winlog->query($_REQUEST);
        $totalRows = count($result->data);
    
    
    	echo json_encode(array(
    			'rows' => $result->data,
    			'ttl' => $totalRows
    	));
    }
    /**
     * 获得单笔动态数据
     */
    public function get() {
    	
        $this->blindParams($draw = new Draw());
        $result = $this->service->get($draw);
       
        echo json_encode($result);
    }
    
    
    


    /**
     * 编辑
     */
    public function edit() {

        $this->blindParams($draw = new Draw());
//         print_r($commodity);
//         exit();
        $result = $this->service->update($draw);
       
        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $this->blindParams($draw = new Draw());
        $result = $this->service->save($draw);        
        echo json_encode($result);
    }
    
    
    /**
     * 添加商品
     */
    public function addprize() {
    
    	$this->blindParams($prize = new DrawPrize());
    	$prizeservice=new DrawPrizeService();
    	$result = $prizeservice->save($prize);
    
    	echo json_encode($result);
    }
    
    
    /**
     * 获得查询的奖品数据
     */
    public function prizequery() {
    	$prizeservice=new DrawPrizeService();
    	$result = $prizeservice->query($_REQUEST);
    	$totalRows = $prizeservice->totalRows($_REQUEST);
		$total = 0;
         foreach ($result->data as $key => $value) {
			$total +=$value->prize_percent;	
         }
    
    	echo json_encode(array(
    			'rows' => $result->data,
    			'ttl' => $totalRows->data,
				'total'=>$total/100
    	));
    }
    
    /**
     * 获得单笔奖品数据
     */
    public function getprize() {
    	$prizeservice=new DrawPrizeService();
    	$this->blindParams($prize = new DrawPrize());
    	$result = $prizeservice->get($prize);
    
    	echo json_encode($result);
    }
    
    /**
     * 编辑奖品
     */
    public function editprize() {
    	$prizeservice=new DrawPrizeService();
//     	$_REQUEST['start_time']=strtotime($_REQUEST['start_time']);
//     	$_REQUEST['end_time']=strtotime($_REQUEST['end_time']);
    	$this->blindParams($prize = new DrawPrize());
    	//         print_r($commodity);
    	//         exit();
    	$result = $prizeservice->update($prize);
    	 
    	echo json_encode($result);
    }
    
    /**
     * 删除单笔数据
     */
    public function delprize() {
    	// 是否单笔删除还是批量删除
    	if (is_array($_REQUEST['id'])) {
    		 
    		$prizes= $_REQUEST['id'];
    	} else {
    		$arr = explode(',',$_REQUEST['id']);
    		 
    		$prizes = $arr;
    	}
    	$prizeservice=new DrawPrizeService();
    
    	 
    	$result = $prizeservice->deleteBatch($prizes);
    
    	echo json_encode($result);
    }
    
    /*
     * 处理商品状态
     * */
    
    public function setdrawstute(){
    	if(isset($_REQUEST['id'])&&$_REQUEST['id']!=null){
			$arr=array('id'=>(int)$_REQUEST['id'],'statu'=>(int)$_REQUEST['statu']);
    		$result=$this->service->setstute($arr);
    		echo json_encode($result);
    	}else{
    		throw new ValidatorException(7);
    	}
    }
    
    public function getdrawname(){
    	$result = $this->service->getname();
    	echo json_encode($result);
    }
    
    /**
     * 删除单笔数据
     */
    public function delwinlog() {
    	// 是否单笔删除还是批量删除
    	if (is_array($_REQUEST['id'])) {
    		 
    		$commoditys= $_REQUEST['id'];
    	} else {
    		$arr = explode(',',$_REQUEST['id']);
    		 
    		$commoditys = $arr;
    	}
    	$winlog=new DrawWinlogService();
    
    	 
    	$result = $winlog->deleteBatch($commoditys);
    
    	echo json_encode($result);
    }
    
    

    

}
