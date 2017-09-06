<?php
/**
 * 媒体报道
 * */
require_once 'common.php';

/** 
 * 根据页码获取对应的数据
 */
function smarty_block_medialist($params, $content, $template, &$repeat) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    if (!$repeat) {
        $ser = new MediaReportTag();
        $data = $ser->getList($current, $pagesize, $sort);
        foreach ($data as $key=>$mediainfo) {
            if ($mediainfo->pic&&strpos($mediainfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $mediainfo->pic;
            }
            $data[$key]->url = getMediaUrl($mediainfo->id);
        }
        
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
 * 对应function标签中的{mediareport}
 */
function smarty_block_mediainfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['id']) ? $params['id'] : ($template->getTemplateVars('id'));
    
    if (!$repeat) {
        $ser = new MediaReportTag();
        $data = $ser->get($id);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取最新
 */
function smarty_block_latestmedia( $params, $content, $template, &$repeat ) {
    $offset = isset($params['from']) ? intval($params['from']) : 1;
    $limit = isset($params['limit']) ? intval($params['limit']) : 10;
    $limit = $limit + $offset -1;
    $offset = $offset -1;
    
    if (!$repeat) {
        $ser = new MediaReportTag();
        $data = $ser->getNewest($limit);
        $data = array_slice($data, $offset, $limit);
        foreach ($data as $key=>$mediainfo) {
            if ($mediainfo->pic&&strpos($mediainfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $mediainfo->pic;
            }
            $data[$key]->url = getMediaUrl($mediainfo->id);
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 根据推荐位置获取 媒体报道...
 */
function smarty_block_mediasbyrecommend( $params, $content, $template, &$repeat ){
    $recommend = isset($params['recommend_name']) ? $params['recommend_name'] : 0;
    $name = isset($params['name']) ? $params['name'] : 'media_id';
    $is_tomobile = isset($params['is_tomobile']) ? $params['is_tomobile'] : '';
    $limit = isset($params['limit']) ? $params['limit'] : '';
    
    if (!$repeat) {
        $ser = new MediaReportTag();
        $data = $ser->getByRecommend($recommend,$name,$is_tomobile);
    
        if ($limit) {
            $data = array_splice($data, 0, $limit);
        }
    
        foreach ($data as $key=>$mediainfo) {
            if ($mediainfo->pic&&strpos($mediainfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $mediainfo->pic;
            }
            $data[$key]->url = getMediaUrl($mediainfo->id);
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
    
        return formatReturnData($data, $content);
    }
}

/**
 * 获取指定条数的媒体报道...
 *
 * 对应function标签中的{medias}
 */
function smarty_block_mediabylimit($params, $content, $template, &$repeat){
    formatFuncParams($params,$order, $limit, $where, $field);

    if (!$repeat) {
        $ser = new MediaReportTag();
        $data = $ser->getLimit ($order, $limit, $where, $field);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * public方法：获取报道地址
 * */
function getMediaUrl($media_id) {
    if (empty($media_id)) {
        return '';
    }
    return NETADDRESS . "/hospital/media/{$media_id}.html";
}
