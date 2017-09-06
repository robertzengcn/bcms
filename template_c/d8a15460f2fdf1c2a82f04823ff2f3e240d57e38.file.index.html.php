<?php /* Smarty version Smarty-3.1.8, created on 2016-12-01 11:38:50
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/man\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:26102583f9b4a1ab958-61033056%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8a15460f2fdf1c2a82f04823ff2f3e240d57e38' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/man\\Index\\index.html',
      1 => 1463393039,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26102583f9b4a1ab958-61033056',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pic' => 0,
    'value' => 0,
    'contact' => 0,
    'RESOURCE' => 0,
    'depNav' => 0,
    'NavigationTag' => 0,
    'navse' => 0,
    'mobileNav' => 0,
    'navs' => 0,
    'techNav' => 0,
    'MOBILE' => 0,
    'nawecond' => 0,
    'doctor' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_583f9b4acee8f9_15868842',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_583f9b4acee8f9_15868842')) {function content_583f9b4acee8f9_15868842($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:/wamp/www/newtemp/tagobj/common\\modifier.truncate.php';
?><?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>




</div>

<div class="banner">
<div class="ad">
    <div style="overflow: hidden;" class="adImg" id="wrapper">
        <div style="width: 320px;height: 160px;overflow:hidden;position:relative;" class="scroller">
            <ul style="width:9999px;height: 160px;overflow:hidden;position:absolute;top:0;left:0" id="thelist">
                <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pic']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
                <li><a  target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" height="160" width="320"></a></li>
               <?php } ?>
            </ul>
        </div>
    </div>
    <div class="adTip"> <a class="" href="/mobile/index.php">1</a><a class="active" href="/mobile/index.php">2</a><a href="/mobile/index.php">3</a></div>
</div>
<div id="container">
    <div class="tel1" style="position: relative"> <a href="tel:<?php echo $_smarty_tpl->tpl_vars['contact']->value['tel'];?>
"><span style="font-size: 20px;font-family:'microsoft yahei' importent;z-index: 999;position: absolute;top: 15px;left: 30px"><?php echo $_smarty_tpl->tpl_vars['contact']->value['tel'];?>
</span><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/tel.jpg" height="37" width="230"></a>
        <div class="tel11"><a href="">手机预约省钱省心</a></div>
    </div>
    <div class="hot1">
        <ul>
            <!-- <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['depNav']->value['ParNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration']<7){?>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['value']->value->url;?>
"><img src="/upload/<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" height="76" width="105"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></li>
            <?php }?>
            <?php } ?> -->
            <?php $_smarty_tpl->tpl_vars['navse'] = new Smarty_variable($_smarty_tpl->tpl_vars['NavigationTag']->value->getMobileGroup("dep_dao","app"), null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
             <li><a href="<?php echo $_smarty_tpl->tpl_vars['value']->value->url;?>
"><img src="/upload/<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" height="76" width="105"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></li>
            <?php } ?>
        </ul>
        <div class="hoti"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/hot.gif" height="35" width="33"></div>
    </div>
    <div class="hot2">
        <div class="ht1"><font style="color:#535353">热点问题</font></div>
        <div class="ht2"></div>
        <div class="ht3"></div>
        <!-- <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mobileNav']->value['ParNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration']<16){?>
        <div class="hots<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" target="_self"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></div>
        <?php }?>
        <?php } ?> -->
        <?php $_smarty_tpl->tpl_vars['navs'] = new Smarty_variable($_smarty_tpl->tpl_vars['NavigationTag']->value->getMobileGroup("app_dao","app"), null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['navs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration']<16){?>
              <div class="hots<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['value']->value->pic;?>
" target="_self"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></div>
            <?php }?>
            <?php } ?>
       </div>
    <div class="tsyl">
        <div class="ht1"><font style="color:#535353">特色医疗</font></div>
        <div class="ht2"></div>
        <div class="ht3"></div>
        <div class="js"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/zl.png" height="102" width="102"></div>
        <div class="fh"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/fh.jpg" height="102" width="24"></div>
        <!-- <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['techNav']->value['ParNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration']<5){?>
        <div class="js<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/technology.php" style="color:#FFF;"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></div>
        <?php }?>
        <?php } ?> -->
        <?php $_smarty_tpl->tpl_vars['nawecond'] = new Smarty_variable($_smarty_tpl->tpl_vars['NavigationTag']->value->getMobileGroup("tech_dao","app"), null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['nawecond']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
             <div class="js<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/technology.php" style="color:#FFF;"><?php echo $_smarty_tpl->tpl_vars['value']->value->subject;?>
</a></div>
            <?php } ?>
    </div>
    <div class="nkzj">
        <div class="ht1"><font style="color:#535353">在线专家</font></div>
        <div class="ht2"></div>
        <div class="ht3"></div>
        <a hidden="hidden" class="prev1"></a><a hidden="hidden" class="next1"></a>
        <div class="prev"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/pre.jpg" height="18" width="20"></div>
        <div class="next"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/next.jpg" height="18" width="20"></div>
        <div class="zjbox">
            <div class="scoll" style="width: 260px;height: 116px;overflow:hidden;position:relative;">
                <ul style="height: 116px;width:9999px;overflow:hidden;position:absolute;top:0;left:0">
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['doctor']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                    <li>
                        <div style="float:left"><a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/doctor.php?method=get&id=<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
">
                            <img src="<?php echo @UPLOAD;?>
<?php echo $_smarty_tpl->tpl_vars['v']->value->pic;?>
" height="116" width="90"></a></div>
                        <div style="float:left; margin-top:20px; margin-left:10px; line-height:24px; font-size:12px;width:150px;"> <a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/doctor.php?method=get&id=<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
">
                            <h4><?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
</h4>
                        </a><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['v']->value->description,30);?>
...</div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="an1"><a href="" style="color:#FFF;"><?php echo $_smarty_tpl->tpl_vars['contact']->value['tel'];?>
</a></div>
        <div class="an2"><a href="<?php echo $_smarty_tpl->tpl_vars['contact']->value['swt_link'];?>
"  target="_self" style="color:#FFF;">咨询专家</a></div>
    </div>
</div>
    <?php echo $_smarty_tpl->getSubTemplate ("Common/index_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>