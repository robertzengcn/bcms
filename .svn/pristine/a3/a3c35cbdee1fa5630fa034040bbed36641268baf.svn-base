/**
 * 自定义导航
 * */
function Navgroup() {
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
	
	// }}}
	// {{{ function initEdit()
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){	
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.cate != undefined) {$("#cate").val(para.cate)}
			if (para.group_id != undefined) {$("#group_id").val(para.group_id)}
			if (para.id != undefined) {
				//有id，则是编辑
				self.cmd(gHttp,{controller:'Navgroup',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						$('#hurl').val(result1.data.url);
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);
							picflag = result1.data.flag;
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			}
			self.onloadCss();
			//初始化导航父级
			$("#apid").bindApid(para.cate, 'Navgroup', 'getByGroup');
			var str='';
			$("#apid").find("option").each(function(){													
				if($(this).text()==$("#pidname").val()){
					$(this).attr('selected','selected');
				}
				
			});
			var slectval=$("#apid").html();
			
			//初始化科室链接数据
			$("#htmlUrl").bindDepartment();
			
			$('#htmlUrl').change(function(){
				$('span[id^="child"]').hide();
				$('span[id^="child"]').html('');
				var sel = $(this).val();
				$('#childDiseaseDiv').empty();
				$('#hurl_link').val(window.location.origin+'/'+sel);
				$('#link_box').val(window.location.origin+'/'+sel);
				
				if(sel=='departments'){
					$('#hurl_link').val('');
					$('#link_box').val(sel);
					self.cmd(gHttp,{controller:'Navigation',method:'getHtmlUrlByPara',op:'departments'},function(result1){
						if(result1.statu){
							var isDisease = '';							
							isDisease = 'onChange="gNavgroup.setChildUrl(this);getDepartSubTree(this.value,\' \',\'hurl_link\',\'link_box\',\'childDiseaseDiv\')"';
							var str='<select class="select" name="childUrl" id="childUrl" '+isDisease+'>';
							str+='<option value="">&nbsp;请选择科室&nbsp;</option>';					
							for (var i=0;i<result1.data.length;i++){
								if(isDisease == ''){
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].url+'">'+result1.data[i].name+'</option>';
								}else{
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].id+'">'+result1.data[i].name+'</option>';
								}
							}
							str+="</select>";
							$('#childUrlDiv').html(str);
							$('#childUrlDiv').show();							
						}else{
							layer.alert(result1.msg);
						}
					
						return false;
					});
				}else if(sel == "channel"){
					self.cmd(gHttp,{controller:'Channel',method:'query'},function(result1){
						var str='<select class="select" name="channelList" onChange="setChannel(this.value)" id="channelList">';
						str += '<option value="">&nbsp;请选择&nbsp;</option>';
						for (var i=0;i<result1.rows.length;i++){
							str +='<option value="'+result1.rows[i].shortname+'">'+result1.rows[i].name+'</option>';
						}
						$('#childUrlDiv').show();
						$('#childUrlDiv').html(str);
						$('#hurl_link').val('');
						$('#link_box').val(sel);
					});
				}else{
					$('#childUrlDiv').hide();
					$('#childUrlDiv').html('');
				}
			});
			
			
			
			
			//hurl 改变时把值写入hurl_link
			$('input#hurl').change(function(){
				$('input#hurl_link').val($(this).val());								
			});
			
			//链接方式切换
			$('input[name="radio_link"]').click(function(){
				$(this).attr('checked',true);
				var value=$("#hurl_link").val();
				if($(this).val()==1){
					$("#hurl").val("");	
					if(value.indexOf('http')!=-1){
						$("#hurl").val(value);	
					}
				}
				else{
					$("#link_box").val(value);
				}
											
				$("#childUrlDiv").hide();
				$("#childUrlDiv").html('');
				$("#childDiseaseDiv").html('');
				$('#htmlUrl').val('');
				
				var id = $(this).attr('id');
				$("div[id^='div_link']").hide();
				$("#div_" + id).show();
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
    
	this.setChildUrl = function(obj) {
		if($.trim(obj.value)==''||obj.value=='undefined'){				
			$('#link_box').val('departments');
			$('#hurl_link').val('departments');			
			$('#childDiseaseDiv').hide();			
		}
		else{			
			var value=window.location.origin+'/'+$(obj).find('option:selected').attr('flag');
			$('#link_box').val(value);
			$('#hurl_link').val(value);
			}
		
	  
   }
	
	
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function() {
		//获取参数
		var para = self.parseUrl(window.location.href);
		if (para.group_id == undefined) {
			var data = {controller:'Navgroup',method:'queryGroup',is_group:1};
			var columns = [
				            {
				            	data : 'id',
				            	render : function (id, type, row) {
				            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
				            	}
				            },
                            { data: 'id' },
				            { data: 'subject' },
				            { data: 'flag'},
				            { data: 'is_display',render:function(value,type,row){return value=='1'?'<span class="label label-success radius">显示</span>':'<span class="label label-default radius">不显示</span>';}},
				            {
							  data : 'id',
							  render : function(id, type, row){
								  var str = '';
					              str += '<a style="text-decoration:none"  onClick="gNavgroup.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gNavgroup.detail('+id+');" href="javascript:;" title="查看详细"><i class="Hui-iconfont">&#xe681;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gNavgroup.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						    	  return str;
							  }
							 }
				        ];
			$("#dataTable").grid({
				para:data,
				aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
							],
				initSort : [[0, "asc"]],
				field : columns
			});
		} else {
			gGroupId = para.group_id;
			var data = {controller:'Navgroup',method:'getGroup',group_id:para.group_id};
			var columns = [
				            {
				            	data : 'id',
				            	render : function (id, type, row) {
				            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
				            	}
				            },
                            { data: 'id' },
				            { data: 'subject' },
				            { data: 'url'},
				            { data: 'pid',render:function(val){var str=val=='无'?'<span class="label label-default radius">无</span>':'<span class="label label-success radius">'+val+'</span>'; return str;}},
				            { data: 'sort'},
				            {
							  data : 'id',
							  render : function(id, type, row){
								  var str = '';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gNavgroup.infoedit('+id+', \'diynav-detail.html\');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gNavgroup.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						    	  return str;
							  }
							 }
				        ];
			$("#dataTable").grid({
				para:data,
				aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}
							],
				initSort : [[0, "asc"]],
				field : columns
			});
		}		
	}
	
	// }}}
	
	//去新增导航
	this.toAddNav = function() {
		self.openAdd('新增导航信息','diynav-detail.html?group_id=' + gGroupId,'740','560')
	}
	
	//单个删除
	this.del = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Navgroup',method:'delGroup',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Navgroup',method:'delGroup',id:ids});
		}		
	}

	//动态编辑
	this.edit = function(id){		
		var url = 'diy-nav.html';		
		self.openEditWID('编辑自定义导航组信息', url + '?id=' + id,'560','302');
	}
	this.infoedit = function(id,url){		
		self.openEditWID('编辑导航信息', url + '?id=' + id,'740','500');
	}
	//查看详细
	this.detail = function(id){
		self.openAdd('本导航组详细列表','diynav-list.html?group_id='+id);
	}
	
	// {{{ function save()
	
	/**
	 * 保存
	 * */
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Navgroup',method:'save'};
		} else {
			post = {controller:'Navgroup',method:'edit',id:id};
		}
		var obj=$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();
				
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').Validform().unignore('#link_box');
		$('#formEdit').Validform().unignore('#hurl');		
		var linkType = $("input[name='radio_link']:checked").val();
		if (linkType == '1') {
			obj.ignore('#link_box');
		} else {
			obj.ignore('#hurl');
		}		
		$('#formEdit').submit();
	}
	
	// }}}
}
