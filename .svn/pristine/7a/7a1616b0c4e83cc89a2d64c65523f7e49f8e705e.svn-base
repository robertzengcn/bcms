<?php
require_once ENTITYPATH . '/Entity.php';

class ClientRecord extends Entity {

    var $id;

    var $client_id;  //Client表关联 ，id

    var $content;

    var $recordtime;
    
    //var $source;//客户来源   
    
    var $reception_id;//咨询人员ID
    

    public function validate() {
    	if ($this->recordtime == '' || $this->recordtime == '0') {
        	$this->recordtime = time();
        }
    }
}
