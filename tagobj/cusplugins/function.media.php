<?php
/**
 *  
 * 报道标签 除了tag
 * 内的变量都参与过滤
 * {media id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_media($params, &$smarty) {
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
	$ser = new MediaReportTag();
	$data = $ser->findOne ( $where, $field );
	$smarty->assign ( $params ['assign'], $data );
}

/**
 *
 * 报道标签 除了tag
 * 内的变量都参与过滤
 * {media id="12" field="*" assign="xxx"}
 *
 *
 */
function smarty_function_mediareport($params, &$smarty) {
    $ser = new MediaReportTag();
    //$data = $ser->findOne ( $where, $field );
    $data = $ser->get($params['id']);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 报道标签 除了tag
 * 内的变量都参与过滤
 * {medias field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_mediareports($params, &$smarty) {
    $page = isset($params['page']) ? $params['page'] : 1;
    $limit = isset( $params ['limit'] ) ? $params ['limit'] : '';
    $ser = new MediaReportTag();
    //$data = $ser->getLimit ($order, $limit, $where, $field);
    $data = $ser->getList($page,$limit);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 报道标签 除了tag
 * 内的变量都参与过滤
 * {medias field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_medias($params, &$smarty) {
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
    $ser = new MediaReportTag();
    $data = $ser->getLimit ($order, $limit, $where, $field);
    $smarty->assign ( $params ['assign'], $data );
}

