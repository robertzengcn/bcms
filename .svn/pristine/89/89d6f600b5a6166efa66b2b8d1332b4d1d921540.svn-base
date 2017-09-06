<?php
/**
 * 网站地图
 * */
require_once 'common.php';
/**
 * 获取头部导航
 */
function smarty_block_headnavmap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getHeadAdv();
        
        foreach ($data as $key=>$navinfo) {
            if ($navinfo->url&&strpos($navinfo->url, NETADDRESS) === false) {
                $navinfo->url = NETADDRESS . '/' . $navinfo->url;
            }
            if ($navinfo->pic&&strpos($navinfo->pic, NETADDRESS) === false) {
                $navinfo->pic = UPLOAD . $navinfo->pic;
            }
            $navinfo->index = $key;
            $data[$key] = $navinfo;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取所有科室列表
 */
function smarty_block_deptmap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getDepartment();
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取所有疾病列表
 */
function smarty_block_diseasemap( $params, $content, $template, &$repeat ) {
    $id = isset($params['department_id']) ? $params['department_id'] : 1;
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getDiease($id);
        
        $disSer = new DiseaseTag();
        foreach ($data as $k=>$v) {
            $data[$k]->url = $disSer->getDiseaseUrl($v->id,$v->department_id,false);
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 通过疾病id，获取文章列表
 */
function smarty_block_arcmapbydisease( $params, $content, $template, &$repeat ) {
    $id = isset($params['disease_id']) ? $params['disease_id'] : '';

    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getByDisease($id);
        
        $arcSer = new ArticleTag();
        foreach ($data as $key=>$arcinfo) {
            if ($arcinfo->pic&&strpos($arcinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $arcinfo->pic;
            }
            $url = $arcSer->getArticleUrl($arcinfo->id, false);
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
 * 获取最新新闻
 */
function smarty_block_newsmap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getNews();
        
        $index = 0;
        foreach ($data as $key=>$newsinfo) {
            if ($newsinfo->pic&&strpos($newsinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $newsinfo->pic;
            }
            $data[$key]->url = getNewsUrl($newsinfo->id);
            $data[$key]->index = $index;
            $index++;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取媒体新闻
 */
function smarty_block_mediamap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getMedia();
        
        foreach ($data as $key=>$mediainfo) {
            if ($mediainfo->pic&&strpos($mediainfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $mediainfo->pic;
            }
            $data[$key]->url = getMediaUrl($mediainfo->id);
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取视频
 */
function smarty_block_moviemap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getMovie();
        
        foreach ($data as $key=>$movieinfo) {
            if ($movieinfo->pic&&strpos($movieinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $movieinfo->pic;
            }
            $data[$key]->url = NETADDRESS . "/hospital/movie/" . $movieinfo->id . ".html";
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取特色技术
 */
function smarty_block_technologymap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getTechnology();
        
        foreach ($data as $k=>$v) {
            if ($v->pic&&strpos($v->pic, NETADDRESS) === false) {
                $data[$k]->pic = UPLOAD . $v->pic;
            }
            $data[$k]->url = getTechUrl($v->id);
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取成功案例
 */
function smarty_block_succmap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getSuccess();
        
        foreach ($data as $k=>$info) {
            $data[$k]->url = getSuccessUrl($info->id);
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取医院设备
 */
function smarty_block_devicemap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getDevice();
        
        $index = 0;
        foreach ($data as $key=>$deviceinfo) {
            if ($deviceinfo->pic&&strpos($deviceinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $deviceinfo->pic;
            }
            $data[$key]->url = getDeviceUrl($deviceinfo->id);
            $data[$key]->index = $index;
            $index++;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取医院荣誉
 */
function smarty_block_honormap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getHonor();
        
        foreach ($data as $key=>$honorinfo) {
            if ($honorinfo->pic&&strpos($honorinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $honorinfo->pic;
            }
            $data[$key]->url = NETADDRESS . "/hospital/honor/" . $honorinfo->id . ".html";
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取医院环境
 */
function smarty_block_environmentmap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getEnvironment();
        
        foreach ($data as $key=>$henvinfo) {
            if ($henvinfo->pic&&strpos($henvinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $henvinfo->pic;
            }
            $data[$key]->url = NETADDRESS . "/hospital/environment/" . $henvinfo->id . ".html";
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取医院医生
 */
function smarty_block_doctormap( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new SiteMapTag();
        $data = $ser->getDoctor();
        
        foreach ($data as $key=>$doctorinfo) {
            if ($doctorinfo->pic&&strpos($doctorinfo->pic, NETADDRESS) === false) {
                $data[$key]->pic = UPLOAD . $doctorinfo->pic;
            }
            $data[$key]->url = NETADDRESS . "/doctor/" . $doctorinfo->id . ".html";
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}


