<?php
/**
 * 特色技术tag标签
 * @author Administrator
 *
 */
class TechnologyTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new TechnologyService ();
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
	public function getList($current=1,$limit='',$sort = true) {
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
		$count  = $this->service->totalRows ( array ('1' => 1 ,'show_position' =>$show_position) )->data;
		#每页显示条数
		$size = empty($size) ? $this->tagConfig['pageSize'] : $size;
		#.生成html信息
		return $this->setPageHtml($current, $size , $count , 'technology' );
	}
	
	/**
	 * 
	 * 根据唯一id获取该id的详细信息
	 * {{$news = $tagOb->get($id)}}
	 * @param int $id 唯一id
	 */
	public function get($id) {
		$id = (int)$id <= 0 ? 0 : (int)$id;
		$where = array( "id" => $id );
		$result = $this->service->findOne( $where , '*' );
        $technology = new Technology();
        $technology->generateFromRedBean($result);
        return $technology;
	}
	
	/**
	 * 根据推荐位置获取案例列表 ...
	 * @param unknown_type $recommend_id
	 */
	public function getByRecommend($recommend,$name='technology_id',$is_tomobile=''){
	if (!is_numeric($recommend)){
			$position = new RecommendPositionService();
			$result = $position->getByName($recommend,$is_tomobile);
			$recommend_id = $result->id;
		}else{
			$recommend_id = (int)$recommend <=0 ? 0 : (int)$recommend;
		}
		$recommendObj = new RecommendListService();
		$technologyIds = $recommendObj->getByRecommendID($recommend_id,$name);
		$_REQUEST['ids'] = array();
		foreach ($technologyIds as $val){
			$_REQUEST['ids'][] = $val->$name;
		}
		$result = $this->service->getByIds();
		return $result->data;
	}
	
	/**
	 * 获取置顶资讯
	 * @param unknown_type $recommend_id
	 * @param unknown_type $disease_id
	 * @param unknown_type $is_top
	 * @param unknown_type $name
	 * @return Ambigous <multitype:, unknown>
	 */
	public function getByTop($recommend,$is_top=1,$name='technology_id',$is_tomobile=''){
		if (!is_numeric($recommend)){
			$position = new RecommendPositionService();
			$result = $position->getByName($recommend,$is_tomobile);
			$recommend_id = $result->id;
		}else{
			$recommend_id = (int)$recommend <=0 ? 0 : (int)$recommend;
		}
		$recommendObj = new RecommendListService();
		$technologyIds = $recommendObj->getByTop($recommend_id,$is_top,$name);
		$_REQUEST['ids'] = array();
	    foreach ($technologyIds as $val){
			$_REQUEST['ids'][] = $val->$name;
		}
		$result = $this->service->getByIds()->data;
		return empty($result) ? $result : $result[0];
	}
	
	/**
	 * 获取用户变量的值...
	 * @param unknown_type $name
	 * @param unknown_type $topic
	 * @return Ambiguous
	 */
	public function getTopicVar($name,$topic){
		$pattern = '/^[a-zA-Z]+$/';
		$where = array();
		if (preg_match($pattern, $name)){
			$where['var_name'] = $name;
		}else{
			$where['name'] = $name;
		}
		if (!is_numeric($topic)){
			$arr = array();
			$arr['subject'] = $topic;
			$rs = $this->service->query($arr)->data;
			$where['tid'] = $rs[0]->id;
		}else{
			$where['tid'] = $topic;
		}
		$userVarObj = new UserVarService();
		$result = $userVarObj->query($where)->data;

		return $result;
	}


    /**
     *
     * 根据科室ID获取该特色技术的列表
     * {{$technology = $TechnologyTag->getByDepartment($department_id,$limit)}}
     * @param int $department_id 科室ID
     * @param int 需要获取的数据条数
     */
    public function getByDepartment($department_id,$limit) {
        $department_id = (int)$department_id <= 0 ? 0 : (int)$department_id;
        $where = array( "department_id" => $department_id );
        $result = $this->service->query($where);
        $technology = new Technology();
        $technology->generateFromRedBean($result);
        $results = array_slice($technology->data,0,$limit);
        return $results;
    }
    /**
     * 获取最新
     */
    public function getNewest($limit){
        $where = array();
        $where['page'] = 1;
        $where['size'] = $limit;
        $result= $this->service->query($where);
        return $result->data;
    
    }
     /**
     * 
     * 获取列表 
     */
    public function getTecList($sql){
		return $this->service->getJoin ( $sql );
    }   
    /**
     * 
     * 获取表字段 
     */
    public function getTecFields(){
		return $this->service->getFields();
    }    
    
}