<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class DrawlogDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DRAWLOG;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
    	
    	
    	
        DTExpression::ge('start_time', $where, 'start_time');
        DTExpression::lt('end_time', $where, 'end_time');
//         DTExpression::eq('isbidding', $where);
        DTExpression::like('name', $where,'d');
        
        DTExpression::eq('statu', $where,'d');
//         DTExpression::eq('exchange', $where);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc('plushtime');
        }
        
        $sql=ORMMap::$sqlMap['drawactivity']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
        
 
        
        return $this->getjoin($sql);
        
        //return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
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
        DTExpression::lt('end_time', $where, 'end_time');
//         DTExpression::eq('isbidding', $where);
        DTExpression::like('name', $where,'d');
        
        DTExpression::eq('statu', $where,'d');
//         DTExpression::eq('exchange', $where);
        DTExpression::page($where);
//         DTOrder::desc('plushtime');
        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
       
        
        $sql=ORMMap::$sqlMap['drawactivitynum']. ' where '.DTEXPRESSION::$sql ;
        //DTExpression::eq('pattern', $where);
        

       return $this->getjoin($sql);
    }
    
    /*
     * 取某个会员某个时间段内参与抽奖的次数
     * */
    public function getdrawcount($arr){
    	$result=R::count($this->tableName,'draw_id=:draw_id and member_id=:member_id and date>=:start and date<=:end',$arr);
    	R::close();
    	return $result;
    	
    	
    }
    

}

