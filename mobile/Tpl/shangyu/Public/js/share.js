function Share() {
	var self = this;
	var sign = false;
	this.getUrlInfo = function(){
		var tourl   = window.location.href;
		if(tourl.match("sharename=") == "sharename="){
			var flag = decodeURI(tourl).split("sharename=");
			var sharename = flag[1].split('&')[0];
			sign = true;
		}
		var url= sign ? flag[0].substring(0,flag[0].length-1) : tourl;
		var item=[];
		item['news']=[];
		item['sdk']=[];
		item['score']=[];
		self.gData({controller:'Share',method:'myShare',url:url,sharename:sharename},function(ret){
			if(ret.statu){
				var news = ret.data.news;
				var sdk = ret.data.js_sdk;
				for(var k in news){
					item['news'][k] = news[k];
				}
				for(var i in sdk){
					item['sdk'][i] = sdk[i];
				}
				item['score'] = ret.data.score;
			}else{
				item = '';
			}
		});
		return item;
	}
	this.initWxConfig = function(){	
		var items = self.getUrlInfo();
		if(items){
			var score = items['score'] ? items['score'] : '';
			if(score){
				$(document).ready(function(){
					$('body').append('<div id="pageDialogBG" class="pageDialogBG"><div class="Prompt"></div></div>');					
					self.addsuccess('获得积分+'+score);
				})
			}
			var shareData = {
					title: items['news']['title'],
					desc:  items['news']['description'],
					link:  items['news']['url'],
					imgUrl: items['news']['picurl'],
					success: function (res) {
						//alert('分享成功');
					},
					cancel: function (res) {
						//alert('已取消分享');
					}	
				};
				wx.config({
					debug: false, // 
					appId: items['sdk']['appid'], // 公众号的唯一标识
					timestamp: items['sdk']['time'], // 生成签名的时间戳
					nonceStr: items['sdk']['nonceStr'], // 生成签名的随机串
					signature: items['sdk']['signature'],// 签名
					jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage']
				});	
				wx.ready(function () {	
					wx.onMenuShareAppMessage(shareData);
					wx.onMenuShareTimeline(shareData);
				});
				wx.error(function (res) {
				  alert(res.errMsg);
				});
		}
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
		$("#pageDialogBG").fadeOut(1000);
	}

}
var gShare = new Share();
gShare.initWxConfig();
