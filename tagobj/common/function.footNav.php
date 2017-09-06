<?php
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