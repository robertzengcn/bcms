<?php

class DeviceService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new DeviceDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $devices = $this->dao->getBatch($ids);

        $files = array();
        foreach ($devices as $device) {
            $filename = GENERATEPATH . 'device/' . $device->id . '.html';
            if ($device->id == 0) {
                throw new ValidatorException(78);
            }
            $files[] = $filename;
        }

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }

        return $this->dao->deleteBeans($devices);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $devices = $this->dao->query($where);
        foreach ($devices as $key => $value) {
            $value->plushtime = date('Y-m-d', $value->plushtime);
        }

        return $this->success($devices);
    }

    /**
     * 获得一条数据
     *
     * @param Entity $device
     * @return Result
     */
    public function get($device) {
        if (! $device->id) {
            throw new ValidatorException(7);
        }

        $this->dao->get($device->id, $device);
        if ($device->pic) {
            $device->src = UPLOAD . $device->pic;
        }

        return $this->success($device);
    }

    /**
     * 保存数据
     *
     * @param Entity $device
     * @return Result
     */
    public function save($device) {
        $device->plushtime = time();
        $device->validate();
        $device->click_count = rand(30, 1000);
        // 获取class对象并插入数据
        $this->dao->save($device);

        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $device
     * @return Result
     */
    public function update($device) {
        $device->validate();
        if (! $device->id) {
            throw new ValidatorException(7);
        }
        return $this->dao->update($device);
    }

    /**
     * 获取所有设备信息
     *
     * @return Result
     */
    function getDevices() {
        $devices = $this->dao->getDevices();

        return $this->success($devices);
    }
}
