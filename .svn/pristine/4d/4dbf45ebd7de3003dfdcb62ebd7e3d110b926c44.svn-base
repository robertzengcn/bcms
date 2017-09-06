// JavaScript Document

var getData = function(data,fun){
		var http = '/controller/index.php';
		$.ajax({
			url:http,
			type:'post',
			data:data,
			async : true,
			dataType:'json',
			success:function(re){
				fun(re);
			}
		});
};

var ysyj = $.extend({},{
	//首页 
	index :function(){
		$(".arr").click(function(){
			var type_name = $(this).parent().prev("h3").text();
			var url = encodeURI("list.html?type_name="+type_name+"&timestamp="+new Date().getTime());
			window.open(url,'_self');
		});
		$(".dis").click(function(){
			var context = $(this).text();
			var types = $(this).parent().prev("h3").text();
			url = encodeURI("foodinfo.html?context="+context+"&types="+types+"&timestamp="+new Date().getTime());
			window.open(url,'_self');		
		});
	},
	
	list : function(){
		    var flag = decodeURI(window.location.search).split("&");		
		    var type_name = flag[0].split('=')[1];
		$(".header h2").text('更多'+type_name);
		getData({controller:'Weixin',method:'getFoodTherapyMore',type_name:type_name},function(ret){
				$(ret.words).each(function(i,n){
					var word = n;
					word = word ? word : '其它';
					 var yinhtml ="<h6 class=\"bgGray pd3 word"+n+"\">"+word+"</h6>";
					 $(".arrlist").append(yinhtml);
				});
				$(ret.diseases).each(function(i,val){
					var name = val.split("|")[1];
					var yin = val.split("|")[0];
					var url = encodeURI("foodinfo.html?context="+name+"&types="+type_name+"&timestamp="+new Date().getTime());
					var namehtml ="<a href=\""+url+"\">"+name+"</a>";
					 $(namehtml).insertAfter('.word'+yin);					
				});
		});	
	},
	searchlist : function(){
		var flag = decodeURI(window.location.search).split("&");		
		var keyword = flag[0].split('=')[1];
		$(".header h2").text(keyword);
		$(".advisevtbox").append("	<p><span>提醒：</span>抱歉，暂时没有查询结果，请输入疾病名称进行查询。</p>");
	},
	
	foodinfo: function(){
		var flag = decodeURI(window.location.search).split("&");
		var context = flag[0].split("=")[1];
		var type_name = flag[1].split("=")[1];
		$(".header h2").text(context);
		getData({controller:'Weixin',method:'getFoodTherapy',context:context,type_name:type_name},function(ret){
			$(".suitablebox").append("<p>"+ret.good_food+"</p>");
			$(".unsuitablebox").append("<p>"+ret.bad_food+"</p>");
		});	
	}
	
	
	
});

$(document).ready(function(){					
	// 搜索
	$(".searchbox input").focus(function(){
		$(this).val("");
	});
	$(".searchbox input").blur(function(){
		var obj = $(this).val();
		if(obj=="")
		{
			$(this).val("请输入您要查询的关键字");
		}
	});	
	$("#seachBtn").click(function(){
		var keyword = $(this).prev("input").val();
		if(keyword=='' ||keyword=='请输入您要查询的关键字') return false;
		getData({controller:'Weixin',method:'getFoodTherapy',context:keyword,type_name:""},function(ret){
			if(ret.good_food!=""||ret.bad_food!=""){
				url = encodeURI("foodinfo.html?context="+keyword+"&types=&timestamp="+new Date().getTime());
				window.open(url,'_self');
			}else{
				url = encodeURI("searchlist.html?keyword="+keyword+"&timestamp="+new Date().getTime());
				window.open(url,'_self');
			}
		});
	
	});
});

