<?php

/**
 *
 * ask在线问答(化验单)dao层
 * @author Administrator
 *
 */
class AskAssayDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_ASKASSAY;
    }
}
