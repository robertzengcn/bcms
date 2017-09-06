<?php
/**
 * ask(化验单)数据实体类
 * @author Administrator
 */
require_once ENTITYPATH . '/Entity.php'; // 引入数据实体基类
class AskAssay extends Entity {

    public $id; // 主键id
    public $askID; // ask表外键id
    public $item = array(); // 检查项目
    public $consult = array(); // 参考值
    public $unit = array(); // 单位
    public $finally = array(); // 结果

    /**
     * 数据验证::由于都是可选项,所以除了ask外键id，其余都为空没关系debug
     *
     * @see kernel/entity/Entity::validate()
     */
    public function validate() {
        if ((int) $this->ask_id <= 0) {
            throw new ValidatorException(7);
        }
    }
}