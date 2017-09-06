<?php
/**
 *  
 * 设备标签 除了tag
 * 内的变量都参与过滤
 * {device id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_device($params, &$smarty) {
	$ser = new DeviceTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($params['id']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}