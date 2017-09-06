<?php /* Smarty version Smarty-3.1.8, created on 2016-11-17 09:40:32
         compiled from "D:/wamp/www/newtemp/app/Tpl/zzyy_app\Common\right.html" */ ?>
<?php /*%%SmartyHeaderCode:8997582d0a9074c372-15726469%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc0cede7a4e4fb868dca40b5505c427f906d9c21' => 
    array (
      0 => 'D:/wamp/www/newtemp/app/Tpl/zzyy_app\\Common\\right.html',
      1 => 1453691557,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8997582d0a9074c372-15726469',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MOBILE' => 0,
    'contact' => 0,
    'SiteMapTag' => 0,
    'vo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_582d0a9121c3d0_65628539',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_582d0a9121c3d0_65628539')) {function content_582d0a9121c3d0_65628539($_smarty_tpl) {?><div id="rightHomePage"><a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/index.php" title=""></a></div>
<div id="rightconsult"><a href="<?php echo $_smarty_tpl->tpl_vars['contact']->value['swt_link'];?>
" target="_blank" title=""></a></div>
<div id="rightArrow"><a href="javascript:;" title=""></a></div>

<div id="floatDivBoxs">
	<div class="floatDtt">科室列表</div>
    <div class="floatShadow">
        <ul class="floatDqq">
            <?php  $_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['SiteMapTag']->value->getDepartment(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->key => $_smarty_tpl->tpl_vars['vo']->value){
$_smarty_tpl->tpl_vars['vo']->_loop = true;
?>
            <li style="padding-left:0px;"><a  href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/department.php?method=index&id=<?php echo $_smarty_tpl->tpl_vars['vo']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['vo']->value->name;?>
</a></li>
            <?php } ?>
        </ul>
        
    </div>
    
</div>
<script>
var flag=0;
$('#rightArrow').click(function(){
	if(flag==1){
		$("#floatDivBoxs").animate({right: '-175px'},300);
		$(this).animate({right: '-5px'},300);
		$(this).css('background-position','-50px 0');
		$(this).css('opacity','0.3');
		flag=0;
	}else{
		$("#floatDivBoxs").animate({right: '0'},300);
		$(this).animate({right: '170px'},300);
		$(this).css('background-position','0px 0');
		$(this).css('opacity','1');
		flag=1;
	}
});
</script><?php }} ?>