/**
 * ask页面js文件
 */
$(document).ready(function(){
	//表单提交
	$("#ask_submit").click(function(){
		var msg = Ask.fromValidate('ask_form');
		if(msg === true){
			var isLogin = Ask.isLogin();
			if(isLogin === true){
				Ask.save('ask_form');
			}else{
				return false;
			}
		}else{
			alert(msg);
			return false;
		}
		return false;
	});
	
});