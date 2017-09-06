<?php
/**
 *  
 * 疾病标签 除了tag
 * 内的变量都参与过滤
 * {diseases field="*" order="id desc" limit="10" assign="xxx"}
 * 
 * 
 */
function smarty_function_diseasesInDepartment($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	$ser = new DiseaseTag();
	foreach ( $params as $key => $v ) {
		if ($key != 'assign'){
			$data = $ser->getByDeparment($v);
		}
	}
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}