 $(document).onload(function(){
	 var url = location.search;
	 if (url.indexof('?') != -1){
		 var str = url.substr(1);
		 $.ajax({
			   type:"GET",
			   url:"/controller?controller=Search&method=query&"+str,
			   dataType: "json",
			   success:function(ret){
				  //console.log(ret.data);
				  if(!jQuery.isEmptyObject(ret.data)){
					  for(var p in ret.data){
						  var html = '';
						  html += '<li><a target="_blank" href="'+ret.data[p].urls+'">'+ret.data[p].subject+'</a></li>';
						  $("#search").html();
					  }
				  }else{
						  $("#search").html("未找到您要的搜索内容！");
				  }
					  $("#back").html("“"+ret.key+"“的搜索结果："+ret.ttl+"条。");
				  }
		   }); 
	 }
});
