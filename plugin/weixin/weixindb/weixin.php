<?php
define("TOKEN", "boyicms");
header('Content-Type: text/html; charset=utf8');
	// 第一次验证：
	if($_GET['echostr']){
		$wechat = new WeChat(TOKEN);
		$wechat->firstValid();
		die();
	}
	// 处理威信公众平台的的消息（事件）
	require '../controller/index.php';
	require '../controller/WeixinController.php';
    $weixin = new WeixinController($_GET['tag']);
	$weixin->responseMSG();
/**
 * 微信公众平台操作类
 */
class WeChat {
	private $_token;                                  // 公众平台请求开发者时需要标记	
	public function __construct($token) {
		$this->_token = $token;
	}

	/**
	 * 用于第一次验证URL合法性
	 */
	public function firstValid() {
		if ($this->_checkSignature()) {					// 检验签名的合法性											
			echo $_GET['echostr'];                     // 签名合法，告知微信公众平台服务器
		}
	}
	/**
	 * 验证签名
	 * @return bool [description]
	 */
	private function _checkSignature() {
		$signature = $_GET['signature'];		// 获得由微信公众平台请求的验证数据
		$timestamp = $_GET['timestamp'];
		$nonce = $_GET['nonce'];
		$tmp_arr = array($this->_token, $timestamp, $nonce); 	// 将时间戳，随机字符串，token按照字母顺序排序并连接
		sort($tmp_arr, SORT_STRING);// 字典顺序
		$tmp_str = implode($tmp_arr);//连接
		$tmp_str = sha1($tmp_str);// sha1签名
		if ($signature == $tmp_str) {
			return true;
		} else {
			return false;
		}
	}
}