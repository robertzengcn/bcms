<?php

class HmTokenService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new HmDAO();
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
    public function get($cart) {
        $this->dao->get($cart->id, $cart);
        return $this->success($cart);
    }
    
    public function maketoken($username){
    
    	return md5(time().$_REQUEST['username'].rand(1000,9999));
    }
    public function savetoken($hmtoken){
    	
    	$this->dao->save($hmtoken);
    	return $this->success();
    }
    public function validtoken($token){
    	$arr=array('token'=>$token);
    	$result=$this->dao->gettoken($arr);
    	
    	if(!$result){
    		
    		return false;
    	}
    	if($result['expire_time']<=time()){
    		return false;
    	}

    	if(!session_id()) session_start();
    	$_SESSION['work_id']=$result['work_id'];
    	return true;    	
    }
    


    
 
    
}

