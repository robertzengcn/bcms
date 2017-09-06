<?php
class NavgroupDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_NAVGROUP;
    }
    
    /**
     * 查询(导航组)
     * @param array $where
     *            查询条件
     *            return object $array
     */
    public function queryGroup($where) {
    	DTExpression::eq('is_group', 1);
        DTExpression::eq('cate', $where);
        DTExpression::like('subject', $where);
        DTOrder::sort('cate asc,sort asc');
        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';
        
        DTExpression::page($where);

        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    
    /**
     * 查询(组成员)
     * @param array $where
     *            查询条件
     *            return object $array
     */
    public function getGroup($where) {
    	
    	DTExpression::eq('group_id', $where);        
        DTExpression::eq('pid', $where);        
        DTOrder::sort('cate asc,sort asc');		
        DTExpression::page($where); 
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    
    /**
     * 获得总数
     * @param array $where
     *            查询条件
     *            return object $array
     */
    public function totalRows($where) {
    	DTExpression::eq('group_id', $where);
    	DTExpression::eq('is_group', $where);
        DTExpression::eq('cate', $where);
        DTExpression::like('subject', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    /**
     * 删除导航组(组成员)
     */
    public function deleteGroup($ids) {
    	if( is_array( $ids ) && count( $ids ) >= 1 ){
    		foreach ( $ids as $value ) {
    			$sql = "DELETE FROM ".$this->tableName." WHERE `group_id` = " . $value;
    			R::exec($sql);
    		}
    	}
    	return true;
    }
    
    /**
     * 通过flag查询导航组所有的组成员
     */
    public function getFlag($flag) {
    	$sql    = "SELECT * FROM `".$this->tableName."` WHERE `flag`='".$flag."' AND `is_group`=1";
    	$result = R::getRow($sql);
    	if( is_null( $result ) ) {return null;}
    	$id     = $result['id'];
    	$sql    = "SELECT * FROM `".$this->tableName."` WHERE `group_id`=" . $id;
    	$list   = R::getAll($sql);
        if( is_null( $list ) ) {return null;}
    	return $list;
    }
    
    /**
     * 通过flag查询导航组所有的名字
     */
    public function getName($flag) {
    	$sql    = "SELECT * FROM `".$this->tableName."` WHERE `flag`='".$flag."' AND `is_group`=1";
//     	$result = R::getRow($sql);
//     	if( is_null( $result ) ) {return null;}
//     	$id     = $result['id'];
//     	$sql    = "SELECT * FROM `".$this->tableName."` WHERE `group_id`=" . $id;
     	$list   = R::getAll($sql);
    	if( is_null( $list ) ) {return null;}
    	return $list;
    }
    
}
