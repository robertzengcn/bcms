<?php /* Smarty version Smarty-3.1.8, created on 2017-05-11 16:48:10
         compiled from "D:\wamp\www\newtemp\tpl\red\disease\list.htpl" */ ?>
<?php /*%%SmartyHeaderCode:254455914254ad9c5a5-16847926%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '776b6fd0d960089ec055effc3da359ef2f27e101' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\disease\\list.htpl',
      1 => 1470217312,
      2 => 'file',
    ),
    'bd669a52015bce59acc996f849868b1d1704015b' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\layout\\layout.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
    '63d3afb5841526e82116ca4114025822248dbf35' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\right\\doctor_right.htpl',
      1 => 1470217312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '254455914254ad9c5a5-16847926',
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
  'unifunc' => 'content_5914254b274f16_67889281',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5914254b274f16_67889281')) {function content_5914254b274f16_67889281($_smarty_tpl) {?><?php if (!is_callable('smarty_function_article')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.article.php';
if (!is_callable('smarty_function_department')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.department.php';
if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\modifier.truncate.php';
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
/style/list.css">

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
		
  <div id="breadcrumb"><span>您当前位置：<a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
</a>>
    <a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/'><?php echo $_smarty_tpl->tpl_vars['department']->value->name;?>
</a> >
    <a target="_blank" ><?php echo $_smarty_tpl->tpl_vars['disease']->value['name'];?>
</a></span></div>
  <div class="clear h8"></div>
  <!--��-->
  <div class="main">
    <?php echo smarty_function_articlesInDisease(array('page'=>($_smarty_tpl->tpl_vars['cur']->value),'diseaseId'=>($_smarty_tpl->tpl_vars['id']->value),'departmentId'=>($_smarty_tpl->tpl_vars['department_id']->value)),$_smarty_tpl);?>

    <div class="par-main">
      <?php echo smarty_function_article(array('id'=>$_smarty_tpl->tpl_vars['id']->value,'assign'=>"article"),$_smarty_tpl);?>

      <h2><span>文章列表</span></h2>
       <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articlesInDisease']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
       <?php echo smarty_function_department(array('id'=>$_smarty_tpl->tpl_vars['v']->value->department_id,'assign'=>"department"),$_smarty_tpl);?>

      <div class="article-list"><h4><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
.html"><?php echo $_smarty_tpl->tpl_vars['v']->value->subject;?>
</a></h4>
        <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['v']->value->description,"60");?>
...<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
.html">[详细]</a></p>
      </div>
       <?php } ?>
      <div class="fenye"><?php echo $_smarty_tpl->tpl_vars['tagOb']->value->getPageHtml($_smarty_tpl->tpl_vars['cur']->value,$_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['adir']->value);?>
</div>
    </div>
    <!--right-->
      <?php /*  Call merged included template "../common/right/doctor_right.htpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("../common/right/doctor_right.htpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '254455914254ad9c5a5-16847926');
content_5914254b1f01f2_95200357($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "../common/right/doctor_right.htpl" */?>
    <!--right end-->
  </div>
  <div class="main-bottom"></div>
  <!--footer-->
  <div class="clear h8"></div>

		<div class="clear"></div>
		<!-- footer -->
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_footer']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="clear"></div>
	</div>
</body>
</html><?php }} ?><?php /* Smarty version Smarty-3.1.8, created on 2017-05-11 16:48:11
         compiled from "D:\wamp\www\newtemp\tpl\red\common\right\doctor_right.htpl" */ ?>
<?php if ($_valid && !is_callable('content_5914254b1f01f2_95200357')) {function content_5914254b1f01f2_95200357($_smarty_tpl) {?><!--right-->

<div class="w235">
        <!--特色技术-->
        <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['right_technology']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!--专家在线-->
    	<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['right_doctor']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!--预约-->
    	<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['right_reservation']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!--答疑-->
    	<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['right_ask']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<!--right end--><?php }} ?>