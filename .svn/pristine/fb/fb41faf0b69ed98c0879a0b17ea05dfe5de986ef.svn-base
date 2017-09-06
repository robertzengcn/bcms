<?php
/**
 * 患者管理-信息来源
 * */
require_once ENTITYPATH . '/Entity.php';
class PatientDataSource extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $title
	 * 来源标题
	 * */
	var $title;
	
	/**
	 * @param $remark
	 * 来源信息备注
	 * */
	var $remark;
	
	public function validate(){
		if (strlen($this->title) == 0){
			throw new Exception('标题不能为空');
		}
	} 
}