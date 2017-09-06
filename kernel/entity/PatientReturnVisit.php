<?php
/**
 * 患者管理-回访记录
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientReturnVisit extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $detail_id
	 * 就诊id:patientdiagnosisdetail.id
	 * */
	var $detail_id;
	
	/**
	 * @param $message
	 * 回访消息
	 * */
	var $message = '';
	
	/**
	 * @param $reply
	 * 回复消息
	 * */
	var $reply = '';
	
	/**
	 * @param $return_time
	 * 回访时间
	 * */
	var $return_time;
	
	/**
	 * @param $reply_id
	 * 回访人
	 * */
	var $reply_id;
	
	/**
	 * @param $visit_method
	 * 回访方式
	 * */
	var $visit_method;
	
	public function validate(){
	} 
}