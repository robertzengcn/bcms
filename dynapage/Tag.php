<?php
// 标签目录
defined('TAG_PATH') or define('TAG_PATH', ABSPATH . '/lib/tag/');

//   系统信息
if(version_compare(PHP_VERSION,'5.4.0','<')) {
    ini_set('magic_quotes_runtime',0);
    define('MAGIC_QUOTES_GPC',get_magic_quotes_gpc()?True:False);
}else{
    define('MAGIC_QUOTES_GPC',false);
}
defined('APP_DEBUG') 	   or define('APP_DEBUG',true);
defined('TEMPDIR')         or define('TEMPDIR',      rtrim($_SERVER['DOCUMENT_ROOT'],'/tpl')); 
defined('INCLUDE_PATH')    or define('INCLUDE_PATH',      TAG_PATH.'Include/'); 
defined('TAGLIB_PATH')     or define('TAGLIB_PATH',    TAG_PATH.'TagLib/'); 
defined('EXCEPTION_PATH')  or define('EXCEPTION_PATH',    TAG_PATH.'Conf/'); 
defined('CONF_PATH')       or define('CONF_PATH',    TAG_PATH.'Conf/'); 
defined('CORE_PATH')       or define('CORE_PATH',    TAG_PATH.'Core/'); 

define('IS_CGI',substr(PHP_SAPI, 0,3)=='cgi' ? 1 : 0 );
define('IS_WIN',strstr(PHP_OS, 'WIN') ? 1 : 0 );
define('IS_CLI',PHP_SAPI=='cli'? 1   :   0);

class Tag {

    var $templateName;

    var $htplFileName;

   // var $neededVars = Array();

    var $tagObjects = Array();

    //var $smarty;
		
	
	
    function __construct($htplFileName) {
		// 加载运行时所需文件
        $this->htplFileName = $htplFileName;
		$this->load_file();
        //$this->smarty = new Smarty();
    }
	
	private function load_file() {
		// 加载系统基础函数库
		if(defined('GLOBAL_FUNC')){
			//error...
		}else{
			require INCLUDE_PATH.'global.func.php';
				// 加载配置文件
				C(include TAG_PATH.'Conf/conftag.php');
			// 读取核心文件列表
			$list = array(
				CORE_PATH.'Tags.class.php',
				CORE_PATH.'TagException.class.php'  // 异常处理类
			);

			// 加载模式文件列表
			foreach ($list as $key=>$file){
				if(is_file($file))  require_cache($file);
			}			
		}
		Tags::Start();
	}
    /**
     * 初始化
     */
    function init() {
        // 检查tpl目录下是否有配置文件。有则取配置文件种到变量定义，
        // 无则选择vars.config种到变量定义 ，
        // 将来有限制的情况下，没有找到配置文件则扔出错误

        $result = $this->readFromConfig();
/*         if ($result->statu) {
            $data = $result->data->vars;
            $this->neededVars[] = $data;
        } */

        return $result;
    }

    /**
     * 读取配置文件
     *
     * @return Result mixed
     */
    private function readFromConfig() {
        // tagobjects.json
/*         $configFile = ABSPATH . '/dynapage/tagobjects.json';
        if (file_exists($configFile)) {
            $content = file_get_contents($configFile);
            $this->tagObjects = json_decode($content);
        } else {
            return new Result(false, 33, ErrorMsgs::get(33), Null);
        } */

        // config.json
        $configFile = TEMPDIR . 'config.json';

        if (file_exists($configFile)) {
            $content = file_get_contents($configFile);
            $templateName = json_decode($content);
        } else {
            return new Result(false, 33, ErrorMsgs::get(33), Null);
        }

        // 判断是否有设置currentUserd
        if ($templateName[0]->currentUsed != '') {
            $this->templateName = $templateName[0]->currentUsed;
            if (! defined('TAGDIR')) {
                define('TAGDIR', ABSPATH . '/tpl/' . $this->templateName . '/common/'); // 自定义插件模板目录
            }
        } else {
        	
            return new Result(false, 34, ErrorMsgs::get(34), Null);
        }

        // 模板
        /*
         * $tempFile = TEMPDIR . $this->templateName . '/' . $this->htplFileName . '.htpl'; if (! file_exists ( $tempFile )) { return new Result ( false, 35, ErrorMsgs::get ( 35 ), Null ); }
         */
        // 模板配置
        $tplConfigFile = TEMPDIR . $this->templateName . '/' . $this->htplFileName . '.json';
        

        if (file_exists($tplConfigFile)) {
            $content = file_get_contents($tplConfigFile);
            $tplConfig = json_decode($content);
        } else {
            // 默认配置
            $varsConfigFile = TEMPDIR . $this->templateName . '/vars.json';
           
            if (file_exists($varsConfigFile)) {
                $content = file_get_contents($varsConfigFile);
                $tplConfig = json_decode($content);
            } else {
                return new Result(false, 34, ErrorMsgs::get(34), Null);
            }
        }

        return new Result(true, 0, '', $tplConfig);
    }





    /**
     * 获取tagObject
     *
     * @param unknown $key
     * @return Result
     */
    public function getTagObject($key) {
        foreach ($this->tagObjects as $k => $v) {
            if ($v->key == $key) {
                return new Result(true, 1, '', $v);
            }
        }
        return new Result(false, 36, ErrorMsgs::get(36), Null);
    }
}

