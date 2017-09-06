/**
 * 全站模板管理
 * */
var uploader = null;
var maxsize='';
function Template() {
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
			auto:true,//有文件选择后
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
			self.cmd(gHttp,{controller:'Template',method:'templateSwitch',used:used},function(result){
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
			self.cmd(gHttp,{controller:'Template',method:'templateDelete',used:used},function(result){
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
		self.cmd(gHttp,{controller:'Template',method:'getLocalTemplateList'},function(result){
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
					
					html += '<li class="item" id="template_div_'+result.data[i].config.Shorthand+'">';
					html += '<div class="Tdetial">';
					html += '<div class="temp-title text-l">'+ result.data[i].config.Name +'</div>';							
					html += '<div class="picbox">';									
					html += '<img src="'+ result.data[i].config.Face +'"/>';								
					html += '</div>';
					html += '<div class="bt-area">';
					html += '<a href="javascript:;" ' + cls + ' onclick="gTemplate.templateSwitch(\''+result.data[i].config.Shorthand+'\',\''+acls+'\');">' + atxt + '</a>&nbsp;|&nbsp;';
					html += '<a href="javascript:;" onclick="gTemplate.templateDelete(\''+result.data[i].config.Shorthand+'\');">删除</a>&nbsp;|&nbsp;';
					html += '<a href="javascript:;" onclick="gTemplate.viewImg(\'图片预览\',\''+ result.data[i].config.Screenshot+'\');">预览</a>';
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
		self.cmd(gHttp,{controller:'Template',method:'getRemoteTemplateList'},function(result){
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
					html += '<a href="javascript:;" onclick="gTemplate.viewImg(\'图片预览\',\''+result.data[i].view+'\');">预览</a>&nbsp;|&nbsp;';
					html += '<a href="javascript:;" onclick="gTemplate.getRemoteProductAuth('+result.data[i].id+',\'在线安装\',4);">安装</a>&nbsp;|&nbsp;';
					html += '<a href="javascript:;" onclick="gTemplate.getRemoteProductAuth('+result.data[i].id+',\'下载\',2);">下载</a>';
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
			self.cmd(gHttp,{controller:'Template',method:'templateInstall',zipFile:url},function(result){
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
			self.cmd(gHttp,{controller:'Template',method:'templateZipDelete',zipFile:url},function(result){
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
	
	
}
