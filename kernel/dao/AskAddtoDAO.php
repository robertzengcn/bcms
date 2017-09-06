<?php

/**
 * 在线问答(追问)dao层
 * @author Administrator
 *
 */
class AskAddtoDAO extends DBBaseDAO {

    /**
     * 构造方法
     */
    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_ASKADDTO;
    }
}
