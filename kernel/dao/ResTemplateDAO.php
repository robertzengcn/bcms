<?php

class ResTemplateDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_RESERTEMPLATE;
    }

    /**
     * 查询指定的数据.
     *
     * @param unknown_type $where
     * @return Ambigous <array(Entity), multitype:, unknown>
     */
    public function query($where) {
    	$sql='select id,title,plushtime,description from restemplate where 1=1 ';    	
    	if(isset($where['title'])&&$where['title']){
    		$sql.=' and title like \'%'.$where['title'].'%\' ';
    	}
    	if(isset($where['order'])&&$where['order']){
    		$sql.=$where['order'];
    	}    	
    	$data = R::getAll($sql);    	
    	$bean = R::convertToBeans('bean', $data);
        $reservations = array();
        foreach ($bean as $v) {
           $entity = new ResTemplate();
           $entity->generateFromRedBean($v);
           $reservations[] = $entity;
        }        
        return $reservations;        
    }

    /**
     * 获取表中总条数 .
     * ..
     *
     * @param array $where
     * @return Ambigous <number, number>
     */
    public function totalRows($where) {
        DTExpression::eq('department_id', $where);
        if (isset($where['name']) && empty($where['department_id'])) {
            if (strlen($where['name'])) {
                $sql = "select count(*) from reservation as r left join doctor as d on doctor_id=d.id where name like '%{$where['name']}%'";
                $count = R::getAll($sql);
                return $count[0]['count(*)'];
            }
        } else
            if (isset($where['department_id']) && isset($where['name'])) {
                if (! empty($where['department_id']) && ! empty($where['name'])) {
                    $sql = "select count(*) from reservation as r left join doctor as d on doctor_id=d.id where name like '%{$where['name']}%' and r.department_id={$where['department_id']}";
                    $count = R::getAll($sql);
                    return $count[0]['count(*)'];
                }
            }
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 添加到详细表 .
     * ..
     *
     * @param object $detail
     */
    public function addToDetail($detail) {
        $bean = R::dispense('reservationdetail');
        $detail->generateRedBean($bean);
        R::store($bean);
    }
    
    /**
     * 修改医生信息
     * */
    public function modTemplate($entity) {
    	return $this->dealAddOperator($entity, 'restemplate');
    }
    
    /*
     * 检查模板是否已经存在
     *  @param array $array
     * */
    public function check_exist($array){    	
    	$beans = R::findOne($this->tableName, " title=:title and type=:type", $array);
    	R::close();
		if($beans!=null){ 	
			if($beans->id){			
				return true;
			}else{			
				return false;
			}
		}else{
			return false;
		}
    }
    
    /*
     * 根据模板id获取模板信息
     * @param $arr
     * */
    public function getdetailbyid($arr){    	
    	$beans = R::findOne($this->tableName, "id=:id", $arr);
    	R::close();
    	return $beans;
    }

    /**
     * 获取详细页的列表...
     *
     * @param array $where
     * @return array
     */
    public function getDetail($where) {
        DTExpression::ge('times', $where, 'start');
        DTExpression::le('times', $where, 'end');
        DTExpression::eq('date', $where);
        DTExpression::eq('department_id', $where);
        DTExpression::eq('doctor_id', $where);
        DTExpression::page($where);
        $res = R::find('reservationdetail', DTExpression::$sql . 'order by times asc' . DTExpression::$limit, DTExpression::$params);
        $arr = array();
        foreach ($res as $k => $bean) {
            $entity = new ReservationDetail();
            $entity->generateFromRedBean($bean);
            $arr[] = $entity;
        }
        R::close();
        return $arr;
    }

    /**
     * 获取详细页总数...
     *
     * @param array $where
     * @return number
     */
    public function getCount($where) {
        DTExpression::eq('date', $where);
        DTExpression::eq('department_id', $where);
        DTExpression::eq('doctor_id', $where);
        $count = R::count('reservationdetail', DTExpression::$sql, DTExpression::$params);
        R::close();
        return $count;
    }

    /**
     * 根据id数组查询详细列表...
     *
     * @param array $ids
     * @return Ambigous <multitype:, RedBean_OODBBean, mixed>
     */
    public function detailBatch($ids = array()) {
        $beans = R::batch('resertemplate', $ids);
        R::close();
        return $beans;
    }
    
    /*
     * 更新模版早上时间
     * */
    public function update_montime($array,$time){
    	
    $bean = R::findAll($this->tableName, "id=:id", $array);
     foreach ($bean as $key => $value){
     	$value->moning_time=$time;
     	R::store($value);     	
        }
        R::close();
    }
    
    /*
     * 更新模版下午时间
    * */
    public function update_afttime($array,$time){
    	
    	$bean = R::findAll($this->tableName, "id=:id", $array);
    	foreach ($bean as $key => $value){
    		$value->afternoon_time=$time;
    		R::store($value);
    	}
    	R::close();
    }
    
    /*
     * 更新模版晚上时间
    * */
    public function update_nigtime($array,$time){
    	
    	$bean = R::findAll($this->tableName, "id=:id", $array);
    	foreach ($bean as $key => $value){
    		$value->night_time=$time;
    		R::store($value);
    	}
    	R::close();
    }
    

    /**
     * 批量删除...
     *
     * @param unknown_type $beans
     * @return Result
     */
    public function deleteDetail($beans) {
        R::trashAll($beans);
        R::close();

        return new Result(true, 0, '', NULL);
    }

    /**
     * 根据科室，医生，日期删除详细表中的记录 .
     * ..
     */
    public function deleteAll($arr) {
        $beans = R::findAll('reservationdetail', "department_id=:department_id and doctor_id=:doctor_id and date=:date", $arr);
        // $beans = R::findAll('reservationdetail',"department_id=:department_id and doctor_id=:doctor_id and date=':date'",$arr);
        R::trashAll($beans);
        R::close();
    }

    /**
     * 获得已约总数...
     */
    public function getApproximately($array) {
        $sql = "select count(*) as num from reservationdetail where statu='已约' and department_id=:department_id and doctor_id=:doctor_id and date=:date and times>=:start and times<=:end";
        $countArr = R::getAll($sql, $array);
        return $countArr[0]['num'];
    }
    
    /**
     * 获取某个医生的总号数...
     */
    public function getAllVerification($array){
    	$sql = "select count(*) as num from reservationdetail where department_id=:department_id and doctor_id=:doctor_id and date=:date and times>=:start and times<=:end";
    	$countArr = R::getAll($sql, $array);
    	return $countArr[0]['num'];
    }

    /**
     * 获取详细表中所有数据
     *
     * @return Ambigous <multitype:, ReservationDetail>
     */
    public function getDetailAll() {
        $beans = R::findAll('reservationdetail');
        $detailAll = array();
        foreach ($beans as $bean) {
            $ReservationDetail = new ReservationDetail();
            $ReservationDetail->generateFromRedBean($bean);
            $detailAll[] = $ReservationDetail;
        }
        return $detailAll;
    }

    /**
     * 将预约者添加到预约表中去
     *
     * @param unknown_type $entity
     * @return Ambiguous
     */
    public function reserUser($entity) {
        $bean = R::dispense('reseruser');
        $entity->generateRedBean($bean);
        $insertId = R::store($bean);
        $entity->generateFromRedBean($bean);
        R::close();
        return $entity;
    }
	
    public function queryDetail(){	
        DTExpression::eq('department_id', $_REQUEST['department_id']);
        DTExpression::eq('doctor_id', $_REQUEST['doctor_id']);
        DTExpression::eq('date', strtotime($_REQUEST['date']) );
        DTExpression::eq('times', strtotime($_REQUEST['date'] . ' ' . $_REQUEST['time']. ':00') );
        
        $res = R::getAll('select * from reservationdetail where ' . DTExpression::$sql, DTExpression::$params);
         
        $bean = R::convertToBeans('bean', $res);
        $reservations = array();
        foreach ($bean as $v) {
            $entity = new ReservationDetail();
            $entity->generateFromRedBean($v);
            $reservations[] = $entity;
        }
        return $reservations[0];
        

    }
    
    
	public function reservationDetail($entity){
	    $bean = R::load('reservationdetail', $entity->id);  
	    $entity->generateRedBean ( $bean );	        
	    $insertId = R::store ( $bean );
	    $entity->generateFromRedBean ( $bean );
	    R::close ();
	    return $entity;
	}
	
	public function getPaibanCount($where){
		DTOrder::asc('date,department_id');
		$cond=" where 1=1";
		if(!empty($where['dept_name'])){
			$cond.=" and result.department like '%".$where['dept_name']."%'";
		}
		if(!empty($where['doctor_name'])){
			$cond.=" and result.doctor like '%".$where['doctor_name']."%'";
		}
		if(!empty($where['date'])){
			$now=strtotime($where['date']);
			$end=strtotime($where['date'].' 23:59:59');
			$cond.=' and date <='.$end.' and date>='.$now;
		}else{
			$now=strtotime(date('Y-m-d',time()));
			$cond.=' and date>='.$now;
		}
		$sqlhead="select result.* from (select r.*,dep.name as department,doc.name as doctor,doc.specialty from {$this->tableName} r left join department dep on dep.id=r.department_id left join doctor doc on doc.id=r.doctor_id) as result";
		$sql=$sqlhead . $cond . DTOrder::$sql ;
		$array = $this->getJoin($sql);
		return count($array);
	}
	
	public function getPaiban($where){
		DTOrder::asc('date,department_id');
		$cond=" where 1=1";
		if(!empty($where['dept_name'])){
			$cond.=" and result.department like '%".$where['dept_name']."%'";
		}
		if(!empty($where['doctor_name'])){
			$cond.=" and result.doctor like '%".$where['doctor_name']."%'";
		}
		if(!empty($where['date'])){
			$now=strtotime($where['date']);
			$end=strtotime($where['date'].' 23:59:59');
			$cond.=' and date <='.$end.' and date>='.$now;
		}else{
			$now=strtotime(date('Y-m-d',time()));
			$cond.=' and date>='.$now;
		}
		$page=empty($where['page']) ? 1 : (int)$where['page'];
		$size=(int)$where['size'];
		$start=($page-1)*$size;
		DTExpression::$limit='limit '.$start.','.$size;
		$sqlhead="select result.* from (select r.*,dep.name as department,dep.url as depurl,doc.name as doctor,doc.specialty from {$this->tableName} r left join department dep on dep.id=r.department_id left join doctor doc on doc.id=r.doctor_id) as result";
		$sql=$sqlhead . $cond . DTOrder::$sql . DTExpression::$limit;
		$array = $this->getJoin($sql);
		return $array;
	}
	
	/**
	 * 处理添加操作
	 * */
	protected function dealAddOperator($entity, $tablename, $isReturnId = false) {
		if ($entity->id) {
			$entity->validate();
			$bean = R::load($tablename, $entity->id);
			$entity->generateRedBean ( $bean );
		} else {
			$entity->validate();
			$bean = R::dispense($tablename);
			$entity->generateRedBean($bean);
		}
		$insertId = R::store ( $bean );
		$entity->generateFromRedBean ( $bean );
		 
		if ($isReturnId) {
			return $insertId;
		}
		return $entity;
	}
	public function getId($department_name){
			$id = R::getRow("select id as tem_id,type from restemplate where title=:department_name", array(
                ':department_name' => $department_name
            ));	
			return $id;
	}	
}