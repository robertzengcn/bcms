<?php

/**
 *
 * 投票dao层
 * @author Administrator
 *
 */
class VoteLogDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_VOTELOG;
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
    public function queryCount($where) {
		$result = R::count($this->tableName,'openid=:openid and tp_time >:stime and tp_time <:etime',$where);
		return $result;	
	}
    public function voteLog($votelog) {
        $result = R::exec("insert into ".$this->tableName."(vid,vtid,openid,tp_num,tp_time) values('".$votelog['vid']."','".$votelog['vtid']."','".$votelog['openid']."','".$votelog['tp_num']."','".$votelog['tp_time']."')");
    	R::close();
        if($result){
            return true;
        }else{
            return false;
        }		
	}
    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::eq('vid', $where);
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }	
}
