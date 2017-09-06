<?php /* Smarty version Smarty-3.1.8, created on 2016-09-19 13:54:34
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/man\Common\header.html" */ ?>
<?php /*%%SmartyHeaderCode:2832757df7d9a129ac5-42878452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa2d44d13c4abaa3cb285dc468e365cee243fe08' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/man\\Common\\header.html',
      1 => 1463366749,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2832757df7d9a129ac5-42878452',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WEBTITLE' => 0,
    'RESOURCE' => 0,
    'LOGO' => 0,
    'PicManagerTag' => 0,
    'logo' => 0,
    'MOBILE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57df7d9a21be01_85486182',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57df7d9a21be01_85486182')) {function content_57df7d9a21be01_85486182($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes">
    <title><?php echo $_smarty_tpl->tpl_vars['WEBTITLE']->value;?>
</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/css/style.css">
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery-1.7.2.min.js"></script>
    <link href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/css/m-mobile-style.css" charset="utf-8" type="text/css" rel="stylesheet">
    <script src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/CheckInvitejs.aspx.htm" type="text/javascript"></script>
</head>

<body>

<!--头部 -->
<!-- <div id="top">
    <div class="logo"><a name="huitou" id="huitou"></a><a href="/mobile/index.php"><img src="<?php echo $_smarty_tpl->tpl_vars['LOGO']->value;?>
" height="50" width="320"></a></div>
    <div class="subLink fz">
        <a href="/mobile/index.php">医院首页</a>
        <a href="/mobile/doctor.php">专家团队</a>
        <a href="/mobile/article.php">疾病资讯</a>
        <a href="/mobile/success.php">康复案例</a>
    </div>
</div> -->
<div id="top" >
<?php $_smarty_tpl->tpl_vars['logo'] = new Smarty_variable($_smarty_tpl->tpl_vars['PicManagerTag']->value->getMobilePic("mobileLogo","mobile"), null, 0);?>
	  <div class="logo"><a name="huitou" id="huitou"></a><a href="/mobile/index.php"><img src="/upload/<?php echo $_smarty_tpl->tpl_vars['logo']->value->img;?>
" height="50" width="320"></a></div>
	  <div class="subLink fz" >
		   <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/introduce.php?method=getInfo">医院简介</a>
		   <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/news.php">新闻动态</a>
		   <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/success.php">康复案例</a>
		   <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/technology.php">特色技术</a>
		    <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/doctor.php">专家团队</a>
	  
		   <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/honor.php">医院荣誉</a>
		   <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/reservation.php?method=form">预约挂号</a>
		   <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/contact.php?method=getRoute">来院路线</a>
	</div>
</div><?php }} ?>