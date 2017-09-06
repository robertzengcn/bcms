<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class CommodityCategoriesDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_COMMODITYCATEGORIES;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) { 
    
        DTExpression::eq('types', $where);        
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
        
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::ge('start_time', $where, 'start_time');
        DTExpression::le('end_time', $where, 'end_time');
        DTExpression::eq('isbidding', $where);
        DTExpression::like('subject', $where);
        DTExpression::eq('shelf', $where);
        //DTExpression::eq('pattern', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    /*
     * 获取开启的目录
     * */
    public function getopencat() {
    	$result = R::findAll($this->tableName,'categories_status=0');
    	$array = array();
    	$class = ORMMap::$classes[$this->tableName];
    	foreach ($result as $k => $bean) {
    		$entity = new $class();
    		$entity->generateFromRedBean($bean);
    		$array[] = $entity;
    	}
    
    	return $array;
    }
     public function getName($arr){	
		$result = R::findAll($this->tableName,'id=:id',$arr);	 
		$array = array();
    	$class = ORMMap::$classes[$this->tableName];
    	foreach ($result as $k => $bean) {
    		$entity = new $class();
    		$entity->generateFromRedBean($bean);
    		$array = $entity;
    	}
    	return $array;
		
	}   
    
}

