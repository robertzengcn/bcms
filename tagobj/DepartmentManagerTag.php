<?php
/**
 * 
 * 科室管理tag标签
 * @author Administrator
 *
 */
class DepartmentManagerTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new ResDepartmentService();
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
	public function getList($current,$size='',$sort = true) {
		#.第几页
		$current   = (int)$current <= 0 ? 0 : (int)$current - 1;
		
		#.查询总条数
		$count  = $this->service->totalRows ( array ('1' => 1 ) )->data;
		#.分页数
		$pageCount = ceil( $count / $this->tagConfig['pageSize']);
		#.组合条件进行数据查询
		$size = $size == '' ? $this->tagConfig['pageSize'] : $size;
		$limit = array ("page" => $current, "size" => $size );
		//$limit = array ("page" => 0, "size" => 1000 );
		$field = '*';
		$where = array ('1' => 1, 'belong' => '0');
		$order = $sort === true ? "id desc" : "id asc";
		$data = $this->getPage ( $field, $where, $limit, $order );
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
		return $this->setPageHtml($current, $size , $count );
	}

	/**
	 *
	 * 根据唯一id获取该id的详细信息
	 * {{$news = $tagOb->get($id)}}
	 * @param int $id 唯一id
	 */
	public function get($value) {
		if (!is_numeric($value)){
			$where = array('name' => $value);
		}else{
			$id = (int)$value <= 0 ? 0 : (int)$value;
			$where = array( "id" => $id );
		}
		$result = $this->service->findOne( $where , '*' );
		$department = new ResDepartment();
		$department->generateFromRedBean($result);
		return $department;
	}
	
	/**
	 * 
	 * 根据id或者name集合获取数据
	 * {{$tagOb->in(10,11,12)}}
	 * @param $valArray
	 */
	public function in($valArray) {
		return $this->inBase($valArray, 'resdepartment');
	}

}