<?php
/**
 * 
 * 医院设备tag标签
 * @author Administrator
 *
 */
class DeviceTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new DeviceService ();
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
	public function getList($current = 1,$limit = '',$sort = true) {
		$limit = $limit == '' ? $this->tagConfig['pageSize'] : $limit;
		#.第几页
		$current   = (int)$current <= 0 ? 0 : (int)$current - 1;
		#.查询总条数
		$count  = $this->service->totalRows ( array ('1' => 1 ) )->data;
		#.分页数
		$pageCount = ceil( $count / $this->tagConfig['pageSize']);
		#.组合条件进行数据查询
		$limit = array ("page" => $current, "size" => $limit );
		$field = '*';
		$where = array ('1' => 1 );
		$order = $sort === true ? "plushtime desc" : "plushtime asc";
		$data = $this->getPage ( $field, $where, $limit, $order );
		return $data;
	}
	
	/**
	 * 
	 * 根据页码获取分页html
	 * {{$tagOb->getPageHtml($cur)}}
	 * @param int $current 当前页
	 */
	public function getPageHtml($current, $size = '',$show_position) {
		#.第几页
		$current   = (int)$current <= 0 ? 0 : (int)$current - 1;
		#.查询总条数
		$count  = $this->service->totalRows ( array ('1' => 1 ) )->data;
		#每页显示条数
		$size = empty($size) ? $this->tagConfig['pageSize'] : $size;
		#.生成html信息
		return $this->setPageHtml($current, $size , $count , 'device' );
	}
	
	/**
	 * 
	 * 根据唯一id获取该id的详细信息
	 * {{$news = $tagOb->get($id)}}
	 * @param int $id 唯一id
	 */
	public function get($value) {
		$id = (int)$value <= 0 ? 0 : (int)$value;
		$where = array( "id" => $id );
		$result = $this->service->findOne( $where , '*' );
		$device = new Device();
		$device->generateFromRedBean($result);
		return $device;
	}
     /**
     * 
     * 获取列表
     */
    public function getDevList($sql){
		return $this->service->getJoin ( $sql );
    } 
    /**
     * 
     * 获取表字段 
     */
    public function getDevFields(){
		return $this->service->getFields();
    }
}