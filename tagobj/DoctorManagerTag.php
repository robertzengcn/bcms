<?php
/**
 * 
 * 预约列表医生信息tag标签
 * @author Administrator
 *
 */
class DoctorManagerTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		
		$this->service = new ResDoctorService ();
		
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
	public function getPageHtml($current, $size = '') {
		#.第几页
		$current   = (int)$current <= 0 ? 0 : (int)$current - 1;
		#.查询总条数
		$count  = $this->service->totalRows ( array ('1' => 1 ) )->data;
		#每页显示条数
		$size = empty($size) ? $this->tagConfig['pageSize'] : $size;
		#.生成html信息
		return $this->setPageHtml($current, $size , $count , 'resdoctor' );
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
		$doctor = new ResDoctor();
		$doctor->generateFromRedBean($result);
		fb($result);
		return $doctor;
	}
	/**
	 *
	 * 随机获取现有的医生中的一条
	 */
	public function getDoctorToday() {
	    $arr = $this->getList();
	    shuffle($arr);
	    $doctor = new ResDoctor();
	    foreach ($arr as $result){
	        $doctor->generateFromRedBean($result);	
	        break;        
	    }
	    return $doctor;
	}	
	
	
	/**
	 * 
	 * 根据id或者name集合获取数据
	 * {{$tagOb->in(10,11,12)}}
	 * @param $valArray
	 */
	public function in($valArray) {
		return $this->inBase($valArray, 'resdoctor');
	}

	/**
	 * 根据科室获取医生 --返回单个对象
	 * @param unknown_type $department_id
	 */
	public function getByDepartment($department){
		if (!is_numeric($department)){
			$where = array();
			$where['name'] =$department;
			$deparmentObj = new ResDepartmentService();
			$rs = $deparmentObj->query($where)->data;
			$department_id = $rs[0]->id;
		}else{
			$department_id = (int)$department <=0 ? 0 : (int)$department;
		}
		$result = $this->service->getByDepartmentID($department_id)->data;
		return empty($result) ? $result : $result[0];
	}
	

	/**
	 * 根据科室获取医生 --返回数组
	 * @param unknown_type $department_id
	 */
	public function getDocByDepartment($department){
	    if (!is_numeric($department)){
	        $where = array();
	        $where['name'] =$department;
	        $deparmentObj = new ResDepartmentService();
	        $rs = $deparmentObj->query($where)->data;
	        $department_id = $rs[0]->id;
	    }else{
	        $department_id = (int)$department <=0 ? 0 : (int)$department;
	    }
	    $result = $this->service->getByDepartmentID($department_id)->data;
	    return $result;
	}
	
	
	
	
	
	/**
	 * 获取医生简历 
	 * @param unknown_type $where
	 * @return Result
	 */
	public function getResumes($doctor){
		$where = array();
		if (!is_numeric($doctor)){
			$where['name'] = $doctor;
			$result = $this->service->findOne( $where , '*' );
			unset($where['name']);
			$where['doctor_id'] = $result->id;
		}else{
			$where['doctor_id'] = $doctor;
		}
		$service = new WorkHistoryService();
		$result = $service->query($where)->data;
		return $result;
	}
	
	/**
	 * 根据推荐位置获取医生信息...
	 * @param unknown_type $doctor_id
	 */
	public function getByRecommend($recommend,$name='doctor_id'){
	    if (!is_numeric($recommend)){
	        $position = new RecommendPositionService();
	        $result = $position->getByName($recommend);
	        $recommend_id = $result->id;
	    }else{
	        $recommend_id = (int)$recommend <=0 ? 0 : (int)$recommend;
	    }
	    $recommendObj = new RecommendListService();
	    $doctors= $recommendObj->getByRecommendID($recommend_id,$name);
	    $resultArr = array();
	    foreach ($doctors as $value){
	        $doctorrs = new ResDoctor();
	        $doctorrs->id = $value->doctor_id;
	        $resultArr[] = $this->service->get($doctorrs)->data;
	    }
	    return $resultArr;
	}
	
}
