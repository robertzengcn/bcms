<?php
/**
 * 患者管理-病历
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientPrescription extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $name
	 * 药品名称
	 * */
	var $name;
	
	/**
	 * @param $code
	 * 拼音代号
	 * */
	var $code;
	
	/**
	 * @param $brand
	 * 品牌
	 * */
	var $brand;
	
	/**
	 * @param $batch_number
	 * 批准文号
	 * */
	var $batch_number;
	
	/**
	 * @param $dosage_form
	 * 剂型
	 * */
	var $dosage_form;
	
	/**
	 * @param $specification
	 * 规格
	 * */
	var $specification;
	
	/**
	 * @param $quantity
	 * 数量
	 * */
	var $quantity = '1';
	
	/**
	 * @param $unit
	 * 单位
	 * */
	var $unit = '';
	
	/**
	 * @param $usage
	 * 用法
	 * */
	var $usage;
	
	
	
	public function validate(){
		if (strlen($this->name) == 0){
			throw new Exception('药品名称不能为空');
		}
	} 
}