<?php /* Smarty version Smarty-3.1.8, created on 2016-09-19 13:54:34
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/man\Common\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:203457df7d9a3fc5f6-78722252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d498337ef76519e9ed9b61d8f6056c6d995067a' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/man\\Common\\footer.html',
      1 => 1459309417,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203457df7d9a3fc5f6-78722252',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'contact' => 0,
    'MOBILE' => 0,
    'department' => 0,
    'v' => 0,
    'RESOURCE' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57df7d9a5dcde6_43051583',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57df7d9a5dcde6_43051583')) {function content_57df7d9a5dcde6_43051583($_smarty_tpl) {?>
<div class="zixund" style="width:318px;margin:0 auto;">
    <div class="zixun">
        <div class="zixun1">
            <div class="zixun11" ><a target="_self"  href="<?php echo $_smarty_tpl->tpl_vars['contact']->value['swt_link'];?>
">点击在线医生，快速咨询</a></div>
        </div>
    </div>
</div>

<!--底部 -->
<div class="zxyy">
    <div class="ht1"><font style="color:#535353">在线挂号</font></div>
    <div class="ht2"></div>
    <div class="ht3"></div>
    <div class="cn">院方郑重承诺，以下信息将绝对保密</div>
    <div class="gh">
        <form action="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/reservation.php?method=reserUser" enctype="multipart/form-data" method="post">
            <input name="sourceUrl" value="" type="hidden">
            <table style="width:97%;" cellpadding="0" cellspacing="8">
                <tbody>
                <tr>
                    <td valign="top" align="right"><span style="color:#F00; font-size:12px;">*</span>姓名：</td>
                    <td><input name="name" id="name" style="width:180px" class="intxt" type="text"></td>
                </tr>
                <tr>
                    <td valign="top" align="right"><span style="color:#F00; font-size:12px;">*</span>电话：</td>
                    <td><input name="hometel" id="tel" style="width:180px" class="intxt" type="text">
                        <span style="color:#F00; font-size:12px;"></span></td>
                </tr>
                <tr>
                    <td valign="top" align="right">选择科室：</td>
                    <td>
                        <select class="intxt" name="department_id" id="zhuanye" style="width:180px">
                            <option value="0">选择科室</option>
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['department']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="right">选择医生：</td>
                    <td>
                        <select class="intxt" name="doctor_id" id="doctor" style="width:180px">
                            <option value="0">选择医生</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="right">就诊日期：</td>
                    <td>
                        <select class="intxt" name="date" id="time" style="width:180px">
                            <option value="0">请选择就诊日期</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="right">就诊时间：</td>
                    <td>
                        <select class="intxt" name="time" id="times" style="width:180px">
                            <option value="0">请选择就诊时间</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <div style="height:30px;padding-top:10px;" align="center">
                <input name="submitBtn" value="提交预约" class="submitBtn" style="color:#FFF; font-weight:bold; background:url(<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/an3.png); width:86px; height:30px; border:none;" type="button">
                &nbsp; <a href="<?php echo $_smarty_tpl->tpl_vars['contact']->value['swt_link'];?>
" target="_blank" >
                <input type="button" value="咨询专家" class="coolbg" style="color:#FFF; font-weight:bold; background:url(<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/an4.png); width:86px; height:30px; border:none; text-align:center;">
            </a>
            </div>
        </form>
    </div>
</div>
<div id="footer">
    <div class="fhui"><a href="javascript:window.history.go(-1)"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/fhui.png" height="30" width="30"></a></div>
    <div class="huit"><a href="#huitou"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/huit.png" height="30" width="30"></a></div>
    <div class="yt"></div>
    <div class="nav22">
        <ul>
            <li><a href="/mobile/contact.php?method=getRoute">来院路线</a></li>
            <li><a href="/mobile/index.php">站内</a></li>
            <li><a href="/mobile/article.php">疾病资讯</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['contact']->value['swt_link'];?>
" target="_self">咨询医生</a></li>

        </ul>
    </div>
    <div class="yyt"></div>
    <div class="db"> 院址：<?php echo $_smarty_tpl->tpl_vars['contact']->value['address'];?>
 <br>
        专家值班电话：<?php echo $_smarty_tpl->tpl_vars['contact']->value['tel'];?>
 <br>
    </div>
</div>
<!-- <div id="dbfd">
    <div class="ht4"></div>
    <ul>
        <li>
            <div class="fd1"><a href="javascript:void(0)" target="_self"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/fd1.jpg" height="20" width="26">科室导航</a></div>
        </li>
        <li class="jbdh">
            <div class="fd1"><a href="tel:<?php echo $_smarty_tpl->tpl_vars['contact']->value['tel'];?>
" style="color:#FFF;"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/fd2.gif" height="20" width="26">电话咨询</a></div>
        </li>
        <li>
            <div class="fd1"><a href="<?php echo $_smarty_tpl->tpl_vars['contact']->value['swt_link'];?>
"  target="_self"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/fd3.gif" height="20" width="26">在线预约</a></div>
        </li>
    </ul>
</div>
<div class="nav_hide">
    <ul>
        <li><a href="/mobile/index.php">首页</a></li>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['department']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['name']['iteration']++;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['name']['iteration']<7){?>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['MOBILE']->value;?>
/article.php?method=query&department_id=<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</a></li>
        <?php }?>
        <?php } ?>
    </ul>
</div>
<div class="right_ask">
    <a target="_self" href="<?php echo $_smarty_tpl->tpl_vars['contact']->value['swt_link'];?>
"><img width="66" height="66" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/swt_lv_1.png"></a>
</div>
<div class="center_ask_main">
    <div class="center_ask">
        <a target="_self" href="<?php echo $_smarty_tpl->tpl_vars['contact']->value['swt_link'];?>
"><img width="260" height="148" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/ask.png"/> </a>
        <a id="close_ask"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/closese.png"></a>
    </div>
</div> -->
<style type="text/css">
    .right_ask{float:right;right:0;position:fixed !important;bottom:85px; POSITION:absolute;bottom:expression(offsetParent.scrollTop +85);}
    .center_ask{width: 323px;height: 120px;position: fixed;top: 40%;margin-left: auto;margin-right: auto;text-align: center;z-index: 999;
    }
    .center_ask_main{position: relative;width: 323px;height: 350px;margin-left: auto;margin-right: auto}
    #close_ask{position: absolute;right:30px;top:10px}
    .hide_ask{display: none}
</style>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery_002.js"></script>
<script>
    $(function() {
        $("#dbfd ul li:eq(0)").click(function() {
            $(".nav_hide").toggle();
            width = $(this).width()+"px";
            $(".nav_hide ul li a").css("width", width);
        });
        $('#close_ask').click(function(){
            $('.center_ask_main').addClass('hide_ask');
        })
    })
</script>

<!--yao-->
<script src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery.touchSlider.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        //ad轮播
        $(".scroller").touchSlider({
            flexible : true,
            speed : 800,
            btn_prev : $(".prev1"),
            btn_next : $(".next1")
        });
        var timer_doc = setInterval(function(){
            $(".next1").click();
        }, 5000);
        $(".scoll").mouseenter(function(){
            clearInterval(timer_doc);
        }).mouseleave(function(){
            timer_doc = setInterval(function(){
                $(".next1").click();
            },5000);
        });
        //医生轮播
        $(".scoll").touchSlider({
            flexible : true,
            speed : 800,
            btn_prev : $(".prev"),
            btn_next : $(".next")
        });
        var timer_doc = setInterval(function(){
            $(".next").click();
        }, 5000);
        $(".scoll").mouseenter(function(){
            clearInterval(timer_doc);
        }).mouseleave(function(){
            timer_doc = setInterval(function(){
                $(".next").click();
            },5000);
        });
    });

</script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/swt.js"></script>

</body>
</html><?php }} ?>