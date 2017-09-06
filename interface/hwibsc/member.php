<?php
/**
 * 
 * cms用户登录接口
 * @author Administrator
 * @version v1.0
 * @example 该接口在进行预约后,由总控中心发起预约接口
 */
require_once '../InterfaceAbstract.php';
class MemberHwibsc extends InterfaceAbstract {
	
	public $posts = array();
	

	
	private $params = array(
		'domain'      	   => array('check'=>true,'info'=>'通信域名'),
		'sign'        	   => array('check'=>true,'info'=>'通信加密字符串'),//false要修改
		'time'        	   => array('check'=>true,'info'=>'通信加密时间戳'),//false要修改
		'username' 	       => array('check'=>true,'info'=>'用户名'),
		'telephone' 	       => array('check'=>false,'info'=>'电话号码'),
		'method' 	       => array('check'=>false,'info'=>'执行方法'),
	);
	
	//构造函数
	public function __construct() {
		parent::__construct();
	}
	
	public function _begin()
	{
	    $this->voluation();
	    
	    //这里暂时注释，上线时开启
	    $this->queryRes();
	} 
	
	//查询time_id值是否正确
	private function queryRes() {
		switch($this->posts['method']){
			case '':
			$this->scorerule();
			break;
			case 'register':
			$this->registermember();
			break;	
			default:
			$this->scorerule();
		}		
		
		$this->msgPut(true, '登记成功!' , null);
	}
	
	private function scorerule(){
		$memberser=new MemberService();	
		$memberarr=array('username'=>$this->posts['username']);
		$memberarray=$memberser->getmembyname($memberarr)->data;//获取会员信息
		 
		$member=new Member();
		$member=$memberarray;		
		if(empty($memberarray->id)){//如果会员不存在则添加会员
			$newmember=array('username'=>$this->posts['username'],'telephone'=>$this->posts['telephone']);
			$mresult=$memberser->addmember2($newmember);
			$member=$mresult->data;
		
		}
		
		$memberlogser=new CommodityAddScoreLogService();//准备写入用户日志
		
		$scoreruleser=new CommodityRuleService();
		$scoarry=array('order'=>'order by id desc');
		$result=$scoreruleser->query($scoarry);//查询现有的积分规则
		
		$nows=time();
		foreach ($result->data as $key=>$val){//规则处理位置
			if($val->status != 0 && $val->id==1){//首次登陆添加积分
				$lognum=$memberlogser->countmember(array('uid'=>$member->id,'type'=>$val->id));
				if($lognum->data<1){
					$memberser->addscoretomember(array('id'=>$member->id,'score'=>$val->score));
					$logarr=array('uid'=>$member->id,'date'=>$nows,'type'=>$val->id,'score'=>$val->score,'ip'=>$this->getIp());//保存用户登录信息,写入日子好
					$memberlogser->savelog($logarr);
				}
		
			}
			if($val->status != 0 && $val->id==2){//完善个人资料				
				$num=$memberlogser->perfectmember(array('uid'=>$member->id,'type'=>$val->id));//获取用户今日获得的积分数
				if($num<1 && $newmember['username'] && $newmember['telephone']){
					$memberser->addscoretomember(array('id'=>$member->id,'score'=>$val->score));
					$logarr=array('uid'=>$member->id,'date'=>$nows,'type'=>$val->id,'score'=>$val->score,'ip'=>$this->getIp());//保存用户登录信息,写入日子好
					$memberlogser->savelog($logarr);
				}
			}
			if($val->id==4){//每日登陆添加积分	
				$num=$memberlogser->summember(array('uid'=>$member->id,'type'=>$val->id));//获取用户今日获得的积分数
				$score = ($val->status != 0) ? $val->score : 0 ;
				if($num->data->total<$val->limit){//如果没有超过该用户每日登录上限则执行操作
					$memberser->addscoretomember(array('id'=>$member->id,'score'=>$score));
				}
				$logarr=array('uid'=>$member->id,'date'=>$nows,'type'=>$val->id,'score'=>$score,'ip'=>$this->getIp());//保存用户登录信息,写入日子好
				$memberlogser->savelog($logarr);
			}
			if($val->status != 0 && $val->id==5){//7天连续登陆
				$yestdaynum=$memberlogser->continuousLogging(array('uid'=>$member->id,'type'=>$val->id,'num'=>$val->limit));
				if($yestdaynum){//如果昨天有登陆,并且用户今天获取的积分数没有达到限制则执行操作						
					$memberser->addscoretomember(array('id'=>$member->id,'score'=>$val->score));
					$logarr=array('uid'=>$member->id,'date'=>$nows,'type'=>$val->id,'score'=>$val->score,'ip'=>$this->getIp());//保存用户登录信息,写入日子好
					$memberlogser->savelog($logarr);
						
				}		
			}
				
		}
	}
	

	
	private function voluation() {

		
		foreach ( $this->params as $key => $value ) {
			if( isset( $_REQUEST[$key] ) && $_REQUEST[$key] != '' ) {
				$this->posts[$key] = trim( $_REQUEST[$key] );
			}else{
				if( $value['check'] === true ) {
					$this->msgPut(0, '参数缺失：'.$value['info'].':'.$key, null);
				}else{
					$this->posts[$key] = '';
				}
			}
		}
	}
	
	private function registermember(){
		
		$memberser=new MemberService();
		$arr=array('username'=>$this->posts['username']);
		$memberser->addmember($arr);
	}
	/*
	 * 获取用户的ip地址
	* */
	protected function getIp(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			return $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORVARDED_FOR'])){
			return $_SERVER['HTTP_X_FORVARDED_FOR'];
		}elseif(!empty($_SERVER['REMOTE_ADDR'])){
			return $_SERVER['REMOTE_ADDR'];
		}else{
			return '未知IP';
		}
	}
	
}
new MemberHwibsc();