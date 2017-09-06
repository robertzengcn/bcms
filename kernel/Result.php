<?php

class Result {

    var $statu;

    var $code;

    var $msg;

    var $data;

    public function __construct($statu, $code, $msg, $data) {
        $this->statu = $statu;
        $this->code = $code;
        $this->msg = $msg;
        $this->data = $data;
    }

    public function __destruct() {}

    public function toJSON() {
        return json_encode($this);
    }
}