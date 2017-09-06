<?php
/**
 * 
 * cms问题回答提交接口
 * @author Administrator
 * @version v1.0
 * @internal 本接口由cms调用,向总控中心进行新问题提交
 * @example 该接口在问题被回答后,进行触发传送
 */
require_once '../InterfaceAbstract.php';
class AnswerGet extends InterfaceAbstract {
	
	private $post_url = 'http://www.boyicms.com/interface/hma/OnlineInterface.php';
	
	//构造函数
	public function __construct( $answer , $mode = 'answer' ) {
		//首次回复
		if( $mode == 'answer' ) {
			if ( isset( $answer->id ) ) {
				$Distribute = $this->getDistributeID( $answer->askID );
				if( $Distribute !== false ) {
					$this->postAnswer( $answer , $Distribute );
				}
			}
			return false;
		//追问回复
		}else{
			//必须为回复,1为系统追问则不行
			if( $answer->mode == 0 ){
				$Distribute = $this->getDistributeID( $answer->askID );
				if( $Distribute !== false ) {
					$this->poatAddAnswer( $answer , $Distribute );
				}
			}else{
				return false;
			}
		}
	}
	
	public function _begin(){}
	
	//该问答ID是否存在于分发日志当中
	public function getDistributeID( $askID ) {
		$result = R::findOne('interface_ask','ask_id = '.$askID);
		if( ! is_object( $result ) ){
			return false;
		}
		return $result;
	}
	
	//进行追问回复操作（回复追问）
	public function poatAddAnswer( $addTo , $Distribute ){
		$data = array();
		$data['type'] 		 = 'online_reply';
		$data['question_id'] = $Distribute->question_id;
		$data['reply']       = $addTo->info;
		$data['doctor_id']   = '1';//医生ID
		$data['doctor_name'] = '默认';//医生姓名
		$data['img_url']     = '';//医生主页
		$data['position']    = '';//医生职称
		$data['add_id']      = $addTo->id;//因为是首次回复,所以“回复追问ID”为0即可
		$data['parent_id']   = $Distribute->ask_id;//问题ID
		$data['hospital']    = $Distribute->source_hospital;
		$data = $this->get_doctor_info( $data , $Distribute->ask_id );//进行信息补全
		$part = json_encode( $data );
		$url  = $this->post_url . '?part=' . $part;
		$result = @file_get_contents( $url );
		$reply  = json_decode( $result , true );
		if( $reply['online_reply'] == 'yes' ) {
			return true;
		}else{
			return false;
		}
	}
	
	//进行回复操作(回复首次)
	public function postAnswer( $anwer , $Distribute ) {
		$data = array();
		$data['type'] 		 = 'online_reply';
		$data['question_id'] = $Distribute->question_id;
		$data['reply']       = $anwer->content;
		$data['doctor_id']   = '1';//医生ID
		$data['doctor_name'] = '默认';//医生姓名
		$data['img_url']     = '';//医生主页
		$data['position']    = '';//医生职称
		$data['add_id']      = 0;//因为是首次回复,所以“回复追问ID”为0即可
		$data['parent_id']   = $Distribute->ask_id;//问题ID
		$data['hospital']    = $Distribute->source_hospital;
		$data = $this->get_doctor_info( $data , $Distribute->ask_id );//进行信息补全
		$part = json_encode( $data );
		$url  = $this->post_url . '?part=' . $part;
		$result = @file_get_contents( $url );
		$reply  = json_decode( $result , true );
		if( $reply['online_reply'] == 'yes' ) {
			$sql = "UPDATE `interface_ask` SET `is_reply`=1,`reply_time`='".time()."' WHERE `id`='".$Distribute->id."'";
			R::exec($sql);
			return true;
		}
	}
	
	
	//回复&追问恢复,取医生信息用
	private function get_doctor_info( $data , $ask_id ){
		new AnswerService();
		//取回复次数
		$result = R::findAll('askaddto',' WHERE `ask_id`=' . $ask_id);
		$addtoc = count( $result );
		$data['reply_num']   = $addtoc + 1;
		//取普通信息
		new AskService();
		$result = R::findOne('doctor',' ORDER BY RAND() LIMIT 1');
		if( is_object( $result ) ){
			$data['doctor_id']   = urlencode( NETADDRESS .'/mobile/doctor.php?method=get&id=' . $result->id );
			$data['doctor_name'] = $result->name;
			$data['position']    = $result->position == '' ? '未知' : $result->position;
			$data['img_url']     = urlencode( UPLOAD . $result->pic );
			return $data;
		}
		return $data;
	}
	
}