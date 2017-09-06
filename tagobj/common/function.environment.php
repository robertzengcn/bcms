<?php
/**
 *  
 * 环境标签 除了tag
 * 内的变量都参与过滤
 * {environment id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_environment($params, &$smarty) {
	$ser = new EnvironmentTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($params['id']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}