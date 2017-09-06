<?php

class ErrorPageService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new ErrorPageDAO();
    }

    /**
     * 批量删除
     *
     * @param array $array(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        return $this->dao->deleteBatch($ids);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询数据
     * @return Result
     */
    public function query($where) {
        $errorPages = $this->dao->query($where);

        return $this->success($errorPages);
    }

    /**
     * 获得一条数据
     *
     * @param Entity $errorPage
     * @return Result
     */
    public function get($errorPage) {
        if (! $errorPage->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($errorPage->id, $errorPage);

        return $this->success($errorPage);
    }

    /**
     * 保存数据
     *
     * @param Entity $errorPage
     * @return Result
     */
    public function save($errorPage) {
        $errorPage->validate();
        // 获取class对象并插入数据
        $this->dao->save($errorPage);

        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $errorPage
     * @return Result
     */
    public function update($errorPage) {
        $errorPage->validate();
        if (! $errorPage->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($errorPage);
    }
}
