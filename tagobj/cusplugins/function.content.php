<?php
/**
 * 获取详细	内容
 * 
 * @param unknown $params
 * @param unknown $smarty
 * 
 */
function smarty_function_content($params, &$smarty) {
	$tag = array (
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
	$data = $params ['data']->findOne ( $where, $field );
	$smarty->assign ( $params ['assign'], $data );
}