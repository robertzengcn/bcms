<?php

/**
 *
 * 投票dao层
 * @author Administrator
 *
 */
class VoteWxUserDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_VOTEWXUSER;
    }
   /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($openid) {
		$result = R::findOne($this->tableName,'openid=:openid',array('openid'=>$openid));
		if($result){
			return true;
		}else{
			return false;
		}	
	}
}
