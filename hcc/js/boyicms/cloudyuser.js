/**
 * SEO����-������������
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
	 * ����
	 * */
	this.save = function(){
		
		
		$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				if (id == '') {
					layer.alert('��ӳɹ�!',function(){
						window.parent.gUser.fillDataTable();
						layer_close();
					});
				} else {
					layer.alert('�����޸ĳɹ�,�����µ�¼ϵͳ!',function(){
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
