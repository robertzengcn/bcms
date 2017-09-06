<?php
class BackupsController extends Controller {
	
	private $service;
	
	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		$this->service = new BackupsService();
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
	 * 获取数据列表
	 */
	public function query() {
		$Dir = "../data";
		//echo $Dir;
		//if(file_exists($Dir)
		$FileArray = array();
		if(is_dir($Dir)){
			if( false != ($Handle = opendir($Dir)) ) {
				$key=0;
			while( false != ($File = readdir($Handle)) ){
    				if( $File!='.' && $File!='..'  && strpos($File,'.sql') ){
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
    					$FileArray[$key]['type'] = "Backups";
    					$FileArray[$key]['pathway'] = "$Dir/$File";
    					$key++;
    				}
    				
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
			$FileArray[] = $Dir."文件不存在";
			echo json_encode($FileArray);
		}
	}
	
	/**
	 * 备份
	 */
	public function backups(){
		$sql = $this->service->backups();
		$filename = ABSPATH . "/data/" .DBNAME."_".date('YmdHi') . ".sql"; //存放路径，默认存放到项目最外层
		$fp = fopen($filename, 'w');
		fputs($fp, $sql);
		fclose($fp);
		echo json_encode(new Result(true, 0, '', null));
	}
	
	/**
	 * 还原
	 */
	public function restore(){
		$times = $_REQUEST['times'];
		$file_dir = $_REQUEST['pathway'];
		//exec("mysql -u".DBUSER." -p".DBPASSWORD." ".DBNAME." < $file_dir",$Info);
		if(file_exists($file_dir)){
			$content = file_get_contents($file_dir);  
			$meg = $this->service->restore($content,$times);
			$meg['name'] = $file_dir;
			$meg['type'] = 'Backups';
			echo json_encode(new Result(true, 0, '', $meg));
		}
	}
	
	/**
	 *  下载
	 */
	public function downfile(){
 		$file = $_REQUEST['pathway'];
		$name = $_REQUEST['filename'];
		$dir = explode('.', $name);
	    if(file_exists($file)){
	    	$archive = new PclZip('../template_c/'.$dir[0].'.zip');
	    	$v_list = $archive->create($file);
	    	if ($v_list == 0) {
	    		echo json_encode(new Result(false, 0, $archive->errorInfo(true), null));
	    	}
	    	echo json_encode(new Result(true, 0, '', $dir[0]));
	        //$handle = fopen ( $file, "r" );
			//输入文件标签
			//Header ( "Content-type: application/octet-stream" );
			//Header ( "Accept-Ranges: bytes" );
			//Header ( "Accept-Length: " . filesize($file));
			//Header ( "Content-Disposition: attachment; filename=" . $name );
			//输出文件内容
			//读取文件内容并直接输出到浏览器
		    //echo fread ( $handle, filesize ( $file ) );
		    //readfile($handle);
			//fclose ( $handle );exit();  */
		}   
	}
	
	/**
	 * 数据包删除(本地)
	 */
 	public function removefile() {
		if (isset($_REQUEST['pathway']) && $_REQUEST['pathway'] != '') {
			$pathway = trim($_REQUEST['pathway']);
			@unlink($pathway);
			die(json_encode(new Result(true, 0, '', null)));
		}
	} 
	
	/**
	 * 上传
	 */
	public function sqlupload(){
	    $upload = false;
        // 进入上传   
        if (is_uploaded_file($_FILES['Filedata']['tmp_name'])) {        	
            $file = $_FILES['Filedata'];
            $updir = "../template_c/data";
            if (! Io::ioMkDir($updir)) {
                $this->dirMkError($updir);
            }
            // 上传大小限制           
            if ((int) $_FILES['Filedata']['size'] > Io::getApachePostMaxValue() * 1024 * 1024) {
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
                'type' => 'Backups'
            );
            die(json_encode(new Result(true, 0, '', $data)));
        } else {
            die(json_encode(new Result(false, '50', ErrorMsgs::get(50), null)));
        }
    }
    
    /**
     *
     *
     * 文件夹无法生成输出
     * @methdo dirMkError
     * @info 用于文件夹无法生成的时候,统一向前端提供报错信息
     *
     * @param string $dirPath
     *            文件夹地址
     */
    private function dirMkError($dirPath) {
    	die(json_encode(new Result(false, 0, '操作失败,请检查' . $dirPath . ',失败原因：' . Io::$dirMakeError, null)));
    }
	
}












