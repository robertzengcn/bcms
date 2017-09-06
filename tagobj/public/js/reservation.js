function getDepartmentManager(){
 	   $.ajax({
 		   type:"GET",
 		   url:"/controller?controller=DepartmentManager&method=getDepartments",
 		   dataType: "json",
 		   success:function(ret){
 			  if(ret.statu){
 				  var _data=ret.data;
 				  var departmentHtml="<option>-请选择科室-</option>";
     			   for(k in _data){				   
     				  departmentHtml+='<option  value="'+_data[k].id+'">'+_data[k].name+'</option>';   
     			   }
 			   	 $("#department_id").html(departmentHtml);
 			  }
 		   }   
 	   }); 	 
}	

function getDoctor(department_id){
 	   $.ajax({
 		   type:"GET",
 		   url:"/controller?controller=DoctorManager&method=getByDepartmentID&department_id="+department_id,
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
	     var timehtml="<option>请选择预约时间</option>";
	     var flag=false;
		   $.ajax({
			   type:"GET",
			   url:"/controller?controller=Reservation&method=getReservation&department_id="+department_id+"&doctor_id="+doctor_id+"&date="+date,
			   dataType: "json",
			   success:function(ret){ 
				   if(ret.statu) {
					   var data = ret.data;
					   if (data == '' || data == null) {
						   timehtml = "<option value=''>当前暂时没有可预约信息</option>";
					   } else {
						   for(k in data){
				   				if(data[k]['available']==0 || data[k]['time'] == ''){
				   					continue;
				   				}
				   				var atime=data[k]['timearrange'];
				   				for(i in atime) {
				   					timehtml+='<option value="'+data[k]['id']+'">'+atime[i]+'</option>';
				   				}
				   				flag=true;		   				
						   }
				   			if(flag==false){
				   				timehtml+='当前预约已满';
				   			}
					   }
					   $("#appointment").html(timehtml);
				   }
			   }
		   }); 
	   }
   
 //表单提交
$(document).ready(function(){  
	$('#subReservation').append('<input type="hidden" id="restime" name="restime" />');
	
	//监听日期获得焦点事件
	$('#date').focus(function(){
		WdatePicker({minDate:'%y-%M-%d'},onpicking:getReservation());
	});
	
	//加载科室数据
	getDepartmentManager();
	
	//监听科室事件
	$("#department_id").change(function(){
		if ($('#date').val() == '') {
			alert('请先选择预约时间！');
			$(this).val('');
			return false;
		}
		var department_id = $(this).val();
		getDoctor(department_id);
	});
	
	//监听医生事件
	$("#doctor_id").change(function(){
		getReservation();
	});
	
	//监听预约事件
	$("#appointment").change(function(){
		var atime = $(this).val();
		var resertime = $(this).find('option:selected').text();
		$('#restime').val(resertime);
		$("#time").val(atime);
	});
	
	$('#subReservation').click(function(){
		//验证数据
		var msg = Reser.fromValidate('#reservationForm');
		if(msg === true){
			Reser.save('reservationForm');
		}else{
			alert(msg);
			return false;
		}
		return false;
	});

});

