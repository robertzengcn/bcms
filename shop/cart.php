<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医院动态
 * @author Administrator
 *
 */
class cartShop extends Shop {
	
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
	 * 医院新闻动态列表
	 */
	public function query() {
		
		
		$param=array('member_id'=>$_SESSION['member_id']);
		
	
		$list = $this->getServiceMethod('CommodityCart','query',$param);
	
		
		//$categories_id=isset($_REQUEST['categories_id'])?(int)$_REQUEST['categories_id']:"";
		$this->smarty->assign('list',$list->data);
// 		$this->pageSetting( 10 ,'commodity','commodity');//分页式列表		
// 		$seo = $this->getServiceMethod('Seo','query',array("flag" => "news"));
// 		$this->smarty->assign('seo',$seo->data[0]);
		$this->smarty->display( 'Cart/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 医院动态详情
	 */
	public function get() {
		//取推荐阅读
		//$this->getRecommend('news','news','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'commodity' , 'commodity' , 'subject' );
		$this->smarty->assign( 'data' , $this->result->data );
		$this->smarty->display( 'Commodity/detail' . TPLSUFFIX );
	}
	
	/*
	 * 获取用户积分数据
	 * */
	public function getscore(){
		$param=array('id'=>$_SESSION['member_id']);
		$list = $this->getServiceMethod('member','getscore',$param);
		$arr=array('stute'=>true, 'id'=>$_SESSION['member_id'],'score'=>$list['ownscore']);
		echo json_encode($arr);
		
	}
	
	/**
	 * 添加购物车
	 * */
	public function addcart(){		
		$commodityid=(int)$_REQUEST['commodity_id'];
		if(isset($quantity)&&$_REQUEST['quantity']!=null){
			$quantity=(int)$_REQUEST['quantity'];
		}else{
			$quantity=1;
		}
		$param=array('commodity_id'=>$commodityid,'member_id'=>$_SESSION['member_id'],'quantity'=>$_REQUEST['quantity']);
			
		$data = $this->getServiceMethod('CommodityCart','addcart',$param);
		echo json_encode($data);
		
	}
	
	/**
	 * 完成结算
	 * 
	 * */
	public function checkout(){
// 		$commodityid=(int)$_REQUEST['commodity_id'];
$this->addcart();
$this->query();						
	}
	
	
	/**
	 * 从购物车中删除商品
	 * */
	
	public function delete(){
		$cartid=(int)$_REQUEST['cart_id'];
		$param=array('id'=>$cartid,'member_id'=>$_SESSION['member_id']);
		$data = $this->getServiceMethod('CommodityCart','deletecartcommodity',$param);
		echo json_encode($data);
	}
	
	public function itemquantity(){
	
		$cartid=(int)$_REQUEST['cart_id'];
		$quantity=(int)$_REQUEST['quantity'];
		$cartarr=array('id'=>$cartid,'member_id'=>$_SESSION['member_id']);
		$cartdetail=$this->getServiceMethod('CommodityCart','getmebercart',$cartarr);
		if(!empty($cartdetail->data)){
			
		if($cartdetail->data['quantity']!=$quantity){
			$num=$cartdetail->data['quantity']-$quantity;	
			if($num<0){
				echo json_encode(array('stute'=>false,'code'=>1,'msg'=>'库存不足。。。','data'=>$quantity));
				exit();
			}			
			$commodityarr=array('commodity_id'=>$cartdetail->data['commodity_id'],'quantity'=>$num);
			$this->getServiceMethod('commodity','updatequantity',$commodityarr);
		}
			
		
		$param=array('id'=>$cartid,'member_id'=>$_SESSION['member_id'],'quantity'=>$quantity);
		
		
		$result=$this->getServiceMethod('CommodityCart','updateitemquantity',$param);
		echo json_encode(array('stute'=>true,'code'=>0,'msg'=>null,'data'=>$quantity));
		
		}else{
			echo json_encode(array('stute'=>false,'code'=>1,'msg'=>'购物车不存在','data'=>$cartdetail->data['quantity']));
		}
		
	}
	
	
}

new cartShop();
?>