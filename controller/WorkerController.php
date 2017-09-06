<?php

class WorkerController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new WorkerService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    /**
     * 删除数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $workers = $_REQUEST['id'];
        } else {
            $workers = array(
                $_REQUEST['id']
            );
        }
        $result = $this->service->deleteBatch($workers);

        echo json_encode($result);
    }

    /**
     * 获得查询的grid数据
     */
    public function query() {
        $result = $this->service->query($_REQUEST);
        $totalRows = $this->service->totalRows($_REQUEST);

        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        ));
    }

    /**
     * 获得单笔
     */
    public function get() {
        $this->blindParams($worker = new Worker());
        $result = $this->service->get($worker);

        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
        $_REQUEST['acls'] = stripslashes($_REQUEST['acls']);
        $this->blindParams($worker = new Worker());
        $result = $this->service->update($worker);

        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
        $_REQUEST['acls'] = stripslashes($_REQUEST['acls']);
        $this->blindParams($worker = new Worker());
        if(!$worker->name){
        	echo json_encode(array('statu'=>false,'code'=>1,'msg'=>'用户名为空','data'=>null));
        exit();
        }
        $userresult=$this->service->finduser($worker);
        if($userresult){
        	echo json_encode(array('statu'=>false,'code'=>2,'msg'=>'用户已存在','data'=>null));
        	exit();
        }
        $result = $this->service->save($worker);
        echo json_encode($result);
    }

    /**
     * reg
     */
    public function reg() {
        $this->blindParams($worker = new Worker());

        $result = $this->service->reg($worker);
        $workers = array();
        if ($result->data) {
            $workers['code'] = true;
        } else {
            $workers['code'] = false;
        }

        echo json_encode($workers);
    }

    /**
     * 员工修改密码
     */
    public function mdf() {
        $result = $this->service->mdfPwd();

        echo json_encode($result->data);
    }

    /**
     * 管理员修改密码
     */
    public function mdfAdmin() {
        $result = $this->service->mdfAdmin();

        echo json_encode($result->data);
    }
    
    /**
     * 获取管理员组
     * */
    public function getgroups(){
    	$result=$this->service->getgroups($_REQUEST);
    	
    	$totalRows=$this->service->getgroupnum($_REQUEST);
    	
    echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        ));
    }
    /**
     * 添加管理员组
     * */
    public function addworkergroup(){
        $_REQUEST['acls'] = stripslashes($_REQUEST['acls']);
    	$this->blindParams($workergroup = new WorkerGroup());
    	$result = $this->service->saveworkergroup($workergroup);
    	echo json_encode($result);
    }
    /**
     * 编辑小组
     * */
    public function editworkergroup(){
        $_REQUEST['acls'] = stripslashes($_REQUEST['acls']);
    	$this->blindParams($workergroup = new WorkerGroup());
    	$result = $this->service->editworkergroup($workergroup);
    	
    	echo json_encode($result);
    }
    /**
     * 获取小组信息
     * */
    public function getworkergroup(){
    	$id=(int)$this->getRequest('id',null);
    	$acl=(int)$this->getRequest('stracl',0);//是否返回字符串形式的权限
    	if(!$id){
    		die(json_encode(new Result(false, 1, '缺少id', null)));    		
    	}
    	$this->blindParams($workergroup = new WorkerGroup());
    	
    	$result = $this->service->getworkergroup($workergroup,$acl);
    	
    	echo json_encode($result);
    }
    /**
     * 删除用户组
     * */
    public function deleteworkergroup(){
    	// 是否单笔删除还是批量删除
    	if (is_array($_REQUEST['id'])) {
    		$workergroup = $_REQUEST['id'];
    	} else {
    		$workergroup = array(
    				$_REQUEST['id']
    		);
    	}
    	$result = $this->service->deleteworkergroup($workergroup);
    	
    	echo json_encode($result);
    }      
    /**
     * 获取当前用户
     * */ 
    public function getcurrentworker(){
     if($_SESSION['is_login']){
     $result=array('statu'=>true,'code'=>0,'msg'=>null,'data'=>$_SESSION['id']);
     	die(json_encode($result));
     }else{
     	$result=array('statu'=>false,'code'=>1,'msg'=>'用户未登陆','data'=>null);
     	die(json_encode($result));
     }
    } 
}

