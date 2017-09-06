<?php

class ResScheduleDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_RESERTEMPLATEDETAIL;
    }

    /**
     * 查询指定的数据.
     *
     * @param unknown_type $where
     * @return Ambigous <array(Entity), multitype:, unknown>
     */
    public function query($where) {    
        DTOrder::sort('id desc');
        return $this->getByComposite('resschedule', DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);     
    }
    
    /*
     * 查找moning的非空数据
     * 
     * */
    
    public function getmorning($arr){
    	$beans = R::findOne($this->tableName, "date=:date and type=:type and tem_id=:tem_id AND morning is not null", $arr);    	
    	R::close();
		return $beans;
    }
    
    /*
     * 查找afternoon的非空数据
    *
    * */
    
    public function getafternoon($arr){    
    	$beans = R::findOne($this->tableName, "date=:date and type=:type and tem_id=:tem_id AND afternoon is not null", $arr);
    	R::close();
    	return $beans;     
    }
    
    /*
     * 查找night的非空数据
    *
    * */
    
    public function getnight($arr){    
    	$beans = R::findOne($this->tableName, "date=:date and type=:type and tem_id=:tem_id AND night is not null", $arr);
    	R::close();
    	return $beans; 
    }
    
    /*
     * 批量更新早上时间
     * 
     * */
    public function updatemon($arr,$time){
    	$bean = R::findAll($this->tableName, "type=:type and tem_id=:tem_id AND morning is not null", $arr);
     	foreach ($bean as $key => $value) {
     		$value->morning=$time;
     		R::store($value);     	
        }
        R::close();	
    }
    
    /*
     * 批量更新下午时间
    *
    * */
    public function updateaft($arr,$time){  
    	$bean = R::findAll($this->tableName, "type=:type and tem_id=:tem_id AND afternoon is not null", $arr);
    	foreach ($bean as $key => $value) {
    		$value->afternoon=$time;
    		R::store($value);
    	}
    	R::close();
    	 
    }
    
    
    /*
     * 批量更新晚上时间
    *
    * */
    public function updatenig($arr,$time){    
    
    	$bean = R::findAll($this->tableName, "type=:type and tem_id=:tem_id AND night is not null", $arr);
    	foreach ($bean as $key => $value) {
    		$value->night=$time;
    		R::store($value);
    	}
    
    	R::close();
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
        $bean = R::dispense('resschedule');
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
        $res = R::find('resschedule', DTExpression::$sql . 'order by times asc' . DTExpression::$limit, DTExpression::$params);
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
        $count = R::count('resschedule', DTExpression::$sql, DTExpression::$params);
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
    	fb($arr);
        $beans = R::findAll('resschedule', "tem_id=:tem_id", $arr);        
        R::trashAll($beans);
        R::close();
    }

    /**
     * 获得已约总数...
     */
    public function getApproximately($array) {
        $sql = "select count(*) as num from resschedule where statu='已约' and department_id=:department_id and doctor_id=:doctor_id and date=:date and times>=:start and times<=:end";
        $countArr = R::getAll($sql, $array);
        return $countArr[0]['num'];
    }
    
    /**
     * 获取某个医生的总号数...
     */
    public function getAllVerification($array){
    	$sql = "select count(*) as num from resschedule where department_id=:department_id and doctor_id=:doctor_id and date=:date and times>=:start and times<=:end";
    	$countArr = R::getAll($sql, $array);
    	return $countArr[0]['num'];
    }

    /**
     * 获取详细表中所有数据
     *
     * @return Ambigous <multitype:, ReservationDetail>
     */
    public function getDetailAll() {
        $beans = R::findAll('resschedule');
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
        
        $res = R::getAll('select * from resschedule where ' . DTExpression::$sql, DTExpression::$params);
         
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
	    $bean = R::load('resschedule', $entity->id);  
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
	 * 通过 类型和模板id把数据取出来
	 * @param $array
	 * return $obj
	 * 
	 * */
	
	public function getdate($arr){		
		$beans = R::findAll($this->tableName,'type=:type and tem_id=:tem_id order by date',$arr);
		return $beans;
		
		
	}
}