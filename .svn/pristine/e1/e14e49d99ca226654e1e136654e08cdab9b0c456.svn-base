<?php

class ThirdStatService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new ThirdStatDAO();
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
    public function get($thirdstat) {
        $this->dao->get($thirdstat->id, $thirdstat);

        return $this->success($thirdstat);
    }

    /**
     * 获取显示第三方代码
     *
     * @return Result
     */
    public function getThirdStats() {
        $array = $this->dao->getThirdStats(1);

        return $this->success($array);
    }

    /**
     * 获取显示第三方代码
     *
     * @return Result
     */
    public function getBySubject($subject) {
        $array = $this->dao->getBySubject($subject);

        return $this->success($array);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $thirdStats = $this->dao->query($where);

        return $this->success($thirdStats);
    }

    /**
     * 保存数据
     *
     * @param Entity $link
     * @return Result
     */
    public function save($thirdstat) {
        $thirdstat->validate();
        // 获取class对象并插入数据
        $this->dao->save($thirdstat);

        return $this->success();
    }

    /**
     * 更新数据
     *
     * @param Entity $link
     * @return Result
     */
    public function update($thirdstat) {
        $thirdstat->validate();

        return $this->dao->update($thirdstat);
    }
}
