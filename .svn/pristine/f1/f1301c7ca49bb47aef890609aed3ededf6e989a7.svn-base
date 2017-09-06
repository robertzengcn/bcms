<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 医疗联合体
 * @author Administrator
 *
 */
class unionMobile extends Mobile {
	
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
	 * 在线问答
	 */
	public function index(){
        //注入科室
        $departments = $this->getServiceMethod('department','query',array());
        $this->smarty->assign('department',$departments->data);
        
        $seo = $this->getServiceMethod('Seo','query',array("flag" => "ask"));
        $this->smarty->assign('seo',$seo->data[0]);
		$this->smarty->display( 'Ask/index' . TPLSUFFIX );
	}
	
	
	/**
	 *
	 * 在线问答列出详细内容
	 */
	public function query(){
		
		$article = $this->getServiceMethod('channelArticle','query',array('subject'=>'医疗联合体简介'));//获取医疗联合体简介
		$channel = $this->getServiceMethod('channel','query',array('shortname'=>'chengyuandanwei'));//查询成员单位
		if(!empty($channel->data)){
			$channelarticles = $this->getServiceMethod('channelArticle','query',array('channel_id'=>$channel->data['0']->id));//获取医疗联合体简介
		    
		}
		
		
		if(!empty($article->data)){
			
			$this->smarty->assign('subject',$article->data['0']->subject);
			$this->smarty->assign('content',$article->data['0']->content);
		}else{
			$this->smarty->assign('subject','');
			$this->smarty->assign('content','');
		}
		

		$this->smarty->assign('list',$channelarticles->data);
	    $this->smarty->display( 'Union/index' . TPLSUFFIX );
	}

 
}
new unionMobile();

?>