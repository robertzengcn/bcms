<?php

class DiseaseController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new DiseaseService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    /**
     * 删除数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $diseases = $_REQUEST['id'];
        } else {
            $diseases = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($diseases);
		//如果删除成功,则遍历删除其子类
		if($result->statu){
			foreach( $diseases as $value ){
				$this->delSubList( $value );
			}
		}
        echo json_encode($result);
    }

    /**
     * 查询
     */
    public function query() {
        $diseases = $this->service->query($_REQUEST);        
        $totalRows = $this->service->totalRows($_REQUEST);
        fb($diseases);
		foreach( $diseases->data as $key => $value ) {
			$diseases->data[$key]->disease_name    = '无';
			if($value->parent_id != 0){
				$parentInfo = $this->getPar( $value->parent_id );
				//如果存在父的情况下
				if(isset($parentInfo[0]['id']) && $parentInfo[0]['id'] >= 1 ) {
					$diseases->data[$key]->disease_name = $parentInfo[0]['name'];
				}
			}
		}
        echo json_encode(array(
            'rows' => $diseases->data,
            'ttl' => $totalRows->data
        ));
    }

    /**
     * 根据科室ID 获取疾病
     */
    public function getByDepartmentID() {
        $disease = $this->service->getByDepartmentID($_REQUEST['department_id']);

        echo json_encode($disease);
    }
    
    /**
     * 添加案例
     */
    public function add() {
        $this->blindParams($disease = new Disease());
        $result = $this->service->save($disease, $_REQUEST['department_id']);

        echo json_encode($result);
    }

    /**
     * 获得单笔数据
     */
    public function get() {
        $this->blindParams($disease = new Disease());
        $result = $this->service->get($disease);

        echo json_encode($result);
    }

    /**
     * 编辑数据
     */
    public function edit() {
        $this->blindParams($disease = new Disease());
        $result = $this->service->update($disease);
        //更新层级关系
        $this->updateSubLayer( (int)$_REQUEST['id'] );
        //更新department
        $this->upSubListDepartment( (int)$_REQUEST['id'] , (int)$_REQUEST['department_id'] );
        echo json_encode($result);
    }
    
    /**
     * 通过ID获取它的单个子集
     */
    public function getSub() {
        $disease = $this->service->getSub($_REQUEST['id']);

        echo json_encode($disease);
    }
    
    /**
     * 通过parent_id获取它的单个父集
     */
    public function getPar($parent_id) {
        $disease = $this->service->getPar( $parent_id );
        
		return $disease->data;
    }
    
    /**
     * 通过parentId获取它的所有父集
     */
    public function getParList() {
        $disease  = $this->service->getParList();
        $parentId = (int)$_REQUEST['id'];
        $data = $this->getParListIds( $disease->data  , $parentId );
        $data = array_reverse( $data );
        array_pop( $data );
        if( count( $data ) <= 0 ){
        	die( json_encode( new Result( false , 0 , '' , null ) ));
        }
        die( json_encode( new Result( true , 0 , '' , $data ) ));
    }
    
    /**
     * 通过ID删除它的所有子集
     * @param int $DiseaseID 疾病id
     */
    private function delSubList( $DiseaseID ) {
    	$diseases  = $this->service->getParList();
    	$data      = $this->getSubListIds($diseases->data, $DiseaseID , 1 );
    	return $this->service->delSubList($data);
    }
    
    /**
     * 通过ID更新它的所有子集的科室ID
     * @param int $DiseaseID 疾病id
     * @param int $DepartmentID 科室id
     */
    private function upSubListDepartment( $DiseaseID , $DepartmentID) {
    	$diseases  = $this->service->getParList();
    	$data      = $this->getSubListIds($diseases->data, $DiseaseID , 1 );
    	return $this->service->upSubListDepartment($data,$DepartmentID);
    }
    
	/**
	 * 
	 * 更新某疾病下所有子孙之间的层级关系
	 * @param int $DiseaseID 索引id
	 */
    private function updateSubLayer( $DiseaseID ) {
    	$diseases  = $this->service->getParList();
    	$disease = new Disease();
    	$disease->id = $DiseaseID;
    	$result = $this->service->get($disease);
    	$layers = $this->getSubListIds($diseases->data, $DiseaseID , ($result->data->layer + 1) );
    	foreach( $layers as $key => $value ){
    		$data[$value->id] = $value->layer;
    	}
    	if( isset($data) ){
    		return $this->service->updateSubLayer($data);
    	}
    	return true;
    }
    
    /**
     * 
     * 递归方法(通过索引id,反向递归其族谱树id)
     * @param array $diseases 数据数组
     * @param int $id 索引id
     * @param array $data 用户递归叠加的数据
     */
    private function getParListIds($diseases,$id,$data = array()){
    	foreach($diseases as $key => $value){
    		if($value->id == $id){
    			$data[] = array('id'=>$value->id,'select'=>$this->getBroList($diseases, $value->department_id , $value->layer, $value->id ));
    			if( $value->parent_id != 0 ) {
    				return $this->getParListIds($diseases, $value->parent_id,$data);
    			}
    		}
    	}
    	return $data;
    }
    
    /**
     * 
     * PC端*****根据科室ID查询其子孙树,并输出为select下拉框输出
     */
    public function getDepartSubTree() {
    	$disease_id = 0;
    	if( isset( $_REQUEST['disease_id'] ) && $_REQUEST['disease_id'] != '' ) {
    		$disease_id  = (int)$_REQUEST['disease_id'];
    	}
    	$DiseaseTrue = $this->service->getByDepartmentID($_REQUEST['department_id']);
    	$html = '';
    	//$html .= '<select>';
    	$html .= '<option value="">请选择</option>';
    	$diseases  = $this->service->getParList();
    	$diseases  = $diseases->data;
    	$department = new Department();
    	$department->id = (int)$_REQUEST['department_id'];
    	$departmentService = new DepartmentService();
    	$departmentInfo    = $departmentService->get($department);
    	$departmentUrl     = $departmentInfo->data->url;
    	foreach( $DiseaseTrue->data as $key => $value ) {
    		if( (int)$value->parent_id == 0 ){
    			$flag = $departmentUrl . '/' . $this->getParUrl($diseases, $value->id);
    			if($disease_id == $value->id){
    				$html .= "<option flag='".$flag."' value='".$value->id."' selected='selected'>".$value->name."</option>";
    			}else{
    				$html .= "<option flag='".$flag."' value='".$value->id."'>".$value->name."</option>";
    			}
	    		$tree = $this->getSubListIds( $DiseaseTrue->data , $value->id , 1 , true );
	    		if(count($tree) >= 1){
	    			foreach ( $tree as $k => $v ) {
	    				$prefix = '';
	    				for($i=1;$i<=$v->layer;$i++){
	    					$prefix .= "&nbsp;&nbsp;";
	    				}
	    				$flag = $departmentUrl . '/' . $this->getParUrl($diseases, $v->id);
	    				if($disease_id == $v->id){
	    					$html .= "<option flag='".$flag."' value='".$v->id."' selected='selected'>".$prefix."|-".$v->name."</option>";
	    				}else{
	    					$html .= "<option flag='".$flag."' value='".$v->id."'>".$prefix."|-".$v->name."</option>";
	    				}
	    			}
	    		}
    		}
    	}
    	//$html .= "</select>";
    	echo json_encode( new Result(true, 0, '', $html ) );
    }
    
    /**
     *
     * 微信管理*****根据科室ID查询其子孙树
     */
    public function getWechatDepartSubTree() {
    	if(isset($_REQUEST['department_id'])&&$_REQUEST['department_id']){
    		$DiseaseTrue = $this->service->getByDepartmentID($_REQUEST['department_id']);
    		$k==0;
    		$result=array();
    		foreach( $DiseaseTrue->data as $key => $value ) {
    			$flag = 'article.php?method=query&department_id='.$value->department_id.'&disease_id='.$value->id;
    			$result[$k]['id']=$value->id;
    			$result[$k]['name']=$value->name;
    			$result[$k]['url']=$flag;
    			$k++;
    		}
    		echo json_encode( new Result(true, 0, '', $result ) );
    	}else{
    		echo json_encode( new Result(false, 0, '', '' ) );
    	}
    }	
    
    /**
     * 
     * 手机端*****根据科室ID查询其子孙树,并输出为select下拉框输出
     */
    public function getMobileDepartSubTree() {
    	$disease_id = 0;
    	if( isset( $_REQUEST['disease_id'] ) && $_REQUEST['disease_id'] != '' ) {
    		$disease_id  = (int)$_REQUEST['disease_id'];
    	}
    	$DiseaseTrue = $this->service->getByDepartmentID($_REQUEST['department_id']);    	
    	$html = '';    	
    	$html .= '<option value="">请选择</option>';    	
    	foreach( $DiseaseTrue->data as $key => $value ) {
    		if( (int)$value->parent_id == 0 ){
    			$flag = 'article.php?method=query&department_id='.$value->department_id.'&disease_id='.$value->id;
    			if($disease_id == $value->id){
    				$html .= "<option flag='".$flag."' value='".$value->id."' selected='selected'>".$value->name."</option>";
    			}else{
    				$html .= "<option flag='".$flag."' value='".$value->id."'>".$value->name."</option>";
    			}
	    		$tree = $this->getSubListIds( $DiseaseTrue->data , $value->id , 1 , true );
	    		if(count($tree) >= 1){
	    			foreach ( $tree as $k => $v ) {
	    				$prefix = '';
	    				for($i=1;$i<=$v->layer;$i++){
	    					$prefix .= "&nbsp;&nbsp;";
	    				}
	    				$flag = 'article.php?method=query&department_id='.$value->department_id.'&disease_id='.$v->id;
	    				if($disease_id == $v->id){
	    					$html .= "<option flag='".$flag."' value='".$v->id."' selected='selected'>".$prefix."|-".$v->name."</option>";
	    				}else{
	    					$html .= "<option flag='".$flag."' value='".$v->id."'>".$prefix."|-".$v->name."</option>";
	    				}
	    			}
	    		}
    		}
    	}    	
    	echo json_encode( new Result(true, 0, '', $html ) );
    }
    
    
    
    
	/**
	 * 
	 * 通过疾病ID获取它的家谱完整URL地址
	 * @param unknown_type $diseases
	 * @param unknown_type $id
	 * @param unknown_type $data
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
    	return implode( '/' , array_reverse( $data ) ) . '/index.html';
    }
    
 
    /**
     * 
     * 递归方法(通过索引id,反向递归查询其子孙树id)
     * @info
     * @param array $diseases 数据数组
     * @param int $id 索引id
     * @param array $data 用户递归叠加的数据
     * @param boolean $clear 是否置空(静态变量处于叠加状态)
     */
    private function getSubListIds( $adds , $id , $layer , $clear = false){
		static $sum = array();
		if($clear){
			$sum = array();
		}
		foreach($adds as $value){
			if($value->parent_id == $id){
				$value->layer = $layer;
				$sum[] = $value;
				$this->getSubListIds($adds,$value->id , $layer+1 );
			}
		}
		return $sum;
    }
    
    /**
     * 
     * 通过科室id、层级id以及主id获取主id下所有层级关系
     * @param array $disease 数据数组
     * @param int $department_id 科室id
     * @param int $layer 层级
     * @param int $id 主索引id
     */
    private function getBroList($disease,$department_id,$layer,$id) {
    	foreach( $disease as $key => $value ) {
    		if( $department_id == $value->department_id && $layer == $value->layer ) {
    			$data[] = array('id'=>$value->id,'layer'=>$value->layer,'name'=>$value->name);
    		}
    	}
    	return $data;
    }
}
?>
