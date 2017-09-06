<?php
/**
 * 调用循环代码标签
 * */
require_once 'common.php';
function smarty_block_loop( $params, $content, $template, &$repeat ) {
    
    $from = empty ( $params ['from'] ) ? "" : $params ['from'];
    $size = empty ( $params ['size'] ) ? "" : $params ['size'];
    $name = empty ( $params ['name'] ) ? "field" : $params ['name'];
    
    if (!$repeat) {
    	$data = $template->getTemplateVars($from);
    	if ($size && !empty($data)) {
    		$data = array_slice($data, 0, $size);
    	}
    	$index = 0;
    	foreach ($data as $k=>$v) {
    	    if (is_object($v)) {
    	        $data[$k]->index = $index;
    	    } else {
    	        $data[$k]['index'] = $index;
    	    }
    		$index++;
    	}
    	return formatReturnData($data, $content, $name);
    }
}
