<?php

/**
 * 视频DAO
 *
 * @author Administrator
 *
 */
class LinkDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_LINK;
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
        DTExpression::eq('isdisplay', $where);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::asc('sort');
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
        DTExpression::like('name', $where);
        DTExpression::eq('isdisplay', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
}
