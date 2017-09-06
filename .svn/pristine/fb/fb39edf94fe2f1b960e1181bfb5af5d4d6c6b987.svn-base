<?php
function smarty_function_commonFun($params, $smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
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
	$dir = str_replace ( 'tag', '', strtolower ( get_class ( $params ['data'] ) ) );
	$smarty->assign ( 'dir', $dir );		
	$smarty->assign ( $params ['assign'], $data );
}