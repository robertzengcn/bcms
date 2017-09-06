﻿function gClients() {
	BaseFunc.call(this);
	var self = this;
	
	this.init=function(){
		$(function(){
			//数据填充
			self.fillDepartments();
			self.fillSource();
			self.fillReceptionist();
			
			//科室的变化
			$('#department_id').change(function(){
				var val=$(this).val();
				self.changeDepartment(val);
			});
			
			self.fillDataTable();
			
			$("#qry").click(function(){self.fillDataTable();});
			
			self.onloadCss();
			
			self.cmd(gHttp,{controller:'Client',method:'getReceptionist'},function(res){
				if(res.statu){
					var receptionist = res.data;
					var recHtml = '<option value="" selected>请选择</option>';
					if ( receptionist!= null) {
						$.each(receptionist,function(i,v) {
							recHtml += '<option value="' + v.id + '">' + v.user_name + '</option>';
						});
					}
					$("#reception_id").html(recHtml);
				}
			});
			
			
		});
		
	}
	
	this.fillDepartments = function() {
		self.cmd(gHttp,{controller:'ResDepartment',method:'getDepartments'},function(ret){
			if(ret.statu){
				var str='<option value="">请选择</option>';
				if ( ret.data!= null) {
					var selected='';
					$.each(ret.data, function(i,obj) {
						str +='<option value="'+obj.id+'" '+selected+'>'+obj.name+'</option>';
					});
				}
				$("#department_id").html(str);
			}else{
				layer.alert(ret.msg);
			}
		});
	}
	
	//加载数据表
	this.fillDataTable = function() {
		$("#dataTable").grid({
			para:{controller:'Client',method:'query'},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]},{sClass:'text-c',aTargets:[7]},{sClass:'text-c',aTargets:[8]},{sClass:'text-c',aTargets:[9]},{sClass:'text-c',aTargets:[11]}
							
				],
			initSort:[0, 'desc'],			
			field : [
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },                        
			            { data: 'username' },
			            { data: 'telephone' },
			            { data: 'gender',render:function(value){return value=='0'?'男':'女';}},
			            { data: 'source_name' },
						{ data: 'reception_name' },
			            { data: 'date' },
						{ data: 'department_name' },
						{ data: 'doctor_name' },
			            { data: 'statu',render:function(value){
							if(value=='已到诊'){
								return '<span class="label label-success radius">'+value+'</span>';
							}else if(value==''||value==null){
								return '<span class="label label-default radius">未预约</span>';
							}else if(value=='一定到诊'){
								return '<span class="label label-warning radius">'+value+'</span>';
							}else{
								return '<span class="label label-default radius">'+value+'</span>';
							}			            	
			            }},
						{ data: 'mark',render:function(value){return value.substr(0,30)+'...';}},
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';							  
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gClients.editClient('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gClients.delClient('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
					    	  return str;
						  },orderable:false
						 }
			        ]
				
		});		
	}
	
	//编辑咨询记录
	this.editClient = function(id){
		self.openEditWID('编辑客服记录','add-newclient.html?id=' + id,'800','480');		
	}
	
	//单个删除预约咨询
	this.delClient = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Client',method:'del',id:id});
	}

	//批量删除预约咨询
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Client',method:'del',id:ids});
	}
	
	//新增咨询记录
	this.addClients=function(){
		self.openEditWID('添加客服记录','add-newclient.html','800','480');		
	}
	
	
	
	
	this.editorclient=function(){
		$(function(){
			//数据填充
			self.fillDepartments();
			self.fillSource();
			self.fillReceptionist();
			//默认咨询日期
			$("#recordtime1").val(self.getNowFormatDate());
			//科室的变化
			$('#department_id').change(function(){
				var val=$(this).val();
				self.changeDepartment(val);
			});
			
			//监听医生事件
			$("#doctor_id").change(function(){
				self.getReservation();
			});
			
			//监听预约事件
			$("#appointment").change(function(){
				var atime = $(this).val();
				var resertime = $(this).find('option:selected').text();
				$('#restime').val(resertime);
				$("#time").val(atime);
				var flag = $(this).find('option:selected').attr("flag");
				$("#code").val(flag);
			});
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			var id = para.id;
			if (id != undefined) {
				self.onloadinfomations(id);
				self.getclientwork(id);
			}else{
				self.getclientwork();
				self.cmd(gHttp,{controller:'Worker',method:'getcurrentworker'},function(res){
					if(res.statu){
						$(".receptionlist").val(res.data);
					}
				});
			}
			$('#age').keyup(function(){								 
				var age = $('#age').val();
				var birthday = self.getBirthdayFromAge(age);
				$('#birthday').val(birthday);
			});

			$('#addnews').click(function(){			
				self.addnews();						
			});
			
			$('#deletlast').click(function(){			
				self.deletlast();						
			});

			self.onloadCss();
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		});
	}
	
	//获取当前日期时间“yyyy-MM-dd”
	this.getNowFormatDate = function() {
		var date = new Date();
		var seperator1 = "-";
		var month = date.getMonth() + 1;
		var strDate = date.getDate();
		if (month >= 1 && month <= 9) {
			month = "0" + month;
		}
		if (strDate >= 0 && strDate <= 9) {
			strDate = "0" + strDate;
		}
		var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate;
		return currentdate;
	} 
	//获取用户关注人
	this.getclientwork=function(client_id){
		if(client_id!=undefined){
			self.cmd(gHttp,{controller:'Client',method:'getclientworker',client_id:client_id},function(ret){
				var str="";
				if (ret.statu) {
					$.each(ret.data,function(i,v){
						str+='<div class="check-box col-2" style="overflow:hidden;height:25px;line-height:25px;" info=""><input type="checkbox" id="pid_items_" name="focus_id[]" value="'+v.id+'" checked/><label>'+v.name+'</label></div>';
					});
					$('#relation_ship').html(str);
				}
			});	
		}else{
			self.cmd(gHttp,{controller:'Client',method:'getclientworker'},function(ret){
				var str="";
				if (ret.statu) {
					$.each(ret.data,function(i,v){
						str+='<div class="check-box col-2" style="overflow:hidden;height:25px;line-height:25px;" info=""><input type="checkbox" id="pid_items_" name="focus_id[]" value="'+v.id+'" checked/><label>'+v.name+'</label></div>';
					});	
					$('#relation_ship').html(str);
				}
			});	
		}

		
	}


	this.addnews=function(){
		var i=$(".sourceform").length;
		var dtd = $.Deferred();
		var wait=function(dtd){
		var str='';		
		str+='<div class="sourceform">';
		str+='<div class="row cl receptions"><label class="form-label col-2">咨询日期：</label><div class="formControls col-2 skin-minimal">';
		str+='<input type="text" maxlength="3" onFocus="WdatePicker({skin:\'whyGreen\'});" name="record['+i+'][recordtime]" id="recordtime'+i+'" class="input-text Wdate baseinfo" style="width:120px;" /></div><div class="col-85"></div>';
		str+='<label class="form-label col-85">本次客服：</label><div class="formControls col-2"> <span class="select-box" style="width:120px;">';
		str+='<select class="select baseinfo receptionlist" name="record['+i+'][reception_id]" flag="'+i+'" plugin="jqtransform" datatype="*"  nullmsg="客服不能为空"></select></span> </div>';
		str+='<div class="col-2"></div></div>';						
		str+='<div class="row cl news"><label class="form-label col-2">客服记录：</label><div class="formControls col-10">';
		str+='<textarea nullmsg="客服记录不能为空！" style="width:100%;height:200px;" id="editor'+i+'" name="record['+i+'][content]" datatype="*" class="ueditclass"></textarea></div><div class="col-2"></div></div>';
		str+='</div>';
		$('div.sourceform:last').after(str);
		dtd.resolve();
		　return dtd.promise();
		}
		$.when(wait(dtd)).done(function(){
		
		UE.getEditor($('textarea:last').attr('id'),{
			toolbars: [
			[   
				'source', //源代码
				'|',
				'undo', //撤销
				'redo', //重做  
				'cleardoc', //清空文档 
				'removeformat', //清除格式
				'searchreplace', //查询替换
				'|',
				'time', //时间
				'date', //日期 
				'spechars', //特殊字符		
				'|', 
				'simpleupload', //单图上传  
				'snapscreen', //截图 
				'insertimage', //多图上传		
				'|',           
				'justifyleft', //居左对齐
				'justifyright', //居右对齐
				'justifycenter', //居中对齐
				'justifyjustify', //两端对齐 
				'autotypeset', //自动排版
				'|',					
				'fullscreen', //全屏  
			]
			]
		});
		});
		self.fillReceptionist();
		$('#deletlast').show();
	}	

	this.deletlast=function(){
		var num=$('div.news').length;
		if($('div.news').length==2){
			$('div.receptions:last').remove();
			$('div.news:last').remove();
			$('#deletlast').hide();
		}else if($('div.news').length>2){
			$('div.receptions:last').remove();
			$('div.news:last').remove();
		}
	}
	
	this.editorGroup=function(){
		$(function(){
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");	
			
			self.fillGroupList();
			self.fillGroupUsers();

			$('.tabBar span').click(function(){
				var index = $(this).index();
				if (index == 1) {
					$("#id, #groupSelect").val('');
					$("#formEdit input[type='text']").val('');
					$("#formEdit input[type='password']").val('');
				}
				
				switch(index) {
					case 0:
						self.fillGroupList();
						self.fillGroupUsers();
						break;
					case 1:
						self.initUser();
						break;
					default:
						break;
			    }
			});
		})
		
	}
	
	//填充组列表
	this.fillGroupList = function(){
		self.cmd(gHttp,{controller:'Worker',method:'getgroups'},function(ret){
			
				var html="";
				var vhtml="";
				$.each(ret.rows,function(i,v) {
					html += '<li flag="'+v.id+'"><span class="label label-success radius">'+v.name+'</span></li>';
				if(v.id!=1){
					vhtml+='<option value="'+v.id+'">'+v.name+'</option>';
				}
				});
				$('#groupSelect').html(vhtml);
				$("#groupList").html(html);
				//取acls
				var groupid=$('#groupSelect').val();
				self.cmd(gHttp,{controller:'Worker',method:'getworkergroup',id:groupid,stracl:1},function(ret){
	                if(ret.statu){
	                	$('#acls').val(ret.data.acls);
	                }	
				});

			
		});
		
		$("#groupList li").click(function(){
			var groupid = $(this).attr('flag');
			self.fillGroupUsers(groupid);
		});
	}
	
	//填充选择人
	this.fillGroupUsers = function(groupid) {
		if(groupid!=undefined){
			var param={controller:'Worker',method:'query',group_id:groupid};
		}else{
			var param={controller:'Worker',method:'query'};
		}
		self.cmd(gHttp,param,function(ret){			
				var html = '';
				$.each(ret.rows,function(i,v) {
					if ($("#s_"+v.id).length<1) {
						//只加载尚未被选中的用户
						html += '<li onClick="gClients.selectThis(this);" pid="'+v.id+'" id="p_'+v.id+'"><span class="label label-success radius">'+v.nick_name+'</span></li>';
					}
				});
				$("#personList").html(html);
			//}
		});
	}
	
	//初始化人员信息
	this.initUser = function(){
		$(function(){			
			self.saveUser();
			$("#save").click(function(){
				$('#formEdit').submit();
			});
			$('body').on('click','#groupSelect',function(){
				var groupid=$(this).val();
				self.cmd(gHttp,{controller:'Worker',method:'getworkergroup',id:groupid},function(ret){
                if(ret.statu){
                	$('acls').val(ret.data.acls);
                }			
			});
			});
		})
	}
	
    // {{{ function saveUser()
	
	/**
	 * 保存
	 * */
	this.saveUser = function(){
		var sname=$('#name').val();
		$('#formEdit').checkAndSubmit('save',{controller:'Worker',method:'add'},function(result1){
			if(result1.statu){
				layer.msg('添加成功!',function(){
					$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");	
					
					self.fillGroupList();
				});
			}else{
				layer.alert(result1.msg);
			}
		});

	}
	
	//选取关注人列表
	this.selectThis=function(obj){
		var pname = $(obj).text();
		var pid = $(obj).attr('pid');
		
		var html = '<li pid="'+pid+'" pname="'+pname+'" onmouseover="gClients.showbt(this);" onmouseout="gClients.hidebt(this);" id="s_'+pid+'">';
		html += '<span class="label label-success radius">'+pname+'</span>';
		html += '<span class="r" style="padding:0px 10px;">';
		html += '<a href="javascript:;" style="text-decoration:none;" onclick="gClients.removeli(this)"><i class="Hui-iconfont">&#xe60b;</i></a>';
		html += '</span>';
		html += '</li>';
		$('.selectList').append(html);
		$(obj).remove();	
		
	}
	
	//保存相关干系人到记录界面
	this.saveRelationship=function(){
		var listNum=$('ul.selectList').find('li').length;		
		if(listNum==0){
			layer.alert('请最少选取一个传阅人',{icon:2});
			return false;
		}
		else{
			var str='';
			$('ul.selectList li').each(function(){
				str+='<div class="check-box col-2" style="overflow:hidden;height:25px;line-height:25px;" info="'+$(this).attr('pname')+'"><input type="checkbox" id="pid_items_' + $(this).attr('pid') + '" name="focus_id[]" value="' + $(this).attr('pid') + '" checked/><label>' + $(this).attr('pname') + '</label></div>';
				
			});			
			$(window.parent.document).find("#relation_ship").html(str);	
			parent.gClients.onloadCss();			
			var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
			parent.layer.close(index); 
			
		}
		
		
	}
	
	
	//分组选项切换
	this.changeGroup=function(value){
		switch(value){
			case '0':self.addNewGroup();break;
		}
		
	}
	
	this.showbt=function(obj){		
		$(obj).find('span.r').show();
		
	}
	
	this.hidebt=function(obj){		
		$(obj).find('span.r').hide();
	}

	this.removeli=function(obj){
		var liObj=$(obj).parent().parent();
		var pid = liObj.attr('pid');
		var pname = liObj.attr('pname');
		$('.personList').append('<li pid="'+pid+'" onclick="gClients.selectThis(this);" id="p_'+pid+'"><span class="label label-success radius">'+pname+'</span></li>');
		$(liObj).remove();
		
	}

	//新增分组
	this.addNewGroup=function(){		
		var selectstr=$('#groupBox').html();
		$('#groupBoxVal').val(selectstr);
		var inputstr='<label class="form-label col-2">分组：</label><div class="formControls col-4">';
		inputstr+='<span class="cancel"><a href="javascript:;" id="cancel" title="取消添加分组" style="text-decoration:none;" onclick="gClients.removeinput(this)"><i class="Hui-iconfont">&#xe66b;</i></a></span>';
	    inputstr+='<input type="text" class="input-text" value="" placeholder="" id="groupname" name="groupname" datatype="*2-16" nullmsg="分组名称不能为空" errormsg="限2-16个字" >';
		inputstr+='</div><div class="col-2"></div>';
		$('#groupBox').html(inputstr);	
		
		$("#groupname").blur(function(){
			var val = $("#groupname").val();
			if (val != '') {
				self.cmd(gHttp,{controller:'Client',method:'saveGroup',name:val},function(ret){
					if (ret.statu) {
						layer.msg("添加" + val + "成功");
						self.removeinput($("#cancel"),ret.data);
					}
				});
			}
		});
	}

	//取消添加分组
	this.removeinput=function(obj,currentGroup){
		var str=$('#groupBoxVal').val();
		$('#groupBox').html(str);
		
		self.fillGroups(currentGroup);
	}
	
	//填充selectGroup
	this.fillGroups = function(currentGroup) {
		self.cmd(gHttp,{controller:'Client',method:'getGroups'},function(ret){
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
				html += '<option value="0">+新增分组</option>';
				$("#groupSelect").html(html);
			}
		});
	}

	
	//保存基础信息及客服记录
	this.saveClient=function(){			
		var url = {controller:'Client',method:'save'};		
		if ($("#id").val() != ''&&$("#id").val() != 'undefined') {
			url = {controller:'Client',method:'update'};
		}		
		formObj=$('#baseinfomation').checkAndSubmit('save',url,function(result1){
			if(result1.statu){				
				var data=result1.data;				
				//将更新成功后的ID写入
				if($("#client_ID").val() == ''){					
					$("#client_ID").val(data);
				}				
				//同步预约挂号所需基础信息
				$('div.sendmsg').html('');
				$('input.resinfo').each(function(){
					var value=$(this).val();
					var name=$(this).attr('name');
					$('div.sendmsg').append('<input type="hidden" name="'+name+'" id="res_'+name+'" value="'+value+'"/>');
				});	
				var sexVal=$('input[name="gender"]:checked').val();
				$('div.sendmsg').append('<input type="hidden" name="sex" id="res_sex" value="'+sexVal+'"/>');
				$('#savebtbox').hide();
				$('#msgbox').hide();
				$('.baseinfo').attr('disabled','disabled');
				parent.gClients.fillDataTable();
				parent.layer.msg('保存成功!',{icon: 1});	
				
				
			}else{
				parent.layer.alert(result1.msg,{icon: 2});
			}
		},function(rest){
			var lastrecepter=$(".receptionlist:last").val();
			$('#last_reception').val(lastrecepter);
		});
		if(!formObj.check('false','#username')||!formObj.check('false','#age')||!formObj.check('false','#telephone')||!formObj.check('false','#address')||!formObj.check('false','#birthday')){			
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		}
		$('#baseinfomation').submit();		
	}	

	/**
	 * 通过用户名查找历史数据
	 * */
	this.findUserInfoByName = function(obj) {
		var request_val=obj.value;			
		var reg=new RegExp("^[\u4e00-\u9fa5]{1,}|[a-zA-Z]{1,}$"); 
		var result=reg.test(request_val);
		if(!result){
				$('div.Namecheckdiv').html('<span class="Validform_checktip Validform_wrong">请输入正确的名称</span>');
		}else{
				$('div.Namecheckdiv').html('');
				var url='';
				var str='';
				str='<table class="table table-border table-bordered table-bg table-hover table-sort">';
				str+='<thead><tr class="text-c"><th width="80">姓名</th><th width="140">手机号</th><th width="140">住址</th><th width="50">操作</th></tr></thead>';
				url = {controller:'Client',method:'getAllPerson',username:request_val};
				self.cmd(gHttp,url,function(data){
					if(data['ttl']==0){
						str='没有查到该姓名相关的历史记录';						
					}
					else{						
						str+='<tbody>';
						$.each(data['rows'],function(k,v){							
							str+='<tr><td>'+v.username+'</td><td class="text-c">'+v.telephone+'</td><td class="text-c">'+v.address+'</td><td class="text-c">';	
							str+='<a style="text-decoration:none" onClick="gClients.onloadinfomations('+v.id+');" href="javascript:;" title="导入该患者信息"><i class="Hui-iconfont">&#xe645;</i></a></td></tr>';
						});
						str+='</tbody></table>';
					}	
						
				});
				setTimeout(function () { 
					layer.tips(str, $(obj), {
						tips: [2,'#78BA32'],
						area:['400px','auto'],	
						time:12000
					});
				
				}, 500);  
					
		}
	}
	
	// }}}
	/**
	 * 通过用户手机号查找历史数据
	 * */
	this.findUserInfoBytelephone = function(obj) {
		var request_val=obj.value;
		if(request_val.length<5){
			return false;
		}else{
			var reg=new RegExp("^1[0-9]{1,}$"); 
			var result=reg.test(request_val);
			if(!result){
					$('div.Phonecheckdiv').html('<span class="Validform_checktip Validform_wrong">请输入正确的手机号</span>');
			}else{
				$('div.Phonecheckdiv').html('');
				var url='';
				var str='';
				str='<table class="table table-border table-bordered table-bg table-hover table-sort">';
				str+='<thead><tr class="text-c"><th width="80">姓名</th><th width="140">手机号</th><th width="140">家庭住址</th><th width="50">操作</th></tr></thead>';
				url = {controller:'Client',method:'getAllPerson',telephone:request_val};
				self.cmd(gHttp,url,function(data){
					if(data['ttl']==0){
						str='没有查到该手机号相关的历史记录';						
					}
					else{						
						str+='<tbody>';
						$.each(data['rows'],function(k,v){						
							str+='<tr><td>'+v.username+'</td><td class="text-c">'+v.telephone+'</td><td class="text-c">'+v.address+'</td><td class="text-c">';	
							str+='<a style="text-decoration:none" onClick="gClients.onloadinfomations('+v.id+');" href="javascript:;" title="导入该患者信息"><i class="Hui-iconfont">&#xe645;</i></a></td></tr>';
						});
						str+='</tbody></table>';
					}	
						
				});
				setTimeout(function () { 
					layer.tips(str, $(obj), {
						tips: [2,'#78BA32'],
						area:['400px','auto'],	
						time:12000
					});
				
				}, 500);  
			}
		}
	}
	
	// }}}
	

	// {{{ function fillUserInfoById()	
	
	/**
	 * 填充用户基本信息
	 * */
	this.onloadinfomations = function(client_id) {
		layer.closeAll('tips'); 
		self.cmd(gHttp,{controller:'Client', method:'get', id:client_id}, function(result1){			
			var data = result1.data;			
			var record_ids = '';
			$.each(data,function(i,v) {
				if ( 'address' == i ) {							
					$("#" + i).val(v);
				} else if ( 'focus_users' == i ) {
					var str = '';
					$.each(v,function(k,u){
						str+='<div class="check-box col-2" style="overflow:hidden;height:25px;line-height:25px;" info="'+u+'"><input type="checkbox" id="pid_items_' + k + '" name="focus_id[]" value="' + k + '" checked/><label>' + u + '</label></div>';
					});	
					$("#relation_ship").html(str);
					
				} else if ('gender' == i ) {
					$("#gender" + v).attr('checked', true);
				} else if ('id' == i ) {
					$("#client_ID").val(v);
					$("#id").val(v);
				} else {
					$("#" + i).val(v);
				}								
			});
			self.cmd(gHttp,{controller:'Client', method:'getclientrecord', client_id:client_id}, function(result2){
				if(result2.data.length>0){
					for(i=0;i<result2.data.length-1;i++){
						self.addnews();
					}
					$.each(result2.data,function(i,v){
						
						$('input[name="record['+i+'][recordtime]"]').val(v.recordtime);				
						$('select[name="record['+i+'][reception_id]"]').val(v.reception_id);
						$('textarea[name="record['+i+'][content]"]').val(v.content);
					});	
					
				}
			});
			

			

			
			//同步预约挂号所需基础信息
			$('div.sendmsg').html('');
			$('input.resinfo').each(function(){
				var value=$(this).val();
				var name=$(this).attr('name');
				$('div.sendmsg').append('<input type="hidden" name="'+name+'" id="res_'+name+'" value="'+value+'"/>');
			});	
			var sexVal=$('input[name="gender"]:checked').val();
			$('div.sendmsg').append('<input type="hidden" name="sex" id="res_sex" value="'+sexVal+'"/>');
			self.onloadCss();
			$('#save').html('<i class="Hui-iconfont">&#xe632;</i> 更新信息');
			$("#record_ids").val(record_ids);
			
			self.gethistoryResbookings(data.telephone);
			
		});
		
	}
	
	// }}}
	
	//调取历史预约记录
	this.gethistoryResbookings=function(telephone){
				
		
			$("#bookinglisttab").grid({
				para:{controller:'ResBookingInfo',method:'getdatabytelephone',telephone:telephone},
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
					],
				field : [							
							{ data: 'id',orderable:false},
							{ data: 'date',orderable:false},
							{ data: 'times',orderable:false},
							{ data: 'depart_name',orderable:false},
							{ data: 'doctor_name',orderable:false},							
							{ data: 'statu',orderable:false,render:function(value){return value=='己到诊'?'<span class="label label-success radius">己到诊</span>':'<span class="label label-default radius">未到诊</span>';}}
						]
					
			});	
			
			
			
		
	}
	
	//地区编辑
	this.editorplace=function(){
		//地区列表
		self.fillPlaceData();
		
		$('#save').click(function(){
			self.savePlace();			
		});
		
	}
	
	//地区列表
	this.fillPlaceData=function() {
		var trClass = {'1':'firstTD', '2':'secondTD', '3':'thirdTD'};
		var pre = {'1':'', '2':'&nbsp;&nbsp;|——', '3':'&nbsp;&nbsp;&nbsp;&nbsp;|——'};
		$.getJSON("/hcc/clients/manage/place.json?="+new Date().getTime(), function(data){
			$.each(data, function(k,v) {
				var idArr = k.split('-');
				var length = idArr.length;
				var currentClass = trClass[length];
				var str='<tr class="'+currentClass+'" id="TD-'+k+'"><td>'+pre[length]+'<input type="text" class="input-text" value="'+v+'" placeholder="请输入地区名称..."/></td>';
				str+='<td class="text-c">';
				if ('thirdTD' !== currentClass)
				    str+='<a style="text-decoration:none;" onClick="gClients.addsoninfo(\''+k+'\',\''+currentClass+'\');" href="javascript:;"><i class="Hui-iconfont">&#xe604;</i></a>';
				str+='<a style="text-decoration:none;" onClick="gClients.delthisplace(\''+k+'\',\''+currentClass+'\');" href="javascript:;" class="ml-5"><i class="Hui-iconfont">&#xe609;</i></a></td></tr>';
				
				if ('firstTD' == currentClass) {
					$('tr.addbtbox').before(str);
				} else if ('secondTD' == currentClass) {
					$('#TD-' + idArr[0]).after(str);
				} else if ('thirdTD' == currentClass) {
					$('#TD-' + idArr[0] + '-' + idArr[1]).after(str);
				}
			});
		});
	} 
	
	//新增顶级地区
	this.addfatherinfo=function(){
		var i=1;
		if ($('.firstTD').length > 0) {
			var iii = $('.firstTD:last').attr('id');
			var arr = iii.split('-');
			i = parseInt(arr[1]) + 1;
		} else {
			i=$('.firstTD').length+1;
		}
		var str='<tr class="firstTD" id="TD-'+i+'"><td><input type="text" class="input-text" value="" placeholder="请输入地区名称..."/></td>';
		str+='<td class="text-c"><a style="text-decoration:none;" onClick="gClients.addsoninfo('+i+',\'firstTD\');" href="javascript:;"><i class="Hui-iconfont">&#xe604;</i></a>';
		str+='<a style="text-decoration:none;" onClick="gClients.delthisplace('+i+',\'firstTD\');" href="javascript:;" class="ml-5"><i class="Hui-iconfont">&#xe609;</i></a></td></tr>';
		$('tr.addbtbox').before(str);
	}
	
	//新增子级地区
	this.addsoninfo=function(i,type){
		var num=0;		
		if(type=='firstTD'){
			num=$('tr.secondTD[id^="TD-'+i+'"]').length;
			if(num==0){
				var str='<tr class="secondTD" id="TD-'+i+'-0"><td>&nbsp;&nbsp;|——<input type="text" class="input-text" value="" placeholder="请输入地区名称..."/></td>';
				str+='<td class="text-c"><a style="text-decoration:none;" onClick="gClients.addsoninfo(\''+i+'-0\',\'secondTD\');" href="javascript:;"><i class="Hui-iconfont">&#xe604;</i></a>';
				str+='<a style="text-decoration:none;" onClick="gClients.delthisplace(\''+i+'-0\',\'secondTD\');" href="javascript:;" class="ml-5"><i class="Hui-iconfont">&#xe609;</i></a></td></tr>';				
				$('tr[id^="TD-'+i+'"]').after(str);
			}
			else{							
				var j=$('tr.secondTD[id^="TD-'+i+'"]:last').attr('id');				
				var arr=j.split('-');				
				j=parseInt(arr[2])+1;				
				var str='<tr class="secondTD" id="TD-'+i+'-'+j+'"><td>&nbsp;&nbsp;|——<input type="text" class="input-text" value="" placeholder="请输入地区名称..."/></td>';
				str+='<td class="text-c"><a style="text-decoration:none;" onClick="gClients.addsoninfo(\''+i+'-'+j+'\',\'secondTD\');" href="javascript:;"><i class="Hui-iconfont">&#xe604;</i></a>';
				str+='<a style="text-decoration:none;" onClick="gClients.delthisplace(\''+i+'-'+j+'\',\'secondTD\');" href="javascript:;" class="ml-5"><i class="Hui-iconfont">&#xe609;</i></a></td></tr>';
				//$('tr.secondTD[id^="TD-'+i+'"]:last').after(str);
				$('tr[id^="TD-'+i+'"]:last').after(str);
			}
		}
		else{
			//子级的子级
			num=$('tr.thirdTD[id^="TD-'+i+'"]').length;
			if(num==0){
				var str='<tr class="thirdTD" id="TD-'+i+'-'+0+'"><td>&nbsp;&nbsp;&nbsp;&nbsp;|——<input type="text" class="input-text" value="" placeholder="请输入地区名称..."/></td>';
				str+='<td class="text-c"><a style="text-decoration:none;" onClick="gClients.delthisplace(\''+i+'-'+0+'\',\'secondTD\');" href="javascript:;"><i class="Hui-iconfont">&#xe609;</i></a></td></tr>';								
				$('tr[id^="TD-'+i+'"]').after(str);
			}
			else{							
				var j=$('tr.thirdTD[id^="TD-'+i+'"]:last').attr('id');				
				var arr=j.split('-');				
				j=parseInt(arr[3])+1;				
				var str='<tr class="thirdTD" id="TD-'+i+'-'+j+'"><td>&nbsp;&nbsp;&nbsp;&nbsp;|——<input type="text" class="input-text" value="" placeholder="请输入地区名称..."/></td>';
				str+='<td class="text-c"><a style="text-decoration:none;" onClick="gClients.delthisplace(\''+i+'-'+j+'\',\'secondTD\');" href="javascript:;"><i class="Hui-iconfont">&#xe609;</i></a></td></tr>';				
				$('tr.thirdTD[id^="TD-'+i+'"]:last').after(str);
				
			}
		}	
	}
	
	
	//删除地区
	this.delthisplace=function(i,type){			
		layer.confirm('是否删除此项？若此项有子地区会一起删除', {
		  icon: 3, title:'提醒',	
		  btn: ['确定', '取消'] //可以无限个按钮
		  ,
		}, function(index, layero){
		  //按钮【按钮一】的回调	
			self.cmd(gHttp,{controller:'Client',method:'delPlace',id:i},function(ret){
				if (ret.statu) {
					layer.msg('删除成功');
					$('tr[id^="TD-'+i+'"]').remove();
					layer.close(index);
				} else {
					layer.msg('删除失败');
				}
			});
			  
		}, function(index){
		  //按钮【按钮二】的回调
			  layer.close(index);
		});	
		
	}
	
	//保存地区列表
	this.savePlace=function(){
		var data = {};
		$('tr[id^="TD-"]').each(function(){
			var id = $(this).attr("id");
			var name = $(this).find('input').val();
			if (name != '') {
				data[id] = name;
			}
		});
		
		self.cmd(gHttp,{controller:'Client',method:'savePlace',data:data},function(ret){
			if (ret.statu) {
				layer.msg('保存成功');layer_close();
			}
		});
	}

	//展示地区列表
	this.showplacelist=function(){
		//填充数据
		$("#firstDiv, #secondDiv, #thirdDiv").html('');
        self.getPlaceHtml();
        
		$('.client-subcat').show();
		
	}
	
	//拼接各个地区的代码
	this.getPlaceHtml = function(){
		self.cmd(gHttp,{controller:'Client',method:'getPlace'},function(ret){
			var firstData = ret.data.first;
			var secondData = ret.data.second;
			var thirdData = ret.data.third;
			
			var html1 = html2 = html3 = '';
			var flag1 = flag2 = flag3 = true;
			$.each(firstData, function(k1,v1){
				var c1 = '';
				if (flag1) {c1='class="client-tab-cur"';flag1=false;}
				html1 += '<a href="#" data="'+k1+'" '+c1+'>'+v1+'</a>';
				
				html2 += '<li>';
				
				var c3 = '';
				if (flag3) {c3='class="client-x"';flag3=false;}
				html3 += '<ul '+c3+'>';
				
				$.each(secondData, function(k2,v2){
					var arr2 = k2.split('-');
					if (k1 == arr2[0]) {
						var c2 = '';
						if (flag2) {c2='class="client-tab-cur"';flag2=false;}
						html2 += '<a href="#" data="'+k2+'" '+c2+'>'+v2+'</a>';
						
						html3 += '<li>';
						$.each(thirdData, function(k3,v3){
							var arr3 = k3.split('-');
							if (k2 == arr3[0] + '-' + arr3[1]) {
								html3 += '<a href="#" data="'+k3+'">'+v3+'</a>';
							}
							
						});
						html3 += '</li>';
					}
				});
				html3 += '</ul>';
				html2 += '</li>';
			});
			$("#firstDiv").html(html1);
			$("#secondDiv").html(html2);
			$("#thirdDiv").html(html3);
		});
		
		placeEvent();
		
	}
	
	//隐藏地区列表
	this.hideplacelist=function(){
		//$('.client-subcat').hide();		
	}
	
	//患者来源管理
	this.editorsource=function(){
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		
		
	}

	//年龄和生日联动
	this.changeAge = function (){
		var timestamp = new Date();
		var year = timestamp.getFullYear();
		var birthday = $('#birthday').val();
		var arr = birthday.split('-');
		var age = year - parseInt(arr[0]);
		$("#age").val(age);
	}

    //通过年龄计算出生年份
	this.getBirthdayFromAge = function(age) {
		age = (age == '') ? 0 : parseInt(age);
		var timestamp = new Date();
		var year = timestamp.getFullYear();
		var month = timestamp.getMonth() + 1;
		var day = timestamp.getDate();
		var birthday = $('#birthday').val();
		var str = (year-age) + '-' . month + '-' . day;
		if (birthday == '') {
			birthday = self.getToday();
		}
		var arr = birthday.split('-');
		str = (year-age) + '-' + arr[1] + '-' + arr[2];
		return str;
	}
	
	//获取当天日期
	this.getToday = function() {
		var timestamp = new Date();
		var year = timestamp.getFullYear();
		var month = timestamp.getMonth() + 1;
		var day = timestamp.getDate();
		
		month = month<10 ? '0' + month : month;
		day = day<10 ? '0' + day : day;
		
		return year + '-' + month + '-' + day;
	}

	// {{{ function changeDepartment()
	
	/**
	 * 改变department
	 * */
	this.changeDepartment = function(val) {
		if ($("#date").val() == '') {
			layer.msg('请先选择预约日期！');
			return false;
		}
		
		if(val==''){
			//关联医生
			$('#doctor_id').html('<option value="">请选择</option>');
		}else{
			self.cmd(gHttp,{controller:'ResDoctor',method:'query',department_id:val},function(ret){
				if(ret.ttl){
					var doctor = '<option value="">请选择</option>';
					//关联医生
					$.each(ret.data,function(i,obj){
						doctor += '<option value="'+obj.id+'">'+obj.name+'</option>';
					});
					$('#doctor_id').html(doctor);
					
				}else{
					layer.alert('当前科室暂无医生');
				}
			});
		}
	}
	
	// }}}
	// {{{ function getReservationByDate()
	
	/**
	 * 日期改变时，重新加载预约时间段
	 * */
	this.getReservationByDate = function() {
		var department_id=$("#department_id").val();
		var doctor_id=$("#doctor_id").val();
		var date=$("#date").val();
		
		if (date == '') {return false;}
		if (department_id != '' && doctor_id != '') {
			self.getReservation();
		}
	}
	
	// }}}
	// {{{ function getReservation()
	
	/**
	 * 获取可预约的时间段
	 * */
   this.getReservation = function(){	  
	   var department_id=$("#department_id").val();
	   var doctor_id=$("#doctor_id").val();
	   var date=$("#date").val();
       var timehtml="";       
       if (date == '') {
			layer.msg('请先选择预约日期！',{icon:2});
			return false;
		}       
	   $.ajax({
		   type:"POST",
		   url:"/controller/",
		   data:{'controller':'Client','method':'getTimepointBydocID','docID':doctor_id,'date':date},
		   dataType: "json",
		   success:function(ret){ 
			   if(ret.statu) {								
				   if(ret.code==0){
						var results=ret.data;								
						timehtml+='<option value="">-请选择-</option>';
						for(var i=0;i<results.length;i++){
							var values=results[i].split('-');
							timehtml+='<option value="'+values[0]+'">'+results[i]+'</option>';
						}
					}else if(ret.code==1){
						timehtml+='<option value="">'+ret.data+'</option>';
					}
			   }else{				   
				   timehtml+='<option value="">'+ret.msg+'</option>';
			   }
			   $('#resvation_id').val(ret.resid);
			   $("#appointment").html(timehtml);
		   }
	   }); 
   }
   
    //}}
	
	// {{{ function savebookinginfo()
	/**
	 * 保存预约信息
	 * */
	this.savebookinginfo=function(){
		var clientID=$('#client_ID').val();
		var sourceID=$('#source').val();
		var post = {controller:'Client',method:'saveBookingInfo',source:sourceID};
		var telephone=$('#telephone').val();
		$('#resbookinginfo').checkAndSubmit('savebookinginfo', post,function(ret){
			if(ret.statu){
												
				self.gethistoryResbookings(telephone);				
				
				parent.layer.msg('操作成功!',{icon: 1});	
				
			}else{
				parent.layer.alert(ret.msg,{icon:2});
			}

			return false;
		});
		$('#resbookinginfo').submit();	
	}
	
	
	
	//}}
	
    // {{{ function fillSource()
	
	/**
	 * 填充来源信息
	 * */
	this.fillSource = function(){
		self.cmd(gHttp,{controller:'Client',method:'getDataSource'},function(res){
			if(res.statu){
				var sourceList = res.data;
				var sourceHtml = '<option value="" selected="selected">请选择</option>';
				if ( sourceList!= null) {
					$.each(sourceList,function(i,v) {
						sourceHtml += '<option value="' + v.id + '">' + v.title + '</option>';
					});
				}
				$("#source").html(sourceHtml);
			}else{
				return false;
			}
		});
	}
	
	// }}}
    // {{{ function fillReceptionist()
	
	/**
	 * 填充前台接待信息
	 * */
	this.fillReceptionist = function() {
		
		var selectArray=new Array();
		$('.receptionlist').each(function(){
			var num=$(this).attr('flag');
			var value=$(this).val();
			if(value!=''&&value!=undefined){
				selectArray[num]=value;
			}			
		});	
		self.cmd(gHttp,{controller:'Client',method:'getReceptionist'},function(res){
			if(res.statu){
				var receptionist = res.data;
				var recHtml = '<option value="" selected>请选择</option>';
				if ( receptionist!= null) {
					
					$.each(receptionist,function(i,v) {
						recHtml += '<option value="' + v.id + '">' + v.user_name + '</option>';
					});
				}
				$(".receptionlist").html(recHtml);

			}else{
				return false;
			}
		});
		$('.receptionlist').each(function(){
			var num=$(this).attr('flag');			
			if(selectArray[num]!=''&&selectArray[num]!=null){
				$(this).val(selectArray[num]);
			}			
		});
	}
	
	// }}}
	// {{{ function manageInitHtml()
	
	/**
	 * 管理初始化
	 * */
	this.manageInitHtml = function(type, title) {
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		$('.tabBar span').click(function(){
			var index = $(this).index();
			if (index == 1) {
				$("#id,#remark").val('');
				$("#formEdit input[type='text']").val('');
			}
		});
		switch(type) {
			case 'source':
				self.getManageSourceTable();
				break;		
			default:
				break;
		}
		
		return false;
	}
	
	// }}}
    // {{{ function getManageSourceTable()
	
	/**
	 * 来源管理
	 * */
	this.getManageSourceTable = function(diaObj){
		$('#sourceList').grid({
			para :  {controller:'Client',method:'getDataSource',list:true},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [{data : 'id',render : function (id, type, row) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'title'},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'id',render : function(id, type, row){
				    	 gData[id] = row;
				    	 return '<a style="text-decoration:none" class="ml-5" onClick="gClients.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					}
				}
			]
		});
		$('#save').click(function(){
			self.subSource();
		});
	}
	
	// }}}
    // {{{ function edit()
	
	/**
	 * 初始化会员修改
	 * */
	this.edit = function(id) {
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
		
		$.each(gData[id],function(i,v){
			$("#" + i).val(v);
		});
	}
	
	// }}}
	// {{{ function delSource()
	//删除来源
	this.delSource = function() {
		var ids = $("#sourceList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#sourceList").dataTable();
				self.openDel(obj,{controller:'Client',method:'delSource',id:ids},function(){
					//更新select
					parent.gClients.fillSource();																	   
				
				});
				
				}
		
		
	}
	
	// }}}
	// {{{ function subSource()
	
	/**
	 * 来源提交
	 * */
	this.subSource = function(content){
		var id = $('#id').val();
    	var url = {controller:'Client',method:'addSource'};
    	if (id != '') {
			var url = {controller:'Client',method:'modSource'};
		}
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#sourceList').dataTable().api().ajax.reload();
				//更新select
				parent.gClients.fillSource();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	// }}}
	
	
    // {{{ function getManageRecptionistTable()
	
	/**
	 * 前台接待列表
	 * */
	 /*
	this.getManageReceptionistTable = function(diaObj){
		$('#receptList').grid({
			para :  {controller:'Client',method:'getReceptionist',isPage:1},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [{data : 'id',render : function (id, type, row) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'user_name'},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'id',render : function(id, type, row){
				    	 gData[id] = row;
				    	 return '<a style="text-decoration:none" class="ml-5" onClick="gClients.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					}
				}
			]
		});
		$('#save').click(function(){
			self.subReceptionist();
		});
		
	}
	
	// }}}
	*/
	/*
	// {{{ function delRecept()
	//删除前台接待
	this.delRecept = function() {
		var ids = $("#receptList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#receptList").dataTable();
				self.openDel(obj,{controller:'Client',method:'delReceptionist',id:ids},function(){
					//更新select
					parent.gClients.fillReceptionist();															 
																								 
				});		
		}
	}
	
	// }}}
	*/
	
	// {{{ function subRecptionist()
	
	/**
	 * 咨询人员提交
	 * */
	this.subReceptionist = function(){
		var id = $('#id').val();
    	var url = {controller:'Client',method:'addReceptionist'};
    	if (id != '') {
			var url = {controller:'Client',method:'modReceptionist',id:id};
		}
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#receptList').dataTable().api().ajax.reload();
				//更新select
				parent.gClients.fillReceptionist();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	// }}}
    // {{{ function stat()
	
	/**
	 * 统计
	 * */
	this.initStat = function() {
		initTimeMonth('start', 'end');
		
		self.statBySource();
		$('#qry').click(function(){
			$("li[id^='li_stat_']").hide();
			//开始统计
			var type = $('#type').val();
			if (type == '') {
				layer.alert('请选择');
				return;
			}
			$("li[id^='li_stat_" + type + "']").show();
			$("#li_stat_" + type + " h4").addClass("selected");
			$("#li_stat_" + type + " .info").css("display","block");
			$("#li_stat_" + type + " b").text("-");
			switch (type) {
		        case '1': //来源统计
		    	    self.statBySource();
			        break;
			    case '2': //咨询统计
			    	self.statByReceptionist();
				    break;
			    case '3': //科室统计
			    	self.statByDepartment();
			    	break;
			    case '4': //所在地区
			    	self.statByRegion();
			    	break;
			    default:
				    break;
			}
		});
			
		$.Huifold("#Huifold1 .item h4","#Huifold1 .item .info","fast",2,"click"); /*菜单展开效果，5个参数顺序不可打乱，分别是：相应区,隐藏显示的内容,速度,类型,事件*/
	}
	
	// }}}
	// {{{ function statBySource()
	
	/**
	 * 来源统计
	 * */
	this.statBySource = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'Client',method:'getStatData',type:'1',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;	
			var tdWidth = 120;
			var header='<tr class="text-c"><th width="'+tdWidth+'">来源名称&nbsp;<b>/</b>&nbsp;统计项目</th>';
			var yes_str='<tr><td class="text-c">一定到诊（人）</td>';			
			var maybe_str='<tr><td class="text-c">可能到诊（人）</td>';
			var unsure_str='<tr><td class="text-c">不确定到诊（人）</td>';
			var no_str='<tr><td class="text-c">不会到诊（人）</td>';
			var arrive_str='<tr><td class="text-c">已到诊（人）</td>';
			var total_str='<tr><td class="text-c">咨询总数（人）</td>';
			$.each(data,function(i,v){
				header+='<th width="90">'+v.title+'</th>';
				yes_str+='<td class="text-c">'+v.yes+'</td>';
				maybe_str+='<td class="text-c">'+v.maybe+'</td>';
				unsure_str+='<td class="text-c">'+v.unsure+'</td>';
				no_str+='<td class="text-c">'+v.no+'</td>';
				arrive_str+='<td class="text-c">'+v.arrive+'</td>';
				total_str+='<td class="text-c">'+v.total_num+'</td>';
			});
			header+='</tr>';
			var tbodyer=yes_str+'</tr>'+maybe_str+'</tr>'+unsure_str+'</tr>'+no_str+'</tr>'+arrive_str+'</tr>'+total_str+'</tr>';
			$('#listAll1').find('thead').html(header);
			$('#listAll1').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info1'),tdWidth,tdWidth,$('#li_stat_1'));			
			//格式化数据
			var statData = self.formatStatData(data,'1');
			//显示统计图
			var stype = $("#showType").val();
			self.showStatImg(statData, 'statImg1', '营收比例', '咨询来源统计','',stype);
		});
		
		//按天统计
		self.cmd(gHttp,{controller:'Client',method:'statByDate',action:'source',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					if (showType == 'pie') {
						var num = 0;
						$.each(v, function(i, d){
							num += d;
						});
						statData.push({
							'name':k,
							'value':num
						});
					} else {
						$.each(v, function(i, d){
							statData.push({
								'group':i,
								'name':k,
								'value':d
							});
						});
					}
				});
				
				var title = '来源到诊量时间曲线 (默认统计最近30天的就诊情况)';
				//显示统计图
				self.showStatImg(statData, 'statImg1_2', '人数', title,'','line');
			}else{
				$("#statImg1_2").html('');
			}
		});
	}
	
	// }}}
    // {{{ function statByReceptionist()
	
	/**
	 * 咨询人员统计
	 * */
	this.statByReceptionist = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'Client',method:'getStatData',type:'2',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var tdWidth = 120;
			var header='<tr class="text-c"><th width="'+tdWidth+'">姓名&nbsp;<b>/</b>&nbsp;统计项目</th>';
			var arrive_str='<tr><td class="text-c">已到诊（人）</td>';
			var total_str='<tr><td class="text-c">咨询总数（人）</td>';
			$.each(data,function(i,v){
				header+='<th width="90">'+v.user_name+'</th>';
				arrive_str+='<td class="text-c">'+v.arrive+'</td>';
				total_str+='<td class="text-c">'+v.total_num+'</td>';
			});
			header+='</tr>';
			var tbodyer=arrive_str+'</tr>'+total_str+'</tr>';
			$('#listAll2').find('thead').html(header);
			$('#listAll2').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info2'),tdWidth,tdWidth,$('#li_stat_2'));
			//格式化数据
			var statData = self.formatStatData(data,'2');
			//显示统计图
			var stype = $("#showType").val();
			self.showStatImg(statData, 'statImg2', '人数', '前台接待工作统计','',stype);
		});
		
		//按天统计
		self.cmd(gHttp,{controller:'Client',method:'statByDate',action:'receptionist',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					if (showType == 'pie') {
						var num = 0;
						$.each(v, function(i, d){
							num += d;
						});
						statData.push({
							'name':k,
							'value':num
						});
					} else {
						$.each(v, function(i, d){
							statData.push({
								'group':i,
								'name':k,
								'value':d
							});
						});
					}
				});
				
				var title = '每天就诊人数统计 (默认统计最近30天的就诊情况)';
				//显示统计图
				self.showStatImg(statData, 'statImg2_2', '人数', title,'','line');
			}else{
				$("#statImg2_2").html('');
			}
		});
	}
	
	// }}}
    // {{{ function statByDepartment()
	
	/**
	 * 科室统计
	 * */
	this.statByDepartment = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'Client',method:'getStatData',type:'3',flag:'department',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var header='<tr><th width="140">科室名称</th>';
			var yes_str='<tr><td class="text-c">一定到诊（人）</td>';			
			var maybe_str='<tr><td class="text-c">可能到诊（人）</td>';
			var unsure_str='<tr><td class="text-c">不确定到诊（人）</td>';
			var no_str='<tr><td class="text-c">不会到诊（人）</td>';
			var arrive_str='<tr><td class="text-c">已到诊（人）</td>';
			var total_str='<tr><td class="text-c">咨询总数（人）</td>';
			$.each(data,function(i,v){
				header+='<th width="90">'+v.name+'</th>';
				yes_str+='<td class="text-c">'+v.yes+'</td>';
				maybe_str+='<td class="text-c">'+v.maybe+'</td>';
				unsure_str+='<td class="text-c">'+v.unsure+'</td>';
				no_str+='<td class="text-c">'+v.no+'</td>';
				arrive_str+='<td class="text-c">'+v.arrive+'</td>';
				total_str+='<td class="text-c">'+v.total_num+'</td>';				
			});
			header+='</tr>';
			var tbodyer=yes_str+'</tr>'+maybe_str+'</tr>'+unsure_str+'</tr>'+no_str+'</tr>'+arrive_str+'</tr>'+total_str+'</tr>';			
			$('#listAll3').find('thead').html(header);
			$('#listAll3').find('tbody').html(tbodyer);
			
			
			//格式化数据
			var statData = self.formatStatData(data,'3','department');
			//显示统计图
			self.showStatImg(statData, 'statImg3', '人数', '科室咨询统计');
		});
		
		self.cmd(gHttp,{controller:'Client',method:'getStatData',type:'3',flag:'month',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var statData = [];
			$.each(data, function(k, v) {
				if (showType == 'pie') {
					var num = 0;
					$.each(v, function(i, d){
						num += d;
					});
					statData.push({
						'name':k,
						'value':num
					});
				} else {
					$.each(v, function(i, d){
						statData.push({
							'group':i,
							'name':k,
							'value':d
						});
					});
				}
			});
			//显示统计图
			self.showStatImg(statData, 'statImg3_2', '人数', '按月份和科室统计');
		});
		
	}
	/**
	 * 所在地区
	 * */
	this.statByRegion = function() {	
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'Client',method:'getStatData',type:'4',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var header='<tr class="text-c"><th colspan="3">地区</th><th>人数</th></tr>';
			var tbodyer='';
			$.each(data,function(i,v){
				tbodyer+='<tr>';		 
					if(v.two != undefined){
						tbodyer+='<td class="text-c" rowspan="'+v.rowspan_one+'">'+v.region_name+'</td>';
						$.each(v.two,function(m,n){
							if(n.three != undefined){
							   tbodyer+='<td class="text-c" rowspan="'+n.rowspan_two+'">'+n.region_name+'</td>';
									$.each(n.three,function(k,f){
										tbodyer+='<td class="text-c">'+f.region_name+'</td><td class="text-c">'+f.region_num+'</td></tr>';
									});	
							}else{
							   tbodyer+='<td class="text-c" colspan="2">'+n.region_name+'</td><td class="text-c">'+n.region_num+'</td></tr>';
							}
						});
						if(v.other_num!=0){
							 tbodyer+='<tr><td class="text-c" colspan="2">其他</td><td class="text-c">'+v.other_num+'</td></tr>';
						}
					}else{
						tbodyer+='<td class="text-c" colspan="3">'+v.region_name+'</td><td class="text-c">'+v.other_num+'</td></tr>';						
					}

			});
			$('#listAll4').find('thead').html(header);
			$('#listAll4').find('tbody').html(tbodyer);
			//格式化数据
			var statData = self.formatStatData(data,'4');
			//显示统计图
			var stype = $("#showType").val();		
			self.showStatImg(statData, 'statImg4', '人数', '所在地区统计','',stype);
		});
			  
	}	
	// }}}
    // {{{ function formatStatData()
	
	/**
	 * 格式化统计数据
	 * */
	this.formatStatData = function(data,statType,field_flag,type) {
		if (type == undefined) {
			var type = $('#showType').val();
		}
		var statData = [];
		if (statType == '1') {
			if (type == 'pie') {
				$.each(data, function(k, v) {
					statData.push({
						'group':'咨询总数',
						'name':v['title'],
						'value':v['total_num']
					});
				});
			}else{
				var name = {'yes':'一定到诊','maybe':'可能到诊','unsure':'不确定到诊','no':'不会到诊','arrive':'已到诊','total_num':'咨询总数'};
				$.each(data, function(k, v) {
					for(var i in name) {
						statData.push({
							'group':v['title'],
							'name':name[i],
							'value':v[i]
						});
					}
				});			
			}
		} else if (statType == '2') {
			if (type == 'pie') {
				var arrive_num = 0;
				var total_num = 0;
				$.each(data, function(k, v) {
					arrive_num += v['arrive'];
					total_num += v['total_num'];
				});
				
				statData.push({
					'group':'已到诊',
					'name':'已到诊',
					'value':arrive_num
				});
				
				statData.push({
					'group':'咨询总数',
					'name':'咨询总数',
					'value':total_num
				});
				
			} else {
				$.each(data, function(k, v) {								
					statData.push({
						'name':v['user_name'],
						'group':'已到诊',
						'value':v['arrive']
					});
					statData.push({
						'name':v['user_name'],
						'group':'咨询总数',
						'value':v['total_num']
					});
					
				});
			}
		} else if (statType == '3') {
			if (type == 'pie') {
				$.each(data, function(k, v) {
					statData.push({
						'name':v['name'],
						'value':v['total']
					});
				});
			} else {
				$.each(data, function(k, v) {
					statData.push({
						'name':v['name'],
						'group':'一定到诊',
						'value':v['yes']
					});
					
					statData.push({
						'name':v['name'],
						'group':'可能到诊',
						'value':v['maybe']
					});
					
					statData.push({
						'name':v['name'],
						'group':'不确定到诊',
						'value':v['unsure']
					});
					
					statData.push({
						'name':v['name'],
						'group':'不会到诊',
						'value':v['no']
					});
					
					statData.push({
						'name':v['name'],
						'group':'已到诊',
						'value':v['arrive']
					});
				});
			
			}
		} else if (statType == '4') {
			$.each(data, function(k, v) {
				if(v.two != undefined){
					$.each(v.two, function(m, n) {
						if(n.three != undefined){
							$.each(n.three, function(o, p) {
								statData.push({
									'group':p['region_name'],
									'name':p['region_name'],
									'value':p['region_num']
								});									
							});	
						}else{
							statData.push({
								'group':n['region_name'],
								'name':n['region_name'],
								'value':n['region_num']
							});									
						}
					});							
				}else{
					statData.push({
						'group':v['region_name'],
						'name':v['region_name'],
						'value':v['region_num']
					});							
				}
				if(v.other_num!=0){
					statData.push({
						'group':v['region_name']+'-其它',
						'name':v['region_name']+'-其它',
						'value':v['other_num']
					});							
				}
			});		
		}
		
		return statData;
	}
	/**
	 * 向左滚动
	 * */
	this.scrollleft=function(obj){		
		var nowlist=Number($(obj).attr('nowlist'));	//1		
		var flag=$(obj).attr('flag');
		var groupnum=Number($(obj).attr('groupnum'));//2
		var scrollength=$(obj).attr('scrollength');		
		if(nowlist<groupnum){
			//$(obj).next('table').css('border','red');
			nowlist++;
			$(obj).parent().find('table').animate({left:'-'+nowlist*scrollength+'px'});				
			$(obj).attr('nowlist',nowlist);	
			$(obj).parent().find('.left_scroll').attr('nowlist',nowlist);	
		}
		else{
			parent.layer.msg('己经是最后一组了',{icon:2});
		}
	}
	/**
	 * 向右滚动
	 * */
	this.scrollright=function(obj){
		var nowlist=Number($(obj).attr('nowlist'));		
		var flag=$(obj).attr('flag');
		var groupnum=Number($(obj).attr('groupnum'));
		var scrollength=$(obj).attr('scrollength');
		if(nowlist>0){
			nowlist--;
			$(obj).parent().find('table').animate({left:'-'+nowlist*scrollength+'px'});				
			$(obj).attr('nowlist',nowlist);	
			$(obj).parent().find('.right_scroll').attr('nowlist',nowlist);
		}
		else{
			parent.layer.msg('己经是第一组了',{icon:2});
		}
	}
	/**
	 * 超长表格滚动处理
	 * */
	
	this.scrollTab=function(obj,thWidth,titWidth,liObj){				
		$(liObj).find('h4').addClass('selected');
		$(liObj).find('div.info').show();
		var sboxWidth=$(obj).find('div.scrollbox').width();
		var sboxHeight=$(obj).find('table').height();
		//var tabWidth=$(obj).find('table').width();
		var tabWidth = sboxWidth;
		$(obj).find('.scrollbox').width(sboxWidth).height(sboxHeight+5);		
		
		
		//表格实际能容纳的项目个数
		var num=parseInt((tabWidth-titWidth-16)/(thWidth+16));
		//var moveLen=
		//目前实际的项目个数
		realnum=$(obj).find('th').length-1;
		//如果实际的项目个数多于表格实际能容纳的个数则注册滚动功能
		if(num<realnum){
			var groupnum=parseInt(realnum/num);				
			//为了让表格美观，需要重先调整单元格大小，使在scrollbox中显示的表格单元数为整数
			var newtdWidth=(tabWidth-titWidth+16)/num;
			tabWidth=realnum*(newtdWidth+16)+titWidth+16;
			$(obj).find('table').width(tabWidth);
			$(obj).find('table th:gt(0)').width(newtdWidth);
			$(obj).find('div.left_scroll').attr('groupnum',groupnum).attr('scrollength',sboxWidth).attr('nowlist',0);
			$(obj).find('div.right_scroll').attr('groupnum',groupnum).attr('scrollength',sboxWidth);
		}else{
			$(obj).find('.left_scroll').hide();
			$(obj).find('.right_scroll').hide();
		}
	}	
	// }}}
    // {{{ function showStatImg()
	
	/**
	 * 显示统计图
	 * */
	this.showStatImg = function(statData, showId, des, title, field_flag,type){
		if (type == undefined) {
			var type = $("#showType").val();
		}
		
		if (statData.length>0) {
			if (type == 'pie') {
				var opt = HighChart.ChartOptionTemplates.Pie(statData,des,title);
			} else if (type == 'line') {
				var opt = HighChart.ChartOptionTemplates.Line(statData,des,title);
			} else if (type == 'bar') {
				var opt = HighChart.ChartOptionTemplates.Bars(statData,true,true,des,title);				
			}
			
			var container = $("#" + showId);
		    HighChart.RenderChart(opt, container);
		}
		
	}
	
	// }}}
	/**
	 * 和预约挂号同步数据
	 * */
	this.syncData = function() {
		self.cmd(gHttp,{controller:'Client',method:'syncData'},function(ret){
			if(ret.statu){
				layer.msg('同步成功!');
				var table=$(window.document).find("#dataTable").dataTable();
				if (table != undefined && table.length > 0) {
					table.api().ajax.reload();	
				}
				
			}else{
				layer.alert('同步失败!',{icon:2});
			}
			return false;
		})
	}
	
	/**
	 * 更新统计
	 * */
	this.updateStatData = function() {
		var start = $("#start").val();
		var end = $("#end").val();
		self.cmd(gHttp,{controller:'Client',method:'updateStatData', start:start, end:end},function(ret){
			if(ret.statu){
				layer.msg('统计数据更新成功', {icon: 1});
			}else{
				layer.alert(ret.msg); 	
			}
		});
	}
}