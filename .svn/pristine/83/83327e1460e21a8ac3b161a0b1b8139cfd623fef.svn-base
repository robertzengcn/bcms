<?php

class WorkHistoryService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new WorkHistoryDAO();
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
     * 根据医生ID删除数据
     *
     * @param array $doctor_ids
     */
    public function deleteByDoctor($doctorIds) {
        foreach ($doctorIds as $value) {
            $this->dao->deleteByDoctor($value);
        }

        return $this->success();
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $workHistorys = $this->dao->query($where);
        foreach ($workHistorys as $key => $value) {
            $value->endtime = date('Y-m-d', $value->endtime);
            $value->begintime = date('Y-m-d', $value->begintime);
        }

        return $this->success($workHistorys);
    }

    /**
     * 获得医生简历数据
     *
     * @param Entity $workhistory
     * @return Result
     */
    public function get($workHistory) {
        $this->dao->get($workHistory->id, $workHistory);
        $workHistory->endtime = date('Y-m-d', $workHistory->endtime);
        $workHistory->begintime = date('Y-m-d', $workHistory->begintime);

        return $this->success($workHistory);
    }

    /**
     * 保存数据
     *
     * @param Entity $workhistory
     * @return Result
     */
    public function save($workHistory) {
        $workHistory->validate();

        $workHistory->begintime = strtotime($_REQUEST['begintime']);
        $workHistory->endtime = strtotime($_REQUEST['endtime']);
        // 获取class对象并插入数据
        $this->dao->save($workHistory);

        return $this->success();
    }

    /**
     * 更改数据
     *
     * @param Entity $workhistory
     * @return Result
     */
    public function update($workHistory) {
        $workHistory->validate();

        $workHistory->begintime = strtotime($_REQUEST['begintime']);
        $workHistory->endtime = strtotime($_REQUEST['endtime']);
        // 获取class对象并修改数据
        $tempWorkhistory = new WorkHistory();
        $this->dao->get($workHistory->id, $tempWorkhistory);
        $workHistory->doctor_id = $tempWorkhistory->doctor_id;

        return $this->dao->update($workHistory);
    }
}
