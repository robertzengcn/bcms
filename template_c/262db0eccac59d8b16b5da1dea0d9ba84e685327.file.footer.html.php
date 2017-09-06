<?php /* Smarty version Smarty-3.1.8, created on 2016-08-30 13:35:54
         compiled from "D:/wamp/www/newtemp/shop/Tpl/man\Common\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:1174357c4fee625c505-41676356%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '262db0eccac59d8b16b5da1dea0d9ba84e685327' => 
    array (
      0 => 'D:/wamp/www/newtemp/shop/Tpl/man\\Common\\footer.html',
      1 => 1472529735,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1174357c4fee625c505-41676356',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c4fee6300631_79904498',
  'variables' => 
  array (
    'contact' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c4fee6300631_79904498')) {function content_57c4fee6300631_79904498($_smarty_tpl) {?>
<div class="footer2 container">
	<ul class="text-center center-block">
        <li><a href="" target="_blank">联系我们</a></li>
        <li><a href="#" target="_blank">帮助信息</a></li>
        <li><a href="#" target="_blank"><?php echo $_smarty_tpl->tpl_vars['contact']->value['icp'];?>
</a></li>
        <li><a ><?php echo $_smarty_tpl->tpl_vars['contact']->value['name'];?>
版权所有</a></li>
    </ul>
</div>
<!-- 对话框HTML -->
<div class="modal fade" id="myModal">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
      <h4 class="modal-title"><i class="icon-info-sign alert-danger"></i>  重要提示</h4>
    </div>
    <div class="modal-body">
      <div class="alert alert-danger with-icon">
        <i class="icon-info-sign"></i>
        <div class="content" id="thecontent"></div>
      </div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      
    </div>
  </div>
</div>
</div>
<script type="text/javascript">

/*$(".suspension li p").hide();
$(".suspension li img").hide();*/

//回到顶部
function goTop(){
	$('html,body').animate({'scrollTop':0},600);
}
</script>




</body>
</html><?php }} ?>