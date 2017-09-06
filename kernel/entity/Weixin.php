<?php
require_once ENTITYPATH . '/Entity.php';
class Weixin extends Entity{
	var $id;
	var $weixinname;
	var $pic;
	var $appid;
	var $appsecret;
	var $tag;
	
	public function validate(){
		if (strlen($this->weixinname) == 0){
			throw new Exception('微信名称不能为空');
		}
		if(strlen($this->appid) == 0){
			throw new Exception('微信应用ID不能为空');
		}
		if(strlen($this->appsecret) == 0){
			throw new Exception('微信应用密钥不能为空');
		}
		if(strlen($this->tag) == 0){
			throw new Exception('微信标识不能为空');
		}
	} 
}