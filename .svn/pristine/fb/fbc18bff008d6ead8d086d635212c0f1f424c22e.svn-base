<?php
/**
 *  
 * 科室标签 除了tag
 * 内的变量都参与过滤
 * {deparments field="*" order="id desc" limit="10" assign="xxx"}
 * 
 * 
 */
function smarty_function_departmentsVector($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	$ser = new DepartmentTag();
	foreach ( $params as $key => $v ) {
		if ($key != 'assign'){
			$data = $ser->in($v);
		}
	}
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$order = empty ( $params ['order'] ) ? "id desc" : $params ['order'];
	$limit = empty ( $params ['limit'] ) ? "10" : $params ['limit'];
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}