<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class CommodityDescriptDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_COMMODITYDESCRIPT;
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
        DTExpression::le('end_time', $where, 'end_time');
        DTExpression::eq('isbidding', $where);
        DTExpression::like('subject', $where);
        
        DTExpression::eq('status', $where);
        DTExpression::eq('exchange', $where);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc('plushtime');
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
        DTExpression::ge('start_time', $where, 'start_time');
        DTExpression::le('end_time', $where, 'end_time');
        DTExpression::eq('isbidding', $where);
        DTExpression::like('subject', $where);
        DTExpression::eq('shelf', $where);
        //DTExpression::eq('pattern', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    public function getitem($array){
    	return R::findOne($this->tableName,'product_id=:product_id',$array);
    }
    
    /*
     * 根据产品id更新产品描述
     * */
    public function updatepro($arr,$desc){
    	$commoditydesc=R::findOne($this->tableName,'product_id=:product_id',$arr);
    	
    	if($commoditydesc){
    	$commoditydesc->product_descript=$desc;
    	R::store($commoditydesc);
    	R::close();
    	}else{
    		$entity=new CommodityDescript();
    		$entity->product_id=$arr['product_id'];
    		$entity->product_descript=$desc;
    	$bean=R::dispense($this->tableName);
    	$entity->generateRedBean($bean);
    	$entity->id= R::store($bean);
    	
    	
    	}    	
    }
}

