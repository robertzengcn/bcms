<?php /* Smarty version Smarty-3.1.8, created on 2016-12-16 14:45:42
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/man\Article\list.html" */ ?>
<?php /*%%SmartyHeaderCode:1101558538d96491595-50555584%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de1acdc580ce0f5faf4d72a9b5b924c1fd71f34e' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/man\\Article\\list.html',
      1 => 1452244017,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1101558538d96491595-50555584',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RESOURCE' => 0,
    'MOBILE' => 0,
    'list' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_58538d966a8893_40345271',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58538d966a8893_40345271')) {function content_58538d966a8893_40345271($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/common\\modifier.truncate.php';
?><?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<link href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/css/yangshi.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/function.js"></script>

</div>

<!--栏目开始 -->

<!-- <div class="lanmu1"><h2>疾病资讯</h2></div> -->
<div class="crumb">当前位置：<a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
">主页</a> &gt; <a href="">疾病资讯</a></div>
<div class="liebiao">
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
    <div class="liebiao1">
        <h3><a href="/mobile/article.php?method=get&id=<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><b><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</b></a></h3>
        <p><a href="/mobile/article.php?method=get&id=<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->description,28);?>
</a>...</p>
    </div>
    <?php } ?>
</div>
<div class="fenye">
    <?php echo $_smarty_tpl->getSubTemplate ("Common/page.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<?php echo $_smarty_tpl->getSubTemplate ("Common/bootom_ph.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>