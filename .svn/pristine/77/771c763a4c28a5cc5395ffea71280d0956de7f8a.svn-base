<?php
if (!defined('BOYICMS_IN')) exit();
return  array(

    /* 错误设置 */
    'ERROR_MESSAGE'         => '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
    'ERROR_PAGE'            => '',	// 错误定向页面
    'SHOW_ERROR_MSG'        => true,    // 显示错误信息
    'TRACE_EXCEPTION'       => false,   // TRACE错误信息是否抛异常 针对trace方法 

    /* 模板引擎设置 */
    'DEFAULT_CHARSET'       => 'utf-8', // 默认模板输出类型
    'TMPL_CONTENT_TYPE'     => 'text/html', // 默认模板输出类型
    'TMPL_EXCEPTION_FILE'   => TAG_PATH.'Conf/debug.tpl',// 异常页面的模板文件
    'TMPL_TEMPLATE_SUFFIX'  => '.html',     // 默认模板文件后缀
	'SUBFIX'				=> '.htpl', //模板后缀
 

    // 布局设置
    'TMPL_CACHFILE_SUFFIX'  =>  '.php',      // 默认模板缓存后缀
    'TMPL_DENY_FUNC_LIST'   =>  'echo,exit',    // 模板引擎禁用函数
    'TMPL_DENY_PHP'         =>  false, 			// 默认模板引擎是否禁用PHP原生代码
    'TMPL_L_DELIM'          =>  '{',            // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'          =>  '}',            // 模板引擎普通标签结束标记
    'TMPL_VAR_IDENTIFY'     =>  'array',     // 模板变量识别。留空自动判断,参数为'obj'则表示对象
    'TMPL_STRIP_SPACE'      =>  false,       // 是否去除模板文件里面的html空格与换行
    'TMPL_CACHE_ON'         =>  true,        // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_CACHE_PREFIX'     =>  '',         // 模板缓存前缀标识，可以动态改变
    'TMPL_CACHE_TIME'       =>  0,         // 模板缓存有效期 0 为永久，(以数字为值，单位:秒)
    'TMPL_LAYOUT_ITEM'      =>  '{__BODY__}', // 布局模板的内容替换标识
    'LAYOUT_ON'             =>  false, // 是否启用布局
    'LAYOUT_NAME'           =>  'layout', // 当前布局名称 默认为layou	
	'CACHE_PATH'			=>  ABSPATH . '/template_c/',	
	'TAGLIB_BEGIN'      =>  '{',  // 标签库标签开始标记
	'TAGLIB_END'        =>  '}',  // 标签库标签结束标记	
	'TAGLIB_LOAD'           =>  true, // 是否使用内置标签库之外的其它标签库，默认自动检测
	'TAGLIB_BUILD_IN'       =>  'Cx', // 内置标签库名称(标签使用不必指定标签库名称),以逗号分隔 注意解析顺序
	'TAGLIB_PRE_LOAD'       =>  'Core\\Boyi',   // 需要额外加载的标签库(须指定标签库名称)，多个以逗号
	'TAGLIB_PRE_DEF'		=>  'boyi',	// 其它标签默认前缀
    'OUTPUT_ENCODE'         =>  false, // 页面压缩输出
    'HTTP_CACHE_CONTROL'    =>  'private', // 网页缓存控制
    'APP_FILE_CASE'  		=>  true, // 是否检查文件的大小写 对Windows系统有效
	'BOYI_VERSION'			=>  'v3.0',

);