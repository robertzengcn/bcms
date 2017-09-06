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

var slys = $.extend({},{
	index : function(){
		$(".arr").click(function(){
			var type_name = $(this).parent().prev("h3").text();
			var url = encodeURI("list.html?type_name="+type_name+"&timestamp="+new Date().getTime());
			window.open(url,'_self');
		});	
		$(".dis").click(function(){
			var type = 'food_get_disease';
			var type_name = $(this).text();
			var types = $(this).parent().prev("h3").text();
			url = encodeURI("diseaselist.html?type_name="+type_name+"&types="+types+"&timestamp="+new Date().getTime());
			window.open(url,'_self');		
		});	
	},
	diseaselist : function(){
		var type = 'food_get_disease';
		var flag = decodeURI(window.location.search).split("&");
		var type_name = flag[0].split("=")[1];
		var types = flag[1].split("=")[1];
		$(".header h2").text(types);
		$(".bgGray").text(type_name+'详细分类');
		getData({controller:'Weixin',method:'foodTherapyDis',type:type,type_name:type_name},function(ret){	
			if(ret.diseases.length>0){
				$(ret.diseases).each(function(i,val){
					var name = val;
					 url = encodeURI("foodlist.html?classtype="+name+"&diseasename="+type_name+"&types="+types+"&timestamp="+new Date().getTime());
					 $(".arrlist").append("<a href=\""+url+"\"><span class=\"icons\"></span>"+val+"</a>")
				});
			}else{
				 $(".arrlist").append("<a href='#'>抱歉,暂无查询结果,请输入疾病名称来查询</a>")
			}
		});	
	},
	foodlist : function(){
		var flag = decodeURI(window.location.search).split("&");
		var classtype = flag[0].split("=")[1];
		var diseasename = flag[1].split("=")[1];
		var types = flag[2].split("=")[1];
		var type = "food_therapy";
		$(".header h2").text(diseasename);
		$(".bgGray").text(classtype);
		getData({controller:'Weixin',method:'foodTherapyList',type:type,classtype:classtype,diseasename:diseasename,types:types},function(ret){	
			$(ret.contexts).each(function(i,val){
				 var url = encodeURI("foodinfo.html?food_name="+val.context_name+"&id="+val.id+"&classtype="+classtype+"&diseasename="+diseasename+"&types="+types+"&timestamp="+new Date().getTime());
				 $(".result ul").append("<li class=\"bgarrow\"><a href=\""+url+"\">"+"<h2>食谱名称："+val.context_name+"</h2>"+"<p>功效：辅助治疗"+diseasename+"</p></a></li>")
			});
		});	
	},
	foodinfo : function(){
		getData({controller:'Weixin',method:'syncSwt'}, function(){});
		$(document).on('click',".foodlist>div",function() {
			$(this).addClass('current').siblings('div').removeClass('current');
		});	
		var flag = decodeURI(window.location.search).split("&");
		var food_name = flag[0].split("=")[1];
		var id = flag[1].split("=")[1];
		var classtype = flag[2].split("=")[1];
		var diseasename = flag[3].split("=")[1];
		var types = flag[4].split("=")[1];
		$(".header h2").text(classtype);		
		getData({controller:'Weixin',method:'foodTherapyInfo',food_name:food_name,id:id,classtype:classtype,diseasename:diseasename,types:types},function(ret){
			$(".current").append("<h4 class=\"jbnav pd3\"><span class=\"icons\"></span>"+ret.food_name+"<br /><em>功效：辅助治疗"+diseasename+"</em></h4><div class=\"pd3\"><p><strong>原料</strong></p>"+ret.material+"<p><strong>制作</strong></p>"+ret.make+"<p><strong>用法</strong></p>"+ret.usage+"</div>");
		    $(ret.same_food).each(function(i,val){
			   var content = "<h4 class=\"jbnav pd3\"><span class=\"icons\"></span>"+val.food_name+"<br /><em>功效：辅助治疗"+diseasename+"</em></h4><div class=\"pd3\"><p><strong>原料</strong></p>"+val.material+"<p><strong>制作</strong></p>"+val.make+"<p><strong>用法</strong></p>"+val.usage+"</div>";
				$(".foodlist").append("<div class=\"foodnav\">"+content+"</div>");
		    });
		
		});		
	},
	list :function(){
		var type = 'get_disease_by_types';
		var flag = decodeURI(window.location.search).split("&");		
		var type_name = flag[0].split('=')[1];
		$(".header h2").text('更多'+type_name);
		getData({controller:'Weixin',method:'foodTherapyDis',type:type,type_name:type_name},function(ret){
				$(ret.words).each(function(i,n){
					var word = n;
					word = word ? word : '其它';
					 var yinhtml ="<h6 class=\"bgGray pd3 word"+n+"\">"+word+"</h6>";
					 $(".arrlist").append(yinhtml);
				});
				$(ret.diseases).each(function(i,val){
					var name = val.split("|")[1];
					var yin = val.split("|")[0];
					var url = encodeURI("diseaselist.html?type_name="+name+"&types="+type_name+"&timestamp="+new Date().getTime());
					var namehtml ="<a href=\""+url+"\">"+name+"</a>";
					 $(namehtml).insertAfter('.word'+yin);					
				});
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
		var type_name = $(this).prev("input").val();
		if(type_name=='' ||type_name=='请输入您要查询的关键字') return false;
		url = encodeURI("diseaselist.html?type_name="+type_name+"&types=&timestamp="+new Date().getTime());
		window.open(url,'_self');	
	});
});

