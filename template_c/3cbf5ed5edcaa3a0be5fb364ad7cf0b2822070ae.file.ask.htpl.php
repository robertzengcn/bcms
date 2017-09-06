<?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 15:17:24
         compiled from "D:\wamp\www\newtemp\tpl\red\common\right\common\ask.htpl" */ ?>
<?php /*%%SmartyHeaderCode:3526584e4f046b2b01-58138805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cbf5ed5edcaa3a0be5fb364ad7cf0b2822070ae' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\right\\common\\ask.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3526584e4f046b2b01-58138805',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WEBSITE' => 0,
    'AskTag' => 0,
    'asks' => 0,
    'PicManagerTag' => 0,
    'UPLOAD' => 0,
    'pic' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_584e4f047c80c3_52607121',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_584e4f047c80c3_52607121')) {function content_584e4f047c80c3_52607121($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/cusplugins\\modifier.truncate.php';
?>    <!--专家答疑-->
    <div class="par-sense bk top8 nonebottom">
        <h4><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/ask/">专家答疑</a></h4>
        <?php $_smarty_tpl->tpl_vars['asks'] = new Smarty_variable($_smarty_tpl->tpl_vars['AskTag']->value->getList(1), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['asks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['value']->iteration=0;
 $_smarty_tpl->tpl_vars['value']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['value']->iteration++;
 $_smarty_tpl->tpl_vars['value']->index++;
 $_smarty_tpl->tpl_vars['value']->first = $_smarty_tpl->tpl_vars['value']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['first'] = $_smarty_tpl->tpl_vars['value']->first;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['first']){?>
        <?php $_smarty_tpl->tpl_vars['pic'] = new Smarty_variable($_smarty_tpl->tpl_vars['PicManagerTag']->value->getPic('askPic'), null, 0);?>
        <div class="sense-img"><img width="226" height="80" src="<?php echo $_smarty_tpl->tpl_vars['UPLOAD']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pic']->value->img;?>
" />
            <div>
                <h5><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/ask/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,"10");?>
</a></h5>
            </div>
        </div>
        <ul>
        <?php }elseif($_smarty_tpl->tpl_vars['value']->iteration<=7){?>
            <li>・<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/ask/<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
.html"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['value']->value->subject,"10");?>
</a></li>
        <?php }?>
        <?php } ?>
        </ul>
    </div><?php }} ?>