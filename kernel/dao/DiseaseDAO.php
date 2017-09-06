<?php

/**
 * 疾病DAO
 *
 * @author Administrator
 *
 */
class DiseaseDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DISEASE;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('department_id', $where, $this->tableName);
        DTExpression::like('name', $where, $this->tableName);
        DTExpression::like('url', $where, $this->tableName);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc($this->tableName . '.id');
        }
        //$sql = ORMMap::$sqlMap['disease_relation'] . ' where ' . DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
        //return $this->getJoin($sql);
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
        DTExpression::eq('department_id', $where);
        DTExpression::like('name', $where);
        DTExpression::like('url', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 获取疾病
     *
     * @return bean
     */
    public function getByDepartmentID($para) {
        DTExpression::eq('department_id', $para);
        if (DTOrder::$is_true == true) {
            DTOrder::$is_true = false;
        }
        DTOrder::asc('id');
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    
    /**
     * 获取顶级疾病
     *
     * @return bean
     */
    public function getByDisease($para) {
    	DTExpression::eq('department_id', $para);
    	DTExpression::eq('parent_id', '0');
    	if (DTOrder::$is_true == true) {
    		DTOrder::$is_true = false;
    	}
    	DTOrder::asc('id');
    	return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    /**
     * 获取子级疾病
     *
     * @return bean
     */
    public function getByDiseaseID($para) {
    	DTExpression::eq('parent_id', $para);
    	if (DTOrder::$is_true == true) {
    		DTOrder::$is_true = false;
    	}
    	DTOrder::asc('id');
    	return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获取单条数据
     *
     * @param unknown $id
     */
    public function getDiseaseById($id) {
        $disease = new Disease();
        $diseaseBean = R::load($this->tableName, $id);
        $disease->generateFromRedBean($diseaseBean);

        return $disease->name;
    }
    
    /**
     * 获取单条数据
     *
     * @param unknown $id
     */
    public function getDisId($id) {
    	$disease = new Disease();
    	$diseaseBean = R::load($this->tableName, $id);
    	$disease->generateFromRedBean($diseaseBean);
    
    	return $disease->url;
    }

    /**
     * 根据疾病ID获取数据
     *
     * @param array $ids
     */
    public function getNames($ids) {
        if(count($ids) <= 0){
            return array();
        }
        DTExpression::in('id', $ids);
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql);
    }

    /**
     * 获取疾病数据
     *
     * @return multitype:Disease
     */
    public function getAllDisease() {
        $diseases = R::findAll($this->tableName);

        $diseaseArray = array();
        foreach ($diseases as $key => $value) {
            $disease = new Disease();
            $disease->generateFromRedBean($value);
            $diseaseArray[] = $disease;
        }

        return $diseaseArray;
    }

    public function getByDepartment($department_id) {
        $diseases = R::find($this->tableName, 'department_id=' . $department_id);
        $diseaseArray = array();
        foreach ($diseases as $value) {
            foreach ($value as $k => $value1) {
                $array[$k] = $value1;
            }
            $diseaseArray[] = $array;
        }
        return $diseaseArray;
    }

    /**
     * 根据疾病名字获取数据
     *
     * @param unknown_type $where
     * @return Disease
     */
    public function getByName($where) {
        $bean = R::find($this->tableName, 'name=:name', $where);
        foreach ($bean as $v) {
            $disease = new Disease();
            $disease->generateFromRedBean($v);
        }
        return $disease;
    }
    
    /**
     * 通过ID获取它的单个子集
     */
    public function getSub($Id) {
        $diseases = R::find($this->tableName, 'parent_id=' . $Id);
        $diseaseArray = array();
        foreach ($diseases as $value) {
            foreach ($value as $k => $value1) {
                $array[$k] = $value1;
            }
            $diseaseArray[] = $array;
        }
        return $diseaseArray;
    }
    
    /**
     * 通过parent_id获取它的单个父集
     */
    public function getPar($parent_id) {
        $diseases = R::find($this->tableName, 'id=' . $parent_id);
        $diseaseArray = array();
        foreach ($diseases as $value) {
            foreach ($value as $k => $value1) {
                $array[$k] = $value1;
            }
            $diseaseArray[] = $array;
        }
        return $diseaseArray;
    }
    
    /**
     * 
     * 更新layer层级关系
     * @param $data
     */
    public function updateSubLayer( $data ) {
    	foreach( $data as $key => $value ) {
    		$disease = new Disease();
    		$bean  = R::load($this->tableName,$key);
    		$bean->layer = $value;
    		R::store( $bean );
    	}
    }
    
    /**
     * 通过ID删除它的所有子集
     * @param int $DiseaseID 疾病id
     */
    public function delSubList( $data ){
        foreach( $data as $key => $value ) {
    		R::trash( R::load( $this->tableName , $value->id ) );
    	}
    }
    
    /**
     * 通过ID更新它的所有子集的科室ID
     * @param int $IDarray 子集数组
     * @param int $DepartmentID 科室id
     */
    public function upSubListDepartment( $IDarray , $DepartmentID ){
        foreach( $IDarray as $key => $value ) {
    		$disease = new Disease();
    		$bean  = R::load($this->tableName,$value->id);
    		$bean->department_id = $DepartmentID;
    		R::store( $bean );
    	}
    }
     /**
     * 通过url获取id
	 * @return id
     */	
    public function getIdByUrl($url) {
		//$id = R::find($this->tableName, " url = '" . $url . "' ");	//单条数据
        $id = R::getRow( "SELECT id FROM ".$this->tableName." WHERE url='".$url."'" );
		return	$id['id'];
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
     * 查询数据
	 * @return array
     */	
    public function getInfo($diseaseID) {
		if($diseaseID){
          $data[0] = R::getRow( "SELECT * FROM ".$this->tableName." WHERE id=".$diseaseID." LIMIT 1 " );				
		}else{
          $data = R::getAll( "SELECT * FROM ".$this->tableName." ORDER BY id DESC" );			
		}
 		$arr =array();
		foreach( $data as $vo){
			$department_name = R::getRow( "SELECT name FROM department WHERE id='".$vo['department_id']."'" );
			$count = R::getRow( "SELECT count(*) as num FROM ".$this->tableName." WHERE department_id=".$vo['department_id'] );
			$vo['department_name'] = $department_name['name'];
			$vo['count'] = $count['num'];
			$arr[] = $vo;
			unset($vo);
		} 
		return	$arr;	
	}	
    /*
     *通过疾病名称获取疾病信息 
     * 
     * */
    public function getdiseasebyname($arr){
    	$diseasesBean = R::findOne($this->tableName,'name=:name and department_id=:department_id',$arr);
    	$disease=new Disease();
    	$disease->generateFromRedBean($diseasesBean);
    	return $disease;
    }
     /**
     * 通过id获取name
	 * @return name
     */	
    public function getName($disease_id) {
		$info = array();
		if($disease_id){
			$info = R::getRow("SELECT name FROM ".$this->tableName." WHERE id=".$disease_id);
		}
		return	$info['name'] ? $info['name'] : '';
	} 
    /**
     * 获得所有疾病的id
	 * @return array
     */	
    public function getAllDiseaseId() {
        $data = R::getAll( "SELECT id FROM ".$this->tableName." WHERE 1=1" );
		return	$data;
	}	
}

