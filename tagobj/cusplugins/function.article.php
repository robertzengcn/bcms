<?php
/**
 *  
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {article id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_article($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	$where = array();
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$ser = new ArticleTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($params['id']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}

/**
 *
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {articles field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_articles($params, &$smarty) {
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
    $ser = new ArticleTag();
    //$data = $ser->getLimit ($order, $limit, $where, $field);
    $data = $ser->getList($params['page']);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {articles field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_articlesInDepartment($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );
    $where=array();
    $ser = new ArticleTag();
    $page = isset($params['page']) ? $params['page'] : 1;
    $limit = isset($params['limit']) ? $params['limit'] : PAGESIZE;
    foreach ( $params as $key => $v ) {
        if ($key != 'assign' && $key != 'page' && $key != 'limit'){
            $data = $ser->getByDeparment($v,$page,$limit);
        }
    }
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {articles field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_articlesInDisease($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );
    $where=array();
    $ser = new ArticleTag();
    $department = isset($params['departmentId']) ? $params['departmentId'] : $params['departmentName'];
    $page = isset($params['page']) ? $params['page'] : 1;
    $limit = isset($params['limit']) ? $params['limit'] : 0;
    $disease = isset($params['diseaseId']) ? $params['diseaseId'] : $params['diseaseName'];
    $data = $ser->getByDisease($department,$disease,$page,$limit);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {articles field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_articlesInNewest($params, &$smarty) {
    $ser = new ArticleTag();
    $data = $ser->getNewest($params['limit']);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {articles field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_topArticles($params, &$smarty) {
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
    $recommend = isset($params['positionId']) ? $params['positionId'] : $params['positionName'];
    if (isset($params['diseaseId'])){
        $disease = $params['diseaseId'];
    }elseif (isset($params['diseaseName'])){
        $disease = $params['diseaseName'];
    }else{
        $disease = '';
    }
    if (isset($params['departmentId'])){
        $department = $params['departmentId'];
    }elseif (isset($params['departmentName'])){
        $department = $params['departmentName'];
    }else{
        $department = '';
    }
    $ser = new ArticleTag();
    $data = $ser->getByTop($recommend,$disease,$department);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}