<?php /* Smarty version Smarty-3.1.8, created on 2016-09-19 13:54:34
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/man\Common\bootom_ph.html" */ ?>
<?php /*%%SmartyHeaderCode:2841357df7d9a325845-07892205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87e8e12c87ce517c2d802e8963b36837e61d7bc9' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/man\\Common\\bootom_ph.html',
      1 => 1452244017,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2841357df7d9a325845-07892205',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RESOURCE' => 0,
    'contact' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57df7d9a3e1065_67191723',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57df7d9a3e1065_67191723')) {function content_57df7d9a3e1065_67191723($_smarty_tpl) {?>
<!-- <div class="bottom_img"><a href="" class="float_tel" ><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/bottom_ph.png" alt="" width="320" height="40" /></a></div>-->
<div style="width:318px;margin:0 auto;">
<div class="lanmu1"><p><a href="/mobile/introduce.php?method=getInfo">详情&gt;&gt;</a></p>
    <h4>医院介绍</h4></div>

<div class="list">
    <div class="tyabout">
        <div>
            <img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/lou.jpg"><strong><?php echo $_smarty_tpl->tpl_vars['contact']->value['name'];?>

        </strong><br>
            <strong>电话：<?php echo $_smarty_tpl->tpl_vars['contact']->value['tel'];?>
</strong><br>
            <strong>医院地址：<?php echo $_smarty_tpl->tpl_vars['contact']->value['address'];?>
</strong><br>
        </div>
        <p><?php echo $_smarty_tpl->tpl_vars['contact']->value['name'];?>
位于<?php echo $_smarty_tpl->tpl_vars['contact']->value['address'];?>
，交通便利，秉承严谨求实的科学态度和诚信求精的行医宗旨，为广大患者提供健康服务。</p>
    </div>
</div>
</div><?php }} ?>