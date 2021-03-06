<?php
/**
 * 导航标签
 * */
require_once 'common.php';
/**
 * 获取自定义导航组
 */
function smarty_block_navgroup( $params, $content, $template, &$repeat ) {
    $flag = isset($params['flag']) ? $params['flag'] : '';

    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getNavgroup($flag);
        foreach ($data as $key=>$navinfo) {
            if ($navinfo['url']&&strpos($navinfo['url'], NETADDRESS) === false) {
				if(preg_match("/^\/[a-zA-Z]+\/?[a-zA-Z]+$/i", $navinfo['url'])){
					$navinfo['url'] = $navinfo['url'] . '/';
				}
                $navinfo['url'] = NETADDRESS  . $navinfo['url'];
            }
            if ($navinfo['pic']&&strpos($navinfo['pic'], NETADDRESS) === false) {
                $navinfo['pic'] = UPLOAD . $navinfo['pic'];
            }
            $navinfo['index'] = $key;
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
 * 根据flag获取导航组的名称
 */
function smarty_block_navgroupname( $params, $content, $template, &$repeat ) {
    $flag = isset($params['flag']) ? $params['flag'] : '';

    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getNavgroupName($flag);
        
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
function smarty_block_navgroupinfo( $params, $content, $template, &$repeat ) {
    $id = isset($params['id']) ? $params['id'] : ($template->getTemplateVars('id'));

    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getById($id);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 根据手机导航组flag获取导航成员信息
 */
function smarty_block_mobilenavgroup( $params, $content, $template, &$repeat ) {
    $flag = isset($params['flag']) ? $params['flag'] : '';
    $cate = isset($params['cate']) ? $params['cate'] : 'mobile';

  if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getMobileGroup($flag, $cate);
        $index = 0;
        foreach ($data as $k=>$v) {
        	if ($v->url&&strpos($v->url, NETADDRESS) === false) {
        		$v->url = NETADDRESS . '/app' . $v->url;
        	}
        	if ($v->pic&&strpos($v->pic, NETADDRESS) === false) {
        		$v->pic = UPLOAD . $v->pic;
        	}
        	$data[$k]->index = $index;
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
 * 根据手机导航组flag获取导航名称
 */
function smarty_block_mobilenavgroupname( $params, $content, $template, &$repeat ) {
    $flag = isset($params['flag']) ? $params['flag'] : '';
    $cate = isset($params['cate']) ? $params['cate'] : 'mobile';

    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getMobileGropname($flag, $cate);
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取全局头部导航
 * 
 * 对应function标签中的{topNav}
 */
function smarty_block_topnavigation( $params, $content, $template, &$repeat ) {
    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getTop();
        foreach ($data as $key=>$navinfo) {
           if ($navinfo->url&&strpos($navinfo->url, NETADDRESS) === false) {
				if(preg_match("/^\/[a-zA-Z]+\/?[a-zA-Z]+$/i", $navinfo->url)){
					$navinfo->url = $navinfo->url . '/';
				}
                $navinfo->url = NETADDRESS  . $navinfo->url;
            }
            if ($navinfo->pic&&strpos($navinfo->pic, NETADDRESS) === false) {
				$navinfo->pic = preg_replace('/^\//', '', $navinfo->pic, 1);
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
 * 获取全局疾病导航
 * 
 * 对应function标签中的{diseaseNav}
 */
function smarty_block_disnavigation($params, $content, $template, &$repeat) {
    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getDisease();
        foreach ($data as $key=>$navinfo) {
            if ($navinfo['url']&&strpos($navinfo['url'], NETADDRESS) === false) {
				if(preg_match("/^\/[a-zA-Z]+\/?[a-zA-Z]+$/i", $navinfo['url'])){
					$navinfo['url'] = $navinfo['url'] . '/';
				}
                $navinfo['url'] = NETADDRESS  . $navinfo['url'];
            }
            if ($navinfo['pic']&&strpos($navinfo['pic'], NETADDRESS) === false) {
				$navinfo['pic'] = preg_replace('/^\//', '', $navinfo['pic'], 1);
                $navinfo['pic'] = UPLOAD . $navinfo['pic'];
            }
            $navinfo['index'] = $key;
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
 * 获取全局尾部导航
 * 
 * 对应function标签的{footNav}
 */
function smarty_block_footnavigation($params, $content, $template, &$repeat) {
    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getFoot();
        foreach ($data as $key=>$navinfo) {
           if ($navinfo->url&&strpos($navinfo->url, NETADDRESS) === false) {
				if(preg_match("/^\/[a-zA-Z]+\/?[a-zA-Z]+$/i", $navinfo->url)){
					$navinfo->url = $navinfo->url . '/';
				}
                $navinfo->url = NETADDRESS  . $navinfo->url;
            }
            if ($navinfo->pic&&strpos($navinfo->pic, NETADDRESS) === false) {
				$navinfo->pic = preg_replace('/^\//', '', $navinfo->pic, 1);
                $navinfo->pic = UPLOAD . $navinfo->pic;
            }
            $navinfo->index = $key;
            $data->$key = $navinfo;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 通过对应的cate值获取对应区域的导航对象数组
 */
function smarty_block_navbycate( $params, $content, $template, &$repeat ) {
    $cate = isset($params['cate']) ? $params['cate'] : 'top';

    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->get($cate);
        foreach ($data as $key=>$navinfo) {
            if ($navinfo['url']&&strpos($navinfo['url'], NETADDRESS) === false) {
				if(preg_match("/^\/[a-zA-Z]+\/?[a-zA-Z]+$/i", $navinfo['url'])){
					$navinfo['url'] = $navinfo['url'] . '/';
				}
                $navinfo['url'] = NETADDRESS  . $navinfo['url'];
            }
            if ($navinfo['pic']&&strpos($navinfo['pic'], NETADDRESS) === false) {
				$navinfo['pic'] = preg_replace('/^\//', '', $navinfo['pic'], 1);
                $navinfo['pic'] = UPLOAD . $navinfo['pic'];
            }
            $navinfo['index'] = $key;
            $data[$key] = $navinfo;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/*************************以下是从function标签中改名并迁移过来的*****************************/
/**
 * 获取指定条数的导航信息
 *
 * {navigations}的block形式
 */
function smarty_block_navbylimit( $params, $content, $template, &$repeat ) {
    formatFuncParams($params,$order, $limit, $where, $field, $children);
    $order = empty ( $params ['order'] ) ? "cate asc,sort asc" : $params ['order'];

    if (!$repeat) {
        $ser = new NavigationTag();
        $data = $ser->getLimit ( $order, $limit, $where, $field );
        foreach ($data as $key=>$navinfo) {
            if ($children) {
                $where['pid'] = $navinfo->id;
                $children = $ser->getLimit ( $order, $limit, $where, $field );
                $navinfo->children = $children;
                $children = true;
            }
            if ($navinfo->url&&strpos($navinfo->url, NETADDRESS) === false) {
				if(preg_match("/^\/[a-zA-Z]+\/?[a-zA-Z]+$/i", $navinfo->url)){
					$navinfo->url = $navinfo->url . '/';
				}
                $navinfo->url = NETADDRESS  . $navinfo->url;
            }
            if ($navinfo->pic&&strpos($navinfo->pic, NETADDRESS) === false) {
				$navinfo->pic = preg_replace('/^\//', '', $navinfo->pic, 1);				
                $navinfo->pic = UPLOAD . $navinfo->pic;
            }
            $navinfo->index = $key;
            $data[$key] = $navinfo;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        $str = formatReturnData($data, $content);
        return $str;
    }
}
