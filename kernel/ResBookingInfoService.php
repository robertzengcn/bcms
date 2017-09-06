<?php

class ResBookingInfoService extends BaseService {

    public function __construct() {
    	
        $this->dao = new ResBookingInfoDAO();
    }

    /**
     * 保存预约人信息
     * ..
     */
    public function save($reservation) {
        $reservation->validate();    
        $rs=$this->dao->save($reservation);        
        return $this->success($rs);
    }
    
    /**
     * 获取一定时间范围内的详细数据
    *
    * */
    
    public function getreserbetw($arr){
    	return $this->dao->getreserbetwmon($arr);
    }
    /**
     * 获取一定时间范围内的详细数据时间
    *
    * */
    
    public function getReserBetwTimes($arr){
    	return $this->dao->getReserBetwTimes($arr);
    }
    /**
     * 查询指定的数据量...
     *
     * @param array $where
     * @return Result
     */
    public function query($where) {      	 	
        if(isset($_REQUEST['date'])&&$_REQUEST['date']!=null){
        	$where['date']=strtotime($_REQUEST['date']);
        }
        if(isset($_REQUEST['starttime'])&&$_REQUEST['starttime']!=null){
        	$where['starttime']=strtotime($_REQUEST['date'].' '.$_REQUEST['starttime']);
        }
        if(isset($_REQUEST['endtime'])&&$_REQUEST['endtime']!=null){
        	$where['endtime']=strtotime($_REQUEST['date'].' '.$_REQUEST['endtime']);
        }
        if(isset($_REQUEST['docID'])&&$_REQUEST['docID']){
        	$where['doctor_id']=$_REQUEST['docID'];
        }
        if(isset($_REQUEST['doctorname'])&&$_REQUEST['doctorname']){
        	$doctorservice=new ResDoctorService();
        	$doctor=$doctorservice->getdoctor_name($_REQUEST['doctorname']);
        	$where['doctor_id']=$doctor->name;
        }
        if(isset($_REQUEST['name'])&&$_REQUEST['name']){
        	$where['username']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['phone'])&&$_REQUEST['phone']){
        	$where['telephone']=$_REQUEST['phone'];
        }
        $reservations = $this->dao->query($where);        
		$resderpartment=new ResDepartmentService();
		$resdoctor=new ResDoctorService();		
        foreach ($reservations as $k => $v) {
        	$v->departmentname=$resderpartment->getDepartmentNameByID($v->department_id);        	
        	$v->doctorname=$resdoctor->getNameByID($v->doctor_id);
            $v->date = date('Y-m-d', $v->date);
            $v->times=date('H:i',$v->times);
            $v->make_time=date('Y-m-d H:i:s',$v->make_time);
        }         
        return $this->success($reservations);
    }
    
    
    public function totalRows($where){
    	 
    	if(isset($_REQUEST['date'])&&$_REQUEST['date']!=null){
    		$where['date']=strtotime($_REQUEST['date']);
    	}
    	if(isset($_REQUEST['start'])&&$_REQUEST['start']!=null){
    		$where['start']=strtotime($_REQUEST['date'].' '.$_REQUEST['start']);
    	}
    	if(isset($_REQUEST['end'])&&$_REQUEST['end']!=null){
    		$where['end']=strtotime($_REQUEST['date'].' '.$_REQUEST['end']);
    	}

    	return $this->dao->totalRows($where);
    }
    
    public function gettotal(){
    	return $this->dao->gettotalCount();
    }
    
    /**
     * 获取所有满足条件预约人的信息列表
     * */
    public function getAllbookinginfos($where) {    	
    	return $this->dao->getAllbookinginfos($where);
    }
    
    /**
     * 获取所有满足条件预约人的信息列表
     * */
    public function getbookingByCondition($where) {
    	return $this->dao->getAllbookinginfos($where);
    }
    
    /**
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
        $departmentS = new DepartmentService();
        $department = new Department();
        $doctorS = new DoctorService();
        
        $doctor = new Doctor();
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
      
    /**
     * 将前端提交预约的患者信息存入
     */
    public function saveBookingInfo($resbookinginfo) {
    	  	
    	$reservation = new ResVation(); 
    	$resvationservice=new ResVationService();
    	$resdepser=new ResDepartmentService();
    	$resdorser=new ResDoctorService();
    	
    	$resbookinginfo->make_time=time(); 
    	 
    	$resv=$this->dao->save($resbookinginfo); 
    	
    	$department=new ResDepartment();
    	$department->id=$resv->department_id;
    	$department=$resdepser->get($department)->data;
    	
    	$doctor=new ResDoctor();
    	$doctor->id=$resv->doctor_id;
    	$doctor=$resdorser->get($doctor)->data;
    	
    	if($resv->id){
    		$reservation->id=$resv->resvation_id;
    		$result = $resvationservice->addresnum($reservation);
    		//$resvationservice->insertuser($_REQUEST['username'],$_REQUEST['sex'],$_REQUEST['age'],$_REQUEST['date'],$resbookinginfo->times,$_REQUEST['address'],$_REQUEST['telephone'],$_REQUEST['email'],$_REQUEST['ill_info'],0,$resv->data->id);
			if($result->statu){
				$resdata = $resvationservice->checkData($resv->date);
					
				$rvdata = new ResVationData();
				$rvdata->week = date("w",$resv->date);
				$rvdata->daytime = date('Y-m-d',$resv->date);
				$duan = $result->data;
				$about = 'day_'.$duan.'_state_1';
				$no = 'day_'.$duan.'_state_2';
				$arrive = $resvationservice->getArriveTotal($resv->date,$resv->department_id);
				if($resdata){
					$rvdata->id = $resdata->id;
					$rvdata->day_1_state_1 = $resdata->day_1_state_1;
					$rvdata->day_2_state_1 = $resdata->day_2_state_1;
					$rvdata->day_3_state_1 = $resdata->day_3_state_1;
					$rvdata->day_1_state_2 = $resdata->day_1_state_2;
					$rvdata->day_2_state_2 = $resdata->day_2_state_2;
					$rvdata->day_3_state_2 = $resdata->day_3_state_2;
					$rvdata->$about = $resdata->$about+1;
					$rvdata->$no = $resdata->$no-1;
					$info['department'] = $resdata->department;
					$info['department_id'] = $resv->department_id;
					$info['type'] = 1;
					$info['arrive'] = $arrive;
					$resvationservice->updateResVationData($rvdata,$info);
				}else{
					$rvinfo = $resvationservice->getNumberTotal($resv->date);
					$rvdata->day_1_state_1 = $rvinfo['m_mark'];
					$rvdata->day_2_state_1 = $rvinfo['a_mark'];
					$rvdata->day_3_state_1 = $rvinfo['n_mark'];
					$rvdata->day_1_state_2 = $rvinfo['mn']-$rvinfo['m_mark'];
					$rvdata->day_2_state_2 = $rvinfo['an']-$rvinfo['a_mark'];
					$rvdata->day_3_state_2 = $rvinfo['nn']-$rvinfo['n_mark'];
					$info['department_id'] = $resv->department_id;
					$info['arrive'] = $arrive;
					$info['type'] = 1;					
					$resvationservice->saveResVationData($rvdata,$info);						
				}	
			}
    	}
		
    	if (class_exists('ClientService')) {//判断client表里是否存在这个用户
    		$clientser=new ClientService();
    		
    		$resresult=$clientser->getclientbytn($resbookinginfo->telephone,$resbookinginfo->username)->data;
    		if(!$resresult->id){//如果client表里不存在
    			$client=new Client();
    			$client->username=$resbookinginfo->username;
    			$client->gender=$resbookinginfo->sex;
    			$client->age=$resbookinginfo->age;
    			$client->address=$resbookinginfo->address;
    			$client->telephone=$resbookinginfo->telephone;
    			$client->plushtime=time();
    			$clientser->save($client);    			
    		}
    	}
    	
    	$result=array('statu'=>true,'code'=>0,'msg'=>null,'data'=>'成功预约'.date('Y-m-d',$resbookinginfo->date).' '.date('H:i:s',$resbookinginfo->times).' '.$department->name.' '.$doctor->name.' 预约号：'.$resbookinginfo->id);
    	return $result;    	
    }
    
    /**
     * 根据id获取resvation_id
     * ..
     */
    public function getResvationID($ID) {
    	return $this->dao->getResvationID($ID);
    }    
    
    
    
    /**
     * 根据id获取一条数据 .
     * ..
     */
    public function get($reservation) {    	
        $this->dao->get($reservation->id, $reservation);
        if($reservation->id){
        $resdepartser=new ResDepartmentService();
        $resdocser=new ResDoctorService();  
        $doctor=new ResDoctor();
        $department=new ResDepartment();
        $doctor->id = $reservation->doctor_id;
        $department->id = $reservation->department_id;
        $reservation->department=$resdepartser->getDepartmentNameByID($department->id);
        $reservation->doctor=$resdocser->getNameByID($doctor->id);   
        if($reservation->sex==1){
        	$reservation->sex='男';
        }else{
        	$reservation->sex='女';
        }
        $reservation->time=date('Y-m-d H:i',$reservation->times);
        $reservation->tel=$reservation->telephone; 
        return $this->success($reservation);
        }else{
        	return $this->fail(15,'没有找到预约信息');
        }
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
        $departmentS = new DepartmentService();
        $department = new Department();
        $doctorS = new DoctorService();
        $doctor = new Doctor();
        $department->id = $where['department_id'];
        $departmentContent = $departmentS->get($department);
        $doctor->id = $where['doctor_id'];
        $doctorContent = $doctorS->get($doctor);
        $detai = $this->dao->getDetail($where);
        foreach ($detai as $v) {
            $v->department = $departmentContent->data->name;
            $v->doctor = $doctorContent->data->name;
            $v->times = date('G:i', $v->times);
            $v->date = date('Y-m-d', $v->date);
        }
        return $this->success($detai);
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
     * 根据条件获取相应数据的数量 .
     * ..
     *
     * @param array $where
     * @return Result
     */
    public function getConditionNum($where) {    	
    	$count = $this->dao->getConditionNum($where);     	
    	return $count;
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

    /**
     * 根据科室，医生，日期删除详细表中的记录...
     * 
     * @param $date, $department_id
     */
    public function delete_indate($date,$department_id) {
    	$arr=array('department_id'=>$department_id,
    			   'date'=>$date
    	);
        $this->dao->delete_indate($arr);
    }
    
    /**
     * 根据科室，医生，日期删除详细表中的记录...
     * 
     * */
    public function deleteAll($arr){
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
	/**
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
	
	
	public function check_date($date,$department_id,$doctor_id){
		$arr=array('date'=>$date,
		           'department_id'=>$department_id,
		            'doctor_id'=>$doctor_id);
		return $this->dao->date_existbean($arr);
	}
	/*
	 *
	 * 设置指定日期的早上排班信息
	 * 
	 * */
	public function setmon_date($reservation){
		

		
		$reservation->validate();
		
        $array=array('date'=>$reservation->date,
        		     'department_id'=>$reservation->department_id,
        		      'doctor_id'=>$reservation->doctor_id     	
        );
        $ress=$this->dao->date_deparment_exist($array);     

		if($ress!=null){
			$ress->morning=$reservation->morning;	
		
			$this->dao->update($ress);
		}else{
		
			$this->dao->save($reservation);
			
		}
        				
	}
	
	/**
	 *
	* 设置指定日期下午的排班信息
	*
	* */
	public function setaft_date($reservation){
	
		$reservation->validate();
	
		$array=array('date'=>$reservation->date,
				'department_id'=>$reservation->department_id,
				'doctor_id'=>$reservation->doctor_id
		);
		$ress=$this->dao->date_deparment_exist($array);
	
	
		if($ress!=null){
			$ress->afternoon=$reservation->afternoon;
	
			$this->dao->update($ress);
		}else{
	
			$this->dao->save($reservation);
	
		}
	
	}
	
	/**
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
	
			$this->dao->update($ress);
		}else{
	
			$this->dao->save($reservation);
	
		}
	
	}
	/**
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

	/**
	 * 删除某个用户的预约
	* */
	public function deletereser($arr){
		$this->dao->deletereser($arr);		
		return $this->success();
	}
	
	
	/**
	 * 更改预约状态为到诊
	 * */
	public function changestatu($arr){
		$this->dao->changestatu($arr);
		
		//判断是否需要推送
		$contactser=new ContactService();
		$jpushstate=$contactser->getContact('jpushstate')->data;
		if($jpushstate){//如果推送开启
		//处理推送
		$resbookinginfo=new ResBookingInfo();
		$resbookinginfo->id=$arr['id'];
		
		$resbookdata=$this->get($resbookinginfo)->data;
		
		if($resbookdata->member_id){
			$member=new Member();
			$member->id=$resbookdata->member_id;
			$memberser=new MemberService();
			$fullmember=$memberser->get($member)->data;
			
			if(!$fullmember->user_alis){
				return $this->fail(8,'推送失败,用户设备为空');//如果用户不存在返回
			}
		}else{
			return $this->fail(9,'推送失败,用户不存在');//如果用户不存在
		}

			$jpushkeydata=$contactser->getContact('jpushkey')->data;
			$jpushsecdata=$contactser->getContact('jpushsec')->data;
		
			if($jpushkeydata){
				$jpushkeyval=$jpushkeydata->val;
			}else{
				return $this->fail(2,'推送应用app key为空');
			}
			if($jpushsecdata){
				$jpushsecval=$jpushsecdata->val;
			}else{
				return $this->fail(3,'推送应用app sec为空');
			}
			
			try{
			$jpushser=new JpushService($jpushkeyval,$jpushsecval);
			$jpushser->setPlatform(array('ios', 'android'));
			$jpushser->addAlias($fullmember->user_alis);
			//$jpushser->addAlias('341');
			$jpushser->setNotificationAlert('医院已确认您到诊');
			$jpushser->iosNotification('医院已确认您到诊', array(
					'sound' => 'sound.caf',
					// 'badge' => '+1',
					// 'content-available' => true,
					// 'mutable-content' => true,
					'category' => 'jiguang',
					'extras' => array(
							'type'=>'resmake'
					),
			));
			$jpushser->androidNotification('医院已确认您到诊', array(
					'title' => '医院已确认您到诊!',
					// 'build_id' => 2,
					'extras' => array(
							'type'=>'resmake'
					),
			));

// 			$jpushser->message('医院已确认您到诊', array(
// 					'title' => '医院已确认您到诊',
// 					// 'content_type' => 'text',
// 					'extras' => array(
// 							'type' => 'resmake',
							
// 					),
// 			));
				
			$jpushser->send();
			$error_log=GENERATEPATH . 'log/jpush_error.log';
			error_log(date('Y-m-d H:i:s') . ' JPUSH success ' .$fullmember->user_alis. PHP_EOL, 3, $error_log);
			}catch(Exception $e){
				$error_log=GENERATEPATH . 'log/jpush_error.log';
				error_log(date('Y-m-d H:i:s') . ' JPUSH error:' . $e->getMessage() . PHP_EOL, 3, $error_log);
				//error_log($message);
			}
		
		}
		
		return $this->success();
	}
	
	/**
	 * 获取某个时段待约的人数
	 * */
	public function getresnum($arr){
		return $this->dao->getresnum($arr);
	}
	
	/**
	 * 获取某个用户的预约挂号信息
	 * */
	public function getreserdetailbymember($arr){
		return $this->dao->getreserdetailbymember($arr);
	}
	
	/**
	 * 检查某一天某个时段的号源
	 * */
	public function checkdaytime($arr){
		return $this->dao->checkdaytime($arr);
	}
	
	/**
	 * 通过手机号码取预约信息
	 * @param $telephone 电话号码
	 * */
	public function getbookinginfobytelephone($telephone){
		$mobilearr=array('telephone'=>$telephone);
		$result=$this->dao->getbookinginfobytelephone($mobilearr);
		$departmentser=new ResDepartmentService();
		$doctorser=new ResDoctorService();
		$department=new ResDepartment();
		$doctor=new ResDoctor();
		foreach($result as $key=>$val){
			$department->id=$val->department_id;//取预约科室信息
			$doctor->id=$val->doctor_id;
			$department=$departmentser->get($department)->data;
			$val->date=date('Y-m-d',$val->date);
			$val->times=date('H:i:s',intval($val->times));
			if(isset($department->name)&&$department->name){
				$val->depart_name=$department->name;			
			}else{
				$val->depart_name=null;
			}
			$doctor=$doctorser->get($doctor)->data;
			if(isset($doctor->name)&&$doctor->name){
				$val->doctor_name=$doctor->name;
			}else{
				$val->doctor_name=null;
			}		
		}
		return $this->success($result);
	}
	/**
	 * 修改某个id的预约状态
	 * @param $id
	 * @param $statu
	 * */
	public function changestatuname($id,$statu){
		$result=$this->dao->changestatuname($id,$statu);
		return $this->success($result);
	}
	/**
	 * 根据手机号取独特的用户
	 * */
	public function getdistinct(){
		$result=$this->dao->getdistinct();
		return $this->success($result);
	}
	/**
	 * 修改回访参数
	 * */
	public function setreturn($id,$statu){
		$this->dao->setreturn($id,$statu);
		return $this->success();
	}
	
	
	
}