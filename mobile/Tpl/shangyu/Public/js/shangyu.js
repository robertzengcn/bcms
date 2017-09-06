function Shangyu() {
var self = this;
laypage.dir='./Tpl/shangyu/Public/css/laypage.css';
var matched, browser;//解决js兼容问题

jQuery.uaMatch = function( ua ) {
    ua = ua.toLowerCase();

    var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
        /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
        /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
        /(msie) ([\w.]+)/.exec( ua ) ||
        ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
        [];

    return {
        browser: match[ 1 ] || "",
        version: match[ 2 ] || "0"
    };
};

matched = jQuery.uaMatch( navigator.userAgent );
browser = {};

if ( matched.browser ) {
    browser[ matched.browser ] = true;
    browser.version = matched.version;
}

// Chrome is Webkit, but Webkit is also Safari.
if ( browser.chrome ) {
    browser.webkit = true;
} else if ( browser.webkit ) {
    browser.safari = true;
}

jQuery.browser = browser;
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
	        		if (!v.specialty && typeof(v.specialty)!="undefined" && v.specialty!=0){
	        			v.specialty="";
	        			}
	        		
	        		var html='';
	        		html+='<ul class="am-list"><li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left am-padding-bottom-0"><div class="am-u-sm-4 am-list-thumb am-padding-left-0"><a href="/mobile/doctor.php?method=get&id='+v.id+'"><img class="am-img-responsive" src="/upload'+v.pic+'" alt="'+v.name+'"></a></div><div class="am-u-sm-8 am-list-main am-padding-0"><h3 class="am-list-item-hd am-margin-bottom-xs"><a href="/mobile/doctor.php?method=get&id='+v.id+'">'+v.name+'</a></h3><div class="am-list-item-text am-margin-bottom-xs color_444">科室：'+v.department_name+' &nbsp;&nbsp; 职称：'+v.position+'</div><div class="am-list-item-text">个人简介: '+v.specialty+'<a href="/mobile/doctor.php?method=get&id='+v.id+'"><详情></a></div></div></li></ul>';	        			        		
	        		$('#doctorlist').append(html);
	        		
	        		$.ajax({
	        			type: "POST",
	        	        url: "/home.php?mod=doctors&method=getdoctor",	        	        
	        	        data: {name:v.name},
	        	        dataType: "json",
	        	        success: function(datas){
	        	        	if(datas.stute){
	        	        		$.each(datas.data,function(s,q){
	        	        			$('#'+v.id+'_'+q.angle).html('<a target="_blank" href="#">约</a>');
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
		var widths=$(document).width()-75;
		
		
		$('body').on('click','.am-icon-chevron-left',function(){
			var weizhi=$('#depnavlist').scrollLeft();
			if(weizhi==0){
				return false;
			}
			weizhi=weizhi-widths;
			$("#depnavlist").scrollLeft(weizhi);
		});
		$('body').on('click','.am-icon-chevron-right',function(){
			 var weizhi=$('#depnavlist').scrollLeft();
			
		   
			weizhi=weizhi+widths;
			$("#depnavlist").scrollLeft(weizhi);
		});
		$('.doctable').each(function(){
			var thisone=this;
			var depid=$(this).attr('docid');
    		$.ajax({type: 'POST',
		    url:'/home.php?mod=reservations&method=getresbydoc',
		    data:{'id':depid},			    			    
		    dataType: 'json',
		    success: function(datadep){
		    	if(datadep.statu&&datadep.code=="0"){
		    		
		    		var restime="";
		    		var weekstr="";
		    		$.each(datadep.data,function(s,l){
		    			console.log(l.week);
		    			switch(l.week)
		    			{
		    			case "1":
		    			  weekstr="周一";
		    			  break;
		    			case "2":
		    			weekstr="周二";
		    			  break;
		    			case "3":
			    		weekstr="周三";
			    		break;
		    			case "4":
				    		weekstr="周四";
				    		break;
		    			case "5":
				    	weekstr="周五";
				    		break;
		    			case "6":
				    	weekstr="周六";
				    		break;	
		    			default:
		    			weekstr="周日";
		    			};
		    				
		    		restime+=weekstr+l.timerang+"、 ";

		    		});
		    		
		    		$('#doc_'+depid).html(restime);
	    	
		    	}else{
		    		$('#doc_'+depid).html('本周暂无可预约信息');
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
	        		var len=datas.data.length;
	        		
	        		$.each(datas.data,function(s,q){
	        			$('#'+q.angle).html('<a target="_blank" href="/mobile/doctormanager.php?method=reserve&id='+q.id+'">约</a>');
	        		
	        			if(s==len-1){
	        				
	        			$('#goreser').attr('href','/mobile/doctormanager.php?method=resernodate&doctor_id='+q.doctor_id);
	        		}
	        		});
	        		
	        	}else{
	        		//$('#schedutable').hide();
	        		$('#schedutable').prepend('<div><p>该医生本周暂无排班</p></div>');
	        		$('#goreser').hide();
	        		
	        	}
	        } 
		});
	});
}

this.checklogin=function(){//判断登录
	
		self.checkuser();

		
		self.loginregisform();//启动登录注册函数

	
	}
this.loginregisform=function(){
	$(function(){
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
					'data': {mobile:mobile, token:token,cms:1},
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
							//alert(data.msg);
							self.startmodal(data.msg);	
						}
					}
					
					
				});
			
		});
		
		var loginform=$("#loginform").Validform({//登录框
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
				if(data.statu){//注册成功
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html('登录成功');
					$('#my-alert').modal();
					setInterval(function(){
						$('#my-alert').modal('close');
					}, 3000); 
					
					$('#Login').modal('close');
					if( typeof jump === 'function' ){
						jump();					    
					}
					
					//window.location.reload();
				}else{
					
					
					$('#mpdc4_ckcode').attr('src','/public/img/verify.php?' + Math.random());	
					
					$('#tpassword').val('');
					$('#captcha').val('');
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html(data.msg);
					$('#my-alert').modal();
					setInterval(function(){
						$('#my-alert').modal('close');
					}, 3000); 
                     return false;
				}
				
				
			},
			
				
		});
		
		var registerform=$("#registerform").Validform({//注册框
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

					$('.Validform_checktip').removeClass('Validform_loading');
					$('.Validform_checktip').html('');

				if(data.status){//注册成功
					
					self.startmodal('注册成功');
					$('#Login').modal('close');
					if( typeof jump === 'function' ){
						jump();					    
					}
				}else{
					//self.changecode();
					//console.log(data.msg);
					
					$('#password').val('');
					self.startmodal(data.msg);
					//alert(data.msg);
				}
				
				
			},
			
				
		});
		
		$('#mpdc4_ckcode').click(function(){
			$('#mpdc4_ckcode').attr('src','/public/img/verify.php?' + Math.random());
		});
		
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
				if( typeof jump === 'function' ){
					jump();					    
				}
        		
        	}else{        		
        		$('#Login').modal();
        		
        		$('#mpdc4_ckcode').attr('src','../public/img/verify.php?' + Math.random());
        	}
        } 
	});

//	$('body').on('click','#mpdc4_ckcode',function(){
//		$('#mpdc4_ckcode').attr('src','../public/img/verify.php?' + Math.random());
//	});
	$('#mpdc4_ckcode').click(function(){
		$(this).attr('src','../public/img/verify.php?' + Math.random());
	});
}
this.startmodal=function(msg){
	$('#my-alert-title').html('提示');
	$('#my-alert-content').html(msg);
	$('#my-alert').modal();
	setInterval(function(){
		$('#my-alert').modal('close');
	}, 6000); 
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
		$('body').on('change','#doctor_id',function(){
			var doctorid=$('#doctor_id option:selected').val();
			if(doctorid==""){
				return false;
			}
			$.ajax({//获取所选医生本周的排班信息
				type: "POST",
		        url: "/home.php?mod=reservations&method=getresbydoc",	        	        
		        dataType: "json",
		        data:{'id':doctorid},
		        success: function(data){
		        	if(data.statu){
		        		 $(".dtd").html("");
		        		$.each(data.data,function(i,v){
					       
					        $('#'+v.timetype+'_'+v.week).html('<a href="javascript:void(0)" target="_blank">可约</a>');
					       
			                $('#docrestab').show();	
		        		});

		        	}

		        } 
			});
			
		});
	});
	
}

this.login=function(){
	$(function(){
		
self.loginregisform();



	});
}

this.kanfu=function(){
	$(function(){
		$('.deplist').each(function(){
			var desid=$(this).attr('dataid');
			var selfcon=this;
			var kanfuid=$('#kanfuid').val();
           self.getartbydepdea(kanfuid,desid,1,selfcon);

			
		});
	});
}

this.getartbydepdea=function(dep,dea,curr,selfcon){
	
	$.ajax({type: 'POST',
	    url:'/home.php?mod=articles&method=getbydepid',
	    data:{'department_id':dep,'disease_id':dea,'page':curr,'size':5},
	    dataType: 'json',
	    success: function(data){
	    	if(data.stute){
	    		var html="";
	    		if(data.data.length>0){
	    			$.each(data.data,function(i,v){
	    				html+='<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left"><h3 class="am-list-item-hd am-padding-0"><a href="/mobile/article.php?method=get&id='+v.id+'" class="">'+v.subject+'</a></h3><span class="am-list-date am-block">'+v.articletime+'</span><div class="am-u-sm-4 am-list-thumb"> <a href="/mobile/article.php?method=get&id='+v.id+'" class=""> <img src="/upload/'+v.pic+'" alt="'+v.subject+'"> </a> </div><div class=" am-u-sm-8  am-list-main"><div class="am-list-item-text">'+v.description+'</div></div></li>';
	    			});
	    			
	    		}
	    		$(selfcon).html(html);
	    		
	        	laypage({
	                cont: 'page_'+dea, // 容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div									
	                pages: data.pages, // 通过后台拿到的总页数
	                curr: curr || 1, // 当前页
	                jump: function(obj, first){ // 触发分页后的回调
	                    if(!first){ // 点击跳页触发函数自身，并传递当前页：obj.curr	                    	
	                    	self.getartbydepdea(dep,dea,obj.curr,selfcon);
	                    }
	                }	        	
	            });
	    	}
	    }
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
            		  html+='<div id="reser_'+v.id+'" class="myreg am-container"><div class="myreg_tit"><strong class="am-fl"></strong><span class="am-fr">预约时间：'+v.make_time+'</span></div><ul><li><div class="myreg_name">就诊时间：</div><span class="myreg_con">'+v.date+'</span></li><li><div class="myreg_name">科室：</div><span class="myreg_con">'+v.departmentname+'</span></li><li><div class="myreg_name">医生姓名：</div><span class="myreg_con">'+v.doctorname+'</span></li><li><div class="myreg_name">患者姓名：</div><span class="myreg_con">'+v.username+'</span></li><li><a class="am-btn am-btn-danger am-margin-sm cancelbtn" dateid="'+v.id+'">取消预约</a></li></ul></div>';
            		  
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

this.contact=function(){
	$(function(){
		$('body').on('click','.jiathis_btn',function(){
			var weixin=$(this).attr('datasrc');
			var title=$(this).attr('datatitle');
		$('#sharemodtitle').html('扫描二维码关注'+title);
		$('#sharesrc').attr('src',weixin);
		var $modal = $('#doc-modal-1');
		$modal.modal();
		});


	});
	
}
this.tijian=function(){
	  $(function ()
			  {   
			      $('.mian_jktj .am-tab-panel > .jktj_box li').hide().eq(0).show()
					  
				  $('.mian_jktj .am-tab-panel > .jktj_nav li').click(function(){
					  $(this).closest('.jktj_nav').find('li.active').removeClass('active');
			          $(this).addClass('active');
					  
					  
					  $('.mian_jktj .am-tab-panel > .jktj_box li').hide();
					  var num=$(this).index();
					  $('.mian_jktj .am-tab-panel > .jktj_box li:eq(' + num + ')').show();
					  
					  
					  });
			      var widths=$(document).width()-70;
					$('body').on('click','.fleft',function(){
						var weizhi=$('#depnavlist').scrollLeft();
						
						console.log(widths);
						if(weizhi==0){
							return false;
						}
						weizhi=weizhi-widths;
						$("#depnavlist").scrollLeft(weizhi);
					});
					$('body').on('click','.fright',function(){
						 var weizhi=$('#depnavlist').scrollLeft();
						
					   
						weizhi=weizhi+widths;
						$("#depnavlist").scrollLeft(weizhi);
					});
					var controlbo=$(this).parent().find('.jktj_nav');
					$('body').on('click','.sleft',function(){
						
						var weizhi=$(controlb).scrollLeft();
						
						console.log(widths);
						if(weizhi==0){
							return false;
						}
						weizhi=weizhi-widths;
						$(controlbo).scrollLeft(weizhi);
					});
					$('body').on('click','.sright',function(){
						
						 var weizhi=$(controlbo).scrollLeft();
						 console.log(weizhi);
					   
						weizhi=weizhi+widths;
						$(controlbo).scrollLeft(weizhi);
					});
					
					$.ajax({//检测用户是否登录， 未登陆的话弹出对话框
						type: "POST",
				        url: "/home.php?mod=login&method=islogin",	        	        
				        dataType: "json",
				        success: function(datas){
				        	if(datas.statu){
				        		$('#botbtn').append('<li><a href="javascript:void(0)" onclick="jump();"><i class="am-icon-calendar-check-o"></i><span class="am-navbar-label">体检预约</span></a></li>');
				        	}else{        		
				        		$('#botbtn').append('<li><a href="javascript:void(0)" id="tijianicon"><i class="am-icon-calendar-check-o"></i><span class="am-navbar-label">体检预约</span></a></li>');
				        	}
				        } 
					});
					
					
			      
					$('body').on('click','#tijianicon',function(){
			    	  self.checklogin();			    	  
			      });
			  }); 
}
this.pass=function(){
	$(function (){
		$('#mpdc4_ckcode').click(function(){
			$('#mpdc4_ckcode').attr('src','/public/img/verify.php?' + Math.random());
		});
		var loginform=$("#changepass").Validform({
			btnSubmit:"#submit", 			
			tiptype:function(msg, o, cssctl){
				if (o.type != 2) {
					
					//状态为2表示通过验证，成功就不提示						
					//页面上不存在提示信息的标签时，自动创建		
					if(o.obj.hasClass('authcode')){
						var $alam=o.obj.next();								
						$alam.html('<span class="Validform_checktip"></span>');
						
						var objtip = o.obj.parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
					else{
						var $alam=o.obj.next();								
						$alam.html('<span class="Validform_checktip"></span>');
						var objtip = o.obj.parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
				}
				else if (o.type == 2){
					 if(o.obj.hasClass('authcode')){
							var $alam=o.obj.next();								
							$alam.html('<span class="Validform_checktip Validform_right"></span>');
							
					}
					else{
						var $alam=o.obj.next();								
						$alam.html('<span class="Validform_checktip Validform_right"></span>');								
					}							
						
				}
			}, 
			
			ajaxPost:true,
			url:'/home.php?mod=users&method=change_password',
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
				if(data.status){//修改密码成功
					$('#my-alert-title').html('提示');
					$('#my-alert-content').html('密码修改成功');
					$('#my-alert').modal();
					setTimeout(function(){
						$('#my-alert').modal('close');
					}, 3000); 
					window.location.href='/mobile/login.php?method=loginout'; 
					
		
				}else{

					$('#my-alert-title').html('提示');
					$('#my-alert-content').html(data.msg);
					$('#my-alert').modal();
					$(':input[type=password]').each(function(){
						
						$(this).val('');
						
					});
					$('#mpdc4_ckcode').attr('src','/public/img/verify.php?' + Math.random());	
					setTimeout(function(){
						$('#my-alert').modal('close');
					}, 3000); 
					

				}
				
				
			},
			
				
		});
		
	});
}
this.introduce=function(){

	$(function (){
		$('body').on('click','.jumppage',function(){
			var weizhi=$(this).attr('dataid');
			console.log(weizhi);
			$.scrollTo(weizhi,500); 
			
		});
	});
}
this.doctorpage=function(){
	$(function (){
		

		
	});		
}
this.findpass=function(){
	$(function (){
		var count=60;
		$('body').on('click','#getcode',function(){
			if(count<60){
				return false;
			}
			var mobile=$('#phone').val();
			if(mobile==""){
				self.startmodal('请输入手机号码');
				//layer.msg('请输入手机号码',{icon:2}); 
				return false;
			}
			
			 var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
			 if (!reg.test(mobile)) {
				 //layer.msg('手机号码不正确',{icon:2});
				 self.startmodal('手机号码不正确');
			      return false;
			 };
			 
				$.ajax({
					type: "POST",
			        url: "/home.php?mod=register&method=gettoken",	        	        			        
			        dataType: "json",
			        success: function(tdatas){
if(tdatas.status){
			$.ajax({
					type: "POST",
			        url: "/home.php?mod=register&method=sendcode",	        	        
			        dataType: "json",
			        data: {'mobile':mobile,'token':tdatas.data},
			        success: function(ret){
			
				if(ret.stute){
					$("#getcode").attr('disabled', true);
					$("#getcode").removeClass('btn-success');
					$("#getcode").addClass('btn-default');
					
					$('#getcode').html('<i class="am-icon-envelope"></i>稍等'+count+'秒重新获取');
					var int=setInterval(function(){
						
						
						count=count-1;
						
						if(count>0){
						$('#getcode').html('<i class="am-icon-envelope"></i>稍等'+count+'秒重新获取');
						//console.log(count);
						}else{
							window.clearInterval(int);
							count=60;
							$('#getcode').html('<i class="am-icon-envelope"></i> 获取验证码');
							$("#getcode").removeClass('btn-default');
							$("#getcode").addClass('btn-success');
						}						
					},1000);
					
					//setInterval(function(){console.log("Hello")},3000); 

				}else{							
					//layer.msg(ret.msg,{icon:2}); 	
					self.startmodal(ret.msg);
				}
				}
			});
			        }else{
			        	self.startmodal(tdatas.msg);
			        	//layer.msg(tdatas.msg,{icon:2}); 	
			        }
			        }
				});
			
			
		});
		//实例化表单
		var loginform=$("#changepass").Validform({
			btnSubmit:"#submitbtn", 			
			tiptype:function(msg, o, cssctl){
				if (o.type != 2) {
					
					//状态为2表示通过验证，成功就不提示						
					//页面上不存在提示信息的标签时，自动创建		
					if(o.obj.hasClass('authcode')){
						var $alam=o.obj.next();								
						$alam.html('<span class="Validform_checktip"></span>');
						
						var objtip = o.obj.parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
					else{
						var $alam=o.obj.next();								
						$alam.html('<span class="Validform_checktip"></span>');
						var objtip = o.obj.parent().find(".Validform_checktip");								
						cssctl(objtip,o.type);						
						objtip.text(msg);
					}
				}
				else if (o.type == 2){
					 if(o.obj.hasClass('authcode')){
							var $alam=o.obj.next();								
							$alam.html('<span class="Validform_checktip Validform_right"></span>');
							
					}
					else{
						var $alam=o.obj.next();								
						$alam.html('<span class="Validform_checktip Validform_right"></span>');								
					}							
						
				}
			}, 
			
			ajaxPost:true,
			url:'/home.php?mod=register&method=valimesscode',
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
				if(data.status){//修改密码成功
					
					self.startmodal('修改密码成功');
					window.location.href="/mobile/login.php"; 
		
				}else{

					$('#my-alert-title').html('提示');
					$('#my-alert-content').html(data.msg);
					$('#my-alert').modal();
					$(':input[type=password]').each(function(){
						
						$(this).val('');
						
					});
					$('#mpdc4_ckcode').attr('src','/public/img/verify.php?' + Math.random());	
					setTimeout(function(){
						$('#my-alert').modal('close');
					}, 3000); 
					

				}
				
				
			},
			
				
		});
		
		
	});
}
/**
 * 医生预约页面
 */
this.doctorreserve = function(){
	$(function (){
		self.getresertime();
	 
       $("#appointment").change(function(){
    	  var time = $(this).val();
    	  $("#time").val(time);
    	  var restime = $("#appointment").find('option:selected').text();
          $('#restime').val(restime);
       }); 
       
       //提交表单
       $('body').on('click','#save',function(){
       	   var mobile=$('#hometel').val();
    	   if(mobile==""||!self.checkPhone(mobile)){    		  
    		   self.startmodal('请检查手机号码');
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
					if (data.statu) {//如果该手机号验证过
						self.validresform('#formID');
					}else{//如果没有验证过
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
   					self.startmodal('请检查手机号码');   					
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
					$('#my-modal-loading').modal('close');
					self.validresform('#formID');
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
   	
       
});
}

/**
 * 医生页面表单提交方法
 * */
this.validresform=function(form){
	   var demo = $(form).Validform({
		    //btnSubmit:"#save", 
		    tiptype:2,
			ajaxPost:true,
			url:'/home.php?mod=reservations&method=saveBookingInfo',
			callback:function(data){
				if(data.statu == true){
					demo.resetForm();
					$("#Validform_msg").text('');
					self.startmodal('预约成功');
					self.getresertime();
				}else{
					$('#Validform_msg').remove();
					self.startmodal(data.msg);
					
				}
	        }
	   });
	   $(form).submit();
	   
}

/**
 * 验证手机号码方法
 * */
this.checkPhone=function(phone) {
	if (!(/^1[34578]\d{9}$/.test(phone))) {
		return false;
	} else {
		return true;
	}
}

this.getresertime=function(){
	$(function (){
	 var department_id=$("#department_id").val();
	 var doctor_id=$("#doctor_id").val();
	 var date=$("#date").val();
	 if("undefined" != typeof date&&date!=""){//日期已定义
		 self.queryrestime(department_id,doctor_id,date);
	 }else{
		 $(function (){
		$('#date').remove(); 
		 $('#dateinput').remove();
		var dateinput='<div class="am-form-group" id="dateinput"><label for="doc-ipt-3" class="am-u-sm-3 am-u-md-2 am-form-label">日&nbsp;&nbsp;期：</label><div class="am-u-sm-9 am-u-md-10"><input class="form-control choosedate" placeholder="日期" id="date" nullmsg="日期输入错误！" datatype="*" name="date" onchange="gShangyu.getresertimes();"></div></div>';
		 $("#formID").prepend(dateinput);
		 $('body').on('focus','#date',function(){
			 WdatePicker({minDate:'%y-%M-%d'}); 
		 });
	
		 });	
		 
	 }

	});
}

this.getresertimes=function(){
	 $(function (){
		 var department_id=$("#department_id").val();
		 var doctor_id=$("#doctor_id").val();		 
		 var date=$("#date").val();
self.queryrestime(department_id,doctor_id,date);
		 
	 });
	
}
this.queryrestime=function(department_id,doctor_id,date){
	
	 $.ajax({
		   type:"POST",
		   url:"/home.php?mod=reservations&method=getreservation",
		   dataType: "json",
		   data:{'department_id':department_id,'doctor_id':doctor_id,'date':date},
		   success:function(ret){
if(ret.data.ttl>0){
	
			   if(ret.data.rows.length){
				   
				   var timehtml="<option value='-1'>--请选择预约时间--</option>"; 
				   for(k in ret.data.rows){
					   
					   var strs= new Array(); //定义一数组
					   strs=ret.data.rows[k].time_point.split("@");  
                       $.each(strs,function(i,v){
                    	   if(v!="0"){
                    	   timehtml+='<option value="'+ret.data.rows[k].id+'">'+v+'</option>'; 
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


	
}