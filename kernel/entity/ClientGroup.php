<?php
/**
 * 客户管理-关注人员组
 * */
require_once ENTITYPATH . '/Entity.php';
class ClientGroup extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $name
	 * 组名
	 * */
	var $name;
	
	/**
	 * @param $remark
	 * 信息备注
	 * */
	var $remark;
	
	public function validate(){
		if (strlen($this->name) == 0){
			throw new Exception('组名不能为空');
		}
	} 
}