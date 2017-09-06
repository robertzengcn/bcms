<?php
/**
 *  
 * 疾病标签 除了tag内的变量都参与过滤
 * {detailTag data=object id="12" field="*"} {/detail}
 *  
 * 
 */
function smarty_block_detailTag($params, $content, &$smarty, &$repeat) {
	$tag = array (
			'data',
			'field',
			'assign' 
	);
	
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 

		{
			$where [$key] = $v;
		}
	}
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$data = $params ['data']->find ( $where, $field );
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