<?php /* Smarty version Smarty-3.1.8, created on 2016-11-14 14:06:00
         compiled from "D:/wamp/www/newtemp/shop/Tpl/man\Order\detail.html" */ ?>
<?php /*%%SmartyHeaderCode:19656582954487d3873-18134565%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e3e6b6b27b36ecdb99b494b7981072a7c55bebb5' => 
    array (
      0 => 'D:/wamp/www/newtemp/shop/Tpl/man\\Order\\detail.html',
      1 => 1467948316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19656582954487d3873-18134565',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'detail' => 0,
    'v' => 0,
    'contact' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_58295448a21672_58751603',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58295448a21672_58751603')) {function content_58295448a21672_58751603($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="container qrcode">
	<div class="col-xs-12 col-sm-5 ">
    	<div class="qrcode_wm">
    	<div class="qrcode_left_title">
        	<h3>提货二维码</h3><h4>请在提货时出示此二维码</h4>
        </div>
        <div class="qrcode_img" id="qrcode"></div>
    	</div></div>
    <div class="col-xs-12 col-sm-7">
    	<div class="qrcode_wm">
    	<div class="qrcode_right_title">
        	<h3>订单号：<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_num'];?>
</h3><h2>待自提</h2>
        </div>
        <div class="qrcode_right_cont">
        	<h6>自提物品 : </h6>
        	
        	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['detail']->value['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
            <h3><?php echo $_smarty_tpl->tpl_vars['v']->value->commodity_name;?>
</h3>
            <?php } ?>
            <h6>日期 ：</h6>
            <span><?php echo $_smarty_tpl->tpl_vars['detail']->value['date'];?>
</span>
        	<h6>自提地址：</h6>
            <p><?php echo $_smarty_tpl->tpl_vars['contact']->value['name'];?>
<br>地址：<?php echo $_smarty_tpl->tpl_vars['contact']->value['address'];?>
<br>电话：<?php echo $_smarty_tpl->tpl_vars['contact']->value['tel'];?>
</p>
        </div>
        </div>
    </div>
</div>
<script>
  $(function ()
  {
	  jQuery('#qrcode').qrcode({size:310,text: "order_<?php echo $_smarty_tpl->tpl_vars['detail']->value['order_num'];?>
_<?php echo $_smarty_tpl->tpl_vars['detail']->value['qrcode'];?>
"});
  });
  </script>
<?php echo $_smarty_tpl->getSubTemplate ("Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>