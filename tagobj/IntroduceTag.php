<?php
/**
 * 
 * 医院介绍tag标签
 * @author Administrator
 *
 */
class IntroduceTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new IntroduceService();
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 获取pic信息
	 */
	public function getPic() {
		return $this->get('pic');
	}
	
	/**
	 * 
	 * 获取content信息
	 */
	public function getContent() {
		return $this->get('content');
	}
	
	/**
	 * 
	 * 获取source信息
	 */
	public function getSource() {
		return $this->get('source');
	}
	
	/**
	 * 
	 * 根据需要获取的字段获取对应的信息
	 * @info　为空则取所有字段
	 * @param string $field 字段名称
	 * @return array&object | string field为空的情况下返回数组对象,否则返回单一字符串
	 */
	public function get($field = '') {
		$result = $this->service->get()->data;
		if($field == ''){
			return $result;
		}else if( isset($result->$field) && $result->$field != '' ){
			return $result->$field;
		}
	}
	
}