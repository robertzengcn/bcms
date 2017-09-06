<?php

class LoginController extends Controller {

    private $service;

    /**
     * 构造函数
     */
    function __construct() {
    	
        parent::__construct();

       
        $this->service = new WorkerService();
        
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);
        
        return $filterService->execute();
        
        
    }

    /**
     * 判断是否登录
     */
    public function isLogin() {

        if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
            $data = array(
                'group' => $_SESSION['group'],
                'name' => $_SESSION['name'],
                'date' => date('Y年m月d日 H:i:s')
            );
            echo json_encode(new Result(true, 0, '', $data));
        } elseif (isset($_COOKIE['is_login']) && $_COOKIE['is_login']) {
            $workerService = new WorkerService();
            $worker = new Worker();
            $worker->id = $_COOKIE['login_id'];
            $workerService->get($worker);
            $_SESSION['is_login'] = true;
            $_SESSION['id'] = $worker->id;
            $_SESSION['name'] = $worker->name;
            $_SESSION['group'] = $worker->group_id;
            $data = array(
                'group' => $_SESSION['group'],
                'name' => $_SESSION['name'],
                'date' => date('Y年m月d日 H:i:s')
            );
            echo json_encode(new Result(true, 0, '', $data));
        } else {
            echo json_encode(new Result(false, 25, ErrorMsgs::get(25), - 1));
        }
    }

    /**
     * 登陆
     */
    public function login() {
        if (strtolower($_REQUEST['verify']) !== strtolower($_SESSION['verify'])) {
            throw new ValidatorException(155);
        }
        if (! isset($_SESSION['token']) && isset($_SESSION['token']) == '') {
            throw new ValidatorException(156);
        } else {
            if ((int) $_REQUEST['token'] !== $_SESSION['token']) {
                throw new ValidatorException(156);
            }
        }
        $result = $this->service->login();
        if ($result->data) {
            $logService = new LogService();
            $logService->save('登录');
            echo json_encode(new Result(true, 0, '', $result->data->group_id));
        } else {
            echo json_encode(new Result(false, 89, ErrorMsgs::get(89), - 1));
        }
    }
    
    /**
     * 验证验证码是否正确
     */
    public function checkVerify(){
    	if (strtolower($_REQUEST['verify']) !== strtolower($_SESSION['verify'])) {
    		echo json_encode(new Result(false, 0, '', null));
    	}else{
    		echo json_encode(new Result(true, 0, '', null));
    	}
    }

    /**
     * 注销
     */
    public function logout() {
        if (isset($_COOKIE[session_name()])) {
            setCookie(session_name(), '', time() - 3600, '/');
        }
        unset($_SESSION['is_login']);
        unset($_SESSION['name']);
        unset($_SESSION['password']);
        unset($_SESSION['group']);

        setCookie('is_login', '', - 1, '/');
        setCookie('login_id', '', - 1, '/');

        echo json_encode(array(
            'code' => true
        ));
    }
    
	public function isLoginTwo() {

        if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
            $data = array(
                'group' => $_SESSION['group'],
                'name' => $_SESSION['name'],
                'date' => date('Y年m月d日 H:i:s')
            );
            echo json_encode(new Result(true, 0, '', $data));
        } elseif (isset($_COOKIE['is_login']) && $_COOKIE['is_login']) {
            $workerService = new WorkerService();
            $worker = new Worker();
            $worker->id = $_COOKIE['login_id'];
            $workerService->get($worker);
            $_SESSION['is_login'] = true;
            $_SESSION['id'] = $worker->id;
            $_SESSION['name'] = $worker->name;
            $_SESSION['group'] = $worker->group;
            $data = array(
                'group' => $_SESSION['group'],
                'name' => $_SESSION['name'],
                'date' => date('Y年m月d日 H:i:s')
            );
            echo json_encode(new Result(true, 0, '', $data));
        } else {
            echo json_encode(new Result(false, 0, '', - 1));
        }
    }
    
    /**
     * 获取管理用户信息
     */
    public function getLoginUserInfo() {
        $types = array('1'=>'管理员','2'=>'工作人员');
        $data = array(
            'id' => $_SESSION['id'],
            'group' => $_SESSION['group'],
            'name' => $_SESSION['name'],
            'type' => isset($types[$_SESSION['group']])?$types[$_SESSION['group']]:'管理员'
        );
        echo json_encode(new Result(true, 0, '', $data));
    }
    
}