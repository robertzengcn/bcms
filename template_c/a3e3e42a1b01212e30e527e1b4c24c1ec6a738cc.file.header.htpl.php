<?php /* Smarty version Smarty-3.1.8, created on 2016-08-31 09:08:51
         compiled from "D:\wamp\www\newtemp\tpl\shangyu\common\layout\header.htpl" */ ?>
<?php /*%%SmartyHeaderCode:871757c62e23dd7d49-03767399%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\shangyu\\common\\layout\\header.htpl',
      1 => 1472003985,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '871757c62e23dd7d49-03767399',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c62e23f18291_05803588',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c62e23f18291_05803588')) {function content_57c62e23f18291_05803588($_smarty_tpl) {?><div class="header">
  <div class="head_top">
    <div class="container">
      <div class="pull-left"><a href="/index.html">网站首页</a>
        <p class="text-muted">|&nbsp;&nbsp;&nbsp;欢迎访问<?php $_smarty_tpl->smarty->_tag_stack[] = array('contactlist', array('flag'=>'name')); $_block_repeat=true; echo smarty_block_contactlist(array('flag'=>'name'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
[field:val/]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_contactlist(array('flag'=>'name'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
官方网站</p>
        <a href="#" data-toggle="modal" data-target="#register">请登录</a> | <a href="/register/index.html">新用户注册</a></div>
      <div class="pull-right"><a href="/mobile">手机版</a>|<a href="/app">APP版</a></div>
    </div>
  </div>
  <div class="head_logo">
    <div class="container">
      <div class="col-xs-12 col-sm-5 pull-left">
      <?php $_smarty_tpl->smarty->_tag_stack[] = array('logopic', array()); $_block_repeat=true; echo smarty_block_logopic(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<img src="[field:src/]"><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_logopic(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>
      <div class="col-xs-12 col-sm-5 pull-right input-group">
        <form class="" role="search">
          <input name="keyword" id="keyword" value="" class="form-control"  placeholder="输入关键词" type="text">
          <span class="input-group-addon">
          <button type="button" id="save" class="">搜索</button>
          </span>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- 导航 -->
<div id="nav">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="collapse navbar-collapse" id="navbar_collapse">
        <ul id="jsddm" class="nav navbar-nav nav-justified">
           <?php $_smarty_tpl->smarty->_tag_stack[] = array('navbylimit', array('order'=>"cate asc,sort asc",'cate'=>"1",'children'=>"true",'pid'=>"0",'is_display'=>"1",'limit'=>"11")); $_block_repeat=true; echo smarty_block_navbylimit(array('order'=>"cate asc,sort asc",'cate'=>"1",'children'=>"true",'pid'=>"0",'is_display'=>"1",'limit'=>"11"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

          <li class="mainlevel"><a href="[field:url/]" target="_self">[field:subject/]</a> <span class="sub_menu">
            <ul style="display: none;" class="container">
              [children]
              <li><a href="[children:url/]" target="_blank">[children:subject/]</a></li>
              [/children]
            </ul>
            </span> </li>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_navbylimit(array('order'=>"cate asc,sort asc",'cate'=>"1",'children'=>"true",'pid'=>"0",'is_display'=>"1",'limit'=>"11"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </ul>
      </div>
    </nav>
  </div>
</div>
<script type="text/javascript"> 
    var has_slide = '0';
    
    $(document).ready(function(){
        $('#jsddm li.mainlevel').mouseenter(function(){
            if(has_slide == 1){
                $(this).find('ul').slideDown("fast");
            }else{
                $(this).find('ul').show();
            }
        });
        $('#jsddm li.mainlevel').mouseleave(function(){
            if(has_slide == 1){
                $(this).find('ul').slideUp("fast");
            }else{
                $(this).find('ul').hide();
            }
        });
    });
    
</script>
<!-- 对话框HTML -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
          <h3 class="modal-title">请登录</h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="post" id="loginform">
			<div style="display: none;" id="errmsg" class="alert alert-danger"></div>
            <div class="form-group">
            	<div class="col-xs-12"><input class="form-control" name="tmobile" placeholder="手机号" datatype="m" errormsg="手机号码不正确" type="text"></div>
            </div>
            <div class="form-group">
            	<div class="col-xs-12"><input class="form-control" name="tpassword" placeholder="密码" type="password" datatype="*6-18" nullmsg="密码不能为空！"></div>
            </div>
            <div class="form-group" id="checkcode">
             
            </div>

            <div class="form-group">
            <div class="col-xs-12">
            	<button class="btn" type="button" id="losubmit">登录</button>
                <span class="pull-right">没有帐号？<a href="/home.php?mod=register" target="_blank">立即注册</a></span>
            </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
















<?php }} ?>