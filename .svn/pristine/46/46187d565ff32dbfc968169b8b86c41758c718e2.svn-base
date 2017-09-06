<?php

/**
 *
 * 投票dao层
 * @author Administrator
 *
 */
class VoteWxszDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_VOTEWXSZ;
    }

    /**
     *
     *
     * 获取多条数据::debug,需使用ORMMap语句映射获取demarment名称
     *
     * @param $params 参数包
     */
    public function query($params) {
        DTExpression::eq('vid', $params);
        DTExpression::page($params);
        if (isset($params['order']) &&  $params['order']) {
            DTOrder::$sql = $params['order'];
        }else{
            DTOrder::desc('id');		
		}
         return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit); 
    }

    /**
     *
     *
     * 获取数据总数
     *
     * @param $params 参数包
     */
    public function totalRows($params) {
        DTExpression::eq('vid', $params);
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function update($entity) {
        $bean = R::load($this->tableName, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);

        return new Result(true, 0, '', NULL);
    }    
 

	/*
     * 根据vid获取数据
     * 
	 */
    
    public function getAppsecret($vid) {   	 
		$result = R::findOne($this->tableName,'vid=:vid',array('vid'=>$vid));
    	$class = ORMMap::$classes[$this->tableName];
    		$entity = new $class();
    		$entity->generateFromRedBean($result);
    	return $entity;
	}
    /**
     * 更新数据
     *
     * @param  $vid
     * @return Result
     */
    public function updateByVid($arr) {	
    	$result = R::exec('update '.$this->tableName.' set appid =:appid, appsecret=:appsecret where vid=:vid',$arr);
    	R::close();
		return $result;
    }
}
