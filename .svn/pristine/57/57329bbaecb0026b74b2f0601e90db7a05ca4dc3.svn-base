<?php

/*
 * 站内搜索模块
 * */
if (!defined('Boyiweb')) {
	die('Illegal Access');
}
//ini_set("display_errors", true);
include_once ABSPATH.'/mod/Mod.php';

class Askss extends Mod{
	
	public function __construct() {
		
		parent::__construct();
		$this->excute();
	}
	
	/**
	 *我的提问
	 */
	public function index() {
		$this->smarty->display( 'ask/myask'.SUBFIX);
	}

    
    public function querya(){
    	$ser = new AskService();
    	$_REQUEST['page']=(empty($_REQUEST['page']))?'1':$_REQUEST['page'];
    	$_REQUEST['size'] = 18;    	
    	$resulta = $ser->query($_REQUEST);
    	
    	foreach ($resulta->data as $key => $value) {
    		$value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
    		if ($value->isanswer == 1) {
    			$value->answertime = date('Y-m-d H:i:s', $value->answertime);
    		}
    	}
    	$count = $_REQUEST['size'];
    	unset($_REQUEST['page']);
    	unset($_REQUEST['size']);
    	$ttla = $ser->totalRows($_REQUEST);
    	$countpage=ceil($ttla->data/$count);
    	echo json_encode(array(
    			'rows' => $resulta->data,
    			'pages' => $countpage
    	));
    }

	public function queryb(){
	    	$ser = new AskService();
	    	$_REQUEST['isanswer'] = 1;
	    	$_REQUEST['page']=(empty($_REQUEST['page']))?'1':$_REQUEST['page'];
	    	$_REQUEST['size'] = 18;
	    	$resulta = $ser->query($_REQUEST);
	    	foreach ($resulta->data as $key => $value) {
	    		$value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
	    		if ($value->isanswer == 1) {
	    			$value->answertime = date('Y-m-d H:i:s', $value->answertime);
	    		}
	    	}
	    	$count = $_REQUEST['size'];
	    	unset($_REQUEST['page']);
	    	unset($_REQUEST['size']);
	    	$ttla = $ser->totalRows($_REQUEST);
	    	$countpage=ceil($ttla->data/$count);
	    	echo json_encode(array(
	    			'rows' => $resulta->data,
	    			'pages' => $countpage
	    	));
	    }
    
     public function queryc(){
    	$ser = new AskService();
    	$_REQUEST['isanswer'] = 0;
    	$_REQUEST['page']=(empty($_REQUEST['page']))?'1':$_REQUEST['page'];
    	$_REQUEST['size'] = 18;
    	$resulta = $ser->query($_REQUEST);
    	foreach ($resulta->data as $key => $value) {
    		$value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
    		if ($value->isanswer == 1) {
    			$value->answertime = date('Y-m-d H:i:s', $value->answertime);
    		}
    	}
    	$count = $_REQUEST['size'];
    	unset($_REQUEST['page']);
    	unset($_REQUEST['size']);
    	$ttla = $ser->totalRows($_REQUEST);
    	$countpage=ceil($ttla->data/$count);
    	echo json_encode(array(
    			'rows' => $resulta->data,
    			'pages' => $countpage
    	));
    }
	
    public function save(){//医患交流，提交问题
    	session_start();
    	if (isset($_SESSION['user']) && $_SESSION['user']) {
    		$_REQUEST['userID'] = $_SESSION['member_id'];
    		$_REQUEST['name'] = $_SESSION['user'];
    		
    		$ask = new Ask();
    		$askDesc = new AskDesc();
    		$askAssay = new AskAssay();
    		foreach ($ask as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$ask->$key = $_REQUEST[$key];
    			}
    		}
    	    foreach ($askDesc as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$askDesc->$key = $_REQUEST[$key];
    			}
    		}
    		foreach ($askAssay as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$askAssay->$key = $_REQUEST[$key];
    			}
    		}
    		$ser = new AskService();
    		$array = $ser->save($ask, $askDesc, $askAssay);
    	}else{
    		$array = array('statu'=>'unlogin','msg'=>null,'code'=>null,'data'=>null);
    	}
    	echo json_encode($array);
    }
    
    public function saves(){
    	session_start();
    	if (isset($_SESSION['verify']) == $_REQUEST['verify']) {
    
    		$ask = new Ask();
    		$askDesc = new AskDesc();
    		$askAssay = new AskAssay();
    		foreach ($ask as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$ask->$key = $_REQUEST[$key];
    			}
    		}
    		foreach ($askDesc as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$askDesc->$key = $_REQUEST[$key];
    			}
    		}
    		foreach ($askAssay as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$askAssay->$key = $_REQUEST[$key];
    			}
    		}
    		$ser = new AskService();
    		$array = $ser->save($ask, $askDesc, $askAssay);
    	}else{
    		$array = array('statu'=>'error','msg'=>null,'code'=>null,'data'=>null);
    	}
    	echo json_encode($array);
    }
    
    public function myask(){
    	session_start();
    	if (isset($_SESSION['user']) && $_SESSION['user']) {
    		$_REQUEST['userID'] = $_SESSION['member_id'];
    		$_REQUEST['name'] = $_SESSION['user'];
    	
    		$ser = new AskService();
	    	$_REQUEST['page']=(empty($_REQUEST['page']))?'1':$_REQUEST['page'];
	    	$_REQUEST['size'] = 18;
	    	$resulta = $ser->query($_REQUEST);
	    	foreach ($resulta->data as $key => $value) {
	    		$value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
	    		if ($value->isanswer == 1) {
	    			$value->answertime = date('Y-m-d H:i:s', $value->answertime);
	    		}
	    	}
	    	$count = $_REQUEST['size'];
	    	unset($_REQUEST['page']);
	    	unset($_REQUEST['size']);
	    	$ttla = $ser->totalRows($_REQUEST);
	    	$countpage=ceil($ttla->data/$count);
	    	$array = array('statu'=>true,'msg'=>null,'pages'=>$countpage,'rows'=>$resulta->data);
    	}else{
    		$array = array('statu'=>'unlogin','msg'=>null,'code'=>null,'data'=>null);
    	}
    	echo json_encode($array);
    }
    
    public function askinfo(){
    	$ser = new AskTag();
    	$data = $ser->get($_REQUEST['id']);
    	$this->smarty->assign('askinfo',$data);
    	$this->smarty->display( 'ask/detail'.SUBFIX);
    }
    
    
    /*
     * 
     * 患者提问，需要登陆
     * 
     * */   
    public function askquestion(){
    	session_start();
    	if (isset($_SESSION['user']) && $_SESSION['user']) {
    		$_REQUEST['userID'] = $_SESSION['member_id'];
    		//$_SESSION['id']= $_SESSION['member_id'];
    		$_REQUEST['name'] = $_SESSION['user'];
    		
    		$ask = new Ask();
    		$askDesc = new AskDesc();
    		$askAssay = new AskAssay();
    		foreach ($ask as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$ask->$key = $_REQUEST[$key];
    			}
    		}
    		foreach ($askDesc as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$askDesc->$key = $_REQUEST[$key];
    			}
    		}
    		foreach ($askAssay as $key => $value) {
    			if (isset($_REQUEST[$key])) {
    				$askAssay->$key = $_REQUEST[$key];
    			}
    		}
    		$ser = new AskService();
    		$array = $ser->save($ask, $askDesc, $askAssay);
    		
    		echo json_encode($array);
    	}else{
    		echo json_encode(array('statu'=>false,'code'=>1,'msg'=>'用户未登陆','data'=>null));
    	}
    }
    
    /*
     * 获取登录后的用户问题列表
     * 
     * */
    public function questionlist(){
    	session_start();
    	if(isset($_SESSION['member_id'])&&$_SESSION['member_id']){
    		$askser=new AskService();
    		if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
    			$list=$askser->query(array('user_id'=>$_SESSION['member_id'],'page'=>(int)$_REQUEST['page'],'size'=>(int)$_REQUEST['size']));
    		}else{
    			$list=$askser->query(array('user_id'=>$_SESSION['member_id']));
    		}
    		//$list=$askser->query(array('user_id'=>$_SESSION['member_id']));
    		if(!empty($list->data)){
    			foreach($list->data as $key=>$value){
    				$value->asktime=date('Y-m-d H:i',$value->plushtime);
    			}
    		}
				if(isset($_REQUEST['curr'])&&strlen($_REQUEST['curr'])>0){
					$page=(int)$_REQUEST['curr'];
				}else{
					$page=1;
				}
				$totals = $askser->totalRows(array('user_id'=>$_SESSION['member_id']));
				if(isset($_REQUEST['size'])&&strlen($_REQUEST['size'])>0){
					$count=$_REQUEST['size'];
				}else{
					$count=1;
				}
				
				$ttl = $totals->data;
				$countpage=ceil($ttl/$count); #计算总页面数
				
    		echo json_encode(array('statu'=>true,'code'=>0,'msg'=>null,'data'=>$list->data,'curr' => $page,'pages' => $countpage));
    		
    		
    	}else{
    		echo json_encode(array('statu'=>false,'code'=>1,'msg'=>'用户未登陆','data'=>null));
    	}
    }
    
    /*
     * 获取已回答的问题列表
    *
    * */
    public function questionanswer(){
    	session_start();
    	if(isset($_SESSION['member_id'])&&$_SESSION['member_id']){
    		$askser=new AskService();
    		if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
    		$list=$askser->query(array('user_id'=>$_SESSION['member_id'],'isanswer'=>1,'page'=>(int)$_REQUEST['page'],'size'=>(int)$_REQUEST['size']));
    		}else{
    			$list=$askser->query(array('user_id'=>$_SESSION['member_id'],'isanswer'=>1));
    		}
    		
    		if(!empty($list->data)){
    			foreach($list->data as $key=>$value){
    				$value->asktime=date('Y-m-d H:i',$value->plushtime);
    			}
    		}
    		if(isset($_REQUEST['curr'])&&strlen($_REQUEST['curr'])>0){
    			$page=(int)$_REQUEST['curr'];
    		}else{
    			$page=1;
    		}
    		$totals = $askser->totalRows(array('user_id'=>$_SESSION['member_id'],'isanswer'=>1));
    		if(isset($_REQUEST['size'])&&strlen($_REQUEST['size'])>0){
    			$count=$_REQUEST['size'];
    		}else{
    			$count=1;
    		}
    		
    		$ttl = $totals->data;
    		$countpage=ceil($ttl/$count); #计算总页面数
    		//echo json_encode($list);
    		echo json_encode(array('statu'=>true,'code'=>0,'msg'=>null,'data'=>$list->data,'curr' => $page,'pages' => $countpage));
    
    
    	}else{
    		echo json_encode(array('statu'=>false,'code'=>1,'msg'=>'用户未登陆','data'=>null));
    	}
    }
    
    /*
     * 获取未回答的问题列表
    *
    * */
    public function questionnoanswer(){
    	session_start();
    	if(isset($_SESSION['member_id'])&&$_SESSION['member_id']){
    		
    		$askser=new AskService();
if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
	$list=$askser->query(array('user_id'=>$_SESSION['member_id'],'isanswer'=>0,'page'=>(int)$_REQUEST['page'],'size'=>(int)$_REQUEST['size']));
}else{
	$list=$askser->query(array('user_id'=>$_SESSION['member_id'],'isanswer'=>0));
}
    	
    		if(!empty($list->data)){
    			foreach($list->data as $key=>$value){
    				$value->asktime=date('Y-m-d H:i',$value->plushtime);
    			}
    		}
    		if(isset($_REQUEST['curr'])&&strlen($_REQUEST['curr'])>0){
    			$page=(int)$_REQUEST['curr'];
    		}else{
    			$page=1;
    		}
    		$totals = $askser->totalRows(array('user_id'=>$_SESSION['member_id'],'isanswer'=>0));
    		if(isset($_REQUEST['size'])&&strlen($_REQUEST['size'])>0){
    			$count=$_REQUEST['size'];
    		}else{
    			$count=1;
    		}
    		
    		$ttl = $totals->data;
    		$countpage=ceil($ttl/$count); #计算总页面数
    		
    		echo json_encode(array('statu'=>true,'code'=>0,'msg'=>null,'data'=>$list->data,'curr' => $page,'pages' => $countpage));
           
    	}else{
    		echo json_encode(array('statu'=>false,'code'=>1,'msg'=>'用户未登陆','data'=>null));
    	}
    }
    
}
new Askss();