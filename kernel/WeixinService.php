<?php
class WeixinService extends BaseService{
	
	private $errorMsg = array(
		-1 => '系统繁忙',
		40001 => '获取access_token时AppSecret错误，或者access_token无效',
		40002 => '不合法的凭证类型',
		40003 => '不合法的OpenID',
		40004 => '不合法的媒体文件类型',
		40005 => '不合法的文件类型',
		40006 => '不合法的文件大小',
		40007 => '不合法的媒体文件id',
		40008 => '不合法的消息类型',
		40009 => '不合法的图片文件大小',
		40010 => '不合法的语音文件大小',
		40011 => '不合法的视频文件大小',
		40012 => '不合法的缩略图文件大小',
		40013 => '不合法的APPID',
		40014 => '不合法的access_token',
		40015 => '不合法的菜单类型',
		40016 => '不合法的按钮个数',
		40017 => '不合法的按钮个数',
		40018 => '不合法的按钮名字长度',
		40019 => '不合法的按钮KEY长度',
		40020 => '不合法的按钮URL长度',
		40021 => '不合法的菜单版本号',
		40022 => '不合法的子菜单级数',
		40023 => '不合法的子菜单按钮个数',
		40024 => '不合法的子菜单按钮类型',
		40025 => '不合法的子菜单按钮名字长度',
		40026 => '不合法的子菜单按钮KEY长度',
		40027 => '不合法的子菜单按钮URL长度',
		40028 => '不合法的自定义菜单使用用户',
		40029 => '不合法的oauth_code',
		40030 => '不合法的refresh_token',
		40031 => '不合法的openid列表',
		40032 => '不合法的openid列表长度',
		40033 => '不合法的请求字符，不能包含\uxxxx格式的字符',
		40035 => '不合法的参数',
		40038 => '不合法的请求格式',
		40039 => '不合法的URL长度',
		40050 => '不合法的分组id',
		40051 => '分组名字不合法',
		40054 => '请按正确格式填写',
		40119 => 'button类型错误',
		40118 => 'media_id大小不合法',
		40117 => '分组名字不合法',
		40120 => 'button类型错误',
		41001 => '缺少access_token参数',
		41002 => '缺少appid参数',
		41003 => '缺少refresh_token参数',
		41004 => '缺少secret参数',
		41005 => '缺少多媒体文件数据',
		41006 => '缺少media_id参数',
		41007 => '缺少子菜单数据',
		41008 => '缺少oauth code',
		41009 => '缺少openid',
		42001 => 'access_token超时',
		42002 => 'refresh_token超时',
		42003 => 'oauth_code超时',
		43001 => '需要GET请求',
		43002 => '需要POST请求',
		43003 => '需要HTTPS请求',
		43004 => '需要接收者关注',
		43005 => '需要好友关系',
		44001 => '多媒体文件为空',
		44002 => 'POST的数据包为空',
		44003 => '图文消息内容为空',
		44004 => '文本消息内容为空',
		45001 => '多媒体文件大小超过限制',
		45002 => '消息内容超过限制',
		45003 => '标题字段超过限制',
		45004 => '描述字段超过限制',
		45005 => '链接字段超过限制',
		45006 => '图片链接字段超过限制',
		45007 => '语音播放时间超过限制',
		45008 => '图文消息超过限制',
		45009 => '接口调用超过限制',
		45010 => '创建菜单个数超过限制',
		45015 => '回复时间超过限制',
		45016 => '系统分组，不允许修改',
		45017 => '分组名字过长',
		45018 => '分组数量超过上限',
		46001 => '不存在媒体数据',
		46002 => '不存在的菜单版本',
		46003 => '您还没有设置任何自定义菜单信息，马上开始设置吧',
		46004 => '不存在的用户',
		47001 => '解析JSON/XML内容错误',
		48001 => '本功能未经微信公众号授权，请到微信管理后台开通权限',
		50001 => '用户未授权该api'
	);
	
	public function __construct(){
		$this->dao = new WeixinDAO();
	}
	
	/**
	 * 设置微信APP...
	 */
	public function setApp(){
		$filename = ABSPATH.'/weixindb/weixinApp.json';	
		if (file_exists($filename)){
			$json = file_get_contents($filename);
			$array = json_decode($json,true);
			if (isset($array['tag']) && ! preg_match("/auth/i", $array['tag'])) {
			    $access_token = $this->judgeToken($array);
			    define('ACCESS_TOKEN', $access_token->token);
			    define('WEIXIN_TAG',$access_token->tag);
			}
		}else{
			return true;
		}
	}
	
	/**
	 * 获取微信总数...
	 */
	public function getCountWeixin($where){
		$count = $this->dao->getCountWeixin($where);
		if($count >= 1 ){
			return array('statu'=>true,'data'=>$count);
		}else{
			return array('statu'=>false,'msg'=>'还没有添加微信，请添加');
		}
	}
	
	/**
	 * 保存微信...
	 */
	public function saveWeixin(){
		unset($_REQUEST['controller'],$_REQUEST['method']);
		if ($_REQUEST['pic'] != ''){
			$array = explode("/", $_REQUEST['pic']);
			$array = array_reverse($array);
			$_REQUEST['pic'] = $array[1].'/'.$array[0];
		}
		$weixin = new Weixin();
		foreach ($_REQUEST as $key=>$val){
			$weixin->$key = $val;
		}
		$weixin->validate();
		$re = $this->dao->saveWeixin($weixin);
		if($re){
			return array('statu'=>true,'msg'=>'添加成功！');
		}else{
			return array('statu'=>false,'msg'=>'添加失败！');
		}
	}
	
	/**
	 * 获取微信...
	 */
	public function getListWeixin($where){
		$result = $this->dao->getListWeixin($where);
		return $result;
	}
	
	/**
	 * 选择微信号...
	 */
	public function choose(){
		$weixin = $this->getWeixinById((int)$_REQUEST['id']);
		$array = array();
		$array['appid'] = $weixin->appid;
		$array['appsecret'] = $weixin->appsecret;
		$array['tag'] = $weixin->tag;
		$array['token'] = 'boyicms';    //公众平台请求开发者时需要标记
		$dir = ABSPATH.'/weixindb';
		if(!is_dir($dir)){
			@mkdir($dir,0777);
		}
		$ret = file_put_contents('../weixindb/weixinApp.json', json_encode($array));
		if(preg_match("/auth/i", $weixin->tag)){
			//如果是auth，则是已授权第三方的公众号
		    return array('statu'=>true);
		}
		
		//先获取token判断是否存在
		$this->judgeToken($array);
		if($ret){
			return array('statu'=>true);
		}else{
			return array('statu'=>false,'msg'=>'选择失败');
		}
	}
	
	
	/**
	 * 获取token...
	 */
	public function getTokenByTag($tag){
		$access_token = new Access_token();
		$access_token->tag = $tag;
		$this->dao->getTokenByTag($access_token);
		return $access_token;
	}
	
	/**
	 * 获取token
	 */
	public function getToken($appid,$appsecret){
		$path = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
		$json = $this->getByCurl($path);
		$result = json_decode($json,true);
		if(isset($result['errcode']) && $result['errcode'] != 0){
			$this->errorMessage($result['errcode']);
		}
		$access_token = $result['access_token'];
		return $access_token;
	}
	
	/**
	 * 判断token...
	 */
	public function judgeToken($array){
		$access_token = $this->getTokenByTag($array['tag']);
		if($access_token->id == ''){
			//获取token添加到数据表
			$token = $this->getToken($array['appid'], $array['appsecret']);
			$access_token->token = $token;
			$access_token->createtime = time();
			$access_token->validate();
			$this->dao->saveToken($access_token);
		}else{
			if(time() - $access_token->createtime >= 7200){
				$token = $this->getToken($array['appid'], $array['appsecret']);
				$access_token->token = $token;
				$access_token->createtime = time();
				$access_token->validate();
				$this->dao->updateToken($access_token);
			}
		}
		return $access_token;
	}
		
	/**
	 * 删除微信...
	 */
	public function deleteWeixin($ids){
		Entity::isIds($ids);
		$re = $this->dao->deleteWeixin($ids);
		if($re){
			return array('statu'=>true,'msg'=>'删除成功');
		}
	}
	
	/**
	 * 根据id获取微信号...
	 */
	public function getWeixinById($id){
		$weixin = new Weixin();
		$weixin->id = $id;
		$this->dao->getWeixinById($weixin);
		return $weixin;
	}
	
	/**
	 * 直接群发给所有关注的用户
	 */
	public function sendAll(){
	    $type = isset($_REQUEST['msgtype']) ? $_REQUEST['msgtype'] : '';
	    //当type为text时，content为内容，否则为media_id
	    $content = isset($_REQUEST['content']) ? $_REQUEST['content'] : '';
	    
	    if ($type == ''){
	        return array('statu'=>false, 'msg'=>'请选择要发送的信息类型');
	    }
	    
	    if ($content == ''){
	        return array('statu'=>false, 'msg'=>'请选择要发送的信息内容');
	    }
	
	    $data = $this->groupData($type, '', $content);
	
	    if (isset($data) && !empty($data)) {
	        $data = $type=='text' ? $data : json_encode($data);
	        if ($appid = $this->checkIsAuthorizer()) {
	            //从第三方平台取数据
	            $array = $this->getRemoteData($appid, 'sendAll', array('data'=>$data));
	        } else {
	            $this->setApp();
	            $path = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.ACCESS_TOKEN;
	            $result = $this->curlData($path, $data);
	            $array = json_decode($result,true);
	        }
	    }
	
	    if ($array['errcode'] == 0) {
	        return array('statu'=>true,'msg'=>'群发成功，用户过几分钟就可以收到消息');
	    }else{
	        $this->errorMessage($array['errcode']);
	    }
	}
	/**
	 * 按组或用户进行群发，原来的sendAll方法，暂停使用...
	 */
	public function sendAll2(){
		$this->setApp();
		$arr = array();
		
		if ($_REQUEST['msgtype'] == ''){
			$array['statu'] = false;
			$array['msg'] = '请选择要发送的信息类型';
			return $array;
		}else{
			$type = $_REQUEST['msgtype'];
		}
		if($_REQUEST['group'] == '' && $_REQUEST['users'] == ''){
			$array['statu'] = false;
			$array['msg'] = '请选择要群发的用户';
			return $array;
		}
		if($_REQUEST['group'] != '' && $_REQUEST['users'] != ''){
			$array['statu'] = false;
			$array['msg'] = '群发的分组与指定用户发送两者只能选一个';
			return $array;
		}
		
		if($_REQUEST['msgtype'] == 'text'){
			if ($_REQUEST['content'] == ''){
				$array['statu'] = false;
				$array['msg'] = '群发的内容不能为空';
				return $array;
			}else{
				$val = $_REQUEST['content'];
			}
		}else{
			foreach($_REQUEST['media_id'] as $key=>$value){
				if ($value == ''){
					$array['statu'] = false;
					$array['msg'] = '请选择要发送的信息';
					return $array;
				}else{
					$val = $value;
				}
			}
		}
		
		if ($_REQUEST['group'] != '' && $_REQUEST['users'] == ''){
		    $sendType = 'sendAll';
			$path = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.ACCESS_TOKEN;
			$data = $this->groupData($type, $_REQUEST['group'], $val);
			if($_REQUEST['msgtype'] != 'text'){
				$data = json_encode($data);
			}
		}
		if ($_REQUEST['group'] == '' && $_REQUEST['users'] != ''){
		    $sendType = 'send';
			$path = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.ACCESS_TOKEN;
			$data = $this->openidData($type, $_REQUEST['users'], $val);
			if($_REQUEST['msgtype'] != 'text'){
				$data = json_encode($data);
			}
		}
		
		if (isset($data) && !empty($data)) {
		    if ($appid = $this->checkIsAuthorizer()) {
		        //从第三方平台取数据
		        $array = $this->getRemoteData($appid, $sendType, array('data'=>$data));
		    } else {
		        $result = $this->curlData($path, $data);
		        $array = json_decode($result,true);
		    }
		}
		
		if ($array['errcode'] == 0) {
			$arr['statu'] = true;
			$arr['msg'] = '群发成功，用户过几分钟就可以收到消息';
		}else{
			$this->errorMessage($array['errcode']);
		}
		
		return $array;
	}	
	/**
	 * 设置根据分组id群发设置数据...
	 */
	public function groupData($type,$group_id,$val){
		$array = array();
		
		if ($group_id) {
		    $array['filter']['group_id'] = $group_id;
		} else {
		    $array['filter']['is_to_all'] = true;
		}
		
		switch ($type){
			case 'news':
				$array['mpnews'] = array('media_id'=>$val);
				$array['msgtype'] = 'mpnews';
				break;
			case 'text':
				$data = '{"filter":{"group_id":"'.$group_id.'"},';
				$data .= '"text":{"content":"'.$val.'"},';
				$data .= '"msgtype":"text"}';
				return $data;
				break;
			case 'voice':
				$array['voice'] = array('media_id'=>$val);
				$array['msgtype'] = 'voice';
				break;
			case 'image':
				$array['image'] = array('media_id'=>$val);
				$array['msgtype'] = 'image';
				break;
			case 'video':
				$array['mpvideo'] = array('media_id'=>$val);
				$array['msgtype'] = 'mpvideo';
				break;				
		}
		return $array;
	}
	
	/**
	 * 根据openid列表来群发信息...
	 */
	public function openidData($type,$openids,$val){
		$array = array();
		$array['touser'] = explode(',', $openids);
		switch ($type){
			case 'news':
				$array['mpnews'] = array('media_id'=>$val);
				$array['msgtype'] = 'mpnews';
				break;
			case 'text':
				$data = '{"touser":';
				$data .= json_encode($array['touser']).',';
				$data .= '"msgtype": "text", "text": { "content": "'.$val.'"}}';
				return $data;
				break;
			case 'voice':
				$array['voice'] = array('media_id'=>$val);
				$array['msgtype'] = 'voice';
				break;
			case 'image':
				$array['image'] = array('media_id'=>$val);
				$array['msgtype'] = 'image';
				break;
			case 'video':
				$array['video'] = array('media_id'=>$val);
				$array['msgtype'] = 'video';
				break;				
		}
		return $array;
	}
	
	/**
	 * 添加分组...
	 */
	public function addGroup(){
		$this->setApp();
		if(trim($_REQUEST['groupid']) == ''){
			$path = 'https://api.weixin.qq.com/cgi-bin/groups/create?access_token='.ACCESS_TOKEN;
			$data = '{"group":{"name":"'.trim($_REQUEST['groupname']).'"}}';
			$info = $this->curlData($path, $data);
		}else{
			$path = 'https://api.weixin.qq.com/cgi-bin/groups/update?access_token='.ACCESS_TOKEN;
			$data = '{"group":{"id":'.(int)$_REQUEST['groupid'].',"name":"'.trim($_REQUEST['groupname']).'"}}';
			$info = $this->curlData($path, $data);
		}
		$array = json_decode($info,true);
		if(isset($array['errcode']) && $array['errcode'] != 0){
			$this->errorMessage($array['errcode']);
		}
		return array('statu'=>true,'msg'=>'操作成功');
	}
	
	/**
	 * 获取所有的用户...
	 */
	public function userAll(){
		$this->setApp();
		$array = $this->getAllUsers($_REQUEST);
		$arr = array();
		$arr['ttl'] = $this->dao->getCountUser();
		$result = array();
		$url = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token='.ACCESS_TOKEN;
		//获取所有的分组
		$allGroup = $this->groupAll();
		foreach ($array as $value){
			//根据openid获取分组
			$data = '{"openid":"'.$value->openid.'"}';
			$info = $this->curlData($url, $data);
			$group = json_decode($info,true);
			if($group['errcode'] != 0){
				$this->errorMessage($group['errcode']);
			}
			//根据goupid获取所属的组名
			foreach ($allGroup as $val){
				if ($group['groupid'] == $val['id']){
					$groupName = $val['name'];
				}
			}
			//根据openid获取用户的基本信息
			$userPath = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.ACCESS_TOKEN.'&openid='.$value->openid;
			$re = $this->getByCurl($userPath);
			$user = json_decode($re,true);
			if(isset($user['errcode']) && $user['errcode'] != 0){
				$this->errorMessage($user['errcode']);
			}
			$result[] = array('openid'=>$value->openid,'groupid'=>$groupName,'username'=>$user['nickname']);
		}
		$arr['rows'] = $result;
		return $arr;
	}
	
	/**
	 * 获取所有的用户...
	 */
	public function getUsers($openid = ''){
		$users = array();
		$path = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.ACCESS_TOKEN.'&next_openid='.$openid;
		$json = $this->getByCurl($path);
		$array = json_decode($json,true);
		if($array['errcode'] != 0){
			$this->errorMessage($array['errcode']);
		}
		foreach ($array['data']['openid'] as $value){
			$users[] = $value;
		}
		if ($array['next_openid'] != '') {
			$this->getUsers($array['next_openid']);
		}
		return $users;
	}
	
	/**
	 * 更新用户数据...
	 */
	public function updateUsers(){
		$this->setApp();
		$users = $this->getUsers();
		//获取数据库中的数据 
		$array = $this->getAllUsers();
		if(count($array)>0){
			$arr = array();
			foreach ($array as $value){
				$arr[] = $value->openid;
				if(!in_array($value->openid, $users)){
					//删除表中这条数据
					$this->dao->deleteUser($value);	
				}
			}
			foreach ($users as $value){
				if(!in_array($value, $arr)){
					//添加到表中
					$attention = new Attention();
					$attention->openid = $value;
					$attention->tag = WEIXIN_TAG;
					$this->dao->saveUser($attention);
				}
			}
		}else{
			//添加到数据库
			foreach ($users as $value){
				$attention = new Attention();
				$attention->openid = $value;
				$attention->tag = WEIXIN_TAG;
				$attention->validate();
				$this->dao->saveUser($attention);
			}
		}
		return array('statu'=>true,'msg'=>'同步微信成功');
	}
	
	/**
	 * 获取数据库中的关注者...
	 */
	public function getAllUsers($where){
		$users = $this->dao->getAllUsers($where);
		return $users;
	}
	
	/**
	 * 获取所有的分组...
	 */
	public function groupAll(){
		$this->setApp();
		$url = 'http://www.boyicms.com/interface/wechat/WechatInterface.php?action=get_authrizer_access_token&appid=wxf6fc0f1888cec14e';
		$url .= '&' . $this->formatApiTokenQry('get_authrizer_access_token');
		$dd = $this->curlData($url, $data);
		$path = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.ACCESS_TOKEN;
		$json = $this->getByCurl($path);
		$data = json_decode($json,true);
		if ($data['errcode'] != 0){
			$this->errorMessage($data['errcode']);
		}
		return $data['groups'];
	}
	
	/**
	 * 修改分组...
	 */
	public function updateGroup(){
		//print_r($_REQUEST);exit;
		$this->setApp();
		if(count($_REQUEST['data']['data'])<1){
			throw new Exception('请选择要改变分组的用户');
		}
		$path = 'https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token='.ACCESS_TOKEN;
		foreach($_REQUEST['data']['data'] as $value){
			if ($value != 'undefined'){
				$data = '{"openid":"'.$value.'","to_groupid":'.$_REQUEST['data']['groupid'].'}';
				$info = $this->curlData($path, $data);
				$array = json_decode($info,true);
				if($array['errcode'] != 0){
					$this->errorMessage($array['errcode']);
				}
			}
		}
		return true;
	}
	
	/**
	 * 修改备注...
	 */
	public function updateRemark(){
		$this->setApp();
		if ($_REQUEST['data']['remark'] == ''){
			throw new Exception('请输入备注名');
		}
		$path = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token='.ACCESS_TOKEN;
		$data = '{"openid":"'.$_REQUEST['data']['openid'].'","remark":"'.$_REQUEST['data']['remark'].'"}';
		$info = $this->curlData($path,$data);
		$obj = json_decode($info);
		if ($obj->errcode == 0){
			return true;
		}else{
			$this->errorMessage($obj->errcode);
		}
	}
	
	/**
	 * 设置按钮...
	 */
	public function setMenu(){
		$this->setApp();
		$this->validateMenu();
		$path = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.ACCESS_TOKEN;
		$parent = array();
		if (isset($_REQUEST['parentOne']['name']) && $_REQUEST['parentOne']['name'] != ''){
			$parent['parentOne'] = $_REQUEST['parentOne'];
		}
		if (isset($_REQUEST['parentTwo']['name']) && $_REQUEST['parentTwo']['name'] != '') {
			$parent['parentTwo'] = $_REQUEST['parentTwo'];
		}
		if (isset($_REQUEST['parentThree']['name']) && $_REQUEST['parentThree']['name'] != '') {
			$parent['parentThree'] = $_REQUEST['parentThree'];
		}
		if (count($parent) < 1){
			$arr = array();
			$arr['statu'] = false;
			$arr['msg'] = '请至少填写一个主菜级菜单名称';
			return $arr;
			exit;
		}
		$data = '{"button":[';
		foreach ($parent as $key=>$value){
			$str = '';
			if ($value['type'] == ''){
				$str = '{"name":"'.$value['name'].'","sub_button":[';
				$tag = $key.'Son';
				foreach ($_REQUEST[$tag] as $val){
					if ($val['name'] != ''){
						if ($val['type'] == 'view_limited'){
						    $str .= '{"type":"'.$val['type'].'","name":"'.$val['name'].'","media_id":"'.$val['key'].'"},';
						}else if($val['type'] == 'view'|| $val['type'] == 'wechat' || $val['type'] == 'weiService'|| $val['type'] == 'topicWeb'|| $val['type'] == 'weiVote'){
							$str .= '{"type":"view","name":"'.$val['name'].'","url":"'.$val['url'].'"},';
						}else{
						    $str .= '{"type":"'.$val['type'].'","name":"'.$val['name'].'","key":"'.$val['key'].'"},';
						}
					}
				}
				$num = strrpos($str, ',');
				$str = substr($str, 0,$num);
				$str .= ']},';
			}else if($value['type'] == 'view'|| $value['type'] == 'wechat' || $value['type'] == 'weiService'|| $value['type'] == 'topicWeb'|| $val['type'] == 'weiVote'){
				$str = '{"name":"'.$value['name'].'","type":"view","url":"'.$value['url'].'"},';
			}else if($value['type'] == 'view_limited'){
				$str = '{"name":"'.$value['name'].'","type":"'.$value['type'].'","media_id":"'.$value['key'].'"},';
			}else{
				$str = '{"name":"'.$value['name'].'","type":"'.$value['type'].'","key":"'.$value['key'].'"},';
			}
			$data .= $str;
		}
		$data .= ']}';
		if ($appid = $this->checkIsAuthorizer()) {
		    //从第三方平台取数据
		    $post = array('data'=>$data);
		    $array = $this->getRemoteData($appid, 'setMenu', $post);
		} else {
		    $info = $this->curlData($path, $data);
		    $array = json_decode($info,true);
		}
		$arr = array();
		if ($array['errcode'] == 0){
			//统计菜单/初始化菜单/修改菜单
				$clickMenu = array();
				$parentOneSon = $_REQUEST['parentOneSon'];
				$parentTwoSon = $_REQUEST['parentTwoSon'];
				$parentThreeSon = $_REQUEST['parentThreeSon'];
				foreach( $parentTwoSon as $v){  
						array_push($parentOneSon, $v);
						unset($v);
				}
				foreach( $parentThreeSon as $v){  
						array_push($parentOneSon, $v);
						unset($v);
				}
				if(!$appid){
				//同步本地_clickCount.json
					foreach( $parentOneSon as $k=>$v){  
							$clickMenu[$k]['ClickName'] =  $v['name'];        //名称
							$clickMenu[$k]['ClickUrl'] =  $v['url'];	     //地址
							$clickMenu[$k]['ClickNum'] =  0;			    //点击量
							$clickMenu[$k]['CreateTime'] =  time();			//更新时间
							unset( $v );
					}

						$clickMenu = array_values($clickMenu);
						$url = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_clickCount.json';				
					if(file_exists($url)){
						$clickContent = json_decode(file_get_contents($url), true);
						$clickEdit = array();
						foreach($clickContent as $key => $click){
							$clickEdit[] =  $click;
							if($click['ClickUrl'] != $clickMenu[$key]['ClickUrl'] || $click['ClickName'] != $clickMenu[$key]['ClickName']){
								$clickEdit[$key]['ClickName'] =  $clickMenu[$key]['ClickName'];
								$clickEdit[$key]['ClickUrl'] = $clickMenu[$key]['ClickUrl'];
								$clickEdit[$key]['ClickNum'] = 0;
								$clickEdit[$key]['CreateTime'] = time();
							}
							unset($click);
						}
						file_put_contents($url, json_encode($clickEdit));
					}else{
						file_put_contents($url, json_encode($clickMenu));				
					}
				}else{
					//保存菜单名称和地址
						$clickMenu = array();
						foreach($parentOneSon as $menu){
							if($menu['type']=='view'){
								$clickMenu[$menu['name']] = $menu['url'];
							}
							foreach($menu['sub_button'] as $me){
								if($me['type']=='view'){
									$clickMenu[$me['name']] = $me['url'];
								}
							}
						}
					$menuurl = ABSPATH.'/weixindb/'.$appid.'_clickCount.json';
					file_put_contents($menuurl, json_encode($clickMenu));				
				}
			$arr['statu'] = true;
			$arr['msg'] = '设置自定义菜单成功!';
		}else{
			$this->errorMessage($array['errcode']);
		}
		return $arr;
	}
	
	/**
	 * 验证按钮...
	 */
	public function validateMenu(){
		$len1 = $this->utf8_strlen($_REQUEST['parentOne']['name']);
		$len2 = $this->utf8_strlen($_REQUEST['parentTwo']['name']);
		$len3 = $this->utf8_strlen($_REQUEST['parentThree']['name']);
		if($len1>4 || $len2>4 || $len3>4){
			throw new Exception('顶级菜单不能超过4个字');
		}
		if($_REQUEST['parentOne']['name'] != ''){
			if ($_REQUEST['parentOne']['type'] != ''){
				$type1 = $_REQUEST['parentOne']['type'];
				if($type1 == 'view' || $type1 == 'wechat' || $type1 == 'weiService'|| $type1 == 'topicWeb' || $type1 == 'weiVote'){
					if ($_REQUEST['parentOne']['url'] == ''){
						throw new Exception('<'.$_REQUEST['parentOne']['name'].'>的url不能为空');
					}else{
						$re = $this->isUrl($_REQUEST['parentOne']['url']);
						if(!$re){
							throw new Exception('<'.$_REQUEST['parentOne']['name'].'>的url格式错误');
						}
					}
				}else{
					if ($_REQUEST['parentOne']['key'] == ''){
						throw new Exception('<'.$_REQUEST['parentOne']['name'].'>的key值不能为空');
					}
				}
			}else{
				$i = 0;
				foreach ($_REQUEST['parentOneSon'] as $value){
					if ($value['name'] != ''){
						$i++;
					}
				}
				if($i == 0){
					throw new Exception('请填写<'.$_REQUEST['parentOne']['name'].'>下的子菜单');
				}
			}
		}
		if($_REQUEST['parentTwo']['name'] != ''){
			if ($_REQUEST['parentTwo']['type'] != ''){
				$type2 = $_REQUEST['parentTwo']['type'];
				if($type2 == 'view' || $type2 == 'wechat' || $type2 == 'weiService'|| $type2 == 'topicWeb'|| $type2 == 'weiVote'){
					if ($_REQUEST['parentTwo']['url'] == ''){
						throw new Exception('<'.$_REQUEST['parentTwo']['name'].'>的url不能为空');
					}else{
						$re = $this->isUrl($_REQUEST['parentTwo']['url']);
						if(!$re){
							throw new Exception('<'.$_REQUEST['parentTwo']['name'].'>的url格式错误');
						}
					}
				}else{
					if ($_REQUEST['parentTwo']['key'] == ''){
						throw new Exception('<'.$_REQUEST['parentTwo']['name'].'>的key值不能为空');
					}
				}
			}else{
				$i = 0;
				foreach ($_REQUEST['parentTwoSon'] as $value){
					if ($value['name'] != ''){
						$i++;
					}
				}
				if($i == 0){
					throw new Exception('请填写<'.$_REQUEST['parentTwo']['name'].'>下的子菜单');
				}
			}
		}
		if ($_REQUEST['parentThree']['name'] != ''){
			if ($_REQUEST['parentThree']['type'] != ''){
				$type3 = $_REQUEST['parentThree']['type'];
				if($type3 == 'view' || $type3 == 'wechat' || $type3 == 'weiService'|| $type3 == 'topicWeb'|| $type3 == 'weiVote'){
					if ($_REQUEST['parentThree']['url'] == ''){
						throw new Exception('<'.$_REQUEST['parentThree']['name'].'>的url不能为空');
					}else{
						$re = $this->isUrl($_REQUEST['parentThree']['url']);
						if(!$re){
							throw new Exception('<'.$_REQUEST['parentThree']['name'].'>的url格式错误');
						}
					}
				}else{
					if ($_REQUEST['parentThree']['key'] == ''){
						throw new Exception('<'.$_REQUEST['parentThree']['name'].'>的key值不能为空');
					}
				}
			}else{
				$i = 0;
				foreach ($_REQUEST['parentThreeSon'] as $value){
					if ($value['name'] != ''){
						$i++;
					}
				}
				if($i == 0){
					throw new Exception('请填写<'.$_REQUEST['parentThree']['name'].'>下的子菜单');
				}
			}
		}
		foreach ($_REQUEST['parentOneSon'] as $value){
			if ($value['name'] != ''){
				if($this->utf8_strlen($value['name']) > 7){
					throw new Exception('<'.$value['name'].'>的字数不能超过7个字');
				}
				if ($value['type'] == ''){
					throw new Exception('请选择<'.$value['name'].'>的事件类型');
				}else{
					if ($value['type'] == 'view' || $value['type'] == 'wechat' || $value['type'] == 'weiService'|| $value['type'] == 'topicWeb'|| $value['type'] == 'weiVote'){
						if($value['url'] == ''){
							throw new Exception('<'.$value['name'].'>的url不能为空');
						}else{
							$re = $this->isUrl($value['url']);
							if(!$re){
								throw new Exception('<'.$value['name'].'>的url格式错误');
							}
						}
					}else{
						if ($value['key'] == ''){
							throw new Exception('<'.$value['name'].'>的key值不能为空');
						}
					}
				}
			}
		}
		foreach ($_REQUEST['parentTwoSon'] as $value){
			if ($value['name'] != ''){
				if($this->utf8_strlen($value['name']) > 7){
					throw new Exception('<'.$value['name'].'>的字数不能超过7个字');
				}
				if ($value['type'] == ''){
					throw new Exception('请选择<'.$value['name'].'>的事件类型');
				}else{
					if ($value['type'] == 'view' || $value['type'] == 'wechat' || $value['type'] == 'weiService'|| $value['type'] == 'topicWeb'|| $value['type'] == 'weiVote'){
						if($value['url'] == ''){
							throw new Exception('<'.$value['name'].'>的url不能为空');
						}else{
							$re = $this->isUrl($value['url']);
							if(!$re){
								throw new Exception('<'.$value['name'].'>的url格式错误');
							}
						}
					}else{
						if ($value['key'] == ''){
							throw new Exception('<'.$value['name'].'>的key值不能为空');
						}
					}
				}
			}
		}
		foreach ($_REQUEST['parentThreeSon'] as $value){
			if ($value['name'] != ''){
				if($this->utf8_strlen($value['name']) > 7){
					throw new Exception('<'.$value['name'].'>的字数不能超过7个字');
				}
				if ($value['type'] == ''){
					throw new Exception('请选择<'.$value['name'].'>的事件类型');
				}else{
					if ($value['type'] == 'view' || $value['type'] == 'wechat' || $value['type'] == 'weiService'|| $value['type'] == 'topicWeb'|| $value['type'] == 'weiVote'){
						if($value['url'] == ''){
							throw new Exception('<'.$value['name'].'>的url不能为空');
						}else{
							$re = $this->isUrl($value['url']);
							if(!$re){
								throw new Exception('<'.$value['name'].'>的url格式错误');
							}
						}
					}else{
						if ($value['key'] == ''){
							throw new Exception('<'.$value['name'].'>的key值不能为空');
						}
					}
				}
			}
		}
	}
	/**
	 * 获得所有自定义菜单...
	 */
	public function menuAll(){
	    if ($appid = $this->checkIsAuthorizer()) {
	    	//从第三方平台取数据
	    	$data = $this->getRemoteData($appid, 'menuAll');
			//保存菜单名称和地址
			$url = ABSPATH.'/weixindb/'.$appid.'_clickCount.json';
			if(!file_exists($url)){
				$clickMenu = array();
				foreach($data['menu']['button'] as $menu){
					if($menu['type']=='view'){
						$clickMenu[$menu['name']] = $menu['url'];
					}
					foreach($menu['sub_button'] as $me){
						if($me['type']=='view'){
							$clickMenu[$me['name']] = $me['url'];
						}
					}
				}
				file_put_contents($url, json_encode($clickMenu));
			}
			
	    } else {
	        $this->setApp();
			//通过API调用设置的菜单
	        $path = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.ACCESS_TOKEN;
	        $json = $this->getByCurl($path);
	        $data = json_decode($json,true);
			if(isset($data['errcode']) && $data['errcode']==46003){
				//(同步)在公众平台官网通过网站功能发布的菜单
				$path = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token='.ACCESS_TOKEN;
				$json = $this->getByCurl($path);
				$info = json_decode($json,true);
				if($info['errcode'] != 0){
					$this->errorMessage($info['errcode']);
				}
				$array = array();
				foreach($info['selfmenu_info']['button'] as $key =>$vo){
					$array[$key]['name'] = $vo['name'];
					foreach($vo['sub_button']['list'] as $k=>$v){
						$array[$key]['sub_button'][$k]['type'] = $v['type'];
						$array[$key]['sub_button'][$k]['name'] = $v['name'];
						$array[$key]['sub_button'][$k]['url'] = $v['url'];
						unset($v);
						unset($vo);
					}
				}
				return $array;				
			}
	    }
		if(isset($data['errcode']) && $data['errcode'] != 0){
			$this->errorMessage($data['errcode']);
		}
		return $data['menu']['button'];
	}
	
	/**
	 * 删除所有菜单...
	 */
	public function deleteMenu(){
	    if ($appid = $this->checkIsAuthorizer()) {
	        //从第三方平台删除数据
	        $array = $this->getRemoteData($appid, 'delMenu');
	    } else {
	        $this->setApp();
    		$result = array();
    		$path = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.ACCESS_TOKEN;
    		$json = $this->getByCurl($path);
    		$array = json_decode($json,true);
	    }
		
		if($array['errcode'] == 0){
			$result['statu'] = true;
			$result['msg'] = '删除成功';
		}else{
			$this->errorMessage($array['errcode']);
		}
		return $result;
	}
	
	/**
	 * 设置关注时自动回复...
	 */
	public function setSub(){
		$this->setApp();
		$array = array();
		if ($_REQUEST['msgtype'] == 'text') {
			if ($_REQUEST['content'] == ''){
				throw new Exception('设置的关注时自动回复内容不能为空');
			}
			$data = $this->responseText(strip_tags(trim($_REQUEST['content'])));
		}else if($_REQUEST['msgtype'] == 'news'){
			if ($_REQUEST['ArticleCount'] == ''){
				$array['statu'] = false;
				$array['msg'] = '请选择要发送图文消息的总数';
				return $array;
			}
			foreach ($_REQUEST['Apicurl'] as $value){
			    if ($value) {
			        $re = $this->isUrl($value);
			        if(!$re){
			            throw new Exception('picurl格式错误');
			        }
			    }
			}
			foreach ($_REQUEST['Aurl'] as $value){
			    if ($value) {
			        $re = $this->isUrl($value);
			        if(!$re){
			            throw new Exception('url格式错误');
			        }
			    }
			}
			$data = $this->responseNews($_REQUEST);
		}else{
			if($_REQUEST['msgtype'] == 'music'){
				if($_REQUEST['musicurl'] != ''){
					if(!$this->isUrl($_REQUEST['musicurl'])){
						throw new Exception('音乐链接格式错误');
					}
				}
				if($_REQUEST['hqmusicurl'] != ''){
					if(!$this->isUrl($_REQUEST['hqmusicurl'])){
						throw new Exception('高清音乐链接格式错误');
					}
				}
			}
			$data = $this->responseMedia($_REQUEST);
		}
		
		//同步数据到总控第三方平台
		if ($appid = $this->checkIsAuthorizer()) {
		    return json_decode($this->syncReplyToRemote($appid, $_REQUEST, 2), true);
		}else{
			file_put_contents('../weixindb/'.WEIXIN_TAG.'_subcontent.json', json_encode($_REQUEST));
			$re = file_put_contents('../weixindb/'.WEIXIN_TAG.'_sub.json', json_encode($data));
			if($re>0){
				$array['statu'] = true;
				$array['msg'] = '设置关注自动回复成功!';
			}else{
				$array['statu'] = false;
				$array['msg'] = '设置关注自动回复失败!';
			}
			return $array;
		}
	}
	
	/**
	 * 删除关注时自动回复...
	 */
	public function deleteSub(){
	    if ($appid = $this->checkIsAuthorizer()) {
	    	return $this->getRemoteData($appid, 'deleteReply', array('type'=>2));
	    }
	    
		$this->setApp();
		@unlink('../weixindb/'.WEIXIN_TAG.'_sub.json');
		@unlink('../weixindb/'.WEIXIN_TAG.'_subcontent.json');
		return array('statu'=>true,'msg'=>'删除成功！');
	}
	
	/**
	 * 判断关注时自动回复是否被设置...
	 */
	public function isSetSub(){
	    if ($appid = $this->checkIsAuthorizer()) {
	        return $this->getRemoteData($appid, 'getKeysword', array('type'=>2));
	    }
		$this->setApp();
		$data = array();
		$filename = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_subcontent.json';
		if (file_exists($filename)){
			$json = file_get_contents($filename);
			$data = json_decode($json,true);
			return array('statu'=>true,'data'=>$data);
		}
		return array('statu'=>false,'data'=>$data);
	}
	
	
	/**
	 * 保存关键词到微信...
	 */
	public function saveKeys(){
		$array = array();
		unset($_REQUEST['controller'],$_REQUEST['method']);
		if($_REQUEST['keyword'] == ''){
			throw new Exception('请输入关键词');
		}
		switch ($_REQUEST['msgtype']){
			case '':
				throw new Exception('请输入要回复的信息类型');
				break;
			case 'news':
				foreach ($_REQUEST['Apicurl'] as $value){
					if($value != ''){
						if(!$this->isUrl($value)){
							throw new Exception('错误的图片链接请修正');
						}
					}
				}
				foreach ($_REQUEST['Aurl'] as $value){
					if($value != ''){
						if(!$this->isUrl($value)){
							throw new Exception('错误的点击链接请修正');
						}
					}
				}
				$array['keyword'] = trim($_REQUEST['keyword']);
				$array['reply'] = $this->responseNews($_REQUEST);
				/*$data[] = $array;
				$arr[] = $_REQUEST;
				file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywordsdata.json', json_encode($arr));
				$re = file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json', json_encode($data));*/
				break;	
			case 'text':
				if($_REQUEST['content'] == ''){
					throw new Exception('回复的内容不能为空');
				}
				$array['keyword'] = trim($_REQUEST['keyword']);
				$array['reply'] = $this->responseText(strip_tags(trim($_REQUEST['content'])));

				/*$data[] = $array;
				$arr[] = $_REQUEST;
				file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywordsdata.json', json_encode($arr));
				$re = file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json', json_encode($data));*/
				break;
			case 'music':
				if($_REQUEST['media_id'] == ''){
					throw new Exception('请选择要回复的缩略图');
				}
				if($_REQUEST['musicurl'] != ''){
					$re = $this->isUrl($_REQUEST['musicurl']);
					if(!$re){
						throw new Exception('音乐连接格式错误');
					}
				}
				if($_REQUEST['hqmusicurl'] != ''){
					$re = $this->isUrl($_REQUEST['hqmusicurl']);
					if(!$re){
						throw new Exception('高清音乐连接格式错误');
					}
				}
				$array['keyword'] = trim($_REQUEST['keyword']);
				$array['reply'] = $this->responseMedia($_REQUEST);
				/*$data[] = $array;
				$arr[] = $_REQUEST;
				file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywordsdata.json', json_encode($arr));
				$re = file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json', json_encode($data));*/
				break;
			default:
				if($_REQUEST['media_id'] == ''){
					throw new Exception('请选择要回复的素材');
				}
				$array['keyword'] = trim($_REQUEST['keyword']);	
				$array['reply'] = $this->responseMedia($_REQUEST);
				/*$data[] = $array;
				$arr[] = $_REQUEST;
				file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywordsdata.json', json_encode($arr));
				$re = file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json', json_encode($data));*/
				break;					
		}
		//判断关键词是否已经存在
		if ($appid = $this->checkIsAuthorizer()) {
			$result = $this->getRemoteData($appid, 'getKeysword', array('type'=>1));
			$data = array_values($result['data']);
		    foreach ($data as $key=>$value){
		        if ($value['keyword'] == $_REQUEST['keyword']){
		            throw new Exception('关键词已存在!');
		        }
		    }
		}
		$this->setApp();
		$file = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json';
		$filename = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywordsdata.json';
		$flag = false;
		if(file_exists($file)){
		    $data = json_decode(file_get_contents($file),true);
		    //判断关键词存不存在
		    foreach ($data as $key=>$value){
		        if ($value['keyword'] == $_REQUEST['keyword']){
		            if($_REQUEST['keystatu'] == ''){
		                throw new Exception('关键词已存在!');
		            }
		            $flag = true;
		            $num = $key;
		        }
		    }
		}else{
		    $data = array();
		}
		
		if ($appid = $this->checkIsAuthorizer()) {
			//不管是否授权给第三方，数据都保存过去，为了后期的绑定过渡
			return json_decode($this->syncReplyToRemote($appid, $_REQUEST), true);
		}
		if(file_exists($filename)){
		    $arr = json_decode(file_get_contents($filename),true);
		}else{
		    $arr = array();
		}
		if($flag){
		    $data[$num] = $array;
		    $arr[$num] = $_REQUEST;
		}else{
		    $data[] = $array;
		    $arr[] = $_REQUEST;
		}
		
		file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywordsdata.json', json_encode($arr));
		$re = file_put_contents(ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json', json_encode($data));
		if($re){
			$array['statu'] = true;
			$array['msg'] = '保存成功 ！';
		}else{
			$array['statu'] = false;
			$array['msg'] = '保存失败 ！';
		}
		return $array;
	}
	
	/**
	 * 判断是否设置了关键词...
	 */
	public function issetKeysword(){
	    if ($appid = $this->checkIsAuthorizer()) {
	    	$result = $this->getRemoteData($appid, 'getKeysword', array('type'=>1));
	    	$data = array_values($result['data']);
	    	return array('statu'=>$result['statu'],'rows'=>$data, 'ttl'=>count($data));
	    }
		$this->setApp();
		$data = array();
		$filename = '../weixindb/'.WEIXIN_TAG.'_keywordsdata.json';
		if(file_exists($filename)){
			$json = file_get_contents($filename);
			$data = json_decode($json,true);
		}
		return array('statu'=>true,'rows'=>$data, 'ttl'=>count($data));
	}
	
	/** 查找已经设置的关键词
	 * 
	 *  */
	public function getKeyByName($keyname){
	    if ($appid = $this->checkIsAuthorizer()) {
	    	return $result = $this->getRemoteData($appid, 'getKeyByName', array('keyword'=>$keyname));
	    }
		$this->setApp();
	    $filename = '../weixindb/'.WEIXIN_TAG.'_keywordsdata.json';
	    if(file_exists($filename)){
	        $json = file_get_contents($filename);
	        $data = json_decode($json,true);
			foreach($data as $k=>$v){
				if($v['keyword'] == $keyname){
					return array('statu'=>true,'data'=>$v);
				}
			}
	    }    
	}	
	
	
	
	/**
	 * 用户发送来的数据自动保存到数据库...
	 */
	public function saveMsg($array){
		$this->setApp();
		//unset($_REQUEST['controller'],$_REQUEST['method']);
		//$array = $_REQUEST;
		//if (isset($array) && is_array($array['Label'])){
		if (isset($array['Label'])){
			$array['Label'] = '纬度:'.$array['Location_X'].',经度:'.$array['Location_Y'];
		}
		//根据msgid进行查询看看信息是否存在
		$re = $this->getMsgByMid($array['MsgId'],$array['FromUserName']);
		if($re->id == ''){
			//添加到数据库
			unset($array['ToUserName'],$array['Recognition'],$array['Location_X'],$array['Location_Y'],$array['Scale']);
			$re = $this->addToMsg($array);
		}
		if($re){
			$arr = array();
			$arr['statu'] = true;
			return $arr;
		}
	}
	
	/**
	 * 获取关注者所有消息...
	 */
	public function getListMsg(){
		$arr = array();
		//查询所有，看看时间是否超过7天的 超过7天的全部删除
		$data = $this->getAllMsg();
		foreach ($data as $value){
			$value->createtime = date('Y-m-d',$value->createtime);
			if($value->isreply == 0){
				$value->isreply = '否';
			}else{
				$value->isreply = '是';
			}
			if($value->msgtype == 'voice' || $value->msgtype == 'video'){
				if($value->msgtype == 'voice'){
					$filename = $value->msgid.'.amr';
				}else{
					$filename = $value->msgid.'.mp4';
				}
				$dir = ABSPATH.'/template_c/temporaryPic/weixin';
				if(!is_dir($dir)){
					mkdir($dir,0777);
				}
				if (!file_exists($dir.'/'.$filename)){
					$content = $this->getFile($value->path);
					$size = file_put_contents($dir.'/'.$filename, $content);
				}
				$value->filename = NETADDRESS.'/template_c/temporaryPic/weixin/'.$filename;
			}
		}
		if(count($data)>0){
			$arr['statu'] = true;
			$arr['data'] = $data;
		}else{
			$arr['statu'] = false;
			$arr['msg'] = '暂时还没有任何信息';
		}
		return $arr;
	}
	
	/**
	 * 防止获取数据超时...
	 */
	public function getFile($url){
		$opts = array('http'=>array('method'=>"GET",'timeout'=>60,));
		$context = stream_context_create($opts);
		$content =file_get_contents($url,false,$context);
		return $content;
	}
	
	/**
	 * 根据信息id获取消息...
	 */
	public function getMsgByMid($msgid,$user){
		$message = new Message();
		$message->msgid = $msgid;
		$message->fromusername = $user;
		$data = $this->dao->getMsgByMid($message);
		return $data;
	}
	
	/**
	 * 添加到信息表中...
	 */
	public function addToMsg($array){
		$this->setApp();
		$array['isreply'] = 0;
		$array['tag'] = WEIXIN_TAG;
		$message = new Message();
		foreach ($array as $key=>$value){
			$key = strtolower($key);
			$message->$key = $value;
		}
		$message->validate();
		$re = $this->dao->addToMsg($message);
		return $re;
	}
	
	public function getMedia(){
		$dir = './download/';
		if (!is_dir($dir)) {
			mkdir($dir,0777);
		}
		
	}
	
	/**
	 * 获取所有的消息...
	 */
	public function getAllMsg(){
		$this->setApp();
		$data = $this->dao->getAllMsg();
		foreach ($data as $value){
			if($value->msgtype == 'video' || $value->msgtype == 'voice'){
				$value->path = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token='.ACCESS_TOKEN.'&media_id='.$value->mediaid;
			}
			//根据openid获取关注者昵称
			$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.ACCESS_TOKEN.'&openid='.$value->fromusername.'&lang=zh_CN';
			$info = $this->getByCurl($url);
			$arr = json_decode($info,true);
			if(isset($arr['errcode']) && $arr['errcode'] != 0){
				$this->errorMessage($arr['errcode']);
			}
			$value->nikename = $arr['nickname'];
		}
		return $data;
	}
	
	public function getCountMsg(){
		$this->setApp();
		return $this->dao->getCountMsg();
	}
	
	/**
	 * 回复用户信息...
	 */
	public function replyMessage(){
		$this->setApp();
		if($_REQUEST['msgtype'] == ''){
			throw new Exception('请选择要回复信息的类型');
		}else{
			switch ($_REQUEST['msgtype']){
				case 'text':
					if ($_REQUEST['content'] == ''){
						throw new Exception('要发送的内容不能为空');
					}
					break;
				case 'image':
					if($_REQUEST['media_id'] == ''){
						throw new Exception('请选择要回复的图片');
					}
					break;
				case 'voice':
					if($_REQUEST['media_id'] == ''){
						throw new Exception('请选择要回复的语音');
					}
					break;
				case 'video':
					if($_REQUEST['media_id'] == ''){
						throw new Exception('请选择要回复的视频');
					}
					break;
				case 'music':
					if ($_REQUEST['media_id'] == ''){
						throw new Exception('请选择音乐对应的缩略图');
					}
					if ($_REQUEST['musicurl'] == ''){
						throw new Exception('音乐链接不能为空');
					}else{
						if(!$this->isUrl($_REQUEST['musicurl'])){
							throw new Exception('音乐链接格式不正确');
						}
					}
					if ($_REQUEST['hqmusicurl'] == ''){
						throw new Exception('高清音乐链接不能为空');
					}else{
						if(!$this->isUrl($_REQUEST['hqmusicurl'])){
							throw new Exception('高清音乐链接格式不正确');
						}
					}
					break;
				case 'news':
					if($_REQUEST['ArticleCount'] == ''){
						throw new Exception('请选择要发送的图文总数');
					}
					foreach ($_REQUEST['Apicurl'] as $value){
						if ($value != ''){
							if (!$this->isUrl($value)){
								throw new Exception('图文消息的图片链接格式有误');
							}
						}
					}
					foreach ($_REQUEST['Aurl'] as $value){
						if($value != ''){
							if (!$this->isUrl($value)){
								throw new Exception('图文消息的点击后的连接格式有误');
							}
						}
					}
					break;				
			}
		}
		$array = array();
		$path = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.ACCESS_TOKEN;
		switch ($_REQUEST['msgtype']){
			case 'text':
				$data = $this->replyText($_REQUEST);
				$info = $this->curlData($path, $data);
				break;
			case 'news':
				$data = $this->replyNews($_REQUEST);
				$info = $this->curlData($path,$data);
				break;
			default:
				$data = $this->replyMedia($_REQUEST);
				$info = $this->curlData($path,$data);
				break;				
		}
		$info = json_decode($info,true);
		if ($info['errcode'] == 0) {
			//修改数据表
			if(isset($_REQUEST['msgid']) && $_REQUEST['msgid'] != 0){
				$this->updateStatu($_REQUEST['openid'],$_REQUEST['msgid']);
			}
			$array['statu'] = true;
			$array['msg'] = '发送成功!';
		}else{
			$this->errorMessage($info['errcode']);
		}
		return $array;
	}
	
	/**
	 * 修改本条信息状态...
	 */
	public function updateStatu($openid,$msgid){
		$message = new Message();
		$message->fromusername = $openid;
		$message->msgid = $msgid;
		$re = $this->dao->updateStatu($message);
		return $re;
	}
	
	/**
	 * 向用户发发送文本消息...
	 */
	public function replyText($array){
		$data = '{
						"touser":"'.$array['openid'].'",
    					"msgtype":"text",
    					"text":
    					{
         					"content":"'.strip_tags($array['content']).'"
    					}
					}';
		return $data;
	}
	
	/**
	 * 向用户发发送图片消息 ...
	 */
	public function replyMedia($array){
		if($array['msgtype'] == 'music'){
			$data = '{
						"touser":"'.$array['openid'].'",
						"msgtype":"music",
						"music":
						{
      						"title":"'.$array['title'].'",
      						"description":"'.$array['description'].'",
      						"musicurl":"'.$array['musicurl'].'",
      						"hqmusicurl":"'.$array['hqmusicurl'].'",
      						"thumb_media_id":"'.$array['media_id'].'"
      					} 
    				 }';
		}else if($array['msgtype'] == 'video'){
			$data = '{
    					"touser":"'.$array['openid'].'",
    					"msgtype":"video",
    					"video":
    					{
      						"media_id":"'.$array['media_id'].'",
      						"thumb_media_id":"'.$array['thumb_media_id'].'",
      						"title":"'.$array['title'].'",
      						"description":"'.$array['description'].'"
    					}
					}';
		}else{
			$data = array();
			$data['touser'] = $array['openid'];
			$data['msgtype'] = $array['msgtype'];
			$data[$array['msgtype']] = array('media_id'=>$array['media_id']);
			$data = json_encode($data);
		}
		return $data;
	}
	
	/**
	 * 向用户发送多图文内容...
	 */
	public function replyNews($array){
		$data = '{"touser":"'.$array['openid'].'","msgtype":"news","news":{"articles": [';
		foreach ($array['Atitle'] as $key=>$value){
			$str .= '{
             			"title":"'.$value.'",
             			"description":"'.$array['Adescription'][$key].'",
             			"url":"'.$array['Aurl'][$key].'",
             			"picurl":"'.$array['Apicurl'][$key].'"
         			},';
		}
		$data .= $str .' ]}}';
		return $data;
	}
	
	/**
	 * 回复文本消息...
	 */
	public function responseText($content){
		$data = array();
		$textTpl = '<xml>
    	             <ToUserName><![CDATA[%s]]></ToUserName>
    	             <FromUserName><![CDATA[%s]]></FromUserName>
    	             <CreateTime>'.time().'</CreateTime>
    	             <MsgType><![CDATA[text]]></MsgType>
    	             <Content><![CDATA['.$content.']]></Content>
    	             <FuncFlag>0</FuncFlag>
    	            </xml>';
		$data['data'] = $textTpl;
		return $data;
	}
	
	/**
	 * 回复多媒体形式的信息...
	 */
	public function responseMedia($array){
		$data = array();
		$tag = ucfirst($array['msgtype']);
		if ($array['msgtype'] == 'music'){
			$textTpl = '<xml>
    	             	<ToUserName><![CDATA[%s]]></ToUserName>
    	             	<FromUserName><![CDATA[%s]]></FromUserName>
    	             	<CreateTime>'.time().'</CreateTime>
    	             	<MsgType><![CDATA['.$array['msgtype'].']]></MsgType>
    	             	<'.$tag.'>
    	             	<Title><![CDATA['.$array['title'].']]></Title>
						<Description><![CDATA['.$array['description'].']]></Description>
						<MusicUrl><![CDATA['.$array['musicurl'].']]></MusicUrl>
						<HQMusicUrl><![CDATA['.$array['hqmusicurl'].']]></HQMusicUrl>
					 	<ThumbMediaId><![CDATA['.$array['media_id'].']]></ThumbMediaId>
					 	</'.$tag.'>
    	            	</xml>';
		}else if($array['msgtype'] == 'video'){
			$textTpl = '<xml>
    	             	<ToUserName><![CDATA[%s]]></ToUserName>
    	             	<FromUserName><![CDATA[%s]]></FromUserName>
    	             	<CreateTime>'.time().'</CreateTime>
    	             	<MsgType><![CDATA['.$array['msgtype'].']]></MsgType>
    	             	<'.$tag.'>
    	             	<MediaId><![CDATA['.$array['media_id'].']]></MediaId>
    	             	<Title><![CDATA['.$array['title'].']]></Title>
						<Description><![CDATA['.$array['description'].']]></Description>
					 	</'.$tag.'>
    	            	</xml>';
		}else{
			$textTpl = '<xml>
    	             	<ToUserName><![CDATA[%s]]></ToUserName>
    	             	<FromUserName><![CDATA[%s]]></FromUserName>
    	             	<CreateTime>'.time().'</CreateTime>
    	             	<MsgType><![CDATA['.$array['msgtype'].']]></MsgType>
    	             	<'.$tag.'>
					 	<MediaId><![CDATA['.$array['media_id'].']]></MediaId>
					 	</'.$tag.'>
    	            	</xml>';
		}
		$data['data'] = $textTpl;
		return $data;
	}
	
	/**
	 * 回复图文消息...
	 */
	public function responseNews($array){
		$data = array();
		$str = '';
		$textTpl = '<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>'.time().'</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>'.$array['ArticleCount'].'</ArticleCount>
					<Articles>';
		foreach ($array['Atitle'] as $key=>$value){
			$str .= '<item>
					 <Title><![CDATA['.$value.']]></Title> 
					 <Description><![CDATA['.$array['Adescription'][$key].']]></Description>
					 <PicUrl><![CDATA['.$array['Apicurl'][$key].']]></PicUrl>
					 <Url><![CDATA['.$array['Aurl'][$key].']]></Url>
					 </item>';
		}
		$textTpl .= $str.'</Articles></xml>';
		$data['data'] = $textTpl;
		return $data; 
	}
	

	
	/**
	 * 上传素材
	 */
	public function uploadMessage($material=null){
		$this->setApp();
		if($_REQUEST['msgtype'] == ''){
			throw new Exception('请选择要上传素材类型');
		}
		$_REQUEST['fileName'] = $_REQUEST['fileName'] ? $_REQUEST['fileName'] : $_REQUEST['pic'];
		switch ($_REQUEST['msgtype']){
			case 'image':
				if ($_REQUEST['fileName'] == ''){
					throw new Exception('请选择要上传的图片');
				}
				break;
			case 'voice':
				if($_REQUEST['fileName'] == ''){
					throw new Exception('请选择要上传的语音');
				}
				break;
			case 'video':
				if($_REQUEST['fileName'] == ''){
					throw new Exception('请选择要上传的视频');
				}
				break;
			case 'thumb':
				if($_REQUEST['fileName'] == ''){
					throw new Exception('请选择要上传的缩略图');
				}
				break;
			case 'mpnews':
				
				if($_REQUEST['fileName'] == ''){
					throw new Exception('请选择要上传的图片');
				}
				if($_REQUEST['title'] == ''){
					throw new Exception('请填写标题');
				}
				if($_REQUEST['content'] == ''){
					throw new Exception('请填写内容');
				}
				if($_REQUEST['content_source_url'] != ''){
					if(!$this->isUrl($_REQUEST['content_source_url'])){
						throw new Exception('点击阅读原文后跳转的url格式错误');
					}
				}
				break;				
		}
	        if(stripos($_REQUEST['fileName'],"http://")==FALSE){
				$_REQUEST['fileName'] =  ABSPATH.'/upload'.$_REQUEST['fileName'];				
			}
		//上传普通文件
		if($_REQUEST['msgtype'] != 'mpnews' && $_REQUEST['msgtype'] != 'video'){
			$info = $this->uploadSimple($_REQUEST['fileName'], $_REQUEST['msgtype']);
			$arr = json_decode($info,true);
			if (isset($arr['errcode']) && $arr['errcode'] != 0){
				$this->errorMessage($arr['errcode']);
			}
			$array['title'] = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
			$array['type'] = $_REQUEST['msgtype'];
			$array['created_at'] = isset($arr['created_at']) ? $arr['created_at'] : time();
			$fileUrl = isset($arr['url']) ? $arr['url'] : '';
			$thumb_media_id = isset($arr['thumb_media_id']) ? $arr['thumb_media_id'] : '';
		}
		//上传视频
		if ($_REQUEST['msgtype'] == 'video'){
			$info = $this->uploadSimple($_REQUEST['fileName'], $_REQUEST['msgtype']);
			$arr = json_decode($info,true);
			if (isset($arr['errcode']) && $arr['errcode'] != 0){
				$this->errorMessage($arr['errcode']);
			}
			$media_id = $arr['media_id'];
			$json = $this->uploadVideo($media_id, $_REQUEST['videoTitle'], $_REQUEST['description']);
			$array = json_decode($json,true);
			if (isset($array['errcode']) && $array['errcode'] != 0){
				$this->errorMessage($array['errcode']);
			}
			$array['video_media_id'] = $media_id;
			$fileUrl = isset($arr['url']) ? $arr['url'] : '';
		}

		
		//上传图文 
		if($_REQUEST['msgtype'] == 'mpnews'){
		    if($material == "material"){
		        $info = $this->uploadSimpleM($_REQUEST['fileName'], 'thumb');
		    }else{
		        $info = $this->uploadSimple($_REQUEST['fileName'], 'thumb');
		    }
			$arr = json_decode($info,true);
			if (isset($arr['errcode']) && $arr['errcode'] != 0){
				$this->errorMessage($arr['errcode']);
			}
			if($material == "material"){
			    $thumb_media_id = $arr['media_id'];
			    $json = $this->uploadMpnews($thumb_media_id, $_REQUEST,$material);
			    $array = json_decode($json,true);
			    $array['type'] = 'news';
			    $array['created_at'] = time();
			}else{
			    $thumb_media_id = $arr['thumb_media_id'];
			    $json = $this->uploadMpnews($thumb_media_id, $_REQUEST);
			    $array = json_decode($json,true);
			}
				
			if (isset($array['errcode']) && $array['errcode'] != 0){
				$this->errorMessage($array['errcode']);
			}
			$array['title'] = $_REQUEST['title'];
			$fileUrl = isset($arr['url']) ? $arr['url'] : '';
		}
	    if (empty($fileUrl) && isset($_REQUEST['fileName']) && !empty($_REQUEST['fileName'])) {
			$fileUrl = str_replace(ABSPATH, NETADDRESS, $_REQUEST['fileName']);
		}		
		$array['filename'] = $fileUrl;
		$array['flag'] = $_REQUEST['flag'] ? $_REQUEST['flag'] : '';
		$array['tag'] = WEIXIN_TAG ? WEIXIN_TAG : 'auth';
		$array['digest'] = stripslashes(trim($_REQUEST['digest']));		
		//使用远程地址，不取本地的
		//$fileArr = array_reverse(explode('/', $array['filename']));
		//$fileStr = NETADDRESS.'/'.$fileArr[3].'/'.$fileArr[2].'/'.$fileArr[1].'/'.$fileArr[0];
		//$array['filename'] = $fileStr;
		//添加到数据库
		if ($appid = $this->checkIsAuthorizer()) {
		    $array['thumb_media_id'] = $thumb_media_id;
		    $array['filename'] = $fileUrl;
		    $array['app_id'] = $appid;
		    $result = $this->getRemoteData($appid, 'syncMediaid', $array);
			if (isset($_REQUEST['from']) && $_REQUEST['from'] == 'send') {
				return array('statu'=>true,'thumb_media_id'=>$thumb_media_id,'filename'=>$fileUrl);
			}
		    return array('statu'=>true);
		}
		$mediaId = new MediaId();
		foreach ($array as $key=>$value){
			$mediaId->$key = $value;
		}
		$mediaId->thumb_media_id = $thumb_media_id;
		$mediaId->validate();
		$this->dao->addMediaId($mediaId);
		if (isset($_REQUEST['from']) && $_REQUEST['from'] == 'send') {
			return array('statu'=>true,'thumb_media_id'=>$thumb_media_id,'filename'=>$fileUrl);
		}else{
			return array('statu'=>true);	
		}
	}
	
	/**
	 * 修改素材
	 */
	public function updateMessage($media_id='',$id='',$thumb_media_id){
	    $old_thumb_media_id = $thumb_media_id;
		$this->setApp();
		//上传图文 
		if($_REQUEST['msgtype'] == 'mpnews'){
		
		    $info = $this->uploadSimpleM($_REQUEST['fileName'], 'thumb');	
			$arr = json_decode($info,true);	
			
			if (isset($arr['errcode']) && $arr['errcode'] != 0){
				$this->errorMessage($arr['errcode']);
			}
			if($arr['media_id']!=""){
			    $thumb_media_id = $arr['media_id'];
			}else{
			    $thumb_media_id = $thumb_media_id;
			}

			if($arr['url']!=""){
			    $fileUrl = $arr['url'];
			}else{
			    $fileUrl = $_REQUEST['fileName'];
			}
			
			$json = $this->updateMpnews($thumb_media_id, $_REQUEST,"material",$media_id);
			$array = json_decode($json,true);
			$array['type'] = 'news';
			$array['created_at'] = time();
			
				
			if (isset($array['errcode']) && $array['errcode'] != 0){
				$this->errorMessage($array['errcode']);
			}
			$array['filename'] = $fileUrl;
			$array['title'] = $_REQUEST['title'];
		}
		
		$array['flag'] = $_REQUEST['flag'];

		//保存修改到数据库	
		if ($appid = $this->checkIsAuthorizer()) {
		    $array['filename'] = $fileUrl;
		    $array['thumb_media_id'] = $thumb_media_id;
		    $array['app_id'] = $appid;
		    $array['media_id'] = $media_id;
			$this->getRemoteData($appid, 'updateMediaid', $array);
			return true;
		}
		$array['tag'] = WEIXIN_TAG;
		$mediaId = $this->dao->getMaterialByMediaid($media_id);
		foreach ($array as $k => $v) {
		    if (isset($mediaId->$k)) {
		        $mediaId->$k = $v;
		    }
		}
		$mediaId->thumb_media_id = $thumb_media_id;
		$this->dao->updateMediaId($mediaId);
		return true;		
		
		
	}	
	
	
	/**
	 * 上传多图文...
	 */
	public function uploadMpnewses(){
	    $this->setApp();
	    $array = array();
	    $data = '{"articles":[';
	    $sub_data = '';
	    
	    $title = ''; //第一个title为群发的title
	    $flag = true;
	    $index = isset($_REQUEST['index']) ? intval($_REQUEST['index']) : 0;
	    $articles = isset($_REQUEST['articles']) ? $_REQUEST['articles'] : array();
	    if (!empty($articles)) {
	        for ($i=1; $i<=$index; $i++) {
	            //现将图片上传，取出mediaID
	            $info = isset($articles['item_' . $i]) ? $articles['item_' . $i] : '';
	            if (!empty($info)) {
	                if ($flag) {
	                    $title = $info['title'];
	                    $flag = false;
	                }
	                $sub_data .= '{
                    					"thumb_media_id":"'.$info['thumb_media_id'].'",
                    					"author":"'.$info['author'].'",
		 								"title":"'.$info['title'].'",
		 								"content_source_url":"'.$info['content_source_url'].'",
		 								"content":"'.$info['content'].'",
		 								"digest":"'.$info['digest'].'",
                    					"show_cover_pic":"'.$info['show_cover_pic'].'"
	 								},';
	            }
	        }
	        
	        $sub_data = substr($sub_data, 0, -1);
	        $data .= $sub_data.']}';
	        $path = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.ACCESS_TOKEN;
	         
	        if ($appid = $this->checkIsAuthorizer()) {
	            //从第三方平台取数据
	            $array = $this->getRemoteData($appid, 'uploadnews', array('data'=>$data));
	            if (isset($array['errcode']) && $array['errcode'] != 0){
	                $this->errorMessage($array['errcode']);
	            }
	            $array['title'] = $title;
	            $result = $this->getRemoteData($appid, 'syncMediaid', $array);

	            return array('statu'=>true,'msg'=>'成功','data'=>$array);
	        } else {
	            $result = $this->curlData($path, $data);
	            $array = json_decode($result,true);
	        
	            if (isset($array['errcode']) && $array['errcode'] != 0){
	                $this->errorMessage($array['errcode']);
	            }
	            $array['title'] = $_REQUEST['title'][1];
	            $array['tag'] = WEIXIN_TAG;
	            $mediaId = new MediaId();
	            foreach ($array as $key=>$value){
	                $mediaId->$key = $value;
	            }
	            $this->dao->addMediaId($mediaId);
	            return array('statu'=>true,'msg'=>'成功','data'=>$array);
	        }
	    }
        
        return array('statu'=>false,'msg'=>'请添加2条以上的图文内容');
	}
	
	/**
	 * 上传普通的文件...
	 */
	public function uploadSimple($filename,$type){
	    if ($appid = $this->checkIsAuthorizer()) {
	        //判断是否上传过资源，来判断用户是否更新了图片
	        $data = array('filename' => $filename, 'type'=>$type);
	        $result = $this->getRemoteData($appid, 'getFileSource', $data);
	        if (!empty($result['media_id'])) {
	            return json_encode($result);
	        }         
	        //先把图片传到总控

	        $filename = $this->uploadFileToRemote($filename, $appid);
     

	        //从第三方平台取数据
	        $data['media'] = $filename;
	        $data['type'] = $type;
	        $info = $this->getRemoteData($appid, 'media_upload', $data);
			$info['filename'] = $data['filename'];		
	        $info = json_encode($info);
	    } else {
	        //判断是否上传过资源，来判断用户是否更新了图片
	        $result = $this->dao->getMaterialByFileName($filename, $type);
	        if (!empty($result['media_id'])) {
	            return json_encode($result);
	        }
	        
	        $data = array('media'=>'@'.$filename);
	        $path = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.ACCESS_TOKEN.'&type='.$type;
			$info['filename'] = $data['filename'];
    		$info = $this->curlData($path, $data);
	    }
		return $info;
	}
	/**
	 * 上传永久素材...(新增其他类型永久素材)
	 */
	public function uploadSimpleM($filename,$type){
	    if ($appid = $this->checkIsAuthorizer()) {
	        //判断是否上传过资源，来判断用户是否更新了图片
	        $data = array('filename' => $filename, 'type'=>$type);
	        $result = $this->getRemoteData($appid, 'getFileSource', $data);
	        if (!empty($result['media_id'])) {
	        	return json_encode($result);
	        }
	        
	        //先把图片传到总控
	        $filename = $this->uploadFileToRemote($filename, $appid);
	        
	        //再从总控平台提交数据
	        $data['media'] = $filename;
	        $data['type'] = $type;
	        $info = $this->getRemoteData($appid, 'add_material', $data);
	        $info = json_encode($info);
	    } else {
	        //判断是否上传过资源，来判断用户是否更新了图片
	        $result = $this->dao->getMaterialByFileName($filename, $type);
	        if (!empty($result['media_id'])) {
	            return json_encode($result);
	        }
	        
	        $data = array('media'=>'@'.$filename);
	        $path = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.ACCESS_TOKEN.'&type='.$type;
	        $info = $this->http_post($path, $data,true);
	    }
	    return $info;
	}
	
	/**
	 * 上传文件到远程服务器
	 * */
	public function uploadFileToRemote($filename, $appid) {
	    header('content-type:text/html;charset=utf8');
	    $url = 'http://www.boyicms.com/interface/wechat/WechatInterface.php?action=upload_material_file&appid=' . $appid;
	    $url .= '&' . $this->formatApiTokenQry('upload_material_file');
	    $data = array('media'=>'@'. $filename);
	    
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    $result = curl_exec($curl);
	    curl_close($curl);
	    $result = json_decode($result);
	    if ($result) $filename = $result['data'];
	    
	    return $result ? $result : $filename;
	}
	
	/**
	 * 上传视频文件...
	 */
	public function uploadVideo($media_id,$title,$description){
		$path = 'https://file.api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token='.ACCESS_TOKEN;
		$data = '{
  					"media_id": "'.$media_id.'",
  					"title": "'.$title.'",
  					"description": "'.$description.'"
				}';
		if ($appid = $this->checkIsAuthorizer()) {
		    //从第三方平台取数据
		    $info = $this->getRemoteData($appid, 'uploadVideo', array('data'=>$data));
		} else {
		    $info = $this->curlData($path, $data);
		}
		
		return $info;
	}
	
	/**
	 * 上传单个图文...
	 */
	public function uploadMpnews($thumb_media_id,$array,$material=null){
	    if($material == 'material'){
	        $path = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token='.ACCESS_TOKEN;
	    }else{
	        $path = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.ACCESS_TOKEN;
	    }
		$data = '{
   					"articles": [
		 							{
                       	 				"thumb_media_id":"'.$thumb_media_id.'",
                       	 				"author":"'.$array['author'].'",
			 							"title":"'.$array['title'].'",
			 							"content_source_url":"'.$array['content_source_url'].'",
			 							"content":"'.$array['content'].'",
			 							"digest":"'.$array['digest'].'",
                        				"show_cover_pic":"'.$array['show_cover_pic'].'"
		 							},
   								]
				 }';
		
		if ($appid = $this->checkIsAuthorizer()) {
		    //从第三方平台取数据
		    $action = ($material == 'material') ? 'add_news' : 'uploadnews';
		    $info = $this->getRemoteData($appid, $action, array('data'=>$data));
		    $info = json_encode($info);
		} else {
		    $info = $this->curlData($path, $data);
		}
		return $info;
	}
	
	/**
	 * 更新单个图文...
	 */
	public function updateMpnews($thumb_media_id,$array,$material=null,$mediaId){
	    $path = 'https://api.weixin.qq.com/cgi-bin/material/update_news?access_token='.ACCESS_TOKEN;		
		$data = '{  "media_id":"'.$mediaId.'",
					"index":0,
   					"articles": {
										"title":"'.$array['title'].'",
                       	 				"thumb_media_id":"'.$thumb_media_id.'",
                       	 				"author":"'.$array['author'].'",
			 							"digest":"'.$array['digest'].'",
										"show_cover_pic":"'.$array['show_cover_pic'].'",
										"content":"'.$array['content'].'",
			 							"content_source_url":"'.$array['content_source_url'].'" 								
		 						}
   								
				 }';
		if ($appid = $this->checkIsAuthorizer()) {
		    
		    //从第三方平台取数据
		    $info = $this->getRemoteData($appid, 'update_news', array('data'=>$data));
		    return json_encode($info);
		}
		$info = $this->curlData($path, $data);
		return $info;
	}
		
	
	
	/**
	 * 根据类型获取表中所有永久素材...
	 */
	public function getByType(){
	    if ($appid = $this->checkIsAuthorizer()) {
	        $type = $_REQUEST['type'] ? $_REQUEST['type'] : 'news';
	        $result = $this->getRemoteData($appid, 'getAllMaterial', array('type'=>$type));
	    } else {
	        $this->setApp();
	        $url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=' . ACCESS_TOKEN;
	        $data = array(
	            'type' => $_REQUEST['type'],
	            'offset' => 0,
	            'count' => 20,
	        );
	        $array = $this->http_post($url, json_encode($data));
	        $result = json_decode($array,true);
	    }
		if (isset($result['errcode']) && $result['errcode'] != 0 ){
			return $this->errorMessage($result['errcode'], true);			
		}
			$data = array();
			$i = 0;
			if(count($result['item'])>0){
				foreach ($result['item'] as $obj) {
					foreach ($obj['content']['news_item'] as $value) {			
						$data[$i]['media_id'] = $obj['media_id'];
						$data[$i]['update_time'] = date("Y-m-d H:i:s", $obj['update_time']);
						$data[$i]['filename'] = $value['thumb_url'];
						$data[$i]['thumb_url'] = $value['thumb_url'];
						$data[$i]['thumb_media_id'] = $value['thumb_media_id'];
						$data[$i]['title'] = $value['title'];
						$data[$i]['digest'] = $value['digest'];
						$i++;
						unset($value);
					}
					unset($obj);
				}
			}else{
				$data = array();				
			}
/* 			$data = array();
			$i = 0;
			$result = $this->dao->getByType($_REQUEST['type']);
			if(count($result)>0){
				foreach($result as $vo){				
					$data[$i]['media_id'] = $vo->media_id;
					$data[$i]['filename'] = $vo->filename;
					$data[$i]['thumb_url'] = $vo->filename;
					$data[$i]['thumb_media_id'] = $value['thumb_media_id'];
					$data[$i]['title'] = $vo->title;
					$data[$i]['digest'] = $vo->digest;
					$data[$i]['update_time'] = date("Y-m-d H:i:s", $vo->created_at);
					$i++;
					unset($vo);
				}
			}else{
				$data = array();				
			} */
		return $data;
	}
	
	/**
	 * 根据thumb_meida_id获取显示图片
	 * */
	public function getShowPic() {
	    $thumb_media_id = isset($_REQUEST['thumb_media_id']) ? $_REQUEST['thumb_media_id'] : '';
	    if ($appid = $this->checkIsAuthorizer()) {
	        $filename = $this->getRemoteData($appid, 'getShowPic', array('thumb_media_id'=>$thumb_media_id));
	    }  else {
            $material = $this->dao->getMaterialByMid($thumb_media_id);
            $filename = $material->filename;
		}
		return $filename;
	}
	
	/**
	 * 批量删除永久素材...
	 */
	public function delMessageById($ids){
	    if ($appid = $this->checkIsAuthorizer()) {
	    	//已授权第三方平台
	        $data = array('media_id' => implode(',', $ids));
	    	$result = $this->getRemoteData($appid, 'delMaterial', $data);
	    	if ($result['errcode'] == 0) {
	    	    return array('statu'=>true,'msg'=>'删除成功');
	    	}
	    }
	    
	    //本地人工绑定数据
	    $ids = $this->getRealIdByMediaid($ids);
	    Entity::isIds($ids);
	    $re = $this->dao->delMessageById($ids);
	    if($re){
	        return array('statu'=>true,'msg'=>'删除成功');
	    }
	    
	    //删除永久素材
	}
	
	/**
	 * 通过media_id获取本地id
	 * */
	protected function getRealIdByMediaid($ids) {
		$data = array();
		foreach ($ids as $mid){
		    $mediaId = $this->dao->getMaterialByMediaid($mid);
		    $data[] = $mediaId->id;
		}
		return $data;
	}
	
	/**
	 * 删除永久素材...
	 */
	public function delMaterialById($id){
	    if ($appid = $this->checkIsAuthorizer()) {
	        $data = array('media_id' => $id);
	    	$result = $this->getRemoteData($appid, 'delMaterial', $data);
	    	if ($result['errcode'] == 0) {
	    	    return array('statu'=>true,'msg'=>'删除素材成功');
	    	}
	    } else {
	        $this->setApp();
	        $data = array('media_id' => $id);
	        $path = 'https://api.weixin.qq.com/cgi-bin/material/del_material?access_token='.ACCESS_TOKEN;
	        $info = json_decode($this->http_post($path, json_encode($data)),true);
	        if(isset($info['errcode']) && $info['errcode'] != 0){
	            $this->errorMessage($result['errcode']);
	        }
	        return array('statu'=>true,'msg'=>'删除素材成功');
	        $ids = $this->getRealIdByMediaid($ids);
	        $re = $this->dao->delMessageById($ids);
	        $result = json_decode($info,true);
	        if($re){
	              return array('statu'=>true,'msg'=>'删除素材成功');
	        }
	    }
	    return $result;
	}
	
	/**
	 * 根据media_id 获取临时素材...
	 */
	public function getMessageById($id){
	    $this->setApp();
	    $re = $this->dao->getMessageById($id);
	    $media_id = $re->media_id;
	    $path = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.ACCESS_TOKEN.'&media_id='.$media_id;
	    $json = $this->http_get($path);
	    $result = json_decode($json,true);
	    if($re){
	        return array('statu'=>true,'msg'=>'获取素材成功','data'=>$re);
	    }
	}
	
	/**
	 * 根据title获取素材...
	 */
	public function getMessageByTitle($title){
	    $this->setApp();
	    $re = $this->dao->getMessageByTitle($title);
	    if($re){
	        return array('statu'=>true,'msg'=>'获取素材成功','data'=>$re);
	    }else{
			return array('statu'=>false,'msg'=>'获取素材失败');
		}

	}
	
	
	
	
	public function http_get($url){
	    $oCurl = curl_init();
	    if(stripos($url,"https://")!==FALSE){
	        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
	        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
	        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
	    }
	        curl_setopt($oCurl, CURLOPT_URL, $url);
	        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
	        $sContent = curl_exec($oCurl);
	        $aStatus = curl_getinfo($oCurl);
	        curl_close($oCurl);
	    if(intval($aStatus["http_code"])==200){
	        return $sContent;
	    }else{
	        return false;
	    }
	  }	

	    	/**
	    	 * POST 请求
	    	 * @param string $url
	    	 * @param array $param
	    	 * @param boolean $post_file 是否文件上传
	    	 * @return string content
	    	 */
	  public function http_post($url,$param,$post_file=false){
	        $oCurl = curl_init();
	        if(stripos($url,"https://")!==FALSE){
	            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
	            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
	            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
	        }
	        if (is_string($param) || $post_file) {
	            $strPOST = $param;
	        }else{
	            $aPOST = array();
	            foreach($param as $key=>$val){
	               $aPOST[] = $key."=".urlencode($val);
	            }
	            $strPOST =  join("&", $aPOST);
	         }
	            curl_setopt($oCurl, CURLOPT_URL, $url);
	            curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
	            curl_setopt($oCurl, CURLOPT_POST,true);
	            curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
	            $sContent = curl_exec($oCurl);
	            $aStatus = curl_getinfo($oCurl);
	            curl_close($oCurl);
	       if(intval($aStatus["http_code"])==200){return $sContent;
	       }else{return false;}
	    }	    
	    
	
	
	
	/** 获取永久素材总数 */
	public function getMaterialCount(){
	    if ($appid = $this->checkIsAuthorizer()) {
	        $result = $this->getRemoteData($appid, 'getMaterialCount');
	    } else {
	        $this->setApp();
    	    $path = 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token='.ACCESS_TOKEN;
    	    $json = $this->getByCurl($path);
    	    $result = json_decode($json,true);
	    }
	    return $result;
	}
	
	/** 
	 * 获取永久素材列表
	 *  */

	public function getMaterialList(){
	    if ($appid = $this->checkIsAuthorizer()) {
	        $type = "news";
	        $result = $this->getRemoteData($appid, 'getAllMaterial', array('type'=>$type));
				$data = array();
				$i = 0;
				if(count($result['item'])>0){
					foreach ($result['item'] as $obj) {
						foreach ($obj['content']['news_item'] as $key=>$value) {
							$data[$i]['media_id'] = $obj['media_id'];
							$data[$i]['index'] = $key;
							$data[$i]['content']['news_item'][0]['update_time'] = date("Y-m-d H:i:s", $obj['update_time']);
							$data[$i]['content']['news_item'][0]['filename'] = $value['thumb_url'];
							$data[$i]['content']['news_item'][0]['thumb_url'] = $value['thumb_url'];
							$data[$i]['content']['news_item'][0]['thumb_media_id'] = $value['thumb_media_id'];
							$data[$i]['content']['news_item'][0]['title'] = $value['title'];
							$data[$i]['content']['news_item'][0]['url'] = $value['url'];
							$data[$i]['content']['news_item'][0]['digest'] = $value['digest'];
							$i++;
							unset($value);
						}
						unset($obj);
					}
				}
				unset($result);
				$result['total_count'] = count($data);
				$result['item'] = $data;				
	    } else {
	        $this->setApp();
	        $path = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.ACCESS_TOKEN;
	        $json = '{"type":"news","offset":"0","count":"20"}'; //素材的类型,图片（image）、视频（video）、语音 （voice）、图文（news）
	        $result = $this->http_post($path,$json);
	        $result = json_decode($result,true);
			if($result['errcode'] != 0){
				$result = array();
				$data = array();
				$i = 0;
				$res = $this->dao->getByType('news');
				foreach($res as $vo){
					$data[$i]['media_id'] = $vo->id;
					$data[$i]['content']['news_item'][0]['title'] = $vo->title;
					$data[$i]['content']['news_item'][0]['thumb_media_id'] = $vo->thumb_media_id;
					$data[$i]['content']['news_item'][0]['digest'] = $vo->digest;
					$data[$i]['content']['news_item'][0]['url'] = $vo->filename;
					$data[$i]['content']['news_item'][0]['thumb_url'] = $vo->filename;
					$i++;
				}
				$result['total_count'] = count($data);
				$result['item'] = $data;
			}
	    }
	    return $result;
	}
	/** 
	 * 根据media_id 获取永久素材 
	 *  */
	public function getMaterialByMid($id = ''){
	    $id = $id ? $id : $_REQUEST['id'];
	    if ($appid = $this->checkIsAuthorizer()) {
	        $data = array('media_id' => $id);
	    	$result = $this->getRemoteData($appid, 'getMaterialById', $data);
	    } else {
	        $this->setApp();
	        $data = array('media_id' => $id);
	        $path = 'https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.ACCESS_TOKEN;
	        $result = $this->http_post($path,json_encode($data));
	        $result = json_decode($result,true);
	    }
	    return $result;
	}
	

	
	/**
	 * 获取所有关键词...
	 */
	public function getAllKeys(){
		$this->setApp();
		$file = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json';
		$data = array();
		$arr = array();
		if(file_exists($file)){
			$json = file_get_contents($file);
			$array = json_decode($json,true);
			if ($array){
				foreach ($array as $key => $value){
					$data[] = array('id'=>$key,'keyword'=>$value['keyword']);
				}
				$arr['data'] = $data;
				$arr['statu'] = true;
				return $arr;
			}else{
				throw new Exception('目前还没有关键词');
			}
		}else{
			throw new Exception('目前还没有关键词');
		}
	}
	
	/**
	 * 删除所有关键词...
	 */
	public function deleteAllKeys(){
	    if ($appid = $this->checkIsAuthorizer()) {
	    	return $this->getRemoteData($appid, 'deleteReply', array('type'=>1));
	    }
		$this->setApp();
		$file = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json';
		$filename = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywordsdata.json';
		$array = array();
		if(file_exists($file)){
			@unlink($file);
			@unlink($filename);
			$array['statu'] = true;
			$array['msg'] = '删除成功!';
			return $array;
		}else{
			throw new Exception('目前还没有关键词');
		}
	}
	
	/**
	 * 根据id删除关键词...
	 */
	public function deleteKeyById(){
	    if ($appid = $this->checkIsAuthorizer()) {
			if (is_array($_REQUEST['keyid'])) {
				$id = implode(',', $_REQUEST['keyid']);
			} else {
				$id = $_REQUEST['keyid'];
			}
	    	return $this->getRemoteData($appid, 'deleteKeyById', array('id'=>$id));
	    }
		$this->setApp();
		$file = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywords.json';
		$filename = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_keywordsdata.json';
		$arr = array();
		if (file_exists($file)){
			$json = file_get_contents($file);
			$array = json_decode($json,true);
			$keys = file_get_contents($filename);
			$keywords = json_decode($keys,true);
			unset($array[(int)$_REQUEST['keyid']]);
			unset($keywords[(int)$_REQUEST['keyid']]);
			$data = json_encode($array);
			$keysdata = json_encode($keywords);
			file_put_contents($filename, $keysdata);
			$re = file_put_contents($file, $data);
			if($re){
				$arr['statu'] = true;
				$arr['msg'] = '删除成功!';
			}else{
				$arr['statu'] = false;
				$arr['msg'] = '删除失败 !';
			}
			return $arr;
		}else{
			throw new Exception('目前还没有关键词');
		}
	}
	
	/**
	 * 获取统计数据...
	 */
	public function clickCount(){
		$res =array();
		if ($appid = $this->checkIsAuthorizer()) {
	        //从第三方平台取数据
			$result = $this->getRemoteData($appid, 'clickCount');
			$array = $result['data']; 
			$data = array();
				foreach ($array as $value){
					if($value['Event'] =='VIEW'){
						$name = $this->KeyByName2($appid,$value['EventKey']);
					}
					if (!$name){
						unset($value);
					}else{
						$data[$i]['url'] = $value['EventKey'];
						$data[$i]['name'] = $name;
						$i++;
					}
				}
				$b = array();
				foreach($data as $v){
					$b[] = $v['name'];
				}
				$c= array_unique($b);
				$arr = array();
				foreach($c as $k=>$v){
					$n = 0;
					foreach($data as $t){
						if($v == $t['name']){
							$n++;
							$arr['url']=$t['url'];							
						}

					}
					$arr['id'] = $k+1;
					$arr['name']=$v;
					$arr['num']=$n;
					$res[] = $arr;
				}
	    }else{ 
			$this->setApp();
			$url = ABSPATH.'/weixindb/'.WEIXIN_TAG.'_clickCount.json';
			if(file_exists($url)){
				$i= 0;
				$array = json_decode(file_get_contents($url),true);
				foreach($array as $vo){
					if($vo['ClickName']){
						$res[$i]['id'] = $i+1;
						$res[$i]['name'] = $vo['ClickName'];
						$res[$i]['url'] = $vo['ClickUrl'];
						$res[$i]['time'] = date("Y-m-d H:i:s", $vo['CreateTime']);
						$res[$i]['num'] = $vo['ClickNum'];
						$i++;
					}
					unset($vo);
				}			
			}
		}	
			return $res;
	}
	/**
	 * 根据key的值找到自定义菜单的name值...
	 */	
	public function KeyByName2($appid,$key){
		$key = trim($key, '"'); //去引号
		$key = stripcslashes($key); //去转义符号
		$url = ABSPATH.'/weixindb/'.$appid.'_clickCount.json';
		if(file_exists($url)){
			$clickContent = json_decode(file_get_contents($url), true);
			foreach($clickContent as $k=>$click){
				if($key==$click){
					return $k;
				}
			}
		}else{
			return null;
		}
	}
	/**
	 * 根据key的值找到自定义菜单的name值...
	 */
	public function KeyByName($key){
		$menus = $this->menuAll();
		$key = trim($key, '"'); //去引号
		$key = stripcslashes($key); //去转义符号
		foreach ($menus as $menu){
			if (count($menu['sub_button'])>0){
				foreach ($menu['sub_button'] as $value){
					if (isset($value['key']) && $value['key'] != ''){
						if ($key == $value['key']){
							$name = $value['name'];
						}
					}
					if (isset($value['url']) && $value['url'] != ''){
						if ($key == $value['url']){
							$name = $value['name'];
						}
					}
				}
			}else{
				if(isset($menu['key']) && $menu['key'] != ''){
					if ($key == $menu['key']){
						$name = $menu['name'];
					}
				}
				if(isset($menu['url']) && $menu['url'] != ''){
					if ($key == $menu['url']){
						$name = $menu['name'];
					}
				}
				if(isset($menu['media_id']) && $menu['media_id'] != ''){
				    $obj = $this->getMaterialByMid($menu['media_id']);
				    $url = $obj['news_item'][0]['url'];
				    $arr = split('#', $url);
				    if (isset($arr[0]) && $arr[0]) {
				        if ( strpos($key, $arr[0]) !== false ) {
				            $name = $menu['name'];
				        }
				    } else {
				        if ($key == $url){
				            $name = $menu['name'];
				        }
				    }
				}
			}
		}
		return $name == '' ? false : $name;
	}
	
	/**
	 * 验证是不是url...
	 */
	public function isUrl($url) {
        $pattern = '/^((http|https):\/\/)?' . '(([0-9]{1,3}\.){3}[0-9]{1,3}' .         // IP形式的URL
        '|' .         // 允许IP和DOMAIN（域名）
        '([0-9a-z_!~*\'()-]+\.)*' .         // 三级域验证
        '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.' .         // 二级域验证
        '[a-z]{2,6})' .         // 顶级域验证
        '(:[0-9]{1,4})?' . '((\/\?)|' . '(\/[0-9a-zA-Z_!~\*\'\(\)\.;\?:@&=\+\$,%#-\/]*)?)$/';
        return preg_match($pattern, trim($url));
    }
    
    /**
     * 判断是不是数字或英文...
     */
    public function isNumAndEnglish($subject){
    	$pattern = '/^[0-9a-zA-Z]+$/';
    	$re = preg_match_all($pattern, $subject);
    	return $re;
    }
    
    /**
     * 判断汉字字符串的长度...
     */
    public function utf8_strlen($str){
    	preg_match_all('/./us', $str, $arr);
    	return count($arr[0]);
    }
	
	/**
	 * 通过curl来传递数据...
	 * @param unknown_type $url
	 * @param unknown_type $data
	 * @return mixed
	 */
	public function curlData($url,$data){
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
		@curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$info = curl_exec($ch);
		curl_close($ch);
		return $info;
	}
	
	/**
	 * 通过curl获取数据...
	 */
	public function getByCurl($url,$timeout = 10) {
		if( function_exists('curl_init') ) {
		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		    curl_setopt($ch, CURLOPT_URL, $url );
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); //强制协议为1.0
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect: ')); 	   //头部要送出'Expect: '
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4); 	   //强制使用IPV4协议解析域名
		    $remote_result = curl_exec($ch);
		    if (curl_errno($ch)) {$remote_result = 0;}
		    curl_close($ch);
		    return $remote_result;
		}else{
			return file_get_contents( $url );
		}	
    }
    
   
	
	/**
	 * 抛出具体的错误...
	 */
	public function errorMessage($code, $info = false){
		foreach ($this->errorMsg as $key=>$value){
			if($code == $key){
				if($info ==false){
					throw new Exception($value);
				}else{
					return $value;	
				}
			}
		}
	}
	
	/**
	 * 卸载插件所需要执行的方法...
	 */
	public function uninstall(){
		//删除数据库中的表
		$sql1 = 'drop table accesstoken';
		$sql2 = 'drop table attention';
		$sql3 = 'drop table mediaid';
		$sql4 = 'drop table message';
		$sql5 = 'drop table weixin';
		$array = array($sql1,$sql2,$sql3,$sql4,$sql5);
		$this->dao->dropTable($array);
		//删除其他文件夹中的数据
		$dir1 = ABSPATH.'/weixindb';
		$this->deleteDir($dir1);
		$dir2 = ABSPATH.'/template_c/temporaryPic/weixin';
		$this->deleteDir($dir2);
		return true;
	}
	
	/**
	 * 删除目录下的文件...
	 */
	public function deleteDir($dir){
		$handle = @opendir($dir);
		while($file = @readdir($handle)){
			if($file!='.' && $file!='..'&&$file!='weixin.php'){
				$filename = $dir.'/'.$file;
				if(!is_dir($filename)){
					@unlink($filename);
				}else{
					$this->deleteDir($dir);
				}
			}
		}
		@closedir($handle);
		return true;
	}
	
	/**
	 * 保存数据到远程总控系统，不管是否授权给第三方，数据都保存过去，为了后期的绑定过渡
	 *
	 * @param $appid 公众号id
	 * @param $data 需要保存的数据
	 * @param $reply_type 回复类型：1消息回复 2关注事件回复
	 * */
	public function syncReplyToRemote($appid, $data = array(), $reply_type = '1' ){
        $url = 'http://www.boyicms.com/interface/wechat/WechatInterface.php?action=saveKeys';
        $url .= '&' . $this->formatApiTokenQry('saveKeys');
        $keyData = array(
            'appid'=> $appid,
            'keyword'=>isset($data['keyword'])?$data['keyword']:'',
            'msgtype'=>isset($data['msgtype'])?$data['msgtype']:'',
            'content'=>isset($data['content'])?$data['content']:'',
            'keystatu'=>isset($data['keystatu'])?$data['keystatu']:'',
            'reply_type' => $reply_type,
            
            //news参数
            'article_count' => isset($data['ArticleCount'])?$data['ArticleCount']:0,
            'atitle' => isset($data['Atitle'])?urldecode(json_encode($data['Atitle'])):'',
            'adescription' => isset($data['Adescription'])?urldecode(json_encode($data['Adescription'])):'',
            'apicurl' => isset($data['Apicurl'])?urldecode(json_encode($data['Apicurl'])):'',
            'aurl' => isset($data['Aurl'])?urldecode(json_encode($data['Aurl'])):'',
        );
        return $this->curlData($url, $keyData);
	}
	
	/**
	 * 判断是否是授权公众号
	 * */
	protected function checkIsAuthorizer() {
	    $filename = ABSPATH.'/weixindb/weixinApp.json';
	    if (file_exists($filename)){
	        $json = file_get_contents($filename);
	        $array = json_decode($json,true);
    	    $url = 'http://www.boyicms.com/interface/wechat/WechatInterface.php?action=check_authorizer&appid=' . $array['appid'];
    	    $url .= '&' . $this->formatApiTokenQry('check_authorizer');
    	    $result = json_decode($this->curl_get_post($url));
    	    return $result->statu ? $array['appid'] : false;
	    }
	    return true;
	}
	
	/**
	 * 访问第三方平台接口
	 * */
	protected function getRemoteData($appid, $action, $data = '', $isFile = false) {
	    $url = 'http://www.boyicms.com/interface/wechat/WechatInterface.php?action='.$action.'&appid=' . $appid;
	    $url .= '&' . $this->formatApiTokenQry($action);
	    if ($isFile) {
	    	$result = $this->http_post($url, $data);
	    } else {
	        $result = $this->curl_get_post($url, $data);
	    }
	    
	    return json_decode($result, true);
	}
	
	/**
	 * 获取服务器返回数据
	 * */
	private function curl_get_post($url, $data = '', $request = 'GET')
	{
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
	    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
	    curl_setopt($curl, CURLOPT_POST, 1);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	    curl_setopt($curl, CURLOPT_HEADER, 0);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    
	    $tmpInfo = curl_exec($curl);
	    if (curl_errno($curl)) {
	        echo 'Errno' . curl_error($curl);
	    }
	    curl_close($curl);
	    return $tmpInfo;
	}
}