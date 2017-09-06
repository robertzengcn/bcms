
   function getReservation(department_id,doctor_id,department,doctor,date){
	       var rhtml="<div class='ghtimebox'><h5>请选择就诊时间段</h5><ul>";
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
		   				var time=ret[k]['times'][0];
		   				rhtml+='<li onclick="getReservationDetail('+department_id+','+doctor_id+',\''+department+'\',\''+doctor+'\',\''+date+'\',\''+time+'\',\''+k+'\')">'+k+' 剩余预约号：'+ret[k]['available']+'</li>';
		   			    flag=true;
		   			}
		   			if(flag==false){
		   				rhtml+='当前预约已满';
		   			}
		   			rhtml+="</div>";
		   			var showdiv = $("#mycontent");
				 showdiv.html(rhtml);
			  }
			
		   }); 
	   }

   function ShowDiv(id,department_id,doctor_id,department,doctor,date){   	   
	   $("#MyDiv").show();
    	var oset=$("#"+id).offset();
        var ltop=oset.top;
        var lleft=oset.left;
        $("#MyDiv").offset({left:lleft,top:ltop+70});	    
	    getReservation(department_id,doctor_id,department,doctor,date);
   
   };
	   //关闭弹出层
	function CloseDiv(show_div){
	   $("#"+show_div).hide();
	};
	function getReservationDetail(department_id,doctor_id,department,doctor,date,time,k){
		var url = "/reservation.html?department_id="+department_id+"&doctor_id="+doctor_id+"&department="+department+"&doctor="+doctor+"&date="+date+"&time="+time+"&k="+k;
		location.href = encodeURI(url);	
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
	});

});

