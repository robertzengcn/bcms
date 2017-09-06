<?php
/**
 * 
 * 在线问答tag标签
 * @author Administrator
 *
 */
class AskTag extends CommonTag {
	
	/**
	 * 
	 * 构造方法,实例化在线问答服务层模块
	 */
	function __construct() {
		$this->service = new AskService ();
		parent::__construct( get_class() );
	}
	
	/**
	 * 
	 * 根据页码获取对应的数据
	 * {{foreach $tagOb->getList($cur) as $v}}
	 * {{/foreach}}
	 * @param  int $current  当前页
	 * @param  boolean $sort 排序规则,true为时间降序
	 * @return array&object 数组对象
	 */
	public function getList($current,$size='',$sort = true, $is_display = 1) {
		#.第几页
		$current   = (int)$current <= 0 ? 1 : (int)$current;
		#.查询总条数
		$count  = $this->service->totalRows ( array ('1' => 1 ) )->data;
		#.分页数
		$pageCount = ceil( $count / $this->tagConfig['pageSize']);
		#.组合条件进行数据查询
		$size = $size == '' ? $this->tagConfig['pageSize'] : $size;
		$where = array ("page" => $current, "size" => $size, "isdisplay"=>$is_display );
		$data  = $this->service->query ( $where )->data;
		#.数据过滤
		/* foreach($data as $key=>$value){
			$data[$key]->plushtime = date('Y-m-d',strtotime( $value->plushtime ));
		} */
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
		return $this->setPageHtml($current, $size , $count , 'ask' );
	}
	
	/**
	 * 
	 * 根据在线问答唯一id获取对应的在线问答信息
	 * 包含问题简单信息、所有信息、化验单信息
	 * @param int $id
	 */
	public function get( $id ) {
		$id = (int)$id <= 0 ? 0 : (int)$id;
		$askInfo = $this->service->getRepeat( $id );
		if($askInfo->isanswer != 0 ) {
			$doctorTag  = new DoctorTag();
			$doctorInfo = $doctorTag->get( $askInfo->doctorID );
			$askInfo->doctor_name = $doctorInfo->name;
		}
		unset($askInfo->doctorID);
		return $askInfo;
	}
	
	/**
	 * 
	 * 根据在线问答唯一id获取对应的追问&回复信息
	 * @param int $id
	 */
	public function getAddto( $id ) {
		$id = (int)$id <= 0 ? 0 : (int)$id;
		$answerService = new AnswerService();
		return $answerService->getAskAddto( $id );
	}

    /**
     *
     * 根据科室ID获取问答信息
     * @param $department_id 科室id
     *
     */
    public function getDepartmentAsk($department_id , $limit = ''){
        return $this->service->getDepartmentAsk($department_id,$limit);
    }

    /**
     *
     * 根据疾病ID获取问答信息
     * @param $disease_id 疾病id
     *
     */
    public function getDiseaseAsk($disease_id){
        return $this->service->getDiseaseAsk($disease_id);
    }

	/**
	 * 根据推荐位置获取 在线问答...
	 * @param unknown_type $ask_id
	 */
	public function getByRecommend($recommend,$name='ask_id',$is_tomobile=''){
	    if (!is_numeric($recommend)){
	        $position = new RecommendPositionService();
	        $result = $position->getByName($recommend,$is_tomobile);
	        $recommend_id = $result->id;
	    }else{
	        $recommend_id = (int)$recommend <=0 ? 0 : (int)$recommend;
	    }
	    $recommendObj = new RecommendListService();
	    $asks= $recommendObj->getByRecommendID($recommend_id,$name);
	    $resultArr = array();
	    foreach ($asks as $value){
	        $askss = new Ask();
	        $askss->id = $value->ask_id;
	        $resultArr[] = $this->service->get($askss)->data;
	    }
	    return $resultArr;
	}
    /**
     * 
     * 获取列表 
     */
    public function getAskList($sql){
		return $this->service->getJoin ( $sql );
    }   
    /**
     * 
     * 获取表字段 
     */
    public function getAskFields(){
		return $this->service->getFields(false,true,array('userID','departmentID','diseaseID'));
    } 
}