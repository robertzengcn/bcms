<?php
require_once '../InterfaceAbstract.php';
class User extends InterfaceAbstract {
	
	public function __construct(){
		parent::__construct(true);
	}
	
	public function _begin() {
	    if( isset( $_REQUEST['method'] ) && method_exists( $this ,  '__'.trim( strtolower( $_REQUEST['method'] ) ) ) ) {
	        $method = '__'.trim( strtolower( $_REQUEST['method'] ) );
	        $this->$method();
	    }else{
	        $this->msgPut(false, '缺少method参数或method参数不正确', null, 1);
	    }
	}
	
	protected function __login(){
	    if( isset( $_REQUEST['username'] ) && isset( $_REQUEST['pwd'] )  ){
	        $username = trim( $_REQUEST['username'] );
	        $password = trim( $_REQUEST['pwd'] );
	        	
	        if( strlen( $password ) != 32 ){$this->__msg(10,'密码不正确.',null);}
	        //$password = md5( $pwd );
	        new ArticleService();
	        $arr=array('name'=>$username,'telephone'=>$username,'password'=>md5($password));
	        $result = R::findOne('worker','`name` = :name or telephone=:telephone and `password`=:password',$arr);
	    
	        if(!is_object( $result )){
	            $this->__msg(1,'账户密码不匹配,验证失败.',null);
	        }else{
	            $secret = $this->getAuthToken()->getSecret();
	            $time = time();
	            $token = md5($result->id.$time.$secret);
	            $array = array(
	                'user_id' => $result->id,
	                'token' => $token,
	                'expire_time' => $time + 3*60*60
	            );
	            $bean = R::dispense(TABLENAME_USER_TOKEN);
	            $bean->import($array);
	            R::store($bean);
	            
	            /*
	            $hmtokenser=new HmTokenService();
	            $token=$hmtokenser->maketoken($username);
	            $hmtoken=new HmToken();
	    
	            $hmtoken->name=$username;
	            $hmtoken->token=$token;
	            $hmtoken->expire_time=time()+86400;
	            $hmtoken->work_id=$result->id;
	            $hmtokenser->savetoken($hmtoken);
	            */
	            
	            $returnarr=array('token'=>$token,'id'=>$result->id);
	            $this->msgPut(true, 'success', $returnarr, 0);
	        };
	    }else{
	        $this->msgPut(false, '缺少username或pwd参数.', null, 1);
	    }
	       
	    /*
		if( isset( $_REQUEST['username'] ) && isset( $_REQUEST['pwd'] )  ){
			if( strlen( trim( $_REQUEST['pwd'] ) ) != 32 ){$this->msgPut(false, '密码不正确.', null, 10);}
			
			$this->userLogin();
			
		}else{
			$this->msgPut(false, '缺少username或pwd参数.', null, 1);
		}
		*/
	}
	
	/**
	 * 获取登录用户所关注的所有客户咨询预约信息
	 * */
	protected function __getReseruserList() {
		new ClientService();
		$userId = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
		if ($userId) {
			@DTExpression::like('focus_id', $userId);
			$clients = R::find('client', DTExpression::$sql, DTExpression::$params);
			$users = array();
			foreach ($clients as $client) {
				$focus_ids = explode(',', $client->focus_id);
				if (!empty($focus_ids) && in_array($userId, $focus_ids)) {
					$users[]= $client->username;
				}
			}
			
			DTExpression::$params = array();
			DTExpression::$limit = '';
			DTExpression::$sql = ' 1=1 ';
			DTOrder::$sql = '';
			
			//所有预约信息
			DTExpression::in('name', $users);
			DTExpression::page($_REQUEST);
			$reseruser = R::find('reseruser', DTExpression::$sql. DTExpression::$limit, DTExpression::$params);
			$data =array();
			foreach ($reseruser as $bean) {
				$user = new ReserUser();
				$user->generateFromRedBean($bean);
				$data[] = $user;
			}
			
			$this->msgPut(true, 'success', $data, 0);
		} else {
			$this->msgPut(false, '缺少参数id.', null, 1);
		}
	}
	
	/**
	 * 获取登录用户所关注的所有客户咨询信息
	 * 
	 * */
	protected function __getClientList() {
		new ClientService();
		$userId = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
		if ($userId) {
			DTExpression::like('focus_id', $userId);
			$clients = R::find('client', DTExpression::$sql, DTExpression::$params);
			$users = array();
			foreach ($clients as $client) {
				$focus_ids = explode(',', $client->focus_id);
				if (!empty($focus_ids) && in_array($userId, $focus_ids)) {
					$users[]= $client->username;
				}
			}
				
			DTExpression::$params = array();
			DTExpression::$limit = '';
			DTExpression::$sql = ' 1=1 ';
			DTOrder::$sql = '';
			
			//所有预约信息
			DTExpression::in('username', $users);
			DTExpression::page($_REQUEST);
			
			$result = R::find('client', DTExpression::$sql. DTExpression::$limit, DTExpression::$params);
			
			$data =array();
            foreach ($result as $k => $bean) {
	            $entity = new Client();
	            $entity->generateFromRedBean($bean);
	            
	            $entity->date = date('Y-m-d', $entity->date);
	            
	            //科室
	            $department = R::load(TABLENAME_DEPARTMENTMANAGER, $entity->department_id);
	            $entity->department_name = $department->name;
	            
	            //医生
	            $doctor = R::load(TABLENAME_DOCTORMANAGER, $entity->doctor_id);
	            $entity->doctor_name = $doctor->name;
	            
	            //渠道
	            $source = R::load('patientdatasource', $entity->source);
	            $entity->source_name = $source->title;
	            
	            //咨询员
	            $reception = R::load('patientreceptionist', $entity->reception_id);
	            $entity->reception_name = $reception->user_name;
	            
	            $data[] = $entity;
            }
				
			$this->msgPut(true, 'success', $data, 0);
		} else {
			$this->msgPut(false, '缺少参数id.', null, 1);
		}
	}
	
	
}
new User();