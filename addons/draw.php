<?php

include_once 'addons.php';
/**
 * 
 * 
 * @author Administrator
 *
 */
class DrawAddons extends Addons {

	private $module  = 'addons';	//模块名称
	private $initlogin;	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		//if((isset($_GET['type']) && $_GET['type'] =='weixin') || empty($_GET['token'])){
		if(isset($_GET['type']) && $_GET['type'] =='weixin'){
			$this->initlogin();
		}else{
			$this->getuser();	
		}
		$this->excute();
	}
	public function getuserid(){
		if(!$_SESSION['member_id']){
			$this->error("用户未登陆...");			
		}
	}
	 public function initlogin(){					
		$this->initlogin = $this->_getcookie('INIT_LOGIN');	
		if($this->initlogin){
			$arr = unserialize($this->initlogin);
			$where= array('user_id'=>$arr['user_id'],'remember_key'=>$arr['remember_key'],'lose_time'=>time());			
			$isout  = $this->getServiceMethod('CommodityKey','isLose',$where);			
			if($isout){
				session_start();
				$_SESSION['member_id']=	$arr['user_id'];
			}else{
				$this->logout();				
			}
		}else{
			$this->login();
		}
	 }
	//注销
		 public function logout(){
	 		$this->_setcookie('INIT_LOGIN',NULL);
			unset($_SESSION['member_id']);
			unset($_SESSION['user']);
			$this->login();			
		 }
		 
	public function login(){
			$url = NETADDRESS . '/'.$this->module.'/dlogin.php?method=login';
			header("Location:".$url); 
			exit;
	}
	/**
	 * 
	 * 医院新闻动态列表
	 */
	public function query() {
		if($_SESSION['member_id']){
				$datetime=time();
		$result=$this->getServiceMethod('Draw','getdrawcount',array('statu' => 1,'datetime'=>$datetime));//根据活动id，取活动奖品

		$activity=array();
		foreach ($result->data as $key =>$val){
			$activity[$key]['name']=$val->name;
			$activity[$key]['start_time']=$val->start_time;
			$activity[$key]['end_time']=$val->end_time;
			$activity[$key]['link']=NETADDRESS.'/'.$this->module.'/draw.php?method=get&drawid='.$val->id;
			$activity[$key]['pic']=UPLOAD . $val->pic;	
		}
		echo json_encode(array('statu'=>true,'msg'=>null,'code'=>0,'data'=>$activity));
		}else{
			$this->error("呣，未找到相关活动...");				
		}
	}
	/**
	 * 
	 * 活动列表
	 */
	public function index() {
		$this->initlogin = $this->_getcookie('INIT_LOGIN');	
		if($this->initlogin){
			$nav = array('drawlist'=>'我的奖品','logout'=>'注销');
		}else{
			$nav = array('drawlist'=>'我的奖品');			
		}
		$datetime=time();
		$result=$this->getServiceMethod('Draw','getdrawcount',array('statu' => 1,'datetime'=>$datetime));//根据活动id，取活动奖品	
		$activity=array();
		foreach ($result->data as $key =>$val){
		$activity[$key]['name']=$val->name;
		$activity[$key]['start_time']=$val->start_time;
		$activity[$key]['end_time']=$val->end_time;
		$activity[$key]['link']=NETADDRESS.'/'.$this->module.'/draw.php?method=get&drawid='.$val->id;
		$activity[$key]['pic']=UPLOAD . $val->pic;			
		}
		$this->smarty->assign('drawnav', $nav);
		$this->smarty->assign('activity', $activity);
		$this->smarty->display( 'Draw/index' . TPLSUFFIX );		
	}	
	
	/**
	 *
	 *活动抽奖逻辑
	 *
	 *@param $id 活动id
	 **/
	
	public function drawprize($id){		
		if($id==''){
			$this->error("呣，未找到相关活动...");			
		}
		$prizeall=$this->getServiceMethod('DrawPrize','getprizedraw',array("drawid" =>$id));

		$prize_arr = array();
		$arr = array();
		$count = count($prizeall->data);
		if($count==0){
			echo json_encode(array('statu'=>false, 'code'=>2,'msg'=>'奖品已抽完','data'=>null));
			exit();	
		}
		$already_prize = array();
		foreach($prizeall->data as $key=>$value){
			if($value->prize_every !=0 && $value->prize_win>=$value->prize_every){
				array_push($already_prize,$value->id);	//今天已抽完的奖品
			}
			//$thank_percent += ($value->prize_percent)/100;
			$prize_arr[$key] = array('id'=>$key+1,'pid'=>$value->id,'name'=>$value->name,'v'=>($value->prize_percent)/100,'img'=>$value->img);	
		}	
		$already_prize = array_values($already_prize);	
/* 		if($thank_percent < 100){
			//计算谢谢参与概率		
			$prize_arr[$count] = array('id'=>$count+1,'pid'=>0,'name'=>'谢谢参与','v'=>100-$thank_percent);				
		} */	
		foreach ($prize_arr as  $val) { 
			$arr[$val['id']] = $val['v']; 
		}		
		$rid = $this->getRand($arr,$already_prize); //根据概率获取奖项id	
		$res = $prize_arr[$rid-1]; //中奖项
		return $res;
	}

	protected function getRand($proArr,$apArr) { 
			$result = ''; 		 
			//概率数组的总概率精度 
			$proSum = array_sum($proArr);
			//概率数组循环
		try{
			do{
				foreach ($proArr as $key => $proCur) { 
					$randNum = mt_rand(1, $proSum); 
					if ($randNum <= $proCur ) { 			
							$result = $key;	
							break;
					} else { 
						$proSum -= $proCur; 
					} 
				}				
			}while(count($apArr)>0 && in_array($result-1, $apArr)); 
			unset ($proArr); 
		}catch(Exception $e){
			$recordfile=ABSPATH.'log/draw_getRand_'.time().'_'.rand(1000,9999).'.log';
			$myfile = @fopen( $recordfile, "w");
			$txt = $e->getMessage();
			fwrite($myfile, $txt);
			fclose($myfile);
		}			
			return $result; 
	}
	
	/**
	 * 
	 * 医院动态详情
	 */
	public function get() {
		if(isset($_REQUEST['drawid'])&&strlen($_REQUEST['drawid'])!=0){
			$id=(int)$_REQUEST['drawid'];
			
		//取推荐阅读
		$result = $this->getServiceMethod('Draw','mobileget',array("id" =>$id));
		if(empty($result->data)){
			$this->error("呣，未找到相关活动...");
		}
		if($result->data->statu==0){
			$this->error("呣，活动已关闭...");
		}
		
		$thetime=time();
		if($thetime<$result->data->start_time){
			$this->error("呣，活动还未开始...");
		}
		
		if($thetime>$result->data->end_time){
			$this->error("呣，活动已经结束...");
		}
			$prizeall=$this->getServiceMethod('DrawPrize','getprizedraw',array("drawid" =>$id));
			$ruletime = date('Y-m-d' , $result->data->start_time).'一'.date('Y-m-d' , $result->data->end_time);
		if($result->data->type==1){//砸金蛋
			$this->smarty->assign('prizeall', $prizeall->data);
			$this->smarty->assign('ruletime', $ruletime);			
			$this->smarty->assign('rulecontent', $result->data->descript);		
			$this->smarty->assign('draw_id', $id);
			$this->smarty->display( 'Draw/zadan' . TPLSUFFIX );
			
		}elseif($result->data->type==2){//刮刮卡			
			$member=$this->getServiceMethod('Member','getscore',array("id" => $_SESSION['member_id']));//获取用户积分数
			$drawtime=floor($member['ownscore']/$result->data->bonus);
			$this->smarty->assign('bonus', $result->data->bonus);
			$this->smarty->assign('drawtime', $drawtime);
 			$this->smarty->assign('rulecontent', $result->data->descript);        
			$this->smarty->assign('prizeall', $prizeall->data);
			$this->smarty->assign('ruletime', $ruletime);			
			$this->smarty->assign('draw_id', $id);
			$this->smarty->display( 'Draw/guaguaka' . TPLSUFFIX );
			
		}else{//转盘
			$prizenum=count($prizeall->data);
			$color = array('#6688DF','#FFAF2F','#F46CBC','#9751F7','#F7C429','#F5647E','#F82045','#01FFC1','#90B7AA','#DA70D6','#C0C0C0','#5FCEC0','#F78585');
			$random_color=array_rand($color,$prizenum);
			$strname = '';
			$strid = '';
			$r_color = '';
			$prize_percent = 0;
			foreach ($prizeall->data as $key=>$value) {
				$strname .= '"' . $value->name . '",';	
				$strid .=$value->id . ',';
				$prize_percent +=$value->prize_percent;
			}
			if($prize_percent != 10000){
				$this->error("呣，活动奖品未设置好");			
			}
			for($i=0;$i<$prizenum;$i++){
				$r_color .='"' . $color[$random_color[$i]] . '",';
			}	
			$strname = substr($strname, 0, strlen($strname) - 1);
			$strid = substr($strid, 0, strlen($strid) - 1);
			$r_color = substr($r_color, 0, strlen($r_color) - 1);
			$this->smarty->assign('drawtime', $drawtime);
			$this->smarty->assign('prizeall', $prizeall->data);			
			$this->smarty->assign('strid', $strid);	
			$this->smarty->assign('strname', $strname);			 
			$this->smarty->assign('random_color', $r_color);
			$this->smarty->assign('rulecontent', $result->data->descript);
			$this->smarty->assign('ruletime', $ruletime);			
			$this->smarty->assign('prizenum', $prizenum);				
			$this->smarty->assign('draw_id', $id);
			$this->smarty->display( 'Draw/zhuanpan' . TPLSUFFIX );
			
		}
		//注入上一条与下一条

		}else{
			$this->error("呣，未找到相关活动...");	
		}
	}
	
	public function drawdan(){	
		//$_SESSION['member_id'] = 41;	
		//$UserName = isset($_SESSION['user'])?trim($_SESSION['user']):null;
		if(isset($_REQUEST['drawid'])&&strlen($_REQUEST['drawid'])!=0){
			$id=(int)$_REQUEST['drawid'];
		}else{
			echo json_encode(array('statu'=>false, 'code'=>2,'msg'=>'drawid不能为空','data'=>null));
			exit();
		}
		$member=$this->getServiceMethod('Member','getscore',array("id" => $_SESSION['member_id']));//获取用户积分数
		
		$result = $this->getServiceMethod('Draw','mobileget',array("id" =>$id));
		$memberdrawcount = $this->getServiceMethod('Drawlog','getdrawcount',array("member_id" =>$_SESSION['member_id'],"draw_id"=>$id));
		
		if($result->data->limit!=0&&$memberdrawcount->data>=$result->data->limit){
			echo json_encode(array('statu'=>false, 'code'=>9,'msg'=>'亲，您已达到每日抽奖限制~','data'=>null));
			exit();
		}
		if(empty($result->data)){
			echo json_encode(array('statu'=>false, 'code'=>4,'msg'=>'未找到相关活动','data'=>null));
			exit();
		}
		if($result->data->statu==0){
			echo json_encode(array('statu'=>false, 'code'=>5,'msg'=>'活动已关闭','data'=>null));
			exit();
		}
		
		$thetime=time();
		if($thetime<$result->data->start_time){
			echo json_encode(array('statu'=>false, 'code'=>2,'msg'=>'活动还未开始','data'=>null));
			exit();
		}
		
		if($thetime>$result->data->end_time){
			echo json_encode(array('statu'=>false, 'code'=>3,'msg'=>'活动已经结束','data'=>null));
			exit();
		}
		
		if($member['ownscore']<$result->data->bonus){
			echo json_encode(array('statu'=>false, 'code'=>7,'msg'=>'积分不足','data'=>null));
			exit();
		}
		
		
		try{
			
		$prizeobj=$this->drawprize($id);//抽奖逻辑位置
			$this->getServiceMethod('DrawPrize','reducecount',array("id" => $prizeobj['pid']));//奖品数量减一		
			$this->getServiceMethod('Member','reducescore',array("id" => $_SESSION['member_id'],'score'=>$result->data->bonus));//扣除用户积分		
		
		}catch(Exception $e){//如果抽奖过程中出现异常则中断改次抽奖,并且记录错误

			$recordfile=ABSPATH.'log/draw_'.time().'_'.rand(1000,9999).'.log';
			$myfile = @fopen( $recordfile, "w");
			$txt = $e->getMessage();
			fwrite($myfile, $txt);
			fclose($myfile);
			$this->error("系统异常请稍后再试...");	
		}		
		//if($prizeobj['pid']!=0){
			$resultprize=$this->getServiceMethod('DrawWinlog','writeowner',array('member_id' => $_SESSION['member_id'],'prize_id'=>$prizeobj['pid'],'draw_id'=>$id));
			$this->getServiceMethod('drawlog','adddrawlog',array("member_id" => $_SESSION['member_id'],'draw_id'=>$id,'result'=>$prizeobj['name']));//写入抽奖记录
			echo json_encode(array('statu'=>true,'msg'=>$prizeobj['name'],'img'=>$prizeobj['img'],'code'=>1,'data'=>array('id'=>$prizeobj['pid'],'zid'=>$resultprize->id,'position'=>$prizeobj['v']*10000)));
		//}else{
		//	$this->getServiceMethod('drawlog','adddrawlog',array("member_id" => $_SESSION['member_id'],'draw_id'=>$id,'result'=>'没有抽中'));//写入抽奖记录
		//	echo json_encode(array('statu'=>true,'msg'=>'谢谢惠顾','code'=>0,'data'=>0));
		//}				
		
	}
	
	/**
	 * 用户获取自己的中奖列表
	 * */
	public function drawlist(){
		$this->initlogin = $this->_getcookie('INIT_LOGIN');	
		if($this->initlogin){
			$nav = array('index'=>'抽奖活动','logout'=>'注销');
		}else{
			$nav = array('index'=>'抽奖活动');			
		}
		//$_SESSION['member_id'] = 41;	
		$size=5;

		if(isset($_REQUEST['page'])&&$_REQUEST['page']!=null){
			$page=(int)$_REQUEST['page'];
			
			$winlist=$this->getServiceMethod('DrawWinlog','query',array("member_id" =>$_SESSION['member_id'],'page'=>$page,'size'=>$size));
		}else{
			$winlist=$this->getServiceMethod('DrawWinlog','query',array("member_id" =>$_SESSION['member_id'],'page'=>1,'size'=>$size));
		}
					
		$wincount=$this->getServiceMethod('DrawWinlog','totalRows',array("member_id" =>$_SESSION['member_id']));
		//$this->pageSetting( 10 ,'draw','DrawWinlog',array("member_id" =>$_SESSION['member_id']));//分页式列表
		$this->smarty->assign('winlist', $winlist->data);
		$pagenum=ceil($wincount->data[0]->num/$size);
		
		$this->smarty->assign('drawnav', $nav);
		
		$this->smarty->assign('pagenum', $pagenum);		
	    
		$this->smarty->display( 'Draw/list' . TPLSUFFIX );
	}
	
	/**
	 * ajax返回分页信息
	 * 
	 * */
	public function ajaxdrawlist(){
		$size=5;
		if(isset($_REQUEST['page'])&&$_REQUEST['page']!=null){
			$page=(int)$_REQUEST['page'];
				
			$winlist=$this->getServiceMethod('DrawWinlog','query',array("member_id" =>$_SESSION['member_id'],'page'=>$page,'size'=>$size));
		}else{
			$winlist=$this->getServiceMethod('DrawWinlog','query',array("member_id" =>$_SESSION['member_id'],'page'=>1,'size'=>$size));
		}
		echo json_encode(array('statu'=>true,'code'=>0,'msg'=>null,'data'=>$winlist->data));
		exit();
		
		
	}
	
	/**
	 * 用户的中奖详情
	 * */
	public function getmydraw(){
		if(isset($_REQUEST['id'])&&$_REQUEST['id']!=null){
			$id=(int)$_REQUEST['id'];
			$result=$this->getServiceMethod('DrawWinlog','getmemdraw',array('member_id' =>$_SESSION['member_id'],'id'=>$id));
			
			$prize=$this->getServiceMethod('DrawPrize','getprizedetail',array('id'=>$result->data['prize_id']));
			
			$this->smarty->assign('prize', $prize->data);
			$this->smarty->assign('detail', $result->data);
									 
			$this->smarty->display('Draw/detail' . TPLSUFFIX );
		}
		
	}

	public function error($msg){
		$index = NETADDRESS . '/'. $this->module .'/draw.php?method=index';
		$this->smarty->assign('INDEX',$index);
		$this->smarty->assign('errormsg', $msg);
		$this->smarty->display('Draw/error' . TPLSUFFIX );
		exit;
	}
	public function _getcookie($name){
		if(empty($name)){return false;}
		if(isset($_COOKIE[$name])){
			return $_COOKIE[$name];
		}else{		
			return false;
		}
	}	
	public function _setcookie($name,$value,$time=0,$path='/',$domain=''){		
		if(empty($name)){return false;}
		$_COOKIE[$name]=$value;				//及时生效
		$s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		if(!$time){
			return setcookie($name,$value,0,$path,$domain,$s);
		}else{
			return setcookie($name,$value,time()+$time,$path,$domain,$s);
		}
	}	
}

new DrawAddons();
?>