<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 文章搜索(文章搜索)
 * @author Administrator
 *
 */
class searchMobile extends Mobile {
	
	/**
	 * 
	 * 构造方法,通过method方法,调取对应的输出函数
	 * @param string $method
	 */
	public function __construct() {
		parent::__construct();
		$this->excute();
	}
	
	/**
	 * 
	 * 搜索入口
	 */
	public function index() {
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != ''){
			$keyword = trim($_REQUEST['keyword']);
			$articles = $this->getServiceMethod('article','query',array('subject'=>$keyword));
			$this->smarty->assign('list',$articles->data);
			$this->smarty->assign('keyword',$keyword);
			$this->smarty->display('Article/search' . TPLSUFFIX );
		}else{
			$this->scriptUrl( NETADDRESS . '/'.PROJECT_NAME.'/' );
		}
	}
	
}

new searchMobile();
?>