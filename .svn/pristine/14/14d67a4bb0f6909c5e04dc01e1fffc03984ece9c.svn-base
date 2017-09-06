<?php

/**
 * 
 * 在线预约
 * @author Administrator
 *
 */
class ReservationController extends Controller{
	private $service;
	
	/**
	 * 构造函数 初始化service
	 */
	function __construct(){
		parent::__construct();
		$this->service = new ReservationService();
	}
	
	/**
	 * 过滤(non-PHPdoc)
	 * 
	 * @see Controller::filter()
	 */
	function filter() {
		$filterService = new FilterService ();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
		return $filterService->execute ();
	}
	
	/**
	 * 在线预约(表单)
	 */
	function form() {
		return true;
	}
	
	/**
	 * 
	 * 根据科室跟医生获取时间
	 */
	function getDate(){
		$department_id = (int)$_REQUEST['department_id'];
		$doctor_id     = (int)$_REQUEST['doctor_id'];
		return $this->service->getDetail(array('department_id'=>$department_id,'doctor_id'=>$doctor_id));
	}
	
    /**
     * 将预约者添加到预约表中去,修改未约成已约
     */
    public function reserUser() {
        $res=$this->service->queryDetail();
        $reservationDetail = new ReservationDetail();
        $reservationDetail->id=$res->id;
        $reservationDetail->department_id=$res->department_id;
        $reservationDetail->doctor_id=$res->doctor_id;
        $reservationDetail->date=$res->date;
        $reservationDetail->times=$res->times;
        $reservationDetail->statu='已约';
        $reservationDetail->username=$_REQUEST['name'];
        $reservationDetail->telephone=$_REQUEST['hometel'];
        $this->service->reservationDetail($reservationDetail);
        $entity = new ReserUser();
        $entity->sex = 0;
        $entity->age = 0;
        $entity->ill = "";
        $this->blindParams($entity);
        return $this->service->reserUser($entity);
    }
	
	/**
	 * 将预约信息添加到预约表中去
	 */
	public function add(){
		print_r($_REQUEST);
	}
	
}