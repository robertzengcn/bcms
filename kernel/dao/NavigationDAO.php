<?php

/**
 * 导航DAO
 *
 * @author Administrator
 *
 */
class NavigationDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_NAVIGATION;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $array
     */
    public function query($where) {
        DTExpression::eq('cate', $where);
        DTExpression::eq('pid', $where);
        DTExpression::like('subject', $where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::sort('cate asc,sort asc');
        }
        
        DTExpression::page($where);
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $array
     */
    public function totalRows($where) {
        DTExpression::eq('cate', $where);
        DTExpression::like('subject', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 获取所有
     *
     * @param Navigation() $navigation
     *
     * @return bean
     */
    public function getNavigation() {
        $navigations = R::findAll($this->tableName, " order by layer asc,pid asc,sort asc");

        $navigationArray = array();
        foreach ($navigations as $key => $value) {
            $navigation = new Navigation();
            $navigation->generateFromRedBean($value);
            $navigationArray[] = $navigation;
        }

        return $navigationArray;
    }

    /**
     * 获取科室
     *
     * @return Ambigous <multitype:, NULL, unknown>
     */
    public function getDepartments() {
        return R::getAll(ORMMap::$sqlMap['navDepartments']);
    }

    /**
     * 获取疾病
     *
     * @return Ambigous <multitype:, NULL, unknown>
     */
    public function getDisease() {
        return R::getAll(ORMMap::$sqlMap['navDisease']);
    }

    /**
     * 获取名称
     *
     * @param unknown $url
     * @return Ambigous <>
     */
    public function getNameByUrl($navigation) {
        $array = explode('/', $navigation->url);
        if (isset($array) && isset($array[1]) && $array[1] == 'departments') {
            $sql = ORMMap::$sqlMap['navNameByUrlDepartments'];
        } else
            if (isset($array) && isset($array[1]) && $array[1] == 'disease') {
                $sql = ORMMap::$sqlMap['navNameByUrlDisease'];
            } else {
                $navigation->name = '===请选择===';
                return;
            }

        $name = R::getRow($sql, array(
            ':url' => $array[2]
        ));
        $navigation->name = $name['name'];

        return;
    }
}
