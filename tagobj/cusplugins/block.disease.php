<?php
/**
 * 疾病相关标签
 * */
require_once 'common.php';
/**
 * 根据页码获取对应的数据
 * 
 * 对应function标签中的{diseases}
 */
function smarty_block_diseaselist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    $articles = empty ( $params ['articles'] ) ? "" : $params ['articles'];
    $children = empty ( $params ['children'] ) ? "" : $params ['children'];
    
    if (!$repeat) {
        $ser = new DiseaseTag();
        $data = $ser->getList($current, $sort, $pagesize);
        foreach ($data as $key=>$info) {
            if ($children) {
                $children = $ser->getByDiseaseID($info->id,100);
                $info->children = $children;
            }
            if ($articles) $info->articles = array();
            
            $info->index = $key;
            $data[$key] = $info;
        }
        fb($data, 'disease');
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
 * 对应function标签中的{disease}
 */
function smarty_block_diseaseinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['name_or_id']) ? $params['name_or_id'] : ($template->getTemplateVars('id'));

    if (!$repeat) {
        $ser = new DiseaseTag();
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
function smarty_block_diseasein($params, $content, $template, &$repeat){
    $disease = isset($params['disease_in']) ? $params['disease_in'] : ($template->getTemplateVars('disease_in'));

    if (!$repeat) {
        $ser = new DiseaseTag();
        $data = $ser->in($disease);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

/**
 * 根据科室获取疾病
 * 
 * 对应function标签中的{diseasesInDepartment}
 */
function smarty_block_diseasebydept($params, $content, $template, &$repeat){
    $department = isset($params['department']) ? $params['department'] : 0;
    $size = isset($params['size']) ? $params['size'] : null;
    $limit = isset($params['limit']) ? $params['limit'] : null;
    
    if (!$repeat) {
        $ser = new DiseaseTag();
        $data = $ser->getByDeparment($department,$size);
        if ($limit) {
        	$data = array_slice($data, 0, $limit);
        }
        foreach ($data as $k=>$v) {
            $data[$k]->url = $ser->getDiseaseUrl($v->id,$v->department_id,false);
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
    
}

/**
 * 根据科室获取顶级疾病
 */
function smarty_block_topdiseasebydept($params, $content, $template, &$repeat){
    $department = isset($params['department']) ? $params['department'] : 0;
    $size = isset($params['size']) ? $params['size'] : null;
    
    if (!$repeat) {
        $ser = new DiseaseTag();
        $data = $ser->getByDisease($department,$size);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

/**
 * 根据id获取子级疾病
 */
function smarty_block_childrendisbyid($params, $content, $template, &$repeat){
    $id = isset($params['id']) ? $params['id'] : 0;
    $size = isset($params['size']) ? $params['size'] : null;
    
    if (!$repeat) {
        $ser = new DiseaseTag();
        $data = $ser->getByDiseaseID($id,$size);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

