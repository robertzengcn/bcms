<?php

class LinkService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new LinkDAO();
    }

    /**
     * 批量删除
     *
     * @param array $array(id,...)
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
    public function get($link) {
        if (! $link->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($link->id, $link);

        return $this->success($link);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $links = $this->dao->query($where);

        return $this->success($links);
    }

    /**
     * 保存数据
     *
     * @param Entity $link
     * @return Result
     */
    public function save($link) {
        $link->validate();
        // 获取class对象并插入数据
        $this->dao->save($link);

        return $this->success();
    }

    /**
     * 更新数据
     *
     * @param Entity $link
     * @return Result
     */
    public function update($link) {
        $link->validate();
        if (! $link->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($link);
    }
}
