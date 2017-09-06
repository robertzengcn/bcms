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