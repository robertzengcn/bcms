<?php
/**
 *  
 * 医生标签 除了tag
 * 内的变量都参与过滤
 * {disease id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_disease($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	foreach ( $params as $key => $v ) {
		if ($key == 'id' || $key=='name'){
			$disease = $v;
		}
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$ser = new DiseaseTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($disease);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}