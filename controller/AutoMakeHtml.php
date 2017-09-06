<?php

/**
 *
 * 静态页面自动生成
 * @author Administrator
 *
 */
class AutoMakeHtml  extends Controller {

    public $tag; // tag句柄
    public $smarty; // smrty句柄
    public $htmlSuffix = '.html'; // 静态文件后缀
    public $option = ''; // request参数op
    public $config; // 配置文件
    public $htmlDir; // html文件夹所存在的路径
    public $htmlName; // html文件夹所存在的名称
    public $automake; //    manualupdate静态手动更新模式 autoupdate静态自动更新模式 dynamic伪静态模式
	public $timeout; // 静态自动更新模式,页面的失效时间   TIMEOUT

    protected function autoMakeInit($op) {
	    if (isset($op)) {
			require_once ABSPATH . '/dynapage/Tag.php'; // tag基类				
			//require_once ABSPATH . '/lib/smarty/Smarty.class.php'; // smarty引擎
            $this->option = trim($op);
            $this->tagInit();
            $this->readConfig($this->option); // 读取配置文件

        }		
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
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }
    /**
     * tag标签对象初始化工作
     */
    private function tagInit() {
        // 检测
        if (! isset($this->option)) {
            $result = new Result(false, - 1, ErrorMsgs::get(- 1), Null);
            die($result->toJSON());
        }

        // tag引入并执行初始化工作
        //print_r($this->option);exit();
        $this->tag = new Tag($this->option);
        $tagConfig = $this->tag->init();
        if (! $tagConfig->statu) {
            die($tagConfig->toJSON());
        }
      
		$this->smarty = Tags::instance('Template');
        // 注入通用变量
        $this->tagAssign();
    }
    /**
     * 生成单页静态页面（当页面时间失效或者不存在则自动生成）
	 * 
     */
	 function  autoMakeHtmlById($Service, $id ){
			
		$htmlDir = $this->dirMake($this->config['key'].'Dir');
		$params = array( "id" => $id );
		$sql = $this->getInfoSql($this->config['key'],$params);
		$info = $Service->getRowTag($sql);
		if( empty($info->id))$this->error();
		if($info->pic) $info->pic = UPLOAD . $info->pic;
		// 注入文章id与文章信息
		$this->smarty->assign($this->config['key'], $info);
		$this->smarty->assign("id", $info->id);
			//注入位置导航
			$params = array();
			$params['key'] = $this->config['key'];
			$params['id'] = $info->id;
			$params['listurl'] = str_replace(ABSPATH, '', $htmlDir);
			$params['listname'] = $this->config['list_name'] ? $this->config['list_name'] : $this->config['name'];
			$params['detailname'] = $this->config['detail_name'] ? $this->config['detail_name'] : ($info->subject ? $info->subject :$info->name);	
			$this->smarty->assign('POSITION',$this->position($params));	
		// 注入SEO信息
		$title = isset($info->subject) ? $info->subject : $info->title;
		$keywords = isset($info->keywords) ? $info->keywords : '';
		$description = isset($info->description) ? $info->description : '';
		if ($title == '') {
			if (isset($info->name)) {
				$title = $info->name;
			}
		}
		//上一篇、下一篇
		if($id == 1){
			$sql = $this->getInfoSql($this->config['key'],array( "ids" => 2 ));
			$updown[0] = '';
			$updown[1] = $Service->getRowTag($sql);
			if((array)$updown[1]==''){
				$updown[1] = '';	
			}
		}else{
			$ids = ($id-1).','.($id+1);
			$sql = $this->getInfoSql($this->config['key'],array( "ids" => $ids ));
			$updown = $Service->getAllTag($sql);
			if((array)$updown[0]==''){
				$updown[0] = '';			
			}
			if((array)$updown[1]==''){
				$updown[1] = '';				
			}
		}

        $this->smarty->assign('updown', $updown);        // 上下页			
		if($info->content){
			$info->content = stripslashes($info->content);
		} 	
		$this->assignSeoInfo( $title, $keywords, $description );
		
		$detailHtml = $htmlDir . $id . $this->htmlSuffix;		
		//读取配置文件模板
		if(empty($info->tplulr)){
		   $this->tagFetch( $this->config['detail_tpl'],$detailHtml);			
		}else{
		    $this->tagFetch( $info->tplulr,$detailHtml);			
		}		
	}
   /**
     * 静态生成列表首页/列表页index/list_n
	 * 
     */	
	 function  autoMakeHtmlIndexOrList( $service, $i ){
			$htmlDir = $this->dirMake($this->config['key'].'Dir');
			// 获取所需初始化数据
            $count = $service->totalRows(array('1' => 1))->data;	
			$pageSize = empty($this->config['pageSize']) ?  6 : $this->config['pageSize'];	
			
			$indexHtml = $htmlDir . 'index' . $this->htmlSuffix;
			$listHtml = $htmlDir . 'list_' . $i . $this->htmlSuffix;
			if( $i != '' && $count < $i ){
				$this->error();
			}			
			if( $i == ''  ){
				$Html = $indexHtml;
				$i = 1;
			}else{
				$Html = $listHtml;
			}
			//注入分页
			$this->setPageHtml($i,$pageSize,$count,str_replace(ABSPATH . '/', '', $htmlDir));
			
			//注入位置导航
			$params = array();
			$params['key'] = $this->config['key'];
			//$params['listurl'] = str_replace(ABSPATH, '', $htmlDir);
			$params['listname'] = $this->config['list_name'] ? $this->config['list_name'] : $this->config['name'];	
	
			$this->smarty->assign('POSITION',$this->position($params));
			//注入SEO信息
			$this->setSinglePageSeo($this->config['key']);
			//读取配置文件模板
            if ( isset($this->config['list_tpl']) ) {
                $this->tagFetch($this->config['list_tpl'],$Html);			
            }elseif( isset($this->config['tpl']) ){
				$this->tagFetch($this->config['tpl'],$Html);		
			}else{
				die(json_encode(new Result(false, 192, ErrorMsgs::get(192), Null)));			
			}			
	 }
   /**
     * 静态生成科室首页
	 * 
     */	
  public function autoMakeDepartmentHtmlIndex ( $service, $method, $id) {
		$htmlDir = $this->dirMakeDepartment( $method );
		$department = new Department();
		$department->id = $id;
		 $info = $service->get($department)->data; 
		if(empty($info->id))$this->error();
		if($info->pic) $info->pic = UPLOAD . $info->pic;
		if($info->content){
			$info->content = stripslashes($info->content);
		}
		$info->department_url = $info->url;
		// 注入文章id与文章信息
		$this->smarty->assign("department", $info);
		$this->smarty->assign("id", $info->id);
		//注入位置导航
		$params = array();
		$params['key'] = $this->config['key'];
		$params['listname'] = $info->name;	
		$this->smarty->assign('POSITION',$this->position($params));
		// 注入SEO信息
		$title = isset($info->name) ? $info->name : $info->title;
		$keywords = isset($info->keywords) ? $info->keywords : '';
		$description = isset($info->description) ? $info->description : '';
 	
		$this->assignSeoInfo( $title, $keywords, $description );

		//读取配置文件模板
			$tplName = GENERATEPATH . $info->tplurl;
		$indexHtml = $htmlDir . 'index' . $this->htmlSuffix;
		if(! file_exists($tplName) || empty($info->tplulr)){
		   $this->tagFetch( $this->config['tpl'],$indexHtml);			
		}else{
		    $this->tagFetch( $info->tplulr,$indexHtml);			
		}
		
  }
    /**
     * 静态生成疾病列表首页/列表页index/list_n
	 * 
     */	
 public function autoMakeDiseaseHtmlIndexOrList ($method1,$method2, $diseaseID , $i) {
 
		$htmlDir = $this->dirMakeDisease( $method1,$method2 );
		$condition = array( "id" => $diseaseID );
		$sql = $this->getInfoSql($this->config['key'],$condition);
		$diseaseService = new DiseaseService();
		$info = $diseaseService->getRowTag($sql); 
		if($info->pic) $info->pic = UPLOAD . $info->pic;
		$info->department_url = $method1;

		// 注入文章id与文章信息
		$this->smarty->assign("disease", $info);
		$this->smarty->assign("id", $info->id);
		$this->smarty->assign("disease_id", $info->id);
		$this->smarty->assign("department_id", $info->department_id);
		//注入位置导航
		$params = array();
		$params['key'] = $this->config['key'];
		$params['id'] = $info->id;
		$params['departmentname'] = $info->department_name;
		$params['diseasename'] = $info->name;
		$params['departmenturl'] = $method1;
		$params['diseaseurl'] = $method2;	
		$this->smarty->assign('POSITION',$this->position($params));
		// 注入SEO信息
		$title = isset($info->name) ? $info->name : $info->title;
		$keywords = isset($info->keywords) ? $info->keywords : '';
		$description = isset($info->description) ? $info->description : '';
 	
		$this->assignSeoInfo( $title, $keywords, $description );
			
		 $where['1'] =1;
		 $where['disease_id'] = $diseaseID;
		 $articleService = new ArticleService();
		 $articleCount = $articleService->totalRows($where)->data;	 
		 $pageSize = empty($this->config['pageSize']) ?  6 : $this->config['pageSize'];		

			$indexHtmlUrl = $htmlDir . 'index' . $this->htmlSuffix; // 疾病目录下首页html路径
			$listHtmlUrl = $htmlDir . 'list_' . $i . '' . $this->htmlSuffix; //
			if( $i != '' && $articleCount < $i ){
				$this->error();
			}
			if( $i == ''  ){
				$htmlUrl = $indexHtmlUrl;
				$i = 1;
			}else{
				$htmlUrl = $listHtmlUrl;
			}
			//注入分页
			$this->setPageHtml($i,$pageSize,$articleCount,$method1.'/'.$method2.'/');
			
			$tplName = GENERATEPATH . $info->tplurl;

			if(! file_exists($tplName) || empty($info->tplulr)){
			   $this->tagFetch( $this->config['tpl'],$htmlUrl);			
			}else{
				$this->tagFetch( $info->tplulr,$htmlUrl);			
			}
 }
 	 
    /**
     * 疾病文章静态生成
	 * 
     */	
	 function  autoMakeArticleHtmlById( $method1, $method2, $articleID ){
	 
		$htmlDir = $this->dirMakeDisease( $method1,$method2 );
		
		$condition = array( "id" => $articleID );
		$sql = $this->getInfoSql($this->config['key'],$condition);
		$articleService = new ArticleService();
		$articleInfo = $articleService->getRowTag($sql);
		if(empty($articleInfo->id))$this->error();		
		if($articleInfo->pic) $articleInfo->pic = UPLOAD . $articleInfo->pic;
		$articleInfo->department_url = $method1;
		$articleInfo->disease_url = $method2;
		if($articleInfo->content){
			$articleInfo->content = stripslashes($articleInfo->content);
		}		
		//注入位置导航
		$params = array();
		$params['key'] = $this->config['key'];
		$params['departmentname'] = $articleInfo->department_name;
		$params['diseasename'] = $articleInfo->disease_name;
		$params['departmenturl'] = $method1;
		$params['diseaseurl'] = $method2;
		$params['detailname'] =	$articleInfo->subject;
		$this->smarty->assign('POSITION',$this->position($params));
		 // 数据注入
        $this->smarty->assign('id', $articleID); // 文章id
        $this->smarty->assign('department_id', $articleInfo->department_id); // 科室id
        $this->smarty->assign('disease_id', $articleInfo->disease_id); // 疾病id
        $this->smarty->assign('doctor_id', $articleInfo->doctor_id); // 医生id
        $this->smarty->assign('article', $articleInfo); // 文章信息
		// 数据seo
		$title = $articleInfo->title ? $articleInfo->title : $articleInfo->subject;
        $this->assignSeoInfo($title, $articleInfo->keywords, $articleInfo->description); // seo信息
		//上一篇、下一篇
		if($articleID == 1){
			$sql = $this->getInfoSql($this->config['key'],array( "ids" => 2 ));
			$updown[0] = '';
			$updown[1] = $articleService->getRowTag($sql);
			if((array)$updown[1]==''){
				$updown[1] = '';				
			}
		}else{
			$ids = ($articleID-1).','.($articleID+1);
			$sql = $this->getInfoSql($this->config['key'],array( "ids" => $ids ));
			$updown = $articleService->getAllTag($sql);
			if((array)$updown[0]==''){
				$updown[0] = '';				
			}
			if((array)$updown[1]==''){
				$updown[1] = '';				
			}
		}
        $this->smarty->assign('updown', $updown); // 上下页	
		//读取配置文件模板
		$artcleHtml = $htmlDir . $articleID . $this->htmlSuffix;
		if( $articleInfo->tplulr ) {
			$this->tagFetch( $articleInfo->tplulr,$artcleHtml);			
		}elseif( isset($this->config['depart_tpl']) ){
			$this->tagFetch($this->config['depart_tpl'],$artcleHtml);		
		}else{
			die(json_encode(new Result(false, 192, ErrorMsgs::get(192), Null)));			
		}

	 }
 

    /**
     * 静态生成自定义频道文章列表首页/列表页index/list_n
	 * 
     */	
	public function autoMakeChannelHtmlIndexOrList ($method, $channelId , $i) {

		$htmlDir = $this->dirMakeDepartment( $method );	
			// 获取所需初始化数据
		$condition = array( "id" => $channelId );
		$sql = $this->getInfoSql($this->config['key'],$condition);
		$channelService = new ChannelService();
		$info = $channelService->getRowTag($sql);
		$info->channel_id = $channelId;
		// 注入文章id与文章信息
		$this->smarty->assign("channel", $info);
		$this->smarty->assign("id", $info->id);
	
		//注入位置导航
		$params = array();
		$params['key'] = $this->config['key'];
		$params['listname'] = $info->name;	
		$this->smarty->assign('POSITION',$this->position($params));
		// 注入SEO信息
		$title = isset($info->name) ? $info->name : $info->title;
		$keywords = isset($info->keywords) ? $info->keywords : '';
		$description = isset($info->description) ? $info->description : '';
 	
		$this->assignSeoInfo( $title, $keywords, $description );
		
			// 获取所需初始化数据
			 $channelArticle = new ChannelArticleService();
            $count = $channelArticle->totalRows(array('channel_id' => $channelId))->data;
			$pageSize = empty($this->config['pageSize']) ?  6 : $this->config['pageSize'];

			$indexHtml = $htmlDir . 'index' . $this->htmlSuffix;
			$listHtml = $htmlDir . 'list_' . $i . $this->htmlSuffix;
			if( $i != '' && $count< $i ){
				$this->error();
			}
			
			if( $i == ''  ){
				$Html = $indexHtml;
				$i = 1;
			}else{
				$Html = $listHtml;
			}
			//注入分页
			$this->setPageHtml($i,$pageSize,$count,$method.'/');
			//读取配置文件模板
            if ($info->tplurl && $info->is_use_tpl==0) {
				$tplName = GENERATEPATH . $info->tplurl;
				$this->tagFetch($tplName,$indexHtml,true);		
            }elseif( isset($this->config['tpl']) ){
				$this->tagFetch($this->config['tpl'],$indexHtml);		
			}else{
				die(json_encode(new Result(false, 192, ErrorMsgs::get(192), Null)));			
			}			
 
	}
    /**
     * 静态生成自定义频道文章
	 * 
     */
	public function autoMakeChannelArticleHtml ( $method, $channelId , $id) {
		$htmlDir = $this->dirMakeDepartment( $method );	
		// 获取所需初始化数据
		$key = strtolower($this->config['key']);
		$params = array( "id" => $id );
		$sql = $this->getInfoSql($key,$params);	
		$channelArticle = new ChannelService();
		$info = $channelArticle->getRowTag($sql);
		if( empty($info->id))$this->error();
		if($info->pic) $info->pic = UPLOAD . $info->pic;
		if($info->content){
			$info->content = stripslashes($info->content);
		}
		$info->channel_id = $channelId;
		//注入位置导航
		$params = array();
		$params['id'] = $id;
		$params['key'] = $key;
		$params['listurl'] = str_replace(ABSPATH, '', $htmlDir);
		$params['listname'] = $info->channel_name;
		$params['detailname'] = $info->subject;	
		$this->smarty->assign('POSITION',$this->position($params));

		// 注入文章id与文章信息
		$this->smarty->assign($key, $info);
		$this->smarty->assign("id", $info->id);

        $this->assignSeoInfo($info->title?$info->title:$info->subject, $info->keywords, $info->description);
		//上一篇、下一篇
		if($id == 1){
			$sql = $this->getInfoSql($key,array( "ids" => 2 ));
			$updown[0] = '';
			$updown[1] = $channelArticle->getRowTag($sql);
			if((array)$updown[1]==''){
				$updown[1] = '';				
			}
		}else{
			$ids = ($id-1).','.($id+1);
			$sql = $this->getInfoSql($key,array( "ids" => $ids ));
			$updown = $channelArticle->getAllTag($sql);
			if((array)$updown[0]==''){
				$updown[0] = '';				
			}
			if((array)$updown[1]==''){
				$updown[1] = '';				
			}
		}
        $this->smarty->assign('updown', $updown);        // 上下页
			//读取配置文件模板
 		$HtmlUrl = $htmlDir . $id. $this->htmlSuffix; 
            if ( $info->channel_detailtplurl  && $info->channel_is_use_tpl==0) {
				$tplName = GENERATEPATH . $info->channel_detailtplurl;
				$this->tagFetch($tplName,$HtmlUrl,true);		
            }elseif( isset($this->config['tpl']) ){
				$this->tagFetch($this->config['tpl'],$HtmlUrl);		
			}else{
				die(json_encode(new Result(false, 192, ErrorMsgs::get(192), Null)));			
			}
	}
    /**
     * 专题生成
     */
    public function autoMakeTopicHtml( $method1, $method2 ) {
	    $topDao = new TopicDAO();	
		$topicInfo = $topDao->getTopicIdByUrl($method1,$method2.'.html');
		if(!$topicInfo){
			$this->error();
		}
		$html = $method1."|".$topicInfo['link']."|".$topicInfo['id'];
    	$topService = new TopicService();
    	$topicHtpl  = $topService->gethtml( $topicInfo['topiclistid'] );
    	require_once GENERATEPATH . 'lib/io.php';
    	if( $topicHtpl != '' ){
    		$relvaPath =  basename( $topicHtpl );
    		//生成
    		$html = explode("|",$html);
    		//查找数据
    		$_REQUEST['id'] = $topicInfo['id'];
			$info = $topService->getOne(array(),'*');
			if( $info->id == $topicInfo['id'] ){
				$this->assignSeoInfo($info->title, $info->keywords, $info->description);
			}
    		//注入样式路径
			$Url = GENERATEPATH . 'topic/' . $html[0] . '/' . $relvaPath; 
			$htmlUrl = NETADDRESS . '/topic/' . $html[0] . '/' . $relvaPath;
    		$this->smarty->assign('TOPIC_STYLE',NETADDRESS . '/topic/' . $html[0] . '/');
    		$this->tagFetch( $Url, $htmlUrl,true );
    	}
	}	 
	
    /**
     *
     *
     * smarty模版解析fetch内容获取
     *
     * @param string $htplName
     *            模版路径(不带后缀)
     * @param string $allHtplName
     *            是否为全路径(意思是模版存在于模版文件夹之外的文件)
     * @param boolen $dynamic
     *            动态
     */
    public function tagFetch($htplName = '', $htmlUrl, $allHtplName = false, $dynamic=false) {
        // 注入通用页面变量
        $this->makeOnce();

        // 如果传入的模版路径不为空,则使用传入的 模版
        if ($htplName != '') {
            if ($allHtplName) {
                $htplFile = $htplName;
            } else {
                $htplFile = TEMPDIR . $this->tag->templateName . '/' . $htplName . SUBFIX;
            }
        } else {
            $htplFile = TEMPDIR . $this->tag->templateName . '/' . $this->tag->htplFileName . SUBFIX;
        }

        // 模版文件是否存在
        if (! file_exists($htplFile)) {
            die(json_encode(new Result(false, 192, ErrorMsgs::get(192) . "：" . $htplFile, Null)));
        }

         // 编译并加载模板文件
            $content = $this->smarty->fetch($htplFile);
			
		 //设置页面为静态
			if(in_array($this->config['key'],array('ask'))){
				$dynamic = true;
			}
			// 判断是否为开启静态
			if ($this->automake == "autoupdate" && $dynamic==false) {
				file_put_contents($htmlUrl, $content);
			} else {
				die($content);
			}
    }
	

    /**
     *
     *
     * 静态文件存放目录生成
     * @info flag为指定该静态文件存放的根目录,flagDir为子模块存在的路径
     *
     * @param string $flag
     *            标识符
     */
    public function dirMake($flag) {
        switch ($flag) {
            case 'error':
                $htmlDir = ABSPATH . '/';
                break;
            case 'departmentDir':
                $htmlDir = ABSPATH . '/departments/';
                break;
            case 'sitemap':
                $htmlDir = ABSPATH . '/';
                break;
            case 'search':
                $htmlDir = ABSPATH . '/';
               	break;
            case 'index':
                $htmlDir = ABSPATH . '/';
                break;
            case 'reservation':
                $htmlDir = ABSPATH . '/reservation/';
                break;
            case 'reservationDir':
                $htmlDir = ABSPATH . '/reservation/';
                break;
            case 'introduce':
                $htmlDir = ABSPATH . '/hospital/';
                break;
            case 'contact':
                $htmlDir = ABSPATH . '/';
                break;
            case 'news':
                $htmlDir = ABSPATH . '/hospital/';
                break;
            case 'newsDir':
                $htmlDir = ABSPATH . '/hospital/news/';
                break;
            case 'movie':
                $htmlDir = ABSPATH . '/hospital/';
                break;
            case 'movieDir':
                $htmlDir = ABSPATH . '/hospital/movie/';
                break;
            case 'mediareport':
                $htmlDir = ABSPATH . '/hospital/';
                break;
            case 'mediareportDir':
                $htmlDir = ABSPATH . '/hospital/media/';
                break;
            case 'honor':
                $htmlDir = ABSPATH . '/hospital/';
                break;
            case 'honorDir':
                $htmlDir = ABSPATH . '/hospital/honor/';
                break;
            case 'environment':
                $htmlDir = ABSPATH . '/hospital/';
                break;
            case 'environmentDir':
                $htmlDir = ABSPATH . '/hospital/environment/';
                break;
            case 'device':
                $htmlDir = ABSPATH . '/hospital/';
                break;
            case 'deviceDir':
                $htmlDir = ABSPATH . '/hospital/device/';
                break;
            case 'success':
                $htmlDir = ABSPATH . '/hospital/';
                break;
            case 'successDir':
                $htmlDir = ABSPATH . '/hospital/success/';
                break;
            case 'doctor':
                $htmlDir = ABSPATH . '/doctor/';
                break;
            case 'doctorDir':
                $htmlDir = ABSPATH . '/doctor/';
                break;
            case 'technology':
                $htmlDir = ABSPATH . '/technology/';
                break;
            case 'technologyDir':
                $htmlDir = ABSPATH . '/technology/';
                break;
            case 'ask':
                $htmlDir = ABSPATH . '/ask/';
                break;
            case 'askDir':
                $htmlDir = ABSPATH . '/ask/';
                break;
        }
        if (! is_dir( $htmlDir ) ) {
			$this->createdir($htmlDir);
        }
        // .给模版注入文件夹路径,用于面包屑导航
        //$this->smarty->assign('HTMLURL', str_replace(ABSPATH, '', $htmlDir)); // 模块路径(静态文件存放路径)
        return $htmlDir;
    }
    /**
     *
     *
     * 静态疾病文件存放目录生成
     * @info flag为指定该静态文件存放的根目录,flagDir为子模块存在的路径
     *
     * @param string $flag
     *            标识符
     */
   public function dirMakeDisease($flag1,$flag2) {
        $htmlDir1 = ABSPATH . '/' . $flag1 . '/';
        $htmlDir2 = ABSPATH . '/' . $flag1 . '/' . $flag2. '/';
		if (! is_dir( $htmlDir2 )) {
			$this->createdir($htmlDir2);
		}
        // .给模版注入文件夹路径,用于面包屑导航
        //$this->smarty->assign('DEPARTMENTURL', str_replace(ABSPATH, '', $htmlDir1)); // 模块路径(静态文件存放路径)
        //$this->smarty->assign('DISLISTURL', str_replace(ABSPATH, '', $htmlDir12)); // 模块路径(静态文件存放路径)
        return $htmlDir2;
    }
    /**
     *
     * 静态科室文件存放目录生成
     */
   public function dirMakeDepartment($flag) {
        $htmlDir = ABSPATH . '/' . $flag . '/';
		if (! is_dir( $htmlDir )) {
			$this->createdir($htmlDir);
		}
        // .给模版注入文件夹路径,用于面包屑导航
        //$this->smarty->assign('HTMLURL', str_replace(ABSPATH, '', $htmlDir)); // 模块路径(静态文件存放路径)
        return $htmlDir;
    }
	
    /**
     *
     *
     * 静态分页文件每页数据条数获取
     *
     * @param string $handler
     *            标识符
     * @return int $pageSize 条数
     */
    public function readConfig($handler = '') {
        // .组合
        $handler = ucfirst($handler) . 'Tag';
        // .默认模版路径
        $currentUsed = file_get_contents(TEMPDIR . '/config.json');
        $array = json_decode($currentUsed, true);
        $pulugin_tpl = $array[0]['currentUsed'];
        // .获取配置文件
        $pagesizeJson = TEMPDIR . $pulugin_tpl . '/makehtml.json';
        $pageArrays = json_decode( $this->delBom( file_get_contents($pagesizeJson) ) );
        // .遍历
        $config = array();
        $isconfig = false;
        if( isset( $pageArrays ) && is_array( $pageArrays ) ){
	        foreach ($pageArrays as $key => $value) {
	            if ($value->tag == $handler) {
	                if (count($value) >= 1) {
	                    foreach ($value as $k => $v) {
	                        $config[$k] = $value->$k;
	                    }
	                    $this->config = $config;
	                    $isconfig = true;
	                }
	            }
	        }
        }
        if (! $isconfig) {
            $this->config['pageSize'] = 8;
        }
        return $this->config;
    }
    
    /**
     * 检测是否存在bom头,并自动去除
     * @param unknown $contents
     * @return string|unknown
     */
    private function delBom($contents){
    	$charset = array();
    	$charset[1]=substr($contents,0,1);
    	$charset[2]=substr($contents,1,1);
    	$charset[3]=substr($contents,2,1);
    	if(ord($charset[1])==239 && ord($charset[2])==187 && ord($charset[3])==191){
    		return substr($contents,3);
    	}
    	return $contents;
    }

    /**
     * 注入通用变量
     */
    public function tagAssign() {
        $this->assignSeoTableInfo();
		$this->setContact();
        $this->smarty->assign("UPLOAD", UPLOAD); // 上传文件根目录
        $this->smarty->assign('WEBSITE', NETADDRESS); // 网站域名根目录
        $this->smarty->assign('PUBLIC', NETADDRESS . '/public'); // 本次模版资源路径
    }

    /**
     *
     *
     * 注入seo信息(手动)
     *
     * @param
     *            $title
     * @param
     *            $keywords
     * @param
     *            $description
     */
    public function assignSeoInfo($title = '', $keywords = '', $description = '') {
        $this->smarty->assign("SEO_TITLE", $title);
        $this->smarty->assign("SEO_KEYWORDS", $keywords);
        $this->smarty->assign("SEO_DESCRIPTION", $description);
    }

    /**
     * 注入seo信息(自动)
     * @info 注入seo表中存在的seo信息
     */
    public function assignSeoTableInfo() {
        if (isset($this->option) && $this->option != '') {
            $seoServices = new SeoService();
            $where = array(
                "flag" => $this->option
            );
            $seoInfo = $seoServices->findOne($where, '*');
            if (isset($seoInfo->id)) {
                $this->smarty->assign("SEO_TITLE", $seoInfo->title);
                $this->smarty->assign("SEO_KEYWORDS", $seoInfo->keywords);
                $this->smarty->assign("SEO_DESCRIPTION", $seoInfo->description);
            }
        }
    }
    /*验证文件夹是否存在
     * @param $path 文件夹地址
     * return 0表示文件夹已经存在,1表示创建成功，2表示创建失败
     * **/
   private function createdir($path){
        if (file_exists($path)){			//判断目录存在否，存在不创建
            return 0;
        }else{ 							//不存在创建
            $re=mkdir($path,0777,true); //第三个参数为true即可以创建多极目录
            if ($re){
                chmod($path,0777);
                return 1;
            }else{
                return 2;
            }
        }
    }
    /*验证文件是否存在
     * @param $path 文件地址
     * return 0表示文件已经存在,1表示创建成功，2表示创建失败
     * **/
   private function createfile($path){
        if (file_exists($path)){			
            return 0;
        }else{ //不存在创建
            $re=fopen($path,"w+"); 
            if ($re){
                chmod($path,0777);
				fclose($re);
                return 1;
            }else{
                return 2;
            }
        }
    }
    /**
     *
     *
     * html生成方法
     *
     * @param string $fileName
     *            html生成路径
     * @param string $content
     *            内容
     */
    public function tagDisplay($fileName, $content, $flag = true) {
        $size = file_put_contents($fileName, $content);
        if ($flag) {
            if ($size > 0) {
                die(json_encode(new Result(true, 0, '', NULL)));
            } else {
                die(json_encode(new Result(false, 49, ErrorMsgs::get(49), NULL)));
            }
        }
    }  
	public function setContact(){
        $contactdao = new ContactDAO();	
		$con['is_retain'] = 1;
		$contactlist = $contactdao->query($con);

        foreach ($contactlist as $key => $value) {
			if($value->val){
				$this->smarty->assign($value->flag, $value->val);
			}
        }
		$pic['kind'] = 1;
        $picmanagerdao = new PicManagerDAO();
		$piclist = $picmanagerdao->query($pic);		
		
        foreach ($piclist as $key => $value) {
			if($value->img){
				$this->smarty->assign($value->flag, UPLOAD. $value->img);
			}
			if($value->link){
				$this->smarty->assign($value->flag.'_link', $value->link);
			}
        }	
	}
    /**
     *
     *
     * 读取配置文件分配变量
     *
     * @param boolean $assign
     *            如果为true,则代表只注入变量
     *            @info 配置文件格式
     *            {
     *            "layout_header": { //注入变量名
     *            "tpl": "common/layout/header", //需要生成的模版路径(不需要加后缀)
     *            "html": "header.html" //模版生成静态文件存放路径
     *            }
     */
    public function makeOnce() {
        $commonConfigJson = TEMPDIR . $this->tag->templateName . '/common/config.json';
        if (! file_exists($commonConfigJson)) {
            return true;
        }
        $configContent = json_decode(file_get_contents($commonConfigJson), true);
        $rootDir = COMPILEDIR . 'commonHtml';
        if (! is_dir($rootDir)) {
            mkdir($rootDir);
        }
        foreach ($configContent as $key => $value) {
            if (is_array($value)) {
				 $tplulr = TEMPDIR . $this->tag->templateName . '/' . $value['tpl'] . SUBFIX ;
                 $this->smarty->assign($key, $tplulr);
            }
        }
		$this->smarty->assign('TEMPPATH', TEMPDIR . $this->tag->templateName);
		$this->smarty->assign('MODULEKEY', strtolower($this->config['key']));
    }

    /**
     * 自定义频道数据读取...
     */
    public function channelData( $channelID ) {
        $this->channelArticles = array();
        $this->channelarticleArray = array();
        $this->channels = array();
        // 通过id查询出自定义频道信息
        $channelS = new ChannelDAO();
        $channels = $channelS->getChanneInfo( $channelID  );
        $this->channels = $channels;
        // 查询出所有的文章
        $obj = new ChannelArticleDAO();
        $channelArticles = $obj->getChanneArticleInfo( $channelID );
        $this->channelArticles = $channelArticles;
        foreach ($this->channelArticles as $value) {
            $this->channelarticleArray[$value['channel_id']][] = $value;
        }
    }

    /**
     * 科室、疾病、文章生成功能数据截取方法
     */
    public function publicData($departmentID, $diseaseID) {
        // 定义预处理数组
        $this->departmentArray = array();
        $this->departmentS = array();
        $this->diseaseArray = array();
        $this->diseaseS = array();

	        // 实例化
	        $departmentDAO = new DepartmentDAO();
	        $diseaseDAO    = new DiseaseDAO();
	        // 获取所需初始化数据
	        $this->departmentArray = $departmentDAO->getInfo($departmentID);
	        $this->diseaseArray    = $diseaseDAO->getInfo($diseaseID);

        // 疾病分组
        foreach ($this->diseaseArray as $key => $value) {
            $this->diseaseS[$value['department_id']][] = $value;
        }
        // 目录生成
        foreach ($this->departmentArray as $key => $value) {
            // 科室目录路径生成
            $dirDepartName = GENERATEPATH . $value['url'];
            $this->departmentS[$value['id']] = $value;
        }
    }
	/**
	 * 
	 * 设置单页面seo信息
	 */
	public function setSinglePageSeo($key){
		//注入SEO信息
		$seodao = new SeoDAO();
		$where = array('flag'=>$key);
		$info = $seodao->getflag($where);
		
		$title = isset($info['title']) ? $info['title'] : '';
		$keywords = isset($info['keywords']) ? $info['keywords'] : '';
		$description = isset($info['description']) ? $info['description'] : '';		
		if ($title == '') {
			$title = $this->config['name'];
		}			
		$this->assignSeoInfo($title, $keywords, $info['description']);		
	}
	/**
	 * 
	 * 根据分页信息获取分页html
	 * @param int $current 当前页
	 * @param int $pageSize 每页条数
	 * @param int $count 总条数
	 * @param string $dir html存放文件夹
	 * @param string $pageHtml 分页模版文件(默认采取index模版分页模式)
	 */
	public function setPageHtml($current,$pageSize,$count,$dir = '',$pageHtml = 'index') {
		#.分页导航允许条数
		$pageMaxNav = 7;
		#.总页数
		$pageCount = ceil($count / $pageSize);
		#.上一页
		$pre     = $current > 1 ? ($current-1) : 1;
		#.下一页
		$next    = ( $current + 1 < $pageCount ) ? ($current+1) : $pageCount;
		#.计算开始&结束页码
		if( $pageCount <= $pageMaxNav ){
			$start = 1;$end   = $pageCount;
		}else{
			#.计算开始
			if( $current <= 4 ){
				$start = 1;$end   = $pageMaxNav;
			}else{
				$start = $current - 3;$end   = $current + 3;
				if( $end >= $pageCount ) {
					$start = $pageCount - $pageMaxNav + 1;$end   = $pageCount+1;	
				}
			}
		}
		#.注入数据并返回解析后的html
		$this->smarty->assign ( 'count', $count );          //总条数
		$this->smarty->assign ( 'pageCount', $pageCount ); //总页数
		$this->smarty->assign ( 'current', $current );    //当前页码
        $this->smarty->assign ( 'pageSize', $pageSize);  //每页条数
		$this->smarty->assign ( 'pre', $pre );			//上一页
		$this->smarty->assign ( 'next', $next );		//下一页
		$this->smarty->assign ( 'end', $end );			
		$this->smarty->assign ( 'start', $start );
		$this->smarty->assign ( 'dir' , NETADDRESS . '/'. $dir );//存放文件夹
		if($pageCount ==1){ return; }
	}
	//位置导航 
    public function position($params)
    {
		$website = NETADDRESS;
		$key = isset($params['key']) ? $params['key'] : '';
		$id = isset($params['id']) ? intval($params['id']) : '';
		$departmentname = $params['departmentname'] ? $params['departmentname'] : '';
		$diseasename = $params['diseasename'] ? $params['diseasename'] : '';
		$departmenturl = $params['departmenturl'] ? $website . '/' . $params['departmenturl'] . '/' : '';
		$diseaseurl = $params['diseaseurl'] ? $departmenturl . $params['diseaseurl'] . '/' : '';
		$detailname = $params['detailname'] ? $params['detailname'] : '';
		$listurl = $params['listurl'] ? $website . $params['listurl']  : '';
		$listname = $params['listname'] ? $params['listname'] : '';
		switch($key){
			case 'disease' : $sign = 1; break;
			case 'article' : $sign = 2; break;
			default : $sign = 3; break;
		}

		$str = '';
		if($sign == 3){
			if(empty($id)){
				$str = '<ol class="breadcrumb">您的位置：<li><a href="'.$website.'"><i class="icon icon-home"></i> 首页</a></li><li>'.$listname.'</li></ol>';
			}else{
				$str = '<ol class="breadcrumb">您的位置：<li><a href="'.$website.'"><i class="icon icon-home"></i> 首页</a></li><li><a href="'.$listurl.'">'.$listname.'</a></li><li class="active">'.$detailname.'</li></ol>';				
			}
		}elseif($sign == 1){
				$str = '<ol class="breadcrumb">您的位置：<li><a href="'.$website.'"><i class="icon icon-home"></i> 首页</a></li><li><a href="'.$departmenturl.'">'.$departmentname.'</a></li><li class="active">'.$diseasename.'</li></ol>';
		}elseif($sign == 2){
				$str = '<ol class="breadcrumb">您的位置：<li><a href="'.$website.'"><i class="icon icon-home"></i> 首页</a></li><li><a href="'.$departmenturl.'">'.$departmentname.'</a></li><li><a href="'.$diseaseurl.'">'.$diseasename.'</a></li><li class="active">'.$detailname.'</li></ol>';
		}
		return $str;
	}	
    /**
     * sql信息 tabs
     * @dep 关联department
     * @dis 关联disease
	 * @cha 关联channel
	 * @as  缩简表
     */
    public function getInfoSql($flag,$params)
    {
		 $tabs = array(
			'introduce'=> array('as'=>'i'),
			'news'  => array('as'=>'new'),
			'article'=>array('as'=>'art','dep'=>1,'dis'=>1),
			'doctor'  => array('as'=>'doc','dep'=>1),
			'topic'  => array('as'=>'top'),
			'success'  => array('as'=>'suc','dep'=>1),
			'technology'  => array('as'=>'tec','dep'=>1),
			'channelarticle'  => array('as'=>'chan','cha'=>1),
			'channel'  => array('as'=>'cha','chan'=>1),
			'ask'  => array('as'=>'ask'),
			'honor'  => array('as'=>'hon'),
			'environment'=>array('as'=>'env'),
			'device'=>array('as'=>'dev'),
			'movie'=>array('as'=>'mov'),
			'mediareport'=>array('as'=>'med'),
			'department'=>array('as'=>'dep'),
			'disease'=>array('as'=>'dis','dep'=>1),
		);
		$tab = $tabs[$flag];
		$as = $tab['as'];
			
		if($params['id'] || $params['ids']){
					if($params['ids']){
				if($as!="doc"){
			  $select = 'SELECT '.$as.'.id,'.$as.'.subject';
				}else{
					$select = 'SELECT '.$as.'.*';
				}
			}else{
			  $select = 'SELECT '.$as.'.*';				
			}
		}
		$join = '';
		if(isset($tab['cha']) && $tab['cha']==1){
			$cha = new ChannelTag();
			$field_cha = $cha->getChaFields();
			$select .= ','.$field_cha;
			$join .=' LEFT JOIN `channel` as cha ON chan.channel_id = cha.id ';
		}
		if(isset($tab['chan']) && $tab['chan']==1){
		  $cha = new ChannelArticleTag();
		  $field_cha = $cha->getChanFields();
		  $select = 'SELECT cha.id,cha.name,cha.shortname,cha.is_use_tpl,cha.tplurl,cha.detailtplurl,cha.title as channel_title,cha.keywords as channel_keywords,cha.description as channel_description';
		  $select .= ','.$field_cha;
		  $join .=' LEFT JOIN `channelarticle` as chan ON chan.channel_id = cha.id ';
		}
		$where = ' WHERE 1=1';
		if(isset($tab['dep']) && $tab['dep']==1){
			$join .= ' LEFT JOIN `department` AS dep ON dep.id = '.$as.'.department_id ';
			if($params['ids']){
				$select .= ',dep.name AS department_name,dep.url AS department_url';				
			}else{
			    $select .= ',dep.name AS department_name';			
			}
		
		}
		if(isset($tab['dis']) && $tab['dis']==1){
			$join .= ' LEFT JOIN `disease` AS dis ON dis.id = '.$as.'.disease_id ';	
			if($params['ids']){
				$select .= ',dis.name AS disease_name,dis.url AS disease_url';				
			}else{
			   $select .= ',dis.name AS disease_name';	
			}
		}
		if($flag=='ask' && $params['id']){
			$select .= ',doc.name as doctorname,an.content,an.plushtime as antime,dep.name as departname';
			$join .= ' LEFT JOIN `answer` AS an ON an.ask_id = '.$as.'.id';
			$join .= ' LEFT JOIN `doctor` AS doc ON doc.id = an.ask_id';
			$join .= ' LEFT JOIN `department` AS dep ON doc.department_id = dep.id';
		}
		if($params['id'])
		{
			$where .= ' AND '.$as.'.id='.$params['id'];
		}
		if($params['ids'])
		{
			$where .= ' AND '.$as.'.id IN('.$params['ids'].')';
		}
		$select .= ' FROM `'.$flag.'` AS '.$as.' ';
		if($params['id']){
			$where .=' LIMIT 1';
		}
		return $select.$join.$where; 
			
	}
}
