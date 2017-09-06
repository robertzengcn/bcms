<?php /* Smarty version Smarty-3.1.8, created on 2016-09-19 13:54:33
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/man\Ask\index.html" */ ?>
<?php /*%%SmartyHeaderCode:608157df7d99d66719-98542458%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ceb463ca304cb8c79346c6e4c2071dc3a0531bb5' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/man\\Ask\\index.html',
      1 => 1452244017,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '608157df7d99d66719-98542458',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WEBTITLE' => 0,
    'RESOURCE' => 0,
    'MOBILE' => 0,
    'department' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57df7d9a043311_64606000',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57df7d9a043311_64606000')) {function content_57df7d9a043311_64606000($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="format-detection" content="telephone=no"/>
    <title>在线咨询_<?php echo $_smarty_tpl->tpl_vars['WEBTITLE']->value;?>
</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- style -->
    <?php echo $_smarty_tpl->getSubTemplate ("Common/common.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <style type="text/css">
        .txtList{height:27px;border-bottom:1px solid #d8d8d8; background:url(<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/txtListBg.png) repeat-x;border-bottom:1px solid #d8d8d8;border-top:1px solid #EAEAEA; }
        .txtList p{height:27px;line-height:30px;background:url(<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/spritr.png) no-repeat 8px -130px;padding-left:30px; }
        .txtList p a,.txtList p{color:#949494;}
        .content{ text-align: center;}
        .form1{width: 60%;float:left;text-align:left;}
        .form1 p{line-height: 60px}
        .textarea1{width: 100%;min-height: 50px}
        .textarea1 textarea{width:350px;min-height: 50px}
        .ask-input1{background:#f4f4f4; border:1px solid #d2d2d2; box-shadow: 0 2px 2px -2px #DDD inset; border-radius:4px; height:34px; line-height:34px; width:300px; padding:0 10px;}
        .ask-text{background:#f4f4f4; border:1px solid #d2d2d2; box-shadow: 0 2px 2px -2px #DDD inset; border-radius:4px; height:34px; line-height:60px; width:100%; padding:0 10px;}
        .ask-input2{background:#f4f4f4; border:1px solid #d2d2d2;height: 20px;width: 20px}
        .btn{clear:both;margin-left:100px;padding-top:30px;padding-bottom: 20px}
        .btn .submitBtn{ width:83px; height:34px; background:url(<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/bg2.png) no-repeat; border:none 0; text-indent:-99988px;}
    </style>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/ask.js"></script>
</head>
<body>
<a name="top"></a>
<div class="main" id="main_id">
    <div id="scroller">
        <!-- header -->
        <?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

       <!--  <div class="txtList"><p><a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
">首页</a> &gt; 在线咨询</p></div> -->
       <div class="crumb">当前位置：<a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
" >主页</a>&gt; <a href="">在线咨询</a></div>
       <!--  <div class="content">
            <div style="width: 20%;min-height: 300px;float:left"></div>
            <div class="form1">
            <form id="ask_form" name="addcontent" onsubmit="return check();" >
                <input type="hidden" name="method" value="save" />
                <p>姓名：<input type="text" class="ask-input1" name="name" value=""></p>
                <p>年龄：<input type="text" class="ask-input1" name="age" value=""></p>
                <p>性别：<input type="radio" class="ask-input2" style="width:20px;color:black;" name="gender" value="1" checked="checked"/><label>男</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="ask-input2" style="width:20px;color:black;" name="gender" value="0" /><label>女</label>
                </p>
                <p>标题：<input type="text" class="ask-input1" name="subject" value=""></p>
                <p>科室：<select class="ask-input1" name="departmentID" style="width:130px;">
                    <option value="0">请选择科室</option>
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['department']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
</option>
                    <?php } ?>
                    </select>
                <p>疾病：<select class="ask-input1" name="diseaseID" style="width:130px;"></select></p>
                内容:&nbsp; 
                <div class="textarea1">
                    	<textarea class="ask-text" name="description" style="height:100px;"></textarea>
                </div>
                <div class="btn">
                    <input class="submitBtn" id="submitBtn" type="submit" value="提 交" >
                </div>
            </form>
            </div>
            <div style="width: 20%;min-height:300px;float: left"></div>
        </div> -->
        <!-- foot_nav -->
        <?php echo $_smarty_tpl->getSubTemplate ("Common/foot_nav.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!-- footer -->
        <?php echo $_smarty_tpl->getSubTemplate ("Common/bootom_ph.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>
</div>
</body>
</html><?php }} ?>