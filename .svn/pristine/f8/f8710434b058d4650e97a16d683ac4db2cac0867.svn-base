<?php
require_once ENTITYPATH . '/Entity.php';

class ThirdStat extends Entity {

    var $id;

    var $subject;

    var $js;

    var $isuse;

    public function validate() {
        if (strlen($this->subject) == 0) {
            throw new ValidatorException(106);
        }

        if (strlen($this->js) == 0) {
            throw new ValidatorException(107);
        }

        if (strlen($this->isuse) == 0) {
            throw new ValidatorException(108);
        }
    }
}
