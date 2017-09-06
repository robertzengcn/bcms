<?php
/**
 * 同一列表标签
 * 可配合分页标签使用 
 * {listTag data="对象" params1="params1" params2="params2" ... } {/listTag}
 * @param string order 		排序条件 			默认 		id desc
 * @param string page 		查询条数			默认		    10
 * @param string current 	当前分页 			默认 		1 
 * 
 */
function smarty_block_listTag($params, $content, &$smarty, $repeat) {
	$tag = array ('data', 'order', 'field', 'limit', 'page', 'current', 'tmp' );
	$where = array ('1' => 1 );
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 

		{
			$where [$key] = $v;
		}
	}
	$current = empty ( $params ['current'] ) ? 1 : $params ['current']; // 当前页
	$field = empty ( $params ['field'] ) ? "*" : $params ['field']; // 查询字段
	$filename = empty ( $params ['tmp'] ) ? 'list' : $params ['tmp']; // 模板目录
	$page = empty ( $params ['page'] ) ? 0 : intval ( $params ['page'] - 1 );

	$limit = array ("page" => $page, "size" => $params ['limit'] );	
	$data = $params ['data']->getPage ( $field, $where, $limit, $params ['order'] );
	if (! $repeat) {
		
		$dir = str_replace ( 'tag', '', strtolower ( get_class ( $params ['data'] ) ) );
		$file = TAGDIR . $dir . '/' . $filename . '.html';
		if (! file_exists ( $file )) {
			$file = TAGDIR . $filename . '.html';
		}
		$smarty->assign ( 'dir', $dir );
		$smarty->assign ( 'current', $current );
		$smarty->assign ( 'page', $params ['page'] );
		$smarty->assign ( 'data', $data );
		return $smarty->fetch ( $file );
	}
}