<?php

/**
 * 资讯(news)DAO
 *
 * @author Administrator
 *
 */
class SeoDAO extends DBBaseDAO {

    public function __construct() {
        parent::__construct();
        $this->tableName = TABLENAME_SEO;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where) {
        DTExpression::eq('flag', $where);
        DTExpression::like('page_name', $where);
        DTExpression::page($where);
        if (isset($where['order']) &&  $where['order']) {
            DTOrder::$sql = $where['order'];
        } else {
            DTOrder::asc('id');
        }
        
        return $this->getByComposite(ORMMap::$classes[$this->tableName], DTExpression::$sql . DTOrder::$sql . DTExpression::$limit);
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
        DTExpression::eq('flag', $where);
        DTExpression::like('page_name', $where);

        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 批量删除
     *
     * @param unknown $ids
     */
    public function deleteBatch($ids) {
        $seos = $this->getBatch($ids);
        foreach ($seos as $key) {
            if ($key->id == 0) {
                return new Result(false, 78, ErrorMsgs::get(78), NULL);
            }
            if ($key->is_retain == 1) {
                return new Result(false, 18, ErrorMsgs::get(18), NULL);
            }
        }
        R::trashAll($seos);
        return new Result(true, 0, '', NULL);
    }
    
    /*
     * 根据flag取数据
     * */
    public function getflag($arr){
    	
    	$result=R::findOne($this->tableName,'flag=:flag',$arr);
    	if($result!=null){
    	$seoarray = array();
    	foreach ($result as $key => $value) {
    		$seoarray[$key]=$value;
    	}
    	return $seoarray;
    	}else{
    		return null;
    	}
    	
    	
    }
}
