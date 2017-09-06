	function maketable(){
		 
		var html='<div class="biaoge_cont1 biaoge_qiehuan"><table class="table table-bordered" cellspacing="0" cellpadding="0"><thead><tr><th><div>科室</div></th><th><div>时段</div></th><th><div>星期一</div></th><th><div>星期二</div></th><th><div>星期三</div></th><th><div>星期四</div></th><th><div>星期五</div></th><th><div>星期六</div></th><th><div>星期日</div></th></tr></thead><tbody>';		
		$.ajax({type: 'POST',
			    url:'/controller/?controller=DepartmentManager&method=query',
			    dataType: 'json',
			    success: function(data){
			    	if(data.data!=null){
						console.log(data.data);
			    		$.each(data.data,function(i,val){
							console.log(val.name);
			    			html+='<dl class="am-accordion-item am-active"><dt class="am-accordion-title">康复医学科</dt><dd class="am-accordion-bd am-collapse am-in"><div class="am-accordion-content"><table class="am-table am-table-bordered"><thead><tr><th></th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th><th>日</th></tr></thead><tbody><tr><td>上午</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td>下午</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></dd></dl>';
			    			
			    		});
						html+='</tbody></table></div>';
		$('#resertable').html(html);
			    	}
			    }
		});
		
		
		
	}
	
	function getweeknum(num){
	var weeknum="";
		switch (num) {
			case 1:
				weeknum = "一";
				break;
			case 2:
				weeknum = "二";
				break;
			case 3:
				weeknum = "三";
				break;
			case 4:
				weeknum = "四";
				break;
			case 5:
				weeknum = "五";
				break;
			default:
				weeknum = "一";
				break;	
}
return weeknum;
	}
	
	function attachdata(){
		//var d = new Date();
		var str = getNowFormatDate();
		console.log(str);
		$.ajax({type: 'POST',
		        url:'/controller/?controller=Reservation&method=showweekreser',
		        data:{'date':str},
				dataType: 'json',
				success: function(data){
					if(data.statu){
						if(data.data!=null){
							$.each(data.data, function(i,v){
								$("#"+v.week+v.timetype+v.department_id).append(v.doctor+'</br>');
							});
						}
						
					}
				}
				
		});
	}
	
	function getNowFormatDate() {
	    var date = new Date();
	    var seperator1 = "-";
	    //var seperator2 = ":";
	    var month = date.getMonth() + 1;
	    var strDate = date.getDate();
	    if (month >= 1 && month <= 9) {
	        month = "0" + month;
	    }
	    if (strDate >= 0 && strDate <= 9) {
	        strDate = "0" + strDate;
	    }
	    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate;
	            
	    return currentdate;
	} 

