<?php

/**
 * 
 * @author Administrator
 *
 */
class PatientDataService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new PatientDataDAO();
    }
   /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
    	$t = time();
    	$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
    	$array=array('openid'=>$openid,'stime'=>$start,'etime'=>$end);    	
        $patientdataArray = $this->dao->query($where);
        return $this->success($patientdataArray);
    }
    /**
     * 查询数据总量
     *
     * @see kernel/BaseService::totalRows()
     */
    public function totalRows($params) {	
        return $this->success($this->dao->totalRows($params));
    }
    /**
     * 获取一条数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function get($data) {
        $this->dao->get($data->id, $data);
 
        return $this->success($data);
    }
    /**
     * 保存数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function save($data) {  
        // 获取class对象并插入数据
        $rs=$this->dao->save($data);
        
        return $this->success($rs);
    }
    /**
     * 保存数据字段
     *
     * @param Entity $commodity
     * @return Result
     */
    public function saveDataField($data,$pid) {

    	$time_slot = $data['visit_time_field'];
		$time_week = $data['visit_time'];	
		$case_id = $data['case_id'];
		$type = $data['type'];
		$money = $data['current_price'];
		$receptionist_id = $data['receptionist_id'];
		$department_id = $data['department'];
		$disease_id = $data['disease_type'];
		$is_finished = $data['is_finished'];
		$project_id = $data['examine_items'];    //诊疗项目
		$doctor_id = $data['doctor_id'];
		$source_id = $data['source'];
		$age_slot = ceil($data['age']/10);  			//年龄段
		
		$sex = ($data['gender']==0) ? 1 : 2;   //1男2女
		//$customer = ($case_id) ? 2 : 1;				       //1新2老
		$customer = ($this->dao->checkIsOld($pid)) ? 2 : 1;				       //1新2老
		$deal = ($is_finished == 1) ? 1 : 2;			    //1成2否
		
		$day_field = 'day_'.$time_slot.'_sex_'.$sex;
		$customer_field = 'customer_'.$customer.'_sex_'.$sex;
		
        $this->blindParams($pdata = new PatientData());
		$pdata->week = date("w",$time_week);
		$pdata->daytime = date("Y-m-d",$time_week);
		
		$pdata->day_1_sex_1 = 0;
		$pdata->day_2_sex_1 = 0;
		$pdata->day_3_sex_1 = 0;
		$pdata->day_1_sex_2 = 0;
		$pdata->day_2_sex_2 = 0;
		$pdata->day_3_sex_2 = 0;
		$pdata->$day_field =  1;
		
		$pdata->customer_1_sex_1 = 0;
		$pdata->customer_2_sex_1 = 0;
		$pdata->customer_1_sex_2 = 0;
		$pdata->customer_2_sex_2 = 0;
		$pdata->$customer_field =  1;
		
		$visit = 0;			
		if($type == 1){
			$pdata->visit_num = 0;								//复诊人次
		}else{
			$pdata->visit_num = 1;
			$visit = 1;
		}
		$pdata->total_num = 1;
		$pdata->total_money = $money;
		$pdata->reception  = $this->setReception('',$receptionist_id,$deal);
		$pdata->department  = $this->setDepartment('',$department_id,$customer,$visit,$money);
		$pdata->disease  = $this->setDisease('',$disease_id,$customer,$visit,$money);
		if($case_id){
			$pdata->pids_1 = '';
			$pdata->pids_2 = $pid;
		}else{
			$pdata->pids_1 = $pid;
			$pdata->pids_2 = '';			
		}
		$examine = 1;
		if($project_id){
			$pdata->project  = $this->setProject('',$project_id,$sex,$examine,$money);			
		}else{
			$pdata->project = '';
		}
		$pdata->doctor  = $this->setDoctor('',$doctor_id,$customer,$visit,$money);
		$pdata->source  = $this->setSource('',$source_id,$examine,$money);
		if($customer==2){
			$pdata->age_1 = '';
			$pdata->age_2 = $this->setAge('',$disease_id,$sex,$age_slot);
		}else{
			$pdata->age_1 = $this->setAge('',$disease_id,$sex,$age_slot);
			$pdata->age_2 = '';			
		}

		//计算数据的md5值，用于统计更新
		$pdata->data_md5 = md5(serialize($pdata));  
        return $this->dao->save($pdata);
    }
    /**
     * 更新数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function update($pdata) {
    			
        return $this->dao->update($pdata);
    }
    /**
     * 更新数据字段
     *
     * @param Entity $commodity
     * @return Result
     */
    public function updateDataField($result,$data,$user) {
    	$time_slot = $data['visit_time_field'];
		$time_week = $data['visit_time'];	
		$case_id = $data['case_id'];
		$type = $data['type'];
		$money = $data['current_price'];
		$receptionist_id = $data['receptionist_id'];
		$department_id = $data['department'];
		$disease_id = $data['disease_type'];
		$is_finished = $data['is_finished'];
		$project_id = $data['examine_items'];    //诊疗项目
		$doctor_id = $data['doctor_id'];
		$source_id = $user['source'];
		$pid = $user['id'];									//患者id
		$age_slot = ceil($user['age']/10);  			//年龄段
			
		$sex = (intval($user['gender'])==0) ? 1 : 2;   				//1男2女
		//$customer = ($case_id) ? 2 : 1;				       //1新2老
		$customer = ($this->dao->checkIsOld($pid, 'update')) ? 2 : 1;				       //1新2老
		$deal = ($is_finished == 1) ? 1 : 2;			    //1成2否
		
		$day_field = 'day_'.$time_slot.'_sex_'.$sex;
		$customer_field = 'customer_'.$customer.'_sex_'.$sex;
		
        $this->blindParams($pdata = new PatientData());
		$pdata->id = $result['id'];
		$pdata->week = $result['week'];
		$pdata->daytime = $result['daytime'];

		$pdata->day_1_sex_1 = $result['day_1_sex_1'];
		$pdata->day_2_sex_1 = $result['day_2_sex_1'];
		$pdata->day_3_sex_1 = $result['day_3_sex_1'];
		$pdata->day_1_sex_2 = $result['day_1_sex_2'];
		$pdata->day_2_sex_2 = $result['day_2_sex_2'];
		$pdata->day_3_sex_2 = $result['day_3_sex_2'];
		$pdata->$day_field = $result[$day_field] + 1;

		$pdata->customer_1_sex_1 = $result['customer_1_sex_1'];
		$pdata->customer_2_sex_1 = $result['customer_2_sex_1'];
		$pdata->customer_1_sex_2 = $result['customer_1_sex_2'];
		$pdata->customer_2_sex_2 = $result['customer_2_sex_2'];
		$pdata->$customer_field =  $result[$customer_field] + 1;	
		
		$visit = 0;	
		if($type == 1){
			$pdata->visit_num = $result['visit_num'];								//复诊人次
		}else{
			$pdata->visit_num = $result['visit_num'] + 1;
			$visit = 1;
		}
		if($case_id){
			$pdata->pids_1 = $result['pids_1'];
			$pdata->pids_2 = $result['pids_2'] ? ($result['pids_2']. ',' . $pid) : $pid;
		}else{
			$pdata->pids_1 = $result['pids_1'] ? ($result['pids_1']. ',' . $pid) : $pid;
			$pdata->pids_2 = $result['pids_2'];			
		}
		$pdata->total_num = $result['total_num'] + 1;	
		$pdata->total_money = $result['total_money'] + $money;
		$pdata->reception  = $this->setReception($result['reception'],$receptionist_id,$deal);
		$pdata->department  = $this->setDepartment($result['department'],$department_id,$customer,$visit,$money);
		$pdata->disease  = $this->setDisease($result['disease'],$disease_id,$customer,$visit,$money);
		$examine = 1;
		if($project_id){
			$pdata->project  = $this->setProject($result['project'],$project_id,$sex,$examine,$money);			
		}else{
			$pdata->project = $result['project'];
		}
		$pdata->doctor  = $this->setDoctor($result['doctor'],$doctor_id,$customer,$visit,$money);
		$pdata->source  = $this->setSource($result['source'],$source_id,$examine,$money);
		if($customer==2){
			$pdata->age_1 = $result['age_1'];
			$pdata->age_2 = $this->setAge($result['age_2'],$disease_id,$sex,$age_slot);
		}else{
			$pdata->age_1 = $this->setAge($result['age_1'],$disease_id,$sex,$age_slot);
			$pdata->age_2 = $result['age_2'];		
		}	

		//计算数据的md5值，用于统计更新
		$pdata->data_md5 = md5(serialize($pdata));
        return $this->dao->update($pdata);
    }
	/*
     * 获取当天时间段数据
     * */
    
    public function getDataByTime($time) {   	 
    	return $this->dao->getDataByTime($time);
	}
	/*
     * 更新字段reception
     * */
    
    public function setReception($reception,$reception_id,$deal) {
		if($reception){
			$reception = unserialize($reception);	
			if(in_array($reception_id, array_keys($reception))){
				$reception[$reception_id]['deal_'.$deal] = $reception[$reception_id]['deal_'.$deal] +1;
			}else{
				$reception[$reception_id]['deal_1'] = ($deal==1) ? 1 : 0;
				$reception[$reception_id]['deal_2'] = ($deal==2) ? 1 : 0;
			}
			$reception = serialize($reception);		
		}else{
			$reception[$reception_id]['deal_1'] = ($deal==1) ? 1 : 0;
			$reception[$reception_id]['deal_2'] = ($deal==2) ? 1 : 0;
			$reception = serialize($reception);	
		}
		return $reception;
	}
	/*
     * 更新字段department
     * */
    
    public function setDepartment($department,$department_id,$customer,$visit,$revenue) {
		if($department){
			$department = unserialize($department);	
			if(in_array($department_id, array_keys($department))){
				$department[$department_id]['customer_'.$customer] = $department[$department_id]['customer_'.$customer] +1;
				if($visit==1){
					$department[$department_id]['visit'] = $department[$department_id]['visit'] + 1;
				}
				$department[$department_id]['revenue'] = $department[$department_id]['revenue'] +$revenue;
			}else{
				$department[$department_id]['customer_1'] = ($customer==1) ? 1 : 0;
				$department[$department_id]['customer_2'] = ($customer==2) ? 1 : 0;
				$department[$department_id]['visit'] = ($visit==1) ? 1 : 0;
				$department[$department_id]['revenue'] = $revenue ? $revenue : 0;				
			}
			$department = serialize($department);		
		}else{
			$department[$department_id]['customer_1'] = ($customer==1) ? 1 : 0;
			$department[$department_id]['customer_2'] = ($customer==2) ? 1 : 0;
			$department[$department_id]['visit'] = ($visit==1) ? 1 : 0;
			$department[$department_id]['revenue'] = $revenue ? $revenue : 0;
			$department = serialize($department);	
		}
		return $department;
	}
	/*
     * 更新字段disease
     * */
    
    public function setDisease($disease,$disease_id,$customer,$visit,$revenue) {	
		if($disease){
			$disease = unserialize($disease);	
			if(in_array($disease_id, array_keys($disease))){
				$disease[$disease_id]['customer_'.$customer] = $disease[$disease_id]['customer_'.$customer] +1;
				if($visit==1){
					$disease[$disease_id]['visit'] = $disease[$disease_id]['visit'] + 1;
				}
				$disease[$disease_id]['revenue'] = $disease[$disease_id]['revenue'] + $revenue;
			}else{
				$disease[$disease_id]['customer_1'] = ($customer==1) ? 1 : 0;
				$disease[$disease_id]['customer_2'] = ($customer==2) ? 1 : 0;
				$disease[$disease_id]['visit'] = ($visit==1) ? 1 : 0;
				$disease[$disease_id]['revenue'] = $revenue;				
			}
			$disease = serialize($disease);		
		}else{
			$disease[$disease_id]['customer_1'] = ($customer==1) ? 1 : 0;
			$disease[$disease_id]['customer_2'] = ($customer==2) ? 1 : 0;
			$disease[$disease_id]['visit'] = ($visit==1) ? 1 : 0;
			$disease[$disease_id]['revenue'] = $revenue;
			$disease = serialize($disease);	
		}
		return $disease;
	}
	/*
     * 更新字段project
     * */
    
    public function setProject($project,$project_id,$sex,$examine,$revenue) {	
		if($project){
			$project = unserialize($project);	
			if(in_array($project_id, array_keys($project))){
				$project[$project_id]['examine'] = $project[$project_id]['examine'] +1;
				$project[$project_id]['revenue'] = $project[$project_id]['revenue'] +$revenue;
				$project[$project_id]['sex_'.$sex] = $project[$project_id]['sex_'.$sex] +1;
			}else{
				$project[$project_id]['examine'] = $examine ? 1 : 0;
				$project[$project_id]['revenue'] = $revenue ? $revenue : 0;	
				$project[$project_id]['sex_1'] = ($sex==1) ? 1 : 0;
				$project[$project_id]['sex_2'] = ($sex==2) ? 1 : 0;				
			}
			$project = serialize($project);		
		}else{
			$project[$project_id]['examine'] = $examine ? 1 : 0;
			$project[$project_id]['revenue'] = $revenue ? $revenue : 0;
			$project[$project_id]['sex_1'] = ($sex==1) ? 1 : 0;
			$project[$project_id]['sex_2'] = ($sex==2) ? 1 : 0;
			$project = serialize($project);	
		}
		return $project;
	}
	/*
     * 更新字段doctor
     * */
    
    public function setDoctor($doctor,$doctor_id,$customer,$visit,$revenue) {	
		if($doctor){
			$doctor = unserialize($doctor);
			if(in_array($doctor_id, array_keys($doctor))){
				$doctor[$doctor_id]['customer_'.$customer] = $doctor[$doctor_id]['customer_'.$customer] +1;
				if($visit==1){
					$doctor[$doctor_id]['visit'] = $doctor[$doctor_id]['visit'] + 1;
				}
				$doctor[$doctor_id]['revenue'] = $doctor[$doctor_id]['revenue'] +$revenue;
			}else{
				$doctor[$doctor_id]['customer_1'] = ($customer==1) ? 1 : 0;
				$doctor[$doctor_id]['customer_2'] = ($customer==2) ? 1 : 0;
				$doctor[$doctor_id]['visit'] = ($visit==1) ? 1 : 0;
				$doctor[$doctor_id]['revenue'] = $revenue;				
			}
			$doctor = serialize($doctor);		
		}else{
			$doctor[$doctor_id]['customer_1'] = ($customer==1) ? 1 : 0;
			$doctor[$doctor_id]['customer_2'] = ($customer==2) ? 1 : 0;
			$doctor[$doctor_id]['visit'] = ($visit==1) ? 1 : 0;
			$doctor[$doctor_id]['revenue'] = $revenue;
			$doctor = serialize($doctor);	
		}
		return $doctor;
	}
	/*
     * 更新字段source
     * */
    
    public function setSource($source,$source_id,$examine,$revenue) {		
		if($source){
			$source = unserialize($source);	
			if(in_array($source_id, array_keys($source))){
				$source[$source_id]['examine'] = $source[$source_id]['examine'] +1;
				$source[$source_id]['revenue'] = $source[$source_id]['revenue'] +$revenue;
			}else{
				$source[$source_id]['examine'] = $examine ? 1 : 0;
				$source[$source_id]['revenue'] = $revenue ? $revenue : 0;				
			}
			$source = serialize($source);		
		}else{
			$source[$source_id]['examine'] = $examine ? 1 : 0;
			$source[$source_id]['revenue'] = $revenue ? $revenue : 0;
			$source = serialize($source);	
		}
		return $source;
	}
	/*
     * 更新字段age
     * */
    public function setAge($age,$disease_id,$sex,$age_slot) {
		$age_slot = $age_slot * 10 ;
		$age_slot = ($age_slot>80) ? 90 : $age_slot;		
		if($age){
			$age = unserialize($age);
			if(isset($age[$disease_id]['disease_id']) && $age[$disease_id]['disease_id'] == $disease_id){
				$age[$disease_id][$age_slot][$sex] += 1;				
			}else{
				for($i=1;$i<10;$i++){
					$age[$disease_id][$i*10][1] = 0;
					$age[$disease_id][$i*10][2] = 0;
				}
				$age[$disease_id][$age_slot][$sex] = 1;
				$age[$disease_id]['disease_id'] =  $disease_id;		
			}			

		}else{
		    $age = array(); 
			for($i=1;$i<10;$i++){
				$age[$disease_id][$i*10][1] = 0;
				$age[$disease_id][$i*10][2] = 0;
			}
			$age[$disease_id][$age_slot][$sex] = 1;
			$age[$disease_id]['disease_id'] =  $disease_id;
		}
		$age = serialize($age);
		return $age;
	}	 
    /**
     * 绑定参数
     *
     * @param unknown $entity
     */
    protected function blindParams($entity) {
        foreach ($entity as $key => $value) {
            if (isset($_REQUEST[$key])) {
                $entity->$key = $_REQUEST[$key];
            }
        }
    }

    /**
     * 更新统计数据
     * */
    public function updateStatData($start, $end) {
        try {
            $result = $this->dao->getVisitPeople($start, $end);
            $data = array();
            foreach ($result as $value) {
                $date = date('Y-m-d', $value['visit_time']);
                 
                $customer = (intval($value['case_num'])>1) ? 2 : 1;	//1新2老
                $time_slot = $value['visit_time_field'];
                if (empty($time_slot)) continue;
                $sex = (intval($value['gender'])==0) ? 1 : 2;   	//1男2女
                $age_slot = ceil($value['age']/10);  			//年龄段
                $day_field = 'day_'.$time_slot.'_sex_'.$sex;
                $customer_field = 'customer_'.$customer.'_sex_'.$sex;
                 
                if (isset($data[$date])) {
                    //日期数据存在，则累加
                    $pdata = $data[$date];
                } else {
                    //日期数据不存在，则初始化
                    $pdata = $this->initPatientData($value['visit_time'], $day_field, $customer_field);
                    $data[$date] = $pdata;
                }
                 
                $pdata->$day_field = $data[$date]->$day_field + 1;
                $pdata->$customer_field =  $data[$date]->$customer_field + 1;
                 
                $money = $value['current_price'];
                $pdata->total_num = $data[$date]->total_num + 1;
                $pdata->total_money = $data[$date]->total_money + $money;
                 
                 
                $visit = 0;
                if($value['type'] == 1){
                    $pdata->visit_num = $data[$date]->visit_num;								//复诊人次
                }else{
                    $pdata->visit_num = $data[$date]->visit_num + 1;
                    $visit = 1;
                }
                 
                $pid = $value['patient_id'];
                if(intval($value['case_num'])>1){
                    $pdata->pids_1 = $data[$date]->pids_1;
                    $pdata->pids_2 = $data[$date]->pids_2 ? ($data[$date]->pids_2 . ',' . $pid) : $pid;
                }else{
                    $pdata->pids_1 = $data[$date]->pids_1 ? ($data[$date]->pids_1 . ',' . $pid) : $pid;
                    $pdata->pids_2 = $data[$date]->pids_2;
                }
                 
                $deal = (intval($value['is_finished']) == 1) ? 1 : 2;			    //1成2否
                 
                $pdata->reception  = $this->setReception($data[$date]->reception,$value['receptionist_id'],$deal);
                $pdata->department  = $this->setDepartment($data[$date]->department,$value['department'],$customer,$visit,$money);
                $pdata->disease  = $this->setDisease($data[$date]->disease,$value['disease_type'],$customer,$visit,$money);
                 
                $examine = 1;
                $project_id = $value['examine_items'];
                if($project_id){
                    $pdata->project  = $this->setProject($data[$date]->project,$project_id,$sex,$examine,$money);
                }else{
                    $pdata->project = $data[$date]->project;
                }
                $pdata->doctor  = $this->setDoctor($data[$date]->doctor,$value['doctor_id'],$customer,$visit,$money);
                $pdata->source  = $this->setSource($data[$date]->source,$value['source'],$examine,$money);
                if($customer==2){
                    $pdata->age_1 = $data[$date]->age_1;
                    $pdata->age_2 = $this->setAge($data[$date]->age_2,$value['disease_type'],$sex,$age_slot);
                }else{
                    $pdata->age_1 = $this->setAge($data[$date]->age_1,$value['disease_type'],$sex,$age_slot);
                    $pdata->age_2 = $data[$date]->age_2;
                }
                 
                //计算数据的md5值，用于统计更新
                $pdata->data_md5 = md5(serialize($pdata));
                 
                $data[$date] = $pdata;
            
            }
            
            $result = $this->dao->updateStatData($data);
            if (!$result) return $this->fail('', "数据统计更新失败");
        } catch (Exception $e) {
            return $this->fail('', $e->getMessage());
        }
        
    	return $this->success();
    }
    
    /**
     * 获取所以需统计的日期
     * */
    public function getStatDate() {
    	return $this->dao->getStatDate();
    }
    
    /**
     * 初始化统计对象
     * */
    protected function initPatientData($time_week, $day_field, $customer_field) {
        $pdata = new PatientData();
        $pdata->week = date("w",$time_week);
        $pdata->daytime = date("Y-m-d",$time_week);
         
        $pdata->day_1_sex_1 = 0;
        $pdata->day_2_sex_1 = 0;
        $pdata->day_3_sex_1 = 0;
        $pdata->day_1_sex_2 = 0;
        $pdata->day_2_sex_2 = 0;
        $pdata->day_3_sex_2 = 0;
        $pdata->$day_field =  0;
    
        $pdata->customer_1_sex_1 = 0;
        $pdata->customer_2_sex_1 = 0;
        $pdata->customer_1_sex_2 = 0;
        $pdata->customer_2_sex_2 = 0;
        $pdata->$customer_field =  0;
         
        $pdata->visit_num = 0;
         
        return $pdata;
    }
}