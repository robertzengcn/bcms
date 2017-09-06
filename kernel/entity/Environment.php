<?php
require_once ENTITYPATH . '/Entity.php';

class Environment extends Entity {

    var $id;

    var $subject;

    var $pic;

    var $content;

    var $title;

    var $keywords;

    var $description;

    var $tag;

    var $plushtime;

    var $click_count;

    public function validate() {
        if ($this->subject == '' || strlen($this->subject) == 0) {
            throw new ValidatorException(6);
        }
        if ($this->content == '' || strlen($this->content) == 0) {
            throw new ValidatorException(5);
        }
        if ($this->pic == '' || strlen($this->pic) == 0) {
            throw new ValidatorException(12);
        }
    }
}

