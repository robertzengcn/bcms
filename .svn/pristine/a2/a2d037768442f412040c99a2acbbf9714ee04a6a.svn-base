/**
 * SEO标签设置
 * */
function Seo() {
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
				
				self.cmd(gHttp,{controller:'Seo',method:'get',id:para.id},function(result1){
					if(result1.statu){						
						$('#formEdit').frmFill('',result1.data);
					}else{
						layer.alert(result1.msg);
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
			para:{controller:'Seo',method:'query'},
			initSort : [[0, "asc"]],
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[5]}
							],
			field : [
			            
                        { data: 'id' },
			            { data: 'page_name' },
			            { data: 'title',render:function(value){return value.substr(0,50)+'...';}},
			            { data: 'keywords',render:function(value){return value.substr(0,50)+'...';}},
			            { data: 'description',render:function(value){return value.substr(0,80)+'...';}},
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
				              str += '<a style="text-decoration:none"  onClick="gSeo.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					    	  return str;
						  }
						 }
			        ]
		});
		
	}
	
	// }}}


	//动态编辑
	this.edit = function(id){
		self.openEditWID('编辑SEO标签','seotag-edit.html?id=' + id,'780','480');
	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Seo',method:'add'};
		} else {
			post = {controller:'Seo',method:'edit',id:id};
		}
		$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.alert('操作成功!',{icon: 1});	
				layer_close();
				
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
}
