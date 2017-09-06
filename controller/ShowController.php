<?php

define('REQUEST_METHOD',$_SERVER['REQUEST_METHOD']);
define('IS_AJAX',isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
define('IS_POST',       REQUEST_METHOD =='POST' ? true : false);
class ShowController extends Controller {

    private $service;

    /**
     * 构造函数
     */
    function __construct() {
    	
        parent::__construct();

       
        $this->service = new ShowService();
        
    }

    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
        $filterService = new FilterService();
        //$filterService->addFunc($filterService::$SQLINJECTION);
        //$filterService->addFunc($filterService::$WORKERLOGHISTORY);
        
        return $filterService->execute();
        
        
    }
	
    /**
     * 分页查询&数据列表
     */
    public function query() {
		$this->unlogin();
		$where['userid_int']  = intval($_SESSION['id']);
        $showList = $this->service->query($where);	
        
        if($showList){
			die(json_encode(array('statu' => true,'data' => $showList)));
		}else{
			die(json_encode(array('statu' => false,'data' => '')));		
		}
    }	
    /**
     * 判断是否登录
     */
    public function check() {

        if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
            $data = array(
                'date' => time()
            );
			echo json_encode(array('success'=>true,'code'=>200,'msg'=>'操作成功','obj'=>$data));
        } else {
			echo json_encode(array('success'=>false,'code'=>25,'msg'=>'','obj'=>''));
        }
    }
	
    /**
     * 未登录
     */
 	public function unlogin(){
		if(empty($_SESSION['id']))
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 error');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		}		
	}
 
    
    /**
     * 获取场景信息
     */
    public function scenePageList() {
			$this->unlogin();
			
			$where['sceneid_bigint']  = intval($_REQUEST['id']);
			$where['mytypl_id']=0;
			$where['userid_int'] = 0;
			if(!empty($_SESSION['id']))
			{
				$where['userid_int']  = intval($_SESSION['id']);
			}
			$_scene_page_list = $this->service->scenePageList($where); 
			
			$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
			$jsonstrtemp = '';
			foreach($_scene_page_list as $vo){
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"sceneId":'.$vo["sceneid_bigint"].',"num":'.$vo["pagecurrentnum_int"].',"name":"'.$vo["pagename_varchar"].'","properties":null,"elements":null,"scene":null},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
			echo $jsonstr;		
	}
      public function design() {
			$this->unlogin();
			$where['id']  = intval($_REQUEST['id']);
			$where['userid_int'] = $where2['userid_int'] = 0;
			if(!empty($_SESSION['id']))
			{
				$where['userid_int'] = $where2['userid_int'] = intval($_SESSION['id']);
			}

			$_scene_page_lists = $this->service->scenePageLists($where);			
			if(empty($_scene_page_lists))
			{
				header('HTTP/1.1 403 Unauthorized');
				echo json_encode(array("success" => false,"code"=> 403,"msg" => "false","obj"=> null,"map"=> null,"list"=> null));
				exit;
			}
			$where2['delete_int']  = 0;
			$where2['id']  = $_scene_page_lists[0]['sceneid_bigint'];

			$_scene_list2 = $this->service->sceneList($where2);
			$replaceArray = json_decode($_scene_page_lists[0]['content_text'],true);

			foreach($replaceArray as $key => $value){
				$replaceArray[$key]['sceneId'] = $_scene_page_lists[0]['sceneid_bigint'];
				$replaceArray[$key]['pageId'] = $where['id'];
			}
			$replaceArray = json_encode($replaceArray);
	
			$jsonstr = '{"success": true,"code": 200,"msg": "success","obj": {"id": '.$_scene_page_lists[0]['id'].',"sceneId": '.$_scene_page_lists[0]['sceneid_bigint'].',"num": '.$_scene_page_lists[0]['pagecurrentnum_int'].',"name": null,"properties": '.$_scene_page_lists[0]["properties_text"].',"elements": '.$replaceArray.',"scene": {"id": '.$_scene_list2[0]['id'].',"name": '.json_encode($_scene_list2[0]['scenename_varchar']).',"createUser": "'.$_scene_list2[0]['userid_int'].'","createTime": 1425998747000,"type": '.$_scene_list2[0]['scenetype_int'].',"pageMode": '.$_scene_list2[0]['movietype_int'].',"image": {"imgSrc": "'.$_scene_list2[0]['movietype_int'].'","isAdvancedUser": false';
			if($_scene_list2[0]['musicurl_varchar']!=''){
				$jsonstr = $jsonstr.',"bgAudio": {"url": "'.$_scene_list2[0]["musicurl_varchar"].'","type": "'.$_scene_list2[0]["musictype_int"].'"}';
			}
			$jsonstr = $jsonstr.'},"isTpl": 0,"isPromotion": 0,"status": 1,"openLimit": 0,"submitLimit": 0,"startDate": null,"endDate": null,	"accessCode": null,	"thirdCode": null,"updateTime": 1426038857000,"publishTime": 1426038857000,"applyTemplate": 0,"applyPromotion": 0,	"sourceId": null,"code": "'.$_scene_list2[0]['scenecode_varchar'].'","description": "'.($_scene_list2[0]['desc_varchar']).'","sort": 0,"pageCount": 0,"dataCount": 0,"showCount": '.$_scene_list2[0]['hitcount_int'].',"userLoginName": null,"userName": null}},"map": null,"list": null}';
			echo $jsonstr;		  
	  } 
    /**
     * 获取模板子菜单
     */	  
	public function upfileSysTag(){
		$this->unlogin();
		
		//header('Content-type: text/json');
		$where['userid_int']  = 0;
		$where['type_int']  = isset($_REQUEST['type']) ? intval($_REQUEST['type']) : 88;
		$where['biztype_int']  = isset($_REQUEST['bizType']) ? intval($_REQUEST['bizType']) : 0;

			$m_upfilelist = $this->service->upfileList($where);

		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		if($m_upfilelist){
			foreach($m_upfilelist as $vo)
			{
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		}
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
		
	}
    /**
     * 获取模板图片列表
     */	
    public function sysPageTpl(){
		
		$this->unlogin();
		
		$where['tagid_int']  = isset($_REQUEST['tagId']) ? intval($_REQUEST['tagId']) : 0;
		$where['userid_int']  = 0;	

		$_scene_list = $this->service->getSysPageTpl($where);		
		
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map": null,"list": [';
		$jsonstrtemp = '';
		foreach($_scene_list as $vo){
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"sceneId":1,"num":1,"name":"name","properties":{"thumbSrc":"'.$vo["thumbsrc_varchar"].'"},"elements":null,"scene":null},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
    }
    /**
     * 新建分页面
     */
	 public function createPage(){ 
			$this->unlogin();
		
			$where['id']  = $getid =  intval($_REQUEST['id']);
			$where['userid_int'] =  (!empty($_SESSION['id'])) ? intval($_SESSION['id']) : 0;
			$iscopy  = (isset($_REQUEST['copy']) && $_REQUEST['copy'] == true ) ? "true" : "false";

			$_scene_list = $this->service->scenePageLists($where);
			
			if(!$_scene_list)
			{
				header('HTTP/1.1 403 Unauthorized');
				echo json_encode(array("success" => false,"code"=> 403,"msg" => "false","obj"=> null,"map"=> null,"list"=> null));
				exit;
			}
			$datainfo = new ShowScenePage();
			$datainfo->scenecode_varchar = $_scene_list[0]['scenecode_varchar'];
			$datainfo->sceneid_bigint = $_scene_list[0]['sceneid_bigint'];
			$datainfo->pagecurrentnum_int = $_scene_list[0]['pagecurrentnum_int']+1;
			$datainfo->createtime_time = date('y-m-d H:i:s',time());
			if($iscopy=="true")
			{
				$datainfo->content_text = $_scene_list[0]['content_text'];
			}
			else
			{
				$datainfo->content_text = "[]";
			}
			$datainfo->pagename_varchar = '';
			$datainfo->properties_text = 'null';
			$datainfo->userid_int = intval($_SESSION['id']);
			$datainfo->mytypl_id = 0;
			$result = $this->service->saveScenePage($datainfo);
			if(!$result)
			{
				header('HTTP/1.1 403 Unauthorized');
				echo json_encode(array("success" => false,"code"=> 403,"msg" => "创建失败","obj"=> null,"map"=> null,"list"=> null));
				exit;
			}				
			$where2['id']  = $_scene_list[0]['sceneid_bigint'];
			$where2['delete_int']  = 0;
			if(!empty($_SESSION['id']))
			{
				$where2['userid_int'] =  intval($_SESSION['id']);
			}
			$_scene_list2 = $this->service->sceneList($where2);		

			$jsonstr = '{
					"success": true,
					"code": 200,
					"msg": "success",
					"obj": {
						"id": '.$result.',
						"sceneId": '.$_scene_list[0]['sceneid_bigint'].',
						"num": '.($_scene_list[0]['pagecurrentnum_int']+1).',
						"name": null,
						"properties": null,
						"elements": null,
						"scene": {
							"id": '.$_scene_list2[0]['id'].',
							"name": '.json_encode($_scene_list2[0]['scenename_varchar']).',
							"createUser": "'.$_scene_list2[0]['userid_int'].'",
							"createTime": 1425998747000,
							"type": '.$_scene_list2[0]['scenetype_int'].',
							"pageMode": '.$_scene_list2[0]['movietype_int'].',
							"image": {
								"imgSrc": "'.$_scene_list2[0]['thumbnail_varchar'].'",
								"isAdvancedUser": false
							},
							"isTpl": 0,
							"isPromotion": 0,
							"status": '.$_scene_list2[0]['showstatus_int'].',
							"openLimit": 0,
							"submitLimit": 0,
							"startDate": null,
							"endDate": null,
							"accessCode": null,
							"thirdCode": null,
							"updateTime": 1426039827000,
							"publishTime": 1426039827000,
							"applyTemplate": 0,
							"applyPromotion": 0,
							"sourceId": null,
							"code": "'.$_scene_list2[0]['scenecode_varchar'].'",
							"description": '.json_encode($_scene_list2[0]['desc_varchar']).',
							"sort": 0,
							"pageCount": 0,
							"dataCount": 0,
							"showCount": 0, 
							"userLoginName": null,
							"userName": null
						}
					},
					"map": null,
					"list": null,
					"iscopy":"'.$iscopy.'-----'.$getid.'"
				}';
			echo $jsonstr;				
	}
    /**
     * 点击获取分页信息前保存信息
     */	
    public function savePage(){
		$this->unlogin();
        if (IS_POST) {
			$uid = intval($_SESSION['id']);
			$datas = json_decode(file_get_contents("php://input"),true);
			$where['id'] = $datas['id'];
			$where['sceneid_bigint'] = $datas['sceneId'];
			$datainfo['pagecurrentnum_int'] = intval($datas['num']);
			$datainfo['properties_text'] = json_encode($datas['properties']);
			$where['userid_int'] = $uid;
			
		$wheredata['userid_int'] = $uid;
		$wheredata['pageid_bigint'] = $where['id'];
		$wheredata['sceneid_bigint'] = $where['sceneid_bigint'];
		$this->service->delSceneData($wheredata);
		
			foreach ($datas['elements'] as $key => $val ) 
			{	
				
				if($val['type']==5 || $val['type']==501 || $val['type']==502 || $val['type']==503 ){  // 501姓名、502手机 、503邮箱、5 文本
					$dataList = new ShowSceneData();
					$dataList->sceneid_bigint = $where['sceneid_bigint'];
					$dataList->pageid_bigint = $where['id'];
					$dataList->elementid_int = $val['id'];
					$dataList->elementtitle_varchar = $val['title'];
					$dataList->elementtype_int = $val['type'];
					$dataList->userid_int = $uid;		
					$this->service->saveSceneData($dataList);
					unset($dataList);
				}
				
			}
			$datainfo['content_text'] = json_encode($datas['elements']);
			$datainfo['id'] = $datas['id'];
			$datainfo['sceneid_bigint'] = $datas['sceneId'];
			$datainfo['userid_int'] = $uid;			
			$res = $this->service->updateMyPage($datainfo);
			if(isset($datas['scene']['image']['bgAudio']) && $datas['scene']['image']['bgAudio']['url']!="")
			{	
				$bgdatainfo['musicurl_varchar'] = $datas['scene']['image']['bgAudio']['url'];
				$bgdatainfo['musictype_int'] = $datas['scene']['image']['bgAudio']['type'];
			}else{
				$bgdatainfo['musicurl_varchar'] = '';
			}
			$bgdatainfo['id'] = $datas['id'];
			$bgdatainfo['sceneid_bigint'] = $datas['sceneId'];
			$bgdatainfo['userid_int'] = $uid;
			$m_scene = $this->service->updateMyScene($bgdatainfo);
			
			unset($datas,$datainfo,$bgdatainfo);
			
			echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> null,"map"=> null,"list"=> null));
		}
    }
    /**
     * 删除分页
     */
    public function delPage(){
		$this->unlogin();
			$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
			$userid  = intval($_SESSION['id']);
			$this->service->delScenePage($id);    
		echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> null,"map"=> null,"list"=> null));
    }
    /**
     * 素材浏览量 +1
     */
    public function usePageCount(){
		$where['id'] = intval($_REQUEST['id']);
		$this->service->initAddPageSysCount($where);
    }
    /**
     * 浏览量 +1
     */
    public function addpv(){
		$where['id'] = intval($_REQUEST['id']);
		$this->service->addSceneViewCount($where);
    }
    /**
     * 点击素料 通过id获取素材
     */	
	public function sysPageInfo(){
		$this->unlogin();
		$id  = intval($_REQUEST['id']);
		$_scene_info=$this->service->sysPageInfoById($id);
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":{"id":'.$_scene_info['id'].',"sceneId":1,"num":1,"name":"sys","properties":{"thumbSrc":"'.$_scene_info['thumbsrc_varchar'].'"},"elements":'.$_scene_info['content_text'].',"scene":null},"map":null,"list":null}';
		echo $jsonstr;
    }
	
	public function my(){
		$this->unlogin();
		
		header('Content-type: text/json');
		$where['userid_int']  = intval($_SESSION['id']);
		$where['type_int']=1;
		$where['biztype_int']  = 0;

		$m_upfilelist = $this->service->upfileList($where);
			
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
		
	}
    /**
     * 用户上传文件(我的背景)
     */		
	public function userList(){
		$this->unlogin();	
		header('Content-type: text/json');

		$where['userid_int']  = intval($_SESSION['id']);
		$where['biztype_int']  = isset($_REQUEST['bizType']) ? intval($_REQUEST['bizType']) : 0;
		$where['filetype_int']  = isset($_REQUEST['fileType']) ? intval($_REQUEST['fileType']) : 0;
		$pageno = isset($_REQUEST['pageNo']) ? intval($_REQUEST['pageNo']) : 1;
		
		$where['tagid_int'] = (isset($_REQUEST['tagId']) && $_REQUEST['tagId']>0)  ? intval($_REQUEST['tagId']) : '';
		$where['delete_int']  = 0;
		$where['showsize'] = isset($_REQUEST['pageSize']) ? intval($_REQUEST['pageSize']) : 17;
		if($where['showsize']>30){
			$where['showsize'] = 30;
		}
		$where['startpage'] = ($pageno-1) * $where['showsize'];
		$m_upfilelist = $this->service->myUpfileList($where);
		
		$m_upfile_count = $this->service->countUpfileList($where);

		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":{"count":'.$m_upfile_count.',"pageNo":'.$pageno.',"pageSize":'.$where['showsize'].'},"list":[';
		$jsonstrtemp = '';
		if($m_upfile_count >0 ){
			foreach($m_upfilelist as $vo)
			{
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"name":'.json_encode($vo["filename_varchar"]).',"extName":"'.$vo["ext_varchar"].'","fileType":'.$vo["filetype_int"].',"bizType":'.$vo["biztype_int"].',"path":"'.$vo["filesrc_varchar"].'","tmbPath":"'.$vo["filethumbsrc_varchar"].'","createTime":1426209633000,"createUser":"'.$vo["userid_int"].'","sort":0,"size":'.$vo["sizekb_int"].',"status":1},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		}
		$jsonstr = $jsonstr.']}';
		unset($m_upfilelist);
		echo $jsonstr; 	
	}
    /**
     * 背景库、音乐、图片...
     */
	public function sysList(){
		$this->unlogin();	
		header('Content-type: text/json');
		
		$biztype_int  = isset($_REQUEST['bizType']) ? intval($_REQUEST['bizType']) : 0;		
		if($biztype_int>0){
			$where['biztype_int']  = $biztype_int;
		}

		$where['filetype_int']  = isset($_REQUEST['fileType']) ? intval($_REQUEST['fileType']) : 0;
		$pageno = isset($_REQUEST['pageNo']) ? intval($_REQUEST['pageNo']) : 1;
		$where['tagid_int'] = (isset($_REQUEST['tagId']) && $_REQUEST['tagId']>0)  ? intval($_REQUEST['tagId']) : '';
		
		$where['showsize'] = isset($_REQUEST['pageSize']) ? intval($_REQUEST['pageSize']) : 17;

		if($where['showsize']>40){
			$where['showsize'] = 40;
		}
		$where['startpage'] = ($pageno-1) * $where['showsize'];
		$c_upfilelist = $this->service->upfileSysList($where);

		$c_upfile_count = $this->service->countUpfileSysList($where);

		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":{"count":'.$c_upfile_count.',"pageNo":'.$pageno.',"pageSize":'.$where['showsize'].'},"list":[';
		$jsonstrtemp = '';
		if($c_upfile_count > 0){
			foreach($c_upfilelist as $vo)
			{
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"name":'.json_encode($vo["filename_varchar"]).',"extName":"'.$vo["ext_varchar"].'","fileType":'.$vo["filetype_int"].',"bizType":'.$vo["biztype_int"].',"path":"'.$vo["filesrc_varchar"].'","tmbPath":"'.$vo["filethumbsrc_varchar"].'","createTime":1426209633000,"createUser":"'.$vo["userid_int"].'","sort":0,"size":'.$vo["sizekb_int"].',"status":1},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		}
		$jsonstr = $jsonstr.']}';
			unset($c_upfilelist);	
		echo $jsonstr;
		
	}

    /**
     * 创建分类
     */	
    public function createTag(){
		$this->unlogin();
		include ENTITYPATH . 'ShowTag.php';
		$datainput = new ShowTag();
		$datainput->name_varchar = isset($_REQUEST['tagName']) ? $_REQUEST['tagName'] : '';
		$datainput->type_int = 1;
		$datainput->biztype_int = 0;
		$datainput->userid_int = intval($_SESSION['id']);
		$datainput->create_time = date('y-m-d H:i:s',time());
		
		$result = $this->service->createShowTag($datainput);
		echo json_encode(array("success" => true,"code"=> 200,"msg" => "操作成功","obj"=> $result,"map"=> null,"list"=> null));	
    }
	
    /**
     * 重新分类
     */	
    public function setUpfileTagId() {
		$this->unlogin();
		$where['ids'] = isset($_REQUEST['fileIds']) ? $_REQUEST['fileIds'] : 0;
		$where['userid_int'] = intval($_SESSION['id']);
		$where['tagid_int'] = isset($_REQUEST['tagId']) ? intval($_REQUEST['tagId']) : 0;
		$result = $this->service->setUpfileTagId($where);
		
		echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> $result,"map"=> null,"list"=> null));
    }
    /**
     * 删除分类
     */
    public function deleteTag() {
		$this->unlogin();

		$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
		$result = $this->service->delTag($id);
		
		echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> $result,"map"=> null,"list"=> null));
    }
    /**
     * 发布
     */	
	public function publish(){
		$this->unlogin();
	 
		$where['id'] = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
		$where['publish_time'] = time();
		$where['userid_int'] = intval($_SESSION['id']);
		$result = $this->service->updatePublish($where);
		if($result){
			$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';				
		}else{
			$jsonstr='{"success":false,"code":101,"msg":"操作失败","obj":null,"map":null,"list":null}';	
		}
			
 		echo $jsonstr;
	}
    /**
     * 秀场详情
     */	
    public function detail(){
		$this->unlogin();
		$where['userid_int']  = intval($_SESSION['id']);
		$where['id']  = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
		$where['delete_int']  = 0;
		$_scene_list=$this->service->sceneDetail($where);    
		
		if($_scene_list){
			$_scene_list['lastpageid']=$_scene_list['lastpageid']>0? intval($_scene_list['lastpageid']):0;
			$jsonstr = '{
				"success": true,
				"code": 200,
				"msg": "success",
				"obj": {
					"id": '.$_scene_list['id'].',
					"name": '.json_encode($_scene_list['scenename_varchar']).',
					"createUser": "'.$_scene_list['userid_int'].'",
					"createTime": 1425998747000,
					"type": '.$_scene_list['scenetype_int'].',
					"pageMode": '.$_scene_list['movietype_int'].',
					"eqcode": "'.$_scene_list['eqcode'].'",
					"image": {
						"imgSrc": "'.$_scene_list['thumbnail_varchar'].'",
						"isAdvancedUser": '.$_scene_list['isadvanceduser'].',
						"lastPageId":'.$_scene_list['lastpageid'].',
						"hideEqAd":'.$_scene_list['hideeqad'];
					if($_scene_list["musicurl_varchar"]!='')
					{
						$jsonstr = $jsonstr.',"bgAudio": {"url": "'.$_scene_list["musicurl_varchar"].'","type": "'.$_scene_list["musictype_int"].'"}';
					}
					$jsonstr = $jsonstr.'},
					"isTpl": 0,
					"isPromotion": 0,
					"status": '.$_scene_list['showstatus_int'].',
					"openLimit": 0,
					"submitLimit": 0,
					"startDate": null,
					"endDate": null,
					"accessCode": null,
					"thirdCode": null,
					"updateTime": 1426041829000,
					"publishTime": 1426041829000,
					"applyTemplate": 0,
					"applyPromotion": 0,
					"sourceId": null,
					"code": "'.$_scene_list['scenecode_varchar'].'",
					"description": '.json_encode($_scene_list['desc_varchar']).',
					"sort": 0,
					"pageCount": 0,
					"dataCount": '.$_scene_list["datacount_int"].',
					"showCount": '.$_scene_list['hitcount_int'].',
					"userLoginName": null,
					"userName": null
				},
				"map": null,
				"list": null
			}';
		}else{
			$jsonstr = '{"success":false,"code":101,"msg":null,"obj":null,"map":null,"list":null}';
		}
		echo $jsonstr;

    }
    /**
     * 缩略图（尾页）
     */	
	public function getPageTpl(){
		$this->unlogin();
		$where['filetype_int']  = isset($_REQUEST['type']) ? intval($_REQUEST['type']) : 1301;
		$_pageTpllsit=$this->service->getPageTplSys($where);
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		if($_pageTpllsit){
			$jsonstrtemp = '';
			foreach($_pageTpllsit as $vo)
			{
				$jsonstrtemp = $jsonstrtemp
					.'{"id":'.$vo["id"].',"sceneId":1301,"num":1,"name":null,"properties":{"thumbSrc":"'.$vo["filethumbsrc_varchar"].'"},"elements":null,"scene":null},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		}
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
	}
    /**
     * 场景类型
     */	
    public function typeList(){
		$this->unlogin();
		header('Content-type: text/json');
		header('HTTP/1.1 200 ok');
		
		$jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		$where['type'] = 'scene_type';
		$list = $this->service->getCateTypeList($where);
	 	if($list){
			foreach($list as $i=> $vo){
				$sort=$i+1;
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"name":"'.$vo["title"].'","value":'.$vo["value"].',"type":"'.$vo["type"].'","sort":'.$sort.',"status":1,"remark":null},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		}
		$jsonstr = $jsonstr.']}';
		echo $jsonstr;
	}	
		

    /**
     * 上传文件
     */	
	public function upload(){
		$this->unlogin();
		$userid  = intval($_SESSION['id']);	
		include ABSPATH . '/addons/upload.php';
		
		$upload = new Upload();      // 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		$filetype  = isset($_REQUEST['fileType']) ? intval($_REQUEST['fileType']) : 0;
		if($filetype==2)
		{
			$upload->exts = array('mp3');// 设置附件上传类型
			$upload->savePath = 'show/mp3/'.$userid.'/'; // 设置附件上传（子）目录
		}
		else
		{
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath = 'show/pic/'.$userid.'/'; // 设置附件上传（子）目录
		}
		$upload->rootPath =  ABSPATH . '/upload/'; // 设置附件上传根目录
		$upload->subName  = array('date','Ym');
		// 采用时间戳命名
		$upload->saveName = 'uniqid';
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			header('Content-type: text/json');
			header('HTTP/1.1 401 error');
			$msg = $upload->getError();
			echo json_encode(array("success" => false,"code"=> 401,"msg" => $msg,"obj"=> null,"map"=> null,"list"=> null));
		}else{// 上传成功 获取上传文件信息
			header('Content-type: text/json');
			header('HTTP/1.1 200 ok');
			foreach($info as $file){
				$thubimagenew = $file['savepath'].$file['savename'];
				if($filetype!=2)
				{
					include ABSPATH . '/addons/image.php'; 
					$image = new Image();
					$thubimage = $file['savepath'].$file['savename'];
					$image->open($upload->rootPath.$thubimage);
					$thubimagenew = str_replace(".".$file['ext'],"_thumb.".$file['ext'],$file['savename']);
					$thubimagenewftp =$thubimagenew;
					$thubimagenew =  $file['savepath'].$thubimagenew;
					// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
					if($filetype==0)
					{
						$image->thumb(80, 126)->save($upload->rootPath.$thubimagenew);
					}
					else
					{
						$image->thumb(80, 80)->save($upload->rootPath.$thubimagenew);
					}
				}
				$sizeint = intval($file['size']/1024);
				// 保存当前数据对象 取得成功上传的文件信息
				$data = new ShowUpfile();
				$data->ext_varchar = strtoupper($file['ext']);
				$data->filename_varchar = $file['name'];
				$data->filetype_int = $filetype;
				$data->biztype_int = isset($_REQUEST['bizType']) ? intval($_REQUEST['bizType']) : 0;
				$data->userid_int = $userid;
				$data->filesrc_varchar = $file['savepath'].$file['savename'];
				$data->sizekb_int = $sizeint;
				$data->filethumbsrc_varchar = $thubimagenew;
				$data->create_time = date('y-m-d H:i:s',time());
				$data->delete_int = 0;
				$data->delete_int = 0;
				$data->tagid_int = 0;
				$id = $this->service->addMyUpfile($data);
				if($id){
					$jsonstr = '{"success":true,"code":200,"msg":"success","obj":{"id":'.$id.',"name":"'.$file['savename'].'","extName":"'.strtoupper($file['ext']).'","fileType":0,"bizType":0,"path":"'.$file['savepath'].$file['savename'].'","tmbPath":"'.$thubimagenew.'","createTime":1426209412922,"createUser":"'.$userid.'","sort":0,"size":'.$sizeint.',"status":1},"map":null,"list":null}';
					echo $jsonstr;
				}else{
					$msg = $image->getError();
					echo json_encode(array("success" => false,"code"=> 1001,"msg" => "上传失败：" . $msg,"obj"=> null,"map"=> null,"list"=> null));					
				}
			}
		}
    }
   /**
     * 预览
     */	
   public function view(){

		$isPreview  = isset($_REQUEST['preview']) ? $_REQUEST['preview'] : 0;
		$id  = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;	
		if(is_numeric($_REQUEST['id'])){
			$where2['id']  = intval($id);
		}else{
			$where2['scenecode_varchar']  = $id;
		}
		$where2['delete_int']  = 0;

		$_scene_list2=$this->service->sceneDetail2($where2); 

		if($_scene_list2['showstatus_int']!=1)
		{
			if($_scene_list2['userid_int']!=intval($_SESSION['id']))
			{
				$where3['id']  = 267070;
				$where3['delete_int']  = 0;
				$_scene_list2=$this->service->sceneDetail2($where3);
			}  
		}  
		
		$where['sceneid_bigint']  = $_scene_list2['id'];
		$where['userid_int'] = 0;
		if(!empty($_SESSION['id']))
		{
			$where['userid_int']  = intval($_SESSION['id']);
		}
		$_scene_list = $this->service->scenePageList2($where); 

		$_scene_list2['lastpageid']=$_scene_list2['lastpageid']>0? intval($_scene_list2['lastpageid']):0;

		$jsonstr = '{"success": true,"code": 200,"msg": "操作成功","obj": {"id": '.$_scene_list2['id'].',"name": '.json_encode($_scene_list2['scenename_varchar']).',"createUser": "'.$_scene_list2['userid_int'].'","type": '.$_scene_list2['scenetype_int'].',"pageMode": '.$_scene_list2['movietype_int'].',"image": {"imgSrc": "'.$_scene_list2['thumbnail_varchar'].'","lastPageId":'.$_scene_list2['lastpageid'].',"hideEqAd":'.$_scene_list2['hideeqad'];
		if($isPreview){
			$this->unlogin();
			$jsonstr = $jsonstr.',"isAdvancedUser": true';
		}else{
			$jsonstr = $jsonstr.',"isAdvancedUser": '.$_scene_list2['isadvanceduser'];
		}	
		if($_scene_list2["musicurl_varchar"]!='')
		{
			$jsonstr = $jsonstr.',"bgAudio": {"url": "'.$_scene_list2["musicurl_varchar"].'","type": "'.$_scene_list2["musictype_int"].'"}';
		}
		$_scene_list2['hitcount_int']=$_scene_list2['hitcount_int']?intval($_scene_list2['hitcount_int']):0;
		
		$jsonstr = $jsonstr.'},"isTpl": 0,"isPromotion": 0,"status": 1,"openLimit": 0,"startDate": null,"endDate": null,"updateTime": 1426045746000,"createTime": 1426572693000,"publishTime":1426572693000,"applyTemplate": 0,"applyPromotion": 0,"sourceId": null,"code": "'.$_scene_list2['scenecode_varchar'].'","description": '.json_encode($_scene_list2['desc_varchar']).',"sort": 0,"pageCount": 0,"dataCount": 0,"showCount": '.$_scene_list2['hitcount_int'].',"eqcode" :"'.$_scene_list2['eqcode'].'","userLoginName": null,"userName": null},"map": null,"list": [';
		$jsonstrtemp = '';
		foreach($_scene_list as $vo)
        {	
			if(strpos($vo["content_text"],'eqs\/link?id')!==false){
				$vo["content_text"]=str_replace('eqs\/link?id','?c=scene&a=link&id',$vo["content_text"]);
				
			}

			$jsonstrtemp = $jsonstrtemp .'{"id": '.$vo["id"].',"sceneId": '.$vo["sceneid_bigint"].',"num": '.$vo["pagecurrentnum_int"].',"name": null,"properties":'.$vo["properties_text"].',"elements": '.$vo["content_text"].',"scene": null},';
		}

		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		echo $jsonstr;
    }
   /**
     * 创建新的场景
     */
    public function addScene() { 
		$this->unlogin();
		if (IS_POST) {
			$datas = $_POST;
			$this->blindParams($datainfo = new ShowScene());
			$datainfo->scenecode_varchar = 'U'.(date('y',time())-9).date('m',time()).$this->randorderno(6,-1);
			$datainfo->scenename_varchar = $datas['name'];
			$datainfo->movietype_int = isset($datas['pageMode']) ? $datas['pageMode'] : 0;
			$datainfo->scenetype_int = intval($datas['type']);
			$datainfo->ip_varchar = '127.0.0.1';
			$datainfo->thumbnail_varchar = "show/default_thum.jpg";
			$datainfo->userid_int = intval($_SESSION['id']);
			$datainfo->createtime_time = date('y-m-d H:i:s',time());	
			$result1 = $this->service->saveScene($datainfo);
			if($result1){
				$this->blindParams($datainfo2 = new ShowScenePage());
				$datainfo2->scenecode_varchar = $datainfo->scenecode_varchar;
				$datainfo2->sceneid_bigint = $result1;
				$datainfo2->content_text = "[]";
				$datainfo2->properties_text = 'null';
				$datainfo2->userid_int = intval($_SESSION['id']);
				$datainfo2->createtime_time = date('y-m-d H:i:s',time());
				$result2 = $this->service->saveScenePage($datainfo2);
				echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> $result1,"map"=> null,"list"=> null));
			}else{
				echo json_encode(array("success" => false,"code"=> 1001,"msg" => "创建场景失败","obj"=> $result1,"map"=> null,"list"=> null));
			}
		}
	}
   /**
     * 删除场景
     */
    public function delScene(){
		$this->unlogin();
		$map['id']= isset($_REQUEST['Id']) ? intval($_REQUEST['Id']) : 0;
		$map['userid_int']  = intval($_SESSION['id']);
		$res = $this->service->delScene($map);
		if($res){
			echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> null,"map"=> null,"list"=> null));
		}else{
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "","obj"=> null,"map"=> null,"list"=> null));			
		}
    }

   /**
     * 复制场景
     */
    public function copyScene(){
		$this->unlogin();
		$this->blindParams($datainfo = new ShowScene());
        $data1 = $this->service->get($datainfo);
		$sceneid = $data1->id;
		$data1->scenecode_varchar = 'U'.(date('y',time())-9).date('m',time()).$this->randorderno(6,-1);
		$data1->createtime_time = date('y-m-d H:i:s',time());
		$data1->userid_int = intval($_SESSION['id']);
		$data1->id = '';
			$result1 = $this->service->saveScene($data1);		
		if($result1){
			$where['sceneid_bigint']  = $sceneid;
			$where['userid_int'] = 0;
			$where['userid_int']  = intval($_SESSION['id']);
			$_scene_list = $this->service->scenePageList3($where);
			$n = count($_scene_list);
			for($i=0; $i<$n; $i++){
				$_scene_list[$i]->id = '';
				$_scene_list[$i]->sceneid_bigint = $result1;
				$_scene_list[$i]->content_text = str_replace($sceneid,$result1,$_scene_list[$i]->content_text);
				$_scene_list[$i]->scenecode_varchar = $data1->scenecode_varchar;
				$_scene_list[$i]->createtime_time = date('y-m-d H:i:s',time());
				$this->service->saveScenePage($_scene_list[$i]);			
			}
		}
			echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> null,"map"=> null,"list"=> null));	
	}
   /**
     * 获取场景信息
     */		
	public function getSceneSet(){
		$this->unlogin();
		
		$where['id']  = isset($_REQUEST['sceneid']) ? intval($_REQUEST['sceneid']) : 0;
		$where['delete_int'] = 0;
		$where['userid_int']  = intval($_SESSION['id']);
		$_scene_set = $this->service->sceneList($where);
		echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> $_scene_set[0],"map"=> null,"list"=> null));			
	}
   /**
     * 设置场景信息
     */	
	public function saveSettings(){
		$this->unlogin();
		$datas = $_POST;

		$datainfo['id'] = $datas['sceneid'];
		$datainfo['scenename_varchar'] = $datas['name'];
		$datainfo['movietype_int'] = intval($datas['pagemode']);
		$datainfo['thumbnail_varchar'] = $datas['pic'];
		$datainfo['desc_varchar'] = $datas['desc'];		
		
		$datainfo['userid_int'] = intval($_SESSION['id']);
		
		$m_scene=$this->service->saveSettings($datainfo);
		if($m_scene){
			echo json_encode(array("success" => true,"code"=> 200,"msg" => null,"obj"=> null,"map"=> null,"list"=> null));	
		}else{
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "设置场景信息失败，请联系管理员","obj"=> null,"map"=> null,"list"=> null));			
		}
	}
   /**
     * 分享 +1 (朋友圈、朋友、QQ、微博、QQ空间) 
     */	
	public function share(){
		if(IS_POST){
			$where['scene_id']  = isset($_POST['sceneid']) ? intval($_POST['sceneid']) : 0;
			$where['channel']  = isset($_POST['channel']) ? intval($_POST['channel']) : '';
			
			$share = $this->service->isShareBySceneid($where['sceneid']);

			if($share){
				$this->service->updateShare($where);
			}else{
				$showshare = new ShowShare();
				$showshare->validate();	
				$showshare->scene_id = $where['scene_id'];
				$showshare->$where['channel'] = 1;
				$this->service->addShare($showshare);	
			}
		}
	}
   /**
     * 获取数据
     */	
	public function queryShare(){
		
		$_REQUEST['delete_int'] = 0;
        $share = $this->service->queryShare($_REQUEST);
        $totalRows = $this->service->totalRowsShare($_REQUEST);
        echo json_encode(array(
            'rows' => $share->data,
            'ttl' => $totalRows->data
        ));		
	}
   /**
     * 获取详情数据
     */	
	public function getDetail(){
		$this->unlogin();
		
		$datas['delete_int'] = 0;
		$datas['id'] = intval($_POST['sceneid']);
        $data = $this->service->getDetail($datas);
		if($data){
			echo json_encode(array("success" => true,"code"=> 200,"msg" => null,"obj"=> $data,"map"=> null,"list"=> null));	
		}else{
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => null,"obj"=> null,"map"=> null,"list"=> null));			
		}		
	}
   /**
     * 获取公众号配置信息
     */	
	public function getConfig(){
		$this->unlogin();

        $data = $this->service->getConfig();
		if($data){
			echo json_encode(array("success" => true,"code"=> 200,"msg" => null,"obj"=> $data,"map"=> null,"list"=> null));	
		}else{
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => null,"obj"=> null,"map"=> null,"list"=> null));			
		}		
	}
   /**
     * 配置公众号信息
     */	
	public function saveConfig(){
		$this->unlogin();
		$data['web_appid'] = trim($_POST['appid']);
		$data['web_appsecret'] = trim($_POST['appsecret']);
        $result = $this->service->saveConfig($data);
		if($result){
			echo json_encode(array("success" => true,"code"=> 200,"msg" => null,"obj"=> $data,"map"=> null,"list"=> null));	
		}else{
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => null,"obj"=> null,"map"=> null,"list"=> null));			
		}		
	}
   /**
     * 随机生字符串(数字+字母)
     */	
	public function randorderno($length = 10, $type = 0) {
		$arr = array(1 => "3425678934567892345678934567892", 2 => "ABCDEFGHJKLMNPQRSTUVWXY");
		$code='';
		if ($type == 0) {
			array_pop($arr);
			$string = implode("", $arr);
		} else if ($type == "-1") {
			$string = implode("", $arr);
		} else {
			$string = $arr[$type];
		}
		$count = strlen($string) - 1;
		for ($i = 0; $i < $length; $i++) {
			$str[$i] = $string[rand(0, $count)];
			$code .= $str[$i];
		}
		return $code;
	}
	
}
