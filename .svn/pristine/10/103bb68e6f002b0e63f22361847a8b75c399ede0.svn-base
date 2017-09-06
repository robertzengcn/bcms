/**
 * 微博设置
 * */
function Weibo() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initList()
	
	/**
	 * 初始化
	 * */
	this.initedit = function() {
		$(function(){
			self.cmd(gHttp,{controller:'Weibo',method:'getcallback'},function(ret){
				if(ret.stute){
					$('#loginform').append('<input type="hidden" value="'+ret.data+'" name="redirect_uri">');
				}
			});
	    	self.cmd(gHttp,{controller:'Weibo',method:'getapp'},function(result1){
	    		if(result1.stute){
	    			
	    		$('#appkey').val(result1.data.appkey);
	    		$('#appsecret').val(result1.data.appsecret);
	    		}
	    	}); 
			
			$('#loginform').Validform({
				btnSubmit:"#loginbtn", 
				tiptype:1, 
				showAllError:false,
				postonce:true,
				beforeSubmit:function(curform){
					var flag=false;
					var appkey=$('#appkey').val();
					var appsecret=$('#appsecret').val();
					self.cmd(gHttp,{controller:'Weibo',method:'saveapp',appkey:appkey,appsecret:appsecret},function(ret){
					if(!ret.stute){
						flag=true;
						
					}else{
						$('#secretdiv').remove();
					}	
					});
					if(flag){
						return false
						}
				},

			});
			
		});
	}
	
	this.access=function(){
		$(function(){						
			//获取参数
			var para = self.parseUrl(window.location.href);
			if(para.code){
				self.cmd(gHttp,{controller:'Weibo',method:'savecode',code:para.code},function(ret){
					if(ret.stute){
						self.cmd(gHttp,{controller:'Weibo',method:'access_token'},function(ret1){
							if(ret1.stute){
							layer.msg('token请求成功');
							var index = parent.layer.getFrameIndex(window.name);
							parent.layer.close(index);
							}
						});
					}
					
				});
			}else{
				layer.msg('code参数不存在');
			}
		});
	}
	
	
}
