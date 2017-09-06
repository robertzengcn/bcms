<?php
/**
 *  
 * 案例标签 除了tag
 * 内的变量都参与过滤
 * {success id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_success($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$ser = new SuccessTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($params['id']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}

/**
 *
 * 案例标签 除了tag
 * 内的变量都参与过滤
 * {successes field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_successes($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );
    $where=array();
    foreach ( $params as $key => $v ) {
        if (! in_array ( $key, $tag ) && ! empty ( $v ))
        {
            $where [$key] = $v;
        }
    }

    $field = empty ( $params ['field'] ) ? "*" : $params ['field'];
    $order = empty ( $params ['order'] ) ? "id desc" : $params ['order'];
    $limit = empty ( $params ['limit'] ) ? "10" : $params ['limit'];
    $ser = new SuccessTag();
    //$data = $ser->getLimit ($order, $limit, $where, $field);
    $data = $ser->getList($params['page']);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

