<meta charset="utf-8">
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
		}
		if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
			$param['department_id'] = (int)$_REQUEST['department_id'];
		}
		$list = $this->getServiceMethod('article','query',$param);
		$this->result['data']  = $list->data;
		$this->result['ttl']   = count($list->data);
		$this->smarty->assign('departmentId',$_REQUEST['department_id']);
		$this->smarty->assign('diseaseId',$_REQUEST['disease_id']);
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
    	$this->smarty->assign('departmentId',(int)$_REQUEST['department_id']);
    	$this->smarty->assign('diseaseId',(int)$_REQUEST['disease_id']);
    	$this->smarty->assign('id',(int)$_REQUEST['id']);
        $this->smarty->display( 'Department/detail' . TPLSUFFIX );
    }
}
new departmentMobile();

?>