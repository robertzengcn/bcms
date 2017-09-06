<?php
class DownloadController extends Controller {
	
	private $service;
	
	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		$this->service = new DownloadService();
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
		 $result = $this->service->query($_REQUEST);
         $totalRows = $this->service->totalRows($_REQUEST);

        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $totalRows->data
        ));
	}
	
	
	/**
	 * 数据包删除(本地)
	 */
 	public function del() {
 		if (is_array($_REQUEST['id'])) {
 			$devices = $_REQUEST['id'];
 		} else {
 			$devices = array(
 					$_REQUEST['id']
 			);
 		}
 		$result = $this->service->deleteBatch($devices);
 		
 		echo json_encode($result);
	} 
	
	/**
	 * 上传
	 */
	public function fileupload(){
	    $upload = false;
        // 进入上传   
        if (is_uploaded_file($_FILES['Filedata']['tmp_name'])) {    
            $file = $_FILES['Filedata'];
            $updir = GENERATEPATH . "data/download/";
            if (! Io::ioMkDir($updir)) {
            	$this->dirMkError($updir);
            }
            // 上传大小限制           
            if ((int) $_FILES['Filedata']['size'] > Io::getApachePostMaxValue() * 1024 * 1024) {
                die(json_encode(new Result(false, 181, ErrorMsgs::get(181), null)));               
            }
            //fb(iconv("UTF-8","gbk",$file["name"]),'file');
            $tmpName = $file['tmp_name'];
            if (is_uploaded_file($_FILES['Filedata']['tmp_name'])) {
                if (copy($_FILES['Filedata']['tmp_name'], $updir . "template.tmp")) {
                 $upload = true;
                }
            }
            if($upload){
            	die(json_encode(new Result(true, 0, '', $file["name"])));
            }else{
            	die(json_encode(new Result(false, '50', ErrorMsgs::get(50), null)));
            }
        }else {fb('file');
            die(json_encode(new Result(false, '50', ErrorMsgs::get(50), null)));
        }
    }
    
    /**
     *文件信息保存至数据库
     */
    public function save(){    		 
    	$updir = GENERATEPATH . "data/download/";
    	if (! Io::ioMkDir($updir)) {
    		     $this->dirMkError($updir);
    	}	
    	$data = $this->service->query($_REQUEST);   //判断是否重名
    	$ttl = $this->service->totalRows($_REQUEST);
    	if(($ttl->data == 1 && !isset($_REQUEST['id'])) || ($ttl->data == 1 && $data->data[0]->name == $_REQUEST['name'])){
    		die(json_encode(new Result(false,0,'文件名称已存在！',null)));
    	}
    	$tmpName = $updir . $_REQUEST['lastname'];
    	if (!rename($tmpName, $updir . iconv("UTF-8","gbk",$_REQUEST["name"]))) {
    		die(json_encode(new Result(false,0,$tmpName.'文件不存在！',null)));
    	}
    	$filepath = iconv('UTF-8','GB2312',$updir . $_REQUEST['name']);
    	if(is_file($filepath)){
    		$_REQUEST['url'] = $filepath;
    		$_REQUEST['sort'] = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 0;
    		$_REQUEST['isshow'] = isset($_REQUEST['isshow']) ? $_REQUEST['isshow'] :0;
    		$this->blindParams($download = new Download());
    		if(isset($_REQUEST['id']) && $_REQUEST['id'] != 0 ){
    			$result = $this->service->update($download);
    		}else{
    			$result = $this->service->save($download);
    		}
            die(json_encode(new Result(true,'','',null)));
    	}else{
    		die(json_encode(new Result(false,0,'找不到文件路径！',null)));
    	}
    }
    
    /**
     * 文件信息编辑
     */
    public function edit(){
    	if(isset($_REQUEST['types']) && $_REQUEST['types'] == 'upload'){
             $array = array();
             $array['name'] = $_REQUEST['name'];
             $array['lastname'] = $_REQUEST['name'];
    		 echo(json_encode(new Result(true,'','',$array)));
    	}else{
    		$this->blindParams($environment = new Download());
    	    $result = $this->service->get($environment);
    	    echo json_encode($result);
    	}
    }
    
    /**
     * 文件夹无法生成输出
     * @methdo dirMkError
     * @info 用于文件夹无法生成的时候,统一向前端提供报错信息
     * @param string $dirPath
     *            文件夹地址
     */
    private function dirMkError($dirPath) {
    	die(json_encode(new Result(false, 0, '操作失败,请检查' . $dirPath . ',失败原因：' . Io::$dirMakeError, null)));
    }
	
}













