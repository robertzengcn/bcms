<?php /* Smarty version Smarty-3.1.8, created on 2016-12-16 14:45:42
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/man\Common\page.html" */ ?>
<?php /*%%SmartyHeaderCode:926858538d96869c75-21910578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1993e4600fd67032c4f796a04f26c66ae2bfcb1e' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/man\\Common\\page.html',
      1 => 1452244017,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '926858538d96869c75-21910578',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageCount' => 0,
    'page' => 0,
    'MOBILE' => 0,
    'url' => 0,
    'moreParam' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_58538d9697b3b9_41974070',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58538d9697b3b9_41974070')) {function content_58538d9697b3b9_41974070($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['pageCount']->value>1){?>
<ul class="NeskyPage">
	<?php if ($_smarty_tpl->tpl_vars['page']->value==1){?>
	<li><span>首页</span></li>
	<?php }else{ ?>
	<li><a href='<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
.php?method=query&page=1<?php echo $_smarty_tpl->tpl_vars['moreParam']->value;?>
'>首页</a></li>
	<li><a href='<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
.php?method=query&page=<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
<?php echo $_smarty_tpl->tpl_vars['moreParam']->value;?>
'>上一页</a></li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['page']->value==$_smarty_tpl->tpl_vars['pageCount']->value){?>
	<li><span>末页</span></li>
	<?php }else{ ?>
	<li><a href='<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
.php?method=query&page=<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
<?php echo $_smarty_tpl->tpl_vars['moreParam']->value;?>
'>下一页</a></li>
	<li><a href='<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
.php?method=query&page=<?php echo $_smarty_tpl->tpl_vars['pageCount']->value;?>
<?php echo $_smarty_tpl->tpl_vars['moreParam']->value;?>
'>末页</a></li>
	<?php }?>
</ul>
<?php }?>
<style type="text/css">
    /*分页*/
    .NeskyPage{width:100%;clear:both;font-size:14px;text-align:center;}
    .NeskyPage{height:22px;line-height:22px;overflow:hidden;padding:15px 0px;}
    .NeskyPage li{display:inline;}
    .NeskyPage li em.btnlists{background:#600567;text-align:center;color:#fff;padding:5px 13px;}
    .NeskyPage li span{padding:3px 8px;color:#686868;border:1px solid #dbdcd3;}
    .NeskyPage li.thisclass span{color:#ffffff;text-align:center;overflow:hidden;font-weight:bold;background:#8f9558;height:20px;width:24px;}
    .NeskyPage li a{	padding:3px 8px;color:#686868;border:1px solid #dbdcd3;}
    .NeskyPage li.pre a,#NeskyPage ul li em a{border:0;padding:0;color:#fff;}
    .NeskyPage li.pre a{margin-top:0;background:#600567;color:#fff;padding:5px 12px 5px 12px;}
    .NeskyPage li a:hover{background:#00632A;height:20px;width:24px;color:#fff;}
    .NeskyPage li span.pageinfo{padding:0;border:0;color:#000;}
    .NeskyPage li span strong{padding:0 4px;text-decoration:underline;color:#a52709;}
</style>
<?php }} ?>