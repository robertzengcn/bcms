<?php

/**
 *
 * askdesc在线问答详情dao层
 * @author Administrator
 *
 */
class AskDescDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_ASKDESC;
    }
    public function query($where) {
        DTExpression::eq('ask_id', $where);
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);		
	}
}
