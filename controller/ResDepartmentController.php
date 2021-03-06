<?php

class ResDepartmentController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new ResDepartmentService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        //$filterService->addFunc($filterService::$WORKERISLOGIN);
        //$filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }
    
    


    /**
     * 获取科室信息
     */
    public function getDepartments() {
        $department = $this->service->getDepartments();        
        $i=0;
		$result = array();
        foreach($department->data as $k=>$v){
        	if($v->belong==''||$v->belong==0){
        		$result[$i]=$v;
        		$j=$v->id;
        		$i++;
        		foreach ($department->data as $valSon){
        			if($valSon->belong==$j){
        				$valSon->name='&nbsp;&nbsp;|--'.$valSon->name;
        				$result[$i]=$valSon;
        				$i++;
        				$x=$valSon->id;
        				foreach ($department->data as $childSon){
        					if($childSon->belong==$x){
        						$childSon->name='&nbsp;&nbsp;&nbsp;&nbsp;|--'.$childSon->name;
        						$result[$i]=$childSon;
        						$i++;
        					}        					     					
        				}
        			}
        		}
        	}
        }
        $department->data=$result;
        echo json_encode($department);
    }

    /**
     * 删除数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $departments = $_REQUEST['id'];
        } else {
            $departments = array(
                $_REQUEST['id']
            );
        }
 
        $result = $this->service->deleteBatch($departments);

        echo json_encode($result);
    }
    
    /**
     * 获得查询的grid数据
     * num 科室拥有的医生数量，resernum 整个科室的预约量
     */
    public function query() { 
 	
        $result = $this->service->query($_REQUEST);  
               
        $totalRows = $this->service->totalRows($_REQUEST);
        $resdoctor=new ResDoctorService();
        $resbookinginfo=new ResBookingInfoService();
        $thedate=$this->service->objectToArray($result->data);    
        
        $arrid=array();
        $arresult=array();
		foreach ($thedate as $key=>$value){
			$thedate[$key]['belong']=$this->service->getDepartmentNameByID($thedate[$key]['belong']);
			//预约数量
			$where['department_id']=$value['id'];
			$arrid[$key]['reserver']=$resbookinginfo->getConditionNum($where);
			//医生数量
			$arrid[$key]['num']= $resdoctor->countByDepartment($value['id']);
			
		 	$arresult[$key]=array_merge($thedate[$key], array('num'=>$arrid[$key]['num'],'resernum'=>$arrid[$key]['reserver'])); 			
		}			
        echo json_encode(array(
        	'data'=> $arresult,
            'rows' => $arresult,
            'ttl' => $totalRows->data
        ));
    }


    
    /**
     * 获得单笔动态数据
     */
    public function get() {
        $this->blindParams($department = new ResDepartment());
        $result = $this->service->get($department);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $this->blindParams($department = new ResDepartment());

        $result = $this->service->update($department);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function addDepartment() {
    	
        echo json_encode($this->service->addDepartment());
        
    }
    
    /**
     * 根据ID获得科室名称
     */
    public function getDepartmentNameByID($ID) {
    	 
    	return $this->service->getDepartmentNameByID($ID);
    
    }
  
    /**
     * 修改科室
     **/
    public function editDepartment() {
    	echo json_encode($this->service->editDepartment());
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
    /*
     * 导入数据
    *
    * */
    
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
     * 导出数据
    *
    * */
    
    public function exportdate(){ 	
    	$thedate=$this->service->checkdate();
    	if(empty($thedate)){
    		$result=false;
    	}else{    		
    		$result = $this->service->query($_REQUEST); 
    		
    		$thedate=$this->service->objectToArray($result->data);
    		$arrid=array();
    		$arresult=array();
    		$resdoctor=new ResDoctorService();
    		$resbookinginfo=new ResBookingInfoService();
    		foreach ($thedate as $key=>$value){   			
    			//预约数量
    			$where['department_id']=$value['id'];
    			$arrid[$key]['reserver']=$resbookinginfo->getConditionNum($where);
    			//医生数量
				$arrid[$key]['num']= $resdoctor->countByDepartment($value['id']);
    			$arresult[$key]=array_merge($thedate[$key], array('num'=>$arrid[$key]['num'],'resernum'=>$arrid[$key]['reserver']));
    		}
    		$str = "科室id,科室名称,医生数量,预约数量\n";
			while(list($key, $value)=each($arresult)){
				$str .= $value[id].",".$value[name].",".$value[num].",".$value[resernum]."\n";	
			}

			$filename = date('Ymdhis').rand(1000,9999).'.csv';
	    	    $csv_url = ABSPATH."/". $filename; 
	    	    $myfile = @fopen( $csv_url, "w") or die("Unable to open file!");
	    	    $strdate =iconv('utf-8','GB2312//IGNORE',$str);
	    	    @fwrite($myfile, $strdate);
	    	    @fclose($myfile);  
	    	    $files=NETADDRESS."/".$filename; 
	    	    echo json_encode(array('stutes'=>true,'url'=>$files));  		
     }
  }
 
   
    
}

