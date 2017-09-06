<?php
/**
 *  
 * 医生标签 除了tag
 * 内的变量都参与过滤
 * {doctor id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_doctor($params, &$smarty) {
	foreach ( $params as $key => $v ) {
		if ($key == 'id' || $key == 'name'){
			$doctor = $v;
		}
	}
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$ser = new DoctorTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($doctor);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}

/**
 *
 * 医生标签 除了tag
 * 内的变量都参与过滤
 * {doctors field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_doctors($params, &$smarty) {
    $page = isset($params['page']) ? $params['page'] : 1;
    $limit = isset( $params ['limit'] ) ? $params ['limit'] : '';
    $ser = new DoctorTag();
    //$data = $ser->getLimit ($order, $limit, $where, $field);
    $data = $ser->getList($page,$limit);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 医生标签 除了tag
 * 内的变量都参与过滤
 * {doctors field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_doctorsInDepartment($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );
    $where=array();
    $ser = new DoctorTag();
    foreach ( $params as $key => $v ) {
        if ($key != 'assign'){
            $data = $ser->getByDepartment($v);
        }
    }
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 医生标签 除了tag
 * 内的变量都参与过滤
 * {doctors field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_resume($params, &$smarty) {
    $ser = new DoctorTag();
    foreach ( $params as $key => $v ) {
        if ($key != 'assign'){
            $data = $ser->getResumes($v);
        }
    }
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

