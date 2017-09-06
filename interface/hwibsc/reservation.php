<?php
/**
 * 
 * cms预约接口
 * @author Administrator
 * @version v1.0
 * @example 该接口在进行预约后,由总控中心发起预约接口
 */
require_once '../InterfaceAbstract.php';

class ReservationHwibsc extends InterfaceAbstract {
	
	public $posts = array();
	

	
	private $params = array(
		'domain'      	   => array('check'=>true,'info'=>'通信域名'),
		'reservation_id'   => array('check'=>true,'info'=>'总控预约ID'),
		'sign'        	   => array('check'=>true,'info'=>'通信加密字符串'),//false要修改
		'time'        	   => array('check'=>true,'info'=>'通信加密时间戳'),//false要修改
		'time_id' 	       => array('check'=>true,'info'=>'预约时间点ID'),
	    'time_field' 	       => array('check'=>true,'info'=>'预约具体时间'),
		'username'     	   => array('check'=>true,'info'=>'预约人姓名'),
		'age' 	           => array('check'=>true,'info'=>'年龄'),
		'sex' 		  	   => array('check'=>true,'info'=>'性别'),
		'telephone' 	   => array('check'=>true,'info'=>'联系电话'),
		'card'			   => array('check'=>false,'info'=>'预约人身份证号'),
		'email'			   => array('check'=>false,'info'=>'电子邮箱'),
		'address'   	   => array('check'=>false,'info'=>'联系地址'),
		'ill' 	  		   => array('check'=>false,'info'=>'预约留言'),
	);
	
	//构造函数
	public function __construct() {
		parent::__construct();
	}
	
	public function _begin()
	{
	    $this->voluation();
	     
	    //这里暂时注释，上线时开启
	    $this->queryRes();
	}
	
	//查询time_id值是否正确
	private function queryRes() {
		new ReservationService();
		$find = R::findOne('reservation','id = '.$this->posts['time_id'].' and state=0');
		
		if( is_object( $find ) ) {
			if( ($find->along-$find->mark) < 1 ) {
				$this->msgPut(4, '该预约时间段已经无号了', null);
			}else{
				$this->runRes( $find );
			}
		}else{
			$this->msgPut(3, 'time_id对应的预约信息不存在', null);
		}
		
		$this->msgPut(true, '预约成功!' , null );
	}
	
	//实际预约功能
	private function runRes( $resInfo ) {
 		$resInfo->dateform=date('Y-m-d',$resInfo->date);
		$resInfo->times=strtotime($resInfo->dateform.' '.$this->posts['time_field']);
       
      $ressql="INSERT INTO `reservationdetail`(`department_id`,`doctor_id`,`date`,`times`,`statu`,`username`,`telephone`,`card`) VALUES (:department_id,:doctor_id,:date,:times,'待约',:username,:telephone,:card)";
       $resarray=array('department_id'=>$resInfo->department_id,
       		'doctor_id'=>$resInfo->doctor_id,
       		'date'=>$resInfo->date,
       		'times'=>$resInfo->times,
       		'username'=>$this->posts['username'],
       		'telephone'=>$this->posts['telephone'],
       		'card'=>$this->posts['card']
       );
       
       R::exec($ressql,$resarray);
       		
		$sql = "INSERT INTO `reseruser` (`name`,`sex`,`age`,`date`,`time`,`address`,`hometel`,`email`,`ill`,`reservation_id`,`reservation_fid`) VALUES (
		:name,:sex,:age,
		:date,:time,:address,:hometel,:email,
		:ill,:reservation_id,:reservation_fid
		)";
		$arrresuser=array('name'=>$this->posts['username'],
				'sex'=>$this->posts['sex'],
				'age'=>$this->posts['age'],
				'date'=>$resInfo->date,
				'time'=>$resInfo->times,
				'address'=>$this->posts['address'],
				'hometel'=>$this->posts['telephone'],
				'email'=>$this->posts['email'],
				'ill'=>$this->posts['ill'],
				'reservation_id'=>$this->posts['reservation_id'],
				'reservation_fid'=>$this->posts['time_id']				
		);
		
		
		
		R::exec($sql,$arrresuser);
	}
	
	private function voluation() {
		
// 		$filename=time();
		
// 		$apk_url = dirname(__FILE__) . "/oldfile_".$filename.".txt";
		
		
// 		$myfile = fopen( $apk_url, "w") or die("Unable to open file!");
// 		$txt = date('Y-m-d H:i:s',time());
		
// 		fwrite($myfile, $txt);
// 		$s = print_r($_REQUEST, true);
// 		fwrite($myfile, $s);
// 		fclose($myfile);
		foreach ( $this->params as $key => $value ) {
			if( isset( $_REQUEST[$key] ) && $_REQUEST[$key] != '' ) {
				$this->posts[$key] = trim( $_REQUEST[$key] );
			}else{
				if( $value['check'] === true ) {
					$this->msgPut(0, '参数缺失：'.$value['info'].':'.$key, null);
				}else{
					$this->posts[$key] = '';
				}
			}
		}
	}
	
}
new ReservationHwibsc();