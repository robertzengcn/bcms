<?php

/**
 * 在线问答模块流程控制器
 * @author Administrator
 *
 */
class WeiboController extends Controller {

    private $service = null;
    private $HMAKEY='Vb4!PLCzCW';    
    private $boyiurl="http://www.hwibsc.com/interface/hma/HmaAccountInterface.php";
    public $useragent = 'Sae T OAuth2 v0.1';
    public $connecttimeout = 30;
    public $format = 'json';
    public $timeout = 30;
    public $ssl_verifypeer = FALSE;
    public $decode_json = TRUE;
    public $access_token;
    public $http_info;
    public $debug=True;
    

    /**
     * 构造方法
     * 实例化基类并实例化service层,并将其赋值给service属性
     */
    public function __construct() {
        parent::__construct();
        $this->service = new WeiboService();
       
       

    
    }
    /**
     * 数据安全验证、登录检测
     *
     * @see controller/Controller::filter()
     */
    public function filter() {
    	$filterService = new FilterService();
    	$filterService->addFunc($filterService::$SQLINJECTION);
    	$filterService->addFunc($filterService::$FILERPLUSHTIME);
    	$filterService->addFunc($filterService::$WORKERISLOGIN);
    	$filterService->addFunc($filterService::$WORKERLOGHISTORY);
    	return $filterService->execute();
    }
    
    public function checkaccess(){
    	$result=$this->service->checkaccess();
    	if($result>0){
    		echo json_encode(array('stute'=>true,'msg'=>'新浪微博已关联','code'=>0,'data'=>null));
    		exit();
    	}else{
    		echo json_encode(array('stute'=>false,'msg'=>'新浪微博未关联,或token到期','code'=>1,'data'=>null));
    		exit();
    	}
    }
    /*
     * 保存应用信息
     * */
    public function saveapp(){
    	if(isset($_REQUEST['appkey'])&&strlen($_REQUEST['appkey'])>0){
    		$appkey=$_REQUEST['appkey'];
    	}else{
    		echo json_encode(array('stute'=>false,'msg'=>'缺少appkey参数','code'=>1,'data'=>null));
    		exit();
    	}
    	if(isset($_REQUEST['appsecret'])&&strlen($_REQUEST['appsecret'])>0){
    		$appsecret=$_REQUEST['appsecret'];
    	}else{
    		echo json_encode(array('stute'=>false,'msg'=>'缺少appsecret参数','code'=>2,'data'=>null));
    		exit();
    	}
    	
    	$contactser=new ContactService();
    	$contactser->updateweiappkey(array('val'=>$appkey));
    	$contactser->updateweiappsecret(array('val'=>$appkey));
    	echo json_encode(array('stute'=>true,'msg'=>'app信息保存成功','code'=>0,'data'=>null));
    	exit();    	    	
    }
    /*
     * 获取回调页面地址
     * */
    public function getcallback(){
    	$url=NETADDRESS.'/hcc/article/callback.html';
    	echo json_encode(array('stute'=>true,'msg'=>'获取callback成功','code'=>0,'data'=>$url));
    	exit();
    	
    }
    
    /*
     * 获取授权过的Access Token
     * */
    public function access_token(){
    	$contactser=new ContactService();
    	$appkey=$contactser->getappkey();
    	$appsecret=$contactser->getappsecret();
    	$appcode=$contactser->getappcode();
    	
    	$url='https://api.weibo.com/oauth2/access_token?client_id='.$appkey->val.'&client_secret='.$appsecret->val.'&grant_type=authorization_code&code='.$appcode->val.'&redirect_uri='.NETADDRESS.'/hcc/article/callback.html';

    	
    	$ch = curl_init();
    	$timeout = 60000*10;
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, true);
    	//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    	
    	$jsresult = curl_exec($ch);
    	curl_close($ch);
    	if($jsresult === FALSE ){
    		
    		echo json_encode(array('stute'=>false,'msg'=>'CURL Error:'.curl_error($ch),'code'=>0,'data'=>null));
    		exit();
    	}
    	   	    	   	
    	
    	$result=json_decode($jsresult);
    	

    		    	    
    	$this->service->update_token($result->access_token, $result->expires_in, $result->uid);
    	
    	
    	echo json_encode(array('stute'=>true,'msg'=>'app token保存成功','code'=>0,'data'=>null));
    	exit();
    	
  	    	        	
    }
    
    /*
     * 保存code
     * 
     * */
    public function savecode(){
    	if(isset($_REQUEST['code'])&&strlen($_REQUEST['code'])>0){
    		$code=$_REQUEST['code'];
    	}else{
    		echo json_encode(array('stute'=>false,'msg'=>'缺少code参数','code'=>1,'data'=>null));
    		exit();
    	}
    	$contactser=new ContactService();
    	$contactser->updateweibocode(array('val'=>$code));
    	echo json_encode(array('stute'=>true,'msg'=>'app code保存成功','code'=>0,'data'=>null));
    	exit();
    	
    }
    
    /*
     * 获取app相关信息
     * */
    public function getapp(){
    	$contactser=new ContactService();
    	$appkey=$contactser->getappkey();
    	$appsecret=$contactser->getappsecret();
    	echo json_encode(array('stute'=>true,'msg'=>null,'code'=>0,'data'=>array('appkey'=>$appkey->val,'appsecret'=>$appsecret->val)));
    	exit();
    	
    }
    
    /*
     * 取消微博关联
     * */
    public function cancelwei(){
    	
    	$this->service->removetoken();
    	echo json_encode(array('stute'=>true,'msg'=>'移除 app token 成功','code'=>0,'data'=>null));
    	exit();
    }



   
}
