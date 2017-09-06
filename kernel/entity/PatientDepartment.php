<?php
/**
 * 患者管理-科室
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientDepartment extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $department_name
	 * 科室名称
	 * */
	var $department_name;
	
	/**
	 * @param $remark
	 * 备注
	 * */
	var $remark;
	
	public function validate(){} 
}