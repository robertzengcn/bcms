<?php
/**
 * 患者管理-患者就诊费用
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientDiagnosisFee extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $case_number
	 * 病历号
	 * */
	var $case_number;
	
	/**
	 * @param $detail_id
	 * 详情id
	 * */
	var $detail_id;
	
	/**
	 * @param $real_price
	 * 实收费用
	 * */
	var $real_price;
	
	/**
	 * @param $current_price
	 * 本次费用
	 * */
	var $current_price;
	
	/**
	 * @param $balance
	 * 余额
	 * */
	var $balance;
	
	/**
	 * @param $pay_time
	 * 缴费时间
	 * */
	var $pay_time;
	
	public function validate(){
		if (strlen($this->case_number) == 0){
			throw new Exception('病历号不能为空');
		}
	} 
}