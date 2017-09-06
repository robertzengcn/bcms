<?php
class MobileController extends Controller {


	//初始化数据入口模型
	private $mobileIni  = null;
	
	private $apkurl="http://www.boyicms.com/interface/hma/ApkInterface.php";

	//设置属性
	private $installPath = array(

		//模版路径设置
		'Tpl'=>array(
			'app' => '/app/Tpl','mobile' => '/mobile/Tpl','wechat' => '/wechat/Tpl',
		 ),
		 'Used' => array(
		 	'app' => '/app/Tpl/config.ini','mobile' => '/mobile/Tpl/config.ini','wechat' => '/wechat/Tpl/config.ini',
		 ),
		 //'upload'=> GENERATEPATH."apk",
		 'remoteTemplateListUrl' => 'http://www.boyicms.com/interface/hwibs/product/index.php?product=mobile&method=getList',
		 'remoteTemplateAuthUrl' => 'http://www.boyicms.com/interface/hwibs/product/index.php?product=mobile&method=productAuth',

	);
	private $func = null;
	//构造函数
    public function __construct() {
        parent::__construct();
        require_once GENERATEPATH . 'lib/plugin/pclzip-2-8-2/pclzip.lib.php'; // .引入PclPHP插件
        require_once GENERATEPATH . 'lib/io.php';
        require_once GENERATEPATH . 'lib/MobileIni.php';
    }
	//安全过滤
    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);
        return $filterService->execute();
    }
    //获取在线模版
    public function getRemoteTemplateList() {
    	$this->func = $_REQUEST['func'];//优化
    	$content = @Io::urlPost($this->installPath['remoteTemplateListUrl'] . '&func='. $this->func .'&domain=' . $_SERVER['SERVER_NAME']);
    	$data = json_decode($content, true);
        $templateList = $data['data'];
        if (count($templateList) >= 1) {
            $templateList = array_values($templateList);
            die(json_encode(new Result(true, 0, '', $templateList)));
        } else {
            die(json_encode(new Result(false, 150, ErrorMsgs::get(150), null)));
        }
    }
    /**
     * 模版包删除(本地)
     *
     * @method templateZipDelete
     *         @info 作用为前端上传安装包后,不想安装则点击了“删除”按钮
     */
    public function templateZipDelete() {
    	if (isset($_REQUEST['zipFile']) && $_REQUEST['zipFile'] != '') {
    		$zipFile = trim($_REQUEST['zipFile']);
    		@unlink($zipFile);
    		die(json_encode(new Result(true, 0, '', null)));
    	}
    }
    
    //获取是否有权限下载
    public function getRemoteProductAuth() {
        $id = (int) $_REQUEST['id'];
        $this->func = $_REQUEST['func'];//优化
        $content = @Io::urlPost($this->installPath['remoteTemplateAuthUrl'] . '&func='. $this->func .'&product_id=' . $id . '&domain=' . $_SERVER['SERVER_NAME']);
        $product = json_decode($content);
        die(json_encode(new Result($product->statu, $product->code, $product->msg, $product->data)));
    }
    //获取本地模版
    public function getLocalTemplateList() {
        if( isset( $_REQUEST['func'] ) && $_REQUEST['func'] != '' ) {//优化
    		$this->func = strtolower( trim( $_REQUEST['func'] ) );
    	}else{
    		die( json_encode( array('status'=>-1,'msg'=>'缺少执行模版管理编码') ) );
    	}
    	$path = ABSPATH . $this->installPath['Tpl'][ $this->func ];
    	if( is_dir( $path ) ) {
    		$used = $this->getUsed();
    		$tplHander = opendir( $path );
			$tplArrays = array();
			$key       = 0;
    		while(( $file = readdir( $tplHander )) !== false) {
	    		switch($file){
					case '.' :continue;break;case '..':continue;break;
					default:
						$fileName = $path . '/' . $file;
						if( is_dir( $fileName ) ) {
							$styleIni = $fileName . '/style.ini';
							if( file_exists( $styleIni ) ) {
								$tplArrays[$key]['path']   = $fileName;
								$tplArrays[$key]['style']  = $styleIni;
								$tplArrays[$key]['config'] = json_decode( file_get_contents( $styleIni ) , true );
								$tplArrays[$key]['face']   = NETADDRESS . $this->installPath['Tpl'][ $this->func ]  . '/' . $file . '/' . $tplArrays[$key]['config']['img'];
								$tplArrays[$key]['currentUsed'] = $tplArrays[$key]['config']['shorthand'] == $used ? 1 : 0;
								$key++;
							}
						}
					break;
				}
    		}
    		die( json_encode( array('status'=>1,'msg'=>'本地模版列表获取成功','data'=>$tplArrays) ) );
    	}else{
    		die( json_encode( array('status'=>-1,'msg'=>'本地模版列表获取失败','data'=>null) ) );
    	}
    }
    //获取正在使用的模版
    public function getUsed(){

		$filePath = ABSPATH . $this->installPath['Used'][ $this->func ];
		$content  = file_get_contents($filePath);
		$json     = array(json_decode($content,true));
		if( isset( $json[0]['view'] ) ) {
			return $json[0]['view'];
		}
		return '';
    }
    //模版切换操作
    public function templateSwitch() {
    	$used       = $_REQUEST['used'];
    	$this->func = $_REQUEST['func'];//优化
    	$text = '{"view":"'.$used.'"}';

        //切换模版前进行初始化数据交互操作
        $iniHander = new MobileIni( $this->getUsed() , $used , $this->func );
        $iniRunEnd = $iniHander->getError();
		if( $iniRunEnd['msg'] != 'true' ) {
			die(json_encode(new Result(false, 152 , $iniRunEnd['msg'] , null)));
		}

    	file_put_contents( ABSPATH . $this->installPath['Used'][ $this->func ] , $text );
    	die(json_encode(new Result(true, 0, '', null)));
    }
    //模版删除操作
    public function templateDelete() {
    	$used       = $_REQUEST['used'];
    	$this->func = $_REQUEST['func'];//优化
    	if( $this->getUsed() == $used ) {
    		die(json_encode(new Result(false, -1, '不能删除当前正在使用的模版', null)));
    	}
    	if (Io::DirDelete( ABSPATH . $this->installPath['Tpl'][ $this->func ] . '/' . $used )) {
    		die(json_encode(new Result(true, 0, '', null)));
    	}else{
    		die(json_encode(new Result(false, -1, '模版删除失败,请刷新页面重试', null)));
    	}
    }
    //模版本地上传
    public function templateLocalUpload() {
    	$this->func = $_REQUEST['func'];//优化
        $upload = false;
        // 进入上传
        if (isset($_FILES['Filedata'])) {
            $file  = $_FILES['Filedata'];
            $updir = GENERATEPATH . 'upload/template'; // 模版包上传目录 //优化
            if (! Io::ioMkDir($updir)) {
                $this->dirMkError($updir);
            }
            // 上传大小限制
            if ((int) $_FILES['Filedata']['size'] > Io::getApachePostMaxValue() * 1024 * 1024) {
                die(json_encode(new Result(false, 181, ErrorMsgs::get(181), null)));
            }
            $zipFileName = $updir . '/' . $file['name'];
            $tmpName = $file['tmp_name'];
            if (is_uploaded_file($tmpName)) {
                if (move_uploaded_file($tmpName, $zipFileName)) {
                    $upload = true;
                }
            }
        }
        if ($upload) {
            $data = array(
                'zip' => $zipFileName
            );
            die(json_encode(new Result(true, 0, '', $data)));
        } else {
            die(json_encode(new Result(false, 151, ErrorMsgs::get(151), null)));
        }
    }
    //模版安装操作
    public function templateInstall() {
    	$this->func = $_REQUEST['func'];//优化
        $installInfo = '系统错误,请刷新页面重试.';
        if (isset($_REQUEST['zipFile']) && $_REQUEST['zipFile'] != '') {
            $zipFile = trim($_REQUEST['zipFile']);
            $installInfo = $this->templateInstallInfo($zipFile);
            if ($installInfo === true) {
                die(json_encode(new Result(true, 0, '', null)));
            }
        }
        die(json_encode(new Result(false, 0, $installInfo, null)));
    }
    //模版安装详情
    private function templateInstallInfo($p_zipname) {
    	if (file_exists($p_zipname)) {
            // 实例化Pclphp
            $this->pclzipHandler = new PclZip($p_zipname);
    	    // 删除临时目录并清空下面的文件
            $tempZipDir = COMPILEDIR . 'tempZip';
            if (! is_dir($tempZipDir)) {
                if (! Io::ioMkDir($tempZipDir)) {$this->dirMkError($tempZipDir);}
            } else {
                Io::DirDelete($tempZipDir);
            }
            if ($this->pclzipHandler->extract(PCLZIP_OPT_PATH, $tempZipDir, PCLZIP_OPT_REMOVE_PATH, '') != 0) {
                // 检查配置文件
                $iniConfig = $tempZipDir . '/style.ini';
				$config    = json_decode( file_get_contents( $iniConfig ) , true );
				// 文件夹生成
				if( ! is_dir( ABSPATH . $this->installPath['Tpl'][ $this->func ] ) ) {
					mkdir( ABSPATH . $this->installPath['Tpl'][ $this->func ] );
				}
				$tplDir    = ABSPATH . $this->installPath['Tpl'][ $this->func ] . '/' . $config['shorthand'];
				if( ! is_dir( $tplDir ) ) {
					mkdir( $tplDir );
				}
				// 模版文件复制
                if (Io::DirCopy($tempZipDir, $tplDir)) {
                    // 删除源包
                    @unlink($p_zipname);
                    // 删除临时文件夹
                    Io::DirDelete($tempZipDir);
                    // 获取切换前使用模版名称
                    $front = $this->getUsed();
                    // 设置当前使用模版 //优化
    				$text = '{"view":"'.$config['shorthand'].'"}';
    				file_put_contents( ABSPATH . $this->installPath['Used'][ $this->func ] , $text );
                    //切换模版前进行初始化数据交互操作
			        $iniHander = new MobileIni( $front , $config['shorthand'] , $this->func );
			        $iniRunEnd = $iniHander->getError();
					if( $iniRunEnd['msg'] != 'true' ) {
						die(json_encode(new Result(false, 152 , $iniRunEnd['msg'] , null)));
					}
    				return true;
                }
            }
    	}
    	return '模版安装失败,请重试。';
    }
	//获取移动端管理功能列表
    public function getMobileFunction() {
    	$data = array();
		$data['mobile'] = array(
			array('id'=>1,'name'=>'模版管理','description'=>'可在线下载手机网页模板，也可由第三方定制模板，通过模板上传功能上传到网站上使用。实现一键更换模板功能，让您的手机网页随心而变，紧跟最主流的互联网移动网页设计需求。','func'=>'template'),
			array('id'=>2,'name'=>'导航管理','description'=>'可对网站上定义的导航进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'nav'),
			array('id'=>3,'name'=>'单张图片管理','description'=>'可对网站上定义的单张图片进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'pic'),
			array('id'=>4,'name'=>'轮播图片管理','description'=>'可对网站上定义的轮播图片进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'scroll'),
		);
		$data['app'] = array(
			array('id'=>1,'name'=>'模版管理','description'=>'可在线下载手机网页模板，也可由第三方定制模板，通过模板上传功能上传到网站上使用。实现一键更换模板功能，让您的手机网页随心而变，紧跟最主流的互联网移动网页设计需求。','func'=>'template'),
			array('id'=>2,'name'=>'导航管理','description'=>'可对网站上定义的导航进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'nav'),
			array('id'=>3,'name'=>'单张图片管理','description'=>'可对网站上定义的单张图片进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'pic'),
			array('id'=>4,'name'=>'轮播图片管理','description'=>'可对网站上定义的轮播图片进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'scroll'),
			array('id'=>5,'name'=>'安卓手机应用在线生成','description'=>'自动的进行安卓apk文件的打包和下载','func'=>'download'),
		);
		$data['wechat'] = array(
			array('id'=>1,'name'=>'模版管理','description'=>'可在线下载手机网页模板，也可由第三方定制模板，通过模板上传功能上传到网站上使用。实现一键更换模板功能，让您的手机网页随心而变，紧跟最主流的互联网移动网页设计需求。','func'=>'template'),
			array('id'=>2,'name'=>'导航管理','description'=>'可对网站上定义的导航进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'nav'),
			array('id'=>3,'name'=>'单张图片管理','description'=>'可对网站上定义的单张图片进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'pic'),
			array('id'=>4,'name'=>'轮播图片管理','description'=>'可对网站上定义的轮播图片进行自由的更换，即便没有程序员的介入，也可对网站模板进行个性化的设置。','func'=>'scroll'),
		);
        echo json_encode(array('rows' => $data[ $_REQUEST['func'] ] ,'ttl'  => count($data[ $_REQUEST['func'] ])));
    }
	//获取移动端模版管理功能列表
    public function getMobileTemplateFunction() {
		$data = array(
			array('id'=>1,'name'=>'手机网页管理','description'=>'生成并管理手机网页，可一键更换界面风格，更改导航和网页上的图片，满足各种个性化的手机网页风格需求。无需找第三方建站平台，无需技术人员，即可让医院在移动互联网时代能拥有自己的移动营销站点。','func'=>'mobile'),
			array('id'=>2,'name'=>'安卓手机应用管理','description'=>'生成并管理安卓移动应用界面效果，可一键更换界面风格，更改导航和图片，满足各种个性化的界面需求；可在线根据需求自动打包生成医院自己的手机APP，上传到医院官网和腾讯，360等应用市场，供千万网民下载；医院通过APP能随时将医院的最新活动发送给安装用户，用户也能随时通过APP获取医院的诊疗服务。','func'=>'app'),
			array('id'=>3,'name'=>'微站管理','description'=>'生成并管理微信微站，可一键更换界面风格，更改导航和图片，无需找第三方建站平台，无需技术人员，即可拥有属于医院自身风格的微站界面，向4亿微信用户SHOW出自己。','func'=>'wechat')
		);
        echo json_encode(array('rows' => $data,'ttl'  => count($data)));
    }
    //APK下载
    public function getDownload() {
    	//http://www.boyicms.com/interface/hma/ApkInterface.php?action=downloadApk
    	//http://10.0.0.189:8000/interface/hma/ApkInterface.php?action=predownApk
    	$url=$this->apkurl."?action=predownApk";
    	$str='';
    	if(isset($_REQUEST['img']) && $_REQUEST['img'] != ''){
    		$img=ABSPATH."/upload/".$_REQUEST['img'];
    		$str = base64_encode(file_get_contents($img));
    		
    		//unlink($img);
    	}
    	
    	$post_data=array(
    			'from'=>$_REQUEST['from'],
    			'apk_type'=>$_REQUEST['apk_type'],
    			'domain'=>trim($_REQUEST['domain']),
    			
    			//'version'=>$_REQUEST['version'],
    			'app_name'=>trim($_REQUEST['app_name']),
    			'img_logo'=>$str,
    	);
    	
    	$result=$this->send_post($url,$post_data);
    	
    	echo $result;
//     	$results=json_decode($result,true);
//     	echo json_encode(new Result($results['status'], 0, $results['msg'], array('url'=>$results['url'])));
    }
    public function checkapk(){
    	$url=$this->apkurl."?action=checkapk";
    	$post_data=array(
    	'apk_type'=>$_REQUEST['apk_type'],
    	'domain'=>trim($_REQUEST['domain']),
    	
    	//'domain'=>'www.lalala.com',

    			);
    	$result=$this->send_post($url,$post_data);
    	echo $result;

    }
    //上传apk
    public function LocalUpload(){
    	$upload = false;

    	// 进入上传
    	if (isset($_FILES['Filedata'])) {
    		$file = $_FILES['Filedata'];
    		$updir = GENERATEPATH . 'apk';
    		if (! Io::ioMkDir($updir)) {
    			$this->dirMkError($updir);
    		}
    		// 上传大小限制
    		if ((int) $_FILES['Filedata']['size'] > Io::getApachePostMaxValue() * 1024 * 1024) {
    			die(json_encode(new Result(false, 181, ErrorMsgs::get(181), null)));
    		}
    		$zipFileName = $updir . '/' . $file['name'];
    		$tmpName = $file['tmp_name'];
    		if (is_uploaded_file($tmpName)) {
    			if (move_uploaded_file($tmpName, $zipFileName)) {
    				$upload = true;
    			}
    		}
    	}
    	if ($upload) {
    		$data = array(
    				'apk' => $zipFileName
    		);
    		die(json_encode(new Result(true, 0, '', $data)));
    	} else {
    		die(json_encode(new Result(false, 151, ErrorMsgs::get(151), null)));
    	}

    }
    //获取医院域名
    public function getDomain(){
    	$domain=$_SERVER['HTTP_HOST'];
    	echo json_encode(new Result(true, 0, '', array('domain'=>$domain)));
    }
    //获取apk类型
    public function getApkType() {
    	$url=$this->apkurl.'?action=getApkTypes';
    	$data = json_decode(file_get_contents($url),true);
    	echo json_encode(new Result(true, 0, '', $data));
    }

    //判断本地文件是否存在
    public function getApkExist() {
        $hm='../apk/hm_1.0.apk';
        $hma='../apk/hma_1.0.apk';

    	$url=$this->apkurl."?action=apkexist";
    	$post_data=array(
    	'apk_type'=>$_REQUEST['apk_type'],
    	'domain'=>trim($_REQUEST['domain']),
    			);
    	$result=$this->send_post($url,$post_data);
//     	echo $result;
//     	exit();
$theresu=json_decode($result,true);

if(file_exists($hma)){
	if($theresu[hma]==1){
	$hmares = '您己生成了该APK，并己下载到网站服务器';
	}else{
		$hmares = '该APK己下载到您的网站服务器，但没有该生成记录，请确认域名是否有更改';
	}
}else{
	if($theresu[hma]==1){
		$hmares = '您己生成过该APK，但未下载';
	}else{
		$hmares = '当前服务端没有您生成该APK的记录，网站服务器也没有下载该APK';
	}
}

    if(file_exists($hm)){
	if($theresu[hm]==1){
	$hmres = '您己生成了该APK，并己下载到网站服务器';
	}else{
		$hmres = '该APK己下载到您的网站服务器，但没有该生成记录，请确认域名是否有更改';
	}
}else{
	if($theresu[hm]==1){
		$hmres = '您己生成过该APK，但未下载';
	}else{
		$hmres = '当前没有该APK的生成记录，站点服务器也没有下载该APK';
	}
}




        echo json_encode(array('hma'=>$hmares,'hm'=>$hmres));
    }

    //获取apk版本
    public function getVersion() {
    	$url=$this->apkurl.'?action=getAllVersions&type='.trim($_REQUEST['type']);
    	$data = json_decode(file_get_contents($url),true);
    	echo json_encode(new Result(true, 0, '', $data));
    }
    /**
     * 发送post请求
     * @param string $url 请求地址
     * @param array $post_data post键值对数据
     * @return string
     */
    function send_post($url, $post_data) {

    	$ch = curl_init();
    	$timeout = 60000*10;
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    	$result = curl_exec($ch);
    	curl_close($ch);
    	return $result;
    }
}

