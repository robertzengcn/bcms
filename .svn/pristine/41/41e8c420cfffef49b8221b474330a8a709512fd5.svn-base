<?php

/**
 * ask数据实体类
 * @author Administrator
 */
require_once ENTITYPATH . '/Entity.php'; // 引入数据实体基类
class Answer extends Entity {

    public $id; // 主键id
    public $askID; // ask对应问题id
    public $hosID; // 医院id(为之后多医院回答做准备)
    public $docID; // 回答医师id(取后台登录用户id即可)
    public $content; // 回答内容
    public $plushtime; // 回答时间
    public $useful; // 顶
    public $useless; // 踩

    /**
     * 数据验证debug
     *
     * @see kernel/entity/Entity::validate()
     */
    public function validate() {
        if ((int) $this->askID <= 0) {
            throw new ValidatorException(7);
        }
        if ($this->content == '') {
            throw new ValidatorException(112);
        }
    }
}
