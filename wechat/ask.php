<meta charset="utf-8">
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
        $departments = $this->getServiceMethod('Department','query',array());
        $this->smarty->assign('department',$departments->data);
		$this->smarty->display( 'Ask/index' . TPLSUFFIX );
	}
	
	
	/**
	 *
	 * 在线问答列出详细内容
	 */
	public function get(){
	    fb($this->result->data,'$this->result->data');
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
}
new askMobile();

?>