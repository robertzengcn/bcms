<?php
require_once ENTITYPATH . '/Entity.php';

class Tag extends Entity {

    var $id;

    var $tag;

    var $plushtime;

    public function validate() {
        if (strlen($this->$tag) == 0) {
            throw new ValidatorException(43);
        }

        if ($this->plushtime == '' || strlen($this->plushtime) == 0) {
            $this->plushtime = time();
        }
    }
}
