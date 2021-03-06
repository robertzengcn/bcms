<?php
class SensitiveWordsController extends Controller {
    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        $this->service = new SensitiveWordsService();
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
    	$filterService->addFunc($filterService::$FILERPLUSHTIME);
    	$filterService->addFunc($filterService::$WORKERLOGHISTORY);
    	return $filterService->execute();
    }
    
    /**
     * 获取所有组
     * */
    public function getGroups() {
		$data = file_get_contents(WORDSJSON);
		$data = json_decode($data);
		$arr = array();
		if(is_array($data)){
			$i= 0;
			foreach($data as $key=>$vo){	
					foreach($vo as $k=>$v){
						if($k==0){
							$arr[$i]['id']=$key;
							$arr[$i]['name']=$v;
							$i++;
							unset($vo);
							unset($v);						
						}
					}			
			}
			$flag = true;
		}else{
			$flag = false;		
		}
		echo json_encode(new Result($flag, 0, '', $arr));
    }
    /**
     * 获取指定组下词汇
     * */
    public function getGroupWords() {
        $groupid = isset($_REQUEST['group_id']) ? $_REQUEST['group_id'] : 'all';
		$groupname = isset($_REQUEST['groupname']) ? $_REQUEST['groupname'] : '全部';
		$data = file_get_contents(WORDSJSON);
		$data = json_decode($data);
		$arr = array();
		if(is_array($data)){
			foreach($data as $key=>$vo){
				if($groupid=="all"){					//全部组下的词汇
						foreach($vo as $k=>$v){
							if( $k!=0 && $k!=1 && $k!=2 ){
								$arr[]=$v;
								unset($vo);
								unset($v);						
							}
						}			
				}else{
					if($key==$groupid){	 				//指定组下的词汇
						foreach($vo as $k=>$v){
							if( $k!=0 && $k!=1 && $k!=2 ){
								$arr[]=$v;
								unset($vo);
								unset($v);						
							}
						}			
					}				
				}
			}
			$flag = true;
			$return['info'] = $arr;
			$return['word'] = $groupname;			
		}else{
			$flag = false;			
		}
		echo json_encode(new Result($flag, 0, '', $return));
    }

    /**
     * 判断增加的词汇重复性
     * */
	public function queryWords(){
	        $str = stripslashes(trim($_REQUEST['words']));
			$str = preg_replace('/[，、\s+\n+]/ui', ',', $str);					//过滤逗号顿号空格换行
			$words = explode(',',$str);
			$words = array_unique($words);					  					//移除数组中重复的值
			foreach( $words as $k=>$v){  
				if( !$v )  
					unset( $words[$k] );                       					//去掉数组里的空值 
					unset( $v );
			}
			$words = array_values($words);					    				//返回数组的所有值(非键名)			
			$data = file_get_contents(WORDSJSON);
			$data = json_decode($data);
			if(is_array($data)){
					$arrall = array();											//所有词汇
					foreach($data as $vo){
						foreach($vo as $k=>$v){
							if( $k > 2 ){
								$arrall[]=$v;
								unset($vo);
								unset($v);						
							}
						}
					}
				foreach($words as $vo){						    				//判断增加的词汇重复性
					if(in_array($vo, $arrall)){										
						$flag = false;
						$msg = "所增加的词汇<span style=\"color:red;\">".$vo."</span>重复，请重新添加";	//重复的词
						break;
					}else{
						$flag = true;
						$msg ="ok";							
					}
					unset($vo);
				}
			}else{
				$flag = true;
				$msg ="ok";				
			}
		echo json_encode(new Result($flag, 0, $msg, $name));	
	}
    /**
     * 判断词组是否存在
     * */
	public function isExistsGrorps(){
		$data = file_get_contents(WORDSJSON);
		$data = json_decode($data);
		if(empty($data) && is_array($data)){
			$flag = false;
			$msg = "请先添加词组！";
		}else{
			$flag = true;
			$msg = "ok";			
		}
		echo json_encode(new Result($flag, 0, $msg, ''));		
	}	
    /**
     * 添加词汇
     * */
	public function addWords(){
		$data = file_get_contents(WORDSJSON);
		$data = json_decode($data);
		if(is_array($data)){
	        $str = stripslashes(trim($_REQUEST['words']));
	        $gname = stripslashes(trim($_REQUEST['gname']));
			$groupid = isset($_REQUEST['groupid']) ? $_REQUEST['groupid'] : 'all';
			$str = preg_replace('/[，、\s+\n+]/ui', ',', $str);					//过滤逗号顿号空格换行
			$words = explode(',',$str);
			$words = array_unique($words);										//移除数组中重复的值
			for( $i=0;$i<count($words);$i++ ){  
				if( !$words[$i] ) 	
					unset( $words[$i] );                   						//去掉数组里的空值 
			}
			$words = array_values($words);										//返回数组的所有值(非键名)
			$res = $this->GroupNameIsExist($data,$gname);   					//判断组名是否存在
			if($res==1){			
					for($y=0;$y<count($data);$y++){
						if($gname == $data[$y][0]){
							for($i=0;$i<count($words);$i++){
								array_push($data[$y],$words[$i]);				//向data尾部增加元素										
							}
						}
					}						
			}else{
					array_unshift($words,$gname);			 					//增加新组成员及元素
					$data[] = $words;																	
			}
		}else{
				array_unshift($words,$gname);									//空白文件增加新组成员及元素
				$data[] = $words;	
		}
				$file =  WORDSJSON;
				$content = json_encode($data);
				$is_file = $this->createfile($file);
				$hand=file_put_contents($file,$content);
			if($hand){
				$flag = true;
				$msg = "添加成功";			
			}else{
				$flag = false;
				$msg = "添加失败";						
			}
		$info['gname'] = $gname;
		$info['groupid'] = $groupid;		
		echo json_encode(new Result($flag, 0, $msg, $info));
	}

	//词组列表
	public function groupList(){
		$data = file_get_contents(WORDSJSON);
		$data = json_decode($data);
		$arr = array();
		if(is_array($data) && count($data)>0){
			$i= 0;
			foreach($data as $key=>$vo){	
					foreach($vo as $k=>$v){
						if($k == 0){
							$arr[$i]['id']=$key+1;										//词组id
							$arr[$i]['group_name']=$v;									//词组名称
							$arr[$i]['number'] = count($vo)-3;							//词组数量
							$arr[$i]['remark'] = $vo[1];								//备注
							$arr[$i]['addtime'] = date("Y-m-d H:i:s", $vo[2]);			//更新时间
							$i++;								
							unset($vo);
							unset($v);
						}
					}			
			}
			$flag = true;		
			if( trim($_REQUEST['order']) == "order by id asc" ){
				arsort($arr);															//对关联数组按照键值进行降序排序
				$arr = array_values($arr);					
			}						
				$page = $_REQUEST['page'];												//分页处理
				$size = $_REQUEST['size'];	
				$count = $page * $size;								
				$num = ($page == 1) ? 0 : $count-$size;									//第一页
				$count = ((count($arr)-$count) >= 0 ) ? $count : count($arr);			//最后一页
			for( $i = $num; $i < $count; $i++ ){			
					$groupList[] = $arr[$i];
				}
		}else{
				$flag = false;
				$groupList = array();
		}				
			if ( isset($_REQUEST['isPage'])) {
				$ttl = count($arr);
				$result = array('rows'=>$groupList,'ttl'=>$ttl);
			} else {
				$result = new Result($flag, 0, '', $groupList);
			}
		echo json_encode($result); 		
	}
    /**
     * 添加词组
     * */
	public function addGroup(){
        $newname = stripslashes(trim($_REQUEST['new_name']));
        $remark = stripslashes(trim($_REQUEST['remark']));
		$time = time();
		$data = file_get_contents(WORDSJSON);				
		$data = json_decode($data);
		$words =array();
		array_push($words,$newname,$remark,$time);									//增加组名,备注,添加时间
		$data[] = $words;						
		$content = json_encode($data);
		$is_file = $this->createfile(WORDSJSON);
		$hand=file_put_contents(WORDSJSON,$content);
		if($hand){
			$info['flag'] = true;
			$info['msg'] = "添加成功";
			$info['result'] = "ok";		
		}else{
			$info['flag'] = false;
			$info['msg'] = "添加失败";
			$info['result'] = "no";					
		}
		echo json_encode(new Result($info['flag'], 0, $info['msg'], $info['result']));
	}
    /**
     * 编辑词组
     * */
	public function editGroup(){
        $new_gname = stripslashes(trim($_REQUEST['new_name']));
        $remark = stripslashes(trim($_REQUEST['remark']));
	    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	    $str = $_REQUEST['words'] ? stripslashes(trim($_REQUEST['words'])) : '';
		$old_gname = trim($_REQUEST['old_gname']);
		$time = time();
			if($str){
				$str = preg_replace('/[，、\s+\n+]/ui', ',', $str);//过滤逗号顿号空格换行
				$words = explode(',',$str);
				$words = array_unique($words);					//移除数组中重复的值
				for( $i=0;$i<count($words);$i++ ){  
					if( !$words[$i] ) 	
						unset( $words[$i] );                            //去掉数组里的空值 
				}
				$words = array_values($words);					        //返回数组的所有值(非键名)
			}else{
				$words =array($new_gname,$remark,$time);
			}
		array_unshift($words,$new_gname,$remark,$time);			//开头增加组名,备注,更新时间			
		$data = file_get_contents(WORDSJSON);				
		$data = json_decode($data);			
		for($y=0;$y<count($data);$y++){
			if($old_gname == $data[$y][0]){
				array_splice($data[$y], 0, 3, $words);					//替换前三个值
			}
		}
		$content = json_encode($data);
		$is_file = $this->createfile(WORDSJSON);
		$hand=file_put_contents(WORDSJSON,$content);
		if($hand){
			$flag = true;
			$msg = "编辑成功";			
		}else{
			$flag = false;
			$msg = "编辑失败";						
		}
		echo json_encode(new Result($flag, 0, $msg, $data));		
	}
    /**
     * 删除单个词组
     * */
	public function removeTotally(){
	    $word = stripslashes(trim($_POST['content']));
		$data = file_get_contents(WORDSJSON);
		$data = json_decode($data);
		$flag = false;
		if(is_array($data) && count($data)>0){
			$arr = array();
			foreach($data as $key=>$vo){				
				foreach($vo as $k=>$v){
					if($k>2 && $word == $v){
						unset($data[$key][$k]);
						$flag = true;						
					}
				}
			}
		
		for( $i=0;$i<count($data);$i++ ){ 	
			$arr[$i] = array_values($data[$i]);
		}			
			$content = json_encode($arr);
			file_put_contents(WORDSJSON,$content);		
		}
		$msg = $flag ? '删除成功!' : '删除失败!';
		echo json_encode(new Result($flag, 0, $msg, ''));	
	}
    /**
     * 删除词组
     * */
	public function delGroups(){
	    $groupsName = $_POST['groupsName'];
		$data = file_get_contents(WORDSJSON);	
		$data = json_decode($data);	
		for($y=0;$y<count($data);$y++){
			for($i=0;$i<count($groupsName);$i++){		
				if($groupsName[$i] == $data[$y][0]){
					$name[] = $data[$y][0];
					unset($data[$y]);
					continue;
				}	
			}
		}
		$data = array_values($data);	
		$content = json_encode($data);
		$is_file = $this->createfile(WORDSJSON);
		$hand=file_put_contents(WORDSJSON,$content);
		if($hand){
			$flag = true;
			$msg = "删除成功";			
		}else{
			$flag = false;
			$msg = "删除失败";						
		}		
		echo json_encode(new Result($flag, $msg, '',$name));		
	}
    /**
     * 判断是否选中模块
     * */
	public function isExistsModule($module){
		$flag = false;
		$moduleall = file_get_contents(MODULEJSON);	
		$moduleall = json_decode($moduleall,true);
		foreach($moduleall as $vo){
			if($module == $vo['module'] && $vo['status']=='checked'){
				$flag = true;
				unset($vo);
				break;
			}
		}
		return 	$flag;	
	}
    /**
     * 标题内容有没有敏感词或者是否重复
     * */		
    public function titleIsSensitiveOrRepeat(){	
		$module  = $_POST['module'];							
		switch($module){
			case 'news' : $filename = NEWSJSON; $modulename='News';break;
			case 'success' : $filename = SUCCESSJSON;$modulename='Success';break;
			case 'media' : $filename = MEDIAJSON;$modulename='MediaReport';break;
			case 'honor' : $filename = HONORJSON;$modulename='Honor';break;
			case 'environ' : $filename = ENVIRONJSON;$modulename='Environment';break;
			case 'device' : $filename = DEVICEJSON;$modulename='Device';break;
			case 'article' : $filename = ARTICLEJSON;$modulename='Article';break;
			case 'technology' : $filename = TECHNOLOGYJSON;$modulename='Technology';break;
			default : break;
			
		}
		$checked = $this->isExistsModule($modulename);
		if($checked){
			$content = stripslashes(trim($_POST['content']));
			$type = $_POST['type'];
			switch($type){
				case 'subject' : $name = "标题";break;
				case 'seo_title' : $name = "SEO标题";break;
				case 'keywords' : $name = "关键词";break;
				case 'seo_desc' : $name = "简介";break;
				case 'editor' : $name = "详细";break;
				default : break;
			}
				$data = file_get_contents(WORDSJSON);
				$data = json_decode($data);
				$flag = false;
				if(is_array($data) && count($data) > 0 ){						//所有词汇
						foreach($data as $vo){
							foreach($vo as $k=>$v){
								$pos = explode($v, $content);
								if( $k > 2 && count($pos) > 1 ){
									$flag = true;
									$msg = $name."内容中有敏感词-".$v;
									break;							
								}
							}
						}
						unset($vo);
						unset($v);
				}
			if($module && $type =='subject'){					//判断是否标题重复
				$titel_data = file_get_contents($filename);
				$titel_data = json_decode($titel_data);
				if(is_array($titel_data) && count($titel_data) > 0){
					if(in_array($content, $titel_data)){
						$flag = true;
						$msg = "标题与以前发布过的重复";
					}
				}		
				
			}
		}else{
			$msg = '';
			$flag = false;
		}
		echo json_encode(new Result($flag, 0, $msg,''));		
		
	}	
    /**
     * 标题是否重复判断
     * */		
	public function titleIsRepeat(){	
	    $title = stripslashes(trim($_POST['title']));
		$titel_data = file_get_contents(TITLEJSON);	
		$titel_data = json_decode($titel_data);
		$flag = false;
		if(is_array($titel_data) && count($titel_data) > 0){
			if(in_array($title, $titel_data)){
				$flag = true;
			}
		}
		echo json_encode(new Result($flag, 0, '',''));		
		
	}
    /**
     * 根据关键词查询
     * */
	public function getWordsByName(){
	    $keyword = stripslashes(trim($_POST['keyword']));
		$data = file_get_contents(WORDSJSON);
		$data = json_decode($data);
		if(is_array($data) && count($data)>0){
			$arr = array();
			foreach($data as $key=>$vo){				
				foreach($vo as $k=>$v){
					if($k>2 && preg_match("/$keyword/i", $v)){
						$arr[]=$v;						
					}
					unset($vo);
					unset($v);
				}
			}			
		}
		if($arr){
			$flag = true;
			$return['info'] = $arr;
			$return['word'] = $groupname;
			$msg = '';
		}else{
			$flag = false;
			$msg = '没有搜索到相关词汇!';
		}
		echo json_encode(new Result($flag, 0, $msg, $return));
		
	}
	/**
	 * 过滤模块-checkbox 
	 * */
	public function getAllModule(){
		$moduleall = file_get_contents(MODULEJSON);	
		$moduleall = json_decode($moduleall);
		$return['re'] = $moduleall;
		echo json_encode(new Result(true, 0, '', $return));	
}
	/**
	 * 保存过滤模块
	 * */
	 public function saveModule(){
		$ids = isset($_POST['moduleposition']) ? $_POST['moduleposition'] : '';
		if($ids==''){
			echo json_encode(new Result(false, 0, '请选择过滤模块！', ''));	
			exit;
		}
		$moduleall = file_get_contents(MODULEJSON);	
		$moduleall = json_decode($moduleall,true);
		$array = array();
			foreach($moduleall as $key=>$vo){
				$id = isset($ids[$key]) ? $ids[$key] : '';
				if($vo['id'] == $id){
					$vo['status'] = 'checked';
				}else{
					$vo['status'] = '';				
				}
				$array[] = $vo;
				unset($vo);
			}			
		$content = json_encode($array);
		$hand=file_put_contents(MODULEJSON,$content);
		if($hand){
			$flag = true;
			$msg = '保存成功!';
		}else{
			$flag = false;
			$msg = '保存失败!';
		}
		echo json_encode(new Result($flag, 0, $msg, ''));
	 }
	/**
	 * 初始化模块
	 * */
	 public function initialModule(){
		$data = array(
			array('id'=>1,'name'=>'医院新闻','module'=>'News','status'=>''),
			array('id'=>2,'name'=>'媒体报道','module'=>'MediaReport','status'=>''),
			array('id'=>3,'name'=>'医院荣誉','module'=>'Honor','status'=>''),
			array('id'=>4,'name'=>'医院环境','module'=>'Environment','status'=>''),
			array('id'=>5,'name'=>'医疗设备','module'=>'Device','status'=>''),
			array('id'=>6,'name'=>'疾病资讯','module'=>'Article','status'=>''),
			array('id'=>7,'name'=>'案例管理','module'=>'Success','status'=>''),
			array('id'=>8,'name'=>'医院技术','module'=>'Technology','status'=>'')
		); 
		$content = json_encode($data);
		$status = file_put_contents(MODULEJSON,$content);
		if($status){
			$flag = true;
			$msg = '初始化模块成功!';
		}else{
			$flag = false;
			$msg = '初始化模块失败!';
		}
		echo json_encode(new Result($flag, 0, $msg, ''));		
	 }
	//对多维数组进行排序
	private function sort_array($array, $keyid, $order='asc', $type='number') {
        if(is_array($array)) {
            foreach($array as $val) {
                $order_arr[] = $val[$keyid];
            }    
            $order = ($order == 'asc') ? SORT_ASC: SORT_DESC;
            $type  = ($type == 'number') ? SORT_NUMERIC: SORT_STRING;
     
           return array_multisort($order_arr, $order, $type, $array);
        }
    }
	//判断组名是否存在
	private function GroupNameIsExist($data,$gname){
			foreach($data as $vo){	
				if(in_array($gname,$vo)){
					return 1;			//存在					
				}
				unset($vo);
			}
	}
	/**
	* 遍历获取文件下的所有子文件名
	* @param string $dir
	* @return array
	*/
  private function getDirAllChildName($dir){
    $files = array();
    if ( $handle = opendir($dir) ) {
        while ( ($file = readdir($handle)) !== false ) {
            if ( $file != ".." && $file != "." ) {
                if ( is_dir($dir . "/" . $file) ) {
                    $files[$file] = my_scandir($dir . "/" . $file);
                }else{
                    $files[] = $file;
                }
            }
        }
        closedir($handle);
        return $files;
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
    /*数组存放.php文件
     * @param $path 文件地址
     * @param $data 数据
     * return 成功，失败
     * **/
   private function filePutContentsToArray($path,$data){
		$content = "<?php\r\n//  网站配置文件\r\nif (!defined('THINK_PATH')) exit();\r\nreturn array(\r\n";
		foreach ($data as $key=>$value){
			$key=strtoupper($key);
			if(strtolower($value)=="true" || strtolower($value)=="false" || is_numeric($value)){
				$content .= "\t'$key'=>$value, \r\n";
			}else{
				$content .= "\t'$key'=>'$value',\r\n";
			}
		$content .= ");\r\n?>";		
      	$r=@chmod($path,0777);
		$hand=file_put_contents($path,$content);
			if($hand){
				return true;
			}else{
				return false;		
			}
		}
	}   
}
