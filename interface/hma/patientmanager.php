<?php
require_once '../InterfaceAbstract.php';

/**
 * HMA患者管理接口
 * 
 * @author Administrator
 * @version v1.0
 */
class Patientmanagers extends InterfaceAbstract {
	public function __construct() {
		parent::__construct ();
	}
	
	public function _begin() {
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		
		if (! in_array ( $_REQUEST ['method'], array (
				'doctormanager_outpatient_time',
				'configure_info',
				'search_article',
				'article_title',
				'departmentmanager_list',
				'department_doctormanager_list',
				'department_doctor_list',
				'dispatcher' 
		) )) { // 需要排除远程登录的接口
		    $this->getRemoteUser();
		}
		
		if (isset ( $_REQUEST ['method'] ) && $_REQUEST ['method'] != '') {
			$method = 'get_' . trim ( $_REQUEST ['method'] );
			if (method_exists ( $this, $method )) {
				$this->$method ();
			} else {
				die ( json_encode ( array (
						'code' => 404,
						'msg' => 'method参数错误,不存在该调用接口!',
				) ) );
			}
		} else {
			
			die ( json_encode ( array (
					'code' => 404,
					'msg' => 'method参数为空!',
			) ) );
		}
	}
	
	/**
	 * token：用户token
	 * part: patientcaselist
	 * page:从第几页取 （可选）
	 * size:取几条 （可选）
	 * @param type：1 （初诊） 2复诊  0不限
	 * pid: 0
	 */
	private function get_patientcaselist() {
		
		$page = $this->getRequest ( 'page', 1 );
		$size = $this->getRequest ( 'size', 10 );
		$type = $this->getRequest ( 'type', 1 ); // 1为获取所有初诊病历列表

		$pid = $this->getRequest ( 'pid', 0 );

		
		$patientserviceser = new PatientService ();
		if (! $_SESSION ['member_mobile']) {
			$this->msgPut ( false, '用户手机号为空', null, '2' );
		}
		
		if($type==0){
			
		$result = $patientserviceser->getListPatientCase ( array (
				'telphone' => $_SESSION ['member_mobile'],
				'page' => $page,
				'size' => $size 
		) );
		}else{
			$result = $patientserviceser->getListPatientCase ( array (
					'telphone' => $_SESSION ['member_mobile'],
					'type' => $type,
					'pid' => $pid,
					'page' => $page,
					'size' => $size
			) );
		}
		if (! empty ( $result ['rows'] )) {
			$patientserviceser = new PatientService ();
			$patientcheckserviceser = new PatientCheckService ();
			foreach ( $result ['rows'] as $key => $val ) {
				if ($val ['pic']) {
					$result ['rows'] [$key] ['pic'] = UPLOAD . $val ['pic'];
				}
				$result ['rows'] [$key] ['medical'] = $patientserviceser->getPrescriptionsByDetailId ( $val ['detail_id'] );
				$result ['rows'] [$key] ['checklist'] = $patientcheckserviceser->query ( array (
						'pid' => $val ['detail_id']
				) )->data;
			}
			
			$this->msgPut ( true, null, $result, 0 );
		}
		$this->msgPut ( false, '没有数据', null, '1' );
	}
	
	/**
	 * 根据case_id取详情数据 http://网站/interface/hma/patientmanager.php 
	 * @param $_Request['case_id'] @param $Request['method']: patientcasedetail
	 * @param $_Request['type] 1为初诊 2为复诊
	 * @param $_Request['pid']: 0为 这个case_id的初诊信息 取某个case_id初诊传的参数:$_Request['case_id'],$_Request['type]=1, $_Request['pid']=0; 取某个case_id复诊传的参数:$_Request['case_id'],$_Request['type]=2, $_Request['pid']=$_Request['case_id'];
	 * @param $_Request['case_number]
	 * 
	 */
	private function get_patientcasedetail() {
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$case_id = ( int ) ($this->getRequest ( 'case_id' ));
		$pid = $this->getRequest ( 'pid', 0 );
		$type = ( int ) $this->getRequest ( 'type', 1 );
		$case_number=$this->getRequest('case_number',"");
		if ($type == 2) {
			$pid = $case_id;
		}
		
		$patientser = new PatientService ();
		if (! $_SESSION ['member_mobile']) {
			$this->msgPut ( false, '用户手机号为空', null, '2' );
		}
		if($type!=0){
		$result = $patientser->getListPatientCase ( array (
				'fcase_number'=>$case_number,
				'case_id' => $case_id,
				'pid' => $pid,
				'type' => $type,
				'telphone' => $_SESSION ['member_mobile'] 
		) );
		}else{
			$result = $patientser->getListPatientCase ( array (
					'fcase_number'=>$case_number,
					'case_id' => $case_id,
					'telphone' => $_SESSION ['member_mobile'],
					'type' => $type,
			) );
		}
		if (! empty ( $result ['rows'] )) {
			$patientserviceser = new PatientService ();
			$patientcheckserviceser = new PatientCheckService ();
			
			$visit_arr = array();
			foreach ( $result ['rows'] as $key => $val ) {
			    $visit_arr[$key] = $val['visit_time'];
				if ($val ['pic']) {
					$result ['rows'] [$key] ['pic'] = UPLOAD . $val ['pic'];
				}
				$result ['rows'] [$key] ['medical'] = $patientserviceser->getPrescriptionsByDetailId ( $val ['detail_id'] );
				$result ['rows'] [$key] ['checklist'] = $patientcheckserviceser->query ( array (
						'pid' => $val ['detail_id'] 
				) )->data;
			}
			
			if (!empty($visit_arr))
			    array_multisort($visit_arr, SORT_NUMERIC, SORT_ASC, $result);
			
			$this->msgPut ( true, null, $result, 0 );
		}
		$this->msgPut ( false, '没有数据', null, '1' );
	}
	

	/**
	 * 根据用户token取用户患者信息
	 * @param $_Request['token]
	 * @param $_Request['method']: patientinfo
	 * @return json
	 */
	public function get_patientinfo(){
		
		if(!isset($_SESSION ['member_mobile'])||strlen($_SESSION ['member_mobile'])<1){
			$this->msgPut ( false, '手机号为空', null, '10' );
		}
		
		$patientserviceser = new PatientService ();
		$data=$patientserviceser->getcasenum($_SESSION ['member_mobile']);
	
		if(!empty($data->data)){
			$this->msgPut ( true, null, $data->data, 0 );
		}
		$this->msgPut ( false, '没有数据', null, '1' );
	}
}
new Patientmanagers ();