function Register() {
this.init=function(){
	$(function(){
		$('body').on('click','#mpdc3_ckcode',function(){
		$('#mpdc3_ckcode').attr('src','../public/img/verify.php?' + Math.random());	
		});
		
	});
}	
}