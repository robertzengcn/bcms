<?php
/**
 * 图片管理标签
 * */
require_once 'common.php';
/**
 * 获取网站logo信息
 * 
 * 对应function标签中的{picture}
 */
function smarty_block_logopic($params, $content, $template, &$repeat) {
    if (!$repeat) {
        $ser = new PicManagerTag();
        $data = $ser->getLogo();
        if ($data->img&&strpos($data->img, NETADDRESS) === false) {
			$data->img = preg_replace('/^\//', '', $data->img, 1);
            $data->img = UPLOAD . $data->img;
        }
        if ($data->src&&strpos($data->src, NETADDRESS) === false) {
			$data->src = preg_replace('/^\//', '', $data->src, 1);
            $data->src = UPLOAD . $data->src;
        }
        if ($data->picture&&strpos($data->picture, NETADDRESS) === false) {
			$data->picture = preg_replace('/^\//', '', $data->picture, 1);
            $data->picture = UPLOAD . $data->picture;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 根据flag获取图片信息
 */
function smarty_block_picbyflag($params, $content, $template, &$repeat) {
    $flag = isset($params['flag']) ? $params['flag'] : '';
    
    if (!$repeat) {
        $ser = new PicManagerTag();
        $data = $ser->getPic($flag);
        if ($data->img&&strpos($data->img, NETADDRESS) === false) {
			$data->img = preg_replace('/^\//', '', $data->img, 1);
            $data->img = UPLOAD . $data->img;
        }
        if ($data->src&&strpos($data->src, NETADDRESS) === false) {
			$data->src = preg_replace('/^\//', '', $data->src, 1);
            $data->src = UPLOAD . $data->src;
        }
        if ($data->picture&&strpos($data->picture, NETADDRESS) === false) {
			$data->picture = preg_replace('/^\//', '', $data->picture, 1);
            $data->picture = UPLOAD . $data->picture;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取网站单张图片信息(手机)
 */
function smarty_block_mobilepic($params, $content, $template, &$repeat) {
    $flag = isset($params['flag']) ? $params['flag'] : '';
    $cate = isset($params['cate']) ? $params['cate'] : 'mobile';
    
    if (!$repeat) {
        $ser = new PicManagerTag();
        $data = $ser->getMobilePic($flag, $cate);
        if ($data->img&&strpos($data->img, NETADDRESS) === false) {
			$data->img = preg_replace('/^\//', '', $data->img, 1);
            $data->img = UPLOAD . $data->img;
        }
        if ($data->src&&strpos($data->src, NETADDRESS) === false) {
			$data->src = preg_replace('/^\//', '', $data->src, 1);
            $data->src = UPLOAD . $data->src;
        }
        if ($data->picture&&strpos($data->picture, NETADDRESS) === false) {
			$data->picture = preg_replace('/^\//', '', $data->picture, 1);
            $data->picture = UPLOAD . $data->picture;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取手机轮播图信息(手机)
 */
function smarty_block_mobilescrollpic($params, $content, $template, &$repeat) {
    $flag = isset($params['flag']) ? $params['flag'] : '';
    $cate = isset($params['cate']) ? $params['cate'] : 'mobile';

    if (!$repeat) {
        $ser = new PicManagerTag();
        $data = $ser->getMobileScroll($flag, $cate);
        if ($data->img&&strpos($data->img, NETADDRESS) === false) {
			$data->img = preg_replace('/^\//', '', $data->img, 1);
            $data->img = UPLOAD . $data->img;
        }
        if ($data->src&&strpos($data->src, NETADDRESS) === false) {
			$data->src = preg_replace('/^\//', '', $data->src, 1);
            $data->src = UPLOAD . $data->src;
        }
        if ($data->picture&&strpos($data->picture, NETADDRESS) === false) {
			$data->picture = preg_replace('/^\//', '', $data->picture, 1);
            $data->picture = UPLOAD . $data->picture;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 根据位置(标记)获取对应的轮播信息,包含连接\图片\文本
 * 
 * 对应function标签中的{carouselAdv}
 */
function smarty_block_scrollpicbyflag($params, $content, $template, &$repeat) {
    $flag = isset($params['flag']) ? $params['flag'] : '';
    $limit = isset($params['limit']) ? $params['limit'] : '';
    $return_index = isset($params['return_index']) ? $params['return_index'] : '';

    if (!$repeat) {
        $ser = new PicManagerTag();
        $data = $ser->getScroll($flag);
        if ($limit) {
        	$data = array_slice($data, 0, $limit);
        }
        
        if ($return_index) {
        	$data = isset($data[$return_index]) ? $data[$return_index] : array();
        }
        
        foreach ($data as $k=>$pic) {
            if ($pic->pic&&strpos($pic->pic, NETADDRESS) === false) {
				$pic->pic = preg_replace('/^\//', '', $pic->pic, 1);
                $data[$k]->pic = UPLOAD . $pic->pic;
            }
            /* if ($pic->url&&strpos($pic->url, NETADDRESS) === false) {
                $data[$k]->url = NETADDRESS . '/' . $pic->url;
            } */
            $data[$k]->index = $k;
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}

/**
 * 获取一条图片信息
 *
 * 对应function标签中的{picManager}
 */
function smarty_block_onepic( $params, $content, $template, &$repeat ) {
    formatFuncParams($params,$order, $limit, $where, $field);
    
    if (!$repeat) {
        $ser = new PicManagerTag();
        $data = $ser->findOne ( $where, $field );
        $data = empty($data) ? $data : $data->getProperties();
        if ($data['img']&&strpos($data['img'], NETADDRESS) === false) {
			$pic->pic = preg_replace('/^\//', '', $pic->pic, 1);
            $data['img'] = UPLOAD . $data['img'];
        }
        
        $assign = isset($params['assign']) ? $params['assign'] : '';
        if ($assign) {
            $template->assign($assign, $data);
        }
        
        return formatReturnData($data, $content);
    }
}