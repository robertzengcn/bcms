<?php

/**
 * 投票
 * @author Administrator
 *
 */
class VoteWxUserController extends Controller {
    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new VoteWxUserService();
    }
}
