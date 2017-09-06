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
