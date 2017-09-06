<?php

/**
 * 视频DAO
 *
 * @author Administrator
 *
 */
class TagDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_TAG;
        $this->articleName = TABLENAME_ARTICLE;
        $this->channelArticleName = TABLENAME_CHANNELARTICLE;
        $this->mediaReportName = TABLENAME_MEDIAREPORT;
        $this->newsName = TABLENAME_NEWS;
        $this->topicName = TABLENAME_TOPIC;
        $this->successName = TABLENAME_SUCCESS;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function queryArticle($where) {
        $tableName = $this->getTable($where);
        DTExpression::eq('plushtime', $where);
        DTOrder::desc('plushtime');
        DTExpression::page($where);

        return $this->getBySql($tableName, DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRowsArticle($where) {
        $tableName = $this->getTable($where);
        DTExpression::eq('plushtime', $where);

        return $this->getCount($tableName, DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 条件查询
     *
     * @param Entity $class
     * @param DTExpression $conditioin
     * @param DTOrder $order
     * @return array(Entity)
     */
    private function getBySql($class, $sql) {
        $result = R::find($class, $sql, DTExpression::$params);
        DTExpression::$params = array();
        DTExpression::$limit = '';
        DTExpression::$sql = ' 1=1 ';
        DTOrder::$sql = '';

        $array = array();
        foreach ($result as $key => $value) {
            $entity = new $class();
            $entity->generateFromRedBean($value);
            $entity->tags = $this->getTagsByPlushtime($entity->plushtime);
            $array[] = $entity;
        }

        return $array;
    }

    /**
     * 获取数据数量
     *
     * @param string $where
     * @param string $para
     * @return number
     */
    private function getCount($table = '', $where = '', $para = '') {
        if ($table == '') {
            $table = $this->tableName;
        }
        DTExpression::$sql = ' 1=1 ';
        DTExpression::$params = array();

        return R::count($table, $where, $para);
    }

    /**
     * 获取表名
     *
     * @param unknown $para
     * @return string
     */
    private function getTable($para) {
        $tableName = '';
        switch ($para['cid']) {
            case '1':
                $tableName = $this->articleName;
                break;
            case '2':
                $tableName = $this->newsName;
                break;
            case '3':
                $tableName = $this->channelArticleName;
                break;
            case '4':
                $tableName = $this->topicName;
                break;
            case '5':
                $tableName = $this->successName;
                break;
            case '6':
                $tableName = $this->mediaReportName;
                break;
            default:
                $tableName = $this->articleName;
                break;
        }

        return $tableName;
    }

    /**
     * 获取tags
     *
     * @param unknown $plushtime
     * @return string
     */
    public function getTagsByPlushtime($plushtime) {
        $tags = R::findAll($this->tableName, " plushtime = '" . $plushtime . "' ");

        $str = '';
        foreach ($tags as $key => $value) {
            $tag = new Tag();
            $tag->generateFromRedBean($value);
            $str .= $tag->tag . ',';
        }

        return $str;
    }

    /**
     * 获得grid数据
     *
     * @param array $para
     *            return object $arr
     */
    public function query($para) {
        DTExpression::eq('tag', $para);
        DTExpression::ge('plushtime', $para, 'start_time');
        DTExpression::le('plushtime', $para, 'end_time');
        DTOrder::desc('plushtime');
        DTExpression::page($para);

        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获得总数
     *
     * @param array $para
     *            return object $arr
     */
    public function totalRows($para) {
        DTExpression::eq('tag', $para);
        DTExpression::ge('plushtime', $para, 'start_time');
        DTExpression::le('plushtime', $para, 'end_time');

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 获取tags
     *
     * @param unknown $plushtime
     * @return multitype:Tags
     */
    public function getTags($plushtime) {
        $tags = R::findAll($this->tableName, " plushtime = '" . $plushtime . "' ");

        $str = '';
        foreach ($tags as $key => $value) {
//             $tag = new Tag();
//             $tag->generateFromRedBean($value);
            $tag = $value->getProperties();
            $str .= $tag['tag'] . ',';
        }
        if ($str != '') {
            $str = substr($str, 0, strlen($str) - 1);
        }

        return $str;
    }

    /**
     * 保存tags
     *
     * @param unknown $entity
     */
    public function tagsSave($entity) {
        $tag = R::dispense($this->tableName);
        $entity->generateRedBean($tag);
        R::store($tag);
        $entity->generateFromRedBean($tag);
    }

    /**
     * 清除tags
     *
     * @param unknown $plushtime
     */
    public function tagsClear($plushtime) {
        $tags = R::findAll($this->tableName, " plushtime = '" . $plushtime . "' ");
        R::trashAll($tags);
    }
}
