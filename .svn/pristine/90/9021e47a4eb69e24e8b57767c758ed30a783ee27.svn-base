<?php

class ResVationService extends BaseService {

    public function __construct() {
        $this->dao = new ResVationDAO();       
    }

    /**
     * 添加或编辑 .
     * ..
     */
    public function save($reservation) {
        $reservation->validate();
        $this->dao->save($reservation);
        return $this->success();
    }
    
    /**
     * 获取所有满足条件的医生排班信息列表
     * */
    public function getAllresvations() {
    	return $this->dao->getAllresvations();
    }    
   
    /**
     * 根据条件获取医生
     */
   public function getdoctors($where){
	   	$docs = new ResDoctorService();
	   	$dep = new ResDepartment();
	   	$depser = new ResDepartmentService();
	   	$doclist = $docs->query($where);
	   	//$docnums = $docs->totalRows($where);
	   	$result = array();
	   	foreach($doclist->data as $k => $v){
	   		$where['page'] = null;
	   		$where['size'] = null;
	   		$where['doctor_id'] = $v->id;
	   		$reser = $this->dao->query($where);
	   		if(empty($reser)){
	   			$dep->id = $v->department_id;
	   			$depinfo = $depser->get($dep);
	   			$reser[0] = $v;
	   			$reser[0]->doctor = $v->name;
	   			$reser[0]->doctor_id = $v->id;
	   			$reser[0]->department = $depinfo->data->name;
	   		}
	   		foreach ($reser as $key => $value) {
	   			//$reser[$key] = array_merge((array)$value,(array)$v); //将医生信息合并到排班信息
	   			$reser[$key]->content = $v->content;
	   			$reser[$key]->position = $v->position;
	   			$reser[$key]->description = $v->description;
	   			$reser[$key]->pic = UPLOAD . $v->pic;
	   			$value->week = date('w',strtotime($value->date));
   				if($value->morning != null && $value->morning != 0){
   				   	$value->morning = 1;
   				}
   				if($value->afternoon != null && $value->afternoon != 0){
   				   	$value->afternoon = 2;
   				}
   				if($value->night != null && $value->night != 0){
   				   	$value->night = 3;
   				}
	   		}
	   		$result[$v->name] = $reser;
	   	}
   	
   	
   	
   	
   	
// 	   	$reservations = $this->dao->getdoctors($where);
// 	   	$departmentS = new ResDepartmentService();
// 	   	$department = new DepartmentManager();
// 	   	$doctorS = new DoctorManagerService();
// 	   	$doctor = new DoctorManager();
	   	
// 	   	$docs = array();
// 	   	$result = array();
// 	   	$i = 0;
// 	   	foreach ($reservations as $k => $v) {
// 	   		$v->date = date('w', $v->date);
// 	   		$department->id = $v->department_id;
// 	   		$departmentContent = $departmentS->get($department);
// 	   		$doctor->id = $v->doctor_id;
// 	   		$doctorContent = $doctorS->get($doctor);
// 	   		$v->department = $departmentContent->data->name;
// 	   		$v->doctor = $doctorContent->data->name;
// 	   		$v->position = $doctorContent->data->position;
// 	   		$v->description = $doctorContent->data->description;
// 	   		$v->pic = $doctorContent->data->pic;
// 	   		if($v->morning != null){
// 	   			$v->morning = 1;
// 	   		}
// 	   		if($v->afternoon != null){
// 	   			$v->afternoon = 2;
// 	   		}
// 	   		if($v->night != null){
// 	   			$v->night = 3;
// 	   		}
// 	   	}
	   	
// 	   	foreach ($reservations as $k => $v) {
// 	   		$docs[$v->doctor] = $v->doctor;
// 	   	}
	   	
// 	   	foreach ($docs as $k => $v){
// 	   		$name = $v;
// 	   		$n=0;
// 	   		foreach($reservations as $b => $a){
	   			
// 	   			if($name == $a->doctor){
// 	   				$result[$name][$n] = $reservations[$b];
// 	   				$n++;
// 	   			}
// 	   		}
// 	   	}
	   	return $this->success($result);
   }
    
    /**
     * 查询指定的数据量...
     *
     * @param array $where
     * @return Result
     */
    public function query($where) { 
    	if(isset($_REQUEST['order'])&&$_REQUEST['order']){
    		$ordercolumun=$_REQUEST['order'];
    	}else{
    		$ordercolumun=array();
    	}    	
    	$ordernum=isset($ordercolumun[0]['column'])?$ordercolumun[0]['column']:1;    	
    	$ordertype=isset($ordercolumun[0]['dir'])?$ordercolumun[0]['dir']:" desc";
    	if(isset($_REQUEST['columns'])&&$_REQUEST['columns']){
    		$columns=$_REQUEST['columns'];
    	}
    	if(isset($_REQUEST['orderable'])&&$_REQUEST['orderable']){
    		$orderable=$columns[$ordernum]['orderable'];
    	}
    	if(isset($orderable)&&$orderable){
    		$orderdate=$columns[$ordernum]['data'];    	
    	}else{
    		$orderdate='date';    		
    	}
    	if(isset($_REQUEST['doctorname'])&&$_REQUEST['doctorname']){
    		$where['name']=$_REQUEST['doctorname'];
    	}     	  	
    	$where['sort']=$orderdate.' '.$ordertype;	
        $reservations=$this->dao->query($_REQUEST);  
        return $this->success($reservations);
    }
    
    public function totalRows($where) {    	
    	$ordercolumun=$_REQUEST['order'];
		if(isset($_REQUEST['search'])&&strlen($_REQUEST['search'])>0){
		    	$searcharray=$_REQUEST['search'];
		}else{
			$searcharray="";
		}
		if(isset($searcharray['value'])&&strlen($searcharray['value'])>0){
    		$searchval=$searcharray['value'];
    	}else{
    		$searchval="";
    	}   	
    	$obj=json_decode($searchval);
    	if($obj!=null){
	    	if(strlen($obj->name) != 0){
	    		$where['name']=$obj->name;
	    	}
	    	if(strlen($obj->department_id) != 0){
	    		$where['department_id']=$obj->department_id;
	    	}
	    	if(strlen($obj->starttime) != 0){
	    		$where['startdate']=strtotime($obj->starttime);
	    	}
	    	
	    	if(strlen($obj->endtime) != 0){
	    		$where['enddate']=strtotime($obj->endtime);
	    	}
    	}     	
    	$reservations = $this->dao->totalRows($where);
    	return $reservations;
    	
    }
    
    public function gettotal(){
    	return $this->dao->gettotalCount();
    	
    }
    
    public function updatedepartment($doctorid, $department_id){
    	$arr=array('doctor_id'=>$doctorid,'department_id'=>$department_id);
    	return $this->dao->updatedepartment($arr);
    }

    /*
     * 返回排班表状态， 0为开启，1为关闭
     * param int $state
     * */
    
    public function returnstate($state){
    	if($state!=null){
    		if($state==0){
    			return '已开放';
    		}else{
    			return '已停诊';
    		}
    	}else{
    		return '已停诊';
    	}
    }
    
    
    
    public function queryTag($where) {
        $departmentS = new DepartmentManagerService();
        $department = new DepartmentManager();
        $doctorS = new DoctorManagerService();
        $doctor = new DoctorManager();
        $reservations = $this->dao->query($where);
        foreach ($reservations as $k => $v) {
            $v->date = date('Y-m-d', $v->date);
            $department->id = $v->department_id;
            $departmentContent = $departmentS->get($department);
            $doctor->id = $v->doctor_id;
            $doctorContent = $doctorS->get($doctor);
            $v->department = $departmentContent->data->name;
            $v->doctor = $doctorContent->data->name;
            if ($v->morning) {
                $morning = explode('-', $v->morning);
                $num1 = strtotime($v->date . ' ' . $morning[1]) - strtotime($v->date . ' ' . $morning[0]);
            }
            if ($v->afternoon) {
                $afternoo = explode('-', $v->afternoon);
                $num2 = strtotime($v->date . ' ' . $afternoo[1]) - strtotime($v->date . ' ' . $afternoo[0]);
            }
            if ($v->night) {
                $night = explode('-', $v->night);
                $num3 = strtotime($v->date . ' ' . $night[1]) - strtotime($v->date . ' ' . $night[0]);
            }
    
            // 计算总数
            if (isset($num1) && ! empty($num1)) {
                $arr = array(
                    'department_id' => $v->department_id,
                    'doctor_id' => $v->doctor_id,
                    'date' => strtotime($v->date),
                    'start' => strtotime($v->date . ' ' . $morning[0]),
                    'end' => strtotime($v->date . ' ' . $morning[1])
                );
                $appCount1 = $this->getApproximately($arr);
                $number_1 = $this->getAllVerification($arr);
            } else {
                $number_1 = 0;
                $appCount1 = 0;
            }
            if (isset($num2) && ! empty($num2)) {
                $arr = array(
                    'department_id' => $v->department_id,
                    'doctor_id' => $v->doctor_id,
                    'date' => strtotime($v->date),
                    'start' => strtotime($v->date . ' ' . $afternoo[0]),
                    'end' => strtotime($v->date . ' ' . $afternoo[1])
                );
                $appCount2 = $this->getApproximately($arr);
                $number_2 = $this->getAllVerification($arr);
            } else {
                $number_2 = 0;
                $appCount2 = 0;
            }
            if (isset($num3) && ! empty($num3)) {
                $arr = array(
                    'department_id' => $v->department_id,
                    'doctor_id' => $v->doctor_id,
                    'date' => strtotime($v->date),
                    'start' => strtotime($v->date . ' ' . $night[0]),
                    'end' => strtotime($v->date . ' ' . $night[1])
                );
                $appCount3 = $this->getApproximately($arr);
                $number_3 = $this->getAllVerification($arr);
            } else {
                $number_3 = 0;
                $appCount3 = 0;
            }
            $v->count = $number_1 +  $number_2+ $number_3;
            $v->approximately = $appCount1 + $appCount2 + $appCount3;
        }
        return $this->success($reservations);
    }
    
    /*
     * 取可预约的数量
     * */
    public function getresnum($reservation){
    	$arr=array('id'=>$reservation->id);
    	$result=$this->dao->getresnum($arr);
    	
    	return $result;
    }
    
    
      
    
    
    
    
    
    
    /**
     * 根据id获取一条数据 .
     * ..
     */
    public function get($reservation) {
    	
        $this->dao->get($reservation->id, $reservation);
            
        $time = $reservation->date;
        $day = date('Y-m-d', $time);
        $reservation->date=$day;
        $departmentService = new ResDepartmentService();
        $doctorService = new ResDoctorService(); 
        $doctor=new ResDoctor();
        $department=new ResDepartment();
        
                 
        $doctor->id=$reservation->doctor_id;
        $department->id=$reservation->department_id;
        $num=0;
        if($reservation->morning){        	
        	$arr = explode('-',$reservation->morning);
        	$reservation->morStart=$arr[0];
        	$reservation->morEnd=$arr[1];
        	$num=$reservation->morning_source;
        	
        }
        if($reservation->afternoon){        	
        	$arr = explode('-',$reservation->afternoon);
        	$reservation->aftStart=$arr[0];
        	$reservation->aftEnd=$arr[1];
        	$num+=$reservation->afternoon_source;
        }
        if($reservation->night){ 
        	$arr = explode('-',$reservation->night);
        	$reservation->nigStart=$arr[0];
        	$reservation->nigEnd=$arr[1]; 
        	$num+=$reservation->night_source;
        }
        $reservation->wholeNum=$num;
        $reservation->department = $departmentService->getDepartmentNameByID($department->id);   
      
        $reservation->doctor = $doctorService->getNameByID($doctor->id);      
        
        return $this->success($reservation);
    }

    /**
     * 修改数据 .
     * ..
     *
     * @param object $reservation
     */
    public function update($reservation) {
        $reservation->validate();
        return $this->dao->update($reservation);
    }

    /**
     * 删除记录 .
     * ..
     *
     * @param array $ids
     */
    public function deleteBatch($ids) {
        Entity::isIds($ids);
        $beans = $this->dao->getBatch($ids);
        foreach ($beans as $v) {
            $arr = $v->export();
            $array = array(
                'department_id' => $arr['department_id'],
                'doctor_id' => $arr['doctor_id'],
                'date' => $arr['date']
            );
            $this->deleteAll($array);
        }
        return $this->dao->deleteBeans($beans);
    }

    /**
     * 添加到详细表 .
     * ..
     *
     * @param object $detail
     */
    public function addToDetail($detail) {
        $this->dao->addToDetail($detail);
    }

    
    
    /**
     * 获取详细列表 .
     * ..
     *
     * @param array $where
     * @return Result
     */
    public function getDetail($where) {
    	if($where['date']==null){
    		throw new ValidatorException(162);
    	}
    	if($where['department_id']==null){
    		throw new ValidatorException(67);
    	}
    	if($where['doctor_id']==null){
    		throw new ValidatorException(28);
    	}
    	$where['normaldate']=date('Y-m-d',$where['date']);    
        $resscheduleservice=new ResScheduleService();        
        $detai = $this->dao->getDetail($where);       
        if($_REQUEST['date']!=null){        
	        foreach ($detai as $k=>$v) {
				if($v->morning!=null&&strlen($v->morning)!=0){
					//$v->time=$v->morning;	
					$arrmon=explode('-',$v->morning);	
					$arrstart=strtotime($where['normaldate'].' '.$arrmon[0]);	
					$arrend=strtotime($where['normaldate'].' '.$arrmon[1]);
					$timeamount=$arrend-$arrstart;
				    $pertime=$timeamount/$v->along;
				    $arrtime=array();
				    $arrtime[0]=$arrstart;
				    $arrtime[$v->along]=$arrend;
				    for ($i=1;$i<$v->along;$i++){
					   $arrtime[$i]=$arrstart+$pertime;
					   $arrstart=$arrstart+$pertime;
				    }
				    $montimeset=array();
				    $atest=array();
					 for($s=0;$s<count($arrtime)-1;$s++){
					 	$montimeset[$s]=date('h:i',$arrtime[$s]).'-'.date('h:i',$arrtime[$s+1]);
					 	$checkarr=array('timestart'=>$arrtime[$s],'timeend'=>$arrtime[$s+1],'department_id'=>$where['department_id'],'doctor_id'=>$where['doctor_id'],'date'=>$where['date']);
					 	$result=$resscheduleservice->getreserbetw($checkarr);
					 	if($result!=null){
					 		unset($montimeset[$s]);				 				
					 	}	
					 }
					 $v->timearrange=array_merge($montimeset);
				}elseif($v->afternoon!=null&&strlen($v->afternoon)!=0){	
					//$v->time=$v->afternoon;
					$arraft=explode('-',$v->afternoon);	
					$arrstart=strtotime($where['normaldate'].' '.$arraft[0]);
					$arrend=strtotime($where['normaldate'].' '.$arraft[1]);
					$timeamount=$arrend-$arrstart;
					if($v->along!=0){
					$pertime=$timeamount/$v->along;
					}else{
					$pertime=$timeamount;						
					}
					$arrtime=array();
					$arrtime[0]=$arrstart;
					$arrtime[$v->along]=$arrend;
					for ($i=1;$i<$v->along;$i++){
						$arrtime[$i]=$arrstart+$pertime;
						$arrstart=$arrstart+$pertime;
					}
					$afttimeset=array();
					$atest=array();
					for($s=0;$s<count($arrtime)-1;$s++){
						$afttimeset[$s]=date('h:i',$arrtime[$s]).'-'.date('h:i',$arrtime[$s+1]);
						$checkarr=array('timestart'=>$arrtime[$s],'timeend'=>$arrtime[$s+1],'department_id'=>$where['department_id'],'doctor_id'=>$where['doctor_id'],'date'=>$where['date']);
						$result=$resscheduleservice->getreserbetw($checkarr);
						if($result!=null){
							unset($afttimeset[$s]);
						}
					}
					$v->timearrange=array_merge($afttimeset);	
				}else{			
					$arrnig=explode('-',$v->night);	
					$arrstart=strtotime($where['normaldate'].' '.$arrnig[0]);
					$arrend=strtotime($where['normaldate'].' '.$arrnig[1]);
					$timeamount=$arrend-$arrstart;	
					$pertime=$timeamount/$v->along;
					$arrtime=array();
					$arrtime[0]=$arrstart;
					$arrtime[$v->along]=$arrend;	
					for ($i=1;$i<$v->along;$i++){
						$arrtime[$i]=$arrstart+$pertime;
						$arrstart=$arrstart+$pertime;
					}
					$nigtimeset=array();
					$atest=array();	
					for($s=0;$s<count($arrtime)-1;$s++){
						$nigtimeset[$s]=date('h:i',$arrtime[$s]).'-'.date('h:i',$arrtime[$s+1]);
						$checkarr=array('timestart'=>$arrtime[$s],'timeend'=>$arrtime[$s+1],'department_id'=>$where['department_id'],'doctor_id'=>$where['doctor_id'],'date'=>$where['date']);
						$result=$resscheduleservice->getreserbetw($checkarr);
						if($result!=null){
							unset($nigtimeset[$s]);				
						}
					}
					$v->timearrange=array_merge($nigtimeset);
				}
		            $v->date = date('Y-m-d', $v->date);
		            $v->available=$v->along-$v->mark;
		            $v->price=0;
		        }    
	        return $this->success($detai);
	    }
    }
    /**
     * 获取可预约时间
     * ..
     *
     * @param array $where
     * @return Result
     */
    public function getDetail2($where) {
    	if($where['date']==null){
    		throw new ValidatorException(162);
    	}
    	if($where['department_id']==null){
    		throw new ValidatorException(67);
    	}
    	if($where['doctor_id']==null){
    		throw new ValidatorException(28);
    	}
		$time_point	= '';$morning_point='';	$after_point='';$night_point='';
        $detai = $this->dao->getDetail($where);
		if(count($detai)>0){
			foreach($detai as $key=>$val){
				unset($val->department_id,$val->doctor_id,$val->along,$val->state,$val->time_point);
				if($val->morning){
					$val->morning_point = $val->morning_point.'@';
					$morning_point = preg_replace('/@/','|'.$val->id.'@',$val->morning_point);
				}
				if($val->afternoon){
					$val->after_point = $val->after_point.'@';
					$after_point = preg_replace('/@/','|'.$val->id.'@',$val->after_point);
				}
				if($val->night){
					$val->night_point = $val->night_point.'@';
					$night_point = preg_replace('/@/','|'.$val->id.'@',$val->night_point);
				}
			}
		$time_point = $morning_point.$after_point.$night_point;//时间.'|'.id.'@'
			$detail = new ResBookingInfoService();			
		$times = $detail->getReserBetwTimes($where);	
			if(count($times)>0){
				foreach($times as $val){
					$time = '/'.date('H:i', $val['times']).'\|'.$val['rid'].'@/';
					$time_point = preg_replace($time,'',$time_point);					
				}
			}
				$time_point = substr($time_point, 0, strlen($time_point) - 1);
			$time_point = explode('@',$time_point);	
		}
		
	    return $this->success($time_point);	
	}
    /**
     * 获取详细页的总数 .
     * ..
     *
     * @param array $where
     * @return Result
     */
    public function getCount($where) {
        $count = $this->dao->getCount($where);
        return new Result(true, 0, '', $count);
    }
    /**
     * 获取详细页的总数 .
     * ..
     *
     * @param array $where
     * @return Result
     */
    public function saveBookingInfo() {
    	$count = $this->dao->getCount($where);
    	return new Result(true, 0, '', $count);
    }
    
    
    /**
     * 删除详细列表...
     *
     * @param array $ids
     */
    public function deleteDetail($ids) {
        Entity::isIds($ids);
        $beans = $this->dao->detailBatch($ids);
        return $this->dao->deleteDetail($beans);
    }

    /*根据科室，医生，日期删除详细表中的记录...
     * 
     * @param $date, $department_id
     */
    public function delete_indate($date) {
    	$arr=array( 'date'=>$date );
        $this->dao->delete_indate($arr);
    }
    /**
     * 根据科室，医生，日期删除详细表中的记录...
     */
    public function deleteAll($arr) {
        $this->dao->deleteAll($arr);
    }

    /**
     * 获取已约总数
     */
    public function getApproximately($array) {
        return $this->dao->getApproximately($array);
    }
    
    /**
     * 根据条件获取总号数...
     */
    public function getAllVerification($array){
    	return $this->dao->getAllVerification($array);
    }

    /**
     * 获取详细页所有的数据
     *
     * @return Result
     */
    public function getDetailAll() {
        $detailAll = $this->dao->getDetailAll();
        $departmentS = new DepartmentService();
        $department = new Department();
        $doctorS = new DoctorService();
        $doctor = new Doctor();
        $contact = new Contact();
        $contact->id = 1;
        $contactS = new ContactService();
        $res = $contactS->get($contact);
        $department_id = 0;
        $doctor_id = 0;
        foreach ($detailAll as $detail) {
            if ($department_id != $detail->department_id) {
                $department_id = $detail->department_id;
                $department->id = $department_id;
                $departmentC = $departmentS->get($department);
            }
            if ($doctor_id != $detail->doctor_id) {
                $doctor_id = $detail->doctor_id;
                $doctor->id = $detail->doctor_id;
                $doctorC = $doctorS->get($doctor);
            }
            unset($detail->department_id, $detail->doctor_id);
            $detail->department = $departmentC->data->name;
            $detail->doctor = $doctorC->data->name;
            $detail->times = date('G:i', $detail->times);
            $detail->hospital = $res->data->val;
        }
        return $this->success($detailAll);
    }

    /**
     * 将预约者添加到预约表中去
     *
     * @param unknown_type $entity
     * @return Result
     */
    public function reserUser($entity) {
        $entity->validate();
        $this->dao->reserUser($entity);
        return $this->success();
    }
	
	public function reservationDetail($entity){
	    $this->dao->reservationDetail($entity);
	    return $this->success();
	}
	
	public function queryDetail(){
	    $res=$this->dao->queryDetail();
	    return $res;
	}
	/**
	 * 获取排班信息总数
	 */
	public function getPaibanCount($where){
		$count = $this->dao->getPaibanCount($where);
		return $this->success($count);
	}
	/**
	 * 获取排班信息
	 */
	public function getPaiban($where){
		$reservations = $this->dao->getPaiban($where);
		foreach ($reservations as $v){
			$v->date=date('Y-m-d',$v->date);
		}
		return $this->success($reservations);
	}
	/*
	 * 检查特定日期是否存在数据
	 * 
	 * */
	
	public function date_exist($date){
	if(!is_array($date)){
		$arr['date']=$date;
	}else{
		$arr=$date;
	}
		return $this->dao->date_exist($arr);
	}
	
	
	public function check_date($date,$department_id,$doctor_id,$timetype=null){
		$arr=array('date'=>$date,'department_id'=>$department_id,'doctor_id'=>$doctor_id);
		return $this->dao->date_existbean($arr,$timetype);
	}
	/*
	 *
	 * 设置指定日期的早上排班信息
	 * 
	 * */
	public function setmon_date($reservation){		
		$reservation->validate();		
        $array=array('date'=>$reservation->date,'department_id'=>$reservation->department_id,'doctor_id'=>$reservation->doctor_id);
        $ress=$this->dao->date_deparment_exist($array); 
		if($ress!=null){			
			$ress->morning=$reservation->morning;
			$ress->morning_point=$reservation->morning_point;
			$ress->morning_source=$reservation->morning_source;
			$ress->time_point=$reservation->time_point;
			$this->dao->update($ress);
		}else{			
			$this->dao->save($reservation);			
		}        				
	}
	
	/*
	 *
	* 设置指定日期下午的排班信息
	*
	* */
	public function setaft_date($reservation){
		$reservation->validate();	
		$array=array('date'=>$reservation->date,'department_id'=>$reservation->department_id,'doctor_id'=>$reservation->doctor_id);
		$ress=$this->dao->date_deparment_exist($array);
		if($ress!=null){
			$ress->afternoon=$reservation->afternoon;
			$ress->afternoon_source=$reservation->afternoon_source;
			$ress->after_point=$reservation->after_point;
			$ress->time_point=$reservation->time_point;
			$this->dao->update($ress);
		}else{	
			$this->dao->save($reservation);	
		}	
	}
	
	/*
	 *
	* 设置指定日期晚上的排班信息
	*
	* */
	public function setnig_date($reservation){		
		$reservation->validate();	
		$array=array('date'=>$reservation->date,
				'department_id'=>$reservation->department_id,
				'doctor_id'=>$reservation->doctor_id
		);
		$ress=$this->dao->date_deparment_exist($array);
		if($ress!=null){
			$ress->night=$reservation->night;
			$ress->night_source=$reservation->night_source;
			$ress->night_point=$reservation->night_point;
			$ress->time_point=$reservation->time_point;
			$this->dao->update($ress);
		}else{	
			$this->dao->save($reservation);	
		}
	
	}
	/*
	 * 预约加号的处理函数
	 * 
	 * */
	public function addnum($reservation,$num){
		$arr=array('id'=>$reservation->id);
		$result=$this->dao->getBatch($arr);
		if($result!=null){

		
		$result[$reservation->id]->along=$result[$reservation->id]->along+(int)$num;

           
		$this->dao->update($result[$reservation->id]);
		}
	}
	
	/*
	 * 更新号源数
	 * 
	 * */
	public function update_num($reservation){
		$arr=array('id'=>$reservation->id);
		$result=$this->dao->getBatch($arr);
		if($result!=null){
			if($reservation->morning_source!=''&&$reservation->morning_source!=0){
				$result[$reservation->id]->morning_source=$reservation->morning_source;
			}			
			if($reservation->afternoon_source!=''&&$reservation->afternoon_source!=0){
				$result[$reservation->id]->afternoon_source=$reservation->afternoon_source;
			}
			if($reservation->night_source!=''&&$reservation->night_source!=0){
				$result[$reservation->id]->night_source=$reservation->night_source;
			}
			if($reservation->morning!=''){
				$result[$reservation->id]->morning=$reservation->morning;
			}
			if($reservation->afternoon!=''){
				$result[$reservation->id]->afternoon=$reservation->afternoon;
			}
			if($reservation->night!=''){
				$result[$reservation->id]->night=$reservation->night;
			}
			if($reservation->department_id!=''){
				$result[$reservation->id]->department_id=$reservation->department_id;
			}
			if($reservation->doctor_id!=''){
				$result[$reservation->id]->doctor_id=$reservation->doctor_id;
			}					
			$result[$reservation->id]->morning_point=$reservation->morning_point;
			$result[$reservation->id]->after_point=$reservation->after_point;
			$result[$reservation->id]->night_point=$reservation->night_point;
			$result[$reservation->id]->time_point=$reservation->time_point;
			$ret=$this->dao->update($result[$reservation->id]);
			if($ret!=''){
				return new Result(true, 0, '', NULL);
			}else{
				return new Result(false, 0, '保存失败，请重试!', NULL);
			}
			
		}
	}
	
	/*
	 * 
	 * 设置停诊
	 * */
	public function setstop($reservation){
		$arr=array('id'=>$reservation->id);
		$result=$this->dao->getBatch($arr);
		if($result!=null){
			$result[$reservation->id]->state=$_REQUEST['type'];
			$ret=$this->dao->update($result[$reservation->id]);
			if($ret!=''){
				return new Result(true, 0, '', NULL);
			}else{
				return new Result(false, 0, '保存失败，请重试!', NULL);
			}
		}
	}
	/**
	 * 已预约数加1 
	 */
	public function addresnum($reservation){
		

		$arr=array('id'=>$reservation->id);
		$result=$this->dao->getBatch($arr);	
		if(!empty($result)){
			$num=(int)($result[$reservation->id]->morning_source+$result[$reservation->id]->afternoon_source+$result[$reservation->id]->night_source-$result[$reservation->id]->mark);            

            if($num>0){
				$result[$reservation->id]->mark=$result[$reservation->id]->mark+1;
            }
			if($result[$reservation->id]->morning_source>0){
				$dtime = 1;
			}elseif($result[$reservation->id]->afternoon_source>0){
				$dtime = 2;			
			}elseif($result[$reservation->id]->night_source>0){
				$dtime = 3;			
			}
			$ret=$this->dao->update($result[$reservation->id]);	
			if($ret!=''){
				return new Result(true, 0, '', $dtime);
			}else{
				return new Result(false, 0, '保存失败，请重试!', NULL);
			}		
		}
	}
	
	/*
	 * 已预约数减1
	 * 
	 * */
	public function reducemarknum($arr){		
		$result=$this->dao->getBatch($arr);		
		if($result!=null){
			$id=$arr['id'];
			if($result[$id]->mark>=1){
				$result[$id]->mark=$result[$id]->mark-1;
			}
			$ret=$this->dao->update($result[$id]);
			if($ret!=''){
				return new Result(true, 0, '', NULL);
			}else{
				return new Result(false, 0, '保存失败，请重试!', NULL);
			}
		}
	}
	
	
	/*
	 * 把详细数据插入预约挂号用户表
	 * 
	 * */
	public function insertuser($name,$sex,$age,$date,$time,$address,$hometel,$email,$ill,$reservation_id=0,$reservation_fid,$member_id){
		
		$sql = "INSERT INTO `resuser` (`name`,`sex`,`age`,`date`,`time`,`address`,`hometel`,`email`,`description`,`reservation_id`,`reservation_fid`,`member_id`) VALUES (
		:name,:sex,:age,
		:date,:time,:address,:hometel,:email,
		:ill,:reservation_id,:reservation_fid,:member_id
		)";
		$arrresuser=array('name'=>$name,
				'sex'=>$sex,
				'age'=>$age,
				'date'=>$date,
				'time'=>$time,
				'address'=>$address,
				'hometel'=>$hometel,
				'email'=>$email,
				'ill'=>$ill,
				'reservation_id'=>$reservation_id,
				'reservation_fid'=>$reservation_fid,
				'member_id'=>$member_id
		);
		
		
		
		R::exec($sql,$arrresuser);
	}
	/*
	 * 查询指定区间内的排班表信息
	 * $param array();
	 * 
	 * */
	public function getweekreservation($startdate,$enddate){
		$arr=array('startdate'=>$startdate,'enddate'=>$enddate,'state'=>0);
		return $this->dao->getresbetween($arr);
	}
	
	public function getDocList($where, $limit, $order) {
	    return $this->dao->getDocList($where, $limit, $order);
	}
	
	/*
	 * 取指定日期期间的某个医生排班表
	 * 
	 * */
	public function getdoctorindate($doctor_id,$start,$end){
		$arr=array('doctor_id'=>$doctor_id,'start'=>$start,'end'=>$end);
		
		return $this->dao->getdoctorindate($arr);		
	}
	/*
	 * 前端请求科室挂号信息方法
	 * */
	public function getreservatiobydep($where){
		$reservations = $this->dao->query($where);
		
		foreach ($reservations as $k => $v) {
		
			$reservations[$k]->times = $v->morning. ' ' . $v->afternoon . ' ' . $v->night;
			$reservations[$k]->date = date('Y-m-d', $v->date);
		}
		
		
		
		return $this->success($reservations);
	}
	
	/*
	 * 删除某个医生的所有排班信息
	 * */
	public function deleteresbydocid($id){
		$arr=array('doctor_id'=>$id);
		$this->dao->deleteresbydocid($arr);
	}
	
	/*
	 * 删除某个科室的所有排班信息
	* */
	public function deleteresbydepid($id){
		$arr=array('department_id'=>$id);
		$this->dao->deleteresbydepid($arr);
	}
  	/**
	 * 获取今天可预约的时间段
	 * */
  public function getDoctorReservation($arr){
        $result = $this->dao->getDoctorReservation($arr);
		return $this->success($result);		
  } 
	
  	/**
	 * 专家出诊表
	 * */
  public function queryDateList($where,$department_id){
        $result = $this->dao->queryDateList($where);
		$array=array();
		$array['isnull'] = 0;
		if($result){
			for($i=1;$i<=7;$i++){
				$array['morning'][$i]='';
				$array['afternoon'][$i]='';
				$array['night'][$i]='';
			}
			$resdoctorService =new ResDoctorService();
			foreach($result as $key =>$val){
				$w = date('w',$val['date']);
				if($w==0)$w=7;
				if($val['department_id']==$department_id){
					if($val['morning'] !=''){
						$doctor=$resdoctorService->getNamePositionById($val['doctor_id']);
						$array['morning'][$w]['url'] = NETADDRESS.'/doctor/'.$val['doctor_id'].'.html';					
						$array['morning'][$w]['name'] = $doctor['name'];
						$array['morning'][$w]['position'] = $doctor['position'];
					}
					if($val['afternoon'] !=''){
						$doctor=$resdoctorService->getNamePositionById($val['doctor_id']);
						$array['afternoon'][$w]['url'] = NETADDRESS.'/doctor/'.$val['doctor_id'].'.html';					
						$array['afternoon'][$w]['name'] = $doctor['name'];
						$array['afternoon'][$w]['position'] = $doctor['position'];					
					}
					if($val['night'] !=''){
						$doctor=$resdoctorService->getNamePositionById($val['doctor_id']);
						$array['night'][$w]['url'] = NETADDRESS.'/doctor/'.$val['doctor_id'].'.html';	
						$array['night'][$w]['name'] = $doctor['name'];
						$array['night'][$w]['position'] = $doctor['position'];					
					}
					$array['isnull'] = 1;
				}
			}
			unset($result);		
		}
		return $array;		
  } 	
	/**
	 * 获取统计数据
	 * */
	public function getStatData() {
	    return $this->dao->getStatData($_REQUEST);
	}
    /**
     * 更新统计数据
     * */
    public function updateStatData($start, $end) {
        try {
            $result = $this->dao->getResVationData($start, $end);
            $data = array();
            foreach ($result as $value) {
                $date = date('Y-m-d', $value['date']);
				$department_id = $value['department_id'];
				$arrive = $this->getArriveTotal($value['date'],$value['department_id']);
				$about = $this->getAboutNumber($value['date'],$value['department_id']);
				if(isset($data[$date])){
					if($value['morning_source']){
						$data[$date]->day_1_state_1 += $value['mark'];
						$data[$date]->day_1_state_2 += $value['morning_source']-$value['mark'];
					}
					if($value['afternoon_source']){
						$data[$date]->day_2_state_1 += $value['mark'];
						$data[$date]->day_2_state_2 += $value['morning_source']-$value['mark'];
					}
					if($value['night_source']){
						$data[$date]->day_3_state_1 += $value['mark'];
						$data[$date]->day_3_state_2 += $value['morning_source']-$value['mark'];
					}
					$data[$date]->department  = $this->setDepartment($data[$date]->department,$department_id,$about,$arrive);					
					$rvdata = $data[$date];
				}else{
					$rvdata = $this->initResVationData($value['date']);
					if($value['morning_source']){
						$rvdata->day_1_state_1 = $value['mark'];
						$rvdata->day_1_state_2 = $value['morning_source']-$value['mark'];
					}
					if($value['afternoon_source']){
						$rvdata->day_2_state_1 = $value['mark'];
						$rvdata->day_2_state_2 = $value['morning_source']-$value['mark'];
					}
					if($value['night_source']){
						$rvdata->day_3_state_1 = $value['mark'];
						$rvdata->day_3_state_2 = $value['morning_source']-$value['mark'];
					}
					$rvdata->department  = $this->setDepartment('',$department_id,$about,$arrive);
				}

				$rvdata->data_md5 = md5(serialize($rvdata));
				$data[$date] = $rvdata;
            }
            $result = $this->dao->updateStatData($data);
            if (!$result) return $this->fail('', "数据统计更新失败");
        } catch (Exception $e) {
            return $this->fail('', $e->getMessage());
        }
        
    	return $this->success();
    }
 	/*
     * 更新字段department 1 about已约 2 arrive 到达
     * */   
    public function setDepartment($department,$department_id,$about,$arrive) {
		if($department){
			$department = unserialize($department);	
			if(in_array($department_id, array_keys($department))){
				$department[$department_id][1] +=$about;
				$department[$department_id][2] +=$arrive;
			}else{
				$department[$department_id][1] = $about;
				$department[$department_id][2] = $arrive;
			}
			$department = serialize($department);		
		}else{
			$department[$department_id][1] = $about;
			$department[$department_id][2] = $arrive;
			$department = serialize($department);	
		}
		return $department;
	}
    /**
     * 初始化统计对象
     * */
    protected function initResVationData($time_week) {
        $rvdata = new ResVationData();
        $rvdata->week = date("w",$time_week);
        $rvdata->daytime = date("Y-m-d",$time_week);
         
        $rvdata->day_1_state_1 = 0;
        $rvdata->day_2_state_1 = 0;
        $rvdata->day_3_state_1 = 0;
        $rvdata->day_1_state_2 = 0;
        $rvdata->day_2_state_2 = 0;
        $rvdata->day_3_state_2 = 0;         
        return $rvdata;
    }
    /**
     * 获取所以需统计的日期
     * */
    public function getStatDate() {
    	return $this->dao->getStatDate();
    }
   /**
     * 保存数据
     *
     * @param Entity 
     * @return Result
     */
    public function saveResVationData($rvdata,$info) {
		$info['about'] = ($info['type'] == 1) ? 1 : $info['about']; 
		$info['arrive'] = ($info['type'] == 1) ? $info['arrive'] : 1;
		$rvdata->department = $this->setDepartment('',$info['department_id'],$info['about'],$info['arrive']);
		$rvdata->data_md5 = md5(serialize($rvdata));		
        return $this->dao->saveResVationData($rvdata);
	}
    /**
     * 更新数据
     *
     * @param Entity 
     * @return Result
     */
    public function updateResVationData($rvdata,$info) {
		$info['about'] = ($info['type'] == 1) ? 1 : $info['about']; 
		$info['arrive'] = ($info['type'] == 1) ? $info['arrive'] : 1;
		$rvdata->department = $this->setDepartment($info['department'],$info['department_id'],$info['about'],$info['arrive']);
		$rvdata->data_md5 = md5(serialize($rvdata));		
        return $this->dao->updateResVationData($rvdata);		
	}
	/*
	 * 检验数据存在
	 * */
	public function checkData($time){
        return $this->dao->checkDataIsAdd($time);		
	}
    /**
     * 获得一天的上下晚号源、已约总数
     * */
    public function getNumberTotal($time){
		$array = array();
		$array['mn'] = $array['an'] = $array['nn'] = $array['m_mark'] = $array['a_mark'] = $array['n_mark'] = 0;
		$where['start_time'] = $time;
		$where['end_time'] = $time + 86399;		
		$result =  $this->dao->getNumberTotal($where);
		foreach($result as $key=>$val){
			if($val['morning_source']){	
				$array['mn'] += $val['morning_source'];
				$array['m_mark'] += $val['mark'];
			}
			if($val['afternoon_source']){	
				$array['an'] += $val['afternoon_source'];
				$array['a_mark'] += $val['mark'];
			}
			if($val['night_source']){	
				$array['nn'] += $val['night_source'];
				$array['n_mark'] += $val['mark'];
			}			
		}
		unset($result);
		return $array;
	}
    /**
     * 获得已到诊总数
     * */
    public function getArriveTotal($time,$department_id){
		$where['start'] = $time;
		$where['end'] = $time + 86399;
		$where['department_id'] = $department_id;
		return $this->dao->getArriveTotal($where);		
	}
    /**
     * 获得已约总数
     * */
    public function getAboutNumber($time,$department_id){
		$where['start'] = $time;
		$where['end'] = $time + 86399;
		$where['department_id'] = $department_id;
		return $this->dao->getAboutNumber($where);		
	}	
}