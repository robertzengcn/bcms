function Ranking() {
	var self = this;
	
/*首页-活动倒计时*/
this.timer = function(intDiff){
	window.setInterval(function(){
	var day=0,
		hour=0,
		minute=0,
		second=0;//时间默认值		
	if(intDiff > 0){
		day = Math.floor(intDiff / (60 * 60 * 24));
		hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
		minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
		second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
	}
	if (minute <= 9) minute = '0' + minute;
	if (second <= 9) second = '0' + second;
	$('#day_show').html(day+"天");
	$('#hour_show').html('<s id="h"></s>'+hour+'时');
	$('#minute_show').html('<s></s>'+minute+'分');
	$('#second_show').html('<s></s>'+second+'秒');
	intDiff--;
	}, 1000);
} 
this.gData = function(data,fun){
	var http = '/controller/';
	$.ajax({url:http,type:'post',cache : false,data:data,async : true ,dataType:'json',success:function(re){fun(re);}});
}

this.addsuccess = function (dat,i){
	$("#pageDialogBG .Prompt").text("");
	var w=($(window).width()-255)/2,
		h=($(window).height()-45)/2;
	$("#pageDialogBG").css({top:h,left:w,opacity:0.8});
	$("#pageDialogBG").stop().fadeIn(1000);
	$("#pageDialogBG .Prompt").append('<s></s>'+dat);
	if(i==1)$(".Prompt s").css("background-position","0px -26px");
	$("#pageDialogBG").fadeOut(1000);
}
}
var gRanking = new Ranking();
gRanking.timer(parseInt($('#remtime').val()));