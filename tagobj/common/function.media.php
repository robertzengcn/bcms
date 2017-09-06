<?php
/**
 *  
 * 报道标签 除了tag
 * 内的变量都参与过滤
 * {media id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_media($params, &$smarty) {
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
	$ser = new MediaReportTag();
	$data = $ser->findOne ( $where, $field );
	$smarty->assign ( $params ['assign'], $data );
}