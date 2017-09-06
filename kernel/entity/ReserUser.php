<?php
require_once ENTITYPATH . '/Entity.php';

class ReserUser extends Entity {

    var $id;

    var $name;

    var $sex;

    var $age;

    var $date;

    var $time;

    var $address;

    var $hometel;

    var $email;

    var $ill;
    
    var $reservation_id;
    
    var $reservation_fid;
    
    var $member_id;

    public function validate() {
        if (strlen($this->name) == 0) {
            throw new ValidatorException(19);
        }
        if ($this->time == '' || strlen($this->time) == 0) {
            $this->time = time();
        }
    }
}
