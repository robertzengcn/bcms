<?php

class HonorService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new HonorDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $honors = $this->dao->getBatch($ids);

        $files = array();
        foreach ($honors as $honor) {
            $filename = GENERATEPATH . 'honor/' . $honor->id . '.html';
            if ($honor->id == 0) {
                throw new ValidatorException(78);
            }
            $files[] = $filename;
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        return $this->dao->deleteBeans($honors);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询数据
     * @return Result
     */
    public function query($where) {
        $honors = $this->dao->query($where);
        foreach ($honors as $key => $value) {
            $value->plushtime = date('Y-m-d', $value->plushtime);
        }

        return $this->success($honors);
    }

    /**
     * 获得一条数据
     *
     * @param Entity $honor
     * @return Result
     */
    public function get($honor) {
        if (! $honor->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($honor->id, $honor);
        if ($honor->pic) {
            $honor->src = UPLOAD . $honor->pic;
        }

        return $this->success($honor);
    }

    /**
     * 保存数据
     *
     * @param Entity $honor
     * @return Result
     */
    public function save($honor) {
        $honor->plushtime = time();
        $honor->validate();
        $honor->click_count = rand(30, 1000);
        // 获取class对象并插入数据
        $this->dao->save($honor);
        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $honor
     * @return Result
     */
    public function update($honor) {
        if (! $honor->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($honor);
    }
}
