<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class CommodityAddScoreLogDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_COMMODITYADDSCORELOG;
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
       
//         DTExpression::eq('isbidding', $where);
//         DTExpression::like('subject', $where);
        //DTExpression::eq('shelf', $where);
        //DTExpression::eq('pattern', $where);

        //return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    /*
     * 根据type取值
     * @param $arr
     * */
    public function getbytype($arr){
    	$result=R::find($this->tableName,'type=:type',$arr);
    	R::close();
    	return $result;
    	
    }
    
    
    /**
     *清空所有数据 
     * */
    
    public function delall(){
    	$member = R::findAll($this->tableName);
    	$result=R::trashAll($member);
    	R::close();
    	return $result;
    }
    
    /*
     * 获取统计数据
     * */
    public function gettotal(){
    	$result=R::count($this->tableName);
    	return $result;
    }
    
    /*
     * 获取所有对象
     * */
    public function getall(){
    	$member=R::find();
    	R::close();
    	return $member;
    }
    
    /*
     *取表里已有的type 
     * */
    public function getdistincttype(){
    	//return R::$f->select('*');
    	
    	$sql=ORMMap::$sqlMap['memberdistinctlog'];
    	$result=R::getAll($sql);
    	R::close();
    	return $result;
    	//return $this->getjoin($sql);
    
    	
    }
    
    
    public function gettypenum($arr){
    	$result=R::count($this->tableName,'type=:type',$arr);
    	R::close();
    	return $result;
    }
    /*
     * 
     * 计算今日用户登陆次数
     * */
    
    public function counttodaylogip($arr){
    	
    	$result=R::count($this->tableName,'uid=:uid and date>:start and date<=:end and type=:type and ip=:ip',$arr);
    	
    	R::close();
    	return $result;
    }
    /*
     * 
     * 计算今日用户登陆次数
     * */
    
    public function counttodaylog($arr){
    	
    	$result=R::count($this->tableName,'uid=:uid and date>:start and date<=:end and type=:type',$arr);
    	
    	R::close();
    	return $result;
    }
    /*
     * 计算某个会员某个时间段获取的积分总数
     * @param array
     * */
    public function summember($arr){
    	DTExpression::eq('uid', $arr);
    	DTExpression::eq('type', $arr);
    	DTExpression::ge('date', $arr, 'start_time');
    	DTExpression::le('date', $arr, 'end_time');
    	$sql=ORMMap::$sqlMap['summemberscore']. ' where '.DTEXPRESSION::$sql;
    	
    	return $this->getjoin($sql);
    }
    /*
     * 计算某个会员的登陆次数
     * @param array(array('uid'=>uid))
     * */
    public function countmember($arr){
    	$result=R::count($this->tableName,'uid=:uid and type=:type',$arr);
    	 
    	R::close();
    	return $result;
    }
    /*
     * 计算上次是否连续登陆过
     * @return date
     * */
    public function iscontinuity($where){
        $result = R::find($this->tableName, 'uid=:uid and type=:type order by id desc limit 0,1',$where);
        foreach ($result as $key => $value) {
            if ($value->id != 0) {
				$date = $value->date;
            }
        }
        return $date;
    }	
}

