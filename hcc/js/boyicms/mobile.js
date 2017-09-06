/**
 * 手机营销管理-手机网页
 * */
var uploader = null;
var maxsize='';
function Mobile() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function init()
	
	/**
	 * 初始化列表
	 * */
	this.init = function() {
		$(function(){
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			
			//默认本地模板
			self.getLocalTemplateList();
			
			$(".tabBar span").click(function(){
				var index = $(this).index();
				switch(index) {
					case 0:
						//本地模板
						self.getLocalTemplateList();
						break;
					case 1:
						//在线模板
						self.getRemoteTemplateList();
						break;
					case 2:
						//上传模板
						self.readPostMaxValue();
						self.initUploader();
						break;
				}
			});
			
		});
	}

	// }}}
	// {{{ function initUploader()
	
	/**
	 * 初始化上传插件
	 * */
	this.initUploader = function() {
		uploader = null;
		
		$(".btns").html('<div id="picker">上传模版</div>');
		
		uploader = WebUploader.create({
			auto:true,
			swf:'lib/webuploader/0.1.5/Uploader.swf',
			server:'/controller/?controller=Template&method=templateLocalUpload',
			pick:'#picker',
			fileVal: 'Filedata',
			fileSingleSizeLimit:maxsize*1024*1024,
			resize:false,
			accept: {
				title: '压缩包',
				extensions: 'zip',
				mimeTypes: 'application/*'
			}
		});
		
		$("#picker").unbind('click').bind('click',function(){
			$("#uploaderDiv").show();
	        $("#progressDiv").hide();
			self.uploadTemp();
		});
	}
	
	// }}}
	// {{{ function templateSwitch
	
	/**
	 * 模版切换操作
	 */
	this.templateSwitch = function ( used , acls ){
		if( $('#template_div_'+used+' a').eq(0).html() == '当前使用' ){
			layer.alert('当前正在使用该模版');return true;
		}
		
		layer.confirm('确定要使用该模版吗?', function(index) {
			self.cmd(gHttp,{controller:'Mobile',method:'templateSwitch',func:gFunc,used:used},function(result){
				switch(result.statu){
					case true:
						$("li[id^='template_div_']").each(function(){
							$(this).find("a").eq(0).html('使用');
							$(this).find("a").eq(0).css('color','#333');
						});
						
						$('#template_div_'+used+' a').eq(0).css('color','red');
						$('#template_div_'+used+' a').eq(0).html('当前使用');
						break;
					case false:
						layer.alert(result.msg);return true;
						break;
					default:
						break;
				}
				layer.close(index);
			});
		});
		
	}
	
	// }}}
	// {{{ function templateDelete
	
	/**
	 * 模版删除操作
	 */
	this.templateDelete = function ( used ) {
		layer.confirm('确定删除该模板吗？', {icon: 3, title:'提示'}, function(index) {
			self.cmd(gHttp,{controller:'Mobile',method:'templateDelete',func:gFunc,used:used},function(result){
				switch(result.statu){
					case true:
						$('#template_div_'+used).hide(1000,function(){
							$('#template_div_'+used).remove();
						});
						break;
					case false:
						layer.alert('删除失败：' + result.msg);
						break;
					default:
						break;
				}
				layer.close(index);
			});
		});
	}
	
	// }}}
	// {{{ function bindItemEvent()
	
	this.bindItemEvent = function() {
		$('li.item').on('mouseenter',function(){
			$(this).find('div.temp-title').stop().animate({height:"30px"});
		}).on('mouseleave', function() {
			$(this).find('div.temp-title').stop().animate({height:"0px"});
		});
	}
	
	// }}}
	// {{{ function getLocalTemplateList()
	
	/**
	 * 获取本地模版
	 */
	this.getLocalTemplateList = function (){
		var index = layer.msg('正在加载本地模版,请稍后...');
		self.cmd(gHttp,{controller:'Mobile',method:'getLocalTemplateList',func:gFunc},function(result){
			if(result.data){
				var len = result.data.length;
				var html = '';var cls = '';var acls = '';var atxt = '';
				for(var i = 0 ; i < len ; i++){
					switch(result.data[i].currentUsed){
						case 0:
							cls  = '';
							acls = '';
							atxt = '使用';
							break;
						case 1:
							cls  = 'style="color:red;"';
							acls = 'used';
							atxt = '当前使用';
							break;
					}
					
					html += '<li class="item" id="template_div_'+result.data[i].config.shorthand+'">';
					html += '<div class="Tdetial">';
					html += '<div class="temp-title text-l">'+ result.data[i].config.name +'</div>';							
					html += '<div class="picbox">';									
					html += '<img src="'+ result.data[i].face +'"/>';								
					html += '</div>';
					html += '<div class="bt-area">';
					html += '<a href="javascript:;" ' + cls + ' onclick="gMobile.templateSwitch(\''+result.data[i].config.shorthand+'\',\''+acls+'\');">' + atxt + '</a>&nbsp;|&nbsp;';
					html += '<a href="javascript:;" onclick="gMobile.templateDelete(\''+result.data[i].config.shorthand+'\');">删除</a>&nbsp;|&nbsp;';
					html += '<a href="javascript:;" onclick="gMobile.viewImg(\'图片预览\',\''+ result.data[i].face+'\');">预览</a>';
					html += '</div>';							
					html += '</div>';
					html += '</li>';
				}
				$('#template_unitBox').empty().append( html );
				self.bindItemEvent();
				layer.close(index);
			}
		});
	}
	
	// }}}
	// {{{ function getRemoteTemplateList()
	
	/**
	 * 获取在线模版
	 */
	this.getRemoteTemplateList = function (){
		var index = layer.msg('正在加载在线模版,请稍后...');
		self.cmd(gHttp,{controller:'Mobile',method:'getRemoteTemplateList',func:gFunc},function(result){
			if(result.data){
				var len = result.data.length;
				var html = '';var cls = '';var acls = '';var atxt = '';
				for(var i = 0 ; i < len ; i++){
					html += '<li class="item">';
					html += '<div class="Tdetial">';
					html += '<div class="temp-title text-l">'+result.data[i].pro_name+'</div>';								
					html += '<div class="picbox">';									
					html += '<img src="'+ result.data[i].cover +'"/>';								
					html += '</div>';
					html += '<div class="bt-area">';
					html += '<a href="javascript:;" onclick="gMobile.viewImg(\'图片预览\',\''+result.data[i].view+'\');">预览</a>&nbsp;|&nbsp;';
					html += '<a href="javascript:;" onclick="gMobile.getRemoteProductAuth('+result.data[i].id+',\'在线安装\',4,\'mobile\');">安装</a>&nbsp;|&nbsp;';
					html += '<a href="javascript:;" onclick="gMobile.getRemoteProductAuth('+result.data[i].id+',\'下载\',2);">下载</a>';
					html += '</div>';
					html += '</div>';
					html += '</li>';
					
				}
				$('#remote_unitBox').empty().append( html );
				self.bindItemEvent();
				layer.close(index);
			}
		});
	}
	
	// }}}
	// {{{ function templateLocalUpload()
	
	/**
	 * 模版安装包上传之后
	 * @param boolean
	 * @param zip
	 */
	this.templateLocalUpload = function (boolean,zip,msg){
		if(boolean){
			$('#template_upload_url').val( zip );
			$('#progressDiv').show(1500);
		}else{
			layer.alert(msg);
		}
	}
	
	// }}}
	// {{{ function templateZipInstall()
	
	/**
	 * 安装模版包
	 */
	this.templateZipInstall = function (){
		var url = $('#template_upload_url').val();
		if(url != ''){
			self.cmd(gHttp,{controller:'Mobile',method:'templateInstall',func:gFunc,zipFile:url},function(result){
				switch(result.statu){
					case true:
						$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
						//默认本地模板
						self.getLocalTemplateList();
						break;
					case false:
						layer.alert('安装失败：' + result.msg);
						break;
					default:
						break;
				}
				$('#progressDiv').hide(1500);
			});
		}
	}
	
	// }}}
	// {{{ function templateZipDelete()
	
	/**
	 * 上传了但不需要进行安装，所以进行删除临时存放包
	 */
	this.templateZipDelete = function (){
		var url = $('#template_upload_url').val();
		if(url != ''){
			self.cmd(gHttp,{controller:'Mobile',method:'templateZipDelete',func:gFunc,zipFile:url},function(result){
				switch(result.statu){
					case true:
						layer.alert('删除成功');
						$('#template_upload_url').val('');
						break;
					case false:
						layer.alert(result.msg);
						break;
					default:
						break;
				}
				$('#progressDiv').hide(1500);
			});
		}
	}
	
	// }}}
	// {{{ function readPostMaxValue()
	
	/**
	 * 读取最大post上传限制
	 */
	this.readPostMaxValue = function () {
		self.cmd(gHttp,{controller:'Template',method:'readPostMaxValue'},function(result){
			if(result.statu){
				$('#post_max_value').html(result.data);
				var size=result.data.length-1;
				maxsize=result.data.substring(0,size);
			}
		});
	}
	
	// }}}
	// {{{ function uploadTemp()
	
	/**
	 * 上传模版
	 * */
	this.uploadTemp = function() {
		// 文件上传过程中创建进度条实时显示。
		uploader.on( 'uploadProgress', function( file, percentage ) {
		   layer.msg('正在努力上传，请等待...', {icon: 16});		   
		    uploader.on( 'uploadSuccess', function( file, response ) {												   
		        //$( '#'+file.id ).find('p.state').text('已上传');
				if(response.statu){
					self.templateLocalUpload(true,response.data.zip);
				}else{
					self.templateLocalUpload(false,'',response.msg);
				}
		    });

		    uploader.on( 'uploadError', function( file ) {
		        layer.alert('当前网络状况不佳，上传失败，请重试',{icon:2}); 
		    });

		    uploader.on( 'uploadComplete', function( file ) {
		        layer.msg('安装包上传成功!');
		    });
		});
		uploader.on( 'error', function(type) {
			 if (type=="Q_TYPE_DENIED"){
		        layer.alert('请上传正确的模板包，模板包必须是zip格式',{icon:2});
		     }else if(type=="F_EXCEED_SIZE"){
		    	 layer.alert('上传文件大小超过了PHP的限制：'+maxsize+'M，请参考上面的规则最后一条修改php.ini配置文件',{icon:2});
		     }

			});
		
	}
	
	// }}}
	
	/*************************以下是单图管理***************************/
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
	 * 初始化单张图片编辑
	 * */
	this.initEdit = function() {
		$(function(){
			self.onloadCss();
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				//有id，则是编辑
				$("#id").val(para.id);
				
				self.cmd(gHttp,{controller:'MobilePicManager',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						$('#hurl').val(result1.data.link);
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);
							picflag = result1.data.flag;
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			}
			
			//初始化科室链接数据
			$("#htmlUrl").bindMobileDepartment(type);			
			
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
					self.cmd(gHttp,{controller:'MobileNavigation',method:'getHtmlUrlByPara',op:'departments',func:type},function(result1){
						if(result1.statu){
							var isDisease = '';							
							isDisease = 'onChange="gMobile.setChildUrl(this);getDepartSubTree(this.value,\' \',\''+type+'\',\'hurl_link\',\'link_box\',\'childDiseaseDiv\')"';
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
						var str='<select class="select" name="channelList" onChange="mobileChannel(this.value,\''+type+'\')" id="channelList">';
						str += '<option value="">&nbsp;请选择&nbsp;</option>';
						for (var i=0;i<result1.rows.length;i++){
							str +='<option value="'+result1.rows[i].id+'">'+result1.rows[i].name+'</option>';
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
			
			//链接方式切换
			$('input[name="radio_link"]').click(function(){
				$(this).attr('checked',true);
				var value=$("#hurl_link").val();
				if($(this).val()==1){
					$("#hurl").val(value);						
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
			
			//hurl 改变时把值写入hurl_link
			$('input#hurl').change(function(){
				$('input#hurl_link').val($(this).val());								
			});
			
			//链接提示
			$('#link_box').on('mouseenter',function(){
				var msg=$(this).attr('info');
				layer.tips(msg, $(this), {
					tips: [3, '#78BA32'],
					area: ['500px', 'auto'],
					time:9000
				});											  
														  
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
		if (gKind == 1) {
			//单张图片管理 kind=1
			var columns = [
					            {
					            	data : 'id',
					            	render : function (id, type, row) {
					            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
					            	}
					            },
	                            { data: 'id' },
					            { data: 'name' },
					            { data: 'flag',},
					            { data: 'img',render : function(value, type, row){
									  return '<img src="/upload/' + value + '" width="300px" height="80px"/>';
								  }	},
					            { data: 'link' },
					            {
								  data : 'id',
								  render : function(id, type, row){
									  var str = '';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.wdedit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
							    	  return str;
								  }
								 }
					        ];
			$("#dataTable").grid({
				para:{controller:'MobilePicManager',method:'query',kind:gKind,cate:gCate},
				
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[6]}
								],
				field : columns
			});
		} else {
			//轮播图管理 kind=2
			var columns = [
					            {
					            	data : 'id',
					            	render : function (id, type, row) {
					            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
					            	}
					            },
	                            { data: 'id' },
					            { data: 'name' },
					            { data: 'flag',},
					            {
								  data : 'id',
								  render : function(id, type, row){
									  var str = '';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.wdscedit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.detail('+id+');" href="javascript:;" title="查看详细"><i class="Hui-iconfont">&#xe613;</i></a>';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
							    	  return str;
								  }
								 }
					        ];
			$("#dataTable").grid({
				para:{controller:'MobilePicManager',method:'query',kind:gKind,cate:gCate},
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]}
					],
				field : columns
			});
		}
	}
	
	// }}}
	
	//单个删除
	this.del = function(id) {
		var obj=$("#dataTable").dataTable();
		console.log(id);
		self.openDel(obj,{controller:'MobilePicManager',method:'del',id:id,kind:2});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'MobilePicManager',method:'del',id:ids,kind:2});
		}
	}

	//编辑单张图
	this.wdedit = function(id){
		self.openEditWID('编辑单张图片', 'pic-edit.html?id=' + id,'740','500');
	}
	
	//编辑轮播图
	this.wdscedit = function(id){
		self.openEditWID('编辑轮播组', 'pic-scroll-edit.html?id=' + id,'540','224');
	}
	//查看轮播详细
	this.detail = function(id) {
		self.openAdd('本轮播组图片列表','scroll-pic.html?pid=' + id);
	}
	
	//保存单张图片
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'MobilePicManager',method:'add'};
		} else {
			post = {controller:'MobilePicManager',method:'edit',id:id};
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
		$('#formEdit').Validform().unignore('#pic');
		var linkType = $("input[name='radio_link']:checked").val();
		if (linkType == '1') {
			obj.ignore('#link_box');			
		} else {
			obj.ignore('#hurl');
		}
		$('#formEdit').submit();
	}
	
	/**********************轮播组图片管理**************************/
    // {{{ function initScollList()
	
	/**
	 * 初始化轮播组列表
	 * */
	this.initScollList = function() {
		$(function(){
			//获取参数
			var para = self.parseUrl(window.location.href);
			//table加载数据
			self.fillScollDataTable(para);
		});
	}
	
	// }}}
    // {{{ function fillScollDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillScollDataTable = function(para) {
		if (para.pid == undefined) {
			var data = {controller:'Pic',method:'query'};
		} else {
			var data = {controller:'Pic',method:'query',pid:para.pid};
		}
		var columns = [
				            {
				            	data : 'id',
				            	render : function (id, type, row) {
				            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
				            	}
				            },
	                        { data: 'id' },
				            { data: 'pic' , render : function(value, type, row){return '<img src="'+value+'" width="300px" height="80px"/>';}},
				            { data: 'url' },
				            {
							  data : 'id',
							  render : function(id, type, row){
								  var str = '';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.editScroll('+id+', '+row.pid+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.delScroll('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						    	  return str;
							  }
							 }
				        ];
		
		$("#dataTable").grid({
			para:data,
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			initSort:[[0, "desc"]],
			field : columns
		});
		
	}
	
	// }}}
	
	//单个删除
	this.delScroll = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Pic',method:'del',id:id});
	}
	
	//批量删除
	this.delScrollBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Pic',method:'del',id:ids});
		}
	}

	//动态编辑
	this.editScroll = function(id,pid){
		self.openEditWID('编辑轮播组图片信息', 'scroll-pic-edit.html?pid='+pid+'&id=' + id,'740','500');
	}
	
	/**为轮播组新增图片**/
	this.Addnewpic=function(url){
		var para = self.parseUrl(window.location.href);
		self.openEditWID('新增图片', url+'?pid='+para.pid,'740','460');
		};
	
	// {{{ function initScollEdit()
	/**
	 * 初始化轮播编辑
	 * */
	this.initScollEdit = function() {
		$(function(){
			self.onloadCss();
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.pid != undefined)$("#pid").val(para.pid);
			if (para.id != undefined) {
				//有id，则是编辑
				self.cmd(gHttp,{controller:'Pic',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);
							picflag = result1.data.flag;
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			}
			
			//链接方式切换
			$('input[name="radio_link"]').click(function(){
				$(this).attr('checked',true);
				var value=$("#hurl_link").val();				
				if($(this).val()==1){
					//alert(value);
					$("#hurl").val(value);						
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
			
			//链接提示
			$('#link_box').on('mouseenter',function(){
				var msg=$(this).attr('info');
				layer.tips(msg, $(this), {
					tips: [3, '#78BA32'],
					area: ['500px', 'auto'],
					time:9000
				});											  
														  
			});
			
			//保存
			$('#save').click(function(){
				self.saveScroll();
			});
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			//初始化科室链接数据
			$("#htmlUrl").bindMobileDepartment(type);
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
					self.cmd(gHttp,{controller:'MobileNavigation',method:'getHtmlUrlByPara',op:'departments',func:type},function(result1){
						if(result1.statu){
							var isDisease = '';							
							isDisease = 'onChange="gMobile.setChildUrl(this);getDepartSubTree(this.value,\' \',\''+type+'\',\'hurl_link\',\'link_box\',\'childDiseaseDiv\')"';
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
						var str='<select class="select" name="channelList" onChange="mobileChannel(this.value,\''+type+'\')" id="channelList">';
						str += '<option value="">&nbsp;请选择&nbsp;</option>';
						for (var i=0;i<result1.rows.length;i++){
							str +='<option value="'+result1.rows[i].id+'">'+result1.rows[i].name+'</option>';
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
		});
		
	}
	
	// }}}
	// {{{ function saveScroll()
	
	/**
	 * 保存轮播图
	 * */
	this.saveScroll = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Pic',method:'add'};
		} else {
			post = {controller:'Pic',method:'edit',id:id};
		}
		var obj=$('#formEdit').checkAndSubmit('save', post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();
				
			}else{
				parent.layer.alert(result1.msg,{icon: 2});
			}
		});
		$('#formEdit').Validform().unignore('#link_box');
		$('#formEdit').Validform().unignore('#hurl');
		$('#formEdit').Validform().unignore('#pic');
		var linkType = $("input[name='radio_link']:checked").val();
		if (linkType == '1') {
			obj.ignore('#link_box');			
		} else {
			obj.ignore('#hurl');
		}
		$('#formEdit').submit();
	}
	
	// }}}
	
	/***************************导航管理****************************/
// {{{ function initNavList()
	
	/**
	 * 初始化列表
	 * */
	this.initNavList = function() {
		$(function(){
			//table加载数据
			self.fillNavDataTable();
			
			//查询
			$("#qry").click(function(){
				self.fillNavDataTable();
			});
		});
	}
	
	// }}}
	// {{{ function initNavEdit()
	/**
	 * 初始化编辑
	 * */
	this.initNavEdit = function() {
		$(function(){
			self.onloadCss();
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.cate != undefined) {$("#cate").val(para.cate)}
			if (para.group_id != undefined) {$("#group_id").val(para.group_id)}
			if (para.id != undefined) {
				//有id，则是编辑
				self.cmd(gHttp,{controller:'MobileNavigation',method:'get',id:para.id},function(result1){
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
			
			//初始化导航父级
			$("#apid").bindApid(para.cate, 'MobileNavigation');
			
			//初始化科室链接数据
			$("#htmlUrl").bindMobileDepartment(type);	
			
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
					self.cmd(gHttp,{controller:'MobileNavigation',method:'getHtmlUrlByPara',op:'departments',func:type},function(result1){
						if(result1.statu){
							var isDisease = '';							
							isDisease = 'onChange="gMobile.setChildUrl(this);getDepartSubTree(this.value,\' \',\''+type+'\',\'hurl_link\',\'link_box\',\'childDiseaseDiv\')"';
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
						var str='<select class="select" name="channelList" onChange="mobileChannel(this.value,\''+type+'\')" id="channelList">';
						str += '<option value="">&nbsp;请选择&nbsp;</option>';
						for (var i=0;i<result1.rows.length;i++){
							str +='<option value="'+result1.rows[i].id+'">'+result1.rows[i].name+'</option>';
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
					$("#hurl").val(value);						
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
				self.saveNav();
			});
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			
		});
	}
	
	// }}}
	// {{{ function fillNavDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillNavDataTable = function() {
		//获取参数
		var para = self.parseUrl(window.location.href);
		if (para.group_id == undefined) {
			var data = {controller:'MobileNavigation',method:'queryGroup',is_group:1,cate:gCate};
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
					              str += '<a style="text-decoration:none"  onClick="gMobile.navEdit('+id+','+gCate+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.navDetail('+id+','+gCate+');" href="javascript:;" title="查看详细"><i class="Hui-iconfont">&#xe681;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.delNavGroup('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						    	  return str;
							  }
							 }
				        ];
			$("#dataTable").grid({
				para:data,
				aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
							],
				initSort : [[0, "desc"]],
				field : columns
			});
		} else {
			gGroupId = para.group_id;
			var data = {controller:'MobileNavigation',method:'getGroup',is_group:0,group_id:para.group_id,cate:gCate};
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
					              str += '<a style="text-decoration:none" onClick="gMobile.navInfoEdit('+id+','+gCate+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gMobile.delNav('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						    	  return str;
							  }
							 }
				        ];
			$("#dataTable").grid({
				para:data,
				aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}
							],
				initSort : [[0, "desc"]],
				field : columns
			});
		}		
	}
	
	// }}}
	
	//去新增导航
	this.toAddNav = function(type) {
		switch(type){
			case 1:self.openAdd('新增导航信息','mobilenav-detail.html?group_id=' + gGroupId,'740','560');break;
			case 2:self.openAdd('新增导航信息','apknav-detial.html?group_id=' + gGroupId,'740','560');break;
			case 3:self.openAdd('新增导航信息','wechatnav-detial.html?group_id=' + gGroupId,'740','560');break;
			
			}
		
		
	}
	
	//单个删除普通导航
	this.delNav = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'MobileNavigation',method:'delete',id:id});
	}
	
	//批量删除普通导航
	this.delNavBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'MobileNavigation',method:'delete',id:ids});
		}
	}
	
	//单个删除导航组
	this.delNavGroup = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'MobileNavigation',method:'delGroup',id:id});
	}
	
	//批量删除导航组
	this.delNavGroupBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'MobileNavigation',method:'delGroup',id:ids});
		}
	}

	//动态编辑
	//1是手机网页mobile  2是安卓应用APK  3是微站WECHAT  
	this.navEdit = function(id,gcate){	
		switch(gcate){
			case 1:self.openEditWID('编辑自定义导航组信息', 'mobile-nav.html?id=' + id,'560','302');break;
			case 2:self.openEditWID('编辑自定义导航组信息', 'apk-nav.html?id=' + id,'560','302');break;
			case 3:self.openEditWID('编辑自定义导航组信息', 'wechat-nav.html?id=' + id,'560','302');break;
			}
	}
	this.navInfoEdit = function(id,gcate){	
		switch(gcate){
			case 1:self.openEditWID('编辑导航信息', 'mobilenav-detail.html?id=' + id,'740','480');break;
			case 2:self.openEditWID('编辑导航信息', 'apknav-detial.html?id=' + id,'740','480');break;
			case 3:self.openEditWID('编辑导航信息', 'wechatnav-detial.html?id=' + id,'740','480');break;
			}
	}
	//查看详细
	this.navDetail = function(id,gcate){
		switch(gcate){
			case 1:self.openAdd('本导航组详细列表','mobilenav-list.html?group_id='+id);break;
			case 2:self.openAdd('本导航组详细列表','apknav-list.html?group_id='+id);break;
			case 3:self.openAdd('本导航组详细列表','wechatnav-list.html?group_id='+id);break;
			}
		
	}
	
	// {{{ function saveNav()
	
	/**
	 * 保存
	 * */
	this.saveNav = function(){		
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'MobileNavigation',method:'save'};
		} else {
			post = {controller:'MobileNavigation',method:'edit',id:id};
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
		$('#formEdit').Validform().unignore('#pic');
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
