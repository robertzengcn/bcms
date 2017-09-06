<?php
require_once '../InterfaceAbstract.php';
/**
 * 健康中心-在线问答接口
 *
 * 接口方式: HTTP
 * 返回格式: json
 * 调用例子：http://www.boyicms.com/interface/hma/OnlineInterface.php&part={"type":"system_suggest","user_id":"","content":""}
 * @param part  接收json数据
 *
 * 具体发送参数据与返回数据请参看数据格式文档
 */

class OnlineInterface extends InterfaceAbstract {
    // {{{ memebers
    private $__hos_name = '';
    
    private $addto = array(
        'domain'      	=> array('check'=>true,'info'=>'通信域名'),
        'question_id'	=> array('check'=>true,'info'=>'总控问题ID'),
        'sign'        	=> array('check'=>true,'info'=>'通信加密字符串'),
        'time'        	=> array('check'=>true,'info'=>'通信加密时间戳'),
    
        'content'     	=> array('check'=>true,'info'=>'追问内容'),
        'parent_id'     => array('check'=>true,'info'=>'CMS问题ID'),
    );
    
    private $distribute = array(
    
        'domain'      	=> array('check'=>true,'info'=>'通信域名'),
    
        'source_domain'	=> array('check'=>true,'info'=>'问题来源域名'),
    
        'question_id'	=> array('check'=>true,'info'=>'总控问题ID'),
    
        'sign'        	=> array('check'=>true,'info'=>'通信加密字符串'),
    
        'time'        	=> array('check'=>true,'info'=>'通信加密时间戳'),
    
        'subject'     	=> array('check'=>true,'info'=>'问题标题'),
    
        'description' 	=> array('check'=>true,'info'=>'问题详细'),
    
        'name' 		  	=> array('check'=>true,'info'=>'提问者姓名'),
    
        'age' 		  	=> array('check'=>true,'info'=>'患者年龄'),
    
        'department'	=> array('check'=>true,'info'=>'问题所属科室'),
    
        'phone'   	  	=> array('check'=>false,'info'=>'提问者联系方式'),
    
        'gender' 	  	=> array('check'=>false,'info'=>'患者性别'),
    
        'history' 	  	=> array('check'=>false,'info'=>'患者患病历史'),
    
        'condtion' 	  	=> array('check'=>false,'info'=>'目前治疗情况'),
    
        'city' 	      	=> array('check'=>false,'info'=>'患者城市'),
    
        'assay_pic'   	=> array('check'=>false,'info'=>'化验单图片'),
    
        'pic'   	    => array('check'=>false,'info'=>'普通问题图片'),
    
        'source_hospital' => array('check'=>false,'info'=>'问题来源医院名称'),
    
    );
    
    // }}}
    
	/**
	 * 构造函数
	 */
	public function __construct() {
	    /*
	    $data = $this->getRequest('part', '');
	    
	    $data = str_replace("'", '"', $data);
	    $data = str_replace("\n", '', $data);  //有时候传过来的有换行，比如图片.
	    if(!is_null(json_decode($data))){
	        //客户端传来的json串略有差异
	        $_REQUEST = json_decode($data, true);
	    
	    }
	    */
	    
	    $_REQUEST['method'] = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
	    parent::__construct();
	}
	
	/**
	 * 接口入口
	 * 返回：json
	 * */
	public function _begin() {
	    //验证总控用户
	    //$this->getRemoteUser();
	    
	    $hospital = R::findOne(TABLENAME_CONTACT, "flag='name'");
	    $this->__hos_name = $hospital->val;
	    
	    $data = $_REQUEST;
	    
		if(empty($data)){
			$this->msgPut(false, '参数不能为空', null, '10001');
		}
		
		if (!isset($data['domain'])) {
			$urlData = parse_url(NETADDRESS);
			$data['domain'] = $urlData['host'];
		}
		
		error_log('type:' . $data['type'] . PHP_EOL, 3, '/tmp/log');
		switch ($data['type']) {
			case 'online': //在线提问
				$result = $this->_online($data);
				break;
			case 'question_list': //提问列表
			    $result = $this->_questionList($data);
			    break;
			case 'question_detail': //提问详情
			    $result = $this->_questionDetail($data);
			    break;
			case 'question_asked': //追问
			    $result = $this->_questionAsked($data);
			    break;
			default:
				$this->msgPut(false, $data['type'] . '不存在', null);
				break;
		}
		
		echo json_encode($result);
	}
	
	// {{{ protected function _online()
	
	/**
	 * 在线提问
	 * */
	protected function _online($data) {
	    try {
	        if (!isset($data['user_id']) || empty($data['user_id'])) {
	            $user = $this->_getuser();
	            if ($user) {
	            	$data['user_id'] = (int)$user['user_id'];
	            }
	        }
	        if($data['age']==""||(int)$data['age']<0){
	        	return array('type'=>'online', 'online'=>'no', 'msg'=>'年龄不正确');
	        }  

	        if (isset($data['img_url']) && $data['img_url']) {
	        	//处理图片
	        	$desPath = "images/question_" . time();
	            if ($url = $this->createImageFromString($data['img_url'], $desPath) )
	            {
	                $data['img_url'] = "/interface/hma/" . $url;
	            } else {
	                $data['img_url'] = '';
	            }
	            
	        }
	        $data['question_id'] = 1;
	        $this->formatDistributeParams($data);
	        
	    } catch (Exception $e) {
	        return array('type'=>'online', 'online'=>'no', 'msg'=>$e->getMessage());
	    }
	    $msg = empty($user) ? '提问成功，稍后将有专业医生为您解答' : $user;
	    
	    return array('type'=>'online', 'online' => 'yes', 'msg'=>$msg);
	}
	
	// }}}
	// {{{ protected function _questionList()
	
	/**
	 * 提问列表
	 * */
	protected function _questionList($data) {
	    try {
	        $result = R::findAll(TABLENAME_ASK, 'user_alis =:user_id', array('user_id'=>$data['user_id']));
	        $list = array();
	        if (!empty($result)) {
	            $index = 0;
	        	foreach ($result as $key=>$value) {
	        		$list[$index]['question_id'] = $value->id;
	        		$list[$index]['reply'] = ((int)$value->isanswer==1) ? 'yes' : 'no';
	        		$list[$index]['title'] = $value->subject;
	        		$list[$index]['time'] = $value->plushtime;
	        		$index++;
	        	}
	        }
	        
	    } catch (Exception $e) {
	        return array('type'=>'question_list', 'question_list'=>'no', 'msg'=>$e->getMessage());
	    }
	    
	    return array('type'=>'question_list', 'data' => $list);
	}
	
	// }}}
	// {{{ protected function _questionDetail()
	
	/**
	 * 提问详情
	 * */
	protected function _questionDetail($data) {
	    try {
	        $quesObj = R::load(TABLENAME_ASK, $data['question_id']);
	        if (empty($quesObj->id)) {
	            return array('type'=>'question_list', 'data' => array());
	        }
	        
	        $askdesc = R::findOne(TABLENAME_ASKDESC, 'ask_id =:question_id order by id desc', array('question_id'=>$data['question_id']));
	        
	        $question = array();
	        $question['question_id'] = $quesObj->id;
	        $question['question_type'] = 0;
	        $question['title'] = $quesObj->subject;
	        $question['description'] = $askdesc->description;
	        $question['image_url'] = $askdesc->pic1;
	        
	        $list = array($question);
	        $this->_getAllContent($data['question_id'], $list);
	        
	        //error_log('get:' . PHP_EOL . var_export($list, true) . PHP_EOL, 3, '/tmp/log');
	    } catch (Exception $e) {
	        return array('type'=>'question_list', 'question_list'=>'no', 'msg'=>$e->getMessage());
	    }
	    return array('type'=>'question_list', 'data' => $list);
	}
	
	// }}}
	// {{{ protected function _getAllContent()
	protected function _getAllContent($question_id, &$selected = array()) {
	    //回复
	    $answers = $this->_getQuestionAnswer($question_id);
	    $selected = array_merge($selected, $answers['answers']);
	    
	    $ids = $answers['ids'];
	    if (empty($ids)) {
	    	return false;
	    }
	    //追问
	    $list = R::findAll(TABLENAME_ASKADDTO, " ans_id in ( " . implode(',', $ids) . " )");
	    
	    if (empty($list)) {
	        return false;
	    }
	    
	    $has_reply_ids = array();
	    $questions = array();
	    $index = 0;
	    
	    foreach ($list as $key => $question) {
	        if ($question->mode == 0) {//追问回复
	            $questions[$index]['question_type'] = 1;
	            $questions[$index]['reply_id'] = 'rid_' . $question->id;
	            $questions[$index]['up_id'] = 'rid_' . $question->add_id;//$question->ask_id;
	            $questions[$index]['reply'] = $question->info;
	            
	            $questions[$index]['doctor'] = array();
	            $questions[$index]['doctor']['doctor_id'] = 1;
	            $questions[$index]['doctor']['doctor_name'] = 'aaa';
	            $questions[$index]['doctor']['img_url'] = '';
	            $questions[$index]['doctor']['reply_num'] = 1;
	            $questions[$index]['doctor']['position'] = '';
	             
	            $questions[$index]['doctor']['hospital'] = $this->__hos_name;
	        } else { //追问
	            $questions[$index]['asked_id'] = $question->id;
	            $questions[$index]['question_type'] = 2;
	            $questions[$index]['up_id'] = 'answer_' . $question->ans_id;
	            if (!empty($question->add_id)) {
	                $questions[$index]['up_id'] = 'rid_' . $question->add_id;
	            }
	            
	            $questions[$index]['asked'] = $question->info;
	            $questions[$index]['has_reply'] = 'no';
	        }
	        
	        $obj = R::findOne(TABLENAME_ASKADDTO, 'ask_id=:ask_id', array('ask_id'=>$question_id));
	        if (!empty($obj->id)) {
	            $has_reply_ids[] = $question->add_id;
	            $questions[$index]['has_reply'] = 'yes';
	        }
	        
	        $index++;
	    }
	    
	    $selected = array_merge($selected, $questions);
	    if ($has_reply_ids) {
	    	return array_merge($selected, $this->_getAllContent($has_reply_ids, $selected));
	    }
	    return true;
	}
	// }}}
	// {{{ protected function _questionAsked()
	
	/**
	 * 追问
	 * */
	protected function _questionAsked($data) {
	    try {
	        $msg = '';
            $data['hospital'] = $data['domain'];
            $question_id = $this->formatAddtoParams($data, $msg);
	    } catch (Exception $e) {
	        return array('type'=>'question_asked', 'question_asked'=>'no', 'msg'=>$e->getMessage());
	    }
	    $question_asked = $question_id ? 'yes' : 'no';
	    $msg = $question_id ? $question_id : $msg;
	    return array('type'=>'question_asked', 'question_asked' => $question_asked, 'msg'=>$msg);
	}
	
	// }}}
	// {{{ protected function _getQuestionAnswer()
	
	/**
	 * 获取问题的回复
	 * */
	protected function _getQuestionAnswer($question_id) {
	    if (!is_array($question_id)) {
	    	$question_id = array($question_id);
	    }
	    try {
	        
	        $list = R::findAll(TABLENAME_ANSWER, "ask_id in ( " . implode(',', $question_id) . " )");
	        $answers = array();
	        $reply_ids = array();
	        
	        $index = 0;
	        foreach ($list as $key => $answer) {
	            $reply_ids[] = $answer['id'];
	            $answers[$index]['question_type'] = 1;
	            $answers[$index]['reply_id'] = 'answer_' . $answer['id'];
	            $answers[$index]['up_id'] = 'answer_' . $answer['ask_id'];
	            $answers[$index]['reply'] = $answer['content'];
	            
	            $doctor = R::load(TABLENAME_DOCTOR, $answer['doc_id']);
	            $reply_num = R::getRow('select count(doc_id) as reply_num from ' . TABLENAME_ANSWER);
	            
	            $answers[$index]['doctor'] = array();
	            $answers[$index]['doctor']['doctor_id'] = $doctor['id'];
	            $answers[$index]['doctor']['doctor_name'] = $doctor['name'];
	            $answers[$index]['doctor']['img_url'] = $doctor['pic'];
	            $answers[$index]['doctor']['reply_num'] = $reply_num['reply_num'];
	            $answers[$index]['doctor']['position'] = $doctor['position'];
	            
	            $answers[$index]['doctor']['hospital'] = $this->__hos_name;
	            $index++;
	        }
	    } catch (Exception $e) {
	        return array();
	    }
	    return array('answers'=>$answers, 'ids'=>$reply_ids);
	}
	
	// }}}
	// {{{ protected function formatDistributeParams()
	
	/**
	 * 格式化提问接口数据
	 * */
	protected function formatDistributeParams($data) {
	    $user = $this->_getuser($data['user_id']);
	    
	    $sign = md5('hwibs' . time() . $data['domain']);
	    $img_url = empty($data['img_url']) ? '' : NETADDRESS . $data['img_url'];
	    $params = array(
	        'name' => $user['acct_name'],
	        'domain' => $data['domain'],
	        'source_domain' => $data['domain'],
	        'question_id' => $data['question_id'],
	        'sign' => $sign,
	        'time' => time(),
	        'subject' => $data['title'],
	        'description' => $data['description'],
	        'phone' => $user->mobile,
	        'age' => $data['age'],
	        'gender' => $data['gender'],
	        'history',
	        'condtion',
	        'city' => $user['city'],
	        'assay_pic' => $img_url,
	        'source_hospital' => $this->__hos_name,
	        'department' => $data['departments'],
	        'user_alis' => $data['user_id'],
	        'pic' => $img_url
	    );
	    
	    return $this->addDistributeSave($params);
	}
	// }}}
	// {{{ protected function formatAddtoParams()
	
	/**
	 * 格式化追问接口数据
	 * */
	protected function formatAddtoParams($data, &$msg = '') {
	    $arr = explode('_', $data['reply_id']);
	    $reply_id = isset($arr[1]) ? $arr[1] : $arr[2];
	    
	    if (isset($arr[0]) && $arr[0] == 'rid') {
	        $obj = R::load(TABLENAME_ASKADDTO, $reply_id);
	    } else {
	        $obj = R::load(TABLENAME_ANSWER, $reply_id);
	        $reply_id = 0;
	    }
	    
	    $sign = md5('hwibs' . time() . $data['domain']);
	    $params = array(
	        'domain' => $data['domain'],
	        'sign' => $sign,
	        'time' => time(),
	        'question_id' => $obj->ask_id,
	        'content' => $data['asked'],
	        'parent_id' => $obj->ask_id,
	        'add_id' => $reply_id
	    );
	    
	    if ($re = $this->addSave($params, $msg)) {
	    	return $obj->ask_id;
	    }
	    
	    return false;
	    
	}
	// }}}
	// {{{ function _getuser()
	/**
	 * 总控用户验证方法
	 */
	protected function _getuser($user_id = '') {
	    try {
            $url = 'http://www.boyicms.com/interface/hma/OnlineInterface.php';
            $post_data = array('part'=>json_encode(array(
                'type' => 'get_user',
            	'user_id' => $user_id
            )));
            
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt ( $ch, CURLOPT_POST, 1 );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
            $data = curl_exec ( $ch );
            curl_close ( $ch );
        } catch ( Exception $e ) {
            return false;
        }
	        
        $user = json_decode ( $data, true );
	        	
	    return $user;    
	}
	
	// }}}
	// {{{ function addSave()
	
	/**
	 * 保存追问和回复
	 * */
	public function addSave($data, &$msg = '') {
	    $error_log = ABSPATH .'/log/addto_error.log';
	    
	    $check = $this->voluation($this->addto, $data);
	    if ($check !== true) {
	        error_log(date('Y-m-d H:i:s') . ' 错误:' . $check." " . PHP_EOL, 3, $error_log);
	        return false;
	    }
	    
	    $addto   = new AskAddto();
	    $service = new AskAddtoService();
	    $addto->mode   = 1;//追问
	    $addto->ask_id = $data['parent_id'];
	    //通过ask_id取ans_id
	    $result = R::findOne('answer','ask_id = '.$addto->ask_id);
	    $addto->ans_id = $result->id;
	    $addto->info   = $data['content'];
	    $addto->plushtime   = time();
	    $addto->useful  = 0;
	    $addto->useless = 0;
	    $addto->add_id  = $data['add_id'];
	    //获取是否存在一摸一样的info信息，存在则证明重复追问了
	    $result = R::findOne('askaddto',"info = '".$addto->info."'");
	    if( is_object( $result ) ) {
	        error_log(date('Y-m-d H:i:s') . ' 错误:存在相同的追问信息！' . PHP_EOL, 3, $error_log);
	        $msg = '存在相同的追问信息！';
	        return false;
	    }else{
	        $service->addto($addto);
	        return true;
	    }
	}
	
	// }}}
	// {{{ function addDistributeSave
	
	/**
	 * 保存提问
	 * */
	private function addDistributeSave($data) {
	    $error_log = ABSPATH .'/log/distribute_error.log';
	    
	    $check = $this->voluation($this->distribute, $data);
	    if ($check !== true) {
	        error_log(date('Y-m-d H:i:s') . ' 错误:' . $check." " . PHP_EOL, 3, $error_log);
	    	return false;
	    }
	
	    $this->bind($ask   = new Ask(), $data);//绑定ask对象
	    $this->bind($askDesc  = new AskDesc(), $data);//绑定askDesc对象
	
	    $askDesc->pic1      = $data['pic'];//手动绑定图片1地址
	    $askDesc->assay_pic = $data['assay_pic'];//手动绑定化验单图片地址
	    $askDesc->gender    = $askDesc->gender == '男' ?  1 : 0;//男1女0
	
	    $this->bind($askAssay = new AskAssay(), $data);//绑定AskAssay对象
	    
	    $serviceHandler = new AskService();
	    $BIND = $serviceHandler->save($ask, $askDesc, $askAssay);
	    if($BIND->statu){
	        $this->setLog( $ask->id, $data );
	        return true;
	    }
	
	}
	
	// }}}
	// {{{ function setLog()
	
	/**
	 * 写入日志
	 * */
	private function setLog( $askID, $data ) {
	
	    $sql = "INSERT INTO `interface_ask` (`ask_id`,`question_id`,`is_reply`,`source_domain`,`add_time`,`domain`,`source_hospital`) VALUES (
			'".$askID."',
			'".$data['question_id']."',
			0,
			'".$data['source_domain']."',
			'".time()."',
			'".$data['domain']."',
			'".$data['source_hospital']."'
			);";
	
	    return R::exec( $sql );
	
	}
	
	// }}}
	// {{{ function voluation()
	
	/**
	 * 参数检测
	 * */
	private function voluation($params, &$data = array()) {
	    foreach ( $params as $key => $value ) {
	        if( isset( $data[$key] ) && $data[$key] != '' ) {
	            $data[$key] = trim( $data[$key] );
	        }else{
	            if( $value['check'] === true ) {
	                return '参数缺失：'.$value['info'].':'.$key;
	            }else{
	                $data[$key] = '';
	            }
	        }
	    }
	    
	    return true;
	    
	}
	
	// }}}
	// {{{ function bind
	
	/**
	 * 绑定实体参数
	 * */
	public function bind($entity, $data) {
	    foreach ( $entity as $key => $value ) {
	        if (isset ( $data [$key] )) {
	            $entity->$key = $data [$key];
	        }
	    }
	}
	
	// }}}
	

	// {{{ function createImageFromString()
	
	/**
	 * 字符串转换成图片，并保存到指定位置
	 *
	 * @param $str base64加密后的图片字符串
	 * @param $desPath 图片保存位置
	 * */
	public function createImageFromString($str, $desPath) {
	    //处理url解码中+被转成空格的情况
	    $str = str_replace(" ", '+', $str);
	
	    $str = base64_decode($str);
	    $im = imagecreatefromstring($str);
	    if ($im !== false) {
	        $file = $desPath . '.png';
	        if (imagepng($im, $file)) {
	            return $file;
	        }
	        $file = $desPath . '.jpg';
	        if(imagejpeg($im, $file)) {
	            return $file;
	        }
	        $file = $desPath . '.gif';
	        if (imagegif($im, $file)) {
	            return $file;
	        }
	        $file = $desPath . '.wbmp';
	        if (imagewbmp($im, $file)) {
	            return $file;
	        }
	    }
	    return false;
	}
	// }}}
}
new OnlineInterface();
