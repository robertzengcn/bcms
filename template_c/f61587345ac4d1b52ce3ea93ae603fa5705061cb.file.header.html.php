<?php /* Smarty version Smarty-3.1.8, created on 2017-05-27 15:44:21
         compiled from "D:\wamp\www\newtemp\template_c\commonHtml\header.html" */ ?>
<?php /*%%SmartyHeaderCode:2100157c62e24bc0de8-01876249%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f61587345ac4d1b52ce3ea93ae603fa5705061cb' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\template_c\\commonHtml\\header.html',
      1 => 1495871060,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2100157c62e24bc0de8-01876249',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c62e24be01e6_42740664',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c62e24be01e6_42740664')) {function content_57c62e24be01e6_42740664($_smarty_tpl) {?><div class="header">
  <div class="head_top">
    <div class="container">
      <div class="pull-left"><a href="/index.html">网站首页</a>
        <p class="text-muted">|&nbsp;&nbsp;&nbsp;欢迎访问发士大夫撒大哥士大夫大师官方网站</p>
        <a href="#" data-toggle="modal" data-target="#register">请登录</a> | <a href="/register/index.html">新用户注册</a></div>
      <div class="pull-right"><a href="/mobile">手机版</a>|<a href="/app">APP版</a></div>
    </div>
  </div>
  <div class="head_logo">
    <div class="container">
      <div class="col-xs-12 col-sm-5 pull-left">
      <img src="http://www.newtemp.com/upload/picmanager/Logo.png"></div>
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
           <br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>169</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.3800</td><td bgcolor='#eeeeec' align='right'>10023248</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>169</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.3910</td><td bgcolor='#eeeeec' align='right'>10023744</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>169</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.3980</td><td bgcolor='#eeeeec' align='right'>10023944</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>169</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.4040</td><td bgcolor='#eeeeec' align='right'>10024248</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>163</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.4090</td><td bgcolor='#eeeeec' align='right'>10040896</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>163</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.4220</td><td bgcolor='#eeeeec' align='right'>10041648</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>169</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.4280</td><td bgcolor='#eeeeec' align='right'>10042416</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>169</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.4330</td><td bgcolor='#eeeeec' align='right'>10042672</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>163</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.4380</td><td bgcolor='#eeeeec' align='right'>10059232</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>169</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.4450</td><td bgcolor='#eeeeec' align='right'>10060288</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined offset: 0 in D:\wamp\www\newtemp\tagobj\cusplugins\common.php on line <i>169</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0010</td><td bgcolor='#eeeeec' align='right'>275464</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608232</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0060</td><td bgcolor='#eeeeec' align='right'>610712</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0090</td><td bgcolor='#eeeeec' align='right'>1003872</td><td bgcolor='#eeeeec'>MakeHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.1280</td><td bgcolor='#eeeeec' align='right'>6310640</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\MakeHtmlController.php' bgcolor='#eeeeec'>..\MakeHtmlController.php<b>:</b>17</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>0.1300</td><td bgcolor='#eeeeec' align='right'>6312928</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>0.2390</td><td bgcolor='#eeeeec' align='right'>9778464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>0.2530</td><td bgcolor='#eeeeec' align='right'>9845824</td><td bgcolor='#eeeeec'>content_57c62e23f18291_05803588(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>0.3210</td><td bgcolor='#eeeeec' align='right'>9914384</td><td bgcolor='#eeeeec'>smarty_block_navbylimit(  )</td><td title='D:\wamp\www\newtemp\template_c\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php' bgcolor='#eeeeec'>..\a3e3e42a1b01212e30e527e1b4c24c1ec6a738cc.file.header.htpl.php<b>:</b>68</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>0.3700</td><td bgcolor='#eeeeec' align='right'>10013232</td><td bgcolor='#eeeeec'>formatReturnData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\block.navigation.php' bgcolor='#eeeeec'>..\block.navigation.php<b>:</b>297</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>0.4500</td><td bgcolor='#eeeeec' align='right'>10060512</td><td bgcolor='#eeeeec'>formatChildrenData(  )</td><td title='D:\wamp\www\newtemp\tagobj\cusplugins\common.php' bgcolor='#eeeeec'>..\common.php<b>:</b>88</td></tr>
</table></font>
          <li class="mainlevel"><a href="http://www.newtemp.com/" target="_self">人流首页</a> <span class="sub_menu">            <ul style="display: none;" class="container">                          </ul>            </span> </li>                      <li class="mainlevel"><a href="http://www.newtemp.com/index.html" target="_self">首页</a> <span class="sub_menu">            <ul style="display: none;" class="container">                          </ul>            </span> </li>                      <li class="mainlevel"><a href="" target="_self">科室介绍</a> <span class="sub_menu">            <ul style="display: none;" class="container">                          </ul>            </span> </li>                      <li class="mainlevel"><a href="http://www.newtemp.comhospital/introduce.html" target="_self">医院概况</a> <span class="sub_menu">            <ul style="display: none;" class="container">                          </ul>            </span> </li>                      <li class="mainlevel"><a href="http://www.newtemp.com/yiyuangaikuang/" target="_self">医院概况</a> <span class="sub_menu">            <ul style="display: none;" class="container">              
              <li><a href="/yiyuangaikuang" target="_blank">频道首页</a></li>                            <li><a href="/hospital/introduce.html" target="_blank">医院简介</a></li>                            <li><a href="/yiyuanwenhua" target="_blank">医院文化</a></li>                            <li><a href="/hospital/environment" target="_blank">精彩图集</a></li>                            <li><a href="/contact.html" target="_blank">医院地址</a></li>                          </ul>            </span> </li>                      <li class="mainlevel"><a href="http://www.newtemp.com/xinwenzhongxin/" target="_self">新闻中心</a> <span class="sub_menu">            <ul style="display: none;" class="container">              
              <li><a href="/xinwenzhongxin" target="_blank">频道首页</a></li>                            <li><a href="/hospital/news" target="_blank">三院新闻</a></li>                            <li><a href="/yiyuangonggao" target="_blank">医院公告</a></li>                            <li><a href="/hospital/media" target="_blank">媒体报告</a></li>                            <li><a href="/xueshuhuiyi" target="_blank">学术会议</a></li>                          </ul>            </span> </li>                      <li class="mainlevel"><a href="http://www.newtemp.comhttp://www.newsite.com/doctor/1.html" target="_self">人流新闻</a> <span class="sub_menu">            <ul style="display: none;" class="container">                          </ul>            </span> </li>                      <li class="mainlevel"><a href="http://www.newtemp.comhospital/news/index.html" target="_self">新闻动态</a> <span class="sub_menu">            <ul style="display: none;" class="container">                          </ul>            </span> </li>                      <li class="mainlevel"><a href="" target="_self">为您服务</a> <span class="sub_menu">            <ul style="display: none;" class="container">              
              <li><a href="/menzhenshijian" target="_blank">门诊时间</a></li>                            <li><a href="jiuzhenxuzhi" target="_blank">就诊须知</a></li>                            <li><a href="/technology" target="_blank">特色专科</a></li>                            <li><a href="/sitemap.html" target="_blank">医院导航</a></li>                            <li><a href="/yuyueguahao" target="_blank">预约挂号</a></li>                            <li><a href="/jiankangtijian" target="_blank">健康体检</a></li>                            <li><a href="/jianchadan" target="_blank">检查单查询</a></li>                            <li><a href="/ask" target="_blank">医患交流</a></li>                            <li><a href="/yijianjianyi" target="_blank">意见建议</a></li>                          </ul>            </span> </li>                      <li class="mainlevel"><a href="" target="_self">专家团队</a> <span class="sub_menu">            <ul style="display: none;" class="container">                          </ul>            </span> </li>                      <li class="mainlevel"><a href="" target="_self">人流技术</a> <span class="sub_menu">            <ul style="display: none;" class="container">                          </ul>            </span> </li>            
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