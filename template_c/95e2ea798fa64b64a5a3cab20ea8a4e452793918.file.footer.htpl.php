<?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 11:53:15
         compiled from "D:\wamp\www\newtemp\tpl\red\common\layout\footer.htpl" */ ?>
<?php /*%%SmartyHeaderCode:1452584e1f2b99a785-74219179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95e2ea798fa64b64a5a3cab20ea8a4e452793918' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\layout\\footer.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1452584e1f2b99a785-74219179',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nav' => 0,
    'WEBSITE' => 0,
    'v' => 0,
    'ContactTag' => 0,
    'RESOURCE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_584e1f2bacb2c3_16052454',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_584e1f2bacb2c3_16052454')) {function content_584e1f2bacb2c3_16052454($_smarty_tpl) {?><!--footer-->
<div class="clear h8"></div>
<div id="footer">
    <div>
        <?php echo smarty_function_navigations(array('order'=>"cate asc,sort asc",'limit'=>"6",'pid'=>"0",'cate'=>"3",'is_display'=>"1",'assign'=>"nav"),$_smarty_tpl);?>

        <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['nav']->value), null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['nav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value->url;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['v']->value->subject;?>
</a>|&nbsp;&nbsp;
        <?php } ?>
    </div>

    <p>
 	<span>
	 	<strong><?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
网址：
            <a href="#"><?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
</a>&nbsp;就诊咨询电话：<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('tel');?>
</strong>
	</span><br />
        <?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
版权所有：<a href="http://www.qqyy.com">全球医院网</a>&nbsp;|&nbsp;ICP备案信息:<a rel="nofollow" href="http://www.miit.gov.cn/n11293472/index.html"><?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('icp');?>
</a><br />
        本站内图片及商标权属本站所有未经授权请勿复制及转载<br />
        <span><a href="http://www.qqyy.com">全球医院网</a>|<a href="http://www.boyicms.com" class="mrleft"> 医院网站智能建设系统</a></span></p>

<!--body end-->
<div class="clear"></div>

<div class="bar">
    <div style="color:#000;" class="title"><?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
，权威专家在线坐诊为您解答！</div>
    <div style="color:#000;" class="user">目前已有<strong style="color:#ff41ab;><span id="number2">5</span></strong>位患者与医生交流</div>
    <div style="color:#ff41ab;" class="time"><strong>咨询电话：<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('tel');?>
</strong></div>
    <div class="bar-ask"><a href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
/reservation.html" target="_blank"><img src='<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/bar/consulting.gif' /></a></div>
</div>
</div>
<script type="text/javascript">
    var GetRandomnVal = 2;
    function GetRandom(n){GetRandomnVal=Math.floor(Math.random()*n+1)}
    GetRandom("4");
    document.getElementById('number1').innerHTML=GetRandomnVal;
    document.getElementById('number2').innerHTML=GetRandomnVal;
</script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/layout.js"></script>
<?php }} ?>