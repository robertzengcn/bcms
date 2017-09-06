<?php
/**
 * 
 * 图片管理tag标签
 * @author Administrator
 *
 */
class PicTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new PicService();
		parent::__construct( get_class() );
	}
    /**
     * 
     * 获取列表 
     */
    public function getPicList($sql){
		return $this->service->getJoin ( $sql );
    }	
}
