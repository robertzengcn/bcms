<?php

class PatientCheckService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new PatientCheckDAO();
    }
    
    /**
     * 添加项目
     * */
    public function save($patientcheck){
    	$this->dao->save($patientcheck);    	
    }
    
    /**
     * 获取项目
     * */
    public function query($where) {
    	$patientchecks = $this->dao->query($where);   
    	foreach($patientchecks as $key=>$val){
    		$val->pic=UPLOAD.$val->pic;
    	}
    	return $this->success($patientchecks);
    }
    
    /*
     * 删除某个pid相关的所有化验单
     * */
    public function delebypid($arr){
    	
    	$this->dao->delebypid($arr);
    	
    	return $this->success();
    }
    
    /*
     * 根据Id删除化验单
     * */
    public function delebyid($ids){
    	if (!is_array($ids)) {
    		$ids = array($ids);
    	}
    	Entity::isIds($ids);
    	$this->dao->delebyid($ids);
    	return $this->success();
    	
    }
    


}
