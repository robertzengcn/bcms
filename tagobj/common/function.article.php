<?php
/**
 *  
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {article id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_article($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	$where = array();
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$ser = new ArticleTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($params['id']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}