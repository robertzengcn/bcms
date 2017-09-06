<?php
class PatientService extends BaseService{
	
	private $errorMsg = array(
		-1 => '系统繁忙',
	);
	
	public function __construct(){
		$this->dao = new PatientDAO();
	}
	
	/**
	 * 获取患者信息总数...
	 */
	public function getCountPatient(){
		$count = $this->dao->getCountPatient();
		if($count >= 1 ){
			return array('statu'=>true,'data'=>$count);
		}else{
			return array('statu'=>false,'msg'=>'还没有患者记录，请添加');
		}
	}
	
	/**
	 * 保存患者信息
	 */
	public function savePatient($patientEntity){
	    return $this->dao->savePatient($patientEntity);
	}
	
	/**
	 * 保存患者案例信息
	 */
	public function savePatientCase($caseEntity){
	    return $this->dao->savePatientCase($caseEntity);
	}
	
	/**
	 * 保存患者就诊详情
	 */
	public function saveDiagnosisDetail($detailEntity){
	    return $this->dao->saveDiagnosisDetail($detailEntity);
	}
	
	/**
	 * 保存患者就诊费用详情
	 */
	public function saveDiagnosisFee($feeEntity, $patient_id, $pType){
	    return $this->dao->saveDiagnosisFee($feeEntity, $patient_id, $pType);
	}
	
	/**
	 * 保存患者就诊处方详情
	 */
	public function savePreDetail($detail_id){
	    if (isset($_REQUEST['prescription']) && !empty($_REQUEST['prescription'])) {//处方修改
	        //处方不能修改,只添加一次
	        $prescription = explode('@', $_REQUEST['prescription']);
	        $preDetailEntities = array();
	        if (is_array($prescription) && !empty($prescription)) {
	            foreach ($prescription as $v) {
	                $arr = split(':', $v);
	                $preDetailEntity = new PatientPrescriptionDetail();
	                $preDetailEntity->case_number = $_REQUEST['case_number'];
	                $preDetailEntity->detail_id = $detail_id;
	                $preDetailEntity->prescription_id = $arr[0];
	                $preDetailEntity->quantity = $arr[1];
	                $preDetailEntity->usage = $arr[2];
	                $preDetailEntities[] = $preDetailEntity;
	                unset($preDetailEntity);
	            }
	        }else {
	                $arr = split(':', $prescription);
	                $preDetailEntity = new PatientPrescriptionDetail();
	                $preDetailEntity->case_number = $_REQUEST['case_number'];
	                $preDetailEntity->prescription_id = $arr[0];
	                $preDetailEntity->quantity = $arr[1];
	                $preDetailEntity->usage = $arr[2];
	                $preDetailEntities[] = $preDetailEntity;
	        }
	        
	        $this->dao->savePreDetail($preDetailEntities, $detail_id);
	    }
	    
	}
	
	/**
	 * 增加检查报告单
	 * */
	public function updateCheck($data){
		$this->dao->updateCheck($data);
	}
	
	/**
	 * 增加统计
	 */
	public function updateStat($patient_id, $case_id){
	    $arr = array('type', 'doctor_id', 'examine_items', 'department', 'disease_type', 'visit_time', 'visit_time_field',
	         'is_finished', 'receptionist_id', 'current_price', 'gender', 'source', 'age', 'is_finished', 'case_number'
        );
	    
	    $data = array();
	    foreach ($arr as $k) {
	    	$data[$k] = $_REQUEST[$k];
	    }
	    
	    $data['case_id'] = $case_id;
	    
	    $patientdata = new PatientDataService();
	    $time_week = $data['visit_time'];
	    $result = $patientdata->getDataByTime(date('Y-m-d',$time_week));
	    if($result){
	        $user =  array('gender'=>$_REQUEST['gender'],'age'=>$_REQUEST['age'],'source'=>$_REQUEST['source'],'id'=>$patient_id);
	        $patientdata->updateDataField($result,$data,$user);
	    }else{
	        $patientdata->saveDataField($data,$patient_id);
	    }
	}
	
	/**
	 * 新增患者（拆分之前的，已废弃）
	 * */
	public function savePatientBack(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $patientFields = array('username','case_number','gender','birthday', 'age', 'telphone', 'qq',
	        'email', 'source', 'source_detail', 'recommend_name', 'recommend_tel',
	        'vip_level', 'money'
	    );
	    $caseFields = array('id', 'patient_id', 'case_number','add_time', 'is_finished', 'reason'
	    );
	
	    $detailFields = array('type', 'case_id','case_number', 'pid', 'pic', 'check', 'doctor_id', 'examine_items',
	        'therapeutic', 'advice', 'department', 'disease_type', 'advise',
	        'untoward_effect', 'remark', 'visit_time', 'visit_time_field', 'return_time', 'return_time_field', 'return_items', 'receptionist_id',
	        'reception_records'
	    );
	
	    $feeFields = array('real_price', 'current_price', 'balance',
	        'is_deal'
	    );
	
	    $operator = 'add';
	    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'modify') {
	        unset($_REQUEST['id'], $_REQUEST['action']);
	        $operator = 'modify';
	    }
	    $data = array();
	    if(!isset($_REQUEST['vtype'])){
	        $_REQUEST['add_time'] = isset($_REQUEST['visit_time']) ? $_REQUEST['visit_time'] : '';
	    }
	    foreach ($_REQUEST as $key=>$val){
	        if (in_array($key, $patientFields)) {
	            $data['patient'][$key] = $val;
	        }
	
	        if ('visit_time' == $key && $val) {
	            $val = (is_numeric($val)) ? $val : strtotime($val);
	        }
	        if ('add_time' == $key && $val) {
	            $val = (is_numeric($val)) ? $val : strtotime($val);
	        }
	        if ('return_time' == $key && $val) {
	            $val = (is_numeric($val)) ? $val : strtotime($val);
	        }
	
	        if (in_array($key, $caseFields)) {
	            if ('add_time' == $key && $operator == 'add') {
	                $data['patientcase'][$key] = $val ? $val : time();
	            } else {
	                $data['patientcase'][$key] = $val;
	            }
	        }
	
	        if (in_array($key, $detailFields)) {
	            if ('return_time' == $key && $operator == 'add') {
	                $data['patientdiagnosisdetail'][$key] = $val ? $val : '';
	            }elseif ('visit_time' == $key && $operator == 'add') {
	                $data['patientdiagnosisdetail'][$key] = $val ? $val : time();
	            }elseif ('visit_time' == $key && $operator != 'add') {
	                $data['patientdiagnosisdetail'][$key] = $val ? $val : '';
	            } else {
	                $data['patientdiagnosisdetail'][$key] = $val;
	            }
	        }
	
	        if (in_array($key, $feeFields)) {
	            $data['patientdiagnosisfee'][$key] = $val;
	        }
	    }
	
	    if (isset($data['patientcase']) && $_REQUEST['case_id']) {
	        $data['patientcase']['id'] = $_REQUEST['case_id'];
	        $data['patientcase']['patient_id'] = $_REQUEST['patient_id'];
	    }
	
	    if (isset($data['patientdiagnosisdetail']) && isset($_REQUEST['detail_id'])&&strlen($_REQUEST['detail_id'])>0) {
	        $data['patientdiagnosisdetail']['id'] = $_REQUEST['detail_id'];
	    }
	
	    if (isset($data['patient']) && isset($_REQUEST['patient_id'])&&strlen($_REQUEST['patient_id'])>0) {
	        $data['patient']['id'] = $_REQUEST['patient_id'];
	        $data['patient']['username'] = $_REQUEST['username'];
	    }
	
	    if (isset($data['patientdiagnosisfee'])) {
	        $data['patientdiagnosisfee']['case_number'] = $_REQUEST['case_number'];
	        $data['patientdiagnosisfee']['pay_time'] = time();
	        // $data['patientdiagnosisfee']['balance'] = $_REQUEST['real_price'] - $_REQUEST['current_price'];
	    }
	
	    if (isset($_REQUEST['prescription']) && !empty($_REQUEST['prescription'])) {//处方修改
	        //处方不能修改,只添加一次
	        $prescription = explode('@', $_REQUEST['prescription']);
	        $data['patientprescriptiondetail'] = array();
	        if (is_array($prescription)) {
	            foreach ($prescription as $v) {
	                $arr = split(':', $v);
	                $data['patientprescriptiondetail'][] = array(
	                    'case_number' => $_REQUEST['case_number'],
	                    'prescription_id' => $arr[0],
	                    'quantity' => $arr[1],
	                    'usage' => $arr[2],
	                );
	            }
	        } else {
	            $arr = split(':', $prescription);
	            $data['patientprescriptiondetail'][] = array(
	                'case_number' => $_REQUEST['case_number'],
	                'prescription_id' => $arr[0],
	                'quantity' => $arr[1],
	                'usage' => $arr[2],
	            );
	        }
	    }
	    $user =  array('gender'=>$data['patient']['gender'],'age'=>$data['patient']['age'],'source'=>$data['patient']['source']);
	    if (isset($data['patient'])) {
	        $data['patient']['add_time'] = time();
	        $data['patient']['money'] = 0;
	    }
	    if ($_REQUEST['case_id'] && $operator == 'add') {
	        unset($data['patient']);
	    }
	    if(isset($_REQUEST['type'])&&$_REQUEST['type']){
	        $data['type']=$_REQUEST['type'];
	    }
	    if(isset($_REQUEST['Ptype'])&&$_REQUEST['Ptype']){
	        $data['Ptype']=$_REQUEST['Ptype'];
	    }
	    if(isset($_REQUEST['checkimg'])&&$_REQUEST['checkimg']){
	        $data['checkimg']=$_REQUEST['checkimg'];
	        	
	    }
	    if(isset($_REQUEST['checkcontent'])&&$_REQUEST['checkcontent']){
	        $data['checkcontent']=$_REQUEST['checkcontent'];
	    }
	
	    $msg = ($operator == 'add') ? '添加' : '更新';
	
	    try {
	        $re = $this->dao->savePatient($data);
	        if(!$re){
	            return array('statu'=>false,'msg'=>$msg . '失败！');
	        }else{
	            if($operator == 'add'){					//增加数据统计
	                $patientdata = new PatientDataService();
	                $time_week = $data['patientdiagnosisdetail']['visit_time'];
	                $result = $patientdata->getDataByTime(date('Y-m-d',$time_week));
	                if($result){
	                    $user['id'] = $re;
	                    $patientdata->updateDataField($result,$data,$user);
	                }else{
	                    $patientdata->saveDataField($data,$re);
	                }
	            }else{
	                $type = $data['patientdiagnosisdetail']['type'];
	                if($type == 2){     //复诊
	
	                }
	            }
	        }
	        	
	    } catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$msg . '失败:' . $e->getMessage());
	    }
	
	    return array('statu'=>true,'msg'=>$msg . '成功！','data'=>$re);
	}
	
	/**
	 * 获取患者诊断信息
	 * */
	public function getListPatientCase($where) {
		
	    $result = $this->dao->getListPatientCase($where);
	    return $result;
	}
		
	/**
	 * 删除患者信息
	 */
	public function deletePatient($ids){
		Entity::isIds($ids);
		$re = $this->dao->deletePatient($ids);
		if($re){
			return array('statu'=>true,'msg'=>'删除成功');
		}
	}
	
	/**
	 * 删除复诊记录后重新累加余额
	 */
	public function addWholeMoney($pid,$cnum){
		try{
			$result = $this->dao->addWholeMoney($pid,$cnum);
		
		}catch (Exception $e){
			return false;
		}
		
	    return $result;
	}
	
	/**
	 * 删除就诊记录
	 * */
	public function delReturnDiagnosisDetail($ids) {
		if (!is_array($ids)) {
			$ids = array($ids);
		}
		Entity::isIds($ids);
		try{
		    $re = $this->dao->delReturnDiagnosisDetail($ids);
		    $money=$this->addWholeMoney($_REQUEST['pid'],$_REQUEST['cnum']);
		}catch (Exception $e){
		    return array('statu'=>false,'msg'=>$e->getMessage());
		}
		return array('statu'=>true,'msg'=>'删除成功','data'=>$money);
	}
	
	/**
	 * 根据id获取就诊信息
	 */
	public function getPatientCaseById($id){
		$data = $this->dao->getPatientCaseById($id);
		
		$data['examine_items_name'] = $this->getExaineItemsStrByIds($data['examine_items']);
		return new Result(true, 0, '', $data);
	}
	
	/**
	 * 获取复诊详情
	 * */
	public function diagnosisDetail($id) {
	    $data = $this->dao->diagnosisDetail($id);
	    $data['visit_time']=date('Y-m-d',$data['visit_time']);
	    $data['return_time']=date('Y-m-d',$data['return_time']);
	    $data['examine_items_name'] = $this->getExaineItemsStrByIds($data['examine_items']);
	    return new Result(true, 0, '', $data);
	}
	
	/**
	 * 根据用户名获取患者基本信息
	 * */
	public function getPatientByName($username) {
	    $data = $this->dao->getPatientByName($username);
	    if (empty($data)) {
	        return new Result(false, 0, '患者不存在');
	    }
	    return new Result(true, 0, '', $data);
	}
	
	/**
	 * 根据id获取患者基本信息
	 * */
	public function getPatientById($id) {
	    $data = $this->dao->getPatientById($id);
	    if (empty($data)) {
	        return new Result(false, 0, '患者不存在');
	    }
	    return new Result(true, 0, '', $data);
	}
	
	/**
	 * 获取根据id患者基础信息
	 * */
	public function getPatientInfoById($id) {
	    $data = $this->dao->getPatientInfoById($id);
	    if (empty($data)) {
	        return new Result(false, 0, '患者不存在');
	    }
	    return new Result(true, 0, '', $data);
	}
	
	/**
	 * 获取会员级别
	 * */
	public function getVipLevels() {
	    $levels = $this->dao->getVipLevels();
		return $levels;
	}
	
	/**
	 * 获取会员等级数据条数
	 * */
	public function getVipLevelsCount() {
	    return $this->dao->getVipLevelsCount();
	}
	
	/**
	 * 保存来源信息
	 */
	public function saveDataSource(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $dataSource = new PatientDataSource();
	    foreach ($_REQUEST as $key=>$val){
	        $dataSource->$key = $val;
	    }
	    
	    try {
	        $dataSource->validate();
	        $re = $this->dao->saveDataSource($dataSource);
	        if($re){
	            return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
	        }else{
	            return array('statu'=>false,'msg'=>'添加失败！');
	        }
	    } catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$e->getMessage());
	    }
	    
	}
	
	/**
	 * 来源信息-修改
	 * */
	public function modSource() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $dataSource = new PatientDataSource();
	    foreach ($_REQUEST as $key=>$val){
	        $dataSource->$key = $val;
	    }
	    $dataSource->validate();
	    $re = $this->dao->modSource($dataSource);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 删除来源信息
	 */
	public function delDataSource($ids){
	    if (!is_array($ids)) {
	    	$ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delDataSource($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 保存诊疗项目信息
	 */
	public function addExamineItem(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $item = new PatientExamineItem();
	    foreach ($_REQUEST as $key=>$val){
	        $item->$key = $val;
	    }
	    try {
	        $item->validate();
	        $re = $this->dao->addExamineItem($item);
	        if($re){
	            return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
	        }else{
	            return array('statu'=>false,'msg'=>'添加失败！');
	        }
	    } catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$e->getMessage());
	    }
	    
	}
	
	/**
	 * 诊疗项目信息-修改
	 * */
	public function modExamineItem() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $item = new PatientExamineItem();
	    foreach ($_REQUEST as $key=>$val){
	        $item->$key = $val;
	    }
	    $item->validate();
	    $re = $this->dao->modExamineItem($item);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 删除诊疗项目信息
	 */
	public function delExamineItem($ids){
	    if (!is_array($ids)) {
	        $ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delExamineItem($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 保存会员级别信息
	 */
	public function saveVipLevel(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $level = new PatientVipLevel();
	    foreach ($_REQUEST as $key=>$val){
	        $level->$key = $val;
	    }
	    try {
	        $level->validate();
	        $re = $this->dao->saveVipLevel($level);
	        if($re){
	            return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
	        }else{
	            return array('statu'=>false,'msg'=>'添加失败！');
	        }
	    } catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$e->getMessage());
	    }
	    
	}
	
	/**
	 * 会员级别信息-修改
	 * */
	public function modVipLevel() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $level = new PatientVipLevel();
	    foreach ($_REQUEST as $key=>$val){
	        $level->$key = $val;
	    }
	    $level->validate();
	    $re = $this->dao->modVipLevel($level);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 删除会员级别信息
	 */
	public function delVipLevel($ids){
	    if (!is_array($ids)) {
	        $ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delVipLevel($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 保存医生信息
	 */
	public function addDoctor(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $doctor = new PatientDoctor();
	    foreach ($_REQUEST as $key=>$val){
	        $doctor->$key = $val;
	    }
	    try {
		    $doctor->validate();
		    $re = $this->dao->addDoctor($doctor);
		    if($re){
		        return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
		    }else{
		        return array('statu'=>false,'msg'=>'添加失败！');
		    }
	    }catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$e->getMessage());
	    }
	}
	
	/**
	 * 医生信息-修改
	 * */
	public function modDoctor() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $doctor = new PatientDoctor();
	    foreach ($_REQUEST as $key=>$val){
	        $doctor->$key = $val;
	    }
	    $doctor->validate();
	    $re = $this->dao->modDoctor($doctor);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 删除医生信息
	 */
	public function delDoctor($ids){
	    if (!is_array($ids)) {
	        $ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delDoctor($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 保存科室信息
	 */
	public function addDepartment(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $department = new PatientDepartment();
	    foreach ($_REQUEST as $key=>$val){
	        $department->$key = $val;
	    }
	    try{
	    	$department->validate();
	    	$re = $this->dao->addDepartment($department);
	    	if($re){
	    		return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
	    	}else{
	    		return array('statu'=>false,'msg'=>'添加失败！');
	    	}
	    	
	    }catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$e->getMessage());
	    }
	    
	}
	
	/**
	 * 科室信息-修改
	 * */
	public function modDepartment() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $department = new PatientDepartment();
	    foreach ($_REQUEST as $key=>$val){
	        $department->$key = $val;
	    }
	    $department->validate();
	    $re = $this->dao->modDepartment($department);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 删除科室信息
	 */
	public function delDepartment($ids){
	    if (!is_array($ids)) {
	        $ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delDepartment($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 保存疾病信息
	 */
	public function addDisease(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $disease = new PatientDisease();
	    foreach ($_REQUEST as $key=>$val){
	        $disease->$key = $val;
	    }
	    try {
		    $disease->validate();
		    $re = $this->dao->addDisease($disease);
		    if($re){
		        return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
		    }else{
		        return array('statu'=>false,'msg'=>'添加失败！');
		    }
	    } catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$e->getMessage());
	    }
	}
	
	/**
	 * 疾病信息-修改
	 * */
	public function modDisease() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $disease = new PatientDisease();
	    foreach ($_REQUEST as $key=>$val){
	        $disease->$key = $val;
	    }
	    $disease->validate();
	    $re = $this->dao->modDisease($disease);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 删除疾病信息
	 */
	public function delDisease($ids){
	    if (!is_array($ids)) {
	        $ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delDisease($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 保存前台接待信息
	 */
	public function addReceptionist(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $receptionist = new PatientReceptionist();
	    foreach ($_REQUEST as $key=>$val){
	        $receptionist->$key = $val;
	    }
	    try{
		    $receptionist->validate();
		    $re = $this->dao->addReceptionist($receptionist);
		    if($re){
		        return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
		    }else{
		        return array('statu'=>false,'msg'=>'添加失败！');
		    }
	    }catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$e->getMessage());
	    }
	}
	
	/**
	 * 前台接待信息-修改
	 * */
	public function modReceptionist() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $receptionist = new PatientReceptionist();
	    foreach ($_REQUEST as $key=>$val){
	        $receptionist->$key = $val;
	    }
	    $receptionist->validate();
	    $re = $this->dao->modReceptionist($receptionist);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 删除前台接待信息
	 */
	public function delReceptionist($ids){
	    if (!is_array($ids)) {
	        $ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delReceptionist($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 保存处方信息
	 */
	public function savePrescription(){
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $prescription = new PatientPrescription();
	    foreach ($_REQUEST as $key=>$val){
	        $prescription->$key = $val;
	    }
	    try {	    	
	        $prescription->validate();
	        $re = $this->dao->savePrescription($prescription);
	        if($re){
	            return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
	        }else{
	            return array('statu'=>false,'msg'=>'添加失败！');
	        }
	    } catch (Exception $e) {
	        return array('statu'=>false,'msg'=>$e->getMessage());
	    }
	     
	}
	
	/**
	 * 处方信息-修改
	 * */
	public function modPrescription() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $prescription = new PatientPrescription();
	    foreach ($_REQUEST as $key=>$val){
	        $prescription->$key = $val;
	    }
	    $prescription->validate();
	    $re = $this->dao->modPrescription($prescription);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 删除处方信息
	 */
	public function delPrescription($ids){
	    if (!is_array($ids)) {
	        $ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delPrescription($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 获取处方信息
	 * */
	public function getPrescriptions() {
		
	    $pres = $this->dao->getPrescriptions();
	    return $pres;
	}
	
	/**
	 * 获取处方信息数据条数
	 * */
	public function getPrescriptionsCount() {
	    return $this->dao->getPrescriptionsCount();
	}
	
	/**
	 * 获取单条处方信息
	 * */
	public function getPrescriptionById() {
	    return $this->dao->getPrescriptionById($_REQUEST['id']);
	}
	
	/**
	 * 根据id获取患者处方信息
	 * */
	public function getPrescriptionByIds() {
	    return $this->dao->getPrescriptionByIds($_REQUEST['id'], $_REQUEST['detail_id']);
	}
	
	/**
	 * 通过code获取单条处方信息
	 * */
	public function getPrescriptionByCode() {
	    return $this->dao->getPrescriptionByCode($_REQUEST['code']);
	}
	
	/**
	 * 根据detail_id获取处方信息
	 * */
	public function getPrescriptionsByDetailId($id) {
	    $pres = $this->dao->getPrescriptionsByDetailId($id);
	    return $pres;
	}
	
	/**
	 * 保存回访信息
	 * */
	public function addReturnVisit() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $returnVisit = new PatientReturnVisit();
	    foreach ($_REQUEST as $key=>$val){
	        $returnVisit->$key = $val;
	    }
	    $returnVisit->validate();
	    $returnVisit->return_time = time();
	    $re = $this->dao->addReturnVisit($returnVisit);
	    if($re){
	        return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'添加失败！');
	    }
	}
	
	/**
	 * 保存回复信息-修改
	 * */
	public function modReturnVisit() {
	    unset($_REQUEST['controller'],$_REQUEST['method']);
	    $returnVisit = new PatientReturnVisit();
	    foreach ($_REQUEST as $key=>$val){
	        $returnVisit->$key = $val;
	    }
	    $returnVisit->validate();
	    $re = $this->dao->modReturnVisit($returnVisit);
	    if($re){
	        return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
	    }else{
	        return array('statu'=>false,'msg'=>'修改失败！');
	    }
	}
	
	/**
	 * 获取回访信息
	 * */
	public function getReturnVisitList($case_number) {
	    $result= $this->dao->getReturnVisitList($case_number);
	    
	    return $result;
	}
	
	/**
	 * 删除回访信息
	 */
	public function delReturnVisit($ids){
	    if (!is_array($ids)) {
	        $ids = array($ids);
	    }
	    Entity::isIds($ids);
	    $re = $this->dao->delReturnVisit($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	}
	
	/**
	 * 获取来源信息
	 * */
	public function getDataSource() {
	    return $this->dao->getDataSource();
	}
	
	/**
	 * 按名称获取来源信息
	 * */
	public function getDataByName() {
		return $this->dao->getDataByName();
	}
	
	/**
	 * 获取前台接待员
	 * */
	public function getReceptionist() {
		return $this->dao->getReceptionist();
	}
	
	/**
	 * 获取前台接待员数据条数
	 * */
	public function getReceptionistCount() {
	    return $this->dao->getReceptionistCount();
	}
	
	/**
	 * 获取主治医生
	 * */
	public function getDoctors() {
		return $this->dao->getDoctors();
	}
	
	/**
	 * 获取主治医生数据条数
	 * */
	public function getDoctorsCount() {
	    return $this->dao->getDoctorsCount();
	}
	
	/**
	 * 获取科室信息
	 * */
	public function getDepartments() {
		return $this->dao->getDepartments();
	}
	
	/**
	 * 获取科室信息数据条数
	 * */
	public function getDepartmentsCount() {
	    return $this->dao->getDepartmentsCount();
	}
	
	/**
	 * 获取疾病信息
	 * */
	public function getDiseases() {
		return $this->dao->getDiseases();
	}
	
	/**
	 * 获取疾病信息数据条数
	 * */
	public function getDiseasesCount() {
	    return $this->dao->getDiseasesCount();
	}
	
	/**
	 * 获取诊疗项目
	 * */
	public function getExamineItems() {
	    return $this->dao->getExamineItems();
	}
	
	/**
	 * 获取诊疗项目数据条数
	 * */
	public function getExamineItemsCount() {
	    return $this->dao->getExamineItemsCount();
	}
	
	/**
	 * 根据ids获取诊疗项目串
	 * */
	public function getExaineItemsStrByIds($ids) {
	    return $this->dao->getExaineItemsStrByIds($ids);
	}
	
	/**
	 * 获取复诊信息
	 * */
	public function getReturnDiagnosisList() {
		return $this->dao->getReturnDiagnosisList($_REQUEST);
	}
	
    /**
     * 获取所有患者列表
     * */
    public function getAllPatients() {
        return $this->dao->getAllPatients();
    }
	
	/**
	 * 获取统计数据
	 * */
	public function getStatData() {
	    return $this->dao->getStatData($_REQUEST);
	}
	
	/**
	 * 获取统计详情
	 * */
	public function getStatDetail() {
		return $this->dao->getStatDetail($_REQUEST);
	}
	
	/**
	 * 获取当月就诊数据
	 * */
	public function statByDate() {
	    return $this->dao->statByDate($_REQUEST);
	}
	
	/**
	 * 验证患者管理密码
	 * */
	public function checkPwdById($login_id, $password) {
	    return $this->dao->checkPwdById($login_id, $password);
	}
	
	/**
	 * 验证是不是url...
	 */
	public function isUrl($url) {
        $pattern = '/^((http|https):\/\/)?' . '(([0-9]{1,3}\.){3}[0-9]{1,3}' .         // IP形式的URL
        '|' .         // 允许IP和DOMAIN（域名）
        '([0-9a-z_!~*\'()-]+\.)*' .         // 三级域验证
        '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.' .         // 二级域验证
        '[a-z]{2,6})' .         // 顶级域验证
        '(:[0-9]{1,4})?' . '((\/\?)|' . '(\/[0-9a-zA-Z_!~\*\'\(\)\.;\?:@&=\+\$,%#-\/]*)?)$/';
        return preg_match($pattern, trim($url));
    }
	
	/**
	 * 抛出具体的错误...
	 */
	public function errorMessage($code){
		foreach ($this->errorMsg as $key=>$value){
			if($code == $key){
				throw new Exception($value);
			}
		}
	}
	
	/**
	 * 卸载插件所需要执行的方法...
	 */
	public function uninstall(){
		//删除数据库中的表
		$sql1 = 'drop table patient';
		$sql2 = 'drop table patientcase';
		$sql3 = 'drop table patientdatasource';
		$sql4 = 'drop table patientdepartment';
		$sql5 = 'drop table patientdiagnosisdetail';
		$sql6 = 'drop table patientdiagnosisfee';
		$sql7 = 'drop table patientdisease';
		$sql8 = 'drop table patientdoctor';
		$sql9 = 'drop table patientexamineitem';
		$sql10 = 'drop table patientmanager';
		$sql11 = 'drop table patientreceptionist';
		$sql12 = 'drop table patientreturnvisit';
		$sql13 = 'drop table patientviplevel';
		
		$array = array($sql1,$sql2,$sql3,$sql4,$sql5,$sql6,$sql7,$sql8,$sql9,$sql10,$sql11,$sql12,$sql13);
		$this->dao->dropTable($array);
		return true;
	}
	
	/**
	 * 通过手机号获取患者信息
	 */
	public function getcasenum($mobile){
		$data=$this->dao->getinfobymobile(array('telphone'=>$mobile));
		return $this->success($data);
	}
	
	/**
	 * 按照id获取来源名称
	 * */
	public function getsourcename($id){
		$arr=array('id'=>(int)$id);
		$data=$this->dao->getsourcename($arr);
		return $this->success($data);
	}
}