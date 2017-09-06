<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 科室
 * @author Administrator
 *
 */
class departmentMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}
	
	/**
	 * 
	 * 科室主页
	 */
	public function index(){
		
        $this->smarty->assign('id',(int)$_REQUEST['id']);
		$this->smarty->display( 'Department/index' . TPLSUFFIX );
	}
	
	
	/**
	 *科室疾病列表内容
	 */
	public function query(){		
		$param = array();
		if(isset($_REQUEST['disease_id']) && $_REQUEST['disease_id'] != ''){
			$param['disease_id'] = (int)$_REQUEST['disease_id'];
			$this->smarty->assign('diseaseId',$_REQUEST['disease_id']);
		}
		if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
			$param['department_id'] = (int)$_REQUEST['department_id'];
			$this->smarty->assign('departmentId',$_REQUEST['department_id']);
		}
		$firstdep = $this->getServiceMethod('department','getonedepart');
		
		if(!empty($firstdep->data)){
			$this->smarty->assign('firdep',$firstdep->data);
			
			$diseaseser=new DiseaseService();
			$diseaarr=$diseaseser->getByDepartmentID($firstdep->data->id);
			if(!empty($diseaarr->data)){
				$this->smarty->assign('firdepdie',$diseaarr->data);
			}else{
				$this->smarty->assign('firdepdie','');
			}
			$articleser=new ArticleService();
			$articlearr=$articleser->getByDepartmentID($firstdep->data->id,1,4,'desc');
			if(!empty($articlearr->data)){
				$this->smarty->assign('firdeparticle',$articlearr->data);
			}else{
				$this->smarty->assign('firdeparticle','');
			}
			
		}else{			
			$this->smarty->assign('firdep','');
		}
		
		$list = $this->getServiceMethod('article','query',$param);
		if(!is_array($this->result)){
			unset($this->result);
		}
		$this->result['data']  = $list->data;
		$this->result['ttl']   = count($list->data);
		
		
		
		$this->pageSetting( 10 ,'department','article',$param);
		$moreParam="";
		if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
			$moreParam.="&department_id=".$param['department_id'];
		}
		if(isset($_REQUEST['disease_id']) && $_REQUEST['disease_id'] != ''){
			$moreParam.="&disease_id=".$param['disease_id'];
		}
		$this->smarty->assign('moreParam',$moreParam);
	    $this->smarty->display( 'Department/list' . TPLSUFFIX );
	}

    /**
     *疾病内容
     *
     */
    public function get(){
    	if(isset($_REQUEST['department_id'])&&$_REQUEST['department_id']){
    		$this->smarty->assign('departmentId',(int)$_REQUEST['department_id']);
    		$deparmtnet=$this->getServiceMethod('department','getdepbyarr',array('id'=>(int)$_REQUEST['department_id']));
    		if(!empty($deparmtnet->data)){
    			$this->smarty->assign('department',$deparmtnet->data);
    		}else{
    			die('未找到科室');
    		}
    		$pirarr=$this->getServiceMethod('disease','getdiseasebyname',array('name'=>'图片集锦','department_id'=>(int)$_REQUEST['department_id']));
    		if($pirarr->data->id){
    			$disarticle=$this->getServiceMethod('article','getByDisease',$pirarr->data->id);
    			if(!empty($disarticle->data)){
    				$this->smarty->assign('picarr',$disarticle->data);
    			}else{
    				$this->smarty->assign('picarr','');
    			}
    		}
    		
    		$jiankan=$this->getServiceMethod('disease','getdiseasebyname',array('name'=>'健康教育','department_id'=>(int)$_REQUEST['department_id']));
    		if($jiankan->data->id){
    			$jiankanarticle=$this->getServiceMethod('article','getByDisease',$jiankan->data->id);
    			if(!empty($jiankanarticle->data)){
    				$this->smarty->assign('jiankanarr',$jiankanarticle->data);
    			}else{
    				$this->smarty->assign('jiankanarr','');
    			}
    		}
    		

    		
    	  	    	
    	}
    	if(isset($_REQUEST['disease_id'])&&$_REQUEST['disease_id']){
    		
    		
    	$this->smarty->assign('diseaseId',(int)$_REQUEST['disease_id']);
    	}
    	
    	if(isset($_REQUEST['id'])&&$_REQUEST['id']){
    	$this->smarty->assign('id',(int)$_REQUEST['id']);
    	}
        $this->smarty->display( 'Department/detail' . TPLSUFFIX );
    }
}
new departmentMobile();

?>