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

/**
 *
 * 获取导航数组信息（疾病）
 * {{topNav assign="xxx"}}
 *
 */
function smarty_function_diseaseNav($params, &$smarty) {
    $fun    = explode( '_' , __FUNCTION__ );
    $assign = isset($params['assign']) ? $params['assign'] : $fun[2];
    $navigationTag = new NavigationTag();
    $smarty->assign ( $assign , $navigationTag->getDisease() );
}

/**
 *
 * 疾病标签 除了tag
 * 内的变量都参与过滤
 * {diseases field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_diseases($params, &$smarty) {
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
    $ser = new DiseaseTag();
    //$data = $ser->getLimit ($order, $limit, $where, $field);
    $data = $ser->getList($params['page']);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

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

