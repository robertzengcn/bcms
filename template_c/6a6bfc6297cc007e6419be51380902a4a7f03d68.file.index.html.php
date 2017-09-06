<?php /* Smarty version Smarty-3.1.8, created on 2016-11-17 09:40:29
         compiled from "D:/wamp/www/newtemp/app/Tpl/zzyy_app\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:27791582d0a8d989cc3-86492852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a6bfc6297cc007e6419be51380902a4a7f03d68' => 
    array (
      0 => 'D:/wamp/www/newtemp/app/Tpl/zzyy_app\\Index\\index.html',
      1 => 1453691557,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27791582d0a8d989cc3-86492852',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RESOURCE' => 0,
    'mobileNav' => 0,
    'nav' => 0,
    'i' => 0,
    'PicManagerTag' => 0,
    'LOGO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_582d0a8f11ddf4_69878332',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582d0a8f11ddf4_69878332')) {function content_582d0a8f11ddf4_69878332($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<link href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php echo $_smarty_tpl->getSubTemplate ("Common/right.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="background_box">
	<div class="background_1">
        <img class="background" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/icon2.png">   
        <span class="tooth">
        
         <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?> 
         <?php  $_smarty_tpl->tpl_vars['nav'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nav']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mobileNav']->value['ParNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nav']->key => $_smarty_tpl->tpl_vars['nav']->value){
$_smarty_tpl->tpl_vars['nav']->_loop = true;
?> 
        	<a href="<?php echo $_smarty_tpl->tpl_vars['nav']->value->url;?>
"><span class="btn<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['nav']->value->subject;?>
</span></a>
         <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
         <?php } ?> 
        </span>
            
        <div class="logo"> 
        <?php $_smarty_tpl->tpl_vars['LOGO'] = new Smarty_variable($_smarty_tpl->tpl_vars['PicManagerTag']->value->getMobilePic('appLogo','app'), null, 0);?> 
        <a><img class="logo" src="<?php echo $_smarty_tpl->tpl_vars['LOGO']->value->src;?>
" ></a></div>
    </div>
</div>
</body>
</html>
<?php }} ?>