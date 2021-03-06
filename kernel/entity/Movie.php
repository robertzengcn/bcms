<?php
require_once ENTITYPATH . '/Entity.php';

class Movie extends Entity {

    var $id;

    var $subject;

    var $pic;

    var $content;

    var $plushtime;

    var $updatetime;

    var $link;
    
    var $click_count;
	
	var $description;
	
	var $flag;

    public function validate() {
        if (strlen($this->subject) == 0) {
            throw new ValidatorException(6);
        }

        if (strlen($this->content) == 0) {
            throw new ValidatorException(17);
        }

        if (! $this->isUrl($this->link)) {
            throw new ValidatorException(55);
        }
    }
}
