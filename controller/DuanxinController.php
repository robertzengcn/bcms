<?php

/**
 * 北科短信模块流程控制器
 * @author Administrator
 *
 */
class DuanxinController extends Controller {
	
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
	 * @param $_REQUEST ['mobile'] 手机号
	 * @param $_REQUEST ['content'] 内容
	 * 
	 * @return json
	 * 
	 */
	public function sendmessage() {
		
		if (isset ( $_REQUEST ['mobile'] ) && strlen ( $_REQUEST ['mobile'] ) > 0) {
			$mobile = $_REQUEST ['mobile'];
		} else {
			echo json_encode ( array (
					'stute' => false,
					'msg' => '缺少有效的手机号参数',
					'code' => 1,
					'data' => null 
			) );
			exit ();
		}
		if (isset ( $_REQUEST ['content'] ) && strlen ( $_REQUEST ['content'] ) > 0) {
			$content = $_REQUEST ['content'];
		} else {
			echo json_encode ( array (
					'stute' => false,
					'msg' => '不能发送内容为空的短信',
					'code' => 1,
					'data' => null 
			) );
			exit ();
		}
        $result=$this->getduanxinconfig();//获取短信配置
		
		$url = $result['url'];
		$cid = $result['cid'];
		$pwd = $result['pwd'];
		$cell = $result['cell'];
		if($url==null||$cid==null||$pwd==null||$cell==null){
			echo json_encode ( array (
					'stute' => false,
					'msg' => '接口参数配置错误，请检查',
					'code' => 2,
					'data' => null
			) );
			exit ();
		}
		$duanxinser = new DuanxinService ( $url, $cid, $pwd, $cell );
		$i=0;
		if ($this->isInString1 ( $mobile, ',' )) { // 如果是多个手机号码
			$mobilearr = explode ( ',', $mobile );
			
			foreach ( $mobilearr as $key => $value ) { // 验证是否为手机号
				
				if (preg_match ( "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}/", $value )) {
					$i+=$duanxinser->sendNormalMessage ( $mobile, $content ); // 发送短信
					
				}
			}
		} else { // 如果只有一个手机号码
			$i=$duanxinser->sendNormalMessage ( $mobile, $content );
			
		}
		
		echo json_encode ( array (
				'statu' => true,
				'msg' => '成功发送'.$i.'条信息',
				'code' => 0,
				'data' => null 
		) );
		exit ();
	}
	
	/**
	 * 更新短信接口信息
	 * @param $_REQUEST ['url'] 
	 * @param $_REQUEST ['cid']
	 * @param $_REQUEST ['pwd']
	 * @param $_REQUEST ['cell']
	 * 
	 * 
	 */
	public function updateduanxin() {
		if (isset ( $_REQUEST ['url'] ) && strlen ( $_REQUEST ['url'] ) > 0) {
			$url = $_REQUEST ['url'];
			if (! filter_var ( $url, FILTER_VALIDATE_URL )) {
				echo json_encode ( array (
						'statu' => false,
						'msg' => '接口url不合法',
						'code' => 1,
						'data' => null 
				) );
				exit ();
			}
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
		
		if (isset ( $_REQUEST ['cell'] ) && strlen ( $_REQUEST ['cell'] ) > 0) {
			$cell = $_REQUEST ['cell'];
		} else {
			echo json_encode ( array (
					'statu' => false,
					'msg' => '缺少cell参数',
					'code' => 1,
					'data' => null 
			) );
			exit ();
		}
		
		$contectser = new ContactService ();
		$contectser->updatemsg_url ( array (
				'val' => $url 
		) );
		$contectser->updatemsg_cid ( array (
				'val' => $cid 
		) );
		$contectser->updatemsg_pwd ( array (
				'val' => $pwd 
		) );
		$contectser->updatemsg_cell ( array (
				'val' => $cell 
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
// 		$contectser = new ContactService ();
// 			$celldata=$contectser->getContact('msg_cell')->data;
// 		if($celldata->val){
// 			$cell=$celldata->val;
// 		}else{
// 			$cell=null;
// 		}
// 		$urldata=$contectser->getContact('msg_url')->data;
// 		if($urldata->val){
// 			$url=$urldata->val;
// 		}else{
// 			$url=null;
// 		}
// 		$pwddata=$contectser->getContact('msg_pwd')->data;
// 		if($pwddata->val){
// 			$pwd=$pwddata->val;
// 		}else{
// 			$pwd=null;
// 		}
// 		$ciddata=$contectser->getContact('msg_cid')->data;
// 		if($ciddata->val){
// 			$cid=$ciddata->val;
// 		}else{
// 			$cid=null;
// 		}
$result=$this->getduanxinconfig();
		
		echo json_encode ( array (
				'statu' => true,
				'msg' => null,
				'code' => 0,
				'data' => $result
		) );
		exit ();
		
	}
	/**
	 * 获取短信配置
	 * */
	public function getduanxinconfig(){
		$contectser = new ContactService ();
		$celldata=$contectser->getContact('msg_cell')->data;
		if($celldata->val){
			$cell=$celldata->val;
		}else{
			$cell=null;
		}
		$urldata=$contectser->getContact('msg_url')->data;
		if($urldata->val){
			$url=$urldata->val;
		}else{
			$url=null;
		}
		$pwddata=$contectser->getContact('msg_pwd')->data;
		if($pwddata->val){
			$pwd=$pwddata->val;
		}else{
			$pwd=null;
		}
		$ciddata=$contectser->getContact('msg_cid')->data;
		if($ciddata->val){
			$cid=$ciddata->val;
		}else{
			$cid=null;
		}
		return array('url'=>$url,'cid'=>$cid,'pwd'=>$pwd,'cell'=>$cell);
	}
}
