<?php
require_once ENTITYPATH . '/Entity.php';

class ResTemplate extends Entity {

    var $id;
    
    var $title;
    
    var $type;

    var $department_id;
    
    var $plushtime;
    
    var $description;

    // 验证字段
    public function validate() {        
        
        if (! strlen($this->title)) {
        	throw new ValidatorException(161);
        }
        
        if (! strlen($this->type)) {
        	throw new ValidatorException(160);
        }        

     }
}