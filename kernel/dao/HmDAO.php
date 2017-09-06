<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class HmDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_HM_TOKEN;
    }

 
    
    /**
     * 取出token值
     * */
    public function gettoken($arr){
    	$res=R::findOne($this->tableName,'token=:token',$arr);
    	if($res){
    	$tokenArray = array();
    	foreach ($res as $key => $value) {
    		$tokenArray[$key]=$value;
    	}
    	return $tokenArray;
    }else{
    	return null;
    }
    }
}

