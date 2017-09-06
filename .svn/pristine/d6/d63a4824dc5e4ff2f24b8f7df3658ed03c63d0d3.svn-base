<?php

class CommodityScorereduceService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new CommodityScorereduceDAO();
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
     * 添加数据记录
     * @param $arr
     * */ 
    public function addlog($arr){
    	$commodityscorereduce=new CommodityScorereduce();
    	$commodityscorereduce->uid=$arr['uid'];
    	$commodityscorereduce->note=$arr['note'];
    	$commodityscorereduce->score=(int)$arr['score'];
    	$this->dao->save($commodityscorereduce);
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
    



    
 
}

