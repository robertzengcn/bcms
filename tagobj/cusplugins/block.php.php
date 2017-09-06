<?php
/**
 * 调用PHP代码标签
 * */
require_once 'common.php';
/**
 * 调用PHP代码
 * 
 */
function smarty_block_php( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        eval($content);
    }
}
