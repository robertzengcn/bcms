<?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 15:17:24
         compiled from "D:\wamp\www\newtemp\tpl\red\common\right\common\technology.htpl" */ ?>
<?php /*%%SmartyHeaderCode:5547584e4f042ab610-56959679%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d85247767c0a88a5a2a891562d422b5b81665da' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\right\\common\\technology.htpl',
      1 => 1470217312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5547584e4f042ab610-56959679',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WEBSITE' => 0,
    'TechnologyTag' => 0,
    'Technologys' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_584e4f04320928_27155200',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_584e4f04320928_27155200')) {function content_584e4f04320928_27155200($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\modifier.truncate.php';
?><!--技术-->
<div class="par-technology bk">
    <h4><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/technology">先进技术</a></h4>
    <?php $_smarty_tpl->tpl_vars['Technologys'] = new Smarty_variable($_smarty_tpl->tpl_vars['TechnologyTag']->value->getList(1,7), null, 0);?>
    <ul>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Technologys']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
        <li>・<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/technology/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,"14");?>
</a></li>
        <?php } ?>
    </ul>
</div><?php }} ?>