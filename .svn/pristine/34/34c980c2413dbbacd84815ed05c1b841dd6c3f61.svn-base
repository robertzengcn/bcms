<?php

/**
 * 视频DAO
 *
 * @author Administrator
 *
 */
class BusinessDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_BUISNESS;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('is_display', $where);
        DTExpression::page($where);

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
        DTExpression::eq('is_display', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 根据swtid获取列表
     *
     * @param unknown $swt_id
     * @return multitype:Buisness
     */
    public function getBySwtId($swt_id) {
        $swt = R::findOne($this->tableName, " swt_id = '" . $swt_id . "' ");
        $business = new Buisness();
        $business->generateFromRedBean($swt);

        return $business;
    }
}
