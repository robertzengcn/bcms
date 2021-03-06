<?php

/**
 * 工作简历DAO
 *
 * @author Administrator
 *
 */
class WorkHistoryDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_WORKHISTORY;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('doctor_id', $where);
        DTExpression::page($where);
        DTOrder::$sql = isset($where['order']) ? $where['order'] : '';

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
        DTExpression::eq('doctors_id', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 根据医生ID删除数据
     *
     * @param string $doctor_id
     */
    public function deleteByDoctor($doctor_id) {
        $workHistorys = R::findAll($this->tableName, 'doctor_id = ?', array(
            $doctor_id
        ));
        $this->deleteBeans($workHistorys);

        return true;
    }
}
