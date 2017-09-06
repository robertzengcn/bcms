<?php

/**
 * 在线问答模块流程控制器
 * @author Administrator
 *
 */
class WuxianController extends Controller {
	
	/**
	 * 构造方法
	 * 实例化基类并实例化service层,并将其赋值给service属性
	 */
	public function __construct() {
		parent::__construct ();
	}
	/**
	 * 数据安全验证、登录检测
	 *
	 * @see controller/Controller::filter()
	 */
	public function filter() {
		$filterService = new FilterService ();
		$filterService->addFunc ( $filterService::$SQLINJECTION );
		$filterService->addFunc ( $filterService::$FILERPLUSHTIME );
		$filterService->addFunc ( $filterService::$WORKERISLOGIN );
		$filterService->addFunc ( $filterService::$WORKERLOGHISTORY );
		return $filterService->execute ();
	}
	
	/**
	 * 发送短信内容
	 * @param $_REQUEST ['mobile'] 短信接收人手机号
	 * @param $_REQUEST ['content'] 短信内容
	 * 
	 */
	public function sendmessage() {
		
		if (isset ( $_REQUEST ['mobile'] ) && strlen ( $_REQUEST ['mobile'] ) > 0) {
			$mobile = $_REQUEST ['mobile'];
		} else {
			echo json_encode ( array (
					'statu' => false,
					'msg' => '缺少mobile参数',
					'code' => 1,
					'data' => null 
			) );
			exit ();
		}
		if (isset ( $_REQUEST ['content'] ) && strlen ( $_REQUEST ['content'] ) > 0) {
			$content = $_REQUEST ['content'];
		} else {
			echo json_encode ( array (
					'statu' => false,
					'msg' => '缺少content参数',
					'code' => 1,
					'data' => null 
			) );
			exit ();
		}
		$contectser = new ContactService ();
		$url = $contectser->getwuxianip()->val;
		$cid = $contectser->getwuxianaccount()->val;
		$pwd = $contectser->getwuxianpassword()->val;
		
		if($url==null||$cid==null||$pwd==null){
			echo json_encode ( array (
					'statu' => false,
					'msg' => '接口参数配置错误，请检查',
					'code' => 2,
					'data' => null
			) );
			exit ();
		}
		
		$wuxianser = new WuxianService ( $url, $cid, $pwd);
		
		if ($this->isInString1 ( $mobile, ',' )) { // 如果是多个手机号码
			$mobilearr = explode ( ',', $mobile );
			
			foreach ( $mobilearr as $key => $value ) { // 验证是否为手机号
				
				if (!preg_match ( "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}/", $value )) {
							echo json_encode ( array (
				'statu' => false,
				'msg' => '请检查手机号码:'.$value.' 格式是否正确',
				'code' => 1,
				'data' => null 
		) );
		exit ();
					
				}
			}
		} else { // 如果只有一个手机号码
			if (!preg_match ( "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}/", $mobile )) {
				echo json_encode ( array (
						'statu' => false,
						'msg' => '请检查手机号码:'.$mobile.' 格式是否正确',
						'code' => 1,
						'data' => null
				) );
				exit ();
					
			}						
		}
		
		$result=$wuxianser->sendNormalMessage ( $mobile, $content );
		echo json_encode ($result);
		exit ();
	}
	
	/**
	 * 更新短信接口信息
	 * 
	 * @param $_REQUEST ['url'] ip:port 例如 43.243.130.33:8860
	 * @param $_REQUEST ['cid'] 账号
	 * @param $_REQUEST ['pwd'] 密码
	 * 
	 */
	public function updateduanxin() {
		if (isset ( $_REQUEST ['url'] ) && strlen ( $_REQUEST ['url'] ) > 0) {
			$url = $_REQUEST ['url'];

		} else {
			echo json_encode ( array (
					'statu' => false,
					'msg' => '缺少url参数',
					'code' => 1,
					'data' => null 
			) );
			exit ();
		}
		if (isset ( $_REQUEST ['cid'] ) && strlen ( $_REQUEST ['cid'] ) > 0) {
			$cid = $_REQUEST ['cid'];
		} else {
			echo json_encode ( array (
					'statu' => false,
					'msg' => '缺少cid参数',
					'code' => 1,
					'data' => null 
			) );
			exit ();
		}
		
		if (isset ( $_REQUEST ['pwd'] ) && strlen ( $_REQUEST ['pwd'] ) > 0) {
			$pwd = $_REQUEST ['pwd'];
		} else {
			echo json_encode ( array (
					'statu' => false,
					'msg' => '缺少pwd参数',
					'code' => 1,
					'data' => null 
			) );
			exit ();
		}
		

		
		$contectser = new ContactService ();
		$contectser->updatewuxian_url ( array (
				'val' => $url 
		) );
		$contectser->updatewuxian_account ( array (
				'val' => $cid 
		) );
		$contectser->updatewuxian_pass ( array (
				'val' => $pwd 
		) );

		echo json_encode ( array (
				'statu' => true,
				'msg' => null,
				'code' => 0,
				'data' => null 
		) );
		exit ();
	}
	
	/**
	 * 检查是否含有某个字符串的方法
	 */
	public function isInString1($haystack, $needle) {
		// 防止$needle 位于开始的位置
		$haystack = '-_-!' . $haystack;
		return ( bool ) strpos ( $haystack, $needle );
	}
	
	/**
	 * 获取短信接口配置
	 */
	public function getconfig() {
		$contectser = new ContactService ();
		$url = $contectser->getwuxianip()->val;
		$cid = $contectser->getwuxianaccount()->val;
		$pwd = $contectser->getwuxianpassword()->val;
		
		
		echo json_encode ( array (
				'statu' => true,
				'msg' => null,
				'code' => 0,
				'data' => array('url'=>$url,'cid'=>$cid,'pwd'=>$pwd)
		) );
		exit ();
		
	}
	
	/**
	 * 查询短信余额
	 * */
	public function checkbalance(){
		$contectser = new ContactService ();
		$url = $contectser->getwuxianip()->val;
		$cid = $contectser->getwuxianaccount()->val;
		$pwd = $contectser->getwuxianpassword()->val;
		
		if($url==null||$cid==null||$pwd==null){
			echo json_encode ( array (
					'statu' => false,
					'msg' => '接口参数配置错误，请检查',
					'code' => 2,
					'data' => null
			) );
			exit ();
		}
		
		$wuxianser = new WuxianService ( $url, $cid, $pwd);
		$result=$wuxianser->checkbalance();
		echo json_encode($result);exit();
		
	}
}
