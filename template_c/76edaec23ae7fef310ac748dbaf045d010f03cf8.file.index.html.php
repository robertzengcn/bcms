<?php /* Smarty version Smarty-3.1.8, created on 2016-11-23 15:38:08
         compiled from "D:/wamp/www/newtemp/shop/Tpl/man\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:502657c4f7c3600049-39019966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76edaec23ae7fef310ac748dbaf045d010f03cf8' => 
    array (
      0 => 'D:/wamp/www/newtemp/shop/Tpl/man\\Index\\index.html',
      1 => 1479881926,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '502657c4f7c3600049-39019966',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_57c4f7c3986697_65956433',
  'variables' => 
  array (
    'RESOURCE' => 0,
    'CommodityTag' => 0,
    'head' => 0,
    'productlist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57c4f7c3986697_65956433')) {function content_57c4f7c3986697_65956433($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="myNiceCarousel" class="carousel slide " data-ride="carousel"> 
  <!-- 圆点指示器 -->
  <ol class="carousel-indicators">
    <li data-target="#myNiceCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myNiceCarousel" data-slide-to="1"></li>
    <li data-target="#myNiceCarousel" data-slide-to="2"></li>
  </ol>
  <!-- 轮播项目 -->
  <div class="carousel-inner">
    <div class="item active"> <img class="visible-xs" alt="First slide" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/banner/banner4.jpg"> <img class="hidden-xs" alt="First slide" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/banner/banner1.jpg">
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>
    <div class="item"><img class="visible-xs" alt="First slide" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/banner/banner5.jpg"> <img class="hidden-xs" alt="First slide" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/banner/banner2.jpg">
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>
    <div class="item"> <img class="visible-xs" alt="First slide" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/banner/banner6.jpg"> <img class="hidden-xs" alt="First slide" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/banner/banner3.jpg">
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>
  </div>
  
  <!-- 项目切换按钮 --> 
  <a class="left carousel-control" href="#myNiceCarousel" data-slide="prev"> <span class="icon icon-chevron-left glyphicon-chevron-right"></span> </a> <a class="right carousel-control" href="#myNiceCarousel" data-slide="next"> <span class="icon icon-chevron-right glyphicon-chevron-right"></span> </a> </div>
<div class="con_box">
  <div class="container">
    <div contenteditable="false" spellcheck="false" class="segment no-padding"> <br>
      <div class="list">
        <header>
          <h3><i class="icon-list-ul icon-border-circle"></i> 精品推荐<small></small></h3>
        </header>
        <section class="cards cards-condensed">
          <div class="col-md-4 col-sm-6 col-lg-3 col-xs-6"> <a href="###" class="card"> <img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/content/img6.jpg" alt=""> 
            <!--<span class="caption"></span>--> 
            </a> </div>
          <div class="col-md-4 col-sm-6 col-lg-3 col-xs-6"> <a href="###" class="card"> <img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/content/img4.jpg" alt=""> 
            <!--<span class="caption"></span>--> 
            </a> </div>
          <div class="col-md-4 col-sm-6 col-lg-3 col-xs-6"> <a href="###" class="card"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/content/img7.jpg" alt=""></a> </div>
          <div class="col-md-4 col-sm-6 col-lg-3 col-xs-6"> <a href="###" class="card"><img src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/images/content/img3.jpg" alt=""></a> </div>          
        </section>        
      </div>
    </div>
   <?php $_smarty_tpl->tpl_vars['head'] = new Smarty_variable($_smarty_tpl->tpl_vars['CommodityTag']->value->getNavgroup("catelogue"), null, 0);?>
    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['name'] = 'catlogue';
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['head']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['catlogue']['total']);
?>
    
    
    <div contenteditable="false" spellcheck="false" class="segment no-padding"> <br>
      <div class="list">
        <header>
          <h3><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['catlogue']['iteration'];?>
F <?php echo $_smarty_tpl->tpl_vars['head']->value[$_smarty_tpl->getVariable('smarty')->value['section']['catlogue']['index']]->name;?>
<small></small></h3>
        </header>
         
        <section class="cards cards-condensed">
          <div class="col-md-4 col-sm-6 col-lg-3 col-xs-6"> <a href="/shop/commodity.php?categories_id=<?php echo $_smarty_tpl->tpl_vars['head']->value[$_smarty_tpl->getVariable('smarty')->value['section']['catlogue']['index']]->id;?>
" class="card"> <img src="<?php echo $_smarty_tpl->tpl_vars['head']->value[$_smarty_tpl->getVariable('smarty')->value['section']['catlogue']['index']]->categories_image;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['head']->value[$_smarty_tpl->getVariable('smarty')->value['section']['catlogue']['index']]->name;?>
"> 
            <!--<span class="caption"></span>--> 
            </a> </div>
          <?php $_smarty_tpl->tpl_vars['productlist'] = new Smarty_variable($_smarty_tpl->tpl_vars['CommodityTag']->value->getcatbyid($_smarty_tpl->tpl_vars['head']->value[$_smarty_tpl->getVariable('smarty')->value['section']['catlogue']['index']]->id), null, 0);?>
          
          <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['plist'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['name'] = 'plist';
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['productlist']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['max'] = (int)3;
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['show'] = true;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['max'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['plist']['total']);
?>
        
          
          <div class="col-md-4 col-sm-6 col-lg-3 col-xs-6"> <a href="./commodity.php?method=get&id=<?php echo $_smarty_tpl->tpl_vars['productlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->id;?>
" class="card"> <img src="<?php echo $_smarty_tpl->tpl_vars['productlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['plist']['index']]->pic;?>
" alt="">            
            </a> </div>
          <?php endfor; endif; ?>
        </section>
      </div>
    </div>
    <?php endfor; endif; ?>
   


<?php echo $_smarty_tpl->getSubTemplate ("Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>