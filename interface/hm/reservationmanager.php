<?php
require_once '../InterfaceAbstract.php';
class Reservationmanager extends InterfaceAbstract{
    private $_statu_str = array(
    	'1' => '已过期',
        '2' => '已到诊',
        '3' => '已到诊'
    );
	public function __construct() {
		parent::__construct(true);
	}
	
	public function _begin() {
	    if( isset( $_REQUEST['method'] ) && method_exists( $this ,  '__'.trim( strtolower( $_REQUEST['method'] ) ) ) ) {
	        $method = '__'.trim( strtolower( $_REQUEST['method'] ) );
	        $this->$method();
	    }else{
	        $this->msgPut(false, '缺少method参数或method参数不正确', null, 1);
	    }
	}
	
	/**
	 * 设置用户为到诊
	 * */
	protected function __makeres(){
		
		if(isset($_REQUEST['id'])&&strlen($_REQUEST['id'])>0){
			$id=(int)$_REQUEST['id'];		
			$statu = isset($_REQUEST['statu']) ? $this->_statu_str[$_REQUEST['statu']] : '';	
			$reseser=new ResBookingInfoService();
			$arr=array('id'=>$id, 'statu'=>$statu);
			$res=$reseser->changestatu($arr);
			$this->msgPut(true, '您已确认到诊！', null, 0);
		}
	}
	
	/**
	 * 获取某个预约时段等待的人数
	 * @param id预约时间段id
	 * */
	protected function __getresnum(){
		if(isset($_REQUEST['id'])&&strlen($_REQUEST['id'])>0){
			$id=(int)$_REQUEST['id'];
			$reseser=new ResBookingInfoService();			
			$res=$reseser->getresnum(array('reserver_id'=>$id));
			$this->msgPut(true, $res, null, 0);
		}
	}
	
	#.通过预约ID取预约信息
	protected function __reservation_info(){
		new ResVationService();
		$reservation_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;	
		if( $reservation_id <= 0 ){
			$this->msgPut(false, '查询失败,id不能为空!', null, 1);			
		}	
			
		$result = R::load('resbookinginfo', $reservation_id);
		if( is_object($result) ){
		    $data['id'] = $reservation_id;
			$data['code']            = 0;
			$data['msg']             = '查询成功';
			#.查询医院名称
			$contact = R::findOne('contact',"flag = 'name'");
			$data['hospital_name']   = $contact->val;
			
			#.查询预约详细信息			
			//$reservaInfo = R::load('reservation',$result->reserver_id);	
			
			#.查询科室
			$deparment = R::load('resdepartment', $result->department_id);
			$data['department_name'] = isset( $deparment->name ) ? $deparment->name : '';
			#.查询医生
			$doctor = R::load('resdoctor', $result->doctor_id);
			$data['doctor_name'] 	 = isset( $doctor->name ) ? $doctor->name : '';
			$data['date'] 			 = date('Y-m-d',$result->date);
			$data['time']            = date('H:i',$result->times);			
			
			//对比扫码时间
			if ($result->statu == '已到诊') {
			    $data['statu'] = 0;
			    $data['restatu'] = '您已确认到诊，就诊时间是：' . $data['date'] . ' ' . $data['time'];
			} else {
			    $statu = 0; $msg = '';
			    $this->checkTime($data['date'], $data['time'], $statu, $msg);
			    $data['statu'] = $statu;
			    $data['restatu'] = $msg;
			}
			
			$data['resertimes']=date('Y-m-d H:i:s',$result->times);
			$data['username'] 		 = $result->username;
			$data['tel'] 			 = $result->telephone;
			die( json_encode( $data ) );				
		}else{
			$this->msgPut(false, '查询失败,该预约id不存在!', null, 11);
		}
	}
	
	/**
	 * 日期和时间比对
	 * */
	protected function checkTime($date = '', $time = '', &$statu = 0, &$msg = '') {
		if (empty($date) || empty($time)) return '日期或时间不能为空！';
		
		$timestamp = time();
		$currentDate = date('Y-m-d', $timestamp);
		$currentTime = date('H:i', $timestamp);
		
		if (strtotime($currentDate)>strtotime($date)) {
		    //过期
		    $msg = '该预约已过期！';
		    $statu = 1;
		} elseif (strtotime($currentDate)<strtotime($date)) {
		    //未到就诊日期
		    $msg = '未到就诊日期！您的预约时间是：' . $date . ' ' . $time;
		    $statu = 0;
		} else {
			//当天
			if (strtotime($currentTime)>strtotime($time)) {
				//过号
				$msg = '您的预约时间是：' . $date . ' ' . $time . '，已过号！';
				$statu = 2;
			} else {
				//早到或正点
			    $msg = '您的就诊时间是：' . $date . ' ' . $time;
				$statu = 3;
			}
		}
	}
}
new Reservationmanager();
?>