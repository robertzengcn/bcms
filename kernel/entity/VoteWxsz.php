<?php
require_once ENTITYPATH . '/Entity.php';

class VoteWxsz extends Entity {

    var $id;

    var $vid;

    var $appid;

    var $appsecret;

    public function validate() {
        if ($this->appid == '' || strlen($this->appid) == 0) {
            throw new ValidatorException(64);
        }
        if ($this->appsecret == '' || strlen($this->appsecret) == 0) {
            throw new ValidatorException(65);
        }
    }
}
