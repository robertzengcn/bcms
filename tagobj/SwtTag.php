<?php
/**
 * 
 * 商务通tag标签
 * @author Administrator
 *
 */
class SwtTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = null;
		parent::__construct( get_class() );
	}
}
