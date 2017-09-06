<?php
/**
 *
 * 医院介绍:获取医院介绍content信息
 * {introduce_content assign="xxx"}
 *
 */
function smarty_function_introduce_content($params, &$smarty) {
    $fun    = explode( '_' , __FUNCTION__ );
    $assign = isset($params['assign']) ? $params['assign'] : $fun[2] . '_' . $fun[3];
    $introduceTag = new IntroduceTag();
    $smarty->assign ( $assign , $introduceTag->get('content') );
}

/**
 *
 * 医院介绍:获取医院介绍pic信息
 * {introduce_pic assign="xxx"}
 *
 */
function smarty_function_introduce_pic($params, &$smarty) {
    $fun    = explode( '_' , __FUNCTION__ );
    $assign = isset($params['assign']) ? $params['assign'] : $fun[2] . '_' . $fun[3];
    $introduceTag = new IntroduceTag();
    $smarty->assign ( $assign , $introduceTag->get('pic') );
}

/**
 *
 * 医院介绍:获取医院介绍source信息
 * {introduce_source assign="xxx"}
 *
 */
function smarty_function_introduce_source($params, &$smarty) {
    $fun    = explode( '_' , __FUNCTION__ );
    $assign = isset($params['assign']) ? $params['assign'] : $fun[2] . '_' . $fun[3];
    $introduceTag = new IntroduceTag();
    $smarty->assign ( $assign , $introduceTag->get('source') );
}

/**
 *
 * 医院介绍:获取医院介绍subject信息
 * {introduce_subject assign="xxx"}
 *
 */
function smarty_function_introduce_subject($params, &$smarty) {
    $fun    = explode( '_' , __FUNCTION__ );
    $assign = isset($params['assign']) ? $params['assign'] : $fun[2] . '_' . $fun[3];
    $introduceTag = new IntroduceTag();
    $smarty->assign ( $assign , $introduceTag->get('subject') );
}