function Cloudysync() {
	BaseFunc.call(this);
	var self = this;
	var count=60;
	this.init = function() {//初始化页面
		$(function(){
			var urlpara = self.parseUrl(window.location.href);
			if(urlpara.type==undefined){
				urlpara.type=0;
			}
			
			
			$('body').on('click','#registerpage,#loginpage',function(){
				var index = parent.layer.getFrameIndex(window.name);
				parent.layer.iframeAuto(index);
			});

			//导航切换
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			$('body').on('click','#getcode',function(){
			self.getcode();
			});
//			$("#registerform").Validform({
//				tiptype:2,
//				ajaxPost:true,
//				url:'',
//			});
			//var post={controller:'BoyiManager',method:'submitform'};
			$('#registerform').checkAndSubmit('save',{controller:'BoyiManager',method:'submitform'},function(ret){
				if(ret.stute){
					var laymsg =layer.msg('注册成功，正在验证网站所有权限');
					self.cmd(gHttp,{controller:'BoyiManager',method:'getremote',username:ret.data.username},function(rey){
						if(rey.stute){
							layer.close(laymsg);
							layer.open({
								  content: '已完成注册，现在可以登录'
								  ,btn: ['确定', '取消']
								  ,yes: function(index, layero){
								    //按钮【按钮一】的回调
									  layer.close(index);
									  $("#loginpage").trigger("click");
								  },cancel: function(){ 
								    //右上角关闭回调
									  
								  }
								});
						}else{
							//layer.alert(rey.msg,{icon: 2});
							layer.close(laymsg);
							//这里需添加一段改变界面的函数
							
							layer.open({
								  content: '<p>认证失败，请手动下载认证文件，请检查根目录是否存在文件：<a href="http://'+rey.data+'">查看</a></p>'
								  ,btn: ['确定']
								  ,yes: function(index, layero){
								    //按钮【按钮一】的回调
									  layer.close(index);
									  //$("#loginpage").trigger("click");
								  }
								});
						}
					});
					
					
			//$('#tab-category').html('<p>注册成功,点击确认验证成为网站做所有者!<input id="yanzheng" type="button" value="验证"><input type="hidden" id="usenamecheck" value="'+ret.data.username+'"></p>');
            
					
				}else{
					layer.alert(ret.msg,{icon: 2});
					$('#pwd').val('');
					$('#pass').val('');
					$('#verify').val('');
					$("#verifyimg").attr('src','../public/img/verify.php?' + Math.random()); 
					
					
				}

			});
			
			$('body').on('click','#yanzheng',function(){
				var username=$('#usenamecheck').val();
				self.cmd(gHttp,{controller:'BoyiManager',method:'getmsg',username:username},function(ret){
					
				});
			});

			$('#loginform').checkAndSubmit('loginbtn',{controller:'BoyiManager',method:'accoutcheck','type':urlpara.type},function(rel){
				if(rel.stute){
					
					if(urlpara.type=='1'){
					var url='http://www.7zm.com/v1/oauth/nopwd/authorize?token='+rel.data.token+'&mobile='+rel.data.mobile;
					
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.full(index);
					parent.layer.iframeSrc(index, url);
					}else if(urlpara.type=='2'){
						var script=[];
						var vs='http://www.xingkongmt.com/auth/login?userid='+rel.data.userid+'&token='+rel.data.token;
						script.push(vs);
						self.loadScripts(script,function(){//action after script load
							
							
							var index = parent.layer.getFrameIndex(window.name);
							parent.layer.full(index);
							parent.layer.iframeSrc(index, rel.data.control);
		
						});	
						
						
					}else if(urlpara.type=='3'){
						
						var index = parent.layer.getFrameIndex(window.name);
						parent.layer.close(index);
						
						parent.duanxin.checkinfos();
						
						
						
					}else{
						layer.msg('登录成功', {icon: 1}); 
						var index = parent.layer.getFrameIndex(window.name);
						parent.layer.close(index);
					}
					//parent.layer.iframeAuto(index);
				}else{
					layer.msg(rel.msg,{icon:2}); 
				}				
			});
			
			$('body').on('click','#kanbuq,verifyimg',function(){
				self.verify();
			})
			
			
			
			
			
			
		});
	}
	//获取验证码
	this.getcode=function(){
		if(count<60){
			return false;
		}
		if($(this).hasClass('btn-default')){
			return false;
		}
		var mobile=$('#phone').val();
		if(mobile==""){
			layer.msg('请输入手机号码',{icon:2}); 
			return false;
		}
		
		 var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
		 if (!reg.test(mobile)) {
			 layer.msg('请输入正确的手机号码',{icon:2});
			  return false;
		 };

		self.cmd(gHttp,{controller:'BoyiManager',method:'getmsg',mobile:mobile},function(ret){
			if(ret.stute){
				$("#getcode").attr('disabled', true);
				$("#getcode").removeClass('btn-success');
				$("#getcode").addClass('btn-default');						
				$('#getcode').html('<i class="Hui-iconfont">&#xe60e;</i>稍等'+count+'秒重新获取').animate({left:"-96px"});
				var int=setInterval(function(){
					count=count-1;
					if(count>0){
					$('#getcode').html('<i class="Hui-iconfont">&#xe60e;</i>稍等'+count+'秒重新获取').animate({left:"-96px"});
					//console.log(count);
					}else{
						window.clearInterval(int);
						count=60;
						$('#getcode').html('<i class="Hui-iconfont">&#xe63f;</i> 获取验证码');
						$("#getcode").removeClass('btn-default');
						$("#getcode").addClass('btn-success').animate({left:"-96px"});
					}						
				},1000);
				
				//setInterval(function(){console.log("Hello")},3000); 

			}else{							
				layer.msg(ret.msg,{icon:2}); 							
			}
		});
		
	}
	
	
	this.reducecount=function(){
		
		count=count-1;
		
//		if(count>0){
//		$('#getcode').html('<i class="Hui-iconfont"></i>'+count);
//		console.log(count);
//		}else{
//			window.clearInterval(int);
//		}
	}
	this.verify=function(){
		$('#verifyimg').attr('src', '../public/img/verify.php?' + Math.random());
	}
	
	
	
	
}