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
			openZoosUrl('chatwin');return false;
			break;
		case 'reservation':
			window.open('/reservation.html','reservationWindow');
			break;
	}
}

/**
 * 记录访问ip信息
 */
Layout.statiStics = function() {
	$.getScript('http://counter.sina.com.cn/ip/',function(){
		var ip      = ILData[0];
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
 * 初始化,截取弹窗标签
 */
$(document).ready(function(){
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


/*
   //动态获取swt和qq
   $("#qqOnline").click(function(){
        var qqNum;
        $.ajax({
            url:'/controller?controller=Contact&method=getContacts&flag=qq',
            type:"get",
            dataType:"json",
            success:function(ret){
                   qqNum = ret.data.val;
                   window.open('http://b.qq.com/webc.htm?new=0&sid='+ qqNum +'&o=www.qqyy.com&q=7', '_blank', 'height=502, width=644,top=100,left=300,toolbar=no,scrollbars=no,menubar=no,status=no');
            }
        });
    });


    $("#swtOnline").click(function(){
        var swt;
        $.ajax({
            url:'/controller?controller=Contact&method=getContacts&flag=swt',
            type:"get",
            dataType:"json",
            success:function(ret){
                swt = ret.data.val;
                window.open(swt, '_blank', 'height=502, width=800,top=100,left=200,toolbar=no,scrollbars=no,menubar=no,status=no');
            }
        });
    });*/
});