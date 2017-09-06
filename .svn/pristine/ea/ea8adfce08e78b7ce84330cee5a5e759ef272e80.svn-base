<?php

class clientfocusmsgobserver  extends Controller{
	/* (non-PHPdoc)
	 * @see Controller::filter()
	*/
	public function filter() {
		// TODO Auto-generated method stub
		$filterService = new FilterService();
		$filterService->addFunc($filterService::$SQLINJECTION);
		$filterService->addFunc($filterService::$FILERPLUSHTIME);

		return $filterService->execute();
	
	}
	
	public function __construct() {
      global $controller;

		$controller->attach($this, array('NOTIFY_CLIENT_SAVE'));
	}
	
	function update(&$class, $eventID, $paramArray) {
	
		if(isset($paramArray['send'])&&$paramArray['send']){//如果开启短信通知
			
			try{
			$contectser=new ContactService();
			$urldata=$contectser->getContact('wuxian_ip')->data;
			if($urldata->val){
				$url=$urldata->val;
			}else{
				$url=null;
			}
			$pwddata=$contectser->getContact('wuxian_password')->data;
			if($pwddata->val){
				$pwd=$pwddata->val;
			}else{
				$pwd=null;
			}
			$ciddata=$contectser->getContact('wuxian_account')->data;
			if($ciddata->val){
				$cid=$ciddata->val;
			}else{
				$cid=null;
			}
				
			if($url==null||$cid==null||$pwd==null){
				throw new Exception('接口配置错误', 77);
			}else{
				$wuxianser = new WuxianService ( $url, $cid, $pwd);
				$workser=new WorkerService();
				if(!empty($paramArray['focus_id'])){
					foreach($_REQUEST['focus_id'] as $val){
						$worker=new Worker();
						$worker->id=$val;
						$worker=$workser->get($worker)->data;
						if($worker->telephone){
							
							$wuxianresult = $wuxianser->sendNormalMessage($worker->telephone,$paramArray['data']);
						}
					}					
				}
				
			}
			
		
			}catch(Exception  $e){
				$error_log=GENERATEPATH . 'log/wuxian_error.log';
				error_log(date('Y-m-d H:i:s') . ' wuxian error:' . $e->getMessage() . PHP_EOL, 3, $error_log);
			}
			
		
         		    
		}
	}


}