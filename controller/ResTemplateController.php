<?php

class ResTemplateController extends Controller {

    private $service;

    function __construct() {
        parent::__construct();
        $this->service = new ResTemplateService();
       
        
    }

    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
       // $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }
    /*
     * 保存模板
     * 
     * 
     * */
    public function savetem(){    	
    	if (! isset($_REQUEST['type']) || empty($_REQUEST['type'])) {

    		throw new ValidatorException(160);
    	}
    	if (! isset($_REQUEST['title']) || empty($_REQUEST['title'])) {
    		throw new ValidatorException(161);
    	}    	
    	$this->blindParams($restemplate = new ResTemplate());
    	$exist=$this->service->check_exist($restemplate);
    	
    	if($exist){
    		throw new ValidatorException(166);
    	}else{      		
    		$result= $this->service->save($restemplate);
    	}
    	
    	echo json_encode($result);
    	
    }
    
    /*
     * 编辑模板 
    * */
	public function modTemplate() {
        echo json_encode($this->service->modTemplate());
    }
    
    /*
     * 获取选中项
     * */
    
    public function tditem(){

    	switch($_REQUEST['time']){
    		case'mon':
    			$_REQUEST['morning']=$_REQUEST['timerang'];
    			break;
    		case 'aft':
    			$_REQUEST['afternoon']=$_REQUEST['timerang'];
    			break;
    		case 'nig':
    			$_REQUEST['night']=$_REQUEST['timerang'];
    			break;
    		default:
    			throw new ValidatorException(164);
    			break;
    	}
    	$this->blindParams($resschedule = new ResSchedule());
    	$ResScheduleService = new ResScheduleService();
    	$checkid=$ResScheduleService->checkdate($resschedule);
    	
    	if($checkid!=null){
    		$res=unserialize($checkid->doctor_num);
    	}else{
    		$res=null;
    	}
    	$resarray=array('statu'=>true,
    			'msg'=>'',
    			'date'=>$res);
    	
    	
    	 
    	echo json_encode($resarray);
    	
    	
    }
    /*
     * 
     * 更新预约模板时间
     * 
     * */
    
    public function updatetime(){
    	switch($_REQUEST['timein']){
    		case'mon':
    			$_REQUEST['morning']=$_REQUEST['time'];
    			break;
    		case 'aft':
    			$_REQUEST['afternoon']=$_REQUEST['time'];
    			break;
    		case 'nig':
    			$_REQUEST['night']=$_REQUEST['time'];
    			break;
    		default:
    			throw new ValidatorException(165);
    			break;
    	}
    	
    	$this->blindParams($resschedule = new ResSchedule());
    	$ResScheduleService = new ResScheduleService();
   
    	$ResScheduleService->updatetime($resschedule);
    	$result=array('statu'=>true,    			
    			      'code'=>0,
    			       'msg'=>'',
    			      'date'=>null,
    	);
    	echo json_encode($result);
    	

    }
    
    /*
     * 保存排班模板数据
     * 
     * 
     * */
    public function savetemitem(){
    	$date=json_decode(stripslashes($_REQUEST['doctor']));
    	$savedate=array();
    	while(list($key,$val)=each($date)){
    		if($val!=null){
    			$savedate[$key]=$val;
    		}
    	}
    	$_REQUEST['doctor_num']=serialize($savedate);    	
    	switch($_REQUEST['time']){
    		case'mon':
    		$_REQUEST['morning']=$_REQUEST['timerang'];
    		break;
    		case 'aft':
    		$_REQUEST['afternoon']=$_REQUEST['timerang'];
    		break;
    		case 'nig':
    	    $_REQUEST['night']=$_REQUEST['timerang'];
    	    break;
    		default:
    		throw new ValidatorException(164);
    		break;	
    	} 
    	
    	$this->blindParams($resschedule = new ResSchedule());
    	$ResScheduleService = new ResScheduleService();
    	$checkid=$ResScheduleService->checkdate($resschedule);    	  	
    	if($checkid!=null){
    		$resschedule->id=$checkid->id;    
    		$date=$ResScheduleService->update($resschedule);
    		if($date->statu){
    			$res=$resschedule;    			
    		}else{
    			throw new ValidatorException($date->code);
    			
    		}
    	}else{
    		$res = $ResScheduleService->save($resschedule);
    	}
    	
    	$resarray=array('statu'=>true,'msg'=>'','date'=>'');
    	echo json_encode($resarray);
    }
    
    /*
     * 获取详细信息
     * 
     * */
    public function getitem(){
    	
    	switch($_REQUEST['time']){
    		case'mon':
    			$_REQUEST['morning']=$_REQUEST['timerang'];
    			break;
    		case 'aft':
    			$_REQUEST['afternoon']=$_REQUEST['timerang'];
    			break;
    		case 'nig':
    			$_REQUEST['night']=$_REQUEST['timerang'];
    			break;
    		default:
    			throw new ValidatorException(164);
    			break;
    	}
    	
    	$this->blindParams($resschedule = new ResSchedule());
    	$ResScheduleService = new ResScheduleService();
   
    	
    	$res=$ResScheduleService->query($resschedule);
    	echo json_encode($res);
    	
    }
    
    
    /*
     * 单双周以及按月的表格生成
    *
    * */
    
    public function getloop(){
    	$type=(int)$_REQUEST['type'];
    	$arrday=array();
    	$arrwek=array(1,2,3,4,5,6,7);
    	$arrthree=array(1,2,3);
		for ($i=1;$i<=$type;$i++){
			$arrday[]=$i;	
		}
		switch($type){
			case 7:
			$resultarr=$arrwek;
			break;
			case 14:
			$resultarr=array_merge($arrwek,$arrwek);
			break;
			case 31:
			$resultarr=array_merge($arrwek,$arrwek,$arrwek,$arrwek,$arrthree);
			break;
			default:
			$resultarr='缺少参数';
			break;
		}
		
		$res=array('stute'=>true,'date'=>$arrday,'week'=>$resultarr);
		echo json_encode($res);    	 
    }

    /**
     * 添加数据
     */
    public function add() {
        
        if (1 > (int) $_REQUEST['along'] || (int) $_REQUEST['along'] > 30) {
            throw new ValidatorException(144);
        }
        if (! isset($_REQUEST['start']) || empty($_REQUEST['start'])) {
            throw new ValidatorException(145);
        }
        if (! isset($_REQUEST['end']) || empty($_REQUEST['end'])) {
            throw new ValidatorException(146);
        }
        $flag = false;
        $arr = array();
        foreach ($_REQUEST['date'] as $k => $v) {
            if ($v == '') {
                unset($_REQUEST['date'][$k]);
            } else {
                $arr[$v][] = $k;
                $flag = true;
            }
        }
        if (! $flag) {
            throw new ValidatorException(143);
        }
        unset($_REQUEST['date']);
        foreach ($arr as $k => $val) {
            $_REQUEST['date'] = $k;
            foreach ($val as $v) {
                $str = strtolower(str_replace($_REQUEST['date'], '', $v));
                $_REQUEST[$str] = $_REQUEST[$v]['start'] . '-' . $_REQUEST[$v]['end'];
            }
            $_REQUEST['morning'] = isset($_REQUEST['morning']) ? $_REQUEST['morning'] : '-';
            $_REQUEST['afternoon'] = isset($_REQUEST['afternoon']) ? $_REQUEST['afternoon'] : '-';
            $_REQUEST['night'] = isset($_REQUEST['night']) ? $_REQUEST['night'] : '-';
            $_REQUEST['date'] = strtotime($k);
            $this->blindParams($reservation = new ResVation());
            $res = $this->service->save($reservation);
            // 添加在详细表中去
            foreach ($val as $v) {
                $this->addDetail($k, $v, $_REQUEST);
            }
            unset($_REQUEST['morning'], $_REQUEST['afternoon'], $_REQUEST['night']);
        }
        echo json_encode($res);
    }

    /**
     * 设置添加到详细页的有效值
     *
     * @param unknown_type $date
     * @param unknown_type $key
     * @param unknown_type $array
     */
    public function addDetail($date, $key, $array) {
        // echo $date,'<br/>',$key;exit;
        $detail = new ReservationDetail();
        $detail->department_id = $array['department_id'];
        $detail->doctor_id = $array['doctor_id'];
        $detail->statu = '待约';
        $detail->date = strtotime($date);
        $start = $array[$key]['start'];
        $end = $array[$key]['end'];
        $t = strtotime($date . ' ' . $end) - strtotime($date . ' ' . $start);
        $along = $array['along'] * 60;
        $count = $t / $along;
        $time = strtotime($date . ' ' . $start);
        // $detail->times = $time;
        // print_r($detail);exit;
        for ($i = 1; $i <= $count; $i ++) {
            $detail->times = $time;
            $this->addToDetail($detail);
            $time += $along;
        }
    }

    /**
     * 查询指定的数据
     */
    public function query() {
    	
        $result = $this->service->query($_REQUEST);
        $ttl = $this->service->totalRows($_REQUEST);
        
        echo json_encode(array(
        	'data'=> $result->data,
            'rows' => $result->data,
            'ttl' => $ttl->data
        ));
        
    }

    /**
     * 根据id获取一条数据 .
     * ..
     */
    public function get() {
        $this->blindParams($reservation = new ResVation());
        $res = $this->service->get($reservation);

        echo json_encode($res);
    }

    /**
     * 修改数据 .
     * ..
     */
    public function edit() {
        if (1 > (int) $_REQUEST['along'] || (int) $_REQUEST['along'] > 30) {
            throw new ValidatorException(144);
        }
        $flag = false;
        foreach ($_REQUEST['date'] as $k => $v) {
            if ($v != '') {
                $k = str_replace("'", '', $k);
                $morning = $k . 'Morning';
                $afternoon = $k . 'Afternoon';
                $night = $k . 'Night';
                if ($_REQUEST[$morning]['start'] != '' && $_REQUEST[$morning]['end'] != '') {
                    $flag = true;
                }
                if ($_REQUEST[$afternoon]['start'] != '' && $_REQUEST[$afternoon]['end'] != '') {
                    $flag = true;
                }
                if ($_REQUEST[$night]['start'] != '' && $_REQUEST[$night]['end'] != '') {
                    $flag = true;
                }
            }
        }
        if (! $flag) {
            throw new ValidatorException(134);
        }
        $date = $_REQUEST['date'];
        foreach ($date as $k => $v) {
            if ($v) {
                unset($_REQUEST['date']);
                $_REQUEST['date'] = $v;
                $k1 = str_replace("'", '', $k) . 'Morning';
                $k2 = str_replace("'", '', $k) . 'Afternoon';
                $k3 = str_replace("'", '', $k) . 'Night';
                $_REQUEST['morning'] = $_REQUEST[$k1]['start'] . '-' . $_REQUEST[$k1]['end'];
                $_REQUEST['afternoon'] = $_REQUEST[$k2]['start'] . '-' . $_REQUEST[$k2]['end'];
                $_REQUEST['night'] = $_REQUEST[$k3]['start'] . '-' . $_REQUEST[$k3]['end'];
                $_REQUEST['date'] = strtotime($v);
                $this->blindParams($reservation = new ResVation());
                $res = $this->service->update($reservation);
                // 修改详细表
                // 先删除原来的数据
                $array = array(
                    'department_id' => $_REQUEST['oldDepartment'],
                    'doctor_id' => $_REQUEST['oldDoctor'],
                    'date' => strtotime($_REQUEST['oldDate'])
                );
                $this->deleteAll($array);
                // 在重新分配后加入数据库
                if ($_REQUEST['morning']) {
                    $key = $k1;
                    $this->editDetai($v, $key, $_REQUEST);
                }
                if ($_REQUEST['afternoon']) {
                    $key = $k2;
                    $this->editDetai($v, $key, $_REQUEST);
                }
                if ($_REQUEST['night']) {
                    $key = $k3;
                    $this->editDetai($v, $key, $_REQUEST);
                }
            }
        }
        echo json_encode($res);
    }

    /**
     * 编辑详细表中的数据...
     *
     * @param unknown_type $date
     * @param unknown_type $key
     * @param unknown_type $array
     */
    public function editDetai($date, $key, $array) {
        $detail = new ReservationDetail();
        $detail->department_id = $array['department_id'];
        $detail->doctor_id = $array['doctor_id'];
        $detail->statu = '待约';
        $detail->date = strtotime($date);
        $t = strtotime($date . ' ' . $array[$key]['end']) - strtotime($date . ' ' . $array[$key]['start']);
        $along = $array['along'] * 60;
        $count = $t / $along;
        $time = strtotime($date . ' ' . $array[$key]['start']);
        $detail->times = $time;
        for ($i = 1; $i <= $count; $i ++) {
            $detail->times = $time;
            $this->addToDetail($detail);
            $time += $along;
        }
    }

    /**
     * 删除记录 .
     * ..
     */
    public function delete() {    	
        if (is_array($_REQUEST['id'])) {
            $reservations = $_REQUEST['id'];
        } else {
            $reservations = array(
                $_REQUEST['id']
            );
        }
        $res = $this->service->deleteBatch($reservations);
        echo json_encode($res);
    }

    /**
     * 添加到详细表中 .
     * ..
     */
    public function addToDetail($detail) {
        $re = $this->service->addToDetail($detail);
    }

    /**
     * 获取详细列表...
     */
    public function getDetail() {
        $this->blindParams($reservation = new ResVation());
        $res = $this->service->get($reservation);
        $_REQUEST['department_id'] = $res->data->department_id;
        $_REQUEST['doctor_id'] = $res->data->doctor_id;
        foreach ($res->data->date as $v) {
            $_REQUEST['date'] = strtotime($v);
        }
        $result = $this->service->getDetail($_REQUEST);
        $ttl = $this->service->getCount($_REQUEST);

        echo json_encode(array(
            'rows' => $result->data,
            'ttl' => $ttl->data
        ));
    }
    /**
     * 按条件获取
     */

    public function getResVation($dep,$doc,$date) {
        $_REQUEST['date'] = strtotime($_REQUEST['date']); 
        $result = $this->service->getDetail($_REQUEST); 

        $arr = array();
        $morning = array();
        $afternoon = array();
        $night = array();
        $along= (strtotime($result->data[1]->times)-strtotime($result->data[0]->times))/60;       
        foreach ($result->data as $k => $v){
            $t = strtotime($v->times);
            $h = intval(date('H',$t));    
            $i = intval(date('i',$t));
            
            if($h < 12){
                $v->flag= "morning";
            }elseif($h >= 12 && $h < 18){
                $v->flag= "afternoon";
            }else{
                $v->flag= "night";
            }
            if(isset( $arr[$v->flag]['min'])){
                $min = $arr[$v->flag]['min'];
                if(strtotime($v->times)<strtotime($min)){
                   $arr[$v->flag]['min']=$v->times;
                }
            }else{
                $arr[$v->flag]['min']=$v->times;
            } 

            if(isset( $arr[$v->flag]['max'])){
                $max = $arr[$v->flag]['max'];
                if(strtotime($v->times)>strtotime($max)){
                     $arr[$v->flag]['max']=$v->times;
                }          
            }else{
                $arr[$v->flag]['max']=$v->times;
            }
            $arr[$v->flag]['field'][]=array("times"=>$v->times,'statu'=>$v->statu);            
        }   
        $result = $this->getFieldStr($arr);
        echo json_encode( $result );
    }

    public function getFieldStr($fields = array()){
        $result = array();
        foreach ($fields as $key=>$value) {
            //计算下班时间
            $end_h = date('H', strtotime($value['max']));
            $end_i = intval(date('i', strtotime($value['max'])));
    
            if ($end_i>30) {
                $end = intval($end_h)+1 . ":00";
            } else {
                $end = $end_h . ":30";
            }
    
            //var_dump($value['field']);
            //拼接时间段
            $min = strtotime($value['min']);
            $max = strtotime($end);
    
            for ($i=$min; $i<=$max+3600; $i=$i+3600) {
                $end_time = $i+3600;
                if ($end_time>$max) {
                    $end_time = $max;
                }
                 
                if ($end_time<=$i) {
                    continue;
                }
                $key = date('H:i', $i) . '-' . date('H:i', $end_time);
                $result[$key]['available'] = 0;
                $result[$key]['unavailable'] = 0;
                foreach ($value['field'] as $v) {
                    $stamp = strtotime($v['times']);
                    if ($stamp>=$i && $stamp < ($i+3600)) {
                        if ('待约' == $v['statu']) {
                            $result[$key]['times'][] = $v['times'];
                            $result[$key]['available']++;
                        } else {
                            $result[$key]['unavailable']++;
                        }
                    }
                }
            }
        }
        return $result;
    } 
    
    

    /**
     * 是否批量删除...
     */
    public function deleteDetail() {
        // print_r($_REQUEST);
        if (is_array($_REQUEST['id'])) {
            $detailIds = $_REQUEST['id'];
        } else {
            $detailIds = array(
                $_REQUEST['id']
            );
        }
        $res = $this->service->deleteDetail($detailIds);

        echo json_encode($res);
    }

    /**
     * 根据科室，医生，日期删除详细表中的记录
     */
    public function deleteAll($arr) {
        $res = $this->service->deleteAll($arr);
    }

    /**
     * 得到详细表中所有的数据
     */
    public function getDetailAll() {
        $detailAll = $this->service->getDetailAll();
        $jsonStr = json_encode($detailAll->data);
        $filename = ABSPATH . '/interface/Reservation.json';
        file_put_contents($filename, $jsonStr);
        $filename = NETADDRESS . '/interface/Reservation.json';
        $detailAll->filename = $filename;
        echo json_encode($detailAll);
    }

    /**
     * 根据排班模板生成预约挂号排班表
     */
    public function makeAppointmentTable() {    	
    	$error=false;
    	$array = $_REQUEST['data'];
    	$time1 = strtotime($array['start']);
    	if (strtolower($time1) == 0) {
    		throw new ValidatorException(145);
    	}
    	$time2 = strtotime($array['end']);
    	if (strtolower($time2) == 0) {
    		throw new ValidatorException(146);
    	}
    	$time3 = $time2 - $time1;
    	$count = $time3 / 86400;//排班日期间有多少天
    	$time = $time1;
    	$date = array();
    	$week = array();
    	$date[] =  $time1;    	
    	for ($i = 1; $i < $count; $i ++) {
    		$time = $time + 86400;
    		$date[] =  $time;    		
    	}
    	if ($time1 != $time2) {
    		$date[] = $time2;    		
    	}    
    	
    	$resscheduleService = new ResScheduleService();    	
    	$reser=new ResVationService();    	 
    	$type=$_REQUEST['type'];  //循环类型  	 
    	if (strlen($type)==0) {
    		throw new ValidatorException(160);
    	}    	 
    	$temp_id=$_REQUEST['temp_id'];//排班模板ID    	 
    	if (strlen($temp_id)==0) {
    		throw new ValidatorException(163);
    	}     	 
    	$temdate=$resscheduleService->getdate($type,$temp_id);//获取排班模板详细数据        	
    	if($temdate!=null){//判断预约模板中的数据是不是为空       		 		
    		set_time_limit(0);    
    		//重组预约模板数据
    		$n=1;
    		$thedatearray=array();    
    		while(list($i,$v)=each($temdate)){
    			$thedatearray[$v->date][$n]=$v;
    			$n++;
    		}     		
    		for($s=1;$s<=$type;$s++){
    			if(!isset($thedatearray[$s])){
    				$thedatearray[$s]=0;
    			}    
    		}    		 
    		try{    			
    			$datenum=1;
    			$typenum=1;     			
    			while(list($key,$val)=each($date)){    				
    				$sw=$this->service->settimedate($val,$type,$datenum,$typenum);
    				if($thedatearray[$sw]!=0){    					   
    					reset ($thedatearray[$sw]);
    					while(list($i,$v)=each($thedatearray[$sw])){    						
    						$i=$v->date;
    						$doctor=unserialize($v->doctor_num);
    						reset($doctor);
    						$resdoctorService=new ResDoctorService();    						
    						while(list($d,$n)=each($doctor)){    							
    							$_REQUEST['department_id']=$resdoctorService->getByDoctorID($d);    							
    							$_REQUEST['doctor_id']=$d;
    							$_REQUEST['date']=$val;     														
    							$_REQUEST['state']='0';    							 
    							if($v->morning!=null){    								
    								$_REQUEST['morning']=$v->morning;
    								$_REQUEST['morning_source']=$n;
    								unset($_REQUEST['afternoon']);
    								unset($_REQUEST['night']);
    								unset($_REQUEST['night_source']);
    								unset($_REQUEST['afternoon_source']);
    								//按号源裂解上班时间段
    								$_REQUEST['time_point']=$this->getTimePoint($v->morning,$n); 
    								$_REQUEST['morning_point']=$this->getTimePoint($v->morning,$n);
    								$this->blindParams($reservation = new ResVation()); 
 									$reservation->department_id=$_REQUEST['department_id'] ? $_REQUEST['department_id'] : 0;
									$reservation->mark=0; 								
    								$reser->setmon_date($reservation);
    							}elseif($v->afternoon!=null){    								
    								$_REQUEST['afternoon']=$v->afternoon;
    								$_REQUEST['afternoon_source']=$n;    								
    								unset($_REQUEST['morning']);
    								unset($_REQUEST['morning_source']);
    								unset($_REQUEST['night']);
    								unset($_REQUEST['night_source']);
    								if(isset($_REQUEST['time_point'])&&$_REQUEST['time_point']){
    									//按号源裂解上班时间段
    									$_REQUEST['time_point'].="@0@".$this->getTimePoint($v->afternoon,$n);    									
    								}else{
    									$_REQUEST['time_point']=$this->getTimePoint($v->afternoon,$n);
    								}
    								$_REQUEST['after_point']=$this->getTimePoint($v->afternoon,$n);
    								$this->blindParams($reservation = new ResVation()); 
 									$reservation->department_id=$_REQUEST['department_id'] ? $_REQUEST['department_id'] : 0;
									$reservation->mark=0;									
    								$reser->setaft_date($reservation); 
    							}else{    								
    								$_REQUEST['night']=$v->night;
    								$_REQUEST['night_source']=$n;
    								unset($_REQUEST['morning']);
    								unset($_REQUEST['afternoon']);
    								unset($_REQUEST['morning_source']);
    								unset($_REQUEST['afternoon_source']);
    								if(isset($_REQUEST['time_point'])&&$_REQUEST['time_point']){
    									//按号源裂解上班时间段
    									$_REQUEST['time_point'].="@0@".$this->getTimePoint($v->night,$n);
    								}else{
    									$_REQUEST['time_point']=$this->getTimePoint($v->night,$n);
    								}
    								$_REQUEST['night_point']=$this->getTimePoint($v->night,$n);
    								$this->blindParams($reservation = new ResVation());
 									$reservation->department_id=$_REQUEST['department_id'] ? $_REQUEST['department_id'] : 0;
									$reservation->mark=0;
    								$reser->setnig_date($reservation);    
    							}   							 
    						}
    					}
    				}
    				$typenum++;
    				if($typenum>$type){
    					$typenum=1;
    				}
    				$datenum++;    				
    			}
    				
    		}catch(Exception $e){
    			$error=true;
    			echo "捕获默认的异常：".$e->getMessage()."<br>";
    		} 
    	}else{
    		$error=true;
    		throw new ValidatorException(167);
    	}    
    	if(!$error){    		
    		$arr = array();    
    		$arr['statu'] = true;
    		$arr['msg'] = null;
    		$arr['date']=null;    
    		echo json_encode($arr);
    	}
    }
    /**
     * 裂解时间段
     */
    public function getTimePoint($times,$num){    	  	
    	$timeArr=explode('-', $times);    	
    	$dateNow=date('Y-m-d',time());    	
    	$begintime=strtotime($dateNow.' '.$timeArr[0]);    	
    	$endtime=strtotime($dateNow.' '.$timeArr[1]);    	
    	$restTime=$endtime-$begintime;
    	$AverageTime=floor($restTime/$num);    	
    	$str=$timeArr[0];    	
    	for($i=1;$i<$num;$i++){
    		$date=$begintime+$i*$AverageTime;
    		$str.='@'.date('H:i',$date);
    	}
    	$str.='@'.$timeArr[1];    	
    	return $str;
    }
    
    
    /**
     * 将预约者添加到预约表中去,修改未约成已约
     */
    public function reserUser() {       
        $res=$this->service->queryDetail();
        $reservationDetail = new ReservationDetail();
        $reservationDetail->id=$res->id;
        $reservationDetail->department_id=$res->department_id;
        $reservationDetail->doctor_id=$res->doctor_id;
        $reservationDetail->date=$res->date;
        $reservationDetail->times=$res->times;
        $reservationDetail->statu='已约';
        $reservationDetail->username=$_REQUEST['name'];
        $reservationDetail->telephone=$_REQUEST['hometel'];
        $this->service->reservationDetail($reservationDetail);
        
        $entity = new ReserUser();
        $this->blindParams($entity);
        $result = $this->service->reserUser($entity);     
        echo json_encode($result);
    }
    
    public function setdate(){
    	
    }
    
    /*
     * 货取模板信息
     * */
    
    public function gettemple(){
    	
    	//$this->blindParams($resertemplate = new ReserTemplate());
    	$result=$this->service->getdetailbyid((int)$_REQUEST['id']);
    	
    	//print_r($result);
    	echo json_encode($result);
    	
    }
    
    /**
     * 获取排班信息
     */
    public function getPaiban() {
    	$page=empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
    	$size=empty($_REQUEST['size']) ? 10 : $_REQUEST['size'];
    	$ttl = $this->service->getPaibanCount($_REQUEST);
    	$result = $this->service->getPaiban($_REQUEST);
    	echo json_encode(array(
    		'statu'=>true,
            'rows' => $result->data,
            'count' => $ttl->data,
    		'page' => $page,
    		'size' => $size
        ));
    }
    
    /*
     * 获取模板全部数据
     * 
     * */
    public function gettemdetail(){
    	
    	if (! strlen($_REQUEST['type'])) {
    		throw new ValidatorException(160);
    	}
    	if (! strlen($_REQUEST['tem_id'])) {
    		throw new ValidatorException(163);
    	}
     	$ResScheduleService = new ResScheduleService();     	
    	$result=$ResScheduleService->getdate($_REQUEST['type'],$_REQUEST['tem_id']);
    	$ResDoctorService = new ResDoctorService();
    	$date=array();    	
    	foreach ($result as $key => $val){
    		$date[$key]['date']=$val->date;    		
	    	if($val->morning!=null){
	    		$date[$key]['kind']='mon';
	    		$date[$key]['time']=$val->morning;
	    	}elseif($val->afternoon!=null){
	    		$date[$key]['kind']='aft';
	    		$date[$key]['time']=$val->afternoon;
	    	}else{
	    		$date[$key]['kind']='nig';
	    		$date[$key]['time']=$val->night;    		
	    	}    	
	    	$dos=unserialize($val->doctor_num);       	
	    	$docarray=array();
	    	reset($dos);
	    	while(list($k, $value)=each($dos)){	    			    		    		
	    		$docarray[$k]['name']=$ResDoctorService->getNameByID($k);  
	    		$docarray[$k]['num']=$value;	    		
	    	}
	    	$date[$key]['doctor_num']=$docarray;
    	}
    	$arrs=array('stute'=>true,'code'=>0,'msg'=>null,'date'=>$date);
    	echo json_encode($arrs);
    }
   
    
   
}