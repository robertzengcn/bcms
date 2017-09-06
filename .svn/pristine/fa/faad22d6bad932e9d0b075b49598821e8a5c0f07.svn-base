<?php
require_once ENTITYPATH . '/Entity.php';

class Pic extends Entity {

    var $id;

    var $pid;

    var $pic;

    var $url;

    var $sort;

    var $text;

    public function validate() {

        if (strlen($this->sort) == 0) {
            throw new ValidatorException(84);
        }

        if (strlen($this->pic) == 0) {
            throw new ValidatorException(98);
        }

        if (strlen($this->url) != 0&&! $this->isUrl($this->url)) {
            throw new ValidatorException(55);
        }

        if (! $this->isNum($this->sort)) {
            throw new ValidatorException(128);
        }
    }
}

