/**
 * 医院设备
 * */
function Device() {
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
	
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){
			self.onloadCss();
			
			//self.getImgSize('newssize');
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				//有id，则是编辑
				$("#id").val(para.id);
				
				self.cmd(gHttp,{controller:'Device',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						$('#id').parent().append('<input type="hidden" id="old_title" name="_title" value="'+result1.data.subject+'">');						
						editor.ready(function(){
							editor.setContent(result1.data.content);
						});
						
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);
							//self.setImgSize('newssize');
						}
					}else{
						$('#message').message(result1.msg);
					}
				});
			}
			
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
			para:{controller:'Device',method:'query'},
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
							  str += '<a style="text-decoration:none" target="_blank" href="/controller/?controller=ViewHtml&method=device&op=device&id='+id+'" title="预览"><i class="Hui-iconfont">&#xe695;</i></a>'; 
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gDevice.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gDevice.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
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
		self.openDel(obj,{controller:'Device',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Device',method:'del',id:ids});
		}
	}

	//动态编辑
	this.edit = function(id){
		self.openEdit('编辑医院设备','device.html?id=' + id);
	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Device',method:'add'};
		} else {
			post = {controller:'Device',method:'edit',id:id};
		}
		$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon:1});	
				layer_close();
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
			return false;
		});
		
		$('#formEdit').submit();
	}
	
}
