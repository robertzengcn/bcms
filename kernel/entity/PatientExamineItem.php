<?php
/**
 * 患者管理-诊疗项目
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientExamineItem extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $item_name
	 * 项目名称
	 * */
	var $item_name;
	
	/**
	 * @param $is_usual
	 * 是否常用
	 * */
	var $is_usual;
	
	/**
	 * @param $remark
	 * 备注
	 * */
	var $remark;
	
	public function validate(){} 
}