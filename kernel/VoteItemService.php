<?php

/**
 * 投票
 * @author Administrator
 *
 */
class VoteItemService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new VoteItemDAO();
    }
   /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
    	
        $voteitemArray = $this->dao->query($where);
		$votedao = new VoteDAO();
		foreach($voteitemArray as $value){
			$value->name = $votedao->getActiveName($value->vid);
			$value->addtime = date('Y-m-d', $value->addtime);
			unset($value->startpicurl1,$value->startpicurl2,$value->startpicurl3,$value->startpicurl4,$value->startpicurl5,$value->lockinfo,$value->wechat_id,$value->ed_dcount);
		}
        return $this->success($voteitemArray);
    }
	/*
     * 获取报名人数
     * */
    
    public function getSignUpCount($where) {   	 
    	return $this->dao->getCount($where);
	}
	/*
     * 获取某个报名时间段人数
     * */
    
    public function getCountInTimeSlot($where) {   	 
    	return $this->dao->countInTimeSlot($where);
	}
	/*
     * 获取某个时间段点击量
     * */
    
    public function getDcountByTime($t,$vid) {   	 
    	return $this->dao->getDcountByTime($t,$vid);
	}
	/*
     * 获取未通过的报名人数
     * */
    
    public function getNotPassedCount($where) {   	 
    	return $this->dao->notPassedCount($where);
	}
	/*
     * 获取未通过的报名人数
     * */
    
    public function getPassedCount($where) {  	 
    	return $this->dao->passedCount($where);
	}
   /**
     * 获取一条数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function get($voteitem) {
        $this->dao->get($voteitem->id, $voteitem);  
        if($voteitem->addtime){
        	$voteitem->addtime=date('Y-m-d',$voteitem->addtime);
        }
		$votedao = new VoteDAO();
		$voteitem->title = $votedao->getActiveName($voteitem->vid);
		$voteitem->piclist = '';
		for($i=1;$i<=5;$i++){
			$sta = 'startpicurl'.$i;
			if($voteitem->$sta){
				$voteitem->piclist .= $voteitem->$sta . '|';
			}
			unset($voteitem->$sta);
		}
		unset($voteitem->wechat_id);
		if($voteitem->piclist){
			$voteitem->piclist = substr($voteitem->piclist, 0, strlen($voteitem->piclist) - 1);
		}
        return $this->success($voteitem);
    }
   /**
     * 保存数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function save($voteitem) {
    	
        $voteitem->validate();        
        $res=$this->dao->save($voteitem);
        return $this->success($res);
    }
   /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
     public function deleteBatch($ids) {
        Entity::isIds($ids);   // 验证ids是否合法
        $voteItemArray = $this->dao->getBatch($ids);
        return $this->dao->deleteBeans($voteItemArray);
    }
    /**
     * 更新数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function update($voteitem) {	
        $voteitem->validate();
        $this->dao->beginTrans();
        return $this->dao->update($voteitem);
    }
    /**
     * 开启
     */
    public function updateSwitch($arr) {
		return $this->success($this->dao->updateSwitch($arr));
    }
    /**
     * 获取对应的报名id
     */	
	public function allByVid($arr){
		return $this->dao->getAllByVid($arr);		
	}
    /**
     * 累积投票/访问量
     */	
	public function getTotalVotesClicks($vid){
		$total = $this->dao->totalVotesClicks($vid);
		return 	$total;		
	}
    /**
     * 选手列表
     */
	public function getPlayersList($vid){
		return $this->dao->playersList($vid);	
	}
    /**
     * 选手列表2
     */	
	public function getPlayersListByType($array){
		return $this->dao->playersListByType($array);	
	}
    /**
     * 搜索
     */	
    public function searchKeyWord($arr) {
		$result = $this->dao->searchKeyWord($arr);
		$array = array();
		foreach($result as $key=>$value){
			$array[$key]['id'] = $value->id;
			$array[$key]['vid'] = $value->vid;
			$array[$key]['item'] = $value->item;
			$array[$key]['vcount'] = $value->vcount;
			$array[$key]['startpicurl1'] = $value->startpicurl1;
		}
        return $this->success($array);	
	}
    /**
     * 加载
     */	
    public function getPassedList($arr) {
		$result = $this->dao->getPassedList($arr);
		foreach($result as $value){
			unset($value->startpicurl2,$value->startpicurl3,$value->startpicurl4,$value->startpicurl5,$value->lockinfo,$value->wechat_id,$value->phone,$value->rank,$value->status,$value->addtime,$value->intro,$value->dcount);
		}
        return $this->success($result);			
	}
    /**
     * 投票
     */	
    public function addPoll($arr) {
		        // 事务	
        $this->dao->beginTrans();
        try {  
            //投票+1		
			$result = $this->dao->addPoll(array('id'=>$arr['id'],'vinum'=>$arr['vinum']));		
            //增加用户投票记录
			//$votelog = new VoteLog();
			$votelogArray['vid']= $arr['vid'];
			$votelogArray['vtid'] = $arr['id'];
			$votelogArray['openid'] = $arr['openid'];
			$votelogArray['tp_num'] = $arr['vinum'];
			$votelogArray['tp_time'] = time();	
			$votelogService = new VoteLogService();			
			$votelogService->addVoteLog($votelogArray);
			// 事务提交
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }		
        return $this->success($result);			
	}
   /**
     * 报名
     */	
    public function addVoteItem($arr) {
		$_REQUEST = $arr;
        $this->blindParams($voteitem = new VoteItem());
        return $this->dao->addVoteitem($voteitem);
	}
    /**
     * 获得选手信息
     */	
    public function getPlayerInfo($arr) {
		$result = $this->dao->getPlayerInfo($arr);
		foreach($result as $value){
			unset($value->lockinfo,$value->wechat_id,$value->phone,$value->rank,$value->status,$value->addtime);
		}
        return $this->success($result);			
	}
    /**
     * 选手排名
     */
	public function getPlayersRanking($vid){
		return $this->dao->playersRanking($vid);	
	}
    /**
     * 获得单个选手名次
     */	
    public function getPlayerRanking($arr) {
		$result = $this->dao->getPlayerRanking($arr);
        return $result;		
	}
    /**
     * 增加浏览量 +1
     */	
    public function initAddView($arr) {
		$result = $this->dao->initAddView($arr);
        return $result;		
	}

    /**
     * 获得报名用户id=>dcount
     */	
    public function getIdsDcount($vid) {
		$result = $this->dao->getIdsDcount($vid);
        return $result;	
	}

    /**
     * ids获得
     */	
    public function getPassedListByIds($ids) {
		$result = $this->dao->getPassedListByIds($ids);
		$array=array();
		foreach($result as $key=>$val){
			$array[$key] = (object)$val;
		}
        return $this->success($array);		
	}
   /**
     * 获得报名用户status
     */
	 public function getPlayerStatusByOpenid($arr){
		$result = $this->dao->getPlayerStatusByOpenid($arr);
        return $result;	
	 }	
    /**
     * 绑定参数
     *
     * @param unknown $entity
     */
    protected function blindParams($entity) {
        foreach ($entity as $key => $value) {
            if (isset($_REQUEST[$key])) {
                $entity->$key = $_REQUEST[$key];
            }
        }
    }	
}