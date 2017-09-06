<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class OrderDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_ORDER;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
    	
    	

        DTExpression::eq('member_id', $where);
        DTExpression::eq('order_stute', $where);
        DTExpression::page($where);

        DTOrder::$sql = isset($where['order']) ? ' order by '.$where['order'] : '';
        
       // $sql=ORMMap::$sqlMap['orderdetail']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
        
        //return $this->getjoin($sql);

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
        DTExpression::le('end_time', $where, 'end_time');
        DTExpression::eq('isbidding', $where);
        DTExpression::like('subject', $where);
        DTExpression::eq('shelf', $where);
        //DTExpression::eq('pattern', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    /*
     * 获取某个会员的订单
     * @param $arr
     * */
    public function getmemberorder($arr){
    	
    	//DTExpression::eq('member_id', $arr,'o');
    	    	
    	//$sql=ORMMap::$sqlMap['orderdetail']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
    	
    	//return $this->getjoin($sql);
    	$result=R::findOne($this->tableName,'id=:id and member_id=:member_id',$arr);
    	$array = array();
        	$orderarray = array();
    	foreach ($result as $key => $value) {
    		$orderarray[$key]=$value;
    	}

    	return $orderarray;
    	
    }
    /*
     * 根据订单号以及订单qrcode查询订单详情
    * param $arr eg: array('order_num'=>'4440-4946-1521','qrcode'=>'df5b3db9cb21c30cf8cc24a6015257c3');
    * */
    
    public function gdetaibyqr($arr){
    	$result=R::findOne($this->tableName,'order_num=:order_num',$arr);
    	$array = array();
    	$orderarray = array();
    	foreach ($result as $key => $value) {
    		$orderarray[$key]=$value;
    	}
    	
    	return $orderarray;
    	
    }
    /*
     * 设置订单为已支付
     * */
    public function setorderpay($arr){
    	$result=R::findOne($this->tableName,'order_num=:order_num and qrcode=:qrcode',$arr);
    	if($result){
    		$result->order_stute=1;
    	}
    	R::store($result);
    }
    
    
}

