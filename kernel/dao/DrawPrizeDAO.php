<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class DrawPrizeDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DRAWPRIZE;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        
        DTExpression::eq('drawid', $where);

        DTExpression::page($where);

        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';

        
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql);
        
       
    
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::eq('drawid', $where);

        DTExpression::page($where);

        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
        //DTExpression::eq('pattern', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    /*
     * 取某个活动下的奖品,扣除中奖概率为0的选项
     * */
    public function drawprize($arr){
    	
    	//R::exec('LOCK TABLES '.$this->tableName.' WRITE');
    	$prizes=R::findAll($this->tableName,'drawid=:drawid and prize_percent !=0 and prize_count>0',$arr);
    	//R::exec('UNLOCK TABLES');
    	R::close();
       $prizeArray = array();
        foreach ($prizes as $key => $value) {
            $prize = new DrawPrize();
            $prize->generateFromRedBean($value);
            $prizeArray[] = $prize;
        }	

    	return $prizeArray;
    	
    }
    
    /*
     * 取奖品用户显示，不扣除中奖概率为0的情况
     * */
    public function showprize($arr){
    	$prizes=R::findAll($this->tableName,'drawid=:drawid and prize_count>0',$arr);
    	$prizeArray = array();
    	foreach ($prizes as $key => $value) {
    		$prize = new DrawPrize();
    		$prize->generateFromRedBean($value);
    		$prizeArray[] = $prize;
    	}
    	 
    	
    	return $prizeArray;
    	
    }
}

