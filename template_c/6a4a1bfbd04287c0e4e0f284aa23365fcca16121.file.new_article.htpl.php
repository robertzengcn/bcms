<?php /* Smarty version Smarty-3.1.8, created on 2017-01-24 17:38:02
         compiled from "D:\wamp\www\newtemp\tpl\red\common\right\common\new_article.htpl" */ ?>
<?php /*%%SmartyHeaderCode:239015887207adbb794-55464849%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a4a1bfbd04287c0e4e0f284aa23365fcca16121' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\right\\common\\new_article.htpl',
      1 => 1470217312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '239015887207adbb794-55464849',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ArticleTag' => 0,
    'articles' => 0,
    'v' => 0,
    'department' => 0,
    'disease' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5887207aee0756_76795361',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5887207aee0756_76795361')) {function content_5887207aee0756_76795361($_smarty_tpl) {?><?php if (!is_callable('smarty_function_department')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.department.php';
if (!is_callable('smarty_function_disease')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.disease.php';
if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\modifier.truncate.php';
?>
  <h3>最新资讯</h3>
    <div class="par_div par_hot">
      <ul>
        <?php $_smarty_tpl->tpl_vars['articles'] = new Smarty_variable($_smarty_tpl->tpl_vars['ArticleTag']->value->getNewest(9), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
        <?php echo smarty_function_department(array('id'=>$_smarty_tpl->tpl_vars['v']->value->department_id,'assign'=>"department"),$_smarty_tpl);?>

        <?php echo smarty_function_disease(array('id'=>$_smarty_tpl->tpl_vars['v']->value->disease_id,'assign'=>"disease"),$_smarty_tpl);?>

        <li>·<a target="_blank" href="<?php echo @NETADDRESS;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['disease']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
.html">
        <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['v']->value->subject,"10");?>
</a></li>
        <?php } ?>
      </ul>
    </div><?php }} ?>