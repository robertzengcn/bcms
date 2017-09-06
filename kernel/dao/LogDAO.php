<?php

/**
 * 操作日志DAO
 *
 * @author Administrator
 *
 */
class LogDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_WORKER_LOG_HISTORY;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::ge('logtime', $where, 'start_time');
        DTExpression::le('logtime', $where, 'end_time');
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc('logtime');
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
        DTExpression::ge('logtime', $where, 'start_time');
        DTExpression::le('logtime', $where, 'end_time');

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * getOne
     *
     * @param array $para
     *            return object entity
     */
    public function get($where, $id = null) {
        $logBean = R::findOne($this->tableName, ' op like ? order by logtime desc ', array(
            $where . '%'
        ));

        $log = new Log();
        $log->generateFromRedBean($logBean);

        return $log;
    }

    /**
     * 清空
     *
     * @return boolean
     */
    public function clear() {
        return R::wipe($this->tableName);
    }
	
	/**
     * 获取标题
     *
     */	
    public function getTitle($table) {
		$title = R::getAssocRow("select subject from ".$table);
		$array = array();
		foreach($title as $key=>$vo){
			$array[$key] = $vo['subject'];
			unset($vo);
		}
		return	$array;

	}
}
