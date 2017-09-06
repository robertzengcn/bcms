<?php
/**
 * 通用文章调取标签  
 * 除了tag内的变量都参与过滤
 * {general data=object order="id desc" limit="10" is_top="1" position="2" categroy="2" type="1"}
 * {/general} 
 */
function smarty_block_generalTag($params, $content, &$smarty, &$repeat) {
	$tag = array (
			'data',
			'order',
			'limit',
			'field',
			'tmp' 
	);
	
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 

		{
			$where [$key] = $v;
		}
	}
	
	$data = $params ['data']->getGeneralOne ( $params ['order'], $params ['limit'], $where, $params ['field'] );
	$filename = empty ( $params ['tmp'] ) ? 'index' : $params ['tmp'];
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