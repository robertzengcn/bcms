<?php
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