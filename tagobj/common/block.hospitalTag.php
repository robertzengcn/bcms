<?php
/**
 * 医院简介数据调取 标签 
 * {hospital params1="params1" params2="params2" ... }
 * {/hospital}
 */

/**待改动**/

function smarty_block_hospitalTag($params, $content, &$smarty, &$repeat) {
	$tag = array (
			'data',
			'order',
			'limit',
			'field',
			'tmp' 
	);
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$filename = empty ( $params ['tmp'] ) ? 'index' : $params ['tmp'];
	$ser = new HospitalTag();
	$data = $ser->get();
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