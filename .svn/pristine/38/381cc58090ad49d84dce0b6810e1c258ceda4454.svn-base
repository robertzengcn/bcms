<?php
/**
 *  
 * 第三方代码:根据外部引用代号(subject)获取对应的脚本信息
 * {thirdcode key="*"}
 * 
 * 上述方式将不再使用，灵活采用获取已开启代码嵌套并显示在页面中
 * {{thirdcode assign="third"}}{{$third}}
 * 
 */
function smarty_function_thirdcode($params, &$smarty) {
	$fun    = explode( '_' , __FUNCTION__ );
	$assign   = isset($params['assign']) ? $params['assign'] : $fun[2];
	$thirdTag = new ThirdTag();
	$result = $thirdTag->getThirdStats();
	$js = '';
	foreach ($result->data as $value) {
	    $js .= $value->js;
	}
	$smarty->assign ( $assign ,  $js);
}