<?php

class CommodityAddScoreLogService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new CommodityAddScoreLogDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
     public function deleteBatch($ids) {
        Entity::isIds($ids);   // 验证ids是否合法
        $scoreruleArray = $this->dao->getBatch($ids);

        return $this->dao->deleteBeans($scoreruleArray);
    } 

    /**
     * 获取一条数据
     *
     * @param Entity $scorerule
     * @return Result
     */
    public function get($scorerule) {
        $this->dao->get($scorerule->id, $scorerule);
 
        return $this->success($scorerule);
    }


    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
	 
    public function query($where) {
        $scoreruleArray = $this->dao->query($where);
			 $memberdao = new MemberDAO();
			 $commodityruledao = new CommodityRuleDAO();
		$array_u =array();
        foreach($scoreruleArray as $key=>$val){
			$memberinfo = $memberdao->getbyid(array('id'=>$val->uid));
			$rulename= $commodityruledao->query(array('id'=>$val->type));
			$val->username = $memberinfo->username;
			$val->telephone = $memberinfo->telephone;
			$val->name = $rulename[0]->name;
        	$val->date=date('Y-m-d H:i',$val->date);
 			if($where['username'] && $where['username'] == $val->username){
				$array_u[] = $val;
			}       	 
        }
			if($where['username']){	
				return $this->success($array_u);				
			}else{
				return $this->success($scoreruleArray);
			}
    }
    public function totalRows($where) {
		  return $this->dao->totalRows($where);		
	}
    /**
     * 保存数据
     *
     * @param Entity $scorerule
     * @return Result
     */
    public function save($scorerule) {
    	
         $scorerule->validate();        
        // 获取class对象并插入数据
        $this->dao->save($scorerule);
      
        return $this->success();
    }
    
    /*
     * 根据type取值
     * @param int $type
     * */
    public function getbytype($type){
    	$arr=array('type'=>$type);
    	$rs=$this->dao->getbytype($arr);
    	return $this->success($rs);
    }

    /**
     * 更新数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function update($scorerule) {
    //    $commodity->updatetime = time();
    	
        $scorerule->validate();
        $this->dao->beginTrans();
        return $this->dao->update($scorerule);
    }
    

    
    /*
     * 返回highchart所需的统计数据
     * */
    
    public function getdate(){
    	$totalnum=$this->dao->gettotal();

    	$rs=$this->dao->getdistincttype();
 
    	if(!empty($rs)){
    		$arr=array();
    		foreach ($rs as $key=>$val){
    			$num=$this->dao->gettypenum(array('type'=>$val['type']));
    			$arr[$val['type']]['name']=$val['name'];
    			$arr[$val['type']]['y']=floatval(number_format($num/$totalnum,2));
    		}
    		return $this->success(array_merge($arr));
    		
    	}else{
    		throw new ValidatorException(180);
    		}
     
    }
    /*
     * 计算今日会员登录次数
     * */
    public function counttodaylog($arr){
    	
    	$t = time();
    	$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
    	$arr=array('uid'=>$arr['uid'],'start'=>$start,'end'=>$end);
        $result=$this->dao->counttodaylog($arr);
        return $this->success($result);    	    	
    }
    /*
     * 计算用户今日获得的积分数
     * 
     * */
    public function summember($arr){
    	$t = time();
    	$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
    	$arrs=array('uid'=>$arr['uid'],'start_time'=>$start,'end_time'=>$end,'type'=>$arr['type']);
    	//$arr=array('uid'=>$arr['uid']);
    	$result=$this->dao->summember($arrs);
    	return $this->success($result[0]);
    }
     /*
     * 完善个人资料
     * 
     * */   
     public function perfectmember($arr){   	
    	$result=$this->dao->perfectmember($arr);
    	return $this->success($result);
    }	
    /*
     * 计算用户登录次数
     * array('uid'=>uid)
     * */
    public function countmember($arr){
    	
    	$result=$this->dao->countmember($arr);
    	return $this->success($result);
    }
    /*
     * 通过接口保存用户登录记录
     * param $arr
     * */
    public function savelog($arr){
    	$member=new CommodityAddScoreLog();
    	$member->uid=$arr['uid'];
    	$member->date=$arr['date'];
    	$member->type=$arr['type'];
    	$member->score=$arr['score'];
    	$member->ip=$arr['ip'];
    	$this->dao->save($member);
    	return $this->success();
    }
    /*
     * 计算用户昨日是否登录
     * 
     * */
    public function countyestdaylog($arr){
    	$t=time()-86400;
    	$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
    	$arr=array('uid'=>$arr['uid'],'start'=>$start,'end'=>$end);
    	$result=$this->dao->counttodaylog($arr);
    	return $this->success($result);
    }
    /*
     * 计算用户ip是否重复
     * 
     * */
	public function fromIp($arr){
    	$t=time();
    	$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
    	$arrs=array('uid'=>$arr['uid'],'start'=>$start,'end'=>$end,'type'=>$arr['type'],'ip'=>$arr['ip']);
    	$result=$this->dao->counttodaylogip($arrs);
		if($result){
			return false;
		}else{
			return true;			
		}
	}
    /*
     * 计算用户是否连续登录
     * 
     * */
	 public function continuousLogging($arr){
	 	$arrc=array('uid'=>$arr['uid'],'type'=>$arr['type']);
		$time=$this->dao->iscontinuity($arrc);
		if($time){
 			$day = ceil((time() - $time)/86400);
			if($day<$arr['num']){
				return false;
			} 
		}
		$y=0;
		for($i=0;$i<$arr['num'];$i++){
			$t=time()-86400*$i;
			$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
			$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
			$arrs=array('uid'=>$arr['uid'],'start'=>$start,'end'=>$end,'type'=>$arr['type']);
			$result=$this->dao->counttodaylog($arrs);
			if($result){
				$y++;
			}
		}
		if($y == $arr['num'] && $y!=0){
			return true;
		}else{
			return false;			
		}
	 }
}

