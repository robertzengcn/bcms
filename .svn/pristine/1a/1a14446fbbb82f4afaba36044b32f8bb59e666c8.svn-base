<?php

/**
 * 在线问答(追问)流程控制器
 * @author Administrator
 *
 */
class AskAddtoController extends Controller {

    private $service = null;

    /**
     * 构造方法
     * 实例化基类并实例化service层,并将其赋值给service属性
     */
    public function __construct() {
        parent::__construct();
        $this->service = new AskAddtoService();
        // .载入标签解析以及smarty基础
        require_once ABSPATH . '/dynapage/Tag.php';
        require_once ABSPATH . '/lib/smarty/Smarty.class.php';
    }

    /**
     * 数据安全验证、登录检测
     *
     * @see controller/Controller::filter()
     */
    public function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        return $filterService->execute();
    }

    /**
     * 在线问题追问与回复方法[用户]
     */
    public function addtoUser() {
        $this->blindParams($askAddto = new AskAddto());
        $Result = $this->service->addto($askAddto);
        // 输出,测试阶段采取跳转,正式采取json输出,前端保证无刷新添加回复
        echo "<script type='text/javascript'>location.href='/zaixianwenda/" . $Result->ansID . ".html?v=" . rand(10000, 99999) . "';</script>";
    }

    /**
     * 在线问题追问与回复方法[医生]
     */
    public function addtoDoc() {
        $this->blindParams($askAddto = new AskAddto());
        $Result = $this->service->addto($askAddto);
        $push=$this->getRequest('push', 0);
        
        $askid= $this->getRequest('askID',0);  
        $content=$this->getRequest('content','');              
        global $controller;
        $controller->notify('NOTIFY_ASK_ADDTO',array('push'=>$push,'askid'=>$askid,'type'=>0,'content'=>$content));
        die(json_encode(new Result(true, 0, '', $Result)));
    }
}
