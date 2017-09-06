<?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 15:17:24
         compiled from "D:\wamp\www\newtemp\tpl\red\common\right\common\doctor.htpl" */ ?>
<?php /*%%SmartyHeaderCode:1032584e4f0439d947-69132492%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '825152362aff6fac118c207df2b671d86fb2bd3e' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\right\\common\\doctor.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1032584e4f0439d947-69132492',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WEBSITE' => 0,
    'DoctorTag' => 0,
    'doctorToday' => 0,
    'UPLOAD' => 0,
    'ContactTag' => 0,
    'RESOURCE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_584e4f044ab203_73068835',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_584e4f044ab203_73068835')) {function content_584e4f044ab203_73068835($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\modifier.truncate.php';
?>﻿<div style="width:235px;clear:both;" class="par-doctor bk">
    <h4><span><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/doctor/">专家在线</a></span></h4>
    <?php $_smarty_tpl->tpl_vars['doctorToday'] = new Smarty_variable($_smarty_tpl->tpl_vars['DoctorTag']->value->getDoctorToday(), null, 0);?>
    <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/doctor/<?php echo $_smarty_tpl->tpl_vars['doctorToday']->value->id;?>
.html">
        <img src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['doctorToday']->value->pic;?>
" alt="doctor" class="img"/></a>
    <div>
        <h5><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/doctor/<?php echo $_smarty_tpl->tpl_vars['doctorToday']->value->id;?>
.html"><?php echo $_smarty_tpl->tpl_vars['doctorToday']->value->name;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['doctorToday']->value->position;?>
</a></h5>
        <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['doctorToday']->value->description,"25");?>
...<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/doctor/<?php echo $_smarty_tpl->tpl_vars['doctorToday']->value->id;?>
.html">[详细]</a></p>
        <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('swt');?>
" class="mr5"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/zx.gif" alt="#" /></a></div>
</div><?php }} ?>