var gHttp = '/controller/';
function BaseFunc() {
	
	/**
     * this对象在外部的名字
     *
     * @field
     * @type String
     */
    this.__thisName = "this";
    
    var self = this;
    
    this.product_id = 0;//产品id
    
    this.sync = false;
    
	// {{{ function setThisName

    /**
     * 设置this对象在外部的名字
     *
     * @param {String} thisName 名字
     *
     * @returns {Void}
     */
    this.setThisName = function (thisName) {
        this.__thisName = thisName;
    }

    // }}}
    // {{{ 
    
    /**
     * 判断是否登录
     * */
    this.isLogin = function(){
    	self.cmd(gHttp,{controller : 'Login',method : 'isLogin'}, function(result) {
    		if (!result.statu || result.data.group != 1) {
    			top.window.location.href = '/hcc/login.html';
    		} else {
    			top.window.location.href = '/hcc/main.html';
    		}
    	});
    }
    // }}}
    // {{{ function cmd()
    
    /**
     * 获取请求数据
     * */
	this.cmd = function(http,para,fun) {
		$.ajax({
			url : http,
			data : para,
			cache : false,
			type : 'post',
			dataType : 'json',
			async : self.sync,
			error : function(obj,error){
				//alert('error!');
			},
			success : function(result){
				if(result != null && result.code != undefined && result.code==25){
					top.window.location.href = '/hcc/login.html';
					return false;
				}
				fun(result);
			}
		});
	}
	
	// }}}
    // {{{ function createHtml()
    
    /**
     * 获取请求数据
     * */
	this.createHtml = function(http,para,fun) {
		$.ajax({
			url : http,
			data : para,
			cache : true,
			type : 'post',
			dataType : 'json',
			error : function(obj,error){
				alert('error!');
			},
			success : function(result){
				if(result != null && result.code != undefined && result.code==25){
					top.window.location.href = '/hcc/login.html';
					return false;
				}
				fun(result);
			}
		});
	}
	
	// }}}
	
	// {{{ function formatTimeToStr()
	
	/**
	 * 将时间撮转换成时间串
	 * */
	this.formatTimeToStr = function(timestamp, isAll) {
		var timestamp = new Date(parseInt(timestamp)*1000);
		var year = timestamp.getFullYear();
		var month = timestamp.getMonth() + 1;
		var day = timestamp.getDate();
		var hour = timestamp.getHours();
		var minute = timestamp.getMinutes();
		var second = timestamp.getSeconds();
		
		month = parseInt(month)<10 ? ('0'+ month) : month; 
		day = parseInt(day)<10 ? ('0'+ day) : day;
		minute = parseInt(minute)<10 ? ('0'+ minute) : minute;
		second = parseInt(second)<10 ? ('0'+ second) : second;
		
		if (isAll) {
			return year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;
		}
		return year+'-'+month+'-'+day;
	};
	// }}}
/*******************************页面上传图片及单复选框特效JS加载***************************************/
 // {{{ function onloadCss() 
	
	this.onloadCss = function() {		
		/*缩略图操作*/
		$('div.thumbnailbox').on('mouseenter',function(){			
			$(this).find('div.img-btn').stop().animate({height:"30px"});
		}).on('mouseleave', function() {
			$(this).find('div.img-btn').stop().animate({height:"0px"});
		});
		$('div.img-btn').find('span.cancel').on('mouseenter',function(){
			$(this).stop().css("background-position","-46px 0px");
		}).on('mouseleave',function(){
			$(this).stop().css("background-position","-46px -22px");
		});
		$('div.img-btn').find('span.uploadimg').on('mouseenter',function(){
			$(this).stop().css("background-position","-68px 0px");
		}).on('mouseleave',function(){
			$(this).stop().css("background-position","-68px -22px");
		});
		var defaultsrc=$('div.thumbnailbox img').attr('flag');
		$('span#delete-thisimg').on('click',function(){
			var $thumbnail_img=$(this);
			var id=$(this).parent().parent().find("img").attr("id");			
			layer.confirm('确认不再使用当前缩略图吗？',function(index){		
				$thumbnail_img.parent().parent().find('img').attr('src',defaultsrc);
				if(id=='thumbnail'){
					$("input:hidden#pic").val('');
				}
				else{
					$("input:hidden."+id).val('');
					}
				layer.msg('已删除!',{icon: 1});
			});
		});
		/*缩略图操作完结*/
		
		/*单选、复选框特效*/
		$('.skin-minimal input').iCheck({
			checkboxClass: 'icheckbox-blue',
			radioClass: 'iradio-blue',
			increaseArea: '20%'
		});
	}

	// }}}
	// {{{ function uploadImg()
	
	/**
	 * 图片上传弹出框
	 * */
	this.uploadImg = function (title,url,w,h){
		layer_show(title,url,w,h);
	}
	
	// }}}
	// {{{ function getJosnMethod
	/**
	 * 获取getJosnMethod数据
	 * */
	this.getJosnMethod = function(url,func){
		self.cmd(gHttp,{controller:'PicManager',method:'getConfigJson',url:url},function(result){
			func(result);
		});
	}
    // }}}
	// {{{ function getImgSize
	/**
	 * 获取图片大小   ****取消根据模板数据设置图片大小功能，加快数据加载速度
	 * */
	/*
	this.getImgSize = function(para){
		self.getJosnMethod('/tpl/config.json', function( data ) {
			var tpl = '';
			if( data != null ) {
				$.each( data, function( key, value ) {
					tpl = value.currentUsed;
				});
			}
            if(tpl=='' || tpl.length == '0'){
            	self.getJosnMethod('/tpl/imgsize.json', function( imgsize ) {
                    var imgsizeArr = new Array();
                    $.each( imgsize, function( key, value ) {
                        imgsizeArr[value.key] = value;
                        if(value.key == para){                          
						   $("#"+para).html(imgsizeArr[para]['width']+'px * '+imgsizeArr[para]['height']+"px");
                            return false;
                        }
                    });
                });
            }else{
            	self.getJosnMethod('/tpl/'+tpl+'/imgsize.json', function( imgsize ) {
                    var imgsizeArr = new Array();
                    $.each( imgsize, function( key, value ) {
                        imgsizeArr[value.key] = value;
                        if(value.key == para){
                            $("#"+para).html(imgsizeArr[para]['width']+'px * '+imgsizeArr[para]['height']+"px");
                            return false;
                        }
                    });
                });
            }

		});
	}
	*/
	
	// }}}
	// {{{ function setImgSize()
	/**
	 * 设置图片大小,固定图片大小****缩略图大小一律限为150*100
	 * */
	/*
	this.setImgSize = function(para,id){
		if(!id){
			id = "#img";
		}
		self.getJosnMethod('/tpl/config.json', function( data ) {
			var tpl = '';
            if( data != null ) {
			$.each( data, function( key, value ) {
				tpl = value.currentUsed;
			});
            }
            if(tpl=='' || tpl.length == '0'){
            	self.getJosnMethod('/tpl/imgsize.json', function( imgsize ) {
                    var imgsizeArr = new Array();
                    $.each( imgsize, function( key, value ) {
                        imgsizeArr[value.key] = value;
                        if(value.key == para){
                            //$(id).attr('width',imgsizeArr[para]['width']);
                           // $(id).attr('height',imgsizeArr[para]['height']);
						   $(id).attr('width',150);
						   $(id).attr('height',100);
                            return false;
                        }
                    });
                });
            }else{
            	self.getJosnMethod('/tpl/'+tpl+'/imgsize.json', function( imgsize ) {
				var imgsizeArr = new Array();
				$.each( imgsize, function( key, value ) {
					imgsizeArr[value.key] = value;
					if(value.key == para){
						//$(id).attr('width',imgsizeArr[para]['width']);
						//$(id).attr('height',imgsizeArr[para]['height']);
						$(id).attr('width',150);
						$(id).attr('height',100);
						return false;
					}
				});
			});
            }
		});
	}
	*/
	// }}}
    // {{{ function fillShowPosition()
	
	/**
	 * 填充显示位数据
	 * */
	this.fillShowPosition = function(positionStr) {
		var data = {'1':'pc端','2':'手机网页','3':'app','4':'微站'};
		var position='';
		var strArr = [];
		if (positionStr != undefined) {
			strArr = positionStr.split(',');
			$.each(data,function(k,v){
				var checked = '';
				$.each(strArr,function(i,s){
					if (s == k) {
						checked = 'checked';
					}
				});
				position += '<div class="check-box">';
				position += '<input type="checkbox" id="show_position_'+k+'" name="show_position[]" value="'+k+'" '+checked+'>';
				position += '<label for="show_position_'+k+'">'+v+'</label>';					
			    position += '</div>';
			});
		}else{
			$.each(data,function(k,v){
				var checked = 'checked';
				position += '<div class="check-box">';
				position += '<input type="checkbox" id="show_position_'+k+'" name="show_position[]" value="'+k+'" '+checked+'>';
				position += '<label for="show_position_'+k+'">'+v+'</label>';					
			    position += '</div>';
			});
		}
		$('#show_position').html(position);	
	}
	
	// }}}
	// {{{　function getPicScroll()
	/**
	 * 获取滚动图片
	 * */
	this.getPicScroll = function(para){
		$.getJSON('/tpl/slide/config.json', function( imgsize ) {
			var slide = new Array();
			var install = true;
			$.each( imgsize, function( key, value ) {
				if(key == 0){
					install = value.name;
					return false;
				}
			});
			if(!install){
				self.cmd(gHttp,{controller:'PicManager',method:'installSlide'},function(result){
					if(!result.statu){
						layer.alert(result.msg);
					}else{
						$('#grid').grid('reload');
					}
				});
			}
		});
	}
	
	// }}}
	// {{{ function viewImg()
	/**
	 * 素材库点击插入编辑器光标处
	 * */
	
	this.putcontent=function(content){
		parent.UE.getEditor('editor').execCommand('inserthtml', content);		
	}
	
	
	
	/**
	 * 预览图片
	 * */
	this.viewImg = function(title, dataStr) {
		if (dataStr == '') {layer.alert('该产品暂时没有预览图哦 ^_^!');return false;}
		
		//layer.photos貌似不可用，故改用弹出页面的形式
		self.openAdd(title, '/hcc/plugin/view.php?img=' + dataStr, 800, 500);
		return false;
		
		//以下是layer.photos， 暂时不可用
		var data = dataStr.split(',');
		var views = [];
		for (var i in data) {
			views[i] = {
				'src' : data[i]
			};
		}
		
		layer.photos({
			photos: {
				title : title,
				data : views
			}
		});
	}
	
	// }}}
	// {{{ function openAdd()
	
	/**
	 * 添加窗口
	 * */
	this.openAdd = function (title,url,w,h,endfun){
		if (w == undefined && h == undefined) {
			var option = {type:2,title:title,content:url,end:function(){
				if(endfun!=undefined){
					endfun();	
				}
				
			}};
			var index = layer.open(option);
			layer.full(index);
		} else {
			if (h == undefined) {
				var option = {type:2,title:title,content:url,area:w + 'px',end:function(){
					if(endfun!=undefined){
						endfun();
					}
				}};
			} else {
				var option = {type:2,title:title,content:url,area:[w + 'px',h + 'px'],end:function(){
					if(endfun!=undefined){
						endfun();
					}
				}};
			}
			
			var index = layer.open(option);
		}
		
	}
	
	// }}}
    // {{{ function openEdit()
	
	/**
	 * 编辑窗口
	 * */
	this.openEdit = function (title,url){
		var index = layer.open({type:2,title:title,content:url});
		layer.full(index);
	}
	
	/*窗口编辑类型*/
	this.openEditWID = function (title,url,w,h,closetype,maxmintype){
		if(closetype==''){
			closetype=1;
		}
		if(maxmintype==''){
			maxmintype=true;
		}	
		layer.open({type:2,title:title,content:url,area:[w + 'px',h + 'px'],closeBtn:closetype,maxmin:maxmintype});		
	}
	
	/*父窗口打开*/
	this.FopenEditWID = function (title,url,w,h){
		parent.layer.open({type:2,title:title,content:url,area:[w + 'px',h + 'px']});		
	}
	// }}}
    // {{{ function openDel()
	
	/**
	 * 删除窗口
	 * */
	this.openDel = function (obj,para,fun){
		layer.confirm('确认要删除吗？',function(index){
			self.cmd(gHttp,para,function(ret){
				if(ret.statu){
					layer.msg('删除成功!',{icon:1},function(index){
						
						if (obj != undefined && obj.length > 0) {
							
							obj.api().ajax.reload();
						} else {
							var table=$(window.document).find("#dataTable").dataTable();
							if (table != undefined && table.length > 0) {
								table.api().ajax.reload();	
							}
						}
						
						if (fun != undefined) {
							fun(ret);
						}
						
						layer.close(index);
					});
					if(fun != undefined){
						fun(ret);
					}
				}else{
					layer.alert('删除失败!',{icon:2});
					//layer_close();
				}
				return false;
			})
		});
	}
	
	// }}}
	/******************************关于产品start********************************/
	// {{{ function getRemoteProductAuth()
	
	/**
	 * 通过id对产品进行权限验证
	 * @param id 产品id
	 * @param mode 下载、升级、更新
	 * @param product 产品类型 2->模版（下载）,3->插件（在线安装）,4->模版（在线安装）
	 */
	this.getRemoteProductAuth = function (id,mode,product,from){
		var c = '';
		var m = '';
		switch(product){
			case 2:c='Template',m='getRemoteProductAuth';break;
			case 3:c='Plugin',m='getRemoteProductAuth';break;
			default :c='Plugin',m='getRemoteProductAuth';break;
		}
		self.cmd(gHttp, {controller:c,method:m,id:id},function(ret){
			if(ret.statu&&ret.data!=""){
				
				self.product_id = ret.data.id;
				var product_name=ret.data.pro_name;	
				self.cmd(gHttp, {controller:'Topic',method:'getpicList'},function(date){
					
					checkgo=product;
					
					if(date.statu){
						if(date.data!=""){
						var jsondata=date.data
						for(var x in jsondata){
							if(jsondata[x].name==product_name){checkgo=6;}
						}
					}
					switch(checkgo){
						case 2:
							layer.confirm('确定需要'+mode+'该产品包吗？', {icon: 3, title:'提示'}, function(index) {
								layer.close(index);
								window.open( ret.data.url_address );
							});
							break;
						case 3:
							self.downloadProduct(ret.data.url_address,ret.data.pro_name,'plugin',mode,from);
							break;
						case 4:
							self.downloadProduct(ret.data.url_address,ret.data.pro_name,'template',mode,from);
							break;
						case 5:
							
							self.downloadProduct(ret.data.url_address,ret.data.pro_name,'topic',mode,from);
							break;
						case 6:
							layer.confirm('改专题模板已经安装，请先删除再安装', {icon: 3, title:'提示'});
							break;
						default:
							self.downloadProduct(ret.data.url_address,ret.data.pro_name,'plugin',mode,from);
							break;
					}
						
				}
			})		
		}else{
			switch(ret.code){
				case 100://需要注册
					self.productOpen("您尚未注册,是否立即注册？",ret.data.url.register,'register','click',id,product);
					break;
				case 101://需要支付
					self.productOpen("您尚未购买此产品,是否立即进行购买？",ret.data.url.buy,'buy','click',id,product);
					break;
				default:break;
			}
		}
		});
	}
	
	// }}}
	// {{{ function getRemoteProductAuthByUrl()
		
	/**
	 * 验证手动输入的产品地址
	 * */
	this.getRemoteProductAuthByUrl = function (url){
		self.cmd(gHttp, {controller:'Plugin',method:'getRemoteProductAuthByUrl',url:url},function(ret){
			if(ret.statu){
				self.product_id = ret.data.id;
				self.downloadProduct(ret.data.url_address,ret.data.pro_name,'plugin','下载');
			}else{
				switch(ret.code){
					case 100://需要注册
						layer_close();
						self.productOpen("您尚未注册,是否立即注册？",ret.data.url.register,'register','url',url);
						break;
					case 101://需要支付
						layer_close();
						self.productOpen("您尚未购买此产品,是否立即进行购买？",ret.data.url.buy,'buy','url',url);
						break;
					default://地址验证失败
						layer.alert('下载地址可能已经失效,或非正确的产品下载地址.');return false;
						break;
				}
			}
		});
	}
	
	// }}}
	// {{{ function productInstall
	
	/**
	 * 产品下载完进行的产品安装服务
	 * */
	this.productInstall = function (zipFile,mode,from){
		switch(mode){
			case 'plugin'://插件
				var index = layer.msg('正在安装专题插件,请稍后...');
				self.cmd(gHttp, {controller:'Plugin',method:'pluginInstall',zipFile:zipFile,product_id:self.product_id},function(ret){
					if(ret.statu){
						layer.alert('恭喜你,插件已安装成功!', function(index) {
							layer.closeAll();
							$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
							//已安装
							self.getLocalPluginList();
						});
					}else{
						layer.alert(ret.msg);
					}
				});
				break;
			case 'template'://模版
				var index = layer.msg('正在安装模版,请稍后...');
				var c = 'Template';
				var func = '';
				if (from != undefined && from == 'mobile') {
					c = 'Mobile';
					func = gFunc;
				}
				self.cmd(gHttp, {controller:c,method:'templateInstall',zipFile:zipFile,func:func},function(result){
					if(result.statu){
						layer.alert('模版安装成功', function(index){
							layer.closeAll();
							layer_close();
							$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
							//默认本地模板
							self.getLocalTemplateList();
						});
					}else{
						layer.alert(result.msg);
					}
				});
				break;
			case 'topic'://专题
				var index = layer.msg('正在安装专题模版,请稍后...');
				self.cmd(gHttp, {controller:'Template',method:'remoteInstallTopic',zipFile:zipFile},function(result){
					if(result.statu){
						layer.alert('专题模版安装成功', function(index) {
							//刷新选取模板
							window.parent.gTopic.refreshTopic();
							layer_close()
						});
						
					}else{
						layer.alert(result.msg);
					}
				});
				break;
		}
	}
	// {{{ function downloadProduct()
	
	/**
	 * 进度条下载框弹出
	 * */
	this.downloadProduct = function (product_url,product_name,product_dir,mode,from){
		layer.confirm('确定' + mode + '该产品吗?', function(index){
			layer.close(index);
			layer.open({
				title : '下载进度',
				type : 2,
				area : ['500px', '200px'],
				content : '/hcc/plugin/download.php?zipFile='+product_url+'&name='+product_name+'&dir='+product_dir+'&from=' + from
			});
		});
	}
	
	// }}}
	// {{{ function productOpen
	/**
	 * 产品弹窗功能
	 * @param content 弹窗信息内容
	 * @param url 需要弹出的地址
	 * @param mode 模式 , 注册或者购买
	 * @param flag       来源 , 点击下载或者手动输入url
	 * @param flagParam 来源参数
	 * @info 如果用户选择注册成功或者购买成功,则会重复进行产品下载权限判断
	 * @product 2->模版 3->插件
	 */
	function productOpen(content,url,mode,flag,flagParam,product){
		layer.open({
			title: '提示',
		    content: content,
		    yes: function() {
		    	self.openEdit(url);
		        switch(mode){
			        case 'register':
				    	layer.open({
				    	    title: '提示',
				    	    content: '请在新打开的窗口中进行注册操作',
				    	    icon: 'succeed',
				    	    yes: function(){
				    			switch(flag){
				    				case 'url'  :self.getRemoteProductAuthByUrl(flagParam);break;
				    				case 'click':self.getRemoteProductAuth(flagParam,'下载',product);break;
				    			}
				    	    }
				    	});
			        	break;
			        case 'buy':
			        	layer.open({
				    	    title: '提示',
				    	    content: '请在新打开的窗口中进行购买操作',
				    	    yes: function(){
				    			switch(flag){
			    					case 'url'  :self.getRemoteProductAuthByUrl(flagParam);break;
			    					case 'click':self.getRemoteProductAuth(flagParam,'下载',product);break;
				    			}
				    	    }
				    	});
			        	break;
		        }
		    }
		});
	}
	
	// }}}
	/******************************关于产品end********************************/

	/**
     * 解析url
     *
     * @param {String} urlValue url的值
     *
     * @returns {Void}
     */
    this.parseUrl = function (urlValue) {
        urlValue = urlValue + "";
        var urlQuery, urlParams;

        //处理url整体
        var urlReg = /^([^?#]*)\??([^#]*)(#?.*)$/;
        var urlMatch = urlValue.match(urlReg);
        urlQuery = "undefined" === typeof urlMatch[2] ? "" : urlMatch[2];

        //处理params
        urlParams = {};
        if ("" !== urlQuery) {
            var arrayParams = urlQuery.split('&');
            for (var i = 0; i < arrayParams.length; i++) {
                var paramStr = arrayParams[i];
                //忽略空的参数
                if ("" === paramStr) {
                    continue;
                }

                var paramKey, paramValue;
                var placeEqual = paramStr.indexOf('=');

                if (-1 === placeEqual) {
                    paramKey = paramStr;
                    paramValue = "";
                } else {
                    paramKey = paramStr.substr(0, placeEqual);
                    paramValue = paramStr.substr(placeEqual + 1);
                }

                //忽略key为空的参数
                if ("" === paramKey) {
                    continue;
                }

                urlParams[paramKey] = paramValue;
            }
        }

        return urlParams;
    }

    // }}}
    
    this.loadScripts=function(array,callback){
        var loader = function(src,handler){
            var script = document.createElement("script");
            script.src = src;
            script.onload = script.onreadystatechange = function(){
            script.onreadystatechange = script.onload = null;
            	handler();
            }
            var head = document.getElementsByTagName("head")[0];
            (head || document.body).appendChild( script );
        };
        (function(){
            if(array.length!=0){
            	loader(array.shift(),arguments.callee);
            }else{
            	callback && callback();
            }
        })();
    }
	//判断编辑器是否有敏感词汇
    this.setEditorFocus = function(){
		var content = UE.getEditor('editor').getContentTxt();
		if(content == "") return false;
		var obj = $('#editor');
		var	module = $('#module').val() ? $('#module').val() : '';
 		self.cmd(gHttp,{controller:'SensitiveWords',method:'titleIsSensitiveOrRepeat',content:content,module:module,type:'editor'},function(ret){		
					if(ret.statu){
						obj.addClass("Validform_error");
						obj.parent().next().html('<span class="Validform_checktip Validform_wrong">'+ret.msg+'</span>');
					}else{
						obj.removeClass("Validform_error");
						obj.parent().next().html('<span class="Validform_checktip"></span>');
					}
		});
}
	
//判断是否有敏感词汇	
 $('#subject,#seo_title,#keywords,#seo_desc').blur(function(){
	var obj = $(this);
	var content = obj.val();
	var type = obj.attr('id');
	var	module = $('#module').val() ? $('#module').val() : '';
	if(type=='subject'){
		var id = $('#id').val();
		var old_title = $('#old_title').val();
		if(id != "" && old_title==content) return false;		
	}
	if(content == "") return false;
	self.cmd(gHttp,{controller:'SensitiveWords',method:'titleIsSensitiveOrRepeat',content:content,module:module,type:type},function(ret){		
		if(ret.statu){
			obj.addClass("Validform_error");
			obj.parent().next().html('<span class="Validform_checktip Validform_wrong">'+ret.msg+'</span>');
		}else{
			obj.removeClass("Validform_error");
			obj.parent().next().html('<span class="Validform_checktip"></span>');
		}
	});	
})	
    
//发送是否有敏感词汇判断    
}

/*******************************滚动效果相关***********************************/
function slider(s){this.init.apply(this,arguments)}
slider.prototype={
	init:function(s){
	   this.o=this.getByClass(s)[0];
	   this.l=this.getByClass('slider_pic',this.o)[0].getElementsByTagName('li');
	   this.b=this.getByClass('slider_btn',this.o)[0];
	   this.bSpan=this.b.getElementsByTagName('span');
	   this.len=this.l.length;
	   this.iNum=0;
	   this.status();//初始化状态
	   this.autoPlay();//自动播放
	   this.clickPlay();//点击按钮播放
	   this.suspensionPause();//鼠标悬浮暂停
	},
	 clickPlay:function()
	 {
	 	var This=this;
	 	for(var i=0;i<this.len;i++)
	 	{    
	 		this.bSpan[i].index=i;
	 		this.bSpan[i].onclick=function()
	 		{
	 			clearInterval(This.timer);
	 			var index=this.index;
	 			This.iNum=(index+1) == This.len ? 0 : (index+1)  ;
	 			var o=This.l[index];
	 			This.setLayout(this,o);
	 			This.autoPlay();
	 		}
	 	}
	 },
	 suspensionPause:function()
	 {  
	 	var This=this;
	 	for(var i=0;i<this.len;i++)
	 	{
	 		this.l[i].onmouseover=function()
	 		{
	 			clearInterval(This.timer);
	 		}
	 		this.l[i].onmouseout=function()
	 		{
	 			This.autoPlay();
	 		}
	 	}
	 },
	 setLayout:function(o1,o2){
	 	for(var j=0;j<this.len;j++)
		{
			if(this.bSpan[j]!=o1)
			{
				this.bSpan[j].className='';
				this.l[j].style.zIndex=j;
			}
		}
		o2.style.zIndex=this.len;
		o2.style.left='600px';
		this.doMove(o2,0);
		o1.className='cur';
	 },
	 status:function(){
	 	for(var i=this.len;i--;i>0)
	 	{
	 		this.l[i].style.zIndex=i;
	 		this.bSpan[i].className='';
	 	}
	 	this.l[0].style.zIndex=this.len;
	 	this.bSpan[0].className='cur';
	 	this.b.style.zIndex=(this.len+1);
	 },
	 autoPlay:function(){
	 	this.timer=null;
	 	var This=this;
	 	this.timer=setInterval(function(){
	 		This.setLayout(This.bSpan[This.iNum],This.l[This.iNum])
	 		This.iNum++;
	 		if(This.iNum==This.len)
	 		{
	 			This.iNum=0;
	 		}
	 	},6000)
	 },
	 getByClass:function(s,p){
	 	var reg=new RegExp('(\\b)'+s+'(\\b)');
	 	var aResult=[];
	 	var aElement=(p || document).getElementsByTagName('*');
	 	for(var i=0;i<aElement.length;i++)
	 	{
	 		reg.test(aElement[i].className) && aResult.push(aElement[i])
	 	}
	 	return aResult;
	 },
	 doMove:function(o,t)
	 {
	 	clearInterval(o.timer);
	 	o.timer=setInterval(function(){
	 		var iS=(t-o.offsetLeft)/8;
	 		iS=iS>0?Math.ceil(iS):Math.floor(iS);

	 		if(o.offsetLeft==t)
	 		{
	 			clearInterval(o.timer);
	 		}
	 		else
	 		{
	 			o.style.left=o.offsetLeft+iS+"px";
	 		}

	 	},30)
	 }

}

/**********************************表单相关******************************************/
$(function(){
	//表单的验证
	$.fn.frmVal = function(data){		
		var _me = $(this);
		var check = true;
		_me.find(':input[type!=button]').each(function(){
			$(this).next('.error').remove();
			var ck = $(this).attr('check');
			var val = $.trim($(this).val());
			var title = $(this).attr('title');
			if(ck != undefined){
				var arr = ck.split(' ');
				var len = arr.length;
				if(len == 1){
					if(arr[0] == 'must'){
						if(val == ''){
							var html = '<div id="error_info"></div>';
							$('body').append(html);
							layer.msg(title);
							check = false;
							return false; 

						}
					}else{
						var str = arr[0].split('-');
						//当有值时才进行判断
						if(val.length > 0){
							switch(str[0]){
								case 'str' : 
									if (str[1] > val.length || str[2] < val.length) {
										var html = '<div id="error_info"></div>';
										$('body').append(html);
										layer.msg(title);
										check =  false;
										return false;
									}
									break;
								case 'num' : 
									if(isNaN(val) || (!isNaN(val) && val < parseInt(str[1])) || (!isNaN(val) && val > parseInt(str[2])) ){
										var html = '<div id="error_info"></div>';
										$('body').append(html);
										layer.msg(title);
										check =  false;
										return false;
									}
									break;			
							}
						}
						
					}
				}else{
					var str = arr[1].split('-');
					switch(str[0]){
						case 'str' : 
							if(str[1] > val.length || str[2] < val.length){
								var html = '<div id="error_info"></div>';
								$('body').append(html);
								layer.msg(title);
								check =  false;
								return false;
							}
							break;
						case 'num' : 
							if(isNaN(val) || (!isNaN(val) && val < parseInt(str[1])) || (!isNaN(val) && val > parseInt(str[2])) ){
								var html = '<div id="error_info"></div>';
								$('body').append(html);
								layer.msg(title);
								check =  false;
								return false;
							}
							break;
						case 'compare' : 
							var id = str[1];
							var one = $.trim($('#'+id).val());
							if(one != val){
								var html = '<div id="error_info"></div>';
								$('body').append(html);
								layer.msg(title);
								check =  false;
								return false;
							}
							break;
						case 'url' :
							var strRegex = "^((https|http|ftp|rtsp|mms)?://)"  
								  + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?"
								        + "(([0-9]{1,3}\.){3}[0-9]{1,3}"
								        + "|"
								        + "([0-9a-z_!~*'()-]+\.)*"
								        + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\."
								        + "[a-z]{2,6})"
								        + "(:[0-9]{1,4})?"
								        + "((/?)|"
								        + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";
							var re = new RegExp(strRegex);
							if (!re.test(val)){
								var html = '<div id="error_info"></div>';
								$('body').append(html);
								layer.msg(title);
								check =  false;
								return false;
							}
							break;
						case 'movie' :
							var pattern = /(.*?)\.(swf)$/i;
							if(val.length == 0 || val.search(pattern) == -1){
								var html = '<div id="error_info"></div>';
								$('body').append(html);
								layer.msg(title);
								check =  false;
								return false;
							}
							break;
					}
				}
			}
		});
		
		if(check){
			//密码进行md5加密
			_me.find(':input[type=password]').each(function(){
				$(this).val($.md5($(this).val()));
			});
			var str = _me.serializeArray();
			var s = data;
			$.each(str,function(i,obj){
				s[obj.name] = obj.value;
			});
			return s;
		}else{
			return false;
		}
	}
	
	//表单赋值
	$.fn.frmFill = function(name, data) {
		var _me = $(this);
		var new_name = '';
		_me.find('input[type="text"]').each(function() {
			for (pro in data) {
				if (name == '') {
					new_name = pro;
				} else {
					new_name = name + '[' + pro + ']';
				}
				if ($(this).attr('name') == new_name) {
					$(this).val(data[pro]);
					break;
				}
			}
		});

		_me.find('input[type="password"],textarea').each(function() {
			for (pro in data) {
				if (name == '') {
					new_name = pro;
				} else {
					new_name = name + '[' + pro + ']';
				}
				if ($(this).attr('name') == new_name) {
					$(this).val(data[pro]);
					break;
				}
			}
		});
		
		_me.find('input[type="hidden"]').each(function() {
			for (pro in data) {
				if (name == '') {
					new_name = pro;
				} else {
					new_name = name + '[' + pro + ']';
				}
				if ($(this).attr('name') == new_name) {
					$(this).val(data[pro]);
					break;
				}
			}
		});
		
        _me.find('img').each(function(){
            for(pro in data){				
                if(name == ''){
                    new_name = pro;
                }else{
                    new_name = name + '['+pro+']';
                }

                if($(this).attr('name') == new_name){
                    $(this).attr('src',data[pro]);
                    break;
                }
            }
        });
		
		_me.find(':radio').each(function(){
			for(pro in data){
				if(name == ''){
					new_name = pro;
				}else{
					new_name = name + '['+pro+']';
				}

				if($(this).attr('name') == new_name && $(this).val() == data[pro]){
					$(this).attr('checked','checked');
				}
			}
		});

		_me.find('select').each(function() {
			for (pro in data) {
				if (name == '') {
					new_name = pro;
				} else {
					new_name = name + '[' + pro + ']';
				}
				if ($(this).attr('name') == new_name) {
					$(this).children('[value="' + data[pro] + '"]').attr('selected', 'selected');
					break;
				}

			}
		});
		

		return _me;
	}

	//表单的提交
	$.fn.frmPost = function(data,fun){
		var base = new BaseFunc();
		var _me = $(this);
		var data = _me.frmVal(data);
		
		if(data){
			base.cmd(gHttp,data,fun);
		}
	}
	
	$.fn.checkAndSubmit = function(subBtnId, data, fun,befun) {
		var _me = $(this);
		var validFormObject = _me.Validform({
			btnSubmit:"#" + subBtnId, 
			btnReset:"#btn_reset",
			tiptype:2, 
			ignoreHidden:false,
			dragonfly:false,
			tipSweep:false,
			label:".label",
			showAllError:true,
			postonce:true,
			ajaxPost:true,
			datatype:{
				"*6-50": /^[^\s]{6,20}$/,
				"Pinteger":/^-?d+$/,//整数
				"doubleINT":/[0-9]{1,}(\.){0,1}[0-9]*/,//小数与整数
				"NumLetter": /[A-Za-z0-9]+/,   //数字加字母
				"Pcode":/[A-Z]{4,}/,
				"LimitNumLetter":/[A-Za-z0-9]{6,12}/,   //数字加字母
				"filename":/[A-Za-z]+(.html){1}$/,
				"Letter": /^[a-zA-Z]{2,50}$/,  //字母	
				"Flags": /^([a-zA-Z]{1,}[-_]?)+[a-zA-Z0-9]{1,}$/,  //标识
				"URL_LINK":/(.)*((\.html){1}|(\.php){1}(.)*)$/,
				"URLS":/http:\/\/|https:\/\/(.)*/,
				"INTS":/^[0-9]*[1-9][0-9]*$/,  //大于1的整数
				"z2-20" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,20}$/,
				"Empty" : /^\s*$/,     //可以为空
				"CheckMobile" : /^(1[34578]\d{9})$/i, //手机号验证
				"CheckMail" : /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/, //邮箱验证
				"CheckQQ" : /^\d{5,10}$/,   //QQ号码验证
				"Times":/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/,  //时间点  08：00
				"Timeslot":/^([1-9]{1}|0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})-(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/, //时间段  8:00-12:00
				
				"username":function(gets,obj,curform,regxp){					//参数gets是获取到的表单元素值，obj为当前表单元素，curform为当前验证的表单，regxp为内置的一些正则表达式的引用;
					var reg1=/^[\w\.]{4,16}$/,
						reg2=/^[\u4E00-\u9FA5\uf900-\ufa2d]{2,8}$/;
		 
					if(reg1.test(gets)){return true;}
					if(reg2.test(gets)){return true;}
					return false;
		 
					//注意return可以返回true 或 false 或 字符串文字，true表示验证通过，返回字符串表示验证失败，字符串作为错误提示显示，返回false则用errmsg或默认的错误提示;
				},				
				"phone":function(){
					// 5.0 版本之后，要实现二选一的验证效果，datatype 的名称 不 需要以 "option_" 开头;	
				}
			},
			usePlugin:{
				swfupload:{},
				datepicker:{},
				passwordstrength:{},
				jqtransform:{
					selector:"select,input"
				}
			},
			beforeCheck:function(curform){
				//在表单提交执行验证之前执行的函数，curform参数是当前表单对象。
				//这里明确return false的话将不会继续执行验证操作;

				
			},
			beforeSubmit:function(curform){
				//resetForm()之后貌似就不执行了
				$.each(data, function(k, v){
					if ($("#" + k).length < 1 ) {
						curform.append('<input type="hidden" id="'+k+'" name="'+k+'" value="'+v+'">');
					} else {
						$("#" + k).remove();						
						curform.append('<input type="hidden" id="'+k+'" name="'+k+'" value="'+v+'">');
					}
				});
				
				//密码进行md5加密
				curform.find(':input[type=password]').each(function(){
					$(this).val($.md5($(this).val()));
				});
				if(befun&&typeof(befun)=="function"){//如果函数存在
					befun(curform);
					}
				
				//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
				//这里明确return false的话表单将不会提交;	
			},
			tiptype:function(msg, o, cssctl) {
				//提示信息控制，避免是否验证通过都一直显示正在提交数据...
				if (!o.obj.is("form")) {
					if (o.type != 2) {
						//状态为2表示通过验证，成功就不提示						
						//页面上不存在提示信息的标签时，自动创建		
						if(o.obj.attr('class')=='select'){
							var $alam=o.obj.parent().parent().next();								
							$alam.html('<span class="Validform_checktip"></span>');
							var objtip = o.obj.parent().parent().parent().find(".Validform_checktip");								
							cssctl(objtip,o.type);						
							objtip.text(msg);
						}
						else{
							var $alam=o.obj.parent().next();								
							$alam.html('<span class="Validform_checktip"></span>');
							var objtip = o.obj.parent().parent().find(".Validform_checktip");								
							cssctl(objtip,o.type);						
							objtip.text(msg);
						}
					}
					else if (o.type == 2){
						 if(o.obj.attr('class')=='select'){
								var $alam=o.obj.parent().parent().next();								
								$alam.html('<span class="Validform_checktip Validform_right"></span>');
								
						}
						else{
							var $alam=o.obj.parent().next();								
							$alam.html('<span class="Validform_checktip Validform_right"></span>');								
						}							
							
					}
				}
			},
			callback:function(data){
				fun(data);
				//返回数据data是json对象，{"info":"demo info","status":"y"}
				//info: 输出提示信息;
				//status: 返回提交数据的状态,是否提交成功。如可以用"y"表示提交成功，"n"表示提交失败，在ajax_post.php文件返回数据里自定字符，主要用在callback函数里根据该值执行相应的回调操作;
				//你也可以在ajax_post.php文件返回更多信息在这里获取，进行相应操作；
				//ajax遇到服务端错误时也会执行回调，这时的data是{ status:**, statusText:**, readyState:**, responseText:** }；
		 
				//这里执行回调操作;
				//注意：如果不是ajax方式提交表单，传入callback，这时data参数是当前表单对象，回调函数会在表单验证全部通过后执行，然后判断是否提交表单，如果callback里明确return false，则表单不会提交，如果return true或没有return，则会提交表单。
			}
		});
		
		validFormObject.config({
			url: gHttp
		});		
		return validFormObject;
		
	}
	
    /**
     * 获取所有选中项
     * */
    $.fn.getSelectedAll = function(returnStr) {
    	var data = '';
		var tbodyObj = $(this).find('tbody');
		tbodyObj.find('input[type="checkbox"]:checked').each(function(){
			if ($(this).val() != '') {
				data += $(this).val() + ',';
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
    
});

/**************************提前加载项******************************/
function selectAll(){
		var tableObj = $(this).parent().parent().parent();
		var tbodyObj = tableObj.find('tbody');
		tbodyObj.find('input[type="checkbox"]').each(function(){
			if ($("#selectAll").attr('checked') == true) {
				tbodyObj.find('input[type="checkbox"]').attr('checked', true);
			} else {
				tbodyObj.find('input[type="checkbox"]').attr('checked', false);
			}
		});
}

/*************************导航编辑数据填充*******************************/
$(function(){
	var base = new BaseFunc();
	
	/**
	 * 绑定链接-科室
	 * */
	$.fn.bindDepartment = function(){
		var _me = $(this);
		base.cmd(gHttp,{controller:'Navigation',method:'getHtmlUrl'},function(result1){
			if(result1.statu){
				var str='<option value="">&nbsp;请选择&nbsp;</option>';
				$.each(result1.data, function(i,obj) {
					str +='<option value="'+obj.url+'">'+obj.name+'</option>';
				});
				_me.html(str);
			}else{
				layer.alert(result1.msg,{icon:2});
			}
		});
	}
	
	/**
	 * 绑定链接-手机网页科室
	 * */
	$.fn.bindMobileDepartment = function(type){
		var _me = $(this);
		base.cmd(gHttp,{controller:'MobileNavigation',method:'getHtmlUrl',func:type},function(result1){
			if(result1.statu){
				var str='<option value="">&nbsp;请选择&nbsp;</option>';
				$.each(result1.data, function(i,obj) {
					str +='<option value="'+obj.url+'">'+obj.name+'</option>';
				});
				_me.html(str);
			}else{
				layer.alert(result1.msg,{icon:2});
			}
		});
	}
	
	/**
	 * 根据科室绑定疾病
	 * */
	$.fn.bindDisease = function(para) {
		var _me = $(this);
		base.cmd(gHttp,{controller:'Navigation',method:'getHtmlUrlByPara',op:para.sel},function(result1){
			if(result1.statu){				
				var isDisease = '';
				if(para.sel == 'disease'){
					isDisease = 'onChange="getDepartSubTree(this.value)"';
				}
				var str='<select class="select" name="childUrl" id="childUrl"  '+isDisease+'>';
				str+='<option value="">&nbsp;请选择病症&nbsp;</option>';
				$.each(result1.data, function(i,obj) {
					if(isDisease == ''){
						str +='<option flag="'+obj.url+'" value="'+obj.url+'">'+obj.name+'</option>';
					}else{
						if(obj.parent==''){
							str +='<option flag="'+obj.url+'" value="'+obj.id+'">'+obj.name+'</option>';
							}							
					}
				});
				str+="</select>";
				_me.html(str);
				_me.show();
				if(para.sel != 'disease'){
					$('#childUrl').change(function(){
						var sel = $(this).val();
						$('#hurl_link').val(sel);
					});
				}
			}else{
				layer.alert(result1.msg);
			}
		
			return false;
		});
	}
	
	/**
	 * 绑定频道链接
	 * */
	$.fn.bindChannel = function(realInput) {
		var _me = $(this);
		base.cmd(gHttp,{controller:'Channel',method:'query'},function(result1){
			var str='<select class="select" name="channelList" check="must" onChange="setChannel(this.value, \''+realInput+'\')" id="channelList">';
			str += '<option value="">&nbsp;请选择&nbsp;</option>';
			$.each(result1.rows, function(i,obj) {
				str +='<option value="'+obj.shortname+'">'+obj.name+'</option>';
			});
			_me.html(str);
			_me.show();
			$('#'+realInput).val('');
		});
	}
	
	/**
	 * 导航父级数据绑定
	 * */
	$.fn.bindApid = function(cate, controller, method) {
		var _me = $(this);
		//默认为PC端普通导航
		if (controller == undefined) {
		    controller = 'Navigation';	
		}
		
		if (method == undefined) {
			method = 'getNavigationBycate';	
		}
		var groupId = $("#group_id").val();
		base.cmd(gHttp,{controller:controller,method:method,cate:cate,pid:'0',group_id:groupId},function(res){
			if(res.statu){
				var str='<option value="0">&nbsp;顶级&nbsp;&nbsp;</option>';
				$.each(res.data, function(i,obj) {
					str +='<option value="'+obj.id+'">'+obj.subject+'</option>';
				});
				_me.html(str);
			}else{
				layer.alert(res.msg);
			}
		});	
		
		$("#apid").change(function(){
			var v = $(this).val();
			$('#pid').val(v);	
			$('#childPidDiv').parent().remove();
			if(v!=0){
				base.cmd(gHttp,{controller:controller,method:'getNavSubTree',cate:cate,pid:v,group_id:groupId},function(res){
					if(res){
						var str1='<select class="select" name="childPid" id="childPid"  title="请选择下一级导航" style="float:left;">';
						str1+= res + "</select>";
						
						if ($('#childPidDiv').length<1) {
							$('#apid').parent().parent().parent().append('<div class="formControls col-2"> <span class="select-box" id="childPidDiv"></span> </div>');
						}
						
						$('#childPidDiv').html(str1);
					}
					$('#childPid').change(function(){
						var c = $(this).val();
						$('#pid').val(c);
					})							
					return false;
					
				});	
			}
		});
	}
	
	/**
	 * 推荐位-checkbox
	 * */
	$.fn.bindRecommend = function() {
		var _me = $(this);
		base.cmd(gHttp,{controller:'News',method:'getAll'},function(ret){
			if(ret.statu){
				//推荐位置
				var position='';
				$.each(ret.data.re,function(i,obj){
					position += '<div class="check-box">';
					position += '<input type="checkbox" id="checkbox-moban'+obj.id+'" name="recommendposition['+i+']" value="'+obj.id+'">';
					position += '<label for="checkbox-moban'+obj.id+'">'+obj.name+'</label>';					
				    position += '</div>';
				});
				_me.html(position);	
			}
		});	
	}
	
	/**
	 * 填充科室select
	 * */
	$.fn.fillDepartment = function() {
		var _me = $(this);
		base.cmd(gHttp,{controller:'Department',method:'getDepartments'},function(ret){
			if(ret.statu){
				var str='<option value="">请选择科室</option>';
				var selected='';
				$.each(ret.data, function(i,obj) {
					str +='<option value="'+obj.id+'" '+selected+'>'+obj.name+'</option>';
				});
				_me.html(str);
			}else{
				layer.alert(ret.msg);
			}
		});
	}
	
	/**
	 * 绑定专题模板
	 * */
	$.fn.bindTopicList = function(){
		var _me = $(this);
		base.cmd(gHttp,{controller:'Topic',method:'getpicList'},function(result1){
			if(result1.statu){
				var str='<option value="">&nbsp;请选择&nbsp;</option>';
				$.each(result1.data, function(i,obj) {
					str +='<option value="'+obj.id+'">'+obj.name+'</option>';
				});
				_me.html(str);
			}else{
				layer.alert(result1.msg);
			}
		});
	}
	
	// {{{ 初始化时间
	/**
	 * 初始化时间
	 * */
	initTimeMonth('start', 'end');	
	
	initTimeWeek('startime', 'endtime');	
	
	initTimeMonth('visitors_start', 'visitors_end');
	
	initTimeMonth('iptrend_start', 'iptrend_end');
	// }}}
	
});

function initTimeMonth(startName, endName) {
	var start_time_len = $("input[name='"+startName+"']").length;
	var end_time_len   = $("input[name='"+endName+"']").length;
	
	var begin = new Date();
	var end = new Date();
	new Date(begin.setMonth((new Date().getMonth()-1)));
	var begintime= begin.Format("yyyy-MM-dd");
	var endtime=end.Format("yyyy-MM-dd");
	
    //默认一个月之前
	if (start_time_len === 1) {
		$("input[name='"+startName+"']").val(begintime);		
	}
	//默认当前时间
    if (end_time_len === 1) {
    	$("input[name='"+endName+"']").val(endtime);    	
	}
}

Date.prototype.Format = function(format) {
	 var o = {
	  "M+" : this.getMonth() + 1, // month
	  "d+" : this.getDate(), // day
	  "h+" : this.getHours(), // hour
	  "m+" : this.getMinutes(), // minute
	  "s+" : this.getSeconds(), // second
	  "q+" : Math.floor((this.getMonth() + 3) / 3), // quarter
	  "S" : this.getMilliseconds()
	 // millisecond
	 }
	 if (/(y+)/.test(format))
	  format = format.replace(RegExp.$1, (this.getFullYear() + "")
	    .substr(4 - RegExp.$1.length));
	 for ( var k in o)
	  if (new RegExp("(" + k + ")").test(format))
	   format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k]
	     : ("00" + o[k]).substr(("" + o[k]).length));
	 return format;
}

function initTimeWeek(startName, endName) {
	var start_time_len = $("input."+startName).length;
	var end_time_len   = $("input."+endName).length;	
	
	var begin = new Date();
	var end = new Date();
	new Date(begin.setDate((new Date().getDate()-7)));
	var begintime= begin.Format("yyyy-MM-dd");
	var endtime=end.Format("yyyy-MM-dd");
	
	//默认当前时间
   if (end_time_len === 1) {
    	$("input."+endName).val(endtime);
	}
    //默认7天之前
	if (start_time_len === 1) {
		$("input."+startName).val(begintime);
	}		
}

function setChannel(value, id) {
	$("#"+id).val(value + '/index.html');
}

/*****************datetable******************************/
!function($){
	/**
	 * 动态加载table数据
	 * */
	var grid = function(option){
		this.size = typeof(option.size) == 'undefined' ? 10 : option.size;
		this.page = 1;
		this.bserverside=option.bserverside == undefined ? true : option.bserverside;
		this.para = option.para;
		this.order = option.order == undefined ? true : option.order; //是否显示排序功能
		this.filter = option.filter == undefined ? false : option.filter; //是否使用过滤功能
		this.changSize = option.changSize == undefined ? true : option.changSize; //是否允许改变每页显示数量
		this.field = option.field;
		this.ttl  = option.ttl;
		this.data = option.data;
		this.size = option.size == undefined ? 10 : option.size;//页数最多显示10页
		this.initSort = option.initSort == undefined ? [[1, "desc"]] : option.initSort; //初始化排序列，默认从第1列(id)倒序排列
		this.checkAll = option.checkAll == undefined ? false : option.checkAll;//是否默认复选框全选
		this.showPage = option.showPage == undefined ? true  : option.showPage;//是否显示分页,默认为true
		this.tableInfo = option.tableInfo == undefined ? true : option.tableInfo; //是否显示表格相关信息
		this.aoColumnDefs = option.aoColumnDefs == undefined ? null  : option.aoColumnDefs;//是否显示分页,默认为true
		this.createdRow = option.createdRow == undefined ? null : option.createdRow; //控制自然序号
	}
	
	grid.prototype = {
		constructor : grid,
		request : function (_me){
			var self = this;
			var oTable = null;
			var field = self.field;
			
			_me.DataTable().destroy();
			_me.show();
			
			
			//如果有数据，则直接展示
			if (self.ttl != undefined && self.data != undefined) {
				var obj = _me.parent().parent().parent().find("#total");
				if (obj!=undefined&&obj.length>0) {
					_me.parent().parent().parent().find("#total").html(self.ttl);
				} else {
					$("#total").html(self.ttl);
				}
				oTable = _me.DataTable({
					"bInfo" : self.tableInfo,               //是否显示表格相关信息
					"bPaginate" : self.showPage,            //是否开启分页
					"sPaginationType": "full_numbers",      //翻页界面类型   
		            "oLanguage": {                          //汉化   
		                "sLengthMenu": "每页显示 _MENU_ 条",   
		                "sZeroRecords": "没有检索到数据",   
		                "sInfo": "显示 _START_ 到 _END_ 条，共 _TOTAL_ 条",   
		                "sInfoEmtpy": "没有数据",   
		                "sProcessing": "正在加载数据...",   
		                "oPaginate": {   
		                    "sFirst": "首页",   
		                    "sPrevious": "前页",   
		                    "sNext": "后页",   
		                    "sLast": "尾页"  
		                }   
		            },
		            "bFilter": self.filter,                       //不使用过滤功能   
		            "bSort":self.order,
		            "bLengthChange": self.changSize,                 //用户不可改变每页显示数量   
		            "iDisplayLength": self.size,                    //每页显示N条数据   
					"data":self.data,
					"columns": field
				});
				
				return oTable;
			}
			
			//如果没数据，则动态获取
			var controller = self.para.controller;
			var method = self.para.method;
			var size = self.size;
			
			var url = gHttp + "?controller=" + controller + "&method=" + method;
			
			//获取数据的处理函数
			var retrieveData = function (sSource, aoData, fnCallback) {
				var sortObj = {};
				var iDisplayStart = 0;
				var iDisplayLength = self.size;
				var sortIndex = 0;
				var sortType = 'desc';
				//根据参数，解析出底层需要的分页参值
				for (var i in aoData) {
					if (aoData[i].name.indexOf('mDataProp') != -1) {
						sortObj[aoData[i].name] = aoData[i].value;
					}
					if (aoData[i].name == 'iDisplayStart') {
						iDisplayStart = aoData[i].value;
					}
					if (aoData[i].name == 'iDisplayLength') {
						iDisplayLength = aoData[i].value;
					}
					if (aoData[i].name.indexOf('iSortCol') != -1) {
						sortIndex = aoData[i].value;
					}
					if (aoData[i].name.indexOf('sSortDir') != -1) {
						sortType = aoData[i].value;
					}
				}
				
				if (self.order) {
					self.para['order'] = ' order by ' + sortObj['mDataProp_' + sortIndex] + ' ' + sortType;
				}
				
				if (self.showPage) {
					self.para['page'] = self.page = (iDisplayStart/iDisplayLength)+1;
					self.para['size'] = self.size = iDisplayLength;
				}
				
				//加入时间校验
				if (!self.checkTime()) return false;
				
				//加入其它参数
				if ($("#frm_post").length > 0) {					
					var frmData = $("#frm_post").frmVal({});
					for (var i in frmData) {
						self.para[i] = frmData[i];
					}
				}
				
			    $.ajax( {   
			        "type": "POST",    
			        "url": sSource,    
			        "dataType": "json",   
			        "data": self.para, //以json格式传递   
			        "success": function(resp) { 
			        	if (_me.parent().parent().parent().find("#total").length>0) {
							_me.parent().parent().parent().find("#total").html(resp.ttl);
						} else {
							$("#total").html(resp.ttl);
						}
			            fnCallback({'aaData':resp.rows, 'iTotalRecords':resp.ttl, 'iTotalDisplayRecords':resp.ttl}); //服务器端返回的对象的returnObject部分是要求的格式  
			        }   
			    });   
			};
			
			//多选框不参与排序
			if (self.aoColumnDefs) {
				var defs = self.aoColumnDefs;
				defs.push({ "bSortable": false, "aTargets": [ 0 ] });
			} else {
				var defs = [ { "bSortable": false, "aTargets": [ 0 ] }];
			}
			
			oTable = _me.DataTable({
				"aoColumnDefs":defs,
				"bAutoWidth": false, 
				"bInfo" : self.tableInfo,               //是否显示表格相关信息
				"bPaginate" : self.showPage,            //是否开启分页
	            "bProcessing": true,                    //加载数据时显示正在加载信息   
	            "bServerSide": self.bserverside,                    //指定从服务器端获取数据   
	            "bFilter": self.filter,                       //不使用过滤功能   
	            "bSort":self.order,
	            "bLengthChange": self.changSize,                 //用户不可改变每页显示数量   
	            "iDisplayLength": self.size,                    //每页显示N条数据   
	            "sAjaxSource": url,//获取数据的url   
	            "fnServerData": retrieveData,           //获取数据的处理函数   
	            "sPaginationType": "full_numbers",      //翻页界面类型   
	            "oLanguage": {                          //汉化   
	                "sLengthMenu": "每页显示 _MENU_ 条",   
	                "sZeroRecords": "没有检索到数据",   
	                "sInfo": "显示 _START_ 到 _END_ 条，共 _TOTAL_ 条",   
	                "sInfoEmtpy": "没有数据",   
	                "sProcessing": "正在加载数据...",   
	                "oPaginate": {   
	                    "sFirst": "首页",   
	                    "sPrevious": "前页",   
	                    "sNext": "后页",   
	                    "sLast": "尾页"  
	                }   
	            },
	            'aaSorting':self.initSort,
	            'columns':field,
	            'fnCreatedRow':self.createdRow  //自动显示序列号
			});
				
			return oTable;
			
		},
		
		checkTime : function() {
			var self = this;
			var start_time_len = $("input[name='start_time']").length;
			var end_time_len   = $("input[name='end_time']").length;
			if(start_time_len === 1 && end_time_len === 1) {
				var start_time = $.trim( $("input[name='start_time']").val() );
				var end_time   = $.trim( $("input[name='end_time']").val() );
				if(start_time === '' && end_time === ''){
	
				}else if(start_time !== '' && end_time !== ''){
					var start_date = new Date( start_time.replace(/-/g,'/') ).getTime();
					var end_date   = new Date( end_time.replace(/-/g,'/') ).getTime();
					if(start_date > end_date){
						layer.alert('开始时间不能大于结束时间.');
						return false;
					}
				}else{
					if(start_time === ''){
						layer.alert('请选择开始时间.');
					}else{
						layer.alert('请选择结束时间.');
					}
					return false;
				}
			}
			return true;
		}
	}
	
	$.fn.grid = function(option){
		var _me = $(this);
		var _grid = new grid(option);
		return _grid.request(_me);
	}

}(window.jQuery);

/*
 * 表格中的批量选中 返回id
 * 
 * */
function chooseall(id){
	var check_val=[];
    var obj=$(id);
    var tbody=obj.find('tbody');
  
    var  checks=tbody.find('input[type="checkbox"]');
    for(var i=0; i<checks.length;i++){
    	if(checks[i].checked){
    	check_val.push(checks[i]);
    	}
    }
 
    return check_val;	
}
/*
 * 
 * 刷新表格，注意需要服务端支持
 * 
 * 
 */
function troad(id){
	var table=$(id).dataTable();
	table.api().ajax.reload();
}

function open_log(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		area: [w+'px', h+'px'],		
		content: url
	});

}
function open_newindow(title,url,w,h){	
	parent.layer.open({
		type: 2,
		area: [w+'px', h +'px'],
		fix: false, //不固定
		maxmin: true,
		shade:0.4,
		title: title,
		content: url
	});
}
/*
 * 右侧小图标
 * */
var righticon=document.getElementById('righticon');
if(righticon){
	var closeright=document.getElementById('closeright');
	closeright.onclick=function(){
		righticon.style.display="none"; 
	};
}

