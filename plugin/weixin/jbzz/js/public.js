var getData = function(data,fun){
		var http = '/controller/';
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

var jbzz = $.extend({},{
	diseaselist:function(){
		//页面内部 a点击
		$(".fl a").click(function(){
			var flag = $(this).text();
		    url = encodeURI("diseaselist.html?flag="+flag+"&timestamp="+new Date().getTime());
			window.open(url,'_self');							 
		});
		init();
		//首次url跳转 定位身体部位
		function init(){
		    var flag = decodeURI(window.location.search).split("&");		
		    var typename = flag[0].split('=')[1];
			$(".fl a").each(function(){
				if($(this).text() == typename){
					$(this).siblings('a').removeClass('current');
					$(this).remove();
					$('.fl').prepend('<a href="#" class="current">'+typename+'</a>');
					part = $(this).text();
					id = "1234";
				    type = 'part';
					getData({controller:'Weixin',method:'autognosis',id:id,type:type,part:part},function(ret){
						$(ret.symptoms).each(function(i,val){
						    symptom = val.symptom;
						    var url = encodeURI("ACsymptoms.html?symptom="+symptom+"&timestamp="+new Date().getTime());
							$(".fr").append("<a href=\""+url+"\">"+symptom+"</a>")
						});
					});	
					
				}
			});
			
		}
		
		
	},
	diseaseresult: function(){
		var flag = decodeURI(window.location.search).split("&");
		var symptom = flag[0].split('=')[1];
		var assName = flag[1].split('=')[1];
		var sickness = flag[2].split('=')[1];
		$(".header h2").html(symptom?symptom:'疾病自诊');
		$("#diseasetitle").text(sickness);
		function diseaseresult(){
			id = '1234';
		    type = 'sickness';
		    sickness = sickness;
			getData({controller:'Weixin',method:'diseaseresult',id:id,type:type,sickness:sickness},function(ret){	
				$(".info1 p").html(ret.content.summarize);
				$(".info2 p").html(ret.content.clinical);
				$(".info3 p").html(ret.content.examine);
				$(".info4 p").html(ret.content.cure);
			});	
		}
		 diseaseresult();
			
		function assSymptomfun(){
				id = '1234';
			    type = 'symptom';
			    symptom = symptom;
			    assSymptom = assName;
				getData({controller:'Weixin',method:'assSymptom',id:id,type:type,symptom:symptom,assSymptom:assSymptom},function(ret){
				if(ret.assSymptoms!="null"){
					$(ret.assSymptoms).each(function(i,val){
						assName = val.assName;
					    url = encodeURI("Diagnosis.html?symptom="+symptom+"&assName="+assName+"&timestamp="+new Date().getTime());
						$(".dis_right ul").append("<li><a href=\""+url+"\">"+assName+"</a></li>")
					});
				}else{
					$(ret.sickness).each(function(i,val){
						if(val.name!= sickness){
							 url = encodeURI("diseaseresult.html?symptom="+symptom+"&assName="+assName+"&sickness="+val.name+"&timestamp="+new Date().getTime());
							 $(".dislist ul").append("<li><a href=\""+url+"\">"+val.name+"</a></li>");			
						}else{
							 $(".dislist ul").append("<li><a href='./index.html'>不好意思，没有其他诊断结果了</a></li>");			
						}
						
					});
				}
				});	
				
		};
		assSymptomfun();
		 
	
	},
	searchlist : function(){
		var flag = decodeURI(window.location.search).split("=");
		var s1 = flag[0].split("?")[1];
			$(".clearfix h2").text(flag[1]);
		if(s1 === "sickness"){
		    sickness = flag[1];
			getData({controller:'Weixin',method:'keySearch',part:sickness},function(ret){
				$(ret.sickness).each(function(i,val){
					 url = encodeURI("diseaseresult.html?symptom="+""+"&assName="+""+"&sickness="+val.name+"&timestamp="+new Date().getTime());
					$(".arrlist").append("<a href=\""+url+"\"><span class=\"icons\"></span>"+val.name+"</a>");
				});
				
			});	
		}else if (s1 === "assSymptom"){
			assSymptom = flag[1];
			$(".arrlist").append("<a href='#'>抱歉，暂无查询结果，请输入身体部位或者疾病名称搜索</a>");				
		}
	},
	diagnosis:function(){
		var flag = decodeURI(window.location.search).split("&");
		var symptom = flag[0].split('=')[1];
		var assName = flag[1].split('=')[1];
			$(".clearfix h2").text(symptom);
		$(".bgGray").html(assName+'诊断结果');
	    assSymptomfun();
		function assSymptomfun(){
			id = '1234';
		    type = 'symptom';
		    symptom = symptom;
		    assSymptom = assName;
			getData({controller:'Weixin',method:'assSymptom',id:id,type:type,symptom:symptom,assSymptom:assSymptom},function(ret){
				sickness = ret.sickness;		
				$(sickness).each(function(i,val){
					 url = encodeURI("diseaseresult.html?symptom="+symptom+"&assName="+assName+"&sickness="+val.name+"&timestamp="+new Date().getTime());
					 $(".result ul").append("<li><span>"+val.name+"</span><p><a href=\""+url+"\">疾病详情 ></a></p></li>");
				});
			});	
		};
	},
	acsymptoms: function(){
		var flag = decodeURI(window.location.search).split("&");
		var typename = flag[0].split('=')[1];
	    assSymptomfun();
		function assSymptomfun(){
			id = '1234';
		    type = 'symptom';
		    symptom = typename;
		    assSymptom = 'null';
			getData({controller:'Weixin',method:'assSymptom',id:id,type:type,symptom:symptom,assSymptom:assSymptom},function(ret){
				$(".header h2").text(typename);
			if(ret.assSymptoms!=null){
				$(ret.assSymptoms).each(function(i,val){
					assName = val.assName;
				    url = encodeURI("Diagnosis.html?symptom="+symptom+"&assName="+assName+"&timestamp="+new Date().getTime());					
					$(".arrlist").append("<a href=\""+url+"\"><span class=\"icons\"></span>"+assName+"</a>");
				});
			}else{
				$(ret.sickness).each(function(i,val){
					 url = encodeURI("diseaseresult.html?symptom="+symptom+"&assName="+assSymptom+"&sickness="+val.name+"&timestamp="+new Date().getTime());
					 $(".arrlist").append("<a href=\""+url+"\"><span class=\"icons\"></span>"+val.name+"</a>")
				});
			}
			});	
			
		};
	}
	
	
});


$(document).ready(function(){
	$(".disinfo .infobox").click(function(){
		if($(this).find("div").css("display")=='none'){
			$(this).find("div").show();
			$(this).siblings('div').find("div").hide();
		}else{
			$(this).find("div").hide();
		}
									
	});		
	$(".todislist").click(function(){
		var flag = $(this).attr('flag');
	    url = encodeURI("diseaselist.html?flag="+flag+"&timestamp="+new Date().getTime());
		window.open(url,'_self');
	});
		$('.more').click(function(){
			$('.humanA').toggle();
			$('.humanB').toggle();
		})
	
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
		getData({controller:'Weixin',method:'keySearch',part:part},function(ret){	
			if(ret.symptoms){
				url = encodeURI("diseaselist.html?flag="+part+"&timestamp="+new Date().getTime());
				window.open(url,'_self');
			}else if(ret.assSymptoms){
				url = encodeURI("searchlist.html?assSymptom="+part+"&timestamp="+new Date().getTime());
			    window.open(url,'_self');
			}else if(ret.sickness){
			    url = encodeURI("searchlist.html?sickness="+part+"&timestamp="+new Date().getTime());
			    window.open(url,'_self');
			}else{
				url = encodeURI("searchlist.html?assSymptom="+part+"&timestamp="+new Date().getTime());
			    window.open(url,'_self');
			}
		});			
		
	});

	var screen_width=$(window).width();
	var screen_height=$(window).height();
	$("body").css('height',screen_height);
	$(".bodybox").css('margin-top',(screen_height-400)/2);
	
});