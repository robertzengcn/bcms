<?php
require_once ENTITYPATH . '/Entity.php';

class WorkHistory extends Entity {

    var $id;

    var $begintime;

    var $endtime;

    var $company;

    var $position;

    var $remark;

    var $doctor_id;

    public function validate() {
        if (strlen($this->begintime) == 0) {
            throw new ValidatorException(73);
        }

        if (strlen($this->endtime) == 0) {
            throw new ValidatorException(74);
        }
    }
}
