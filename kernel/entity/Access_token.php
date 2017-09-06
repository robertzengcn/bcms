<?php
require_once ENTITYPATH . '/Entity.php';
class Access_token extends Entity{
	var $id;
	var $tag;
	var $token;
	var $createtime;
	
	public function validate(){
		if(strlen($this->tag) == 0){
			throw new Exception('微信标识不能为空');
		}
		if (strlen($this->token) == 0){
			throw new Exception('微信token不能为空');
		}
		if(strlen($this->createtime) == 0){
			throw new Exception('token创建时间不能为空');
		}
	}
}