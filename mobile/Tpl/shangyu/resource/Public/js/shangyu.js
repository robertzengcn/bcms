function Shangyu() {
var self = this;
laypage.dir='./Tpl/shangyu/Public/css/laypage.css';
this.department = function() {
$(function(){

	$('body').on('click','.depitm',function(){
		var id=$(this).attr('dataid');
		var thml=$(this).html();
		$('#depname').html('<a id="depname" href="/mobile/department.php?method=get&department_id='+id+'" class="active">'+thml+'</a>');
		$.ajax({
			type: "POST",

            url: "/home.php?mod=departments&method=getdiseasebydep",
            
            data: {department_id:id},

            dataType: "json",

            success: function(data){
            	var dhtml='';
            	if(data.statu){            		
            		if(data.data.length>0){
            			
            			$.each(data.data,function(i,v){
            				if(v.name!="图片集锦"){
            				dhtml+='<a class="item" href="/mobile/department.php?method=get&department_id='+v.id+'"><div class="title">'+v.name+'</div><i class="am-icon-chevron-right am-fr"></i></a>';	
            				}
            				});
            			
            			
            			$('#dielist').html(dhtml);
            		}else{
            			window.location.href="/mobile/department.php?method=get&department_id="+id; 
            		}
            	}
            	
            }
			
		});
	});

	
	
});
}
this.departmentdetail = function(curr){
	
	$(function(){
		
		var depid=$('#department_id').val();
		$.ajax({
			type: "POST",

	        url: "/home.php?mod=doctors&method=query",
	        
	        data: {department_id:depid,page:curr,size:2},

	        dataType: "json",

	        success: function(data){
	        	$('#doctorlist').html('');
	        	if(data.rows.length>0){
	        	$.each(data.rows,function(i,v){
	        		
	        		var html='';
	        		html+='<ul class="am-list"><li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left am-padding-bottom-0"><div class="am-u-sm-4 am-list-thumb am-padding-left-0"><img class="am-img-responsive" src="/upload'+v.pic+'" alt="'+v.name+'"></div><div class="am-u-sm-8 am-list-main am-padding-0"><h3 class="am-list-item-hd am-margin-bottom-xs">'+v.name+'</h3><div class="am-list-item-text am-margin-bottom-xs color_444">科室：'+v.department_name+' &nbsp;&nbsp; 职称：'+v.position+'</div><div class="am-list-item-text">个人简介: '+v.content+'<a href="/mobile/doctor.php?method=get&id='+v.id+'"><详情></a></div></div></li></ul><div id="'+v.id+'_div"><table class="am-table am-table-bordered" id="'+v.id+'_table"><thead><tr><th></th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th><th>日</th></tr></thead><tbody><tr><td>上午</td><td id="mon_1"></td><td id="mon_2"></td><td id="mon_3"></td><td id="mon_4"></td><td id="mon_5"></td><td id="mon_6"></td><td id="mon_7"></td></tr><tr><td>下午</td><td id="aft_1"></td><td id="aft_2"></td><td id="aft_3"></td><td id="aft_4"></td><td id="aft_5"></td><td id="aft_6"></td><td id="aft_7"></td></tr></tbody></table><a class="am-btn am-btn-primary my_persbtn2" href="#" target="_blank" id="'+v.id+'_yubtn">我要预约</a></div>';	        			        		
	        		$('#doctorlist').append(html);
	        		
	        		$.ajax({
	        			type: "POST",
	        	        url: "/home.php?mod=doctors&method=getdoctor",	        	        
	        	        data: {name:v.name},
	        	        dataType: "json",
	        	        success: function(datas){
	        	        	if(datas.stute){
	        	        		$.each(datas.data,function(s,q){
	        	        			$('#'+q.angle).html('<a target="_blank" href="#">约</a>');
	        	        		});
	        	        	}else{
	        	        		$('#'+v.id+'_div').hide();
	        	        		
	        	        	}
	        	        } 
	        		});
	        		
	        	});
	        	}
	        	
	        	laypage({
	                cont: 'page1', // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
									// id="page1"></div>
	                pages: data.pages, // 通过后台拿到的总页数
	                curr: curr || 1, // 当前页
	                jump: function(obj, first){ // 触发分页后的回调
	                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
	                    	self.departmentdetail(obj.curr);
	                    }
	                }
	            });
	               	
	        }
			
		});

		self.jiankanliucheng(1);
		self.jiankandetail(1);
		
		
		

	});
	
}
this.jiankandetail = function(curr){
	var departmentid=$('#depid').val();	
	var jiancha=$('#jiancha').html();
	$.ajax({
		type: "POST",
        url: "/home.php?mod=diseases&method=getarticlebydepdie",	        	        
        data: {department_id:departmentid,disease_name:jiancha,page:curr,size:2},
        dataType: "json",
        success: function(datas){
        	$('#jiankanlist').html('');
        	if(datas.stute){
        		if(datas.data.length>0){
        			var html='';
        			$.each(datas.data,function(s,n){
        				html+='<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left"><h3 class="am-list-item-hd am-padding-0"><a href="/mobile/article.php?method=get&id='+n.id+'" class="">'+n.subject+'</a></h3><span class="am-list-date am-block">'+n.description+'</span><div class="am-u-sm-4 am-list-thumb"> <a href="/mobile/article.php?method=get&id='+n.id+'" class=""> <img src="/upload/'+n.pic+'" alt="'+n.subject+'"/></a></div><div class=" am-u-sm-8  am-list-main"><div class="am-list-item-text">'+n.description+'</div></div></li>';
        			});
        			$('#jiankanlist').html(html);
        		}
	        	laypage({
	                cont: 'page2', // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
									// id="page1"></div>
	                pages: datas.page, // 通过后台拿到的总页数
	                curr: curr || 1, // 当前页
	                jump: function(obj, first){ // 触发分页后的回调
	                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
	                    	self.jiankandetail(obj.curr);
	                    }
	                }
	            });
        		
        	}else{
        		
        		
        	}
        } 
	});
}
this.jiankanliucheng=function(curr){
	var departmentid=$('#depid').val();	
	var liucheng=$('#liucheng').html();
	$.ajax({
		type: "POST",
        url: "/home.php?mod=diseases&method=getarticlebydepdie",	        	        
        data: {department_id:departmentid,disease_name:liucheng,page:curr,size:2},
        dataType: "json",
        success: function(datas){
        	$('#jianchaliucheng').html('');
        	if(datas.stute){
        		if(datas.data.length>0){
        			var html='';
        			$.each(datas.data,function(s,n){
        				html+='<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left"><h3 class="am-list-item-hd am-padding-0"><a href="/mobile/article.php?method=get&id='+n.id+'" class="">'+n.subject+'</a></h3><span class="am-list-date am-block">'+n.description+'</span><div class="am-u-sm-4 am-list-thumb"> <a href="/mobile/article.php?method=get&id='+n.id+'" class=""> <img src="/upload/'+n.pic+'" alt="'+n.subject+'"/></a></div><div class=" am-u-sm-8  am-list-main"><div class="am-list-item-text">'+n.description+'</div></div></li>';
        			});
        			$('#jianchaliucheng').html(html);
        		}
	        	laypage({
	                cont: 'page3', // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
									// id="page1"></div>
	                pages: datas.page, // 通过后台拿到的总页数
	                curr: curr || 1, // 当前页
	                jump: function(obj, first){ // 触发分页后的回调
	                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
	                    	self.jiankandetail(obj.curr);
	                    }
	                }
	            });
        		
        	}else{
        		
        		
        	}
        } 
	});
}
this.depschedual=function(){
	$(function(){
		$('body').on('click','.am-accordion-title',function(){
			$(this).parent().find('.am-accordion-bd').toggle();
		});
		$('.depcontents').each(function(){
			var thisone=this;
			var depid=$(this).attr('dataid');
			$.ajax({type: 'POST',
			    url:'/home.php?mod=departments&method=getbelongdep',
			    data:{'id':depid},
			    dataType: 'json',
			    success: function(data){
			    	if(data.statu){
			    		
			    		if(data.data.length>0){
			    				
			    		$.each(data.data,function(i,val){
			    			var html="";
			    			html+='<dl class="am-accordion-item am-active"><dt class="am-accordion-title">'+val.name+'</dt><dd class="am-accordion-bd am-collapse"> <div class="am-accordion-content"><table class="am-table am-table-bordered"><thead><tr><th></th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th><th>日</th></tr></thead><tbody><tr><td>上午</td><td id="'+val.id+'_mon_1"></td><td id="'+val.id+'_mon_2"></td><td id="'+val.id+'_mon_3"></td><td id="'+val.id+'_mon_4"></td><td id="'+val.id+'_mon_5"></td><td id="'+val.id+'_mon_6"></td><td id="'+val.id+'_mon_0"></td></tr><tr><td>下午</td><td id="'+val.id+'_aft_1"></td><td id="'+val.id+'_aft_2"></td><td id="'+val.id+'_aft_3"></td><td id="'+val.id+'_aft_4"></td><td id="td_'+val.id+'_aft_5"></td><td id="td_'+val.id+'_aft_6"></td><td id="td_'+val.id+'_aft_0"></td></tr></tbody></table></div></dd></dl>';
			    			$(thisone).append(html);
				    		$.ajax({type: 'POST',
			    			    url:'/home.php?mod=reservations&method=getreserverbydep',
			    			    data:{'department_id':val.id},			    			    
			    			    dataType: 'json',
			    			    success: function(datadep){
			    			    	if(datadep.stute){
			    			    		$.each(datadep.data,function(s,l){
			    			    			$('#'+val.id+'_'+l.angle).html('<a target="_blank" href="/mobile/doctor.php?method=get&id=l.doctor_id">'+l.doctor+'</a>');	
			    			    			
			    			    		});
			    			    		
			    			    	
			    			    	
			    			    	}
			    			    }			    			    				    			
				    		});
			    		});
			    		

			    		
			    		}else{
			    			
			    			$.ajax({type: 'POST',
			    			    url:'/home.php?mod=departments&method=getdepbyid',
			    			    data:{'id':depid},			    			    
			    			    dataType: 'json',
			    			    success: function(datadep){
			    			    	if(datadep.statu){
			    			    		var html="";
			    			    		html+='<dl class="am-accordion-item am-active"><dt class="am-accordion-title">'+datadep.data.name+'</dt><dd class="am-accordion-bd am-collapse"> <div class="am-accordion-content"><table class="am-table am-table-bordered"><thead><tr><th></th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th><th>日</th></tr></thead><tbody><tr><td>上午</td><td id="'+datadep.data.id+'_mon_1"></td><td id="'+datadep.data.id+'_mon_2"></td><td id="'+datadep.data.id+'_mon_3"></td><td id="'+datadep.data.id+'_mon_4"></td><td id="'+datadep.data.id+'_mon_5"></td><td id="'+datadep.data.id+'_mon_6"></td><td id="'+datadep.data.id+'_mon_0"></td></tr><tr><td>下午</td><td id="'+datadep.data.id+'_aft_1"></td><td id="'+datadep.data.id+'_aft_2"></td><td id="'+datadep.data.id+'_aft_3"></td><td id="'+datadep.data.id+'_aft_4"></td><td id="'+datadep.data.id+'_aft_5"></td><td id="'+datadep.data.id+'_aft_6"></td><td id="'+datadep.data.id+'_aft_0"></td></tr></tbody></table></div></dd></dl>';
			    			    	
			    			    	$(thisone).append(html);
			    			    	
						    		$.ajax({type: 'POST',
					    			    url:'/home.php?mod=reservations&method=getreserverbydep',
					    			    data:{'department_id':depid},			    			    
					    			    dataType: 'json',
					    			    success: function(datadep){
					    			    	if(datadep.stute){
					    			    		$.each(datadep.data,function(s,l){
					    			    			$('#'+depid+'_'+l.angle).html('<a target="_blank" href="/mobile/doctor.php?method=get&id=l.doctor_id">'+l.doctor+'</a>');	
					    			    			
					    			    		});
					    			    		
					    			    	
					    			    	
					    			    	}
					    			    }			    			    				    			
						    		});
			    			    	}
			    			    }
			    			});
			    			
			    			
			    		}
			    		
						// html+='</tbody></table></div>';
		// $('#resertable').html(html);
			    	}else{
			    		
			    		
			    	}
			    	
			    }
		});
			
		});
	    var theped=$('.lowdep').attr('dataid');
		var strs= new Array();
		strs=theped.split(","); 
		$.each(strs,function(a,b){
			$.ajax({type: 'POST',
			    url:'/home.php?mod=departments&method=getbelongdep',
			    data:{'id':b},
			    dataType: 'json',
			    success: function(data){
			    	if(data.statu){
			    		
			    		if(data.data.length>0){
			    				
			    		$.each(data.data,function(i,val){
			    			var html="";
			    			html+='<dl class="am-accordion-item am-active"><dt class="am-accordion-title">'+val.name+'</dt><dd class="am-accordion-bd am-collapse"> <div class="am-accordion-content"><table class="am-table am-table-bordered"><thead><tr><th></th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th><th>日</th></tr></thead><tbody><tr><td>上午</td><td id="'+val.id+'_mon_1"></td><td id="'+val.id+'_mon_2"></td><td id="'+val.id+'_mon_3"></td><td id="'+val.id+'_mon_4"></td><td id="'+val.id+'_mon_5"></td><td id="'+val.id+'_mon_6"></td><td id="'+val.id+'_mon_0"></td></tr><tr><td>下午</td><td id="'+val.id+'_aft_1"></td><td id="'+val.id+'_aft_2"></td><td id="'+val.id+'_aft_3"></td><td id="'+val.id+'_aft_4"></td><td id="'+val.id+'_aft_5"></td><td id="'+val.id+'_aft_6"></td><td id="'+val.id+'_aft_0"></td></tr></tbody></table></div></dd></dl>';
			    			$('.lowdep').append(html);
				    		$.ajax({type: 'POST',
			    			    url:'/home.php?mod=reservations&method=getreserverbydep',
			    			    data:{'department_id':val.id},			    			    
			    			    dataType: 'json',
			    			    success: function(datadep){
			    			    	if(datadep.stute){
			    			    		$.each(datadep.data,function(s,l){
			    			    			$('#'+val.id+'_'+l.angle).html('<a target="_blank" href="/mobile/doctor.php?method=get&id=l.doctor_id">'+l.doctor+'</a>');	
			    			    			
			    			    		});
			    			    		
			    			    	
			    			    	
			    			    	}
			    			    }			    			    				    			
				    		});
			    		});
			    		

			    		
			    		}else{
			    			
			    			$.ajax({type: 'POST',
			    			    url:'/home.php?mod=departments&method=getdepbyid',
			    			    data:{'id':b},			    			    
			    			    dataType: 'json',
			    			    success: function(datadep){
			    			    	if(datadep.statu){
			    			    		var html="";
			    			    		html+='<dl class="am-accordion-item am-active"><dt class="am-accordion-title">'+datadep.data.name+'</dt><dd class="am-accordion-bd am-collapse"> <div class="am-accordion-content"><table class="am-table am-table-bordered"><thead><tr><th></th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th><th>日</th></tr></thead><tbody><tr><td>上午</td><td id="'+datadep.data.id+'_mon_1"></td><td id="'+datadep.data.id+'_mon_2"></td><td id="'+datadep.data.id+'_mon_3"></td><td id="'+datadep.data.id+'_mon_4"></td><td id="'+datadep.data.id+'_mon_5"></td><td id="'+datadep.data.id+'_mon_6"></td><td id="'+datadep.data.id+'_mon_0"></td></tr><tr><td>下午</td><td id="'+datadep.data.id+'_aft_1"></td><td id="'+datadep.data.id+'_aft_2"></td><td id="'+datadep.data.id+'_aft_3"></td><td id="'+datadep.data.id+'_aft_4"></td><td id="'+datadep.data.id+'_aft_5"></td><td id="'+datadep.data.id+'_aft_6"></td><td id="'+datadep.data.id+'_aft_0"></td></tr></tbody></table></div></dd></dl>';
			    			    	
			    			    	$('.lowdep').append(html);
			    			    	
						    		$.ajax({type: 'POST',
					    			    url:'/home.php?mod=reservations&method=getreserverbydep',
					    			    data:{'department_id':b},			    			    
					    			    dataType: 'json',
					    			    success: function(datadep){
					    			    	if(datadep.stute){
					    			    		$.each(datadep.data,function(s,l){
					    			    			$('#'+b+'_'+l.angle).html('<a target="_blank" href="/mobile/doctor.php?method=get&id=l.doctor_id">'+l.doctor+'</a>');	
					    			    			
					    			    		});
					    			    		
					    			    	
					    			    	
					    			    	}
					    			    }			    			    				    			
						    		});
			    			    	}
			    			    }
			    			});
			    			
			    			
			    		}
			    		
						// html+='</tbody></table></div>';
		// $('#resertable').html(html);
			    	}else{
			    		
			    		
			    	}
			    	
			    }
		});
		});
		
		
	});
	
}
this.doctordetail=function(){
	$(function(){
		var doctorname=$('#doctorname').text();
		$.ajax({
			type: "POST",
	        url: "/home.php?mod=doctors&method=getdoctor",	        	        
	        data: {name:doctorname},
	        dataType: "json",
	        success: function(datas){
	        	if(datas.stute){
	        		$.each(datas.data,function(s,q){
	        			$('#'+q.angle).html('<a target="_blank" href="#">约</a>');
	        		});
	        	}else{
	        		$('#schedutable').hide();
	        		
	        	}
	        } 
		});
	});
}

this.checklogin=function(){//判断登录
	
		self.checkuser();

		var count=60;
		$('#getcode').click(function(){
			
			
				
				var mobile=$('#mobile').val();
				var token=$('#token').val();
				
				if(count<60){
					return false;
				}
				$.ajax({
					'url':'/home.php?mod=register&method=sendcode',
					'type':'POST',
					'dataType':'json',
					'data': {mobile:mobile, token:token},
					'success':function(data){
						if(data.stute){
							$("#getcode").attr('disabled', true);
							$("#getcode").removeClass('btn-success');
							$("#getcode").addClass('btn-default');
							var int=setInterval(function(){														
								count=count-1;							
								if(count>0){
								$('#getcode').html(count+'秒后重新获取');
								//console.log(count);
								}else{
									window.clearInterval(int);
									count=60;
									$('#getcode').html('获取验证码');
									$("#getcode").removeClass('btn-default');
									$("#getcode").addClass('btn-success');
								}						
							},1000);
						}else{
							alert(data.msg);
						}
					}
					
					
				});
			
		});


		
		
		var loginform=$("#loginform").Validform({
			btnSubmit:"#losubmit", 			
			tiptype:function(msg, o, cssctl){
				if (o.type != 2) {
					
					//状态为2表示通过验证，成功就不提示						
					//页面上不存在提示信息的标签时，自动创建		
					if(o.obj.hasClass('authcode')){
						var $alam=o.obj.parent().next().next();								
						$alam.html('<span class="Validform_checktip"></span>');
						
						var objtip = o.obj.parent().parent().parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
					else{
						var $alam=o.obj.parent().next();								
						$alam.html('<span class="Validform_checktip"></span>');
						var objtip = o.obj.parent().parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
				}
				else if (o.type == 2){
					 if(o.obj.hasClass('authcode')){
							var $alam=o.obj.parent().next().next();								
							$alam.html('<span class="Validform_checktip Validform_right"></span>');
							
					}
					else{
						var $alam=o.obj.parent().next();								
						$alam.html('<span class="Validform_checktip Validform_right"></span>');								
					}							
						
				}
			}, 
			
			ajaxPost:true,
			url:'/home.php?mod=login&method=dologin',
			beforeSubmit:function(curform){
				$.ajax({
					'url':'/home.php?mod=login&method=gettoken',
					'success':function(data){
						if(data.statu){
							$('#lotoken').remove();
							
							curform.append('<input type="hidden" id="lotoken" name="lotoken" value="'+data.data+'">');
						}
					}
				});
				//密码进行md5加密
				
				curform.find(':input[type=password]').each(function(){
					
					$(this).val($.md5($(this).val()));
					
				});
				
				//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
				//这里明确return false的话表单将不会提交;	
			},
			callback:function(data){//清除提交状态
				//registerform.setStatus("normal");
				//$("#registerform").find('.Validform_checktip').each(function(){
					$('.Validform_checktip').removeClass('Validform_loading');
					$('.Validform_checktip').html('');
				//});
				if(data.status){//注册成功
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html('登录成功');
					$('#my-alert').modal();
					setInterval(function(){
						$('#my-alert').modal('close');
					}, 3000); 
					$('#Login').modal('close');
					//window.location.reload();
				}else{
					
					
					$('#mpdc4_ckcode').attr('src','/public/img/verify.php?' + Math.random());	
					
					$('#tpassword').val('');
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html(data.msg);
					$('#my-alert').modal();
					setInterval(function(){
						$('#my-alert').modal('close');
					}, 3000); 

				}
				
				
			},
			
				
		});
		
		var registerform=$("#registerform").Validform({
			btnSubmit:"#submits", 			
			tiptype:function(msg, o, cssctl){
				if (o.type != 2) {
					
					//状态为2表示通过验证，成功就不提示						
					//页面上不存在提示信息的标签时，自动创建		
					if(o.obj.hasClass('authcode')){
						var $alam=o.obj.parent().next().next();								
						$alam.html('<span class="Validform_checktip"></span>');
						
						var objtip = o.obj.parent().parent().parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
					else{
						var $alam=o.obj.parent().next();								
						$alam.html('<span class="Validform_checktip"></span>');
						var objtip = o.obj.parent().parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
				}
				else if (o.type == 2){
					 if(o.obj.hasClass('authcode')){
							var $alam=o.obj.parent().next().next();								
							$alam.html('<span class="Validform_checktip Validform_right"></span>');
							
					}
					else{
						var $alam=o.obj.parent().next();								
						$alam.html('<span class="Validform_checktip Validform_right"></span>');								
					}							
						
				}
			}, 
			
			ajaxPost:true,
			url:'/home.php?mod=register&method=registernocaptcha',
			beforeSubmit:function(curform){
				//密码进行md5加密
				curform.find(':input[type=password]').each(function(){
					$(this).val($.md5($(this).val()));
				});
				
				//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
				//这里明确return false的话表单将不会提交;	
			},
			callback:function(data){//清除提交状态
				//registerform.setStatus("normal");
				//$("#registerform").find('.Validform_checktip').each(function(){
					$('.Validform_checktip').removeClass('Validform_loading');
					$('.Validform_checktip').html('');
				//});
				if(data.status){//注册成功
					//console.log("成功");
					self.startmodal('注册成功');
					$('#Login').modal('close');
				}else{
					//self.changecode();
					//console.log(data.msg);
					
					$('#password').val('');
					alert(data.msg);
				}
				
				
			},
			
				
		});

		


	
	}
this.ask=function(){
	$(function(){
self.checklogin();
$('#questionlist').click(function(){
	$.ajax({//检测用户是否登录， 未登陆的话弹出对话框
		type: "POST",
        url: "/home.php?mod=login&method=islogin",	        	        
        dataType: "json",
        success: function(datas){
        	if(datas.statu){//跳转到问答页面
        		window.location.href="/mobile/ask.php?method=myquestion"; 
        		
        	}else{        		
        		$('#Login').modal();
        		$('#mpdc4_ckcode').attr('src','../public/img/verify.php?' + Math.random());
        	}
        } 
	});


	
});

var questionform=$("#submitques").Validform({
	btnSubmit:"#questionsubmit", 			
	tiptype:function(msg, o, cssctl){
		if (o.type != 2) {
			
			//状态为2表示通过验证，成功就不提示						
			//页面上不存在提示信息的标签时，自动创建		
			if(o.obj.hasClass('authcode')){
				var $alam=o.obj.parent().next().next();								
				$alam.html('<span class="Validform_checktip am-text-danger"></span>');
				
				var objtip = o.obj.parent().parent().parent().find(".Validform_checktip");								
				cssctl(objtip,o.type);						
				objtip.text(msg);
			}
			else{
				var $alam=o.obj.parent().next();								
				$alam.html('<span class="Validform_checktip am-text-danger"></span>');
				var objtip = o.obj.parent().parent().find(".Validform_checktip");								
				cssctl(objtip,o.type);						
				objtip.text(msg);
			}
		}
		else if (o.type == 2){
			 if(o.obj.hasClass('authcode')){
					var $alam=o.obj.parent().next().next();								
					$alam.html('<span class="Validform_checktip Validform_right"></span>');
					
			}
			else{
				var $alam=o.obj.parent().next();								
				$alam.html('<span class="Validform_checktip Validform_right"></span>');								
			}							
				
		}
	}, 
	
	ajaxPost:true,
	url:'/home.php?mod=askss&method=askquestion',
	beforeSubmit:function(curform){
		//密码进行md5加密
		curform.find(':input[type=password]').each(function(){
			$(this).val($.md5($(this).val()));
		});
		
		//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
		//这里明确return false的话表单将不会提交;	
	},
	callback:function(data){//清除提交状态
		//registerform.setStatus("normal");
		//$("#registerform").find('.Validform_checktip').each(function(){
			$('.Validform_checktip').removeClass('Validform_loading');
			$('.Validform_checktip').html('');
		//});
		if(data.statu){//注册成功
			//console.log("成功");
			$('#subject').val('');
			$('#doc-vld-ta-1').val('');
			self.startmodal('提交问题成功');
			
		}else{
			//self.changecode();
			//console.log(data.msg);
			$('#my-alert-title').html('提示');
			$('#my-alert-content').html(data.msg);
			$('#my-alert').modal();
			setInterval(function(){
				$('#my-alert').modal('close');
			}, 3000); 
			
			
			//alert(data.msg);
		}
		
		
	},
	
		
});


	});


}

this.checkuser=function(){
	
	$.ajax({//检测用户是否登录， 未登陆的话弹出对话框
		type: "POST",
        url: "/home.php?mod=login&method=islogin",	        	        
        dataType: "json",
        success: function(datas){
        	if(datas.statu){
        		
        	}else{        		
        		$('#Login').modal();
        		
        		$('#mpdc4_ckcode').attr('src','../public/img/verify.php?' + Math.random());
        	}
        } 
	});
}
this.startmodal=function(msg){
	$('#my-alert-title').html('提示');
	$('#my-alert-content').html(msg);
	$('#my-alert').modal();
	setInterval(function(){
		$('#my-alert').modal('close');
	}, 3000); 
}
this.questionlist=function(){
	var curr=1;
	$(function(){
		self.questionfirst(curr);

		self.questionsecond(curr);

		self.questinthird(curr);

	});
}
this.questionfirst=function(curr){
	$.ajax({//获取问题列表
		type: "POST",
        url: "/home.php?mod=askss&method=questionlist",
        data:{'page':curr,'size':10},
        dataType: "json",
        success: function(datas){
        	if(datas.statu){
        		if(datas.data.length>0){
        			var html="";
        			$.each(datas.data,function(i,v){
        				
        				html+='<li><a href="/mobile/ask.php?method=askdetail&id='+v.id+'"><p class="am-ellipsis">'+v.subject+'</p><span class="am-fl">'+v.asktime+'</span><span class="am-fr">已回答:'+v.isanswer+';</span></a></li>';
        			});
        			$('#myquestion').html(html);
    	        	laypage({
    	                cont: 'page1', // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
    									// id="page1"></div>
    	                pages: datas.page, // 通过后台拿到的总页数
    	                curr: curr || 1, // 当前页
    	                jump: function(obj, first){ // 触发分页后的回调
    	                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
    	                    	self.questionfirst(obj.curr);
    	                    }
    	                }
    	            });
        		}
        		

        	}
        } 
	});
}
this.questionsecond=function(curr){
	$.ajax({//获取回答的问题列表
		type: "POST",
        url: "/home.php?mod=askss&method=questionanswer",
        data:{'page':curr,'size':10},
        dataType: "json",
        success: function(datas){
        	if(datas.statu){
        		if(datas.data.length>0){
        			var html="";
        			$.each(datas.data,function(i,v){
        				
        				html+='<li><a href="/mobile/ask.php?method=askdetail&id='+v.id+'"><p class="am-ellipsis">'+v.subject+'</p><span class="am-fl">'+v.asktime+'</span><span class="am-fr">已回答:'+v.isanswer+';</span></a></li>';
        			});
        			$('#answerquestion').html(html);
    	        	laypage({
    	                cont: 'page2', // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
    									// id="page1"></div>
    	                pages: datas.page, // 通过后台拿到的总页数
    	                curr: curr || 1, // 当前页
    	                jump: function(obj, first){ // 触发分页后的回调
    	                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
    	                    	self.questionsecond(obj.curr);
    	                    }
    	                }
    	            });
        		}	        		
        	}
        } 
	});
}
this.questinthird=function(curr){
	$.ajax({//获取问题列表
		type: "POST",
        url: "/home.php?mod=askss&method=questionnoanswer",	        	        
        dataType: "json",
        data:{'page':curr,'size':10},
        success: function(datas){
        	if(datas.statu){
        		if(datas.data.length>0){
        			var html="";
        			$.each(datas.data,function(i,v){
        				
        				html+='<li><a href="/mobile/ask.php?method=askdetail&id='+v.id+'"><p class="am-ellipsis">'+v.subject+'</p><span class="am-fl">'+v.asktime+'</span><span class="am-fr">已回答:'+v.isanswer+';</span></a></li>';
        			});
        			$('#noanswerquestion').html(html);
    	        	laypage({
    	                cont: 'page3', // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
    									// id="page1"></div>
    	                pages: datas.page, // 通过后台拿到的总页数
    	                curr: curr || 1, // 当前页
    	                jump: function(obj, first){ // 触发分页后的回调
    	                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
    	                    	self.questinthird(obj.curr);
    	                    }
    	                }
    	            });
        		}	        		
        	}
        } 
	});
}
this.feedback=function(){
	$(function(){
		var loginform=$("#feedback").Validform({
			btnSubmit:"#submit", 			
			tiptype:function(msg, o, cssctl){
				if (o.type != 2) {
					
					//状态为2表示通过验证，成功就不提示						
					//页面上不存在提示信息的标签时，自动创建		
					if(o.obj.hasClass('authcode')){
						var $alam=o.obj.parent().next().next();								
						$alam.html('<span class="Validform_checktip"></span>');
						
						var objtip = o.obj.parent().parent().parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
					else{
						var $alam=o.obj.parent().next();								
						$alam.html('<span class="Validform_checktip"></span>');
						var objtip = o.obj.parent().parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
				}
				else if (o.type == 2){
					 if(o.obj.hasClass('authcode')){
							var $alam=o.obj.parent().next().next();								
							$alam.html('<span class="Validform_checktip Validform_right"></span>');
							
					}
					else{
						var $alam=o.obj.parent().next();								
						$alam.html('<span class="Validform_checktip Validform_right"></span>');								
					}							
						
				}
			}, 
			
			ajaxPost:true,
			url:'/home.php?mod=feedbacks&method=add',
			beforeSubmit:function(curform){

				//密码进行md5加密
				
				curform.find(':input[type=password]').each(function(){
					
					$(this).val($.md5($(this).val()));
					
				});
				
				//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
				//这里明确return false的话表单将不会提交;	
			},
			callback:function(data){//清除提交状态
				//registerform.setStatus("normal");
				//$("#registerform").find('.Validform_checktip').each(function(){
					$('.Validform_checktip').removeClass('Validform_loading');
					$('.Validform_checktip').html('');
				//});
				if(data.statu){//注册成功
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html('提交成功');
					$('#my-alert').modal();
					setInterval(function(){
						$('#my-alert').modal('close');
					}, 3000); 
					$('#Login').modal('close');
					$('#doc-vld-ta-1').val('');
					//window.location.reload();
				}else{
					
					
						
					
					$('#tpassword').val('');
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html(data.msg);
					$('#my-alert').modal();
					setInterval(function(){
						$('#my-alert').modal('close');
					}, 3000); 

				}
				
				
			},
			
				
		});
	});
}
this.user=function(){
	self.checklogin();
}
this.reservation=function(){
	$(function(){
		$.ajax({//判断用户登录，然后
			type: "POST",
	        url: "/home.php?mod=login&method=islogin",	        	        
	        dataType: "json",
	        success: function(datas){
	        	if(datas.statu){
        		if(datas.member){
        			$('#hometel').val(datas.member.telephone);
        		}
	        	}
	        } 
		});
	});
	
}

this.login=function(){
	$(function(){
		var loginform=$("#loginforms").Validform({
			btnSubmit:"#submit", 			
			tiptype:function(msg, o, cssctl){
				if (o.type != 2) {
					
					//状态为2表示通过验证，成功就不提示						
					//页面上不存在提示信息的标签时，自动创建		
					if(o.obj.hasClass('authcode')){
						var $alam=o.obj.parent().next().next();								
						$alam.html('<span class="Validform_checktip"></span>');
						
						var objtip = o.obj.parent().parent().parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
					else{
						var $alam=o.obj.parent().next();								
						$alam.html('<span class="Validform_checktip"></span>');
						var objtip = o.obj.parent().parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
				}
				else if (o.type == 2){
					 if(o.obj.hasClass('authcode')){
							var $alam=o.obj.parent().next().next();								
							$alam.html('<span class="Validform_checktip Validform_right"></span>');
							
					}
					else{
						var $alam=o.obj.parent().next();								
						$alam.html('<span class="Validform_checktip Validform_right"></span>');								
					}							
						
				}
			}, 
			
			ajaxPost:true,
			url:'/home.php?mod=login&method=dologin',
			beforeSubmit:function(curform){
				$.ajax({
					'url':'/home.php?mod=login&method=gettoken',
					'success':function(data){
						if(data.status){
							$('#lotoken').remove();
							
							curform.append('<input type="hidden" id="lotoken" name="lotoken" value="'+data.data+'">');
						}
					}
				});
				//密码进行md5加密
				
				curform.find(':input[type=password]').each(function(){
					
					$(this).val($.md5($(this).val()));
					
				});
				
				//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
				//这里明确return false的话表单将不会提交;	
			},
			callback:function(data){//清除提交状态
				//registerform.setStatus("normal");
				//$("#registerform").find('.Validform_checktip').each(function(){
					$('.Validform_checktip').removeClass('Validform_loading');
					$('.Validform_checktip').html('');
				//});
				if(data.status){//注册成功
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html('登录成功');
					$('#my-alert').modal();
					setInterval(function(){
						$('#my-alert').modal('close');
					}, 3000); 
					
					window.location.href="/mobile/user.php";
					//window.location.reload();
				}else{
					
					
					$('#mpdc4_ckcode').attr('src','/public/img/verify.php?' + Math.random());	
					
					$('#tpassword').val('');
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html(data.msg);
					$('#my-alert').modal();
					setTimeout(function(){
						$('#my-alert').modal('close');
					}, 3000); 

				}
				
				
			},
			
				
		});
	
		$('#mpdc4_ckcode').click(function(){
			$('#mpdc4_ckcode').attr('src','/public/img/verify.php?' + Math.random());
		});
	});
}
this.kanfu=function(){
	$(function(){
		$('.deplist').each(function(){
			var depid=$(this).attr('dataid');
           self.getartbydep(depid,1);

			
		});
	});
}
this.getartbydep=function(dep,page){
	
	$.ajax({type: 'POST',
	    url:'/home.php?mod=articles&method=getbydepid',
	    data:{'department_id':dep,'page':page,'size':5},
	    dataType: 'json',
	    success: function(data){
	    	if(data.stute){
	    		var html="";
	    		if(data.data.length>0){
	    			$.each(data.data,function(i,v){
	    				html+='<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left"><h3 class="am-list-item-hd am-padding-0"><a href="#" class="">'+v.subject+'</a></h3><span class="am-list-date am-block">'+v.articletime+'</span><div class="am-u-sm-4 am-list-thumb"> <a href="#" class=""> <img src="/upload/'+v.pic+'" alt="'+v.subject+'"> </a> </div><div class=" am-u-sm-8  am-list-main"><div class="am-list-item-text">'+v.description+'</div></div></li>';
	    			});
	    			
	    		}
	    		$(this).html(html);
	        	laypage({
	                cont: 'page'+dep, // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
									// id="page1"></div>
	                pages: data.pages, // 通过后台拿到的总页数
	                curr: curr || 1, // 当前页
	                jump: function(obj, first){ // 触发分页后的回调
	                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
	                    	self.getartbydep(dep,curr);
	                    }
	                }
	            });
	    	}
	    }
	});	
}

this.getreser=function(){
	$(function(){
		self.showmyres(1);

		
		$('body').on('click','.cancelbtn',function(){
			var dateid=$(this).attr('dateid');
			$.ajax({//取消挂号
				type: "POST",
		        url: "/home.php?mod=reservations&method=cancelres",	        	        
		        dataType: "json",
		        data:{'id':dateid},
		        success: function(datas){
		        	if(datas.statu){
                      $('#reser_'+dateid).remove();
                      self.startmodal('取消预约成功');

	                  
		        	}else{
		        		self.startmodal(datas.msg);
		        	}
		        } 
			});
		});
		
	});
	
}

this.showmyres=function(curr){
	$.ajax({//获取某个用户的预约信息
		type: "POST",
        url: "/home.php?mod=reservations&method=getmyreser",	        	        
        dataType: "json",
        data:{'page':curr,'size':10},
        success: function(datas){
        	if(datas.statu){
        		var html='';
        		
              if(datas.data.length>0){
            	  $.each(datas.data,function(i,v){
            		  html+='<div id="reser_'+v.id+'" class="myreg am-container"><div class="myreg_tit"><strong class="am-fl"></strong><span class="am-fr">预约时间：'+v.make_time+'</span></div><ul><li><div class="myreg_name">就诊时间：</div><span class="myreg_con">'+v.date+'</span></li><li><div class="myreg_name">科室：</div><span class="myreg_con">'+v.department+'</span></li><li><div class="myreg_name">医生姓名：</div><span class="myreg_con">'+v.doctor+'</span></li><li><div class="myreg_name">患者姓名：</div><span class="myreg_con">'+v.username+'</span></li><li><a class="am-btn am-btn-danger am-margin-sm cancelbtn" dateid="'+v.id+'">取消预约</a></li></ul></div>';
            		  
            	  });
              }
              $('#resercontent').html(html);
	        	laypage({
                cont: 'pages', // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
								// id="page1"></div>
                pages: datas.pages, // 通过后台拿到的总页数
                curr: curr || 1, // 当前页
                jump: function(obj, first){ // 触发分页后的回调
                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
                    	self.showmyres(curr);
                    }
                }
            });
        	}
        } 
	});
	
}
this.indexsuse=function(){
	$(function(){
	$('#searchshow').click(function(){
		
		$('#searchform').removeClass('am-hide');
		$('#searchinput').focus();
	});
	
	$('#closeform').click(function(){
		$('#searchform').addClass('am-hide');
		
	});
	
    $('#searchinput').bind('keypress',function(event){
    	var searchval=$('#searchinput').val();
    	
        if(event.keyCode == "13")    
        {
        	event.preventDefault();
        	self.searchfun(1,searchval);
        }
    });
	
	});
}

this.searchfun=function(curr,searchval){
	$.ajax({//获取某个用户的预约信息
		type: "POST",
        url: "/home.php?mod=searchs&method=ajaxquery",	        	        
        dataType: "json",
        data:{'page':curr,'size':10,'keyword':searchval},
        success: function(datas){
        	if(datas.stute){
        		var html='';
        		
              if(datas.data.length>0){
            	  $.each(datas.data,function(i,v){
            		  html+='<li><a href="/mobile/article.php?method=get&id='+v.id+'">'+v.subject+'</a></li>';
            		  
            	  });
              }
              
  			$('#my-alert-title').html('搜索结果');
			$('#my-alert-content').html(html);
			$('#my-alert').modal();
              
	        	laypage({
                cont: 'searchpages', // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div
								// id="page1"></div>
                pages: datas.pages, // 通过后台拿到的总页数
                curr: curr || 1, // 当前页
                jump: function(obj, first){ // 触发分页后的回调
                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr
                    	self.searchfun(curr,searchval);
                    }
                }
            });
	        	
	        	
        	}else{
        		$('#my-alert-title').html('搜索结果');
    			$('#my-alert-content').html(datas.msg);
    			$('#my-alert').modal();
        	}
        } 
	});
	
}






	
}