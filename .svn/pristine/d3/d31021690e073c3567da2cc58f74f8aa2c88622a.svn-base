<?php

class WorkerService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
        $this->dao = new WorkerDAO();
        $this->group=new WorkerGroupDAO();
    }

    public function __destruct() {}

    /**
     * 批量删除
     *
     * @param array $arr(id,...)
     * @return boolean
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids); // 验证ids是否合法

        return $this->dao->deleteBatch($ids);
    }

    /**
     * 获取一条数据
     *
     * @param Entity $link
     * @return Result
     */
    public function get($worker) {
        $this->dao->get($worker->id, $worker);
        $worker->acls = json_decode($worker->acls, true);
        return $this->success($worker);
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $workers = $this->dao->query($where);
        foreach ($workers as $value) {
        	$workergroup=new WorkerGroup();
        	$workergroup->id=(int)$value->group_id;
        	$value->group_name=$this->getworkergroup($workergroup)->data->name;
        	if(!$value->group_name){
        		$value->group_name="未分组";
        	}
            $value->plushtime = date('Y-m-d H:i:s', $value->plushtime);
        }
return $this->success($workers);
        //return new Result(true, 0, '', $workers);
    }

    /**
     * 保存数据
     *
     * @param Entity $link
     * @return Result
     */
    public function save($worker) {
        $worker->validate();
        // 获取class对象并插入数据
        $worker->password = md5($worker->password);
        $this->dao->save($worker);

        return new Result(true, 0, '', NULL);
    }

    /**
     * 更新数据
     *
     * @param Entity $link
     * @return Result
     */
    public function update($worker) {
        $worker->validate();
        
        // 获取class对象并修改数据
        if(isset($worker->password)&&strlen($worker->password)>0){//如果密码不为空则加密
        	$worker->password = md5($worker->password);
        }else{
        	
        		$result=$this->getworkerbyid($worker->id)->data;
        		if($result){
        			$worker->password=$result->password;
        		}
        	
        }
       
        if (isset($_REQUEST['qx'])) {
            $qx = implode(',', $_REQUEST['qx']);
            $worker->purview = $qx;
        }

        return $this->dao->update($worker);
    }

    /**
     * 登陆
     */
    public function login() {
        $result = $this->dao->login();
        if ($result) {
            $worker = new Worker();
            $worker->generateFromRedBean($result);
            setCookie('is_login', true, time() + 86400, '/');
            setCookie('login_id', $worker->id, time() + 86400, '/');
            $_SESSION['id'] = $worker->id;
            $_SESSION['name'] = $worker->name;
            $_SESSION['is_login'] = true;
            $_SESSION['group'] = $worker->group_id;
        } else {
            $worker = '';
        }

        return new Result(true, 0, '', $worker);
    }

    /**
     * 注册
     */
    public function reg($worker) {
        $worker->validate();

        $result = $this->dao->reg();
        if ($result) {
            $array = false;
        } else {
            if (isset($_REQUEST['qx'])) {
                $qx = implode(',', $_REQUEST['qx']);
                $worker->purview = $qx;
            } else {
                $worker->purview = '';
            }

            $worker->password = md5($worker->password);
            $worker->plushtime = time();
            $worker->group_id = 2;
            $this->dao->save($worker);
            $array = true;
        }

        return new Result(true, 0, '', $array);
    }
    
    /**
     * 查找用户名
     * */
    public function finduser($worker){
    	$result=$this->dao->finduserbyname($worker->name);
    	if($result){
    		return true;//用户存在
    	}else{
    		return false;//用户存在
    	}
    }

    /**
     * 管理员修改密码
     */
    public function mdfAdmin() {
        $result = $this->dao->reg();
        if ($result) {
            $worker = new Worker();
            $worker->generateFromRedBean($result);
            $worker->password = md5($_REQUEST['new1']);
            $this->dao->update($worker);
            $array = true;
        } else {
            $array = false;
        }

        return new Result(true, 0, '', $array);
    }

    /**
     * 修改密码
     */
    public function mdfPwd() {
        $_REQUEST['password'] = $_REQUEST['old_password'];
        $result = $this->dao->login();

        $array = array();
        if ($result) {
            $worker = new Worker();
            $worker->generateFromRedBean($result);
            if ($result->group == 2) {
                $worker->password = md5($_REQUEST['new1']);
                $this->dao->update($worker);
                $array['code'] = 0;
            } else {
                $array['code'] = 1;
            }
        } else {
            $array['code'] = 2;
        }

        return new Result(true, 0, '', $array);
    }
    /**
     * 取worker里的nick_name和id
     * */
    public function getnicknamelist($where=array()){
    	$result=$this->dao->getnicknamelist($where);
    	return $this->success($result);
    }
    /**
     * 取管理员组
     * */
    public function getgroups($where){
    	$result=$this->group->query($where);
    	
    	
    	return $this->success($result);
    }
    /**
     * 取管理员组数量
     * 
     * */
    public function getgroupnum($where){
    	$result=$this->group->totalRows($where);
    	return $this->success($result);
    }
    /**
     * 保存管理员组
     * @param $entity workergroup
     * */
    public function saveworkergroup($workergroup){
    	$result=$this->group->save($workergroup);
    	return $this->success();
    }
    /**
     * 编辑管理员组
     * @param $entity workergroup
     * */
    public function editworkergroup($workergroup){
    	$this->group->update($workergroup);
    	return $this->success();
    }
    /**
     * 取管理员组
     * @param $entity workergroup
     * */
    public function getworkergroup($workergroup,$acls=0){
    	$this->group->get($workergroup->id, $workergroup);
    	if($acls==0){
    		$workergroup->acls = json_decode($workergroup->acls, true);
    	}
    	
    	return $this->success($workergroup);
    }
    /**
     * 删除管理员组
     * @param $ids
     * */
    public function deleteworkergroup($ids){
    	$result=$this->group->deleteBatch($ids);    	
    	return $result;
    }
    
    /**
     * 通过id取用户
     *
     * */
    public function getworkerbyid($id){
    	$arr=array('id'=>(int)$id);
    	$result=$this->dao->getworkerbyid($arr);
    	return $this->success($result);
    }
}
