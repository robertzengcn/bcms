<?php

class CommodityService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new CommodityDAO();
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
        
            
            
            $commoditydescservice=new CommodityDescriptService();
            $result=$commoditydescservice->getdesc($commodity->id);
            if($result){
            $commodity->descript=$result->product_descript;
            }else{
            	$commodity->descript="";
            }
        
        if($commodity->start_time){
        	$commodity->start_time=date('Y-m-d',$commodity->start_time);
        }
        if($commodity->end_time){
        	$commodity->end_time=date('Y-m-d',$commodity->end_time);
        }
        if($commodity->pic){
        	$commodity->src = str_replace(UPLOAD, '/', $commodity->pic);
        }        
 //       $commodity->tags = $tagsService->getTags($commodity->plushtime);
//         $recommend = new RecommendListService();
//         $result = $recommend->getById('commodity_id', $commodity->id);
//         $commodity->recommend = $result; 
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
			if($value->end_time < time()){
				$value->status = 0;	
			}
            $value->pic = UPLOAD . $value->pic;
            $value->plushtime = date('Y-m-d', (int)$value->plushtime);
            $value->start_time=date('Y-m-d',(int)$value->start_time);
            $value->end_time=date('Y-m-d',(int)$value->end_time);
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
        
        if(isset($_REQUEST['descript'])&&$_REQUEST['descript']!=null){
        $commoditydescript=new CommodityDescriptService();
        $commoditydesc=new CommodityDescript();
        $commoditydesc->product_id=$rs->id;
        $commoditydesc->product_descript=$_REQUEST['descript'];
        $commoditydescript->save($commoditydesc);
        }
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
    
    public function getFlag($flag){
    	switch($flag){
    		case 'catelogue':
    			$this->getcat();
    		break;
    		default:
    			
    	}
    }
    public function getcat(){
    	$commoditycatelog=new CommodityCategoriesService();
    	$commoditycatelog->getcat();
    }
    
    /*
     * 
     * */
    
    public function getcatbyid($id){
    	$arr=array('categories_id'=>$id);
    	return $this->dao->getcatbyid($arr);
    	
    }
    
    /*
     * 减少商品数量 增加已销数量
     * @param $commodity_id, $quantity
     * */
    public function reduce($commodity_id,$quantity){
    	
    	$commodity=new Commodity();
    	$commodity->id=$commodity_id;    	
    	$this->get($commodity);
    	$commodity->quantity=$commodity->quantity-$quantity;
    	$commodity->salenum=$commodity->salenum+$quantity;
    	$commodity->counts=rand(1,1000);
    	$commodity->updatetime=time();
    	$commodity->start_time=strtotime($commodity->start_time);
    	$commodity->end_time=strtotime($commodity->end_time);
		$commodity->discount=($commodity->discount=='') ? null : $commodity->discount;
    	$this->update($commodity);
    	
    }
    
    /*
     * 商城前端取商品信息
     * */
    public function getcombyid($arr){
    	
    	$commodity=new Commodity();
    	
    	$commodity->id=$arr['id'];
    
    	$this->dao->get($commodity->id, $commodity);
    	
    	return $this->success($commodity);
    	
    }
    
    /*
     * 更新库存商品数量
     * */
    public function updatequantity($arr){
    	$commodity=new Commodity();
    	$commodity->id=$arr['commodity_id'];
    	$this->get($commodity);
    	$commodity->quantity=$commodity->quantity+$arr['quantity'];
    	
    	$this->update($commodity);
    }
		public function getCartList($shopids){
		    	return $this->dao->getCartList($shopids);
		}

}

