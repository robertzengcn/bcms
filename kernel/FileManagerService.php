<?php

class FileManagerService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new FileManagerDAO();
    }
}

