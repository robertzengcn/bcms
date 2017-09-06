<?php /* Smarty version Smarty-3.1.8, created on 2017-01-24 17:38:03
         compiled from "D:\wamp\www\newtemp\tpl\red\ask\detail.htpl" */ ?>
<?php /*%%SmartyHeaderCode:214115887207bec5565-87185189%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea196688d6ed32170ac69b00da296637b13acecc' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\ask\\detail.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
    'bd669a52015bce59acc996f849868b1d1704015b' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\layout\\layout.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
    '09ed719298667911a9009702f3d922db278928cf' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\public\\tiwen.htpl',
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
  'nocache_hash' => '214115887207bec5565-87185189',
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
  'unifunc' => 'content_5887207c294499_41265485',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5887207c294499_41265485')) {function content_5887207c294499_41265485($_smarty_tpl) {?><?php if (!is_callable('smarty_function_doctor')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.doctor.php';
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
/style/ask.css">

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
		
  <div id="breadcrumb"><span>您现在的位置：<a href='<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
</a>>
            <a href='<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/ask/'>专家答疑</a>>
            <a>文章详情</a></span></div>
  <div class="clear h8"></div>
  <!--��-->
  <div class="main">
   <?php $_smarty_tpl->tpl_vars['askInfo'] = new Smarty_variable($_smarty_tpl->tpl_vars['AskTag']->value->get($_smarty_tpl->tpl_vars['id']->value), null, 0);?>
    <div class="par-main">
      <h2><span>专家答疑</span></h2>
      <div class="ask-par">
        <h3 class="bg1"><span>提问于：<?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['askInfo']->value->plushtime);?>
</span><?php echo $_smarty_tpl->tpl_vars['askInfo']->value->department_name;?>
</h3>
        <div><?php echo $_smarty_tpl->tpl_vars['askInfo']->value->description;?>
</div>
          <?php if ($_smarty_tpl->tpl_vars['askInfo']->value->isanswer!=0){?>
          <?php echo smarty_function_doctor(array('name'=>$_smarty_tpl->tpl_vars['askInfo']->value->doctor_name),$_smarty_tpl);?>

        <h3 class="bg2"><span>解答于：<?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['askInfo']->value->plushtime);?>
</span><a href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/doctor/<?php echo $_smarty_tpl->tpl_vars['doctor']->value->id;?>
.html"><?php echo $_smarty_tpl->tpl_vars['doctor']->value->name;?>
</a></h3>
        <div> <?php echo $_smarty_tpl->tpl_vars['askInfo']->value->content;?>
</div>
          <?php }?>
      </div>
      <div class="femind">若您仍有疑问，请与在线医生进行<a href="<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('swt');?>
">即时沟通 >></a></div>
        <div class="ask-tab"><div></div><p>
            您好，这里是<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
在线专家答疑，留下您的问题，我们的专家会对您的问题尽快进行回复，感谢您对
            <?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
的信任！<strong>健康热线：<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('tel');?>

            </strong>
            </p>
        </div>

        <!--���ʱ?begin-->
        <?php /*  Call merged included template "../common/public/tiwen.htpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("../common/public/tiwen.htpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '214115887207bec5565-87185189');
content_5887207c1e47f0_67052175($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "../common/public/tiwen.htpl" */?>
        <!--���ʱ?end-->
    </div>
    <!--right-->
      <?php /*  Call merged included template "../common/right/doctor_right.htpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("../common/right/doctor_right.htpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '214115887207bec5565-87185189');
content_5887207c22eb89_85219464($_smarty_tpl);
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
</html><?php }} ?><?php /* Smarty version Smarty-3.1.8, created on 2017-01-24 17:38:04
         compiled from "D:\wamp\www\newtemp\tpl\red\common\public\tiwen.htpl" */ ?>
<?php if ($_valid && !is_callable('content_5887207c1e47f0_67052175')) {function content_5887207c1e47f0_67052175($_smarty_tpl) {?><div class="clear h8"></div>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery1.42.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/ask.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/ask_base.js"></script>

<div  class="ask-wrap">
    <form id="ask_form" name="addcontent" action="/controller" method="get">
        <div>姓名：<input type="text" class="ask-input1" name="name" value=""/></div>
        <div>年龄：<input type="text" class="ask-input1" name="age" value=""/></div>
        <div>性别：<input type="radio" name="gender" value="1" />男
            <input type="radio" name="gender" value="0" checked="checked"/>女
        </div>
        <div>标题：<input type="text" class="ask-input2" name="subject" value=""/></div>
        <div>疾病：<select name="departmentID"><option>请选择科室</option></select>
            <select name="diseaseID"><option>请选择疾病</option></select></div>
        <div class="content">内容：<textarea name="description">请输入问题详细描述</textarea>
        </div>

        <div class="btn">
            <input type="submit" id="ask_submit" value="提 交" />
            <input type="reset"  id="ask_reset"  value="重 置" class="btn2"/>
        </div>
    </form>
   </div><?php }} ?><?php /* Smarty version Smarty-3.1.8, created on 2017-01-24 17:38:04
         compiled from "D:\wamp\www\newtemp\tpl\red\common\right\doctor_right.htpl" */ ?>
<?php if ($_valid && !is_callable('content_5887207c22eb89_85219464')) {function content_5887207c22eb89_85219464($_smarty_tpl) {?><!--right-->

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