<?php
/**
 * 科室数据调取 标签 
 * {department params1="params1" params2="params2" ... }
 * {/department}
 *
 */
function smarty_block_department($params, $content, &$smarty, &$repeat) {
	$tag = array (
			'data',
			'order',
			'limit',
			'field',
			'tmp' 
	);
	$where = '1=1';
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$filename = empty ( $params ['tmp'] ) ? 'index' : $params ['tmp'];
	$ser = new DepartmentTag();
	$data = $ser->getLimit ( $params ['order'], $params ['limit'], $where, $field );
	if (! $repeat) {
		$dir = str_replace ( 'tag', '', strtolower ( get_class ( $ser ) ) );
		$file = TAGDIR . $dir . '/' . $filename . '.html';
		if (! file_exists ( $file )) {
			$file = TAGDIR . $filename . '.html';
		}
		$smarty->assign ( 'dir', $dir );
		$smarty->assign ( 'data', $data );
		return $smarty->fetch ( $file );
	}
}