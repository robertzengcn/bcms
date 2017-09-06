<?php /* Smarty version Smarty-3.1.8, created on 2017-05-27 15:43:20
         compiled from "D:\wamp\www\newtemp\tpl\red\index.htpl" */ ?>
<?php /*%%SmartyHeaderCode:1298959292e182af379-13376370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '573d16c3792a6f89ee88caa20b46a8c4f30d2db6' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\index.htpl',
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
  'nocache_hash' => '1298959292e182af379-13376370',
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
  'unifunc' => 'content_59292e195dfe45_50229248',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59292e195dfe45_50229248')) {function content_59292e195dfe45_50229248($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\modifier.truncate.php';
if (!is_callable('smarty_function_department')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.department.php';
if (!is_callable('smarty_function_disease')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.disease.php';
if (!is_callable('smarty_function_friendLink')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\function.friendLink.php';
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
/style/index.css">

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
		
  <!--flash-->
  <div class="clear h8"></div>
  <div class="flash bk">
    <div class="flash-wrap">
      <div id="flash-box">
        <ul id="flash-content">
          <?php $_smarty_tpl->tpl_vars['indexScroll'] = new Smarty_variable($_smarty_tpl->tpl_vars['PicManagerTag']->value->getScroll('index'), null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['indexScroll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
          <li> <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['value']->value->url;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" alt="" /></a><div class="mask"></div><div class="comt"><h4><?php echo $_smarty_tpl->tpl_vars['value']->value->text;?>
</h4></div></li>
            <?php } ?>
        </ul>
      </div>
      <ul id="flash-list">
           <?php $_smarty_tpl->tpl_vars['indexScroll'] = new Smarty_variable($_smarty_tpl->tpl_vars['PicManagerTag']->value->getScroll('index'), null, 0);?>
           <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['indexScroll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
        <li><div class="mask1"></div><div class="comt1"><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['value']->value->url;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['value']->value->text;?>
" /></a></div></li>
           <?php } ?>
      </ul>
    </div>
  </div>
  <script type="text/javascript">
new Marquee(
{
	MSClass	  : ["flash-box","flash-content","flash-list"],
	Direction : 2,
	Step	  : 0.3,
	Width	  : 630,
	Height	  : 250,
	Timer	  : 20,
	DelayTime : 2500,
	WaitTime  : 0,
	ScrollStep: 0,
	SwitchType: 0,
	AutoStart : true
});
</script>

  <!--top-news-->
  <div class="top-news">
    <h4 id="top-news_btn1" onmouseover="showtab(1,'top-news',3)" class="current"><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/mediareport/">医院动态</a></h4>
      <h4 id="top-news_btn2" onmouseover="showtab(2,'top-news',3)"><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/news/">行业新闻</a></h4>
      <h4 id="top-news_btn3" onmouseover="showtab(3,'top-news',3)"><a target="_blank" href="#">热点文章</a></h4>
      <!--医院动态-->
      <div id="top-news_sub1">
        <?php $_smarty_tpl->tpl_vars['News'] = new Smarty_variable($_smarty_tpl->tpl_vars['NewsTag']->value->getList(1,7,true), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['News']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['value']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['value']->index++;
 $_smarty_tpl->tpl_vars['value']->first = $_smarty_tpl->tpl_vars['value']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['value']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['first']){?>
      <h5><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/news/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></h5>
      <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->content,"50");?>
...<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/news/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html">[详细]</a></p>
       <ul>
         <?php }else{ ?>
        <li><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/news/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,"20");?>
</a></li>
         <?php }?>
        <?php } ?>
      </ul>
    </div>
    <!--医院媒体报道-->
    <div id="top-news_sub2" class="hide">
        <?php $_smarty_tpl->tpl_vars['MediaReports'] = new Smarty_variable($_smarty_tpl->tpl_vars['MediaReportTag']->value->getList(1,7,true), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MediaReports']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['value']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['value']->index++;
 $_smarty_tpl->tpl_vars['value']->first = $_smarty_tpl->tpl_vars['value']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['value']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['first']){?>
        <h5><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/media/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></h5>
        <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->content,"50");?>
...<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/media/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html">[详细]</a></p>
        <ul>
        <?php }else{ ?>
        <li><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/media/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,"20");?>
</a></li>
        <?php }?>
        <?php } ?>
        </ul>
    </div>
      <!--热点文章-->
    <div id="top-news_sub3" class="hide">
        <?php $_smarty_tpl->tpl_vars['Articles'] = new Smarty_variable($_smarty_tpl->tpl_vars['ArticleTag']->value->getNewest(7), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['value']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['value']->index++;
 $_smarty_tpl->tpl_vars['value']->first = $_smarty_tpl->tpl_vars['value']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['value']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
        <?php echo smarty_function_department(array('id'=>$_smarty_tpl->tpl_vars['value']->value->department_id,'assign'=>"department"),$_smarty_tpl);?>

        <?php echo smarty_function_disease(array('id'=>$_smarty_tpl->tpl_vars['value']->value->disease_id,'assign'=>"disease"),$_smarty_tpl);?>

        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['first']){?>
        <h5><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['disease']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></h5>
        <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->content,"50");?>
...<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['disease']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html">[详细]</a></p>
        <ul>
        <?php }else{ ?>
        <li><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['disease']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,"20");?>
</a></li>
        <?php }?>
        <?php } ?>
      </ul>
    </div>
  </div>
  <!--doctor-->
  <div class="clear h8"></div>
  <div class="doctor bk">
    <div class="doctor-tab"><span><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('swt');?>
">
                <img src="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/public/images/index/doctor-zx.gif"></a></span>
        <?php $_smarty_tpl->tpl_vars['pic'] = new Smarty_variable($_smarty_tpl->tpl_vars['PicManagerTag']->value->getPic('doctor'), null, 0);?>
        <img src="<?php echo $_smarty_tpl->tpl_vars['pic']->value->src;?>
" /></div>
    <div class="doctor-wrap" id="doctor-box">
      <div id="doctor-content">
          <?php echo smarty_function_doctors(array('limit'=>9),$_smarty_tpl);?>

          <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['doctors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
        <div class="doctor-list bk">
          <div><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/doctor/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" alt="#" width="200" height="120" /></a><h5><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/doctor/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</a></h5><?php echo $_smarty_tpl->tpl_vars['value']->value->position;?>
</div>
        </div>
           <?php } ?>
      </div>
    </div>
    <script type="text/javascript"> 
new Marquee(["doctor-box","doctor-content"],2,2,958,212,50,0,0)
</script>
  </div>
  <!--科室列表begin-->
  <div class="department">
  <?php echo smarty_function_departments(array(),$_smarty_tpl);?>

      <?php  $_smarty_tpl->tpl_vars['department'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['department']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['departments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['department']->key => $_smarty_tpl->tpl_vars['department']->value){
$_smarty_tpl->tpl_vars['department']->_loop = true;
?>
  <div class="clear h8"></div>
  <div class="article-wrap bk">
    <div class="article-tab"><h3 class="mb_h3"><a target="_blank" target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['department']->value->name;?>
</a></h3>
    <span><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/doctor/">专家队伍</a><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/technology/">特色技术</a></span>
    </div>
    <div class="clear h8"></div>
      <?php $_smarty_tpl->tpl_vars['Diseases'] = new Smarty_variable($_smarty_tpl->tpl_vars['DiseaseTag']->value->getByDeparment($_smarty_tpl->tpl_vars['department']->value->id), null, 0);?>
    <div class="article-left">
      <h4><span><?php echo $_smarty_tpl->tpl_vars['department']->value->name;?>
</span>疾病导航</h4>
        <?php $_smarty_tpl->tpl_vars['ArtPic'] = new Smarty_variable($_smarty_tpl->tpl_vars['ArticleTag']->value->getByDeparment($_smarty_tpl->tpl_vars['department']->value->id,1,3), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['ArPic'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ArPic']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ArtPic']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['ArPic']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['ArPic']->key => $_smarty_tpl->tpl_vars['ArPic']->value){
$_smarty_tpl->tpl_vars['ArPic']->_loop = true;
 $_smarty_tpl->tpl_vars['ArPic']->index++;
 $_smarty_tpl->tpl_vars['ArPic']->first = $_smarty_tpl->tpl_vars['ArPic']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['ArPic']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['first']){?>
      <a target="_blank"><img style="width: 186px;height: 74px" src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['ArPic']->value->pic;?>
" /></a>
        <?php }?>
        <?php } ?>
      <div>
          <?php echo smarty_function_disease(array('id'=>$_smarty_tpl->tpl_vars['department']->value->disease_id),$_smarty_tpl);?>

          <?php  $_smarty_tpl->tpl_vars['DisValue'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DisValue']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Diseases']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['DisValue']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['DisValue']->key => $_smarty_tpl->tpl_vars['DisValue']->value){
$_smarty_tpl->tpl_vars['DisValue']->_loop = true;
 $_smarty_tpl->tpl_vars['DisValue']->index++;
 $_smarty_tpl->tpl_vars['DisValue']->first = $_smarty_tpl->tpl_vars['DisValue']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['DisValue']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
          <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration']<5){?>
          <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['DisValue']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['DisValue']->value->name;?>
</a>
          <?php }?>
          <?php } ?>
      </div>
      <ul>
      <?php $_smarty_tpl->tpl_vars['Articles'] = new Smarty_variable($_smarty_tpl->tpl_vars['ArticleTag']->value->getByDeparment($_smarty_tpl->tpl_vars['department']->value->id,1,3), null, 0);?>
          <?php  $_smarty_tpl->tpl_vars['ArtValue'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ArtValue']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ArtValue']->key => $_smarty_tpl->tpl_vars['ArtValue']->value){
$_smarty_tpl->tpl_vars['ArtValue']->_loop = true;
?>
      <li>·<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['DisValue']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['ArtValue']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['ArtValue']->value->subject,"14");?>
</a></li>
          <?php } ?>
      </ul>
    </div>
    <div class="article-right">
      <h4>
          <?php  $_smarty_tpl->tpl_vars['DisValue'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DisValue']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Diseases']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['DisValue']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['DisValue']->key => $_smarty_tpl->tpl_vars['DisValue']->value){
$_smarty_tpl->tpl_vars['DisValue']->_loop = true;
 $_smarty_tpl->tpl_vars['DisValue']->index++;
 $_smarty_tpl->tpl_vars['DisValue']->first = $_smarty_tpl->tpl_vars['DisValue']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['DisValue']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
          <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration']<7){?>
          <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['DisValue']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['DisValue']->value->name;?>
</a>|
          <?php }?>
          <?php } ?>
      </h4>
      <div>
          <?php echo smarty_function_recommendArticles(array('positionName'=>"首页疾病图文",'departmentName'=>($_smarty_tpl->tpl_vars['department']->value->name),'size'=>1),$_smarty_tpl);?>

          <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['recommendArticles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
          <?php echo smarty_function_disease(array('id'=>$_smarty_tpl->tpl_vars['value']->value->disease_id),$_smarty_tpl);?>

          <img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" /><h5>
              <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['disease']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html">
                  <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,15);?>
</a></h5>
      <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->description,50);?>
...<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['disease']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html">[详细]</a></p>
          <?php } ?>
      </div>
      <ul>
      <?php echo smarty_function_recommendArticles(array('positionName'=>"首页疾病列表",'departmentName'=>($_smarty_tpl->tpl_vars['department']->value->name),'size'=>8),$_smarty_tpl);?>

      <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['recommendArticles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
      <?php if ($_smarty_tpl->tpl_vars['v']->value->disease_id==false){?>
      <li>·<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['v']->value->subject,14);?>
</a></li>
      <?php }else{ ?>
      <?php echo smarty_function_disease(array('id'=>$_smarty_tpl->tpl_vars['v']->value->disease_id),$_smarty_tpl);?>

      <li>·<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['department']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['disease']->value->url;?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['v']->value->subject,10);?>
</a></li>
      <?php }?>
      <?php } ?>
      </ul>
    </div>
  </div>
  <div class="technology bk">
    <h4><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/technology/"><?php echo $_smarty_tpl->tpl_vars['department']->value->name;?>
特色技术</a></h4>
    <?php $_smarty_tpl->tpl_vars['technology'] = new Smarty_variable($_smarty_tpl->tpl_vars['TechnologyTag']->value->getByDepartment($_smarty_tpl->tpl_vars['department']->value->id,4), null, 0);?>
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['technology']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['value']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['value']->index++;
 $_smarty_tpl->tpl_vars['value']->first = $_smarty_tpl->tpl_vars['value']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['value']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['first']){?>
    <a target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" /></a>
    <?php }?>
    <div><h5><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/technology/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></h5><p>&nbsp;&nbsp;<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->content,"11");?>
...<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/technology/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html">[详细]</a></p></div>
    <?php } ?>
  </div>
  <?php } ?>
  </div>
    <!-- 科室列表end -->

  <!--医院简介-->
  <div class="clear h8"></div>
    <?php $_smarty_tpl->tpl_vars['introduce'] = new Smarty_variable($_smarty_tpl->tpl_vars['IntroduceTag']->value->get(), null, 0);?>
  <div class="about">
    <div class="about-top">
      <div class="about-img"><a target="_blank" href="#" rel="nofollow"><img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['introduce']->value->pic;?>
" alt="#" /></a></div>
      <div class="about-info">
        <p>&nbsp;&nbsp;<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['introduce']->value->content,"180");?>
...<a target="_blank" href="#">[详情]</a></p>
      </div>
    </div>
    <div class="about-tool">

      <div>全国最受欢迎的医院</div><div>咨询病情 了解费用 科学治疗</div><div>贯彻卫生部新医改便民网上预约</div>
    </div>
  </div>
  <!--在线问答-->
  <div class="ask">
    <div class="ask-list">
      <?php $_smarty_tpl->tpl_vars['Asks'] = new Smarty_variable($_smarty_tpl->tpl_vars['AskTag']->value->getlist(1,7), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Asks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['value']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['value']->index++;
 $_smarty_tpl->tpl_vars['value']->first = $_smarty_tpl->tpl_vars['value']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['value']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['first']){?>
      <h4><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/ask/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,"12");?>
</a> </h4>
        <?php $_smarty_tpl->tpl_vars['askInfo'] = new Smarty_variable($_smarty_tpl->tpl_vars['AskTag']->value->get($_smarty_tpl->tpl_vars['value']->value->id), null, 0);?>
      <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['askInfo']->value->content,"28");?>
...<a target="_blank" href="#">[详细]</a></p>
      <ul>
        <?php }else{ ?>
      <li><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/ask/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,"15");?>
</a></li>
        <?php }?>
        <?php } ?>
      </ul>
    </div>
  </div>
  <!--尾部医院环境等图片轮播-->
  <div class="clear h8"></div>
  <div class="pic-tab bk nonebottom">
  <h3><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/device/" id="pic-box_btn1" onmouseover="showtab(1,'pic-box',4)" class="current">医疗设备</a>
      <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/environment/" id="pic-box_btn2" onmouseover="showtab(2,'pic-box',4)">医院环境</a>
      <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/honor/" id="pic-box_btn3" onmouseover="showtab(3,'pic-box',4)">医院荣誉</a>
      <a target="_blank"  id="pic-box_btn4" onmouseover="showtab(4,'pic-box',4)">友情连接</a></h3>
  </div>
  <div class="pic bk">
    <div id="pic-box_sub1">
      <ul id="pic-content1">
        <?php echo smarty_function_devices(array('limit'=>10),$_smarty_tpl);?>

        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['devices']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
        <li><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/device/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" /><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></li>
        <?php } ?>
      </ul>
    </div>
    <div id="pic-box_sub2" class="hide">
      <ul id="pic-content2">
         <?php echo smarty_function_environments(array('limit'=>10),$_smarty_tpl);?>

          <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['environments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
          <li><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/environment/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" /><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></li>
          <?php } ?>
      </ul>
    </div>
    <div id="pic-box_sub3" class="hide">
      <ul id="pic-content3">
        <?php echo smarty_function_honors(array('limit'=>10),$_smarty_tpl);?>

          <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['honors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
          <li><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/hospital/honor/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" /><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></li>
          <?php } ?>
      </ul>
    </div>
    <div id="pic-box_sub4" class="hide">
      <div id="pic-content4">
          <?php echo smarty_function_friendLink(array('limit'=>5),$_smarty_tpl);?>

          <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['friendLink']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          <li style="display: inline-block;"><a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['v']->value->url;?>
' target='_blank'> <?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
</a> </li>
          <?php } ?>
      </div>
    </div>
<script type="text/javascript">
new Marquee(["pic-box_sub1","pic-content1"],2,2,958,150,50,0,0)
</script>
<script type="text/javascript"> 
new Marquee(["pic-box_sub2","pic-content2"],2,2,958,150,50,0,0)
</script>
<script type="text/javascript"> 
new Marquee(["pic-box_sub3","pic-content3"],2,2,958,150,50,0,0)
</script>
  </div>

		<div class="clear"></div>
		<!-- footer -->
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_footer']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="clear"></div>
	</div>
</body>
</html><?php }} ?>