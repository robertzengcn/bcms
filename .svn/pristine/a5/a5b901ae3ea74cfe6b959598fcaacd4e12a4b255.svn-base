<?php

/**
 *
 * ask在线问答dao层
 * @author Administrator
 *
 */
class PhysicalexamDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_PHYSICALEXAM;
    }

    /**
     * 获取本ip过去一小时内的所有提交次数
     *
     * @param string $ip
     *            ip地址
     * @return int 提交次数
     */
    public function getLimitIp($ip) {
        DTExpression::ge('plushtime', array(
            'begin_time' => time() - 60 * 60
        ), 'begin_time', $this->tableName);
        DTExpression::eq('ip', array(
            'ip' => $ip
        ), $this->tableName);
        return (int) $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }


    /**
     *
     * @param $params 参数包
     */
    public function query($params) {
        DTExpression::ge('plushtime', $params, 'start_time', $this->tableName);
        DTExpression::le('plushtime', $params, 'end_time', $this->tableName);
        DTExpression::eq('ischeck', $params, $this->tableName);
        DTExpression::page($params);
        //DTOrder::$is_true = false;
        //DTOrder::asc($this->tableName . '.ischeck');
        //DTOrder::desc($this->tableName . '.plushtime');
//         print_r($params);
//         exit();
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     *
     *
     * 获取数据总数
     *
     * @param $params 参数包
     */
    public function totalRows($params) {
        DTExpression::ge('plushtime', $params, 'start_time');
        DTExpression::le('plushtime', $params, 'end_time');
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }


}
