<?php
/**
 * 所有接口必须通过api_token验证之后方可进行其它的验证或操作
 * 涉及到密码相关的必须以md5加密后传值，不可出现明文密码
 * 用户登录后会返回一个user_token值，以  $this->getUserToken(); 获取并返回给接口调用方
 * 
 * 时间撮（time） :必须
 * 
 * 所有接口的api_token验证：api_token=md5(方法名 + 时间撮 + 密钥)
 * 已登录用户验证(接口直接返回的，不需要调用方计算)：user_token=md5(用户id + 时间撮 + 密钥)
 * 用户单点登录：sso_token=md5(用户id + 时间撮 + 密钥)
 * 用户普通登录：token=md5(用户名 + 密码 + 时间撮 + 密钥)，登录后返回user_token供以后调用
 * 
 * 获取Request对像: $request = $this->getRequest();
 * 使用： $request->参数名; 或   $getRequest('参数名','默认值【可选】'); 
 * 设置：$request->set($key, $value);
 * 
 * */
require_once $_SERVER ['DOCUMENT_ROOT'] . '/web-setting.php';
require_once KERNELPATH . '/Result.php';
require_once DAOPATH . '/ORMMap.php';
require_once KERNELPATH . '/ErrorMsgs.php';
require_once KERNELPATH . '/LogMsgs.php';
require_once KERNELPATH . '/FilterService.php';
require_once DAOPATH . '/DTExpression.php';
require_once DAOPATH . '/DTOrder.php';
require_once ABSPATH . '/lib/rb.php';
require_once ABSPATH . '/lib/api/token/AuthToken.php';

header("Content-type: text/html; charset=utf-8");

abstract class InterfaceAbstract
{
    private $authToken = null;
    
    public $msg = '';
    
    public $user_token = '';
    
	public function __construct($needAuthUser = false)
	{
	    if (isset(R::$currentDB) && R::$currentDB != 'default') {
	        R::setup('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASSWORD);
	    }
	    
	    // 开启freeze
	    R::freeze(false);
	    
	    //error_log(var_export($_REQUEST, true) . PHP_EOL, 3, '/tmp/log');
	    if ($this->filter() === false) {
	        $this->msgPut(false, '不安全的数据', '');
	    }
	    
	    spl_autoload_register ( array ('InterfaceAbstract','load') );
	    
	    $this->authToken = $this->getAuthToken();
	    
	    //api验证
	    $this->authAPI();
	    
	    //用户验证，根据需要验证
	    if ($needAuthUser) {
	        if(!session_id()) session_start();
	        if(!isset($_SESSION['work_id'])||!$_SESSION['work_id']){//如果没有验证过token
	            if(isset($_REQUEST['method'])&&$_REQUEST['method']!='login'){
	                $user_token = $this->getRequest('token', '');
	                $this->authUser($user_token);
	            }
	        }
	    }
	    
	    $this->_begin();
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
	
	//入口
	abstract public function _begin();
	
	//敏感信息过滤
	private function filter() {
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
	
	// .执行信息输出
	public function msgPut($statu, $msg, $data, $code = 0) {
	    die ( json_encode ( array (
	        'statu' => $statu,
	        'msg' => $msg,
	        'data' => $data,
	        'code' => ( int ) $code
	    ), true ) );
	  
	} 
	
	//获取Request对象
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
	
	//获取AuthToken对象
	public function getAuthToken()
	{
		return new AuthToken();
	}
	
	//api接口验证
	public function authAPI()
	{
	    $method = $this->getRequest('method', '');
	    $time = $this->getRequest('time', '');
	    $api_token = $this->getRequest('api_token', '');
	    $result = $this->authToken->authApiToken($method, $time, $api_token, $this->msg);
	    if (!$result) {
	    	$this->msgPut(false, $this->msg, '');
	    }
	}
	
	//用户验证
	public function authUser($user_token)
	{
	    $new_user_token = $this->authToken->authUserToken($user_token, $this->msg);
	    if (!$new_user_token) {
	        $this->msgPut(false, $this->msg, '');
	    }
	    
	    //验证通过之后返回user_token，保持登录状态
	    $this->user_token = $new_user_token;
	}
	
	//单点登录
	public function ssoLogin()
	{
	    $user_id = $this->getRequest('user_id', '');
	    $time = $this->getRequest('time', '');
	    $sso_token = $this->getRequest('sso_token', '');
		$new_user_token = $this->authToken->ssoLogin($user_id, $time, $sso_token, $this->msg);
		if (!$new_user_token) {
		    $this->msgPut(false, $this->msg, '');
		}
		
		//验证通过之后返回user_token，保持登录状态
		$this->user_token = $new_user_token;
		$this->msgPut(true, $this->msg, $new_user_token);
	}
	
	//用户登录
	public function userLogin()
	{
	    $username = $this->getRequest('username', '');
	    $password = $this->getRequest('pwd', ''); //以md5形式传值
	    $time = $this->getRequest('time', '');
	    
	    $result = $this->authToken->userLogin($username, $password, $time, $this->msg);
	    if (!$result) {
	        $this->msgPut(false, $this->msg, '');
	    }
	    
	    //验证通过之后返回id和user_token，保持登录状态
	    $this->user_token = $result['token'];
	    $this->msgPut(true, 'success', $result, 0);
	}
	
	//获取验证之后的user_token
	public function getUserToken()
	{
		return $this->user_token;
	}
	
	/**
	 * 总控用户验证方法
	 */
	public function getRemoteUser() {
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
}