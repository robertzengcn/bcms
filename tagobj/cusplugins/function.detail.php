<?php
/**
 *  
 * 详细标签 除了tag
 * 内的变量都参与过滤
 * {detail data=object id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_detail($params, &$smarty) {
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