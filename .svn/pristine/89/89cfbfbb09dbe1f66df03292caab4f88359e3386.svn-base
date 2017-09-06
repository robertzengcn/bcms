<?php
require_once ENTITYPATH . '/Entity.php';

class Download extends Entity {

    var $id;

    var $name;

    var $plushtime;

    var $isshow;

    var $url;

    var $sort;
    
    public function validate() {
        if ($this->name == '' || strlen($this->name) == 0) {
            throw new ValidatorException(6);
        }
        if ($this->plushtime == '' || strlen($this->plushtime) == 0) {
            $this->plushtime = time();
        }
        
    }
}
