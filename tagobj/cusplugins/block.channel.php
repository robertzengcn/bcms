<?php
/**
 * 个性频道相关标签
 * */
require_once 'common.php';

/** 
 * 根据页码获取对应的数据
 * 
 * 对应function标签中的{channels}
 */
function smarty_block_channellist($params, $content, $template, &$repeat) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    if (!$repeat) {
        $ser = new ChannelTag();
        $data = $ser->getList($current, $sort, $pagesize);
        $template->assign('cur', $current);
        
        //保存pagesize
        setcookie('pagesize', $pagesize);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

/**
 * 根据唯一id获取该id的详细信息
 * 
 * 对应function标签中的{channel}
 */
function smarty_block_channelinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['name_or_id']) ? $params['name_or_id'] : ($template->getTemplateVars('id'));
    
    if (!$repeat) {
        $ser = new ChannelTag();
        $data = $ser->get($id);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

/**
 *根据id或者name集合获取数据
 *
 */
function smarty_block_channelin($params, $content, $template, &$repeat){
    $channel = isset($params['channel_in']) ? $params['channel_in'] : ($template->getTemplateVars('channel_in'));
    
    if (!$repeat) {
        $ser = new ChannelTag();
        $data = $ser->in($channel);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}
