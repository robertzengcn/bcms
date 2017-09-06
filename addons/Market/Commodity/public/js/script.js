//商品规格选择
$(function() {
	$(".theme-options").each(function() {
		var i = $(this);
		var p = i.find("ul>li");
		p.click(function() {
			if (!!$(this).hasClass("selected")) {
				$(this).removeClass("selected");

			} else {
				$(this).addClass("selected").siblings("li").removeClass("selected");

			}

		})
	})
})
$(document).ready(function() {
	//弹出规格选择
	var ww = $(window).width();
	if (ww <1025) {
		$('.theme-login').click(function() {
			$(document.body).css("position", "fixed");
			$('.theme-popover-mask').show();
			$('.theme-popover').slideDown(200);
			var gid =$(this).attr('flag'); 
			var src = $(this).parent().parent().parent().find('li img').attr('src');
			var price = $(this).parent().parent().parent().find('li .J_Price').text();
			var num = $(this).parent().parent().parent().find('li .text_box').attr('value');
			var stock = $("#goods"+gid).find('.J_stock').attr('value');
			var limitnum = $("#goods"+gid).find('.J_limit').attr('value');
			if(src != 'undefined' && src != ''){
				$('.img-info img').attr('src',src);
			}
			if(price != 'undefined' && price != ''){
				$('.theme-signin-right .J_Price').text(price);
			}
			if(num != 'undefined' && num != ''){
				$('.theme-options .text_box').attr('value',num);
			}
			if(stock != 'undefined' && stock != ''){
				$('.theme-options .stock').text(stock);
				$('.theme-signin-right .stock').text(stock);
			}
			if(limitnum != undefined){
				$('#limitnum').val(limitnum);
			}			
			$('#J_gid').val(gid);
		})

		$('.theme-poptit .close,.btn-op .close,.theme-popover-mask').click(function() {
			$(document.body).css("position", "static");
			//					滚动条复位
			$('.theme-signin-left').scrollTop(0);

			$('.theme-popover-mask').hide();
			$('.theme-popover').slideUp(200);
		})
	}
	//导航固定
	var dv = $('ul.am-tabs-nav.am-nav.am-nav-tabs'),
		st;

	if (ww < 623) {

				var tp =ww+363;
				$(window).scroll(function() {
					st = Math.max(document.body.scrollTop || document.documentElement.scrollTop);
					if (st >= tp) {
						if (dv.css('position') != 'fixed') dv.css({
							'position': 'fixed',
							top: 53,
							'z-index': 1000009
						});

					} else if (dv.css('position') != 'static') dv.css({
						'position': 'static'
					});
				});
				//滚动条复位（需要减去固定导航的高度）

				$('.introduceMain ul li').click(function() {
					sts = tp;
					$(document).scrollTop(sts);
				});
       } else {

		dv.attr('otop', dv.offset().top); //存储原来的距离顶部的距离
		var tp = parseInt(dv.attr('otop'))+36;
		$(window).scroll(function() {
			st = Math.max(document.body.scrollTop || document.documentElement.scrollTop);
			if (st >= tp) {
             
					if (dv.css('position') != 'fixed') dv.css({
						'position': 'fixed',
						top: 0,
						'z-index': 998
					});

				//滚动条复位	
				$('.introduceMain ul li').click(function() {
					sts = tp-35;
					$(document).scrollTop(sts);
				});

			} else if (dv.css('position') != 'static') dv.css({
				'position': 'static'
			});
		});



	}
	var hh = document.documentElement.clientHeight;
	var ls = document.documentElement.clientWidth;
	if (ls < 640) {



		$(".select dt").click(function() {
			if ($(this).next("div").css("display") == 'none') {
				$(".theme-popover-mask").height(hh);
				$(".theme-popover").css("position", "fixed");
				$(this).next("div").slideToggle("slow");
				$(".select div").not($(this).next()).hide();
			}
          else{
          	$(".theme-popover-mask").height(0);
			$(".theme-popover").css("position", "static");
			$(this).next("div").slideUp("slow");;
          }

		})


		$(".eliminateCriteria").live("click", function() {
			$(".dd-conent").hide();
		})

		$(".select dd").live("click", function() {
			$(".theme-popover-mask").height(0);
			$(".theme-popover").css("position", "static");
			$(".dd-conent").hide();
		});
	}


	$("span.love").click(function() {
		$(this).toggleClass("active");
	});


	$("#select1 dd").click(function() {
		$(this).addClass("selected").siblings().removeClass("selected");
		if ($(this).hasClass("select-all")) {
			$("#selectA").remove();
		} else {
			var copyThisA = $(this).clone();
			if ($("#selectA").length > 0) {
				$("#selectA a").html($(this).text());
			} else {
				$(".select-result dl").append(copyThisA.attr("id", "selectA"));

			}
		}
	});

	$("#select2 dd").click(function() {
		$(this).addClass("selected").siblings().removeClass("selected");
		if ($(this).hasClass("select-all")) {
			$("#selectB").remove();
		} else {
			var copyThisB = $(this).clone();
			if ($("#selectB").length > 0) {
				$("#selectB a").html($(this).text());
			} else {
				$(".select-result dl").append(copyThisB.attr("id", "selectB"));
			}
		}
	});

	$("#select3 dd").click(function() {
		$(this).addClass("selected").siblings().removeClass("selected");
		if ($(this).hasClass("select-all")) {
			$("#selectC").remove();
		} else {
			var copyThisC = $(this).clone();
			if ($("#selectC").length > 0) {
				$("#selectC a").html($(this).text());
			} else {
				$(".select-result dl").append(copyThisC.attr("id", "selectC"));
			}
		}
	});

	$("#selectA").live("click", function() {
		$(this).remove();
		$("#select1 .select-all").addClass("selected").siblings().removeClass("selected");
	});

	$("#selectB").live("click", function() {
		$(this).remove();
		$("#select2 .select-all").addClass("selected").siblings().removeClass("selected");
	});

	$("#selectC").live("click", function() {
		$(this).remove();
		$("#select3 .select-all").addClass("selected").siblings().removeClass("selected");
	});

	$(".select dd").live("click", function() {
		if ($(".select-result dd").length > 1) {
			$(".select-no").hide();
			$(".eliminateCriteria").show();
			$(".select-result").show();
		} else {
			$(".select-no").show();
			$(".select-result").hide();

		}
	});

	$(".eliminateCriteria").live("click", function() {
		$("#selectA").remove();
		$("#selectB").remove();
		$("#selectC").remove();
		$(".select-all").addClass("selected").siblings().removeClass("selected");
		$(".eliminateCriteria").hide();
		$(".select-no").show();
		$(".select-result").hide();
			var url = '';
			var flag = decodeURI(window.location.href).split("&");
				$.each(flag,function(i,v){
					if(v.match("id")==null)url += v +'&';
				})
		url=url.substring(0,url.length-1)
		window.location.href = url;	
	});
	//优惠券
	$(".hot span").click(function() {
		$(".shopPromotion.gold .coupon").toggle();
	})

	
	
	//获得文本框对象
	var t = $("#text_box");
	//初始化数量为1,并失效减
	$('#min').attr('disabled', true);
	//数量增加操作
	$("#add").click(function() {
		if($("#Stock .stock").text() == 0) return false;
		if($('#limitnum').val() != 0 && t.val()>=1){
			if($('#limitnum').val() == 1){
				addsuccess('每户限购1件商品');
				return false;
			}
			var limit = parseInt($('#limitnum').val())-1;
			if($('#limitnum').val()>1 && t.val() >= limit){
				addsuccess('每户每月限购'+limit+'件商品');
				return false;				
			}
		}
			t.val(parseInt(t.val()) + 1)
			if (parseInt(t.val()) != 1) {
				$('#min').attr('disabled', false);
			}

		})
		//数量减少操作
	$("#min").click(function() {
		t.val(parseInt(t.val()) - 1);
		if (parseInt(t.val()) == 1) {
			$('#min').attr('disabled', true);
		}

	})

		//确认
	$("#true").click(function() {
		if($("#Stock .stock").text() == 0){
			addsuccess('没有库存');
			return false;
		}
		if($('#limitnum').val() != 0 && t.val()>=1){
			if($('#limitnum').val() == 1){
				addsuccess('每户限购1件商品');
				return false;
			}
			var limit = parseInt($('#limitnum').val())-1;
			if($('#limitnum').val()>1 && t.val() >= limit){
				addsuccess('每户每月限购'+limit+'件商品');
				return false;				
			}
		}
		var num = $('#text_box').val();
		var score = $('#score').val();
		var gid = $('#gid').val();
		var lnum = $('#limitnum').val();
		getData({method:'_userStatus',num:num,score:score,gid:gid,lnum:lnum},function(re){
			if(re.status==2){
				var flag = decodeURI(window.location.href).split("?");
				var url = flag[0]+'?method=cart&timestamp='+new Date().getTime();
					getData({method:'_addShopCart',id:gid,num:num,type:'cart'},function(ret){
						if(ret.code == 1){
							window.open(url,'_self');
						}
					});
			}else if(re.status==1){
				addsuccess('你得积分不够');				
			}else if(re.status==3){
				addsuccess('你已兑购过此商品');					      
			}else if(re.status==4){
				addsuccess('本月你已兑购过此商品');					      
			}else if(re.status==5){
				addsuccess('本月你对此商品兑购次数已用完');					      
			}else{
				addsuccess('请先登录');				
			}
		});
	})
	$('.J_sure').live('click',function(){
		if($("#Stock .stock").text() == 0){
			addsuccess('没有库存');
			return false;
		}
		if($('#limitnum').val() != 0 && t.val()>=1){
			if($('#limitnum').val() == 1){
				addsuccess('每户限购1件商品');
				return false;
			}
			var limit = parseInt($('#limitnum').val())-1;
			if($('#limitnum').val()>1 && t.val() >= limit){
				addsuccess('每户每月限购'+limit+'件商品');
				return false;				
			}
		}
		var gid = $('#J_gid').val();
		var score = $('#goods'+gid).find('.J_score').attr('value');
		var num = $('.theme-options .text_box').attr('value');
		getData({method:'_userStatus',num:num,score:score},function(re){
			if(re.status==2){
					getData({method:'_addShopCart',id:gid,num:num,type:'cart'},function(ret){
						if(ret.code == 1){
							var flag = decodeURI(window.location.href).split("?");
							var url = flag[0]+'?method=cart&timestamp='+new Date().getTime();
							window.open(url,'_self');
						}
					});
			}else if(re.status==1){
				addsuccess('你得积分不够');				
			}else{
				//var login = '';
				//window.open(login,'_self');				      
			}
		});			
	})
	//删除购物车物品
	var n = function(s, r, q) {
		$.PageDialog.confirm(s, r, q)
	};
	var e = function(t, s, r, q) {
		$.PageDialog.fail(t, s, r, q)
	};
    var a = $("#cartBody");
	$(".list-del", a).each(function(q) {
		$(this).live("click",
		function() {			 
			var r = $(this);
			var t = r.attr("flag");
			var s = function() {
				var u = function(v) {					 
					if (v.code == 1) {
						var flag = decodeURI(window.location.href).split("?");
						var url = flag[0]+'?method=cart&timestamp='+new Date().getTime();
						window.open(url,'_self');														
					} else {
						e("删除失败，请重试")
					}
				};
				getData({method:'_delCartItem',gid:t}, u)
			};
			n("您确定要删除吗？", s)
		})
	});

	//pay
	$("#J_Go").live("click",function(){
		var moenycount = $('input[name="MoenyCount"]').val();
		var scorecount = $('input[name="ScoreCount"]').val();
		var num = 1;
		if((moenycount+scorecount) == 0){
			addsuccess('购物车暂无物品');
			return false;
		}
		getData({method:'_userStatus',num:num,score:scorecount},function(re){
			if(re.status==2){
				getData({method:'pay',moenycount:moenycount,scorecount:scorecount},function(ret){					
					if(ret.status==1){
						var flag = decodeURI(window.location.href).split("?");
						var success = flag[0]+'?method=success&timestamp='+new Date().getTime();
						window.open(success,'_self');
					}else{
						addsuccess('购物车暂无物品');						
					}					
				})
			}else if(re.status==1){
				addsuccess('你得积分不够');				
			}else{
				//var login = '';
				//window.open(login,'_self');				      
			}
		});
	})
	var addsuccess = function (dat){
		$("#pageDialogBG .Prompt").text("");
		var w=($(window).width()-255)/2,
			h=($(window).height()-45)/2;
		$("#pageDialogBG").css({top:h,left:w,opacity:0.8});
		$("#pageDialogBG").stop().fadeIn(1000);
		$("#pageDialogBG .Prompt").append('<s></s>'+dat);
		$("#pageDialogBG").fadeOut(1000);
	}
	var getData = function(data,fun){
			var http = '/addons/commodity.php';
			$.ajax({url:http,type:'post',data:data,async:true,dataType:'json',
				beforeSend:function(){$("#loading").show();}, 
				success:function(re){
					fun(re);
					$("#loading").hide();
				}
			});
	}

});