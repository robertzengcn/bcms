<?php /* Smarty version Smarty-3.1.8, created on 2016-11-21 16:32:43
         compiled from "D:/wamp/www/newtemp/shop/Tpl/man\Commodity\detail.html" */ ?>
<?php /*%%SmartyHeaderCode:1585832b12ba9fc88-52504182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2816cc9036cd62207a7823f856ee90abe9c265c0' => 
    array (
      0 => 'D:/wamp/www/newtemp/shop/Tpl/man\\Commodity\\detail.html',
      1 => 1464572510,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1585832b12ba9fc88-52504182',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'CommodityTag' => 0,
    'cate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5832b12bcfd492_28553711',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5832b12bcfd492_28553711')) {function content_5832b12bcfd492_28553711($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php $_smarty_tpl->tpl_vars['cate'] = new Smarty_variable($_smarty_tpl->tpl_vars['CommodityTag']->value->getcatinfo($_smarty_tpl->tpl_vars['data']->value->categories_id), null, 0);?>


<div class="productdetail_content container">
  <ol class="breadcrumb">
    <li><a href="/"><i class="icon icon-home"></i> 首页</a></li>
    <li><a href="#"><?php echo $_smarty_tpl->tpl_vars['cate']->value->data->name;?>
</a></li>
    <li class="active"><?php echo $_smarty_tpl->tpl_vars['data']->value->subject;?>
</li>
  </ol>
  <div class="pull-left col-sm-4 col-xs-12">
    <ul class="productdetail_big_img">
      <li><a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['data']->value->pic;?>
"/></a></li>
     
    </ul>

    
    <div class="bianhao">
    	<p>礼品编号：<span><?php echo $_smarty_tpl->tpl_vars['data']->value->model;?>
</span></p>
        <a href="#"><i class="icon icon-link"></i>&nbsp;复制链接</a>
        <a href="#"><i class="icon icon-node"></i>&nbsp;分享</a>
    </div>
    <p style="margin:0;">图片仅供参考，实际兑换礼品请以实物或您获取的服务为准</p>
  </div>
  <form action="./cart.php" method="get">
  <div class="pull-left col-sm-8 col-xs-12 productdetail_content_m">
  	<h2><?php echo $_smarty_tpl->tpl_vars['data']->value->subject;?>
</h2>
  	
    <div class="alert alert-danger">重要提示：兑换后请到医院凭手机生成二维码到院领取物品</div>
    <?php if ($_smarty_tpl->tpl_vars['data']->value->exchange==1){?>      
      <p> 积分：<span><?php echo $_smarty_tpl->tpl_vars['data']->value->score;?>
</span> </p>
<?php }else{ ?> 
  <p>积分：<span><?php echo $_smarty_tpl->tpl_vars['data']->value->score;?>
</span>  现金：<span><?php echo $_smarty_tpl->tpl_vars['data']->value->price;?>
</span></p>
<?php }?>  
    
    
    
    
    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['data']->value->id;?>
 name="commodity_id" />
	<button class="btn btn-danger" type="submit"  value="Submit">立即兑换</button>
    <button class="btn btn-success addcart" type="button" dataid="<?php echo $_smarty_tpl->tpl_vars['data']->value->id;?>
">加入购物车</button>

  </div>
  </form>
</div>



<script type="text/javascript">
    //$('.spinnerExample').spinner({});
        $('.addcart').on('click',function(){
    	var comid=$(this).attr('dataid');
    	var quanity=1;
    	addcart(comid,quanity);
    	
    	});
</script>


<script type="text/javascript">
$(function(){
	$(".yListr ul li em").click(function(){
		$(this).addClass("yListrclickem").siblings().removeClass("yListrclickem");
	})
})
</script>

<script type="text/javascript">
$(function ()
{
	$('.small_img_box li:not(.disabled)').hover(function() {
		$(this).closest('.small_img_box').find('li.small_active').removeClass('small_active');
		$(this).addClass('small_active');
	});
  $(".small_img_box li").hover(function(){//点击链接
	 $(".productdetail_big_img li").css("display","none");//将main下所有的div都隐藏
	 $(".productdetail_big_img li:eq(" + $(this).index() + ")").css("display","block"); //链接对应的div显示
	}); 
});
</script>

<div class="parameter_specification_r container ">
	<p class="parameter_specification_r_title">
    	<span class="psr_active">礼品介绍</span>
        
    </p>
    <div class="ps_r_title_content">
    	<div class="ps_r_title_content_1">
<?php echo $_smarty_tpl->tpl_vars['data']->value->descript;?>

        </div>
        
    </div>
</div>


<?php echo $_smarty_tpl->getSubTemplate ("Common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>