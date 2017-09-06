<?php
/**
 * 
 * 总控问题分发接收接口
 * @author Administrator
 * @version v1.0
 * @internal 本接口由总控中心进行调用
 * @example 该接口为被动触发接口
 * @example http://127.0.0.1/interface/hwibsc/distribute.php?name=Libin&description=Dont&subject=mYsubject&domain=www.boyicms.com&time=1428463630&sign=ba0c978b7f8708d918b9f9a8f931047d&source_domain=www.baidu.com&question_id=2300&age=10
 */
include './common.class.php';
class distribute extends common {
	private $params = array(
		'domain'      	=> array('check'=>true,'info'=>'通信域名'),
		'source_domain'	=> array('check'=>true,'info'=>'问题来源域名'),
		'question_id'	=> array('check'=>true,'info'=>'总控问题ID'),
		'sign'        	=> array('check'=>true,'info'=>'通信加密字符串'),
		'time'        	=> array('check'=>true,'info'=>'通信加密时间戳'),
		'subject'     	=> array('check'=>true,'info'=>'问题标题'),
		'description' 	=> array('check'=>true,'info'=>'问题详细'),
		'name' 		  	=> array('check'=>true,'info'=>'提问者姓名'),
		'age' 		  	=> array('check'=>true,'info'=>'患者年龄'),
		'department'	=> array('check'=>true,'info'=>'问题所属科室'),
		'phone'   	  	=> array('check'=>false,'info'=>'提问者联系方式'),
		'gender' 	  	=> array('check'=>false,'info'=>'患者性别'),
		'history' 	  	=> array('check'=>false,'info'=>'患者患病历史'),
		'condtion' 	  	=> array('check'=>false,'info'=>'目前治疗情况'),
		'city' 	      	=> array('check'=>false,'info'=>'患者城市'),
		'assay_pic'   	=> array('check'=>false,'info'=>'化验单图片'),
		'pic'   	    => array('check'=>false,'info'=>'普通问题图片'),
		'source_hospital' => array('check'=>false,'info'=>'问题来源医院名称'),
	);
	public $posts = array();
	
	public function __construct() {
		parent::__construct();							    	    			    	   
		$this->voluation();
		parent::signCheck();						
		$this->addSave();
	}
	
	private function addSave() {				
		parent::bind($ask   = new Ask());//绑定ask对象
// 		$ask->departname    = $this->posts['department'];//手动绑定科室中文名称
// 		$ask->departmentID  = $this->getDepartID( $ask->departname );//通过中文科室名称,取对应的ID
		parent::bind($askDesc  = new AskDesc());//绑定askDesc对象		
		$askDesc->pic1      = $this->posts['pic'];//手动绑定图片1地址
		$askDesc->assay_pic = $this->posts['assay_pic'];//手动绑定化验单图片地址
		$askDesc->gender    = $askDesc->gender == '男' ?  1 : 0;//男1女0			
		parent::bind($askAssay = new AskAssay());//绑定AskAssay对象
		$serviceHandler = new AskService();
		$BIND = $serviceHandler->save($ask, $askDesc, $askAssay);
		if($BIND->statu){
			$this->setLog( $ask->id );
			parent::msgPut(true, '问题收入成功!' , null );
		}
	}
	
	private function getDepartID($name){
		new ArticleService();
		$result = R::findOne('department',"`name` = '{$name}'");
		return !is_object( $result ) ? 0 : $result->id;
	}
	
	private function setLog( $askID ) {
		$sql = "INSERT INTO `interface_ask` (`ask_id`,`question_id`,`is_reply`,`source_domain`,`add_time`,`domain`,`source_hospital`) VALUES (
			'".$askID."',
			'".$this->posts['question_id']."',
			0,
			'".$this->posts['source_domain']."',
			'".time()."',
			'".$this->posts['domain']."',
			'".$this->posts['source_hospital']."'
			);";
		RETURN R::exec( $sql );
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
new distribute();