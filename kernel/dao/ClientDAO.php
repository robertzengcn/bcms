<?php

/**
 *
 * 客服管理（咨询管理）模块dao层
 * @author Administrator
 *
 */
class ClientDAO extends DBBaseDAO {

    private $recordTable = 'clientrecord';
    private $clienttoworker='clienttoworker';
    
    public function __construct() {
        parent::__construct();
        $this->tableName = 'client';
    }
    
    /**
     * 保存咨询预约关系
     * 
     * 一(client)对多(clientrecord)添加
     * */
    public function saveClient($client) {    	
    	$clientBean = R::dispense($this->tableName);    	
    	$client->generateRedBean($clientBean);    	    	
    	R::store($clientBean); 
    	   	  	
    	return $clientBean->id;//返回数据成功添加后的ID
    }
    
    /**
     * 保存clientrecord
     * */
    public function saveclientrecord($clientrecord){
    	$clientrecordBean = R::dispense($this->recordTable);
    	$clientrecord->generateRedBean($clientrecordBean);
         
    	R::store($clientrecordBean);
    	
    }
    
    /**
     * 修改咨询预约关系
     *
     * 一(client)对多(clientrecord)修改
     * */
    public function updateClient($client) {    	
        $clientBean = R::load($this->tableName, $client->id);
        $client->generateRedBean($clientBean);        
//         foreach ($clientRecords as $clientRecord) {
//             $clientRecordBean = R::load($this->recordTable, $clientRecord->id);
//             $clientRecord->generateRedBean($clientRecordBean);
//             if ($clientRecordBean->plushtime == '') {
//                 $clientRecordBean->plushtime = time();
//             }
//             $clientRecordBean->focus_id = $clientRecord->focus_id;
//             $clientRecordBean->reception_id = $clientRecord->reception_id;            
//             $clientRecordBean->source = $clientRecord->source;
//             $clientBean->ownClientRecordList[] = $clientRecordBean;
//         }
        
        R::store($clientBean);
        return $clientBean->id;
    }
    
    /**
     * 根据$client_id 删除所有记录
     * @param $client_id
     * */
    public function deleteclientrecord($client_id){
    	$array=array('client_id'=>$client_id);
    	$clientrecord = R::findAll($this->recordTable,'client_id=:client_id',$array);
    	$result=R::trashAll($clientrecord);
    	R::close();
    }
    
    /**
     * 根据$client_id删除所有记录
     * 
     * */
    public function deleteclientwork($client_id){
    	$array=array('client_id'=>$client_id);
    	$clientrecord = R::findAll($this->clienttoworker,'client_id=:client_id',$array);
    	
    	$result=R::trashAll($clientrecord);
    	//R::close();
    }
    
    /**
     * 删除咨询预约关系
     *
     * 一(client)对多(clientrecord)删除
     * */
    public function deleteClient($ids) {
        if (!is_array($ids)) {
        	$ids = array($ids);
        }
        
        foreach ($ids as $id) {
            $clientBean = R::load($this->tableName, $id);
            $beans = R::findAll($this->recordTable, 'client_id=' . $id);            
            R::trashAll($beans);
            R::trash($clientBean);
            $this->deleteclientwork($id);
        }
        
    }
    
    /**
     *
     * 写入预约记录 @$client_id
     */
    public function addrescode($resbookID,$client_id) {
    	$clientBean = R::load($this->tableName, $client_id);
    	if($clientBean->res_code!=''){
    		$clientBean->res_code.='@'.$resbookID;
    	}else{
    		$clientBean->res_code=$resbookID.'@';
    	}    	
    	R::store ($clientBean);    	
    	return $clientBean->res_code;
    }
    
    
    /**
     *
     *
     * 根据$client_id获取咨询记录
     *
     * @param int $client_id
     */
    public function getRecord($client_id) {
        return R::findAll($this->recordTable, 'client_id=' . $client_id);
    }

    /**
     *
     *
     * 获取多条数据
     *
     * @param $params 参数包
     */
    public function query($params) {
        if ($params['start'] && !is_numeric($params['start'])) {
            $params['start'] = strtotime($params['start']);
        }
        if ($params['end'] && !is_numeric($params['end'])) {
            $params['end'] = strtotime($params['end']);
        }
        
        DTExpression::like('username', $params, $this->tableName);
        DTExpression::eq('telephone', $params, $this->tableName);        
        DTExpression::eq('last_reception', $params, $this->tableName);
        DTExpression::eq('source', $params, $this->tableName);
        DTExpression::ge('plushtime', $params, 'start', $this->tableName);
        DTExpression::le('plushtime', $params, 'end', $this->tableName);
        if (isset($params['order']) &&  $params['order']) {
        	DTOrder::$sql = $params['order'];
        } else {
        	DTOrder::desc($this->tableName . '.id');
        }
        
        DTExpression::page($params);
        
        $result = R::findAll($this->tableName, DTExpression::$sql.DTOrder::$sql . DTExpression::$limit, DTExpression::$params);      
      
       
        $array = array();
        foreach ($result as $k => $bean) {
        	
            $entity = new Client();
            $entity->generateFromRedBean($bean);            
            $source = R::load('patientdatasource', $entity->source);
            $entity->source_name = $source->title;
            
            //咨询员
            $reception = R::load('worker', $entity->last_reception);
            $entity->reception_name = $reception->nick_name;
            
            $array[] = $entity;
        }
       
        return $array;
    }

    /**
     *
     *
     * 获取数据总数
     *
     * @param $params 参数包
     */
    public function totalRows($params) {
       if ($params['start'] && !is_numeric($params['start'])) {
            $params['start'] = strtotime($params['start']);
        }
        if ($params['end'] && !is_numeric($params['end'])) {
            $params['end'] = strtotime($params['end']);
        }
        
        DTExpression::eq('username', $params, $this->tableName);
        DTExpression::eq('telephone', $params, $this->tableName);        
        DTExpression::eq('reception_id', $params, $this->tableName);
        DTExpression::eq('source', $params, $this->tableName);
        return $this->getRecordCount(DTExpression::$sql, DTExpression::$params);
    }

    /**
     * 获取所有患者列表
     * */
    public function getAllPerson() {
    	$sql = '1=1 ';
    	if (isset($_REQUEST['username']) && $_REQUEST['username']) {
    		$sql .= " and username like '%" . $_REQUEST['username'] . "%'";
    	}
    
    	if (isset($_REQUEST['telephone']) && $_REQUEST['telephone']) {
    		$sql .= " and telephone like '%" . $_REQUEST['telephone'] . "%'";
    	}
    	$n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 10;
    	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    	$m = ($page-1)*$n;
    	DTExpression::limit($m, $n);
    	$count = R::count('client', $sql);
    	$sql .= DTExpression::$limit;
    	$data = $this->dealFindOperator('Client', $sql);
    	return array('rows'=>$data,'ttl'=>$count);
    }
    
    
    /**
     * 获取所有信息
     * */
    public function get($id,$client) {
        $bean = R::load($this->tableName, $client->id);
        $client = new Client();
        $client->generateFromRedBean($bean);
		$client->telephone = ($client->telephone == 0) ? '' : $client->telephone;
		$client->qq = ($client->qq == 0) ? '' : $client->qq;
		$client->email = ($client->email == 0) ? '' : $client->email;
			
        //获取关注人信息
//         $focus_ids = explode(',', $client->focus_id);
//         $client->focus_users = array();
//         if (!empty($focus_ids)) {
//         	$userBeans = R::loadAll(TABLENAME_WORKER, $focus_ids);
//         	foreach ($userBeans as $bean) {
//         		$user = new Worker();
//         		$user->generateFromRedBean($bean);
//         		$client->focus_users[$user->id] = $user->name;
//         	}
//         }
// 			$arr=array('client_id'=>(int)$id);
//         $client->records = array();
//         $recordBeans = R::findAll($this->recordTable, 'client_id=:client_id' ,$arr);
//         foreach ($recordBeans as $bean) {
//         	$record = new ClientRecord();
//         	$record->generateFromRedBean($bean);        	
//         	$client->records[] = $record;
//         }
       
        return $client;
    }
    
    /**
     * 根据关注者id获取关注者信息
     * */
    public function getUsersByIds($ids) {
    	if (empty($ids)) return array();
    	$userBeans = R::loadAll(TABLENAME_WORKER, $ids);
    	$users = array();
    	foreach ($userBeans as $bean) {
    		$user = new Worker();
    		$user->generateFromRedBean($bean);
    		$users[] = $user;
    	}
    	return $users;
    }
    
    /**
     * 获取来源信息
     * */
    public function getDataSource() {
        return $this->dealFindOperator('PatientDataSource');
    }
    
    /**
     * 保存来源信息
     * */
    public function saveDataSource($entity) {
        $where = array('title' => $entity->title);        
        if($this->isExists('patientdatasource', $where)) {
            throw new Exception('存在同名项目，不能重复添加！');
        }
        return $this->dealAddOperator($entity, 'patientdatasource');
    }
    
    
    //检查是否存在同名项目
    protected function isExists($tablename, $where = array()) {
    	if (is_array($where)) {
    		foreach ($where as $key => $v) {
    			DTExpression::eq($key, $where);
    		}
    
    		$result = R::findOne($tablename, DTExpression::$sql, DTExpression::$params);
    		if (empty($result)) {
    			return false;
    		}
    		 
    		return true;
    	}
    
    	return false;
    }
    
    /**
     * 删除来源信息
     * */
    public function delDataSource($ids) {
        $beans = R::batch('patientdatasource', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 修改来源信息
     * */
    public function modSource($entity) {
        return $this->dealAddOperator($entity, 'patientdatasource');
    }
    
    /**
     * 获取前台接待员
     * */
    public function getReceptionist() {
        $n = isset($_REQUEST['size']) ? $_REQUEST['size'] : 10;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $m = ($page-1)*$n;
        DTExpression::limit($m, $n);
        return $this->dealFindOperator('PatientReceptionist', DTExpression::$sql . DTExpression::$limit);
    }
    
    /**
     * 获取前台接待员数据条数
     * */
    public function getReceptionistCount() {
        return R::count('patientreceptionist');
    }
    
    /**
     * 保存前台接待信息
     * */
    public function addReceptionist($entity) {
        return $this->dealAddOperator($entity, 'patientreceptionist');
    }
    
    /**
     * 修改前台接待信息
     * */
    public function modReceptionist($entity) {
        return $this->dealAddOperator($entity, 'patientreceptionist');
    }
    
    /**
     * 删除前台接待信息
     * */
    public function delReceptionist($ids) {
        $beans = R::batch('patientreceptionist', $ids);
        R::trashAll($beans);
        return true;
    }
    
    /**
     * 处理简单查询
     * */
    protected function dealFindOperator($className, $sql='', $binds = '') {
        $tablename = strtolower($className);
        if (empty($binds)) {
            $beans = R::find($tablename, $sql);
        } else {
        
            $beans = R::find($tablename, $sql, $binds);
        }
    
        $array = array();
        foreach($beans as $bean){
            $obj = new $className();
            $obj->generateFromRedBean($bean);
            $array[] = $obj;
        }
        return $array;
    }
    
    /**
     * 处理添加操作
     * */
    protected function dealAddOperator($entity, $tablename, $isReturnId = false) {
        if ($entity->id) {
            $entity->validate();
            $bean = R::load($tablename, $entity->id);
            $entity->generateRedBean ( $bean );
        } else {
            $entity->validate();
            $bean = R::dispense($tablename);
            $entity->generateRedBean($bean);
        }
        $insertId = R::store ( $bean );
        $entity->generateFromRedBean ( $bean );
         
        if ($isReturnId) {
            return $insertId;
        }
        return $entity;
    }
    
    /**
     * 获取统计数据
     * */
    public function getStatData($where = '') {
        $type = isset($where['type']) ? $where['type'] : '1';
        $start = isset($where['start']) ? $where['start'] : '';
        $end = isset($where['end']) ? $where['end'] : '';
        if ($start && $end) {
            $start = strtotime($start);
            $end = strtotime($end);
            if ($end-$start < 0) {
                throw new Exception('开始时间不能大于终止时间');
            }
        }
        switch ($type) {
        	case '1': //来源
        	    $data = $this->statBySource($start, $end);
        	    break;
        	case '2': //咨询
        	    $data = $this->statByReceptionist($start, $end);
        	    break;
        	case '3': //科室
        	    $flag = isset($_REQUEST['flag']) ? $_REQUEST['flag'] : 'department';
        	    if ('department' == $flag) {
        	        $data = $this->statByDepartment($start, $end);
        	    } else {
        	        //按月份
        	        $data = $this->statByMonth($start, $end);
        	    }
        	    break;
        	case '4': //地区
        	    $data = $this->statByRegion($start, $end);
        	    break;
        	default:
        	    break;
        }
        return $data;
    }
    
    /**
     * 来源统计
     * */
    public function statBySource($start = '', $end = '') {
        $data = array();
        $sql = 'select id, title from patientdatasource';
        $result = R::getAll($sql);
        foreach ($result as $value) {
            if ($value['title']) {
                $data[$value['id']]['yes'] = 0;
                $data[$value['id']]['maybe'] = 0;
                $data[$value['id']]['unsure'] = 0;
                $data[$value['id']]['no'] = 0;
                $data[$value['id']]['arrive'] = 0;
                $data[$value['id']]['total_num'] = 0;
                 
                $data[$value['id']]['title'] = $value['title'];
            }
        }
         
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select source from clientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultSource = R::getAll($sql);
		if($resultSource){  	
			foreach ($resultSource as $key=>$value) {
					$source = unserialize($value['source']);
				if($source){
					foreach($source as $k=>$v){
						$data[$k]['yes'] = (isset($data[$k]['yes']) ? (int)$data[$k]['yes'] : 0 ) + (int)$v[1];
						$data[$k]['maybe'] = (isset($data[$k]['maybe']) ? (int)$data[$k]['maybe'] : 0 ) + (int)$v[2];
						$data[$k]['unsure'] = (isset($data[$k]['unsure']) ? (int)$data[$k]['unsure'] : 0 ) + (int)$v[3];
						$data[$k]['no'] = (isset($data[$k]['no']) ? (int)$data[$k]['no'] : 0 ) + (int)$v[4];
						$data[$k]['arrive'] = (isset($data[$k]['arrive']) ? (int)$data[$k]['arrive'] : 0 ) + (int)$v[5];
						$data[$k]['total_num'] += (int)$v[1]+ (int)$v[2]+ (int)$v[3]+ (int)$v[4]+ (int)$v[5];
					}
				}
			}
		}
                
        //分页
        if (isset($_REQUEST['page']) && $_REQUEST['page']) {
            $ttl = count($data);
            $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
            $data = array_slice($data, $start, intval($_REQUEST['size']));
            return array('rows'=>array_values($data), 'ttl'=>$ttl);
        }
        
        return array_values($data);
    }
    
    /**
     * 前台接诊统计
     * */
    public function statByReceptionist($start = '', $end = '') {
        $data = array();
        $sql = 'select w.id, w.nick_name from clienttoworker as cw left join worker as w on cw.work_id=w.id';
        $result = R::getAll($sql);
        foreach ($result as $value) {
            if ($value['nick_name']) {
                $data[$value['id']]['arrive'] = 0;
                $data[$value['id']]['total_num'] = 0;
                 
                $data[$value['id']]['user_name'] = $value['nick_name'];
                $data[$value['id']]['reception_id'] = $value['id'];
            }
        }
         
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select kefu from clientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultReception = R::getAll($sql);
		if($resultReception){  	
			foreach ($resultReception as $key=>$value) {
					$reception = unserialize($value['kefu']);	
				if($reception){
					foreach($reception as $k=>$v){
						if(!empty($data[$k]['user_name'])){
							$data[$k]['total_num'] = isset($data[$k]['total_num']) ? $data[$k]['total_num'] : 0;
							$data[$k]['total_num'] += $v;
						}
					}
				}
			}
		}		
         
        //分页
        if (isset($_REQUEST['page']) && $_REQUEST['page']) {
            $ttl = count($data);
            $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
            $data = array_slice($data, $start, intval($_REQUEST['size']));
            return array('rows'=>array_values($data), 'ttl'=>$ttl);
        }
        return array_values($data);
    }
    /**
     * 科室
     * */
    public function statByDepartment($start, $end) {
        $data = array();
        $sql = 'select id, name from resdepartment';
        $result = R::getAll($sql);
        foreach ($result as $value) {
            if ($value['name']) {
                $data[$value['id']]['yes'] = 0;
                $data[$value['id']]['maybe'] = 0;
                $data[$value['id']]['unsure'] = 0;
                $data[$value['id']]['no'] = 0;
                $data[$value['id']]['arrive'] = 0;
                $data[$value['id']]['total_num'] = 0;
                 
                $data[$value['id']]['name'] = $value['name'];
                $data[$value['id']]['department_id'] = $value['id'];
            }
        }
		
 		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select department,daytime from clientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $result = R::getAll($sql);       
        //$type = array('yes','maybe','unsure','no','arrive');
		if($result){
			foreach ($result as $key=>$value) {
				$department = unserialize($value['department']);
				if($department){
					foreach($department as $k=>$v){
						if($data[$k]['name']){
							$data[$k]['yes'] = (isset($data[$k]['yes']) ? (int)$data[$k]['yes'] : 0 ) + (int)$v[1];
							$data[$k]['maybe'] = (isset($data[$k]['maybe']) ? (int)$data[$k]['maybe'] : 0 ) + (int)$v[2];
							$data[$k]['unsure'] = (isset($data[$k]['unsure']) ? (int)$data[$k]['unsure'] : 0 ) + (int)$v[3];
							$data[$k]['no'] = (isset($data[$k]['no']) ? (int)$data[$k]['no'] : 0 ) + (int)$v[4];
							$data[$k]['arrive'] = (isset($data[$k]['arrive']) ? (int)$data[$k]['arrive'] : 0 ) + (int)$v[5];
							$data[$k]['total_num'] += (int)$v[1]+ (int)$v[2]+ (int)$v[3]+ (int)$v[4]+ (int)$v[5];
						}
					}
				}
			}
		}
         
        //分页
        if (isset($_REQUEST['page']) && $_REQUEST['page']) {
            $ttl = count($data);
            $start = (intval($_REQUEST['page'])-1)*intval($_REQUEST['size']);
            $data = array_slice($data, $start, intval($_REQUEST['size']));
            return array('rows'=>array_values($data), 'ttl'=>$ttl);
        }
         
        return array_values($data);
    }
    
    /**
     * 科室月份
     * */
    public function statByMonth($start, $end) {
        $sql = 'select id, name from resdepartment';
        $result = R::getAll($sql);
        $columns = array();
        foreach ($result as $value) {
            if ($value['name']) {
                $columns[$value['id']] = $value['name'];
            }
        }
        $return = $this->initArray($start, $end, $columns);	
        //一定到诊统计
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select daytime,department from clientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $result= R::getAll($sql);		
		if($result){
			foreach ($result as $key=>$value) {
				$department = unserialize($value['department']);				
				foreach($department as $k=>$v){
					$return[$value['daytime']][$columns[$k]] += (int)$v[1]+ (int)$v[2]+ (int)$v[3]+ (int)$v[4]+ (int)$v[5];
				}
			}
		}	
        return $return;
    }
 	/**
	 * 所在地区统计（1-3层table）
	 * */
	public function statByRegion($start, $end) 
	{
	    $data = array();
		$regionFile = ABSPATH . '/hcc/clients/manage/place.json';
		if(!file_exists($regionFile)){
			return $data;
		}
        $regionJson = file_get_contents($regionFile);
        $result = json_decode($regionJson, true);
		$result_keys = array_keys($result);
	    foreach ($result as $key=>$value) {
			$arr = explode('-',$key);
			if(preg_match('/^'.$arr[0].'$/',$key)){
				$data[$key]['region_name'] = $value;
				$data[$key]['region_num'] = 0;
				$data[$key]['other_num'] = 0;		                                 //其它数量		
			}elseif(preg_match('/^'.$arr[0].'\-\d+$/',$key)){
				$data[$arr[0]]['two'][$arr[1]]['region_name'] = $value;
				$data[$arr[0]]['two'][$arr[1]]['region_num'] = 0;
				if(!in_array($arr[0].'-'.$arr[1] . '-0', $result_keys, true)){       //判断是否有第三层
					if(!isset($data[$arr[0]]['rowspan_one'])){
						$data[$arr[0]]['rowspan_one'] = 0;
					}
					$data[$arr[0]]['rowspan_one'] += 1;					
				}
			}elseif(preg_match('/^'.$arr[0].'\-\d+\-\d+$/',$key)){
				$data[$arr[0]]['two'][$arr[1]]['three'][$arr[2]]['region_name'] = $value;
				$data[$arr[0]]['two'][$arr[1]]['three'][$arr[2]]['region_num'] = 0;

				if(!isset($data[$arr[0]]['two'][$arr[1]]['rowspan_two'])){
					$data[$arr[0]]['two'][$arr[1]]['rowspan_two'] = 0;
				}
				if(!isset($data[$arr[0]]['rowspan_one'])){
					$data[$arr[0]]['rowspan_one'] = 0;
				}
				$data[$arr[0]]['rowspan_one'] += 1;                                //table最大层rowspan多少
				$data[$arr[0]]['two'][$arr[1]]['rowspan_two'] += 1;                 //table中间层rowspan多少
			}
	    }
		
		unset($regionJson,$result,$arr);                              
		$start = date('Y-m-d',$start); 
		$end = date('Y-m-d',$end);
	    $sql = "select daytime,region from clientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultRegion = R::getAll($sql);
		if($resultRegion){
			foreach ($resultRegion as $key => $value) {
				$region = unserialize($value['region']);
				if($region){
					foreach($region as $k=>$v){
						if ($k == 0) continue;
							$ar = explode('-',$k);
							$n = count($ar);
							$sign = false;
							if($n!=3 && $v!=0){
								$data[$ar[0]]['other_num'] +=  1;
								//如果有三层，但是又把他增加在了第一层或第二层上,则算在其它上
								if($sign==false){
								  $data[$ar[0]]['rowspan_one']	= $data[$ar[0]]['rowspan_one']+1;	
								  $sign = true;
								}
							}else{
								$data[$ar[0]]['two'][$ar[1]]['three'][$ar[2]]['region_num'] += (int)$v;
							}
							
					}
				}
			}
		}

		return $data;
	}   
    /**
     * 按时间统计
     * */
    public function statByDate($where) {
        $action = isset($where['action']) ? $where['action'] : 'source';
        $start = isset($where['start']) ? $where['start'] : date('Y-m-01', strtotime(date("Y-m-d")));
        $start = strtotime($start . ' 00:00:00');
        $end = isset($where['end']) ? strtotime($where['end'] . ' 23:59:59') : time();
    
        switch ($action) {
        	case 'receptionist':
        	    return $this->getRecptionistByDate($start, $end);
        	    break;
        	case 'source':
        	    return $this->getSourceByDate($start, $end);
        	    break;
        	default:
        	    break;
        }
        return false;
    }
    
    /**
     * 按时间获取来源每天接待到诊的客户量
     * */
    protected function getSourceByDate($start, $end) {
        $sql = 'select id, title from patientdatasource';
        $result = R::getAll($sql);
        $columns = array();
        foreach ($result as $value) {
            if ($value['title']) {
                $columns[$value['id']] = $value['title'];
            }
        }
        $return = $this->initArray($start, $end, $columns);
		
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select source,daytime from clientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $resultSource = R::getAll($sql);
		if($resultSource){  	
			foreach ($resultSource as $key=>$value) {
					$source = unserialize($value['source']);
				if($source){
					foreach($source as $k=>$v){
						if($v[1]){
							$return[$value['daytime']][$columns[$k]] += (int)$v[1];
						}
					}
				}
			}
		}
        return $return;
    }
    
    /**
     * 按时间获取咨询员每天接待到诊的客户量
     * */
    protected function getRecptionistByDate($start, $end) {
        $sql = 'select w.id, w.nick_name from clienttoworker as cw left join worker as w on cw.work_id=w.id';
        $result = R::getAll($sql);
        $columns = array();
        foreach ($result as $value) {
            $columns[$value['id']] = $value['nick_name'];
        }
		unset($result);
        $return = $this->initArray($start, $end, $columns);

        //一定到诊统计
		$start = date('Y-m-d',$start); 
		$end=date('Y-m-d',$end);
	    $sql = "select kefu,daytime from clientdata where 1=1";
	    if ($start && $end) {
	        $sql .= " and daytime between '" . $start . "' and '" . $end ."'";
	    }	
	    $result = R::getAll($sql);
		if($result){
			foreach ($result as $key=>$value) {	
				$kefu = unserialize($value['kefu']);				
				foreach($kefu as $k=>$v){
					if(!empty($columns[$k])){
						$return[$value['daytime']][$columns[$k]] =  + (int)$v;
					}
				}
			}
		} 
        return $return;
    }
    
    /**
     * 格式化时间
     * 
     * @$day 间隔天数，默认1天，即每天都统计
     * */
    public function initArray($starTime, $endTime, $columns=array()) {
        $array = array();
        for ($i = $starTime; $i <= $endTime;) {
            $j = $i + 86400;
            $field = date('Y-m-d', $i);
			foreach($columns as $val){
				$array[$field][$val] = 0;
			}
            $i = $j;
        }       
        return $array;
    }
    
    /**
     * 保存关注组的信息
     * */
    public function saveGroup($group) {
        //查看组是否存在
        $result = R::findOne('clientgroup', 'name="' . $group->name . '"');
        if (!empty($result) && $result->id != '') {
        	throw new ValidatorException('222', '组名已存在');
        }
        return $this->dealAddOperator($group, 'clientgroup', true);
    }
    
    /**
     * 获取组信息
     * */
    public function getGroups() {
        return $this->dealFindOperator('ClientGroup');
    }
    
    /**
     * 获取组下用户信息
     * */
    public function getGroupUsers($groupid) {
        if ($groupid == 'all') {
        	$sql = '';
        	$bind=array();
        } else {
        	$sql = 'group_id=:group_id';
        	$bind=array('group_id'=>(int)$groupid);
        }
        
        
        return $this->dealFindOperator('Worker', $sql,$bind);
    }


	/**
     * 保存ClientData
     * 
     * */
    public function saveClientData($clientdata) {    	
    	$clientdataBean = R::dispense(TABLENAME_CLIENTDATA);    	
    	$clientdata->generateRedBean($clientdataBean);    	    	
    	R::store($clientdataBean);    	  	
    	return $clientdataBean->id;//返回数据成功添加后的ID
    }
    /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function updateClientData($entity) {
        $bean = R::load(TABLENAME_CLIENTDATA, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);

        return new Result(true, 0, '', NULL);
    }
	/*
	 * 检验数据存在
	 * */
	public function checkDataIsAdd($time){
		$result=R::findOne( TABLENAME_CLIENTDATA, 'daytime =:daytime', array('daytime'=>date('Y-m-d',$time)));	
		if($result!=null){
			return $result;
		}
		return '';
	}

    
    /**
     * 保存用户关注者
     * @param $entity clientwork
     * */
    public function saveclientwork($clientwork){
    	$clientworkBean = R::dispense($this->clienttoworker);
    	$clientwork->generateRedBean($clientworkBean);
    	
    	R::store($clientworkBean);
    }
    /**
     * 取关注者
     * */
    public function getclientworker($arr){
    	$result=R::findAll($this->clienttoworker,'client_id=:client_id',$arr);
    	$arr=array();
    	if(!empty($result)){
    		foreach($result as $key=>$val){
    			$entity = new ClientWorker();
    			$entity->generateFromRedBean($val);
    			$arr[] = $entity;
    		}    		
    	}
    	
    	return $arr;
    }
    /**
     * 通过workid获取数据
     * @param array('work_id'=>$workid,'page'=>开始查询位置,'size'=>总数)
     * */
    public function getbyworkid($arr){
    	
    	$result=R::findAll($this->clienttoworker,'work_id=:work_id Limit :page,:size',$arr);
    	
    	$arr=array();
    	if(!empty($result)){
    		foreach($result as $key=>$val){
    			$entity = new ClientWorker();
    			$entity->generateFromRedBean($val);
    			$arr[] = $entity;
    		}    		
    	}
    	
    	return $arr;
    }
    
    /**
     * 查询客户关系表中符合条件的数据数量
     * */
    public function gettotal_work($arr){
    	$result=R::count($this->clienttoworker,'work_id=:work_id',$arr);

    	 
    	return $result;
    }
    /**
     * 查看用户和关注者之间的关联关系
     * @param array('client_id','work_id')
     * */
    public function workclientres($arr){
    	$result=R::findOne($this->clienttoworker,'work_id=:work_id and client_id=:client_id',$arr);
    return $result;
    }
    
    /**
     * 取用户记录来访
     * */
    public function getclientrecord($arr){
    	if(isset($arr['page'])&&strlen($arr['page']>0)&&isset($arr['size'])&&strlen($arr['size'])>0){
    		$sql = ORMMap::$sqlMap['receptionlistcheck'].' LIMIT :page,:size';
    		
    	}else{
    		$arr=array('client_id'=>$arr['client_id']);
    		$sql = ORMMap::$sqlMap['receptionlistcheck'];
    	}

   

    	
    	return R::getAll( $sql,$arr);

    	
    }
    /**
     * 取客服记录中符合条件的总数
     * */
    public function getrecordnum($arr){
    	$result=R::count($this->clienttoworker,'client_id=:client_id',$arr);
    	return $result;
    }
    /**
     * 通过电话号码取客户信息
     * */
    public function getbytelephone($arr){
    	$result=R::findOne($this->tableName,'telephone=:telephone',$arr);
    	return $result;
    }
    /**
     * 通过手机和姓名查找用户
     * */
    public function getclientbytn($arr){
    	$bean=R::findOne($this->tableName,'telephone=:telephone and username=:username',$arr);
    	$obj = new Client();
    	$obj->generateFromRedBean($bean);
    
    	return $obj;
    }
      /**
     * 查询record条数
     * */
    public function getTotalRecord($arr){
    	$result=R::count($this->recordTable,'client_id=:client_id',$arr);   	 
    	return $result;
    }
	
	public function getClientData($start, $end){
	    $sql = "select cr.recordtime,cr.client_id,cr.reception_id,c.id,c.source,c.address";
		$sql .=" ,rb.statu,rb.date"; 
	    $sql .= " from `client` as c";
	    $sql .= " left join `clientrecord` as cr on c.id=cr.client_id";
	    $sql .= " left join `resbookinginfo` as rb on rb.telephone=c.telephone";
	    if ($start && $end) {
			$start = date('Y-m-d', $start);
			$end = date('Y-m-d', $end);
	        $sql .= " where cr.recordtime between '" . $start . "' and '" . $end . "'";
	    }	
	    return R::getAll($sql);
	}
	/**
	 * 更新统计数据
	 * */
	public function updateStatData($data) {
	    foreach ($data as $c) {
	        $this->updateData($c);
	    }
		return true;
	}
	/**
	 * 更新统计数据
	 * */
	protected function updateData($cdata) {
	    //根据日期获取md5值
	    $daytime = $cdata->daytime;
	    $cDataObj = R::findOne('clientdata', 'daytime=:daytime', array(':daytime'=>$daytime));
	    if (isset($cDataObj->id)) {
	        //查看md5是否相同
	        if ($cDataObj->data_md5 != $cdata->data_md5) {
	            //更新
	            $cdata->id = $cDataObj->id;
	            return $this->clientDataUpdate($cdata,'clientdata');
	        }
	    } else {
	        //添加
	        return $this->clientDataSave($cdata,'clientdata');
	    }
	}
    /**
     * 修改数据
     *
     * @param object $entity
     * @return boolean
     */
    public function clientDataUpdate($entity,$tableName) {
        $bean = R::load($tableName, $entity->id);

        if ($bean->id == 0) {
            return new Result(false, 78, ErrorMsgs::get(78), NULL);
        }
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);

        return new Result(true, 0, '', NULL);
    }
    /**
     * 插入数据
     *
     * @param unknown $entity
     * @return boolean
     */
    public function clientDataSave($entity,$tableName) {
    	
        $bean = R::dispense($tableName);
        $entity->generateRedBean($bean);
        $entity->id= R::store($bean);
        return $entity;
    }
}
