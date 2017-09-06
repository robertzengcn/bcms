<?php

/**
 *
 * 在线问答对外开放接口通知接收与发送文件
 * @author Administrator
 *
 */
class Notice {
	
	static $loadFile = array();
	static $putMode  = 'json';
	static $apiHand  = null;
	static $tipsCode = array(
		0 => '系统内部错误,信息编码不存在',
		1 => '系统内部错误,文件加载失败',
		2 => '缺少合作方标识符参数',
		3 => '引用方法不存在',
	);
	
	/**
	 *
	 * 构造方法,加载需要的php文件
	 */
	public function __construct( $coop = null ) {
		$baseUrl = rtrim ( $_SERVER ['DOCUMENT_ROOT'], '/' );
		//加载必须文件
		self::$loadFile[] = $baseUrl . '/web-setting.php';
		self::$loadFile[] = $baseUrl . '/lib/rb.php';
		self::$loadFile[] = $baseUrl . '/kernel/dao/ORMMap.php';
		self::$loadFile[] = $baseUrl . '/lib/Ask/Base.php';
		//加载网站api文件
		if( isset( $coop ) ) {
			$apiTag = ucwords( $coop );
		}else{
			return self::tipsMessage( 2 );
		}
		self::$loadFile[] = $baseUrl . '/lib/Ask/api/'. $apiTag . '.php';
		foreach ( self::$loadFile as $key => $fileName ) {
			if( file_exists( $fileName ) ){
				include_once $fileName;
			}else{
				return self::tipsMessage( 1 );
			}
		}
		self::$apiHand = new $apiTag();
	}
	
	/**
	 * 
	 * 方法引用,用于调用各网站的接口文件,处理数据等
	 * @param string $method
	 * @param array $parms
	 */
	public function __call( $method , $parms ) {
		if( ! method_exists( self::$apiHand , $method ) ) {
			return self::tipsMessage( 3 );
		}
		return self::$apiHand->$method( $parms );
	}
	
	/**
	 * 
	 * 提示信息输出
	 * @param int $code
	 */
	static function tipsMessage( $code = null ) {
		$code = is_null( $code ) ? 0 : $code;
		$trip = self::$tipsCode[$code];
		switch( strtolower( self::$putMode ) ){
			case 'json':
				return json_encode( array( 'statu' => $code , 'msg' => $trip ) );
				break;
			case 'xml':
				break;
			case 'txt':
				break;
			case 'html':
				break;
			default:
				break;
		}
	}

}
?>