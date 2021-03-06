<?php
/**
 * 问答相关标签
 * */
require_once 'common.php';

/** 
 * 根据页码获取对应的数据
 * 
 * 参应function标签中的{asks}
 */
function smarty_block_asklist($params, $content, $template, &$repeat) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $is_display = isset($params['is_display']) ? $params['is_display'] : 1;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    if (!$repeat) {
        $ser = new AskTag();
        $data = $ser->getList($current, $pagesize, $sort, $is_display);
        foreach ($data as $k=>$askinfo) {
            $url = getClientUrl('ask', $askinfo->id);
            if (!$url)
                $url = getAskUrl($askinfo->id);
            $data[$key]->url = $url;
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
 * 
 * 根据在线问答唯一id获取对应的在线问答信息
 * 包含问题简单信息、所有信息、化验单信息
 * 
 * 对应function标签中的{ask}
 */
function smarty_block_askinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['id']) ? $params['id'] : ($template->getTemplateVars('id'));
    
    if (!$repeat) {
        $ser = new AskTag();
        $data = $ser->get($id);
        return formatReturnData($data, $content);
    }
}

/**
 * 根据在线问答唯一id获取对应的追问&回复信息
 * 
 * 对应fuction标签中的{askAddto}
 */
function smarty_block_askrepinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['id']) ? $params['id'] : ($template->getTemplateVars('id'));
    
    if (!$repeat) {
        $ser = new AskTag();
        $data = $ser->getAddto($id);
        return formatReturnData($data, $content);
    }
}

/**
 *
 * 根据科室ID获取问答信息
 * @param $department_id 科室id
 *
 */
function smarty_block_askbydept($params, $content, $template, &$repeat){
    $department_id = isset($params['department_id']) ? $params['department_id'] : 0;
    $limit = isset($params['limit']) ? $params['limit'] : '10';
    if (!$repeat) {
        $ser = new AskTag();
        $data = $ser->getDepartmentAsk($department_id, $limit);
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

/**
 * 根据疾病ID获取问答信息
 */
function smarty_block_askbydisease($params, $content, $template, &$repeat){
    $disease_id = isset($params['disease_id']) ? $params['disease_id'] : 0;
    
    if (!$repeat) {
        $ser = new AskTag();
        $data = $ser->getDiseaseAsk($disease_id);
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

/**
 * 根据推荐位置获取在线问答...
 */
function smarty_block_askbyrecommend($params, $content, $template, &$repeat){
    $recommend = isset($params['recommend_name']) ? $params['recommend_name'] : '';
    $name = isset($params['name']) ? $params['name'] : 'ask_id';
    $is_tomobile = isset($params['is_tomobile']) ? $params['is_tomobile'] : '';
    
    if (!$repeat) {
        $ser = new AskTag();
        $data = $ser->getByRecommend($recommend, $name, $is_tomobile);
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

/**
 * public方法：获取问答详情地址
 * */
function getAskUrl($ask_id) {
    if (empty($ask_id)) {
        return '';
    }
    return NETADDRESS . "/ask/{$ask_id}.html";
}