/**
 * 医院新闻
 * */
var oTable = null;
function News() {
	BaseFunc.call(this);
	var self = this;
	
	
	// {{{ function initList()
	
	/**
	 * 初始化列表
	 * */
	 
	this.initList = function() {
		$(function(){
			//table加载数据
			self.fillDataTable();
			
			//查询
			$("#qry").click(function(){
				self.fillDataTable();
			});
		});
	}
/* 	//判断编辑器是否有敏感词汇
	this.setEditorFocus = function(){
		var obj = $('#editor');
 		var content = UE.getEditor('editor').getContentTxt();
		UE.getEditor('editor').addListener('blur',function(editor){
 			self.cmd(gHttp,{controller:'SensitiveWords',method:'titleIsSensitiveOrRepeat',title:content,type:'editor'},
			function(ret){		
					if(ret.statu){
						obj.addClass("Validform_error");
						obj.parent().next().html('<span class="Validform_checktip Validform_wrong">'+ret.msg+'</span>');
					}else{
						obj.removeClass("Validform_error");
						obj.parent().next().html('<span class="Validform_checktip Validform_right"></span>');
					}
				}); 	
		})
    } */	
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){
        	//填充推荐位数据
        	$('#recommendposition').bindRecommend();
        	
			//self.getImgSize('newssize');
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				//有id，则是编辑
				$("#id").val(para.id);
				
				self.cmd(gHttp,{controller:'News',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						$('#id').parent().append('<input type="hidden" id="old_title" name="_title" value="'+result1.data.subject+'">');
						self.fillShowPosition(result1.data.show_position);
						$('#recommendposition').find('input[name^=recommendposition]').each(function(){
							var checkbox = $(this);
							$.each(result1.data.recommend,function(i,obj){
								if(checkbox.val() == obj.recommendposition_id){
									checkbox.attr('checked','checked');
								}
							});
						});	
						
						editor.ready(function(){
							editor.setContent(result1.data.content);
						});
						
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);							
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			} else {
				self.fillShowPosition();
			}
			self.onloadCss();
			//保存
			$('#save').click(function(){
				self.save();
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
	this.fillDataTable = function() {
		$("#dataTable").grid({
			para:{controller:'News',method:'query'},
			aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}
							],
			field : [
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
                        { data: 'id' },
			            { data: 'subject' },
			            { data: 'description',render:function(value){return value.substr(0,60)+'...';}},
			            { data: 'plushtime' },
			            { data: 'click_count' },
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" target="_blank" href="/controller/?controller=ViewHtml&method=news&op=news&id='+id+'" title="预览"><i class="Hui-iconfont">&#xe695;</i></a>'; 
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gNews.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gNews.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
					    	  return str;
						  }
						 }
			        ]
		});
	}
	
	// }}}
	
	//单个删除
	this.del = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'News',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'News',method:'del',id:ids});
		}
	}

	//动态编辑
	this.edit = function(id){
		self.openEdit('编辑','new.html?id=' + id);
	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'News',method:'add'};
		} else {
			post = {controller:'News',method:'edit',id:id};
		}
		$('#formEdit').checkAndSubmit('save',post,function(result1){
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