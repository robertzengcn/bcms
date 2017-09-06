<?php

/**
 * 
 * 在线问答对外开放接口抽象文件
 * @author Administrator
 *
 */
abstract class Base {
	/**
	 * 
	 * 验证数据来源是否正确,比如说来源路径、参数中的token'等
	 */
	abstract public function validate();
	
	/**
	 * 
	 * 提问问题(推送)
	 */
	abstract public function question();
	
	/**
	 * 
	 * 回答问题(推送)
	 */
	abstract public function answer();
	
	/**
	 * 
	 * 接收问题(接收)
	 */
	abstract public function receive();
	
	/**
	 * 
	 * 数据解析方法，用于处理receive接收数据带来的解析问题
	 * 可能是需要处理xml、json或者txt等
	 */
	abstract public function analyze();
	
	/**
	 * 
	 * 数据提交方法,用于进行模拟post传送数据
	 * @param unknown_type $url
	 * @param unknown_type $timeout
	 */
	static public function curlPost( $url , $timeout = 30) {
	    $ch = curl_init();
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout );
	    curl_setopt($ch, CURLOPT_URL, $url );
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect: ') );
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4) ;
	    $remote_result = curl_exec( $ch );
	    if ( curl_errno($ch) ) { $remote_result = 0;}
	    curl_close( $ch );
	    return $remote_result;
	}
	
	/**
	 * 
	 * 日志记录方法,记录推送或者接收日志
	 */
	static public function log() {
		return true;
	}
}
?>