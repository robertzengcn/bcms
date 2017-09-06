<?php

class ResVationDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_RESERVATION;
        $this->doctormanager=TABLENAME_DOCTORMANAGER;
        $this->departmentmanager=TABLENAME_DEPARTMENTMANAGER;
        $this->resvationdata = TABLENAME_RESVATIONDATA;
    }
    
    
    /**
     * 获取所有满足条件的医生排班信息列表
     * */
    public function getAllresvations() {
    	$sql = '1=1 ';
    	if (isset($_REQUEST['doctor_id']) && $_REQUEST['doctor_id']) {
    		$sql .= " and doctor_id =" . $_REQUEST['doctor_id'];
    	}    	
    	if (isset($_REQUEST['department_id']) && $_REQUEST['department_id']) {
    		$sql .= " and department_id =" . $_REQUEST['department_id'] ;
    	}
    	if (isset($_REQUEST['statu']) && $_REQUEST['statu']) {    		
    		$sql .= " and statu='" .$_REQUEST['statu']."'";
    	}
    	if (isset($_REQUEST['docID']) && $_REQUEST['docID']) {
    		$sql .= " and doctor_id='" .$_REQUEST['docID']."'";
    	}
    	if (isset($_REQUEST['date']) &&$_REQUEST['date']) {
    		if(strstr($_REQUEST['date'],"-")){
    			$_REQUEST['date']=strtotime($_REQUEST['date']);
    		}    		
    		$sql .= " and date='" .$_REQUEST['date']."'";
    	}
    	if (isset($_REQUEST['state']) && $_REQUEST['state']) {
    		$sql .= " and state='" .$_REQUEST['state']."'";
    	}
    	$count = R::count($this->tableName, $sql);
    	$n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
    	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    	$m = ($page-1)*$n;
    	fb($page,"page");
    	DTExpression::limit($m, $n);    	
    	$sql .= DTExpression::$limit;    	
    	$data = $this->dealFindOperator('ResVation', $sql);    	
    	$resdepart=new ResDepartmentDAO();
    	$resdoctor=new ResDoctorDAO();
    	foreach ($data as $key=>$val){
    		$val->department_name=$resdepart->getDepartmentNameByID($val->department_id);
    		$val->doctor_name=$resdoctor->getNameByID($val->doctor_id);
    		//医生职称
    		$val->position=$resdoctor->getPositionByID($val->doctor_id);
    		$val->date=date('Y-m-d',$val->date);    		
    		//可约的号源数
    		$val->bookingNum=(int)$val->morning_source+$val->afternoon_source+$val->night_source-$val->mark;
    	}    	
    	return array('rows'=>$data,'ttl'=>$count);
    }
    
    /**
     * 根据条件取医生
     * */
    public function getdoctors($where){
    	DTExpression::page($where);
    	if($where['date'] && $where['department_id']){//如果日期存在
    		
    	    switch ($where['time']){
    			case 3:
    				$sql=' and night IS NOT NULL';
    				break;
    			case 2:
    				$sql=' and afternoon IS NOT NULL';
    				break;
    			case 1:
    				$sql=' and morning IS NOT NULL';
    				break;    
    			default:
    				$sql='';		
    		}
    		
    		$arr=array('date'=>$where['date'],'department_id'=>$where['department_id']);
    		
    		$result  = R::findAll( $this->tableName, 'date =:date and department_id=:department_id '.$sql, $arr);
    		

    	}elseif ($where['date'] && !$where['department_id']){
    	    switch ($where['time']){
    			case 3:
    				$sql=' and night IS NOT NULL';
    				break;
    			case 2:
    				$sql=' and afternoon IS NOT NULL';
    				break;
    			case 1:
    				$sql=' and morning IS NOT NULL';
    				break;    
    			default:
    				$sql='';		
    		}
    		
    		$arr=array('date'=>$where['date']);
    		
    		$result  = R::findAll( $this->tableName, 'date =:date'.$sql, $arr);
    	}elseif(!$where['date'] && !$where['department_id']){
    	switch ($where['time']){
    			case 3:
    				$sql=' night IS NOT NULL';
    				break;
    			case 2:
    				$sql=' afternoon IS NOT NULL';
    				break;
    			case 1:
    				$sql=' morning IS NOT NULL';
    				break;    
    			default:
    				$sql='';		
    		}
    		
    		//$arr=array('date'=>$where['date']);
    		
    		$result  = R::findAll( $this->tableName, $sql);
    	}else{
    		$starttime=strtotime('last monday');
    		$endtime=strtotime('next sunday');
    		switch ($where['time']){
    			case 3:
    				$sql=' and night IS NOT NULL';
    				break;
    			case 2:
    				$sql=' and afternoon IS NOT NULL';
    				break;
    			case 1:
    				$sql=' and morning IS NOT NULL';
    				break;    
    			default:
    				$sql='';		
    		}
    		$arr=array('department_id'=>$where['department_id'],'starttime'=>$starttime,'endtime'=>$endtime);
    		$result  = R::findAll( $this->tableName, 'date >=:starttime and date<:endtime and department_id=:department_id '.$sql, $arr);
    		
    		
    	}
    	
    	R::close();
    	$reser = array();
    	foreach ($result as $key => $value) {
    		$Reservation = new Reservation();
    		$Reservation->generateFromRedBean($value);
    		$reser[] = $Reservation;
    	}
    	return $reser;
    }

    /**
     * 查询指定的数据.
     *
     * @param unknown_type $where
     * @return Ambigous <array(Entity), multitype:, unknown>
     */
    public function query($where) { 
        DTExpression::ge('date', $where, 'start_time','r');        
        DTExpression::le('date', $where, 'end_time','r');
        DTExpression::page($where);        
        $sort=isset($where['sort'])?$where['sort']:'id desc';        
        DTOrder::sort($sort);
        if (isset($where['department_id'])) {
        	if (strlen($where['department_id']) != 0) {
        	DTExpression::eq('department_id', $where, 'r');
        	}
        }
        if (isset($where['doctor_id'])) {
        	if (strlen($where['doctor_id']) != 0) {
        		DTExpression::eq('doctor_id', $where, 'r');
        	}
        }
        if (isset($where['doctor'])) {
        	if ($where['doctor'] != '') {
        		DTExpression::like('name', $where,'resdoctor');
        	}
        }        
        if(isset($where['page'])&&isset($where['size'])){
          $start = (int) $where['page'] - 1;
           $size = (int) $where['size'];
        }
        $sql=ORMMap::$sqlMap['reservationjoin']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;                
        $data = $this->getJoin($sql);         
        foreach($data as $key=>$v){
        	if($v->state==0||$v->state==1){
        		//与当前时间戳比较，如果时间戳己晚于当前时间则定为过期，修改当时数据的状态  
        		if($v->date<=time()){
        			$data[$key]->state=2;
        			$reservationBean = R::load('resvation', $v->id);
        			$reservationBean->state = 2;
        			$id = R::store ( $reservationBean );        			
        		}
        	}
        	$data[$key]->morningtime=($v->morning)?$v->morning."（".$v->morning_source."）":0;
        	$data[$key]->aftertime=($v->afternoon)?$v->afternoon."（".$v->afternoon_source."）":0;
        	$data[$key]->nighttime=($v->night)?$v->night."（".$v->night_source."）":0;
        	$data[$key]->wholeBookNum=(int)($v->morning_source+$v->afternoon_source+$v->night_source);
        	$data[$key]->date = date('Y-m-d', $v->date);        	
        }
        R::close();
		return $data; 	
    }

    
    
    /**
     * 获取表中总条数 .
     * ..
     *
     * @param array $where
     * @return Ambigous <number, number>
     */
    public function totalRows($where) {
    	DTExpression::ge('date', $where, 'start_time','r');        
        DTExpression::le('date', $where, 'end_time','r');
        DTExpression::page($where);        
        $sort=isset($where['sort'])?$where['sort']:'id desc';        
        DTOrder::sort($sort);
        if (isset($where['department_id'])) {
        	if (strlen($where['department_id']) != 0) {
        	DTExpression::eq('department_id', $where, 'r');
        	}
        }
        if (isset($where['doctor'])) {
        	if ($where['doctor'] != '') {
        		DTExpression::like('name', $where,'resdoctor');
        	}
        }       

        $sql=ORMMap::$sqlMap['reservationjoin']. ' where '.DTEXPRESSION::$sql . DTOrder::$sql ;         
        $data = $this->getJoin($sql);        
        return count($data);
	}
    
    /**
     * 计算剩余的号数
     * 
     */
    public function getresnum($where){
    	DTExpression::eq('id', $where);
    	$sql='SELECT along - mark AS num,department_id,doctor_id,date,morning,afternoon,night from '.$this->tableName.' where'.DTExpression::$sql;
    	
    	$result=$this->getJoin($sql);
    	if($result!=null){
    	return $result[0]->num;
    	}else{
    		return 0;
    	}
    	
    	//return $this->getByComposite($this->tableName, $sql.' where'.DTExpression::$sql);
    }
	
	
	    /*
     * 计算预约挂号表里的数据总数
     * 
     * */
    public function gettotalCount(){
    	return $count = R::count($this->tableName);
    }
    
    /*
     * 更新医生所在科室
     * 
     * */
    public function updatedepartment($arr){
    	$sql='update '.$this->tableName.' set department_id=:department_id where doctor_id=:doctor_id';
    
    	return R::exec($sql,$arr);
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
        $res = R::find($this->tableName, DTExpression::$sql .'and state=0 order by date '.  DTExpression::$limit, DTExpression::$params);
       
        $arr = array();
        foreach ($res as $k => $bean) {
            $entity = new Reservation();
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
        $beans = R::batch('reservationdetail', $ids);
        R::close();
        return $beans;
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
    /*
     * 根据日期和科室删除详细列表中的记录
     * @param $array
     * */
    public function delete_indate($arr) {
    	$beans = R::findAll($this->tableName, "doctor_id=:doctor_id and date=:date", $arr);
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
     public function queryDateList($where){	
	    DTExpression::between('date', $where,'start_date','end_date');     
		$res = R::getAll('select * from resvation where ' . DTExpression::$sql, array('start_date'=>$where['start_date'],'end_date'=>$where['end_date']));
		return $res;
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
	/*
	 * 
	 * check date exist, return id
	 * */
	public function date_exist($date){
		
	
	
		$result  = R::findOne( $this->tableName, 'date =:date', $date);
		if($result!=null){
		return $result->id;
		}else{
			return null;
		}
		
	}
	
	/*
	 * 
	 * check date exist return bean
	 * 日期，科室ID，医生ID
	 * */
	
	public function date_existbean($date,$timetype=null){
		if($timetype==null){
			$result  = R::findOne( $this->tableName, 'date =:date and department_id=:department_id and doctor_id=:doctor_id', $date);
		}else{
			switch ($timetype){
				case 'nig':
    			$sql=' and night IS NOT NULL';
    			break;
    		case 'aft':
    			$sql=' and afternoon IS NOT NULL';
    			break;
    		default:
    			$sql=' and morning IS NOT NULL';
			}
			$result  = R::findOne( $this->tableName, 'date =:date and department_id=:department_id and doctor_id=:doctor_id'.$sql, $date);
			
		}
		if($result!=null){
			return $result;
		}else{
			return null;
		}
	}
	
	/*
	 * 判断特定科室，特定日期下有无数据
	 * 
	 * @param $array
	 * 
	 * 
	 * */
	public function date_deparment_exist($array){
		$result  = R::findOne( $this->tableName, 'date =:date and department_id=:department_id and doctor_id=:doctor_id', $array);
		R::close();
		return $result;
	}
	
	/*
	 * 更新早上时间
	 * 
	 * */
	
	public function update($bean){
		return R::store($bean);
		R::close();		
	}
	
	/*
	 * 获取指定区间的日期
	 * */
	public function getresbetween($array){
		
		DTExpression::ge('date', $array, 'startdate');
		DTExpression::le('date', $array, 'enddate');
		DTExpression::eq('state',$array, 'state');

		//$sqlmore=' AND state=0';
		$sql=ORMMap::$sqlMap['resershow']. ' where '.DTEXPRESSION::$sql;
		
		return $this->getJoin(ORMMap::$sqlMap['resershow'].' where '.DTEXPRESSION::$sql);
		R::close();
	}
	
	public function getDocList($where, $limit, $order) {
	    $sql = ORMMap::$sqlMap['doctormanager_relation'];
	    if (!empty($where) && is_array($where)) {
	        foreach ($where as $k=>$v) {
	            DTExpression::eq($k, $v);
	        }
	        $sql .= ' where '.DTEXPRESSION::$sql;
	    }
	    
	    if ($order) {
	        $sql .= ' order by ' . $order;
	    }
	    
	    if (isset($limit['page']) && isset($limit['size'])) {
	    	DTExpression::limit($limit['page'] * $limit['size'], $limit['size']);
	    	$sql .= DTExpression::$limit;
	    }

		return $this->getJoin($sql);
		R::close();
	}
	
	/*
	 * 查询指定日期期间的医生排班情况
	 * */	
	public function getdoctorindate($arr){
		$result=R::findAll($this->tableName,'doctor_id=:doctor_id and date>=:start and date<:end and state=0',$arr);
		$reservations = array();
		
	        foreach ($result as $v) {
	        $entity = new ResVation();
            $entity->generateFromRedBean($v);
            $reservations[] = $entity;
            } 
                  
            return $reservations;
	}
	
	/*
	 *根据医生id删除排班信息 
	 * */
	public function deleteresbydocid($arr){
		$resbean=R::findAll($this->tableName,'doctor_id=:doctor_id',$arr);		
		R::trashall($resbean);
	}
	
	/*
	 *根据科室id删除排班信息
	* */
	public function deleteresbydepid($arr){
		$resbean=R::findAll($this->tableName,'department_id=:department_id',$arr);
	
		R::trashall($resbean);
	}
	
	/**
	 * 处理简单查询
	 * */
	protected function dealFindOperator($className, $sql='', $binds = '') {
		$tablename = strtolower($className);
		if (empty($binds)) {
			$beans = R::find($tablename, $sql);
		} else {
			$beans = R::find($tablename, $sql, $binds);
		}
	
		$array = array();
		foreach($beans as $bean){
			$obj = new $className();
			$obj->generateFromRedBean($bean);
			$array[] = $obj;
		}
		return $array;
	}
  	/**
	 * 获取今天可预约的时间段
	 * */
  public function getDoctorReservation($arr){
  		$bean = R::getAll("select morning_point,after_point,night_point from ".$this->tableName." where department_id=:department_id and doctor_id=:doctor_id and state=0 and date >:start and date<=:end",array(
                ':department_id' => $arr['department_id'],
                ':doctor_id' => $arr['doctor_id'],
                ':start' => $arr['start'],
                ':end' => $arr['end']
            ));
		$array = array();
		foreach($bean as $val){
			if($val['morning_point']){
				$array = array_push($array,$val['morning_point']);
			}
			if($val['after_point']){
				$array = array_push($array,$val['after_point']);
			}
			if($val['night_point']){
				$array = array_push($array,$val['night_point']);
			}
		}
		return $array;
  }

    /**
     * 获得号源、已约总数
     */
    public function getNumberTotal($where) {
        $sql = "select date,mark,morning_source,afternoon_source,night_source from ".$this->tableName." where date between :start_time and :end_time";
        $sumArr = R::getAll($sql, $where);
        return $sumArr;
    }
    /**
     * 获得已约总数
     */
    public function getAboutTotal($where) {
        $sql = "select sum(mark) as num from ".$this->tableName." where date between :start_time and :end_time";
        $sumArr = R::getAll($sql, $where);
        return $sumArr['num'];
    }	 
     /**
     * 格式化时间
     * 
     * @$day 间隔天数，默认1天，即每天都统计
     * */
    public function initArray($starTime, $endTime, $columns=array()) {
        $array = array();
        for ($i = $starTime; $i <= $endTime;) {
            $j = $i + 86400;
            $field = date('Y-m-d', $i);
			foreach($columns as $val){
				$array[$field][$val] = 0;
			}
            $i = $j;
        }       
        return $array;
    }
	/**
	 * 获取统计数据
	 * */
	public function getStatData($where = '') {
	    $type = isset($where['type']) ? $where['type'] : '1';
	    $start = isset($where['start']) ? $where['start'] : '';
	    $end = isset($where['end']) ? $where['end'] : '';
	    if ($start && $end) {
	        $start = strtotime($start);
	        $end = strtotime($end);
	        if ($end-$start < 0) {
	            throw new Exception('开始时间不能大于终止时间');
	        }
	    }
	    switch ($type) {
	    	case '1': //排班统计
	    	    $data = $this->getStatBySchedule($start, $end);
	    	    break;
	    	case '2': 
	    	    $flag = isset($_REQUEST['flag']) ? $_REQUEST['flag'] : '';
	    	    if ('department' == $flag) {
					//科室到诊统计
	    	        $data = $this->getStatByDepartment($start, $end);
	    	    }
	    	    break;
	    	default:
	    	    break;
	    }
	    return $data;
	}
	/**
	 * 获得resvationdata数据
	 * */
    public function queryResVationData($where) {
		
        DTExpression::eq('id', $where);
        DTExpression::eq('daytime', $where);
        DTExpression::eq('week', $where);
        DTExpression::ge('daytime', $where, 'start_time');
        DTExpression::le('daytime', $where, 'end_time');
        DTExpression::page($where);

        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';

        return $this->getByComposite(ORMMap::$classes[$this->resvationdata], DTExpression::$sql . DTOrder::$sql);
	}
	/**
	 * 排班统计
	 * */
	public function getStatBySchedule($start = '', $end = '') {
	    $data = array();
	    $tot = array();
		$where = array('start_time'=>date('Y-m-d',$start), 'end_time'=>date('Y-m-d',$end));
		$result = $this->queryResVationData($where);
		
	    $init = array('Sunday' => '','Monday' => '','Tuesday' => '','Wednesday' => '', 'Thursday' => '','Friday' => '','Saturday' => '');
	    $week = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	    $data[0] = $data[1] = $data[2] = $data[3] = $init;

	    $data[3]['title'] = '上午';
	    $data[2]['title'] = '下午';
	    $data[1]['title'] = '晚上';
	    $data[0]['title'] = '总计';
		$am_about = $pm_about = $night_about = $total_about = $am_no = $pm_no = $night_no = $total_no = 0;
	    if ($result) {
    	    foreach ($result as $k=>$v) {
				unset($v->department);
				$a_about[$v->week] = isset($v->day_1_state_1) ? (int)$v->day_1_state_1 : 0;
				$p_about[$v->week] = isset($v->day_2_state_1) ? (int)$v->day_2_state_1 : 0;
				$n_about[$v->week] = isset($v->day_3_state_1) ? (int)$v->day_3_state_1 : 0;
				$t_about[$v->week] = $a_about[$v->week] + $p_about[$v->week] + $n_about[$v->week];
				
				$a_no[$v->week] = isset($v->day_1_state_2) ? (int)$v->day_1_state_2 : 0;
				$p_no[$v->week] = isset($v->day_2_state_2) ? (int)$v->day_2_state_2 : 0;
				$n_no[$v->week] = isset($v->day_3_state_2) ? (int)$v->day_3_state_2 : 0;
				$t_no[$v->week] = $a_no[$v->week] + $p_no[$v->week] + $n_no[$v->week];
    	    }
				for($i=0;$i<7;$i++){
					$am_about = isset($a_about[$i]) ? $a_about[$i] : 0;
					$pm_about = isset($p_about[$i]) ? $p_about[$i] : 0;
					$night_about = isset($n_about[$i])? $n_about[$i] : 0;
					$total_about = isset($t_about[$i])? $t_about[$i] : 0;
					
					$am_no = isset($a_no[$i])? $a_no[$i] : 0;
					$pm_no = isset($p_no[$i])? $p_no[$i] : 0;
					$night_no = isset($n_no[$i])? $n_no[$i] : 0;
					$total_no = isset($t_no[$i])? $t_no[$i] : 0;
					//上午
					$data[3][$week[$i]] = '已：' . $am_about . '&nbsp;<b>/</b>&nbsp;' . '未：' . $am_no;
					//下午
					$data[2][$week[$i]] = '已：' . $pm_about . '&nbsp;<b>/</b>&nbsp;' . '未：' . $pm_no;
					//晚上
					$data[1][$week[$i]] = '已：' . $night_about . '&nbsp;<b>/</b>&nbsp;' . '未：' . $night_no;					
					//总计
					$data[0][$week[$i]] = '已：' . $total_about . '&nbsp;<b>/</b>&nbsp;' . '未：' . $total_no;
					$tot['about'] += $total_about;
					$tot['no'] += $total_no;
				}
					$tot['total'] = $tot['about'] + $tot['no'];
	    } else {
			$tmp = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	        foreach ($tmp as $v) {
	            //上午
	            $data[3][$v] = '已：0&nbsp;<b>/</b>&nbsp;未：0';
	            //下午
	            $data[2][$v] = '已：0&nbsp;<b>/</b>&nbsp;未：0';
	            //晚上
	            $data[1][$v] = '已：0&nbsp;<b>/</b>&nbsp;未：0';
	            //总计
	            $data[0][$v] = '已：0&nbsp;<b>/</b>&nbsp;未：0';
	        }
			$where = array('start_time'=>$start, 'end_time'=>$end);
			$result = $this->getNumberTotal($where);
			$total = $about = 0;
			$m_mark = $a_mark = $n_mark = $m_no = $a_no = $n_no = $morning_source = $afternoon_source = $night_source= array();
			foreach($result as $key=>$val){
				$w = date("w",$val['date']);
				$m_mark[$w] = isset($m_mark[$w]) ? $m_mark[$w] : 0;
				$a_mark[$w] = isset($a_mark[$w]) ? $a_mark[$w] : 0;
				$n_mark[$w] = isset($n_mark[$w]) ? $n_mark[$w] : 0;
				$a_no[$w] = isset($a_no[$w]) ? $a_no[$w] : 0;	
				$m_no[$w] = isset($m_no[$w]) ? $m_no[$w] : 0;
				$n_no[$w] = isset($n_no[$w]) ? $n_no[$w] : 0;
				if($val['morning_source']){
					$morning_source[$w] = isset($morning_source[$w]) ? $morning_source[$w] : 0;					
					$m_mark[$w] += $val['mark'];
					$morning_source[$w] += $val['morning_source'];
					$m_no[$w] = $morning_source[$w] - $m_mark[$w];
					$data[3][$tmp[$w]] = '已：'.$m_mark[$w].'&nbsp;<b>/</b>&nbsp;未：'.$m_no[$w];
					$total += $val['morning_source'];
					$about += $val['mark'];
				}
				if($val['afternoon_source']){
					$afternoon_source[$w] = isset($afternoon_source[$w]) ? $afternoon_source[$w] : 0;				
					$a_mark[$w] += $val['mark'];
					$afternoon_source[$w] += $val['afternoon_source'];
					$a_no[$w] = $afternoon_source[$w] - $a_mark[$w];
					$data[2][$tmp[$w]] = '已：'.$a_mark[$w].'&nbsp;<b>/</b>&nbsp;未：'.$a_no[$w];
					$total += $val['afternoon_source'];
					$about += $val['mark'];
				}
				if($val['night_source']){
					$night_source[$w] = isset($night_source[$w]) ? $night_source[$w] : 0;					
					$n_mark[$w] += $val['mark'];
					$night_source[$w] += $val['night_source'];
					$n_no[$w] = $night_source[$w] - $n_mark[$w];
					$data[1][$tmp[$w]] = '已：'.$n_mark[$w].'&nbsp;<b>/</b>&nbsp;未：'.$n_no[$w];
					$total += $val['night_source'];
					$about += $val['mark'];
				}
				$t_mark[$w] = $m_mark[$w] + $a_mark[$w] + $n_mark[$w];
				$t_no[$w] = $m_no[$w] + $a_no[$w] + $n_no[$w];
				$data[0][$tmp[$w]] = '已：'.$t_mark[$w].'&nbsp;<b>/</b>&nbsp;未：'.$t_no[$w];				
			}

			$no = $total- $about;
			$tot['about'] = $about;
			$tot['no'] = $no;
			$tot['total'] = $total;
	    }
		unset($result);
	    return array('rows'=>array_values($data),'ttl'=>4,'total'=>$tot);
	}		
	/**
	 * 科室到诊率
	 * */
	public function getStatByDepartment($start, $end) 
	{
	    $data = array();
	    $sql = 'select id, name from resdepartment';
	    $result = R::getAll($sql);
	    foreach ($result as $value) {
	        if (!isset($data[$value['id']])) {
	            $data[$value['id']]['department_name'] = $value['name'];
	            $data[$value['id']]['arrive_num'] = 0;
	            $data[$value['id']]['about_num'] = 0;
	        }
	    }

		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select daytime,department from resvationdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultDepartment = R::getAll($sql);
	    $arrive = $about = 0;
		if($resultDepartment){
			foreach ($resultDepartment as $key=>$value) {
					$department = unserialize($value['department']);					
				foreach($department as $k=>$v){
				    if ($k == 0) continue;
						$data[$k]['about_num'] += (int)$v[1];
						$data[$k]['arrive_num'] += (int)$v[2];
						$arrive += $v[2];
						$about += $v[1];
				}
			}
		}
	    //金额占所有科室金额的百分比及平均消费
	    foreach ($data as $k => $v) {
			if($v['about_num'] != 0){
				$percent = round($v['arrive_num']/$v['about_num'], 3)*100;
				$data[$k]['percent'] = $percent;
			}else{
				$data[$k]['percent'] = '0';		
			}
	    }	    
	    //分页
	    $ttl = count($data);
		$total['arrive'] = $arrive;
		$total['about'] = $about;
		$total['percent'] = ($arrive==0) ? 0 : $arrive/$about*100; 
	    if (isset($_REQUEST['page']) && $_REQUEST['page']) {
	        $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
	        $data = array_slice($data, $start, intval($_REQUEST['size']));
	        return array('rows'=>array_values($data), 'ttl'=>$ttl,'total'=>$total);
	    }  
	    return array('rows'=>array_values($data), 'ttl'=>$ttl,'total'=>$total);
	}
	/**
	 * 获取所有需统计的日期
	 * */
	public function getStatDate() {
		$sql = "SELECT FROM_UNIXTIME(date,'%Y-%m-%d') days FROM resvation GROUP BY days";
		return R::getAll($sql);
	}
	/**
	 * 获得统计数据
	 * */	
	public function getResVationData($start, $end){
	    $sql = "select r.morning_source,r.afternoon_source,r.night_source,r.mark,r.department_id,r.date";
	    $sql .= " from `resvation` as r";
	    if ($start && $end) {
	        $sql .= " where r.date between '" . $start . "' and '" . $end . "'";
	    }	
	    return R::getAll($sql);
	}
	/**
	 * 更新统计数据
	 * */
	public function updateStatData($data) {
	    foreach ($data as $rv) {
	        $this->updateData($rv);
	    }
		return true;
	}
	/**
	 * 更新统计数据
	 * */
	protected function updateData($rvdata) {
	    //根据日期获取md5值
	    $daytime = $rvdata->daytime;
	    $rvDataObj = R::findOne('resvationdata', 'daytime=:daytime', array(':daytime'=>$daytime));
	    if (isset($rvDataObj->id)) {
	        //查看md5是否相同
	        if ($rvDataObj->data_md5 != $rvdata->data_md5) {
	            //更新
	            $rvdata->id = $rvDataObj->id;
	            return $this->resVationDataUpdate($rvdata,'resvationdata');
	        }
	    } else {
	        //添加
	        return $this->resVationDataSave($rvdata,'resvationdata');
	    }
	}
    /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function resVationDataUpdate($entity,$tableName) {
        $bean = R::load($tableName, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);

        return new Result(true, 0, '', NULL);
    }
    /**
     * 插入数据
     *
     * @param unknown $entity
     * @return boolean
     */
    public function resVationDataSave($entity,$tableName) {
    	
        $bean = R::dispense($tableName);
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return $entity;
    }
	/*
	 * 检验数据存在
	 * */
	public function checkDataIsAdd($time){
		$result=R::findOne( $this->resvationdata, 'daytime =:daytime', array('daytime'=>date('Y-m-d',$time)));	
		if($result!=null){
			return $result;
		}
		return '';
	}
    /**
     * 获得已到诊总数...
     */
    public function getArriveTotal($array) {
        $sql = "select count(*) as num from resbookinginfo where statu='已到诊' and department_id=:department_id and times>=:start and times<=:end";
        $countArr = R::getRow($sql, $array);
        return $countArr['num'];
    }
    /**
     * 获得已约总数
     */
    public function getAboutNumber($array) {
        $sql = "select count(*) as num from resbookinginfo where department_id=:department_id and times>=:start and times<=:end";
        $countArr = R::getRow($sql, $array);
        return $countArr['num'];
    }
	/**
     * 保存resvationData
     * 
     * */
    public function saveResVationData($resvationdata) {    	
    	$resvationdataBean = R::dispense(TABLENAME_RESVATIONDATA);    	
    	$resvationdata->generateRedBean($resvationdataBean);    	    	
    	R::store($resvationdataBean);    	  	
    	return $resvationdataBean->id;//返回数据成功添加后的ID
    }
    /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function updateResVationData($entity) {
        $bean = R::load(TABLENAME_RESVATIONDATA, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);

        return new Result(true, 0, '', NULL);
    }	
}