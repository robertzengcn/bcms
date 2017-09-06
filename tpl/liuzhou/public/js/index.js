// JavaScript Document

/*js最后加载-开始*/
window.onload=function(){

/*导航*/
var has_slide = '0';

$(document).ready(function(){
	$('#wydh li.mainlevel').mouseenter(function(){
		if(has_slide == 1){
			$(this).find('ul').slideDown("fast");
		}else{
			$(this).find('ul').show();
		}
	});
	$('#wydh li.mainlevel').mouseleave(function(){
		if(has_slide == 1){
			$(this).find('ul').slideUp("fast");
		}else{
			$(this).find('ul').hide();
		}
	});
});
$('.header_nav .navbar-nav li.mainlevel:not(.disabled)').mouseenter(function() {
  $(this).closest('.navbar-nav').find('li.active').removeClass('active');
  $(this).addClass('active');
});
$('.header_nav .navbar-nav li.mainlevel:not(.disabled)').mouseleave(function() {
  $(this).closest('.navbar-nav').find('li.active').removeClass('active');
});

/*首页最新公告*/
 var box = document.getElementById("zxgg_list"), can = true;
 box.innerHTML += box.innerHTML;
 box.onmouseover = function () { can = false };
 box.onmouseout = function () { can = true };
 new function () {
 var stop = box.scrollTop % 33 == 0 && !can;
 if (!stop) box.scrollTop == parseInt(box.scrollHeight / 2) ? box.scrollTop = 0 : box.scrollTop++;
 setTimeout(arguments.callee, box.scrollTop % 33 ? 10 : 1500);
 };

/*首页科室导航*/
$(function ()
{   
	$('.home_ks > li .ks_box').hide()/*.eq(0).show()*/
	$('.home_ks li').mouseenter(function() {
		$(".home_ks > li .ks_box").hide()//将main下所有的div都隐藏
		$(".home_ks > li .ks_box:eq(" + $(this).index() + ")").show(); //链接对应的div显示
	});
	$('.home_ks > li').mouseleave(function() {
		$(".home_ks > li .ks_box").hide()//将main下所有的div都隐藏
	});
});


/*首页专家滚动*/
jQuery(".home_zj_left").slide({mainCell:".bd ul",autoPlay:true,effect:"leftMarquee",vis:4,interTime:20,trigger:"click"});
/*首页友情链接*/
jQuery(".yqlj_left").slide({mainCell:".bd ul",autoPage:true,effect:"leftLoop",autoPlay:true,vis:9,trigger:"click"});



}/*js最后加载-结束*/

/*回到顶部*/
$(function () {
	//当滚动条的位置处于距顶部400像素以下时，跳转链接出现，否则消失 
	$(function () {
		$(window).scroll(function () {
			if ($(window).scrollTop() > 400) {
				$("#back-to-top").fadeIn(1500);
			}
			else {
				$("#back-to-top").fadeOut(1500);
			}
		});
		//当点击跳转链接后，回到页面顶部位置 
		$("#back-to-top").click(function () {
			$('body,html').animate({ scrollTop: 0 }, 1000);
			return false;
		});
	});
});
 


// 设置为主页
function SetHome(obj,vrl){
try{
obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
}
catch(e){
if(window.netscape) {
try {
netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
}
catch (e) {
alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
}
var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
prefs.setCharPref('browser.startup.homepage',vrl);
}else{
alert("您的浏览器不支持，请按照下面步骤操作：1.打开浏览器设置。2.点击设置网页。3.输入："+vrl+"点击确定。");
}
}
}
// 加入收藏 兼容360和IE6
function shoucang(sTitle,sURL)
{
try
{
window.external.addFavorite(sURL, sTitle);
}
catch (e)
{
try
{
window.sidebar.addPanel(sTitle, sURL, "");
}
catch (e)
{
alert("加入收藏失败，请使用Ctrl+D进行添加");
}
}
}
