<?php

class ResDoctorController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new ResDoctorService();
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
            $doctors = $_REQUEST['id'];
        } else {
            $doctors = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($doctors);
        echo json_encode($result);
    }
    

    
    /*
     * 更新医生部门
     * 
     * */
    public function update_department(){
    	if (is_array($_REQUEST['id'])) {
    		$doctors = $_REQUEST['id'];
    	} else {
    		$doctors = array(
    				$_REQUEST['id']
    		);
    	}
    	$department=$_REQUEST['department_id'];
    	foreach ($doctors as $key=>$val){

    		$this->service->update_department($val,$department);
    	}
    	
    	
    }

    /**
     * 获得查询的grid数据
     */
    public function query() {    	
        $doctors = $this->service->query($_REQUEST);        
        $totalRows = $this->service->totalRows($_REQUEST); 
        $resbookinginfo=new ResBookingInfoService();
        $thedate=$this->service->objectToArray($doctors->data);  
        if(isset($_REQUEST['start_time'])&&$_REQUEST['start_time']){
        	$startdate=$this->changedate($_REQUEST['start_time']);
        }else{
        	$startdate="";
        }
        if(isset($_REQUEST['end_time'])&&$_REQUEST['end_time']){
        	$enddate=$this->changedate($_REQUEST['end_time']);
        }else{
        	$enddate="";
        }
        $arrid=array();
        $arresult=array();        
        foreach ($thedate as $key=>$value){
        	$where['doctor_id']=$value['id'];        	
        	$diagnosed['statu']='已到诊';
        	$diagnosed['doctor_id']=$value['id'];        	
        	//预约总数
        	$arrid[$key]['reserver']=$resbookinginfo->getConditionNum($where);
        	//到诊患者总数
        	$arrid[$key]['mark']=$resbookinginfo->getConditionNum($diagnosed);
        	//查询关联的展示医生信息
        	$doctorService=new DoctorService();
        	$relation_ret=$doctorService->getByResDoctorId($value['id']); 
        	
        	if(isset($relation_ret['id'])&&$relation_ret['id']!=''&&isset($relation_ret['name'])&&$relation_ret['name']!=''){
        		$arrid[$key]['rel_name']=$relation_ret['name'];
        		$arrid[$key]['rel_id']=$relation_ret['id'];
        	}else{
        		$arrid[$key]['rel_name']='未关联';
        		$arrid[$key]['rel_id']='';
        	}
        	$arrid[$key]['genters']=$this->genderchar($value['gender']);
        	$arrid[$key]['department_name']=$this->changenull($value['department_name']);
        	$arresult[$key]=array_merge($thedate[$key], array('rel_name'=>$arrid[$key]['rel_name'],'rel_id'=>$arrid[$key]['rel_id'],'resernum'=>$arrid[$key]['reserver'],'mark'=>$arrid[$key]['mark'],'genters'=>$arrid[$key]['genters'],'department_name'=>$arrid[$key]['department_name']));
        	
        }  		
        echo json_encode(array(
        	'data'=>$arresult,
            'rows' => $arresult,
            'ttl' => $totalRows->data
        ));
    }

    /**
     * 获得己关联科室的医生数据
     */
    public function getDocHasDep() { 
    	$data = $this->service->getDocHasDep();
    	echo json_encode($data);
    }
    
    
    /*
     * 修改医生和科室的关联关系
    * */
    
    public function change_relation(){
         if(is_array($_REQUEST['id'])){
         	foreach ($_REQUEST['id'] as $k=>$v){
         		$arr=array('id'=>(int)$v);
         		$this->service->delete_relation($arr);
         	}
         }else{
         	$arr=array('id'=>(int)$_REQUEST['id']);
         	$this->service->delete_relation($arr);
         }
    	

    

    		$array=array('statu'=>true,
    				     'msg'=>null,
    				     'data'=>null
    		);

    	echo json_encode($array);
    }
    
    
    /*
     * 查询是否有数据存在
    *
    * */
    public function checkdate(){
    	$thedate=$this->service->checkdate();
    	if(empty($thedate)){
    		$stute=false;
    	}else{
    		$stute=true;
    	}
    	echo json_encode(array('stutes'=>$stute));
    }


    
    /**
     * 编辑数据
     */
    public function ediorDoctor() {
        $result = $this->service->ediorDoctor();
        echo json_encode($result);
    }

    /**
     * 添加数据
     */
    public function addDoctor() {       
        $result = $this->service->addDoctor();
        echo json_encode($result);
    }
	
    /**
     * 获取数据
     */
	public function getDoctorsById() {
        $result = $this->service->getDoctorsById();        
        echo json_encode($result);
    }
    
    /**
     * 根据医生名称获取数据
     */
    public function getDoctorsByName() {    	
    	$result = $this->service->getDoctorsByName();    	
    	echo json_encode($result);
    }
    
    
    /**
     * 根据疾病ID 获取医生
     */
    public function getByDiseaseId() {
        $result = $this->service->getByDiseaseId();

        echo json_encode($result);
    }

    /**
     * 根据科室ID来获取医生
     */
    public function getByDepartmentID() {
        $res = $this->service->getByDepartmentID($_REQUEST['department_id']);

        echo json_encode($res);
    }
    
    /**
     * 根据医生ID来获取医生姓名
     */
    public function getNameByID($id) {
    	$res = $this->service->getNameByID($id);    
    	echo json_encode($res);
    }
    
    /**
     * 获取静态url列表
     */
    public function getHtmlUrl() {

    	$result = $this->service->getHtmlUrl();
    
    	echo json_encode($result);
    }
    
    /**
     * 添加医生关联关系
     * */
    public function updata_relation() {
    	if (is_array($_REQUEST['id'])) {
    		$doctors = $_REQUEST['id'];
    	} else {
    		$doctors = array($_REQUEST['id']);
    	}
    	$relation_id=$_REQUEST['relation_id'];
    	foreach ($doctors as $key=>$val){    	
    		$this->service->updata_relation($val,$relation_id);
    	}
    }
    
    /*
     * 导出数据
    *
    * */
    
    public function exportdate(){
    	$thedate=$this->service->checkdate();
    	if(empty($thedate)){
    		throw new ValidatorException(180);
    	}else{    
    		$result = $this->service->query($_REQUEST);
    		$thedate=$this->service->objectToArray($result->data);    		
    		$resbookinginfo=new ResBookingInfoService();
    		$arrid=array();
    		$arresult=array();
    		foreach ($thedate as $key=>$value){
    			$where['doctor_id']=$value['id'];
    			$diagnosed['statu']='已约';
    			$diagnosed['doctor_id']=$value['id'];
    			//预约总数
    			$arrid[$key]['reserver']=$resbookinginfo->getConditionNum($where);
    			//到诊患者总数
    			$arrid[$key]['mark']=$resbookinginfo->getConditionNum($diagnosed);
    			$arrid[$key]['genters']=$this->genderchar($value['gender']);
    			$arrid[$key]['department_name']=$this->changenull($value['department_name']);
    			$arresult[$key]=array_merge($thedate[$key], array('resernum'=>$arrid[$key]['reserver'],'mark'=>$arrid[$key]['mark'],'genters'=>$arrid[$key]['genters'],'department_name'=>$arrid[$key]['department_name']));
    			 
    		}
    		
    		$str = "医生id,医生姓名,科室,擅长病种,性别,预约数,到诊数\n";    
    
    		while(list($key, $value)=each($arresult)){
    			$str .= $value[id].",".$value[name].",".$value[department_name].",".$value[specialty].",".$value[genters].",".$value[resernum].",".$value[mark]."\n";
    
    		}    		
    		$filename = date('Ymdhis').rand(1000,9999).'.csv';
    		$csv_url = ABSPATH."/upload/". $filename;
    		$myfile = @fopen( $csv_url, "w") or die("Unable to open file!");
    		$strdate =iconv('utf-8','GB2312//IGNORE',$str);
    
    		@fwrite($myfile, $strdate);
    
    		@fclose($myfile);
    		$files=NETADDRESS."/upload/".$filename;
    		echo json_encode(array('stutes'=>true,'url'=>$files));
    	}
    }
    
    public function importdate(){
    	 
        	   	 
    	$thedate=$this->service->checkdate();
    	
    	if(empty($thedate)){
    		$result=$this->service->importdate();
    	}else{
    		$result=false;
    	}
    
    	echo json_encode(array('stutes'=>$result));
    }
    
    /*
     * 获取除本科室外的其它科室医生
    * */
    public function get_otherdoctor(){
    
    	$result=$this->service->get_otherdoctor($_REQUEST);
    	echo json_encode($result);
    }
    
    /*
     * 批量设置医生所属科室
    *
    * */
    public function changedepartment(){    	
    	if(isset($_REQUEST['id'])&&$_REQUEST['id']!=null){
    		if(isset($_REQUEST['department_id'])&&$_REQUEST['department_id']!=null){
    			$reserverationservice=new ReservationService();
    	        if(is_array($_REQUEST['id'])){
    	          foreach($_REQUEST['id'] as $key=>$val){
    		        $this->service->changedepartment($val,$_REQUEST['department_id']);
    		        $reserverationservice->updatedepartment($val,$_REQUEST['department_id']);
    	          }
    	       }else{
    		      $this->service->changedepartment($_REQUEST['id'],$_REQUEST['department_id']);    		
    		      $reserverationservice->updatedepartment($_REQUEST['id'],$_REQUEST['department_id']);
    	       }
    	$arr=array('stute'=>true,
    	             'msg'=>null,
    	             'data'=>null);
    	echo json_encode($arr);
    		}else{
    			throw new ValidatorException(27);
    		}
    }else{
    	throw new ValidatorException(7);
    }
    }
    
    
}

