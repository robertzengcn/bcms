<?php
require_once ENTITYPATH . '/Entity.php';

class StatisticsLog extends Entity {

    var $id;

    var $ip;

    var $visittime;

    var $sessionid;

    var $fromurl;

    var $url;

    public function validate() {}
}