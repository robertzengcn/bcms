<?php
require_once 'common.php';

/**
 * 获取显示第三方代码
 * 
 * 对应function标签中的{thirdcode}
 */
function smarty_block_displaythird( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new ThirdTag();
        $data = $ser->getThirdStats();
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}
