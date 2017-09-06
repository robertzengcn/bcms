<?php
/**
 * 
 * 时间格式化
 * @param $string 字符串
 * @param $format 需要格式化的形式
 * @param $default_date 默认时间
 * @param $formatter 格式化类型
 */
function smarty_modifier_date_format($string, $format=null, $default_date='', $formatter='auto')
{
    if ($format === null) {
        $format = Smarty::$_DATE_FORMAT;
    }
    /**
     * Include the {@link shared.make_timestamp.php} plugin
     */
    require_once(SMARTY_PLUGINS_DIR . 'shared.make_timestamp.php');
    if ($string != '') {
        $timestamp = smarty_make_timestamp($string);
    } elseif ($default_date != '') {
        $timestamp = smarty_make_timestamp($default_date);
    } else {
        return;
    }
    if($formatter=='strftime'||($formatter=='auto'&&strpos($format,'%')!==false)) {
        if (DS == '\\') {
            $_win_from = array('%D', '%h', '%n', '%r', '%R', '%t', '%T');
            $_win_to = array('%m/%d/%y', '%b', "\n", '%I:%M:%S %p', '%H:%M', "\t", '%H:%M:%S');
            if (strpos($format, '%e') !== false) {
                $_win_from[] = '%e';
                $_win_to[] = sprintf('%\' 2d', date('j', $timestamp));
            }
            if (strpos($format, '%l') !== false) {
                $_win_from[] = '%l';
                $_win_to[] = sprintf('%\' 2d', date('h', $timestamp));
            }
            $format = str_replace($_win_from, $_win_to, $format);
        }
        return strftime($format, $timestamp);
    } else {
        return date($format, $timestamp);
    }
}
?>