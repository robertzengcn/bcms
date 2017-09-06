<?php

#.引用核心库类
ob_start();
define('Boyiweb', 'home');
//ini_set("display_errors", true);
require_once $_SERVER ['DOCUMENT_ROOT'] . '/web-setting.php';
require_once DAOPATH . '/ORMMap.php';
require_once KERNELPATH . '/Result.php';
require_once KERNELPATH . '/ErrorMsgs.php';
require_once KERNELPATH . '/LogMsgs.php';
require_once KERNELPATH . '/FilterService.php';
require_once DAOPATH . '/DTExpression.php';
require_once DAOPATH . '/DTOrder.php';
require_once ABSPATH . '/controller/Controller.php';
require_once ABSPATH . '/lib/FirePHPCore/fb.php';
require_once ABSPATH . '/lib/FirePHPCore/FirePHP.class.php';
require_once ABSPATH . '/lib/common/function/general.php';
require_once KERNELPATH . '/exception/ValidatorException.php';



if(empty($_GET['mod']) || !in_array($_GET['mod'], array('login', 'register','reservations','searchs','doctors','askss','departments','articles','feedbacks')))$_GET['mod'] = 'index';


if($_GET['mod'] =='index'){
	
	boyi_redirect(NETADDRESS);
}

try{
require_once ABSPATH.'/mod/'.ucfirst($_GET['mod']).'.php';
} catch (ValidatorException $ve) {
            $code = $ve->getCode();
            echo json_encode(new Result(false, $code, ErrorMsgs::get($code), null));
        } catch (Exception $e) {
            echo json_encode(new Result(false, '', $e->getMessage(), null));
        }