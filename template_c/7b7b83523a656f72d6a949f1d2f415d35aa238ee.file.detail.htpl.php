<?php /* Smarty version Smarty-3.1.8, created on 2016-08-31 09:08:52
         compiled from "D:\wamp\www\newtemp\tpl\shangyu\ask\detail.htpl" */ ?>
<?php /*%%SmartyHeaderCode:2453157c62e248cb028-23076466%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b7b83523a656f72d6a949f1d2f415d35aa238ee' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\shangyu\\ask\\detail.htpl',
      1 => 1471752440,
      2 => 'file',
    ),
    '32f7529ea203c35a6c79f92ebbb5833f8153c0ba' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\shangyu\\common\\layout\\layout.htpl',
      1 => 1471941271,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2453157c62e248cb028-23076466',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SEO_TITLE' => 0,
    'SEO_KEYWORDS' => 0,
    'SEO_DESCRIPTION' => 0,
    'layout_header' => 0,
    'layout_footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c62e24b4f949_19367426',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c62e24b4f949_19367426')) {function content_57c62e24b4f949_19367426($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\modifier.truncate.php';
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $_smarty_tpl->tpl_vars['SEO_TITLE']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['SEO_KEYWORDS']->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['SEO_DESCRIPTION']->value;?>
" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<?php $_smarty_tpl->smarty->_tag_stack[] = array('picbyflag', array('flag'=>"logo2")); $_block_repeat=true; echo smarty_block_picbyflag(array('flag'=>"logo2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<link rel="alternate icon" type="image/png" href="[field:src]">
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_picbyflag(array('flag'=>"logo2"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<link href="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/css/zui.min.css" rel="stylesheet">
<!--页标题前图标-->
<!--<link href="fonts/1.1/iconfont.css" rel="stylesheet" type="text/css" />-->
<!--新增图标样式-->
<link href="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/style.css" rel="stylesheet" type="text/css" />
<!--框架样式-->
<link href="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/color.css" rel="stylesheet" type="text/css" />
<!--颜色样式-->
<link href="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/images.css" rel="stylesheet" type="text/css" />
<!--图片样式-->
<link href="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/font.css" rel="stylesheet" type="text/css" />
<!-- 下面这个css是新加的，后面要整到总的css里 -->
<link href="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/newadd.css" rel="stylesheet" type="text/css" />
<!--文字样式-->

<script type="text/javascript" src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/lib/jquery/jquery.js"></script><!--前置js 放在zui.js或zui.min.js之前-->
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/js/zui.min.js"></script>
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/js/new_js.js"></script>
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/reservation.js"></script>
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/reservation_base.js"></script>
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/date/WdatePicker.js"></script>
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/boyicms/search_start.js"></script>
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/js/readmore.min.js"></script>
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/js/Validform.min.js"></script>
<script type="text/javascript" src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/js/jquery.md5.js"></script> 
<!-- 下面这个是登录的js -->
<script src="<?php echo smarty_function_resource(array(),$_smarty_tpl);?>
/js/login.js"></script>


<!--新增js-->
</head>

<body>
    <!--head-->
    <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_header']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!-- center -->
    
<?php $_smarty_tpl->tpl_vars['obj'] = new Smarty_variable($_smarty_tpl->tpl_vars['tagOb']->value->get($_smarty_tpl->tpl_vars['id']->value), null, 0);?>
<ol class="breadcrumb container list_nav">您现在的位置：
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
"><i class="icon icon-home"></i> 首页</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/ask"> <i class="icon icon-home"></i>>医患交流</a></li>
        <li class="active">问答详情</li>
 </ol>


<div class="main_cont1 main_cont2 container">
	
	<div class="listdet_l col-xs-12 col-sm-9">
    	<h1><?php echo $_smarty_tpl->tpl_vars['obj']->value->subject;?>
</h1>
        <span class="listdet_sj"><?php echo $_smarty_tpl->tpl_vars['obj']->value->plushtime;?>
  提问者：<?php echo $_smarty_tpl->tpl_vars['obj']->value->name;?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['obj']->value->content;?>

        <span>　　回答时间：<?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['askInfo']->value->plushtime);?>
 -- 已结束</span><br/>
        
        <!-- <div class="listdet_xgyd">
        <h3><strong>推荐阅读</strong><a href="#" target="_blank">查看更多>></a></h3>
        <ul>
            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['NewsTag']->value->getList(1,10); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
        	<li class="col-xs-12 col-sm-6"><a class="col-xs-7" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['v']->value->subject,15);?>
</a><span class="col-xs-5">「<?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['obj']->value->plushtime);?>
」</span></li>
            <?php } ?>
        </ul>
        </div> -->
    </div> 
    <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_right']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>

    <!-- footer -->
    <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_footer']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>




</body>
</html>
<?php }} ?>