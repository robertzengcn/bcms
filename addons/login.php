<?php
//载入入口文件
include_once 'addons.php';
/**
 * 
 * 积分商城
 * @author Administrator
 *
 */
class LoginAddons extends Addons {

	public $action  = 'addons';	//模块名称
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}

	//登录
	public function login(){
		$this->_publicData();	
		$this->smarty->display( 'Commodity/login' . TPLSUFFIX );			
	}
	//注册
	public function register(){
		$this->_publicData();	
		$this->smarty->display( 'Commodity/reg' . TPLSUFFIX );			
	}
	//获取手机注册验证码
	public function getRegisterVerifyCode(){	
		$user_mobile = $_POST['mobile'];	
		if($user_mobile == ''){
			$data['status'] = 0;
			$data['info'] = "请输入手机号";
			echo json_encode($data);
			exit;
		}		
			$contectser = new ContactService ();
			$url = $contectser->getmsgurl ()->val;
			$cid = $contectser->getmsgcid ()->val;
			$pwd = $contectser->getmsgpwd ()->val;
			$cell = $contectser->getmsgcell ()->val;
			$duanxinser = new DuanxinService ( $url, $cid, $pwd, $cell );
			$result=$duanxinser->sendAuthCode( $user_mobile); // 发送短信
			
		if($result){
			$data['status'] = 1;
			$data['info'] = "验证短信已经发送，请注意查收";
		}else{
			$data['status'] = 0;
			$data['info'] = "验证短信发送失败";	
		}
		echo json_encode($data);			
	}
	//登录验证/处理
	public function userLogin(){
		$mobile	= $_POST['mobile'];
		$password	= $_POST['password'];
		$i= $_POST['remember'] ? $_POST['remember'] : '';
			$data['status'] = 0;
		if($mobile=='' || $password==''){
			$data['info'] = "手机或者密码不能为空";
			echo json_encode($data);
			exit;			
		}
		if(!preg_match("/^(1[34578]\d{9})$/i", $mobile)){
			$data['info'] = "手机号码格式错误";
			echo json_encode($data);
			exit;		
		}
		$memberser=new MemberService();
		$where['username'] = $mobile;
		$where['password'] = md5($password);
		$where['source'] = 'market';			
		$result=$memberser->docheck($where);	
		if($result->statu){
			$this->setLoginCookie($i);		
			$data['status'] = 1;
			$data['info'] = "登录成功";
			$data['jump'] = NETADDRESS . '/'. $this->action .'/commodity.php?method=index';
		}else{				
			$data['info'] = "账号或密码错误";
		}
			echo json_encode($data);		
	}
	//手机号/名字验证
	public function checkInfo(){
		if($_POST['mobile']){
			$where['mobile'] = $_POST['mobile'];	
			$msg = "手机号已被使用,请更换";
		}elseif($_POST['username']){
			$where['nickname'] = $_POST['username'];
			$msg = "名字已被使用,请更换";			
		}			
		$obj=$this->getServiceMethod('Member','checkUserExist',$where);
		if($obj){
			$result['status'] = 0;
			$result['info'] = $msg;				
		}else{
			$result['status'] = 1;				
		}
		echo json_encode($result);			
	}

	//短信验证
	public function checkMessageCode(){
		$code = $_POST['code'];
		$scode = $_SESSION['MOBILE_AUTH_CODE'];
		$time = time();
		if(md5($code) == $scode){
		    $result['status'] = 1;
		    $result['info'] = "验证成功";
		}else{
			$result['status'] = 0;
		    $result['info'] = "请输入正确的验证码";
		}
		echo json_encode($result);			
	}

	//注册验证/处理
	public function checkReg(){
			$mobile =  $_POST['telephone'];
			$username  = $_POST['username'];
			$password = $_POST['user_pwd'];
			$scode = $_SESSION['MOBILE_AUTH_CODE'];
			$mob=$this->getServiceMethod('Member','checkUserExist',array('mobile'=>$mobile));
			if($mob){
				$result['status'] = 0;
				$result['info'] = "手机号已被使用,请更换";
				echo json_encode($result);
				exit;
			}
			if(md5($_POST['sms_code'])!=$scode){
				$checkvalue = 0;
				$result['status'] = 0;
				$result['info'] = "短信验证码错误";
				echo json_encode($result);
				exit;
			}
		   $where=array('mobile'=>$mobile,'username'=>$username,'password'=>md5($password),'source'=>'commodity');
		$obj=$this->getServiceMethod('Member','registmember',$where);
		
		if($obj->statu){
			$result['status'] = 1;
			$result['info'] = "注册用户成功";
			$result['jump'] = NETADDRESS . '/'. $this->action .'/commodity.php?method=index';
		}else{
			$result['status'] = 0;
			$result['info'] = $obj->msg;			
		}
		echo json_encode($result);	
	}
	//用户自动登录
	public function setLoginCookie($i){
		if($i==1){
			$mid = $_SESSION['member_id'];
				$remember_key = md5(time().rand(100, 999).$mid);
				$arr = array('user_id'=>$mid,'remember_key'=>$remember_key);
				$arr_str = serialize($arr);
				$losetime = time()+604800;
				$this->_setcookie('INIT_LOGIN',$arr_str,$losetime);   //保存一周时间
				$where = array('user_id'=>$mid,'remember_key'=>$remember_key,'lose_time'=>$losetime);			
				$addkey=$this->getServiceMethod('CommodityKey','addKey',$where);
		}else{
				$this->_setcookie('INIT_LOGIN',NULL);
		}
		
	}
	/**
	 * 
	 * 注入公共数据
	 */
	private function _publicData() {
		/** 注入contact信息  **/
		/** 注入logo icon**/
		$logo = array('shop_logo','shop_icon_72','shop_icon_32');
		$goods_logo=$this->getServiceMethod('PicManager','getLogo',$logo);
		$goods_url = array();
		foreach($goods_logo->data as $key=>$value){
			$goods_url[$key] = UPLOAD . $value->img;
		}
		/** 注入nav **/
		/** 注入轮播图片 **/		
		
		/** 注入url **/
	    $login = NETADDRESS . '/'. $this->action .'/login.php';
		$index = $login . "?method=index";
		$method_url= $login . "?method=";
		$this->smarty->assign('LOGO',$goods_url);
		$this->smarty->assign('INDEX',$index);
		$this->smarty->assign('COMMODITY',$login);
		$this->smarty->assign('METHOD',$method_url);		
	}
	private function _getcookie($name){
		if(empty($name)){return false;}
		if(isset($_COOKIE[$name])){
			return $_COOKIE[$name];
		}else{		
			return false;
		}
	}
	private function _setcookie($name,$value,$time=0,$path='/',$domain=''){		
		if(empty($name)){return false;}
		$_COOKIE[$name]=$value;				//及时生效
		$s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		if(!$time){
			return setcookie($name,$value,0,$path,$domain,$s);
		}else{
			return setcookie($name,$value,time()+$time,$path,$domain,$s);
		}
	}

}
new LoginAddons();
?>