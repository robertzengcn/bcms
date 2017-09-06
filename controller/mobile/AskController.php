<?php

/**
 * 在线问答模块流程控制器
 * @author Administrator
 *
 */
class AskController extends Controller {

    private $service = null;

    /**
     * 构造方法
     * 实例化基类并实例化service层,并将其赋值给service属性
     */
    public function __construct() {
        parent::__construct();
        $this->service = new AskService();
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
     * 在线问题添加方法
     * 由前端页面发起,允许get或者post提交数据
     */
    public function save() {

        // 实例化ask数据实体,并将其进行request参数绑定
        $this->blindParams($ask = new Ask());
        // 绑定问答详情数据实体
        $this->blindParams($askDesc = new AskDesc());
        // 绑定化验单数据实体
        $this->blindParams($askAssay = new AskAssay());
        // 执行service新增操作;并将其结果输出
        return $this->service->save($ask, $askDesc, $askAssay);
    }
    
    /**
     * 在线问答 获取单条数据
     */
    public function get() {
        $res = $this->service->getRepeat ( $_REQUEST['id'] );
        $Result = new Result(true, 0, '', $res);
        return $Result;
    }

}
