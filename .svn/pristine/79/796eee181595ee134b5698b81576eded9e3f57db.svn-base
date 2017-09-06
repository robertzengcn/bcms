<?php

/**
 * 视频DAO
 *
 * @author Administrator
 *
 */
class PatientCheckDAO extends DBBaseDAO {

    public function __construct() {
        $this->isInnerNet = true;
        parent::__construct();
        $this->tableName = 'patientcheck';
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {    	
        DTExpression::eq('pid', $where);
        DTExpression::page($where);      
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    
    /*
     * 根据pid删除所有相关报告单
     * */
    public function delebypid($arr){    	
	   $result=R::findall($this->tableName,'pid=:pid',$arr);
	   //$beans=R::convertToBeans($this->tableName,$result);
	   if(!empty($result)){
		   foreach($result as $key=>$val){
		   	R::trash($val);
		   }
	   }   
	   R::close();
    }
    
    /*
     * 根据id删除某个报告单
     * */
    public function delebyid($ids){
    	$beans=R::batch($this->tableName, $ids);
    	R::trashAll($beans);
    	R::commit();
    	return true;
    	
    }
    

   
}
