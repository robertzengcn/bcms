<?php
require_once ENTITYPATH . '/Entity.php';

class Department extends Entity {

    var $id;

    var $name;

    var $url;

    var $title;

    var $keywords;

    var $description;

    var $tplurl;
    
    var $pic;
    
    var $content;
    
    var $orders;

    public function validate() {
    	
        if ($this->name == '' || strlen($this->name) == 0) {
            throw new ValidatorException(67);
        }
        if ($this->url == '' || strlen($this->url) == 0) {
            throw new ValidatorException(68);
        }
        $pattern = '/^[a-zA-Z]+$/';
        if (! preg_match($pattern, $this->url)) {
            throw new ValidatorException(141);
        }
    }
}
