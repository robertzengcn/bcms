<?php
/**
 *  
 * 获取图片轮播信息:根据id(标识符)来获取对应的轮播资源
 * {{carouselAdv id="*" assign="xxx"}}
 * 
 */
function smarty_function_carouselAdv($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2];
	$picManagerTag = new PicManagerTag();
	$smarty->assign ( $assign , $picManagerTag->getScroll( $params['id'] ) );
}