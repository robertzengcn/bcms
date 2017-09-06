function Score() {
	var self = this;
	this.initScore = function(){
		self.gData({controller:'Share',method:'sWeixin'},function(ret){
			if(ret.statu){
				$(document).ready(function(){
					$('body').append('<div id="pageDialogBG" class="pageDialogBG"><div class="Prompt"></div></div>');					
					self.addsuccess("恭喜您获得积分:+"+ret.data.score);
				})
			}
		});
	}
	this.gData = function(data,fun){
		var http = '/controller/';
		$.ajax({url:http,type:'post',cache : false,data:data,async : false,dataType:'json',success:function(re){fun(re);}});
	}
	
	this.addsuccess = function (dat){
		$("#pageDialogBG .Prompt").text("");
		var w=($(window).width()-255)/2,
			h=($(window).height()-45)/2;
		$("#pageDialogBG").css({top:h,left:w,opacity:0.8});
		$("#pageDialogBG").stop().fadeIn(1000);
		$("#pageDialogBG .Prompt").append('<s></s>'+dat);
		$(".Prompt s").css("background-position","0px -26px");
		$("#pageDialogBG").fadeOut(1000);
	}
}
var gScore = new Score();
gScore.initScore();