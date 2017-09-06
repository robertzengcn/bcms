<?php

/**
 * 视频DAO
 *
 * @author Administrator
 *
 */
class UserVarDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_USERVAR;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('isdisplay', $where);
        DTExpression::eq('name', $where);
        DTExpression::eq('pid', $where);
        DTExpression::eq('var_name', $where);
        DTExpression::eq('tid', $where);
        DTExpression::page($where);
        // DTOrder::asc ( 'sort' );
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

    /**
     * 根据外键获得数据
     */
    public function getByPid($para, $kind) {
        return R::findAll($this->tableName, 'pid = ' . $para . ' and kind=' . $kind);
    }

    /**
     * 根据外键清除数据
     *
     * @param unknown $pid
     * @param unknown $kind
     */
    public function clearByPid($pid, $kind) {
        $userVars = $this->getByPid($pid, $kind);

        return $this->deleteBeans($userVars);
    }
}
