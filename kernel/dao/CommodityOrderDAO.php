<?php

/**
 * 商城购物订单记录DAO
 *
 * @author Administrator
 *
 */
class CommodityOrderDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_COMMODITYORDER;
    }
	
	//查询用户订单记录
	public function query($where) {
        DTExpression::eq('id', $where, $this->tableName);
        DTExpression::eq('uid', $where, $this->tableName);
        DTOrder::$sql = isset($where['orders']) ? $where['orders'] : '';
        DTExpression::page($where);
		$sql =  'SELECT * FROM '.$this->tableName.' WHERE '.DTExpression::$sql . DTOrder::$sql . DTExpression::$limit;
        return $this->getJoin($sql);		
	 }
	//通过订单号获取订单详情
    public function getOrderDetailByOrder($arr){
    	$result=R::findOne($this->tableName,'orders=:orders',$arr);
    	$orderarray = array();
    	if (isset($result->id) && $result->id) {
    	    $orderarray = $result->export();
    	}
    	return $orderarray;
	}
     /**
     * 保存订单记录
     *
     * @see DBBaseDAO::save()
     */
    public function orderSave($order) {
/*         $orderBean = R::dispense($this->tableName);
        $order->generateRedBean($orderBean);
        R::store($orderBean);		
        return true; */
        $result = R::exec("insert into ".$this->tableName."(orders,uid,qrcode) values('".$order[0]."','".$order[1]."','".$order[2]."')");
        if($result){
            return true;
        }else{
            return false;
        }
    }   
	
}

