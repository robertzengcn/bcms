<?php

class DrawWinlogService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new DrawWinlogDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
     public function deleteBatch($ids) {
        Entity::isIds($ids);   // 验证ids是否合法
        $commodityArray = $this->dao->getBatch($ids);

      
/*无此功能页面 
        $files = array();
        $recommendListDAO = new RecommendListDAO();
        foreach ($commodityArray as $commodity) {
          $filename = GENERATEPATH . 'commodity/' . $commodity->id . '.html';
            if ($commodity->id == 0) {
                throw new ValidatorException(78);
            }
            $files[] = $filename;
            $recommendListDAO->deleteById('$commodity_id', $$commodity->id);
        } 
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
*/
        return $this->dao->deleteBeans($commodityArray);
    } 

    /**
     * 获取一条数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function get($draw) {
        $this->dao->get($draw->id, $draw);
        
     
        if($draw->start_time){
        	$draw->start_time=date('Y-m-d',$draw->start_time);
        }
        if($draw->end_time){
        	$draw->end_time=date('Y-m-d',$draw->end_time);
        }
        
 //       $commodity->tags = $tagsService->getTags($commodity->plushtime);
//         $recommend = new RecommendListService();
//         $result = $recommend->getById('commodity_id', $commodity->id);
//         $commodity->recommend = $result; 
        return $this->success($draw);
    }


    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
    	
    	
        $winarr = $this->dao->query($where);
      
        foreach ($winarr as $key => $value) {
            //$value->plushtime = date('Y-m-d', $value->plushtime);
            $value->date=date('Y-m-d',$value->date);
            
        }

        return $this->success($winarr);
    }
    
    /*
     * 获取查询条件下的结果总数
     * */
    public function querycount($where){
    	
    	$result = $this->dao->totalRows($where);
    	return $this->success($result);
    }
    

    /**
     * 保存数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function save($draw) {
    	
         $draw->validate();        
        // 获取class对象并插入数据
        $rs=$this->dao->save($draw);
        

        return $this->success($rs);
    }

    /**
     * 更新数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function update($commodity) {
    //    $commodity->updatetime = time();
    	
        $commodity->validate();
        $this->dao->beginTrans();
        return $this->dao->update($commodity);
    }
    
    public function setstute($id){
    	//Entity::isIds($id);
    	$arr=array('id'=>(int)$id);
    	$this->dao->setstute($arr);
    	return $this->success();
    	
    }
    
    /*
     * 取当天奖品抽中数
    * */
    public function gettodaycount($id){
    	$t = time();
    	$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
    	$array=array('prize_id'=>$id,'start'=>$start,'end'=>$end);
    	$result=$this->dao->gettodaycount($array);

    	return $this->success($result);
    }
    
    /*
     * 写入获奖名单
    * */
    public function writeowner($arr){
    	$winlog=new DrawWinlog();
    	$winlog->member_id=$arr['member_id'];
    	$winlog->prize_id=$arr['prize_id'];
    	$winlog->draw_id=$arr['draw_id'];
    	$winlog->statue=0;
    	$winlog->date=time();
    	//$winlog->flag=md5($winlog->member_id.time().rand(1000,9999));
    	$winlog->flag=$this->createOrderId();
    	return $this->dao->save($winlog);
    	 
    }
    
    /*获取某次活动某个奖品的已被抽中数
     * */
    public function getprizeamount($prizeid){
    	$arr=array('prize_id'=>(int)$prizeid);   	
    	return $this->dao->getprizeamount($arr);
    }
    
    /*
     * 
     * 取某个会员某次活动的获奖信息
     * 
     * */
    public function getmemdraw($arr){
    	$result=$this->dao->getmemdraw($arr);
    	$result['date']=date('Y-m-d H:i',$result['date']);
    	return $this->success($result);
    }
    
    /*
     * 根据flag查找中奖详情
     * */
    public function getdetailbyflag($arr){
    	$result=$this->dao->getdetailbyflag($arr);
    	if(!empty($result)){
    		$winlog=$result[0];
    		$winlog->date=date('Y-m-d H:i',$winlog->date);
    		return $winlog;
    	}else{
    		return null;
    	}
    }
     /*
     * 查找中奖列表
     * */
    public function getWinnersList($where){ 
        $winarr = $this->dao->getList($where);
		$draws = new DrawService();
		$dps = new DrawPrizeService();
        foreach ($winarr as $key => $value) {
			$drawinfo = $draws->getNameById(array('id'=>$value->draw_id));
			$value->draw_name = $drawinfo->name;
			$dpsinfo = $dps->getprizedetail(array('id'=>$value->prize_id));
			$value->prize_name = $dpsinfo->data->name;
			$value->prize_img = $dpsinfo->data->img;				
            $value->date=date('Y-m-d',$value->date);
			unset($value->member_id,$value->prize_id,$value->draw_id);
        }
        return $this->success($winarr);		
	}
     /**
     * 查找中奖详情
     * */
    public function getWinnersInfo($where){
		if($where['type']==1){
			$wininfo = $this->dao->getInfoById(array('id'=>$where['id']));
		}else{
			$wininfo = $this->dao->getInfoByFlag(array('flag'=>$where['flag']));		
		}
		if($wininfo->id){
			$draws = new DrawService();
			$dps = new DrawPrizeService();
			$drawinfo = $draws->getNameById(array('id'=>$wininfo->draw_id));
			$wininfo->draw_name = $drawinfo->name;
			$dpsinfo = $dps->getprizedetail(array('id'=>$wininfo->prize_id));
			$wininfo->prize_name = $dpsinfo->data->name;
			$wininfo->prize_img = $dpsinfo->data->img;
			unset($wininfo->member_id,$wininfo->prize_id,$wininfo->draw_id);			
			return $this->success($wininfo);
		}
		return array('statue'=>false,'code'=>0,'msg'=>'无此奖品','data'=>'');
	}
     /**
     * 设置奖品为已领取
     * */
    public function makePrizeStatus($where){
		$this->dao->setStatus($where);	
		
    	return $this->success();
	}
	//生成随机单号
	public function createOrderId(){		
		$rst = date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 6);
		return $rst;	
	}		
}

