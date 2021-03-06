<?php

class BaseService {

    protected $dao = null;

    function __construct() {}

    function __destruct() {}

    public function success($data = '') {
        return new Result(true, 0, '', $data);
    }

    public function fail($code, $message) {
        return new Result(false, $code, $message, null);
    }

    /**
     * 获取指定条数 和 排序 记录
     *
     * @param string $order
     *            排序条件
     * @param string $limit
     *            数量
     */
    public function getLimit($order, $limit, $where, $field) {
        return $this->dao->getLimit($order, $limit, $where, $field);
    }

    /**
     * 按条件获取 单条记录
     */
    public function findOne($where, $field) {
        return $this->dao->findOne($where, $field);
    }
    /**
     * 获取 单条记录
     */
    public function getRowTag($sql, $field) {
        return $this->dao->getRow($sql, $field);
    }
    /**
     * 获取 所有记录
     */
    public function getAllTag($sql) {
        return $this->dao->getJoin($sql);
    }
    /**
     * 获取指定条数 和 排序 记录 分页
     *
     * @param string $order
     *            排序条件
     * @param string $where
     *            条件
     */
    public function getPage($field, $where, $limit, $order) {
        return $this->dao->getPage($field, $where, $limit, $order);
    }

    /**
     * 根据查询条件获取总记录数
     *
     * @param array $where
     *            查询条件
     */
    public function totalRows($where) {
        $totalRows = $this->dao->totalRows($where);
        return new Result(true, 0, '', $totalRows);
    }

    /**
     * 获取表中所有记录
     *
     * @return Result
     */
    public function getListAll() {
        $array = $this->dao->getListAll();
        return new Result(true, 0, '', $array);
    }

    public function getLastOne($id) {
        return $this->dao->getLastOne($id);
    }

    /**
     * 根据id获取上条记录
     *
     * @param
     *            int id
     * @return object
     */
    public function getPreOne($id) {
        return $this->dao->getPreOne($id);
    }

    /**
     * 根据多name或id取出数据
     *
     * @param
     *            $where
     * @return array
     *
     */
    public function in($where, $entity) {
        return $this->dao->in($where, $entity);
    }
    
    /**
     * 对象转成数组函数
     * @param object
     * 
     * @retun array
     * */
    
    public function objectToArray($obj){
    	$arr = is_object($obj) ? get_object_vars($obj) : $obj;
    	if(is_array($arr)){    		
    		return array_map(array($this, 'objectToArray'), $arr);
    		
    	}else{
    		return $arr;
    	}
    }
    /**
     * sql查询
	 * @param string $sql
     * @return object 
     */
    public function getJoin($sql){
		return $this->dao->getJoin ( $sql );
    }  
   /**
     * 获取表字段
	 * @param boolean $abb 
	 * @param array $delfield 
	 * @param boolean $as	 
     * @return string
     */
    public function getFields($as=false, $abb=true, $delfield = array('content')){
		return $this->dao->getFields($as, $abb, $delfield);
    }	
    
    protected function formatApiTokenQry($method) {
        require_once ABSPATH . '/lib/api/token/AuthToken.php';
        $time = time();
        $token = new AuthToken();
        return 'time=' . $time . '&api_token=' . $token->getApiToken($method, $time);
    }
}
