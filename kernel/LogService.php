<?php
class LogService extends BaseService {

    /**
     * 构造函数
     */
    public function __construct() {
		if(!defined('WORDSDIR'))define('WORDSDIR', ABSPATH."/tpl/words/"); //敏感词汇文件夹
		if (! is_dir( WORDSDIR )) {
			@mkdir( WORDSDIR , 0777 , true);
		}
		if(!defined('WORDSJSON'))define('WORDSJSON', WORDSDIR."words.json");//敏感词汇保存的JION文件
		if(!defined('MODULEJSON'))define('MODULEJSON',WORDSDIR."module.json");//模块标题保存文件
		if(! file_exists( MODULEJSON )){
			$this->initModule();
		}
		if(!defined('MODULEMTIMEJSON'))define('MODULEMTIMEJSON',WORDSDIR."modulemtime.json");//模块更新时间保存文件
		if(!defined('NEWSJSON'))define('NEWSJSON',WORDSDIR."news.json");//新闻标题保存文件
		if(!defined('MEDIAJSON'))define('MEDIAJSON',WORDSDIR."media.json");//媒体报道标题保存文件
		if(!defined('SUCCESSJSON'))define('SUCCESSJSON',WORDSDIR."success.json");//案例标题保存文件	
		if(!defined('HONORJSON'))define('HONORJSON',WORDSDIR."honor.json");//医院荣誉标题保存文件
		if(!defined('ENVIRONJSON'))define('ENVIRONJSON',WORDSDIR."environ.json");//医院环境保存文件
		if(!defined('DEVICEJSON'))define('DEVICEJSON',WORDSDIR."device.json");//医疗设备标题保存文件
		if(!defined('ARTICLEJSON'))define('ARTICLEJSON',WORDSDIR."article.json");//疾病资讯标题保存文件
		if(!defined('TECHNOLOGYJSON'))define('TECHNOLOGYJSON',WORDSDIR."technology.json");//医院技术标题保存文件
        $this->dao = new LogDAO();
        
    }

    /**
     * 清空
     *
     * @return Result
     */
    public function clear() {
        $result = $this->dao->clear();

        return new Result($result, 118, ErrorMsgs::get(118), NULL);
    }

    /**
     * 获取单条数据
     *
     * @param unknown $user_id
     * @param unknown $name
     * @param unknown $c
     * @param unknown $m
     * @return string
     */
    public function get($c, $m) {
        $where = $_SESSION['id'] . '|' . $_SESSION['name'] . '|' . $_SESSION['group'] . '|' . $c . '|' . $m;
        $log = $this->dao->get($where);

        return $log;
    }

    /**
     * 获得grid数据
     *
     * @param array $where
     *            查询条件
     * @return Result
     */
    public function query($where) {
        $logs = $this->dao->query($where);
        foreach ($logs as $key => $value) {
            $value->logtime = date('Y-m-d H:i:s', $value->logtime);
            $json = explode('|', $value->op);
            $value->name =  $json[1];
            $value->group = $json[2];
            $value->op = LogMsgs::getController($json[3]) . ' 操作 ' . $json[5];
        }

        return $this->success($logs);
    }

    /**
     * 保存数据
     *
     * @param $op 操作类型
     * @param $msg 中文描述
     * @return Result
     */
    public function save($msg) {
		$method = $_REQUEST['method'];
		$controller = $_REQUEST['controller'];
		//更新模块操作时间
		$module = array('News','MediaReport','Honor','Environment','Device','Article','Success','Technology');
		if($method == 'add' || $method == 'del'){   //$method == 'edit'
			if(in_array($controller, $module) && file_exists(MODULEMTIMEJSON)){
	            $time = file_get_contents(MODULEMTIMEJSON);
				$configmtime = json_decode($time);
				$configmtime->$controller = time();
                $info = json_encode($configmtime);
                file_put_contents(MODULEMTIMEJSON, $info);				
			}
		}
		//更新标题
		if($method == 'query' && in_array($controller, $module)){ 
			$statu = $this->isUpdateTitle($controller);
			if($statu != 0){
				 $table = strtolower($controller);
				 $data = $this->dao->getTitle($table); 
				 $data = json_encode($data);
				 $fileurl = $this->getFileUrl($controller);
				 if($statu == 1){
					@unlink($fileurl['filename']);
					file_put_contents($fileurl['filename'],$data);				 
				 }else{
					$time_info = file_get_contents(MODULEMTIMEJSON);
					$config_mtime = json_decode($time_info);
					$config_mtime->$controller = time();
					$config_info = json_encode($config_mtime);
					file_put_contents(MODULEMTIMEJSON, $config_info);
					file_put_contents($fileurl['filename'],$data);					
				 }
			}
		}		
        $configFile = ABSPATH . '/config.json';
       
        if (file_exists($configFile)) {
            $content = file_get_contents($configFile);
            $config = json_decode($content);
			if(isset($config->mtime) && ($method == 'edit'|| $method == 'add' || $method == 'del' ||  $method == 'update')){
				$config->mtime = time();				           //先保存修改数据时间
                $data = json_encode($config);
                file_put_contents($configFile, $data);				
			}
            if (isset($config->openLog) && $config->openLog && $msg != false) {
                $log = new Log();
                $log->logtime = time();
                // id|name|group|c|m|msg
                $log->op = $_SESSION['id'] . '|' . $_SESSION['name'] . '|' . $_SESSION['group'] . '|' . $_REQUEST['controller'] . '|' . $_REQUEST['method'] . '|' . $msg;
                // 获取class对象并插入数据
                $this->dao->save($log);
            }
        }
    }
    /**
     * 判断是否更新标题
     *
     */
	 public function isUpdateTitle($moudle){
	 	$flag = 0;
		$info = $this->getFileUrl($moudle);
		if($info['status']) {
			return 2;
		}
		$fileurl = $info['filename'];
		if(file_exists(MODULEMTIMEJSON) && file_exists($fileurl)){ //查询标题
			$media_time = file_get_contents(MODULEMTIMEJSON);		
			$media_time = json_decode($media_time);
			$time = $media_time->$moudle;
			$data = file_get_contents($fileurl);
			$data = json_decode($data);
			if($time > filemtime($fileurl)){				 
				$flag = 1;	
			}					
		}	 
		return $flag;
	 }
    /**
     * 获取路径
     *
     */
	public function getFileUrl($moudle){
		switch($moudle){
				case 'News' : $filename = NEWSJSON;break;
				case 'Success' : $filename = SUCCESSJSON;break;
				case 'MediaReport' : $filename = MEDIAJSON;break;
				case 'Honor' : $filename = HONORJSON;break;
				case 'Environment' : $filename = ENVIRONJSON;break;
				case 'Device' : $filename = DEVICEJSON;break;
				case 'Article' : $filename = ARTICLEJSON;break;
				case 'Technology' : $filename = TECHNOLOGYJSON;break;
				default : break;
				
		}		
		if(!file_exists($filename)){
			$re = fopen($filename,"w+");
			chmod($filename,0777);
			fclose($re);
			$info['status'] = true;
			$info['filename'] = $filename;
			return $info;			
		}else{
			$info['status'] = false;
			$info['filename'] = $filename;
			return $info;		
		}

	}
	/**
	 * 初始化模块
	 * */
	 public function initModule(){
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
		file_put_contents(MODULEJSON,$content);
	}
}
