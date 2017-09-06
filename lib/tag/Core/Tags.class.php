<?php

class Tags {

    private static $_instance = array();

    /**
     * 应用程序初始化
     * @access public
     * @return void
     */
    static public function start() {
        // 设定错误和异常处理
        register_shutdown_function(array('Tags','fatalError'));	
        set_error_handler(array('Tags','appError'));
        set_exception_handler(array('Tags','appException'));
        // 注册AUTOLOAD方法
        spl_autoload_register(array('Tags', 'autoload'));
			
        return ;
    }


    /**
     * 系统自动加载
     * @param string $class 对象类名
     * @return void
     */
    public static function autoload($class) {
        // 检查是否存在别名定义
        $file       =   $class.'.class.php';
		if(substr($class,0,8)=='Template'){ // 加载模板引擎驱动
            if(require_array(array(
                CORE_PATH.$file),true)){
                return ;
            }
        }elseif(substr($class,0,6)=='TagLib'){ // 加载标签库驱动
            if(require_array(array(
                TAGLIB_PATH.$file),true)) {
                return ;
            }
        }elseif(substr($class,0,6)=='Cx'){ // 加载标签库
            if(require_array(array(
                TAGLIB_PATH.$file),true)) {
                return ;
            }
        }elseif (C('TAGLIB_PRE_LOAD')) {	// 自动加载自定义标签
            foreach(explode(',',C('TAGLIB_PRE_LOAD')) as $layer){
				$className = substr($layer,strrpos($layer,'\\')+1);
				if(require_array(array(
					CORE_PATH.$className.'.class.php'),true)) {
					return ;
				}            
            }
        }
    }


    /**
     * 取得对象实例 支持调用类的静态方法
     * @param string $class 对象类名
     * @param string $method 类的静态方法名
     * @return object
     */
    static public function instance($class,$method='') {
        $identify   =   $class.$method;
        if(!isset(self::$_instance[$identify])) {
            if(class_exists($class)){
                $o = new $class();
                if(!empty($method) && method_exists($o,$method))
                    self::$_instance[$identify] = call_user_func_array(array(&$o, $method));
                else
                    self::$_instance[$identify] = $o;
            }
            else
                E(L('_CLASS_NOT_EXIST_').':'.$class);
        }
        return self::$_instance[$identify];
    }

    /**
     * 自定义异常处理
     * @access public
     * @param mixed $e 异常对象
     */
    static public function appException($e) {
        $error = array();
        $error['message']   = $e->getMessage();
        $trace  =   $e->getTrace();
        if('throw_exception'==$trace[0]['function']) {
            $error['file']  =   $trace[0]['file'];
            $error['line']  =   $trace[0]['line'];
        }else{
            $error['file']      = $e->getFile();
            $error['line']      = $e->getLine();
        }
        E($error);
    }

    /**
     * 自定义错误处理
     * @access public
     * @param int $errno 错误类型
     * @param string $errstr 错误信息
     * @param string $errfile 错误文件
     * @param int $errline 错误行数
     * @return void
     */
    static public function appError($errno, $errstr, $errfile, $errline) {
      switch ($errno) {
          case E_ERROR:
          case E_PARSE:
          case E_CORE_ERROR:
          case E_COMPILE_ERROR:
          case E_USER_ERROR:
            ob_end_clean();
            // 页面压缩输出支持
            if(C('OUTPUT_ENCODE')){
                $zlib = ini_get('zlib.output_compression');
                if(empty($zlib)) ob_start('ob_gzhandler');
            }
            $errorStr = "$errstr ".$errfile." 第 $errline 行.";
            function_exists('E')?E($errorStr):exit('ERROR:'.$errorStr);
            break;
          case E_STRICT:
          case E_USER_WARNING:
          case E_USER_NOTICE:
          default:
            $errorStr = "[$errno] $errstr ".$errfile." 第 $errline 行.";
            trace($errorStr,'','NOTIC');
            break;
      }
    }
    
    // 致命错误捕获
    static public function fatalError() {
        if ($e = error_get_last()) {
            switch($e['type']){
              case E_ERROR:
              case E_PARSE:
              case E_CORE_ERROR:
              case E_COMPILE_ERROR:
              case E_USER_ERROR:  
                ob_end_clean();
                function_exists('E')?E($e):exit('ERROR:'.$e['message']. ' in <b>'.$e['file'].'</b> on line <b>'.$e['line'].'</b>');
                break;
            }
        }
    }

}
