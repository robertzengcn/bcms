<?php

class DoctorService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new DoctorDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $doctors = $this->dao->getBatch($ids);

        $files = array();
        foreach ($doctors as $doctor) {
            $filename = GENERATEPATH . 'doctor/' . $doctor->id . '.html';
            if ($doctor->id == 0) {
                throw new ValidatorException(78);
            }
            $files[] = $filename;
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $this->dao->beginTrans();
        try {
            $this->dao->deleteBeans($doctors);
            // 删除医生疾病
            foreach ($ids as $id) {
                $this->dao->deleteDisease($id);
            }
            // 删除简历
            $workHistoryService = new WorkHistoryService();
            foreach ($ids as $id) {
                $workHistoryService->deleteByDoctor($ids);
            }

            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }

        return $this->success();
    }

    /**
     * 获取医生信息
     */
    public function getByDepartmentID($department_id) {
        $doctor = $this->dao->getByDepartmentID($department_id);

        return $this->success($doctor);
    }

    /**
     * 获取一条数据
     *
     * @param Entity $doctor
     * @return Result
     */
    public function get($doctor) {
        if (! $doctor->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($doctor->id, $doctor);

        if ($doctor->pic) {
            $doctor->src1 = UPLOAD . $doctor->pic;
        }
        if ($doctor->certificate) {
            $doctor->src2 = UPLOAD . $doctor->certificate;
        }

        $result = $this->dao->getDisease($doctor->id);
        $doctor->disease = $result;
        $recommend = new RecommendListService();
        $result = $recommend->getById('doctor_id', $doctor->id);
        $doctor->recommend = $result;
        return $this->success($doctor);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $doctors = $this->dao->query($where);
        $diseaseService = new DiseaseService();
        $departmentdao = new DepartmentDAO();
        foreach ($doctors as $key) {
            $result = $this->dao->getDisease($key->id);
            $ids = array();
            foreach ($result as $value) {
                $ids[] = $value->disease_id;
            }
            $disease = $diseaseService->getNames($ids);
            $key->disease = '';
            foreach ($disease as $d) {
                $key->disease .= $d->name . ',';
            }
            $key->disease = rtrim($key->disease, ',');
            if ($key->plushtime != '') {
                $key->plushtime = date('Y-m-d', $key->plushtime);
            }
			$key->department_name = $departmentdao->getName($key->department_id);
        }

        return $this->success($doctors);
    }

    /**
     * 保存数据
     *
     * @param Entity $doctor
     * @return Result
     */
    public function save($doctor) {
        $doctor->validate();
        // 获取科室对象
        $departments = new Department();
        $departmentsDao = new DepartmentDAO();
        $departments->id = $_REQUEST['department_id'];
        $departmentsBean = $departmentsDao->getDepartmentByID($departments);

        if ($departments->id == 0) {
            throw new ValidatorException(27);
        }
        $diseaseArray=array();
		if(isset($_REQUEST['disease_id'])&&$_REQUEST['disease_id']){
		        $diseaseArray = $_REQUEST['disease_id'];
		}
        $doctor->plushtime = time();
        $doctor->click_count = rand(30, 100);
        // 获取class对象并插入数据
        $this->dao->beginTrans();
        try {
            $this->dao->doctorSave($doctor, $departmentsBean);
            foreach ($diseaseArray as $val) {
                $this->dao->addDisease($doctor->id, $val);
            }

            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }
        
        $is_tomobile = isset($_REQUEST['is_tomobile']) ? $_REQUEST['is_tomobile'] : '1';
        if (! empty($_REQUEST['recommendposition'])) {
            $recommendList = new RecommendListService();
            foreach ($_REQUEST['recommendposition'] as $value) {
                $recommend = new RecommendList();
                $recommend->recommendposition_id = $value;
                $recommend->doctor_id = $doctor->id;
                $recommend->is_tomobile = $is_tomobile;
                $recommendList->save($recommend);
            }
        }
        return $this->success();
    }

    /**
     * 更新数据
     *
     * @param Entity $doctor
     * @return Result
     */
    public function update($doctor) {
        $doctor->validate();
        if (! $doctor->id) {
            throw new ValidatorException(7);
        }

        $this->dao->beginTrans();
        try {
            $this->dao->update($doctor);
            if(isset($_REQUEST['disease_id'])&&$_REQUEST['disease_id']){
            $this->dao->updateDisease($doctor, $_REQUEST['disease_id']);
            }
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }
        
        $is_tomobile = isset($_REQUEST['is_tomobile']) ? $_REQUEST['is_tomobile'] : '1';
        if (! empty($_REQUEST['recommendposition'])) {
            $recommendList = new RecommendListService();
            $recommendList->deleteById('doctor_id', $doctor->id);
            foreach ($_REQUEST['recommendposition'] as $value) {
                $recommend = new RecommendList();
                $recommend->recommendposition_id = $value;
                $recommend->doctor_id = $doctor->id;
                $recommend->is_tomobile = $is_tomobile;
                $recommendList->save($recommend);
            }
        }
        return $this->success();
    }

    /**
     * 根据疾病ID获取医生
     *
     * @return Result
     */
    public function getByDiseaseId() {
        $diseaseId = $_REQUEST['disease_id'];
        $doctors = $this->dao->getByDiseaseId($diseaseId);
        $array['doctors'] = $doctors;

        return $this->success($array);
    }
    
    /**
     * 根据预约医生表ID获取关联医生
     *
     * @return Result
     */
    public function getByResDoctorId($resdocID) {
    	return $this->dao->getByResDoctorId($resdocID);
    }
    /**
     * 获取静态url列表
     *
     * @return Result
     */
    public function getHtmlUrl() {
    	$fxed = '';
    	switch ( $_REQUEST['func'] ){
    		case 'mobile':$fxed    = 'mobile/';break;
    		case 'app':$fxed    = 'app/';break;
    		case 'wechat':$fxed = 'wechat/';break;
    	}
    	$fxed = '';
    	$url = array();
    	
    	$doctors = $this->dao->getListAll();
    	return $this->success($doctors);
    	
    }
/*
 * 通过Id取doctor
 * */
    public function getdoctorbyid($id){
    	
    	$doctor=new Doctor();
    	$doctor->id=$id;
    	
    	if (! $doctor->id) {
    		throw new ValidatorException(7);
    	}
    	$this->dao->get($doctor->id, $doctor);
    	
    	if ($doctor->pic) {
    		$doctor->src1 = UPLOAD . $doctor->pic;
    	}
    	if ($doctor->certificate) {
    		$doctor->src2 = UPLOAD . $doctor->certificate;
    	}
    	
    	$result = $this->dao->getDisease($doctor->id);
    	$doctor->disease = $result;
    	$recommend = new RecommendListService();
    	$result = $recommend->getById('doctor_id', $doctor->id);
    	$doctor->recommend = $result;
    	return $this->success($doctor);
    	
    }
    
    /**
     * 更新预约挂号医生id
     */
    public function updateReserve($where){
    	$result = $this->dao->updateReserve($where);
    	return $this->success($result);
    }
    
}
