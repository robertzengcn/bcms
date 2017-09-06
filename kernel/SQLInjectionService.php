<?php

/**
 *
 * sql关键词、xss过滤装置
 * @author Administrator
 *
 */
class SQLInjectionService {

    /**
     * 外部接口调用方法
     */
    public function execute() {

        foreach ($_REQUEST as $key => $value) {
            if (! is_array($value)) {
                $_REQUEST[$key] = addslashes(trim($value));
            }
        }
        
        //if( ! $this->filter() ) { 
        	//return new Result( false , 140 , ErrorMsgs::get( 140 ) , NULL ); 
        //}

        return new Result(true, 0, '', NULL);
    }

    /**
     * 数据过滤
     */
    private function filter() {
        $getfilter = "'|<[^>]*?>|^\\+\/v(8|9)|\\b(and|or)\\b.+?(>|<|=|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
        $postfilter = "^\\+\/v(8|9)|\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|<\\s*img\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
        $cookiefilter = "\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
        foreach ($_GET as $key => $value) {
            if (! $this->stopAttack($key, $value, $getfilter)) {
                return false;
            }
        }
        foreach ($_POST as $key => $value) {
            if (! $this->stopAttack($key, $value, $postfilter)) {
                return false;
            }
        }
        foreach ($_COOKIE as $key => $value) {
            if (! $this->stopAttack($key, $value, $cookiefilter)) {
                return false;
            }
        }
        return true;
    }

    private function stopAttack($StrFiltKey, $StrFiltValue, $ArrFiltReq) {
        $StrFiltValue = $this->arrForeach($StrFiltValue);
        if (preg_match("/" . $ArrFiltReq . "/is", $StrFiltValue) == 1) {
            return false;
        }
        if (preg_match("/" . $ArrFiltReq . "/is", $StrFiltKey) == 1) {
            return false;
        }
        return true;
    }

    private function arrForeach($arr) {
        static $str;
        if (! is_array($arr)) {
            return $arr;
        }
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $this->arr_foreach($val);
            } else {
                $str[] = $val;
            }
        }
        return implode($str);
    }
}