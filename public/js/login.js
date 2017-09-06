	$(function(){
		
		var loginform=$("#loginform").Validform({
			btnSubmit:"#losubmit", 			
			tiptype:2, 			
			ajaxPost:true,
			url:'/home.php?mod=login&method=dologin',
			beforeSubmit:function(curform){
				
				$.ajax({
					'url':'/home.php?mod=login&method=gettoken',
					'success':function(data){
						if(data.status){
							$('#lotoken').remove();
							curform.append('<input type="hidden" id="lotoken" name="lotoken" value="'+data.data+'">');
						}
					}
				});
				//密码进行md5加密
				curform.find(':input[type=password]').each(function(){
					$(this).val($.md5($(this).val()));
				});
				
				//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
				//这里明确return false的话表单将不会提交;	
			},
			callback:function(data){//清除提交状态

				
				
			},
			
				
		});
//		$('body').on('click','#losubmit',function(){
//			
//			var tmobile=$('#tmobile').val();
//			var tpassword=$('#tmobile').val();
//		$.ajax({
//		'url':'/home.php?mod=login&method=dologin',
//		'data':{'mobile':tmobile,'tpassword':tpassword},
//		'success':function(data){
//			if(data.status){
//				
//				
//			}
//		}
//	});
//		});
		
		
	});