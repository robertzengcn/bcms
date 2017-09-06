<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 专家团队(医生)
 * @author Administrator
 *
 */
class doctorMobile extends Mobile {
	
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
	 * 专家医生团队列出
	 */
	public function query() {
		$limit=3;//设置每页显示多少个
		if(isset($_REQUEST['page'])&&$_REQUEST['page']){
			$page=(int)$_REQUEST['page'];

		}else{
			$page=1;
			
		}

		
		$list = $this->getServiceMethod('Doctor','query',array("page" => $page,"size"=>$limit));
		$totalnum = $this->getServiceMethod('Doctor','totalRows',array());
		
		$pageCount=ceil($totalnum->data/$limit);//总共多少页
	
		$this->smarty->assign( 'url' , 'doctor');
		$this->smarty->assign( 'list' , $list->data);
		$this->smarty->assign( 'page' , $page);
		$this->smarty->assign( 'pageCount' , $pageCount);		
		$seo = $this->getServiceMethod('Seo','query',array("flag" => "doctor"));
		if(!empty($seo->data)){
		$this->smarty->assign('seo',$seo->data[0]);
		}
		$this->smarty->display( 'Doctor/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 医生详情
	 */
	public function get() {
		
		if(!isset($_REQUEST['id'])||strlen($_REQUEST['id'])<1){
			echo '缺少医生id参数';
			exit();
		}else{
			$doctor_id=(int)$_REQUEST['id'];
		}
		
		
		$result=$this->getServiceMethod('Doctor','getdoctorbyid',$doctor_id);
		
		
		
		$this->smarty->assign( 'data' , $result->data );
		if($result->data!=null){
			
			$dodepartment = $this->getServiceMethod('Department','getdepbyarr',array('id'=>$result->data->department_id));
	if($dodepartment->data){
		$this->smarty->assign( 'doctortodep' , $dodepartment->data->name);
	}
		}
		
		//取推荐阅读
		$this->getRecommend('doctor','doctor','name');
		//注入上一条与下一条
		$this->getNextAndLast('doctor','doctor','name');
		$this->smarty->display( 'Doctor/detail' . TPLSUFFIX );
	}
	
}

new doctorMobile();
?>