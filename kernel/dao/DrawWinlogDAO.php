<?php
/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class DrawWinlogDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DRAWWINLOG;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
    	
    	
    	
        DTExpression::ge('date', $where,'start_time','w');
        DTExpression::lt('date', $where,'end_time','w');
// //         DTExpression::eq('isbidding', $where);
        DTExpression::eq('member_id', $where,'w');
        DTExpression::like('name', $where,'p');
        DTExpression::eq('statue', $where,'w');               
        DTExpression::eq('id', $where,'d');
        DTExpression::page($where);
       

// //         DTExpression::eq('exchange', $where);
//         DTExpression::page($where);
// //         DTOrder::desc('plushtime');
//         DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
        
        $sql=ORMMap::$sqlMap['winlogquery']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
      
        
//         print_r($sql);
//         exit();
        
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
// //         DTExpression::eq('isbidding', $where);
         DTExpression::like('name', $where,'d');
        
         DTExpression::eq('statue', $where,'d');
// //         DTExpression::eq('exchange', $where);
//         DTExpression::page($where);
// //         DTOrder::desc('plushtime');
//         DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
       
       DTExpression::eq('member_id', $where);      
        $sql=ORMMap::$sqlMap['winlognum']. ' where '.DTExpression::$sql ;
        //DTExpression::eq('pattern', $where);
        

       return $this->getjoin($sql);
    }
    
    /*
     * 设置活动为关闭
     * 
     * */
    
    public function setstute($arr){
    	R::exec('update '.$this->tableName.' set statue =0 where id=:id',$arr);
    	R::close();
    	
    }
    
    /*
     * 获取当天某个商品被抽中的数量
    * */
    public function gettodaycount($arr){
    	//R::exec('LOCK TABLES '.$this->tableName.' WRITE');
    	$result=R::count($this->tableName,'prize_id=:prize_id and date>:start and date<:end',$arr);
    	
    	//R::exec('UNLOCK TABLES');
    	R::close();
    	return $result;
    }
    
    /*
     * 去某个奖品已被抽中数
     * */
    public function getprizeamount($arr){
    	//R::exec('LOCK TABLES '.$this->tableName.' WRITE');
    	$result=R::count($this->tableName,'prize_id=:prize_id',$arr);
    	 
    	//R::exec('UNLOCK TABLES');
    	R::close();
    	return $result;
    }
    
    /*
     * 取某个会员某次活动的获奖信息
     * */
    public function getmemdraw($arr){
    	$result=R::findOne($this->tableName,'member_id=:member_id and id=:id',$arr);
    	R::close();
    	$winarray = array();
    	foreach ($result as $key => $value) {
    		$winarray[$key]=$value;
    	}
    	return $winarray;
    }
    
    /*
     * 
     * 根据flag取中奖鑫鑫
     * */
    public function getdetailbyflag($arr){
    	DTExpression::eq('flag', $arr,'w');
//     	$result=R::findOne($this->tableName,'flag=:flag',$arr);
//     	R::close();
//     	$winarray = array();
//     	foreach ($result as $key => $value){
//     		$winarray[$key]=$value;
//     	}
//     	return $winarray;

    	$sql=ORMMap::$sqlMap['winlogquery']. ' where '.DTEXPRESSION::$sql;
    	return $this->getjoin($sql);
    }
    public function getList($where) {        
        DTExpression::eq('statue', $where);
        DTExpression::eq('member_id', $where);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc('id');
        } 
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    public function getInfoById($arr){	
    	$result=R::findOne($this->tableName,'id=:id',$arr);
     	R::close();
        $array = new DrawWinlog();
        $array->generateFromRedBean($result);
    	return $array;
    }
    public function getInfoByFlag($arr){	
    	$result=R::findOne($this->tableName,'flag=:flag',$arr);
     	R::close();
        $array = new DrawWinlog();
        $array->generateFromRedBean($result);
    	return $array;
    }
    /*
     * 设置订单为已支付
     * */
    public function setStatus($arr){	
    	$result=R::findAll($this->tableName,'flag=:flag',$arr);
		foreach($result as $val){
    		$val->statue=1;
    		$val->date=time();
			R::store($val);			
		}
    }
}

