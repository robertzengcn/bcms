<?php

/**
 * 投票
 * @author Administrator
 *
 */
class VoteLogService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new VoteLogDAO();
    }
   /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
    	
        $votewzuArray = $this->dao->query($where);
        return $this->success($votewzuArray);
    }
    public function queryCount($openid) { 
    	$t = time();
    	$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
    	$array=array('openid'=>$openid,'stime'=>$start,'etime'=>$end);   	
        $count = $this->dao->queryCount($array);
        return $count;
    }
   /**
     * 保存数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function addVoteLog($votelog) {
        $res=$this->dao->voteLog($votelog);
        return $this->success($res);
    }
    /**
     * 查询数据总量
     *
     * @see kernel/BaseService::totalRows()
     */
    public function totalRows($params) {
        return $this->dao->totalRows($params);
    }
    /**
     * 绑定参数
     *
     * @param unknown $entity
     */
    protected function blindParams($entity) {
        foreach ($entity as $key => $value) {
            if (isset($_REQUEST[$key])) {
                $entity->$key = $_REQUEST[$key];
            }
        }
    }	
}