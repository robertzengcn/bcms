<?php

class RecommendListService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new RecommendListDAO();
    }

    /**
     * 获取推荐位置数据
     *
     * @return multitype:Recommendposition
     */
    public function get($article_id) {
        return $this->dao->getList($article_id);
    }

    /**
     * 通过调取文章数据id
     */
    public function getRecommend($order, $limit, $where, $field) {
        return $this->dao->getBean($order, $limit, $where, $field);
    }

    /**
     * 保存位置信息
     */
    public function save($recommend) {
        $recommend->validate();
        return $this->dao->save($recommend);
    }

    /*
     * 根据类别取位置数据 @param string $field @param string $id
     */
    public function getById($field, $id) {
        return $this->dao->getById($field, $id);
    }

    /**
     * 根据类别删除数据
     *
     * @param string $field
     * @param string $id
     */
    public function deleteById($field, $id) {
        return $this->dao->deleteById($field, $id);
    }

    /**
     * 根据推荐位置获取数据...
     *
     * @param unknown_type $recommend_id
     */
    public function getByRecommendID($recommend_id, $name) {
        return $this->dao->getByRecommendID($recommend_id, $name);
    }

    /**
     * 根据推荐位置获取置顶的资讯
     *
     * @param unknown_type $recommend_id
     * @param unknown_type $is_top
     * @param unknown_type $name
     */
    public function getByTop($recommend_id, $is_top, $name) {
        return $this->dao->getByTop($recommend_id, $is_top, $name);
    }
}
