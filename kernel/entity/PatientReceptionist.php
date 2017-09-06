<?php
/**
 * 患者管理-前台接待员
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientReceptionist extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $user_name
	 * 用户姓名
	 * */
	var $user_name;
	
	/**
	 * @param $remark
	 * 备注
	 * */
	var $remark;
	
	public function validate(){} 
}