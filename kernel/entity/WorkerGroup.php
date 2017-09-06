<?php
require_once ENTITYPATH . '/Entity.php';

class WorkerGroup extends Entity {

    var $id;

    var $name;

    var $mark;//备注
    
    var $acls;//组权限

    public function validate() {

    }
}
