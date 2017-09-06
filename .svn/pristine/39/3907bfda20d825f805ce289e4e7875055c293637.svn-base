<?php
/**
 *  
 * 获取广告通体弹窗插件:根据id(标识符)来获取对应的弹窗脚本文件
 * {{jsadv id="*" assign="xxx"}}
 * 
 */
function smarty_function_jsadv($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2];
	$picManagerTag = new PicManagerTag();
	$smarty->assign ( $assign , $picManagerTag->getSpecial( $params['id'] ) );
}