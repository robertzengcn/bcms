<?php /* Smarty version Smarty-3.1.8, created on 2016-11-23 15:37:57
         compiled from "D:/wamp/www/newtemp/shop/Tpl/man\Commodity\list.html" */ ?>
<?php /*%%SmartyHeaderCode:1079657c50105e76605-34303358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7ebc28718629903ec57bf33622bda8371bc9659' => 
    array (
      0 => 'D:/wamp/www/newtemp/shop/Tpl/man\\Commodity\\list.html',
      1 => 1479886662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1079657c50105e76605-34303358',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c501060a3554_44547409',
  'variables' => 
  array (
    'list' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c501060a3554_44547409')) {function content_57c501060a3554_44547409($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>




<div class="container liebiao">
<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
  <div class="col-md-4 col-sm-6 col-lg-3">
    <div class="card">
      <a href="./commodity.php?method=get&id=<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['v']->value->pic;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['v']->value->subject;?>
"></a>
      <span class="caption">图片仅供参考，实际兑换礼品请以实物或您获取的服务为准</span>
      <a href="./commodity.php?method=get&id=<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
" class="card-heading"><strong><?php echo $_smarty_tpl->tpl_vars['v']->value->subject;?>
</strong></a>
      <div class="card-content text-muted">
<?php if ($_smarty_tpl->tpl_vars['v']->value->exchange==1){?>      
        积分：<span><?php echo $_smarty_tpl->tpl_vars['v']->value->score;?>
</span> 
<?php }else{ ?> 
  积分：<span><?php echo $_smarty_tpl->tpl_vars['v']->value->score;?>
</span>  现金：<span><?php echo $_smarty_tpl->tpl_vars['v']->value->price;?>
</span>
<?php }?>       
      </div>
      <div class="card-actions">
        <button class="btn btn-danger" onclick="addandjumptocart(<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
)"><i class="icon icon-shopping-cart"></i>&nbsp;兑换</button>
      </div>
    </div>
  </div>
<?php } ?>
  

</div>






<?php echo $_smarty_tpl->getSubTemplate ("Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>