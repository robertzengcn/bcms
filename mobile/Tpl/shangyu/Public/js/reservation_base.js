/**
 * 
 */
var Reser = {};

var validate = {
		'name':{c:true,m:'请正确填写姓名',l:{min:2,max:10},v:{min:0,max:0},p:""},
		'age' :{c:true,m:'请正确填写年龄',l:{min:1,max:3},v:{min:1,max:120},p:""},
		'sex':{c:true,m:'请选择性别',l:{min:1,max:1},v:{min:0,max:1},p:""},
		'telephone':{c:true,m:'请正确填写联系方式',l:{min:0,max:0},v:{min:0,max:0},p:/^[0-9]{11}$/},
		'email':{c:false,m:'请正确输入邮箱',l:{min:0,max:0},v:{min:0,max:0},p:/^\w+@\w+(\.[a-zA-Z]+)+$/i},
		'address':{c:false,m:'请输入家庭住址',l:{min:0,max:0},v:{min:0,max:0},p:""},		
		'date':{c:true,m:'请填写正确的日期时间',l:{min:0,max:0},v:{min:0,max:0},p:/^((\d{2}|\d{4})\-\d{1,2}\-\d{1,2}|(\d{2}|\d{4})\.\d{1,2}\.\d{1,2})$/},	
		'ill':{c:false,m:'请正确填写病情描述信息',l:{min:1,max:200},v:{min:0,max:0},p:""}		
}

Reser.fromValidate = function(formID){
	var selectOb = '';
	var error = '';
	$.each(validate,function(key,value){
		selectOb = $("[name="+key+"]");
		switch(value.c){
		     case true :
		    	 var boolean = Reser.validate(selectOb,value);
		    	 if(!boolean){
		    		 error += value.m+'\r\n';
		    	 }
		    	 break;
		     case false :
		    	 if($.trim(selectOb.val())!=''){
		    		 var boolean = Reser.validate(selectOb,value);
		    		 if(!boolean){
		    			 error += value.m+'\r\n';
		    		 }
		    	 }
		    	 break;
		}
	});
	return error == '' ? true : error;
}

Reser.validate = function(selectOb,value){
	var boolean = true;
	if(selectOb.length<=0){
		boolean = false;
	}else{
		if(value.l.min !== 0 || value.l.max !== 0){
			if(selectOb.val() == '' || selectOb.val().length < value.l.min || selectOb.val().length > value.l.max){
				boolean = false;
			}
		}
		if(value.v.min !== 0 || value.v.max !== 0){
			if(selectOb.val() < value.v.min || selectOb.val() > value.v.max){
				boolean = false;
			}
		}
		if(value.p !== ''){
			partten = new RegExp(value.p);
			if(partten.test(selectOb.val()) === false){
				boolean = false;
			}
		}
	}
	return boolean;
}

Reser.save = function(formID){
	var data = $('#'+formID).serializeArray();
	$.ajax({
		url:'/home.php?mod=reservations&method=saveBookingInfo',
		data:data,
		type:'post',
		dataType:'json',
		success:function(ret){
			if(ret.statu == true){
				$('[type=reset]').click();
				$('#my-alert-title').html('提示');
				$('#my-alert-content').html('预约成功');
				$('#my-alert').modal();
				setInterval(function(){
					$('#my-alert').modal('close');
				}, 6000); 
				var url = window.location.pathname;
				var title = document.title;
				var state = {
							title: title,
							url: url,
				};  
				window.history.pushState(state, document.title, url);				
			}else{
				$('#my-alert-title').html('提示');
				$('#my-alert-content').html(ret.msg);
				$('#my-alert').modal();
				setInterval(function(){
					$('#my-alert').modal('close');
				}, 6000); 
			}
		}
	});
}

