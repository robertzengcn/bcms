<?php
/**
 * 
 * SEO关键词tag标签
 * @author Administrator
 *
 */
class SeoTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new SeoService();
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 根据页码获取对应的数据
	 * {{foreach $tagOb->getList($cur) as $v}}
	 * {{/foreach}}
	 * @param  int $current  当前页
	 * @param  boolean $sort 排序规则,true为时间降序
	 * @return array list
	 */
	public function getList($current,$sort = true, $limit = '') {
		#.第几页
		$current   = (int)$current <= 0 ? 0 : (int)$current - 1;
		#.查询总条数
		$count  = $this->service->totalRows ( array ('1' => 1 ) )->data;
		#.分页数
		$pageCount = ceil( $count / $this->tagConfig['pageSize']);
		#.组合条件进行数据查询
		$limit = $limit == '' ? $this->tagConfig['pageSize'] : $limit;
		$limit = array ("page" => $current, "size" => $limit );
		$field = '*';
		$where = array ('1' => 1 );
		$order = $sort === true ? "id desc" : "id asc";
		$data = $this->service->getPage ( $field, $where, $limit, $order );
		return $data;
	}
	
	/**
	 * 
	 * 根据页码获取分页html
	 * {{$tagOb->getPageHtml($cur)}}
	 * @param int $current 当前页
	 */
	public function getPageHtml($current, $size = '') {
		#.第几页
		$current   = (int)$current <= 0 ? 0 : (int)$current - 1;
		#.查询总条数
		$count  = $this->service->totalRows ( array ('1' => 1 ) )->data;
		#每页显示条数
		$size = empty($size) ? $this->tagConfig['pageSize'] : $size;
		#.生成html信息
		return $this->setPageHtml($current, $size , $count , 'news' );
	}
	
	/**
	 * 
	 * 根据唯一flag获取seo的详细信息
	 * {{$info = $SeoTag->get($id)}}
	 * @param int $id 唯一id
	 */
	public function get($flag) {
		$where  = array( "flag" => $flag );
		$result = $this->service->findOne( $where , '*' );
		$entity = new Seo();
		$entity->generateFromRedBean( $result );
		return $entity;
	}
	
}