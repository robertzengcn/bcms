/**
 * 更多功能-插件
 * */
function Plugin() {
	BaseFunc.call(this);
	var self = this;
	
	// {{{ function initList()
	
	/**
	 * 初始化列表
	 * */
	this.init = function() {
		$(function(){
			self.onloadCss();
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			//默认已安装
			self.getLocalPluginList();
			
			$(".tabBar span").click(function(){
				var index = $(this).index();
				switch(index) {
					case 0:
						//已安装
						self.getLocalPluginList();
						break;
					case 1:
						//在线下载
						self.getRemotePlugin();
						break;
					case 2:
						//URL下载
						break;
				}
			});
			$('#thenewmsg').on('click',function(){
				var msg=$(this).attr('info');
				layer.tips(msg, $(this), {
					tips: 3,
					time:3000
				});
			});
			
		});
	}
	
	// }}}

    // {{{ function getRemotePlugin()
	
	/**
	 * 在线插件
	 * */
	this.getRemotePlugin = function() {
		$("#remoteDataTable").grid({
			para:{controller:'Plugin',method:'getRemotePluginList'},
			//initSort : [[1, "asc"]],
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]},{sClass:'text-c',aTargets:[7]},{sClass:'text-c',aTargets:[8]}
							],
			field : [
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
                        { data: 'id' },
			            { data: 'pro_name' },
			            { data: 'description' },
			            { data: 'version' },
			            { data: 'is_free' ,render:function(value,rowData,rowIndex){return (value=='免费')?'<span class="label label-success radius">'+value+'</span>':'<span class="label label-default radius">'+value+'</span>';} },
			            { data: 'price' },
			            { data: 'update_time' },
			            {
						  data : 'id',
						  render : function(value, type, rowData){
							  var str ='<a id="'+rowData.view+'" data="'+value+'" class="button btn_view" href="javascript:void(0)"><i class="Hui-iconfont">&#xe695;</i></a>';
								switch(rowData.product_statu){
									case 1:
										str +='<a style="text-decoration:none" class="ml-5" info="您的版本己是最新版，无须更新" href="javascript:void(0)" id="thenewmsg"><i class="Hui-iconfont">&#xe6c4;</i></a>';
										break;
									case 2:
										str +='<a style="text-decoration:none" class="ml-5" onclick="gPlugin.update('+value+')" href="javascript:void(0)" title="更新"><i class="Hui-iconfont">&#xe6df;</i></a>';
										break;
									case 3:
										str +='<a style="text-decoration:none" class="ml-5" onclick="gPlugin.upgrade('+value+')" href="javascript:void(0)" title="升级"><i class="Hui-iconfont">&#xe61d;</i></a>';
										break;
									default:
										str +='<a style="text-decoration:none" class="ml-5" onclick="gPlugin.download('+value+')" href="javascript:void(0)" title="下载"><i class="Hui-iconfont">&#xe641;</i></a>';
										break;
								}
								return str;
								
						      }
						 }
			        ]
		});
		
	}
	
	// }}}
	// {{{ function update()
	
	/**
	 * 更新
	 * */
	this.update = function(id) {
		
	}
	
	
	// }}}
	// {{{ function upgrade()
	
	/**
	 * 升级
	 * */
	this.upgrade = function (id) {
		self.getRemoteProductAuth ( id , '升级');
	}
	
	// }}}
	// {{{ function download() 
	
	/**
	 * 下载
	 * */
	this.download = function (id) {
		self.getRemoteProductAuth ( id , '下载' );
	}
	
	// }}}
	// {{{ function getLocalPluginList()
	
	/**
	 * 已安装插件
	 * */
	this.getLocalPluginList = function() {
		$("#dataTable").grid({
			para:{controller:'Plugin',method:'getLocalPluginList'},
			initSort : [[1, "asc"]],
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[6]}
							],
			field : [
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
                        { data: 'id' },
			            { data: 'Name' },
			            { data: 'ByVersion' },
			            { data: 'Author' },
			            { data: 'Discription' },
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" onClick="gPlugin.goToUse('+id+');" href="javascript:;" title="开始使用"><i class="Hui-iconfont">&#xe63c;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gPlugin.uninstall('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
					    	  return str;
						  }
						 }
			        ]
		});
		
	}
	
	// }}}
	
	//卸载
	this.uninstall = function(id) {
		layer.confirm('确定要卸载该插件吗?',function(index){
			self.cmd(gHttp, {controller:'Plugin',method:'pluginUninstall',id:id},function(ret){
				if(ret.statu){
					layer.msg('恭喜你,插件卸载成功!');
					self.getLocalPluginList();
					layer.close(index);
				}else{
					layer.alert(ret.msg);
				}
			});
		});
	}

	//动态编辑
	this.goToUse = function(id){
		//'织梦数据同步','plugins/dedecopy/index.html'
		//'站群管理','plugins/webgroup/index.html'
		self.cmd(gHttp, {controller:'Plugin',method:'getLocalPluginById',id:id},function(ret){
			if(ret.statu){
				if(ret.data.HccinletHtml != ''){
					var htmlUrl = '/hcc/plugin/plugins/'+ret.data.ByName+'/'+ret.data.HccinletHtml + '.html';
					self.openEdit(ret.data.Name, htmlUrl);
				}
			}else{
				layer.alert(ret.msg);
			}
			return false;
		});
	}
	
	// {{{ function urlDownload()
	
	/**
	 * 链接下载
	 * */
	this.urlDownload = function() {
		var url = document.getElementById('demo-labs-input').value;
		if(url==''){
			$("#checkmsg").html('下载链接不能为空！').addClass('Validform_wrong');
			}
		else if(url.indexOf('www.boyicms.com')==-1){
			$("#checkmsg").html('链接错误，请输入正确的链接！').addClass('Validform_wrong');
			}
			else{
    			self.getRemoteProductAuthByUrl(url);
			}
	}
	
	// }}}
	
}
