/**
 * SEO管理-友情链接设置
 * */
function FLink() {
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
		});
	}
	
	// }}}
	// {{{ function initEdit()
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){
			
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				//有id，则是编辑
				$("#id").val(para.id);
				self.cmd(gHttp,{controller:'Link',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
					}else{
						layer.alert(result1.msg);
					}
				});
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
			para:{controller:'Link',method:'query'},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
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
			            { data: 'url' },
			            { data: 'isdisplay',render:function(value){return value=='1'?'<span class="label label-success radius">是</span>':'<span class="label label-default radius">否</span>';}},
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
				              str += '<a style="text-decoration:none" onClick="gFLink.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gFLink.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
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
		self.openDel(obj,{controller:'Link',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {		
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Link',method:'del',id:ids});
		}
	}

	//动态编辑
	this.edit = function(id){
		self.openEditWID('编辑链接', 'flink-edit.html?id=' + id,'652','280');
	}
	
	// {{{ function save()
	
	/**
	 * 保存
	 * */
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Link',method:'add'};
		} else {
			post = {controller:'Link',method:'edit',id:id};
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
	
	// }}}
}
