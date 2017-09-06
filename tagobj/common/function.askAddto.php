<?php
/**
 *  
 * 在线问答,根据id获取问答回复与追问信息
 * {{askAddto id="*" assign="xxx"}}
 * 
 */
function smarty_function_askAddto($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2];
	$askTag = new AskTag();
	$smarty->assign ( $assign , $askTag->getAddto( (int)$params['id'] ) );
}