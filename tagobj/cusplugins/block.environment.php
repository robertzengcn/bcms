<?php
/**
 * 医院环境标签
 * */
require_once 'common.php';
/**
 * 根据页码获取对应的数据
 * 
 * 对应function标签中的{environments}
 */
function smarty_block_henvlist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    if (!$repeat) {
        $ser = new EnvironmentTag();
        $data = $ser->getList($current, $pagesize, $sort);
        foreach ($data as $key=>$henvinfo) {
            if ($henvinfo->pic&&strpos($henvinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $henvinfo->pic;
            }
            $data[$key]->url = NETADDRESS . "/hospital/environment/" . $henvinfo->id . ".html";
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
 * 对应function标签中的{environment}
 */
function smarty_block_henvinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['id']) ? $params['id'] : ($template->getTemplateVars('id'));

    if (!$repeat) {
        $ser = new EnvironmentTag();
        $data = $ser->get($id);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}
