<?php
/**
 *  
 * 医院介绍:获取医院介绍pic信息
 * {introduce_pic assign="xxx"}
 * 
 */
function smarty_function_introduce_pic($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2] . '_' . $fun[3];
	$introduceTag = new IntroduceTag();
	$smarty->assign ( $assign , $introduceTag->get('pic') );
}