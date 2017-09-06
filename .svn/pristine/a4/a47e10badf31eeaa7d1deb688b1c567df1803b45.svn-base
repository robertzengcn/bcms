<?php

/*
 * 科室模块
 * */
if (!defined('Boyiweb')) {
	die('Illegal Access');
}

//ini_set("display_errors", true);
include_once ABSPATH.'/mod/Mod.php';

class Departments extends Mod{
	
	public function __construct() {
		
		parent::__construct();
		$this->excute();
	}
	
	/**
	 *搜索页
	 */
	public function index() {
		
	}
	
	//获取资讯文章
	public function query(){
        $ser = new ArticleService();
    	$article = $ser->query($_REQUEST);
    	$totalRows = $ser->totalRows($_REQUEST);
    	 
    	foreach ($article->data as $key => $value) {
    		$value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
    	}
    	echo json_encode(array(
    			'rows' => $article->data,
    			'ttl' => $totalRows->data
    	));
    }
    
    /*
     * 获取某个科室信息
     * 
     * */    
    public function getdepartment(){
    	$departmentser=new DepartmentService();
    	$deparr=$departmentser->getDepartments();
    	echo json_encode($deparr);    	
    }
    
    /*
     *获取科室下的疾病 
     * */
    public function getdiseasebydep(){
    	$diseaseser=new DiseaseService();
    	if(isset($_REQUEST['department_id'])&&$_REQUEST['department_id']){
    	$diseasearr=$diseaseser->getByDepartmentID((int)$_REQUEST['department_id']);
    	echo json_encode($diseasearr);
    	}
    }
    /*
     * 获取某个预约具体科室信息
     * */
    public function getdepbyid(){
    	if(!isset($_REQUEST['id'])||!$_REQUEST['id']){
    		echo json_encode(array('stute'=>false,'code'=>1,'msg'=>null,'data'=>null));
    		exit();
    	}
    	$departmentmanser=new DepartmentManagerService();
    	$arr=array('id'=>(int)$_REQUEST['id']);
    	$result=$departmentmanser->getdepartmentbyarr($arr);
    	echo json_encode($result);
    }
    
    /*
     * 取二级科室
     * */
	public function getbelongdep(){
		if(!isset($_REQUEST['id'])||!$_REQUEST['id']){
			echo json_encode(array('stute'=>false,'code'=>1,'msg'=>null,'data'=>null));
			exit();
		}
		$departmentmanser=new DepartmentManagerService();
		$arr=array('id'=>(int)$_REQUEST['id']);
		$result=$departmentmanser->getbelongdep($arr);
		echo json_encode($result);
	}
	
	public function get(){
		//$_REQUEST['id'] = $_REQUEST['department_id'];
		$doc = new Department();
		foreach ($doc as $key => $value) {
			if (isset($_REQUEST[$key])) {
				$doc->$key = $_REQUEST[$key];
			}
		}
		$ser = new DepartmentService();
		$result = $ser->get($doc);
		echo json_encode($result);
	}
	
}
new Departments();