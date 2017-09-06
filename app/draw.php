<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院动态
 * @author Administrator
 *
 */
class drawMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		$this->getuser();
		if(!isset($_SESSION['member_id'])){	
			echo json_encode(array('statu'=>false,'code'=>15,'msg'=>'请重新登录','data'=>''));
			exit();			
        }
		$this->excute();
	}
	
	
	/*
	 * 获取我的幸运中奖列表
	 * */
	
	public function getwinnerslist(){
		if(isset($_REQUEST['page'])&&strlen($_REQUEST['page'])>0){
			$page=(int)$_REQUEST['page'];
		}
		if(isset($_REQUEST['size'])&&strlen($_REQUEST['size'])>0){
			$size=(int)$_REQUEST['size'];
		}
		if(isset($_REQUEST['order'])&&strlen($_REQUEST['order'])>0){
			$order=$_REQUEST['order'];
		}else{
			$order='';
		}
		if(isset($_REQUEST['statue'])&&strlen($_REQUEST['statue'])>0){
			if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
				$param=array('member_id'=>$_SESSION['member_id'],'page'=>$page,'size'=>$size,'statue'=>$_REQUEST['statue'],'order'=>$order);
			}else{
				$param=array('member_id'=>$_SESSION['member_id'],'statue'=>$_REQUEST['statue'],'order'=>$order);
			}
		}else{
			if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
				$param=array('member_id'=>$_SESSION['member_id'],'page'=>$page,'size'=>$size,'order'=>$order);
			}else{
				$param=array('member_id'=>$_SESSION['member_id'],'order'=>$order);
			}
		}	
		$list = $this->getServiceMethod('DrawWinlog','getWinnersList',$param);	
		echo json_encode($list);
		
	}
	

	
	/*
	 * 获取单个中奖详情
	 * 
	 * */
	
	public function getwinnersinfo(){
		if(isset($_REQUEST['win_id'])&&strlen($_REQUEST['win_id'])>0){
			$win_id=(int)$_REQUEST['win_id'];
		}else{
			echo json_encode(array('statu'=>false, 'code'=>115,'msg'=>'中奖id不存在','data'=>null));
			exit();
		}		
		$param=array('id'=>$win_id,'member_id'=>$_SESSION['member_id'],'type'=>1);
		$detail = $this->getServiceMethod('DrawWinlog','getWinnersInfo',$param);
		echo json_encode($detail);		
	}

	
	
}

new drawMobile();
?>