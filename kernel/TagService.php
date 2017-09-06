<?php

class TagService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new TagDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        return $this->dao->deleteBatch($ids);
    }

    /**
     * 获取一条数据
     *
     * @param Entity $link
     * @return Result
     */
    public function get($tag) {
        $this->dao->get($tag->id, $tag);

        return $this->success($tag);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function queryArticle($where) {
        $tags = $this->dao->queryArticle($where);
        foreach ($tags as $key => $value) {
            $value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
        }

        return $this->success($tags);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function totalRowsArticle($where) {
        $totalRowsArticle = $this->dao->totalRowsArticle($where);

        return $this->success($totalRowsArticle);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $tags = $this->dao->query($where);
        foreach ($tags as $key => $value) {
            $value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
        }

        return $this->success($tags);
    }

    /**
     * 保存数据
     *
     * @param Entity $link
     * @return Result
     */
    public function save($tag) {
        $tag->validate();
        // 获取class对象并插入数据
        $this->dao->save($tag);

        return $this->success();
    }

    /**
     * 更新数据
     *
     * @param Entity $link
     * @return Result
     */
    public function update($tag) {
        $tag->validate();

        return $this->dao->update($tag);
    }

    /**
     * 保存tags
     *
     * @param unknown $plushtime
     */
    public function tagsSave($plushtime) {
        if (isset( $_REQUEST['tags'] ) && $_REQUEST['tags'] != '') {
            $tags = explode(',', $_REQUEST['tags']);
            foreach ($tags as $value) {
                $tag = new Tag();
                $tag->tag = $value;
                $tag->plushtime = $plushtime;
                $this->dao->tagsSave($tag);
            }
        }
    }

    /**
     * 清空tags
     *
     * @param unknown $plushtime
     */
    public function tagsClear($plushtime) {
        $this->dao->tagsClear($plushtime);
    }

    /**
     * 获取tags
     *
     * @param unknown $plushtime
     */
    public function getTags($plushtime) {
        return $this->dao->getTags($plushtime);
    }
}
