<?php
/**
 * 
 * 总控问题追问推送接口
 * @author Administrator
 * @version v1.0
 * @internal 本接口由总控中心进行调用
 * @example 该接口为被动触发接口
 * @example 
 */
include './common.class.php';
class addto extends common {
	private $params = array(
		'domain'      	=> array('check'=>true,'info'=>'通信域名'),
		'question_id'	=> array('check'=>true,'info'=>'总控问题ID'),
		'sign'        	=> array('check'=>true,'info'=>'通信加密字符串'),
		'time'        	=> array('check'=>true,'info'=>'通信加密时间戳'),
	
		'content'     	=> array('check'=>true,'info'=>'追问内容'),
		'parent_id'     => array('check'=>true,'info'=>'CMS问题ID'),
		'add_id'        => array('check'=>true,'info'=>'追问回复ID(某条追问的回复ID)'),
	);
	public $posts = array();
	
	public function __construct() {
		parent::__construct();
		$this->voluation();
		parent::signCheck();
		$this->addSave();
	}
	
	private function addSave() {
		$service = new AskAddtoService();
		$addto   = new AskAddto();
		$addto->mode   = 1;//追问
		$addto->ask_id = $this->posts['parent_id'];
		//通过ask_id取ans_id
		$result = R::findOne('answer','ask_id = '.$addto->ask_id);
		$addto->ans_id = $result->id;
		$addto->info   = $this->posts['content'];
		$addto->plushtime   = time();
		$addto->useful  = 0;
		$addto->useless = 0;
		$addto->add_id  = $this->posts['add_id'];
		//获取是否存在一摸一样的info信息，存在则证明重复追问了
		$result = R::findOne('askaddto',"info = '".$addto->info."'");
		if( is_object( $result ) ) {
			parent::msgPut(3, '存在相同的追问信息！' , null );
		}else{
			$BIND    = $service->addto($addto);
			parent::msgPut(true, '问题追问成功!' , null );
		}
	}
	
	private function voluation() {
		foreach ( $this->params as $key => $value ) {
			if( isset( $_REQUEST[$key] ) && $_REQUEST[$key] != '' ) {
				$this->posts[$key] = trim( $_REQUEST[$key] );
			}else{
				if( $value['check'] === true ) {
					parent::msgPut(0, '参数缺失：'.$value['info'].':'.$key, null);
				}else{
					$this->posts[$key] = '';
				}
			}
		}
	}
	
	public function __destruct() {
		unset($this->params);
	}
}
new addto();