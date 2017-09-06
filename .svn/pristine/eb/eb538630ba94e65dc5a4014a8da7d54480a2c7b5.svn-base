<?php
/**
 *  
 * 在线问答,通过page分页数获取在线问答列表
 * {{asks page="*" assign="xxx"}}
 * 
 */
function smarty_function_asks($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2];
	$askTag = new AskTag();
	$smarty->assign ( $assign , $askTag->getList( (int)$params['page'] ) );
}