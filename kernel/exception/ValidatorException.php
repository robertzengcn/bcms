<?php

class ValidatorException extends Exception {

    public function __construct($code, $message = '') {
        parent::__construct($message, $code);
    }
}