<?php /* Smarty version Smarty-3.1.8, created on 2017-05-27 15:44:21
         compiled from "D:\wamp\www\newtemp\tpl\shangyu\index.htpl" */ ?>
<?php /*%%SmartyHeaderCode:1301457c62e8e024494-54226437%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80edc8f9215f2a5fa271bda7c5b8905c3f8f1556' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\shangyu\\index.htpl',
      1 => 1489137958,
      2 => 'file',
    ),
    '32f7529ea203c35a6c79f92ebbb5833f8153c0ba' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\shangyu\\common\\layout\\layout.htpl',
      1 => 1495177946,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1301457c62e8e024494-54226437',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c62e8e5f4a77_96085611',
  'variables' => 
  array (
    'SEO_TITLE' => 0,
    'SEO_KEYWORDS' => 0,
    'SEO_DESCRIPTION' => 0,
    'layout_header' => 0,
    'layout_footer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c62e8e5f4a77_96085611')) {function content_57c62e8e5f4a77_96085611($_smarty_tpl) {?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php if (isset($_smarty_tpl->tpl_vars['SEO_TITLE']->value)){?><?php echo $_smarty_tpl->tpl_vars['SEO_TITLE']->value;?>
<?php }?></title>
<meta name="keywords" content="<?php if (isset($_smarty_tpl->tpl_vars['SEO_KEYWORDS']->value)){?><?php echo $_smarty_tpl->tpl_vars['SEO_KEYWORDS']->value;?>
<?php }?>" />
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
    
<div class="home_banner">
  <div class="banner">
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('picbyflag', array('flag'=>"index")); $_block_repeat=true; echo smarty_block_picbyflag(array('flag'=>"index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<img class="hidden-xs" src="[field:src/]"><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_picbyflag(array('flag'=>"index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

  </div>
  <div class="nav_two">
    <ul class="container">
      <?php $_smarty_tpl->smarty->_tag_stack[] = array('navgroup', array('flag'=>"index_nav")); $_block_repeat=true; echo smarty_block_navgroup(array('flag'=>"index_nav"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

      <li><a href="[field:url/]"  target="_blank"><span><img src="[field:pic/]"></span>
        <p>[field:subject/]</p>
        </a></li>
      <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_navgroup(array('flag'=>"index_nav"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </ul>
  </div>
</div>
<div class="main_top container">
  <div class="col-xs-12 col-sm-12 col-md-8 maint_l">
    <div class="white_bg">
      <div class="col-xs-12 col-sm-6" style="padding:0;">
        <div id="myNiceCarousel" class="carousel slide " data-ride="carousel"> 
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('scrollpicbyflag', array('flag'=>"scroll",'assign'=>"pic")); $_block_repeat=true; echo smarty_block_scrollpicbyflag(array('flag'=>"scroll",'assign'=>"pic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_scrollpicbyflag(array('flag'=>"scroll",'assign'=>"pic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

          <!-- 圆点指示器 -->
          <ol class="carousel-indicators">
              <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pic']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['nava']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['nava']['iteration']++;
?>
			   <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['nava']['iteration']==1){?> <?php $_smarty_tpl->tpl_vars['active'] = new Smarty_variable("active", null, 0);?> <?php }else{ ?> <?php $_smarty_tpl->tpl_vars['active'] = new Smarty_variable('', null, 0);?> <?php }?>
               <li data-target="#myNiceCarousel" data-slide-to="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['nava']['iteration']-1;?>
" class="<?php echo $_smarty_tpl->tpl_vars['active']->value;?>
"></li>
              <?php } ?>
          </ol>
          <!-- 轮播项目 -->
          <div class="carousel-inner">
            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pic']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['nava']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['nava']['iteration']++;
?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['nava']['iteration']==1){?> <?php $_smarty_tpl->tpl_vars['active'] = new Smarty_variable("active", null, 0);?> <?php }else{ ?> <?php $_smarty_tpl->tpl_vars['active'] = new Smarty_variable('', null, 0);?> <?php }?>
            <div class="item <?php echo $_smarty_tpl->tpl_vars['active']->value;?>
"><a href="$v->url"><img src="<?php echo $_smarty_tpl->tpl_vars['v']->value->pic;?>
"></a></div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <ul class="news_tit">
          <li class="active"><a href="/news/index.html">院内新闻</a></li>
          <li><a href="/yuwugongkai/index.html">院务公开</a></li>
          <li class="bg_none"><a href="#">媒体报道</a></li>
        </ul>
        <ul class="news_box">
          <li>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('newsbyrecommend', array('recommend_name'=>"首页头版头条",'limit'=>"1")); $_block_repeat=true; echo smarty_block_newsbyrecommend(array('recommend_name'=>"首页头版头条",'limit'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <h2><a href="<?php echo smarty_function_newsurl(array(),$_smarty_tpl);?>
[field:id/].html">[field:subject/]</a></h2>
            <p>[field:description|length:35/]</p>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_newsbyrecommend(array('recommend_name'=>"首页头版头条",'limit'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <dl>
              <?php $_smarty_tpl->smarty->_tag_stack[] = array('newslist', array('pagesize'=>"4")); $_block_repeat=true; echo smarty_block_newslist(array('pagesize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

              <dd><a href="<?php echo smarty_function_newsurl(array(),$_smarty_tpl);?>
[field:id/].html" target="_blank">[field:subject|length:30/]</a><span>[field:plushtime|date_format:"m-d"/]</span></dd>
              <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_newslist(array('pagesize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </dl>
          </li>
          <li style="display:none;">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('channelarcsbyrecommend', array('recommend_name'=>"首页头版头条",'name'=>"院务公开")); $_block_repeat=true; echo smarty_block_channelarcsbyrecommend(array('recommend_name'=>"首页头版头条",'name'=>"院务公开"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <h2><a href="/yuanwugongkai/[field:id/].html">[field:subject/]</a></h2>
            <p>[field:description|length:35/]</p>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_channelarcsbyrecommend(array('recommend_name'=>"首页头版头条",'name'=>"院务公开"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <dl>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('channelarcsbyname', array('name'=>"信息公开",'size'=>"4")); $_block_repeat=true; echo smarty_block_channelarcsbyname(array('name'=>"信息公开",'size'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

              <dd><a href="/yuanwugongkai/[field:id/].html" target="_blank">[field:subject|length:30/]</a><span>[field:plushtime|date_format:"m-d"/]</span></dd>
              <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_channelarcsbyname(array('name'=>"信息公开",'size'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

             </dl>
          </li>
          <li style="display:none;">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('mediasbyrecommend', array('recommend_name'=>"首页头版头条",'pagesize'=>"1")); $_block_repeat=true; echo smarty_block_mediasbyrecommend(array('recommend_name'=>"首页头版头条",'pagesize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <h2><a href="<?php echo smarty_function_mediaurl(array(),$_smarty_tpl);?>
[field:id/].html">[field:subject/]</a></h2>
            <p>[field:description|length:35/]</p>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_mediasbyrecommend(array('recommend_name'=>"首页头版头条",'pagesize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <dl>
              <?php $_smarty_tpl->smarty->_tag_stack[] = array('medialist', array('pagesize'=>"4")); $_block_repeat=true; echo smarty_block_medialist(array('pagesize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

              <dd><a href="[field:url/].html" target="_blank">[field:subject|length:30/]</a><span>[field:plushtime|date_format:"m-d"/]</span></dd>
              <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_medialist(array('pagesize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </dl>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-4 maint_r">
    <div class="white_bg">
      <ul class="notice_tit">
        <li class="active"><a href="/yiyuangonggao">医院公告</a></li>
        <li><a href="xueshuhuiyi">学术会议</a></li>
        <li class="bg_none"><a href="zhaopinxinxi">招聘信息</a></li>
      </ul>
      <ul class="notice_box">
        <li>
          <dl>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('channelarcsbyname', array('name'=>"医院公告",'size'=>"6")); $_block_repeat=true; echo smarty_block_channelarcsbyname(array('name'=>"医院公告",'size'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <dd><a href="/yiyuangonggao/[field:id/].html" target="_blank">[field:subject/]</a><span>[field:plushtime|date_format:"m-d"/]</span></dd>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_channelarcsbyname(array('name'=>"医院公告",'size'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

          </dl>
        </li>
        <li style="display:none;">
          <dl>
           <?php $_smarty_tpl->smarty->_tag_stack[] = array('channelarcsbyname', array('name'=>"学术会议",'size'=>"6")); $_block_repeat=true; echo smarty_block_channelarcsbyname(array('name'=>"学术会议",'size'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <dd><a href="/xueshuhuiyi/[field:id/].html" target="_blank">[field:subject/]</a><span>[field:plushtime|date_format:"m-d"/]</span></dd>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_channelarcsbyname(array('name'=>"学术会议",'size'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

          </dl>
        </li>
        <li style="display:none;">
          <dl>
           <?php $_smarty_tpl->smarty->_tag_stack[] = array('channelarcsbyname', array('name'=>"招聘信息",'size'=>"6")); $_block_repeat=true; echo smarty_block_channelarcsbyname(array('name'=>"招聘信息",'size'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <dd><a href="/zhaopinxinxi/[field:id/].html" target="_blank">[field:subject/]</a><span>[field:plushtime|date_format:"m-d"/]</span></dd>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_channelarcsbyname(array('name'=>"招聘信息",'size'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

          </dl>
        </li>
      </ul>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(function ()
	{
			$('.maint_l .news_tit li:not(.disabled)').hover(function() {
					$(this).closest('.news_tit').find('li.active').removeClass('active');
					$(this).addClass('active');
					 $(".news_box li").css("display","none");//将main下所有的div都隐藏
			 		$(".news_box li:eq(" + $(this).index() + ")").css("display","block"); //链接对应的div显示
			});
		
	});  
	
	$(function ()
	{
			$('.maint_r .notice_tit li:not(.disabled)').hover(function() {
					$(this).closest('.notice_tit').find('li.active').removeClass('active');
					$(this).addClass('active');
					 $(".notice_box li").css("display","none");//将main下所有的div都隐藏
			 		$(".notice_box li:eq(" + $(this).index() + ")").css("display","block"); //链接对应的div显示
			});
		
	}); 
</script>

<div class="main_two container">
  <div class="col-xs-12 col-sm-12 col-md-8 mtwo_l">
  	<div class="white_bg">
    	<div class="main_tit">
          <strong class="pull-left"><a href="<?php echo smarty_function_doctorlisturl(array(),$_smarty_tpl);?>
" target="_blank">医师介绍</a></strong>
          <span class="pull-right"><a href="#myNiceCarousel1" data-slide="prev"><i class="icon icon-angle-left"></i></a> <a href="#myNiceCarousel1" data-slide="next"><i class="icon icon-angle-right"></i></a></span>
        </div>
        <div id="myNiceCarousel1" class="carousel slide " data-ride="carousel">
          <!-- 轮播项目 -->
          <div class="carousel-inner">
              <div class="item active">
              	<ul>
              	    <?php $_smarty_tpl->smarty->_tag_stack[] = array('doctorlist', array('page'=>"1",'pagesize'=>"4")); $_block_repeat=true; echo smarty_block_doctorlist(array('page'=>"1",'pagesize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                	<li><a href="<?php echo smarty_function_doctorlisturl(array(),$_smarty_tpl);?>
[field:id/].html" target="_blank"> <img src="[field:pic/]"><span>[field:name/]</span></a></li>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_doctorlist(array('page'=>"1",'pagesize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </ul>
              </div>
              <div class="item">
              	<ul>
                	<?php $_smarty_tpl->smarty->_tag_stack[] = array('doctorlist', array('page'=>"2",'pagesize'=>"4")); $_block_repeat=true; echo smarty_block_doctorlist(array('page'=>"2",'pagesize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                	<li><a href="<?php echo smarty_function_doctorlisturl(array(),$_smarty_tpl);?>
[field:id/].html" target="_blank"> <img src="[field:pic/]"><span>[field:name/]</span></a></li>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_doctorlist(array('page'=>"2",'pagesize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </ul>
              </div>
              <div class="item">
              	<ul>
                	<?php $_smarty_tpl->smarty->_tag_stack[] = array('doctorlist', array('page'=>"3",'pagesize'=>"4")); $_block_repeat=true; echo smarty_block_doctorlist(array('page'=>"3",'pagesize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                	<li><a href="<?php echo smarty_function_doctorlisturl(array(),$_smarty_tpl);?>
[field:id/].html" target="_blank"> <img src="[field:pic/]"><span>[field:name/]</span></a></li>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_doctorlist(array('page'=>"3",'pagesize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </ul>
              </div>
          </div>
         </div>
    
    </div>
  </div>
<div class="col-xs-12 col-sm-12 col-md-4 mtwo_r">
  	<div class="white_bg">
    	<div class="main_tit"><strong class="pull-left"><a href="#" target="_blank">门诊预约</a></strong></div>
        <form class="form-horizontal" role="form" method="post">
          <div class="form-group">
            <label class="col-xs-3 col-sm-2 col-md-3 control-label">个人信息：</label>
            <div class="col-xs-4">
              <input name="name" id="name" placeholder="姓名" class="form-control" type="text">
            </div>
            <div class="col-xs-5">
              <input name="hometel" id="hometel" placeholder="电话" class="form-control" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-3 col-sm-2 col-md-3 control-label"></label>
            <div class="col-xs-4">
              <select name="sex" id="sex" class="form-control">
                <option value="">性别</option>
                <option value="1">男</option>
                <option value="0">女</option>
              </select>
            </div>
            <div class="col-xs-5">
              <input name="age" id="age" placeholder="年龄" class="form-control" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-3 col-sm-2 col-md-3 control-label">选择科室：</label>
            <div class="col-xs-9">
              <select name="department" id="department_id" class="form-control" onchange="getDoctor(this.value);">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-3 col-sm-2 col-md-3 control-label">坐诊时间：</label>
            <div class="col-xs-4">
              <input id='date' name='date' onfocus="WdatePicker({minDate:'%y-%M-%d'})" placeholder="请输入日期" class="form-control" type="text">
            </div>
            <div class="col-xs-5">
              <select name="appointment" id="appointment" class="form-control" onchange="getTime(this.value)">
               <option value="">--请选择时间--</option>
              </select>
              <input type="hidden" id="time" name="time" value=''/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-3 col-sm-2 col-md-3 control-label">选择医生：</label>
            <div class="col-xs-4">
              <select name="doctor_id" id="doctor_id" class="form-control" onchange="getReservation();">
                <option value="">请选择医生</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12" style="text-align: center;">
              <input id="button" class="btn btn-block" value="挂号" data-loading="稍候..." type="button" name="button">
              <input name="type" id="type" value="article" type="hidden">
              <input name="ill" id="iLL" value="kong" type="hidden">
            </div>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="main_three container">
	<div class="main_tit"><strong class="pull-left"><a>科室介绍</a></strong></div>
    <div class="col-xs-12 col-sm-6 col-md-3 mthree_keshi">
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('deptlist', array('page'=>"1",'pagesize'=>"3",'diseases'=>true)); $_block_repeat=true; echo smarty_block_deptlist(array('page'=>"1",'pagesize'=>"3",'diseases'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    	<h3><i class="icon icon-circle"></i>  [field:name/]</h3>
        <ul>
            [diseases limit='9']
            <li><a href="[diseases:url/]" target="_blank">[diseases:name/]</a></li>
            [/diseases]
        </ul>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_deptlist(array('page'=>"1",'pagesize'=>"3",'diseases'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 mthree_keshi">
    	<?php $_smarty_tpl->smarty->_tag_stack[] = array('deptlist', array('page'=>"2",'pagesize'=>"3",'diseases'=>true)); $_block_repeat=true; echo smarty_block_deptlist(array('page'=>"2",'pagesize'=>"3",'diseases'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    	<h3><i class="icon icon-circle"></i>  [field:name/]</h3>
        <ul>
            [diseases limit='9']
            <li><a href="[diseases:url/]" target="_blank">[diseases:name/]</a></li>
            [/diseases]
        </ul>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_deptlist(array('page'=>"2",'pagesize'=>"3",'diseases'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 mthree_keshi">
    	<?php $_smarty_tpl->smarty->_tag_stack[] = array('deptlist', array('page'=>"3",'pagesize'=>"3",'diseases'=>true)); $_block_repeat=true; echo smarty_block_deptlist(array('page'=>"3",'pagesize'=>"3",'diseases'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    	<h3><i class="icon icon-circle"></i>  [field:name/]</h3>
        <ul>
            [diseases limit='9']
            <li><a href="[diseases:url/]" target="_blank">[diseases:name/]</a></li>
            [/diseases]
        </ul>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_deptlist(array('page'=>"3",'pagesize'=>"3",'diseases'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 mthree_keshi bord_none">
    	<?php $_smarty_tpl->smarty->_tag_stack[] = array('deptlist', array('page'=>"4",'pagesize'=>"3",'diseases'=>true)); $_block_repeat=true; echo smarty_block_deptlist(array('page'=>"4",'pagesize'=>"3",'diseases'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    	<h3><i class="icon icon-circle"></i>  [field:name/]</h3>
        <ul>
            [diseases limit='9']
            <li><a href="[diseases:url/]" target="_blank">[diseases:name/]</a></li>
            [/diseases]
        </ul>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_deptlist(array('page'=>"4",'pagesize'=>"3",'diseases'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 
    </div>
</div>


<div class="main_four container">
	<div class="col-xs-12 col-sm-12 col-md-7 mfour_l">
    	<div class="white_bg">
        <div class="main_tit"><strong class="pull-left"><a>专题专栏</a></strong></div>
        <ul class="mfour_zt row">
        	<?php $_smarty_tpl->smarty->_tag_stack[] = array('picbyflag', array('flag'=>"zhuanti1")); $_block_repeat=true; echo smarty_block_picbyflag(array('flag'=>"zhuanti1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<li class="col-xs-12 col-sm-6"><a href="[field:link/]" target="_blank">
        	<img src="[field:src/]"><p>[field:name/]</p><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_picbyflag(array('flag'=>"zhuanti1"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></li>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('picbyflag', array('flag'=>"zhuanti2")); $_block_repeat=true; echo smarty_block_picbyflag(array('flag'=>"zhuanti2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<li class="col-xs-12 col-sm-6"><a href="[field:link/]" target="_blank">
            <img src="[field:src/]"><p>[field:name/]</p><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_picbyflag(array('flag'=>"zhuanti2"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></li>
        </ul>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 mfour_r">
    	<div class="white_bg">
        <div class="main_tit"><strong class="pull-left"><a>咨询预约</a></strong></div>
        <ul class="mfour_zx row">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('navgroup', array('flag'=>"index_yuyue")); $_block_repeat=true; echo smarty_block_navgroup(array('flag'=>"index_yuyue"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        	<li class="col-xs-12 col-sm-6"><a href="[field:url/]" target="_blank"><img src="[field:pic/]"></a></li>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_navgroup(array('flag'=>"index_yuyue"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </ul>
        </div>
    </div>
</div>


    <!-- footer -->
    <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_footer']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>




</body>
</html>
<?php }} ?>