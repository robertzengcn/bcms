<?php

/**
 * 投票
 * @author Administrator
 *
 */
class VoteWxszService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new VoteWxszDAO();
    }
   /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
    	
        $votewzArray = $this->dao->query($where);
		$votedao = new VoteDAO();
		foreach($votewzArray as $value){
			$value->name = $votedao->getActiveName($value->vid);
			$value->status = 1;
		}
        return $this->success($votewzArray);
    }

   /**
     * 获取一条数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function get($votewxsz) {
        $this->dao->get($votewxsz->id, $votewxsz);  
		$votedao = new VoteDAO();
		$votewxsz->title = $votedao->getActiveName($votewxsz->vid);
        return $this->success($votewxsz);
    }
   /**
     * 保存数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function save($votewxsz) {
    	
        $votewxsz->validate();        
        $res=$this->dao->save($votewxsz);
        return $this->success($res);
    }
   /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
     public function deleteBatch($ids) {
        Entity::isIds($ids);   // 验证ids是否合法
        $voteWxszArray = $this->dao->getBatch($ids);
        return $this->dao->deleteBeans($voteWxszArray);
    }
    /**
     * 更新数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function update($votewxsz) {	
        $votewxsz->validate();
        $this->dao->beginTrans();
        return $this->dao->update($votewxsz);
    }
    /**
     * 获取数据
     *
     */
    public function getAppsecret($vid) {	
        $result = $this->dao->getAppsecret($vid);
        return $result;
    } 
    /**
     * 更新数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function updateByVid($arr) {	
        return $this->success($this->dao->updateByVid($arr));
    }
}