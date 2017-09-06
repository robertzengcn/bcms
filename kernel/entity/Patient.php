<?php
/**
 * 患者管理-患者信息
 * */
require_once ENTITYPATH . '/Entity.php';
class Patient extends Entity{
    /**
     * @param $id
     * 主键id
     * */
	var $id;
	
	/**
	 * @param $username
	 * 患者姓名
	 * */
	var $username;
	
	/**
	 * @param $case_number
	 * 病历号
	 * */
	var $case_number;
	
	/**
	 * @param $gender
	 * 患者性别0男 1女
	 * */
	var $gender;
	
	/**
	 * @param $birthday
	 * 患者生日
	 * */
	var $birthday;
	
	/**
	 * @param $age
	 * 年龄
	 * */
	var $age;
	
	/**
	 * @param $telphone
	 * 患者电话
	 * */
	var $telphone;
	
	/**
	 * @param $qq
	 * 患者QQ
	 * */
	var $qq = null;
	
	/**
	 * @param $email
	 * 患者邮箱
	 * */
	var $email = '';
	
	/**
	 * @param $source
	 * 患者来源
	 * */
	var $source = '';
	
	/**
	 * @param $source_detail
	 * 患者来源详情
	 * */
	var $source_detail = '';
	
	/**
	 * @param $recommend_name
	 * 推荐人姓名
	 * */
	var $recommend_name = '';
	
	/**
	 * @param $recommend_tel
	 * 推荐人电话
	 * */
	var $recommend_tel = '';
	
	/**
	 * @param $vip_level
	 * 会员等级
	 * */
	var $vip_level;
	
	/**
	 * @param $money
	 * 账户金额
	 * */
	var $money;
	
	/**
	 * @param $add_time
	 * 添加时间
	 * */
	var $add_time;
	
	public function validate(){
		if (strlen($this->username) == 0){
			throw new Exception('患者姓名不能为空');
		}
		
		if (strlen($this->case_number) == 0){
		    throw new Exception('病历号不能为空');
		}
		
		/*if(strlen($this->telphone) == 0){
			throw new Exception('患者电话不能为空');
		}
		*/
		if ($this->email) {
			if (!$this->isEmail($this->email)) {
			    throw new Exception('邮箱格式不正确');
			}
		}
		/*
		if ($this->telphone) {
			if (!$this->isMobile($this->telphone)) {
			    $pattern = '/[0-9]{8}$/';
			    if (!preg_match($pattern, $this->telphone)){
			        throw new Exception('手机号格式不正确');
			    }
			}
		}
		*/
		if (strlen($this->source) == 0){
		    throw new Exception('患者来源不能为空');
		}
		
		if ('1' == $this->source) {
			//默认数据，1为来源自推荐
			if ($this->recommend_name == '') {
			    throw new Exception('推荐人姓名不能为空');
			}
			
/* 			if ($this->recommend_tel == '') {
			    throw new Exception('推荐人电话不能为空');
			} */
		}
		
		if ($this->recommend_tel) {
		    if (!$this->isMobile($this->recommend_tel)) {
		        throw new Exception('电话格式不正确');
		    }
		}
	} 
}