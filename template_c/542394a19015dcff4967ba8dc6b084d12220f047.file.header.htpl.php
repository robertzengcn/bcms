<?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 11:53:15
         compiled from "D:\wamp\www\newtemp\tpl\red\common\layout\header.htpl" */ ?>
<?php /*%%SmartyHeaderCode:18271584e1f2b6f2be1-96700603%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '542394a19015dcff4967ba8dc6b084d12220f047' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\layout\\header.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18271584e1f2b6f2be1-96700603',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PicManagerTag' => 0,
    'logoInfo' => 0,
    'UPLOAD' => 0,
    'nav' => 0,
    'WEBSITE' => 0,
    'v' => 0,
    'ContactTag' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_584e1f2b8a45c9_22202270',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_584e1f2b8a45c9_22202270')) {function content_584e1f2b8a45c9_22202270($_smarty_tpl) {?><!--top-->
<div class="wrapper">
    <?php $_smarty_tpl->tpl_vars['logoInfo'] = new Smarty_variable($_smarty_tpl->tpl_vars['PicManagerTag']->value->getPic('topPic'), null, 0);?>
    <div id="banner"><a href="<?php echo $_smarty_tpl->tpl_vars['logoInfo']->value->link;?>
">
    <img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['logoInfo']->value->img;?>
" /></a></div>
    <!--nav-->
    <?php echo smarty_function_navigations(array('order'=>"cate asc,sort asc",'limit'=>"9",'pid'=>"0",'cate'=>"1",'is_display'=>"1",'assign'=>"nav"),$_smarty_tpl);?>

    <div id="nav">
        <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['nav']->value), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['nav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value->url;?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['v']->value->pic;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['v']->value->subject;?>
"/></a></li>
        <?php } ?>
    </div>
<!--nav-->
<div class="bar-center" id="bar_center">
    <?php echo $_smarty_tpl->tpl_vars['PicManagerTag']->value->getSpecial('one');?>

</div>
<div class="bar-right" id="bar_right">
    <?php echo $_smarty_tpl->tpl_vars['PicManagerTag']->value->getSpecial('three');?>

</div>
<!--subnav-->
<div id="search" class="diseasenav">
    <div class="search-left">
    <span class="search-tel"><span class="color">24小时</span>专家热线：<span class="color"><?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('tel');?>
</span></span>
    <?php echo smarty_function_navigations(array('order'=>"cate asc,sort asc",'limit'=>"6",'pid'=>"0",'cate'=>"2",'is_display'=>"1",'assign'=>"nav"),$_smarty_tpl);?>

    <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['nav']->value), null, 0);?>
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['nav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
    <a href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value->subject;?>
</a>|
    <?php } ?>
    </div>
</div>








<?php }} ?>