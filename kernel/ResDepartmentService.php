<?php

class ResDepartmentService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
         $this->dao = new ResDepartmentDAO();
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
        
        if (isset($department->pic)&&$department->pic) {
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
     * 根据科室ID获得科室名称
     */
    public function getDepartmentNameByID($ID) {
    	if($ID!=''&&$ID!='0'){
    		return $this->dao->getDepartmentNameByID($ID);
    	}else{
    		return '顶级科室';
    	}    	
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
     * 保存科室信息
     */
    public function addDepartment(){
    	unset($_REQUEST['controller'],$_REQUEST['method']);
    	$department = new ResDepartment();    	
    	foreach ($_REQUEST as $key=>$val){
    		$department->$key = $val;
    	}
    	if(isset($_REQUEST['belong'])&&$_REQUEST['belong']!=''){
    		$department->belong = $_REQUEST['belong'];
    	}else{
    		$department->belong = 0;
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
    public function editDepartment() {
    	unset($_REQUEST['controller'],$_REQUEST['method']);
    	$department = new ResDepartment();
    	foreach ($_REQUEST as $key=>$val){
    		$department->$key = $val;
    	}
    	$department->validate();
    	$re = $this->dao->editDepartment($department);
    	if($re){
    		return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
    	}else{
    		return array('statu'=>false,'msg'=>'修改失败！');
    	}
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
    /**
     * 检查科室表里是否有数据存在
     *
     * 
     * @return Result
     */
    public function checkdate(){
    	return $this->dao->getDepartments();
    	
    }
    /**
     * 从原可是表导入数据到科室表
     *
     *
     * @return Result
     */
    public function importdate(){
    	
    	return $this->dao->importdate();
    	 
    }
    /**
     * 获取顶级科室信息
     *
     * @return Result
     */
    public function gettopDepartments() {
    	$departments = $this->dao->gettopDepartments();
    
    	return $this->success($departments);
    }
    
    /*
     * 获取某个科室具体信息
     * @param array('id'=>departmnet_id)
     * */
    public function getdepartmentbyarr($arr){
    	if (!isset($arr['id'])||!$arr['id']) {
    		 
    		throw new ValidatorException(7);
    	}
		$department=new ResDepartment();
		$department->id=$arr['id'];
        $this->dao->get($department->id, $department);
        
        if (isset($department->pic)&&$department->pic) {
            $department->src = UPLOAD . $department->pic;
        }
        return $this->success($department);
    }
    
    /*
     * 取某个科室下的二级科室
     * */
    public function getbelongdep($arr){
    	if (!isset($arr['id'])||!$arr['id']) {    		 
    		throw new ValidatorException(7);
    	}
  		$result=$this->dao->getbelongdep($arr);    	
   		return $this->success($result);
    }


    
    
    
}
