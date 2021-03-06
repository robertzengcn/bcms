<?php
/**
 * 成功案例标签
 * */
require_once 'common.php';
/**
 * 根据页码获取对应的数据
 */
function smarty_block_successlist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    if (!$repeat) {
        $ser = new SuccessTag();
        $data = $ser->getList($current, $sort, $pagesize);
        foreach ($data as $k=>$v) {
        	if ($v->pic1&&strpos($v->pic1, NETADDRESS) === false) {
        		$data[$k]->pic1 = UPLOAD . $v->pic1;
        	}
        	if ($v->pic2&&strpos($v->pic2, NETADDRESS) === false) {
        		$data[$k]->pic2 = UPLOAD . $v->pic2;
        	}
            $url = getClientUrl('success', $v->id);
            if (!$url)
                $url = getSuccessUrl($v->id);
            $data[$k]->url = $url;
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
 * 对应function标签中的{success}
 */
function smarty_block_successinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['id']) ? $params['id'] : ($template->getTemplateVars('id'));
    if (!$repeat) {
        $ser = new SuccessTag();
        $data = $ser->get($id);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 根据推荐位置获取案例列表 ...
 */
function smarty_block_successbyrecommend( $params, $content, $template, &$repeat ) {
    $recommend = isset($params['recommend_name']) ? $params['recommend_name'] : '';
    $name = isset($params['name']) ? $params['name'] : 'success_id';
    $is_tomobile = isset($params['is_tomobile']) ? $params['is_tomobile'] : '';
    $limit = isset($params['limit']) ? intval($params['limit']) : '';
    
    if (!$repeat) {
        $ser = new SuccessTag();
        $data = $ser->getByRecommend($recommend,$name,$is_tomobile);
        if ($limit) {
            $data = array_slice($data, 0, $limit);
        }
        
        foreach ($data as $k=>$info) {
            $url = getClientUrl('success', $info->id);
            if (!$url)
                $url = getSuccessUrl($info->id);
            $data[$key]->url = $url;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 根据推荐位置 和科室 获取案例列表 ...
 */
function smarty_block_successbyrecommenddept( $params, $content, $template, &$repeat ) {
    $recommend = isset($params['recommend_name']) ? $params['recommend_name'] : '';
    $dep_id = isset($params['department_id']) ? $params['department_id'] : '';
    $name = isset($params['name']) ? $params['name'] : 'success_id';
    $is_tomobile = isset($params['is_tomobile']) ? $params['is_tomobile'] : '';
    $limit = isset($params['limit']) ? $params['limit'] : '';

    if (!$repeat) {
        $ser = new SuccessTag();
        $data = $ser->getByRecommendDep($recommend,$dep_id,$name,$is_tomobile);
        foreach ($data as $k=>$info) {
            $url = getClientUrl('success', $info->id);
            if (!$url)
                $url = getSuccessUrl($info->id);
            $data[$key]->url = $url;
        }
        
        if ($limit) {
        	$data = array_slice($data, 0, $limit);
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取置顶案例
 */
function smarty_block_topsuccess( $params, $content, $template, &$repeat ) {
    $recommend = isset($params['recommend_name']) ? $params['recommend_name'] : '';
    $is_top = isset($params['is_top']) ? $params['is_top'] : 1;
    $name = isset($params['name']) ? $params['name'] : 'success_id';

    if (!$repeat) {
        $ser = new SuccessTag();
        $data = $ser->getByTop($recommend,$is_top,$name);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 根据科室 获取案例
 */
function smarty_block_successbydept( $params, $content, $template, &$repeat ) {
    $department = isset($params['department_id']) ? $params['department_id'] : '';

    if (!$repeat) {
        $ser = new SuccessTag();
        $data = $ser->getByDepartment($department);
        foreach ($data as $k=>$info) {
            $url = getClientUrl('success', $info->id);
            if (!$url)
                $url = getSuccessUrl($info->id);
            $data[$key]->url = $url;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * public方法：获取案例详情地址
 * */
function getSuccessUrl($id) {
    if (empty($id)) {
        return '';
    }
    return NETADDRESS . "/hospital/success/{$id}.html";
}