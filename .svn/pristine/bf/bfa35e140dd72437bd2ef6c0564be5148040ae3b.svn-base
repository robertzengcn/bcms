<?php
require_once ENTITYPATH . '/Entity.php';

class Seo extends Entity {

    var $id;

    var $page_name;

    var $flag;

    var $title;

    var $keywords;

    var $description;

    var $is_retain;

    public function validate() {
        if (strlen($this->page_name) == 0) {
            throw new ValidatorException(90);
        }

        if (strlen($this->flag) == 0) {
            throw new ValidatorException(110);
        }

        if (strlen($this->title) == 0) {
            throw new ValidatorException(91);
        }

        if (strlen($this->keywords) == 0) {
            throw new ValidatorException(92);
        }

        if (strlen($this->description) == 0) {
            throw new ValidatorException(93);
        }
    }
}
