<?php
require_once 'HISAbstract.php';
require_once 'HISInterface.php';
require_once '../nusoap.php';

header("Content-type:text/html;charset=utf-8");
class HISWebservice extends  HISAbstract implements HISInterface
{
    private $client = null;
    private $msg = '';
    public function __construct()
    {
    	parent::__construct();
    	$this->client = $this->getSoapClient();
    }
    
    /**
     * 基础查询-医院信息查询
     * */
    public function QueryHospital() {
        $xml = '<Req>
<TransactionCode></TransactionCode>
<Data>
<HosId>' . $this->hosId . '</HosId>
</Data>
</Req>';
        $params = $this->formatData('basic.BasicApi.QueryHospital', $xml);
        $result = $this->sendMessage($params, $this->msg);
        if (!$result) {
        	die($this->msg);
        }
        
        return $result;
        
    }

    /**
     * queryBaseDept()
     *
     * 基础查询-查询门诊科室
     *
     * 查询科室列表包含行政科室部门等医院的科室应该是分为门诊科室和行政科室，门诊科室只用于挂号、诊疗等，但是行政科室是用来做oa或其它相关医院介绍等。
     *
     *@param  $data = array(
     *            'HosId' => int,医院id
     *            'DeptType' => int,1行政科室，2门诊科室
     *            'DeptName' => string,科室名称，可选
     *            'DeptCode' => string,科室代码（id）， 可选
     *        )
     * */
    public function QueryBaseDept($data = array())
    {
        $attributes = array(
            'HosId' => $this->hosId,
        	'DeptName' => isset($data['DeptName']) ? $data['DeptName'] : '',
            'DeptCode' => isset($data['DeptCode']) ? $data['DeptCode'] : '',
            'DeptType' => isset($data['DeptType']) ? $data['DeptType'] : 2
        );
        $xml = $this->dataToXml($attributes);
        
        $params = $this->formatData('basic.BasicApi.QueryBaseDept', $xml);
        $result = $this->sendMessage($params, $this->msg);
        if (!$result) {
        	die($this->msg);
        }
        
        return $result;
        
    }
    
    /**
     * QueryBaseDoctor()
     *
     * 基础查询-查询门诊医生
     *
     *
     *@param  $data = array(
     *            'HosId' => int,医院id
     *            'DeptCode' => string,科室代码（id）， 必须，否则为所有科室
     *            'DoctorType' => int,1行政医生，2门诊医生，必须
     *            'DoctorName' => string,医生名称，可选
     *            'DoctorCode' => string,医生编码，可选
     *        )
     * */
    public function QueryBaseDoctor($data = array())
    {
        $attributes = array(
            'HosId' => $this->hosId,
            'DeptCode' => isset($data['DeptCode']) ? $data['DeptCode'] : '',
            'DoctorCode' => isset($data['DoctorCode']) ? $data['DoctorCode'] : '',
            'DoctorName' => isset($data['DoctorName']) ? $data['DoctorName'] : '',
            'DoctorType' => isset($data['DoctorType']) ? $data['DoctorType'] : 2
        );
        $xml = $this->dataToXml($attributes);
        $params = $this->formatData('basic.BasicApi.QueryBaseDoctor', $xml);
        $result = $this->sendMessage($params, $this->msg);
        if (!$result) {
            die($this->msg);
        }
    
        return $result;
    
    }
    
    /**
     * QueryClinicDept()
     *
     * 门诊资源-查询门诊科室
     *
     *
     *@param  $data = array(
     *            'HosId' => int,医院id
     *            'DeptName' => string, 科室名称，可选
     *            'DeptCode' => string, 科室代码（id）， 可选
     *            'WorkDateStart' => date, 查询有出诊日期范围（YYYY-MM-DD） 开始，可选
     *            'WorkDateEnd' => date, 查询有出诊日期范围（YYYY-MM-DD） 结束，可选
     *            'WorkTime' => int, 查询有出诊日期范围 时段0-全天 1-上午 2-下午， 可选
     *            'RegType' => int, 获取的号源类别，可选
     *        );
     * */
    public function QueryClinicDept($data = array())
    {
        $attributes = array(
            'HosId' => $this->hosId,
            'DeptName' => isset($data['DeptName']) ? $data['DeptName'] : '',
            'DeptCode' => isset($data['DeptCode']) ? $data['DeptCode'] : '',
            'WorkDateStart' => isset($data['WorkDateStart']) ? $data['WorkDateStart'] : '',
            'WorkDateEnd' => isset($data['WorkDateEnd']) ? $data['WorkDateEnd'] : '',
            'WorkTime' => isset($data['WorkTime']) ? $data['WorkTime'] : 0,
            'RegType' => isset($data['RegType']) ? $data['RegType'] : 0,
        );
        $xml = $this->dataToXml($attributes);
        $params = $this->formatData('yy.yygh.QueryClinicDept', $xml);
        $result = $this->sendMessage($params, $this->msg);
        
        //print_r($result);
        return $result;
    
    }
    
    /**
     * QueryClinicDoctor()
     *
     * 门诊资源-查询门诊医生（排班信息）
     *
     *
     *@param  $data = array(
     *            'HosId' => int,医院id
     *            'DoctorName' => string,医生名称：支持模糊检索，可选
     *            'DoctorCode' => string,医生编码，可选
     *            'DeptCode' => string, 科室代码（id）， 必须
     *            'DoctorTitleCode' => string,医生职称编码，可选
     *            'ScheduleId' => string,排班id，可选
     *            'WorkDateStart' => date, 查询有出诊日期范围（YYYY-MM-DD） 开始，可选
     *            'WorkDateEnd' => date, 查询有出诊日期范围（YYYY-MM-DD） 结束，可选
     *        );
     * */
    public function QueryClinicDoctor($data = array())
    {
        $attributes = array(
            'HosId' => $this->hosId,
            'DoctorName' => isset($data['DoctorName']) ? $data['DoctorName'] : '',
            'DoctorCode' => isset($data['DoctorCode']) ? $data['DoctorCode'] : '',
            'DeptCode' => isset($data['DeptCode']) ? $data['DeptCode'] : '',
            'DoctorTitleCode' => isset($data['DoctorTitleCode']) ? $data['DoctorTitleCode'] : '',
            'ScheduleId' => isset($data['ScheduleId']) ? $data['ScheduleId'] : '',
            'WorkDateStart' => isset($data['WorkDateStart']) ? $data['WorkDateStart'] : '',
            'WorkDateEnd' => isset($data['WorkDateEnd']) ? $data['WorkDateEnd'] : ''
        );
        $xml = $this->dataToXml($attributes);
        $params = $this->formatData('yy.yygh.QueryClinicDoctor', $xml);
        $result = $this->sendMessage($params, $this->msg);
        //print_r($result);
        return $result;
    
     }
     
     /**
      * QueryNumbers()
      *
      * 门诊资源-查询号源信息
      *
      *
      *@param  $data = array(
      *            'HosId' => int,医院id
      *            'DeptCode' => string, 科室代码（id）， 必须
      *            'DoctorCode' => string, 医生编码， 必须
      *            'RegDate' => string, 出诊日期（YYYY-MM-DD）， 必须
      *            'TimeSlice' => int, 班次:0全天,1上午,2下午    ， 必须
      *            'ScheduleId' => string, 排班id，可选
      *        );
      * */
     public function QueryNumbers($data = array())
     {
         $attributes = array(
             'HosId' => $this->hosId,
             'DeptCode' => isset($data['DeptCode']) ? $data['DeptCode'] : '',
             'DoctorCode' => isset($data['DoctorCode']) ? $data['DoctorCode'] : '',
             'RegDate' => isset($data['RegDate']) ? $data['RegDate'] : '',
             'TimeSlice' => isset($data['TimeSlice']) ? $data['TimeSlice'] : 0,
             'ScheduleId' => isset($data['ScheduleId']) ? $data['ScheduleId'] : ''
         );
         $xml = $this->dataToXml($attributes);
         
         $params = $this->formatData('yy.yygh.QueryNumbers', $xml);
         $result = $this->sendMessage($params, $this->msg);
         if (!$result) {
             die($this->msg);
         }
     
         return $result;
     
     }
     
     /**
      * LockOrder()
      *
      * 预约功能-锁号（注意:每次返回的订单号都是全局唯一的建议使用：GUID）
      *
      *
      *@param  $data = array(
      *            'HosId' => int,医院id
      *            'DeptCode' => string, 科室代码（id）， 必须
      *            'DoctorCode' => string, 医生编码， 必须
      *            'CardType' => int, 证件类型， 必须
      *            'CardNo' => string, 证件号， 必须
      *            'RegType' => string, 号源类型，必须
      *            'RegDate' => string, 出诊日期（YYYY-MM-DD）， 必须
      *            'TimeSlice' =>  int, 班次:0全天,1上午,2下午    ， 必须
      *            'SqNo' => string, 就诊序号  ， 必须
      *            'SourceCode' => string, 号源ID  ， 必须
      *            'ScheduleId' => string, 排班id，可选
      *        );
      * */
     public function LockOrder($data = array())
     {
         $attributes = array(
             'HosId' => $this->hosId,
             'DeptCode' => isset($data['DeptCode']) ? $data['DeptCode'] : '',
             'DoctorCode' => isset($data['DoctorCode']) ? $data['DoctorCode'] : '',
             'CardType' => isset($data['CardType']) ? $data['CardType'] : '',
             'CardNo' => isset($data['CardNo']) ? $data['CardNo'] : '',
             'RegType' => isset($data['RegType']) ? $data['RegType'] : '',
             'RegDate' => isset($data['RegDate']) ? $data['RegDate'] : '',
             'TimeSlice' => isset($data['TimeSlice']) ? $data['TimeSlice'] : 0,
             'SqNo' => isset($data['SqNo']) ? $data['SqNo'] : '',
             'SourceCode' => isset($data['SourceCode']) ? $data['SourceCode'] : '',
             'ScheduleId' => isset($data['ScheduleId']) ? $data['ScheduleId'] : ''
         );
         $xml = $this->dataToXml($attributes);
         $params = $this->formatData('yy.yygh.LockOrder', $xml);
         $result = $this->sendMessage($params, $this->msg);
         return $result;
          
     }
     
     /**
      * Unlock()
      *
      * 预约功能-释号
      *
      *
      *@param  $orderId 订单号， 必须
      *
      * */
     public function Unlock($orderId)
     {
         $xml = "<Req>
         <TransactionCode></TransactionCode>
         <Data>
         <OrderId>{$orderId}</OrderId>
         </Data>
         </Req>";
         $params = $this->formatData('yy.yygh.Unlock', $xml);
         $result = $this->sendMessage($params, $this->msg);
         return $result;
     
     }
     
     /**
      * BookService()
      *
      * 预约功能-挂号
      *
      *
      *@param  $data = array(
      *            'OrderId' => string,订单号， 必须
      *            'ScheduleId' => string, 排班id，必须
      *            'IdCardNo' => string, 身份证号码， 必须
      *            'Mobile' => string, 联系电话， 必须
      *            'Name' => string, 患者姓名， 必须
      *            'Sex' => int, 性别， 必须
      *            'Address' => string, 家庭住址， 必须
      *            'CardNo' => string, 证件号没有的时候传：初诊， 必须
      *            'CardType' => int, 证件类型， 必须
      *            'PayFee' => int, 是否已经付费1是0否，可选
      *            'TransNo' => string, 电子交易流水号，可选
      *            'TransTime' => strig, 支付时间，可选
      *            'RegFlag' => int, 1-当天挂号  2-预约， 必须
      *            'OperatorId' => string, 操作人ID， 必须
      *            'OperatorName' => string, 操作人名称， 必须
      *        );
      *
      * */
     public function BookService($data = array())
     {
         $attributes = array(
             'OrderId' => isset($data['OrderId']) ? $data['OrderId'] : '',
             'ScheduleId' => isset($data['ScheduleId']) ? $data['ScheduleId'] : '',
             'IdCardNo' => isset($data['IdCardNo']) ? $data['IdCardNo'] : '',
             'Mobile' => isset($data['Mobile']) ? $data['Mobile'] : '',
             'Name' => isset($data['Name']) ? $data['Name'] : '',
             'Sex' => isset($data['Sex']) ? $data['Sex'] : 3,
             'Address' => isset($data['Address']) ? $data['Address'] : '',
             'CardNo' => isset($data['CardNo']) ? $data['CardNo'] : '',
             'CardType' => isset($data['CardType']) ? $data['CardType'] : '',
             'PayFee' => isset($data['PayFee']) ? $data['PayFee'] : 0,
             'TransNo' => isset($data['TransNo']) ? $data['TransNo'] : '',
             'TransTime' => isset($data['TransTime']) ? $data['TransTime'] : '',
             'RegFlag' => isset($data['RegFlag']) ? $data['RegFlag'] : 2,
             'OperatorId' => isset($data['OperatorId']) ? $data['OperatorId'] : '',
             'OperatorName' => isset($data['OperatorName']) ? $data['OperatorName'] : ''
         );
         $xml = $this->dataToXml($attributes);
         $params = $this->formatData('yy.yygh.BookService', $xml);
         $result = $this->sendMessage($params, $this->msg);
         return $result;
          
     }
     
     /**
      * YYCancel()
      *
      * 预约功能-退号
      *
      *
      *@param  $data = array(
      *            'OrderId' => string,订单号， 必须
      *            'Reason' => string, 取消原因， 必须
      *            'Price' => string, 价格， 必须
      *            'OperatorId' => string, 取消操作人ID， 必须
      *            'OperatorName' => string, 取消人名称， 必须
      *        )
      *
      * */
     public function YYCancel($data = array())
     {
         $attributes = array(
             'OrderId' => isset($data['OrderId']) ? $data['OrderId'] : '',
             'Reason' => isset($data['Reason']) ? $data['Reason'] : '',
             'Price' => isset($data['Price']) ? $data['Price'] : '',
             'OperatorId' => isset($data['OperatorId']) ? $data['OperatorId'] : '',
             'OperatorName' => isset($data['OperatorName']) ? $data['OperatorName'] : ''
         );
         $xml = $this->dataToXml($attributes);
         
         $params = $this->formatData('yy.yygh.YYCancel', $xml);
         $result = $this->sendMessage($params, $this->msg);
         return $result;
          
     }
    
     /**
      * QueryRegInfo()
      *
      * 预约功能-预约信息查询
      *
      *
      *@param  $data = array(
      *            'CardType' => int, 证件类型， 可选
      *            'CardNo' => string, 证件号， 可选
      *            'IdCardNo' => string, 身份证号码， 可选
      *            'OrderId' => string,订单号， 可选
      *            'ClinicCard' => string, 就诊卡号， 可选
      *            'TimeSlice' => int, 就诊时段:0全天,1上午,2下午， 可选
      *            'StartTime' => string, 就诊日期开始， 可选
      *            'EndTime' => string, 就诊日期结束， 可选
      *            'RegFlag' => int, 1-预约 2-当天挂号， 可选
      *        )
      *
      * */
     public function QueryRegInfo($data = array())
     {
         $attributes = array(
             'CardType' => isset($data['CardType']) ? $data['CardType'] : 0,
             'CardNo' => isset($data['CardNo']) ? $data['CardNo'] : '',
             'IdCardNo' => isset($data['IdCardNo']) ? $data['IdCardNo'] : '',
             'OrderId' => isset($data['OrderId']) ? $data['OrderId'] : '',
             'ClinicCard' => isset($data['ClinicCard']) ? $data['ClinicCard'] : '',
             'TimeSlice' => isset($data['TimeSlice']) ? $data['TimeSlice'] : 0,
             'StartTime' => isset($data['StartTime']) ? $data['StartTime'] : '',
             'EndTime' => isset($data['EndTime']) ? $data['EndTime'] : '',
             'RegFlag' => isset($data['RegFlag']) ? $data['RegFlag'] : 1
         );
         $xml = $this->dataToXml($attributes);
         $params = $this->formatData('yy.yygh.QueryRegInfo', $xml);
         $result = $this->sendMessage($params, $this->msg);
         return $result;
          
     }
     
    /**
     * 调用接口
     * */
    public function sendMessage($params, &$msg = '') {
        $result = $this->client->call ( 'service', $params );
        if (!$err=$this->client->getError()) {
            $data = $this->xmlToArray($result['out']);
            if (isset($data['RespCode']) && $data['RespCode'] == '10000') {
                if (isset($data['Data'])) {
                    return $data['Data'];
                }
                return array();
            }
            
            $RespCode = is_array($data['RespCode']) ? implode(',', $data['RespCode']) : $data['RespCode'];
            $RespMessage = is_array($data['RespMessage']) ? implode(',', $data['RespMessage']) : $data['RespMessage'];
            $this->msg = '错误码【' . $RespCode . '】，' . $RespMessage;
            return false;
        }  else {
            $this->msg = "调用出错：".$err;
            return false;
        }
    }
    
    /**
     * 获取错误信息
     * */
    public function getErrorMsg() {
    	return $this->msg;
    }
}


/***********************************以下为测试信息*****************************************/


//$service = new HISWebservice();
//$service->QueryHospital();
//$data = array(
    //'DeptCode' => 1034,
    //'WorkDateStart' => '2017-08-14',
    //'WorkDateEnd' => '2017-08-26'
//);
//$service->QueryBaseDept($data);
//$service->QueryBaseDoctor();
//$service->QueryClinicDept($data);
/*
//$service->QueryClinicDoctor($data); //医生排班

$data = array(
	'DeptCode' => 1034,
    'DoctorCode' => 450,
    'RegDate' => '2017-08-18',
    'TimeSlice' => 1,
);
//$service->QueryNumbers($data);

//$service->QueryRegInfo();

$data = array(
	'OrderId' => 'test123456'
);
//$service->BookService($data);
 * */
 