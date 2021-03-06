<?php

class PicService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new PicDAO();
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
    public function get($pic) {
        $this->dao->get($pic->id, $pic);
        if ($pic->pic) {
            $pic->src = UPLOAD . $pic->pic;
        }

        return $this->success($pic);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $pics = $this->dao->query($where);
        foreach ($pics as $value) {
            $value->pic = UPLOAD . $value->pic;
        }

        return $this->success($pics);
    }

    /**
     * 保存数据
     *
     * @param Entity $link
     * @return Result
     */
    public function save($pic) {
        $pic->validate();
       
        // 获取class对象并插入数据
        $this->dao->save($pic);

        return $this->success();
    }

    /**
     * 更新数据
     *
     * @param Entity $link
     * @return Result
     */
    public function update($pic) {
        $pic->validate();

        return $this->dao->update($pic);
    }
}
