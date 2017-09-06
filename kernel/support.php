<?php
if (empty($_SERVER["DOCUMENT_ROOT"])) {
    $_SERVER["DOCUMENT_ROOT"] = dirname(dirname(__FILE__));
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/web-setting.php";
require_once DAOPATH . "/ORMMap.php";
require_once KERNELPATH . "/Result.php";
require_once KERNELPATH . "/ErrorMsgs.php";
require_once KERNELPATH . "/LogMsgs.php";
require_once DAOPATH . "/DTExpression.php";
require_once DAOPATH . "/DTOrder.php";
require_once KERNELPATH . "BaseService.php";
require_once DAOPATH . "DBBaseDAO.php";
require_once KERNELPATH . "exception/ValidatorException.php";

