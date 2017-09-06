<?php
/**
 * 患者管理-病历
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientCase extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $patient_id
	 * 患者id
	 * */
	var $patient_id;
	
	/**
	 * @param $case_number
	 * 病历号
	 * */
	var $case_number;
	
	/**
	 * @param $is_finished
	 * 是否成交
	 * */
	var $is_finished;
	
	/**
	 * @param $reason
	 * 未成交原因
	 * */
	var $reason;
	
	/**
	 * @param $add_time
	 * 添加时间
	 * */
	var $add_time;
	
	public function validate(){} 
}