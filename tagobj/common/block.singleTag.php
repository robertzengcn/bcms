<?php
/**
 * 通用数据调取 标签 {singleTag data="对象" params1="params1" params2="params2" ... } {/singleTag}
 */
function smarty_block_singleTag($params, $content, &$smarty, &$repeat) {
	$tag = array (
			'data',
			'field',
			'tmp' 
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
	if (! $repeat) {
		$dir = str_replace ( 'tag', '', strtolower ( get_class ( $params ['data'] ) ) );
		$file = TAGDIR . $dir . '/' . $filename . '.html';
		if (! file_exists ( $file )) {
			$file = TAGDIR . $filename . '.html';
		}	
		$smarty->assign ( 'dir', $dir );
		$smarty->assign ( 'data', $data );	
		return $smarty->fetch ( $file );
	}
}