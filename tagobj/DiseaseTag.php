<?php
/**
 * 
 * 疾病管理tag标签
 * @author Administrator
 *
 */
class DiseaseTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		$this->service = new DiseaseService ();
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
	 * {{$info = $DiseaseTag->get($id)}}
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
		$disease = new Disease();
		$disease->generateFromRedBean($result);
		return $disease;
	}
	
	/**
	 * 
	 * 根据id或者name集合获取数据
	 * {{$tagOb->in(10,11,12)}}
	 * @param $valArray
	 */
	public function in($valArray) {
		return $this->inBase($valArray, 'disease');
	}
	
	
	/**
	 * 根据科室获取疾病
	 * @param unknown_type $department_id
     * @param unknown type $size  疾病数组分割步数
	 */
	public function getByDeparment($department,$size = null){
		if (!is_numeric($department)){
			$where = array();
			$where['name'] = $department;
			$deparmentObj = new DepartmentService();
			$rs = $deparmentObj->query($where)->data;
			$department_id = $rs[0]->id;
		}else{
			$department_id = (int)$department <=0 ? 0 : (int)$department;
		}
		$diseases = $this->service->getByDepartmentID($department_id)->data;
        if($size!==1 && isset($size)){
            $diseases = array_chunk($diseases,$size,true);
        }
        return $diseases;
	}
	
	/**
	 * 根据科室获取顶级疾病
	 * @param unknown_type $department_id
	 * @param unknown type $size  疾病数组分割步数
	 */
	public function getByDisease($department,$size = null){
		if (!is_numeric($department)){
			$where = array();
			$where['name'] = $department;
			$deparmentObj = new DepartmentService();
			$rs = $deparmentObj->query($where)->data;
			$department_id = $rs[0]->id;
		}else{
			$department_id = (int)$department <=0 ? 0 : (int)$department;
		}
		$diseases = $this->service->getByDisease($department_id)->data;
		if($size!==1 && isset($size)){
			$diseases = array_chunk($diseases,$size,true);
		}
		return $diseases;
	}
	
	/**
	 * 根据id获取子级疾病
	 * @param int $id
	 * @param unknown type $size  疾病数组分割步数
	 */
	public function getByDiseaseID($id,$size = null){
		$department_id = (int)$id <=0 ? 0 : (int)$id;
		$diseases = $this->service->getByDiseaseID($id)->data;
		if($size!==1 && isset($size)){
			$diseases = array_chunk($diseases,$size,true);
		}
		return $diseases;
	}
	
	/**
	 * 获取
	 * @param int $id 文章id
	 * @echo 输出实际路径
	 */
	public function getDiseaseUrl($id,$did, $isEcho = true){
		$id  = (int)$id <= 0 ? 0 : (int)$id;
		$did = (int)$did <= 0 ? 0 : (int)$did;
		$diseaseService = new DiseaseService();
		$diseaseArrays  = $diseaseService->query( array() );
		$this->initDiseaseData = $diseaseArrays->data;
		$departService  = new DepartmentService();
		$departArrays   = $departService->query( array() );
		$this->initDepartmentData = $departArrays->data;
		$url = NETADDRESS;
		//循环科室信息
		foreach( $this->initDepartmentData as $key => $value ){
			if( $value->id == $did ){
				$url .= '/' . $value->url;break;
			}
		}
		
		if ($isEcho) {
		    ECHO $url . '/' . $this->getParUrl( $diseaseArrays->data , $id ) . '/index.html';
		} else {
		    return $url . '/' . $this->getParUrl( $diseaseArrays->data , $id ) . '/index.html';
		}
		
	}
	
	/**
	 * 通过递归形式,获取某个疾病的整体路径
	 * @param unknown $diseases
	 * @param unknown $id
	 * @param string $data
	 * @return string
	 */
	private function getParUrl( $diseases , $id  ,$data = '' ){
		foreach($diseases as $key => $value){
			if($value->id == $id){
				$data[] = $value->url;
				if( $value->parent_id != 0 ) {
					return $this->getParUrl($diseases, $value->parent_id , $data);
				}
			}
		}
		return implode( '/' , array_reverse( $data ) );
	}
	/**
	 *
	 * 根据唯一id获取该id的字段详细信息
	 * {{$news = $tagOb->get($id)}}
	 * @param int $id 唯一id
	 * @param string $field 字段
	 */
	public function getInfo($value, $field) {
			$id = (int)$value <= 0 ? 0 : (int)$value;
		$result = $this->service->getFieldInfo( $id, $field);
		return $result;
	}
    //获取表字段 
    public function getDisFields(){
		return $this->service->getFields();
    }
    /**
     * 
     * 获取列表 
     */
    public function getDisList($sql){
		return $this->service->getJoin ( $sql );
    } 
}