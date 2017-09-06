<?php
/**
 *  
 * 联系方式标签 除了tag
 * 内的变量都参与过滤
 * {contacts field="*" order="id desc" limit="10" assign="xxx"}
 * 
 * 
 */
function smarty_function_contacts($params, &$smarty) {
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
	$order = empty ( $params ['order'] ) ? "id desc" : $params ['order'];
	$limit = empty ( $params ['limit'] ) ? "10" : $params ['limit'];
	$ser = new ContactTag();
	$data = $ser->getLimit ($order, $limit, $where, $field);
	$smarty->assign ( $params ['assign'], $data );
}