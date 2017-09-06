<?php

/**
 * 医生(Doctors)DAO
 *
 * @author Administrator
 *
 */
class ResDoctorDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DOCTORMANAGER;
        $this->doctorToDisease = TABLENAME_DOCTORTODISEASE;
        
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) { 
    	if(isset($where['name'])&&$where['name']){
    		DTExpression::like('name', $where, $this->tableName);
    	}
    	if(isset($where['department_id'])&&$where['department_id']){
    		DTExpression::eq('department_id', $where, $this->tableName);
    	}
    	if(isset($where['position'])&&$where['position']){
    		DTExpression::eq('position', $where, $this->tableName);
    	}
    	if(isset($where['page'])&&$where['page']){
    		DTExpression::page($where);
    	}        
        DTOrder::desc($this->tableName . '.id');        
        $sql = ORMMap::$sqlMap['doctormanager_relation'] . ' where ' . DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
        $array = $this->getJoin($sql,$where); 	
        return $array;
    }
    
    /*
     * get doctor id by name
     * 
     * */
    public function get_name($arr){
       $result = R::findOne($this->tableName, 'name = ?',$arr);
       return $result;
    	
    }
    
    /**
     * 获得己关联科室的医生数据
     */
    public function getDocHasDep() {
    	$sql = '1=1 ';
    	if (isset($_REQUEST['docname']) && $_REQUEST['docname']) {
    		$sql .= " and name like '%" . $_REQUEST['docname']. "%'";
    	}
    	if (isset($_REQUEST['docID']) && $_REQUEST['docID']) {
    		$sql .= " and id =" . $_REQUEST['docID'] ;
    	}
    	if (isset($_REQUEST['department_id']) && $_REQUEST['department_id']) {
    		$sql .= " and department_id =" . $_REQUEST['department_id'] ;
    	}  
    	//过滤未关联科室的医生
    	$sql .=" and department_id <>'' or department_id <>null";
    	$count = R::count($this->tableName, $sql);    	
    	$n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
    	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    	$m = ($page-1)*$n;
    	DTExpression::limit($m, $n);    	
    	$sql .= DTExpression::$limit;
    	$data = $this->dealFindOperator('ResDoctor', $sql);
    	$resdepart=new ResDepartmentDAO();    	
    	foreach ($data as $key=>$val){
    		$val->department_name=$resdepart->getDepartmentNameByID($val->department_id); 
    	}
    	return array('rows'=>$data,'ttl'=>$count);  
    }
    
    
    
    
    /***
     * 获得满足条件的医生数量
    *
    */
    public function gettotalRows($where) {
    	fb($where,"ss");
    	DTExpression::like('name', $where, $this->tableName);
    	DTExpression::eq('department_id', $where, $this->tableName);
    	DTExpression::eq('position', $where, $this->tableName);
    	DTExpression::page($where);
    	DTOrder::desc($this->tableName . '.id');
    	//$result=R::count($this->tableName,DTEXPRESSION::$sql,array('department_id'=>$where['department_id'],'	'=>$where['position']));    	
    	return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    	//return $result;    
    }
    
    
    /*
     * 获取除该科室外的其它科室医生
    * */
    public function get_otherdoctor($where){
    	DTExpression::like('name', $where);
    	DTOrder::asc('convert(name using gbk)');
    	if(isset($where['name'])&&$where['name']!=null){
    	    $arr=array('department_id'=>(int)$where['department_id'],'name'=>'%'.$where['name'].'%');
    	}else{
    		$arr=array('department_id'=>(int)$where['department_id']);
    	}
    	$doctorbean = R::findAll($this->tableName,DTExpression::$sql.'and department_id <> :department_id'. DTOrder::$sql, $arr);   
    	//DTExpression::eq('department_id', $where, $this->tableName);   	 	
    	R::close();    	
    	$resdoctor=new ResDoctor();
    	$docarray=array();
    	foreach ($doctorbean as $key => $value) {
    		$resdoctor->generateFromRedBean($value);
    		$docarray[]=$value;
    	}
    	return $docarray;
    }
    /**
     * 添加医生信息
     */
    public function addDoctor($entity){//ediorDoctor
    	return $this->dealAddOperator($entity, 'resdoctor');
    }    
	
    /**
     * 编辑医生信息
     */
    public function ediorDoctor($entity){//ediorDoctor
    	return $this->dealAddOperator($entity, 'resdoctor');
    }
    
   
    public function delete_relation($arr){
    	$sql='update '.$this->tableName.' set `department_id`=0 where id=:id';
    	
    	return R::exec($sql,$arr);
    	
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::like('name', $where);
        DTExpression::eq('department_id', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 根据医生获取疾病
     *
     * @param string $para
     *            return array $arr
     */
    public function getDisease($para) {
        $diseases = R::findAll($this->doctorToDisease, 'doctor_id = ?', array(
            $para
        ));

        $diseaseArray = array();
        foreach ($diseases as $key => $value) {
            $doctorToDisease = new DoctorToDisease();
            $doctorToDisease->generateFromRedBean($value);
            $diseaseArray[] = $doctorToDisease;
        }

        return $diseaseArray;
    }

    /**
     * 更新医生数据
     *
     * @param entity $doctor
     * @param array $disease_id
     *            return boolean
     */
    public function updateDisease($doctor, $diseaseId) {
        // 医生疾病表数据的修改
        $bean = R::findAll($this->doctorToDisease, 'doctor_id = ?', array(
            $doctor->id
        ));
        $this->deleteBeans($bean);
        foreach ($diseaseId as $value) {
            $doctorToDisease = new DoctorToDisease();
            $doctorToDisease->doctor_id = $doctor->id;
            $doctorToDisease->disease_id = $value;

            $bean = R::dispense($this->doctorToDisease);
            $doctorToDisease->generateRedBean($bean);
            R::store($bean);
        }

        return true;
    }

    /**
     * 删除医生疾病关系表数据
     *
     * @param int $doctor_id
     */
    public function deleteDisease($doctor_id) {
        $doctorToDisease = R::findAll($this->doctorToDisease, 'doctor_id = ?', array(
            $doctor_id
        ));

        $this->deleteBeans($doctorToDisease);

        return true;
    }

    /**
     * 获取医生数据
     *
     * @return multitype:Doctors
     */
    public function getDoctors() {
        $doctors = R::findAll($this->tableName);

        $doctorArray = array();
        foreach ($doctors as $key => $value) {
            $doctor = new Doctor();
            $doctor->generateFromRedBean($value);
            $doctorArray[] = $doctor;
        }

        return $doctorArray;
    }

    /**
     * 获取单条数据
     *
     * @param unknown $id
     */
    public function getDoctorById($id) {
        $doctor = new Doctor();
        $doctorBean = R::load($this->tableName, $id);
        $doctor->generateFromRedBean($doctorBean);

        return $doctor->name;
    }

    /**
     * 获取单条数据
     *
     * @param unknown $id
     */
    public function getDoctorsById($id) {
    	$resdoctor = new ResDoctor();
    	$doctorBean = R::load($this->tableName, $id);
    	$resdoctor->generateFromRedBean($doctorBean);    
    	return $resdoctor;
    }
    /**
     * 获取医生
     *
     * @param unknown $departments_id
     * @return Ambigous <array(Entity), multitype:unknown >
     */
    public function getByDepartmentID($department_id) {
        $doctors = R::findAll($this->tableName, 'department_id = ?', array(
            $department_id
        ));

        $doctorArray = array();
        foreach ($doctors as $key => $value) {
            $doctor = new Doctor();
            $doctor->generateFromRedBean($value);
            $doctorArray[] = $doctor;
        }

        return $doctorArray;
    }
    
    /**
     * 根据医生名称获取数据
     */
    public function getDoctorsByName() {
    	$sql = '1=1 ';
        if (isset($_REQUEST['doctorname']) && $_REQUEST['doctorname']) {
        	$sql .= " and name like '%" . $_REQUEST['doctorname'] . "%'";
        }
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        $count = R::count('resdoctor', $sql);
        $sql .= DTExpression::$limit;
        $data = $this->dealFindOperator('ResDoctor', $sql);
        return array('rows'=>$data,'ttl'=>$count);
    }
    
    /**
     * 根据医生ID来获取医生名称
     */
    public function getNameByID($id) {
    	$detail = R::findOne('resdoctor',"id=".$id);    	
    	return $detail['name'];
    }
    
    /**
     * 根据医生ID来获取医生名称
     */
    public function getPositionByID($id) {
    	$detail = R::findOne('resdoctor',"id=".$id);
    	return $detail['position'];
    }
    
    /**
     * 根据医生ID获取医生所属科室
     */
    public function getByDoctorID($id) {    	    		
    	$detail = R::findOne('resdoctor',"id=".$id);    	
    	return $detail['department_id'];
    }
    
    
    /**
     * 更新医生所在的部门
     * @param int $doctor
     * @param int $departments_id
     * @return Ambigous <array(Entity), multitype:unknown >
     */
    public function update_department($doctor,$departments_id){   	
    	$resdoctor = R::load($this->tableName, (int)$doctor);
    	$resdoctor->department_id = (int)$departments_id;
    	R::store($resdoctor);
    }
    
    /**
     * 添加医生关联关系
     * */
    public function updata_relation($doctor_id,$relation_id){    	 
    	$resdoctor = R::load($this->tableName, (int)$doctor_id);
    	$resdoctor->relation_id = (int)$relation_id;
    	R::store($resdoctor);
    }
    

    /**
     * 根据疾病ID获取医生
     *
     * @param string $disease_id
     */
    public function getByDiseaseId($disease_id) {
        $beans = R::findAll($this->doctorToDisease, " disease_id = '" . $disease_id . "' ");
        $ids = array();
        foreach ($beans as $key => $value) {
            $doctorToDisease = new DoctorToDisease();
            $doctorToDisease->generateFromRedBean($value);
            $ids[] = $doctorToDisease->doctor_id;
        }

        $beans = R::batch($this->tableName, $ids);
        $doctorArray = array();
        foreach ($beans as $key => $value) {
            $doctor = new Doctor();
            $doctor->generateFromRedBean($value);
            if ($doctor->id == 0) {
                continue;
            }
            $doctorArray[] = $doctor;
        }

        return $doctorArray;
    }
    
    /**
     * 根据科室id取医生的数量
     *
     * @param string $depart_id
     */
    
    
    public function countByDepartment($depart_id){
    	return $countdoctor=R::count($this->tableName,"department_id = '" . $depart_id . "' ");
    }
    
    /*
     * 导入医生数据到预约医生数据表里
     * 
     * */
    
    public function importdate(){
    	$sql = 'INSERT INTO '.$this->tableName.' ( name, pic, birthday, gender, content, certificate, specialty, cultural, university, department_id, plushtime ) SELECT name,pic, birthday, gender, content, certificate, specialty, cultural, university, department_id, plushtime FROM `'.$this->doctor.'` ';

    	
    	R::exec($sql);
    	return true;
    }

    public function changedepartment($docotor_id,$department_id){
    	//DTExpression::in('id', $arr, $this->tableName);
    	
    	$arrdate=array('department_id'=>(int)$department_id,
    			         'id'=>(int)$docotor_id
    	                );
    	//$sql='update '.$this->tableName.' set `department_id`=4'.' where '.DTExpression::$sql;

    	$sql='update '.$this->tableName.' set `department_id`=:department_id'.' where id=:id';
//     	print_r($sql);
//     	exit();
    	R::close();
    	return R::exec($sql,$arrdate);
    	
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
     * 根据医生ID来获取医生名称和
     */
    public function getNamePositionById($id) {
			$array = R::getRow("select name,position from ".$this->tableName." where id=:id", array(
                ':id' => $id
            ));
			return $array;
	}  
}
