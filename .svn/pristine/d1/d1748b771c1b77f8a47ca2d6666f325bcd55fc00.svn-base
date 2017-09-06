<?php
/**
 * 网站站点地址
 */
function smarty_function_website($params, $template) {
    $website = NETADDRESS;
    switch (PROJECT_NAME) {
    	case 'mobile':
    	    $website .= '/mobile/';
    	    break;
    	case 'app':
    	    $website .= '/app/';
    	    break;
    	case 'wechat':
    	    $website .= 'wechat';
    	    break;
    	default:
    	    break;
    }
    return $website;
}

/**
 * 网站上传/下载目录
 */
function smarty_function_upload($params, $template) {
    return UPLOAD;
}

/**
 * public目录
 */
function smarty_function_resource($params, $template) {
    return NETADDRESS . '/public';
}

/**
 * 根据flag获取联系人数据
 *
 * 对应function标签中的{contact}
 */
function smarty_function_contactinfo( $params, $template ) {
    $flag = isset($params['flag']) ? $params['flag'] : ($template->getTemplateVars('flag'));
    $ser = new ContactTag();
    return $ser->get($flag);
}

/**
 * 获取静态文件路径
 *
 */
function smarty_function_htmlurl( $params, $template ) {
    $htmlurl = $template->getTemplateVars('HTMLURL');
    return $htmlurl;
}

/**
 * 获取pic信息
 *
 * 对应function标签中的{introduce_pic}
 */
function smarty_function_introducepic( $params, $template ) {
    $ser = new IntroduceTag();
    $pic = $ser->getPic();
    return ($pic&&strpos($pic, NETADDRESS) === false) ? UPLOAD . $pic : $pic;
}

/**
 * 获取content信息
 *
 * 对应function标签中的{introduce_content}
 */
function smarty_function_introducecontent($params, $template) {
    $ser = new IntroduceTag();
    return $ser->getContent();
}

/**
 * 根据频道名取频道链接
 */
function smarty_function_channelurl( $params, $template) {
    $channelname = isset($params['name']) ? $params['name'] : '';

    $ser = new ChannelTag();
    return $ser->getChannelUrl($channelname);
}

/**
 * 根据flag获取对应的弹窗html文本
 *
 * 对应function标签中的{jsadv}
 * 
 * @param $flag 弹窗图片标识，one|two|three|four|five|six
 */
function smarty_function_poppicbyflag($params, $template) {
    $flag = isset($params['flag']) ? $params['flag'] : '';

    $ser = new PicManagerTag();
    return $ser->getSpecial($flag);
}

/**
 * 通过外部代码标识符(来源)获取指定的外部代码
 * 
 * @return string js代码
 */
function smarty_function_thirddetail( $params, $template) {
    $flag = isset($params['flag']) ? $params['flag'] : '';

    $ser = new ThirdTag();
    return $ser->get($flag);
}

/**
 * 获取所有可显示代码
 *
 * @return string 代码
 */
function smarty_function_thirdstat( $params, $template) {
    $ser = new ThirdTag();
    $data = $ser->getThirdStats();
    $js = '';
    foreach ($data as $value) {
        $js .= $value->js;
    }
    return $js;
}

/**
 * 获取医生列表页地址
 * */
function smarty_function_doctorlisturl( $params, $template) {
    $url = getClientListUrl('doctor');
    return $url ? $url : NETADDRESS . '/doctor/';
}

/**
 * 获取医疗设备列表页地址
 * */
function smarty_function_devicelisturl( $params, $template) {
    return NETADDRESS . '/hospital/device/';
}

/**
 * 获取医院环境列表页地址
 * */
function smarty_function_envlisturl( $params, $template) {
    return NETADDRESS . '/hospital/environment/';
}

/**
 * 获取医院荣誉列表页地址
 * */
function smarty_function_honorlisturl( $params, $template) {
    return NETADDRESS . '/hospital/honor/';
}

/**
 * 获取医院特色技术列表页地址
 * */
function smarty_function_technologylisturl( $params, $template) {
    $url = getClientListUrl('technology');
    return $url ? $url : NETADDRESS . '/technology/';
}

/**
 * 获取医院案例列表页地址
 * */
function smarty_function_successurl( $params, $template) {
    $url = getClientListUrl('success');
    return $url ? $url : NETADDRESS . '/hospital/success/';
}

/**
 * 获取医院媒体列表页地址
 * */
function smarty_function_mediaurl( $params, $template) {
    return NETADDRESS . '/hospital/media/';
}

/**
 * 获取医院新闻列表页地址
 * */
function smarty_function_newsurl( $params, $template) {
    $url = getClientListUrl('news');
    return $url ? $url : NETADDRESS . '/hospital/news/';
}

/**
 * 预约挂号地址
 * */
function smarty_function_resvationurl( $params, $template) {
    return NETADDRESS . '/reservation.html';
}

/**
 * 加载预约挂号css
 * */
function smarty_function_resvationcss( $params, $template) {
    $resource = NETADDRESS . '/tagobj/public/style/';
    $css = '<link rel="stylesheet" type="text/css" href="'.$resource.'ask.css">';
    $css .= '<link rel="stylesheet" type="text/css" href="'.$resource.'reservationlist.css">';
    return $css;
}

/**
 * 加载预约挂号js
 * */
function smarty_function_resvationjs( $params, $template) {
    $resource = NETADDRESS . '/tagobj/public/js/';
    $js = '<script type="text/javascript" src="'.$resource.'date/WdatePicker.js"></script>';
    $js .= '<script type="text/javascript" src="'.$resource.'reservation.js"></script>';
    $js .= '<script type="text/javascript" src="'.$resource.'reservation_base.js"></script>';
    return $js;
}

/**
 * 加载问答css
 * */
function smarty_function_askcss( $params, $template) {
    $resource = NETADDRESS . '/tagobj/public/style/';
    $css = '<link rel="stylesheet" type="text/css" href="'.$resource.'ask.css">';
    return $css;
}

/**
 * 加载问答js
 * */
function smarty_function_askjs( $params, $template) {
    $resource = NETADDRESS . '/tagobj/public/js/';
    $js = '<script type="text/javascript" src="'.$resource.'jquery1.42.min.js"></script>';
    $js .= '<script type="text/javascript" src="'.$resource.'ask.js"></script>';
    $js .= '<script type="text/javascript" src="'.$resource.'ask_base.js"></script>';
    return $js;
}

/**
 * 百度地图显示医院地址
 * */
function smarty_function_showbaidumap( $params, $template) {
    $divId = isset($params['div_id']) ? $params['div_id'] : 'dituContent';
    
    $ser = new ContactTag();
    $map = $ser->get('map');
    $point = explode(',', $map);
    
    $resource = NETADDRESS . '/tagobj/public/js/';
    $js = '<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>';
    $js .= '<script type="text/javascript">';
    $js .= 'var gDivId="' . $divId. '";';
    $js .= 'var gTitle="' . $ser->get('name'). '";';
    $js .= 'var gTel="' . $ser->get('tel'). '";';
    $js .= 'var gMapLon="' . $point[0] . '";';
    $js .= 'var gMapLat="' . $point[1] . '";';
    $js .= '</script>';
    $js .= '<script type="text/javascript" src="'.$resource.'map.js"></script>';
    
    return $js;
}

/**
 * 客户端的列表url需特殊处理
 * */
function getClientListUrl($fileName) {
    $url = "";
    switch (PROJECT_NAME) {
    	case 'mobile':
    	    $url = NETADDRESS . "/mobile/{$fileName}.php";
    	    break;
    	case 'app':
    	    $url = NETADDRESS . "/app/{$fileName}.php";
    	    break;
    	case 'wechat':
    	    $url = NETADDRESS . "/wechat/{$fileName}.php";
    	    break;
    	default:
    	    break;
    }
    return $url;
}