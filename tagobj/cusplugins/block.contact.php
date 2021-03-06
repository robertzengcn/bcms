<?php
require_once 'common.php';

/**
 * 联系方式 列表
 *
 * 对应function标签中的{contacts}
 */
function smarty_block_contactlist( $params, $content, $template, &$repeat ) {
    formatFuncParams($params,$order, $limit, $where, $field);
    
    if (!$repeat) {
        $ser = new ContactTag();
        $data = $ser->getLimit ($order, $limit, $where, $field);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

