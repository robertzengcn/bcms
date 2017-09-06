<?php

class CommodityDescriptService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new CommodityDescriptDAO();
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
      
        return $this->dao->deleteBeans($commodityArray);
    } 

    /**
     * 获取一条数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function get($commodity) {
        $this->dao->get($commodity->id, $commodity);
        
            
        
        if($commodity->start_time){
        	$commodity->start_time=date('Y-m-d',$commodity->start_time);
        }
        if($commodity->end_time){
        	$commodity->end_time=date('Y-m-d',$commodity->end_time);
        }
        $tagsService = new TagService();
 //       $commodity->tags = $tagsService->getTags($commodity->plushtime);
        $recommend = new RecommendListService();
        $result = $recommend->getById('commodity_id', $commodity->id);
        $commodity->recommend = $result; 
        return $this->success($commodity);
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
        foreach ($commodityArray as $key => $value) {
            $value->plushtime = date('Y-m-d', $value->plushtime);
            $value->start_time=date('Y-m-d',$value->start_time);
            $value->end_time=date('Y-m-d',$value->end_time);
        }

        return $this->success($commodityArray);
    }

    /**
     * 保存数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function save($commodity) {
    	
         $commodity->validate();        
        // 获取class对象并插入数据
        $rs=$this->dao->save($commodity);
       
        return $this->success();
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
    
    /*
     * 根据product_id取商品
     * 
     * */
    
    public function getdesc($id){
    	$array=array('product_id'=>$id);
    	
    	return $this->dao->getitem($array);
    }
    
    /*
     * 根据产品id更新描述
     * */
    public function updatepro($id,$desc){
    	
    	$arr=array('product_id'=>$id);
    	$this->dao->updatepro($arr,$desc);
    	return $this->success();
    }
}

