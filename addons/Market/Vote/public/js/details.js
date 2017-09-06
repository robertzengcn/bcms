function Vote() {
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

/*投票*/
$(document).on("click", ".js_vote", function() {
	var itid = $("#vid").val();
	var ktcs = $('#ktcs').val();
	var mcsl = $('#mcsl').val();
	//var wxgz = $('#wxgz').val();
	var id = $('#id').val();
	var openid = $('#openid').val();
	//if(wxgz==0){
	//	$('#guanzhu').show();
	//}else{
		self.gData({controller:'VoteItem',method:'gVoteAjax',id:id,itid:itid,vnum:mcsl,openid:openid,ktcs:ktcs},function(ret){
			if(ret.statu){
				var oldnum=$(".js_num").html().replace(/票/,'');
				var num=parseInt(ret.data)+parseInt(oldnum);
				//$(".details_pic span").html(num+"票");
				$(".js_num").html(num+"票");
				self.addsuccess("投票成功");
			}else{
				self.addsuccess(ret.msg, 1);		
			}
		});
	//}
});

}
var gVote = new Vote();
gVote.timer(parseInt($('#remtime').val()));