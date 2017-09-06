<?php

class FileManagerController extends Controller {
    private $service;

    /**
     * 构造函数 初始化service
     */
    function __construct() {
        parent::__construct();
        $this->service = new FileManagerService();
        //pc端模板路径
        $json = file_get_contents('../tpl/config.json');
        $tpl = json_decode($json);
        $dirs = $tpl[0]->currentUsed;
        define('TPLDIR', "../tpl/".$dirs);
        //wap
        $json = file_get_contents('../mobile/Tpl/config.ini');
        $tpl = json_decode($json);
        $dirs = $tpl->view;
        define('TPLWAP', '../mobile/Tpl/'.$dirs);
        //app
        $json = file_get_contents('../app/Tpl/config.ini');
        $tpl = json_decode($json);
        $dirs = $tpl->view;
        define('TPLAPP', '../app/Tpl/'.$dirs);
        //wechat
        $json = file_get_contents('../wechat/Tpl/config.ini');
        $tpl = json_decode($json);
        $dirs = $tpl->view;
        define('TPLWECHAT', '../wechat/Tpl/'.$dirs);
    }
    
    /**
     * 过滤(non-PHPdoc)
     *
     * @see Controller::filter()
     */
    function filter() {
    	$filterService = new FilterService();
    	//$filterService->addFunc($filterService::$SQLINJECTION);
    	//$filterService->addFunc($filterService::$WORKERISLOGIN);
    	//$filterService->addFunc($filterService::$FILERPLUSHTIME);
    	//$filterService->addFunc($filterService::$WORKERLOGHISTORY);
    	return $filterService->execute();
    }
    
    /**
     * 获取文件列表
     */
    public function getFile(){
    	$FileArray = array();
    	if($_REQUEST['Dir'] == ''){
    		if($_REQUEST['tem'] == 'pc'){
    			$Dir = TPLDIR;
    		}elseif($_REQUEST['tem'] == 'wap'){
    			$Dir = TPLWAP;
    		}elseif($_REQUEST['tem'] == 'app'){
    			$Dir = TPLAPP;
    		}elseif($_REQUEST['tem'] == 'wechat'){
    			$Dir = TPLWECHAT;
    		}else{
    		}
    	}else{
    		$Dir = $_REQUEST['Dir'];
    	}
    	
    	if( is_dir($Dir) ){
    		if( false != ($Handle = opendir($Dir)) ) {
    			$key=0;
    			while( false != ($File = readdir($Handle)) ){
    				if( $File!='.' && $File!='..' && !strpos($File, 'png') && strpos($File,'.') ){
    					@$FileArray[$key]['name'] = $File;
    					@$filesize = filesize("$Dir/$File");
    					@$filesize=$filesize/1024;
    					if($filesize<0.1){
    						@list($ty1,$ty2)=explode(".",$filesize);
    						$filesize=$ty1.".".substr($ty2,0,2);
    					}
    					else{
    						@list($ty1,$ty2)=explode(".",$filesize);
    						$filesize=$ty1.".".substr($ty2,0,1);
    					}
    					@$FileArray[$key]['size'] = $filesize;
    					@$filetime = filemtime("$Dir/$File");
    					@$FileArray[$key]['plushtime'] = Date("Y-m-d H:i:s",$filetime);
    					$FileArray[$key]['type'] = "file";
    					$FileArray[$key]['pathway'] = "$Dir/$File";
    				}elseif($File!='.' && $File!='..' && !strpos($File,'.')){
    					@$FileArray[$key]['name'] = $File;
    					@$filesize = filesize("$Dir/$File");
    					@$filesize=$filesize/1024;
    					if($filesize<0.1){
    						@list($ty1,$ty2)=explode(".",$filesize);
    						$filesize=$ty1.".".substr($ty2,0,2);
    					}
    					else{
    						@list($ty1,$ty2)=explode(".",$filesize);
    						$filesize=$ty1.".".substr($ty2,0,1);
    					}
    					@$FileArray[$key]['size'] = $filesize;
    					@$filetime = filemtime("$Dir/$File");
    					@$FileArray[$key]['plushtime'] = Date("Y-m-d H:i:s",$filetime);
    					$FileArray[$key]['type'] = "dir";
    					$FileArray[$key]['pathway'] = "$Dir/$File";
    					//echo "$Dir/$File";
    					//exit();
    				}
    				$key++;
    			}
    			closedir( $Handle );
    		}
    		$FileArray = array_merge($FileArray);
    		//echo json_encode($FileArray);
    		echo json_encode(array(
    				'rows' => $FileArray,
    				'ttl' => $key
    		));
    	}else{
    		$FileArray[] = 'error';
    	}
    }
    
    /**
     * 编辑文件
     */ 
    public function edit(){
    	$filecontent = array();
    	$file = $_REQUEST['Dir'];
    	$name = $_REQUEST['name'];
    	$filecontent['name'] = $name;
    	if(is_file($file)){
    		$fp = fopen($file,"r");
    		$filecontent['content'] = fread($fp,filesize($file));
    		fclose($fp);
    	}
    	echo json_encode(array('state' => $filecontent));
    }
    /**
     * 保存文件
     */
    public function save() {
    	if(file_exists($_REQUEST['Dir'])){
    		$file = $_REQUEST['Dir'];
    		$content = $_REQUEST['content'];
    		//判断是否开启了get_magic_gpc
    		if(get_magic_quotes_gpc()){
    			$content=stripslashes($content);
    		}
    		$fp = fopen($file, "w");
    		fputs($fp, $content);
    		fclose($fp);
    		$file = dirname($file);
    		$dirarray['dir'] = $file;
    		echo json_encode($dirarray);
    	}else{
    		$dirarray['dir'] = "文件丢失了！";
    		echo json_encode($dirarray);
    	}
    }
    /**
     * 上级目录
     */
    public function lastdir(){
    	$dirarray = array();
    	$Dir = $_REQUEST['Dir'];
    	if($Dir == TPLDIR || $Dir == TPLAPP || $Dir == TPLWAP || $Dir == TPLWECHAT){
    		$dirarray['lastdir'] = "none";
    	}elseif(dirname($Dir) == TPLDIR || dirname($Dir) == TPLAPP || dirname($Dir) == TPLWAP || dirname($Dir) == TPLWECHAT){
    		$dirarray['lastdir'] = "last";
    		$dirarray['dir'] = dirname($Dir);
    	}else{
    		$dirarray['dir'] = dirname($Dir);
    	}
    	echo json_encode($dirarray);
    }
    
}
