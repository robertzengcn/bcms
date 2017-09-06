<?php
abstract class AuthTokenAbstract
{
    public function __construct()
    {
        if (isset(R::$currentDB) && R::$currentDB != 'default') {
            R::setup('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASSWORD);
        }
        
        // 开启freeze
        R::freeze(false);
    }
    
    /**
     * saveUserToken()
     *
     * 用户登录成功后保存用户的token及过期时间，并返回用户信息
     * 
     * token = md5(用户id + 当前时间  + 密钥);
     *
     * */
    public function saveUserToken($user_id, $secret = '')
    {
        $time = time();
        $array = array(
            'user_id' => $user_id, 
            'token' => md5($user_id.$time.$secret),
            'expire_time' => $time + 3*60*60
        );
        $bean = R::dispense(TABLENAME_USER_TOKEN);
        $bean->import($array);
        R::store($bean);
        
        return $bean;
    }
    
    /**
     * delExpireUserToken()
     *
     * 删除过期的 user_token 表记录
     *
     * */
    public function delExpireUserToken()
    {
         $sql = 'delete from user_token where expire_time-unix_timestamp()<=0';
         R::exec($sql);
    }
    
    /**
     * updateUserExpireTime()
     *
     * 更新的 user_token 表记录，更新过期时间
     *
     * */
    public function updateUserExpireTime($user_id, $time)
    {
         $bean = R::findOne(TABLENAME_USER_TOKEN, 'user_id=:user_id', array('user_id'=>$user_id));
         
         if ($time>$bean->expire_time) {
             $expire = $time + 3*60*60;
             $token = md5($user_id . $time);
             
             $bean->token = $token;
             $bean->expire_time = $expire;
             R::store($bean);
         }
         return $bean;
    }
    
    /**
     *
     *
     * 获取user_token表记录
     *
     * */
    public function getUserToken($user_token)
    {
        return R::findOne(TABLENAME_USER_TOKEN, 'token=:token', array('token'=>$user_token));
    }
    
    /**
     * 根据user_id获取user_token表记录
     * */
    public function getUserTokenByUid($user_id)
    {
        return R::findOne(TABLENAME_USER_TOKEN, 'user_id=:user_id', array('user_id'=>$user_id));
    }
    
    /**
     * function getUserById()
     * 
     * 通过用户id获取用户信息
     * 
     * */
    public function getUserById($user_id)
    {
        $user = R::load('worker', $user_id);
        return $user;
    }
    
    /**
     * function getUser()
     *
     * 用户登录
     *
     * */
    public function getUser($username, $password)
    {
        $password = $this->encodePwd($password);
        $binds = array('name'=>$username, 'telephone'=>$username, 'password'=>$password);
        $user = R::findOne('worker', '(`name` =:name or telephone=:telephone) and password=:password', $binds);
        return $user;
    }
    
    // {{{ public function encode()
    
    /**
     * 编码密码，必须是明文密码
     *
     * @return string
     */
    protected function encodePwd($password)
    {
        return md5($password);
    }
    
    // }}}
    
    /**
     * 访问结束后关闭数据库访问
     * */
    public function __destruct()
    {
    	R::close();
    }
}