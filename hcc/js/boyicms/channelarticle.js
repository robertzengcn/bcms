/**
 * 频道资讯
 * */
function ChannelArticle() {
	BaseFunc.call(this);
	var self = this;
	
	// {{{ function initList()
	
	/**
	 * 初始化列表
	 * */
	this.initList = function() {
		$(function(){
			var channel_id = '';
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				channel_id = para.id;
		    }
			//table加载数据
			
			self.fillDataTable(channel_id);
			
			//查询
			$("#qry").click(function(){
				var subject=$('#subject').val();
				var start=$('#logmin').val();
				var end=$('#logmax').val();
				
				var param={controller:'ChannelArticle',method:'get',id:channel_id,subject:subject,start_time:start,end_time:end};
			    self.SearchDataTable(param);
			});
		});
	}
	
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){
			//填充推荐位数据
        	$('#recommendposition').bindRecommend();
        	//频道id
        	var channel_id = '';
        	var para2 = self.parseUrl(parent.location.href);
        	if (para2.id != undefined) {
				$('#channel_id').attr('value',para2.id);
		    }
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				
				//有id，则是编辑
				$("#id").val(para.id);
				
				self.cmd(gHttp,{controller:'ChannelArticle',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						self.fillShowPosition(result1.data.show_position);
						$('#recommendposition').find('input[name^=recommendposition]').each(function(){
							var checkbox = $(this);
							$.each(result1.data.recommend,function(i,obj){
								if(checkbox.val() == obj.recommendposition_id){
									checkbox.attr('checked','checked');
								}
							});
						});	
						var tplurl = $.trim(result1.data.tplurl);
						var detailtplurl = $.trim(result1.data.detailtplurl);
						if(result1.data.is_use_tpl == 1){
							$('#uploadTpl').hide();
							$('#uploadDetailTpl').hide();
						}
						if(tplurl != ''){
							$('#span_list').html('已上传模版文件,模版路径：'+tplurl);
						}
						if(detailtplurl != ''){
							$('#span_detail').html('已上传模版文件,模版路径：'+detailtplurl);
						}
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);
							//self.setImgSize('newssize');
						}
					}else{
						$('#message').message(result1.msg);
					}
				});
			} else {
				$('#source').val(document.domain);
				self.fillShowPosition();
			}
			
			$('[name=name]').change(function(){
				var me = $(this);
				var val = me.val();
				self.cmd(gHttp,{controller:'Pingyin',method:'conversion',data:val}, function(ret){
					$('[name=shortname]').val(ret.data);
				});
			});
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			self.onloadCss();
			//保存
			$('#save').click(function(channel_id){
				self.save(channel_id);
			});
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			
		});
	}
	
   
	// }}}
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.SearchDataTable = function(param) {
		self.cmd(gHttp,param,function(ret) {																								
			var data = ret.rows;
			var total = ret.ttl;
			$("#total").html(total);
			$("#dataTable").DataTable({
				retrieve: true,
				bStateSave:true,
				data:data,
				aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}
							],
				columns: [
				            {
				            	data : 'id',
				            	render : function (id, type, row) {
				            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
				            	}
				            },
                            { data: 'id' },
				            { data: 'subject' },
							{ data: 'description',render:function(value){return value.substr(0,60)+'...';}},
				            { data: 'channelName'},
				            { data: 'plushtime'},
				            {
							  data : 'id',
							  render : function(id, type, row){
								  var str = '';
								  str += '<a style="text-decoration:none" target="_blank" href="/controller/?controller=ViewHtml&method=channelArticle&op=channelArticle&id='+id+'" title="预览"><i class="Hui-iconfont">&#xe695;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gArticle.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gArticle.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						    	  return str;
							  }
							 }
				        ]
			});
		});		
		
	}
	
	//搜索文章
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function(channel_id) {
		var querys={controller:'ChannelArticle',method:'getByChannelID',channel_id:channel_id};
		self.cmd(gHttp,querys,function(ret) {																								
			var data = ret.rows;
			var total = ret.ttl;
			$("#total").html(total);
			$("#dataTable").DataTable({
				retrieve: true,
				bStateSave:true,
				ajax:{
					'url':'../../../controller/',
					'data':querys,
					'type':'POST',
					'dataType':'json',
					'dataSrc':function(json){
						return json.rows;
					}
					
				},
				
				
				aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}
							],
				columns: [
				            {
				            	data : 'id',
				            	render : function (id, type, row) {
				            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
				            	}
				            },
                            { data: 'id' },
				            { data: 'subject' },
							{ data: 'description',render:function(value){return value.substr(0,60)+'...';}},
				            { data: 'channelName'},
				            { data: 'plushtime'},
				            {
							  data : 'id',
							  render : function(id, type, row){
								  var str = '';
								  str += '<a style="text-decoration:none" target="_blank" href="/controller/?controller=ViewHtml&method=channelArticle&op=channelArticle&id='+id+'" title="预览"><i class="Hui-iconfont">&#xe695;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gArticle.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gArticle.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						    	  return str;
							  }
							 }
				        ]
			});
		});		
		
	}
	// }}}
	//单个删除
	this.del = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'ChannelArticle',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'ChannelArticle',method:'delBatch',id:ids});
		}
	}

	//动态编辑
	this.edit = function(id){
		self.openEdit('编辑文章','channelArticle.html?id=' + id);
	}
	
	//保存
	this.save = function(){
		//频道id
    	
		
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'ChannelArticle',method:'save'};
		} else {
			post = {controller:'ChannelArticle',method:'update',id:id};
		}
		$('#formEdit').checkAndSubmit('save', post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		
		$('#formEdit').submit();
	}
	
}
