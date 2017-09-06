<?php

/**
 * Feedback数据实体类
 * @author Administrator
 */
require_once ENTITYPATH . '/Entity.php'; // 引入数据实体基类
class Physicalexam extends Entity {

    public $id; // 主键id
    public $plushtime; // 提交时间
    public $name; // 姓名
    public $tel; // 联系电话
    public $ischeck; // 是否审阅,0为未审阅,1为已审阅
   // public $content; // 内容
	
	
    /**
     * 数据验证debug
     *
     * @see kernel/entity/Entity::validate()
     */
    public function validate() {
        if ($this->content == '' || ! isset($this->content)) {
            throw new ValidatorException(112);
        }
        if ($this->plushtime == '' || strlen($this->plushtime) == 0) {
            $this->plushtime = time();
        }
        
    }
}
