<?php

/**
 * 在线问答(追问)实体类
 * @author Administrator
 */
require_once ENTITYPATH . '/Entity.php'; // 引入数据实体基类
class AskAddto extends Entity {

    public $id; // 主键id
    public $mode; // 1为追问,0为回复
    public $askID; // 问题主键id
    public $ansID; // 问题回复表主键ID
    public $info; // 追问内容(回答内容)
    public $plushtime; // 回复或追问的时间
    public $useful; // 顶
    public $useless; // 踩
    public $addID;//追问或回复

    /**
     * 数据验证debug
     *
     * @see kernel/entity/Entity::validate()
     */
    public function validate() {}
}
