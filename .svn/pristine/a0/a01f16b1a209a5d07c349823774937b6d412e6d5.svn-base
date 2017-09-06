<?php
require_once ENTITYPATH . '/Entity.php';

class Library extends Entity {

    var $id;

    var $name;

    var $content;
    
    var $plushtime;

    public function validate() {
        if ($this->name == '' || strlen($this->name) == 0) {
            throw new ValidatorException(19);
        }
        if ($this->content == '' || strlen($this->content) == 0) {
        	throw new ValidatorException(5);
        }
        if ($this->plushtime == '' || (int)$this->plushtime == 0) {
        	$this->plushtime = time();
        }
    }
}