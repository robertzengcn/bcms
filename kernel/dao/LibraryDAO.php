<?php

/**
 * 素材库DAO
 *
 * @author Administrator
 *
 */
class LibraryDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_LIBRARY;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::like('name', $where);
        DTOrder::desc('plushtime');
        DTExpression::page($where);
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    
    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
    	DTExpression::like('name', $where);
    	return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 批量删除
     *
     * @param unknown $ids
     */
    public function deleteBatch($ids) {
        $contacts = $this->getBatch($ids);
        foreach ($contacts as $key) {
            if ($key->id == 0) {
                return new Result(false, 78, ErrorMsgs::get(78), NULL);
            }
            if ($key->is_retain == 1) {
                return new Result(false, 18, ErrorMsgs::get(18), NULL);
            }
        }
        R::trashAll($contacts);

        return new Result(true, 0, '', NULL);
    }

    /**
     * 
     * 获取当前正在运行的数据库名称
     */
    public function get_data(){
    	return new Result(true, 0, '', DBNAME);
    }
    
    /**
     * 
     * 获取当前正在运行的数据表列表
     */
    public function get_table(){
        $dataArray = R::getAssocRow("select table_name from information_schema.tables where table_schema='". DBNAME ."'");
        return $dataArray;
    }
    
    /**
     * 
     * 根据数据表获取该表所有的字段
     */
    public function get_field(){
    	$dataArray = R::getAssocRow("SHOW COLUMNS FROM ".$_REQUEST['table']);
		return $dataArray;
    }
    
    public function replace(){
    	$ab_table   = $_REQUEST['ab_table'];
    	$ab_field   = $_REQUEST['ab_field'];
    	$ab_search  = $_REQUEST['ab_search'];
    	$ab_replace = $_REQUEST['ab_replace'];
    	$sql = "SELECT `id`,`".$ab_field."` FROM `".$ab_table."` WHERE `".$ab_field."` like '%". $ab_search ."%'";
    	$dataArray = R::getAssocRow( $sql );
    	if( count( $dataArray ) <= 0 ){
    		return 0;
    	}
    	$replace_firm = 0;
    	foreach ( $dataArray as $key => $value ){
    		$v = str_replace($ab_search, $ab_replace, $value[$ab_field]);
    		$sql = "UPDATE `".$ab_table."` SET `".$ab_field."`='".$v."' WHERE id=".$value['id'];
    		R::exec($sql);
    		$replace_firm++;
    	}
    	return $replace_firm;
    }
    
}
