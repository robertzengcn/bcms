<?php
/**
 *  
 * 资讯标签 除了tag
 * 内的变量都参与过滤
 * {articles field="*" order="id desc" limit="10" assign="xxx"}
 * 
 * 
 */
function smarty_function_recommendArticles($params, &$smarty) {
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
	$data = $ser->getByRecommend($recommend,$disease,$department,$params['size']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}