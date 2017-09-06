﻿/**
 * 敏感词汇设置
 * */
function Words() {
	BaseFunc.call(this);
	var self = this;
	//var words = {"words":/^[a-zA-Z]{2,50}$/};
	//console.log($.fn);
	
	/**
	 * 初始化编辑
	 * */
	
	this.initEdit=function(){
		$(function(){
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");			
			self.fillGroupList();
			self.fillGroupUsers();
			self.initContent();	
			$('.tabBar span').click(function(){
				var index = $(this).index();
				if (index == 1) {
					$("#id, #groupSelect").val('');
					$("#formEdit input[type='text']").val('');
				}
				
				switch(index) {
					case 0:
						self.fillGroupList();
						self.fillGroupUsers();
						break;
					case 1:
						self.getGroupListTable();
						break;
					case 2:
						self.initGroups();
						break;
					case 3:
						self.bindModule();
						break;
					default:
						break;
			    }
			});
		})
		
	}
	
	//填充组列表
	this.fillGroupList = function(){
		self.cmd(gHttp,{controller:'SensitiveWords',method:'getGroups'},function(ret){
			if (ret.statu) {
				var data = ret.data;
				var html = '<li flag="all"><span class="label label-secondary radius">全部</span></li>';
				$.each(data,function(i,v) {
					html += '<li flag="'+v.id+'"><span class="label label-success radius">'+v.name+'</span></li>';						
				});
				$("#groupList").html(html);
			}
		});
		
		$("#groupList li").click(function(){
			var groupid = $(this).attr('flag');
			$('input#groupchoise').val(groupid);
			var groupname = $(this).text();
			$("#groupList li span").removeClass("label-secondary");
			$("#groupList li span").addClass("label-success");
			$(this).html('<span class="label label-secondary radius">'+groupname+'</span>');
			$('#personList > li').remove();
			self.fillGroupUsers(groupid,groupname);
		});
	}
	
	//选择组的词汇
	this.fillGroupUsers = function(groupid,groupname) {
		self.cmd(gHttp,{controller:'SensitiveWords',method:'getGroupWords',group_id:groupid,groupname:groupname},function(ret){
			if (ret.statu) {
				var data = ret.data.info;
				var html = '';
					$.each(data,function(i,v) {
						html += '<li pid="'+v.id+'" pname="'+data[i]+'" onmouseover="gWords.showbt(this);" onmouseout="gWords.hidebt(this);">'+data[i];
						html += '<span class="r" style="padding:0px 10px;"><a href="javascript:;" style="text-decoration:none;" onclick="gWords.removeTotally(this,\''+data[i]+'\')"><i class="Hui-iconfont">&#xe60b;</i></a></span>';
						html += '</li>';
					});
					$("#selectList").html(html);					
				
			}
		});
	}
	
	//初始化分组
	this.initGroups = function(){
		$(function(){
			//self.fillGroups();
			
			$("#savegroup").click(function(){
				self.saveGroup();
			});
		})
	}
	//初始化内容
	this.initContent = function(){
		$(function(){
			self.clearContent();		
			$("#save").click(function(){
				if($('#groupchoise').val()=='all'){
					layer.confirm('您当前选择的词汇分组是全部，为了便于词汇组后期维护，建议您为该组词汇选择一个分类，如果不需要分类，请点击确认', {icon: 1, title:'提醒'}, function(index){
					  //do something
					  self.saveWords();
					  layer.close(index);
					});					
				}else{
					self.saveWords();
				}
				
			});
		})		
	}
	
	this.queryKeyWords = function(){
		var value=$('#keyword').val();
		if($.trim(value)==''){
			layer.msg('请输入关键词！',{icon:2});
		}else{
			self.getKeywordByName(value);					
		}		
	}
	//根据关键词查询
	this.getKeywordByName=function(v){
		self.cmd(gHttp,{controller:'SensitiveWords',method:'getWordsByName',keyword:v},function(ret){
			if (ret.statu) {
				var data = ret.data.info;
				var html = '';
					$.each(data,function(i,v) {
						html += '<li pid="'+v.id+'" pname="'+data[i]+'" onmouseover="gWords.showbt(this);" name="'+data[i]+'" onmouseout="gWords.hidebt(this);">'+data[i];
						html += '<span class="r" style="padding:0px 10px;"><a href="javascript:;" style="text-decoration:none;" onclick="gWords.removeTotally(this,\''+data[i]+'\')"><i class="Hui-iconfont">&#xe60b;</i></a></span>';
						html += '</li>';
					});
					$("#selectList").html(html);
			}else{
				layer.msg(ret.msg,{icon:2});
			}
			
		});
	}
	//清空添加内容
	this.clearContent = function(){
		$('#textarea').html('<textarea nullmsg="内容不能为空！" placeholder="请将要导入的词汇复制进来，各词汇间用逗号或顿号或换行或空格隔开。支持将整理成EXCEL表格的词汇以纵列的方式复制进来" style="width:99%;height:300px;" id="content" name="content" datatype="*1-9000"></textarea><p class="textarea-numberbar">各词汇间用：逗号/顿号/换行/空格分隔开，支持EXCEL单纵列复制导入</p>');
	}
    // {{{ function saveWords()
	
	/**
	 * 保存词汇与分组
	 * */
	this.saveWords = function(){
		var content=$('#content').val();
		var gname = $('.label-secondary').text();
		self.cmd(gHttp,{controller:'SensitiveWords',method:'isExistsGrorps'},function(res){	
			if(!res.statu){
				parent.layer.msg(res.msg,{icon:2});
				self.initGroups();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","2");
				//var event = evt ? evt : window.event;
				//event.stopPropagation();
				return ;
			}else{
			if(content==""){
				parent.layer.msg('请填写要增加的词汇!',{icon:2}); 
				return ;
			}
			if(gname=='' || gname=='全部'){
				parent.layer.msg('请选择分组!',{icon:2});
				return ;			
			}
			var groupid = $('.label-secondary').parent().attr('flag');
			self.cmd(gHttp,{controller:'SensitiveWords',method:'queryWords',words:content},function(res){
				if(!res.statu){
					parent.layer.msg(res.msg,{icon:2});
					return ;
				}else{
					self.cmd(gHttp,{controller:'SensitiveWords',method:'addWords',words:content,groupid:groupid,gname:gname},function(result1){
						if(result1.statu){
							layer.msg(result1.msg,{icon:1});
							self.fillGroupUsers(result1.data.groupid,result1.data.gname);
						}else{
							layer.msg(result1.msg,{icon:2});
							return ;
						}
					});	
				}
			});
			window.location.href = window.location.href;
			}
		});
	}
		
	//选取移除词汇列表
	this.selectThis=function(obj){
		var bt_str='<span class="r" style="padding:0px 10px;"><a href="javascript:;" style="text-decoration:none;" onclick="gWords.removeTotally(this,\''+$(obj).html()+'\')"><i class="Hui-iconfont">&#xe60b;</i></a></span>';
		$('.selectList').append('<li pid="'+$(obj).attr('pid')+'" pname="'+$(obj).html()+'" onmouseover="gWords.showbt(this);" onmouseout="gWords.hidebt(this);">'+$(obj).html()+bt_str+'</li>');
		$(obj).remove();	
		
	}
	
	//保存到记录界面
	this.saveRelationship=function(){
		var listNum=$('ul.selectList').find('li').length;
		if(listNum==0){
			layer.alert('请选择要增加的词汇组',{icon:2});
			return false;
		}else{
			var str='';
			$('ul.selectList li').each(function(){
				str+='<div class="check-box col-2" style="overflow:hidden;height:25px;line-height:25px;" info="'+$(this).attr('pname')+'"><input type="checkbox" id="pid_items_' + $(this).attr('pid') + '" name="examine_items[]" value="' + $(this).attr('pid') + '" checked/><label>' + $(this).attr('pname') + '</label></div>';
				
			});	
			var groupid = $('.label-secondary').parent().attr('flag');
				groupid = (groupid !='undefined') ? groupid : '';
			var content =  $('#selectList').text();
			var groupname = $('.label-secondary').text();
		self.cmd(gHttp,{controller:'SensitiveWords',method:'save',content:content,gid:groupid,groupname:groupname},function(ret){
			if (ret.status == 1) {
				parent.layer.msg(ret.msg,{icon:1});
			}else{
				parent.layer.msg(ret.msg,{icon:2});				
			}
		});
			
		}
		
		
	}
	
	
	//分组选项切换
	this.changeGroup=function(value){
		switch(value){
			case '+':self.addNewGroup();break;
		}
		
	}
	
	this.showbt=function(obj){		
		$(obj).find('span').show();
		
	}
	
	this.hidebt=function(obj){		
		$(obj).find('span').hide();
	}

	//移除词汇
	this.removeTotally=function(obj,str){
		var liObj=$(obj).parent().parent();		
		$(liObj).remove();
		self.cmd(gHttp,{controller:'SensitiveWords',method:'removeTotally',content:str},function(ret){
			if (ret.status) {
				parent.layer.msg(ret.msg,{icon:1});
			}else{
				parent.layer.msg(ret.msg,{icon:2});				
			}
		});
		
	}
	//新增分组
	this.addNewGroup=function(){		
		var selectstr=$('#groupBox').html();
		$('#groupBoxVal').val(selectstr);
		var inputstr='<label class="form-label col-2"><span class="c-red">*</span>分组：</label><div class="formControls col-4">';
		inputstr+='<span class="cancel"><a href="javascript:;" id="cancel" title="取消添加分组" style="text-decoration:none;" onclick="gWords.removeinput(this)"><i class="Hui-iconfont">&#xe66b;</i></a></span>';
	    inputstr+='<input type="text" class="input-text" value="" placeholder="" id="groupname" name="groupname" datatype="*2-16" nullmsg="分组名称不能为空" errormsg="限2-16个字" >';
		inputstr+='</div><div class="col-2"></div>';
		$('#groupBox').html(inputstr);	
		

	}

	//取消添加分组
	this.removeinput=function(obj,currentGroup){
		var str=$('#groupBoxVal').val();
		$('#groupBox').html(str);		
		self.fillGroups(currentGroup);
	}
	
	//填充selectGroup
	this.fillGroups = function(currentGroup) {
		self.cmd(gHttp,{controller:'SensitiveWords',method:'getGroups'},function(ret){
			if (ret.statu) {
				var data = ret.data;
				var html = '<option value="">请选择</option>';
				$.each(data,function(i,v) {
					var selected = '';
					if (currentGroup != undefined && currentGroup == v.id) {
						selected = 'selected';
					}
					html += '<option value="'+v.id+'" '+selected+'>' + v.name + '</option>';
				});
				html += '<option value="+">+新增分组</option>';
				$("#groupSelect").html(html);
			}
		});
	}
	

		/**
	 * 初始化会员修改
	 * */
	this.edit = function(id) {
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","2");
		$.each(gWords[id],function(i,v){
			$("#" + i).val(v);
		});
		$('#oldgname').val($('#group_name').val());
	}
	/**
	 * 词组管理
	 * */
	this.getGroupListTable = function(){
		$('#levelList').grid({
			para :  {controller:'SensitiveWords',method:'groupList',isPage:1},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}
							],
			field : [{data : 'id',render : function (id, type, row) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'group_name'},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'addtime'},
				     {data:'number'},
				     {data:'id',render : function(id, type, row){
				    	 gWords[id] = row;
				    	 return '<a style="text-decoration:none" class="ml-5" onClick="gWords.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					}
				}
			]
		});
		$('#savegroup').click(function(){
			self.saveGroup();
		});
	}	
	
	/**
	 * 添加编辑词组
	 * */
	this.saveGroup = function(){
		var id = $('#id').val();
    	var url = {controller:'SensitiveWords',method:'addGroup'};
    	if (id != '') {
			var url = {controller:'SensitiveWords',method:'editGroup',id:id};
		}
		$('#formAdd').checkAndSubmit('savegroup', url,function(result1){
			if(result1.statu){
				layer.msg(result1.msg,{icon:1});
				self.fillGroupList();
				self.fillGroupUsers();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formAdd').submit();
	}

	/**
	 * 删除词组
	 * */
	this.delGroups = function() {
		var groupsName = $("#levelList").getSelectedAllName();
		if(groupsName==''){
			layer.msg('请选择要删除的项目',{icon:2});
		}else{
				var obj = $("#levelList").dataTable();
				layer.confirm('确认要删除吗？删除该分类会同时删除该分类下所添加的词汇表！',function(index){
					self.cmd(gHttp,{controller:'SensitiveWords',method:'delGroups',groupsName:groupsName},function(ret){
						layer.close(index);
						if(ret.statu){
							self.getGroupListTable();
							parent.layer.msg('删除成功!',{icon:1});
						}else{
							layer.alert('删除失败!',{icon:2});
							layer_close();
						}
						return false;
					})
				});
				
			}
	}
	/**
	 * 过滤模块-checkbox
	 * */
	this.bindModule = function() {
		self.cmd(gHttp,{controller:'SensitiveWords',method:'getAllModule'},function(ret){
			if(ret.statu){
				var position='';
				$.each(ret.data.re,function(i,obj){
					position += '<div class="check-box">';
					position += '<input type="checkbox" '+obj.status+' id="checkbox-moban'+obj.id+'" name="moduleposition['+i+']" value="'+obj.id+'">';
					position += '<label class="btn btn-primary radius mgl-18" style="margin-bottom:10px;" for="checkbox-moban'+obj.id+'"><i class="Hui-iconfont">&#xe603;</i>'+obj.name+'</label>';					
				    position += '</div>';
				});
				$('#moduleposition').html(position);	
			}
		});
		self.onloadIcheckboxCss();
		$("#savemodule").click(function(){
			self.saveModule();
		});
	}
	/*单选、复选框特效*/
	this.onloadIcheckboxCss = function() {
		$('.skin-minimal input').iCheck({
			checkboxClass: 'icheckbox-blue',
			radioClass: 'iradio-blue',
			increaseArea: '20%'
		});			
	}
	//保存模块
	this.saveModule=function(){
		var posturl = {controller:'SensitiveWords',method:'saveModule'};
		$('#formSave').checkAndSubmit('savemodule',posturl,function(ret){
			if (ret.statu) {
				parent.layer.msg(ret.msg,{icon:1});
			}else{
				parent.layer.msg(ret.msg,{icon:2});				
			}
		});
		$('#formSave').submit();		
	}
	//初始化模块
	this.initialModule=function(){
		self.cmd(gHttp,{controller:'SensitiveWords',method:'initialModule'},function(ret){
			if (ret.statu) {
				self.bindModule();	
				parent.layer.msg(ret.msg,{icon:1});
			}else{
				parent.layer.msg(ret.msg,{icon:2});				
			}
		});		
	}
}


    /**
     * 获取所有选中项名称
     * */
    $.fn.getSelectedAllName = function(returnStr) {
    	var data = '';
		var tbodyObj = $(this).find('tbody');
		tbodyObj.find('input[type="checkbox"]:checked').each(function(){
			if ($(this).val() != '') {
				data += $(this).parent().next().next().text() + ',';
			}
		});
		if (data != '') {
			var len = data.length;
			data = data.substr(0,len-1);
		}
		if (data != '' && returnStr == undefined) {
			data = data.split(',');
		}
		return data;
  }