<?php
/**
 * 患者管理-疾病
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientDisease extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $disease_name
	 * 疾病名称
	 * */
	var $disease_name;
	
	/**
	 * @param $remark
	 * 备注
	 * */
	var $remark;
	
	public function validate(){} 
}