<?php

class DTOrder {

    public static $sql = '';

    public static $is_true = false;

    /**
     * 排序
     *
     * @param unknown $field
     */
    public static function sort($order) {
        DTOrder::$sql = ' order by ' . $order;
    }

    /**
     * 正序
     *
     * @param unknown $field
     */
    public static function asc($field) {
        DTOrder::$is_true = false;
        if (DTOrder::$is_true) {
            DTOrder::$sql .= ',' . $field . ' asc ';
        } else {
            DTOrder::$sql = ' order by ' . $field . ' asc ';
            DTOrder::$is_true = true;
        }
    }

    /**
     * 倒序
     *
     * @param unknown $field
     */
    public static function desc($field) {
        DTOrder::$is_true = false;
        if (DTOrder::$is_true) {
            DTOrder::$sql .= ',' . $field . ' desc ';
        } else {
            DTOrder::$sql = ' order by ' . $field . ' desc ';
            DTOrder::$is_true = true;
        }
    }
}