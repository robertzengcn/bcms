<?php
/**
 *  
 * 荣誉标签 除了tag
 * 内的变量都参与过滤
 * {honors field="*" order="id desc" limit="10" assign="xxx"}
 * 
 * 
 */
function smarty_function_honors($params, &$smarty) {
	$page = isset($params['page']) ? $params['page'] : 1;
	$limit = isset($params['limit']) ? $params['limit'] : '';
	$ser = new HonorTag();
	//$data = $ser->getLimit ($order, $limit, $where, $field);
	$data = $ser->getList($page,$limit);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}