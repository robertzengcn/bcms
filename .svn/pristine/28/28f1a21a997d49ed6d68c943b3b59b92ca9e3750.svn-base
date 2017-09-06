<?php
require_once ENTITYPATH . '/Entity.php';

class ResDoctor extends Entity {

    var $id;

    var $name;

    var $pic;

    var $birthday;

    var $gender;

    var $content;

    var $certificate;

    var $specialty;

    var $cultural;

    var $university;

    var $description;

    var $plushtime;    

    var $position;   
    
    var $department_id;
    
    var $relation_id;
    

    public function validate() {
        if ($this->name == '' || strlen($this->name) == 0) {
            throw new ValidatorException(71);
        }
        if ($this->content == '' || strlen($this->content) == 0) {
            throw new ValidatorException(126);
        }
        if ($this->specialty == '' || strlen($this->specialty) == 0) {
            throw new ValidatorException(123);
        }
        
        if ($this->position == '' || strlen($this->position) == 0) {
            throw new ValidatorException(157);
        }
    }
}
