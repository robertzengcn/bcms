<?php

/**
 * 资讯(Article)DAO
 *
 * @author Administrator
 *
 */
class BoyiManagerDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_BOYIMANAGER;        
    }

    public function getkey(){
    	//R::findOne($this->tableName,'');
    	$res=R::findLast($this->tableName);
    	$boyiArray = array();
    	foreach ($res as $key => $value) {
    		$boyiArray[$key]=$value;
    	}
    	return $boyiArray;
    }
 
}
