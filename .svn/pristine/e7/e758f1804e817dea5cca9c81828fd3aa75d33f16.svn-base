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
/*首页-搜索*/
$(document).on("click", "#show-alert", function() {
	var keyword = $('#search').val();
	var id = $('#id').val();
	if(keyword=='' || keyword==undefined){
		$.alert("请输入编号或姓名", "提示");
	}else{
		self.gData({controller:'VoteItem',method:'search',keyword:keyword,id:id},function(ret){
			if(ret.statu){
				$('#boyicms div').remove();
				var html='';
				$.each(ret.data,function(i,v){
					var html = '<div class="item player_box">';
					html +='<div class="outline"><div class="pic"><i class="number">'+v.id+'号</i>';
					html +='<a href="./vote.php?method=xiangqing&id='+v.vid+'&vid='+v.id+'"><img src="'+v.startpicurl1+'"></a>';
					html +='<p id="itid'+v.id+'">'+v.vcount+'票</p></div>';
					html +='<div class="vote"><p>'+v.item+'</p><a href="javascript:;" data-itid="'+v.id+'">投票</a></div></div></div>';
					$('#boyicms').append(html);
				});
			}else{
				$.alert("没有搜索到相关信息", "提示");
			}
		});
	}
 });


/*首页-投票*/
$(document).on("click", ".vote a", function() {
	var itid = $(this).attr("data-itid");
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
				var oldnum=$("#itid"+itid).html().replace(/票/,'');
				var num=parseInt(ret.data)+parseInt(oldnum);
				$("#itid"+itid).html(num+"票");
				self.addsuccess("投票成功");
			}else{
				self.addsuccess(ret.msg, 1);			
			}
		});
	//}
});
/*首页-搜索*/
$(document).on("click", ".upload_btn", function() {
	if($('input[name="username"]').val()==''){
		$.alert("请输入名称", "提示");
		return;
	}
	if($('input[name="telphone"]').val()==''){
		$.alert("请输入手机号", "提示");
		return;
	}
	if($('textarea[name="xuanyan"]').val()==''){
		$.alert("请输入参赛宣言", "提示");
		return;
	}
 });

}
var gVote = new Vote();
gVote.timer(parseInt($('#remtime').val()));
