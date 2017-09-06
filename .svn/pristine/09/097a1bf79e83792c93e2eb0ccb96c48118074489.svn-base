<?php
/**
 * 通用文章数据调取 标签 
 * {loop data="对象" params1="params1" params2="params2" ... }
 * {/loop}
 * {loop data=$article order="id desc" limit="5" tmp="list" field="id,title"}
 * {/loop}
 */
function smarty_block_loopTag($params, $content, &$smarty, &$repeat) {
	$tag = array (
			'data',
			'order',
			'limit',
			'field',
			'tmp' 
	);
	$where = array();
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$filename = empty ( $params ['tmp'] ) ? 'index' : $params ['tmp'];
	$data = $params ['data']->getLimit ( $params ['order'], $params ['limit'], $where, $field );
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