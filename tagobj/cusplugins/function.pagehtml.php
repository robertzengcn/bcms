<?php
/**
 * 特色技术分页
 */
function smarty_function_technologypagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    //显示位
    $show_position = unsetShowPosition();
    $size = $_COOKIE['pagesize'];
    $ser = new TechnologyTag();
    return $ser->getPageHtml($current, $size,$show_position);
}

/**
 * 文章分页
 * */
function smarty_function_arclistpagehtml($params, $template) {
    $disease_id = isset($params['disease_id']) ? $params['disease_id'] : '';
    //显示位
    $show_position = unsetShowPosition();
    $dir = isset($params['dir']) ? $params['dir'] : '';
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new ArticleTag();
    return $ser->getPageHtml($current, $disease_id, $dir, $size,$show_position);
}

/**
 * 根据部门获取文章分页html
 */
function smarty_block_arcspagehtmlbydept($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $department_id = isset($params['department_id']) ? $params['department_id'] : '';
    $dir = isset($params['dir']) ? $params['dir'] : '';
    $size = $_COOKIE['pagesize'];
    if (!$repeat) {
        $ser = new ArticleTag();
        return $ser->getPageHtmlByDep($current, $department_id, $dir, $size);
    }
}

/**
 * 问答分页
 * */
function smarty_function_askpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new AskTag();
    return $ser->getPageHtml($current, $size);
}

/**
 *
 * 个性频道分页条
 */
function smarty_function_channelpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new ChannelTag();
    return $ser->getPageHtml($current, $size);
}

/**
 *
 * 个性频道文章分页条
 */
function smarty_function_channelarcspagehtml($params, $template) {
    $channel_id = isset($params['channel_id']) ? $params['channel_id'] : 0;
    //显示位
    $show_position = unsetShowPosition();
    $dir = isset($params['dir']) ? $params['dir'] : '';
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new ChannelArticleTag();
    return $ser->getPageHtml($current, $channel_id, $dir, $size,$show_position);
}

/**
 *
 * 科室分页条
 */
function smarty_function_deptpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new DepartmentTag();
    return $ser->getPageHtml($current, $size);
}


/**
 *
 * 科室管理分页条
 */
function smarty_function_deptmpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new DepartmentManagerTag();
    return $ser->getPageHtml($current, $size);
}

/**
 *
 * 医院设备分页条
 */
function smarty_function_devicepagehtml($params, $template) {
	//显示位
	$show_position = unsetShowPosition();
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new DeviceTag();
    return $ser->getPageHtml($current, $size,$show_position);
}


/**
 *
 * 疾病列表分页条
 */
function smarty_function_diseasepagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new DiseaseTag();
    return $ser->getPageHtml($current, $size,$show_position);
}

/**
 *
 * 医生列表分页条
 */
function smarty_function_doctorpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new DoctorTag();
    return $ser->getPageHtml($current, $size);
}

/**
 *
 * 预约挂号医生列表分页条
 */
function smarty_function_doctormanagerpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new DoctorManagerTag();
    return $ser->getPageHtml($current, $size);
}

/**
 *
 * 预约挂号医生挂号信息列表分页条
 */
function smarty_function_reserdoctorpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new ReservationTag();
    return $ser->getDocPageHtml($current, $size);
}

/**
 *
 * 医院环境列表分页条
 */
function smarty_function_henvpagehtml($params, $template) {
	//显示位
	$show_position = unsetShowPosition();
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new EnvironmentTag();
    return $ser->getPageHtml($current, $size,$show_position);
}

/**
 *
 * 医院荣誉列表分页条
 */
function smarty_function_honorpagehtml($params, $template) {
	//显示位
	$show_position = unsetShowPosition();
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new HonorTag();
    return $ser->getPageHtml($current, $size,$show_position);
}


/**
 *
 * 媒体报道分页条
 */
function smarty_function_mediapagehtml($params, $template) {
	//显示位
	$show_position = unsetShowPosition();
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new MediaReportTag();
    return $ser->getPageHtml($current, $size,$show_position);
}

/**
 *
 * 视频列表分页条
 */
function smarty_function_moviepagehtml($params, $template) {
	//显示位
	$show_position = unsetShowPosition();
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new MovieTag();
    return $ser->getPageHtml($current, $size,$show_position);
}

/**
 *
 * 新闻列表分页条
 */
function smarty_function_newspagehtml($params, $template) {
	//显示位
	$show_position = unsetShowPosition();
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;    
    $size = $_COOKIE['pagesize'];
    $ser = new NewsTag();
    $aa = $ser->getPageHtml($current, $size,$show_position);
    return $aa;
}

/**
 *
 * 预约挂号列表分页条
 */
function smarty_function_reserpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $_REQUEST['page'] = $current;
    $size = $_COOKIE['pagesize'];
    $ser = new ReservationTag();
    return $ser->getPageHtml($current, $size);
}

/**
 *
 * seo列表分页条
 */
function smarty_function_seopagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new SeoTag();
    return $ser->getPageHtml($current, $size);
}

/**
 *
 * 成功案例列表分页条
 */
function smarty_function_successpagehtml($params, $template) {
	//显示位
	$show_position = unsetShowPosition();
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new SuccessTag();
    return $ser->getPageHtml($current, $size,$show_position);
}


/**
 *
 * 专题列表分页
 */
function smarty_function_topicpagehtml($params, $template) {
    $current = $template->getTemplateVars('cur');
    $current = $current == '' ? 1 : $current;
    $size = $_COOKIE['pagesize'];
    $ser = new TopicTag();
    return $ser->getPageHtml($current, $size);
}

