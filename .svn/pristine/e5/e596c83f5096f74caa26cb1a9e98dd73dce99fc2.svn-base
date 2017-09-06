<?php
/**
 *  
 * 在线问答,根据id获取问答信息
 * {{ask id="*" assign="xxx"}}
 * 
 */
function smarty_function_ask($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2];
	$askTag = new AskTag();
	$smarty->assign ( $assign , $askTag->get( (int)$params['id'] ) );
}