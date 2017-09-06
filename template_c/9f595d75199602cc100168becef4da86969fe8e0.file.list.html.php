<?php /* Smarty version Smarty-3.1.8, created on 2016-11-14 09:59:06
         compiled from "D:/wamp/www/newtemp/shop/Tpl/man\Order\list.html" */ ?>
<?php /*%%SmartyHeaderCode:937758291a6a87a497-67722156%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f595d75199602cc100168becef4da86969fe8e0' => 
    array (
      0 => 'D:/wamp/www/newtemp/shop/Tpl/man\\Order\\list.html',
      1 => 1467011538,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '937758291a6a87a497-67722156',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_58291a6ab2dbb5_88097424',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58291a6ab2dbb5_88097424')) {function content_58291a6ab2dbb5_88097424($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="container jiesuan">
  
  <h3>全部订单</h3>
  <table class="table table-striped" id="cartTable">
    <thead>
      <tr class="danger">
        <th>日期</th>
        <th>订单号</th>
        
        <th>数量</th>
        <th>总积分数/所需付款数</th>
        <th style="min-width: 60px;">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['name'] = 'orderlist';
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['list']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['orderlist']['total']);
?>
      <tr>
        <td class="checkbox_1"><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['orderlist']['index']]->date;?>
</td>
        <td class="goods">   <span><a href="./order.php?method=getorder&order_id=<?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['orderlist']['index']]->id;?>
">
        <?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['orderlist']['index']]->order_num;?>

        </a></span></td>
       
        <td class="count"><?php echo count($_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['orderlist']['index']]->detail);?>
</td>
        <td class="subtotal"><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['orderlist']['index']]->total_score;?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['orderlist']['index']]->total_price;?>
</td>
        <td class="operation"><a class="" href="./order.php?method=getorder&order_id=<?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['orderlist']['index']]->id;?>
">订单详情</a></td>
      </tr>
<?php endfor; endif; ?>
    </tbody>
  </table>
  
   
  
</div>


<?php echo $_smarty_tpl->getSubTemplate ("Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>