<?php

/**
 * 资讯(Article)DAO
 *
 * @author Administrator
 *
 */
class NetworkPicDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_NETWORKPIC;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::page($where);
        DTOrder::desc('updatetime');

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
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
}
