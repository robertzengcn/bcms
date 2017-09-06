<?php
class PatientDAO extends DBBaseDAO{
	
	public function __construct() {
	    $this->isInnerNet = true;
        parent::__construct();
    }
    
    /**
     * 获取患者信息总数...
     */
    public function getCountPatient(){
    	$count = R::count('patient');
    	return $count;
    }
    
    /**
     * 保存患者基础信息
     * */
    public function savePatient($patientEntity){ 
        $patient_id = 0;
        $patient_id = $this->dealAddOperator($patientEntity, 'patient', true);
        return $patient_id;
    }
    
    /**
     * 保存患者案例信息
     * */
    public function savePatientCase($caseEntity){
        $case_id = 0;
        if (empty($caseEntity->id)) {
            $caseEntity->add_time = time();
        }
        $case_id = $this->dealAddOperator($caseEntity, 'patientcase', true);
        return $case_id;
    }
    
    /**
     * 保存患者就诊详情
     * */
    public function saveDiagnosisDetail($detailEntity){
        $detail_id = 0;
        $detail_id = $this->dealAddOperator($detailEntity, 'patientdiagnosisdetail', true);
        return $detail_id;
    }
    
    /**
     * 保存患者就诊费用详情
     * */
    public function saveDiagnosisFee($feeEntity, $patient_id, $pType){
        $fee_id = $money = 0;
        //如果Ptype为3，说明是用户修改了复诊记录以往的收费值，重先计算此项及后面所有的相关项费用
        if(!empty($pType)&&$pType==3){
            //当前修改对象
            $curObj = R::getRow('SELECT * FROM `patientdiagnosisfee` WHERE `detail_id` =  ' . $feeEntity->detail_id . ' AND `case_number` = ' . $feeEntity->case_number);
            $curId = $curObj['id'];
            //查询当前对象及以后的数据
            DTExpression::ge('id', $curId);
            DTExpression::eq('case_number', $feeEntity->case_number);
        				DTOrder::asc('id');
        				$fee_data=R::findAll('patientdiagnosisfee',DTExpression::$sql . DTOrder::$sql,DTExpression::$params);
        				//默认当前money
        				$money = $feeEntity->balance;
             
        				//整理后的新对象
        				$dealedData = array();
        				foreach ($fee_data as $bean) {
        				    if (empty($dealedData)) {
        				        //第一次处理，即当前修改对象，不与之前的数据进行计算
        				        $bean->balance = $money;
        				    } else {
        				        //向下累计处理
        				        $money = $money + $bean->real_price - $bean->current_price;
        				        $bean->balance = $money;
        				    }
    
        				    //记录重新整理过的数据对象
        				    $dealedData[] = $bean;
        				}
             
        				//保存整理后的新对象
        				R::storeAll ( $dealedData );
        }else{
            $money = $feeEntity->balance;
        }
    
    
        //修改-余额写进账户
        $patientBean = R::load('patient', $patient_id);
        $patientBean->money = $money;
        $id = R::store ( $patientBean );
        $bean = R::findOne("patientdiagnosisfee", "detail_id=" . $feeEntity->detail_id);
        
        $leftmoney = $feeEntity->current_price;
        if ($bean && $bean->id) {
            $feeEntity->id = $bean->id;
            if ($feeEntity->current_price != $bean->current_price) {
                //修改，费用变动则积分重新折算差额，用于返还或添加积分
                $leftmoney = $feeEntity->current_price - $bean->current_price;
            }
        } else {
        	$feeEntity->pay_time = time();
        }
        
        $fee_id = $this->dealAddOperator($feeEntity, 'patientdiagnosisfee', true);
        
        //添加积分和积分日志
        $rule = R::load('commodityrule', 7);
        //如果积分规则生效则记录积分及日志
        if ($fee_id && !empty($rule) && $rule->status == 1) {
            $score = $leftmoney * intval($rule->score);
            
            //记录用户积分
            $patient = R::load('patient', $patient_id);
            
            $sql = 'username="'.$patient->username.'"';
            if ($patient->telphone)
                $sql .= ' or telephone=' . $patient->telphone;
            $memberObj = R::findOne('member', $sql);
            $member = new Member();
            
            fb($patient, '$patient');
            fb($memberObj, '$memberObj');
            if (!empty($memberObj)) {
                $member->id = $memberObj->id;
                $member->ownscore = $memberObj->ownscore + $score;
            } else {
                $member->ownscore = $score;
            }
            
            $member->username = $patient->username;
            $member->telephone = $patient->telphone;
            $member_id = $this->dealAddOperator($member, 'member', true);
            
            fb($member_id, 'mid');
            
            //医院就诊消费添加积分写入积分日志
            if ($member_id) {
                $memberLog=new CommodityAddScoreLog();
                $memberLog->uid = $member_id;
                $memberLog->date = time();
                $memberLog->type = 7;
                $memberLog->score = $score;
                $memberLog->ip = $this->getIp();
                $this->dealAddOperator($memberLog, 'commodityaddscorelog');
            }
            
        }
        
        return $fee_id;
             
    }
    
    /**
     * 积分日志记录IP
     * */
    protected function getIp(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            return $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORVARDED_FOR'])){
            return $_SERVER['HTTP_X_FORVARDED_FOR'];
        }elseif(!empty($_SERVER['REMOTE_ADDR'])){
            return $_SERVER['REMOTE_ADDR'];
        }else{
            return '未知IP';
        }
    }
    
    /**
     * 保存患者就诊处方详情
     * */
    public function savePreDetail($preDetailEntities, $detail_id){
        if (!empty($preDetailEntities)) {
            $oldIds = array();
            $olddata = R::find('patientprescriptiondetail', "detail_id=" . $detail_id);
            foreach ($olddata as $old) {
                $oldIds[$old['id']] = $old['prescription_id'];
            }
        
            $curIds = array();
            foreach ($preDetailEntities as $preDetailEntity) {
                $curIds[] = $preDetailEntity->prescription_id;
            }
        
            foreach ($preDetailEntities as $pre) {
                if (in_array($pre->prescription_id, $oldIds) && in_array($pre->prescription_id, $curIds)) {
                    //修改
                    $bean = R::findOne("patientprescriptiondetail", "detail_id=" . $detail_id . " and prescription_id=" . $pre->prescription_id);
                    if ($bean && $bean->id) {
                        $pre->id = $bean->id;
                    }
                    $this->dealAddOperator($pre, 'patientprescriptiondetail');
                    unset($oldIds[$bean->id]);
                }
        
                if (!in_array($pre->prescription_id, $oldIds) && in_array($pre->prescription_id, $curIds)) {
                    //添加
                    $this->dealAddOperator($pre, 'patientprescriptiondetail');
                }
        
            }
        
            foreach ($oldIds as $id) {
                $bean = R::findOne("patientprescriptiondetail", "detail_id=" . $detail_id . " and prescription_id=" . $id);
                R::trash($bean);
            }
        }else{//执行删除操作
            $oldIds = array();
            $olddata = R::find('patientprescriptiondetail', "detail_id=" . $detail_id);
            foreach ($olddata as $old) {
                $oldIds[$old['id']] = $old['prescription_id'];
            }
            foreach ($oldIds as $id) {
                $bean = R::findOne("patientprescriptiondetail", "detail_id=" . $detail_id . " and prescription_id=" . $id);
                R::trash($bean);
            }
        }
        
    }
    
    /**
     * 增加检查报告单
     * */
    public function updateCheck($data){
        if(!empty($data['checkimg'])){
            $detail_id = $data['detail_id'];
            $patientchecker=new PatientCheckService();//如果存在检查单就，则更新检查单
        
            $patientchecker->delebypid(array('pid'=>$detail_id));
        
            foreach($data['checkimg'] as $key=>$value){
                $patientcheck=new PatientCheck();
                if(isset($data['checkcontent'][$key])){
                    $img=str_replace(UPLOAD,"",$value);
                    $patientcheck->content=$data['checkcontent'][$key];
                    $patientcheck->pic=$img;
                    $patientcheck->pid=$detail_id;
                }else{
                    $img=str_replace(UPLOAD,"",$value);
                    $patientcheck->pic=$img;
                    $patientcheck->pid=$detail_id;
                }
                 
                $patientchecker->save($patientcheck);
                 
            }
        }
    }
    
    /**
     * 保存患者信息到数据库...
     */
    public function savePatientBack($data){    	
        $patient_id = $detail_id = $case_id = '';
        
        try {
            R::begin();
            $patient = new Patient();
            if (isset($data['patient'])&&$data['patient']) {
                foreach ($data['patient'] as $key=>$value) {
                    $patient->$key = $value;
                }
                $bean = R::findOne("patient", "username='" . $patient->username . "'");
                
                if ($bean && $bean->id) {
                   // $patient_id = $bean->id;
                    $patient->generateRedBean ( $bean );
                    $patient_id = R::store ( $bean );
                } else {
                    $patient_id = $this->dealAddOperator($patient, 'patient', true);
                }
                
                if (isset($data['patientcase']['id'])&&strlen($data['patientcase']['id'])>0) {
                    $patient_id = '';
                }
            }
            
            if (isset($data['patientcase'])&&$data['patientcase']) {
                $case = new PatientCase();
                foreach ($data['patientcase'] as $key=>$value) {
                    $case->$key = $value;
                }
                if ($patient_id) {
                	$case->patient_id = $patient_id;
                }
                
                $bean = R::findOne("patientcase", "id='" . $case->id . "'");
                
                if ($bean && $bean->id) {
                    $case_id = $bean->id;
                    $patient_id = $bean->patient_id;
                    $case->generateRedBean ( $bean );
                    R::store ( $bean );
                } else {
                    if (empty($case->add_time)){$case->add_time = time();}
                    $entity = $this->dealAddOperator($case, 'patientcase');
                    $patient_id = $entity->patient_id;
                    $case_id = $entity->id;
                }
                
            }
           
            if (isset($data['patientdiagnosisdetail'])&&$data['patientdiagnosisdetail']) {
                $detail = new PatientDiagnosisDetail();
                foreach ($data['patientdiagnosisdetail'] as $key=>$value) {
                    $detail->$key = $value;
                }
                if ($case_id) {
                	$detail->case_id = $case_id;
                }
                $detail_id = $this->dealAddOperator($detail, 'patientdiagnosisdetail', true);
            }
            
            if (isset($data['patientdiagnosisfee'])&&$data['patientdiagnosisfee']) {
                $fee = new PatientDiagnosisFee();
                foreach ($data['patientdiagnosisfee'] as $key=>$value) {
                    $fee->$key = $value;
                }
                if ($detail_id) {
                	$fee->detail_id = $detail_id;
                }
               //如果Ptype为3，说明是用户修改了复诊记录以往的收费值，重先计算此项及后面所有的相关项费用
               	if(isset($data['Ptype'])&&$data['Ptype']==3){
               		//当前修改对象
               		$curObj = R::getRow('SELECT * FROM `patientdiagnosisfee` WHERE `detail_id` =  ' . $fee->detail_id . ' AND `case_number` = ' . $fee->case_number);
               		$curId = $curObj['id'];               		
               		//查询当前对象及以后的数据
               		DTExpression::ge('id', $curId);
               		DTExpression::eq('case_number', $fee->case_number);
    				DTOrder::asc('id');
               		$fee_data=R::findAll('patientdiagnosisfee',DTExpression::$sql . DTOrder::$sql,DTExpression::$params);               		
               		//默认当前money
               		$money = $fee->balance;
               		
               		//整理后的新对象
               		$dealedData = array();
               		foreach ($fee_data as $bean) {
               			if (empty($dealedData)) {
               				//第一次处理，即当前修改对象，不与之前的数据进行计算
               				$bean->balance = $money;
               			} else {
               				//向下累计处理
               				$money = $money + $bean->real_price - $bean->current_price;
               				$bean->balance = $money;
               			}
               			
               			//记录重新整理过的数据对象
               			$dealedData[] = $bean;
               		}
               		
               		//保存整理后的新对象
               		R::storeAll ( $dealedData );
               	}else{
               		$money = $fee->balance;
               	}
                
                
                //修改-余额写进账户
                $patientBean = R::load('patient', $patient_id);
                $patientBean->money = $money;
                $id = R::store ( $patientBean );
                $bean = R::findOne("patientdiagnosisfee", "detail_id=" . $detail_id);
                
                if ($bean && $bean->id) {
                    $fee->id = $bean->id;
                }
                
                $fee = $this->dealAddOperator($fee, 'patientdiagnosisfee', true);
                if (!$patient_id) { //老客户,只添加case
                    $caseBean = R::load('patientcase', $case->id);
                    $case->generateFromRedBean ( $caseBean );
                    $patient_id = $case->patient_id;
                }
                
               
            }
            
            if (isset($data['patientprescriptiondetail'])&&$data['patientprescriptiondetail']) {
                $oldIds = array();
                $olddata = R::find('patientprescriptiondetail', "detail_id=" . $detail_id);
                foreach ($olddata as $old) {
                	$oldIds[$old['id']] = $old['prescription_id'];
                }
                
                $curIds = array();
                foreach ($data['patientprescriptiondetail'] as $key=>$value) {
                    $curIds[] = $value['prescription_id'];
                }
                
                foreach ($data['patientprescriptiondetail'] as $key=>$value) {
                    $pre = new PatientPrescriptionDetail();
                    foreach ($value as $k=>$v) {
                        $pre->$k = $v;
                    }
                    if ($detail_id) {
                        $pre->detail_id = $detail_id;
                    }
                    
                    if (in_array($pre->prescription_id, $oldIds) && in_array($pre->prescription_id, $curIds)) {
                    	//修改
                        $bean = R::findOne("patientprescriptiondetail", "detail_id=" . $detail_id . " and prescription_id=" . $pre->prescription_id);
                        if ($bean && $bean->id) {
                            $pre->id = $bean->id;
                        }
                        $this->dealAddOperator($pre, 'patientprescriptiondetail');
                    	unset($oldIds[$bean->id]);
                    }

                    if (!in_array($pre->prescription_id, $oldIds) && in_array($pre->prescription_id, $curIds)) {
                        //添加
                        $this->dealAddOperator($pre, 'patientprescriptiondetail');
                    }
                    
                }
                
                foreach ($oldIds as $id) {
                    $bean = R::findOne("patientprescriptiondetail", "detail_id=" . $detail_id . " and prescription_id=" . $id);
                    R::trash($bean);
                }
            }else{//执行删除操作
            	$oldIds = array();
            	$olddata = R::find('patientprescriptiondetail', "detail_id=" . $detail_id);
            	foreach ($olddata as $old) {
            		$oldIds[$old['id']] = $old['prescription_id'];
            	}	
            	foreach ($oldIds as $id) {
            		$bean = R::findOne("patientprescriptiondetail", "detail_id=" . $detail_id . " and prescription_id=" . $id);
            		R::trash($bean);
            	}
            }
           
            if($detail_id){
           if(!empty($data['checkimg'])){
            $patientchecker=new PatientCheckService();//如果存在检查单就，则更新检查单
            
            $patientchecker->delebypid(array('pid'=>$detail_id));
          
            foreach($data['checkimg'] as $key=>$value){
            	$patientcheck=new PatientCheck();
            	if(isset($data['checkcontent'][$key])){
            		$img=str_replace(UPLOAD,"",$value);
            		$patientcheck->content=$data['checkcontent'][$key];
            		$patientcheck->pic=$img;
            		$patientcheck->pid=$detail_id;
            	}else{
            		$img=str_replace(UPLOAD,"",$value);
            		$patientcheck->pic=$img;
            		$patientcheck->pid=$detail_id;
            	}
            	
            	$patientchecker->save($patientcheck);
            	
            }
            }
            }
            R::commit();
        } catch (Exception $e) {
            R::rollback();
            throw new Exception($e->getMessage());
            return false;
        }
         
        return $patient_id;
    }
    
    /**
     * 获取患者初诊信息
     * */
    public function getListPatientCase($where = '') {
   
        //别名
        $a = 'a'; //patientcase
        $b = 'b'; //patient
        $c = 'c'; //patientdiagnosisdetail
        $d = 'd'; //patientdatasource
        $e = 'e'; //patientdiagnosisfee
        $f='f';
        $g='g';
    
        $table = array(
            $a => "patientcase as {$a}",
            $b => "patient as {$b}",
            $c => "patientdiagnosisdetail as {$c}",
            $d => "patientdatasource as {$d}",
            $e => "patientdiagnosisfee as {$e}",
            $f => "patientdepartment as {$f}",
            $g=>"patientdisease as {$g}"
            );
        
            $sql = "select {$a}.id as case_id, {$a}.*,{$b}.id as patient_id, {$b}.*";
            $sql .= ",{$c}.id as detail_id, {$c}.*";
            $sql .= ",{$d}.title as source_name,{$d}.id as source,{$f}.department_name as department_name,{$g}.disease_name as disease_name";
            $sql .= ",{$e}.*";
            $sql .= " from " . $table[$a];
            $sql .= " inner join " . $table[$b];
            $sql .= " inner join " . $table[$c];
            $sql .= " inner join " . $table[$d];
            $sql .= " inner join " . $table[$e];
            $sql .= " on {$a}.patient_id={$b}.id";
            $sql .= " and {$a}.id={$c}.case_id and {$b}.source={$d}.id";
            $sql .= " and {$e}.detail_id={$c}.id";
            $sql .= " left join " . $table[$f];
            $sql .= " on {$c}.department={$f}.id";
            $sql .= " left join " . $table[$g];
            $sql .= " on {$c}.disease_type={$g}.id";
            
            $sql .= " where  1=1 ";
   
            
            if (isset($where['case_id']) && $where['case_id']) {
                $sql .= " and {$a}.id='" . $where['case_id'] . "'";
            }
             
            if (isset($where['receptionist_id']) && $where['receptionist_id']) {
                $sql .= " and {$c}.receptionist_id='" . $where['receptionist_id'] . "'";
            }
             
            if (isset($where['case_number']) && $where['case_number']) {
                $sql .= " and {$a}.case_number='" . $where['case_number'] . "'";

            
            }
             
            if (isset($where['username']) && $where['username']) {
                $sql .= " and {$b}.username='" . $where['username'] . "'";
            }
             
            if (isset($where['telphone']) && $where['telphone']) {
                $sql .= " and {$b}.telphone='" . $where['telphone'] . "'";
            }
             
            if (isset($where['detail_id']) && $where['detail_id']) {
                $sql .= " and {$c}.id=" . $where['detail_id'];
            }
             
            if (isset($where['is_first']) && $where['is_first']) {
                $sql .= " and {$c}.type=" . $where['is_first'];
            }
             
            if (isset($where['disease_type']) && $where['disease_type']) {
                $sql .= " and {$c}.disease_type=" . $where['disease_type'];
            }
             
            if (isset($where['doctor_id']) && $where['doctor_id']) {
                $sql .= " and {$c}.doctor_id=" . $where['doctor_id'];
            }
             
            if (isset($where['start']) && $where['start']&&isset($where['end']) && $where['end']) {
                $sql .= " and {$c}.visit_time between " . strtotime($where['start'])." and ".strtotime($where['end']);                
            }
                        
             
            if (isset($where['is_pay_for']) && $where['is_pay_for']) {
                if ($where['is_pay_for'] == '1') {
                    $sql .= " and {$e}.balance<0";
                } else {
                    $sql .= " and {$e}.balance>=0";
                }
            }
          
            if(isset($where['type'])&&strlen($where['type'])>0){//如果是取复诊数据
            	
            	if ($where['type'] == '2') {
            		$sql .= " and {$c}.type=2";
  
            		
            	} elseif($where['type'] == '1') {
            		$sql .= " and {$c}.type=1";
            	}
            	if(isset($where['fcase_number'])&&$where['fcase_number']){//初诊或复诊时需要用到
            		$casenum=$where['fcase_number'];
            		$sql .= " and {$c}.case_number=".$casenum;
            	}
            }
            
            if(isset($where['pid'])&&strlen($where['pid'])>0){
            
            		$sql .= " and {$c}.pid=".$where['pid'];
            	
            }

            $return_time_arr = array(
                '7' => mktime(0,0,0,date("m"),date("d")+7,date("Y")),
                '15' => mktime(0,0,0,date("m"),date("d")+15,date("Y")),
                '30' => mktime(0,0,0,date("m")+1,date("d"),date("Y")),
                '60' => mktime(0,0,0,date("m")+2,date("d"),date("Y")),
            );
             
            $return_time = '';
            if (isset($where['return_time']) && $where['return_time']) {
                $return_time = $return_time_arr[$where['return_time']];
            }
             
            if ($return_time) {
                $sql .= " and {$c}.return_time>" . time() . " and {$c}.return_time<" . $return_time;
            }
             
            $sql .= " order by {$a}.add_time desc";
            $count = count(R::getAll($sql));
            
            if (isset($where['page'])) {
            	$page = $where['page'];
            	$size = isset($where['size']) ? $where['size'] : 10;
            	$sql .= " limit " . ($page-1)*$size . "," . $size;
            }   
           
            $data = R::getAll($sql);
           
            foreach ($data as $k => $d) {
            	$doctorBean = R::load('patientdoctor', $d['doctor_id']);
            	$data[$k]['doctor_name'] = $doctorBean->doctor_name ? $doctorBean->doctor_name : '';
            	
            	$receptionistBean = R::load('patientreceptionist', $d['receptionist_id']);
            	$data[$k]['receptionist_user'] = $receptionistBean->user_name ? $receptionistBean->user_name : '';
            	
            	$departmentBean = R::load('patientdepartment', $d['department']);
            	$data[$k]['department_name'] = $departmentBean->department_name ? $departmentBean->department_name : '';
            	
            	$diseaseBean = R::load('patientdisease', $d['disease_type']);
            	$data[$k]['disease_name'] = $diseaseBean->disease_name ? $diseaseBean->disease_name : '';
            	
            	$visit_num = $this->getVisitCount($d['detail_id']);
            	if($visit_num['count']==0){
            		$data[$k]['visit_num'] = '0';
            	}else{
            		$data[$k]['visit_num']=date('Y-m-d H:m',$visit_num['lastime']).'&nbsp;<b>/</b>&nbsp;'.$visit_num['count'].'&nbsp;次';
            	}  
            	$arr = array('1'=>'上午', '2'=>'下午', '3'=>'晚上');
            	if ($data[$k]['visit_time'])
            	    $data[$k]['visit_time_str'] = date('Y-m-d', $data[$k]['visit_time']);
            	if ($data[$k]['visit_time_field']) {
            	    $data[$k]['visit_time_str'] .= ' ' . $arr[$data[$k]['visit_time_field']];
            	}
            	
            	if ($data[$k]['return_time']!=0)
            	    $data[$k]['return_time_str'] = date('Y-m-d', $data[$k]['return_time']);
            	if ($data[$k]['return_time_field']!=0&&isset($data[$k]['return_time_str'])) {
            	    $data[$k]['return_time_str'] .= ' ' . $arr[$data[$k]['return_time_field']];
            	}
            	if($data[$k]['return_time']==0){
            		$data[$k]['return_time_str']='';
            	}
            }
             
            return array('rows'=>array_values($data),'ttl'=>$count);
    }
    
    /**
     * 根据id进行就诊信息
     */
    public function getPatientCaseById($id) {
        $where = array('detail_id'=>$id);
        $result = $this->getListPatientCase($where);
        
        $data = $result['rows'];
        $data = empty($data) ? array() : $data[0];
    	return $data;
    }
    
    /**
     * 获取复诊详情
     * */
    public function diagnosisDetail($id) {
        $result = $this->getListPatientCase(array('detail_id'=>$id));
        $data = $result['rows'];
        $data = empty($data) ? array() : $data[0];
    	return $data;
    }
    
    /**
     * 删除患者信息
     */
    public function deletePatient($ids){
    	//所有诊断id
        $beans = R::batch('patientcase', $ids);
        $feeIds = $detailIds = array();
        foreach ($ids as $case_id) {
            //删除patientdiagnosisdetail表中相关内容，递归获取所有case_id下的初复诊id
            $detail = R::findOne('patientdiagnosisdetail',"case_id=".$case_id);
            $detailIds[] = $detail->id;
            $this->getReViewIds($detail->id, $detailIds);
            
            //删除patientdiagnosisfee表中内容
            if (!empty($detailIds)) {
            	foreach ($detailIds as $detailId) {
            	    $fee = R::findOne('patientdiagnosisfee',"detail_id=".$detailId);
            	    $feeIds[] = $fee->id;
            	}
            }
        }
        
        $this->beginTrans();
        try{
            $detail = R::loadAll('patientdiagnosisdetail', $detailIds);
            R::trashAll($detail);
            $fee = R::loadAll('patientdiagnosisfee', $feeIds);
            R::trashAll($fee);
            
            R::trashAll($beans);
            $this->commitTrans();
        }catch (Exception $e){
            $this->rollbackTrans();
            return false;
        }
    	return true;
    }
    
    /**
     * 获取初诊下的所有复诊id
     * */
    public function getReViewIds($pid, &$ids = array()) {
        $details = R::findAll('patientdiagnosisdetail',"pid=".$pid);
        
    	if (empty($details)) { 
    		return $ids;
    	} else {
    		foreach ($details as $detail) {
    			$ids[] = $detail->id;
    		}
    	}
    	return $ids;
    }
    
    /**
     * 获取会员等级
     * */
    public function getVipLevels() {
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        return $this->dealFindOperator('PatientVipLevel', DTExpression::$sql . DTExpression::$limit);
    }
    
    /**
     * 获取会员等级数据条数
     * */
    public function getVipLevelsCount() {
        return R::count('patientviplevel');
    }
    
    /**
     * 获取所有患者列表
     * */
    public function getAllPatients() {
        $sql = '1=1 ';
        if (isset($_REQUEST['recommend_name']) && $_REQUEST['recommend_name']) {
        	$sql .= " and username like '%" . $_REQUEST['recommend_name'] . "%'";
        }
        
        if (isset($_REQUEST['recommend_tel']) && $_REQUEST['recommend_tel']) {
            $sql .= " and telphone like '%" . $_REQUEST['recommend_tel'] . "%'";
        }
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        $count = R::count('patient', $sql);
        $sql .= DTExpression::$limit;
        $data = $this->dealFindOperator('Patient', $sql);
        return array('rows'=>$data,'ttl'=>$count);
    }
    
    /**
     * 保存来源信息
     * */
    public function saveDataSource($entity) {
        $where = array('title' => $entity->title);
        if($this->isExists('patientdatasource', $where)) {
            throw new Exception('已存在同名项目，请勿重复添加！');
        }
		return $this->dealAddOperator($entity, 'patientdatasource');
    }
    
    /**
     * 删除来源信息
     * */
    public function delDataSource($ids) {
        $beans = R::batch('patientdatasource', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 保存诊疗项目信息
     * */
    public function addExamineItem($entity) {
        $where = array('item_name' => $entity->item_name);
        if($this->isExists('patientexamineitem', $where)) {
            throw new Exception('已存在同名项目，请勿重复添加！');
        }
        return $this->dealAddOperator($entity, 'patientexamineitem');
    }
    
    /**
     * 修改诊疗项目信息
     * */
    public function modExamineItem($entity) {
        return $this->dealAddOperator($entity, 'patientexamineitem');
    }
    
    /**
     * 删除诊疗项目信息
     * */
    public function delExamineItem($ids) {
        $beans = R::batch('patientexamineitem', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 保存会员级别信息
     * */
    public function saveVipLevel($entity) {
        $where = array('level_name' => $entity->level_name);
        if($this->isExists('patientviplevel', $where)) {
            throw new Exception('会员等级已存在！');
        }
        return $this->dealAddOperator($entity, 'patientviplevel');
    }
    
    /**
     * 修改会员级别信息
     * */
    public function modVipLevel($entity) {
        return $this->dealAddOperator($entity, 'patientviplevel');
    }
    
    /**
     * 修改来源信息
     * */
    public function modSource($entity) {
        return $this->dealAddOperator($entity, 'patientdatasource');
    }
    
    /**
     * 删除会员级别信息
     * */
    public function delVipLevel($ids) {
        $beans = R::batch('patientviplevel', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 保存医生信息
     * */
    public function addDoctor($entity) {
    	$where = array('doctor_name' => $entity->doctor_name);
    	if($this->isExists('patientdoctor', $where)) {
    		throw new Exception('已存在同名项目，请勿重复添加！');
    	}
        return $this->dealAddOperator($entity, 'patientdoctor');
    }
    
    /**
     * 修改医生信息
     * */
    public function modDoctor($entity) {
        return $this->dealAddOperator($entity, 'patientdoctor');
    }
    
    /**
     * 删除医生信息
     * */
    public function delDoctor($ids) {
        $beans = R::batch('patientdoctor', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 保存科室信息
     * */
    public function addDepartment($entity) {
    	$where = array('department_name' => $entity->department_name);
    	if($this->isExists('patientdepartment', $where)) {
    		throw new Exception('已存在同名项目，请勿重复添加！');
    	}
        return $this->dealAddOperator($entity, 'patientdepartment');
    }
    
    /**
     * 修改科室信息
     * */
    public function modDepartment($entity) {
        return $this->dealAddOperator($entity, 'patientdepartment');
    }
    
    /**
     * 删除科室信息
     * */
    public function delDepartment($ids) {
        $beans = R::batch('patientdepartment', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 保存疾病信息
     * */
    public function addDisease($entity) {
    	$where = array('disease_name' => $entity->disease_name);
    	if($this->isExists('patientdisease', $where)) {
    		throw new Exception('已存在同名项目，请勿重复添加！');
    	}
        return $this->dealAddOperator($entity, 'patientdisease');
    }
    
    /**
     * 修改疾病信息
     * */
    public function modDisease($entity) {
        return $this->dealAddOperator($entity, 'patientdisease');
    }
    
    /**
     * 删除疾病信息
     * */
    public function delDisease($ids) {
        $beans = R::batch('patientdisease', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 保存前台接待信息
     * */
    public function addReceptionist($entity) {
    	$where = array('user_name' => $entity->user_name);
    	if($this->isExists('patientreceptionist', $where)) {
    		throw new Exception('已存在同名项目，请勿重复添加！');
    	}
        return $this->dealAddOperator($entity, 'patientreceptionist');
    }
    
    /**
     * 修改前台接待信息
     * */
    public function modReceptionist($entity) {
        return $this->dealAddOperator($entity, 'patientreceptionist');
    }
    
    /**
     * 删除前台接待信息
     * */
    public function delReceptionist($ids) {
        $beans = R::batch('patientreceptionist', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 添加回访信息
     * */
    public function addReturnVisit($entity) {
        return $this->dealAddOperator($entity, 'patientreturnvisit');
    }
    
    /**
     * 删除回访信息
     * */
    public function delReturnVisit($ids) {
        $beans = R::batch('patientreturnvisit', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 添加回复信息-修改
     * */
    public function modReturnVisit($entity) {
        $bean = R::load('patientreturnvisit', $entity->id);
        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }

        $entity->detail_id = $bean->detail_id;
        $entity->message = $bean->message;
        $entity->return_time = $bean->return_time;
        $entity->generateRedBean($bean);
        $bean->setProperty('reply', $entity->reply);
        $entity->id = R::store($bean);
        $entity->generateFromRedBean ( $bean );
        
        return $entity;
    }
    
    /**
     * 获取回访信息
     * */
    public function getReturnVisitList($where = '') {
        $case_number = isset($where['case_number']) ? $where['case_number'] : '';
    	$sql = 'select a.*, b.case_number from patientreturnvisit as a inner join patientdiagnosisdetail as b ';
    	$sql .= 'on (a.detail_id=b.id) where 1=1 ';
    	
    	$case_number = isset($where['case_number']) ? $where['case_number'] : '';
    	if ($case_number) {
    	    $sql .= 'and b.case_number=' . $case_number;
    	}
    	
    	$detail_id = isset($where['detail_id']) ? $where['detail_id'] : '';
    	if ($detail_id) {
    	    $sql .= 'and b.id=' . $detail_id;
    	}
    	
    	$count = count(R::getAll($sql));
    	
    	if (isset($where['page'])) {
    	    $page = $where['page'];
    	    $size = isset($where['size']) ? $where['size'] : 10;
    	    $sql .= " order by id desc limit " . ($page-1)*$size . "," . $size;
    	}
    	
    	$data = R::getAll($sql);
    	foreach($data as $k=>$v){
    		if($v['return_time']){
    			$data[$k]['return_time']=date('Y-m-d H:m',$v['return_time']);
    		}
    		else{
    			$data[$k]['return_time']=='';
    		}
    		if($v['reply_id']){
    			$name=R::findOne("patientreceptionist", "id=" . $v['reply_id'] );
    			$data[$k]['reply_name']=$name['user_name'];
    		}
    		else{
    			$data[$k]['reply_name']='';
    		}
    		if($v['visit_method']){
    			switch($v['visit_method']){
    				case '1':$data[$k]['visit_method']='电话';break;
    				case '2':$data[$k]['visit_method']='短信';break;
    				case '3':$data[$k]['visit_method']='邮件';break;
    				case '4':$data[$k]['visit_method']='微信';break;
    				case '5':$data[$k]['visit_method']='QQ';break;
    				case '6':$data[$k]['visit_method']='应用消息';break;
    				default:$data[$k]['visit_method']='不明渠道';break;
    			}    			
    		}
    		else{
    			$data[$k]['visit_method']='不明渠道';
    		}
    	}
    	
    	return array('rows'=>$data,'ttl'=>$count);
    }
    
    /**
     * 获取来源信息
     * */
    public function getDataSource() {
        return $this->dealFindOperator('PatientDataSource');
    }
    
    /**
     * 按名称获取来源信息
     * */
    public function getDataByName() {
    	if(isset($_REQUEST['type'])&&$_REQUEST['type']){
    		switch($_REQUEST['type']){
    			case '1':$sql="select * from patientdatasource where title='".$_REQUEST['keywords']."' ";
    			break;
    			case '2':$sql="select * from patientreceptionist where user_name='".$_REQUEST['keywords']."' ";
    			break;    			
    			case '3':$sql="select * from patientdoctor where doctor_name='".$_REQUEST['keywords']."' ";
    			break;
    			case '4':$sql="select * from patientdepartment where department_name='".$_REQUEST['keywords']."' ";
    			break;
    			case '5':$sql="select * from patientdisease where disease_name='".$_REQUEST['keywords']."' ";
    			break;
    			case '6':$sql="select * from patientexamineitem where item_name='".$_REQUEST['keywords']."' ";
    			break;
    		}
    		
    	}     	  	
    	$result=count(R::getAll($sql));    	
    	return $result;
    }
    
    /**
     * 获取前台接待员
     * */
    public function getReceptionist() {
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : '50';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        return $this->dealFindOperator('PatientReceptionist', DTExpression::$sql . DTExpression::$limit);
    }
    
    /**
     * 获取前台接待员数据条数
     * */
    public function getReceptionistCount() {
        return R::count('patientreceptionist');
    }
    
    /**
     * 获取主治医生
     * */
    public function getDoctors() {
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        return $this->dealFindOperator('PatientDoctor', DTExpression::$sql . DTExpression::$limit);
    }
    
    /**
     * 获取主治医生数据条数
     * */
    public function getDoctorsCount() {
        return R::count('patientdoctor');
    }
    
    /**
     * 获取科室信息
     * */
    public function getDepartments() {
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        return $this->dealFindOperator('PatientDepartment', DTExpression::$sql . DTExpression::$limit);
    }
    
    /**
     * 获取科室信息数据条数
     * */
    public function getDepartmentsCount() {
        return R::count('patientdepartment');
    }
    
    /**
     * 获取疾病信息
     * */
    public function getDiseases() {
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        return $this->dealFindOperator('patientdisease', DTExpression::$sql . DTExpression::$limit);
    }
    
    /**
     * 获取疾病信息数据条数
     * */
    public function getDiseasesCount() {
        return R::count('patientdisease');
    }
    
    /**
     * 获取诊疗项目
     * */
    public function getExamineItems() {
        $is_usual = isset($_REQUEST['is_usual']) ? $_REQUEST['is_usual'] : '';
        if ($is_usual) {
            DTExpression::$sql .= " and is_usual = " . $is_usual;
        }
        
        if (!isset($_REQUEST['isPage'])) {
            return $this->dealFindOperator('PatientExamineItem', DTExpression::$sql);
        }
        
        $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
        if ($keyword) {
        	DTExpression::$sql .= " and item_name like '%{$keyword}%' ";
        }
        
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        return $this->dealFindOperator('PatientExamineItem', DTExpression::$sql . DTExpression::$limit);
    }
    
    /**
     * 获取诊疗项目数据条数
     * */
    public function getExamineItemsCount() {
        $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
        if ($keyword) {
            DTExpression::$sql .= " and item_name like '%{$keyword}%' ";
        }
        return R::count('patientexamineitem', DTExpression::$sql);
    }
    
    /**
     * 根据ids获取诊疗项目串
     * */
    public function getExaineItemsStrByIds($ids = '') {
        $sql = '';
        if ($ids) {
        	if (!is_array($ids)) {
        		$sql .= ' id in(' . $ids . ')';
        	} else {
        	    $sql .= ' id in(' . implode(',', $ids) . ')';
        	}
        }
        $data = $this->dealFindOperator('PatientExamineItem', $sql);
        $names = array();
        foreach ($data as $value) {
        	$names[$value->id] = $value->item_name;
        }
        return $names;
    }
	
    /**
     * 获取复诊信息
     * */
public function getReturnDiagnosisList($where = '') {
        $sql = 'select a.id as detail_id, a.*, d.patient_id from patientdiagnosisdetail as a';
        $sql .= ' left join patientcase as d ';
        $sql .= ' on (d.case_number=a.case_number and d.id=a.case_id) where 1=1 ';
        
        if (isset($where['case_number']) && $where['case_number']) {
        	$sql .= ' and a.case_number="' . $where['case_number'] . '"';
        }
        
        if (isset($where['pid']) && !empty($where['pid'])) {
            $sql .= ' and a.pid="' . $where['pid'] . '"';
        } else {
            $sql .= ' and a.pid="0"';
        }
        
        if (isset($where['detail_id']) && $where['detail_id']) {
            $sql .= ' and a.id="' . $where['detail_id'] . '"';
        }
        if(isset($where['bData'])&& $where['bData']&&isset($where['eDate'])&& $where['eDate']){
        	$sql .=' and visit_time between '.strtotime($where['bData']).' and '.strtotime($where['eDate']);
        }
        $sql .= ' and a.type=2 order by a.visit_time desc'; //复诊
       
        $count = count(R::getAll($sql));
        
        if (isset($where['page'])) {
            $page = $where['page'];
            $size = isset($where['size']) ? $where['size'] : 10;
            $sql .= " limit " . ($page-1)*$size . "," . $size;
        }  
    
        $data = R::getAll($sql);        
        foreach ($data as $k => $v) {
            if ($v['doctor_id']) {
                $doctorObj = R::findOne('patientdoctor', 'id=' . $v['doctor_id']);
                $data[$k]['doctor_name'] = $doctorObj['doctor_name'];
            } else {
                $data[$k]['doctor_name'] = '';
            }
            if($v['receptionist_id']){
            	$receptionObj= R::findOne('patientreceptionist', 'id=' . $v['receptionist_id']);
            	$data[$k]['user_name'] = $receptionObj['user_name'];
            }else {
                $data[$k]['user_name'] = '';
            }
        	if($v['disease_type']){
            	$diseaseObj= R::findOne('patientdisease', 'id=' . $v['disease_type']);            	
            	$data[$k]['disease_name'] = $diseaseObj['disease_name'];
            }else {
                $data[$k]['disease_name'] = '';
            }
        	if($v['visit_time'] && $v['visit_time']>0){            
            	$data[$k]['visit_time'] = date('Y-m-d',$v['visit_time']);
            }else {
                $data[$k]['visit_time'] = '';
            }
        	if($v['return_time'] && $v['return_time']>0){            
            	$data[$k]['return_time'] =  date('Y-m-d',$v['return_time']);
            }else {
                $data[$k]['return_time'] = '';
            }
            $feeObj = R::findOne('patientdiagnosisfee', 'detail_id=' . $v['detail_id']);
            $data[$k]['real_price'] = $feeObj ? $feeObj['real_price'] : 0;
            $data[$k]['current_price'] = $feeObj ? $feeObj['current_price'] : 0;
            $data[$k]['balance'] = $feeObj ? $feeObj['balance'] : 0;
            $data[$k]['pay_time'] = $feeObj ? $feeObj['pay_time'] : 0;
            
            
            if ($v['examine_items']) {
        	    $data[$k]['examine_items_name'] = $this->getExaineItemsStrByIds($v['examine_items']);
            } else {
                $data[$k]['examine_items_name'] = '';
            }
        }
    	return array('rows'=>$data,'ttl'=>$count);
    }
    
    /**
     * 删除就诊详情
     * */
    public function delReturnDiagnosisDetail($ids = array()) {
        $beans = R::batch('patientdiagnosisdetail', $ids);
        $feeIds = $detailIds = $visitIds = array();        
        if (!empty($ids)) {
            foreach ($ids as $detailId) {
                //删除patientdiagnosisfee表中内容
                $fee = R::findOne('patientdiagnosisfee',"detail_id=".$detailId);
                if (!empty($fee->id)) $feeIds[] = $fee->id;
        
                //删除patientreturnvisit表中相关内容
                $visit = R::findOne('patientreturnvisit',"detail_id=".$detailId);
                if (!empty($visit->id)) $visitIds[] = $visit->id;
            }
        }
        
        $this->beginTrans(); 
        
        try{
            $fee = R::loadAll('patientdiagnosisfee', $feeIds);
            R::trashAll($fee);
            $visit = R::loadAll('patientreturnvisit', $visitIds);
            R::trashAll($visit);        
            R::trashAll($beans);
            
            
            
        }catch (Exception $e){
            $this->rollbackTrans();
            $this->commitTrans();
            return false;
        }        
       
        return false;
    }
    
    /**
     * 删除复诊记录后重新累加余额
     */
    public function addWholeMoney($pid,$cnum){
    	//$sql='select * from patientdiagnosisfee where case_number='.$cnum.' order by pay_time asc';
    	DTExpression::eq('case_number', $cnum);
    	DTOrder::asc('pay_time');
    	$result=R::findAll('patientdiagnosisfee',DTExpression::$sql . DTOrder::$sql,DTExpression::$params);
    	//$result=R::getAll($sql);     	
    	$current_price=0;   
    	$real_price=0;
    	$left_money=0;
    	$i=0;
    	$arr=array();
    	foreach($result as $v){
    		//$feetBean = R::load('patient', $v['id']);    		  		
    		$real_price+=$v['real_price'];  
    		$current_price+=$v['current_price'];    		
			
			if($i==0){
				$balance=$v['real_price']-$v['current_price'];	
			}else{
				$balance=$left_money+$v['real_price']-$v['current_price'];	
			}
    		$i++;		
    		$left_money+=$balance;
    		$v->balance = $balance;
    		$arr[]=$v;			
    	}       	
    	try{
    		//修改-余额写进账户
    		$patientBean = R::load('patient', $pid);
    		$patientBean->money = $real_price-$current_price;
    		$id = R::store ( $patientBean );
    		
    		//更新所有的当前用户的所有单笔消费余额信息
    		$id = R::storeAll ( $arr );
    		
    	}catch (Exception $e){
            
            return false;
        } 	
    	$money=$real_price-$current_price;
    	return $money;
    	
    }
    
    
	/**
	 * 删除表...
	 */
	public function dropTable($data){
		if(is_array($data)){
			foreach ($data as $value){
				R::exec($value);
			}
		}else{
			R::exec($data);
		}
		return true;
	}
	
	/**
	 * 根据用户名获取患者信息
	 * */
	public function getPatientByName($username) {
	    $patientBean = R::findOne('patient',"username='".$username."'");
	    $patient = new Patient();
	    $patient->generateFromRedBean($patientBean);
	    return $patient;
	}
	
	/**
	 * 获取根据id患者基本信息
	 * */
	public function getPatientById($id) {
	    $patientBean = R::load('patient', $id);
	    $patient = $patientBean->getProperties();
	    //$patient['money'] = intval($patient['money']);
	    return $patient;
	}
	
	/**
	 * 获取根据id患者基础信息
	 * */
	public function getPatientInfoById($id) {
	    $patientBean = R::findOne('patient',"id='".$id."'");
	    $patient = new Patient();
	    $patient->generateFromRedBean($patientBean);
	    return $patient;
	}
	
	/**
	 * 根据id判断是某个医生的新客户还是老客户
	 * */
	public function checkIsNewByPid($patient_id, $doctor_id = '') {
	    $sql = 'select d.case_number from patientdiagnosisdetail as d inner join patientcase as c';
	    $sql .= ' on (d.case_number=c.case_number and d.case_id=c.id and d.type=1 and c.patient_id=' . $patient_id . ') where 1=1 ';
	    if ($doctor_id) {
	        $sql .= ' and d.doctor_id=' . $doctor_id;
	    }
	    $result = R::getAll($sql);
	    if (count($result)>1) {
	    	return false;
	    }
		return true;
	}
	
	/**
	 * 根据id判断是否是初诊
	 * */
	public function checkVisitStatusByPid($patient_id, $case_number, $type = '1') {
	    $sql = 'select d.case_number from patientdiagnosisdetail as d inner join patientcase as c';
	    $sql .= ' on (d.case_number=c.case_number and d.case_id=c.id) where d.type=' . $type . ' and c.patient_id=' . $patient_id;
	    $sql .= ' and d.case_number=' . $case_number;
	    $result = R::getAll($sql);
	    if (empty($result)) {
	        return false;
	    }
	    return true;
	}
	
	/**
	 * 获取统计数据详情
	 * */
	public function getStatDetail($where = '') {
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
	    	case '1': //就诊人数
	    	    $type_id = isset($where['type_id']) ? $where['type_id'] : '';
	    	    return $data = $this->getStatDetailByPeople($type_id, $start, $end, $where);
	    	    break;
	    	case '2': //周及就诊时间段
	    	    $data = $this->getStatByWeek($start, $end);
	    	    break;
	    	case '3': //前台接诊
	    	    $receptionist_id = isset($where['receptionist_id']) ? $where['receptionist_id'] : '';
	    	    return $data = $this->statDetailByReceptionist($receptionist_id, $start, $end, $where);
	    	    break;
	        case '4': //来源
	            $data = $this->statBySource($start, $end);
	    	    break;
	    	case '5': //医生接诊
	    	    $doctor_id = isset($where['doctor_id']) ? $where['doctor_id'] : '';
	    	    return $data = $this->statDetailByDoctor($doctor_id, $start, $end, $where);
	    	    break;
	    	case '6': //科室疾病
	    	    break;
	    	case '7': //财务
	    	    break;
	    	case '8': //治疗方案
	    	    break;
	    	default:
	    	    break;
	    }
	    
	    if(empty($data)){
	        return array('statu'=>false,'msg'=>'暂无详情数据！');
	    }
	    return array('statu'=>true,'data'=>$data);
	}
	
	/**
	 * 按时间统计
	 * */
	public function statByDate($where) {
		$action = isset($where['action']) ? $where['action'] : 'people';
		$start = isset($where['start']) ? $where['start'] : date('Y-m-01', strtotime(date("Y-m-d")));
		$start = strtotime($start . ' 00:00:00');
		$end = isset($where['end']) ? strtotime($where['end'] . ' 23:59:59') : time();
		
		switch ($action) {
			case 'people':
			    return $this->getPeopleByDate($start, $end);
			    break;
			case 'receptionist':
			    return $this->getRecptionistByDate($start, $end);
			    break;
			case 'source':
			    return $this->getSourceByDate($start, $end);
			    break;
			case 'doctor':
			    return $this->getDoctorByDate($start, $end);
			    break;
			case 'money':
			    return $this->getMoneyByDate($start, $end);
			    break;
			default:
			    break;
		}
		return false;
	}
	
	/**
	 * 按时间获取每天收入金额
	 * */
	protected function getMoneyByDate($start, $end) {
	    $return = $this->initArray($start, $end, array('每日收入'));
	 
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select total_money,daytime from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $result = R::getAll($sql);	
	    foreach ($result as $key=>$value) {
	            $return[$value['daytime']]['每日收入'] = (int)$value['total_money'];
	    }
	
	    return $return;
	}
	
	/**
	 * 按时间获取医生每天接待到诊的客户量
	 * */
	protected function getDoctorByDate($start, $end) {
	    $sql = 'select id, doctor_name from patientdoctor';
	    $result = R::getAll($sql);
	    $columns = array();
	    foreach ($result as $value) {
	        if ($value['doctor_name']) {
	            $columns[$value['id']] = $value['doctor_name'];
	        }
	    }
	    $return = $this->initArray($start, $end, $columns);
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select doctor,daytime from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resDoctor = R::getAll($sql);
		if($resDoctor){  	
			foreach ($resDoctor as $key=>$value) {
				$r_value = unserialize($value['doctor']);						
				foreach($r_value as $k=>$v){
					$return[$value['daytime']][$columns[$k]] = (int)$v['customer_1']+(int)$v['customer_2'];
				}
			}
		}
	
	    return $return;
	}
	
	/**
	 * 按时间获取来源每天接待到诊的客户量
	 * */
	protected function getSourceByDate($start, $end) {
	    $sql = 'select id, title from patientdatasource';
	    $result = R::getAll($sql);
	    $columns = array();
	    foreach ($result as $value) {
	        if ($value['title']) {
	            $columns[$value['id']] = $value['title'];
	        }
	    }
	    $return = $this->initArray($start, $end, $columns);
	    
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select source,daytime from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resSource = R::getAll($sql);
		if($resSource){  	
			foreach ($resSource as $key=>$value) {
				$r_value = unserialize($value['source']);						
				foreach($r_value as $k=>$v){
					$return[$value['daytime']][$columns[$k]] = (int)$v['examine'];
				}
			}
		}
	    return $return;
	}
	
	/**
	 * 按时间获取前台每天接待到诊的客户量
	 * */
	protected function getRecptionistByDate($start, $end) {
	    $sql = 'select id, user_name from patientreceptionist';
	    $result = R::getAll($sql);
	    $columns = array();
	    foreach ($result as $value) {
	    	$columns[$value['id']] = $value['user_name'];
	    }
	    
	    $return = $this->initArray($start, $end, $columns);
	    
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select reception,daytime from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $res = R::getAll($sql);
		if($res){  	
			foreach ($res as $key=>$value) {
				$r_value = unserialize($value['reception']);						
				foreach($r_value as $k=>$v){
					$return[$value['daytime']][$columns[$k]] = (int)$v['deal_1']+(int)$v['deal_2'];
				}
			}
		}
	     
	    return $return;
	}
	
	/**
	 * 按时间获取每天就诊数据
	 * */
	public function getPeopleByDate($start, $end) {
	    //初始化数据
	    $columns = array( 'old', 'new');
	    $return = $this->initArray($start, $end, $columns);	
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select daytime,customer_1_sex_1,customer_1_sex_2,customer_2_sex_1,customer_2_sex_2 from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultVisit = R::getAll($sql);

	    //就诊人数
 		foreach ($resultVisit as $key=>$value) {
			$return[$value['daytime']]['old'] = (int)$value['customer_2_sex_1'] + (int)$value['customer_2_sex_2'];
			$return[$value['daytime']]['new'] = (int)$value['customer_1_sex_1'] + (int)$value['customer_1_sex_2'];					
	    }
	    return $return;	   
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
	 * 医生接诊详情
	 * */
	public function statDetailByDoctor($doctor_id, $start, $end, $where = '') {
		$sql = 'select u.username,u.gender,u.age ,count(*) as visit_num,FROM_UNIXTIME(d.visit_time , \'%Y-%m-%d\' ) as visit_time from patientdiagnosisdetail as d';
	    $sql .= ' inner join patient as u';
	    $sql .= ' on d.case_number=u.case_number where 1=1 ';
	    $sql .= ' and d.doctor_id=' . $doctor_id;
	    if ($start && $end) {
	        $sql .= ' and d.visit_time between ' . $start . ' and ' . $end;
	    }

	    $sql .= ' group by u.id'; 
	    
	    $count = count(R::getAll($sql));
	    
	    if (isset($where['page'])) {
	        $page = $where['page'];
	        $size = isset($where['size']) ? $where['size'] : 10;
	        $sql .= " limit " . ($page-1)*$size . "," . $size;
	    }
	    
	    $data = R::getAll($sql);	    
	    return array('rows'=>$data, 'ttl'=>$count);
	}
	/**
	 * 前台接诊详情
	 * */
	public function statDetailByReceptionist($receptionist_id, $start, $end, $where = '') {		
	    $sql = 'select u.id as user_id, u.username, u.gender,c.is_finished,c.reason,u.age,d.receptionist_id,';
	    $sql .= ' FROM_UNIXTIME(d.visit_time , \'%Y-%m-%d\' ) as visit_time from patientdiagnosisdetail as d';
	    $sql .= ' inner join patientcase as c';
	    $sql .= ' inner join patient as u';
	    $sql .= ' inner join patientdiagnosisfee as f';
	    $sql .= ' on (d.case_number=c.case_number and c.id=d.case_id and c.patient_id=u.id and d.id=f.detail_id) where 1=1 ';
	    $sql .= ' and d.receptionist_id=' . $receptionist_id;
	    if ($start && $end) {
	        $sql .= ' and d.visit_time between ' . $start . ' and ' . $end;
	    }
	    $sql .= ' group by c.patient_id, c.is_finished';
	    
	    $count = count(R::getAll($sql));
	     
	    if (isset($where['page'])) {
	        $page = $where['page'];
	        $size = isset($where['size']) ? $where['size'] : 10;
	        $sql .= " limit " . ($page-1)*$size . "," . $size;
	    }
	     
	    $data = R::getAll($sql);
	    
		return array('rows'=>$data, 'ttl'=>$count);
	}	
	
	/**
	 * 获取统计详情-就诊人数
	 * */
	public function getStatDetailByPeople($type_id, $start, $end, $where = '') {
		if (!$type_id) {
			throw new Exception('参数有误！');
		}
		if (isset($where['ids']) && empty($where['ids'])) {
			return array('rows'=>array(), 'ttl'=>0);
		}
		$user_ids = explode(',', $where['ids']);
	    $sql = 'select distinct(u.id) as user_id, u.username,u.gender,u.birthday,c.case_number,u.age ';
	    $sql .= ' from patient as u';
	    $sql .= ' inner join patientcase as c';
	    $sql .= ' on (u.id=c.patient_id) where 1=1 and u.id in(' . implode(',', $user_ids) . ')';
	    $count = count(R::getAll($sql));
	     
	    if (isset($where['page'])) {
	        $page = $where['page'];
	        $size = isset($where['size']) ? $where['size'] : 10;
	        $sql .= " limit " . ($page-1)*$size . "," . $size;
	    }
	     
	    $data = R::getAll($sql);
	    
		return array('rows'=>$data, 'ttl'=>$count);
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
	    	case '1': //就诊人数
	    	    $type_id = isset($_REQUEST['type_id']) ? $_REQUEST['type_id'] : '';
	    	    if ($type_id) {
	    	        $data = $this->getPeopleStatByDisease($start, $end, $type_id);
	    	    } else {
	    	        $data = $this->getStatByPeople($start, $end);
	    	    }
	    	    break;
	    	case '2': //周及就诊时间段
	    	    $data = $this->getStatByWeek($start, $end);
	    	    break;
	    	case '3': //前台接诊
	    	    $data = $this->statByReceptionist($start, $end);
	    	    break;
	    	case '4': //来源
	    	    $data = $this->statBySource($start, $end);
	    	    break;
	    	case '5': //医生接诊
	    	    $data = $this->statByDoctor($start, $end);
	    	    break;
	    	case '6': //科室疾病
	    	    $flag = isset($_REQUEST['flag']) ? $_REQUEST['flag'] : 'department';
	    	    if ('department' == $flag) {
	    	        $data = $this->statByDepartment($start, $end);
	    	    } elseif ('disease' == $flag) {
	    	        $data = $this->statByDisease($start, $end);
	    	    } else {
	    	    	//按月份
	    	        $data = $this->statByMonth($start, $end);
	    	    }
	    	    break;
	    	case '7': //财务
	    	    $flag = isset($_REQUEST['flag']) ? $_REQUEST['flag'] : 'department';
	    	    if ('department' == $flag) {
	    	        $data = $this->statByDepartment($start, $end);
	    	    } elseif ('disease' == $flag) {
	    	        $data = $this->statByDisease($start, $end);
	    	    } else{
	    	        //按医生
	    	        $data = $this->statByDoctor($start, $end);
	    	    }
	    	    break;
	    	case '8': //治疗项目
	    	    $data = $this->statByExamineItems($start, $end);
	    	    break;
	    	default:
	    	    break;
	    }
	    return $data;
	}
	
	/**
	 * 诊疗项目
	 * */
	public function statByExamineItems($start='', $end='') {
	    $data = array();
	    $sql = 'select id, item_name from patientexamineitem';
	    $result = R::getAll($sql);
	    foreach ($result as $value) {
	        if ($value['id'] == 0) continue;
	        if (!isset($data[$value['id']])) {
	            $data[$value['id']]['item_id'] = $value['id'];
	            $data[$value['id']]['item_name'] = $value['item_name'];
	            $data[$value['id']]['male'] = 0;
	            $data[$value['id']]['female'] = 0;
           
	            $data[$value['id']]['money'] = 0;
	            $data[$value['id']]['num'] = 0;
	        }
	    }

		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select daytime,project from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultProject = R::getAll($sql);
	    $total_money = 0;
		if($resultProject){
			foreach ($resultProject as $key=>$value) {
				$project = unserialize($value['project']);	
				if (is_array($project) && !empty($project))	{
				    foreach($project as $id=>$v){
				        if ($id == 0) continue;
				        $project_ids = explode(',', $id);
				        foreach ($project_ids as $k) {
				            $data[$k]['male'] += (int)$v['sex_1'];
				            $data[$k]['female'] += (int)$v['sex_2'];
				            $data[$k]['money'] +=$v['revenue'];
				            $data[$k]['num'] += (int)$v['sex_1']+(int)$v['sex_2'];
				        }
				        $total_money += $v['revenue'];
				    }
				}					
			}
		}
	    
        //分页
        if (isset($_REQUEST['page']) && $_REQUEST['page']) {
            $ttl = count($data);
            $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
            $data = array_slice($data, $start, intval($_REQUEST['size']));
            return array('rows'=>array_values($data), 'ttl'=>$ttl);
        }
	    return array_values($data);
	}
	
	/**
	 * 科室
	 * */
	public function statByDepartment($start, $end) {
	    $data = array();
	    $sql = 'select id, department_name from patientdepartment';
	    $result = R::getAll($sql);
	    foreach ($result as $value) {
	        if (!isset($data[$value['id']])) {
	            $data[$value['id']]['department_name'] = $value['department_name'];
	            $data[$value['id']]['new_num'] = 0;
	            $data[$value['id']]['old_num'] = 0;
	            $data[$value['id']]['re_visit'] = 0;
	            $data[$value['id']]['income'] = 0;
	            
	            $data[$value['id']]['money'] = 0;
	            $data[$value['id']]['num'] = 0;
	        }
	    }

		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select daytime,department from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultDepartment = R::getAll($sql);
	    $total_money = 0;
		if($resultDepartment){
			foreach ($resultDepartment as $key=>$value) {
					$department = unserialize($value['department']);						
				foreach($department as $k=>$v){
				    if ($k == 0) continue;
						$data[$k]['new_num'] += (int)$v['customer_1'];
						$data[$k]['old_num'] += (int)$v['customer_2'];		
						$data[$k]['re_visit'] += (int)$v['visit'];
						$data[$k]['money'] +=$v['revenue'];
						$data[$k]['num'] += (int)$v['customer_1']+(int)$v['customer_2'];
						$total_money += $v['revenue'];
				}
			}
		}

	   	
	    //金额占所有科室金额的百分比及平均消费
	    foreach ($data as $k => $v) {	    	
	        $percent = ($total_money!=0) ? round($v['money']/$total_money, 3)*100 : 0;
	        $data[$k]['percent'] = $percent . '%';
	        $data[$k]['average']=($v['num']!=0) ? round($v['money']/$v['num']) : round($v['money']);
	    }	    
	    //分页
	    if (isset($_REQUEST['page']) && $_REQUEST['page']) {
	        $ttl = count($data);
	        $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
	        $data = array_slice($data, $start, intval($_REQUEST['size']));
	        return array('rows'=>array_values($data), 'ttl'=>$ttl);
	    }
	    
	    return array_values($data);
	}
	
	/**
	 * 疾病
	 * */
	public function statByDisease($start, $end) {
	    $data = array();
	    $sql = 'select id, disease_name from patientdisease';
	    $result = R::getAll($sql);
	    foreach ($result as $value) {
	        if (!isset($data[$value['id']])) {
	            $data[$value['id']]['disease_name'] = $value['disease_name'];
	            $data[$value['id']]['new_num'] = 0;
	            $data[$value['id']]['old_num'] = 0;
	            $data[$value['id']]['re_visit'] = 0;
	            $data[$value['id']]['income'] = 0;
	            
	            $data[$value['id']]['money'] = 0;
	            $data[$value['id']]['num'] = 0;
	        }
	    }

		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select daytime,disease from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultDisease = R::getAll($sql);
	    $total_money = 0;
		if($resultDisease){
			foreach ($resultDisease as $key=>$value) {
					$disease = unserialize($value['disease']);						
				foreach($disease as $k=>$v){
				    if ($k == 0) continue;
						$data[$k]['new_num'] += (int)$v['customer_1'];
						$data[$k]['old_num'] += (int)$v['customer_2'];		
						$data[$k]['re_visit'] += (int)$v['visit'];
						$data[$k]['money'] +=$v['revenue'];
						$data[$k]['num'] += (int)$v['customer_1']+(int)$v['customer_2'];
						$total_money += $v['revenue'];
				}
			}
		}
	    //金额占所有疾病金额的百分比	    
	    foreach ($data as $k => $v) {
	        $percent = ($total_money!=0) ? round($v['money']/$total_money, 3)*100 : 0;
	    	$data[$k]['percent'] = $percent . '%';
	        $data[$k]['average']=($v['num']!=0) ? round($v['money']/$v['num']) : round($v['money']);
	    }
	   
	    //分页
	    if (isset($_REQUEST['page']) && $_REQUEST['page']) {
	        $ttl = count($data);
	        $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
	        $data = array_slice($data, $start, intval($_REQUEST['size']));
	        return array('rows'=>array_values($data), 'ttl'=>$ttl);
	    }
	    return array_values($data);
	}
	
	/**
	 * 疾病和月份
	 * */
	public function statByMonth($start, $end) {
	    $data = array();
	    $sql = 'select id, disease_name from patientdisease';
	    $result = R::getAll($sql);	
	    foreach ($result as $key=>$value) {
	        if ($value['id']) {

					//初始化1-12月份的值
				$keys = array('January', 'February', 'March', 'April','May',
					'June', 'July', 'August', 'September', 'October', 'November', 'December'
				);
				$data[$value['id']] = array_fill_keys($keys, 0);
				$data[$value['id']]['disease_name'] = $value['disease_name'];
				$data[$value['id']]['disease_id'] = $value['id'];
	        }
	    }
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select daytime,disease from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultDisease = R::getAll($sql);
		if($resultDisease){
			foreach ($resultDisease as $key=>$value) {
					$month = date('F', strtotime($value['daytime']));
					$disease = unserialize($value['disease']);						
    				foreach($disease as $k=>$v){
    				    if ($k != 0)
    					    $data[$k][$month] += (int)$v['customer_1']+(int)$v['customer_2'];
    				}
			}
		}
	
	    //分页
	    if (isset($_REQUEST['page']) && $_REQUEST['page']) {
	        $ttl = count($data);
	        $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
	        $data = array_slice($data, $start, intval($_REQUEST['size']));
	        return array('rows'=>array_values($data), 'ttl'=>$ttl);
	    }
	    return array_values($data);
	}
	
	/**
	 * 医生接诊
	 * */
	public function statByDoctor($start = '', $end = '') {	
	    $data = array();
	    $sql = 'select id, doctor_name from patientdoctor';
	    $result = R::getAll($sql);
	    foreach ($result as $value) {
	        if ($value['doctor_name']) {
	            $data[$value['id']]['doctor_name'] = $value['doctor_name'];
	            $data[$value['id']]['new_num'] = 0;
	            $data[$value['id']]['old_num'] = 0;	            
	            $data[$value['id']]['re_visit'] = 0;
	            $data[$value['id']]['doctor_id'] = $value['id'];
	            $data[$value['id']]['money'] = 0;
	            $data[$value['id']]['num'] = 0;
				//$data[$value['id']]['first_visit'] = 0;
	        }
	    }

		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select daytime,doctor from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultDoctor = R::getAll($sql);
	    $total_money = 0;
		if($resultDoctor){
			foreach ($resultDoctor as $key=>$value) {
					$doctor = unserialize($value['doctor']);						
				foreach($doctor as $k=>$v){
						$data[$k]['new_num'] += (int)$v['customer_1'];
						$data[$k]['old_num'] += (int)$v['customer_2'];		
						$data[$k]['re_visit'] += (int)$v['visit'];
						$data[$k]['money'] += $v['revenue'];
						$data[$k]['num'] += (int)$v['customer_1']+(int)$v['customer_2'];
						//$data[$k]['first_visit'] += (int)$v['customer_1']+(int)$v['customer_2']-(int)$v['visit'];
						$total_money += $v['revenue'];
				}
			}
		}
	    //金额占所有医生金额的百分比
	    foreach ($data as $k => $v) {
	        $percent = ($total_money!=0) ? round($v['money']/$total_money, 3)*100 : 0;
	        $data[$k]['percent'] = $percent . '%';
	        $data[$k]['average']=($v['num']!=0) ? round($v['money']/$v['num']) : round($v['money']);
	    }	    
	    //分页
	    if (isset($_REQUEST['page']) && $_REQUEST['page']) {
	        $ttl = count($data);
	        $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
	        $data = array_slice($data, $start, intval($_REQUEST['size']));
	        return array('rows'=>array_values($data), 'ttl'=>$ttl);
	    }
	    return array_values($data);
	}
	
	/**
	 * 来源统计
	 * */
	public function statBySource($start = '', $end = '') {
	
	    $data = array();
	    $sql = 'select id, title from patientdatasource';
	    $result = R::getAll($sql);
	    foreach ($result as $value) {
	        if ($value['title']) {
	            $data[$value['id']]['visit_num'] = 0;
	            $data[$value['id']]['income'] = 0;
	            $data[$value['id']]['total_num'] = 0;	            
	            $data[$value['id']]['title'] = $value['title'];
	            $data[$value['id']]['source_id'] = $value['id'];
	        }
	    }
		$total_money = 0;    
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select source from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultSource = R::getAll($sql);
		if($resultSource){  	
			foreach ($resultSource as $key=>$value) {
					$source = unserialize($value['source']);						
				foreach($source as $k=>$v){
						$data[$k]['visit_num'] += $v['examine'];
						$data[$k]['income'] += $v['revenue'];			
						$data[$k]['total_num'] += $v['examine'];
						$total_money += $v['revenue'];
				}
			}
		}
		
	    foreach ($data as $k => $v) {
	        //每种来源的收入/总收入
	        if($v['title']==''||$v['title']=='undefined'){
	        	$data[$k]['title']='己删除项';
	        }
	        $percent = ($total_money!=0) ?($v['income']/$total_money)*100 : 0 ;
	        $data[$k]['percent'] = round($percent, 1) . '%';
	    }	    

	    
	    //分页
	    if (isset($_REQUEST['page']) && $_REQUEST['page']) {
	        $ttl = count($data);
	        $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
	        $data = array_slice($data, $start, intval($_REQUEST['size']));
	        return array('rows'=>array_values($data), 'ttl'=>$ttl);
	    }
	    return array_values($data);
	}
	
	/**
	 * 前台接诊统计
	 * */
	public function statByReceptionist($start = '', $end = '') {
	    $data = array();
	    $sql = 'select id, user_name from patientreceptionist';
	    $result = R::getAll($sql);
	    foreach ($result as $value) {
	        if ($value['id']) {
	            $data[$value['id']]['user_name'] = $value['user_name'];
	            $data[$value['id']]['receptionist_id'] = $value['id'];
	            $data[$value['id']]['deal_num'] = 0;	            
	            $data[$value['id']]['not_deal_num'] = 0;
	        }
	    }
		
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select reception from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultReception = R::getAll($sql);
		if($resultReception){  	
			foreach ($resultReception as $key=>$value) {
					$reception = unserialize($value['reception']);						
				foreach($reception as $k=>$v){
						$data[$k]['deal_num'] += $v['deal_1'];
						$data[$k]['not_deal_num'] += $v['deal_2'];
				}
			}
		}
	    
	    //分页
	    if (isset($_REQUEST['page']) && $_REQUEST['page']) {
	        $ttl = count($data);
	        $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
	        $data = array_slice($data, $start, intval($_REQUEST['size']));
	        return array('rows'=>array_values($data), 'ttl'=>$ttl);
	    }
	    return array_values($data);
	}
	
	/**
	 * 周及就诊时间段
	 * */
	public function getStatByWeek($start = '', $end = '') {
	    $data = array();
	    //就诊人数
		$where = array('start_time'=>date('Y-m-d',$start), 'end_time'=>date('Y-m-d',$end));
		$patientData = new PatientDataDAO();
		$result = $patientData->query($where);
		
	    $init = array('Monday' => '','Tuesday' => '','Wednesday' => '', 'Thursday' => '','Friday' => '','Saturday' => '','Sunday' => '');
	    $week = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	    $data[0] = $data[1] = $data[2] = $data[3] = $init;
	    $data[0]['title'] = '上午';
	    $data[1]['title'] = '下午';
	    $data[2]['title'] = '晚上';
	    $data[3]['title'] = '总计';
		$am_male = $pm_male = $night_male = $total_male = $am_female = $pm_female = $night_female = $total_female = 0;
	    if ($result) {
    	    foreach ($result as $k=>$v) {
				unset($v->reception,$v->source,$v->department,$v->project,$v->disease,$v->doctor,$v->age);	
				$a_male[$v->week] = isset($v->day_1_sex_1) ? (int)$v->day_1_sex_1 : 0;
				$p_male[$v->week] = isset($v->day_2_sex_1) ? (int)$v->day_2_sex_1 : 0;
				$n_male[$v->week] = isset($v->day_3_sex_1) ? (int)$v->day_3_sex_1 : 0;
				$t_male[$v->week] = $a_male[$v->week] + $p_male[$v->week] + $n_male[$v->week];
				
				$a_female[$v->week] = isset($v->day_1_sex_2) ? (int)$v->day_1_sex_2 : 0;
				$p_female[$v->week] = isset($v->day_2_sex_2) ? (int)$v->day_2_sex_2 : 0;
				$n_female[$v->week] = isset($v->day_3_sex_2) ? (int)$v->day_3_sex_2 : 0;
				$t_female[$v->week] = $a_female[$v->week] + $p_female[$v->week] + $n_female[$v->week];
    	    }
				for($i=0;$i<7;$i++){
					$am_male = isset($a_male[$i]) ? $a_male[$i] : 0;
					$pm_male = isset($p_male[$i]) ? $p_male[$i] : 0;
					$night_male = isset($n_male[$i])? $n_male[$i] : 0;
					$total_male = isset($t_male[$i])? $t_male[$i] : 0;
					
					$am_female = isset($a_female[$i])? $a_female[$i] : 0;
					$pm_female = isset($p_female[$i])? $p_female[$i] : 0;
					$night_female = isset($n_female[$i])? $n_female[$i] : 0;
					$total_female = isset($t_female[$i])? $t_female[$i] : 0;
					//上午
					$data[0][$week[$i]] = '男：' . $am_male . '&nbsp;<b>/</b>&nbsp;' . '女：' . $am_female;
					//下午
					$data[1][$week[$i]] = '男：' . $pm_male . '&nbsp;<b>/</b>&nbsp;' . '女：' . $pm_female;
					//晚上
					$data[2][$week[$i]] = '男：' . $night_male . '&nbsp;<b>/</b>&nbsp;' . '女：' . $night_female;					
					//总计
					$data[3][$week[$i]] = '男：' . $total_male . '&nbsp;<b>/</b>&nbsp;' . '女：' . $total_female;
				}
	    } else {
			$fill = array('am'=>array('male'=>array(),'female'=>array()));
			$tmp = array('Monday'=>$fill,'Tuesday'=>$fill,'Wednesday'=>$fill,'Thursday'=>$fill,'Friday'=>$fill,'Saturday'=>$fill,'Sunday'=>$fill);
	        foreach ($tmp as $k=>$v) {
	            //上午
	            $data[0][$k] = '男：0&nbsp;<b>/</b>&nbsp;' . '女：0';
	            //下午
	            $data[1][$k] = '男：0&nbsp;<b>/</b>&nbsp;' . '女：0';
	            //晚上
	            $data[2][$k] = '男：0&nbsp;<b>/</b>&nbsp;' . '女：0';
	            //总计
	            $data[3][$k] = '男：0&nbsp;<b>/</b>&nbsp;' . '女：0';
	        }
	    }
	    return array_values($data);
	}
	
	/**
	 * 就诊人数统计
	 * */
	public function getStatByPeople($start = '', $end = '') {
	    $data = array();
		
		$where = array('start_time'=>date('Y-m-d',$start), 'end_time'=>date('Y-m-d',$end));
		$patientData = new PatientDataDAO();
		$visit = $patientData->getVisitByTime($where);	
	    $attributes = array('old'=>'老客户', 'new'=>'新客户');
	    $index = 0;
		$i = 2;
	    foreach ($attributes as $key => $title) {
	        $data[$index]['title'] = $title;
	        $data[$index]['male'] = isset($visit['customer_'.$i.'_sex_1']) ? (int)$visit['customer_'.$i.'_sex_1'] : 0;
	        $data[$index]['female'] = isset($visit['customer_'.$i.'_sex_2']) ? (int)$visit['customer_'.$i.'_sex_2'] : 0;	
	        $data[$index]['num']   = ($index==0) ? (int)($visit['customer_2_sex_1']+$visit['customer_2_sex_2']) : (int)($visit['customer_1_sex_1']+$visit['customer_1_sex_2']);
	        $data[$index]['sex']="男：".$data[$index]['male']."&nbsp;<b>/</b>&nbsp;"."女：".$data[$index]['female'];
			if($index==0){
				$pids_2 = $visit['pids_2'];
				$pids_2 = preg_replace('/,,/', ',', $pids_2);
				$pids_2 = preg_replace('/(^,|,$)/', '', $pids_2);
				$data[$index]['ids'] = $pids_2;
			}else{
				$pids_1 = $visit['pids_1'];
				$pids_1 = preg_replace('/,,+/', ',', $pids_1);
				$pids_1 = preg_replace('/(^,|,$)/', '', $pids_1);
				$data[$index]['ids'] = $pids_1;				
			}
	        $data[$index]['type'] = $index+1;
			$i--;
	    	$index++;
	    }
	    $data['total_money']=$visit['total_money'] ? $visit['total_money'] : 0;
	    $data['total_num']=$visit['total_num'] ? $visit['total_num'] : 0;
		return array_values($data);
	}

	
	
	// {{{ 就诊人数统计，详细部分   //原综合统计，按日期统计 
	protected function getVisitPeople($start = '', $end = '') {  
		$sql = " select p.id as case_id, p.patient_id, count(distinct(p.patient_id)) as num, p.add_time, p.case_number";
		$sql .= ", u.username, u.gender, u.birthday, u.age";
		$sql .= " from `patientcase` as p";
		$sql .= " left join `patient` as u on (p.patient_id=u.id) where 1=1 ";
		if ($start && $end) {
		    $sql .= ' and p.add_time between ' . $start . ' and ' . $end;
		}
		$sql .= " group by p.patient_id";
		
		$result = R::getAll($sql);
		$data = array('total_num'=>0);
		$data['old'] = array('total_num'=>0);
		foreach ($result as $value) {
			$data['total_num'] += $value['num'];
			$data['ids'][] = $value['patient_id'];
			$sex_key = ($value['gender'] == '1') ? 'female' : 'male';
			if (!isset($data[$sex_key]['num'])) {
			    $data[$sex_key]['num'] = 0;
			}
			$data[$sex_key]['num'] += $value['num'];
			$data[$sex_key]['case_ids'][] = $value['case_id'];
			
			//新老客户
			$new_or_old = 'old';
			if ($this->checkIsNewByPid($value['patient_id'])) { //新
			    $new_or_old = 'new';
			}
			
			if (!isset($data[$new_or_old][$sex_key]['num'])) {
			    $data[$new_or_old][$sex_key]['num'] = 0;
			}
			$data[$new_or_old]['total_num'] += $value['num'];
			$data[$new_or_old]['ids'][] = $value['patient_id'];
			$data[$new_or_old][$sex_key]['num'] += $value['num'];
			$data[$new_or_old][$sex_key]['case_ids'][] = $value['case_id'];
			
			//初复诊
			$first_second_never = 'first';
			if (!isset($data[$first_second_never][$sex_key]['num'])) {
			    $data[$first_second_never][$sex_key]['num'] = 0;
			}
			 
			if ($this->checkVisitStatusByPid($value['patient_id'], $value['case_number'], '2')) { //复诊
			    $first_second_never = 'second';
			} else { //应该有复诊却没有，看是否过期
			    $sql = "select return_time from patientdiagnosisdetail where case_number=" . $value['case_number'] . " order by id desc limit 1";
			    $result = R::getAll($sql);
			    $return_time = empty($result) ? 0 : $result[0]['return_time'];
			    if (time() - $return_time <0) { //未如期复诊
			        $first_second_never = 'never';
			    }
			}
			
			$data[$first_second_never]['ids'][] = $value['patient_id'];
			$data[$first_second_never]['total_num'] += $value['num'];
			$data[$first_second_never][$sex_key]['num'] += $value['num'];
			$data[$first_second_never][$sex_key]['case_ids'][] = $value['case_id'];
		}
		
		//总的营收金额
		$total_case_ids = $this->formatCaseIds($data);
		$data['total_money'] = $this->getCurrentPrice($total_case_ids);
		
		$types = array('new', 'old', 'first', 'second', 'never');
		foreach ($types as $type) {
			$case_numbers = $this->formatCaseIds($data[$type]);
		    $data[$type]['total_money'] = $this->getCurrentPrice($case_numbers);
		}
		return $data;
	}
	
	/**
	 * 获取分类case_number
	 * */
	protected function formatCaseIds($data) {
	    $total_case_ids = array();
	    if (isset($data['male']['case_ids']) && !empty($data['male']['case_ids'])) {
	        $total_case_ids = array_merge($total_case_ids, $data['male']['case_ids']);
	    }
	    
	    if (isset($data['female']['case_ids']) && !empty($data['female']['case_ids'])) {
	        $total_case_ids = array_merge($total_case_ids, $data['female']['case_ids']);
	    }
	    return $total_case_ids;
	}
	
	/**
	 * 获取当前用户所用费用
	 * */
	protected function getCurrentPrice($total_case_ids) {
	    if (!$total_case_ids) {
	    	return 0;
	    }
	    $sql = "select sum(f.current_price) as price from patientdiagnosisfee as f inner join patientdiagnosisdetail as d on f.detail_id=d.id where d.case_id in(" . implode(',', $total_case_ids). ")";
	    
	    $result = R::getAll($sql);
	    return empty($result) ? 0 : $result[0]['price'];
	}
	// }}}
	
	/**
	 * 就诊人数-按病症分类统计
	 * */
	public function getPeopleStatByDisease($start = '', $end = '', $type_id = '') {
	    //就诊人数
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
		$age = ($type_id == 1) ? 'age_2' : 'age_1';
	    $sql = "select ".$age." from patientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $result = R::getAll($sql);
	    
		if($result){  	
			foreach ($result as $key=>$value) {
				$age_value = unserialize($value[$age]);	
				if (empty($age_value)) continue;
				foreach($age_value as $k=>$v){
						$data[$k]['disease_id'] = $k;
						$diseaseObj= R::findOne('patientdisease', 'id=' . $k);					
						$data[$k]['disease_name'] = $diseaseObj['disease_name'];
						unset($v[0]);
						for($y=1;$y<10;$y++){
						    if (!isset($data[$k][$y*10][1]))$data[$k][$y*10][1]=0;
						    if (!isset($data[$k][$y*10][2]))$data[$k][$y*10][2]=0;
							$data[$k][$y*10][1] += isset($v[$y*10][1]) ? (int)$v[$y*10][1] : 0;
							$data[$k][$y*10][2] += isset($v[$y*10][2]) ? (int)$v[$y*10][2] : 0;						
						}
				}
			}
			$i=0;
			foreach($data as $key=>$value){
				for($m=1;$m<10;$m++){
					$array[$i][$m*10] = '男：' . $data[$key][$m*10][1] . '&nbsp;<b>/</b>&nbsp;' . '女：' . $data[$key][$m*10][2];
					$array[$i]['disease_id'] = $data[$key]['disease_id'];	
					$array[$i]['disease_name'] = $data[$key]['disease_name'];					
				}
				$i++;
			}
			unset($data);
			return array_values($array);
		}else{
			return array();
		}
	}
	
	/**
	 * 获取回访次数
	 * */
	public function getVisitCount($detail_id) {
	    if (!$detail_id) {
	    	return 0;
	    }
	    $sql = 'select count(*) as count,max(return_time) as lastime from patientreturnvisit where detail_id=' . $detail_id;
	    $data = R::getRow($sql);
	    return $data;
	}
	
	/**
	 * 处理添加操作
	 * */
	protected function dealAddOperator($entity, $tablename, $isReturnId = false) {
	    if ($entity->id) {
	        //修改
	        $entity->validate();
	        $bean = R::load($tablename, $entity->id);
	        
	        if (!$bean->isEmpty()) {
	        	$data = $bean->getProperties();
	        	if (isset($data['add_time'])) {
	        	    $entity->add_time = $data['add_time'];
	        	}
	        }
	        
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
	 * 检查数据是否存在
	 * 
	 * @return boolean  true:存在   false:不存在
	 * */
	protected function isExists($tablename, $where = array()) {
		if (is_array($where)) {
		    foreach ($where as $key => $v) {
                 DTExpression::eq($key, $where);
            }
            
            $result = R::findOne($tablename, DTExpression::$sql, DTExpression::$params);
            if (empty($result)) {
            	return false;
            }
             
            return true;
		}
		
		return false;
	}
	
	/**
	 * 检查患者管理登录密码
	 * */
	public function checkPwdById($login_id, $password) {
	    $result = R::findOne('worker', 'id = ? and password = ?', array($login_id,md5($password)));
	    if (empty($result)) {
	        return false;
	    }
	    return true;
	}
	
    /**
	 * 获取处方信息
	 * */
	public function getPrescriptions() {
		
	    $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 50;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $code = isset($_REQUEST['code']) ? $_REQUEST['code'] : '';
        DTExpression::like('name', $name);
        DTExpression::like('code', $code);
        DTExpression::limit($m, $n);
        
        return $this->dealFindOperator('PatientPrescription', DTExpression::$sql . DTExpression::$limit, DTExpression::$params);
	}
	
	/**
	 * 获取处方信息数据条数
	 * */
	public function getPrescriptionsCount() {
	    return R::count('patientprescription');
	}
	
	/**
	 * 保存处方信息
	 */
	public function savePrescription($entity){
	    return $this->dealAddOperator($entity, 'patientprescription');
	}
	
	/**
	 * 处方信息-修改
	 * */
	public function modPrescription($entity) {
	    return $this->dealAddOperator($entity, 'patientprescription');
	}
	
	/**
	 * 删除处方信息
	 */
	public function delPrescription($ids){
	    $beans = R::batch('patientprescription', $ids);
	    R::trashAll($beans);
	    return true;
	}
	
	/**
	 * 获取单条处方信息
	 * */
	public function getPrescriptionById($id) {
	    $prescription = R::load('patientprescription', $id);
	    return $prescription->getProperties();
	}
	
	/**
	 * 根据id获取患者处方信息
	 * */
	public function getPrescriptionByIds($ids, $detail_id) {
    	$sql = 'select * from patientprescription where id in (' . $ids . ')';
    	$arr = R::getAll($sql);
    	if ($detail_id) {
    	    foreach ($arr as $k=>$d) {
    	        $bean = R::findOne("patientprescriptiondetail", "detail_id=" . $detail_id . " and prescription_id=" . $d['id']);
    	        if ($bean->id != '') {
    	        	$arr[$k]['prescription_id'] = $bean->prescription_id;
    	        	$arr[$k]['quantity'] = $bean->quantity;
    	        	$arr[$k]['usage'] = $bean->usage;
    	        }
    	    }
    	}
        return $arr;
	}
	
	/**
	 * 通过code获取处方信息
	 * */
	public function getPrescriptionByCode($code) {
	    $sql = 'select * from patientprescription where code like "%'.$code.'%"';
	    return R::getAll($sql);
	}
	
	/**
	 * 根据detail_id获取处方信息
	 * */
	public function getPrescriptionsByDetailId($detail_id) {
	    $sql = 'select d.prescription_id, d.quantity, d.usage, p.name, p.code, p.specification,p.unit from patientprescriptiondetail as d inner join patientprescription as p on d.prescription_id=p.id where d.detail_id=' . $detail_id;
	    $arr = R::getAll($sql);
	    return $arr;
	}
	
	/**
	 * 通过手机号取case_num
	 * @param array('telphone'=>13545645698)
	 */
	public function getinfobymobile($arr){
		$data=R::findone("patient",'telphone=:telphone',$arr);
	        

            if ($data->id != 0) {
                $patient = new Patient();
                $patient->generateFromRedBean($data);
                
            }
    
        return   $patient;
	}
	/**
	 * 通过id取名称
	 * */
	public function getsourcename($arr){
		$data=R::findone("patientdatasource",'id=:id',$arr);
		if($data->id){
			$patientdatasource=new PatientDataSource();
			$patientdatasource->generateFromRedBean($data);
		}
		return $patientdatasource;
		
	}
}