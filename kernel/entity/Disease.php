<?php
require_once ENTITYPATH . '/Entity.php';

class Disease extends Entity {

    var $id;

    var $name;

    var $url;

    var $title;

    var $keywords;

    var $description;

    var $department_id;

    var $pic;

    var $tplurl;
    
    var $layer;
    
    var $parent_id;
    
    var $content;

    public function validate() {
        if ($this->name == '' || strlen($this->name) == 0) {
            throw new ValidatorException(69);
        }
        if ($this->url == '' || strlen($this->url) == 0) {
            throw new ValidatorException(70);
        }
        $pattern = '/^[a-zA-Z]+$/';
        if (! preg_match($pattern, $this->url)) {
            throw new ValidatorException(141);
        }

        if (! $this->isNum($this->department_id) || strlen($this->department_id) == 0) {
            throw new ValidatorException(27);
        }
    }
}
