<?php
//载入入口文件
include_once 'init.php';

/**
 * 
 * 疾病资讯
 * @author Administrator
 *
 */
class articleMobile extends Mobile {
	
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
	 * 根据条件获取所有疾病资讯
	 * @request department_id 科室id
	 * @request page 第几页
	 * @request size 每页多少条
	 */
	public function query() {
		$param = array();
		if(isset($_REQUEST['disease_id']) && $_REQUEST['disease_id'] != ''){
			$param['disease_id'] = (int)$_REQUEST['disease_id'];
		}
        if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
            $param['department_id'] = (int)$_REQUEST['department_id'];
        }
        $param['show_position'] = $this->getShowPositionStr(PROJECT_NAME); //获取特定显示数据
        $list = $this->getServiceMethod('Article','query',$param);
        //print_r($list);exit();
        if(!is_array($this->result)){
        	unset($this->result);
        }
        $this->result['data']  = $list->data;
        $this->result['ttl']   = count($list->data);
		$this->pageSetting( 6 ,'article','article',$param);//分页式列表
		if(isset($_REQUEST['disease_id']) && $_REQUEST['disease_id'] != ''){
			$this->smarty->assign('moreParam','&disease_id='.$param['disease_id']);
		}
        if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
            $this->smarty->assign('moreParam','&department_id='.$param['department_id']);
        }
		$this->smarty->display( 'Article/list' . TPLSUFFIX );
	}
	
	/*
	 * 科室文章列表
	 */
	public function arcbydep() {
		$param = array();
		if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
			$param['department_id'] = (int)$_REQUEST['department_id'];
		}
		$param['size']=6;//设置每页显示多少个
		if(isset($_REQUEST['page'])&&$_REQUEST['page']){
			$param['page']=(int)$_REQUEST['page'];

		}else{
			$param['page']=1;
			
		}

		$param['show_position'] = $this->getShowPositionStr(PROJECT_NAME); //获取特定显示数据
		$list = $this->getServiceMethod('Article','query',$param);
		$totalnum = $this->getServiceMethod('Article','totalRows',$param);
		
		$pageCount=ceil($totalnum->data/$param['size']);//总共多少页
		
		$this->smarty->assign( 'url' , 'article');
		$this->smarty->assign( 'list' , $list->data);
		$this->smarty->assign( 'page' , $param['page']);
		$this->smarty->assign( 'pageCount' , $pageCount);	
		
		
		if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] != ''){
			$this->smarty->assign('moreParam','&department_id='.$param['department_id']);
		}
		
		$this->smarty->assign('id',(int)$_REQUEST['department_id']);
		$this->smarty->display( 'Article/arcbydep' . TPLSUFFIX );
	}
	
	/**
	 * 
	 * 通过id获取对应的文章信息
	 */
	public function get() {
		//取推荐阅读
		$this->getRecommend('article','article','subject');
		//注入上一条与下一条
		$this->getNextAndLast( 'article' , 'article' , 'subject' );
		$this->smarty->assign('data',$this->result->data);
		$this->smarty->display('Article/detail' . TPLSUFFIX);
	}
	
	/**
	 * 
	 * 通过疾病id获取对应的文章信息
	 */
	public function getDisease() {
		if(isset($_REQUEST['diseaseID']) && $_REQUEST['diseaseID'] != ''){
			$diseaseID = (int)trim($_REQUEST['diseaseID']);
			$disease_article = $this->getServiceMethod('article','query',array('disease_id'=>$diseaseID,'page'=>1,'size'=>10));
			$i = 0;
			$html = '<ul class="list3">';
			//图文
			foreach($disease_article->data as $key => $value){
				if( $value->pic != '' && isset( $value->pic )) {
					$html .= '<li class="sick_look"><a href="/'.PROJECT_NAME.'/article.php?method=get&id='.$value->id.'"><img  src="'.UPLOAD.$value->pic.'" alt="'.$value->subject.'" width="114" height="75" />';
					$html .= '<p>'.mb_substr(strip_tags($value->content),0,70,'utf-8').'...<span class="txt">[详细]</span></p></a>';
					$html .= '</li>';
					break;
				}
			}
			//列表
			$html .= '</ul>';
			$html .= '<ul class="list" id="listId1">';
			for($i=0;$i<3;$i++){
				$html .= '<li><a href="/'.PROJECT_NAME.'/article.php?method=get&id='.$disease_article->data[$i]->id.'">'.$disease_article->data[$i]->subject.'</a></li>';
			}
			$html .= '</ul>';
			//更多按钮
			$html .= '<div class="bottom"><a href="/'.PROJECT_NAME.'/article.php?method=query&disease_id='.$disease_article->data[0]->disease_id.'">查看更多内容&gt;&gt;</a></div>';
			die( json_encode( array('html'=>$html) ) );
		}
	}
	
}

new articleMobile();
?>