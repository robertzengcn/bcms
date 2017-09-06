<?php
define ( 'IS_OPEN_STATIC', false);//是否开启路由 http://网址/v-xxxx
include_once 'addons.php';
/**
 * 
 * 
 * @author Administrator
 *
 */
class ShowAddons extends Addons {

	private $module  = 'addons';	//模块名称
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}

	/**
	 * 
	 * 活动列表
	 */
	public function index() {
		$sysinfo=$this->getServiceMethod('Show','getSys');
		$sysinfo['web_title'] =	$sysinfo['web_title'] ? trim($sysinfo['web_title'] ):'免费移动场景应用自营销管家';
		$sysinfo['is_open_reg'] =	isset($sysinfo['is_open_reg']) ? intval($sysinfo['is_open_reg'] ):1;
		
		$sysinfo['qi_ad_xds'] =	isset($sysinfo['qi_ad_xds']) ? intval($sysinfo['qi_ad_xds'] ):90;
		$this->smarty->assign('sys', $sysinfo); 
		$this->smarty->display( 'Show/index_edit' . TPLSUFFIX );	
	}
	
	public function preview() {	
	
		$sysinfo=$this->getServiceMethod('Show','getSys');
		$this->smarty->assign('sys', $sysinfo);
		
		$appid = $sysinfo['web_appid'];
		$appsecret = $sysinfo['web_appsecret'];
		
		$where['userid_int']  = intval($_SESSION['id']);
		$where['id']  = isset($_REQUEST['id']) ? intval($_REQUEST['id'] ) : 0;	
		$where['delete_int']  = 0;
		$_scene_info=$this->getServiceMethod('Show','sceneDetail',$where);		

		$argu2 = array();
		$argu2['title'] = $_scene_info["scenename_varchar"];
		$argu2['id'] = $_scene_info["id"];
		$argu2['url'] = IS_OPEN_STATIC ?  'v-'.$_scene_info["scenecode_varchar"] : 'addons/show.php?method=preview&id='.$_scene_info["id"];
		$argu2['desc'] = $_scene_info["desc_varchar"];
		$argu2['imgsrc'] = $_scene_info["thumbnail_varchar"];
		
		$this->smarty->assign("confinfo2",$argu2);
		$confinfo = array();
		$mydd= $this->get_client_ip();
		if($appid && $appsecret){
			require_once 'jssdk.php';                       //微信分享
			$jssdk = new JSSDK($appid,$appsecret); 
			$confinfo = $jssdk->GetSignPackage();
		}
		if(empty($confinfo)){
			$confinfo["appId"] = $confinfo["timestamp"] = $confinfo["nonceStr"] =$confinfo["signature"] = '';			
		}
		$this->smarty->assign("confinfo",$confinfo);
		$this->smarty->display( 'Show/index_view' . TPLSUFFIX );	
	}
	

		/**
		 * 获取客户端IP地址
		 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
		 * @param boolean $adv 是否进行高级模式获取（有可能被伪装） 
		 * @return mixed
		 */
		function get_client_ip($type = 0,$adv=false) {
			$type       =  $type ? 1 : 0;
			static $ip  =   NULL;
			if ($ip !== NULL) return $ip[$type];
			if($adv){
				if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
					$pos    =   array_search('unknown',$arr);
					if(false !== $pos) unset($arr[$pos]);
					$ip     =   trim($arr[0]);
				}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
					$ip     =   $_SERVER['HTTP_CLIENT_IP'];
				}elseif (isset($_SERVER['REMOTE_ADDR'])) {
					$ip     =   $_SERVER['REMOTE_ADDR'];
				}
			}elseif (isset($_SERVER['REMOTE_ADDR'])) {
				$ip     =   $_SERVER['REMOTE_ADDR'];
			}
			// IP地址合法验证
			$long = sprintf("%u",ip2long($ip));
			$ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
			return $ip[$type];
		}
		
}

new ShowAddons();
?>