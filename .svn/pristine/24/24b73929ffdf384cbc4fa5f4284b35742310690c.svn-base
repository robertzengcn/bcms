<?php
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