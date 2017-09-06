<?php
require_once ENTITYPATH . '/Entity.php';

class ErrorPage extends Entity {

    var $id;

    var $code;

    var $content;

    var $page;

    var $defaultpage;

    public function validate() {
        if ($this->code == '' || strlen($this->code) == 0) {
            throw new ValidatorException(86);
        } else {
            $pattern = '/^\d{3}$/';
            $result = preg_match($pattern, $this->code);
            if (! $result) {
                throw new ValidatorException(147);
            }
        }
        if ($this->page == '' || strlen($this->page) == 0) {
            throw new ValidatorException(87);
        }
    }
}