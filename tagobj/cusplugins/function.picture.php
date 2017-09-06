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

/**
 *
 * picManager标签 除了tag
 * 内的变量都参与过滤
 * {picManager field="*" assign="xxx"}
 *
 *
 */
function smarty_function_picManager($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );
    $where=array();
    foreach ( $params as $key => $v ) {
        if (! in_array ( $key, $tag ) && ! empty ( $v ))
        {
            $where [$key] = $v;
        }
    }

    $field = empty ( $params ['field'] ) ? "*" : $params ['field'];
    $ser = new PicManagerTag();
    $data = $ser->findOne ( $where, $field );
    $smarty->assign ( $params ['assign'], $data );
}

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

