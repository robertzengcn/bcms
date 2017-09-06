<?php

class CommodityKeyService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new CommodityKeyDAO();
    }
	//保证记录值
     public function addKey($where){ 
	 
		$_REQUEST = $where;	
		$this->blindParams($commoditykey = new CommodityKey());	

    	$cresult=$this->getUserId(array('user_id'=>$where['user_id']));	
    	if(empty($cresult->data)){//用户表里无此用户时添加 
 			return $this->dao->save($commoditykey);	      
    	}else{
				$commoditykey->id = $cresult->data['id'];
				$commoditykey->lose_time = time()+604800;
			return $this->dao->updateInfo($commoditykey);		
		}
	 }
	 
    public function getUserId($arr){
    	$result=$this->dao->getUserId($arr);
    	return $this->success($result);
    }
    //是否失效
     public function isLose($where){		 
		return $this->dao->isLose($where);	
	 }
    protected function blindParams($entity) {
        foreach ($entity as $key => $value) {
            if (isset($_REQUEST[$key])) {
                $entity->$key = $_REQUEST[$key];
            }
        }
    }
	
}

