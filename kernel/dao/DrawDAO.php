<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class DrawDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DRAW;
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
        DTExpression::like('name', $where,'d');        
        DTExpression::eq('statu', $where,'d');
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        }
        $sql=ORMMap::$sqlMap['drawactivity']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
        
        return $this->getjoin($sql);
       
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
        //DTExpression::page($where);
//         DTOrder::desc('plushtime');
        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
       
        
        //$sql=ORMMap::$sqlMap['drawactivitynum']. ' where '.DTEXPRESSION::$sql ;
        //DTExpression::eq('pattern', $where);
        $sql=ORMMap::$sqlMap['drawcount']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;       
        return $this->getjoin($sql);
    }
    
    /*
     * 设置活动为关闭
     * 
     * */
    
    public function setstute($arr){
    	R::exec('update '.$this->tableName.' set statu=:statu where id=:id',$arr);
    	R::close();
    	
    }
    
    public function getname(){
		//     	$result=R::findAll($this->tableName);
		//     	R::close();
		//     	return $result;
				
		$sql=ORMMap::$sqlMap['drawname'];

		return $this->getjoin($sql);
    }
    
    /*
     * 获取抽奖活动
     * */
    public function getdrawcount($where=array()){
    	DTExpression::lt('start_time', $where, 'datetime');
    	DTExpression::ge('end_time', $where, 'datetime');
    	DTExpression::eq('statu', $where,'d');
        DTExpression::page($where); 
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc('id');
        }		
    	$sql=ORMMap::$sqlMap['drawshow']. ' where '.DTEXPRESSION::$sql .DTOrder::$sql . DTExpression::$limit;
    	return $this->getjoin($sql);
    }
    public function getNameById($arr){
     	$result=R::findOne($this->tableName,'id=:id',$arr);
     	R::close();
        $array = new Draw();
        $array->generateFromRedBean($result);
	    unset($array->descript,$array->start_time,$array->end_time);
    	return $array;
    }
}

