<?php

/**
 * 投票
 * @author Administrator
 *
 */
class VoteWxUserService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new VoteWxUserDAO();
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
   /**
     * 保存数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function addWxUser($votewxuser) {
		$_REQUEST = $votewxuser;
        $this->blindParams($votewxuser = new VoteWxUser());	
        $res=$this->dao->save($votewxuser);
        return $this->success($res);
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