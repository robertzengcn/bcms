<?php

/**
 * 在线问答模块(化验单)流程控制器
 * @author Administrator
 *
 */
class AskAssayController extends Controller {

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

    public function getItem() {
        die(json_encode(new Result(true, 0, '', array(
            "name" => 'Libin'
        ))));
    }
}
