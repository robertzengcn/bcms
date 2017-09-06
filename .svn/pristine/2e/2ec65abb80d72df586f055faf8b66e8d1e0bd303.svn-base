<?php
require_once ENTITYPATH . '/Entity.php';

class Business extends Entity {

    var $id;

    var $swt_id;

    var $url;

    public function validate() {
        if ($this->swt_id == '' || strlen($this->swt_id) == 0) {
            throw new ValidatorException(99);
        }
        if (! $this->isUrl($this->$url) || strlen($this->url) == 0) {
            throw new ValidatorException(100);
        }
    }
}
