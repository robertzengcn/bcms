<?php /* Smarty version Smarty-3.1.8, created on 2016-12-01 11:38:51
         compiled from "D:/wamp/www/newtemp/mobile/Tpl/man\Common\index_footer.html" */ ?>
<?php /*%%SmartyHeaderCode:3575583f9b4b1a0166-05684120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc680d799407c4fa7bf33bb8648f8149edd38528' => 
    array (
      0 => 'D:/wamp/www/newtemp/mobile/Tpl/man\\Common\\index_footer.html',
      1 => 1459494328,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3575583f9b4b1a0166-05684120',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RESOURCE' => 0,
    'departmentmanager' => 0,
    'v' => 0,
    'contact' => 0,
    'department' => 0,
    'MOBILE' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_583f9b4b65b188_63067175',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_583f9b4b65b188_63067175')) {function content_583f9b4b65b188_63067175($_smarty_tpl) {?><?php if (!is_callable('smarty_function_departmentmanager')) include 'D:/wamp/www/newtemp/tagobj/common\\function.departmentmanager.php';
?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/date/WdatePicker.js"></script>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/reservation_base.js"></script>


<!--底部 -->
<div class="zxyy">
    <div class="ht1"><font style="color:#535353">在线挂号</font></div>
    <div class="ht2"></div>
    <div class="ht3"></div>
    <div class="cn">院方郑重承诺，以下信息将绝对保密</div>
    <div class="gh">
         <form id='form1'>
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="64">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
                                    <td><input class="online_txt" name='name' type="text" />
                                        <span>*</span></td>
                                </tr>
                                <tr>
                                    <td width="64">年&nbsp;&nbsp;&nbsp;&nbsp;龄：</td>
                                    <td><input class="online_txt" name='age' type="text" />
                                        <span>*</span></td>
                                </tr>
                                <tr>
                                    <td width="64">性&nbsp;&nbsp;&nbsp;&nbsp;别：</td>
                                    <td><select name="sex" style="font-size:12px;">
                                            <option selected="selected" value="" ><a >请选择</a></option>
                                            <option value='1'>女</option>
                                            <option value='0'>男</option>
                                        </select>
                                        <span>*</span></td>
                                </tr>  
                                <tr>
                                    <td width="64">联系电话：</td>
                                    <td><input class="online_txt" name='hometel' type="text" />
                                        <span style="font-size:10px;">*</span></td>
                                </tr>
                                 <tr>
                                    <td width="64">电子邮箱：</td>
                                    <td><input class="online_txt" name='email' type="text" />
                                    </td>
                                </tr> 
                                <tr>
                                    <td width="64">联系地址：</td>
                                    <td><input class="online_L_txt"  name="address" value="请输入家庭住址"  type="text" style="font-size:12px;"/></td>
                                </tr>

                                <tr>
                                    <td width="64">预约时间：</td>
                                    <td><input class="online_txt" id='date' name='date' type="text" onfocus="WdatePicker({minDate:'%y-%M-%d'})"/>
                                        <span>*</span></td>
                                </tr>

                                <tr >
                                    <td width="64" padding-top:0px;>预约门诊：</td>
                                    <td>
                                        
										<?php echo smarty_function_departmentmanager(array('page'=>"0",'limit'=>"100"),$_smarty_tpl);?>

                                        <select id="department_id" name="department_id" class="sel_L" style="font-size:12px;" onchange="getDoctor(this.value);">
                                            <option>-请选择科室-</option>
                                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['departmentmanager']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
</option>
                                            <?php } ?>
                                        </select>
                                        <select id="doctor_id" name="doctor_id" class="sel_L" style="font-size:12px;" onchange="getReservation();">
                                            <option selected="selected" value="">-请选择医生-</option>
                                        </select>
                                        <select id="appointment" name="appointment" class="sel_L" style="font-size:12px;" onchange="getTime(this.value)">
                                            <option selected="selected" value="">请选择预约时间</option>
                                        </select>
                                        <input type="hidden" id="time" name="time" value=''/>
                                        <span>*</span>
                                    </td>
                                </tr>
                                 <tr>
                                    <td width="64" valign="top">留言内容：</td>
                                    <td><textarea name="ill" style="border: 1px solid #7f9db9;"></textarea></td>
                                </tr>
                                <tr >
                                    <td width="64"></td>
                                    <td class="td_btn" style="padding-top:12px;"><input value="提交" id='button' name='button' type="button">&nbsp;&nbsp;
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="重置" ></td>
                                </tr>
                            </table>
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
<div id="dbfd">
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
        </div>
<style type="text/css">
    .right_ask{float:right;right:0;position:fixed !important;bottom:85px; POSITION:absolute;bottom:expression(offsetParent.scrollTop +85);}
    .center_ask{width: 323px;height: 120px;position: fixed;top: 40%;margin-left: auto;margin-right: auto;text-align: center;z-index: 999;
    }
    .center_ask_main{position: relative}
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

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/reservation.js"></script>
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