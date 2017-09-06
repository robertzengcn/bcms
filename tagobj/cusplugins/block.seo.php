<?php
require_once 'common.php';
/**
 * 根据页码获取对应的数据
 */
function smarty_block_seolist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    if (!$repeat) {
        $ser = new SeoTag();
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
 */
function smarty_block_seoinfo( $params, $content, $template, &$repeat ) {
    $flag = isset($params['flag']) ? $params['flag'] : ($template->getTemplateVars('flag'));

    if (!$repeat) {
        $ser = new SeoTag();
        $data = $ser->get($flag);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取一条信息
 *
 * 对应function标签中的{seo}
 */
function smarty_block_oneseo( $params, $content, $template, &$repeat ) {
    formatFuncParams($params,$order, $limit, $where, $field);
    
    if (!$repeat) {
        $ser = new SeoTag();
        $data = $ser->findOne ( $where, $field );
        $data = empty($data) ? $data : $data->getProperties();
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}