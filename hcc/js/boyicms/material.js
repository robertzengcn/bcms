/**
 * 素材库
 * */

function Material() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initList()
	
	/**
	 * 初始化列表
	 * */
	this.initList = function() {
		$(function(){
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			
			//table加载数据
			self.fillDataTable();
			
			$(".tabBar span").click(function(){
				$("#id").val('');
				$("#name").val('');
				editor.setContent('');
			});
			self.initEdit();
		});
	}
	
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function(id) {
		if (id != undefined) {
			//有id，则是编辑
			$("#id").val(id);
			
			self.cmd(gHttp,{controller:'Library',method:'get',id:id},function(result1){
				if(result1.statu){
					$('#formEdit').frmFill('',result1.data);
					editor.ready(function(){
						editor.setContent(result1.data.content);
					});
				}else{
					layer.alert(result1.msg);
				}
			});
		}
		
		//保存
		$('#save').click(function(){
			//alert("ok");					  
			self.save();
		});
	}


	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function() {
		$("#dataTable").grid({
			para:{controller:'Library',method:'query'},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]}
							],
			field : [
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
                        { data: 'id' },
			            { data: 'name' },
			            { data: 'content', render : function(content, type, row) {
			            	return '<div onclick="gMaterial.putintoedit('+row.id+');" style="width:100%;height:40px;overflow:hidden;">'+content+'</div>';
			            }},
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
				              str += '<a style="text-decoration:none" onClick="gMaterial.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe60c;</i></a>&nbsp;';
				              str += '<a style="text-decoration:none" onClick="gMaterial.del('+id+');" href="javascript:;" title="删除" class="ml-5"><i class="Hui-iconfont">&#xe6e2;</i></a>';
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
		self.openDel(obj,{controller:'Library',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Library',method:'delBatch',id:ids});
	}

	//动态编辑
	this.edit = function(id){
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
		$("#id").val(id);
		self.initEdit(id);
	}
	
	this.putintoedit=function(id){		
		if(id!=undefined){
			self.cmd(gHttp,{controller:'Library',method:'get',id:id},function(ret){
				var content = ret.data.content;
				self.putcontent(content);
				return false;
			});	
			}
		}
	
	//保存
	this.save = function(){		
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Library',method:'save'};
		} else {
			post = {controller:'Library',method:'update',id:id};
		}
		$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){				
				parent.layer.msg('操作成功!',{icon:1});				
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
				$("#id").val("");				
				var table=$(window.document).find("#dataTable").dataTable();
				table.api().ajax.reload();
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
}
