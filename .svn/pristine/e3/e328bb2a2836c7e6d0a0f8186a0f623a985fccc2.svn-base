<?php

/**
 * 联系方式DAO
 *
 * @author Administrator
 *
 */
class RecommendListDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_RECOMMENDLIST;
    }

    /**
     * 根据类别删除数据
     *
     * @param string $field
     * @param string $id
     */
    public function deleteById($field, $id) {
        $recommendlist = R::findAll($this->tableName, $field . '=' . $id);
        R::trashAll($recommendlist);
    }

    /**
     * 根据类别ID获取
     *
     * @param string $field
     * @param string $id
     */
    public function getById($field, $id) {
        $recommendlist = R::findAll($this->tableName, $field . '=' . $id);

        $arr = array();
        foreach ($recommendlist as $k => $bean) {
            $entity = new RecommendList();
            $entity->generateFromRedBean($bean);
            $arr[] = $entity;
        }

        return $arr;
    }

    /**
     * 根据前台获取各种状态文章id
     *
     * @param unknown $article_id
     * @return multitype:Recommendlist
     */
    public function getBean($order, $limit, $where, $field = '*') {
        if (is_array($where)) {
            foreach ($where as $key => $v) {
                DTExpression::eq($key, $where);
            }
        }
        DTExpression::limit(0, $limit);
        DTOrder::sort($order);
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 根据推荐位置获取数据...
     *
     * @param unknown_type $recommend_id
     * @param unknown_type $name
     * @return Ambigous <multitype:, unknown>
     */
    public function getByRecommendID($recommend_id, $name) {
        DTExpression::eq('recommendposition_id', $recommend_id);
        DTOrder::sort($name . ' desc');
        $sql = "select $name from " . $this->tableName . ' where ' . DTExpression::$sql . DTOrder::$sql;
        // echo $sql;
        // exit;
        $result = $this->getJoin($sql);
        $arr = array();
        foreach ($result as $v) {
            if (! empty($v->$name)) {
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * 根据推荐位置获取置顶的资讯
     *
     * @param unknown_type $recommend_id
     * @param unknown_type $is_top
     * @param unknown_type $name
     * @return Ambiguous
     */
    public function getByTop($recommend_id, $is_top, $name) {
        DTExpression::eq('is_top', $is_top);
        DTExpression::eq('recommendposition_id', $recommend_id);
        DTOrder::sort($name . ' desc');
        $sql = "select $name from " . $this->tableName . ' where ' . DTExpression::$sql . DTOrder::$sql;
        $result = $this->getJoin($sql);
        foreach ($result as $v) {
            if (! empty($v->$name)) {
                $arr[] = $v;
            }
        }
        return $arr;
    }
}
