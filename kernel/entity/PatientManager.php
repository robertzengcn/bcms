<?php
/**
 * 患者管理-病患管理员
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientManager extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $user_id
	 * 用户id
	 * */
	var $user_id;
	
	public function validate(){} 
}