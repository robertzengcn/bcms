<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class CommodityScorereduceDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_COMMODITYSCOREREDUCE;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
    	//DTExpression::like('name', $where, $this->tableName);
        //DTEXPRESSION::like('username', $where);
        DTEXPRESSION::eq('type', $where);        
        DTExpression::ge('date', $where, 'start_time');
        DTExpression::le('date', $where, 'end_time');
        DTExpression::page($where);

        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        }
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
        DTEXPRESSION::like('username', $where,'m');
        DTEXPRESSION::eq('type', $where,'ms');
        DTExpression::ge('date', $where, 'start_time','ms');
        DTExpression::le('date', $where, 'end_time','ms');        
        $sql=ORMMap::$sqlMap['memberscorelogcount']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
        return $this->getjoin($sql);
       
    }
    
  	
}

