<?php

class CommodityLogService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new CommodityLogDAO();
    }

	//增加记录
	public function saveAll($consumplogs){
		        // 事务	
        $this->dao->beginTrans();
        try {            
            // 增加数据	
		   foreach ($consumplogs as $consumplog) {
				$_REQUEST = $consumplog;
				$totalscore += $consumplog['totalscore'];
				$this->blindParams($consumplog = new CommodityLog());			
				  $this->dao->save($consumplog);
				//扣减对应的商品数量 quantity salenum
				$commodityService = new CommodityService();
				$commodityService->reduce($_REQUEST['gid'],$_REQUEST['num']);	
		   }
			$commodityorderDAO = new CommodityOrderDAO();			
			$commodityorderDAO->orderSave(array($_REQUEST['orders'],$_REQUEST['uid'],$_REQUEST['qrcode']));				
            //扣减用户积分数量
			$memberService = new MemberService();	
			$memberService->reducescore(array('id'=>$_REQUEST['uid'],'score'=>$totalscore));
			// 事务提交
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans();
            return $this->fail(0, $e->getMessage());
        }
        return $this->success();		
	}
	//查询记录
	public function query($where){
		$buygoods = $this->dao->query($where);
        //$memberDAO = new MemberDAO();
        //$member = $memberDAO->getscoreamount(array('id'=>$uid));
		$i=0;
		$array =array();
		$array['price']=0;
		$array['score']=0;
		foreach($buygoods as $key => $value){
		     $commodityDAO = new CommodityDAO();	
			 $commodity = $commodityDAO->getInfoById(array('id'=>$value->gid));
			 $buygoods[$key]->subject =  $commodity->subject;
			 $buygoods[$key]->subtitle =  $commodity->subtitle;
			 $buygoods[$key]->pic =  $commodity->pic;
			 if($i==0){
				 $array['status'] = $value->status;
			 	 $array['orders'] = $value->orders;
				 $array['buytime'] = date('Y-m-d', $value->buytime);
				 $array['taketime'] = $value->taketime ? date('Y-m-d', $value->taketime) : '';
				 $array['qrcode'] = $value->qrcode;
			 }
				$array['price']+=$value->totalcash;
				$array['score']+=$value->totalscore;
				$i++;
		}
		$array['data'] = $buygoods;
		return $array;
	}
	//查询用户消费记录	
	public function getScoreLog($where){
		$buygoods = $this->dao->query($where);
		$array =array();
		foreach($buygoods as $key => $value){
			
		}		
	}
    /**
     * 设置订单为已领取
     * */
    public function makeorderhaspay($arr){
    	$this->dao->setorderpay($arr);
    	return $this->success();
    }
    public function isToBuy($arr){
    	return $this->dao->isToBuy($arr);		
	}
    public function byMonth($arr){
    	return $this->dao->buyNumByTime($arr);		
	}	
    protected function blindParams($entity) {
        foreach ($entity as $key => $value) {
            if (isset($_REQUEST[$key])) {
                $entity->$key = $_REQUEST[$key];
            }
        }
    }
    /**
     * 通过订单号和qrcode取数据
     * @param $arr
     * */
    protected function getitembyqrcode($arr){
    	return $this->dao->getitembyarr($arr);
    }
}

