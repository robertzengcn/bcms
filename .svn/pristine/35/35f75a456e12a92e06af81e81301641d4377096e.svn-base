<?php
/**
 * 错误页面标签
 * */
require_once 'common.php';
/**
 * 根据页码获取对应的数据
 * 
 * 对应function标签中的{error}
 */
function smarty_block_errorlist( $params, $content, $template, &$repeat ) {
    formatFuncParams($params,$order, $limit, $where, $field);
    
    if (!$repeat) {
        $ser = new ErrorTag();
        $data = $ser->getLimit ($order, $limit, $where, $field);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取404页面内容
 * */
function smarty_block_errorinfo($params, $content, $template, &$repeat) {
    formatFuncParams($params,$order, $limit, $where, $field);
    
    if (!$repeat) {
        $ser = new ErrorTag();
        $data = $ser->getLimit ($order, $limit, $where, $field);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data[0], $content);
    }
}
