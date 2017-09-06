<?php

/**
 * 特色技术(Technology)DAO
 *
 * @author Administrator
 *
 */
class TechnologyDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_TECHNOLOGY;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('department_id', $where, $this->tableName);
        DTExpression::eq('isbidding', $where, $this->tableName);
        DTExpression::ge('plushtime', $where, 'start_time', $this->tableName);
        DTExpression::le('plushtime', $where, 'end_time', $this->tableName);
        DTExpression::eq('kind', $where, $this->tableName);
        DTExpression::like('subject', $where, $this->tableName);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::desc($this->tableName . '.plushtime');
        }

        if (isset($where['show_position']) && $where['show_position']) {
            $show_position = str_replace('show_position', $this->tableName . '.show_position', stripslashes($where['show_position']));
            DTExpression::$sql .= " and " . $show_position;
        }
        //$sql = ORMMap::$sqlMap['technology_relation'] . ' where ' . DTEXPRESSION::$sql . DTOrder::$sql . DTExpression::$limit;
       // $array = $this->getJoin($sql);

         return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit, DTExpression::delFields($this->tableName,array('content'))); 
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::eq('department_id', $where);
        DTExpression::eq('kind', $where);
        DTExpression::eq('isbidding', $where);
        DTExpression::ge('plushtime', $where, 'start_time');
        DTExpression::le('plushtime', $where, 'end_time');
        DTExpression::like('subject', $where);
        
        if (isset($where['show_position']) && $where['show_position']) {
        	$show_position = str_replace('show_position', $this->tableName . '.show_position', stripslashes($where['show_position']));
        	DTExpression::$sql .= " and " . $show_position;
        }

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 根据id数组获取数据
     *
     * @return Ambigous <multitype:, Technology>
     */
    public function getByIds() {
        $ids = (isset($_REQUEST['ids']) && $_REQUEST['ids'] != '') ? $_REQUEST['ids'] : array();
        $result = $this->getBatch($ids);
        $technologys = array();
        foreach ($result as $key => $value) {
            if ($value->id != 0) {
                $technology = new Technology();
                $technology->generateFromRedBean($value);
                $technologys[] = $technology;
            }
        }

        return $technologys;
    }
}
