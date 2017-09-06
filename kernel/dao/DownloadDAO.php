<?php

/**
 * 环境DAO
 *
 * @author Administrator
 *
 */
class DownloadDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_DOWNLOAD;
    }

    /**
     * 获得grid数据
     * @param array $where
     *  查询条件
     *  return object $arr
     */
    public function query($where) {
        DTExpression::ge('plushtime', $where, 'start_time');
        DTExpression::le('plushtime', $where, 'end_time');
        DTExpression::like('name', $where);
        DTExpression::page($where);
        DTOrder::desc('plushtime');
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit,ORMMap::$sqlMap['common_fields']);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::ge('plushtime', $where, 'start_time');
        DTExpression::le('plushtime', $where, 'end_time');
        DTExpression::eq('name', $where);
        
        if (isset($where['show_position']) && $where['show_position']) {
        	$show_position = str_replace('show_position', $this->tableName . '.show_position', stripslashes($where['show_position']));
        	DTExpression::$sql .= " and " . $show_position;
        }

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
}
