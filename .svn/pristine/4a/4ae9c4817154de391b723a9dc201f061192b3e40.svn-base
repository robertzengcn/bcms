<?php
/**
 *  
 * picManager标签 除了tag
 * 内的变量都参与过滤
 * {picManager field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_picManager($params, &$smarty) {
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
	$ser = new PicManagerTag();
	$data = $ser->findOne ( $where, $field );
	$smarty->assign ( $params ['assign'], $data );
}