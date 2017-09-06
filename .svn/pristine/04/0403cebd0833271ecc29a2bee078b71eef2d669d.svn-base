<?php
require_once ENTITYPATH . '/Entity.php';

class Navigation extends Entity {

    var $id;

    var $subject;

    var $url;

    var $layer;

    var $pid;

    var $sort;

    var $cate;

    var $is_display;
    
    var $pic;

    public function validate() {
    	
        if (strlen($this->sort) == 0) {
            throw new ValidatorException(84);
        }

        if (strlen($this->cate) == 0) {
            throw new ValidatorException(82);
        }

        if (strlen($this->is_display) == 0) {
            throw new ValidatorException(83);
        }
    }
}

