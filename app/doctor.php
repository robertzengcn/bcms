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
		$param = array();
		//$param['show_position'] = $this->getShowPositionStr(PROJECT_NAME); //获取特定显示数据
		if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
			$param['department_id'] = (int)$_REQUEST['department_id'];
			$dep = (int)$_REQUEST['department_id'];
			$totalnum = $this->getServiceMethod('Doctor','totalRows',array('department_id'=>(int)$_REQUEST['department_id']));
		}else{
			$dep = 0;
			$totalnum = $this->getServiceMethod('Doctor','totalRows',array());
		}
		$param['size']=3;//设置每页显示多少个
		if(isset($_REQUEST['page'])&&$_REQUEST['page']){
			$param['page']=(int)$_REQUEST['page'];
		}else{
			$param['page']=1;
		}
		
		$list = $this->getServiceMethod('Doctor','query',$param);
		
		$pageCount=ceil($totalnum->data/$param['size']);//总共多少页
		
		$this->smarty->assign( 'url' , 'doctor');
		$this->smarty->assign( 'list' , $list->data);
		$this->smarty->assign( 'page' , $param['page']);
		$this->smarty->assign( 'pageCount' , $pageCount);
		$this->smarty->assign( 'dep_id' , $dep);
		//$this->smarty->assign( 'list' , $this->result['rows']);
		$this->smarty->display( 'Doctor/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 医生详情
	 */
	public function get() {
		//取医生详情
		$this->smarty->assign( 'data' , $this->result->data );
		//取推荐阅读
		$this->getRecommend('doctor','doctor','name');
		//注入上一条与下一条
		$this->getNextAndLast('doctor','doctor','name');
		$this->smarty->display( 'Doctor/detail' . TPLSUFFIX );
	}
	
}

new doctorMobile();
?>