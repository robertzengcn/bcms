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
			$this->smarty->assign('channel_id',(int)$_REQUEST['channel_id']);
			
		}
		$channel = $this->getServiceMethod('channel','query',array('id'=>(int)$_REQUEST['channel_id']));//取个性频道属性
		if(!empty($channel->data)){
		$this->smarty->assign('data',$channel->data['0']);
		}else{
			echo '没有找到页面';
			exit();
		}
		$list = $this->getServiceMethod('channelArticle','getByChannelID',$param);
		
		
// 		$channeldetail = $this->getServiceMethod('channel','getchannelbyid',$param);
// 		if(!empty($channeldetail->data)){
// 			$this->smarty->assign('channelname',$channeldetail->data['name']);
// 		}else{
// 			$this->smarty->assign('channelname','');
// 		}
		if(!is_array($this->result)){
			unset($this->result);
		}
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
		if(!isset($_REQUEST['id'])&&strlen($_REQUEST['id'])<1){
			echo '缺少参数';
			exit();
		}
		$channelarticle = $this->getServiceMethod('channelarticle','query',array('id'=>(int)$_REQUEST['id']));
	if(!empty($channelarticle->data)){
		
	
		$channel=$this->getServiceMethod('channel','getchannelbyid',array('id'=>$channelarticle->data['0']->channel_id));
		
		$this->smarty->assign('channel_id',$channelarticle->data['0']->channel_id);			
		if($channel->data!=null){
			$this->smarty->assign('channel',$channel->data);
		}
		
		$this->smarty->assign('data',$channelarticle->data['0']);
		
		$this->smarty->display( 'Channel/detail' . TPLSUFFIX );
	}else{
		header("HTTP/1.1 404 Not Found");
		
		header("Status: 404 Not Found");
		
		exit();
	}
	}
	
}

new channelMobile();
?>