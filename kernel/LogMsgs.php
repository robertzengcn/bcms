<?php

class LogMsgs {

    /**
     * 操作消息
     *
     * @var unknown
     */
    private static $logMsgs = Array(
        'logout' => '注销',
        'del' => '删除',
        'delBatch' => '批量删除',
        'save' => '添加',
        'update' => '更改',
        'add' => '添加',
        'edit' => '更改',
        'generate' => '生成静态',
        'generateOp' => '控制生成静态',
        'generateAll' => '生成所有静态',
        'generateHtml' => '生成静态地图',
        'generateSiteMap' => '生成sitemap',
        'ad_edit' => '编辑广告',
        'add_special' => '定制特色技术添加',
        'mdf_special' => '定制特色技术编辑',
        'addCustom' => '定制动态类添加',
        'editCustom' => '定制动态类编辑',
        'saveTpl' => '保存修改模板',
        'editStaticTpl' => '编辑静态模板',
        'reg' => '注册',
        'mdf' => '修改员工密码',
        'mdf_admin' => '管理员修改密码',
        'clearSys' => '清空日志',
        'openSys' => '开启日志',
        'closeSys' => '关闭日志',
        'csvSys' => '导出csv',
        'installSlide' => '安装轮播组'
    );

    /**
     * 控制器消息
     *
     * @var unknown
     */
    private static $controllerMsgs = Array(
        'Article' => '疾病资讯',
        'Business' => '商务通',
        'ChannelArticle' => '自定义频道文章',
        'Channel' => '自定义频道',
        'Contact' => '联系方式',
        'Department' => '科室',
        'Device' => '先进设备',
        'Disease' => '疾病',
        'Doctor' => '医生',
        'Environment' => '医院环境',
        'Honor' => '医院荣誉',
        'Introduce' => '医院简介',
        'Link' => '友情链接',
        'MakeHtml' => '生成页面',
        'MediaReport' => '媒体报道',
        'Movie' => '视频管理',
        'Navigation' => '导航设置',
        'News' => '医院动态',
        'Pic' => '轮播图片',
        'PicManager' => '图片管理',
        'Seo' => 'SEO',
        'StatisticsLog' => '流量统计',
        'Success' => '成功案例',
        'Tags' => 'Tags管理',
        'Technology' => '特色技术',
        'ThirdStat' => '第三方代码',
        'Topic' => '专题',
        'UserVar' => '自定义字段',
        'Worker' => '用户管理',
        'WorkHistory' => '简历管理',
        'Login' => '登录管理',
        'WorkerLogHistory' => '系统日志'
    );

    /**
     * 获取日志操作信息
     *
     * @param unknown $code
     * @return Ambigous <string, unknown>
     */
    public static function get($code) {
        $msg = isset(self::$logMsgs[$code]) ? self::$logMsgs[$code] : false;

        return ($msg ? $msg : false);
    }

    /**
     * 获取控制器信息
     *
     * @param unknown $code
     * @return Ambigous <string, multitype:string >
     */
    public static function getController($code) {
        $msg = isset(self::$controllerMsgs[$code]) ? self::$controllerMsgs[$code] : false;

        return (($msg) ? $msg : '未知的控制器');
    }
}
