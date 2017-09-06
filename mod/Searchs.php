<?php

/*
 * 站内搜索模块
 * */
if (!defined('Boyiweb')) {
	die('Illegal Access');
}

//ini_set("display_errors", true);
include_once ABSPATH.'/mod/Mod.php';

class Searchs extends Mod{
	
	public function __construct() {
		
		parent::__construct();
		$this->excute();
	}
	
	/**
	 *搜索页
	 */
	public function index() {
		if(!isset($_REQUEST['keyword'])||strlen($_REQUEST['keyword'])<1){
			$this->msgPut(false,1,'缺少关键词',null);
		}
		
		$keyword = $_REQUEST['keyword'];
		$ser = new SearchService();
		$result = $ser->query($keyword);
		$str = '';
		foreach($result as $v){
			$str .= '<li><a target="_blank" href="'.$v->urls.'">'.$v->subject.'</a></li>';
		}
		$count = count($result);
		
		$sers = '"'.$keyword.'"的搜索结果：'.$count.'条。'; 
		$this->smarty->assign('html',$str);
		$this->smarty->assign('keys',$sers);
		$this->smarty->display( 'search/search'.SUBFIX);
	}
	
	public function ajaxquery(){//ajax返回搜索结果
	
		if(isset($_REQUEST['keyword'])&&strlen($_REQUEST['keyword'])>0){
			$keyword = $_REQUEST['keyword'];
			$ser = new SearchService();
			
			$result = $ser->query($keyword);
			
			$count = count($result);
			if($result){
			echo json_encode(array('stute'=>true,'code'=>0,'msg'=>null,'data'=>$result,'pages'=>$count));
			exit();
			}else{
				echo json_encode(array('stute'=>false,'code'=>0,'msg'=>'没有找到相关数据','data'=>null,'pages'=>$count));
				exit();
			}
		}else{
			echo json_encode(array('stute'=>false,'code'=>0,'msg'=>'缺少keyword','data'=>null));
			exit();
		}

    }
    

	
	
}
new Searchs();