<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class MemberDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_MEMBER;
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
        DTEXPRESSION::like('username', $where,'m');
        DTExpression::ge('date', $where, 'start_time','ml');
        DTExpression::le('date', $where, 'end_time','ml');
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        }
      
        $sql=ORMMap::$sqlMap['memberdetail']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
// print_r($sql);
// print_r($where);


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
        DTEXPRESSION::like('username', $where,'m');
        DTExpression::ge('date', $where, 'start_time','ml');
        DTExpression::le('date', $where, 'end_time','ml');
        $sql=ORMMap::$sqlMap['memberdetailcount']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
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
    public function getbyid($arr){
    	$result=R::find($this->tableName,'id=:id',$arr);
    	foreach ($result as $key => $value) {
    		$member = new Member();
    		$member->generateFromRedBean($value);
    	}
    	R::close();
    	return $member;
    	
    }
    
    /*
     * 检查数据是否存在
     * */
    public function getdate(){
    	$member = R::findAll($this->tableName);
    	
    	$memberArray = array();
    	foreach ($member as $key => $value) {
    		$member = new Member();
    		$member->generateFromRedBean($value);
    		$memberArray[] = $member;
    	}
    	R::close();
    	
    	return $memberArray;
    }
    
    /*
     *清空所有数据 
     * */
    
    public function delall(){
    	$member = R::findAll($this->tableName);
    	$result=R::trashAll($member);
    	R::close();
    	return $result;
    }
    
    /*
     * 通过用户名获取用户数据
     * */
    public function getmemberbyname($arr){
    	
    	$member = R::findOne($this->tableName,'username=:username',$arr);
    	R::close();
    	
    	
     	$memberArray = array();
     	if($member){
    	foreach ($member as $key => $value) {
    		$memberArray[$key]=$value;
    	}
     	}
    	R::close();
    	return $memberArray;
    }
 
    /*
     * 通过手机号获取用户数据
     * */
    public function getmemberbymobile($arr){
    	
    	$member = R::findOne($this->tableName,'telephone=:telephone',$arr);
    	R::close();  	
     	$memberArray = array();
     	if($member){
    	foreach ($member as $key => $value) {
    		$memberArray[$key]=$value;
    	}
     	}
    	R::close();
    	return $memberArray;
    } 
    public function getscoreamount($arr){
    	$member = R::findOne($this->tableName,'id=:id',$arr);
    	R::close();
    	$memberArray = array();
    	foreach ($member as $key => $value) {
    		$memberArray[$key]=$value;
    	}
    	
    	return $memberArray;
    	
    }
    /*
     * 减去某个会员的积分
     * @param $arr['id'], $arr['score'] 
     * 
     * */
    public function reducescore($arr){
    	$memarr=array('id'=>$arr['id']);
    	//R::exec('LOCK TABLES '.$this->tableName.' WRITE');   //msyql 5.6 报1044 Access denied for user
    	$member = R::findOne($this->tableName,'id=:id',$memarr);    	   	
        $member->ownscore=$member->ownscore-$arr['score'];
        R::store($member);
        //R::exec('UNLOCK TABLES');
        R::close();
    	
    }
    
    /*
     * 根据用户名取数据
     * @param array('username'=>username);
     * */
    public function getmembyname($arr){
    	$result = R::findOne($this->tableName,'username=:username',$arr);
		$member = new Member();
		$member->generateFromRedBean($result);
        R::close();
		return $member;
    }
    
    /*
     * 取所有用户
     * */
    
    public function getallmember(){
    	$member=R::findAll($this->tableName,'telephone IS NOT NULL');
    	
    	R::close();
    	$memberArray = array();
    	foreach ($member as $key => $value) {
    		
    		$member = new Member();
    		$member->generateFromRedBean($value);
    		$memberArray[] = $member;
    	}
    	 
    	return $memberArray;
    }
    
     /*
     * 手机号/用户名验证
     * */
    
    public function checkInfo($arr){
		$field = array_keys($arr);	
    	$info = R::findOne($this->tableName,$field[0].'=:'.$field[0],$arr);
    	R::close();
		if($info){
		  return true;
		}else{
		  return false;			
		}
	} 

    
}

