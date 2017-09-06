<?php
//header("Content-type: text/html; charset=utf-8");
require_once './HISWebservice.php';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if (empty($action)) {
	exit(json_encode("{$action}不存在"));
}

try {
    unset($_REQUEST['action']);
    
    $service = new HISWebservice();
    $result = '';
    
    switch ($action) {
    	case 'QueryClinicDoctor': //查询门诊医生
    	    $result = $service->QueryClinicDoctor($_REQUEST);
    	    break;
    	case 'QueryClinicDept': //查询门诊科室
    	    $result = $service->QueryClinicDept($_REQUEST);
    	    break;
    	case 'QueryNumbers': //查询号源
    	    //根据科室获取号源，返回SourceCode,SqNo,StartTime(HH:MI),EndTime(HH:MI)
    	    $result = $service->QueryNumbers($_REQUEST);
    	    break;
    	case 'Unlock': //释号
    	    $orderId = '';
    	    $result = $service->Unlock($orderId);
    	    break;
    	case 'BookService':
    	    //锁号
    	    $_REQUEST['CardNo'] = isset($_REQUEST['CardNo']) ? $_REQUEST['CardNo'] : '初诊';
    	    $result = $service->LockOrder($_REQUEST);
    	    $msg = $service->getErrorMsg();
    	    if (!empty($msg)) {
    	        exit(json_encode($msg));
    	    }
    	    
    	    $sqNo = $result['SqNo'];
    	    file_put_contents('orderid', $_REQUEST['Name'] . ':' . $result['OrderId'] . ':' . $result['SqNo']);
    	    
    	    //挂号
    	    //$_REQUEST['OrderId'] = 'LY' . time() . rand(100000, 999999);
    	    $_REQUEST['OrderId'] = $result['OrderId'];
    	    
    	    $_REQUEST['IdCardNo'] = isset($_REQUEST['IdCardNo']) ? $_REQUEST['IdCardNo'] : '';
    	    $_REQUEST['Sex'] = isset($_REQUEST['Sex']) ? $_REQUEST['Sex'] : 3; //默认未知
    	    $_REQUEST['Address'] = isset($_REQUEST['Address']) ? $_REQUEST['Address'] : '';
    	    $_REQUEST['CardType'] = isset($_REQUEST['CardType']) ? $_REQUEST['CardType'] : '1'; //默认就诊卡
    	    $_REQUEST['RegFlag'] = isset($_REQUEST['RegFlag']) ? $_REQUEST['RegFlag'] : '2'; //默认预约
    	    $_REQUEST['OperatorId'] = isset($_REQUEST['OperatorId']) ? $_REQUEST['OperatorId'] : 'test';
    	    $_REQUEST['OperatorName'] = isset($_REQUEST['OperatorName']) ? $_REQUEST['OperatorName'] : 'test';
    	    $result = $service->BookService($_REQUEST);
    	    $result['SqNo'] = $sqNo;
    	    break;
    	case 'YYCancel': //退号
    	    $data = array(
    	        'OrderId' => isset($_REQUEST['IdCardNo']) ? $_REQUEST['IdCardNo'] : '',
        	    'Reason' => isset($_REQUEST['IdCardNo']) ? $_REQUEST['IdCardNo'] : '接口测试',
        	    'Price' => isset($_REQUEST['IdCardNo']) ? $_REQUEST['IdCardNo'] : '0.00',
        	    'OperatorId' => isset($_REQUEST['IdCardNo']) ? $_REQUEST['IdCardNo'] : 'test',
        	    'OperatorName' => isset($_REQUEST['IdCardNo']) ? $_REQUEST['IdCardNo'] : 'test'
    	    );
    	    $result = $service->YYCancel($data);
    	    break;
    	case 'QueryRegInfo': //预约信息查询
    	    $result = $service->QueryRegInfo();
    	    break;
    	case 'CardType': //卡类型
    	    $result = $service->CardType();
    	    break;
    	case 'Sex': //性别
    	    $result = $service->Sex();
    	    break;
    	default:
    	    break;
    }
} catch (Exception $e) {
    exit(json_encode($e->getMessage()));
}

$msg = $service->getErrorMsg();
if (!empty($msg)) {
	exit(json_encode($msg));
}

exit(json_encode($result));
