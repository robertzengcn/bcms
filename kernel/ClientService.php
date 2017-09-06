<?php

/**
 * 客服管理（咨询管理）模块service服务层
 * @author Administrator
 *
 */
class ClientService extends BaseService {

    /**
     * 构造方法
     * 实例化基类并实例化dao数据表处理层,并将其赋值给dao属性
     */
    public function __construct() {
        parent::__construct();
        $this->dao = new ClientDAO();
     
    }

    /**
     * 添加方法
     * 处理问题添加逻辑处理方法,并需要开启事务,处理client、clientRecord表的数据插入
     *
     * @param object $client
     *            client实体对象
     * @param object $clientRecord
     *            clientRecord实体对象
     */
    public function save($client) {
        // 开启事务处理
        $this->dao->beginTrans();
        // 异常try模块
        try {
            $client->validate();
            $data=$this->dao->saveClient($client);
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans(); // 事务回滚
            return $this->fail(0, $e->getMessage());
        }
        // 回执
        return $this->success($data);
    }
    
    /**
     * 保存clientrecord
     * @param entity $clientrecord
     * */
    public function saveclientrecord($clientrecord){
    	$this->dao->saveclientrecord($clientrecord);
    	return $this->success();
    }
    
    /**
     * 根据client_id删除所有记录
     * */
    public function deleteclientrecord($client_id){
    	Entity::isIds(array($client_id));
    	$this->dao->deleteclientrecord($client_id);
    	return $this->success();
    }
    
    /**
     * 根据client_id删除所有记录
     * */
    public function deleteclientwork($client_id){
    	Entity::isIds(array($client_id));
    	$this->dao->deleteclientwork($client_id);
    	return $this->success();
    }
    
    /**
     * 获取所有患者列表
     * */
    public function getAllPerson() {
    	return $this->dao->getAllPerson();
    }
    
    
    /**
     * 修改方法
     * 处理问题添加逻辑处理方法,并需要开启事务,处理client、clientRecord表的数据插入
     *
     * @param object $client
     *            client实体对象
     * @param object $clientRecord
     *            clientRecords实体对象数组
     */
    public function update($client) {
        // 开启事务处理
        $this->dao->beginTrans();
        // 异常try模块
        try {
            $client->validate();
            $data=$this->dao->updateClient($client);
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans(); // 事务回滚
            return $this->fail(0, $e->getMessage());
        }
        // 回执
        return $this->success($data);
    }
    
    /**
     * 删除方法
     * 需要开启事务,处理client、clientRecord表的删除
     *
     * @param int $id
     *            client实体对象的id
     */
    public function deleteClient($id) {
        // 开启事务处理
        $this->dao->beginTrans();
        // 异常try模块
        try {
            $this->dao->deleteClient($id);
           
            $this->dao->commitTrans();
        } catch (Exception $e) {
            $this->dao->rollbackTrans(); // 事务回滚
            return $this->fail(0, $e->getMessage());
        }
        // 回执
        return $this->success();
    }
    
    /**
     * 
     * 发送短信给所有关注人
     * 
     * */
    public function sendMsg($focus_ids) {
    	try {
    		$users = $this->dao->getUsersByIds($focus_ids);
    		$ser = new DuanxinService();
    		foreach ($users as $user) {
    			if (!empty($user->mobile)) {
    				$content = '客户' . $_REQUEST['username'] . '预约了您' . $_REQUEST['date'] . ' ' . $_REQUEST['restime'] . '的号码!';
    				$ser->sendNormalMessage($user->mobile, $content);
    			}
    		}
    	    
    	} catch (Exception $e) {
    		return $this->fail(0, $e->getMessage());
    	}
    	return $this->success();
    }

    /**
     *
     *
     * 分页查询&数据列表
     *
     * @param array $params
     */
    public function query($params) {
        $Result = $this->dao->query($params);
        if(!empty($Result)){
        	$resbookinginfoser=new ResBookingInfoService();
        	foreach($Result as $key=>$val){
        		
        		$resbookarr=$resbookinginfoser->getbookinginfobytelephone($val->telephone)->data;
        		if(isset($resbookarr[0])){
        			
        			$val->date=$resbookarr[0]->date;
        			$val->department_name=$resbookarr[0]->depart_name;
        			$val->doctor_name=$resbookarr[0]->doctor_name;
        			$val->statu=$resbookarr[0]->statu;
        		}else{
        			$val->date=null;
        			$val->department_name=null;
        			$val->doctor_name=null;
        			$val->statu=null;
        		}
        	}
        	

        }
        
        return $this->success($Result);
    }

    /**
     *
     * 写入预约记录    
     * $resbookID 预约成功后返回的ID,$client_id患者的基础表ID
     */
    public function addrescode($resbookID,$client_id) {
    	$Result = $this->dao->addrescode($resbookID,$client_id);    	
    	return $Result;
    }
    
    /**
     *
     * 获取咨询记录
     *
     * @param int $client_id
     * @return object 数据对象
     */
    public function getRecord($client_id) {
        $Result = $this->dao->getRecord($client_id);
        return $Result;
    }

    /**
     * 查询数据总量
     *
     * @see kernel/BaseService::totalRows()
     */
    public function totalRows($params) {
        return $this->dao->totalRows($params);
    }

    /**
     * 获取一条数据
     *
     * @param Int $id
     * @return Result
     */
    public function get($id,$client) {
//         if (! $id) {
//             throw new ValidatorException(7);
//         }
        $data = $this->dao->get($client->id,$client);
        return $this->success($data);
    }
    
    /**
     * 保存关注人所有分组信息
     * */
    public function saveGroup($group) {
        // 异常try模块
        try {
            $group->validate();
            $groupid = $this->dao->saveGroup($group);
        } catch (Exception $e) {
            return $this->fail(0, $e->getMessage());
        }
        // 回执
        return $this->success($groupid);
    }
    
    /**
     * 获取组信息
     * */
    public function getGroups() {
        return $this->dao->getGroups();
    }
    
    /**
     * 获取指定组用户
     * */
    public function getGroupUsers($groupid) {
        return $this->dao->getGroupUsers($groupid);
    }
    
    /**
     * 获取来源信息
     * */
    public function getDataSource() {
        return $this->dao->getDataSource();
    }
    
    /**
     * 保存来源信息
     */
    public function saveDataSource(){
        unset($_REQUEST['controller'],$_REQUEST['method']);
        $dataSource = new PatientDataSource();
        foreach ($_REQUEST as $key=>$val){
            $dataSource->$key = $val;
        }
         
        try {
            $dataSource->validate();
            $re = $this->dao->saveDataSource($dataSource);
            if($re){
                return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
            }else{
                return array('statu'=>false,'msg'=>'添加失败！');
            }
        } catch (Exception $e) {
            return array('statu'=>false,'msg'=>$e->getMessage());
        }
         
    }
    
    /**
     * 来源信息-修改
     * */
    public function modSource() {
        unset($_REQUEST['controller'],$_REQUEST['method']);
        $dataSource = new PatientDataSource();
        foreach ($_REQUEST as $key=>$val){
            $dataSource->$key = $val;
        }
        $dataSource->validate();
        $re = $this->dao->modSource($dataSource);
        if($re){
            return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
        }else{
            return array('statu'=>false,'msg'=>'修改失败！');
        }
    }
    
    /**
     * 删除来源信息
     */
    public function delDataSource($ids){
        if (!is_array($ids)) {
            $ids = array($ids);
        }
        Entity::isIds($ids);
        $re = $this->dao->delDataSource($ids);
        if($re){
            return array('statu'=>true,'msg'=>'删除成功');
        }
    }
    
    /**
     * 获取前台接待员
     * */
    public function getReceptionist() {
        return $this->dao->getReceptionist();
    }
    
    /**
     * 保存前台接待信息
     */
    public function addReceptionist(){
        unset($_REQUEST['controller'],$_REQUEST['method']);
        $receptionist = new PatientReceptionist();
        foreach ($_REQUEST as $key=>$val){
            $receptionist->$key = $val;
        }
        $receptionist->validate();
        $re = $this->dao->addReceptionist($receptionist);
        if($re){
            return array('statu'=>true,'msg'=>'添加成功！', 'data'=>$re);
        }else{
            return array('statu'=>false,'msg'=>'添加失败！');
        }
    }
    
    /**
     * 前台接待信息-修改
     * */
    public function modReceptionist() {
        unset($_REQUEST['controller'],$_REQUEST['method']);
        $receptionist = new PatientReceptionist();
        foreach ($_REQUEST as $key=>$val){
            $receptionist->$key = $val;
        }
        $receptionist->validate();
        $re = $this->dao->modReceptionist($receptionist);
        if($re){
            return array('statu'=>true,'msg'=>'修改成功！', 'data'=>$re);
        }else{
            return array('statu'=>false,'msg'=>'修改失败！');
        }
    }
    
    /**
     * 删除前台接待信息
     */
    public function delReceptionist($ids){
        if (!is_array($ids)) {
            $ids = array($ids);
        }
        Entity::isIds($ids);
        $re = $this->dao->delReceptionist($ids);
        if($re){
            return array('statu'=>true,'msg'=>'删除成功');
        }
    }
    
    /**
     * 获取前台接待员数据条数
     * */
    public function getReceptionistCount() {
        return $this->dao->getReceptionistCount();
    }
    
    /**
     * 获取统计数据
     * */
    public function getStatData() {
        return $this->dao->getStatData($_REQUEST);
    }
    
    /**
     * 获取当月就诊数据
     * */
    public function statByDate() {
        return $this->dao->statByDate($_REQUEST);
    }
	/*
	 * 检验数据存在
	 * */
	public function checkData($time){
        return $this->dao->checkDataIsAdd($time);		
	}
    /**
     * 保存数据
     *
     * @param Entity 
     * @return Result
     */
    public function saveClientData($cdata,$info,$type) {
		$statu = 3;
		if($info['type'] == 2){
			$statu = $this->getStatu($info['statu']);
		}
		$cdata->zx_total = ($info['type']==1) ? 1 : 0;
		$cdata->kefu = ($info['type']==1) ? $this->setKefu('',$info['reception']) : '';
		if($type==1){
			$cdata->region = $this->setRegion('',$info['region_id']);
		}
		$cdata->res_total = ($info['type']==1) ? 0 : 1;
		$cdata->source = ($info['type']==1) ? '' : $this->setField('',$info['source_id'],$statu);	
		//$cdata->department = ($info['type']==1) ? '' : $this->setField('',$info['department_id'],$statu);
		$cdata->data_md5 = md5(serialize($cdata));		
        return $this->dao->saveClientData($cdata);
	}
    /**
     * 更新数据
     *
     * @param Entity 
     * @return Result
     */
    public function updateClientData($cdata,$info,$type) {
		$statu = 3;
		if($info['type'] == 2){
			$statu = $this->getStatu($info['statu']);
		}
		$cdata->kefu = ($info['type']==1) ? $this->setKefu($info['kefu'],$info['reception']) : $info['kefu'];
		if($type==1){
			$cdata->region = $this->setRegion($info['region'],$info['region_id']);
		}
		$cdata->source = ($info['type']==1) ? $info['source'] : $this->setField($info['source'],$info['source_id'],$statu);
		//$cdata->department = ($info['type']==1) ? $info['department'] : $this->setField($info['department'],$info['department_id'],$statu);
		$cdata->data_md5 = md5(serialize($cdata));		
        return $this->dao->updateClientData($cdata);		
	}	
	/*
     * 更新字段field
     * */
    
    public function setField($field,$id,$statu) {
		if($field){
			$field = unserialize($field);	
			if(in_array($id, array_keys($field))){
				$field[$id][$statu] = $field[$id][$statu] + 1;				
			}else{
				$field[$id][1] = 0;
				$field[$id][2] = 0;
				$field[$id][3] = 0;
				$field[$id][4] = 0;
				$field[$id][5] = 0;
				$field[$id][$statu] = 1;	
			}
			$field = serialize($field);		
		}else{
			$field[$id][1] = 0;
			$field[$id][2] = 0;
			$field[$id][3] = 0;
			$field[$id][4] = 0;
			$field[$id][5] = 0;
			$field[$id][$statu] = 1;
			$field = serialize($field);	
		}
		return $field;
	}
	/**
     * 更新kefu
     * */
    
    public function setKefu($kefu,$reception) {
		$data = array();
		foreach($reception as $key=>$val){
			if($kefu){
				$kefu = unserialize($kefu);	
				if(in_array($key, array_keys($kefu))){
					$data[$key] = $kefu[$key] +$val;
				}else{
					$data[$key] = $val;
				}		
			}else{
				$data[$key] = $val;
			}
		}
		$data = serialize($data);
		return $data;	
	}
	/**
     * 更新region
     * */
    
    public function setRegion($region,$region_id) {
		if($region){
			$region = unserialize($region);	
			if(in_array($region_id, array_keys($region))){
				$region[$region_id] = $region[$region_id] +1;
			}else{
				$region[$region_id] = 1;
			}
			$region = serialize($region);		
		}else{
			$region[$region_id] = 1;
			$region = serialize($region);	
		}
		return $region;	
	}	
    /**
     * 保存客服关注者
     * */
    public function saveclientwork($clientworker){
    	$this->dao->saveclientwork($clientworker);
    	return $this->success();
    }
    
    /**
     * 取客服关注者
     * */
    public function getclientworker($client_id){
    	$arr=array('client_id'=>(int)$client_id);
    	$result=$this->dao->getclientworker($arr);
    	$workser=new WorkerService();
    	foreach($result as $key=>$val){
    		$worker=new Worker();
    		$worker->id=$val->work_id;
    		
    		$workers=$workser->get($worker)->data;
    		
    		if($workers->nick_name){
    			$val->name=$workers->nick_name;
    		}else{
    			unset($val);//如果worker表中找不到，则删除
    		}
    	}
    	return $this->success($result);
    }
    /**
     * 通过work_id获取相关数据
     * @param $workid
     * @param $page 从第几条
     * @param $size 取几条
     * */
    public function getdatabyworkid($workid,$page=0,$size=10){
    	if(!$workid){
    	return $this->fail(10,'word_id为空');
    	}
    	$pages=$page*$size;
    	$arr=array('work_id'=>(int)$workid,'page'=>$pages,'size'=>$size);
    	$result=$this->dao->getbyworkid($arr);
    	
    	$clientser=new ClientService();
    	foreach($result as $key=>$val){
    		$client=new Client();
    		$client->id=$val->client_id;
    		$client=$clientser->get($val->client_id,$client)->data;
    		unset($val->work_id);
    		unset($val->id);
    		if($client&&$client->username){
    			$val->username=$client->username;
    			$val->telephone=$client->telephone;
    			$val->gender=$client->gender;
    		}else{
    			unset($val);//如果worker表中找不到，则删除
    		}
    	}
    	return $this->success($result);    	
    }
    /**
     * 获取相关数据的条数
     * @param $work_id
     * */
    public function gettotal_work($work_id){
    	if(!$work_id){
    		return $this->fail(10,'word_id为空');
    	}
    	$arr=array('work_id'=>(int)$work_id);
    	$result=$this->dao->gettotal_work($arr);
    	return $this->success($result);
    	
    }
    /**
     * 判断用户id和工作人员id是否关联
     * */
    public function workclientres($work_id,$client_id){
    	$arr=array('work_id'=>(int)$work_id,'client_id'=>(int)$client_id);
    	$result=$this->dao->workclientres($arr);
    	return $this->success($result);
    }
    /**
     * 取客服记录
     * */
    public function getclientrecord($client_id,$page=null,$size=null){
    	$pages=(int)$page*$size;
    	
    	$arr=array('client_id'=>(int)$client_id,'page'=>(int)$pages,'size'=>(int)$size);

    	$result=$this->dao->getclientrecord($arr);
    	
    	foreach($result as $key=>$val){
    		if(!isset($val['plushtime'])){
    			$val['plushtime']="";
    		}
    		if(!isset($val['focus_id'])){
    			$val['focus_id']="";
    		}
    	}
    	
    	return $this->success($result);
    }
    /**
     * 取客服记录中符合条件的总数
     * */
    public function getrecordnum($client_id){
    	$arr=array('client_id'=>(int)$client_id);
    	$result=$this->dao->getrecordnum($arr);
    	return $this->success($result);
    }
    /**
     * 通过电话号码取client
     * @param $telephone
     * */
    public function getclientbytel($telephone){
    	$arr=array('telephone'=>$telephone);
    	$result=$this->dao->getbytelephone($arr);
    	return $this->success($result);
    }
    /**
     * 根据手机号和用户姓名查找
     * @param $telephone手机
     * @param $name姓名
     * */
    public function getclientbytn($telephone,$name){
    	$arr=array('telephone'=>$telephone,'username'=>$name);
    	$result=$this->dao->getclientbytn($arr);
    	return $this->success($result);
    }
    /**
     * 获取相关数据的条数
     * @param $client_id
     * */
    public function getTotalRecord($client_id){
    	$arr=array('client_id'=>$client_id);
    	$result=$this->dao->getTotalRecord($arr);
    	return $result;
    	
    }
    /**
     * 更新统计数据
     * */
    public function updateStatData($start, $end) {
        try {
            $result = $this->dao->getClientData($start, $end);
            $data = array();
			$cdata = new ClientData();
            foreach ($result as $value) {
					$date = $value['recordtime'];
					$region_id = $this->getRegionId($value['address']);
					$reception = array($value['reception_id']);
					if(isset($data[$date])){
						$data[$date]->zx_total +=1;
						$data[$date]->kefu  = $this->setKefu($data[$date]->kefu,$reception);
						if($region_id){
							$data[$date]->region  = $this->setRegion($data[$date]->region,$region_id);
						}
						$cdata = $data[$date];
					}else{
						$cdata->week = date("w",strtotime($date));
						$cdata->daytime = $date;
						$cdata->zx_total = 1;
						$cdata->res_total = 0;
						$cdata->kefu  = $this->setKefu('',$reception);
						if($region_id){
							$cdata->region =  $this->setRegion('',$region_id);
						}
					}
						$cdata->data_md5 = md5(serialize($cdata));
						$data[$date] = $cdata;
 				if(isset($value['date'])){
					$cdata = new ClientData();
					$date = date('Y-m-d', $value['date']);
					$statu = $this->getStatu($value['statu']);
					if(isset($data[$date])){
						$data[$date]->res_total +=1;
						$data[$date]->source  = $this->setField($data[$date]->source,$value['source'],$statu);
						$cdata = $data[$date];
					}else{
						$cdata->week = date("w",strtotime($date));
						$cdata->daytime = $date;
						$cdata->res_total = 1;
						$cdata->zx_total = 0;
						$cdata->source  = $this->setField('',$value['source'],$statu);
					}
						$cdata->data_md5 = md5(serialize($cdata));
						$data[$date] = $cdata;
				}
            }
            $result = $this->dao->updateStatData($data);
            if (!$result) return $this->fail('', "数据统计更新失败");
        } catch (Exception $e) {
            return $this->fail('', $e->getMessage());
        }
        
    	return $this->success();
    }
	
	public function getRegionId($address){
		$regionFile = ABSPATH . '/hcc/clients/manage/place.json';
		if(!file_exists($regionFile)){
			return '';
		}
		$add = explode('>',$address);
		$len = count($add);
		if($len==1){
			$address = $add[0];
		}elseif($len==2){
			$address = $add[1];			
		}elseif($len==3){
			$address = $add[2];				
		}
        $regionJson = file_get_contents($regionFile);
        $result = json_decode($regionJson, true);
	    foreach ($result as $key=>$value) {
			if($value==$address) return $key;
		}
		 return '';		
	}	
	public function getStatu($info){
		switch($info){
			case '一定到诊' :    $statu = 1; break;
			case '可能到诊' :    $statu = 2; break;
			case '不确定到诊' :  $statu = 3; break;
			case '不会到诊' :    $statu = 4; break;
			case '已到诊' :      $statu = 5; break;
		}
		return $statu;
	}
}