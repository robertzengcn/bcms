<?php

/**
 * 商城购物记录DAO
 *
 * @author Administrator
 *
 */
class CommodityLogDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_COMMODITYLOG;
    }
	
	//查询用户购物记录
	public function query($where) {
        DTExpression::eq('uid', $where);
        DTExpression::eq('orders', $where);
        DTExpression::eq('qrcode', $where);
        DTExpression::eq('status', $where);
        DTExpression::ge('buytime', $where, 'start_time');
        DTExpression::le('buytime', $where, 'end_time');
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc('id');
        }
		return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);		
	 }
    
    /**
     * 设置订单为已支付
     * */
    public function setorderpay($arr){	
    	$result=R::findAll($this->tableName,'orders=:orders and qrcode=:qrcode',$arr);
		foreach($result as $val){
    		$val->status=1;
    		$val->taketime=time();
			R::store($val);			
		}
    }
    /**
     * 判断用户是否已经购买过此商品
     * */
    public function isToBuy($arr){
		$result=R::findAll($this->tableName,'uid=:uid and gid=:gid',$arr);
		$number = 0;
		foreach($result as $val){
			$number += $val->num;
		}
		return $number;
	}
    /**
     * 判断用户每月限购
     * */
    public function buyNumByTime($arr){
		$result=R::findAll($this->tableName,'uid=:uid and gid=:gid and buytime>:stime and buytime<:etime',$arr);
		$number = 0;
		foreach($result as $val){
			$number += $val->num;
		}
		return $number;
	}
    public function totalRows() {
		return R::count($this->tableName);
    }	
    /**
     * 根据订单号和qrcode取数据
     * */
    public function getitembyarr($arr){
    	$result=R::findOne($this->tableName,'orders=:orders and qrcode=:qrcode',$arr);
    	$orderarray = array();
    	if($result){
    		foreach ($result as $key => $value) {
    			$orderarray[$key]=$value;
    		}
    	}
    	return $orderarray;;
    }
}

