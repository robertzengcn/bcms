/**
 * 功能：负责网站全局的弹窗以及头部js功能
 * author:Layout.item
 */
var Layout  = [];//layout原型
Layout.charUrl = '';//chat路径

Layout.setCharUrl = function( url ) {
	Layout.charUrl = url;
}

/**
 * 负责事件弹窗,并根据genre选择对应的地址来进行
 */
Layout.openWindow = function( genre ) {
	switch( genre ) {
		case 'chat':
			window.open(Layout.charUrl,'chatWindow');
			break;
		case 'reservation':
			window.open('/reservation/index.html','reservationWindow');
			break;
	}
}

/**
 * 记录访问ip信息
 */
Layout.statiStics = function() {
	var ip      = '';
	var fromurl = document.referrer;
	var tourl   = window.location.href;
	$.ajax({
		url      : '/controller/',
		data     : {controller:'StatisticsLog',method:'add',ip:ip,fromurl:fromurl,url:tourl},
		async    : true,
		type     : 'post',
		dataType : 'json',
		error    : function(obj,error){
			return false;
		},
		success  : function(ret){
			return true;
		}
	});
}

/**
 * 弹窗关闭
 */
Layout.close      = function( id ) {
	$("#"+id).parent().hide();
}

/**
 * 共用幻灯片触发
 */
Layout.marquee    = function() {
	new Marquee({
		MSClassID : "banner-box",
		ContentID : "banner-comtent",
		TabID	  : "banner-id",
		Direction : 2,
		Step	  : 0.3,
		Width	  : 980,
		Height	  : 320,
		Timer	  : 20,
		DelayTime : 2000,
		WaitTime  : 0,
		ScrollStep: 260,
		SwitchType: 1,
		AutoStart : 1
	})
}

/**
 * 加载远程js
 */
Layout.loadremotejs = function() {
	$.getScript("http://www.boyicms.com/interface/hwibs/script/_v1.js", function(data, status, jqxhr) {});
}

/**
 * 初始化,截取弹窗标签
 */
$(document).ready(function(){
	//加载远程js
	Layout.loadremotejs();
	//进行弹窗兼容
	$("area,a").click(function(){
		var href = $(this).attr('href');
		if( href != '' && href != null ) {
			if( href.indexOf('openWindow') != -1 ){
				if( href.indexOf('chat') != -1 ){
					Layout.openWindow('chat');
				}else if( href.indexOf('reservation') != -1 ){
					Layout.openWindow('reservation');
				}
				return false;
			}
		}
	});
	//记录
	Layout.statiStics();
});