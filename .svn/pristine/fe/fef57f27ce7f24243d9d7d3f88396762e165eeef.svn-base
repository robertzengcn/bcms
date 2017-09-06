<?php
#.文件载入
ob_start();
require_once $_SERVER ['DOCUMENT_ROOT'] . '/web-setting.php';
require_once DAOPATH . '/ORMMap.php';
require_once KERNELPATH . '/Result.php';
require_once KERNELPATH . '/ErrorMsgs.php';
require_once KERNELPATH . '/LogMsgs.php';
require_once KERNELPATH . '/FilterService.php';
require_once DAOPATH . '/DTExpression.php';
require_once DAOPATH . '/DTOrder.php';
require_once ABSPATH . '/controller/mobile/Controller.php';
require_once ABSPATH . '/lib/FirePHPCore/fb.php';
require_once ABSPATH . '/lib/FirePHPCore/FirePHP.class.php';

/**
 * 
 * 手机端入口方法
 * @author Administrator
 *
 */
class ActionController {
	
	#.过滤列表
	protected $filters = Array ();
	
	/**
	 * 
	 * 构造方法
	 */
	function __construct() {
		
		@session_start ();
		$firephp = FirePHP::getInstance(true);
		$firephp->setEnabled(true);  //firephp调试状态
	}
	
	/**
	 * 
	 * 入口执行
	 */
	public function excute() {
		
		#.判断
		if ((! isset ( $_REQUEST ['controller'] )) || $_REQUEST ['controller'] == NULL || strlen ( $_REQUEST ['controller'] ) == 0) {
			return new Result ( false, - 1, ErrorMsgs::get ( - 1 ), Null );
		}
		#.载入对应的控制器
		$controllerClassName = $_REQUEST ['controller'] . 'Controller';
		$file_path = ABSPATH . '/controller/mobile/' . $controllerClassName . '.php';
		if (! file_exists ( $file_path )) {
			return new Result ( false, 1, ErrorMsgs::get ( 1 ), NULL );
		}
		require_once $file_path;
		#.执行控制器中的过滤方法
		$controller = new $controllerClassName ();
		
		$result = $controller->filter ();
		if (! $result->statu) {
			return $result;
		}
		#.执行控制器中的入口方法
		return $controller->excute ();
	}
}
//开启自动绑定功能
spl_autoload_register ( array (
		'Controller',
		'load' 
) );

		


