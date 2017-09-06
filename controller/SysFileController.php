<?php
class SysFileController extends Controller{
	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		require_once GENERATEPATH . 'lib/io.php';
		require_once GENERATEPATH . 'lib/templateIni.php';
		require_once GENERATEPATH . 'lib/plugin/pclzip-2-8-2/pclzip.lib.php'; // .引入PclPHP插件
	}
	
	function filter() {
		$filterService = new FilterService();
		$filterService->addFunc($filterService::$SQLINJECTION);
		$filterService->addFunc($filterService::$WORKERISLOGIN);
		$filterService->addFunc($filterService::$FILERPLUSHTIME);
		$filterService->addFunc($filterService::$WORKERLOGHISTORY);
		return $filterService->execute();
	}
	
	/**
	 * 备份相关文件
	 */
    public function backups(){
    	$files = array();
    	$files = array('app','mobile','tpl','upload','wechat','web-setting.php');
        for($i=0; $i<count($files); $i++){
        	$dir .= "../" . $files[$i] . ",";
        }
        $dir = rtrim($dir,',');
        $path = ABSPATH . "/data/tplfile";
        /* if(!file_exit($path)){
        	mkdir($path,0777);
        } */
        $archive = new PclZip($path."/sys_tpl_".date('YmdHi') . ".zip");
        $v_list = $archive->create($dir);
        if($v_list == 0 ){
        	echo json_encode(new Result(false, 0, '备份失败', null));
        }else{
        	echo json_encode(new Result(true, 0, '', null));
        }
    }
    
    /**
     * 获取列表
     */
    public function query(){
    	$dir = "../data/tplfile";
    	$filearray = array();
    	if(is_dir($dir)){
    		$handle = opendir($dir);
    		$key = 0 ;
    		while( ($File = readdir($handle)) != false ){
    			if($File != '.' && $File != '..' && strpos($File,'.zip')){
    				$filearray[$key]['name'] = $File;
    				$filesize = filesize($dir."/".$File)/1024/1024;
    				if($filesize < 0.1){
    					list($str1,$str2) = explode('.', $filesize);
    					$filearray[$key]['size'] = $str1. "." .substr($str2,0,2);
    				}else{
    					list($str1,$str2) = explode('.', $filesize);
    					$filearray[$key]['size'] = $str1. "." .substr($str2,0,1);
    				}
    		    $filearray[$key]['plushtime'] = date("Y-m-d H:i:s",filemtime($dir."/".$File));	
    		    $filearray[$key]['type'] = "SysFile";	
    		    $filearray[$key]['pathway'] = "$dir/$File";
    			$key ++;	
    			}
    		}
    		closedir($handle);
    		$FileArray = array_merge($filearray);
    		//echo json_encode($FileArray);
    		echo json_encode(array(
    				'rows' => $FileArray,
    				'ttl' => $key
    		));
    	}
    }
    
    /**
     * 文件还原
     */
    public function restore(){
    	$dir = $_REQUEST['pathway'];
    	$meg = array();
    	$files = array();
    	$files = array('app','mobile','tpl','upload','wechat','web-setting.php');
    	for($i=0; $i<count($files); $i++){
    		$filedir = ABSPATH."/".$files[$i];
    		$filedir = trim($filedir);
    		$this->deldir($filedir);
    		if(file_exists($filedir)){
    			if (!Io::DirDelete($filedir)) {
    				die(json_encode(new Result(false, 0, "$filedir 文件删除失败 ", null)));
    			}
    		}
    	}
     	$archive = new PclZip($dir);
    	$v_list = $archive->extract();
    	if($v_list == 0){
    		echo json_encode(new Result(false, 0, '', ''));
    	}else{
    		$meg['times'] = 'success';
    		echo json_encode(new Result(true, 0, '', $meg));
    	} 
    }
    
    /**
     * 删除模板文件
     */
    public function removefile() {
		if (isset($_REQUEST['pathway']) && $_REQUEST['pathway'] != '') {
			$pathway = trim($_REQUEST['pathway']);
			@unlink($pathway);
			die(json_encode(new Result(true, 0, '', null)));
		}
	} 
    
    
    /**
     * 删除目录及目录下的所有文件
     */
    public function deldir($dir){
    	if(file_exists($dir)){
    		if(is_dir($dir)){
    			$handle = opendir($dir);
    			while(false !== ($File=readdir($handle))){
    				if($File != '.' && $File != '..'){
    					if(is_dir("$dir/$File")){
    						$this->deldir("$dir/$File");
    					}else{
    						if(!unlink("$dir/$File")){
    							echo "$dir/$File";
    							exit();
    						}
    					}
    				}
    			}
    			closedir($dir);
    	    	//rmdir($dir);
    		}else{
    			unlink($dir);
    		}
    	}
    	
    }
    
    /**
     * 上传
     */
    public function sqlupload(){
    	$upload = false;
    	// 进入上传
    	if (is_uploaded_file($_FILES['Filedataa']['tmp_name'])) {
    		$file = $_FILES['Filedataa'];
    		$updir = "../template_c/data";
    		if (! Io::ioMkDir($updir)) {
    			//$this->dirMkError($updir);
    		} 
    		// 上传大小限制
    		if ((int) $_FILES['Filedataa']['size'] > Io::getApachePostMaxValue() * 1024 * 1024) {
    			die(json_encode(new Result(false, 181, ErrorMsgs::get(181), null)));
    
    		}
    		$FileDir = $updir . '/' . $file['name'];
    		$tmpName = $file['tmp_name'];
    		
    		if (is_uploaded_file($tmpName)) {
    			if (move_uploaded_file($tmpName, $FileDir)) {
    				$upload = true;
    			}
    		}
    	}
    	if ($upload) {
    		$data = array(
    				'sql' => $FileDir ,
    				'type' => 'SysFile'
    		);
    		die(json_encode(new Result(true, 0, '', $data)));
    	} else {
    		die(json_encode(new Result(false, '51', ErrorMsgs::get(50), null)));
    	}
    }
    
}