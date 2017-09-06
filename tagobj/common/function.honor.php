<?php
/**
 *  
 * 荣誉标签 除了tag
 * 内的变量都参与过滤
 * {honor id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_honor($params, &$smarty) {
	$ser = new HonorTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($params['id']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}