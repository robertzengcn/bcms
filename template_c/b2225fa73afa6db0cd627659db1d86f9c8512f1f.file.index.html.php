<?php /* Smarty version Smarty-3.1.8, created on 2017-05-27 15:41:38
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/shangyu\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1396059292db24bb556-13835738%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2225fa73afa6db0cd627659db1d86f9c8512f1f' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/shangyu\\Index\\index.html',
      1 => 1490684856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1396059292db24bb556-13835738',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PicManagerTag' => 0,
    'logo' => 0,
    'pic' => 0,
    'v' => 0,
    'NavigationTag' => 0,
    'nav' => 0,
    'RESOURCE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_59292db299d671_46874130',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59292db299d671_46874130')) {function content_59292db299d671_46874130($_smarty_tpl) {?><!doctype html>
<html class="no-js">
<?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器 UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>  以获得更好的体验！</p>
<![endif]-->

<!--首页页眉-->
  <header data-am-widget="header" class="am-header home_header ">
      <div class="am-header-left am-header-nav">
          <a href="#left-link" class="" data-am-offcanvas="{target: '#navPush', effect: 'push'}">
            <i class="am-header-icon am-icon-th-list"></i>
          </a>
      </div>
<?php $_smarty_tpl->tpl_vars['logo'] = new Smarty_variable($_smarty_tpl->tpl_vars['PicManagerTag']->value->getMobilePic("mobileLogo","mobile"), null, 0);?>
      <h1 class="am-header-title">
          <img src="<?php echo @UPLOAD;?>
<?php echo $_smarty_tpl->tpl_vars['logo']->value->img;?>
" />
      </h1>

      <div class="am-header-right am-header-nav">
          <a href="javascript:void(0);" class="" id="searchshow">
          	<i class="am-header-icon am-icon-search"></i>
          </a>
      </div>
      
<form class="am-topbar-form am-topbar-left am-form-inline am-animation-slide-top am-animation-delay-1 am-u-sm-12 home_search am-hide" id="searchform" role="search">
        <div class="am-form-group am-u-sm-12">
          <input type="text" class="am-form-field am-input-sm am-radius am-u-sm-12" id="searchinput" placeholder="搜索">
          <button type="button" class="am-close" id="closeform">&times;</button>
        </div>
      </form>
      
  </header>
  

<!-- 侧边栏内容 -->
<div id="navPush" class="am-offcanvas nav-push-content">
  <div class="am-offcanvas-bar">
    <div class="am-offcanvas-content">
      <ul class="am-menu am-menu-offcanvas1  menu-main am-no-layout">
      
        <li><a href="#" data-am-modal="{target: '#my-share'}"><i class="am-icon-share-alt"></i>分享到</a></li>
        <li><a href="/mobile/feedback.php"><i class="am-icon-envelope"></i>建议反馈</a></li>
        <li><a href="tel:<?php echo smarty_function_contactinfo(array('flag'=>"tel"),$_smarty_tpl);?>
"><i class="am-icon-phone"></i>热线电话</a></li>
        <li><a href="/mobile/introduce.php"><i class="am-icon-group"></i>关于我们</a></li>
 
      </ul>
    </div>
  </div>
</div>

<!--横幅-->
<div data-am-widget="slider" class="am-slider am-slider-c2 home_banner" data-am-slider='{"directionNav":false}' >
  <ul class="am-slides">
  
   <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pic']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>  
      <li>
        	<a href="<?php echo $_smarty_tpl->tpl_vars['v']->value->url;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['v']->value->pic;?>
"></a>
          
      </li>
    <?php } ?>
  </ul>
</div>
<?php $_smarty_tpl->tpl_vars['nav'] = new Smarty_variable($_smarty_tpl->tpl_vars['NavigationTag']->value->getMobileGroup('mobile_nav'), null, 0);?>

<!--首页导航-->
<div data-am-widget="tabs" class="am-tabs am-tabs-default home_nav" >
    <div class="am-tabs-bd">
        <ul data-tab-panel-0 class="am-tab-panel am-active">
        
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['navone'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['name'] = 'navone';
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['nav']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['max'] = (int)9;
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['show'] = true;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['max'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['navone']['total']);
?>
          <li><a href="<?php echo $_smarty_tpl->tpl_vars['nav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['navone']['index']]->url;?>
"><img src="<?php echo @UPLOAD;?>
<?php echo $_smarty_tpl->tpl_vars['nav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['navone']['index']]->pic;?>
"><span class="homenav"><?php echo $_smarty_tpl->tpl_vars['nav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['navone']['index']]->subject;?>
</span></a></li>
         <?php endfor; endif; ?> 
        </ul>
        <ul data-tab-panel-1 class="am-tab-panel">
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['name'] = 'navtwo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['nav']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start'] = (int)9;
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['max'] = (int)9;
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['show'] = true;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['max'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['navtwo']['total']);
?>
          <li><a href="<?php echo $_smarty_tpl->tpl_vars['nav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['navtwo']['index']]->url;?>
"><img src="<?php echo @UPLOAD;?>
<?php echo $_smarty_tpl->tpl_vars['nav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['navtwo']['index']]->pic;?>
"><span class="homenav"><?php echo $_smarty_tpl->tpl_vars['nav']->value[$_smarty_tpl->getVariable('smarty')->value['section']['navtwo']['index']]->subject;?>
</span></a></li>
        <?php endfor; endif; ?> 
        </ul>
    </div>
    <ul class="am-tabs-nav am-cf">
        <li class="am-active"><a href="[data-tab-panel-0]">青春</a></li>
        <li class=""><a href="[data-tab-panel-1]">彩虹</a></li>
    </ul>
</div>

<!--底部按钮-->
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default am-no-layout home_navbar">
	<ul class="am-navbar-nav am-cf am-avg-sm-4">
    	<li><a href="/mobile/user.php"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/i/icon/icon_b1.png"><span class="am-navbar-label">个人中心</span></a></li>
        <li><a href="/upload/apk/hma_hongen.apk"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/i/icon/icon_b2.png"><span class="am-navbar-label">APP下载</span></a></li>
    </ul>
</div>


<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<!--<![endif]-->
<script src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/amazeui.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/laypage.js"></script>

<script src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/shangyu.js"></script>
<script type="text/javascript">
var gShangyu = new Shangyu();
gShangyu.indexsuse();

</script>

<div class="am-modal-actions" id="my-share">
  <div class="am-modal-actions-group">
  	<h3 class="am-share-title am-margin-0">分享到</h3>
    <ul class="am-share-sns am-avg-sm-3 am-margin-0">
      <li><a href="#" data-am-share-to="weibo"><i class="am-icon-weibo"></i><span>新浪微博</span></a></li>
      <li><a href="#" data-am-share-to="qq"><i class="am-icon-qq"></i><span>QQ 好友</span></a></li>
      <li><a href="#" data-am-share-to="qzone"><i class="am-icon-star"></i><span>QQ 空间</span></a></li>
      <li><a href="#" data-am-share-to="tqq"><i class="am-icon-tencent-weibo"></i><span>腾讯微博</span></a></li>
      <li><a href="#" data-am-share-to="wechat"><i class="am-icon-wechat"></i><span>微信</span></a></li>
      <li><a href="#" data-am-share-to="renren"><i class="am-icon-renren"></i><span>人人网</span></a></li>
    </ul>
  </div>
  <div class="am-modal-actions-group">
    <button class="am-btn am-btn-secondary am-btn-block" data-am-modal-close>取消</button>
  </div>
</div>

<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
  <div class="am-modal-dialog">
    <div class="am-modal-hd" id="my-alert-title"></div>
    <div class="am-modal-bd" id="my-alert-content">
     
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn">确定</span>
    </div>
  </div>
</div>

</body>
</html>
<?php }} ?>