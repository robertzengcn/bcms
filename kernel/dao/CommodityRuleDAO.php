<?php

/**
 * 规则DAO
 *
 * @author Administrator
 *
 */
class CommodityRuleDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_COMMODITYRULE;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('name', $where);
        DTExpression::eq('id', $where);
        DTExpression::eq('status', $where);
		return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }
    
   /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function update($entity) {
        $bean = R::load($this->tableName, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return new Result(true, 0, '', NULL);
    }    
    

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::ge('start_time', $where, 'start_time');
        DTExpression::le('end_time', $where, 'end_time');
        DTExpression::eq('isbidding', $where);
        DTExpression::like('subject', $where);
        DTExpression::eq('shelf', $where);
        //DTExpression::eq('pattern', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
     /**
     * 开启
     */
    public function updateon($arr) {
    	$result = R::exec('update '.$this->tableName.' set status =:status where id=:id',$arr);
    	R::close();
		return $result;
    }       
}

