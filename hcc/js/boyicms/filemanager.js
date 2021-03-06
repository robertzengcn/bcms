/**
 * 文件管理
 * */
var Dir = '';
var tem = '';
function File() {
	BaseFunc.call(this);
	var self = this;
	
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){
			self.onloadCss();
			
			//self.getImgSize('newssize');
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.path != undefined) {
				//有id，则是编辑
				$("#id").val(para.path);
				self.cmd(gHttp,{controller:'FileManager',method:'edit',Dir:para.path,name:para.name},function(result1){
					if(result1.state){
						$('#name').html(result1.state.name);
						$('#content').val(result1.state.content);
						//var contentView = "<textarea name='content' style='width:99%;height:450px;background:#ffffff;'>"+result1.state.content+"</textarea>\r\n";
						//$('#content').html(contenview);
					}else{
					//	$('#message').message(result1.msg);
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
	
	
	
	/**
	 * 初始化列表
	 * */
	this.initList = function(Dir,tem) {
		Dir = Dir == undefined ? '' : Dir;
		$(function(){
			$.Huitab("#" +
					"tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			
			//默认pc端模板
			var tem = 'pc';
			self.filltable(tem,Dir);
			
			$(".tabBar span").click(function(){
				var index = $(this).index();
				switch(index) {
					case 0:
						var tem = 'pc';
						self.filltable(tem,Dir);
						break;
					case 1:
						var tem = 'wap';
						self.filltable(tem,Dir);
						break;
					case 2:
						var tem = 'app';
						self.filltable(tem,Dir);
						break;
					case 3:
						var tem = 'wechat';
						self.filltable(tem,Dir);
						break;
				}
			});
			
		});	
	}
	
	
	/**
	 * 加载数据表
	 * */
	this.filltable = function(tem,Dir) {
		var table = '';  
		if(tem == ''){
		    tem = $('#aaa .current').attr('value');
			table = '#'+tem;
		}else{
			table = '#'+tem;
		}
		$(table).grid({
			para:{controller:'FileManager',method:'getFile',tem:tem,Dir:Dir},
			bserverside:false,
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]}
							],
			field : [
			            
                        { data: 'name' ,
                          render:function(type,name,row){
                        	  var span = '';
                        	if(row.type == "dir"){
                        		span += "<img src='../images/boyicms/buttonbg/dir.gif' border=0 width=16 height=16 align=absmiddle />&nbsp;"+row.name;
                        	}else{
                        		span += "<img src='../images/boyicms/buttonbg/htm.gif' border=0 width=16 height=16 align=absmiddle />&nbsp;"+row.name;
                        	}
                        	return span;
                        }	
                        },
			            { data: 'size' ,
		            	  render:function(type,name,row){
                        	  var span = '';
                        	  if(row.type == "dir"){
                        		span += '';
                        	  }else{
                        		span += row.size +"　kb";
                        	  }
                        	return span;
                        }		
			            },
			            { data: 'plushtime'},
			           
			            {
						  data : 'name',
						  render : function(type,mame,row){
							  var str = '';
							  if(row.type == "dir"){
								  str += "<a style='text-decoration:none'  onClick=gFile.filltable('','"+row.pathway+"'); title='打开'><i class='Hui-iconfont'>&#xe695;</i></a>";
							  }else{
								  str += "<a style='text-decoration:none'  onClick=gFile.edit('"+row.pathway+"','"+row.name+"'); title='编辑'><i class='Hui-iconfont'>&#xe6df;</i></a>";
							  }
					    	  return str;
			            }
			            }
			        ]
		});
		
		//返回上级
		if(Dir == ''){
			$('#dirname').html("<i class='Hui-iconfont'>&#xe631;</i> 根&nbsp;目&nbsp;录");
		}else{
			$('#dirname').html("<i class='Hui-iconfont'>&#xe66b;</i> 返回上级");
		}
		$('#dirname').attr('value',Dir);
		
	}
	
	//动态编辑
	this.edit = function(path,name){
		self.openEditWID('编辑文件：'+name,'edit.html?path='+path+'&name='+name,800,500);
	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();    
		var content = $("#content").val();
		//$('#formEdit').checkAndSubmit('save',post,function(result1){
		self.cmd(gHttp,{controller : 'FileManager',method:'save',Dir:id,'content':content}, function(result1){
			if(result1.dir !== 'error'){
				parent.gFile.filltable('',result1.dir);
				parent.layer.msg('操作成功!',{icon:1});	
				layer_close();
			}else{
				parent.layer.alert(result1.dir,{icon:2});
			}
			return false;
		});
	}
	
	//返回上级
	$('#dirname').click(function(){	
		Dir = $('#dirname').attr('value');
		if(Dir !== ''){
			self.cmd(gHttp,{controller : 'FileManager',method : 'lastdir',Dir : Dir}, function(result) {
	    		if (result.lastdir == 'none') {
	    			$('#dirname').html("<i class='Hui-iconfont'>&#xe631;</i> 根&nbsp;目&nbsp;录");
	    		}else if(result.lastdir == 'last'){
	    			self.filltable('',result.dir);
	    			$('#dirname').html("<i class='Hui-iconfont'>&#xe631;</i> 根&nbsp;目&nbsp;录");
	    		}else{
	    			self.filltable('',result.dir);
	    			$('#dirname').html("<i class='Hui-iconfont'>&#xe6dc;</i> 返回上级");
	    		}
	    	});
		}
		
	});
		
}
