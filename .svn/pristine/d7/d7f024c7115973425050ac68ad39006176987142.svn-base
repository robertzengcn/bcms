<?php

class CommodityRuleService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new CommodityRuleDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
     public function deleteBatch($ids) {
        Entity::isIds($ids);   // 验证ids是否合法
        $scoreruleArray = $this->dao->getBatch($ids);

        return $this->dao->deleteBeans($scoreruleArray);
    } 

    /**
     * 获取一条数据
     *
     * @param Entity $scorerule
     * @return Result
     */
    public function get($scorerule) {
        $this->dao->get($scorerule->id, $scorerule);
 
        return $this->success($scorerule);
    }


    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
		$scoreruleArray = $this->dao->query($where);
        return $this->success($scoreruleArray);
    }

    /**
     * 保存数据
     *
     * @param Entity $scorerule
     * @return Result
     */
    public function save($scorerule) {
    	
         $scorerule->validate();        
        // 获取class对象并插入数据
        $this->dao->save($scorerule);
      
        return $this->success();
    }
    

    /**
     * 更新数据
     *
     * @param Entity $commodity
     * @return Result
     */
    public function update($scorerule) {
    //    $commodity->updatetime = time();
    	
        $scorerule->validate();
        $this->dao->beginTrans();
        return $this->dao->update($scorerule);
    }
    
    /**
     * 开启
     */
    public function updateon($arr) {
		return $this->success($this->dao->updateon($arr));
    }

}

