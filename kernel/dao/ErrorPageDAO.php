<?php

/**
 * 异常页面DAO
 *
 * @author Administrator
 *
 */
class ErrorPageDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_ERRORPAGE;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询数据
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('code', $where);
        DTExpression::page($where);

        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询数据
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::eq('code', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
}
