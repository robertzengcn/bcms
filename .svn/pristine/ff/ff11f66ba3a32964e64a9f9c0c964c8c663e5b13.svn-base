<?php


include_once 'init.php';
class getContact extends Mobile{
    function __contruct(){
          parent::__construct();
    }

    public function runContact(){
        $flag = $_REQUEST['flag'];
        $result =  $this->getServiceMethod('Contact','getContact',$flag);

        echo  json_encode($result);

    }

}

$run = new getContact();
$funName = $_REQUEST['funName'];
$run->$funName();