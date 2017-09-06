<?php /* Smarty version Smarty-3.1.8, created on 2017-05-11 16:48:11
         compiled from "D:\wamp\www\newtemp\template_c\commonHtml\doctor.html" */ ?>
<?php /*%%SmartyHeaderCode:241065887207c40f374-74413395%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '821cbd7108dd3db4321e97c5d3bc6587664463d1' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\template_c\\commonHtml\\doctor.html',
      1 => 1494492490,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '241065887207c40f374-74413395',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5887207c417077_77664223',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5887207c417077_77664223')) {function content_5887207c417077_77664223($_smarty_tpl) {?>﻿<div style="width:235px;clear:both;" class="par-doctor bk">
    <h4><span><a target="_blank" href="http://www.newtemp.com/doctor/">专家在线</a></span></h4>
    <br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Use of undefined constant PROJECT_NAME - assumed 'PROJECT_NAME' in D:\wamp\www\newtemp\kernel\dao\DBBaseDAO.php on line <i>549</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0000</td><td bgcolor='#eeeeec' align='right'>275992</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>2</td><td bgcolor='#eeeeec' align='center'>0.0050</td><td bgcolor='#eeeeec' align='right'>608760</td><td bgcolor='#eeeeec'>ActionController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>105</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>3</td><td bgcolor='#eeeeec' align='center'>0.0080</td><td bgcolor='#eeeeec' align='right'>975016</td><td bgcolor='#eeeeec'>ActionController->excute(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>34</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>4</td><td bgcolor='#eeeeec' align='center'>0.0790</td><td bgcolor='#eeeeec' align='right'>1430752</td><td bgcolor='#eeeeec'>ViewHtmlController->__construct(  )</td><td title='D:\wamp\www\newtemp\controller\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>62</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>5</td><td bgcolor='#eeeeec' align='center'>0.8230</td><td bgcolor='#eeeeec' align='right'>6732936</td><td bgcolor='#eeeeec'>Html->makeOnce(  )</td><td title='D:\wamp\www\newtemp\controller\ViewHtmlController.php' bgcolor='#eeeeec'>..\ViewHtmlController.php<b>:</b>22</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>6</td><td bgcolor='#eeeeec' align='center'>2.6862</td><td bgcolor='#eeeeec' align='right'>11141320</td><td bgcolor='#eeeeec'>Html->tagFetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>708</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>7</td><td bgcolor='#eeeeec' align='center'>2.7092</td><td bgcolor='#eeeeec' align='right'>11331464</td><td bgcolor='#eeeeec'>Smarty_Internal_TemplateBase->fetch(  )</td><td title='D:\wamp\www\newtemp\controller\HtmlBase.php' bgcolor='#eeeeec'>..\HtmlBase.php<b>:</b>118</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>8</td><td bgcolor='#eeeeec' align='center'>2.7252</td><td bgcolor='#eeeeec' align='right'>11388152</td><td bgcolor='#eeeeec'>content_584e4f044ab203_73068835(  )</td><td title='D:\wamp\www\newtemp\lib\smarty\sysplugins\smarty_internal_templatebase.php' bgcolor='#eeeeec'>..\smarty_internal_templatebase.php<b>:</b>180</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>9</td><td bgcolor='#eeeeec' align='center'>2.7252</td><td bgcolor='#eeeeec' align='right'>11388496</td><td bgcolor='#eeeeec'>DoctorTag->getDoctorToday(  )</td><td title='D:\wamp\www\newtemp\template_c\825152362aff6fac118c207df2b671d86fb2bd3e.file.doctor.htpl.php' bgcolor='#eeeeec'>..\825152362aff6fac118c207df2b671d86fb2bd3e.file.doctor.htpl.php<b>:</b>35</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>10</td><td bgcolor='#eeeeec' align='center'>2.7252</td><td bgcolor='#eeeeec' align='right'>11388616</td><td bgcolor='#eeeeec'>DoctorTag->getList(  )</td><td title='D:\wamp\www\newtemp\tagobj\DoctorTag.php' bgcolor='#eeeeec'>..\DoctorTag.php<b>:</b>85</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>11</td><td bgcolor='#eeeeec' align='center'>2.7372</td><td bgcolor='#eeeeec' align='right'>11395792</td><td bgcolor='#eeeeec'>CommonTag->getPage(  )</td><td title='D:\wamp\www\newtemp\tagobj\DoctorTag.php' bgcolor='#eeeeec'>..\DoctorTag.php<b>:</b>41</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>12</td><td bgcolor='#eeeeec' align='center'>2.7372</td><td bgcolor='#eeeeec' align='right'>11395840</td><td bgcolor='#eeeeec'>BaseService->getPage(  )</td><td title='D:\wamp\www\newtemp\tagobj\CommonTag.php' bgcolor='#eeeeec'>..\CommonTag.php<b>:</b>65</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>13</td><td bgcolor='#eeeeec' align='center'>2.7372</td><td bgcolor='#eeeeec' align='right'>11396080</td><td bgcolor='#eeeeec'>DoctorDAO->getPage(  )</td><td title='D:\wamp\www\newtemp\kernel\BaseService.php' bgcolor='#eeeeec'>..\BaseService.php<b>:</b>47</td></tr>
<tr><td bgcolor='#eeeeec' align='center'>14</td><td bgcolor='#eeeeec' align='center'>2.7372</td><td bgcolor='#eeeeec' align='right'>11396448</td><td bgcolor='#eeeeec'>DBBaseDAO->unsetShowPosition(  )</td><td title='D:\wamp\www\newtemp\kernel\dao\DoctorDAO.php' bgcolor='#eeeeec'>..\DoctorDAO.php<b>:</b>275</td></tr>
</table></font>
    <a target="_blank" href="http://www.newtemp.com/doctor/2.html">
        <img src="http://www.newtemp.com/upload/doctor/20160119170329193.png" alt="doctor" class="img"/></a>
    <div>
        <h5><a target="_blank" href="http://www.newtemp.com/doctor/2.html">放大啊师傅&nbsp;范德萨发撒</a></h5>
        <p>...<a target="_blank" href="http://www.newtemp.com/doctor/2.html">[详细]</a></p>
        <a target="_blank" href="" class="mr5"><img src="http://www.newtemp.com/public/images/zx.gif" alt="#" /></a></div>
</div><?php }} ?>