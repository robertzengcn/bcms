<?php
class WeixinController extends Controller{

	private $_tag;	
	protected $service;
	
	public function __construct($tag=''){
	
		$this->_tag = $tag;
		
		parent::__construct();
		$this->service = new WeixinService();
		//$this->setApp();	
	}
	
	public function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);
        return $filterService->execute();
    }

    /**
     * 获取微信总数...
     */
    public function getCountWeixin(){
    	$array = $this->service->getCountWeixin('');
    	echo json_encode($array);
    }
    
    /**
     * 保存微信号...
     */
    public function saveWeixin(){
    	$re = $this->service->saveWeixin();
    	echo json_encode($re);
    }
    
    /**
     * 获取微信号...
     */
    public function getListWeixin(){
        //同步商务通代码到微信页面
        $this->syncSwt();
        
    	$rows = $this->service->getListWeixin($_REQUEST);
    	$data = $this->service->getCountWeixin($_REQUEST);
    	$rows = $rows ? $rows : array();
    	$ttl = isset($data['data']) ? $data['data']: 0 ;
    	echo json_encode(array('rows'=>$rows,'ttl'=>$ttl));
    }
    
    /**
     * 同步商务通到微信页面
     * */
    public function syncSwt() {
        $urls = array(
            ABSPATH . '/plugin/weixin/bgdjd/itemlist.html',
            ABSPATH . '/plugin/weixin/bztz/article.html',
            ABSPATH . '/plugin/weixin/slys/foodinfo.html',
        );
    	try {
    		$dao = new ContactDAO();
    		$swtObj = $dao->getContact('swt');
    		$swt = '';
    		if (isset($swtObj->id) && !empty($swtObj->val)) {
    			$swt = trim($swtObj->val);
    		}
    		if ($swt) {
    			foreach ($urls as $url) {
    			    $content = file_get_contents($url);
    			    //判断是否存在id
    			    if (preg_match("/id=\"swtlink\"/", $content)) {
    			        //判断链接是否有改变
    			        $flag = preg_match("/<a href=\"{$swt}\" id=\"swtlink\">/", $content);
    			        //未改变则退出
    			        if ($flag) break;
    			        //替换<a href="#" id="swtlink">中的链接
    			        $content = preg_replace("/<a href=\"(.*)\" id=\"swtlink\">/", "<a href=\"{$swt}\" id=\"swtlink\">", $content);
    			        //重新写入
    			        file_put_contents($url, $content);
    			    }
    			}
    		}
    		
    	} catch (Exception $e) {
    	}
    }
    /**
     * 选择微信号...
     */
    public function choose(){
    	unset($_SESSION['token']);
    	$re = $this->service->choose();
    	echo json_encode($re);
    }
    
    /**
     * 删除微信...
     */
    public function deleteWeixin(){
    	//@unlink(ABSPATH.'/weixindb/weixinApp.json');
    	$ids = array();
    	if (is_array($_REQUEST['id'])) {
    		foreach ($_REQUEST['id'] as $value){
    			if($value == 'undefined'){
    				unset($value);
    			}else{
    				$ids[] = $value;
    			}
    		}
            $id = $ids;
        } else {
            $id = array(
                $_REQUEST['id']
            );
        }
    	$re = $this->service->deleteWeixin($id);
    	echo json_encode($re);
    }
	
	/**
	 * 获取token
	 */
	public function getToken($appid,$appsecret){
		$path = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
		$json = file_get_contents($path);
		$result = json_decode($json,true);
		$access_token = $result['access_token'];
		$_SESSION['token'] = $access_token;
		$_SESSION['tokentime'] = time();
	}
	
	/**
	 * 群发功能...
	 */
	public function sendAll(){
		$array = $this->service->sendAll();
		echo json_encode($array);
	}
	
	/**
	 * 更新用户数据...
	 */
	public function updateUsers(){
		$array = $this->service->updateUsers();
		echo json_encode($array);
	}
	
	/**
	 * 添加分组...
	 */
	public function addGroup(){
		$array = $this->service->addGroup();
		echo json_encode($array);
	}
	
	/**
	 * 获取所有的用户...
	 */
	public function userAll(){
		$result = $this->service->userAll();
		echo json_encode($result);
	}
	
	/**
	 * 获取所有的分组...
	 */
	public function groupAll(){
		$result = array();
		$result['data'] = $this->service->groupAll();
		if (count($result['data'])>=1) {
			$result['statu'] = true;
			echo json_encode((object)$result);
		}else{
			$result['statu'] = false;
		}
	}
	
	/**
	 * 修改用户到别的分组...
	 */
	public function updateGroup(){
		$result = array();
		$statu = $this->service->updateGroup();
		$result['statu'] = $statu;
		$result['msg'] = '修改分组成功';
		echo json_encode((object)$result);
	}
	
	/**
	 * 修改备注...
	 */
	public function updateRemark(){
		$result = array();
		$result['statu'] = $this->service->updateRemark();
		if ($result['statu']){
			$result['msg'] = '修改备注成功';
		}else{
			$result['msg'] = '修改备注失败';
		}
		echo json_encode((object)$result);
	}
	
	/**
	 * 设置自定义菜单...(3个一级菜单，每个一级菜单最多包含5个二级菜单)
	 */
	public function setMenu(){		
		$result = $this->service->setMenu();
		echo json_encode((object)$result);
	}
	
	/**
	 * 获取所有自定义菜单...
	 */
	public function menuAll(){
		$result = array();
		$result['data'] = $this->service->menuAll();
		if (count($result['data'])>=1){
			$result['statu'] = true;
		}else{
			$result['statu'] = false;
			$result['msg'] = '还没有设置任何菜单，请设置';
		}
		echo json_encode((object)$result);
	}
	
	/**
	 * 删除自定义菜单...
	 */
	public function deleteMenu(){
		$array = $this->service->deleteMenu();
		echo json_encode($array);
	}
	
	/**
	 * 设置关注时自动回复...
	 */
	public function setSub(){
		$array = $this->service->setSub();
		echo json_encode($array);
	}
	
	/**
	 * 删除关注时自动回复...
	 */
	public function deleteSub(){
		$array = $this->service->deleteSub();
		echo json_encode($array);
	}
	
	/**
	 * 检查是否已经设置了自动回复...
	 */
	public function isSetSub(){
		$array = $this->service->isSetSub();
		echo json_encode($array);
	}
	
	
	
	/**
	 * 将关键词保存到数据库...
	 */
	public function saveKeys(){
		$array = $this->service->saveKeys();
		echo json_encode($array);
	}
	
	/**
	 * 判断是否设置了关键词...
	 */
	public function issetKeysword(){
		$array = $this->service->issetKeysword();
		echo json_encode($array);
	}
	
	/**
	 * 查找已经设置的关键词.
	 */
	public function getKeyByName(){
	    $keyname = $_REQUEST['keyname'];
	    $array = $this->service->getKeyByName($keyname);
	    echo json_encode($array);
	}	
		
	
	
	/**
	 * 将所有的关键词设置到微信...
	 */
	public function sendKeys(){
		$array = $this->service->sendKeys();
		echo json_encode($array);
	}
	
	/**
	 * 用户发送来的数据自动保存到数据库...
	 */
	public function saveMsg($array){
		$re = $this->service->saveMsg($array);
		echo json_encode($re);
	}
	
	/**
	 * 获取关注者的消息...
	 */
	public function getListMsg(){
		$result = array();
		$array = $this->service->getListMsg();
		if($array['statu']){
			$result['rows'] = $array['data'];
			$result['ttl'] = $this->service->getCountMsg();
		}else{
			$result['statu'] = false;
			$result['msg'] = '暂时还没有任何信息';
		}
		echo json_encode($result);
	}
	
	/**
	 * 回复关注者...
	 */
	public function replyMessage(){
		$array = $this->service->replyMessage();
		echo json_encode($array);
	}
	
	/**
	 * 上传...
	 */
	public function uploadMessage(){
	    $type = isset($_REQUEST["material"]) ?$_REQUEST["material"]:null;
		$array = array();
		$array = $this->service->uploadMessage($type);
		echo json_encode($array);
	}

	/**
	 * 修改永久素材...
	 */
	public function updateMessage(){
	    $media_id = isset($_REQUEST["media_id"]) ?$_REQUEST["media_id"]:'';
		$id = isset($_REQUEST["id"]) ?$_REQUEST["id"]:'';
		$thumb_media_id= isset($_REQUEST["thumb_media_id"]) ?$_REQUEST["thumb_media_id"]:'';
		$array = array();
		$array['statu'] = $this->service->updateMessage($media_id,$id,$thumb_media_id);
		echo json_encode($array);
	}	
	
	/**
	 * 上传多图文...
	 */
	public function uploadMpnewses(){
		$array = $this->service->uploadMpnewses();
		echo json_encode($array);
	}
	
	/**
	 * 根据类型获取表中所有素材...
	 */
	public function getByType(){
		$array = array();
		$data = $this->service->getByType();
			$i= 0;
				$page = $_REQUEST['page'];												//分页处理
				$size = $_REQUEST['size'];	
				$count = $page * $size;								
				$num = ($page == 1) ? 0 : $count-$size;									
				$count = ((count($data)-$count) >= 0 ) ? $count : count($data);			
			for($i=$num; $i<$count; $i++){		
				$groupList[] = $data[$i];
			}

		if(is_array($data) &&  count($data)>=1 ){
			$array['statu'] = true;
			$array['rows'] = $groupList;
			$array['ttl'] = count($data);
		}else{
			$array['statu'] = false;
			$array['rows'] = array();
			$array['ttl'] = 0;
			$array['msg'] = $data;
		}
		echo json_encode($array);
	}
	
	/**  
	 * 根据id 删除 素材
	 * */
	public function delMessageById(){
	    $ids = array();
	    if (is_array($_REQUEST['id'])) {
	        foreach ($_REQUEST['id'] as $value){
	            if($value == 'undefined'){
	                unset($value);
	            }else{
	                $ids[] = $value;
	            }
	        }
	        $id = $ids;
	    } else {
	        $id = array(
	            $_REQUEST['id']
	        );
	    }
	    $re = $this->service->delMessageById($id);
	    echo json_encode($re);
	    
	}
	
	/** 
	 * 删除永久素材
	 *  */
	public function delMaterialById(){
	      $id =  $_REQUEST['id'];
	      $re = $this->service->delMaterialById($id);
	      echo json_encode($re);
	}
	
	/**
	 * 根据id 获取临时素材
	 * * */
	public function getMessageById(){
	    $id = $_REQUEST['id'];
	    $re = $this->service->getMessageById($id);
	    echo json_encode($re);
	}
	/**
	 * 根据素材名称 搜索素材
	 * * */
	public function getMessageByTitle(){
	    $title = $_REQUEST['msgname'];
	    $re = $this->service->getMessageByTitle($title);
	    echo json_encode($re);
	}	
	
	/**
	 * 根据thumb_meida_id获取显示图片
	 * */
	public function getShowPic() {
		echo json_encode($this->service->getShowPic());
	}
	
	/**
	 * 根据id 获取永久素材
	 * * */
	public function getMaterialByMid(){
	    $id = $_REQUEST['id'];
	    $re = $this->service->getMaterialByMid($id);
	    echo json_encode($re);
	}
	
	/** 获取永久素材总数 */
	public function getMaterialCount(){
	    $result = $this->service->getMaterialCount();
	    echo json_encode($result);
	}
	
	/** 获取永久素材列表*/
	public function getMaterialList(){
	    $result = $this->service->getMaterialList();
	    echo json_encode($result);
	}	
	
	/**
	 * 获取关键词表中所有数据...
	 */
	public function getAllKeys(){
		$array = $this->service->getAllKeys();
		echo json_encode($array);
	}
	
	/**
	 * 删除关键词表中的所有关键词...
	 */
	public function deleteAllKeys(){
		$array = $this->service->deleteAllKeys();
		echo json_encode($array);
	}
	
	/**
	 * 根据id删除关键词...
	 */
	public function deleteKeyById(){
		$array = $this->service->deleteKeyById();
		echo json_encode($array);
	}
	
	/**
	 * 获取统计数据...
	 */
	public function clickCount(){
		$re = $this->service->clickCount();
		$array = array();
		if(count($re)>0){
			$array['statu'] = true;
			$array['rows'] = $re;
			$array['ttl'] = count($re);			
		}else{
			$array['statu'] = false;
			$array['rows'] = array();
			$array['ttl'] = 0;
		}
		echo json_encode($array);
	}
	
	/**
	 * 获取唯一标志...
	 */
	public function getTag(){
		$tag = uniqid();
		if($tag){
			echo json_encode(array('statu'=>true,'data'=>$tag));
		}else{
			echo json_encode(array('statu'=>false,'msg'=>'获取唯一标识失败'));
		}
	}
	/**  
	 * 微信跳转链接获取专题
	 * */
	public function getTopicUrls(){	
        $result = $this->service->getTopicUrls($_REQUEST);
        $totalRows = $this->service->totalRows($_REQUEST);		
        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        ));		
	}	
	/**
	 * 上传文件...
	 */
	public function uploadFile(){
		$array = array();
		$path = COMPILEDIR . 'temporaryPic';
        $url = NETADDRESS . '/template_c/temporaryPic';
		if (! file_exists($path)) {
            mkdir($path, 0777);
        }
        $path = $path . '/' . $_GET['dir'];
        //echo $path;exit;
        $uploadPath = GENERATEPATH . 'upload/' . $_GET['dir'];
		if (! file_exists($uploadPath)) {
            mkdir($uploadPath, 0777);
        }
		if (! file_exists($path)) {
            mkdir($path, 0777);
        }
		$fileData = $_FILES['Filedata'];
		$onlyname = date ( 'YmdHis' ) . rand ( 0, 1000 );
		$arr = explode('.', $fileData['name']);
		$hz = $arr[count($arr)-1];
		$filename = $path.'/'.$onlyname.'.'.$hz;
		$tmpname = $fileData['tmp_name'];
		$showname = $url.'/'.$_GET['dir'].'/'.$onlyname.'.'.$hz;
		if(is_uploaded_file($tmpname)){
			if(move_uploaded_file($tmpname, $filename)){
				$array['statu'] = true;
				$array['filename'] = $filename;
				$array['showname'] = $showname;
			}else{
				$array['statu'] = false;
			}
		}else{
			$array['statu'] = false;
		}
		echo json_encode($array);
	}
	
	/**
	 * 销毁token重新获取...
	 */
	public function reset(){
		unset($_SESSION['token']);
		$array = array();
		$array['statu'] = true;
		echo json_encode($array);
	}
	
	/** 疾病自诊 接口，通过部位名称获取症状信息 */
	
	public function autognosis(){
	    $id = $_REQUEST['id'];
	    $type = $_REQUEST['type'];
	    $part= $_REQUEST['part'];
	    $url = 'http://www.boyicms.com/interface/hma/AutognosisInterface.php' ;
	    $params ="part={'id':".$id.",'type':'".$type."','part':'".$part."'}";
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;	   
	}
	
	
	/** 疾病自诊 接口，通过症状获取伴随症状或疾病 */
	
	public function assSymptom(){
	    $id = $_REQUEST['id'];
	    $type = $_REQUEST['type'];
	    $symptom= $_REQUEST['symptom'];
	    $assSymptom= $_REQUEST['assSymptom'];
	    $url = 'http://www.boyicms.com/interface/hma/AutognosisInterface.php' ;
	    $params ="part={'id':'".$id."','type':'".$type."','symptom':'".$symptom."','assSymptom':'".$assSymptom."'} ";
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	}
	
	/** 疾病自诊 接口，通过疾病名称获取疾病内容 */
	
	public function diseaseresult(){
	    $id = isset($_REQUEST['id'])?$_REQUEST['id'] : '1234';
	    $type = isset($_REQUEST['type'])?$_REQUEST['type'] : '';
	    $sickness= isset($_REQUEST['sickness'])?$_REQUEST['sickness'] : '';
	    $url = 'http://www.boyicms.com/interface/hma/AutognosisInterface.php' ;
	    $params = "part={'id':'".$id."','type':'".$type."','sickness':'".$sickness."'}";
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	}

	/** 疾病自诊 接口，关键词搜索 */
	public function keySearch(){
	    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'1234';
	    $type = isset($_REQUEST['keys'])?$_REQUEST['keys']:'keys';
	    $part = isset($_REQUEST['part'])?$_REQUEST['part']:''; 
	    $url = 'http://www.boyicms.com/interface/hma/AutognosisInterface.php' ;
	    $post_data = "{'id':'".$id."','type':'".$type."','part':'".$part."'}";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	    
	}
	
	

	
	/** 食疗养生接口，获取 疾病详细分类 */
	public function foodTherapyDis(){
	    $type = $_REQUEST['type'];
	    $type_name = $_REQUEST['type_name'];
	    $url = 'http://www.boyicms.com/interface/hma/FoodTherapyInterface.php' ;
	    $post_data = "{'type':'".$type."', 'type_name':'".$type_name."'}";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	    
	}
	
	
	/** 食疗养生接口，获取食谱推荐列表  */
	
	public function foodTherapyList(){
	    $type = $_REQUEST['type'];
	    $classtype = $_REQUEST['classtype'];
	    $diseasename = $_REQUEST['diseasename'];
	    $types = $_REQUEST['types'];
	    $url = 'http://www.boyicms.com/interface/hma/FoodTherapyInterface.php' ;
	    $post_data = "{'type':'".$type."','classtype':'".$classtype."','diseasename':'".$diseasename."','types':'".$types."'}";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	     
	}
	
	/** 食疗养生接口，获取食谱详细信息  */
	public function foodTherapyInfo(){
	    $type = "food_context";
	    $food_name = $_REQUEST['food_name'];
	    $id= $_REQUEST['id'];
	    $classtype = $_REQUEST['classtype'];
	    $diseasename = $_REQUEST['diseasename'];
	    $types = $_REQUEST['types'];
	    $url = 'http://www.boyicms.com/interface/hma/FoodTherapyInterface.php' ;
	    $post_data = "{'type':'".$type."', 'food_name':'".$food_name."', 'id':'".$id."', 'classtype':'".$classtype."','diseasename':'".$diseasename."','types':'".$types."'}";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	
	}
	
	/** 饮食宜忌接口，获取症状 饮食宜忌详细信息  */
	
	public function getFoodTherapy(){
	    $type = "food_contraindicated";
	    $context = $_REQUEST['context'];
	    $type_name= $_REQUEST['type_name'];	  
	    $url = 'http://www.boyicms.com/interface/hma/FoodTherapyInterface.php' ;
	    $post_data = "{'type':'".$type."','context':'".$context."','type_name':'".$type_name."'}";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	}
	
	/** 饮食宜忌接口 根据类型 获取更多 */
	public function getFoodTherapyMore(){
	    $type = "get_disease_by_foodtable_types";
	    $context = $_REQUEST['context'];
	    $type_name= $_REQUEST['type_name'];
	    $url = 'http://www.boyicms.com/interface/hma/FoodTherapyInterface.php' ;
	    $post_data = "{'type':'".$type."','context':'".$context."','type_name':'".$type_name."'}";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	}
	
	
	/** 标准体重  
	 **/
	public function getBMI($height,$weight){
	    $height = $height / 100;
	    return $weight/($height*$height);
	}
	
	/**  
	 * 计算标准体重的函数
	 * */
	public function stardardWeight($height,$weight,$sex){
	    if($sex == 1){
	        $weight = $height - 105;    //体重改良，男性：标准体重（kg)=身高-105（cm)
	    }else{
	        $weight = $height - 105 - 2.5;   //女性：标准体重（kg)=身高-105-2.5（cm）
	    }
	    return json_encode($weight);
	}
	
	/**  
	 * 成人的BMI数值： 
	 * 过轻：低于18.5 
	 * 正常：18.5-24.99 
	 * 适中：20-25
	 * 过重：25-28 
	 * 肥胖：28-32 
	 * 非常肥胖, 高于32 
	 * 专家指出最理想的体重指数是22
	 * */
	public function getBMIState(){
	    $height = isset($_REQUEST['height']) ? $_REQUEST['height']: 0;
	    $weight= isset($_REQUEST['weight']) ? $_REQUEST['weight'] : 0;
	    $sex= isset($_REQUEST['sex']) ? $_REQUEST['sex'] : 1;
	    $bmi = $this->getBMI($height, $weight);
	    $out = "计算出现异常";
		if ($bmi <= 18.5) {
		    $out = "体重过轻";
		} else if ($bmi > 18.5 && $bmi <= 25) {
		    $out = "体重正常";
		} else if ($bmi > 25 && $bmi <= 28) {
		    $out = "体重过重";
		} else if ($bmi > 28 && $bmi <= 32) {
		    $out = "肥胖";
		} else if ($bmi > 32) {
		    $out = "非常肥胖";
		}
		$stdWeight = $this->stardardWeight($height, $weight, $sex);
	    echo json_encode(array('bmi'=>$out,'stdWeght'=>$stdWeight));
	}
	
	
	/**  检查报告单  查找具体检查项目*/
	public function reportContent(){
	    $username = isset($_REQUEST['username']) ? $_REQUEST['username']: '1234';
	    $type = "report_examine";
	    $type_name = isset($_REQUEST['type_name']) ? $_REQUEST['type_name']: '';
	    $classsify_id = isset($_REQUEST['classify_id']) ? $_REQUEST['classify_id']: '';
	    $url = 'http://www.boyicms.com/interface/hma/ReportInterface.php' ;
	    $post_data ="{'username':'".$username."', 'type':'".$type."', 'type_name':'".$type_name."','classify_id':'".$classsify_id."'} ";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	}
	
	
	//stdclass 转 array
	public function object_array($array){
	    if(is_object($array)){
	        $array = (array)$array;
	    }
	    if(is_array($array)){
	        foreach($array as $key=>$value){
	            $array[$key] = $this->object_array($value);
	        }
	    }
	    return $array;
	}
	
	/**
	 * 提交报告单
	 */
	public function submitReport(){
	    $type = "report";
	    $username = isset($_REQUEST['username']) ? $_REQUEST['username']: '1234';
	    $resultArr= $_REQUEST['resultArr'];
	    $referenceArr= $_REQUEST['referenceArr'];
	    $type_name = isset($_REQUEST['type_name']) ? $_REQUEST['type_name']: '';
	    $url = 'http://www.boyicms.com/interface/hma/ReportInterface.php' ;
	    $post_data ="{'username':'".$username."', 'type':'"."report_examine"."', 'type_name':'".$type_name."'} ";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $out = curl_exec($ch);
	    $out = json_decode($out);
	    $result = $this->object_array($out);
	    foreach ($result['report_items'] as $k=>&$v){
	        $v['result'] = $resultArr[$k];
	        if($referenceArr[$k] != ""){
	            $v['reference_value'] = $referenceArr[$k];
	        }
	       
	    }
	    $report_name = json_encode($result['report_items'],JSON_UNESCAPED_UNICODE);
	    $url = 'http://www.boyicms.com/interface/hma/ReportInterface.php' ;
	    $post_data = "{'username':'".$username."','type':'report','report_name':".$report_name."}";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	    
	}
	
	/**   
	 * 根据type_name查找报告单子分类
	 * */
	public function getReportType(){
	    $username = isset($_REQUEST['username']) ? $_REQUEST['username']: '1234';
	    $type_name = isset($_REQUEST['type_name']) ? $_REQUEST['type_name']: '';
	    $url = 'http://www.boyicms.com/interface/hma/ReportInterface.php' ;
	    $post_data = "{'username':'".$username."', 'type':'report_classify', 'type_name':'".$type_name."'}";
	    $params = 'part=' . $post_data;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	}
	
	/**
	 * 根据wec_type查找微信编辑器内容
	 * '1' => '标题',
	        '2' => '正文',
	        '3' => '图文',
	        '4' => '关注',
	        '5' => '分隔线',
	        '6' => '背景',
	        '7' => '表情图',
	        '8' => '阅读原文',
	        '9' => '点赞',
	        '10' => '其它',
	 * */
	public function getWechatContent(){
	    $type = isset($_REQUEST['type']) ? $_REQUEST['type']: '1';
	    $url = 'http://www.boyicms.com/interface/hwibs/weixin/WechatInterface.php';
	    $params = 'action=list&type=' . $type . '&' . $this->formatApiTokenQry('list');
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    $output = curl_exec($ch);
	    echo $output;
	}
	
	
	
	/**
	 * 回复模版
	 */
	private $_msg_template = array(
		'text' => '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>',//文本回复XML模板
		'image' => '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[%s]]></MediaId></Image></xml>',//图片回复XML模板
		'music' => '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[music]]></MsgType><Music><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><MusicUrl><![CDATA[%s]]></MusicUrl><HQMusicUrl><![CDATA[%s]]></HQMusicUrl><ThumbMediaId><![CDATA[%s]]></ThumbMediaId></Music></xml>',//音乐模板
		'news' => '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>%s</ArticleCount><Articles>%s</Articles></xml>',// 新闻主体
		'news_item' => '<item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item>',//某个新闻模板
		);

	/**
	 * 发送文本信息
	 * @param  [type] $to      目标用户ID
	 * @param  [type] $from    来源用户ID
	 * @param  [type] $content 内容
	 * @return [type]          [description]
	 */
	private function _msgText($to, $from, $content) {
		$response = sprintf($this->_msg_template['text'], $to, $from, time(), $content);
		die($response);
	}
	/**
	 * 发送图片消息
	 * @param  [type] $to   [description]
	 * @param  [type] $from [description]
	 * @param  [type] $file 图片文件地址
	 * @return [type]       [description]
	 */
	private function _msgImage($to, $from, $file, $is_id=false) {
		if ($is_id) {
			$media_id = $file;
		} else {
			// 上传图片到微信公众服务器，获取mediaID
			$result_obj = $this->uploadTmp($file, 'image');
			$media_id = $result_obj->media_id;
		}
		// 拼凑图像类消息xml文件
		$response = sprintf($this->_msg_template['image'], $to, $from, time(), $media_id);
		die($response);
	}
	/**
	 * 发送音乐消息
	 *	
	 */
	private function _msgMusic($to, $from, $music_url, $hq_music_url, $thumb_media_id, $title='', $desc='') {
		$response = sprintf($this->_msg_template['music'], $to, $from, time(), $title, $desc, $music_url, $hq_music_url, $thumb_media_id);
		die($response);
	}
	/**
	 * 发送新闻消息
	 *
	 */
	private function _msgNews($to, $from, $item_list=array()) {
		// 拼凑文章部分
		$item_str = '';
		foreach($item_list as $item) {
			$item_str .= sprintf($this->_msg_template['news_item'], $item['title'], $item['desc'], $item['picurl'], $item['url']);
		}
		//拼凑整体图文部分
		$response = sprintf($this->_msg_template['news'], $to, $from, time(), count($item_list), $item_str);
		die($response);
	}

    /**
     * 处理事件
     */
	public function responseMSG() {
		// 获取请求时POST：XML字符串
		// $_POST,不是key/value型因此不能使用该数组
		$xml_str = $GLOBALS['HTTP_RAW_POST_DATA'];

		// 如果没有post数据，则响应空字符串表示结束
		if (empty($xml_str)) {
			die ('');
		}

		// 解析该xml字符串，利用simpleXML
		libxml_disable_entity_loader(true);//禁止xml实体解析，防止xml注入
      	$request_xml = simplexml_load_string($xml_str, 'SimpleXMLElement', LIBXML_NOCDATA);//从字符串获取simpleXML对象

      	// 判断该消息的类型通过元素：MsgType
      	switch ($request_xml->MsgType) {
      		case 'event': // 事件类型
      			// 判断具体的事件类型（关注，取消，点击）
      			$event = $request_xml->Event;
      			if ('subscribe'==$event) { // 关注事件
      				$this->_doSubscribe($request_xml);
      			}
      			elseif ('CLICK' == $event) { //菜单点击事件
      				$this->_doClick($request_xml);
      			}
      			elseif ('VIEW' == $event) { //连接跳转事件
					$this->_doView($request_xml);
      			}
      			break;
      		case 'text': // 文本消息
      			$this->_doText($request_xml);
      			break;
      		case 'image': // 图片消息
      			$this->_doImage($request_xml);
      			break;
      		case 'voice': // 语音消息
      			$this->_doVoice($request_xml);
      			break;
      		case 'video': // 视频消息
      			$this->_doVideo($request_xml);
      			break;
      		case 'shortvideo': // 短视频消息
      			$this->_doShortVideo($request_xml);
      			break;
      		case 'location': // 位置消息
      			$this->_doLocation($request_xml);
      			break;
      		case 'link': // 连接消息
      			$this->_doLink($request_xml);
      			break;
      		default:
      			break;
      	}
	}
	/**
	 * 用于处理关注事件的方法
	 * @param  [type] $request_xml 事件信息对象
	 * @return [type]              [description]
	 */
	private function _doSubscribe($request_xml) {
		// 利用消息发送，完成向关注用户打招呼功能！
		$configFile = ABSPATH.'/weixindb/'.$this->_tag.'_subcontent.json';
		if (file_exists($configFile)) {		   
			//发送文本消息
			$subcontent = json_decode(file_get_contents($configFile),true);
			$msgtype = $subcontent['msgtype'];
			if($msgtype == 'text'){
				$this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $subcontent['content']);			
			}elseif($msgtype == 'news'){
				//发送图文消息
				$news_list = array();
				$news = array();
				for($i=1; $i<=$subcontent['ArticleCount'];$i++){
					$news['title'] = $subcontent['Atitle'][$i];
					$news['desc'] = $subcontent['Adescription'][$i];
					$news['picurl'] = $subcontent['Apicurl'][$i];
					$news['url'] = $subcontent['Aurl'][$i];
					array_push($news_list,$news);
				}
				$this->_msgNews($request_xml->FromUserName, $request_xml->ToUserName, $news_list);				
			}
		}

	}	
	/**
	 * 用于处理文本消息的方法
	 */
	private function _doText($request_xml) {
		//将用户发送来的数据自动保存到数据库
		$array = "";
 		if(is_object($request_xml)) {  
			$array = (array)$request_xml;  
		}
		$this->saveMsg($array); 
		// 获取文本内容
		$content = $request_xml->Content;
		// 对内容进行判断
		$keywordFile = ABSPATH.'/weixindb/'.$this->_tag.'_keywordsdata.json';		//设置的关键词回复
		$data = '';
		if (file_exists($keywordFile)) {
			$keywordsdata = json_decode(file_get_contents($keywordFile));
			foreach($keywordsdata as $key=>$vo){
				if($vo->keyword == $content){
					$data = $vo->content;
				}
			}
		}
		if($data){
			$this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $data);				
		}else {
				//自动发送图文消息
				$configFile = ABSPATH.'/weixindb/'.$this->_tag.'_subcontent.json';
				$subcontent = json_decode(file_get_contents($configFile),true);
				$news_list = array();
				$news = array();
				for($i=1; $i<=$subcontent['ArticleCount'];$i++){
					$news['title'] = $subcontent['Atitle'][$i];
					$news['desc'] = $subcontent['Adescription'][$i];
					$news['picurl'] = $subcontent['Apicurl'][$i];
					$news['url'] = $subcontent['Aurl'][$i];
					array_push($news_list,$news);
				}

				$this->_msgNews($request_xml->FromUserName, $request_xml->ToUserName, $news_list);

		}
	}
	/**
	 * 处理点击菜单跳转链接事件
	 */

	private function _doView($request_xml) {
		$url = ABSPATH.'/weixindb/'.$this->_tag.'_clickCount.json';
		$request_xml = (array)$request_xml;
		if(file_exists($url)){
			$clickContent = json_decode(file_get_contents($url), true);
			foreach($clickContent as $key => $click){
				if($click['ClickUrl'] == $request_xml['EventKey']){
					$clickContent[$key]['ClickNum'] = $click['ClickNum']+1;
					$clickContent[$key]['CreateTime'] = time();
				}
			}
			file_put_contents($url, json_encode($clickContent));
		}	
	}
	/**
	 * 处理点击事件
	 */
	private function _doClick($request_xml) {
		//$content = '你点击了菜单，携带的KEY为: ' . $request_xml->EventKey;
		//$this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $content);
	}
	/**
	 * 处理图片响应数据
	 */
	private function _doImage($request_xml) {
		//$content = '你所上传的图片的Media_ID:' . $request_xml->MediaId;
		//$this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $content);
	}

	private function _doLocation($request_xml) {
		// $content = '你的坐标为,经度:'.$request_xml->Location_Y.',纬度:'.$request_xml->Location_X . "\n" . '你所在的位置为：' . $request_xml->Label;
		// $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $content);
		// 利用位置获取信息
		//百度LBS圆形范围查询：
		$url = 'http://api.map.baidu.com/place/v2/search?query=%s&location=%s&radius=%s&output=%s&ak=%s';
		$query = '银行';
		$location  = $request_xml->Location_X . ',' . $request_xml->Location_Y;
		$radius = 2000;
		$output = 'json';
		$ak = 'OBDl6igKrng0V6VqT5RWIP6z';
		$url = sprintf($url, urlencode($query), $location, $radius, $output, $ak);
		$result = $this->_requestGet($url, false);
		$result_obj = json_decode($result);
		$re_list = array();
		foreach($result_obj->results as $re) {
			$r['name'] = $re->name;
			$r['address'] = $re->address;
			$re_list[] = implode('-', $r);
		}
		$re_str = implode("\n", $re_list);
		//
		$this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $re_str);
	}

		

}