/**
 * SEO管理-友情链接设置
 * */
function gCloudyuser() {
	BaseFunc.call(this);
	var self = this;
	
	
	this.getlist=function(){
			
		
		}
	
	
	
	this.initEdit=function(){
		
		
		}
	// {{{ function save()
	
	/**
	 * 保存
	 * */
	this.save = function(){
		
		
		$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				if (id == '') {
					layer.alert('添加成功!',function(){
						window.parent.gUser.fillDataTable();
						layer_close();
					});
				} else {
					layer.alert('密码修改成功,请重新登录系统!',function(){
						self.cmd(gHttp,{controller:'Login',method:'logout'},function(ret){
							if(ret.code){
								top.window.location.href = '/hcc/login.html';
								layer_close();
							}
						});
					});
				}
				
			}else{
				layer.alert(result1.msg);
			}
		});
		
		$('#formEdit').submit();
	}
	
	// }}}
}
