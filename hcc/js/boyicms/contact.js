/**
 * 医院联系方式
 * */
function Contact() {
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
				
				self.cmd(gHttp,{controller:'Contact',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						//console.log(result1.data);
						if(result1.data.flag=='map'){
							$('#baidusite').show();
							}
						if(result1.data.flag=='swt'){
							$('#swtjsnotic').show();
							}	
						if(result1.data.flag=='swt_link'){
							$('#swtlinknotic').show();
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
	
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function() {
		$("#dataTable").grid({
			para : {controller:'Contact',method:'getByName'},
			showPage : false,
			tableInfo : false,
			order : false,
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
			            { data: 'flag' },
			            { data: 'val',},
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
				              str += '<a name="'+row.flag+'" style="text-decoration:none" class="ml-5" onClick="gContact.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              
				              if (row.is_retain == '0') {
				                  str += '<a style="text-decoration:none" class="ml-5" onClick="gContact.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
				              }
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
		self.openDel(obj,{controller:'Contact',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Contact',method:'delBatch',id:ids});
		}
	}

	//动态编辑
	this.edit = function(id){
		self.openEdit('编辑医院联系方式','contact.html?id=' + id);
	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Contact',method:'save'};
		} else {
			post = {controller:'Contact',method:'update',id:id};
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
