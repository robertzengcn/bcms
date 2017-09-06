function Usercloudysync() {
	Cloudysync.call(this); 
	var self = this;
	this.login = function() {
		$(function(){
		$('#userloginform').checkAndSubmit('loginbtn',{controller:'BoyiManager',method:'accoutcheck','type':1},function(rel){
			if(rel.stute){
				
//				url='http://www.7zm.com/v1/oauth/nopwd/authorize?token='+rel.data.token+'&mobile='+rel.data.mobile;
				var index = parent.layer.getFrameIndex(window.name);
//				parent.layer.full(index);
//				parent.layer.iframeSrc(index, url);
				//console.log(parent.document.location);
				//$("body",parent.document).find('#goim').removeAttr("disabled");	
				parent.layer.close(index);
				//parent.layer.iframeAuto(index);
			}else{
				layer.msg(rel.msg,{icon:2}); 
			}				
		});
		});
	}
	
	
	
	
	
}