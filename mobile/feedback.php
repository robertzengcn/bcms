<meta charset="utf-8">
<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 意见建议
 * @author Administrator
 *
 */
class feedbackMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param unknown_type $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}
	
	/**
	 * 
	 * 意见建议
	 */
	public function index(){
		
		$this->smarty->display( 'Feedback/index' . TPLSUFFIX );
	}
	
	
}
new feedbackMobile();

?>
