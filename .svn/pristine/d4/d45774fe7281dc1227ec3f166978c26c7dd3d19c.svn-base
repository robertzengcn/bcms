<?php

/*
 * 医师模块
 * */
if (!defined('Boyiweb')) {
	die('Illegal Access');
}

//ini_set("display_errors", true);
include_once ABSPATH.'/mod/Mod.php';

class Doctors extends Mod{
	
	public function __construct() {
		
		parent::__construct();
		$this->excute();
	}
	
	/**
     * 搜索医生
     */
    public function querydoc(){
    	$where = array();
    	$where['page'] = (empty($_REQUEST['page']))?'1':$_REQUEST['page'];
    	$where['size'] = isset($_REQUEST['size']) ? $_REQUEST['size'] : 6;
    	$where['name'] = $_REQUEST['name'];
    	$ser = new DoctorService();
    	$array = $ser->query($where);
    	$totals = $ser->totalRows($where);
    	$ttl = $totals->data;
    	$countpage=ceil($ttl/$where['size']); #计算总页面数
    	echo json_encode(array(
    		
    	'rows' => $array->data,
    	'ttl' => $ttl,
    	'curr' => $where['page'],
    	'pages' => $countpage
    	));
    }
	
	/**
	 * 根据科室或星时间或职称获取医生
	 */
	public function getdoctors() {
		$where = array();
		$where['department_id'] = isset($_REQUEST['dep']) ? $_REQUEST['dep'] : null;
		$where['position'] = isset($_REQUEST['position']) ? $_REQUEST['position'] : null;
		$where['page'] = (empty($_REQUEST['page']))?'1':$_REQUEST['page'];
		$where['size'] = isset($_REQUEST['size']) ? $_REQUEST['size'] : 6;
		$doctor = new DoctorService();
		$ttl = $doctor->totalRows($where);
		$docs = $doctor->query($where);
		$dep = new Department();
		$serdep = new DepartmentService();
		foreach($docs->data as $k => $v){
			$dep->id = $v->department_id;
			$depinfo = $serdep->get($dep);
			$v->department_name = $depinfo->data->name;
		}
		$countpage = ceil($ttl->data/$where['size']);
		echo json_encode(array(
				'data' => $docs,
				'ttl' => $ttl->data,
				'page' => $where['page'],
				'pages' => $countpage
		));
	}

	/*
	 * 
	 * 获取医生的方法
	 * */
	public function query(){
		$_REQUEST['page']=(empty($_REQUEST['page']))?'1':$_REQUEST['page'];
		$page = $_REQUEST['page'];
		$ser = new DoctorService();
		$array = $ser->query($_REQUEST);
		if(isset($_REQUEST['size'])&&$_REQUEST['size']){
		$count = $_REQUEST['size'];
		}else{
			$count = 1;
		}
		unset($_REQUEST['page']);
		unset($_REQUEST['size']);
	    $totals = $ser->totalRows($_REQUEST);
	    $ttl = $totals->data;
		
		//$start=($page-1)*$count; #计算每次分页的开始位置
		$countpage=ceil($ttl/$count); #计算总页面数
		//$pagedata=array();
		//$pagedata=array_slice($array,$start,$count); 
		echo json_encode(array(
				 
				'rows' => $array->data,
				'ttl' => $totals->data,
				'curr' => $page,
				'pages' => $countpage
		));
		exit();
    }
/*
 * 根据医生姓名查询医生这周排班情况
 * */
    
    public function getdoctor(){
    	if(isset($_REQUEST['name'])&&$_REQUEST['name']){
    		$doctormanager=new ResDoctorService();
    		$shedult=$doctormanager->getdoctorstu($_REQUEST['name']);
    		if($shedult!=null){
    		foreach ($shedult as $key=>$v){
    			//$shedult[$key]->week=date('w',$v->date);
    			if($v->morning){
    				$shedult[$key]->angle='mon_'.date('w',(int)$v->date);
    				$shedult[$key]->time=$v->morning;
    			}elseif($v->afternoon){
    				$shedult[$key]->angle='aft_'.date('w',(int)$v->date);
    				$shedult[$key]->time=$v->afternoon;
    			}else{
    				$shedult[$key]->angle='nig_'.date('w',(int)$v->date);
    				$shedult[$key]->time=$v->night;
    			}
    		}
    		echo json_encode(array('stute'=>true,'code'=>0,'msg'=>null,'data'=>$shedult));
    		}else{
    			echo json_encode(array('stute'=>false,'code'=>3,'msg'=>'没有该医生排班信息','data'=>null));
    		}
    	}else{
    		echo json_encode(array('stute'=>false,'code'=>1,'msg'=>'医生名称为空','data'=>null));
    	}
    }
	
	
}
new Doctors();