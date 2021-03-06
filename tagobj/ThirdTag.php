<?php
/**
 * 
 * 三方统计代码tag标签
 * @author Administrator
 *
 */
class ThirdTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new ThirdStatService();
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 通过外部代码标识符(来源)获取指定的外部代码
	 * @param string $flag 标识符
	 * @return js 脚本信息
	 */
	public function get($flag = '') {
		if( $flag === '' ){
			return '';
		}else{
			return $this->service->getBySubject($flag)->data->js;
		}
	}
	
	/**
	 * 获取显示第三方代码
	 *
	 * @return Result
	 */
	public function getThirdStats() {
	    return $this->service->getThirdStats(1)->data;
	}
}
