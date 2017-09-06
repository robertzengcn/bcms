<?php
/**
 *  
 * 科室标签 除了tag
 * 内的变量都参与过滤
 * {department id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_department($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	foreach ( $params as $key => $v ) {
		if ($key=='id' || $key=='name'){
			$department = $v;
		}
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$ser = new DepartmentTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($department);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}