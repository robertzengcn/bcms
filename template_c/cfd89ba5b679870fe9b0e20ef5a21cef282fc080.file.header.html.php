<?php /* Smarty version Smarty-3.1.8, created on 2016-08-30 11:30:50
         compiled from "D:/wamp/www/newtemp/shop/Tpl/man\Common\header.html" */ ?>
<?php /*%%SmartyHeaderCode:36157c4f919d74912-82467289%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cfd89ba5b679870fe9b0e20ef5a21cef282fc080' => 
    array (
      0 => 'D:/wamp/www/newtemp/shop/Tpl/man\\Common\\header.html',
      1 => 1472527787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '36157c4f919d74912-82467289',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c4f91a0e1db0_98869690',
  'variables' => 
  array (
    'RESOURCE' => 0,
    'CommodityTag' => 0,
    'head' => 0,
    'num' => 0,
    'line' => 0,
    's' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c4f91a0e1db0_98869690')) {function content_57c4f91a0e1db0_98869690($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\modifier.truncate.php';
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<title>积分商城</title>
<!--<link rel="alternate icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/i/favicon.png">-->

<link href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/css/style.css"rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/css/zui.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery.js"></script><!--前置js 放在zui.js或zui.min.js之前-->
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/zui.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/shop.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery.qrcode.min.js"></script>
<script>
  $(function ()
  {
      $('.nav li:not(.disabled)').hover(function() {
          $(this).closest('.nav').find('li.active').removeClass('active');
          $(this).addClass('active');
      });
  });
  </script>
<script>
  $(function ()
  {
    $("[data-toggle=popover]")
      .popover();
  });
  
  
/*导航浮动*/
  $(function(){
var nav=$(".black_dh"); //得到导航对象
var win=$(window); //得到窗口对象
var sc=$(document);//得到document文档对象。
win.scroll(function(){
  if(sc.scrollTop()>=50){
    nav.addClass("fixednav"); 
   $(".navTmp").fadeIn(); 
  }else{
   nav.removeClass("fixednav");
   $(".navTmp").fadeOut();
  }
})  
}) 
</script>
</head>

<body>

<!--[if lt IE 8]>
    <div class="alert alert-danger">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a href="http://browsehappy.com/">更换一个更好的浏览器</a> 来提升用户体验.</div>
<![endif]-->

<div class="head">


  <div class="container"> <a class="pull-left hidden-xs" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/logo/logo.png"></a>
    <div class="head-operates-logined pull-right text-center"> <a href="./cart.php"><i class="icon icon-shopping-cart"></i>
      <p>购物车</p>
      </a>
      <a href="./order.php"><i class="icon icon-shopping-cart"></i>
      <p>我的订单</p>
      </a>
      
      </div>
    <form class="navbar-form  text-center" role="search" name="searchForm" action="./search.php">
      <div class="form-group">
        <input type="text" id="keyword" class="form-control" name="keyword" placeholder="搜索" onclick="if(this.value=='')this.value=''" onblur="if(this.value ==''){this.value=this.defaultValue}">
        
      </div>
      <button type="submit" class="btn"><i class="icon icon-search"></i></button>
    </form>
  </div>
</div>
<script type="text/javascript">

  function checkSearchForm() {
    if (document.getElementById('keyword').value) {
      return true;
    } else {
      alert("请输入搜索关键词！");
      return false;
    }
  }
  
   //搜索框下拉框效果
  $(".form-control").mousedown(function() {

    $(".j-search-history").show();

  });

  $("form[name='searchForm']").mouseleave(function() {

    $(".j-search-history").hide();

  })

  function clear_search() {

    $.post('search.php?act=clear', '', clear_searchhtml, 'JSON');

  }

  function clear_searchhtml() {

    $('.history-items').html('');

  }
</script>
<div class="black_dh">
  <div class="container"> <a class="pull-left fenlei" href="#" data-toggle="popover" data-placement="bottom" data-target="#popoverContent1" data-trigger="focus"><i class="icon icon-th-list"></i>&nbsp;&nbsp;所有分类</a>
    <div id="popoverContent1" class="popover">
      <div class="arrow"></div>
      <div class="popover-content">
      
       <?php $_smarty_tpl->tpl_vars['head'] = new Smarty_variable($_smarty_tpl->tpl_vars['CommodityTag']->value->getNavgroup("catelogue"), null, 0);?>
       
        <table class="table">
        <?php $_smarty_tpl->tpl_vars['num'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['head']->value), null, 0);?>
        <?php $_smarty_tpl->tpl_vars['line'] = new Smarty_variable($_smarty_tpl->tpl_vars['num']->value/3, null, 0);?>

       
         <?php $_smarty_tpl->tpl_vars['s'] = new Smarty_variable(0, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['line']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['line']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
       
          <tr>
          <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['name'] = 'catlist';
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['head']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['max'] = (int)3;
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start'] = (int)$_smarty_tpl->tpl_vars['s']->value;
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['show'] = true;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['max'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['catlist']['total']);
?>
            <td><a href="./commodity.php?categories_id=<?php echo $_smarty_tpl->tpl_vars['head']->value[$_smarty_tpl->getVariable('smarty')->value['section']['catlist']['index']]->id;?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['head']->value[$_smarty_tpl->getVariable('smarty')->value['section']['catlist']['index']]->name,4);?>
</a></td>
       
         <?php endfor; endif; ?>
          </tr> 
            <?php $_smarty_tpl->tpl_vars['s'] = new Smarty_variable($_smarty_tpl->tpl_vars['s']->value+3, null, 0);?>        
       <?php }} ?>
         

        </table>
      </div>
    </div>
    <?php $_smarty_tpl->tpl_vars['head'] = new Smarty_variable($_smarty_tpl->tpl_vars['CommodityTag']->value->getNavgroup("catelogue"), null, 0);?>
    <ul  class="nav pull-left nav_zhu">
      <li class="active"><a href="/shop">首页</a></li>      
<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['head']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration']<8){?>
 <li><a href="./commodity.php?categories_id=<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->name,2);?>
</a></li>
 <?php }?>
<?php } ?>

    </ul>
  </div>
</div><?php }} ?>