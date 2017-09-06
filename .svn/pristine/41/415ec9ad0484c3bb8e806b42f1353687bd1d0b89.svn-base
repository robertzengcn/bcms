<?php

class DownloadService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new DownloadDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $environments = $this->dao->getBatch($ids);
        fb($environments,"environment");
        $files = array();
        foreach ($environments as $environment) {
            $filename = GENERATEPATH . 'data/download/' . $environment->nmae;
            if ($environment->id == 0) {
                throw new ValidatorException(78);
            }
            $files[] = $filename;
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        return $this->dao->deleteBeans($environments);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $environments = $this->dao->query($where);

        foreach ($environments as $key => $value) {
            $value->plushtime = date('Y-m-d', $value->plushtime);
        }

        return $this->success($environments);
    }

    /**
     * 获得一条数据
     *
     * @param Entity $environment
     * @return Result
     */
    public function get($environment) {
        if (! $environment->id) {
            throw new ValidatorException(7);
        }
        $this->dao->get($environment->id, $environment);
        return $this->success($environment);
    }

    /**
     * 保存数据
     *
     * @param Entity $enviorment
     * @return Result
     */
    public function save($environment) {
        $environment->plushtime = time();
        $environment->validate();
        //$environment->click_count = rand(30, 1000);
        // 获取class对象并插入数据
        $this->dao->save($environment);

        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $environment
     * @return Result
     */
    public function update($environment) {
        $environment->validate();
        if (! $environment->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($environment);
    }
}
