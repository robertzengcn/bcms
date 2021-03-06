<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 先进设备(先进设备)
 * @author Administrator
 *
 */
class channelMobile extends Mobile {
	
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
	 * 个性频道动态列表
	 */
	public function query() {
		$param = array();
		if(isset($_REQUEST['channel_id']) && $_REQUEST['channel_id'] != ''){
			$param['channel_id'] = (int)$_REQUEST['channel_id'];
		}
		$list = $this->getServiceMethod('channelArticle','getByChannelID',$param);
		$this->result['data']  = $list->data;
		$this->result['ttl']   = count($list->data);
		
		$param['show_position'] = $this->getShowPositionStr(PROJECT_NAME); //获取特定显示数据
		$this->pageSetting( 10 ,'channel','channelArticle',$param,'getByChannelID');//分页式列表
		$moreParam="";
		if(isset($_REQUEST['channel_id']) && $_REQUEST['channel_id'] != ''){
			$moreParam.="&channel_id=".$param['channel_id'];
		}
		$this->smarty->assign('moreParam',$moreParam);
		$this->smarty->assign('channel_id',$param['channel_id']);
		$this->smarty->display( 'Channel/list' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 个性频道文章详情详情
	 */
	public function get() {
		$this->smarty->assign('channel_id',(int)$_REQUEST['channel_id']);
		$this->smarty->assign('id',(int)$_REQUEST['id']);
		$this->smarty->display( 'Channel/detail' . TPLSUFFIX );
	}
	
}

new channelMobile();
?>