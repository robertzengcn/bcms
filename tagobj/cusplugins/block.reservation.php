<?php
/**
 * 预约挂号
 * */
require_once 'common.php';
/**
 * 获取出指定时间内所有的医生相关数据
 *
 * 对应function标签听{getReservation}
 */
function smarty_block_allreserbylimit( $params, $content, $template, &$repeat ) {
    $start = isset($params['start']) ? $params['start'] : '';
    $end = isset($params['end']) ? $params['end'] : '';
    $model = isset($params['model']) ? $params['model'] : 1;

    if (!$repeat) {
        $ser = new ReservationTag();
        $data = $ser->getLimitAll($start='',$end='',$model);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取预约挂号医生列表
 */
function smarty_block_reserdoclist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    $docreservation = empty ( $params ['docreservation'] ) ? "" : $params ['docreservation'];
    
    if (!$repeat) {
        $ser = new DoctorManagerTag();
        $data = $ser->getList($current, $pagesize, $sort);
        foreach ($data as $key=>$doctorinfo) {
            if ($docreservation) $doctorinfo->docreservation = array();
    
            if ($doctorinfo->pic&&strpos($doctorinfo->pic, NETADDRESS) === false) {
				$doctorinfo->pic = preg_replace('/^\//', '', $doctorinfo->pic, 1);
                $data[$key]->pic = UPLOAD . $doctorinfo->pic;
            }
            $data[$key]->url = NETADDRESS . "/reservation/" . $doctorinfo->id . ".html";
        }
        $template->assign('cur', $current);
    
        //保存pagesize
        setcookie('pagesize', $pagesize);
    
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
    
        return formatReturnData($data, $content);
    }
}

/**
 * 根据页码获取对应的数据-预约挂号列表
 */
function smarty_block_reserlist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    if (!$repeat) {
        $ser = new ReservationTag();
        $data = $ser->getList($current, $pagesize, $sort);
        $template->assign('cur', $current);
        
        //保存pagesize
        setcookie('pagesize', $pagesize);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取单个医生排班
 */
function smarty_block_doctorreser( $params, $content, $template, &$repeat ) {
    $department = isset($params['department_id']) ? $params['department_id'] : 0;
    $doctor = isset($params['doctor_name']) ? $params['doctor_name'] : '';

    if (!$repeat) {
        $ser = new ReservationTag();
        $data = $ser->getDocReservation($department,$doctor);
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取详细的上班时间表
 *
 */
function smarty_block_reserdetaillist($params, $content, $template, &$repeat){
    $department = isset($params['department_id']) ? $params['department_id'] : '';
    $doctor = isset($params['doctor_id']) ? $params['doctor_id'] : '';
    $date = isset($params['date']) ? $params['date'] : '';
    $times = isset($params['times']) ? $params['times'] : '';

    if (!$repeat) {
        $ser = new ReservationTag();
        $data = $ser->getDetailList($department,$doctor,$date,$times);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取已约用户
 * */
function smarty_block_reseruserlist($params, $content, $template, &$repeat){
    $from = isset($params['from']) ? $params['from'] : 0;
    $limit = isset($params['limit']) ? $params['limit'] : '';
    if (!$repeat) {
        $ser = new ReservationTag();
        $data = $ser->getUserList()->data;
        if ($limit) {
        	$data = array_splice($data, $from, $limit);
        }
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }

        return formatReturnData($data, $content);
    }
}