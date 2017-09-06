<?php
require_once ENTITYPATH . '/Entity.php';

class Website extends Entity {

    var $id;

    var $hospital;

    var $domain;

    var $ip;

    var $port;

    var $db;

    var $user;

    var $pwd;

    var $addtime;

    public function validate() {
        /*if (strlen($this->hospital) == 0) {
            throw new ValidatorException('aaaaa');
        }

        if (strlen($this->domain) == 0) {
            throw new ValidatorException(2);
        }

        if (strlen($this->ip) == 0) {
            throw new ValidatorException(3);
        }
        
        if (strlen($this->port) == 0) {
            throw new ValidatorException(4);
        }
        
        if (strlen($this->db) == 0) {
            throw new ValidatorException(5);
        }
        
        if (strlen($this->user) == 0) {
            throw new ValidatorException(6);
        }
        
        if (strlen($this->pwd) == 0) {
            throw new ValidatorException(7);
        }
        */
        if ($this->addtime == '' || strlen($this->addtime) == 0) {
            $this->addtime = time();
        }
    }
}