<?php /* Smarty version Smarty-3.1.8, created on 2017-05-11 16:48:11
         compiled from "D:\wamp\www\newtemp\tpl\red\common\page\index.html" */ ?>
<?php /*%%SmartyHeaderCode:117825914254b616af4-76424640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1326dd974342c414ee76f97cc99324fbbff9af99' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\page\\index.html',
      1 => 1470217311,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117825914254b616af4-76424640',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dir' => 0,
    'pre' => 0,
    'start' => 0,
    'end' => 0,
    'var' => 0,
    'current' => 0,
    'next' => 0,
    'pageCount' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5914254b70cca9_13051136',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5914254b70cca9_13051136')) {function content_5914254b70cca9_13051136($_smarty_tpl) {?><p class="fenye">
    <a href="../<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_tmp1;?>
/list_1.html" target="_self">首页</a>
	<a href="../<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_tmp2;?>
/list_<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pre']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo $_tmp3;?>
.html" target="_self">上一页</a>	
	<!-- start -->
	<?php ob_start();?><?php $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['var']->step = 1;$_smarty_tpl->tpl_vars['var']->total = (int)ceil(($_smarty_tpl->tpl_vars['var']->step > 0 ? $_smarty_tpl->tpl_vars['end']->value+1 - ($_smarty_tpl->tpl_vars['start']->value) : $_smarty_tpl->tpl_vars['start']->value-($_smarty_tpl->tpl_vars['end']->value)+1)/abs($_smarty_tpl->tpl_vars['var']->step));
if ($_smarty_tpl->tpl_vars['var']->total > 0){
for ($_smarty_tpl->tpl_vars['var']->value = $_smarty_tpl->tpl_vars['start']->value, $_smarty_tpl->tpl_vars['var']->iteration = 1;$_smarty_tpl->tpl_vars['var']->iteration <= $_smarty_tpl->tpl_vars['var']->total;$_smarty_tpl->tpl_vars['var']->value += $_smarty_tpl->tpl_vars['var']->step, $_smarty_tpl->tpl_vars['var']->iteration++){
$_smarty_tpl->tpl_vars['var']->first = $_smarty_tpl->tpl_vars['var']->iteration == 1;$_smarty_tpl->tpl_vars['var']->last = $_smarty_tpl->tpl_vars['var']->iteration == $_smarty_tpl->tpl_vars['var']->total;?><?php $_tmp4=ob_get_clean();?><?php echo $_tmp4;?>

		<?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['var']->value!=$_smarty_tpl->tpl_vars['current']->value){?><?php $_tmp5=ob_get_clean();?><?php echo $_tmp5;?>

			<a href="../<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
<?php $_tmp6=ob_get_clean();?><?php echo $_tmp6;?>
/list_<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['var']->value;?>
<?php $_tmp7=ob_get_clean();?><?php echo $_tmp7;?>
.html" target="_self"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['var']->value;?>
<?php $_tmp8=ob_get_clean();?><?php echo $_tmp8;?>
</a>
		<?php ob_start();?><?php }else{ ?><?php $_tmp9=ob_get_clean();?><?php echo $_tmp9;?>

			<a href="javascript:;" class='ay'><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['var']->value;?>
<?php $_tmp10=ob_get_clean();?><?php echo $_tmp10;?>
</a>
		<?php ob_start();?><?php }?><?php $_tmp11=ob_get_clean();?><?php echo $_tmp11;?>

	<?php ob_start();?><?php }} ?><?php $_tmp12=ob_get_clean();?><?php echo $_tmp12;?>

	<!-- end-->
	<a href="../<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
<?php $_tmp13=ob_get_clean();?><?php echo $_tmp13;?>
/list_<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['next']->value;?>
<?php $_tmp14=ob_get_clean();?><?php echo $_tmp14;?>
.html" target="_self">下一页</a>
    <a href="../<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
<?php $_tmp15=ob_get_clean();?><?php echo $_tmp15;?>
/list_<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageCount']->value;?>
<?php $_tmp16=ob_get_clean();?><?php echo $_tmp16;?>
.html" target="_self">末页</a>
</p><?php }} ?>