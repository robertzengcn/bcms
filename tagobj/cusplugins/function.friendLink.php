<?php
/**
 *  
 * 友情链接:参数limit为设置需要被展示的条数
 * {{friendLink limit="*" assign="xxx"}}
 * 
 */
function smarty_function_friendLink($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2];
	$linkTag = new LinkTag();
	$smarty->assign ( $assign , $linkTag->getList( (int)$params['limit'] ) );
}