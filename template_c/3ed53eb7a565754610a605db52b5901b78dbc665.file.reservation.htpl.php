<?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 15:17:24
         compiled from "D:\wamp\www\newtemp\tpl\red\common\right\common\reservation.htpl" */ ?>
<?php /*%%SmartyHeaderCode:22433584e4f045149a5-35627986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ed53eb7a565754610a605db52b5901b78dbc665' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\right\\common\\reservation.htpl',
      1 => 1470217312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22433584e4f045149a5-35627986',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'DepartmentTag' => 0,
    'departments' => 0,
    'i' => 0,
    'listName' => 0,
    'value' => 0,
    'WEBSITE' => 0,
    'RESOURCE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_584e4f046648e7_32294727',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_584e4f046648e7_32294727')) {function content_584e4f046648e7_32294727($_smarty_tpl) {?>      <!--预约-->
      <div class="par-reserve bk top8">
        <h4>预约信息</h4>
        <ul id="reserve-box">
        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['listName'] = new Smarty_variable('赵女士', null, 0);?>
        <?php $_smarty_tpl->tpl_vars['departments'] = new Smarty_variable($_smarty_tpl->tpl_vars['DepartmentTag']->value->getList(1,7), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['departments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
        <?php if ($_smarty_tpl->tpl_vars['i']->value==2){?>
        <?php $_smarty_tpl->tpl_vars['listName'] = new Smarty_variable('王先生', null, 0);?>
        <?php }elseif($_smarty_tpl->tpl_vars['i']->value==3){?>
        <?php $_smarty_tpl->tpl_vars['listName'] = new Smarty_variable('周女士', null, 0);?>
        <?php }elseif($_smarty_tpl->tpl_vars['i']->value==4){?>
        <?php $_smarty_tpl->tpl_vars['listName'] = new Smarty_variable('刘女士', null, 0);?>
        <?php }elseif($_smarty_tpl->tpl_vars['i']->value==5){?>
        <?php $_smarty_tpl->tpl_vars['listName'] = new Smarty_variable('李女士', null, 0);?>
        <?php }elseif($_smarty_tpl->tpl_vars['i']->value==6){?>
        <?php $_smarty_tpl->tpl_vars['listName'] = new Smarty_variable('柳先生', null, 0);?>
        <?php }elseif($_smarty_tpl->tpl_vars['i']->value==7){?>
        <?php $_smarty_tpl->tpl_vars['listName'] = new Smarty_variable('陈女士', null, 0);?>
        <?php }?>
        <li><span><?php echo $_smarty_tpl->tpl_vars['listName']->value;?>
</span><span><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</span><span class="dress">预约成功</span></li>
        <?php } ?>
        </ul>
         <script>
        new Marquee(["reserve-box"],0,0.1,235,175,22,2000,2000,0,3);
        </script>
        <div><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/reservation.html"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/reserve-ask.gif" alt="#" /></a></div>
      </div><?php }} ?>