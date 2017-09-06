<?php
/**
 * 医院设备标签
 * */
require_once 'common.php';
/**
 * 根据页码获取对应的数据
 * 
 * 对应function标签中的{devices}
 */
function smarty_block_devicelist( $params, $content, $template, &$repeat ) {
    $pagesize = isset($params['pagesize']) ? $params['pagesize'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : true;
    $current = isset($params['page']) ? $params['page'] : $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    
    if (!$repeat) {
        $ser = new DeviceTag();
        $data = $ser->getList($current, $pagesize, $sort);
        $index = 0;
        foreach ($data as $key=>$deviceinfo) {
            if ($deviceinfo->pic&&strpos($deviceinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $deviceinfo->pic;
            }
            $data[$key]->url = getDeviceUrl($deviceinfo->id);
            $data[$key]->index = $index;
            $index++;
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
 * 对应function标签中的{device}
 */
function smarty_block_deviceinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['name_or_id']) ? $params['name_or_id'] : ($template->getTemplateVars('id'));

    if (!$repeat) {
        $ser = new DeviceTag();
        $data = $ser->get($id);
        if ($data->pic&&strpos($data->pic, NETADDRESS) === false) {
            $data->pic = UPLOAD . $data->pic;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        return formatReturnData($data, $content);
    }
}

/**
 * public方法：获取设备地址
 * */
function getDeviceUrl($device_id) {
    if (empty($device_id)) {
        return '';
    }
    return NETADDRESS . "/hospital/device/{$device_id}.html";
}