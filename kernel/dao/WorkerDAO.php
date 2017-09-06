<?php

/**
 * 视频DAO
 *
 * @author Administrator
 *
 */
class WorkerDAO extends DBBaseDAO {

    public function __construct() {
        $this->tableName = TABLENAME_WORKER;
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
        DTExpression::eq('group_id', $where);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::asc('id');
        }
        
  
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
        DTExpression::eq('name', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 判断用户
     */
    public function login() {
        return R::findOne($this->tableName, 'name = ? or telephone=? and password = ?', array(
            $_REQUEST['name'],
        	$_REQUEST['name'],
            md5($_REQUEST['password'])
        ));
    }

    /**
     * 判断用户唯一
     */
    public function reg() {
        return R::findOne($this->tableName, 'name = ?', array(
            $_REQUEST['name']
        ));
    }
    /**
     * 查找用户名是否存在
     * */
    public function finduserbyname($name){
    	return R::findOne($this->tableName, 'name = ?', array(
    			$name
    	));
    }
    /**
     * 通过id获取name
	 * @return name
     */	
    public function getName($worker_id) {
		$info = array();
		if($worker_id){
			$info = R::getRow("SELECT name FROM ".$this->tableName." WHERE id=".$worker_id);
		}
		return	isset($info['name']) ? $info['name'] : '';
	}
	/**
	 * 取worker中的昵称和id
	 * */
	public function getnicknamelist($where){
		DTExpression::eq('id',$where);
		$sql = ORMMap::$sqlMap['workerlist'];
		return $this->getJoin($sql);
	}
	/**
	 * 通过id取值
	 * */
	public function getworkerbyid($arr){
		$result=R::findone($this->tableName,'id=:id',$arr);
		if($result){
			$worker = new Worker();
			$worker->generateFromRedBean($result);
			
		}
		return $worker;
	}
	
}
