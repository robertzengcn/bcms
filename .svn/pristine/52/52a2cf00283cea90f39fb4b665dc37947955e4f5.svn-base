<?php
/**
 * 分页标签 {pageTag count="总页数" page="条数" current="当前页" } {/pageTag}
 * 
 * @param PAGESIZE 根据配置文件中来显示分页条
 */
function smarty_block_pageTag($params, $content, &$smarty, &$repeat) {
	$count = $params ['count']; // 总页数
	$current = $params ['current']; // 当前页
	$page = $params ['page']; // 每页多少条
	$pre = $current > 1 ? ($current - 1) : 1; // 上一页
	$next = $current + 1; // 下一页
	
	if ($current < PAGESIZE && $count > PAGESIZE) {
		$start = PAGESIZE - 1;
	} else {
		$start = $current;
	}
	
	$end = $count < PAGESIZE ? $count : $current + PAGESIZE - 1;
	
	$max = $current <= 1 ? $current : $current + PAGESIZE;
	$filename = empty ( $params ['tmp'] ) ? 'index' : $params ['tmp'];
	$currentUsed=file_get_contents(TEMPDIR.'/config.json');
	$array=json_decode($currentUsed,true);
	
	$pulugin_tpl=$array[0]['currentUsed'];
	
	$file = TEMPDIR.$pulugin_tpl . '/common/page/' . $filename . ".html";

	
	if (! file_exists ( $file )) {
		// 指定模板不存在，返回上级寻找
		$file = PLUGINSDIR_SMARTY . $filename . ".html";
	}

	$smarty->assign ( 'count', $count );
	$smarty->assign ( 'pagesize', PAGESIZE );
	$smarty->assign ( 'max', $max );
	$smarty->assign ( 'page', $page );
	$smarty->assign ( 'current', $current );
	$smarty->assign ( 'pre', $pre );
	$smarty->assign ( 'next', $next );
	$smarty->assign ( 'end', $end );
	$smarty->assign ( 'start', $start );
	
	if (! $repeat) {		
		return $smarty->fetch ( $file );
	}
}