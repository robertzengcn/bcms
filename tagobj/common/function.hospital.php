<?php
/**
 *  
 * 医院简介标签 除了tag
 * 内的变量都参与过滤
 * {hospital field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_hospital($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$ser = new HospitalTag();
	//$data返回为对象中的对象,,待修改
	$data = $ser->get();
	$smarty->assign ( $params ['assign'], $data->data );
}