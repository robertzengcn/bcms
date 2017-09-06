<?php

class BusinessService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new BusinessDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        return $this->dao->deleteBatch($ids);
    }

    /**
     * 获取一条数据
     *
     * @param Entity $link
     * @return Result
     */
    public function get($business) {
        if (! $business->id) {
            throw new ValidatorException(7);
        }

        $this->dao->get($business->id, $business);

        return $this->success($business);
    }

    /**
     * 获取显示swt
     *
     * @return Result
     */
    public function getBySwtId($swt_id) {
        $swt = $this->dao->getBySwtId($swt_id);
        if ($swt->pic) {
            $swt->src = UPLOAD . $swt->pic;
        }

        return $this->success($swt);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $businessArray = $this->dao->query($where);

        return $this->success($businessArray);
    }

    /**
     * 保存数据
     *
     * @param Entity $link
     * @return Result
     */
    public function save($business) {
        $business->validate();
        // 获取class对象并插入数据
        $this->dao->save($business);

        return $this->success();
    }

    /**
     * 更新数据
     *
     * @param Entity $link
     * @return Result
     */
    public function update($business) {
        $business->validate();
        if (! $business->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($business);
    }
}
