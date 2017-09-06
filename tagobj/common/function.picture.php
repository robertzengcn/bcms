<?php
/**
 *  
 * 图片管理:通过key(flag)查询对应的图片
 * {picture key="logo" assign="xxx"}
 * 
 */
function smarty_function_picture($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign = isset($params['assign']) ? $params['assign'] : $fun[2];
	$key 		 = trim( strtolower( $params['key'] ) );
	if( $key  != '' ) {
		$picManagerTag  = new PicManagerTag();
		switch( $key ) {
			case 'logo':
				$smarty->assign ( $assign , $picManagerTag->getLogo() );
				break;
			default:
				break;
		}
	}
}