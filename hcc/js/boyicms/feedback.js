/**
 * 医院设备
 * */
function Feedback() {
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
				
				self.cmd(gHttp,{controller:'Feedback',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						$('#plushtime').html(result1.data.plushtime);
						$('#content').html(result1.data.content);
						
					}else{
						$('#message').message(result1.msg);
					}
				});
			}
			
			$('.skin-minimal input').iCheck({
				checkboxClass: 'icheckbox-blue',
				radioClass: 'iradio-blue',
				increaseArea: '20%'
			});
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
			para:{controller:'Feedback',method:'query'},
			aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[5]}
							],
			field : [
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
                        { data: 'id' },
                        { data: 'content',render:function(value){return value.substr(0,60)+'...';}},
			            { data: 'plushtime' },
			            { data: 'ischeck',
			            	render: function(id, type, row){
				            	  var span = '';
				            	  if(row.ischeck == 1){
				            		  span += '<span class="badge badge-success radius">已审阅</span>';
				            	  }else{
				            		  span += '<span class="badge badge-default radius">未审阅</span>'; 
				            	  }
				            	  return span;
				           }
			            },
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" onClick="gFeedback.getdetail('+id+');" href="javascript:;" title="审阅"><i class="Hui-iconfont">&#xe695;</i></a>'; 
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gFeedback.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
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
		self.openDel(obj,{controller:'Feedback',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Feedback',method:'del',id:ids});
	}

	//查看详情
	this.getdetail = function(id){
		self.openEditWID('审阅反馈建议','detail.html?id=' + id,650,480);
	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Feedback',method:'add'};
		} else {
			post = {controller:'Feedback',method:'edit',id:id};
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
