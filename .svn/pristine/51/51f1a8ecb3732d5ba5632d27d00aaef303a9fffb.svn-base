<?php
/**
 *  
 * 新闻动态标签 除了tag
 * 内的变量都参与过滤
 * {news id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_news($params, &$smarty) {
	$ser = new NewsTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($params['id']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}