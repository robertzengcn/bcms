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

/**
 *
 * 环境标签 除了tag
 * 内的变量都参与过滤
 * {environments field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_environments($params, &$smarty) {
    $page = isset($params['page']) ? $params['page'] : 1;
    $limit = isset($params['limit']) ? $params['limit'] : '';
    $ser = new EnvironmentTag();
    //$data = $ser->getLimit ($order, $limit, $where, $field);
    $data = $ser->getList($page,$limit);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

