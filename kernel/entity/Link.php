<?php
require_once ENTITYPATH . '/Entity.php';

class Link extends Entity {

    var $id;

    var $name;

    var $url;

    var $sort;

    var $isdisplay;

    public function validate() {
        if (strlen($this->url) == 0) {
            throw new ValidatorException(94);
        }

        if (strlen($this->sort) == 0) {
            throw new ValidatorException(84);
        }

        if (strlen($this->isdisplay) == 0) {
            throw new ValidatorException(83);
        }

        if (! $this->isUrl($this->url)) {
            throw new ValidatorException(55);
        }

        if (! $this->isNum($this->sort)) {
            throw new ValidatorException(128);
        }

        if (! $this->isNum($this->isdisplay)) {
            throw new ValidatorException(129);
        }
    }
}
