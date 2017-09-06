<?php
require_once ENTITYPATH . '/Entity.php';

class Introduce extends Entity {

    var $id;
    
    var $pic;

    var $content;
    
    var $title;

    var $keywords;

    var $description;

    var $plushtime;

    public function validate() {
        if (strlen($this->content) == 0) {
            throw new ValidatorException(53);
        }
    }
}
