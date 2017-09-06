<?php
/**
 * 通用数据调取 函数
    {singleFun data="对象" params1="params1" params2="params2" ... } 
 */
function smarty_function_singleFun($params, &$smarty) {
	$tag = array (
			'order',
			'limit',
			'field',
			'assign' 
	);
	$where=array();
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}

	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$filename = empty ( $params ['tmp'] ) ? 'index' : $params ['tmp'];
	$data = $params ['data']->findOne ( $where, $field );
	$smarty->assign ( $params ['assign'], $data );
}