<?php
require_once 'common.php';
/**
 * 根据页码获取对应的数据
 * 
 * 对应function标签中的{deparments}
 */
function smarty_block_deptlist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    $articles = empty ( $params ['articles'] ) ? "" : $params ['articles'];
    $diseases = empty ( $params ['diseases'] ) ? "" : $params ['diseases'];
    $technology = empty ( $params ['technology'] ) ? "" : $params ['technology'];
    $doctor = empty ( $params ['doctor'] ) ? "" : $params ['doctor'];
    $doctors = empty ( $params ['doctors'] ) ? "" : $params ['doctors'];
    $arcbyrecommend = empty ( $params ['arcbyrecommend'] ) ? "" : $params ['arcbyrecommend'];
    
    if (!$repeat) {
        $ser = new DepartmentTag();
        $data = $ser->getList($current, $pagesize, $sort);
        
    	foreach ($data as $key=>$info) {
    	    if ($articles) $info->articles = array();
    	    if ($diseases) $info->diseases = array();
    	    if ($technology) $info->technology = array();
    	    if ($doctor) $info->doctor = array();
    	    if ($doctors) $info->doctors = array();
    	    if ($arcbyrecommend) $info->arcbyrecommend = array();
    		
    		$info->index = $key;
    		$data[$key] = $info;
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
 * 对应function标签的{department}
 */
function smarty_block_deptinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['name_or_id']) ? $params['name_or_id'] : ($template->getTemplateVars('id'));
    if (!$repeat) {
        $data = $template->getTemplateVars('department');
        if (!empty($id)) {
            $ser = new DepartmentTag();
            $data = $ser->get($id);
        }
        
        $diseaseinfo = $template->getTemplateVars('disease');
        $childurl = $data->url;
        if (!empty($diseaseinfo['id'])) {
            $disSer = new DiseaseTag();
            $childurl = $disSer->getDiseaseUrl($diseaseinfo['id'],$data->id,false);
        }
        $data->childurl = $childurl;
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 根据id或者name集合获取数据
 *
 * 对应function标签中的{departmentsVector}
 */
function smarty_block_deptin($params, $content, $template, &$repeat){
    $department = isset($params['department_in']) ? $params['department_in'] : ($template->getTemplateVars('department_in'));
    
    if (!$repeat) {
        $ser = new DepartmentTag();
        $data = $ser->in($department);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}