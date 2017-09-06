<?php
/**
 * 
 * 总控微信第三方数据推送接口
 * @author Administrator
 * @version v1.0
 * @internal 本接口由总控中心进行调用
 * @example 该接口为被动触发接口
 * @example 
 */
include './common.class.php';
class callback extends common {
    private $dao = null;
	public function __construct() {
		parent::__construct();
		$this->dispatch();
	}
	
	/**
	 * 调用分发
	 * */
	protected function dispatch() {
	    $action = $this->getRequest('action', '');
	    switch ($action) {
	    	case 'uploadImg': //暂时没有使用
	    	    $this->downloadImg();
	    	    break;
	    	case 'saveWeixin':
	    	    $this->dao = new WeixinDAO();
	    	    $this->saveWeixinUser();
	    	    break;
	    	default:
	    	    break;
	    }
		
	}
	
	
	protected function downloadImg() {
	    if($_FILES)
	    {
	        $filename = $_FILES['file']['name'];
	        $tmpname = $_FILES['file']['tmp_name'];
	        $dir = UPLOAD . 'weixin';
	        if (!is_dir($dir)) {mkdir($dir, 0777);}
	        $fileDir = $dir.'/'.$filename;
	        if(move_uploaded_file($tmpname, $fileDir))
	        {
	            parent::msgPut(true, '' , $fileDir );
	        }
	        parent::msgPut(false, "文件{$filename}上传失败" , null );
	    }
	}
	
	protected function saveWeixinUser() {
	    try {
	        $weixinname = $this->getRequest('weixinname', '');
	        $weixin = new Weixin();
			if($_REQUEST['tag'] == 'auth'){
				$_REQUEST['tag'] = 'auth_' . uniqid();
			}
	        foreach ($_REQUEST as $key=>$val){
	            $weixin->$key = $val;
	        }
	        error_log(var_export($_REQUEST, true).PHP_EOL, 3, '/tmp/zyy.log');
	        $obj = $this->dao->getWeixinByName($weixinname);
	        error_log(var_export($obj, true).PHP_EOL, 3, '/tmp/zyy.log');
	        
	        if (!isset($obj->id) || $obj->id == '') {
	            $weixin->validate();
	            $re = $this->dao->saveWeixin($weixin);
	        }
	        
	        if($re){
	            parent::msgPut(true, '' , null );
	        }
	        parent::msgPut(false, "添加公众号{$name}信息失败" , null );
	    } catch (Exception $e) {
	        error_log($e->getMessage().PHP_EOL, 3, '/tmp/zyy.log');
	        parent::msgPut(false, $e->getMessage() , null );
	    }
	    
	}

    final public function getRequest($name = '', $default = '') {
		if (!empty($name)) {
		    if (isset($_REQUEST[$name]) && $_REQUEST[$name]) {
		    	return $_REQUEST[$name];
		    } else {
		    	return $default;
		    }
		}
	
		return $_REQUEST;
	}
}
new callback();