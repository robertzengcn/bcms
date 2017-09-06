<?php
/**
 * 友情链接标签
 * */
require_once 'common.php';
/**
 * 根据限制获取条数获取友情连接列表
 * 
 * 对应function标签中的{friendLink}
 */
function smarty_block_linklist( $params, $content, $template, &$repeat ) {
    $limit = isset($params['limit']) ? $params['limit'] : 8;
    
    if (!$repeat) {
        $ser = new LinkTag();
        $data = $ser->getList($limit);
        foreach ($data as $key=>$info) {
            if ($info->pic && strpos($info->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $info->pic;
            }
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

