<?php
/**
 * 
 * 截取 
 * @param $string 字符串
 * @param $length 需要截取的长度
 * @param $etc 尾巴
 */

function truncate($str, $length = 80, $etc = '...', $charset="utf-8", $start=0, $suffix=true) {
    if ($length == 0)
        return '';

       if(function_exists("mb_substr")){
            $slice= mb_substr($str, $start, $length, $charset);
        }elseif(function_exists('iconv_substr')) {
            $slice= iconv_substr($str,$start,$length,$charset);
        }else{
            $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
            $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
            $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
            $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("",array_slice($match[0], $start, $length));
        }    
		$fix='';
		if(strlen($slice) < strlen($str)){
			$fix = $etc;
		}
		return $suffix ? $slice.$fix : $slice;
}

/**
 * 
 * 简单运算 
 * @param $string 字符串
 * @param $number 运算的数字
 * @param $symbol 运算符号
 */
function operation($string, $number = 0, $symbol = '+') {
	if(!is_numeric($string)) return $string;
    if ($number == 0) return $string;
		$number = intval($number);
	switch($symbol){
		case '+'; $string = $string+$number;break;
		case '-'; $string = $string-$number;break;
		case '*'; $string = $string*$number;break;
		case '/'; $string = $string/$number;break;
		default:break;
	}
    return $string;
}
/**
 * 
 * 时间格式化
 * @param $string 字符串
 * @param $format 需要格式化的形式
 */
function dateformat($string, $format=null) {
	if ($format === null) {
		return ;
	}
	return date($format, $string);
}	