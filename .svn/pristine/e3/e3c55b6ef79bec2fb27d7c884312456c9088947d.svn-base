<?php

/**
 * 资讯(Article)DAO
 *
 * @author Administrator
 *
 */
class WeiboDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_WEIBO;        
    }
    
    public function checkaccess(){
    	$time=time();
    	
    	$result=R::count($this->tableName,'access_token IS NOT NULL and expires_time>:expires',array('expires'=>$time));
    	return $result;
    }
    
    /*
     * 获取最新的token
     * 
     * */
    public function getlast(){
    	$time=time();
    	
    	$result=R::findLast($this->tableName,'access_token IS NOT NULL and expires_time>:expires',array('expires'=>$time));
    	
    	$weibo = new Weibo();
    	$weibo->generateFromRedBean($result);
    	return $weibo;
    }
    
    
    /*
     * 移除token
     * */
    public function removetoken(){
    	//$time=time();
//     	$weibo=R::dispense($this->tableName);
//     	print_r($weibo);exit();
    	R::wipe($this->tableName);
    	//$weibo=R::trashAll($beans)($this->tableName,'access_token IS NOT NULL and expires_time>:expires',array('expires'=>$time));
    	//R::trash($weibo);
    }
    
    

 
}
