<?php
/**
 * 
 * HMA专用数据获取接口
 * @author Administrator
 * @version v1.0
 */
require_once '../InterfaceAbstract.php';
class GetPart extends InterfaceAbstract {
	public function __construct() {
		parent::__construct();
	}
	
	public function _begin() {
	    if (!in_array($_REQUEST['method'], array('doctormanager_outpatient_time','configure_info','search_article','article_title','departmentmanager_list','department_doctormanager_list','department_doctor_list','dispatcher'))){//需要排除登录的接口
		    //总控验证用户方法
			$this->getRemoteUser();
		}
		
		if( isset( $_REQUEST['method'] ) &&  $_REQUEST['method'] != '' ) {
			$method = 'get_' . trim( $_REQUEST['method'] );
			if ( method_exists( $this , $method ) ) {
				$this->$method();
			}else{
				die( json_encode( array( 'code'=>1,'msg'=>'method参数错误,不存在该调用接口!','departments'=>null ) ) );
			}
		}else{
			die( json_encode( array( 'code'=>1,'msg'=>'method参数为空!','departments'=>null ) ) );
		}
	}
	
	#.查询文章
	private function get_article_info(){
		$id = isset( $_REQUEST['articleId'] ) && $_REQUEST['articleId'] >=1 ? $_REQUEST['articleId'] : 0;
		if( $id <= 0 ){
			die( json_encode( array( 'code'=>1,'msg'=>'ID不能为空!','data'=>null ) ) );
		}
		new ArticleService();
		$result = R::find('article',"id=".$id);
		if( count($result) >= 1 ){
			$data = array();
			$data['code']    = 0;
			$data['msg']     = '获取成功';
			$data['title']   = $result[$id]->title;
			$data['date']    = date('Y-m-d H:i:s',$result[$id]->plushtime);
			$data['author']  = $result[$id]->source;
			$data['content'] = $result[$id]->content;
			die( json_encode( $data ) );
		}else{
			$this->msgPut(false, '不存在对应的文章信息!', null, 1);
		}
	}
	private function get_article_title(){
		$articleser=new ArticleService();
		$result=$articleser->getuniquetitle();
		$this->msgPut(true, '', $result);
		
	}
	
	#.匹配文章列表
	#.http://10.0.0.75/interface/hma/get.php?part=search_article
	private function get_search_article(){
		$page = isset( $_REQUEST['page'] ) && $_REQUEST['page'] >=1 ? $_REQUEST['page'] : 1;
		$rows = isset( $_REQUEST['rows'] ) && $_REQUEST['rows'] >=1 ? $_REQUEST['rows'] : 10;
		$word = isset( $_REQUEST['keyword'] ) ? $_REQUEST['keyword'] : '';
		#.获取匹配关键词后的总条数
		new ArticleService();
		$result = R::find('article',"subject like '%".$word."%'");
		$count  = count( $result );
		if( count( $result ) <= 0 ) {
			$this->msgPut(false, '没有找到匹配的文章!', null, 1);
		}
		#.计算最大页
		$maxPage = ceil( $count / $rows );
		if( $page > $maxPage ){
			die( json_encode( array( 'code'=>0,'msg'=>'没有数据','data'=>null ) ) );
			$this->msgPut(true, '没有数据', null, 0);
		}
		#.limit
		$limit   = ( $page - 1 ) * 10 . ',' . $rows;
		$result = R::find('article',"subject like '%". $word ."%' ORDER BY id desc limit ".$limit);
		#.遍历获得hma像要的数据
		$data = array();
		foreach ( $result as $key => $value ) {
			$data[$key-1]['articleId']    = $value->id;
			$data[$key-1]['title']        = $value->subject;
			$data[$key-1]['description']  = $value->description;
			$data[$key-1]['date']         = date('Y-m-d H:i:s',$value->plushtime);
			#.根据科室ID查科室
			$deparment = R::find('department','id='.$value->department_id);
			$disease   = R::find('disease','id='.$value->disease_id);
			$data[$key-1]['url']          = NETADDRESS . '/app/article.php?method=get&id=' . $value->id;
			//$data[$key-1]['appurl']          = NETADDRESS . '/app/article.php?method=get&id=' . $value->id;
		}
		#.输出
		$ddata = array();
		foreach ($data as $k => $v){$ddata[] = $v;}
		$this->msgPut(true, '', $ddata, 0);
	}
	
	#.通过医生ID取该医生的预约排班表
	#.http://10.0.0.75/interface/hma/get.php?part=doctor_outpatient_time
	private function get_doctormanager_outpatient_time() {
		#.信息来源
		if( ! isset( $_REQUEST['doctor_id'] ) || $_REQUEST['doctor_id'] == '' || (int)$_REQUEST['doctor_id'] <= 0 ) {
			$this->msgPut(false, '请选择医生', null, 1);
		}
		if( ! isset( $_REQUEST['department_id'] ) || $_REQUEST['department_id'] == '' || (int)$_REQUEST['department_id'] <= 0 ) {
			$this->msgPut(false, '请选择科室', null, 15);
		}		
		#.是否存在该医生的预约信息
		new ResDoctorService();	
		$doctor_id = (int)$_REQUEST['doctor_id'];	
		//调取超过当前日期的可预约数据，今天以前的数据无意义，不调取	
		$queryarr=array('doctor_id'=>$doctor_id,'date'=>time());
		$result    = R::findall('resvation','doctor_id = :doctor_id and date>=:date',$queryarr);	
		
		if( count( $result ) <= 0 ) {
			die( json_encode( array('statu'=>false, 'code'=>1,'msg'=>'该医生暂无排班信息!','data'=>null ) ) );
		}else{
			$resultarr=array();
			$num=0;
			//查询患者预约信息表(resbookinginfo)从数据中迁出己被约的时间点
			foreach ($result as $key=>$val){				
				
				//医生号源个数
				$bookingNum=(int)$val->morning_source+(int)$val->afternoon_source+(int)$val->night_source;
				//是否还有号源
				$num=$bookingNum-(int)$val->mark;
				
				//裂解time_point
				$timepoint=explode('@',$val->time_point);
				$timeobj=array();
				for($i=0;$i<count($timepoint);$i++){
					if(isset($timepoint[$i+1])){
						$timeobj[$timepoint[$i]]=$timepoint[$i].'-'.$timepoint[$i+1];
					}
				}				
				//向总结果中注入日期,id
				$resultarr[$key]['date']=date('Y-m-d',$val->date);
				$resultarr[$key]['id']=$val->id;
				
				if($num!=0&&(int)$val->mark!=0){
					//有人预约，但还有余号
					unset($_REQUEST['method']);
					unset($_REQUEST['department_id']);					
					//还有号源人，但部分号己被预约，查被约时间点
					$resbookservice=new ResBookingInfoService();									
					$_REQUEST['docID']=$_REQUEST['doctor_id'];
					//查询日期以当前时间为起点
					$_REQUEST['date']=date('Y-m-d',$val->date);						
					$bookresult=$resbookservice->getAllbookinginfos();					
					if($bookresult['ttl']>0){
						//有人预约，将己约的时间点从总数据中迁出
						$rows=$bookresult['rows'];
						$timearrange=array();
						foreach( $timeobj as $tkey=>$time) {
							foreach ($rows as $k=>$row){
								if(strtotime($tkey)==strtotime($row->times)){
									unset($timeobj[$tkey]);
									break;
								}
							}
						}
						
					}					
					$timearrange= array_values($timeobj);					
					$resultarr[$key]['timearrange']=$timearrange;
					
				}else if((int)$val->mark==0){
					//无人预约
					$resultarr[$key]['timearrange']=array_values($timeobj);
					
				}else if($num==0&&(int)$val->mark!=0){
					//该医生当日号己约完
					$resultarr[$key]['timearrange']='本日号已满';
				}
				$num++;	
			}//foreach over			
			$this->msgPut(true, null, array_merge($resultarr), 0);
		}
		
	}
	
	
	#.通过科室获取医生列表
	#.http://10.0.0.75/interface/hma/get.php?part=department_doctor_list&apartment=10
	private function get_department_doctor_list() {
		
		#.获取基本信息

		$departmentID = (int)$_REQUEST['apartment'];
		$service    = new DoctorService();
		$docList    = $service->getByDepartmentID($departmentID);//取出所有
		if( count( $docList->data ) <= 0 ) {
			die( json_encode( array( 'code'=>1,'msg'=>'该科室分类下没有医生信息!','data'=>null ) ) );
			$this->msgPut(false, '该科室分类下没有医生信息!', null, 1);
		}
		$data = $docList->data;
		#.遍历并组合hma需要的信息
		$docArray = array();
		foreach ( $data  as $key => $value) {
			$docArray[$key]['doctor_id'] = $value->id;
			$docArray[$key]['name']      = $value->name;
			$docArray[$key]['position']  = $value->position;
			$docArray[$key]['hospital']  = '';
			$docArray[$key]['adept']     = $value->specialty;
			#.查询该医生是否处于允许预约
			$result = R::findOne('reservation','doctor_id = ' . $value->id);
			$docArray[$key]['isEmpty']   = ! is_object( $result ) ? 1 : 0;
			$docArray[$key]['img_url']   = UPLOAD . $value->pic;
		}
		#.是否有分页参数
		if( ! isset( $_REQUEST['row'] ) || ! isset( $_REQUEST['page'] ) ){
			$this->msgPut(true, '获取成功!', $docArray);
		}
		$row  = (int)$_REQUEST['row'];
		$page = (int)$_REQUEST['page'];
		if($row <= 0 || $page <= 0){
			$this->msgPut(true, '获取成功!', $docArray);
		}
		#.进行分页操作
		if( $page >= count( $docArray ) / $row ) {
			$page = count( $docArray ) / $row;
		}
		$begin = ($page - 1) * $row;
		$data = array_slice($docArray,$begin,$row);
		$this->msgPut(true, '获取成功!', $data);
	}
	
	#.科室获取接口
	private function get_department_list() {
		$services = new DepartmentService();
		$getDepartments = $services->getDepartments();
		if( is_array( $getDepartments->data ) ) {
			die( json_encode( array( 'code'=>0,'msg'=>'获取成功!','departments'=>$getDepartments->data ) ) );
		}else{
			die( json_encode( array( 'code'=>1,'msg'=>'科室列表为空!','departments'=>null ) ) );
		}
	}
	
	
	#.获取预约挂号科室列表
	private function get_departmentmanager_list() {
		$services = new ResDepartmentService();
		$getDepartments = $services->getDepartments();
		if( is_array( $getDepartments->data ) ) {
			die( json_encode( array( 'code'=>0,'msg'=>'获取成功!','departments'=>$getDepartments->data ) ) );
		}else{
			die( json_encode( array( 'code'=>1,'msg'=>'科室列表为空!','departments'=>null ) ) );
		}
	}
	
	#.通过科室获取医生列表
	#.http://10.0.0.75/interface/hma/get.php?part=department_doctor_list&apartment=10
	//此接口只返回改医生一周内是否有号的信息
	private function get_department_doctormanager_list() {
		if(!isset($_REQUEST['apartment'])||empty($_REQUEST['apartment'])){
			$this->msgPut(false, '未选择科室!', null, 27);
		}
		
		//$lastday=strtotime(date('Y-m-d')." Sunday");
		//$startday=strtotime(date('Y-m-d',$lastday)." - 6 days");
		//更改为预约今天以后所有放出的可预约号源
		$startday=strtotime(date("Y-m-d",strtotime("+1 day")));
		
		#.获取基本信息
		$departmentID = (int)$_REQUEST['apartment'];
		$service    = new ResDoctorService();
		$docList    = $service->getByDepartmentID($departmentID);//取出所有
		
		if( count( $docList->data ) <= 0 ) {
			$this->msgPut(false, '该科室暂无坐诊医生!', null, 1);
		}
		$data = $docList->data;
		
		#.遍历并组合hma需要的信息 
		$docArray = array();
		foreach ( $data  as $key => $value) {
			$docArray[$key]['doctor_id'] = $value->id;
			$docArray[$key]['name']      = $value->name;
			$docArray[$key]['position']  = $value->position;
			$docArray[$key]['hospital']  = '';
			$docArray[$key]['adept']     = $value->specialty;
			
			#.查询该医生是否处于允许预约
			//$arr=array('doctor_id'=>$value->id,'datestart'=>$startday,'dateend'=>$lastday);			
			//$result = R::findAll(TABLENAME_RESERVATION,'doctor_id = :doctor_id AND date >= :datestart AND date <= :dateend AND state=0' ,$arr);
			//echo $value->id;
			
			$arr=array('doctor_id'=>$value->id,'datestart'=>$startday);
			$result = R::findAll(TABLENAME_RESERVATION,'doctor_id = :doctor_id AND date >= :datestart AND state=0' ,$arr);
		
			$docArray[$key]['isEmpty']   = empty($result) ? 1 : 0;
			$docArray[$key]['img_url']   = UPLOAD . $value->pic;
		}
		
		#.是否有分页参数
		if( ! isset( $_REQUEST['row'] ) || ! isset( $_REQUEST['page'] ) ){
		die( json_encode( array( 'code'=>0,'msg'=>'获取成功!','data'=>$docArray ) ) );
		}
		$row  = (int)$_REQUEST['row'];
		$page = (int)$_REQUEST['page'];
		if($row <= 0 || $page <= 0){
			die( json_encode( array( 'code'=>0,'msg'=>'获取成功!','data'=>$docArray ) ) );
		}
		#.进行分页操作
		if( $page >= count( $docArray ) / $row ) {
			$page = count( $docArray ) / $row;
		}
		$begin = ($page - 1) * $row;
		$data = array_slice($docArray,$begin,$row);
		$this->msgPut(true, '获取成功!', $data);
	}
	
	
	#.通过总控预约ID取预约信息
	private function get_reservation_info(){
		new ResVationService();
		$reservation_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;	
		if( $reservation_id <= 0 ){
			$this->msgPut(false, '查询失败,id不能为空!', null, 1);			
		}		
		$resarr=array('id'=>$reservation_id);
		$result = R::findOne('resbookinginfo','id=:id', $resarr);
		if( is_object($result) ){
			$data['code']            = 0;
			$data['msg']             = '查询成功';
			#.查询医院名称
			$contact = R::findOne('contact',"flag = 'name'");
			$data['hospital_name']   = $contact->val;
			$arrcheck=array('id'=>$result->reserver_id);
			
			#.查询预约详细信息			
			//$reservaInfo = R::findOne('reservation','id = :id',$arrcheck );	
			
			#.查询科室
			$deparment   = R::findOne('resdepartment',"id = " . $result->department_id);
			$data['department_name'] = isset( $deparment->name ) ? $deparment->name : '';
			#.查询医生
			$doctor      = R::findOne('resdoctor',"id = " . $result->doctor_id);
			$data['doctor_name'] 	 = isset( $doctor->name ) ? $doctor->name : '';
			$data['date'] 			 = date('Y-m-d',$result->date);
			$data['time']            = date('H:i',$result->times);			
			if($result->statu=="已约"){
				$data['resstatu']=0;
			}else{
				$data['resstatu']=1;
			}
			$data['resertimes']=date('Y-m-d H:i:s',$result->times);
			$data['username'] 		 = $result->username;
			$data['tel'] 			 = $result->telephone;
			die( json_encode( $data ) );				
		}else{
			$this->msgPut(false, '查询失败,改预约id不存在!', null, 11);
		}
	}
	
	#.获取软件配置信息
	private function get_configure_info(){
		$contact = new ContactService();
		$swt = $contact->getContact('swt_link');
		$tel = $contact->getContact('tel');
		$address_hos = $contact->getContact( 'address' );
		$jwd     = $contact->getContact( 'map' );
		$busNum  = $contact->getContact( 'route' );
		$json = array();
		$json['code'] = 0;
		$json['chatUrl']     = $swt->data->val;
		$json['tel']         = $tel->data->val;
		$json['address_hos'] = $address_hos->data->val;
		$json['busNum']      = $busNum->data->val;
		//分割经纬度
		if( $jwd->data->val != '' ){
			$jwdArrays = explode(',',$jwd->data->val);
			$json['log'] = $jwdArrays[0];
			$json['lat'] = $jwdArrays[1];
		}else{
			$json['log'] = '';
			$json['lat'] = '';
		}
		$json['msg'] = '获取成功';
		die( json_encode( $json ) );
	}
	
	#.获取星期几
	private function get_week($time = null) {
		$weekarray=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
		return $weekarray[date('w',$time)];
	}
	

	

	
}
new GetPart();
?>