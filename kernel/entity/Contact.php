<?php
require_once ENTITYPATH . '/Entity.php';

class Contact extends Entity {

    var $id;

    var $flag;

    var $name;

    var $val;

    var $is_retain;

    public function validate() {
        if ($this->name == '' || strlen($this->name) == 0) {
            throw new ValidatorException(19);
        }
//         if ($this->name == 'ICP备案号') {
//             if ($this->val == '' || strlen($this->val) == 0) {
//                 throw new ValidatorException(20);
//             } else {
//                 if (! $this->isNum($this->val)) {
//                     throw new ValidatorException(119);
//                 }
//             }
//         }
        if ($this->name == '商务通') {
            if ($this->val == '' || strlen($this->val) == 0) {
                throw new ValidatorException(20);
            } else {
                if (! $this->isUrl($this->val)) {
                    throw new ValidatorException(120);
                }
            }
        }

    }
}