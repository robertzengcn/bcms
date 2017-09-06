<?php
class ZhimengController extends Controller {

    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new ZhimengService();
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
     * 判断用户之前是否有保存数据库信息 ...
     */
    public function haveMsg(){
    	$result = $this->service->haveMsg();
    	echo json_encode($result);
    }
	
    /**
     * 设置数据库的信息...
     */
    public function addDatabase(){
    	$result = $this->service->addDatabase();
    	//$arr=array("info"=>"demo info","status"=>"y");
    	echo json_encode($result);
    }
    
    /**
     * 链接数据库...
     */
    public function connectDB(){
    	$conn = mysql_connect($_COOKIE['mysqlMsg']['url'],$_COOKIE['mysqlMsg']['user'],$_COOKIE['mysqlMsg']['pwd']);
    	mysql_select_db($_COOKIE['mysqlMsg']['name']);
    	mysql_query('set names utf8');
    	return $conn;
    }
    
    /**
     * 获取栏目名称...
     */
    public function getTypenames(){
    	$this->connectDB();
    	$result = mysql_query('select typename,description,keywords,seotitle from dede_arctype');
    	$data = array();
    	while($row = mysql_fetch_assoc($result)){
    		$data[] = $row;
    	}
    	$str = serialize($data);
    	$_SESSION['typenamedata'] = $str;
    	echo json_encode($data);
    }
    
    /**
     * 根据条件获取数据...
     */
    public function getData(){
    	$this->connectDB();
    	set_time_limit(0);
    	if ($_REQUEST['keyword'] != ''){
    		$sql = "select a.id,a.title,a.litpic,a.keywords,a.description,b.body,c.typename from dede_archives as a left join dede_addonarticle as b on b.aid=a.id left join dede_arctype as c on c.id=a.typeid where typename='{$_REQUEST['typename']}' and title like '%{$_REQUEST['keyword']}%' limit {$_REQUEST['count']}";
    	}else{
    		$sql = "select a.id,a.title,a.litpic,a.keywords,a.description,b.body,c.typename from dede_archives as a left join dede_addonarticle as b on b.aid=a.id left join dede_arctype as c on c.id=a.typeid where typename='{$_REQUEST['typename']}' limit {$_REQUEST['count']}";
    	}
    	$result = mysql_query($sql);
    	$data = array();
    	while($row = mysql_fetch_assoc($result)){
    		$data[] = $row;
    	}
    	//清空数据库
    	$statu = $this->service->clearTable();
    	if(!$statu->statu){
    		echo json_decode($statu);
    	}
    	//保持进数据库
    	$array = array();
    	foreach ($data as $value){
    		$result = $this->saveZmdata($value);
    		$array[] = $result;
    	}
    	echo json_encode($result);
    }
    
    public function gettotal(){
    	$conn=$this->connectDB();
    	set_time_limit(0);
    	//$sql = "select a.id,a.title,a.litpic,a.keywords,a.description,b.body,c.typename from dede_archives as a left join dede_addonarticle as b on b.aid=a.id left join dede_arctype as c on c.id=a.typeid where 1=1";
    	$sql = "select COUNT(*) as num from dede_archives";

    	$result = mysql_query($sql);
    	
    	$data = mysql_fetch_assoc($result);
    	
    	mysql_close($conn);
    	return $data[num];
    	
    	
    }
    
    /**
     * 保存织梦数据...
     */
    public function saveZmdata($data){
    	$_REQUEST = $data;
    	$this->blindParams($entity = new Zmdata());
    	$result = $this->service->saveZmdata($entity);
    	return $result;
    }
    
    /**
     * 获取zmdata表中数据...
     */
    public function getZmDatas(){
    	$num=$this->gettotal();
    	
    	$rows = $this->service->getZmDatas($_REQUEST);
    	//print_r($rows);exit;
    	$count = $this->service->getZmdataCount();
    	
    	echo json_encode(array('draw'=>$_REQUEST['draw'],'data'=>$rows->data,'recordsFiltered'=>$count->data,'recordsTotal'=>$num,'rows'=>$rows->data,'ttl'=>$count->data));
    }
    
    /**
     * 将数据保存到本地 ...
     */
    public function saveDataLocal(){
    	 $this->service->saveDataLocal();
    	$array = array('stute'=>true, 'msg'=>null, 'code'=>null, 'data'=>null);
    	echo json_encode($array);
    }
    
    /**
     * 更新文章信息 ...
     */
    public function updateArticle(){
    	$article = new Article();
    	foreach ($article as $key => $value) {
            if (isset($_REQUEST['data'][$key])) {
                $article->$key = $_REQUEST['data'][$key];
            }
        }
        $result = $this->service->updateArticle($article);
        echo json_encode($result);
    }  
    public function checkconnect(){
    	$conn = mysql_connect($_REQUEST['url'],$_REQUEST['user'],$_REQUEST['pwd']);
    	if($conn){
    		$array = array('stute'=>true, 'msg'=>null, 'code'=>null, 'data'=>null);
    		
    	}else{
    		$array = array('stute'=>false, 'msg'=>null, 'code'=>null, 'data'=>null);
    	}
    	mysql_close($conn);
    	echo json_encode($array);
    }
}

