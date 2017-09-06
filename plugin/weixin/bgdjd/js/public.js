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
var bgdjd = $.extend({},{
	index: function(){
		$(".linebottom>div a").click(function(){
			var type_name = $(this).text();
			getData({controller:'Weixin',method:'reportContent',type_name:type_name},function(ret){
				if(ret.type == "report_items"){
				    url = encodeURI("itemlist.html?type_name="+type_name+"&classify_id=&timestamp="+new Date().getTime());
					window.open(url,'_self');
				}else{
					url = encodeURI("inspectionlist.html?type_name="+type_name+"&timestamp="+new Date().getTime());
					window.open(url,'_self');
				}
			});
		});	
	},
	
	inspectionlist:function(){
		var flag = decodeURI(window.location.search).split("&");		
		var type_name = flag[0].split('=')[1];
		$(".fl a").each(function(){
			if($(this).text() == type_name){
				$(this).siblings('a').removeClass('current');
				$(this).remove();
				$('.fl').prepend('<a href="#" class="current">'+type_name+'</a>');
			   $(".header h2").text(type_name);
				getData({controller:'Weixin',method:'getReportType',type_name:type_name},function(ret){
					$(ret.report_classify).each(function(i,v){
						if(v.examine_id != undefined){
							 var url = encodeURI("itemlist.html?type_name="+v.examine_name+"&classify_id="+v.classify_id+"&timestamp="+new Date().getTime());
							 $(".fr").append("<a href=\""+url+"\">"+v.examine_name+"</a>");			
						}else{
							 $(".fr").append("<a href=\"#\" class=\"subType\" classify_id=\""+v.classify_id+"\">"+v.type_name+"</a>");
						}
					});	 
				});	
			}
		});
		//页面内部 li点击
		$(document).on('click','.fl a',function(){
			var flag = $(this).text();
		    var url = encodeURI("inspectionlist.html?type_name="+flag+"&timestamp="+new Date().getTime());
			window.open(url,'_self');							 
		});
		$(document).on('click','.subType',function(){
			var subType = $(this).text();
			var classify_id = $(this).attr("classify_id");
			getData({controller:'Weixin',method:'getReportType',type_name:subType},function(ret){
					 var url = encodeURI("itemlist.html?type_name="+subType+"&classify_id="+classify_id+"&timestamp="+new Date().getTime());
				     window.open(url,'_self');
			});
		});
	},
	
	
	itemlist :function(){
		getData({controller:'Weixin',method:'syncSwt'}, function(){});
		var flag = decodeURI(window.location.search).split("&");
		var type_name = flag[0].split("=")[1];
		var classify_id = flag[1].split("=")[1];
		   $(".header h2").text(type_name);
		getData({controller:'Weixin',method:'reportContent',type_name:type_name,classify_id:classify_id},function(ret){
			
		  if(ret.report_items!=undefined&&ret.report_items.length !=0){		
			var item ='';
			$(ret.report_items).each(function(i,val){
				var code = '';
				if(val.code!=""){
					code = "<span>（"+val.code+"）</span>";
				}
				if(val.input_model == 2){
					 item +="<li class='item_li'><ul class='itemstyle_1'><li class='item_name'><p>"+val.project_name+"<br />"+code+"</p></li>";
				     item += "<li class='item_result'><input type='text' value='' class='result_input'/></li>";
				     if(val.reference_value.length>1){
				    	var m ="";
				    	$(val.reference_value).each(function(n,v){
				    		m += "<li class='info_li'>"+v+"</li>";
				    	});
				    	item +="<li class='item_ref'><p>"+val.unit+"<br />（<span class='more_itemcss'>"+val.reference_value[0]+"</span>）</p></li><div class='morelist_contain hidecss'><ul class='morereflist'><li class='title_li'><a id='close_bt'>关闭</a>选择参考值</li>"+m+"</ul></div></ul></li>";
				     }else{
				    	item +="<li class='item_ref'><p>"+val.unit+"<br />（"+val.reference_value[0]+"）</p></li></ul></li>";
				     }
				}else if(val.input_model == 3){
					item +="<li class='item_li'><ul class='itemstyle_2'><li class='item_name'><p>"+val.project_name+"<br />"+code+"<p></li><li class='item_options'><a href='javascript:' class='choose_css'>"+val.normal_value+"</a><a href='javascript:'>"+val.abnormal_value+"</a></li></ul></li>";
				}
			});	
			 $(".item_ul").append(item);

			$(document).on('click','#clear',function(){
				$(".result_input").val('');			
			});			
			$(document).on('click','.item_ref',function(){
				$(this).next("div").show();			
			});
			$(document).on('click','.item_options a',function(){
				$(this).siblings("a").removeClass("choose_css");
				$(this).addClass("choose_css");		
			});		
			$(document).on('click','#close_bt',function(){
				$(".morelist_contain").hide();			
			});	
			$(document).on('click','.morereflist .info_li',function(){
				$(this).siblings().removeClass("choose_value");
				$(this).addClass("choose_value");
				var re_value = $(this).text();
			    $(this).parent().parent().prev().find("span").text(re_value);
				//console.log(re_value,'re_value');
			});
			}else{
				$('.itembox, .advisevtbox').remove();						
			    $('body').append("<section class=\"advisevtbox\"><p><span>提醒：</span>抱歉，暂无查询结果。</p></section>");
			}
		});
		
		$(document).on('click','#sendReport',function(){
			var resultArr = [];
			var result = "";
			var referenceArr = [];
			var referenceValue = "";
			var flag = false;
			$(".itembox .item_ul .item_li").children("ul").each(function(i,e){				
				if($(this).attr("class") == "itemstyle_2"){
					result = $(this).children(".item_options").children('.choose_css').text();
					referenceValue = "";
				}else{
					result = $(this).children('.item_result').children('.result_input').val();
					referenceValue = $(this).children(".item_ref").children("p").children("span").text();
					if(result == "" && flag ==false){
						name  = $(this).children('.item_name').children("p").text();
						alert(name+"不能为空");
						flag = true;
					}
				}
				resultArr.push(result);
				referenceArr.push(referenceValue);			
			});
			if(flag ==false){
				getData({controller:'Weixin',method:'submitReport',type_name:type_name,resultArr:resultArr,referenceArr:referenceArr},function(ret){
					$("#body2").show();
					var diagnose ="检查正常，您很健康！";
					if(ret.diagnose !=""){
						var diagnose =ret.diagnose;
					}
					$(".results .res").html(diagnose);
				})
			}
		});	
		
		
	}
});




$(document).ready(function(){		
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
		var part = $(this).prev("input").val();
		if(part=='' ||part=='请输入您要查询的关键字') return false;
		getData({controller:'Weixin',method:'reportContent',type_name:part},function(ret){
			if(ret.type == "report_items"){
				url = encodeURI("itemlist.html?type_name="+part+"&classify_id=&timestamp="+new Date().getTime());
				window.open(url,'_self');
			}else{
				url = encodeURI("inspectionlist.html?type_name="+part+"&timestamp="+new Date().getTime());
				window.open(url,'_self');
			}
		});
	});
});