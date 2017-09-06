	function getDoctor(department_id){
 	   $.ajax({
 		   type:"GET",
 		   url:"/home.php?mod=reservations&method=getByDepartmentID&department_id="+department_id,
 		   dataType: "json",
 		   success:function(ret){
 			  if(ret.statu){
 				  var _data=ret.data;
 				  var docHtml="<option>-请选择医生-</option>";
     			   for(k in _data){				   
     				   docHtml+='<option  value="'+_data[k].id+'">'+_data[k].name+'</option>';   
     			   }
 			   	 $("#doctor_id").html(docHtml);
 			  }
 		   }   
 	   }); 	 
  }

   function getReservation(){
		 var department_id=$("#department_id").val();
		 var doctor_id=$("#doctor_id").val();
		 var date=$("#date").val();
		 if(department_id==""){
			 alert('请选择科室');
			 return false;
		 }
		 if(doctor_id==""){
			 alert('请选择医生');
			 return false;		 
		 }

	     var timehtml="<option>请选择预约时间</option>";
	     var flag=false;
		   $.ajax({
			   type:"POST",
			   url:"/home.php?mod=reservations&method=getreservation",
			   data:{'department_id':department_id,'doctor_id':doctor_id,'date':date},
			   dataType: "json",
			   success:function(ret){
				  
				   if(ret.data.ttl>0){
					   
					   if(ret.data.rows.length){
						   
						   var timehtml="<option value='-1'>--请选择预约时间--</option>"; 
						   for(k in ret.data.rows){
							   
							   var strs= new Array(); //定义一数组
							   strs=ret.data.rows[k].time_point.split("@");  
		                       $.each(strs,function(i,v){
		                    	   if(v!="0"){
		                    	   timehtml+='<option data="'+ret.data.rows[k].id+'" value="'+v+'">'+v+'</option>'; 
		                    	   }
		                       }); 
						   }
						   
						   
					   }else{
						   var timehtml="<option>当前暂时没有可预约信息</option>"; 
					   }
					   $("#appointment").html(timehtml);
		}else{
			$("#appointment").html("<option>当前暂时没有可预约信息</option>");
		}
			   }
		   }); 
	   }
   
   function getTime(atime){
	   $("#time").val(atime);	   
   }

 //表单提交
   
$(document).ready(function(){  
	$('#form1').append('<input type="hidden" id="restime" name="resvationID" />');
	$('#button').click(function(){
		
		var mobile = $('#hometel').val();
		if(mobile==""){
			$('#my-alert-title').html('提示');
			$('#my-alert-content').html('请检查手机号码');
			$('#my-alert').modal();
			setInterval(function(){
				$('#my-alert').modal('close');
			}, 6000); 
			return false;
		}
		$.ajax({
			type : "POST", 
			dataType : "json", 
			url : '/home.php?mod=reservations&method=checkmobile', 
			data : {
				'mobile' : mobile
			},
			success : function(data) {
				if (data.statu) {//如果该手机号有验证过
					
					var msg = Reser.fromValidate('#form1');
					if (msg === true) {
						Reser.save('form1');
					} else {						
						$('#my-alert-title').html('提示');
						$('#my-alert-content').html(msg);
						$('#my-alert').modal();
						setInterval(function(){
							$('#my-alert').modal('close');
						}, 6000); 
						return false;
					}			
				
				}else{//如果已经验证过
					$('#telnum').html(mobile);
					$('#my-modal-loading').modal();
					
	
				}
			}
		});
		
	});
	var count=60;
	$('#btnSendCode').click(function(){	
		var mobile = $('#hometel').val();
		if(count<60){
			return false;
		}
		$.ajax({
			'url':'/home.php?mod=register&method=sendcode',
			'type':'POST',
			'dataType':'json',
			'data': {mobile:mobile,cms:1},
			'success':function(data){
				if(data.stute){
					$("#btnSendCode").attr('disabled', true);
				
					var int=setInterval(function(){														
						count=count-1;							
						if(count>0){
						$('#btnSendCode').html(count+'秒后重新获取');
						
		
						}else{
							window.clearInterval(int);
							count=60;
							$('#btnSendCode').html('获取验证码');
						
							$("#btnSendCode").removeAttr("disabled");
						}						
					},1000);
				}else{
					$('#msgtext').html('请检查手机号码');
		    		$('#alterbody').find('i').addClass("icon-remove-sign text-danger");
		    		$('#altermsg').modal('show');
				}
			}
			
			
		});
	});
	
	
		$('#confirmbtn').click(function(){	
		var code=$('#checkCode').val();
		if(code==""){
			$('#senderr').html('验证码不能为空');
			window.setTimeout(function(){
				$('#senderr').html('');
			},5000); 
			return false;
		}
		$.ajax({
			'url':'/home.php?mod=register&method=validcmscode',
			'type':'POST',
			'dataType':'json',
			'data': {code:code},
			'success':function(data){
				if(data.statu){
					var msg = Reser.fromValidate('#form1');
					if (msg === true) {
						$('#my-modal-loading').modal('close');
						Reser.save('form1');						
					} else {//显示错误提示
						$('#my-alert-title').html('提示');
						$('#my-alert-content').html(msg);
						$('#my-alert').modal();
						setInterval(function(){
							$('#my-alert').modal('close');
						}, 6000); 
						return false;
						
					}
				}else{
					$('#senderr').html('验证码错误');
					window.setTimeout(function(){
						$('#senderr').html('');
					},5000); 
					return false;
				}
			}
		});
			
		
	});
		$('#appointment').change(function(){
			//var resid=$('#appointment').attr('data');
			var resid=$(this).children('option:selected').attr('data');
			$('#restime').val(resid);
			});
	
	
	
//    var select = document.getElementById('appointment');
//    select.onchange = function(){
//    	
//    	var obj=document.getElementById('appointment');
//    	var resertime=obj.options[obj.selectedIndex].text;
//    	document.getElementById("restime").value=resertime;
//    	if(document.getElementById("time"))
//    	{ 
//    	document.getElementById("time").value=obj.value;
//    	}else{
//    		$('#form1').append('<input type="hidden" id="time" name="time" />');
//    		document.getElementById("time").value=obj.value;
//    	}
//    }
	
	

});

