<?php
require_once ENTITYPATH . '/Entity.php';

class Worker extends Entity {

    var $id;

    var $name;

    var $password;

    var $group_id;

    var $plushtime;

    var $purview;
    
    var $acls;
    
    var $telephone;
    
    var $nick_name;

    public function validate() {
        if ($this->plushtime == '') {
            $this->plushtime = time();
        }
    }
}