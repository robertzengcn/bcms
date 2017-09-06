/**
 * 用户管理
 * */
function User() {
	BaseFunc.call(this);
	var self = this;
	
	this.loginUser = '';
	
	// {{{ function initList()
	
	/**
	 * 初始化列表
	 * */
	this.initList = function() {
		$(function(){
			self.cmd(gHttp,{controller : 'Login',method : 'getLoginUserInfo'},function(res){
				if (res.statu) {
					this.loginUser = res.data.name;
				}
			});
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
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			//获取参数
			var para = self.parseUrl(window.location.href);
			
			
			if (para.id != undefined) {
				//有id，则是编辑
				$("#id").val(para.id);
				$("#pass").attr('name', 'pass_confirm');
				$("#div_acl").hide(); //修改只允许修改密码，故不显示
				$('input[type=password]').removeAttr('datatype');//编辑状态下允许密码为空
				
				self.cmd(gHttp,{controller:'Worker',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						$("#pwd").val('');
						self.getworkergroup(result1.data.group_id);
						if (result1.data.acls != ''&&result1.data.acls != null&&result1.data.acls != "{}") {
							$.each(result1.data.acls,function(m,v){
								$("input[value='"+m+"']").attr('checked',true);
								$.each(v,function(i,vv){
									$("input[value='"+vv+"']").attr('checked',true);
								});
							});
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			}		
			if(para.id == undefined||para.id ==""){
				self.getworkergroup();				
			}

			
			//保存
			$('#save').click(function(){
				if(para.id != undefined){//如果在编辑状态下密码为空，则不提交密码
					var pass=$('#pwd').val();
					if(pass==""){
						$('input[type=password]').removeAttr('name');
					}
				}
				self.save();
			});
			
			$('body').on('change','input[name="group_id"]',function(){				
				var value=$(this).val();
				$('#div_ac2').show();
				$('#div_ac2').find('input[type="checkbox"]').prop("checked",false);
				 
				self.cmd(gHttp,{controller:'Worker',method:'getworkergroup',id:value},function(res){
					
					if (res.data.acls != ''&&res.data.acls != null) {
						$.each(res.data.acls,function(m,v){
							$("input[value='"+m+"']").prop('checked',true);
							$.each(v,function(i,vv){
								$("input[value='"+vv+"']").prop('checked',true);
							});
						});
						
					}
				});
				

			});
			//返回
			$('#back').click(function(){
				layer_close();
			});
			//self.checkwebsite();
			
			
		});
	}
	
	// }}}
    // {{{ function getworkergroup()
	
	/**
	 * 加载worker group
	 * */
	this.getworkergroup=function(group_id, is_default){	
		self.cmd(gHttp,{controller:'Worker',method:'getgroups'},function(result1){//取用户组
			if(result1.rows.length>0){
				var str="";
				$.each(result1.rows,function(i,v){
					if(v.id==group_id){
						var valid='checked';
					}else{
						var valid="";
					}
					str+='<div class="radio-box"><input id="acl'+v.id+'" type="radio" name="group_id" value="'+v.id+'" '+valid+'/><label for="super_manage">'+v.name+'</label></div>';
				});
				$('#grouplist').html(str);
			}
		});
		
		if(is_default!=undefined&&is_default==true){
			self.cmd(gHttp,{controller:'Worker',method:'getworkergroup',id:group_id},function(res){
				if(res.statu){
					if (res.data.acls != ''&&res.data.acls != null&&res.data.acls != "{}") {//勾选单选框
						$.each(res.data.acls,function(m,v){
							$('#div_ac2').find("input[value='"+m+"']").attr('checked',true);
							$.each(v,function(i,vv){
								$('#div_ac2').find("input[value='"+vv+"']").attr('checked',true);
							});
						});
					}
				}
		    });
		}
		self.onloadthisCss();
	}
	
	/**
	 * 加载css
	 * */
	this.onloadthisCss = function() {
		$(".permission-list dt input:checkbox").click(function(){
			$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
		});
		$(".permission-list2 dd input:checkbox").click(function(){
			var l =$(this).parent().parent().find("input:checked").length;
			var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
			if($(this).prop("checked")){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
			}
			else{
				if(l==0){
					$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
				}
				if(l2==0){
					$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
				}
			}
			
		});
		$('.skin-minimal input').iCheck({
			checkboxClass: 'icheckbox-blue',
			radioClass: 'iradio-blue',
			increaseArea: '20%'
		});
	}
	
	// }}}
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function() {
		$("#dataTable").grid({
			para:{controller:'Worker',method:'query'},
			initSort : [[1, "asc"]],
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
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
			            { data: 'group_name'},
			            { data: 'plushtime' },
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" onClick="gUser.edit('+id+');" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              if(row.name != loginUser){
				            	  str += '<a style="text-decoration:none" class="ml-5" onClick="gUser.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
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
		self.openDel(obj,{controller:'Worker',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Worker',method:'del',id:ids});
	}

	//动态编辑
	this.edit = function(id){
		self.openEditWID('编辑用户', 'user_info.html?id=' + id,'800','460');
	}
	
	// {{{ function save()
	
	/**
	 * 保存
	 * */
	this.save = function(){
		var sname=$('#name').val();
		var sid=$('#id').val();
		if (sname == '') {
			parent.layer.msg('请填写用户名！',{icon:2});
			return false;
		}
		self.cmd(gHttp,{controller:'Worker',method:'query',name:sname},function(res){
			if(res.ttl!=0 && sid == '' ){
				parent.layer.msg('该用户名己被人使用，请更换用户名！',{icon:2});				
				}else if(res.ttl==1 && sname!=res.rows[0].name){
					parent.layer.msg('该用户名己被人使用，请更换用户名！',{icon:2});	
				}else{
					var post = {};
					var id = $("#id").val();
					if (id == '') {
						post = {controller:'Worker',method:'add'};
					} else {
						post = {controller:'Worker',method:'edit',id:id};
					}
					
					var group = $('input[name="group_id"]:checked').val();
					if (group == '') {
						layer.msg('请为该用户分配一个组');
						return false;
					}
					
					var acls = [];
					$('#div_ac2').find('input[type="checkbox"]:checked').each(function(){
						var key = $(this).parents(".permission-list").find("dt").first().find("input:checkbox").val();
						var value = $(this).val();
						if (acls[key] == undefined) {acls[key]=[];}
						if (key == value) {
							acls[key] = [];
						} else {
							var index = acls[key].length;
							acls[key][index] = value;
						}
					});
					
					if (acls.leng == 0) {
						layer.msg('请为该用户分配权限');
						return false;
					}
					
					//转化成json串
					var str = '';
					for(var i in acls) {
						str += '"'+i+'":[';
						var d = acls[i];
						for(var q in d){
							str += '"'+d[q]+'",';
						}
						str = str.substr(0,str.length-1);
						str += '],';
					}
					str = '{' + str.substr(0,str.length-1) + '}';			
					$('#acls').val(str);
					
					var formObj=$('#formEdit').checkAndSubmit('save',post,function(result1){
						if(result1.statu){
							if (id == '') {
								layer.msg('添加成功!',function(){
									window.parent.gUser.fillDataTable();
									layer_close();
								});
							} else {
								self.cmd(gHttp,{controller : 'Login',method : 'getLoginUserInfo'},function(res){
									if (res.statu) {
										var loginUser = res.data.name;
										if (loginUser == sname) {
											//只有修改当前登录用户才需要重新登录
											layer.msg('资料修改成功,请重新登录系统!',function(){
												self.cmd(gHttp,{controller:'Login',method:'logout'},function(ret){
													if(ret.code){
														top.window.location.href = '/hcc/login.html';
														layer_close();
													}
												});
											});
										} else {
											layer.msg('资料修改成功!',function(){
												window.parent.gUser.fillDataTable();
												layer_close();
											});
										}
									}
								});
								
							}
							
						}else{
							layer.alert(result1.msg);
						}
					});
					if(id == ''){//如果是新增
				
						if(!formObj.check('false','#name')||!formObj.check('false','#telephone')||!formObj.check('false','#nick_name')){			
							$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
						}else if(!formObj.check('false','#pwd')||!formObj.check('false','#pass')){
							$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");	
						}
					}else{//编辑
						if(!formObj.check('false','#name')||!formObj.check('false','#telephone')||!formObj.check('false','#nick_name')){			
							$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
						}
					}
	
					
					$('#formEdit').submit();
					
					}
		});
		
		
	}
	
	//检查网站是否已在总控注册
	this.checkwebsite=function(){
		self.cmd(gHttp,{controller:'BoyiManager',method:'checkwebsite'},function(res){
			if(res.stute){
				$('#boyilogin').hide();
			}else{
				$('#boyilogin').show();
				$('#goim').attr('disabled','true');
				
			}
		});
	}
	
	
	// }}}
	//初始化设置分组
	this.grouplist=function(){
		$(function(){
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			self.groupdatatable();
			self.onloadthisCss();
			self.addgroup();
		});		
	}
//添加管理组
this.addgroup=function(){
	var post = {controller:'Worker',method:'addworkergroup'};
	var formObj=$('#formEdit').checkAndSubmit('save',post,function(result1){
		if(result1.statu){
			self.groupdatatable();
			parent.gUser.refreshGroup();
			formObj.resetForm();
			layer.msg('添加成功',{icon:1});
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		}else{
			layer.alert(result1.msg,{icon:2});
		}	
	},function(obj){//表单提交前执行函数
		var acls = [];
		$('#div_ac').find('input[type="checkbox"]:checked').each(function(){
			var key = $(this).parents(".permission-list").find("dt").first().find("input:checkbox").val();
			var value = $(this).val();
			if (acls[key] == undefined) {acls[key]=[];}
			if (key == value) {
				acls[key] = [];
			} else {
				var index = acls[key].length;
				acls[key][index] = value;
			}
		});
		
		if (acls.leng == 0) {
			layer.msg('请为该组分配权限');
			return false;
		}
		
		//转化成json串
		var str = '';
		for(var i in acls) {
			str += '"'+i+'":[';
			var d = acls[i];
			for(var q in d){
				str += '"'+d[q]+'",';
			}
			str = str.substr(0,str.length-1);
			str += '],';
		}
		str = '{' + str.substr(0,str.length-1) + '}';			
		obj.find('input[name="acls"]').val(str);
		
	});
}

//刷新组
this.refreshGroup = function(){
	var group_id = $("input[name='group_id']:checked").val();
	self.getworkergroup(group_id, true);
}

//管理组表格初始化	
this.groupdatatable=function(){
	$(function(){
		$("#groupList").grid({
			para:{controller:'Worker',method:'getgroups'},
			//datatable插件里设置列   
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]}
							],	
			field : [                   
                        { data: 'id',
                        	render : function (id, type, row) {
		            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
		            	} },
                        { data: 'id' },
			            { data: 'name' },
			            { data: 'mark',render:function(value){return value.substr(0,20)+'...';}},
			            {
					      data : 'id',
						  render : function(id, type, row){
								  var str = '';
					              str += '<a style="text-decoration:none" onClick="gUser.editgroup('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont"></i></a>';
					              str += '<a style="text-decoration:none" onClick="gUser.deletegroup('+id+');" href="javascript:;" title="删除" id="search_download_'+id+'" class="ml-5"><i class="Hui-iconfont"></i></a>';
						    	  return str;
							  }
							 }
	
						
			        ]
		});
	});
}
//编辑用户组
this.editgroup=function(id){
	$(function(){
		if(!id){
			layer.msg('id为空',{icon:2});
			return false;
		}
		self.cmd(gHttp,{controller:'Worker',method:'getworkergroup',id:id},function(res){
			
			if(res.statu){
				var post= {controller:'Worker',method:'editworkergroup'};	
				var acl=$('#div_ac').html();
				var html='<div class="pd-5"><form action="" method="post" class="form form-horizontal" id="Edituser"><div class="row cl"><label class="form-label col-2"><span class="c-red">*</span>组名称：</label><div class="formControls col-7"><input type="text" class="input-text" value="'+res.data.name+'" placeholder="" id="editname" name="name" datatype="*2-16" nullmsg="组名称不能为空" errormsg="限2-16个字" ></div><div class="col-3"></div></div><div class="row cl"><label class="form-label col-2">备注：</label><div class="formControls col-7"><textarea name="mark" id="editmark" cols="" rows="" class="textarea"  placeholder="请输入备注内容..."  dragonfly="true" onKeyUp="textarealength(this,200)">'+res.data.mark+'</textarea><p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p></div></div><input type="hidden" name="id" value="'+id+'"/><div id="div_ac'+id+'">'+acl+'</div><input type="hidden" name="acls"/><div class="row cl ps-b-5 pd-5 bg-1 bk-gray"><button id="edititem" class="btn btn-primary radius bt-normal" type="button"><i class="Hui-iconfont">&#xe632;</i> 修改</button></div></form></div>';
				  layer.open({
					    type: 1,
					    content: html,
					    btn: ['确定', '取消'],
					    success: function(layero, index){
					    	self.onloadthisCss();
							if (res.data.acls != ''&&res.data.acls != null&&res.data.acls != "{}") {//勾选单选框
								
								$.each(res.data.acls,function(m,v){
									
									$('#div_ac'+id).find("input[value='"+m+"']").attr('checked',true);
									$.each(v,function(i,vv){
										$('#div_ac'+id).find("input[value='"+vv+"']").attr('checked',true);
									});
								});
							}
					    	var editform=$('#Edituser').checkAndSubmit('edititem',post,function(result1){
					    		if(result1.statu){
					    			layer.close(index);
					    			self.groupdatatable();
					    		}else{
					    			layer.alert(result1.msg);
					    		}	
					    	},function(obj){//表单提交前执行函数
					    		var acls = [];
					    		$('#div_ac' + id).find('input[type="checkbox"]:checked').each(function(){
									var key = $(this).parents(".permission-list").find("dt").first().find("input:checkbox").val();
									var value = $(this).val();
									if (acls[key] == undefined) {acls[key]=[];}
									if (key == value) {
										acls[key] = [];
									} else {
										var index = acls[key].length;
										acls[key][index] = value;
									}
								});
								
								if (acls.leng == 0) {
									layer.msg('请为该组分配权限',{icon:1});
									return false;
								}
								
								//转化成json串
								var str = '';
								for(var i in acls) {
									str += '"'+i+'":[';
									var d = acls[i];
									for(var q in d){
										str += '"'+d[q]+'",';
									}
									str = str.substr(0,str.length-1);
									str += '],';
								}
								str = '{' + str.substr(0,str.length-1) + '}';			
								obj.find('input[name="acls"]').val(str);
					    		
					    	});    
					    	  }
					  });
				
			}else{
				layer.alert(res.msg);	

			}
	});
		
	});	
}
//删除用户组
this.deletegroup=function(id){
	$(function(){
		if(!id){
			layer.msg('id为空',{icon:2});
			return false;
		}else if(id==1){
			layer.msg('不能删除超级管理员分组！',{icon:2});
			return false;
		}
		self.cmd(gHttp,{controller:'Worker',method:'deleteworkergroup',id:id},function(res){
			if(res.statu){				
				self.groupdatatable();
			}else{
				layer.alert(res.msg);	
			}
		});
	});	
}
//批量删除用户组
this.delBatchworkergroup=function(){
	var ids = $("#groupList").getSelectedAll();	
	if(ids.length<=0){
		layer.msg('请选择要删除的项目',{icon:2});
	}else if($.inArray("1", ids)!=-1){
		layer.msg('不能删除超级管理员分组！',{icon:2});
	}else{		
		var obj=$("#groupList").dataTable();
		self.openDel(obj,{controller:'Worker',method:'deleteworkergroup',id:ids});
	}
	
}


}
