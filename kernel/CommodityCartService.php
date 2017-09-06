<?php

class CommodityCartService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new CommodityCartDAO();
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
    public function get($cart) {
        $this->dao->get($cart->id, $cart);
        

        return $this->success($cart);
    }
    /*
     * 获取购物车中商品详情
     * */
    
    public function getmebercart($arr){
    	$result=$this->dao->getmebercart($arr);
    	return $this->success($result);
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
        	
            $value->date = date('Y-m-d', $value->date);
   
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
    public function update($cart) {
    //    $commodity->updatetime = time();
    	
        $cart->validate();
        $this->dao->beginTrans();
        return $this->dao->update($cart);
    }

    /*
     * 添加购物车的控制器
     * @param array
     * */
    public function addcart($arr){
    	
    	$daoarray=array('commodity_id'=>$arr['commodity_id'],'member_id'=>$arr['member_id']);
    	$commodityservice=new CommodityService();
    	$commodity=new Commodity();
    	$commodity->id=$arr['commodity_id'];
    	$comdata=$commodityservice->get($commodity);
    	
    	
    	$com=$comdata->data;
    	if($com->quantity<$arr['quantity']){
    		$errarray=array('statu'=>false,'code'=>181,'msg'=>'商品数量不足,无法添加购物车');
    		echo json_encode($errarray);
    		exit();
    	}
    	if($com->exchange==1){
    		$finalscore=$com->score;
    		$finalprice=0;
    	}else{
    		$finalscore=$com->score;
    		$finalprice=$com->price;
    	}
    	$totalscore=$finalscore*$arr['quantity'];
    	$totalprice=$finalprice*$arr['quantity'];
   
    	$result=$this->dao->getmembercart($daoarray);
        try{
    	$this->dao->beginTrans();
    	if(!empty($result)){
    		$cart=new Cart();
    		$cart->id=$result['id'];
    		$this->dao->get($cart->id, $cart);    		
    		$cart->quantity=$cart->quantity+$arr['quantity'];
    		$cart->final_score=$cart->final_score+$totalscore;
    		$cart->final_price=$cart->final_price+$finalprice;
    		$this->dao->update($cart);
    		
    	}else{
    		$cart=new Cart();
    		$cart->member_id=$arr['member_id'];
    		$cart->commodity_id=$arr['commodity_id'];
    		$cart->quantity=$arr['quantity'];
    		$cart->final_score=$totalscore;
    		$cart->final_price=$finalprice;
    		$cart->date=time();
    		$this->dao->save($cart);
    	}
    	$commodityservice->reduce($arr['commodity_id'],$arr['quantity']);
    	$this->dao->commitTrans();
    	return $this->success();
        }catch (Exception $e) {
        	$this->dao->rollbackTrans();
        	return $this->fail();
        }
        
    }
    
    /*
     *从购物车中删除商品 
     *@param array 
     * */
    
    public function deletecartcommodity($arr){
    	$this->dao->getmembercartid($arr);

    	return $this->success();
    	
    }
    /*
     * 统计用户提交购物车id的积分数
     * */
    public function count_score($arr){
    	
    		$result=$this->dao->getmebercart($arr);
    		return $this->success($result['final_score']);
    	
    }
    
    /*
     * 统计用户提交购物车id的所需付款数
    * */
    public function count_price($arr){
    	 
    	$result=$this->dao->getmebercart($arr);
    	return $this->success($result['final_price']);
    	 
    }
    
    /*
     * 
     * 更新购物车中的商品数量
     * */
    
    public function updateitemquantity($arr){
    	
    	$this->dao->updateitemquantity($arr);
    	return $this->success();    	    	
    }
    
 
    
}

