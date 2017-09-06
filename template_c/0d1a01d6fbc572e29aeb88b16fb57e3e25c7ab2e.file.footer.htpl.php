<?php /* Smarty version Smarty-3.1.8, created on 2016-08-31 09:08:52
         compiled from "D:\wamp\www\newtemp\tpl\shangyu\common\layout\footer.htpl" */ ?>
<?php /*%%SmartyHeaderCode:966657c62e24256922-37284977%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d1a01d6fbc572e29aeb88b16fb57e3e25c7ab2e' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\shangyu\\common\\layout\\footer.htpl',
      1 => 1471752440,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '966657c62e24256922-37284977',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PicManagerTag' => 0,
    'ThirdTag' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c62e243f0c07_23248852',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c62e243f0c07_23248852')) {function content_57c62e243f0c07_23248852($_smarty_tpl) {?><div class="footer">
	<div class="container">
    	<div class="col-xs-12 col-sm-4 foor_l">
        	医院地址：<?php $_smarty_tpl->smarty->_tag_stack[] = array('contactlist', array('flag'=>'address')); $_block_repeat=true; echo smarty_block_contactlist(array('flag'=>'address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
[field:val/]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_contactlist(array('flag'=>'address'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<br>
            健康热线：<?php $_smarty_tpl->smarty->_tag_stack[] = array('contactlist', array('flag'=>'tel')); $_block_repeat=true; echo smarty_block_contactlist(array('flag'=>'tel'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
[field:val/]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_contactlist(array('flag'=>'tel'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<br>
            QQ：<?php $_smarty_tpl->smarty->_tag_stack[] = array('contactlist', array('flag'=>'qq')); $_block_repeat=true; echo smarty_block_contactlist(array('flag'=>'qq'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
[field:val/]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_contactlist(array('flag'=>'qq'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<br>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('contactlist', array('flag'=>'icp')); $_block_repeat=true; echo smarty_block_contactlist(array('flag'=>'icp'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
[field:val/]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_contactlist(array('flag'=>'icp'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </div>
        <div class="col-xs-12 col-sm-4 foor_m">
        	 <form action="" method="get">
		        <label></label>
		        <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu(this.value)">
				  <?php $_smarty_tpl->smarty->_tag_stack[] = array('footnavigation', array()); $_block_repeat=true; echo smarty_block_footnavigation(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		          <option value="[field:url/]">[field:subject]</option>
		          <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_footnavigation(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		        </select>
		     </form>
                <h4>分享本站:</h4>
                <ul>
                	<li><a href="javascript:void(0)" class="jiathis_button_qzone"><i class="icon icon-star"></i></a></li>
                    <li><a href="javascript:void(0)" class="jiathis_button_tsina"><i class="icon icon-weibo"></i></a></li>
                    <li><a href="javascript:void(0)" class="jiathis_button_weixin"><i class="icon icon-wechat"></i></a></li>
                    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1" charset="utf-8"></script>
                </ul>
        </div>
        <div class="col-xs-12 col-sm-4 foor_r">
        	<ul class="pull-left">
            	<li><?php $_smarty_tpl->smarty->_tag_stack[] = array('picbyflag', array('flag'=>'weixin')); $_block_repeat=true; echo smarty_block_picbyflag(array('flag'=>'weixin'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<img src="[field:src/]"><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_picbyflag(array('flag'=>'weixin'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<p>官方微信</p></li>
                <li><?php $_smarty_tpl->smarty->_tag_stack[] = array('picbyflag', array('flag'=>'weibo')); $_block_repeat=true; echo smarty_block_picbyflag(array('flag'=>'weibo'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<img src="[field:src/]"><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_picbyflag(array('flag'=>'weibo'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<p>官方微博</p></li>
            </ul>
            <ul class="pull-right">
            	<li><a href="#" target="_blank">关于我们</a>|</li>
                <li><a href="#" target="_blank">网站地图</a>|</li>
                <li><a href="#" target="_blank">法律责任</a></li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript"> 
//尾部导航
    function MM_jumpMenu(url){ //v3.0 
    window.location.href=url; 
    } 
    </script>




<!-- 弹窗  -->
<!--  
<div class="bar-center">
<?php echo $_smarty_tpl->tpl_vars['PicManagerTag']->value->getSpecial('one');?>

</div>
<div class="bar-right">
	<?php echo $_smarty_tpl->tpl_vars['PicManagerTag']->value->getSpecial('three');?>

</div>
<div class="bar-wrap" style="background-color: #731817;">
	<div align="center">
	<?php echo $_smarty_tpl->tpl_vars['PicManagerTag']->value->getSpecial('four');?>

	</div>
</div>
-->
<!-- <div style="display:none">
	<?php echo $_smarty_tpl->tpl_vars['ThirdTag']->value->get('cnzz');?>

</div> --><?php }} ?>