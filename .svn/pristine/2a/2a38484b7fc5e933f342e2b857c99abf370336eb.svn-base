<?php
require_once ENTITYPATH . '/Entity.php';
class Attention extends Entity{
	var $id;
	var $openid;
	var $tag;
	
	public function validate(){
		if(strlen($this->openid) == 0){
			throw new Exception('openid不能为空');
		}
		if(strlen($this->tag) == 0){
			throw new Exception('微信标记不能为空');
		}
	}
}