<?php
/**
 * 
 * 获取用户积分
 * @author Administrator
 * @version v1.0
 * @example 该接口在进行预约后,由总控中心发起预约接口
 */
require_once '../InterfaceAbstract.php';

header("Content-type: text/html; charset=utf-8");
class ScoreHwibsc extends InterfaceAbstract {
	
	//构造函数
	public function __construct() {
		parent::__construct();
	}
	
	public function _begin() {
	    $this->queryRes();
	}
	//查询time_id值是否正确
	private function queryRes() {
			$token = $_REQUEST['token'];
			if(strlen($token)<1){
				$this->msgPut(false, '用户未登陆', array(), 14);
			}
			$url = "http://www.boyicms.com/interface/hma/HmaAccountInterface.php?type=logincheck";
			$post_data = array ("token"=>$token);
	      
			$ch=curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
			$data=curl_exec($ch);
			curl_close($ch);			
	        $obj=json_decode($data);
	       if($obj->code==1){			
				$memberser=new MemberService();
				
				$memberarr=array('username'=>$obj->data->username);
				$memberarray=$memberser->getmembyname($memberarr)->data;//获取会员信息			
					
						$member=new Member();						
						if(empty($memberarray->id)){//如果会员不存在则添加会员
							$newmember=array('username'=>$obj->data->username,'telephone'=>'');
							$mresult=$memberser->addmember2($newmember);
							$member=$mresult->data;
							$memberarray->ownscore = 0;
						}else{
							$member=$memberarray;
						}
						$memberlogser=new CommodityAddScoreLogService();//准备写入用户日志						
						$scoreruleser=new CommodityRuleService();
						$scoarry=array('order'=>'order by id desc');
						$res=$scoreruleser->query($scoarry);//查询现有的积分规则
						$score = 0;
						$ownscore = $memberarray->ownscore;
						$nows=time();
						foreach($res->data as $key=>$val){//规则处理位置
							if($val->status != 0 && $val->id==1){//首次登陆添加积分
								$lognum=$memberlogser->countmember(array('uid'=>$member->id,'type'=>$val->id));
								if($lognum->data<1){
									$memberser->addscoretomember(array('id'=>$member->id,'score'=>$val->score));
									$logarr=array('uid'=>$member->id,'date'=>$nows,'type'=>$val->id,'score'=>$val->score,'ip'=>$this->getIp());//保存用户登录信息,写入日子好
									$memberlogser->savelog($logarr);
									$score = $score + $val->score;
								}						
							}
							if($val->status != 0 && $val->id==2){//完善个人资料				
								$num=$memberlogser->countmember(array('uid'=>$member->id,'type'=>$val->id));//用户是否完善个人资料获取积分次数
								if($num<1 && $newmember['username'] && $newmember['telephone']){
									$memberser->addscoretomember(array('id'=>$member->id,'score'=>$val->score));
									$logarr=array('uid'=>$member->id,'date'=>$nows,'type'=>$val->id,'score'=>$val->score,'ip'=>$this->getIp());//保存用户登录信息,写入日子好
									$memberlogser->savelog($logarr);
									$score = $score + $val->score;
								}
							}
							if($val->status != 0 && $val->id==4){//每日登陆添加积分	
								$num=$memberlogser->summember(array('uid'=>$member->id,'type'=>$val->id));//获取用户今日获得的积分数
								if($num->data->total<$val->limit ){//如果没有超过该用户每日登录上限则执行操作
									$memberser->addscoretomember(array('id'=>$member->id,'score'=>$val->score));
								    $logarr=array('uid'=>$member->id,'date'=>$nows,'type'=>$val->id,'score'=>$val->score,'ip'=>$this->getIp());//保存用户登录信息,写入日子好
								    $memberlogser->savelog($logarr);
									$score = $score + $val->score;
								}

							}
							if($val->status != 0 && $val->id==5){//7天连续登陆
								$yestdaynum=$memberlogser->continuousLogging(array('uid'=>$member->id,'type'=>$val->id,'num'=>$val->limit));
								if($yestdaynum){//如果昨天有登陆,并且用户今天获取的积分数没有达到限制则执行操作						
									$memberser->addscoretomember(array('id'=>$member->id,'score'=>$val->score));
									$logarr=array('uid'=>$member->id,'date'=>$nows,'type'=>$val->id,'score'=>$val->score,'ip'=>$this->getIp());//保存用户登录信息,写入日子好
									$memberlogser->savelog($logarr);
									$score = $score + $val->score;									
								}		
							}								
						}
						$ownscore = $ownscore+$score;
						$this->msgPut(true, '', array('ownscore'=>(int)$ownscore,'score'=>$score));
			}else{
			    $this->msgPut(false, '请重新登录', array(), 15);
			}
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
new ScoreHwibsc();