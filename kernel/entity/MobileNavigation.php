<?php
require_once ENTITYPATH . '/Entity.php';

class MobileNavigation extends Entity {

    var $id;

    var $subject;

    var $flag;

    var $is_display;
    
    var $is_group;
    
    var $url;
    
    var $layer;
    
    var $pid;
    
    var $sort;
    
    var $cate;
    
    var $name;
    
    var $group_id;
    
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

