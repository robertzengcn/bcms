<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 在线问答
 * @author Administrator
 *
 */
class askMobile extends Mobile {
	
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
	public function get(){
	    
        $this->smarty->assign( 'data' , $this->result->data ); 
	    $this->smarty->display( 'Ask/detail' . TPLSUFFIX );
	}

    /**
     *在线问答保存
     *
     */
    public function save(){
        if($this->result->statu){
            echo('<script>alert("提交成功，请等待专家回复！");window.history.back();</script>');
        }else{
            echo('<script>alert("提交失败，请刷新页面重试！");window.history.back();</script>');
        }
    }
    
    /*
     * 获取我的问题列表
     * */
    public function myquestion(){
    	
    	if(isset($_SESSION['user'])&&$_SESSION['user']){
    		
    		$askser=new AskService();
    		$myquestionnum=$askser->getquestionnum($_SESSION['member_id']);
    		$answerquestion=$askser->getquestionansw($_SESSION['member_id']);
    		$unanseerquestion=$myquestionnum-$answerquestion;
    		$this->smarty->assign( 'unanseerquestion' , $unanseerquestion);
    		$this->smarty->assign( 'answerquestion' , $answerquestion);
    		$this->smarty->assign( 'questionnum' , $myquestionnum);
    		$this->smarty->display( 'Ask/list' . TPLSUFFIX );
    	}else{
    		echo '用户未登陆';exit();
    	}    	    	
    }
    
    /*
     * 问题详情 
     * */
    public function askdetail(){
    	if(isset($_SESSION['user'])&&strlen($_SESSION['user'])>0){
    		if(isset($_REQUEST['id'])&&$_REQUEST['id']){
    			$id=(int)$_REQUEST['id'];
    			$askdetail = $this->getServiceMethod('Ask','getAsk',$id);
    			if($askdetail!=null){
    				$askdesc=$this->getServiceMethod('AskDesc','getaskbyid',$id);
    				$plushtime=date('Y-m-d H:i:s',$askdetail->plushtime);
    				$this->smarty->assign( 'pulshtime' , $plushtime);
    			$this->smarty->assign( 'description' , $askdesc->description);
    			$this->smarty->assign( 'subject' , $askdetail->subject);
    			
    			$this->smarty->display( 'Ask/detail' . TPLSUFFIX );
    			}else{
    				echo '你找的问题不存在';
    			}
    		}
    		
    	}else{
    		echo '用户未登陆';exit();
    	}
    }
}
new askMobile();

?>