<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class DepartmentDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DEPARTMENT;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('name', $where);
        DTExpression::like('url', $where);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::asc('id');
        }
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit, DTExpression::delFields($this->tableName,array('content')));
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::ge('plushtime', $where, 'start_time');
        DTExpression::le('plushtime', $where, 'end_time');
        DTExpression::like('name', $where);
        DTExpression::like('url', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 获取科室数据
     *
     * @return multitype:Departments
     */
    public function getDepartments() {
        $departments = R::findAll($this->tableName);

        $departmentArray = array();
        foreach ($departments as $key => $value) {
            $department = new Department();
            $department->generateFromRedBean($value);
            $departmentArray[] = $department;
        }

        return $departmentArray;
    }

    /**
     * 获取科室
     *
     * @param Departments() $department
     *            $channel->id
     * @return bean
     */
    public function getDepartmentByID($department) {
        $departmentBean = R::load($this->tableName, $department->id);
        $department->generateFromRedBean($departmentBean);

        return $departmentBean;
    }
    /**
     * 查询数据
	 * @return array
     */	
    public function getInfo($departmentID) {
		if($departmentID){
          $data[0] = R::getRow( "SELECT * FROM ".$this->tableName." WHERE id=".$departmentID." LIMIT 1 " );				
		}else{
          $data = R::getAll( "SELECT * FROM ".$this->tableName." ORDER BY id DESC" );			
		}
		return	$data;
	}
    /**
     * 查询字段数据
	 * @return array
     */	
    public function getFieldInfo($departmentID,$field='name') {
          $data = R::getRow( "SELECT {$field} FROM ".$this->tableName." WHERE id={$departmentID} LIMIT 1 " );		
		return	$data;
	}
    /**
     * 通过url获取id
	 * @return id
     */	
    public function getIdByUrl($url) {
		$info = R::getRow("SELECT id FROM ".$this->tableName." WHERE url='".$url."'");
		return	$info['id'];
	}
    /**
     * 通过id获取url
	 * @return url
     */	
    public function getUrlById($id) {
		$info = R::getRow("SELECT url FROM ".$this->tableName." WHERE id=".$id);
		return	$info['url'];
	}
    /**
     * 通过id获取name
	 * @return url
     */	
    public function getName($department_id) {
		$info = array();
		if($department_id){
			$info = R::getRow("SELECT name FROM ".$this->tableName." WHERE id=".$department_id);
		}
		return	isset($info['name']) ? $info['name'] : '';
	}
	/*
	 * 取第一个科室,按id排序
	* */
	
	public function getonedepart(){
		$departmentBean=R::findOne($this->tableName,'order by id asc');
		if($departmentBean!=null){
			$department=new Department();
			$department->generateFromRedBean($departmentBean);
	
			return $department;
		}else{
			return null;
		}
	}
	
	/*
	 *
	* 取模板
	* */
	public function getdepbyarr($arr){
		$departmentBean=R::findOne( $this->tableName,'id=:id',$arr);
	
		$department=new Department();
		 
		$department->generateFromRedBean($departmentBean);
	
		return $department;
	}
    /**
     * 获得所有科室的id
	 * @return array
     */	
    public function getAllDepartmentId() {
        $data = R::getAll( "SELECT id FROM ".$this->tableName." WHERE 1=1" );
		return	$data;
	}
}
