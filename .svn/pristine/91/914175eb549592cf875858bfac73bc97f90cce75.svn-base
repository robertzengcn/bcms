<?php
/**
 * 
 * 简单运算 
 * @param $string 字符串
 * @param $number 运算的数字
 * @param $symbol 运算符号
 */
function smarty_modifier_operation($string, $number = 0, $symbol = '+') {
    if ($number == 0)
        return $string;
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

?>