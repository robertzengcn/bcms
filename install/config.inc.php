﻿<?php
$config = array(
	//系统运行文件夹权限配置
	'System_Authority' => array(
		'/web-setting.php'  => 'read,write',
		'/'            		=> 'read,write',
		'/public/'          =>'read,write',
		'/upload/'			=>'read,write',
		'/tpl/'				=>'read,write',
		'/template_c/'		=>'read,write',
		'/plugin/'			=>'read,write',
		'/topic/'           =>'read,write',
		'/hcc/plugin/plugins/'	=>'read,write',
		'/controller/'		=>'read,write',
		'/kernel/'			=>'read,write',
		'/kernel/dao/'		=>'read,write',
		'/kernel/entity/'	=>'read,write',
		'/install/'               => 'read,write',
		'/install/web-setting.php' => 'read,write',
		'/install/dist/template/' => 'read,write' 
	),
	//网站联系方式对应字段值
	'System_Contact' => array(
		'name'     => array('name'=>'医院名称','is_retain'=>1,'flag'=>'name'),
		'tel'      => array('name'=>'电话','is_retain'=>0,'flag'=>'tel'),
		'qq'       => array('name'=>'qq','is_retain'=>0,'flag'=>'qq'),
		'address'  => array('name'=>'地址','is_retain'=>0,'flag'=>'address'),
		'route'    => array('name'=>'乘车路线','is_retain'=>0,'flag'=>'route'),
		'icp'      => array('name'=>'ICP备案号','is_retain'=>0,'flag'=>'icp')
	),
	#########################################################################################################
											/* 默认值 */
	#########################################################################################################
	//网站联系方式默认值
	'Contact_Sql' => array(
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('医院名称', '', '1', 'name');",
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('电话', '', '1', 'tel');",
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('QQ', '', '1', 'qq');",
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('地址', '', '1', 'address');",
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('乘车路线', '', '1', 'route');",
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('百度地图经纬度', '', '1', 'map');",
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('ICP备案号', '', '1', 'icp');",
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('商务通(默认代码)', '', '1', 'swt');",
		"INSERT INTO `contact` (`name`,`val`,`is_retain`,`flag`) VALUES ('网站域名', '', '1', 'domain');"
	),
	//网站SEO默认值
	'Seo_Sql' => array(
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('在线问答', 'ask', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('新闻列表', 'news', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('案例列表', 'success', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('特色技术列表', 'technology', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('荣誉列表', 'honor', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('环境列表', 'environment', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('设备列表', 'device', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('联系方式', 'contact', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('首页', 'index', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('医院简介', 'introduce', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('网站地图', 'sitemap', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('搜索页', 'search', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('医生列表', 'doctor', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('媒体报道', 'mediaReport', null, null, null, '1');",
		"INSERT INTO `seo` (`page_name`,`flag`,`title`,`keywords`,`description`,`is_retain`) VALUES ('在线预约', 'reservation', null, null, null, '1');"
	),
	//医院联系方式默认值
	'Introduct_Sql' => array(
		"INSERT INTO `introduce` (`subject`,`pic`,`source`,`content`,`click_count`,`title`,`keywords`,`description`,`plushtime`) VALUES ('', null, null, '', '0', null, null, null, '0');",
	),
	//文章推荐位置默认值
	'Article_Sql' => array(
		"INSERT INTO `recommendposition` (`name`,`shortname`) VALUES ('首页头版头条', '');",
		"INSERT INTO `recommendposition` (`name`,`shortname`) VALUES ('首页头版列表', '');",
		"INSERT INTO `recommendposition` (`name`,`shortname`) VALUES ('首页疾病图文', '');",
		"INSERT INTO `recommendposition` (`name`,`shortname`) VALUES ('首页疾病列表', '');",
		"INSERT INTO `recommendposition` (`name`,`shortname`) VALUES ('科室头版头条', '');",
		"INSERT INTO `recommendposition` (`name`,`shortname`) VALUES ('科室头版列表', '');",
		"INSERT INTO `recommendposition` (`name`,`shortname`) VALUES ('科室疾病图文', '');",
		"INSERT INTO `recommendposition` (`name`,`shortname`) VALUES ('科室疾病列表', '');"
	),
	//积分规则
	'Rule_Sql' => array(
		"INSERT INTO `commodityrule` VALUES (1, '首次下载APP并登陆可获积分100个', 100, 0, '首次下载APP并登陆', 1);",
		"INSERT INTO `commodityrule` VALUES (2, '完善个人资料(姓名、电话)，获得积分', 100, 0, '完善个人资料', 1);",
		"INSERT INTO `commodityrule` VALUES (3, '使用微信/APP分享功能分享院内信息给他人，并激活链接', 10, 100, '微信/APP分享功能', 1);",
		"INSERT INTO `commodityrule` VALUES (4, '每日登陆可获积分', 10, 50, '每日登陆', 1);",
		"INSERT INTO `commodityrule` VALUES (5, '设置多少天连续登陆获得相应积分，', 100, 7, '连续登陆', 1);",
		"INSERT INTO `commodityrule` VALUES (6, '关注微信公众号的用户首次注册商城并登陆可获取积分', 100, 0, '微信首次注册并登录', 1);",
		"INSERT INTO `commodityrule` VALUES (7, '医院就诊后每消费一元可获得相应积分', 100, 0, '医院就诊消费', 1);"
	),
)
?>