<?php
require_once ENTITYPATH . '/Entity.php';

class Client extends Entity {

    var $id;

    var $username;

    var $gender;//性别

    var $age;

    var $birthday;    
    
    var $address;

    var $telephone;

    var $email;

    var $qq;
    
    var $mark;//备注
    
    var $plushtime;
    
    var $res_code;//预约信息关联ID   resbookinginfo  ID
    
    var $ad_record; //新增  征信记录  预约后按时赴约次数（信用评估）
    
    //var $focus_id;//关注人ID
    
    //var $last_source;//最新来源渠道，评定用户关联性

    var $last_reception;//最后一次对接的客服人员ID
    
    var $source;
    
    public function validate() {
        if ($this->plushtime == '' || $this->plushtime == '0') {
        	$this->plushtime = time();
        }
    }
}
