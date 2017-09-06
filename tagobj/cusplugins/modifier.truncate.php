<?php
/**
 * 
 * 截取 
 * @param $string 字符串
 * @param $length 需要截取的长度
 * @param $etc 尾巴
 */
function smarty_modifier_truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false) {
    if ($length == 0)
        return '';

    $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
    if (function_exists('mb_strlen')) {
        if (mb_strlen($string, 'UTF-8') > $length) {
            $length -= min($length, mb_strlen($etc, 'UTF-8'));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/' . 'u', '', mb_substr($string, 0, $length + 1, 'UTF-8'));
            } 
            if (!$middle) {
                return mb_substr($string, 0, $length, 'UTF-8') . $etc;
            }
            return mb_substr($string, 0, $length / 2, 'UTF-8') . $etc . mb_substr($string, - $length / 2, $length, 'UTF-8');
        }
        return $string;
    }
    
    // no MBString fallback
    if (isset($string[$length])) {
        $length -= min($length, strlen($etc));
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
        } 
        if (!$middle) {
            return substr($string, 0, $length) . $etc;
        }
        return substr($string, 0, $length / 2) . $etc . substr($string, - $length / 2);
    }
    return $string;
}

?>