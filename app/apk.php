<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * apk
 * @author Administrator
 *
 */
class apkMobile extends Mobile {
	
	/**
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}
	
	/**
	 * 获取apk二维码
	 */
	public function getapk(){
		$domain = $_SERVER['HTTP_HOST'];
		$hma = '/apk/hma_1.0.apk';
		$filepath = '../apk/hma_1.0.apk';
		$url = "http://".$domain.$hma;
		if(file_exists($filepath)){
			//header("Location: /qrcode.php?url=$url");
			$this->smarty->assign( 'url' , $url);
		}else{
			$this->smarty->assign( 'url' , $url);
		}
		$char = '01234156789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$char = str_shuffle($char);
		$char = substr($char, 0, 7);
		$this->smarty->assign( 'char' , $char);
		$this->smarty->display( 'Apk/index' . TPLSUFFIX );
	}

}

new apkMobile();
?>