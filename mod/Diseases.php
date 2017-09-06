<?php

/*
 * 医师模块
 * */
if (!defined('Boyiweb')) {
	die('Illegal Access');
}

//ini_set("display_errors", true);
include_once ABSPATH.'/mod/Mod.php';

class Diseases extends Mod{
	
	public function __construct() {
		
		parent::__construct();
		$this->excute();
	}
	
	/**
	 *搜索页
	 */
	public function index() {
		
	}
	
	
	/*
	 *取某个科室,某种疾病的文章 
	 * */
	public function getarticlebydepdie(){
		if(!isset($_REQUEST['department_id'])||!$_REQUEST['department_id']){//检查科室id是否为空
			echo json_encode(array('stute'=>false,'code'=>1,'msg'=>'科室id参数为空','data'=>null));
			exit();
		}
		if(!isset($_REQUEST['disease_name'])||!$_REQUEST['disease_name']){//检查疾病名称是否为空
			echo json_encode(array('stute'=>false,'code'=>2,'msg'=>'疾病名称为空','data'=>null));
			exit();
		}
		
		$jiankan=$this->getServiceMethod('disease','getdiseasebyname',array('name'=>$_REQUEST['disease_name'],'department_id'=>(int)$_REQUEST['department_id']));
		
		if($jiankan->data->id){
			$total=$this->getServiceMethod('article','totalRows',array('disease_id'=>$jiankan->data->id));//取总共多少这个疾病的文章
			if($total->data<=0){
				echo json_encode(array('stute'=>false,'code'=>5,'msg'=>'当前疾病下没有文章','data'=>null));
			}
			if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
				
				$jiankanarticle=$this->getServiceMethod('article','query',array('disease_id'=>$jiankan->data->id,'page'=>$_REQUEST['page'],'size'=>$_REQUEST['size']));
				
			}else{
			$jiankanarticle=$this->getServiceMethod('article','query',array('disease_id'=>$jiankan->data->id));
			}
			if(!empty($jiankanarticle->data)){
				if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
					
					$page=ceil($total->data/(int)$_REQUEST['size']);
					
					$arr=array('stute'=>true,'code'=>0,'msg'=>null,'data'=>$jiankanarticle->data,'page'=>$page);;
				}else{
					$arr=array('stute'=>true,'code'=>0,'msg'=>null,'data'=>$jiankanarticle->data);
				}
				
				
				echo json_encode($arr);
				
			}else{
				echo json_encode(array('stute'=>false,'code'=>4,'msg'=>'当前疾病下没有文章','data'=>null));
			
			}
			
		}else{
			echo json_encode(array('stute'=>false,'code'=>3,'msg'=>'当前科室下的疾病不存在','data'=>null));
			
		}
		
	}
	
	
	
}
new Diseases();