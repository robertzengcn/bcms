<?php
require_once ENTITYPATH . '/Entity.php';

class ResDepartment extends Entity {

    var $id;

    var $name;

    var $description;

    var $content;
    
    var $belong;

    public function validate() {
    
        if ($this->name == '' || strlen($this->name) == 0) {
            throw new ValidatorException(67);
        }
    }
}
