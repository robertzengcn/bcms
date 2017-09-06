<?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 11:53:15
         compiled from "D:\wamp\www\newtemp\tpl\red\error.htpl" */ ?>
<?php /*%%SmartyHeaderCode:20864584e1f2b45aa44-59598849%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8504091bace03c056cf79cb2376282bace27a11' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\error.htpl',
      1 => 1470217312,
      2 => 'file',
    ),
    'bd669a52015bce59acc996f849868b1d1704015b' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\layout\\layout.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20864584e1f2b45aa44-59598849',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SEO_TITLE' => 0,
    'SEO_KEYWORDS' => 0,
    'SEO_DESCRIPTION' => 0,
    'RESOURCE' => 0,
    'layout_header' => 0,
    'layout_footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_584e1f2b65a646_32488409',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_584e1f2b65a646_32488409')) {function content_584e1f2b65a646_32488409($_smarty_tpl) {?><?php if (!is_callable('smarty_function_error')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.error.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_smarty_tpl->tpl_vars['SEO_TITLE']->value;?>
</title>
    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['SEO_KEYWORDS']->value;?>
" />
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['SEO_DESCRIPTION']->value;?>
" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/style/layout.css">
    
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/style/404.css">

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/MSClass.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery1.42.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/showtab.js"></script>
    
</head>
<body>
	<div class="wrapper">
		<!--head-->
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_header']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="clear"></div>
		<!-- center -->
		
  <div class="clear h8"></div>
  <!--404-->
  <div class="error bk">
    <div class="error_content">
      <?php echo smarty_function_error(array('id'=>($_smarty_tpl->tpl_vars['id']->value),'assign'=>"error"),$_smarty_tpl);?>

      <h2><?php echo $_smarty_tpl->tpl_vars['error']->value[0]->content;?>
...</h2>
      1.请检查您输入的地址是否正确; <br>
      2.如果您不能确认您输入的网址,请进入<a href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
">网站首页</a>浏览更多精彩文章。</div>
  </div>
  <!--footer-->
  <div class="clear h8"></div>

		<div class="clear"></div>
		<!-- footer -->
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_footer']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="clear"></div>
	</div>
</body>
</html><?php }} ?>