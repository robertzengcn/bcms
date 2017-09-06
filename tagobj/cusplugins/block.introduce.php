<?php
/**
 * 医院介绍
 * */
require_once 'common.php';
/**
 * 根据唯一id获取该id的详细信息
 * 
 * 对应function标签中的{introduce_subject}
 */
function smarty_block_introduceinfo( $params, $content, $template, &$repeat ) {
    $field = isset($params['field']) ? $params['field'] : ($template->getTemplateVars('field'));

    if (!$repeat) {
        $ser = new IntroduceTag();
        $data = $ser->get($field);
        if ($field) {
        	if ($field == 'pic' || $field == 'src') {
        	    $data = ($data&&strpos($data, NETADDRESS) === false) ? UPLOAD . $data : $data;
        	}
        } else {
            if ($data->pic&&strpos($data->pic, NETADDRESS) === false) {
                $data->pic = UPLOAD . $data->pic;
            }
            if ($data->src&&strpos($data->src, NETADDRESS) === false) {
                $data->src = UPLOAD . $data->src;
            }
        }
        
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }

        return formatReturnData($data, $content);
    }
}
