/**
 * 医生管理
 * */
function Doctor() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initList()
	
	/**
	 * 初始化列表
	 * */
	this.initList = function() {
		$(function(){
			//加载科室信息
			$('#department_id').fillDepartment();
			
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
			
			
			//填充推荐位数据
        	$('#recommendposition').bindRecommend();
			
			//导航切换
			$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
			
			//加载科室信息
			$('#department_id').fillDepartment();
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				//有id，则是编辑
				$("#id").val(para.id);
				
				self.cmd(gHttp,{controller:'Doctor',method:'get',id:para.id},function(result1){
					if(result1.statu){						
						$('#formEdit').frmFill('',result1.data);
						
						self.fillShowPosition(result1.data.show_position);
						$('#recommendposition').find('input[name^=recommendposition]').each(function(){
							var checkbox = $(this);
							$.each(result1.data.recommend,function(i,obj){
								if(checkbox.val() == obj.recommendposition_id){
									checkbox.attr('checked','checked');
								}
							});
						});							
						$("input[name='gender'][value='"+result1.data.gender+"']").parent().addClass('checked');
						
						editor.ready(function(){
							editor.setContent(result1.data.content);
						});
						
						var str = '';
						self.cmd(gHttp,{controller:'Disease',method:'getByDepartmentID',department_id:result1.data.department_id},function(val){
							$.each(val.data,function(i,obj){
								var check = '';
								$.each(result1.data.disease,function(o,b){
									if(b.disease_id == obj.id){
										check = 'checked';
										return false;
									}
								});
								str += '<div class="check-box">';
								str += '<input '+check+' class="check" type="checkbox" name="disease_id['+i+']" id="disease_'+i+'" value="'+obj.id+'"><label for="disease_'+i+'">'+obj.name+'</label>';
								str += '</div>';
							});
							$('#disease_id').html(str);
						});
						
						var tplurl = $.trim(result1.data.tplurl);
                        if(tplurl != ''){
                            $('#doctor_temp').html('已上传模版文件,模版路径：'+tplurl);
                        }
                        
                        //医生照片
						if(result1.data.pic != ''){
							$('#thumbnail_doc').attr('src',result1.data.src1);
							//self.setImgSize('doctorsize', '#thumbnail_doc');
						}
						
						//资格证照片
						if(result1.data.certificate != ''){
							$('#thumbnail_prove').attr('src',result1.data.src2);
							//self.setImgSize('doctorsize', '#thumbnail_prove');
						}
						
						//个人经历列表
						self.fillPersonalExperience(para.id);
					}else{
						layer.alert(result1.msg);
					}
				});
			} else {
				self.fillShowPosition();
			}
			self.onloadCss();
			$('[name=name]').change(function(){
				var me = $(this);
				var val = me.val();
				self.cmd(gHttp,{controller:'Pingyin',method:'conversion',data:val}, function(ret){
					$('#url').val(ret.data);
				});
			});
			
			//科室的变化
			$('#department_id').change(function(){
				var department_id = $(this).val();
				self.cmd(gHttp,{controller:'Disease',method:'getByDepartmentID',department_id:department_id},function(ret){
					var str = '';
					$.each(ret.data,function(i,obj){
						str += '<div class="check-box">';
						str += '<input type="checkbox" class="check" name="disease_id['+i+']" id="disease_'+i+'" value="'+obj.id+'">';
						str += '<label for="disease_'+i+'" >'+obj.name+'</label>';					
						str += '</div>';					 
											 
						//str += '<input type="checkbox" class="check" name="disease_id['+i+']" id="disease_'+i+'" value="'+obj.id+'"><label for="disease_'+i+'" >'+obj.name+'</label>&nbsp;&nbsp;&nbsp;';
					});
					$('#disease_id').html(str);
					//加载样式
					$('.skin-minimal input').iCheck({
						checkboxClass: 'icheckbox-blue',
						radioClass: 'iradio-blue',
						increaseArea: '20%'
					});
					
				});
			});
			
			//导航切换后的操作
			$(".tabBar span").click(function(){
				var index = $(this).index();
				if (index == 2) {
					$("#operatorBtn").hide();
				} else {
					$("#operatorBtn").show();
				}
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
			para:{controller:'Doctor',method:'query'},
			initSort : [[0, "asc"]],
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[6]},{sClass:'text-c',aTargets:[7]}
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
			            { data: 'pic',
			              render : function(value, type, row){
			            	  return '<img src="/upload/' + value + '" width="90px"/>';
			              }	
			            },
			            { data: 'department_name' },
			            { data: 'description',render:function(value){return value.substr(0,60)+'...';}},
			            { data: 'plushtime' },
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" target="_blank" href="/controller/?controller=ViewHtml&method=doctor&op=doctor&id='+id+'" title="预览"><i class="Hui-iconfont">&#xe695;</i></a>'; 
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gDoctor.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gDoctor.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
					    	  return str;
						  }
						 }
			        ]
		});
		
	}
	
	// }}}
	// {{{ function del()
	
	/**
	 * 单个删除
	 * */
	this.del = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Doctor',method:'del',id:id});
	}
	
	// }}}
	// {{{ function delBatch()
	
	/**
	 * 批量删除
	 * */
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Doctor',method:'del',id:ids});
		}	
	}

	// }}}
	// {{{ function edit()
	
	/**
	 * 动态编辑
	 * */
	this.edit = function(id){
		self.openEdit('编辑医生基本信息','edit.html?id=' + id);
	}
	
	// }}}
	// {{{ function save()
	
	/**
	 * 保存
	 * */
	this.save = function(){
		
		//var department_id = $('select[name="department_id"]').val()*1;
		//var layer_0       = $('#layer_0').val()*1;	
		//科室必须选择
		//if(department_id==0){layer.alert('请选择关联科室!');return false;}
		
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Doctor',method:'add'};
		} else {
			post = {controller:'Doctor',method:'edit',id:id};
		}

		var formObj=$('#formEdit').checkAndSubmit('save',post,function(ret){
			if(ret.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();
				
				
			}else{
				parent.layer.alert(ret.msg,{icon:2});
			}

		});
		if(!formObj.check('false','#seo_title')||!formObj.check('false','#seo_desc')||!formObj.check('false','#department_id')){				
			$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","1");
		}
		if(!formObj.check('false','#Docname')||!formObj.check('false','#pic')||!formObj.check('false','#Docposition')||!formObj.check('false','#Docspecialty')){				
			$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
		}
		$('#formEdit').submit();
	}
	
	// }}}
	// {{{ function fillPersonalExperience()
	
	/**
	 * 医生个人经历列表
	 * */
	this.fillPersonalExperience = function (doctor_id) {
		$("#dataTable").grid({
			para:{controller:'WorkHistory',method:'query',doctor_id:doctor_id},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[6]}
							],
			order:false,
			field : [
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
			            { data: 'company' },
			            { data: 'position' },
			            { data: 'begintime' },
			            { data: 'endtime' },
			            { data: 'remark',render:function(value){return value.substr(0,60)+'...';}},
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gDoctor.editExperience('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gDoctor.delExperience('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
					    	  return str;
						  }
						 }
			        ]
		});
	}
	
	// }}}
	// {{{ function addExperienct()
	
	/**
	 * 新增经历
	 * */
	this.addExperience = function() {
		var doctor_id = $("#id").val();
		if (doctor_id == '') {
			layer.confirm('请先完善前面的医生个人信息并保存后才能编辑此项',{icon: 2},function(index){
				//导航切换
				$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
				layer.close(index);
			});
			return false;
		}
		self.openAdd('编辑医生从医经历','experience.html?doctor_id=' + doctor_id,'700','420')
	}
	
	// }}}
    // {{{ function delExperience()
	
	/**
	 * 单个删除经历
	 * */
	this.delExperience = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'WorkHistory',method:'del',id:id});
	}
	
	// }}}
	// {{{ function delBatchExperience()
	
	/**
	 * 批量删除经历
	 * */
	this.delBatchExperience = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'WorkHistory',method:'del',id:ids});
		}
	}

	// }}}
	// {{{ function initExperience()
	
	/**
	 * 初始化编辑经历
	 * */
	this.initEditExperience = function() {
		$(function(){
			//获取参数
			var para = self.parseUrl(window.location.href);
			$("#doctor_id").val(para.doctor_id);
			if (para.id != undefined) {
				//有id，则是编辑
				self.cmd(gHttp,{controller:'WorkHistory',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
					}else{
						layer.alert(result1.msg,{icon: 2});
					}
				});
			}
			
			//保存
			$('#save').click(function(){
				self.saveExperience();
			});
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			
		});
	}
	
	// }}}
	// {{{ function editExperience()
	
	/**
	 * 动态编辑经历
	 * */
	this.editExperience = function(id){
		self.openEditWID('编辑医生从业经历','experience.html?id=' + id,'700','420');
	}
	
	// }}}
	// {{{ function saveExperience()
	
	/**
	 * 保存
	 * */
	this.saveExperience = function(){
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'WorkHistory',method:'add'};
		} else {
			post = {controller:'WorkHistory',method:'edit',id:id};
		}

		var formObj=$('#formEdit').checkAndSubmit('save',post,function(ret){
			if(ret.statu){
				var url=parent.location.href;				
				parent.layer.msg('操作成功!',{icon: 1});		
				parent.location.replace(url);	
				$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","2");
				layer_close();
				
			}else{
				layer.alert(ret.msg,{icon: 2});
			}

		});
		if(!formObj.check('false','#seo_title')||!formObj.check('false','#seo_desc')){			
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
		}
		if(!formObj.check('false','#Docname')||!formObj.check('false','#pic')||!formObj.check('false','#Docposition')||!formObj.check('false','#department_id')||!formObj.check('false','#Docspecialty')||!formObj.check('false','#editor')){			
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		}
		$('#formEdit').submit();
		
	}
	
	// }}}
}
