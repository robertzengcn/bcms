<?php
require_once '../InterfaceAbstract.php';
class Order extends InterfaceAbstract {
	
	public function __construct(){
		parent::__construct(true);
	}
	
	public function _begin() {
	    if( isset( $_REQUEST['method'] ) && method_exists( $this ,  '__'.trim( strtolower( $_REQUEST['method'] ) ) ) ) {
	        $method = '__'.trim( strtolower( $_REQUEST['method'] ) );
	        $this->$method();
	    }else{
	        $this->msgPut(false, '缺少method参数或method参数不正确', null, 1);
	    }
	}
	
/**
 * 获取抽奖和订单结果
 * */
	protected function __getorder(){
		
		if(isset($_REQUEST['querynum'])&&strlen($_REQUEST['querynum'])>0){
			$querynum=$_REQUEST['querynum'];
						$orderser=new CommodityOrderService();
						$arr=array('orders'=>$querynum);
						$result=$orderser->getOrderDetailByOrder($arr);
						echo json_encode($result);
			
		}else{
		    $this->msgPut(false, '缺少参数query num', null, 1);
		}				
	}
	/**
	 * 修改订单为已提取
	 * */
	protected function __orderhaspay(){
		if(!isset($_REQUEST['order_num'])||!isset($_REQUEST['qrcode'])){
			$this->msgPut(false, '缺少订单参数', null, 16);
		}
		$arr=array('orders'=>$_REQUEST['order_num'],'qrcode'=>$_REQUEST['qrcode']);
		//$orderser=new OrderService();
		$orderser=new CommodityLogService();
		$result=$orderser->makeorderhaspay($arr);
		echo json_encode($result);
	}
	/**
	 * 扫描获取单个中奖详情
	 * 
	 * */
	protected function __sweepdrawinfo(){
		if(!isset($_REQUEST['flag'])){
			$this->msgPut(false, '缺少参数flag', null, 16);
		}
		$arr=array('flag'=>$_REQUEST['flag'],'type'=>2);
		$dls=new DrawWinlogService();
		$result=$dls->getWinnersInfo($arr);
		echo json_encode($result);
	}
	/**
	 * 设置奖品为已领取状态
	 * 
	 * */
	protected function __makeprizestatus(){		
		if(isset($_REQUEST['flag'])&&strlen($_REQUEST['flag'])>0){
			$flag=$_REQUEST['flag'];
			$arr=array('flag'=>$flag);
			$dls=new DrawWinlogService();
			$result=$dls->makePrizeStatus($arr);
			echo json_encode($result);
			
		}else{
			$this->msgPut(false, '缺少参数query', null, 1);
		}				
	}	
	
	
}
new Order();