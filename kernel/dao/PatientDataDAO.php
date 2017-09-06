<?php

/**
 *
 * 
 * @author Administrator
 *
 */
class PatientDataDAO extends DBBaseDAO {

    public function __construct() {
        $this->isInnerNet = true;
        parent::__construct();
        $this->tableName = TABLENAME_PATIENTDATA;
    }
   /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
		
        DTExpression::eq('id', $where);
        DTExpression::eq('daytime', $where);
        DTExpression::eq('week', $where);
        DTExpression::ge('daytime', $where, 'start_time');
        DTExpression::le('daytime', $where, 'end_time');
        DTExpression::page($where);

        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';

        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql);
	}
    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::eq('daytime', $where);
        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function update($entity) {
        $bean = R::load($this->tableName, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);

        return new Result(true, 0, '', NULL);
    }
	
   public function getDataByTime($time) {
		$result = R::getRow('select * from '.$this->tableName.' where daytime=:daytime', array(':daytime' => $time));
    	return $result;	
	}	
    /**
     * 就诊人数统计
     *
     */
   public function getVisitByTime($where) {
		$result = R::getRow('select group_concat(pids_1) as pids_1, group_concat(pids_2) as pids_2,sum(customer_1_sex_1) as customer_1_sex_1, sum(customer_1_sex_2) as customer_1_sex_2,sum(customer_2_sex_1) as customer_2_sex_1,sum(customer_2_sex_2) as customer_2_sex_2, sum(total_money) as total_money, sum(total_num) as total_num from '.$this->tableName.'  where daytime between :start_time and :end_time', array(
			':start_time' => $where['start_time'], ':end_time' => $where['end_time']));
    	return $result;	
	}
	/**
	 * 按时间获取每天就诊数据
	 * */
   public function getPeopleByDate($where) {
		$result = R::getRow('select customer_1_sex_1,customer_1_sex_2,customer_2_sex_1,customer_2_sex_2, daytime from '.$this->tableName.'  where daytime between :start_time and :end_time', array(
			':start_time' => $where['start_time'], ':end_time' => $where['end_time']));
    	return $result;	
	}	

	/**
	 * 更新统计数据
	 * */
	public function updateStatData($data) {
	    foreach ($data as $p) {
	        $this->updateData($p);
	    }
		return true;
	}
	
	/**
	 * 获取所有需统计的日期
	 * */
	public function getStatDate() {
		$sql = "SELECT FROM_UNIXTIME(visit_time,'%Y-%m-%d') days FROM patientdiagnosisdetail GROUP BY days";
		return R::getAll($sql);
	}
	
	// {{{ 就诊人数统计，详细部分   //原综合统计，按日期统计
	public function getVisitPeople($start = '', $end = '') {
	    $sql = " select p.id as case_id, p.patient_id, count(distinct(p.patient_id)) as num, p.add_time, p.case_number, p.is_finished ";
	    $sql .= ", d.type, d.visit_time, d.visit_time_field, d.examine_items, d.doctor_id, d.receptionist_id, d.department,d.disease_type,count(d.case_number) as case_num ";
	    $sql .= ", u.username, u.gender, u.birthday, u.age, u.source";
	    $sql .= ", f.current_price";
	    $sql .= " from `patientcase` as p";
	    $sql .= " inner join `patientdiagnosisdetail` as d on (d.case_id=p.id) ";
	    $sql .= " inner join `patientdiagnosisfee` as f on (f.detail_id=d.id) ";
	    $sql .= " inner join `patient` as u on (p.patient_id=u.id) where 1=1 ";
	    if ($start && $end) {
	        $sql .= ' and d.visit_time between ' . $start . ' and ' . $end;
	    }
	    $sql .= " group by p.patient_id, p.is_finished";
	
	    return R::getAll($sql);
	}
	
	/**
	 * 更新统计数据
	 * */
	protected function updateData($pdata) {
	    //根据日期获取md5值
	    $daytime = $pdata->daytime;
	    $pDataObj = R::findOne('patientdata', 'daytime=:daytime', array(':daytime'=>$daytime));
	    if ($pDataObj->id) {
	        //查看md5是否相同
	        if ($pDataObj->data_md5 != $pdata->data_md5) {
	            //更新
	            $pdata->id = $pDataObj->id;
	            return $this->update($pdata);
	        }
	    } else {
	        //添加
	        return $this->save($pdata);
	    }
	}
	
	//为修改或增加时统计提供的方法，即只要数据库中存在，则为老客户
	public function checkIsOld($patient_id = '', $opt = 'save') {
	    $num = ($opt == 'save') ? 1 : 1;
	    
	    $sql = " select count(d.case_number) as case_num from `patientcase` as p";
	    $sql .= " inner join `patientdiagnosisdetail` as d on (d.case_id=p.id) ";
	    $sql .= " and p.patient_id=" . $patient_id;
	
	    $result = R::getRow($sql);
	    if (intval($result['case_num']) > $num) return true;
	    return false;
	}
	
}
