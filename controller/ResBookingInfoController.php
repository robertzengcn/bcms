<?php

class ResBookingInfoController extends Controller {

    private $service;

    function __construct() {
        parent::__construct();
        $this->service = new ResBookingInfoService();
    }

    function filter() {
        $filterService = new FilterService();
        $filterService->addFunc($filterService::$SQLINJECTION);
       // $filterService->addFunc($filterService::$WORKERISLOGIN);
        $filterService->addFunc($filterService::$FILERPLUSHTIME);
        $filterService->addFunc($filterService::$WORKERLOGHISTORY);

        return $filterService->execute();
    }

    /**
     * 添加数据
     */
    public function add() {
        
        if (1 > (int) $_REQUEST['along']) {
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
        $detail = new ResVation();
        $detail->department_id = $array['department_id'];
        $detail->doctor_id = $array['doctor_id'];
        $detail->statu = '已约';
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
        $total = $this->service->gettotal();
        if(isset($_REQUEST['draw'])&&strlen($_REQUEST['draw'])>0){
         	$draw=$_REQUEST['draw'];
        }else{
         	$draw=1;
        }
        
        echo json_encode(array(
            'draw'=>$draw,
        	'recordsTotal'=>$total,
        	'recordsFiltered'=>$ttl,
        	'data'=>$result->data,		
            'rows' => $result->data,//预留保证原来的程序能够顺利运行
            'ttl' => $ttl
        ));
    }

    /**
     * 获取所有满足条件预约人的信息列表
     * */
    public function getAllbookinginfos() {    	
    	$data = $this->service->getAllbookinginfos($where='');
    	echo json_encode($data);
    }
    
    /**
     * 将前端提交预约的患者信息存入
     */
    public function saveBookingInfo() {
    	$this->blindParams($resbookinginfo = new ResBookingInfo());     	
    	$data = $this->service->saveBookingInfo($resbookinginfo);     	 	
    	echo json_encode($data);
    }
    
    
    /**
     * 根据id获取一条数据 .
     * ..
     */
    public function get() {
        $this->blindParams($reservationdetail = new ResBookingInfo());
        $res = $this->service->get($reservationdetail);		
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
                $this->blindParams($reservation = new Reservation());
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
        $detail = new ResBookingInfo();
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
     * 更新排班表
     * 
     * */
    
    
    public function update(){
    	
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
        $this->blindParams($reservation = new Reservation());
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

    public function getReservation($dep,$doc,$date) {
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
     * 处理开始时间 结束时间...
     */
    public function process() {
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
        $count = $time3 / 86400;
        $time = $time1;
        $date = array();
        $week = array();
        $date[] = $array['start'];
        $week[] = date('w', $time1);
        for ($i = 1; $i < $count; $i ++) {
            $time = $time + 86400;
            $date[] = date('Y-m-d', $time);
            $week[] = date('w', $time);
        }
        if ($time1 != $time2) {
            $date[] = $array['end'];
            $week[] = date('w', $time2);
        }
        $arr = array();
        $arr['date'] = $date;
        $arr['week'] = $week;
        $arr['statu'] = true;
        echo json_encode($arr);
    }

    /**
     * 将预约者添加到预约表中去,修改未约成已约
     */
    public function reserUser() {       
        $res=$this->service->queryDetail();
        $reservationDetail = new ResBookingInfo();
        $reservationDetail->id=$res->id;
        $reservationDetail->department_id=$res->department_id;
        $reservationDetail->doctor_id=$res->doctor_id;
        $reservationDetail->date=$res->date;
        $reservationDetail->times=$res->times;
        $reservationDetail->statu='已约';
        $reservationDetail->username=$_REQUEST['name'];
        $reservationDetail->telephone=$_REQUEST['hometel'];
        $this->service->reservationDetail($reservationDetail);        
       
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
    
    
    /**
     * 导出数据

    
    public function exportdate(){
    	$result = $this->service->getAllbookinginfos();     	
    	if($result['ttl']==0){
    		$result=false;
    	}else{ 
    		$rows=$result['rows'];   		
    		$str = "序号,患者姓名,电话,身份证号,预约科室,预约医生,预约日期,详细时间,状态\n";    		
    		while(list($key, $value)=each($result['rows'])){    			
    			$str .= $value->id.",".$value->username.",".$value->telephone.",".$value->id_card.",".$value->department_name.",".$value->doctor_name.",".$value->date.",".$value->times.",".$value->statu."\n";
    		}    
    		$filename = date('Ymdhis').rand(1000,9999).'.csv';
    		$csv_url = ABSPATH."/". $filename;
    		$myfile = @fopen( $csv_url, "w") or die("Unable to open file!");
    		$strdate =iconv('utf-8','GB2312//IGNORE',$str);
    		@fwrite($myfile, $strdate);
    		@fclose($myfile);
    		$files=NETADDRESS."/".$filename;
    		echo json_encode(array('stutes'=>true,'url'=>$files));
    	}
    }
    
    /**
     * 删除单笔数据
     */
    public function del() {
    	if (is_array($_REQUEST['id'])) {
		$resbookingfo = $_REQUEST['id'];
		
		} else {
    		$resbookingfo = array(
    				$_REQUEST['id']
    		);
    	}
    	$result = $this->service->deleteBatch($resbookingfo);
    
    	echo json_encode($result);
    }
    /**
     * 通过手机取预约信息
     * @param mobile
     * */
    public function getdatabytelephone(){
    	$telephone=$this->getRequest('telephone',null);
    	if(!$telephone){
    		die(json_encode(array('statu'=>false,'code'=>2,'msg'=>'手机号码不正确','data'=>null)));    		    	
    	}
    	
    	$result=$this->service->getbookinginfobytelephone($telephone);
    	if($result->statu){
    		die(json_encode(array('rows'=>$result->data,'ttl'=>count($result->data))));
    	}
    }
    
    
}