<?php

/*
 * 站内搜索模块
 * */
if (!defined('Boyiweb')) {
	die('Illegal Access');
}

//ini_set("display_errors", true);
include_once ABSPATH.'/mod/Mod.php';

class Articles extends Mod{
	
	public function __construct() {
		
		parent::__construct();
		$this->excute();
	}
		
public function getbydepid(){
	
if(isset($_REQUEST['department_id'])&&strlen($_REQUEST['department_id'])>0){
	$depid=(int)$_REQUEST['department_id'];
	$articleser=new ArticleService();
if(isset($_REQUEST['disease_id'])&&strlen($_REQUEST['disease_id'])>0){
	if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
		$list=$articleser->query(array('department_id'=>$depid,'disease_id'=>$_REQUEST['disease_id'],'page'=>(int)$_REQUEST['page'],'size'=>(int)$_REQUEST['size']));
	
	}else{
		$list=$articleser->query(array('department_id'=>$depid));
	}

}else{
if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
	$list=$articleser->query(array('department_id'=>$depid,'page'=>(int)$_REQUEST['page'],'size'=>(int)$_REQUEST['size']));
	
}else{
	$list=$articleser->query(array('department_id'=>$depid));
}
}
if(isset($_REQUEST['size'])&&strlen($_REQUEST['size'])>0){
	$count=(int)$_REQUEST['size'];
}else{
	$count=1;
}
if(isset($_REQUEST['disease_id'])&&strlen($_REQUEST['disease_id'])>0){
$ttl=$articleser->totalRows(array('department_id'=>$depid,'disease_id'=>$_REQUEST['disease_id']));

}else{
	$ttl=$articleser->totalRows(array('department_id'=>$depid));	
}
if($ttl->data){
	
	$countpage=ceil($ttl->data/$count); #计算总页面数	
}else{
	$countpage=1;
}


if(!empty($list->data)){
	foreach($list->data as $k=>$v){
		$v->articletime=date('Y-m-d',$v->plushtime);
	}
	
	echo json_encode(array('stute'=>true,'code'=>0,'msg'=>null,'data'=>$list->data,'pages'=>$countpage));
	exit();
	
}else{
	echo json_encode(array('stute'=>false,'code'=>2,'msg'=>'当前没有文章','data'=>null));
	exit();
}
	
}else{
	echo json_encode(array('stute'=>false,'code'=>1,'msg'=>'缺少department_id','data'=>0));
	exit();
}
    }

	
	
}
new Articles();