/**
 * H5秀场
 * */

function H5() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initList()
	
    var SHOW_URL = "http://"+window.location.host+"/addons/show.php";
   var CONTROLLER_URL = "http://"+window.location.host+"/controller/";
  var PREFIX_HOST = "http://"+window.location.host+"/";
   var PREFIX_FILE_HOST = "http://"+window.location.host+'/upload/';	
	/**
	 * 初始化列表
	 * */
	this.initList = function() {
		$(function(){
		
			//table加载数据
			self.fillDataShow();

			 $(".cover").hover(function () {
				$(this).addClass("cshow");
			},function () {
				$(this).removeClass("cshow");
			});
			
		});
	}
		/**
	 * 初始化列表
	 * */
	this.initDataList = function() {
		$(function(){
			//table加载数据
			self.fillDataTable();
			
			//查询
			$("#qry").click(function(){
				self.fillDataTable();
			});

		});
	}
	
	//qrcode
	this.showurl = function(url){
		$('#output').html('');
		$('#output').qrcode({
			render: "canvas",
		    width: 220,
		    height:220,
		    text: url
		});
		$("#voteurl").val(url);
		$('#urlModal').modal('show');
	}
	
	this.fillDataTable = function(){
		$("#dataTable").grid({
			para:{controller:'Show',method:'queryShare'},
			aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
							],
			field : [
			            {
			            	data : 'scene_id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
                        { data: 'id' },
			            { data: 'name' },
			            { data: 'show_count' },
			            { data: 'share_count' },
			            {
						  data : 'scene_id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" href="/hcc/h5/detail.html?sceneid='+id+'" title="详情"><i class="Hui-iconfont">&#xe695;</i></a>&nbsp;&nbsp;';
							  str += '<a style="text-decoration:none" onclick=\"gH5.showurl(\''+SHOW_URL+'?method=preview&id='+id+'\');\" href=\"javascript:;\" title="链接"><i class="Hui-iconfont">&#xe6df;</i></a>';
					    	  return str;
						  }
						 }
			        ]
		});		
	}
/**
 * 详情
 * */	
this.initDetail = function(){
	var para = self.parseUrl(window.location.href);	
		if (para.sceneid != undefined) {
			self.cmd(gHttp,{controller:'Show',method:'getDetail',sceneid:para.sceneid},function(result){
				if(result.success == true){
					$('.mysite img').attr("src",'/upload/'+result.obj.thumb_img);
					$('.mysite .sitename').text(result.obj.name);
					$('.mysite .link').html('场景链接：<a target="_blank" href="'+result.obj.link+'">'+result.obj.link +'</a>');
					$('.summeryNum').text(result.obj.show_count);
					$('.mysite .showcount').text(result.obj.show_count);
					$("#timeline").val(result.obj.timeline);
					$("#appmessage").val(result.obj.appmessage);
					$("#qq").val(result.obj.qq);
					$("#qzone").val(result.obj.qzone);
					$("#weibo").val(result.obj.weibo);
					$("#other").val(result.obj.other);
				}
			})	
		}
}
//加载数据表
	this.fillDataShow = function() {
			self.cmd(gHttp,{controller:'Show',method:'query'},function(result){
				if(result.statu){		
							$('.col-md-12').empty(); 
							var html = '';
							$.each(result.data,function(i,n){
									html +='<div class=\"h5\" id="scene_'+n.id+'">';
								    html +='<div class=\"cover\">';
									html +='<img src=\"'+PREFIX_FILE_HOST + n.thumbnail_varchar+'\" width=\"200\" height=\"200\">';
									html +='<div class=\"choice\">';
						            html +='<a class=\"cbtn cbtn1\" href=\"'+SHOW_URL+'?method=preview&id='+n.id+'\" target=\"_blank\">预览</a>';
						            html +='<a class=\"cbtn cbtn2\" href=\"'+SHOW_URL+'/#/scene/create/'+n.id+'?pageId=1" target=\"_blank\">编辑</a>';
						            html +='<a class=\"cbtn cbtn3\" onClick=\"gH5.edit('+n.id+');\" href=\"javascript:;\">设置</a>'; 
						            html +='</div>';
									html +='</div>';
									html +='<div class=\"bottom\">';
									html +='<p class=\"pull-left\">'+n.scenename_varchar+'</p>';
									html +='<p class=\"pull-right\"><a href=\"'+SHOW_URL+'/#/scene/create/'+n.id+'?pageId=1" target=\"_blank\"><i class=\"glyphicon glyphicon-edit\"></i> 编辑</a></p>';
									html +='<div class=\"clearfix\"></div>';
									html +='</div>';
									html +='<div class=\"bottom2\">';
									html +='<p>';
									html +='<a href=\"'+SHOW_URL+'?method=preview&id='+n.id+'\" target=\"_blank\">查看</a>';
									html +='<a href="/hcc/h5/detail.html?sceneid='+n.id+'" href=\"javascript:;\">数据</a>';
									html +='<a href=\"javascript:;\" onclick=\"gH5.copyScene('+n.id+')\">复制</a>';
									html +='<a href=\"javascript:;\" onclick=\"gH5.delScene('+n.id+')\">删除</a>';
									html +='</p>';
									html +='</div>';
									html +='</div>';
							});
							$('.col-md-12').append(html);
							$('.col-md-12').append('<div class=\"clearfix\"></div><div class=\"page\"><div></div></div>');
				}else{
						$('.col-md-12').empty(); 					
				}
			});
	}
	/**
	 * 删除
	 * */	
  this.delScene = function (Id) {
		layer.confirm('是否删除产品！\r\n删除后数据不可恢复，请谨慎操作！', {
		  icon: 3, title:'提醒',	
		  btn: ['确定', '取消'] 
		  ,
		}, function(index, layero){
			self.cmd(gHttp,{controller:'Show',method:'delScene',Id:Id},function(result){
				if (result.success == true) {
					layer.msg('删除成功',{icon:1});
					$('#scene_'+Id).remove();
					layer.close(index);
				} else {
					layer.msg('删除失败',{icon:2});
				}
			});
			  
		}, function(index){
			  layer.close(index);
		});	
    }
	/**
	 * 复制
	 * */
    this.copyScene = function (SceneId) {
		self.cmd(gHttp,{controller:'Show',method:'copyScene',id:SceneId},function(result){
			if(result.success == true){
					gH5.initList();
					layer.msg('复制场景成功!',{icon:1});
			}else{
				 layer.msg("复制场景失败");				
			}
		})
    }	
	/**
	 * 创建
	 * */
	this.newCreate = function(){
		self.cmd(gHttp,{controller:'Show',method:'typeList'},function(result){
			if(result.success == true){
				$.each(result.list,function(i,n){
					var selected = (i==0) ? ' selected="selected"' : '';
					$("#type").append('<option value="'+n.value+'"'+selected+'>'+n.name+'</option>');
				})
			}		
		});			
	}
	/**
	 * 公众号配置
	 * */
	this.initConfig = function(){
		self.cmd(gHttp,{controller:'Show',method:'getConfig'},function(result){
			if(result.success == true){
				$('#appid').val(result.obj.web_appid);
				$('#appsecret').val(result.obj.web_appsecret);
			}		
		});			
	}
	/**
	 * 公众号修改
	 * */
	this.saveConfig = function(){
		var appid = $('#appid').val();
		var appsecret = $('#appsecret').val();

		if(appid.length != 18){
			layer.msg("请输入正确的AppID",{icon:2});
			return false;			
		}
		if(appsecret.length != 32){
			layer.msg("请输入正确的AppSecret",{icon:2});
			return false;			
		}
		self.cmd(gHttp,{controller:'Show',method:'saveConfig',appid:appid,appsecret:appsecret},function(result){
			if(result.success == true){
					parent.layer.msg('配置成功',{icon:1});
					self.layer_close();
			}else{
					layer.msg('配置失败请联系管理员~',{icon:2});
			}		
		});		
	}
	/*关闭弹出框口*/
	 this.layer_close = function(){
		var index = parent.layer.getFrameIndex(window.name);
		parent.layer.close(index);
	}
	/**
	 * 保存
	 * */
	this.saveScene = function(){
		var name = $('#name').val();
		if(!name){
			layer.msg("请输入场景名称",{icon:2});
			return false;
		}else{
			var type = $('#type').val();
			post = {controller:'Show',method:'addScene',name:name,type:type};
			self.cmd(gHttp,post,function(result){
				if(result.success){
					parent.gH5.initList();
					parent.layer.msg('操作成功!',{icon:1});
					self.layer_close();
				}else{
					layer.msg(result.msg,{icon:2});
				}
			});
		}
	}
	/**
	 * 编辑
	 * */
	this.edit = function(id){
		self.open_newindows('设置封面信息','h5/show-edit.html?sceneid=' + id,'750','480');
	}
/*textarea 字数限制*/
	this.textarealength = function (obj,maxlength){
	var v = $(obj).val();
	var l = v.length;
	if( l > maxlength){
		v = v.substring(0,maxlength);
	}
	$(obj).parent().find(".textarea-length").text(v.length);
}	
	/**
	 * 打开新窗口
	 * */
	this.open_newindows = function(title,url,w,h){	
		parent.layer.open({
			type: 2,
			area: [w+'px', h +'px'],
			fix: false, //不固定
			maxmin: true,
			shade:0.4,
			title: title,
			content: url,
			success:function(layero,index){
				parent.layer.setTop(layero);
			}
		});
//		layer.full(index);
	}
	
	/*弹出层*/
	this.layer_show = function(title,url,w,h){
		if (title == null || title == '') {
			title=false;
		};
		if (url == null || url == '') {
			url="404.html";
		};
		if (w == null || w == '') {
			w=800;
		};
		if (h == null || h == '') {
			h=($(window).height() - 50);
		};
		layer.open({
			type: 2,
			area: [w+'px', h +'px'],
			fix: false, //不固定
			maxmin: true,
			shade:0.4,
			title: title,
			content: url
		});
	}
	/**
	 * 初始化编辑 scenename_varchar thumbnail_varchar desc_varchar  movietype_int
	 * */
	this.initEdit = function() {
			//获取参数
		var para = self.parseUrl(window.location.href);	
			if (para.sceneid != undefined) {
				$("#sceneid").val(para.sceneid);				
				self.cmd(gHttp,{controller:'Show',method:'getSceneSet',sceneid:para.sceneid},function(result){
					if(result.success == true){	
						if(result.obj.thumbnail_varchar != ''){
							$('#thumbnail').attr('src', '/upload/' + result.obj.thumbnail_varchar);
							$('#pic').val(result.obj.thumbnail_varchar);							
						}
						$('#name').val(result.obj.scenename_varchar);
						$('#scenedesc').val(result.obj.desc_varchar);						
						if(result.obj.movietype_int!=''){
							$('#movietype').children("option").each(function(){  
					               var dotemp_value = $(this).val();
					              if(dotemp_value == result.obj.movietype_int){					            	 
					                    $(this).attr("selected","selected");  
					              }  
					              
					         });
						}
					}
				});
			}
	}
	/**
	 * 保存设置
	 * */
	this.saveSet = function() {
		var sceneid = $("#sceneid").val();
		var name = $("#name").val();
		var thumbnail = $("#thumbnail").attr("src");
		var pic = $("#pic").val();
		var desc = $("#scenedesc").val();
		var pagemode = $("#movietype").val();
		if(name==''){
			layer.msg("请输入场景名称",{icon:2});
			return false;			
		}
		if(thumbnail =='../images/boyicms/logo/thumbnail_auto.gif'){
			layer.msg("请上传封面图片",{icon:2});
			return false;			
		}
		if(desc ==''){
			layer.msg("请输入分享描述",{icon:2});
			return false;			
		}
		self.cmd(gHttp,{controller:'Show',method:'saveSettings',sceneid:sceneid,name:name,pic:pic,desc:desc,pagemode:pagemode},function(result){
			if(result.success == true){
				gH5.initList();
				parent.layer.msg('操作成功!',{icon:1});	
				self.layer_close();						
			}else{
				layer.msg(result.msg,{icon:2});				
			}			
			
		})		
	}	 
}