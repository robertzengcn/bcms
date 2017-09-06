<?php

/**
 *
 * 多站点管理dao层
 * @author Administrator
 *
 */
class WebsiteDAO extends DBBaseDAO {

    /**
     * Members
     * */
    private $_remoteDBCon = null;
    
    public function __construct() {
        parent::__construct();
        $this->tableName = 'website';
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function query($where = array()) {
        if (isset($where['hospital']) && $where['hospital']){
            DTExpression::like('hospital', $where);
        }
        
        if (isset($where['domain']) && $where['domain']){
            DTExpression::like('domain', $where);
        }
        DTExpression::page($where);
        $result = $this->getByComposite('Website', DTExpression::$sql . DTExpression::$limit);
        return $result;
    }

    /**
     * 获得总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function totalRows($where) {
    if (isset($where['hospital']) && $where['hospital']){
            DTExpression::like('hospital', $where);
        }
        
        if (isset($where['domain']) && $where['domain']){
            DTExpression::like('domain', $where);
        }
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    /**
     * 处理内容
     * */
    public function manageContent($websitecontent) {
        $table = 'websitecontent';
    	if ($websitecontent->id) {
    		//修改
    	    $bean = R::load($table, $websitecontent->id);
    	    if ($websitecontent->id == 0) {
    	        return new Result(false, 78, ErrorMsgs::get(78), NULL);
    	    }
    	    $websitecontent->generateRedBean($bean);
    	    $websitecontent->id= R::store($bean);
    	} else {
    		//添加
    	    $bean = R::dispense($table);
    	    $websitecontent->generateRedBean($bean);
    	    $websitecontent->id= R::store($bean);
    	}
    	return $websitecontent;
    }
    
    /**
     * 获得内容数据
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function getContentList($where) {
        $this->tableName = 'websitecontent';
        if (isset($where['website_id']) && $where['website_id'] && $where['website_id'] != 'all') {
            DTExpression::eq('website_id', $where['website_id']);
        }
        
        if ($where['type']) {
            DTExpression::eq('type', $where['type']);
        }
        DTExpression::page($where);
        return $this->getByComposite($this->tableName, DTExpression::$sql . DTExpression::$limit);
    }
    
    /**
     * 获得内容总数
     *
     * @param array $where
     *            查询条件
     *            return object $arr
     */
    public function getContentTotalRows($where) {
        $this->tableName = 'websitecontent';
        if (isset($where['website_id']) && $where['website_id'] && $where['website_id'] != 'all') {
            DTExpression::eq('website_id', $where['website_id']);
        }
        
        if ($where['type']) {
            DTExpression::eq('type', $where['type']);
        }
        
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }
    
    /**
     * 获取contentBeans
     * */
    public function getContentBatch($ids) {
        $this->tableName = 'websitecontent';
    	return $this->getBatch($ids);
    }
    
    /**
     * 获取一条内容
     * */
    public function getContent($websitecontent) {
    	$this->tableName = 'websitecontent';
    	return $this->get($websitecontent->id, $websitecontent);
    }
    
    /**
     * 发送
     * */
    public function sendArticle($hospitals, $data = array()) {
        $hospitals = explode(',', $hospitals);
        $message = '';
        foreach ($hospitals as $hospital) {
            $msg = '';
            try {
                //连接数据库
                if ($this->_remoteDBCon == null) {
                    if (!$this->getRemoteDBCon($hospital, $msg)) {
                        $message .= $msg . "<br/>";
                    }
                } 
                
                if (empty($msg)) {
                    $sql = $this->getSendSql($hospital, $data);
                    mysql_query($sql);
                    mysql_close($this->_remoteDBCon);
                    $this->_remoteDBCon = null;
                }
            } catch (Exception $e) {
                $message .= $e->getMessage();
                continue;
            }
        }
        
        if ($message) {
            return new Result(false, 1, $message, '');
        }
    	return new Result(true, 0, '', '');
    }
    
    /**
     * 获取要发送的sql
     * */
    public function getSendSql($hospital, $data = array()) {
        $sql = '';
        if (empty($hospital) || empty($data)) {
        	return $sql;
        }
        $articleKeys = array('subject','pic','source','content','title','keywords','description','isbidding','is_top');
        $dds = array();
        foreach ($data as $article) {
            $temp = array();
            foreach ($article as $k => $v) {
                if (in_array($k, $articleKeys)) {
                    $temp[$k] = $v;
                }
            }
            	
            $temp['plushtime'] = time();
            $temp['updatetime'] = time();
            $temp['department_id'] = 1;
            $temp['disease_id'] = 1;
            $temp['doctor_id'] = 1;
            	
            //获取部门
            if ($dep = $this->getRemoteDepartment($hospital, $article['department'])) {
                $temp['department_id'] = $dep->data;
            }
            //获取疾病
            if ($dis = $this->getRemoteDisease($hospital, $temp['department_id'], $article['disease'])) {
                $temp['disease_id'] = $dis->data;
            }
            	
            //获取医生
            if ($doc = $this->getRemoteDoctor($hospital, $temp['department_id'], $article['doctor'])) {
                $temp['doctor_id'] = $doc->data;
            }
        
            $temp['worker_id'] = 1;
            $keys = array_keys($temp);
            
            $dds[] = $temp;
        }
        
        $sql = "insert into `article` (`".implode("`,`", $keys)."`) VALUES ";
        foreach ($dds as $temp) {
        	$sql .= "('".implode("','", $temp)."'),";
        }
        $sql = substr($sql, 0, -1);
        return $sql;
    }
    
    /**
     * 根据信息测试连接数据库
     * */
    public function testRemoteDBCon($info = array(), &$msg = '') {
        set_time_limit(10);
        $attr = array('hospital', 'ip', 'domain', 'port', 'db', 'user', 'pwd');
        foreach ($attr as $key) {
        	if (!isset($info[$key]) || empty($info[$key])) {
        	    $msg = "医院信息不完整";
        	    return false;
        	}
        }
    
        try {
            $server = $info['ip'] ? ($info['ip']) : ($info['domain'] ? ($info['domain']) : '');
            $server = $info['port'] ? ($server . ":" . $info['port']) : $server;
            $link = mysql_connect($server, $info['user'], $info['pwd']);
            if (!$link) {
                $msg = "医院：【" . $info['hospital'] . "】站点连接异常！ERROR：Database could not connect";
                return false;
            }
    
            if ( !mysql_select_db($info['db'], $link) ) {
                $msg = "医院：【" . $info['hospital'] . "】站点连接异常！ERROR：" . mysql_error();
                return false;
            }
             
            mysql_query('set names utf8');
            $this->_remoteDBCon = $link;
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return false;
        }
        return true;
    }
    
    /**
     * 根据站点id测试连接数据库
     * */
    public function getRemoteDBCon($website_id, &$msg = '') {
        set_time_limit(10);
        //查询医院地址
        $this->tableName = 'website';
        $websiteObj = new Website();
        $this->get($website_id, $websiteObj);
        
        if (!$websiteObj->id) {
        	$msg = "医院信息不存在";
        	return false;
        }
        
        try {
            $server = $websiteObj->ip ? ($websiteObj->ip) : ($websiteObj->domain ? ($websiteObj->domain) : '');
            $server = $websiteObj->port ? ($server . ":" . $websiteObj->port) : $server;
            $link = mysql_connect($server, $websiteObj->user, $websiteObj->pwd);
            if (!$link) {
                $msg = "医院：【" . $websiteObj->hospital . "】站点连接异常！ERROR：Database could not connect";
                return false;
            }
            
            if ( !mysql_select_db($websiteObj->db, $link) ) {
                $msg = "医院：【" . $websiteObj->hospital . "】站点连接异常！ERROR：" . mysql_error();
                return false;
            }
             
            mysql_query('set names utf8');
            $this->_remoteDBCon = $link;
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return false;
        }
    	return true;
    }
    
    /**
     * 获取远程部门信息
     * */
    public function getRemoteDepartment($hospital, $department) {
        //连接数据库
        if ($this->_remoteDBCon == null) {
            if (!$this->getRemoteDBCon($hospital, $msg)) {
                return new Result(false, 1, $msg, '');
            }
        }
        
        $tempSql = "select id from department where name like '%" . $department . "%'";
        $result = mysql_query($tempSql);
        $row = mysql_fetch_row($result, MYSQL_ASSOC);
        if (empty($row)) {
            $tempSql = "select id from department limit 0,1";
            $result = mysql_query($tempSql);
            $row = mysql_fetch_row($result, MYSQL_ASSOC);
        }
        
        $department_id = $row['id'];
        mysql_free_result($result);
        
        return new Result(true, 0, '', $department_id);
    }
    
    /**
     * 获取远程疾病信息
     * */
    public function getRemoteDisease($hospital, $department_id, $disease) {
        //连接数据库
        if ($this->_remoteDBCon == null) {
            if (!$this->getRemoteDBCon($hospital, $msg)) {
                return new Result(false, 1, $msg, '');
            }
        }
    
        $tempSql = "select id from disease where name like '%" . $disease . "%' and department_id=" . $department_id;
        $result = mysql_query($tempSql);
        $row = mysql_fetch_row($result, MYSQL_ASSOC);
        if (empty($row)) {
            $tempSql = "select id from disease where department_id=" . $department_id . "  limit 0,1";
            $result = mysql_query($tempSql);
            $row = mysql_fetch_row($result, MYSQL_ASSOC);
        }
        
        $disease_id = $row['id'];
        mysql_free_result($result);
    
        return new Result(true, 0, '', $disease_id);
    }
    
    /**
     * 获取远程医生信息
     * */
    public function getRemoteDoctor($hospital, $department_id, $doctor) {
        //连接数据库
        if ($this->_remoteDBCon == null) {
            if (!$this->getRemoteDBCon($hospital, $msg)) {
                return new Result(false, 1, $msg, '');
            }
        }
    
        $tempSql = "select id from doctor where name='" . $doctor . "' and department_id=" . $department_id . "  limit 0,1";
        $result = mysql_query($tempSql);
        $row = mysql_fetch_row($result, MYSQL_ASSOC);
        if (empty($row)) {
            $tempSql = "select id from doctor where department_id=" . $department_id;
            $result = mysql_query($tempSql);
            $row = mysql_fetch_row($result, MYSQL_ASSOC);
        }
        
        $doctor_id = $row['id'];
        mysql_free_result($result);
    
        return new Result(true, 0, '', $doctor_id);
    }
    
}
