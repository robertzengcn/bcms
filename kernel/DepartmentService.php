<?php

class DepartmentService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new DepartmentDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $departments = $this->dao->getBatch($ids);

        $files = array();
        foreach ($departments as $department) {
            $filename = GENERATEPATH . 'department/' . $department->url . '/' . $department->id . '.html';
            if ($department->id == 0) {
                throw new ValidatorException(78);
            }
            $files[] = $filename;
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        return $this->dao->deleteBeans($departments);
    }

    /**
     * 获取科室信息
     *
     * @return Result
     */
    public function getDepartments() {
        $departments = $this->dao->getDepartments();

        return $this->success($departments);
    }

    /**
     * 获取一条数据
     *
     * @param Entity $news
     * @return Result
     */
    public function get($department) {
        if (! $department->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($department->id, $department);
        
        if ($department->pic) {
            $department->src = UPLOAD . $department->pic;
        }
        return $this->success($department);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $departments = $this->dao->query($where);

        return $this->success($departments);
    }

    /**
     * 保存数据
     *
     * @param Entity $news
     * @return Result
     */
    public function save($department) {
        $department->validate();
        // 获取class对象并插入数据
        $this->dao->save($department);

        return $this->success();
    }

    /**
     * 更新数据
     *
     * @param Entity $news
     * @return Result
     */
    public function update($department) {
        $department->validate();
        if (! $department->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($department);
    }
    
    /*
     * 取第一个科室,按id排序
     * */
    public function getonedepart(){
    	$result=$this->dao->getonedepart();
    	if($result!=null){
    		
    	return $this->success($result);
    	}else{
    	return $this->success();
    	}
    }
    
    /*
     * 根据数组获取科室
     * */
    public function getdepbyarr($arr){
    	$result=$this->dao->getdepbyarr($arr);
    	return $this->success($result);
    }
     /**
     * 通过id获取name
	 * @return url
     */	
    public function getName($department_id) {
    	return $this->dao->getName($department_id);		
	}
     /**
     * 通过id获取url
	 * @return url
     */	
    public function getUrl($department_id) {
    	return $this->dao->getUrlById($department_id);		
	}	
    /**
     * 查询字段数据
	 * @return array
     */	
    public function getFieldInfo($departmentID,$field) {
    	return $this->dao->getFieldInfo($departmentID,$field);		
	}
}
