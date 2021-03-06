function Main() {
	BaseFunc.call(this);
	
	var self = this;
	
	this.init = function() {
		$(function(){
			self.cmd(gHttp,{controller : 'Login',method : 'getLoginUserInfo'},function(res){
				if (res.statu) {
	    			$('#loginUserName').html(res.data.name);
	    			//$('#loginUserType').html(res.data.type);
	    			
    				//开启用户使用权限
    				self.cmd(gHttp,{controller:'Worker',method:'get',id:res.data.id},function(result1){
    					if(result1.statu){
    						if (result1.data.acls != '' && result1.data.acls != null) {
    							$("dl[id^='menu-']").hide();
	    						$("ul[flag^='ul-']").hide();
    							$.each(result1.data.acls,function(m,v){
    								$("#" + m).show();
    								$("#" + m).find('dd ul').show();
									$("#" + m).find('dd ul li').hide();
									$("li[flag='home']").show();
    								$.each(v,function(i,vv){
    									$("li[flag='"+vv+"']").show();
    								});
    							});
    						}
    					}else{
    						layer.alert(result1.msg);
    					}
    				});
	    		}
        	});
			
			//获取domain，拼接营销学院，常见问题，在线教程链接
			self.cmd(gHttp,{controller:'Mobile',method:'getDomain'},function(ret){
				if(ret.statu){
					var domain = ret.data.domain;
					var url = 'http://www.boyicms.com/admin/?q=help.do';
					//营销学院
					$("li[flag='school'] a").attr('_href', url + '&action=seosuport&domain=' + domain);
					//常见问题
					$("li[flag='questions'] a").attr('_href', url + '&action=faq&domain=' + domain);
					//在线教程，如果不修改，则使用本地目录下的视频教程
					$("li[flag='online'] a").attr('_href', url + '&action=onlineteach&domain=' + domain);
				}
			});
		});
	}
	// {{{ function logout()
	
	/**
	 * 注销
	 * */
	this.logout = function() {
		self.cmd(gHttp,{
            controller : 'Login',
            method : 'logout'
        }, function(ret) {
            if (ret.code) {
                alert('注销成功!');
                location.replace('/hcc/login.html');
            }
        });
	}
    
	// }}}
	// {{{ function article_add()
	
	/*
	 * 跳转到
	 * */
	this.jumpUrl = function (title,url,w,h){
		var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
		layer.full(index);
	}
	
	// }}}
	
}