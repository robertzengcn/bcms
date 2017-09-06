<?php
/**
 *  
 * 医院介绍:获取医院介绍subject信息
 * {introduce_subject assign="xxx"}
 * 
 */
function smarty_function_introduce_subject($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2] . '_' . $fun[3];
	$introduceTag = new IntroduceTag();
	$smarty->assign ( $assign , $introduceTag->get('subject') );
}