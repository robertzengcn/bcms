<?php
require_once 'common.php';
/**
 * 预约挂号下的所有科室
 * 
 * 对应function标签中的{departmentmanager}
 */
function smarty_block_deptmlist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    $children = empty ( $params ['children'] ) ? "" : $params ['children'];
    
    if (!$repeat) {
        $ser = new DepartmentManagerTag();
        $data = $ser->getList($current, $pagesize, $sort);
        foreach ($data as $key=>$info) {
            if ($children) {
                $where['belong'] = $info->id;
                $children = $ser->getLimit ( 'id asc', 1000, $where, '*' );
                $data[$key]->children = $children;
                $children = true;
            }
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
 */
function smarty_block_deptminfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['name_or_id']) ? $params['name_or_id'] : ($template->getTemplateVars('id'));

    if (!$repeat) {
        $ser = new DepartmentManagerTag();
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
function smarty_block_deptmin($params, $content, $template, &$repeat){
    $department = isset($params['department_in']) ? $params['department_in'] : ($template->getTemplateVars('department_in'));

    if (!$repeat) {
        $ser = new DepartmentManagerTag();
        $data = $ser->in($department);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}
