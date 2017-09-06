/**
 * 云同步
 * */
function CloudSync() {
	BaseFunc.call(this);
	var self = this;
	
	/**
	 * 初始化
	 * */
	this.init = function() {
		$(function(){
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				$("#type").val(para.type);
			}
			self.onloadCss();
			
			//保存
			$('#save').click(function(){
				self.save();
			});
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			
		});
	}
	
	this.openNewWindow = function(title, type){
		var url = 'cloudsync/qqyy_hosptalweb.html?type=' + type;
		parent.layer_show(title,url,'580','320');
	}
	
    // {{{ function onloadCss()
	
	/**
	 * 加载css
	 * */
	this.onloadCss = function() {
		$('.skin-minimal input').iCheck({
			checkboxClass: 'icheckbox-blue',
			radioClass: 'iradio-blue',
			increaseArea: '20%'
		});
	}
	
	// }}}
	
	//保存
	this.save = function(){
		var data = {};
		var user = $('#user').val();
		var pwd = $('#pwd').val();
		var type = $("#type").val();  //为以后不同的同步类型做准备
		
		if(user){
			data.user = user;
		}else{
			layer.alert('用户名不能为空');
			return false;
		}
		if(pwd){
			data.pwd = pwd;
		}else{
			layer.alert('密码不能为空');
			return false;
		}
		
		self.cmd(gHttp,{controller:'SysCloud',method:'synchro',data:data},function(result1){
			if(result1.statu == false){
				layer.alert(result1.msg);
				return false;
			}
			var len = result1.data.length;
			if(result1.data == 1){
				if(result1.statu){
					layer.alert('同步成功');
				}else{
					layer.alert('同步失败');
				}
				return false;
			}
			$.each(result1.data,function(index,val){
				if(val.obj == 'contact'){
					layer_confirm(val.name+'已经存在，要覆盖吗？',function(){
						self.cmd(gHttp,{controller:'SysCloud',method:'update',data:val},function(result){
							if(!result.statu){
								layer.alert(result.msg);
								return false;
							}
						});
					});
				}else{
					layer_confirm(val.subject+'已经存在，要覆盖吗？',function(){
						self.cmd(gHttp,{controller:'SysCloud',method:'update',data:val},function(result){
							if(!result.statu){
								layer.alert(result.msg);
								return false;
							}
						});
					});
				}
				if(index == len-1){
					layer.alert('同步成功');
					return false;
				}
			});
		});
	}
	
}