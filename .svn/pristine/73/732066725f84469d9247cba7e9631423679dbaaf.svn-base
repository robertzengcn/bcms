/**
 * 邮件发布设置
 * */
function Email() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initList()
	
	/**
	 * 初始化
	 * */
	this.initEdit = function() {
		$(function(){

		
		});		
	}	
	
	this.setconfig=function(){
		$(function(){
		self.cmd(gHttp,{controller:'Email',method:'getconfig'},function(ret){
				if(ret.stute){
					$('#url').val(ret.data.url);
					$('#cid').val(ret.data.cid);
					$('#pwd').val(ret.data.pwd);
					$('#cell').val(ret.data.cell);
				}
			});
		$('#configform').checkAndSubmit('configbtn',{controller:'Email',method:'updateemail'},function(rel){
			if(rel.stute){
				var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
				parent.layer.close(index); 
				
				
			}else{
				layer.msg(rel.msg,{icon:2}); 
			}				
		});
		$('body').on('click','#back',function(){
			var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
			parent.layer.close(index); //再执行关闭   
		});
		
		});
	}



}	

