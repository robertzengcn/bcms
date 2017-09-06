	function getDoctor(department_id){
 	   $.ajax({
 		   type:"GET",
 		   url:"/controller?controller=Doctor&method=getByDepartmentID&department_id="+department_id,
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
				   for(k in ret){
		   				if(ret[k]['available']==0){
		   					continue;
		   				}
		   				var atime=ret[k]['times'][0];
		   				timehtml+='<option value="'+atime+'">'+k+' 剩余预约号：'+ret[k]['available']+'</option>';
		   				flag=true;		   				
				   }
		   			if(flag==false){
		   				timehtml+='当前预约已满';
		   			}
				   $("#appointment").html(timehtml);
			   }
		   }); 
	   }
   
   function getTime(atime){
	   $("#time").val(atime);	   
   }

 //表单提交
$(document).ready(function(){  

	$('#button').click(function(){
		//验证数据
		var msg = Reser.fromValidate('#form1');
		if(msg === true){
			Reser.save('form1');
		}else{
			alert(msg);
			return false;
		}
		return false;
	});

});

