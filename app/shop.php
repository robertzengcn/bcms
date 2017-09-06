<?php
//载入入口文件
include_once 'init.php';
/**
 * 
 * 积分商城
 * @author Administrator
 *
 */
class ShopMobile extends Mobile {
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
	 * 获取我的订单
	 * */	
	public function getorderjson(){
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
		if(isset($_REQUEST['order_stute'])&&strlen($_REQUEST['order_stute'])>0){
			if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
				$param=array('uid'=>$_SESSION['member_id'],'page'=>$page,'size'=>$size,'order_stute'=>$_REQUEST['order_stute'],'orders'=>$order);
			}else{
				$param=array('uid'=>$_SESSION['member_id'],'order_stute'=>$_REQUEST['order_stute'],'orders'=>$order);
			}
		}else{
			if(isset($_REQUEST['page'])&&isset($_REQUEST['size'])){
				$param=array('uid'=>$_SESSION['member_id'],'page'=>$page,'size'=>$size,'orders'=>$order);
			}else{
				$param=array('uid'=>$_SESSION['member_id'],'orders'=>$order);
			}
		}	
			$list = $this->getServiceMethod('CommodityOrder','getOrderList',$param);
		echo json_encode($list);
		
	}

		/*
		 * 获取单个订单详情
		* $param $_Request['order_id'];
		* 返回json格式数据
		* */
		public function getorderdetailjson(){
		
			if(isset($_REQUEST['order_id'])&&strlen($_REQUEST['order_id'])>0){
				$order_id=(int)$_REQUEST['order_id'];
			}else{
				echo json_encode(array('statu'=>false, 'code'=>115,'msg'=>'订单id不存在','data'=>null));
				exit();
			}
				$param=array('id'=>$order_id,'uid'=>$_SESSION['member_id']);
			$detail = $this->getServiceMethod('CommodityOrder','getOrderDetail',$param);			
			echo json_encode($detail);			
		}
		
}
new ShopMobile();
?>