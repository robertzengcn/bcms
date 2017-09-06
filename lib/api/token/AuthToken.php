<?php
require_once 'AuthTokenAbstract.php';
require_once 'AuthTokenInterface.php';
class AuthToken extends  AuthTokenAbstract implements AuthTokenInterface
{
    /**
     * 密钥
     * */
    private $_secret = 'boyicms!@#20170627';
    
    /**
     * api_token的有效性
     * */
    private $_api_token = false;
    
    public function __construct()
    {
    	parent::__construct();
    }
    
    /**
     * function authApiToken()
     * 
     * 保持接口访问的隐蔽性和有效性，保证接口只能给自家人用
     * 
     * token = md5 (方法名 + 时间撮 + 密钥)
     * 
     * */
    public function authApiToken($method, $time, $api_token, &$msg = '')
    {
        if (empty($method)) {
            $msg = '参数method不能为空！';
        	return false;
        }
        
        if (empty($api_token)) {
            $msg = '参数api_token不能为空！';
        	return false;
        }
        
    	$api_token_server = $this->getApiToken($method, $time);
    	if ($api_token != $api_token_server) {
    	    $msg = 'api_token验证失败，系统拒绝访问！';
    		return false;
    	}
    	
    	$this->_api_token = true;
    	return true;
    }
    
    /**
     * function authUserToken()
     * 
     * 保护用户的用户名及密码多次提交，以防密码泄露
     * 
     * token=md5(用户id + 当前时间)
     * 
     * */
    public function authUserToken($user_token, &$msg = '')
    {
        //检测 api_token的有效性；
        if (!$this->_api_token) {
            $msg = '请先验证api_token的有效性';
        	return false;
        }
        
        if (empty($user_token)) {
            $msg = 'user_token不能为空';
        	return false;
        }
        
        //删除过期的 user_token 表记录；
        $this->delExpireUserToken();
        
        //根据user_token 获取表记录，如果表记录不存在，直接返回错误，如果记录存在，则进行下一步；
        $user = $this->getUserToken($user_token);
        if (empty($user) || empty($user->id)) {
            $msg = 'user_token验证失败或已过期，系统拒绝访问！';
        	return false;
        }
        
        if ($user_token != $user->token) {
            $msg = 'user_token验证失败，系统拒绝访问！';
            return false;
        }
        
        session_start();
        $_SESSION['work_id']=$user->user_id;
            
        //更新 user_token 的过期时间（延期，保证其有效期内连续操作不掉线）；
        $this->updateUserExpireTime($user->user_id, $time);
        setcookie('work_id', $user->user_id, $user->expire_time);
        
        //返回接口数据；
        return $user->token;
    }
    
    /**
     * function getSecret()
     * 
     * 获取密钥
     * 
     * */
    public function getSecret()
    {
    	return $this->_secret;
    }
    
    /**
     * function getApiToken()
     * 
     * 获取token值，token = md5 (方法名 + 时间撮 + 密钥) 
     * 当前日期： 2017-06-21
     * */
    public function getApiToken($method, $time)
    {
        $secret = $this->getSecret();
    	return md5($method . $time . $secret);
    }
    
    /**
     * 
     * function setLoginToken()
     * 
     * 登录之后写入token
     * 
     * */
    protected function setLoginToken($user_id, $time)
    {
        //删除过期token
        $this->delExpireUserToken();
        
        $userToken = $this->getUserTokenByUid($user_id);
        if (empty($userToken) || empty($userToken->id)) {
            $userToken = $this->saveUserToken($user_id, $this->_secret);
        } else {
            $userToken = $this->updateUserExpireTime($user_id, $time);
        }
        
        return $userToken->token;
    }
    
    /**
     * function userLogin()
     * 
     * 用户登录
     * 
     * */
    public function userLogin($username, $password, $time, &$msg = '')
    {
        if (empty($username) || empty($password)) {
            $msg = '用户名或密码不能为空';
        	return false;
        }
        
    	$user = $this->getUser($username, $password);
    	if (empty($user) || empty($user->id))
    	{
    	    $msg = '用户名或密码有误！';
    	    return false;
    	}
    	
    	//写入usertoken数据
    	$user_token_server = $this->setLoginToken($user->id, $time);
    	
    	return array('token'=>$user_token_server, 'id'=>$user->id);
    }
    
    /**
     * function ssoLogin()
     * 
     * 用户单点登录
     * sso_token = md5(用户id + 时间撮 + 密钥)
     * */
    public function ssoLogin($user_id, $time, $sso_token, &$msg = '')
    {
        if (empty($user_id)) {
        	$msg = '参数user_id不能为空';
        	return false;
        }
        
        if (empty($time)) {
            $msg = '参数time不能为空';
            return false;
        }
        
        if (empty($sso_token)) {
            $msg = '参数sso_token不能为空';
            return false;
        }
        
        $user = $this->getUserById($user_id);
        if (empty($user) || empty($user->id))
        {
            $msg = '用户不存在！';
            return false;
        }
        
        $sso_token_server = $this->getSSOToken($user_id, $time);
        if ($sso_token != $sso_token_server) {
        	$msg = 'sso_token有误，单点登录失败';
        	return false;
        }
        
        //写入usertoken数据
        $user_token_server = $this->setLoginToken($user_id, $time);
        
        //写入session以便访问其它页面不受限制
        
        return $user_token_server;
    }
    
    /**
     * function getSSOToken
     * 
     * 获取用户ssotoken
     * token = md5(用户名id + 时间撮 + 密钥)
     * 
     * */
    protected function getSSOToken($user_id, $time)
    {
    	return $token_server = md5($user_id . $time . $this->_secret);
    }
}