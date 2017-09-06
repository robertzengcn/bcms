<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class CommodityCartDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_COMMODITYCART;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
    	

        DTExpression::eq('member_id', $where,'c');

        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
        
        $sql=ORMMap::$sqlMap['cartinfo']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
        
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
        DTExpression::le('end_time', $where, 'end_time');
        DTExpression::eq('isbidding', $where);
        DTExpression::like('subject', $where);
        DTExpression::eq('shelf', $where);
        //DTExpression::eq('pattern', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    public function getcatbyid($arr){
    	$result=R::findAll($this->tableName,'categories_id=:categories_id',$arr);
    	$array = array();
    	$class = ORMMap::$classes[$this->tableName];
    	foreach ($result as $k => $bean) {
    		$entity = new $class();
    		$entity->generateFromRedBean($bean);
    		$array[] = $entity;
    	}
    	
    	return $array;
    	
    }
    /**
     * 获取某个会员下某个商品是否在购物车中
     * */
    public function getmembercart($arr){
    	$result=R::findOne($this->tableName,'member_id=:member_id and commodity_id=:commodity_id',$arr);
    	R::close();
    	
    	$cartarray = array();
    	if($result){
    	foreach ($result as $key => $value) {
    		$cartarray[$key]=$value;
    	}
    	}
    	return $result;
    }
    
    /**
     * 获取某个会员下某个商品是否在购物车中
    * */
    public function getmembercartid($arr){
    	$result=R::findOne($this->tableName,'member_id=:member_id and id=:id',$arr);
    	
//     	$array = array();
//     	$class = ORMMap::$classes[$this->tableName];
//     	foreach ($result as $k => $bean) {
//     		$entity = new $class();
//     		$entity->generateFromRedBean($bean);
//     		$array[] = $entity;
//     	}

         if($result!=null){
    	R::trash($result);
         }
    	R::close();
    	
    	
    	//return $result;
    }
    /*
     * 获取用户购物车的商品并且更新数量
     * 
     * */
    public function updateitemquantity($arr){
    	$datearr=array('member_id'=>$arr['member_id'],'id'=>$arr['id']);
    	
    	$cart=R::findOne($this->tableName,'member_id=:member_id and id=:id',$datearr);
    	    	    	
    	if($cart!=null){
    		$commodity=new Commodity();
    		$commodityser=new CommodityService();
    		$commodity->id=$cart->commodity_id;
    		
    		$commoditydetail=$commodityser->get($commodity);
    		
    		
    		$cart->quantity=$arr['quantity'];
    		if($commoditydetail->data->exchange==2){
    		$cart->final_price=$arr['quantity']*$commoditydetail->data->price;
    		$cart->final_score=$arr['quantity']*$commoditydetail->data->score;
    		}else{
    			$cart->final_score=$arr['quantity']*$commoditydetail->data->score;
    		}
    		
    		R::store($cart);
    	}
    	R::close();
    }
    public function getmebercart($arr){
  
    	$cart=R::findOne($this->tableName,'member_id=:member_id and id=:id',$arr);
    	$cartarray = array();
    	foreach ($cart as $key => $value) {
    		$cartarray[$key]=$value;
    	}
    	
    	return $cartarray;
    }
}

