<?php

/**
 * 医生(Doctors)DAO
 *
 * @author Administrator
 *
 */
class DoctorDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DOCTOR;
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
        DTExpression::like('name', $where, $this->tableName);
        DTExpression::eq('department_id', $where, $this->tableName);
        DTExpression::eq('reserve_id', $where, $this->tableName);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::asc($this->tableName . '.id');
        }
        
        if (isset($where['show_position']) && $where['show_position']) {
            $show_position = str_replace('show_position', $this->tableName . '.show_position', stripslashes($where['show_position']));
            DTExpression::$sql .= " and " . $show_position;
        }
        
        //$sql = ORMMap::$sqlMap['doctor_relation'] . ' where ' . DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
        //$array = $this->getJoin($sql);
         return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit, DTExpression::delFields($this->tableName,array('content')));      
        return $array;
    }

    /**
     * 保存医生数据
     *
     * @see DBBaseDAO::save()
     */
    public function doctorSave($doctor, $departmentsbean) {
    	$this->remPic( 'save' , $doctor , null );
        $doctorBean = R::dispense($this->tableName);
        $doctor->generateRedBean($doctorBean);
        $departmentsbean->ownDoctors[] = $doctorBean;

        R::store($departmentsbean);
        $doctor->generateFromRedBean($doctorBean);

        return true;
    }

    /**
     * 保存医生疾病关系
     *
     * @param string $doctor_id
     * @param string $disease_id
     */
    public function addDisease($doctor_id, $disease_id) {
        $sql = 'insert into doctortodisease(doctor_id,disease_id) values(' . $doctor_id . ',' . $disease_id . ')';
        R::exec($sql);
        return true;
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
        DTExpression::eq('reserve_id', $where, $this->tableName);
        if (isset($where['show_position']) && $where['show_position']) {
        	$show_position = str_replace('show_position', $this->tableName . '.show_position', stripslashes($where['show_position']));
        	DTExpression::$sql .= " and " . $show_position;
        }

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
     * 根据预约医生表ID获取关联医生
     *
     * @return Result
     */
    public function getByResDoctorId($resdocID) {
    	$beans = R::findOne($this->tableName, " reserve_id = '" . $resdocID . "' ");  
    	if($beans){
    		$arr=array('id'=>$beans->id,'name'=>$beans->name);
    	}else{
    		$arr=array();
    	}
    		
        return $arr;
    }
    
    /**
     * 获取指定条数 和 排序 记录 分页
     *
     * @param string $order
     *            排序条件
     * @param string $where
     *            条件
     * @param
     *            return array
     */
    
    
    public function getPage($field = 'id,title', $where, $limit = array("page"=>"0","size"=>"2"), $order = 'id desc') {
    	if (is_array($where)) {
    		foreach ($where as $key => $v) {
    			if ($key != 'id') {
    				DTExpression::like($key, $where);
    			} else {
    				DTExpression::eq($key, $where);
    			}
    		}
    	}
    
    	$show_position = $this->unsetShowPosition();
    	if ($show_position) {
    		DTExpression::$sql .= " and " . $show_position;
    	}
    	DTExpression::limit($limit['page'] * $limit['size'], $limit['size']);
    	
    	
    	return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
	
    /**
     * 通过id获取name
	 * @return name
     */	
    public function getName($doctor_id) {
		$info = array();
		if($doctor_id){
			$info = R::getRow("SELECT name FROM ".$this->tableName." WHERE id=".$doctor_id);
		}
		return	isset($info['name'])&&strlen($info['name'])>0 ? $info['name'] : 'admin';
	}	
	
	/**
	 *更新预约医生id 
	 */
	public function updateReserve($where){
		$arr = array('reserve_id'=>$where['reserve_id'],'id'=>$where['id']);
		$sqls = 'update '.$this->tableName.' set `reserve_id`= 0'.' where reserve_id=:reserve_id';
		$sql = 'update '.$this->tableName.' set `reserve_id`=:reserve_id'.' where id=:id';
		R::close();
		R::exec($sqls,array('reserve_id'=>$where['reserve_id']));
		return R::exec($sql,$arr);
	}
}
