<?php

class BoyiManagerService extends BaseService {
	private $boyimanagerurl="http://www.hwibsc.com/interface/hma/HmaAccountInterface.php";
	

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new BoyiManagerDAO();
    }
    
    /*
     * 保存总控传来的key到本地
     * 
     * */    
    public function save($boyimanager){
    	$this->dao->save($boyimanager);
    	return $this->success();
    }
    
    /*
     * 取最新的key
     * */
    
    public function getkey(){
    	$result=$this->dao->getkey();
    	
    	return $this->success($result);
    	
    }
    
    /**
     * 发送post请求
     * @param string $url 请求地址
     * @param array $post_data post键值对数据
     * @return string
     */
    public function send_post($url, $post_data) {
    
    	$ch = curl_init();
    	$timeout = 60000*10;
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    	$result = curl_exec($ch);
    	curl_close($ch);
    	return $result;
    }
    
    /*
     * 添加IM用户到总控
    * */
    public function addusertoboyi($username){
    	if(strlen($username)<1){
    		echo json_encode(array('stute'=>false,'msg'=>'用户名为空','code'=>1,'data'=>null));
    		exit();
    	}
    	$boyimanagerser=new BoyiManagerService();
    	$keyresult=$boyimanagerser->getkey();
    	if(empty($keyresult->data)){
    		echo json_encode(array('stute'=>false,'msg'=>'网站未认证','code'=>2,'data'=>null));
    		exit();
    	}
    	$url=$this->boyimanagerurl."?type=addimuser";
    	
    	$post_data=array(
    			'hmkey'=>md5( $this->HMAKEY . date('Y-m-d')),
    			'website'=>NETADDRESS,
    			'username'=>$username,
    			'webkey'=>$keyresult->data['boyikey']   			    			 
    	);
    	$result=$this->send_post($url,$post_data);
    	if($obj->code==0){//远程验证成功

    		    		 
    		return $this->success();
    	}else{
    		return $this->fail($obj->code, $obj->msg);
    	}
    	

    	
    	 
    }



}
