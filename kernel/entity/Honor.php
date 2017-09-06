<?php
require_once ENTITYPATH . '/Entity.php';

class Honor extends Entity {

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
        if (strlen($this->content) == 0) {
            throw new ValidatorException(5);
        }

        if (strlen($this->subject) == 0) {
            throw new ValidatorException(6);
        }

        if (strlen($this->pic) == 0) {
            throw new ValidatorException(12);
        }
        if ($this->plushtime == '' || strlen($this->plushtime) == 0) {
            $this->plushtime = time();
        }
    }
}
