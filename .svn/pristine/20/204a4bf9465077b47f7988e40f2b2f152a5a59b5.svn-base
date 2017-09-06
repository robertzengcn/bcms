<?php
/**
 * 通用文章数据调取 标签 
 * {article params1="params1" params2="params2" ... }
 * {/article}
 *
 */
function smarty_block_articleTag($params, $content, &$smarty, &$repeat) {
	$tag = array (			
			'order',
			'limit',
			'field',
			'tmp' 
	);
	$where = array();
	fb('articleTag33');
	$smarty->assign ( 'www', 'wwwwwwwwwww' );
	
	$dir = str_replace ( 'tag', '', strtolower ( get_class ( $ser ) ) );
	$file = TAGDIR . $dir . '/' . $filename . '.htpl';
	if (! file_exists ( $file )) {
	    $file = TAGDIR . $filename . '.htpl';
	}
	return $smarty->display ($file);
	return 'dddddd';
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	
	
	$field = isset ( $params ['field'] ) ? "*" : $params ['field'];
	$filename = empty( $params ['tmp'] ) ? 'index' : $params ['tmp'];
	$ser = new ArticleTag();
	$data = $ser->getNewest($params ['limit']);
	
	$return = 'r';
	$dataindex = md5 ( __FUNCTION__ . md5 ( serialize ( $params ) ) );
	$dataindex = substr ( $dataindex, 0, 16 );
	$smarty->blocksdata[$dataindex] = $data;
	$smarty->assign($return, $data);
	
	//$data = $ser->getLimit ( $params ['order'], $params ['limit'], $where, $field );
	fb('------------','block');
	fb($data, 'ddd');
	//return $data;
	if (list ( $key, $item ) = each ( $smarty->blocksdata [$dataindex] )) {
	    $smarty->assign ( $return, $item );
	    $repeat = true;
	}
	
	return 'ddddddddd';
	
	if (! $repeat) {
		$dir = str_replace ( 'tag', '', strtolower ( get_class ( $ser ) ) );
		$file = TAGDIR . $dir . '/' . $filename . '.htpl';
		if (! file_exists ( $file )) {
			$file = TAGDIR . $filename . '.htpl';
		}
		//$file = ABSPATH . '/index.html';
		$smarty->assign ( 'dir', $dir );
		$smarty->assign ( 'data', $data );
		fb($file,'ff');
		return $smarty->fetch ( $file );
	}
	
}