$(function() {
	var addsuccess = function (dat,i){
		$("#pageDialogBG .Prompt").text("");
		var w=($(window).width()-255)/2,
			h=($(window).height()-45)/2;
		$("#pageDialogBG").css({top:h,left:w,opacity:0.8});
		$("#pageDialogBG").stop().fadeIn(1000);
		$("#pageDialogBG .Prompt").append('<s></s>'+dat);
		if(i==1)$(".Prompt s").css("background-position","0px -26px");
		$("#pageDialogBG").fadeOut(1000);
	}
	var getData = function(data,fun){
			var http = '/addons/dlogin.php';
			$.ajax({url:http,type:'post',data:data,async:true,dataType:'json',
				success:function(re){
					fun(re);
				}
			});
	}
	$("#mobile").focus(function(){
	var obj=$(this).val();
		if(obj=="请输入11位手机号"){
			$(this).val("");
		 }
	  });
$("#mobile").blur(function(){
	$("#mobile_err").css("display","none");
		var txt_value=$(this).val();
	   if(txt_value==""){
			$(this).val("请输入11位手机号");
			return false;
		 }
		if(txt_value.length == 0){
			$("#mobile_err").css("display","block");
			formError("#mobile_err","手机号不能为空");
			return false;
		}

		if(!$.checkMobilePhone(txt_value)){
			$("#mobile_err").css("display","block");
			formError("#mobile_err","手机号码格式错误，请重新输入");
			return false;
		}
});
 $("#paw").blur(function(){
	$("#paw_err").css("display","none");
	var txt_value=$(this).val();
	if(txt_value.length == 0){
		$("#paw_err").css("display","block");
		addsuccess("密码必须填写");
		return false;
	}
});
$(document).ready(function(){
	$("#sub").click(function(){
		var mobile = $("#mobile").val();
		var paw = $("#paw").val();
		if($.trim(mobile).length == 0){
			$("#mobile_err").css("display","block");
			formError("#mobile_err","手机号不能为空");
			return false;
		}
		if(!$.checkMobilePhone(mobile)){
			$("#mobile_err").css("display","block");
			formError("#mobile_err","手机号码格式错误，请重新输入");
			return false;
		}
		if(paw.length == 0){
			$("#paw_err").css("display","block");
			addsuccess("密码必须填写");
			return false;
		}
		var remember = $('#remember-me').val();
		getData({method:'userLogin',mobile:mobile,password:paw,remember:remember},function(res){	
			if(res.status==1){
				window.location.href = res.jump;
				addsuccess(res.info,1);				
			}else{
				addsuccess(res.info);					
			}			
		});
		
	})
})
//手机号码验证
$.checkMobilePhone = function(value){
	if($.trim(value)!='')
		return /^(1[34578]\d{9})$/i.test($.trim(value));
	else
		return true;
};
 $.trim = function(value){
　　return value.replace(/(^\s*)|(\s*$)/g, "");
}
function formError(obj,msg){
	$(obj).html("<span style='color:red;font-size: 14px;margin-left:80px;'>" + msg + "</span>"); 
}	
})