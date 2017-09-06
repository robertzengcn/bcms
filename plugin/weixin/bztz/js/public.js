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
var bztz = $.extend({},{
	article: function(){
	 getData({controller:'Weixin',method:'syncSwt'}, function(){});		
	}
});
$(document).ready(function(){

	$("#bmiTest").click(function(){		
		if($("#height").val()==""){
			alert("请输入您的身高");
			return false;
		}
		if($("#weight").val()==""){
			alert("请输入您的体重");
			return false;
		}
		
		if($("#height").val()!="" && $("#weight").val()!=""){
			$(".resultbox").show();
			
			var height = $("#height").val();
			var weight = $("#weight").val();
			var sex = $("input[name='sex']:checked").val();
			getData({controller:'Weixin',method:'getBMIState',height:height,weight:weight,sex:sex},function(ret){
				var info = (ret['bmi'] == "体重正常") ? "，请保持良好状态！" : "，请注意锻炼！";
				$(".resultbox h2").html("测试结果："+ret['bmi']);
				$(".resulttext").html("您的状况属于<span class=\"normalresult\">"+ret['bmi']+"</span>"+info);
				$(".resultbox p span").html(ret['stdWeght']);
				if(ret['bmi'] == "体重过轻"){
					$(".help").show();
					$("#recipe").html("<a href='./article.html'>了解身体偏瘦原因</a>");				
				}
				if(ret['bmi'] == "体重过重"||ret['bmi'] == "肥胖"||ret['bmi'] == "非常肥胖"){
					$(".help").show();
					url = "/plugin/weixin/slys/diseaselist.html?type_name=减肥&types=";
					$("#recipe").html("<a href="+url+">查看健康食谱</a>");				
					
				}
			});	
		}				
	});
	
	
});