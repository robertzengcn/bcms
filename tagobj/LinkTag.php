<?php
/**
 * 
 * 友情链接tag标签
 * @author Administrator
 *
 */
class LinkTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new LinkService ();
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 根据限制获取条数获取友情连接列表
	 * @param int $limit 限制条数
	 * @return array&object 对象数组
	 */
	public function getList($limit = 8) {
		if( (int)$limit >= 1) {
			#.组合条件
			$order = "sort desc";
			$where = array(
				"isdisplay" => 1
			);
			return $this->service->getLimit( $order , $limit , $where , '*' );
		}
		return null;
	}
    /**
     * 
     * 获取列表 
     */
    public function getLinList($sql){
		return $this->service->getJoin ( $sql );
    }
}