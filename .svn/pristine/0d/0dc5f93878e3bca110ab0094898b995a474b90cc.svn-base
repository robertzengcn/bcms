function Signup() {
	var self = this;
	 
this.gData = function(data,fun){
	var http = '/controller/';
	$.ajax({url:http,type:'post',cache : false,data:data,async : false ,dataType:'json',
		beforeSend:function(){$("#loading").show();},	
		success:function(re){
			fun(re);
			$("#loading").hide();
		}
	});
}

this.addsuccess = function (dat,i){
	$("#pageDialogBG .Prompt").text("");
	var w=($(window).width()-255)/2,
		h=($(window).height()-45)/2;
	$("#pageDialogBG").css({top:h,left:w,opacity:0.8});
	$("#pageDialogBG").stop().fadeIn(1000);
	$("#pageDialogBG .Prompt").append('<s></s>'+dat);
	if(i==1)$(".Prompt s").css("background-position","0px -26px");
	$("#pageDialogBG").fadeOut(1000);
}
 $(document).ready(function(){  
    $('#form').ajaxForm({  
        dataType: 'json',
        beforeSubmit:showRequest, 
		beforeSend:function(){$("#loading").show();},		
        success: processJson  
    });

	function showRequest(formData,jqForm,options){
		if($('input[name="username"]').val()==''){
			$.alert("请输入名称", "提示");
			return false;
		}
		if($('input[name="telphone"]').val()==''){
			$.alert("请输入手机号", "提示");
			return false;
		}
		if(!self.checkMobilePhone($('input[name="telphone"]').val())){
			$.alert("请输入正确手机号", "提示");
			return false;
		}
		if($('textarea[name="xuanyan"]').val()==''){
			$.alert("请输入参赛宣言", "提示");
			return false;
		}
		if($('input[name="fileup[]"]').val()=='' || $('input[name="fileup[]"]').val()==undefined){
			$.alert("请上传你的参赛照片", "提示");
			return false;
		}
		if($('textarea[name="xuanyan"]').val().length > 500){
			$.alert("参赛宣言超过字数限制", "提示");
			return false;
		}
		var queryString = $.param(formData);    
		return true;  
	}

	function processJson(data){  
		 if(!data.statu){
		  self.addsuccess(data.msg);
		}else{
			$("#loading").hide();
		  //self.addsuccess(data.msg);
		  setTimeout(function(){
			window.location.href = data.url;
			}, 1500);
		}
	}

});
 //手机号码验证
this.checkMobilePhone = function(value){
    if($.trim(value)!='')
      return /^(1[34578]\d{9})$/i.test($.trim(value));
    else
      return true;
  };
this.textarealength = function (obj,maxlength){
	var v = $(obj).val();
	var l = v.length;
	if( l > maxlength){
		v = v.substring(0,maxlength);
	}
	$(obj).parent().find(".textarea-length").text(v.length);
}
}
var gSignup = new Signup();