<?php
require_once ENTITYPATH . '/Entity.php';

class Websitecontent extends Entity {

    var $id;

    var $website_id;

    var $type;

    var $content;

    var $addtime;

    public function validate() {
        if ($this->addtime == '' || strlen($this->addtime) == 0) {
            $this->addtime = time();
        }
    }
}