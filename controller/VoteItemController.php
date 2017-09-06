<?php

/**
 * 投票
 * @author Administrator
 *
 */
class VoteItemController extends Controller {
    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new VoteItemService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
		$method = $_REQUEST['method'];
		$array = array('search','gListAjax','gVoteAjax','xiangqing');
		$filterService = new FilterService();
		$filterService->addFunc($filterService::$SQLINJECTION);
		if(!in_array($method, $array)){
			$filterService->addFunc($filterService::$WORKERISLOGIN);
		}
		//$filterService->addFunc($filterService::$FILERPLUSHTIME);
		//$filterService->addFunc($filterService::$WORKERLOGHISTORY);

		return $filterService->execute();
		
    }
    /**
     * 获得查询的grid数据
     */
    public function query() {

        $result = $this->service->query($_REQUEST);
        $totalRows = $this->service->getSignUpCount(array('vid'=>$_REQUEST['vid']));
        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows
        ));
    }
    /**
     * 获得单笔动态数据
     */
    public function get() {
        $this->blindParams($voteitem = new VoteItem());
        $result = $this->service->get($voteitem);
       
        echo json_encode($result);
    }
   /**
     * 编辑
     */
    public function edit() {
		$i = 1;
		foreach($_REQUEST['piclist'] as $val){
			if(!preg_match("/thumbnail_auto.gif/i", $val) && $val !=''){
				$_REQUEST['startpicurl'.$i] = isset($_REQUEST['startpicurl'.$i]) ? '' : $val;
			}
			$i++;
		}
		unset($_REQUEST['piclist']);
        $this->blindParams($voteitem = new VoteItem());
        $result = $this->service->update($voteitem);
       
        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
		$i = 1;
		foreach($_REQUEST['piclist'] as $val){
			if(!preg_match("/thumbnail_auto.gif/i", $val) && $val !=''){
				$_REQUEST['startpicurl'.$i] = $val;
				$i++;
			}
		}
		unset($_REQUEST['piclist']);
		$_REQUEST['status'] = 0;
		$_REQUEST['rank'] = 0;
		$_REQUEST['dcount'] = rand(99,999);
    	$_REQUEST['addtime']=time();
        $this->blindParams($voteitem = new VoteItem());
        $result = $this->service->save($voteitem);      
        echo json_encode($result);

    }
    /**
     * 删除单笔数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {       	
            $vis= $_REQUEST['id'];
        } else {
        	$arr = explode(',',$_REQUEST['id']);        	
            $vis = $arr;
        }
        $result = $this->service->deleteBatch($vis);
        echo json_encode($result);
    }
    /**
     * 开启关闭按钮
     */
    public function auditSwitch() {    
		$arr = array('id'=>$_REQUEST['id'],'status'=>$_REQUEST['status']);
		$result = $this->service->updateSwitch($arr);		
		echo json_encode($result);
    } 
    /**
     * 选手列表
     */	
    public function queryList() {
		$info['status'] = $_REQUEST['status'];
        $result = $this->service->query($info);
        $totalRows = $this->service->getNotPassedCount(array('status'=>$_REQUEST['status']));
        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows
        ));
    }
    /**
     * 搜索
     */
    public function search() {
		$keyword = htmlspecialchars($_POST['keyword']);
		$id = intval($_POST['id']);
		if(empty($id) && empty($keyword)){
			echo json_encode(array('statu'=>false,'code'=>1,'msg'=>'','data'=>''));
			exit;
		}
		if(is_numeric($keyword)){
			$data = array('id'=>$keyword,'vid'=>$id,'status'=>1);
		}else{
			$data = array('item'=>$keyword,'vid'=>$id,'status'=>1);			
		}
        $result = $this->service->searchKeyWord($data);
		if($result->data){
			echo json_encode($result);
		}else{
			echo json_encode(array('statu'=>false,'code'=>1,'msg'=>'','data'=>''));		
		}		
	}
    /**
     * 加载
     */
    public function gListAjax() {
		$p = intval($_GET['page']) ? $_GET['page'] : 1;
		$vid = intval($_GET['id']);
		$type = $_GET['type'];
		switch($type){
			case 'dcount': $order = 'dcount';break;
			case 'vcount': $order = 'vcount';break;
			case 'icount': $order = 'id';break;
			default: $order = 'id';break;
		}
		//分页
		$size=8;
/* 		$stat = 1+($p-1)*$size;
		$end = $p*$size;
 		if($type =='dcount'){
			$abspath = rtrim ( $_SERVER ['DOCUMENT_ROOT'], '/' );
			$viewdir = $abspath.'/data/vote/'.$vid.'/';
			$viewurl = $abspath.'/data/vote/'.$vid.'/dcount.json';
			if(file_exists($viewurl)){
				$ids = '';
				$data = json_decode(file_get_contents($viewurl),true);
				arsort($data);
				$data = array_slice($data,$stat,$end,true);
				foreach($data as $key=>$value){
					$ids .= $key . ',';	
				}
				$ids = substr($ids, 0, strlen($ids) - 1);
				$voteitemlist = $this->service->getPassedListByIds($ids);
			}else{
				$voteitemlist = $this->service->getPassedList(array('status'=>1,'vid'=>$vid,'page'=>$p,'size'=>$size,'order'=>$order));				
			}			
		}else{ */
			$voteitemlist = $this->service->getPassedList(array('status'=>1,'vid'=>$vid,'page'=>$p,'size'=>$size,'order'=>$order));
		//}
        $count = $this->service->getPassedCount(array('status'=>1,'vid'=>$vid));
		$pagex=ceil($count/$size);
		
		if($p<=$pagex){
			$voteitemlist->page=$p+1;
		}
		$voteitemlist->sum=$pagex;
		echo json_encode($voteitemlist);		
	}
    /**
     * 投票(减少服务器请求设置cookie)
     */
    public function gVoteAjax() {
		$itid = intval($_POST['itid']);
		$ktcs = intval($_POST['ktcs']);
		$vnum = intval($_POST['vnum']);
		$id = intval($_POST['id']);
		$openid = $_POST['openid'];
		$wx_sftp = $this->_getcookie('wx_sftp');
		//$wx_sftp ='';
		if($wx_sftp){
			if($wx_sftp >=$ktcs){
				echo json_encode(array('statu'=>false,'code'=>0,'msg'=>'今天投票次数已用完！','data'=>''));	
			}else{
				$t = time();
				$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
				$result = $this->service->addPoll(array('id'=>$itid,'vinum'=>$vnum,'vid'=>$id,'openid'=>$openid));
				$this->_setcookie('wx_sftp',$wx_sftp+$vnum,$sur);
				echo json_encode($result);					
			}
		}else{			
			$votelogService = new VoteLogService();
			$count = $votelogService->queryCount($openid);
			if($count>=$ktcs){
				$t = time();
				$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
				$sur = $end - $t;
				$this->_setcookie('wx_sftp',$count,$sur);
				echo json_encode(array('statu'=>false,'code'=>0,'msg'=>'今天投票次数已用完！','data'=>''));		
			}else{
				$result = $this->service->addPoll(array('id'=>$itid,'vinum'=>$vnum,'vid'=>$id,'openid'=>$openid));
				$t = time();
				$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
				$sur = $end - $t;
				$this->_setcookie('wx_sftp',$count,$sur);
				echo json_encode($result);			
			}			
		}		
	}
	public function _getcookie($name){
		if(empty($name)){return false;}
		if(isset($_COOKIE[$name])){
			return $_COOKIE[$name];
		}else{		
			return false;
		}
	}
	//setcookie
	public function _setcookie($name,$value,$time=0,$path='/',$domain=''){		
		if(empty($name)){return false;}
		$_COOKIE[$name]=$value;				
		$s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		if(!$time){
			return setcookie($name,$value,0,$path,$domain,$s);
		}else{
			return setcookie($name,$value,time()+$time,$path,$domain,$s);
		}
	}	
}
