<?php
abstract class HISAbstract
{
    /**
     * 接口地址
     * */
    private $_url = 'http://27.151.52.81:8999/Hos-HOP/services/ServiceGateWay?wsdl';
    
    public $hosId = '222285';
    
    private $_soap_client = null;
    
    private $_authInfo = array(
            'ClientId' => '100123',
            'ClientVersion' => '1024727',
            'Sign' => 'Sign',
            'SessionKey' => 'SessionKey'
        );
    
    public function __construct()
    {
        $this->_soap_client = new nusoap_client($this->_url, true);
        $this->_soap_client->soap_defencoding = 'UTF-8';
        $this->_soap_client->decode_utf8 = false;
        $this->_soap_client->xml_encoding = 'UTF-8';
    }
    
    public function getSoapClient() {
    	return $this->_soap_client;
    }
    
    /**
     * 格式化提交接口参数
     * */
    public function formatData($api, $xml) {
        $params = array(
            'parameters' => array(
                'authInfo' => json_encode($this->_authInfo),
                'sequenceNo' => microtime(true),
                'api' => $api,
                'param' => $xml,
                'paramType' => 1,
                'outType' => 1,
                'v' => '1.0'
            )
        );
        
        return $params;
    }
    
    /**
     * 解析xml字符串
     * */
    public function xmlToArray($xml = '')
    {
    	$xmlstring = simplexml_load_string($xml);
    	return json_decode(json_encode($xmlstring),true); ;
    }
    
    /**
     * 数组转化为xml格式
     * */
    public function dataToXml($data = array()) {
        $xml = "<Req><TransactionCode></TransactionCode><Data>";
    	foreach ($data as $k => $v) {
    		$xml .= "<{$k}>{$v}</{$k}>";
    	}
    	$xml .= "</Data></Req>";
    	return $xml;
    }
    
    /**
     * 业务字典-卡类型
     * */
    public function CardType() {
    	$data = array(
    		1 => '就诊卡',
    	    2 => '身份证',
    	    3 => '护照',
    	    4 => '户口簿',
    	    5 => '军官证',
    	    6 => '士兵证',
    	    7 => '回乡证',
    	    8 => '通行证',
    	    9 => '临时身份证',
    	    10 => '外国人居留证',
    	    11 => '警官',
    	    12 => '医保卡',
    	    13 => '其它证件证',
    	    14 => '住院号'
    	);
    	
    	return $data;
    }
    
    /**
     * 业务字典-订单类型
     * */
    public function Serviceid() {
    	$data = array(
    		'0' => '预约挂号',
    	    '001' => '西药',
    	    '002' => '中成药',
    	    '003' => '草药',
    	    '004' => '非药品类型列表（检查）',
    	    '005' => '就诊卡充值',
    	    '999' => '所有订单'
    	);
    	
    	return $data;
    }
    
    /**
     * 业务字典-报告单类型
     * */
    public function ReportType() {
    	$data = array(
    		1 => '检验报告单',
    	    2 => '检查报告单'
    	);
    	
    	return $data;
    }
    
    /**
     * 业务字典-订单消费状态
     * */
    public function CStatus() {
    	$data = array(
    		0 => '未消费',
    	    1 => '已消费'
    	);
    	
    	return $data;
    }
    
    /**
     * 业务字典-性别
     * */
    public function Sex() {
    	$data = array(
    		1 => '男',
    	    2 => '女',
    	    3 => '未知'
    	);
    	
    	return $data;
    }
    
    /**
     * 业务字典-订单状态
     * */
    public function OrderStatus() {
    	$data = array(
    		0 => '未支付',
    	    1 => '正在支付',
    	    2 => '已支付',
    	    3 => '正在退费',
    	    4 => '已退费',
    	    5 => '已完成'
    	);
    	
    	return $data;
    }
    
    /**
     * 业务字典-充值方式
     * */
    public function CargeType() {
    	$data = array(
    		0 => '现金充值',
    	    1 => '支付宝充值',
    	    2 => '银联充值',
    	    3 => '微信充值'
    	);
    	
    	return $data;
    }
    
    /**
     * 业务字典-收费项
     * */
    public function Payfeeitem() {
    	$data = array(
    		0 => '挂号单缴费',
    	    1 => '检查单缴费',
    	    2 => '检验单缴费',
    	    3 => '住院单缴费',
    	    4 => '就诊卡费用充值'
    	);
    	
    	return $data;
    }
    
    
}