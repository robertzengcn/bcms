<?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 15:17:23
         compiled from "D:\wamp\www\newtemp\tpl\red\contact.htpl" */ ?>
<?php /*%%SmartyHeaderCode:3983584e4f03ec8e53-40196013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90f4f87af10fb2da8e2c1d9a0b1c2cd924eb36d5' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\contact.htpl',
      1 => 1470217312,
      2 => 'file',
    ),
    'bd669a52015bce59acc996f849868b1d1704015b' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\layout\\layout.htpl',
      1 => 1470217311,
      2 => 'file',
    ),
    '63d3afb5841526e82116ca4114025822248dbf35' => 
    array (
      0 => 'D:\\wamp\\www\\newtemp\\tpl\\red\\common\\right\\doctor_right.htpl',
      1 => 1470217312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3983584e4f03ec8e53-40196013',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SEO_TITLE' => 0,
    'SEO_KEYWORDS' => 0,
    'SEO_DESCRIPTION' => 0,
    'RESOURCE' => 0,
    'layout_header' => 0,
    'layout_footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_584e4f041fb962_85539381',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_584e4f041fb962_85539381')) {function content_584e4f041fb962_85539381($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_smarty_tpl->tpl_vars['SEO_TITLE']->value;?>
</title>
    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['SEO_KEYWORDS']->value;?>
" />
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['SEO_DESCRIPTION']->value;?>
" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/style/layout.css">
    
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/style/about.css">

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/MSClass.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/jquery1.42.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['RESOURCE']->value;?>
/js/showtab.js"></script>
    
</head>
<body>
	<div class="wrapper">
		<!--head-->
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_header']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="clear"></div>
		<!-- center -->
		
<div class="clear h8"></div>
<div class="main">
<!--左边-->
  <div class="par-main">
      <div id="breadcrumb"><div><span>您的当前位置：<a target='_blank' href="<?php echo $_smarty_tpl->tpl_vars['WEBSITE']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
</a>>><a href="#" onclick="return false;">来院路线</a></span></div></div>
      <h2 class="title">来院路线</h2>
      <div class="road">
      <?php $_smarty_tpl->tpl_vars['data'] = new Smarty_variable($_smarty_tpl->tpl_vars['ContactTag']->value->get('map'), null, 0);?>
        <div class="road-img">
          <!--引用百度地图API-->
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
           <div style="width:660px;height:620px;border:#ccc solid 1px;" id="dituContent"></div>

<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }

    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
		var point = new BMap.Point(<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('map');?>
);//定义一个中心点坐标
        map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }

    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }

    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
	map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }

    //标注点数组

	    var markerArr = [{title:"<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
",content:"电话：<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('tel');?>
<br/>",point:"<?php echo str_replace(',','|',$_smarty_tpl->tpl_vars['data']->value);?>
",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
		 ];

    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });

			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
				    this.openInfoWindow(_iw);
			    });
			    _iw.addEventListener("open",function(){
				    _marker.getLabel().hide();
			    })
			    _iw.addEventListener("close",function(){
				    _marker.getLabel().show();
			    })
				label.addEventListener("click",function(){
				    _marker.openInfoWindow(_iw);
			    })
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://map.baidu.com/image/us_cursor.gif", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }

    initMap();//创建和初始化地图
</script>
        </div>
        <div class="road-bottom">
        <p>
        <strong>您好!这里是<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('name');?>
联系方式: </strong><br/>
健康热线：<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('tel');?>
&nbsp;&nbsp;&nbsp;&nbsp; QQ咨询：<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('qq');?>
    <br/>
 联系地址：<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('address');?>
<br/>
 乘车路线:<?php echo $_smarty_tpl->tpl_vars['ContactTag']->value->get('route');?>

        </p>
        </div>
      </div>
    </div>

<!--左边 end-->
<!--右边-->
  <?php /*  Call merged included template "./common/right/doctor_right.htpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("./common/right/doctor_right.htpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '3983584e4f03ec8e53-40196013');
content_584e4f04196044_61629879($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "./common/right/doctor_right.htpl" */?>
<!--右边end-->

</div>

		<div class="clear"></div>
		<!-- footer -->
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['layout_footer']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="clear"></div>
	</div>
</body>
</html><?php }} ?><?php /* Smarty version Smarty-3.1.8, created on 2016-12-12 15:17:24
         compiled from "D:\wamp\www\newtemp\tpl\red\common\right\doctor_right.htpl" */ ?>
<?php if ($_valid && !is_callable('content_584e4f04196044_61629879')) {function content_584e4f04196044_61629879($_smarty_tpl) {?><!--right-->

<div class="w235">
        <!--特色技术-->
        <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['right_technology']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!--专家在线-->
    	<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['right_doctor']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!--预约-->
    	<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['right_reservation']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!--答疑-->
    	<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['right_ask']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<!--right end--><?php }} ?>