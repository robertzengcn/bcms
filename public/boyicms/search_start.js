$(document).ready(function(){
	$('#save').click(function(){	
		var keyword = $("#keyword").val();
		if('' == keyword){
			alert("请输入查询内容！");
		}else{
			window.location = "/search.html?keyword="+keyword;
		}
		
	 });
	});
