<?php
require_once ENTITYPATH . '/Entity.php';

class MobilePicManager extends Entity {

    var $id;

    var $name;

    var $flag;

    var $img;

    var $link;

    var $sort;

    var $kind;
    
    var $cate;

    public function validate() {
    	return true;
        if (strlen($this->link) == 0) {
            throw new ValidatorException(159);
        }

        if (! $this->isUrl($this->link)) {
            throw new ValidatorException(55);
        } else {
            if (! $this->isSetHttp($this->link)) {
                $this->link = 'http://' . $this->link;
            }
        }
    }
}
