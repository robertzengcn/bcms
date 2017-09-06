<?php
/**
 *  
 * 个性频道标签 除了tag
 * 内的变量都参与过滤
 * {channel id="12" field="*" assign="xxx"}
 * 
 * 
 */
function smarty_function_channel($params, &$smarty) {
	$tag = array (
			'field',
			'order',
			'limit',
			'assign' 
	);
	$where=array();
	foreach ( $params as $key => $v ) {
		if (! in_array ( $key, $tag ) && ! empty ( $v )) 
		{
			$where [$key] = $v;
		}
	}
	
	$field = empty ( $params ['field'] ) ? "*" : $params ['field'];
	$ser = new ChannelTag();
	//$data = $ser->findOne ( $where, $field );
	$data = $ser->get($params['id']);
	$fun = explode('_',__FUNCTION__);
	$fun = $fun[2];
	$assign = isset($params['assign']) ? $params['assign'] : $fun;
	$smarty->assign ( $assign , $data );
}

/**
 *
 * 个性频道文章标签 除了tag
 * 内的变量都参与过滤
 * {channelArticle id="12" field="*" assign="xxx"}
 *
 *
 */
function smarty_function_channelArticle($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );
    $where=array();
    foreach ( $params as $key => $v ) {
        if (! in_array ( $key, $tag ) && ! empty ( $v ))
        {
            $where [$key] = $v;
        }
    }

    $field = empty ( $params ['field'] ) ? "*" : $params ['field'];
    $ser = new ChannelArticleTag();
    //$data = $ser->findOne ( $where, $field );
    $data = $ser->get($params['id']);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 个性频道文章标签 除了tag
 * 内的变量都参与过滤
 * {channelArticles field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_channelArticles($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );
    $where=array();
    foreach ( $params as $key => $v ) {
        if (! in_array ( $key, $tag ) && ! empty ( $v ))
        {
            $where [$key] = $v;
        }
    }

    $field = empty ( $params ['field'] ) ? "*" : $params ['field'];
    $order = empty ( $params ['order'] ) ? "id desc" : $params ['order'];
    $limit = empty ( $params ['limit'] ) ? "10" : $params ['limit'];
    $ser = new ChannelArticleTag();
    //$data = $ser->getLimit ($order, $limit, $where, $field);
    $data = $ser->getList($params['page']);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}

/**
 *
 * 个性频道标签 除了tag
 * 内的变量都参与过滤
 * {channels field="*" order="id desc" limit="10" assign="xxx"}
 *
 *
 */
function smarty_function_channels($params, &$smarty) {
    $tag = array (
        'field',
        'order',
        'limit',
        'assign'
    );
    $where=array();
    foreach ( $params as $key => $v ) {
        if (! in_array ( $key, $tag ) && ! empty ( $v ))
        {
            $where [$key] = $v;
        }
    }

    $field = empty ( $params ['field'] ) ? "*" : $params ['field'];
    $order = empty ( $params ['order'] ) ? "id desc" : $params ['order'];
    $limit = empty ( $params ['limit'] ) ? "10" : $params ['limit'];
    $ser = new ChannelTag();
    //$data = $ser->getLimit ($order, $limit, $where, $field);
    $data = $ser->getList($params['page']);
    $fun = explode('_',__FUNCTION__);
    $fun = $fun[2];
    $assign = isset($params['assign']) ? $params['assign'] : $fun;
    $smarty->assign ( $assign , $data );
}
