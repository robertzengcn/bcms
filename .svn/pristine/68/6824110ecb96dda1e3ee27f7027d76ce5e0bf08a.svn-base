<?php
/**
 *  
 * 导航标签 除了tag
 * 内的变量都参与过滤
 * {navigation id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_navigation($params, &$smarty) {
    fb('function');
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
	$ser = new NavigationTag();
	$data = $ser->findOne ( $where, $field );
	fb($data, 'func');
	$smarty->assign ( $params ['assign'], $data );
}

/**
 *
 * 导航标签 除了tag
 * 内的变量都参与过滤
 * {navigations field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_navigations($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );

    $where = array ();

    foreach ( $params as $key => $v ) {
        if (! in_array ( $key, $tag ) && $v !== null) {
            $where [$key] = $v;
        }
    }

    $field = empty ( $params ['field'] ) ? "*" : $params ['field'];
    $order = empty ( $params ['order'] ) ? "cate asc,sort asc" : $params ['order'];
    $limit = empty ( $params ['limit'] ) ? "10" : $params ['limit'];
    $ser = new NavigationTag ();
    $data = $ser->getLimit ( $order, $limit, $where, $field );
    $smarty->assign ( $params ['assign'], $data );
}

/**
 *
 * 获取导航数组信息（头部）
 * {{topNav assign="xxx"}}
 *
 */
function smarty_function_topNav($params, &$smarty) {
    $fun    = explode( '_' , __FUNCTION__ );
    $assign = isset($params['assign']) ? $params['assign'] : $fun[2];
    $navigationTag = new NavigationTag();
    $smarty->assign ( $assign , $navigationTag->getTop() );
}

/**
 *
 * 获取导航数组信息（脚部）
 * {{topNav assign="xxx"}}
 *
 */
function smarty_function_footNav($params, &$smarty) {
    $fun    = explode( '_' , __FUNCTION__ );
    $assign = isset($params['assign']) ? $params['assign'] : $fun[2];
    $navigationTag = new NavigationTag();
    $smarty->assign ( $assign , $navigationTag->getFoot() );
}

