<?php

class PluginService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new PluginDAO();
    }

    /**
     * 执行sql文件
     */
    public function installSql($sqlContent) {
        return $this->dao->installSql($sqlContent);
    }
}
