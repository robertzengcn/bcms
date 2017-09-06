<?php

/**
 * 视频DAO
 *
 * @author Administrator
 *
 */
class WorkerGroupDAO extends DBBaseDAO {

    public function __construct() {
        $this->tableName = TABLENAME_WORKERGROUP;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where=array()) {
        DTExpression::eq('name', $where);

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
}
