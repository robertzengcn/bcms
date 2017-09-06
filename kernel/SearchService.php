<?php

/**
 * 在线问答模块(问题回答)service服务层
 * @author Administrator
 *
 */
class SearchService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new SearchDAO();
    }
    
    public function query($keyword) {
    	$result = $this->dao->query($keyword);
    	return $result;
    }

}