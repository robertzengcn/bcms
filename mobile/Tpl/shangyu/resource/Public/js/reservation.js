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
			   type:"GET",
			   url:"/home.php?mod=reservations&method=getReservation&department_id="+department_id+"&doctor_id="+doctor_id+"&date="+date,
			   dataType: "json",
			   success:function(ret){
				   if(ret.data!=""){
					   var timehtml="<option>请选择</option>"; 
				   for(k in ret.data){
		   				if(ret.data[k]['available']==0||ret.data[k]['time']==''){
		   					continue;
		   				}
		   				$.each(ret.data[k].timearrange,function(i,item){
		   					timehtml+='<option value="'+ret.data[k]['id']+'">'+item+'</option>';
		   				});
		   				
		   				//var atime=ret[k]['times'][0];
		   				
		   				flag=true;		   				
				   }
		   			if(flag==false){
		   				timehtml+='当前预约已满';
		   			}
				   
				   }else{
					   var timehtml="<option>当前暂时没有可预约信息</option>"; 
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
	$('#form1').append('<input type="hidden" id="restime" name="restime" />');
	
	
//	$('body').on('change','#appointment',function(){
//		resertime=$('#appointment option:selected').text();
//		$('#restime').val(resertime);
//	});//因为jquery版本容易引起冲突
    var select = document.getElementById('appointment');
    select.onchange = function(){
    	
    	var obj=document.getElementById('appointment');
    	var resertime=obj.options[obj.selectedIndex].text;
    	document.getElementById("restime").value=resertime;
    	if(document.getElementById("time"))
    	{ 
    	document.getElementById("time").value=obj.value;
    	}else{
    		$('#form1').append('<input type="hidden" id="time" name="time" />');
    		document.getElementById("time").value=obj.value;
    	}
    }
	
	

});

