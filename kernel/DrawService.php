<?php

class DrawService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new DrawDAO();
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
        if ($draw->pic) {
            $draw->src = UPLOAD . $draw->pic;
        }
     
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
    	
        $commodityArray = $this->dao->query($where);
    
        if(count($commodityArray)>0){
			foreach ($commodityArray as $key => $value) {
				if($value->end_time < time()){
					$value->statu = 2;	
				}
				//$value->plushtime = date('Y-m-d', $value->plushtime);
				$value->start_time=date('Y-m-d H:i:s',$value->start_time);
				$value->end_time=date('Y-m-d H:i:s',$value->end_time);
			}
		}
        return $this->success($commodityArray);
    }
    /**
     * 查询数据总量
     *
     * @see kernel/BaseService::totalRows()
     */
    public function totalRows($params) {	
        return $this->success($this->dao->totalRows($params));
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
    
    public function setstute($arr){
    	//Entity::isIds($id);
    	$this->dao->setstute($arr);
    	return $this->success();
    	
    }
    
    public function getname(){
    	$result=$this->dao->getname();

    	return $this->success($result);
    }
    
    /*
     * 获取抽奖的详细数据
     * */
    public function mobileget($arr){
    	$draw=new Draw();
    	$draw->id=$arr['id'];
    	$this->dao->get($draw->id, $draw);
    	return $this->success($draw);
    }
    /*
     * 获取今日可以使用的抽奖活动
     * */
    
    public function getdrawcount($where) {
    	 
    	$commodityArray = $this->dao->getdrawcount($where);
    
    	foreach ($commodityArray as $key => $value) {
    		//$value->plushtime = date('Y-m-d', $value->plushtime);
    		$value->start_time=date('Y-m-d H:i:s',$value->start_time);
    		$value->end_time=date('Y-m-d H:i:s',$value->end_time);
    	}
    
    	return $this->success($commodityArray);
    }
    /*
     * id取活动名称
     * */
    public function getNameById($arr){
    	return $this->dao->getNameById($arr);
    }
}

