<?php
/**
 *  
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {articles field="*" order="id desc" limit="10" assign="xxx"}
 * 
 * 
 */
function smarty_function_articlesInNewest($params, &$smarty) {
	$ser = new ArticleTag();
	$data = $ser->getNewest($params['limit']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}