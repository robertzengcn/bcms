<?php

class WebsiteService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new WebsiteDAO();
    }

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        $websiteArray = $this->dao->getBatch($ids);
        return $this->dao->deleteBeans($websiteArray);
    }
    
    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteContentBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法
    
        $websiteArray = $this->dao->getContentBatch($ids);
        return $this->dao->deleteBeans($websiteArray);
    }

    /**
     * 获取一条数据
     *
     * @param Entity $website
     * @return Result
     */
    public function get($website) {
        $this->dao->get($website->id, $website);
        
        return $this->success($website);
    }
    
    /**
     * 获取一条数据
     *
     * @param Entity $website
     * @return Result
     */
    public function getContent($websitecontent) {
        $this->dao->getContent($websitecontent);
        return $this->success($websitecontent);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $websiteArray = $this->dao->query($where);
        return $this->success($websiteArray);
    }
    
    /**
     * 获得内容数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function getContentList($where) {
        $contentArray = $this->dao->getContentList($where);
        return $this->success($contentArray);
    }
    
    /**
     * 获得内容记录数
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function getContentTotalRows($where) {
        $totalRows = $this->dao->getContentTotalRows($where);
        return new Result(true, 0, '', $totalRows);
    }

    /**
     * 保存数据
     *
     * @param Entity $website
     * @return Result
     */
    public function save($website) {
        $website->addtime = time();
        $website->validate();
        // 获取class对象并插入数据
        $this->dao->save($website);
        return $this->success();
    }
    
    public function testConn() {
        $html = '';
        try {
            $isTest = isset($_REQUEST['is_test']) ? $_REQUEST['is_test'] : '';
            if ($isTest) { //填写内容时测试
                $attr = array(
                	'hospital' => $_REQUEST['hospital'],
                    'domain' => $_REQUEST['domain'],
                    'ip' => $_REQUEST['ip'],
                    'port' => $_REQUEST['port'],
                    'db' => $_REQUEST['db'],
                    'user' => $_REQUEST['user'],
                    'pwd' => $_REQUEST['pwd'],
                );
                $flag = $this->dao->testRemoteDBCon($attr, $msg);
            } else {
                $flag = $this->dao->getRemoteDBCon($_REQUEST['website_id'], $msg);
            }
            
            if (empty($msg) && $flag) {
                $html = '<span style="color:green">正常</span>';
                $msg = '连接正常';
            } else {
                $html = '<span class="status_error" style="color:red">异常</span>';
            }
        } catch (Exception $e) {
            $html = '<span class="status_error" style="color:yello">未知</span>';
        }
        return json_encode(array('status'=>$html, 'msg'=>$msg, 'flag'=>$flag));
    }

    /**
     * 更新数据
     *
     * @param Entity $website
     * @return Result
     */
    public function update($website) {
        $website->validate();
        return $this->dao->update($website);
    }
    
    /**
     * 处理内容
     * */
    public function manageContent($websitecontent) {
        $websitecontent->validate();
        // 获取class对象并插入数据
        $this->dao->manageContent($websitecontent);
        return $this->success();
    }
    
    /**
     * 发送文章
     * */
    public function sendArticle($hospital, $data) {
        return $this->dao->sendArticle($hospital, $data);
    }
    
    /**
     * 抛出具体的错误...
     */
    public function errorMessage($code){
        foreach ($this->errorMsg as $key=>$value){
            if($code == $key){
                throw new Exception($value);
            }
        }
    }
    
    /**
     * 卸载插件所需要执行的方法...
     */
    public function uninstall(){
        //删除数据库中的表
        $sql1 = 'drop table website';
        $sql2 = 'drop table websitecontent';
    
        $array = array($sql1,$sql2);
        $this->dao->dropTable($array);
        return true;
    }
}
