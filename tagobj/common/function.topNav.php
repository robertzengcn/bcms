<?php
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