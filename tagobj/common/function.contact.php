<?php
/**
 *  
 * 联系方式:通过key(flag)查询对应的val输出
 * {contact key="*" assign="xxx"}
 * 
 */
function smarty_function_contact($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2];
	$contactTag  = new ContactTag();
	$smarty->assign ( $assign , $contactTag->get( $params['key'] ) );
}