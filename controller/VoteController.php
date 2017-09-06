<?php
/**
 * 投票
 * @author Administrator
 *
 */
class VoteController extends Controller {
    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new VoteService();
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {		
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
		//$filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        //$filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
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
     * 获得单笔动态数据
     */
    public function get() {
        $this->blindParams($vote = new Vote());
        $result = $this->service->get($vote);
        echo json_encode($result);
    }

    /**
     * 编辑
     */
    public function edit() {
		$str = '';
		foreach($_REQUEST['piclist'] as $val){
			if(!preg_match("/thumbnail_auto.gif/i", $val) && $val !=''){
				$str .= $val . '|';
			}
		}
		$str = substr($str, 0, strlen($str) - 1);
		unset($_REQUEST['piclist']);
		$_REQUEST['wappicurl'] = $str;
		$_REQUEST['check'] = 0;
    	//$_REQUEST['start_time']=strtotime($_REQUEST['start_time']);
    	$_REQUEST['over_time']=strtotime($_REQUEST['over_time']);
    	$_REQUEST['statdate']=strtotime($_REQUEST['statdate']);
    	$_REQUEST['enddate']=strtotime($_REQUEST['enddate']);
    	$_REQUEST['fxtb']= NETADDRESS . '/upload' . $_REQUEST['fxtb'];
    	$_REQUEST['gztb']= NETADDRESS . '/upload' . $_REQUEST['gztb'];
        $this->blindParams($vote = new Vote());
        $result = $this->service->update($vote);
		
       	$votewxszService=new VoteWxszService();
		$arr = array('vid'=>$_REQUEST['id'],'appid'=>$_REQUEST['appid'],'appsecret'=>$_REQUEST['appsecret']);
		$res = $votewxszService->updateByVid($arr);	
		if($res->data==1){
			$abspath = rtrim ( $_SERVER ['DOCUMENT_ROOT'], '/' );
			$appurl = $abspath.'/data/vote/'.$_REQUEST['id'].'/share.json';
			if(file_exists($appurl)){
				$data = json_decode(file_get_contents($appurl));
				$appId  = $data->shareId;
				$token = $abspath.'/weixindb/access_token_'.$appId.'.json';
				$ticket = $abspath.'/weixindb/jsapi_ticket_'.$appId.'.json';
				@unlink($appurl);
				@unlink($token);
				@unlink($ticket);			
			}
		}		
        echo json_encode($result);
    }

    /**
     * 添加
     */
    public function add() {
		$str = '';
		foreach($_REQUEST['piclist'] as $val){
			if(!preg_match("/thumbnail_auto.gif/i", $val) && $val !=''){
				$str .= $val . '|';
			}
		}
		$str = substr($str, 0, strlen($str) - 1);
		unset($_REQUEST['piclist']);
		$_REQUEST['wappicurl'] = $str;
		$_REQUEST['checks'] = 0;
		$_REQUEST['add_time'] = time();
		$_REQUEST['ed_dcount'] = '';
    	//$_REQUEST['start_time']=strtotime($_REQUEST['start_time']);
    	$_REQUEST['over_time']=strtotime($_REQUEST['over_time']);
    	$_REQUEST['statdate']=strtotime($_REQUEST['statdate']);
    	$_REQUEST['enddate']=strtotime($_REQUEST['enddate']);
    	$_REQUEST['fxtb']= NETADDRESS . '/upload' . $_REQUEST['fxtb'];
    	$_REQUEST['gztb']= NETADDRESS . '/upload' . $_REQUEST['gztb'];
        $this->blindParams($vote = new Vote());
        $result = $this->service->save($vote);
		$_REQUEST['vid'] = $result->data->id;
         $this->blindParams($votewxsz = new VoteWxsz());
       	$votewxszService=new VoteWxszService();
		$res = $votewxszService->save($votewxsz);
        echo json_encode($res);
        

    }
    /**
     * 删除单笔数据
     */
    public function del() {
        // 是否单笔删除还是批量删除
        if (is_array($_REQUEST['id'])) {
            $votes= $_REQUEST['id'];
        } else {
        	$arr = explode(',',$_REQUEST['id']);
            $votes = $arr;
        }
        $result = $this->service->deleteBatch($votes);

        echo json_encode($result);
    }
    /**
     * 获得活动名称
     */	
    public function getName() {
        $result = $this->service->getName();
        echo json_encode($result);		
	}
    /**
     * 获得活动设置
     */	
    public function getSetList() {
		$vid = intval($_REQUEST['vid']);
		$data = array(array('id'=>'1','name'=>'钻石投票','content'=>'开启钻石投票后，投票将使用支付方式充值票数'),
				  array('id'=>'2','name'=>'自动统计','content'=>'每天自动统计与清空用户投票信息表')
			);
		$abspath = rtrim ( $_SERVER ['DOCUMENT_ROOT'], '/' );
		$voteseturl = $abspath.'/data/vote/'.$vid.'/setvote.json';
		$data1 = array('1'=>0,'2'=>0);
		if(file_exists($voteseturl)){
			$data1 = json_decode(file_get_contents($voteseturl),true);
		}else{
			file_put_contents($voteseturl,json_encode($data1));
		}

		foreach($data as $key=>$val){
			$data[$key]['status'] = $data1[$key+1];
			$data[$key]['vid'] = $vid;
		}
		
		$array =array();
		$array['rows'] = $data;
		$array['ttl'] = count($data);		
        echo json_encode($array);	
	}
    /**
     * 开启关闭设置
     */
    public function setSwitch() {  
		$id = intval($_REQUEST['id']);
		$vid = intval($_REQUEST['vid']);
		$status = intval($_REQUEST['status']);
		$abspath = rtrim ( $_SERVER ['DOCUMENT_ROOT'], '/' );
		$voteseturl = $abspath.'/data/vote/'.$vid.'/setvote.json';
		$data = json_decode(file_get_contents($voteseturl));
		$data->$id = $status;
		$fp = fopen($voteseturl, "w");
		$res = fwrite($fp, json_encode($data));
		fclose($fp);
		if($res){
			if($id==2){
				if($status==1){
					$this->service->onMysqlEvent($vid);
				}else{
					$this->service->offMysqlEvent($vid);					
				}
			}
			if($status==1){
				$result['data'] = 1;				
			}else{
				$result['data'] = 0;				
			}
			$result['statu'] = true;
			echo json_encode($result);	
		}else{
			$result['statu'] = false;
			echo json_encode($result);			
		}

    }
    public function getVoteUrls() {
        $data = $this->service->getVoteChecksAndTitle();
        if(count($data)>0){
			$result = array();
			foreach ($data as $key => $value) {
				$result['data'][$key]['url']='/addons/vote.php?method=index&id='.$value['id'];
				$result['data'][$key]['title']=$value['title'];				
			}
			$result['statu'] = true;
			echo json_encode($result);				
		}else{
			$result['statu'] = false;
          echo json_encode($result);			
		}
		
	}	
}
