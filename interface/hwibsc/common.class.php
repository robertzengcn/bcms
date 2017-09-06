<?php
/**
 * 
 * 问答接口基类文件
 * @author Administrator
 *
 */
ob_start ();
// .装载必须
require_once $_SERVER ['DOCUMENT_ROOT'] . '/web-setting.php';
require_once DAOPATH . '/ORMMap.php';
require_once KERNELPATH . '/Result.php';
require_once KERNELPATH . '/ErrorMsgs.php';
require_once KERNELPATH . '/LogMsgs.php';
require_once KERNELPATH . '/FilterService.php';
require_once DAOPATH . '/DTExpression.php';
require_once DAOPATH . '/DTOrder.php';
require_once ABSPATH . '/controller/Controller.php';
class common {
	private $logo = 'hwibs';
	
	// .构造函数
	public function __construct() {
	    error_log(var_export($_REQUEST, true) . PHP_EOL, 3, '/tmp/log');
		if ($this->filter () === false) {
			$this->msgPut ( 2, '参数提交未通过安全验证.', null );
		}
		
		spl_autoload_register ( array (
				'common',
				'load' 
		) );
		

	}
	
	// .执行sign检查
	public function signCheck() {
		$sign = $this->posts ['sign'];
		$md5 = md5 ( $this->logo . $this->posts ['time'] . $this->posts ['domain'] );
		if ($sign != $md5) {
			$this->msgPut ( 1, '加密字符串无法通过验证.', null );
		}
	}
	
	// .自动加载
	public function load($class) {
		if (strpos ( $class, 'Service' ) !== false) {
			$file_path = KERNELPATH . $class . '.php';
		} elseif (strpos ( $class, 'DAO' ) !== false) {
			$file_path = DAOPATH . $class . '.php';
		} elseif (strpos ( $class, 'Model_' ) !== false) {
			$file_path = false;
		} elseif (strpos ( $class, 'Smarty' ) !== false) {
			$file_path = strtolower ( ABSPATH . '/lib/smarty/sysplugins/' . $class . '.php' );
		} elseif (strpos ( $class, 'Tag' ) !== false && $class == 'Tag') {
			$file_path = ENTITYPATH . $class . '.php';
		} elseif (strpos ( $class, 'Tag' ) !== false) {
			$file_path = ABSPATH . '/tagobj/' . $class . '.php';
		} elseif (strpos ( $class, 'Exception' )) {
			$file_path = KERNELPATH . '/exception/' . $class . '.php';
		} else {
			$file_path = ENTITYPATH . $class . '.php';
		}
		if ($file_path) {
			if (file_exists ( $file_path )) {
				require_once $file_path;
			} else {
				exit ( $file_path . '文件不存在!' );
			}
		}
	}
	
	// .绑定实体参数
	public function bind($entity) {
		foreach ( $entity as $key => $value ) {
			if (isset ( $_REQUEST [$key] )) {
				$entity->$key = $_REQUEST [$key];
			}
		}
	}
	
	// .执行信息输出
	public function msgPut($status, $msg, $data, $code = null) {
		die ( json_encode ( array (
				'status' => $status,
				'msg' => $msg,
				'data' => $data,
				'code' => ( int ) $code 
		) ) );
	}
	
	// .执行参数提交安全检查
	public function filter() {
		$getfilter = "'|<[^>]*?>|^\\+\/v(8|9)|\\b(and|or)\\b.+?(>|<|=|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
		$postfilter = "^\\+\/v(8|9)|\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|<\\s*img\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
		$cookiefilter = "\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
		foreach ( $_GET as $key => $value ) {
			if (! $this->stopAttack ( $key, $value, $getfilter )) {
				return false;
			}
		}
		foreach ( $_POST as $key => $value ) {
			if (! $this->stopAttack ( $key, $value, $postfilter )) {
				return false;
			}
		}
		foreach ( $_COOKIE as $key => $value ) {
			if (! $this->stopAttack ( $key, $value, $cookiefilter )) {
				return false;
			}
		}
		return true;
	}
	private function stopAttack($StrFiltKey, $StrFiltValue, $ArrFiltReq) {
		$StrFiltValue = $this->arrForeach ( $StrFiltValue );
		if (preg_match ( "/" . $ArrFiltReq . "/is", $StrFiltValue ) == 1) {
			return false;
		}
		if (preg_match ( "/" . $ArrFiltReq . "/is", $StrFiltKey ) == 1) {
			return false;
		}
		return true;
	}
	private function arrForeach($arr) {
		static $str;
		if (! is_array ( $arr )) {
			return $arr;
		}
		foreach ( $arr as $key => $val ) {
			if (is_array ( $val )) {
				$this->arr_foreach ( $val );
			} else {
				$str [] = $val;
			}
		}
		return implode ( $str );
	}
	/**
	 * 总控用户验证方法
	 */
	protected function getuser() {
		if (! isset ( $_SESSION )) {
			session_start ();
		}
			$token = $this->getRequest ( 'token', '' );			
		if ($token) {
			try {
				$error_log = GENERATEPATH . 'log/account_error.log';
				
				$url = "http://www.boyicms.com/interface/hma/HmaAccountInterface.php?type=logincheck";
				$post_data = array (
						"token" => $token 
				);
				
				$ch = curl_init ();
				curl_setopt ( $ch, CURLOPT_URL, $url );
				curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt ( $ch, CURLOPT_POST, 1 );
				curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
				$data = curl_exec ( $ch );
				curl_close ( $ch );
			} catch ( Exception $e ) {
				error_log ( date ( 'Y-m-d H:i:s' ) . ' send userlogin error:' . $e->getMessage () . PHP_EOL, 3, $error_log );
			}
			$obj = json_decode ( $data );
			
			if ($obj->code == 1) {
				
				$datearray = array (
						'username' => $obj->data->username,
						'user_alis'=>$obj->data->user_id
				);
				
				$memberser = new MemberService ();
				$result = $memberser->getmemberbyname ( $datearray );
				// $result=$this->getServiceMethod( 'Member' , 'getmemberbyname' , $datearray );
				
				if (! empty ( $result )) {
					
					$_SESSION ['user'] = $result ['username'];
					$_SESSION ['member_id'] = $result ['id'];
					$_SESSION ['member_mobile'] = $obj->data->mobile;
				} else {
					$results = $memberser->addmember ( $datearray );
					
					$_SESSION ['user'] = $results->data->username;
					$_SESSION ['member_id'] = $results->data->id;
				}
			} else {
				$this->msgPut ( false, '登录失败，账号密码错误', null, 15 );
			}
		}
	}
	
	/**
	 * Request数据处理
	 */
	final public function getRequest($name = '', $default = '') {
		if (! empty ( $name )) {
			if (isset ( $_REQUEST [$name] ) && strlen ( $_REQUEST [$name] ) > 0) {
				return $_REQUEST [$name];
			} else {
				return $default;
			}
		}
		
		return $_REQUEST;
	}
	/**
	 * 检查数据是否存在，不存在则停止
	 */
	final public function checkRequest($name = '') {
		if (! empty ( $name )) {
			if (isset ( $_REQUEST [$name] ) && strlen ( $_REQUEST [$name] ) > 0) {
				return $_REQUEST [$name];
			} else {
				
				die ( json_encode ( array (
						'statu' => false,
						'msg' => '参数为空',
						'code' => 1,
						'data' => null 
				) ) );
			}
		}
		
		die ( json_encode ( array (
				'statu' => false,
				'msg' => '缺少参数',
				'code' => 2,
				'data' => null 
		) ) );
	}
}