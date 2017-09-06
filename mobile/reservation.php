<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 预约服务
 * @author Administrator
 *
 */
class reservationMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}
	
	/**
	 * 
	 * 在线预约表单
	 */
	public function form() {
		//注入科室
		$departments = $this->getServiceMethod('departmentmanager','query',array());
		$this->smarty->assign('department',$departments->data);
		//注入医生
		$doctors  = $this->getServiceMethod('doctor','query',array());
		$departmentsData = $departments->data;
		$doctorsData = $doctors->data;
		$departmetnDoctor = array();
		$i   = 0;
		foreach($departmentsData as $key => $value){
			foreach($doctorsData as $k => $v) {
				if( $v->department_id == $value->id ) {
					$departmetnDoctor[ $value->id ][$i]['id']   = $v->id;
					$departmetnDoctor[ $value->id ][$i]['name'] = $v->name;
					$i++;
				}
			}
		}
		$this->smarty->assign('doctor',json_encode($departmetnDoctor));
		$this->smarty->display( 'Reservation/index' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 通过科室与医生id取得对应的日期或时间
	 */
	public function getDate() {
		if(count($this->result->data) <= 0){
			$this->result->statu = false;
		}else{
			if(isset($_REQUEST['date']) && $_REQUEST['date'] != ''){
				$date = trim($_REQUEST['date']);
				$timeArray = array();
				$data = $this->result->data;
				foreach($data as $key => $value){
					if($value->date == $date || $value->statu == '待约'){
						$timeArray[] = $value;
					}
				}
				if(count($timeArray) <=0){
					$this->result->statu = false;
				}
				$this->result->data = $timeArray;
				die( json_encode( $this->result ) );
			}
		}
		die( json_encode( $this->result ) );
	}
	
	/**
	 * 
	 * 表单提交
	 */
	public function reserUser() {
		die( json_encode( $this->result ) );
	}
	
	/*
	 * 科室预约列表
	 * */
	public function showtable(){
		$depmanser=new DepartmentManagerService();
		$deplist=$depmanser->gettopDepartments();
		$num=count($deplist->data);
		
		//print_r($deplist);exit();
		
		$this->smarty->assign('departmentlist',$deplist->data);
		$this->smarty->assign('departmentnum',$num);//科室数量
		
		$this->smarty->display( 'Reservation/reservationtime' . TPLSUFFIX );
	}
	/*
	 * 显示预约挂号页
	 * */
	public function index(){
		$depmanser=new DepartmentManagerService();
		$deplist=$depmanser->gettopDepartments();
		$num=count($deplist->data);
		
		//print_r($deplist);exit();
		
		$this->smarty->assign('departmentlist',$deplist->data);
		$this->smarty->assign('departmentnum',$num);//科室数量
		$this->smarty->display( 'Reservation/index' . TPLSUFFIX );
	}
}

new reservationMobile();
?>