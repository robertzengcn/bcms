<?php
require_once ENTITYPATH . '/Entity.php';

class ClientData extends Entity {

    var $id;

    var $zx_total;

    var $res_total;

    var $department;

    var $kefu;
	
    var $week;

    var $source;
	
    var $daytime;
 
    var $data_md5;
	
    public function validate() {
    }
}
