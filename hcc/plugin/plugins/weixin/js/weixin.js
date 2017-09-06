/**
 * 微信公众号管理
 * */
var uploader = null;
function WeiXin() {
	BaseFunc.call(this);
	var self = this;
	
	// {{{ function initAccount()
	
	/**
	 * 初始化帐号管理
	 * */
	this.initAccount = function() {
		$(function(){
			self.fillAccountTable();
		});
	}
	
	// }}}
	// {{{ function fillAccountTable()
	
	/**
	 * 帐号列表
	 * */
	this.fillAccountTable = function() {
		$('#dataTable').grid({
            size : 10,
            para : {controller:'Weixin',method:'getListWeixin'},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}												
							],
            field : [
				{
					data : 'id',
					render : function (id, type, row) {
						return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
					}
				},
				{data:'id'},
              {data:'weixinname'},
              {data:'pic', render : function(pic){
            	  return '<img width="90px" src="'+pic+'"/>';
              }},
              {data:'id', render : function(id, type, row){
            	  return location.hostname + '/weixindb/weixin.php?tag=' + row.tag;
              }},
              {data:'tag', render : function(tag){return 'boyicms';}},
              {data:'id',render : function(id,type,row){
                  var str = '<a style="text-decoration:none" onClick="gWeiXin.openManage('+id+');" href="javascript:;" title="公众号功能设置"><i class="Hui-iconfont">&#xe63c;</i></a>';
                  str += ' <a style="text-decoration:none" class="ml-5" onClick="gWeiXin.delAccount('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
                  return str;
                }
              }
            ]
          });
	}
	
	// }}}
	// {{{ function openManage()
	
	/**
	 * 打开公众号管理
	 * */
	this.openManage = function(id) {
		//判断token是否有效
		self.cmd(gHttp,{controller:'Weixin',method:'choose',id:id},function(ret){
			if(ret.statu){
				self.openEdit('公众号功能设置','detail-wx.html?from=1&id='+id);
			}else{
				layer.alert(ret.msg);
			}
		});	
	}
	
	// }}}
    // {{{ function delAccount()
	
	/**
	 * 删除帐号
	 * */
	this.delAccount = function(id) {
		var obj = $("#dataTable").dataTable();
		self.openDel(obj,{controller:'Weixin',method:'deleteWeixin',id:id});
	}
	
	// }}}
    // {{{ function delBatchAccount()
	
	/**
	 * 批量删除帐号
	 * */
	this.delBatchAccount = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj = $("#dataTable").dataTable();
		self.openDel(obj,{controller:'Weixin',method:'deleteWeixin',id:ids});
	}
	
	// }}}
	// {{{ function authBingding()
	
	/**
	 * 授权绑定
	 * */
	this.authBingding = function() {
		var domain = location.hostname;
	    window.open('http://www.boyicms.com/wechat/?q=base&action=auth&domain=' + domain, 'authWin');
		layer_close();
	}
	
	// }}}
	// {{{ function initBinding()
	
	/**
	 * 初始化人工绑定
	 * */
	this.initBinding = function() {
		$(function(){
			self.cmd(gHttp,{controller:'Weixin',method:'getTag'},function(ret){
				if(ret.statu){
					 var url = location.hostname;
					 var self_url = "http://"+url+"/weixindb/weixin.php?tag="+ret.data;
					 $("#div_url").html(self_url);
					 $("#tag").val(ret.data);
				}else{
					layer.alert(ret.msg);
				}
			});	
			
			$("#save").click(function(){
				self.addWeiXin();
			});
			
			//初始化应用图标上传
			self.initUploadAppLogo();
		});
	}
	
	// }}}
    // {{{ function initUploadAppLogo()
	
	/**
	 * 上传应用图标-即二维码图片
	 * */
	this.initUploadAppLogo = function() {
		uploader = null;
		$(".btns_app_logo").html('<div id="picker3"><i class="Hui-iconfont">&#xe600;</i> 上传图片</div>');
		
		uploader = WebUploader.create({
			auto:true,
			swf:'lib/webuploader/0.1.5/Uploader.swf',
			server:'/controller/?controller=Upload&method=uploadPic&dir=weixin',
			pick:'#picker3',
			fileVal: 'file',
			resize:false
		});
		
		$("#picker3").unbind('click').bind('click',function(){
			self.uploadAppLogo();
		});
		
		
	}
	
	
	// }}}
    // {{{ function uploadAppLogo()
	
	/**
	 * 上传应用图标-即二维码图片
	 * */
	this.uploadAppLogo = function() {
		// 文件上传过程中创建进度条实时显示。
		uploader.on( 'uploadProgress', function( file, percentage ) {
		    uploader.on( 'uploadSuccess', function( file, response ) {
		        layer.msg('上传成功',{icon:1});
				if(response.result){
					$('#img').attr('src',response.path);
					$('#showImg').show();
					$("#pic").val(response.url);
				}else{
					layer.alert(response.mes,{icon:2});
				}
		    });

		    uploader.on( 'uploadError', function( file ) {
		    	layer.alert('上传失败',{icon:2});
		    });
		});
	}
	
	// }}}
	// {{{ function addWeiXin()
	
	/**
	 * 保存人工绑定微信
	 * */
	this.addWeiXin = function() {
		if($('#weixinname').val() == ''){
			layer.msg('请输入微信名称');
			return false;
		}
		if($('#appid').val() == ''){
			layer.msg('请输入AppID');
			return false;
		}
		if($('#appsecret').val() == ''){
			layer.msg('请输入AppSecret');
			return false;
		}
		var formData = $('#information').serializeArray();
		var data = {controller:'Weixin',method:'saveWeixin'};
		$.each(formData,function(i,obj){
			data[obj.name] = obj.value;
		});
		self.cmd(gHttp,data,function(re){
			if(re.statu){
							//刷新列表
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg(re.msg);
				layer_close();

			}else{
				parent.layer.msg(re.msg);
			}
		});
	}
	
	// }}}
	// {{{ function initManage()
	
	/**
	 * 公众号管理初始化
	 * */
	this.initManage = function(){
		$(function(){
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.from == '1') {
				$('#li_menu').attr('flag', 'opener');
			}
			
			//自定义菜单
			self.menu();
			$.Huifold("#Huifold1 .item h4","#Huifold1 .item .info","fast",2,"click"); /*5个参数顺序不可打乱，分别是：相应区,隐藏显示的内容,速度,类型,事件*/
		})
	}
	
	// }}}
	// {{{ function WechatJumpUrls()
	/**
	 * 微信跳转链接之专题
	 * */
	this.WechatUrlsOfTopic = function(protocol, hostname){
		var items=[];
		var array =[];
		var urls =[];
		self.cmd(gHttp,{controller:'Topic',method:'getTopicUrls'},function(ret){
			if(ret.statu){
				$.each(ret.data,function(i,v){        	
					var url = protocol+'//'+hostname+'/topic/'+v.url+'/'+v.link;			
					urls[i] = url;
					items[url] = v.subject;
				});				
			}
		});	
		array[0]=urls;
		array[1]=items;
		return array;
	}
	/**
	 * 微信跳转链接
	 * */
	 
	this.WechatJumpUrls = function(protocol, hostname){
		//{{{ 便于正确显示view的默认选项
        var array=[];
		var urls=[];
		var items=[];
		urls['wechat']=[];	
		urls['topicWeb']=[];
		urls['weiVote']=[];		
        urls['weiService'] = [
            protocol+'//'+hostname+'/plugin/weixin/jbzz/index.html',
            protocol+'//'+hostname+'/plugin/weixin/slys/index.html',
            protocol+'//'+hostname+'/plugin/weixin/ysyj/index.html',            
            protocol+'//'+hostname+'/plugin/weixin/bgdjd/index.html',
            protocol+'//'+hostname+'/plugin/weixin/bztz/index.html',
            protocol+'//'+hostname+'/addons/commodity.php?method=index&type=weixin',
            protocol+'//'+hostname+'/addons/draw.php?method=index&type=weixin',
        ]; 

		items[protocol+'//'+hostname+'/plugin/weixin/jbzz/index.html'] = '疾病自诊';
		items[protocol+'//'+hostname+'/plugin/weixin/slys/index.html'] = '食疗养生';
		items[protocol+'//'+hostname+'/plugin/weixin/ysyj/index.html'] = '饮食宜忌';		
		items[protocol+'//'+hostname+'/plugin/weixin/bgdjd/index.html'] = '检查报告单解读';
		items[protocol+'//'+hostname+'/plugin/weixin/bztz/index.html'] = '体重测试';
		items[protocol+'//'+hostname+'/addons/commodity.php?method=index&type=weixin'] = '微商城';	
		items[protocol+'//'+hostname+'/addons/draw.php?method=index&type=weixin'] = '幸运抽奖';	
/* 		urls['menuClick']=['QNA','EVAL','HMRECORD','REPORT'];		
		items['QNA'] ='体检报告查询';
		items['EVAL'] =	'自我健康监测';
		items['HMRECORD'] =	'健康风险评估';
		items['REPORT'] = '健康评估报告'; */
       
        var data = self.getLocalLink();
        var i = 0;
        $.each(data['single'],function(n,v){        	
        	var url=urls['wechat'][i] = protocol+'//'+hostname+'/'+v.url;
			items[url]=v.name;
			i++;
        });		
		var department=data['department'];		
		for(var k in department){
			i++;
			var dep=department[k]['self'];
			var sonDis=department[k]['son'];
			var url=urls['wechat'][i] = protocol+'//'+hostname+'/'+dep.url;
			items[url]=dep.name;
			$.each(sonDis,function(n,m){
				i++;
				var url=urls['wechat'][i] = protocol+'//'+hostname+'/wechat/'+m.url;
				items[url]=m.name;
			});
		}        
		var channel= data['channel'];
		$.each(channel,function(ckey,cval){			
			i++;
			var url=urls['wechat'][i] = protocol+'//'+hostname+'/'+cval.url;
			items[url]=cval.name;		
		}); 
		//专题列表topicWeb
		self.cmd(gHttp,{controller:'Topic',method:'getTopicUrls'},function(ret){
			if(ret.statu){
				$.each(ret.data,function(n,v){				
					var url =urls['topicWeb'][n]= protocol+'//'+hostname+'/topic/'+v.url+'/'+v.link;			
					items[url]=v.subject;
				});				
			}
		});
		//微投票列表topicWeb
		self.cmd(gHttp,{controller:'Vote',method:'getVoteUrls'},function(ret){
			if(ret.statu){
				$.each(ret.data,function(n,v){				
					var url =urls['weiVote'][n]= protocol+'//'+hostname+v.url;		
					items[url]=v.title;
				});				
			}
		});
		//菜单点击
		
        //商务通
        var swt_link = self.getSwtUrl();
        if (swt_link != '') {
        	i++;
        	urls['wechat'][i] = swt_link;
        }
		array[0]=urls;
		array[1]=items;
		
        return array;
	}
	
	// }}}
	// {{{ function wechatJumpItems()
	
	/**
	 * 微信链接详情
	 * */
	 /*
	this.wechatJumpItems = function(protocol, hostname){
		var items = [];
		items[protocol+'//'+hostname+'/plugin/weixin/jbzz/index.html'] = '疾病自诊';
		items[protocol+'//'+hostname+'/plugin/weixin/slys/index.html'] = '食疗养生';
		items[protocol+'//'+hostname+'/plugin/weixin/ysyj/index.html'] = '饮食宜忌';
		items[protocol+'//'+hostname+'/plugin/weixin/bztz/index.html'] = '标准体重';
		items[protocol+'//'+hostname+'/plugin/weixin/bgdjd/index.html'] = '检查报告单解读';
		
		items[protocol+'//'+hostname+'/wechat/index.php'] = '微站首页';
		items[protocol+'//'+hostname+'/wechat/introduce.php?method=getInfo'] = '微站简介';
		
		var data = self.getLocalLink(2);
		$.each(data['single'],function(i,v){
			var k = protocol+'//'+hostname+'/'+v.url;
        	items[k] = v.name;
        });
        
		//商务通
        var swt_link = self.getSwtUrl();
        if (swt_link != '') {
        	items[swt_link] = '商务通';
        }
        
		var multi = data['multi'];
        for(var i in multi) {
        	$.each(multi[i],function(n,m){
        		var k = protocol+'//'+hostname+'/'+m.url;
	        	items[k] = m.name;
	        	
			});
        }
       
		return items;
	}
	 */
	// }}}
	// {{{ function getLocalLink()
	
	/**
	 * 获取本地链接
	 * */
	this.getLocalLink = function(){		
		var array = [];
		array['single'] = [];
		array['department'] = [];
		array['channel'] = [];
		self.cmd(gHttp,{controller:'MobileNavigation',method:'getHtmlUrl',func:'wechat'},function(ret){
			if(ret.statu){
				data = ret.data;				
				var k = 0;
				$.each(data,function(i,v){
					var op = v.url;
					if (op.split('.').length>1) {
						//原子级链接
						array['single'][k] = v;
						k++;
					} else if(op=='departments'){
						//有子级
						var title = v.name;
						var url = {controller:'MobileNavigation',method:'getHtmlUrlByPara',func:'wechat',op:'departments'};
						self.cmd(gHttp,url,function(departmentsDate){
							if (ret.statu) {
								var dd = departmentsDate.data;								
								if (dd.length>0) {
									$.each(dd,function(j,val){
										array['department'][val.name]=[];
										array['department'][val.name]['self']=[];
										array['department'][val.name]['son']=[];
										array['department'][val.name]['self']=val;
										var url = {controller:'Disease',method:'getWechatDepartSubTree',department_id:val.id};
										self.cmd(gHttp,url,function(diseaseDate){
											if(diseaseDate.statu){												
												array['department'][val.name]['son']=diseaseDate.data;
											}											
										});
										
									});									
								}
							}
						});
					}else if(op=='channel'){
						self.cmd(gHttp,{controller:'Channel',method:'query'},function(channelDate){
							if(channelDate.ttl!=0){								
								array['channel']=channelDate.rows;
							}
						});
						
					}
				})
			}else{
				layer.alert(ret.msg);
			}
			
		});
		return array;
	}
	
	// }}}
	// {{{ function getSwtUrl()
	
	/**
	 * 商务通链接
	 * */
	this.getSwtUrl = function(){
		var swtUrl = '';
		var data = {controller:'Contact',method:'getContacts',flag:'swt_link'};
		self.cmd(gHttp,data,function(dataRet){
			if (dataRet.statu) {
				var swt = dataRet.data;
				if (swt.length>0 && swt.val != '') {
					swtUrl = swt.val;
				}
			}
		});
		return swtUrl;
	}
	
	// }}}
	// {{{ function getSelectOptionsHtml()
	
	/**
	 * 获取选择项内容
	 * */
	this.getSelectOptionsHtml = function(urls, items, selVal){
		var html = '';
		for (var i in urls) {
			var key = urls[i];
			if (selVal != undefined && key==selVal) {
				html += '<option value="'+key+'" selected>'+items[key]+'</option>';
			} else {
				html += '<option value="'+key+'">'+items[key]+'</option>';
			}
		}
		return html;
	}
	/**
	 * 重新选择自动回复操作
	 * */	
	this.selSucaiShwo = function(){
		$('#welSucai').html('<div class="cl bg-1 bk-gray informations" id="chooseMsg"></div>');
		$('#selSucai').html('<a class="btn btn-success radius addpatient_bt bt-normal" onClick="gWeiXin.goToChooseMsg(\'autoReply\',\'welSucai\',\'\',\'reply\');" href="javascript:;"><i class="Hui-iconfont">&#xe61f;</i> 选择图文信息</a>');
		$('#selSucai').show();
	}	
	// }}}
	// {{{ function getMaterialList()
	
	/**
	 * 获取永久素材列表
	 * */
	this.getMaterialList = function(id){
		var view_limitedHtml = '';
		self.cmd(gHttp,{controller:'Weixin',method:'getMaterialList'},function(ret){
			var op = '';
			if(ret.total_count>0){
				$.each(ret.item,function(i,v){
					op+= '<option value="'+v.media_id+'">---'+v.content.news_item[0]['title']+'---</option>';
				});
				view_limitedHtml = '<span id="chooseMsg"><div><a  href="javascript::void(0)" onclick="gWeiXin.getthumblist(\'material\',\''+id+'\',\'menu\');return false;" class="text_a thumb"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe616;</i>&nbsp;&nbsp;选择图文信息</span></a></div></span>';
			}else{
				view_limitedHtml = '<span id="chooseMsg"><div><a  href="javascript::void(0)" onclick="return false;" class="text_a material"><span class="label label-success radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe600;</i>&nbsp;&nbsp;添加图文信息</span></a></div></span>';
			}
		});	
		return view_limitedHtml;
	}
	
	// }}}
	// {{{ function bindKeyWord()
	
	/**
	 * 绑定关键词
	 * */
	this.bindKeyWord = function() {
		var bindKeyWordHtml = '';
		self.cmd(gHttp,{'controller':'Weixin','method':'getAllKeys'},function(result){
			var op = '';
			if(result.statu){
				$.each(result.data,function(i,v){
					op+= '<option value="'+v.id+'">---'+v.keyword+'---</option>';
				});
			}
			bindKeyWordHtml ='<select class="event_set" name="td_optval" ><option value="">---请选择绑定关键词---</option>'+op+'</select>';
			
		});
		
		return bindKeyWordHtml;
	}
	
	// }}}
	// {{{ function goToChooseUrl()
	
	/**
	 * 跳转到选择页面
	 * */
	/*
	this.goToChooseUrl = function(type, objId, selectedItem) {
		console.log(objId,'objId:');
		console.log(selectedItem,'selectedItem:');
	    var title = type == 'wechat' ? '选择微站页面' : '选择图文信息';
		self.openEditWID(title, 'choose-info-item.html?type='+type+'&obj=' + objId + '&selected=' + selectedItem,'620','420');
	}
	*/
	/*
	*打开微站网页列表	
	**/
	this.getweblist=function(type,objId){
		var title = '选择微站页面';
		self.openEditWID(title, 'choose-info-item.html?type='+type+'&obj=' + objId + '&selected=' ,'620','420');
	}
	// }}}
	
	/*
	*打开己添加的图文列表	
	**/
	this.getthumblist=function(type,objId,direction){		
		var title ='选择图文素材' ;
		self.openEditWID(title, 'choose-info-item.html?type='+type+'&obj=' + objId + '&selected='+'&direction='+direction,'620','420');
	}
	
	/*
	*打开微服务列表	
	**/
	this.getweiservicelist=function(type,objId){		
		var title ='选择微服务';
		self.openEditWID(title, 'choose-info-item.html?type='+type+'&obj=' + objId + '&selected=','620','420');
	}
	/*
	*打开专题列表	
	**/
	this.gettopicweblist=function(type,objId){		
		var title ='选择专题页面';
		self.openEditWID(title, 'choose-info-item.html?type='+type+'&obj=' + objId + '&selected=','620','420');
	}	
	// {{{ function goToChooseMsg()
	/*
	*打开菜单点击列表
	**/
	this.getclicklist=function(type,objId){		
		var title ='选择点击列表';
		self.openEditWID(title, 'choose-info-item.html?type='+type+'&obj=' + objId + '&selected=','620','420');
	}	
	
	
	/**
	 * 跳转到选择图文信息页
	 * */
	this.goToChooseMsg = function(from, objId, selectedItem) {
		self.openEditWID('选择图文信息','choose-info-item.html?type=material&from='+from+'&obj=' + objId + '&selected=' + selectedItem+'&direction=reply','620','430')
	}
	
	// }}}
	// {{{ function initChooseUrl()
	
	/**
	 * 初始化选择页面
	 * */
	this.initChooseUrl = function() {
		$(function() {			
			var para = self.parseUrl(window.location.href);
			var type = para.type;
			var objId = para.obj;
			var selected = decodeURI(para.selected);			
			if (type == 'material') {
				var from = para.from;
				var direction = para.direction;
				//图文信息
				self.menuChooseMsg(from,objId, selected,direction);
			} else if(type=='wechatWeb'){
				//微站网页
				self.menuChooseUrl(type,objId,selected);
			}else if(type=='weiService'){
				//微服务列表				
				self.menuChooseServise(type,objId,selected);
			}else if(type=='topicWeb'){
				//专题列表			
				self.menuTopicWeb(type,objId,selected);
			}else if(type=='menuClick'){
				//菜单点击
				self.menuClick(type,objId,selected);				
			}else if(type=='weiVote'){
				//微投票
				self.menuChooseVote(type,objId,selected);				
			}
		});
	}
	
	// }}}
	// {{{ function menuChooseMsg()
	
	/**
	 * 选择图文信息
	 * */
	this.menuChooseMsg = function(from,obj,selected,direction){
		self.cmd(gHttp,{controller:'Weixin',method:'getMaterialList'},function(ret){
			var msgList = '<ul class="normal_item col-12">';
			if(ret.total_count>0){
				$.each(ret.item,function(i,v){
					var checked = '';
					if (selected != undefined && selected == v.content.news_item[0]['title']) {
						checked = 'checked';
					}
					msgList +='<li class="info_item radio-box"><input type="radio" name="msgRadio" url="'+v.content.news_item[0]['url']+'" thumb_url="'+v.content.news_item[0]['thumb_url']+'" title="'+v.content.news_item[0]['title']+'" thumb_media_id="'+v.content.news_item[0]['thumb_media_id']+'" description="'+v.content.news_item[0]['digest']+'" value="'+v.media_id+'" style="position: relative; top:2px;" '+checked+'/><label>'+v.content.news_item[0]['title']+'</label></li>';
					msgList +='';
				});
			}
			msgList += '</ul>';
			$('#contentDiv').html(msgList);
			self.onloadCss();
		});
		
		$('#saveSelected').click(function(){
			var mid = $('input[name="msgRadio"]:checked').val();
	    	if(mid == null){
	    		layer.msg("请选择要执行的操作项目！",{icon:2});
	    		return false;
	    	}else{
	    		var description = $('input[name="msgRadio"]:checked').attr('description');
	    		var title = $('input[name="msgRadio"]:checked').attr('title');
	    		var url = $('input[name="msgRadio"]:checked').attr('url');
	    		var thumb_media_id = $('input[name="msgRadio"]:checked').attr('thumb_media_id');
	    		var thumb_url = $('input[name="msgRadio"]:checked').attr('thumb_url');
		    	//var ch = $("[name=msgRadio]:checked").parent().text();
				if(direction =='menu'){     //菜单列表
					window.parent.gWeiXin.fillMeOpt2(obj,url,title,description,mid);					
				}else if(direction =='reply'){  //自动回复
					window.parent.gWeiXin.fillMeOpt(from,obj,thumb_media_id,url,title,description,mid,thumb_url);
				}else if(direction =='mass'){  //群发消息
					window.parent.gWeiXin.fillMassMessage(obj,mid);						
				}
				//parent.layer_close();
				parent.layer.msg("已选中图文",{icon:1});
				parent.layer.closeAll();
	    	}
		});
		
	}
	/**
	 * 填充群发消息
	 * */
	this.fillMassMessage = function(obj,media_id){						
		self.cmd(gHttp,{controller:'Weixin',method:'getMaterialByMid',id:media_id},function(ret){
			$.each(ret.news_item,function(index,vo){
				$('#tags').val(vo.title);
				$('#author').val(vo.author);
				$('#digest').val(vo.digest);
				$('#pic').val(vo.thumb_url);
				$('#thumbnail').attr('src',vo.thumb_url);
				$('#tmid').val(vo.thumb_media_id);
				editor.setContent(vo.content);
				$('#'+obj +' .tags').text(vo.title);
				$('#'+obj +' .author').text(vo.author);
				$('#'+obj +' .digest').text(vo.digest);
				$('#'+obj +' .pic').text(vo.thumb_url);
				$('#'+obj +' .content').text(vo.content);
				$('#'+obj +' .tmid').text(vo.thumb_media_id);
				if(obj == 'appmsgItem1'){
					$('#'+obj+' .tit').text(vo.title);
					$('#'+obj+' .bg_pic').css({"background-image":"url("+vo.thumb_url+")","background-size":"100% 108px"});
				}else{
					$('#'+obj+' .pic_tit').text(vo.title);
					$('#'+obj+' .bg_pic').css({"background-image":"url("+vo.thumb_url+")","background-size":"78px 78px"});
				}
	
			});
		});
	}
	/**
	 * 填充素材执行操作栏2
	 * */	
	 //mc2SFYqqXrcLHHnvGrsm9wG11bDPVyWNT8aEHW3CLdk thumb_media_id
	 
	 //mc2SFYqqXrcLHHnvGrsm9yGYFGT5-doTGJgch_Ptv00
	this.fillMeOpt2 = function(obj,url,title,description,mid){
			var opthtml ='';
			var temp ='';
			var name = $('#'+obj).attr('name');
			var optkey = name.replace("[opt]","[key]");
			opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+title+'</span><span class="r"><a href="javascript:;" id="div_'+mid+'" title="'+title+'" description="'+description+'"  value="'+mid+'" class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+obj+'\',\'material\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
			temp = '<input type="hidden" class="input-text" name="'+optkey+'" value="'+mid+'" />';
			$('#'+obj).html(opthtml+temp);
	}
	// }}}
	// {{{ function fillMeOpt()
	
	/**
	 * 填充素材执行操作栏
	 * */
	this.fillMeOpt = function(from,obj,thumb_media_id,url,title,description,mid,thumb_url){
		var html = '<span  id="msgSend">'+title+'</span> <span class="r"><a href="javascript:" id="div_'+thumb_media_id+'" thumb_media_id="'+thumb_media_id+'" url="'+url+'" thumb_url="'+thumb_url+'" title="'+title+'" description="'+description+'" value="'+mid+'" class="close_a thumb" onclick="gWeiXin.selSucaiShwo();" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span>';
		if (from == 'autoReply') {
			$('#'+obj).find("#chooseMsg").html(html);
			$('#'+obj).find("input[name$='[url]']").val(mid);
			$('#'+obj).find("input[name$='[key]']").val(mid);			
			$("div[id$='Sucai']").hide();
			$('#welSucai').show();
		} else if(from == 'send') {
			$('#'+obj).find("span#msgSend").text(title);		
		} else {
			$('#'+obj).find("span#chooseMsg").html(html);
			$('#'+obj).find("input[name$='[url]']").val(mid);
			$('#'+obj).find("input[name$='[key]']").val(mid);
		}
		
		//图文点击
		/*
		$(document).on('click',".thumb",function(){
			console.log('3');
			var selected = $(this).parent().parent().attr('title');
			var tdId = $(this).parent().parent().parent().attr("id");
			self.goToChooseMsg(from, tdId, selected);
		});
		*/
	}
	
	// }}}
	/**
	**撤消自定义菜单选择的操作项
	**/
	this.cancelSelect=function(objID,type){
		var weiSerHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.getweiservicelist(\'weiService\',\''+objID+'\');return false;" class="text_a weiService"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe648;</i>&nbsp;&nbsp;请选择微服务</span></a></div></span>';
		var wechatHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.getweblist(\'wechatWeb\',\''+objID+'\');return false;" class="text_a wechat"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe681;</i>&nbsp;&nbsp;请选择微站页面</span></a></div></span>';	
		var topicWebHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.gettopicweblist(\'topicWeb\',\''+objID+'\');return false;" class="text_a topicweb"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe681;</i>&nbsp;&nbsp;请选择专题页面</span></a></div></span>';
		var weiVoteHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.gettopicweblist(\'weiVote\',\''+objID+'\');return false;" class="text_a weivote"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe681;</i>&nbsp;&nbsp;请选择微投票页面</span></a></div></span>';
		var clickHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.getclicklist(\'menuClick\',\''+objID+'\');return false;" class="text_a click"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe681;</i>&nbsp;&nbsp;请选择点击页面</span></a></div></span>';			
		if(type=='material'){
			$('#'+objID).html('<span id="chooseMsg"></span>');	
			var view_limitedHtml = self.getMaterialList(objID);	
			$('#'+objID).html(view_limitedHtml);
		}else if(type=='wechatWeb'){
			$('#'+objID).html(wechatHtml);
		}else if(type=='topicWeb'){
			$('#'+objID).html(topicWebHtml);
		}else if(type=='menuClick'){
			$('#'+objID).html(clickHtml);
		}else if(type=='weiVote'){
			$('#'+objID).html(weiVoteHtml);
		}else{
			$('#'+objID).html(weiSerHtml);
		}		
	}
	
	
	// {{{ function menu()
	
	/**
	 * 自定义菜单
	 * */
	this.menu = function(){
		var view_limitedHtml = '';
		var bindKeyWordHtml ='';
		var protocol = location.protocol;
		var hostname = location.hostname;
        //view的默认选项
		var viewarray = self.WechatJumpUrls(protocol, hostname);
		var view_urls=viewarray[0];
		//view显示值
		var view_items = viewarray[1];
		/*	
		//绑定关键词,该功能去掉
		//bindKeyWordHtml = self.bindKeyWord();	
		*/			


		//响应事件
		$(document).unbind('click').on('change','[name$="[type]"]',function(){
			var type = $(this).find("option:selected").attr('flag');
			var opt_id=$(this).attr('id').replace("Type","Opt");
			var name = $(this).attr('name');
			var optname = name.replace("[type]","[url]");
			var idval=$(this).attr('id');
			var id=idval.substring(0,idval.length-4)+'Opt';	
			switch(name){
				case 'parentOne[type]':var tr = "first";break;
				case 'parentTwo[type]':var tr = "second";break;
				case 'parentThree[type]':var tr = "third";break;
				default: break;
			}			
			var view_limitedHtml = '<span id="chooseMsg"><div><a  href="javascript::void(0)" onclick="gWeiXin.getthumblist(\'material\',\''+id+'\',\'menu\');return false;" class="text_a thumb"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe616;</i>&nbsp;&nbsp;选择图文信息</span></a></div></span>';
			
			var weiSerHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.getweiservicelist(\'weiService\',\''+id+'\');return false;" class="text_a weiService"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe648;</i>&nbsp;&nbsp;请选择微服务</span></a></div></span>';
			var wechatHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.getweblist(\'wechatWeb\',\''+id+'\');return false;" class="text_a wechat"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe681;</i>&nbsp;&nbsp;请选择微站页面</span></a></div></span>';
			var topicHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.gettopicweblist(\'topicWeb\',\''+id+'\');return false;" class="text_a wechat"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe681;</i>&nbsp;&nbsp;请选择专题页面</span></a></div></span>';
			var clickHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.getclicklist(\'menuClick\',\''+id+'\');return false;" class="text_a wechat"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe681;</i>&nbsp;&nbsp;请选择点击页面</span></a></div></span>';
			var weiVoteHtml = '<span id="chooseMsg"><div><a href="javascript::void(0)" onclick="gWeiXin.getclicklist(\'weiVote\',\''+id+'\');return false;" class="text_a wechat"><span class="label label-primary radius" style="padding:8px 16px;"><i class="Hui-iconfont">&#xe681;</i>&nbsp;&nbsp;请选择微投票页面</span></a></div></span>';			
			if(type != ''){
				var hiddenKeys = "#"+tr+"SonOneTr," + "#"+tr+"SonTwoTr," + "#"+tr+"SonThreeTr," + "#"+tr+"SonFourTr," + "#"+tr+"SonFiveTr";
				$(hiddenKeys).hide();
				if(type == 'view_limited'){
					opthtml = view_limitedHtml;
					var temp='';							
				}else if(type == 'view'){
					opthtml = '<input name="td_optval" class="input-text" type="text" >';
					var temp = '<input type="hidden" class="input-text" name="'+optname+'" value="view"/>';
				}else if(type == 'wechat'){
					opthtml = wechatHtml;
					var temp='';
				}else if(type == 'weiService'){
					opthtml = weiSerHtml;
					var temp = '';
				}else if(type == 'weiVote'){
					opthtml = weiVoteHtml;
					var temp = '';
				}else if(type == 'topicWeb'){
					opthtml = topicHtml;
					var temp = '';
				}else if(type == 'menuClick'){
					opthtml = clickHtml;
					optkey = name.replace("[type]","[key]");
					var temp = '<input type="hidden" class="input-text" name="'+optkey+'" value="click"/>';
				}else{
					opthtml="";
					var temp = "";
				}
				$('#'+opt_id).html(opthtml+temp);
			}else{
				var showTr = "#"+tr+"SonOneTr,"+"#"+tr+"SonTwoTr,"+"#"+tr+"SonThreeTr,"+"#"+tr+"SonFourTr,"+"#"+tr+"SonFiveTr";
				$(showTr).show();
				$('#'+opt_id).html("");
			}			
			$('input[name="td_optval"]').change(function(){
				$(this).parent().find("input[name$='[url]']").val($(this).val());
			});
		});	
		
		//判断是否有菜单
		self.cmd(gHttp,{'controller':'Weixin','method':'menuAll'},function(ret1){
			if(ret1.statu){
				$.each(ret1.data,function(index,obj){
					var tags = ['first', 'first', 'second', 'third'];
					var tag = tags[index+1];					
					$('#'+tag+'Name').val(obj.name);
					var list = $('#'+tag+'Type').find('option');
					if(obj.sub_button.length == 0){
						var hiddenKeys = "#"+tag+"SonOneTr," + "#"+tag+"SonTwoTr," + "#"+tag+"SonThreeTr," + "#"+tag+"SonFourTr," + "#"+tag+"SonFiveTr";
						$(hiddenKeys).hide();
					}
					//判断是否为链接
					if(obj.type == 'view'){
						$('#'+tag+'Type').find('option[flag=view]').attr('selected',true);
					}else if(obj.type == 'click'){
						$('#'+tag+'Type').find('option[flag=menuClick]').attr('selected',true);						
					}else{
						$.each(list,function(n,o){
							if(o.value == obj.type){
								o.selected = 'selected';
							}
						});
					}
					var opt = $('#'+tag+'Opt');
					var optt = $('#'+tag+'Type');
					var optkey = opt.attr('name').replace("[opt]","[key]");					
					var opthtml = "";
					if(obj.type != undefined && obj.type != ''){
						//默认数据保存在tr
						var defData = JSON.stringify(obj);
						opt.parent().attr('data', defData);
						var flag = optt.find("option:selected").attr('flag');
						if(obj.type == 'view_limited'){
							//查找图文信息
							self.cmd(gHttp,{'controller':'Weixin','method':'getMaterialByMid', 'id':obj.media_id},function(ret){
								if (ret.errcode == undefined) {
								    var midObj = ret.news_item[0];
									opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+midObj.title+'</span><span class="r"><a href="javascript:;" id="div_'+obj.media_id+'" title="'+midObj.title+'" description="'+midObj.digest+'"  value="'+obj.media_id+'" class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+tag+'Opt\',\'material\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
								} else {
									opthtml = view_limitedHtml;
								}
							});
							var temp = '<input type="hidden" class="input-text" name="'+optkey+'" value="'+obj.media_id+'"/>';								
							opt.html(opthtml+temp);
						}else if(obj.type == 'click'){
							var opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+obj.name+'</span><span class="r"><a href="javascript:;"  title="'+obj.name+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+tag+'\',\'menuClick\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
							var temp = '<input type="hidden" class="input-text"  name="'+optkey+'" value="'+obj.key+'"/>';							
							opt.html(opthtml+temp);						
						}else{								
                                var input_url = opt.attr('name').replace("[opt]","[url]");
                                //微站\微服务\专题
                                for(var i in view_urls) {
                                    var options = view_urls[i];
                                    for(var k in options) {
                                        if (obj.url == options[k]) {
												if(i == 'wechat'){
													var typename = 'wechatWeb';
												}else if(i=='topicWeb'){
													var typename = 'topicWeb';						
												}else if(i=='weiService'){
													var typename = 'weiService';					
												}else if(i=='menuClick'){
													var typename = 'menuClick';															
												}else if(i=='weiVote'){
													var typename = 'weiVote';					
												}
                                        	$('#'+tag+'Type').find('option[flag='+i+']').attr('selected',true);
                                        	opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+view_items[obj.url]+'</span><span class="r"><a href="javascript:;"  title="'+view_items[obj.url]+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+tag+'Opt\',\''+typename+'\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
                                            opthtml += '<input name="'+input_url+'" class="input-text" type="hidden" value="'+obj.url+'">';
                                            opt.html(opthtml);
                                            opt.parent().attr('flag', i);
                                            break;
                                        }
                                    }
                                 }
                                 
                                 if (opthtml) {
                                     //微站或微服务
                                     opt.html(opthtml);
                                     $('#'+tag+'Opt').find("select").val(obj.url);
                                 } else {
                                     //链接
                                     opthtml = '<input name="'+input_url+'" class="input-text" type="hidden" value="'+obj.url+'">';
                                        opthtml += '<input name="td_optval" class="input-text" type="text" value="'+obj.url+'">'; 
                                     opt.html(opthtml);
                                     opt.find("input[type=hidden]").val(obj.url);
                                 }
                            $(document).on('change','[name="td_optval"]',function(){
                                 $(this).prev('input').val($(this).val());
                            });

                            }
					}
					
					//判断是否有子菜单
					if(obj.sub_button.length>0){
						$.each(obj.sub_button,function(i,v){
							var tags = [tag+'SonOne', tag+'SonOne', tag+'SonTwo', tag+'SonThree', tag+'SonFour', tag+'SonFive'];
							var son = tags[i+1];
							$('#'+son+'Name').val(v.name);
							var list = $('#'+son+'Type').find('option');
							//判断 响应事件类型
							if(v.type == 'view'){
								$('#'+son+'Type').find('option[flag=view]').attr('selected',true);
							}else if(v.type == 'view_limited'){
								$('#'+son+'Type').find('option[flag=view_limited]').attr('selected',true);
							}else if(v.type == 'click'){
								$('#'+son+'Type').find('option[flag=menuClick]').attr('selected',true);								
							}else{
								$.each(list,function(n,o){
									if(o.value == v.type){
										o.selected = 'selected';
									}
								});
							}
																													
							var sonopthtml = "";
							var sonopt = $('#'+son+'Opt');
							var sonoptkey = sonopt.attr('name').replace("[opt]","[key]");

							if(v.type != undefined && v.type != ''){
								//默认数据保存在tr
								var defData = JSON.stringify(v);
								sonopt.parent().attr('data', defData);
								if(v.type == 'view_limited'){
									//查找图文信息
									self.cmd(gHttp,{'controller':'Weixin','method':'getMaterialByMid', 'id':v.media_id},function(ret){
										if (ret.errcode == undefined) {
										    var midObj = ret.news_item[0];
										    sonopthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+midObj.title+'</span><span class="r"><a href="javascript:;" id="div_'+obj.media_id+'" title="'+midObj.title+'" description="'+midObj.digest+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+son+'Opt\',\'material\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
										} else {
											sonopthtml = view_limitedHtml;
										}
									});
									var temp = '<input type="hidden" class="input-text" name="'+sonoptkey+'" value="'+v.media_id+'"/>';								
									sonopt.html(sonopthtml+temp);
								}else if(v.type == 'view'){
									if (v.type == 'view') {
	                                    var input_url = sonopt.attr('name').replace("[opt]","[url]");
	                                    var input_type = sonopt.attr('name').replace("[opt]","[type]");
	                                    //weiSerHtml   wechatHtml topicWeb
	                                    for(var i in view_urls) {
	                                        var options = view_urls[i];
	                                        for(var k in options) {
	                                            if (v.url == options[k]) {
													if(i == 'wechat'){
														var typename = 'wechatWeb';
													}else if(i=='topicWeb'){
														var typename = 'topicWeb';						
													}else if(i=='weiService'){
														var typename = 'weiService';					
													}else if(i=='menuClick'){
														var typename = 'menuClick';															
													}else if(i=='weiVote'){
														var typename = 'weiVote';															
													}
													sonopthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+view_items[v.url]+'</span><span class="r"><a href="javascript:;"  title="'+view_items[v.url]+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+son+'Opt\',\''+typename+'\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
	                                            	sonopthtml += '<input name="'+input_url+'" class="input-text" type="hidden" value="'+v.url+'">';
	                                                $("#"+son+"Type option[flag='"+i+"']").attr('selected', true);
	                                                sonopt.parent().attr('flag', i);
	                                                break;
	                                            }
	                                        }
	                                     }
	                                     
	                                     if (sonopthtml) {
	                                         //下拉而不是链接
	                                    	 sonopt.html(sonopthtml);
	                                         $('#'+son+'Opt').find("select").val(v.url);
	                                     } else {
	                                         //链接
											 sonopthtml = '<input name="'+input_url+'" class="input-text" type="hidden" value="'+v.url+'">';									
	                                    	 sonopthtml += '<input name="td_optval" class="input-text" type="text" value="'+v.url+'">';
	                                         sonopt.html(sonopthtml);
	                                         sonopt.find("input[type=hidden]").val(v.url);
	                                     }
	                                     
	                                     $(document).on('change','[name="'+son+'Optval'+'"]',function(){
	                                         $(this).prev('input').val($(this).val());
	                                     });

	                                } else {
	                                    sonopthtml = '<input name="'+son+'Optval'+'" class="input-text" type="text" value="'+v.url+'">';
										sonopt.html(sonopthtml);
										sonopt.find("input[type=hidden]").val(v.url);
	                                }
								}else if(v.type == 'bindKeyWord'){
									sonopthtml = '<select name="'+son+'Optval'+'" class="event_set"><option value="">---请选择绑定关键词---</option></select>';
									sonopt.html(sonopthtml);
									sonopt.find("input[type=hidden]").val(v.url);
								}else if(v.type == 'wechat'){
									sonopthtml = '<select name="'+son+'Optval'+'" class="event_set"><option value="">---请选择微站---</option></select>';
									sonopt.html(sonopthtml);
									sonopt.find("input[type=hidden]").val(v.url);
								}else if(v.type == 'weiService'){
									sonopthtml = '<select name="'+son+'Optval'+'" class="event_set"><option value="">---请选择微服务---</option></select>';
									sonopt.html(sonopthtml);
									sonopt.find("input[type=hidden]").val(v.url);
								}else if(v.type == 'weiVote'){
									sonopthtml = '<select name="'+son+'Optval'+'" class="event_set"><option value="">---请选择微投票---</option></select>';
									sonopt.html(sonopthtml);
									sonopt.find("input[type=hidden]").val(v.url);
								}else if(v.type == 'click'){
	                                    var input_click = sonopt.attr('name').replace("[opt]","[key]");								
										var opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+v.name+'</span><span class="r"><a href="javascript:;"  title="'+v.name+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+son+'Opt\',\'menuClick\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
							          var temp = '<input type="hidden" class="input-text"  name="'+input_click+'" value="'+v.key+'"/>';								
									sonopt.html(opthtml+temp);										
								}
                            $(document).on('change','[name="td_optval"]',function(){
                                 $(this).prev('input').val($(this).val());
                            });
							}								
						});
					}
				});
			}else{
				layer.alert(ret1.msg);
				return false;
			}
			/*
			//图文点击
			$(document).on('click',".thumb",function(){
				console.log('1');
				var selected = $(this).parent().attr('title');
				var tdId = $(this).parent().parent().parent().attr("id");;
				self.goToChooseMsg('menu',tdId,selected);
			});
			*/
			//添加素材
			$(document).on('click','.material',function(){
				self.openEdit('新增素材','add-text.html','1050','650');
			});
			
		});
		//保存菜单
		$('#savemenu').click(function(){
			var flag =  true;
			var RegUrl = new RegExp(); 
			RegUrl.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
			if($('#firstName').val() != ''){
				if($('#firstName').val().length > 4){
					layer.alert('主菜单一名称为《'+$('#firstName').val()+'》多于4个字，请酌减');
					return false;
				}
				var type = $('#firstType').val();
				if(type !== ''){
					if($('#firstSonOneName').val() != ''){
						if($('#firstSonOneName').val().length>7){
							layer.alert('子菜单的名称为《'+$('#firstSonOneName').val()+'》多于7个字，请酌减');
							return false;
						}
						var type = $('#firstSonOneType').val();
						if(type == ''){
							layer.alert('子菜单的名称为《'+$('#firstSonOneName').val()+'》的事件类型不能为空！');
							return false;
						}
					}						
				}
			}				
			var dataArray = {};
			var data = $('#form1').serializeArray();
			$.each(data,function(i,obj){
				dataArray[obj.name] = obj.value;
			});
			
			dataArray.controller = 'Weixin';
			dataArray.method = 'setMenu';
			if(flag){
				self.cmd(gHttp,dataArray,function(ret){
					if(ret.statu){
						self.menu();
						parent.layer.msg(ret.msg,{icon: 1});
					}else{
						parent.layer.msg(ret.msg,{icon: 2});
						flag = false;
					}
				});
			}
		});
		
		//清空菜单
		$('#clearMenu').click(function(){
			layer.confirm('确认要删除吗？',function(index){
				self.cmd(gHttp,{'controller':'Weixin','method':'deleteMenu'},function(ret){
					if(ret.statu){
						var url=parent.location.href;
						parent.location.replace(url);
						parent.layer.msg('操作成功!',{icon: 1});	
						layer.close(index);
					}else{
						layer.alert('删除失败!',{icon:2});
						layer_close();
					}
					return false;
				})
			});
		});
	}
	
	// }}}
	// {{{ function weixineditor()
	
	/**
	 * 添加图文信息
	 * */
	this.weixineditor = function(){
		//获取参数
		var para = self.parseUrl(window.location.href);
		var flag = para.flag == undefined ? 1 : para.flag;
		var id = para.id == undefined ? '' : para.id;
		var media_id = para.media_id == undefined ? '' : para.media_id;
		var thumb = para.thumb_id == undefined ? '' : para.thumb_id;
		var picfile = para.filename == undefined ? '' : para.filename;
		var editdata = self.fillEditSucai(id,media_id,thumb,flag,picfile);
		
		//默认都是图文素材，若以后分类型再放开此开关
		flag = 1;
		
		if(flag ==1 ){
			var material = 'material';
		}else{
			var material = '';
		}	
		if(editdata!=undefined && editdata!= null &&editdata !=""){
			var data1 = {'controller':'Weixin','method':'updateMessage','material':material,'media_id':media_id,'id':id,'thumb_media_id':thumb};
		}else{
			var data1 = {'controller':'Weixin','method':'uploadMessage','material':material};
		}

		$('#save').click(function(){
				var fileName = $('#pic').val() ? $('#pic').val() : '';
				data1['fileName'] = fileName;
			$('#wechateditor').checkAndSubmit('save',data1,function(ret){	
				if(ret.statu){
					parent.layer.alert('素材操作成功',{icon:1});
					window.parent.gWeiXin.getNewsByType();
					layer_close();
				}else{
					layer.alert(ret.msg);
				}			
			});
			$('#wechateditor').submit();
		});
		
		$("#addColor").click (function() {
			$(".sp-container").toggle();
		});

		if ($("#full").length>0) {
			 $("#full").spectrum({
				    color: "#ECC",
				    flat: true,
				    showInput: true,
				    className: "full-spectrum",
				    preferredFormat: "hex",
				    chooseText: "确定",
				    cancelText: "取消",
				    hide: function (color) {
				    alert(color);
				    },
				    change: function(color) {
				        var color = color.toHexString();
				        $("#addColor").before('<li class="colorli" style="background-color: '+color+';" onclick="changeColor(\''+color+'\')"><span class="delColor" id="delColor_'+color+'">X</span></li>');
				        
				        $("span[id^='delColor_']").click(function(e){e.stopPropagation(); $(this).parent().remove()});
				        
				        $(".sp-container").hide();
				    }
			});

		    $(".sp-container").hide();
		    $(".sp-cancel").click(function(){$(".sp-container").hide();});
		
		}
		
		//初次加载
		var data = {'controller':'Weixin','method':'getWechatContent','type':'1'};
		self.cmd(gHttp,data,function(ret){
			if(!ret.statu){
				layer.alert(ret.msg);
			}
			var html = '';
			var data = ret.data;
			for(var i in data) {
				html += '<div class="list_content">';
				html += '<p>' + data[i].wec_name + '</p>';
				html += '' + data[i].content + '';
				html += '</div>';
			}
			$('#info_group').html(html);
		});
		
		if(flag!=undefined && flag!=null){
			$("[name=flag]").val(flag);
		}			
		if(editdata!=undefined && editdata!= null &&editdata !=""){				
			$.each(editdata[0],function(i,v){
				$("[name="+i+"]").val(v);
			});
			$("#thumbnail").attr('src',picfile);
			$("#pic").val(picfile);
		}
		//删除缩略图
		$(document).on('click',"#delete-thisimg",function() {	
			$('#thumbnail').attr('src','/hcc/images/boyicms/logo/thumbnail_auto.gif');
			$('#pic').val('');
		});
		$(document).on('click','.list_content',function(){
			var c = $(this).html();
			editor.ready(function(){
				editor.setContent(c);
			});
		});
		
		$("#style-categories li").click(function(){
			if($(this).hasClass("allmenu_li")){
				$("#style-categories li.active").removeClass("active");
				$(this).addClass("active");
				var type = $(this).attr('flag');
				$('#info_group').html('');
				if (type == '11') {
					var data = {'controller':'Library','method':'query'};
					self.cmd(gHttp,data,function(ret){
						var html = '';
						var data = ret.rows;
						if (data == '') return false;
						for(var i in data) {
							html += '<div class="list_content">';
							if (data[i].wec_name != '') {
								html += '<p>' + data[i].name + '</p>';
							}
							if (data[i].content != '') {
								html += data[i].content;
							}
							html += '</div>';
						}
						$('#info_group').html(html);
					});
					return false;
				}
				var data = {'controller':'Weixin','method':'getWechatContent','type':type};
				self.cmd(gHttp,data,function(ret){
					if(!ret.statu){
						layer.alert(ret.msg);
					}
					var html = '';
					var data = ret.data;
					for(var i in data) {
						html += '<div class="list_content">';
						if (data[i].wec_name != '') {
							html += '<p>' + data[i].wec_name + '</p>';
						}
						if (data[i].content != '') {
							html += data[i].content;
						}
						html += '</div>';
					}
					$('#info_group').html(html);
				});
			}							  
		});
		self.onloadCss();
	}

	// }}}
	// {{{ function fillEditSucai()
	
	/**
	 * 填充素材编辑数据
	 * */
	this.fillEditSucai = function(id,media_id,thumb_id,flag,picfile) {
		if(flag == 0){  //临时
/*					var method='getMessageById';
				getData({controller:'Weixin',method:method,id:id},function(ret){
					self.weixineditor(flag,ret.data,picfile,'',id);
				});*/
		}else{  //永久素材
			var method='getMaterialByMid';
			var news_item = [];
			self.cmd(gHttp,{controller:'Weixin',method:method,id:id},function(ret){	
				news_item = ret.news_item;
			});
            return news_item;
		}
	}
	
	// }}}
	// {{{ function menuChooseUrl()
	
	/**
	 * 选择微站页面
	 * */
	this.menuChooseUrl = function(type, obj, selected){		
		var self = this;		
		var itemList = '';		
		var multiList = '';
		var channelList = '';		
		//微站特殊处理，将有子级的部分分开展示
		itemList += '<h3>医院基础信息</h3>';
		itemList += '<ul class="normal_item col-12">';
		var protocol = location.protocol;
		var hostname = location.hostname;		
		var checked = '';		
		//以下是获取的真实链接          
		var data = self.getLocalLink();				
		$.each(data['single'],function(i,v){
			//单链接
			v.url = protocol+'//'+hostname+'/'+v.url;
			if (selected != undefined && selected == v.url) {
				checked = 'checked';
			}
			itemList +='<li class="info_item radio-box mg-1"><input type="radio" name="msgRadio" title="'+v.name+'" value="'+v.url+'" '+checked+'/><label>'+v.name+'</label></li>';
		});
	  
		itemList += '</ul>';
		
		//子级链接
		var department = data['department'];
		for(var i in department) {
			multiList += '<h3>'+i+'链接</h3><ul class="normal_item col-12">';				
			var dep=department[i]['self'];
			var sonDis=department[i]['son'];
			dep.url=protocol+'//'+hostname+'/'+dep.url;
			multiList +='<li class="col-12 radio-box mg-2" style="clear:both;"><input type="radio" name="msgRadio" title="'+dep.name+'" value="'+dep.url+'" '+checked+'/><label>'+dep.name+'</label></li>';
			$.each(sonDis,function(n,m){
				m.url = protocol+'//'+hostname+'/wechat/'+m.url;
				multiList +='<li class="info_item radio-box mg-1"><input type="radio" name="msgRadio" title="'+m.name+'" value="'+m.url+'" '+checked+'/><label>'+m.name+'</label></li>';
				
			});
			multiList += '</ul>';
		}
		//个性频道
		var channel=data['channel'];
		if(channel.length>0){
			channelList += '<h3>个性频道链接</h3><ul class="normal_item col-12">';	
			$.each(channel,function(k,v){
				v.id = protocol+'//'+hostname+'/wechat/channel.php?method=query&channel_id='+v.id;
				channelList +='<li class="info_item radio-box mg-1"><input type="radio" name="msgRadio" title="'+v.name+'" value="'+v.id+'" '+checked+'/><label>'+v.name+'</label></li>';
			});
			channelList += '</ul>';
		}
        var content = '';
		if (itemList != '') {
			content += '<div class="infolist cl">';
			content += itemList;
			content += '</div>'
		}
		if (multiList != '') {
			content += '<div class="infolist cl">';
			content += multiList;
			content += '</div>'
		}
		if (channelList != '') {
			content += '<div class="infolist cl">';
			content += channelList;
			content += '</div>'
		}
		$("#contentDiv").html(content);
		self.onloadCss();
		$('#saveSelected').click(function(){
			var link = $('input[name="msgRadio"]:checked').val();
	    	if(link == null){
	    		layer.msg("请选择要执行的操作项目！",{icon:2});
	    		return false;
	    	}else{			
	    		parent.layer.msg("操作成功！",{icon:1});
	    		var title = $('input[name="msgRadio"]:checked').attr('title');
		    	//var ch = $("[name=msgRadio]:checked").parent().text();
		    	window.parent.gWeiXin.fillOpt(obj,title,link,type);
		    	layer.closeAll();
		    	layer_close();
	    	}
		});
	}
	// }}}
	// {{{ function menuTopicWeb()
	
	/**
	 * 选择菜单点击
	 * */
	this.menuClick=function(type, obj, selected){
		var self = this;
		var checked = '';
		var itemList = '<ul class="normal_item col-12">';
		
		array=[];array[0]=[];array[1]=[];array[2]=[];array[3]=[];array[4]=[];array[5]=[];array[6]=[];
		array[0]['name']='体检报告查询';
		array[0]['click']='REPORT';
		array[1]['name']='自我健康监测';
		array[1]['click']='HMRECORD';
		array[2]['name']='健康风险评估';
		array[2]['click']='QNA';
		array[3]['name']='健康评估报告';
		array[3]['click']='EVAL';
		array[4]['name']='联系方式';
		array[4]['click']='CONTACT';
		array[5]['name']='注册咨询';
		array[5]['click']='REGISTER';
		array[6]['name']='健康管理服务';
		array[6]['click']='HEALTH';
		$.each(array,function(k,v){
			itemList +='<li class="info_item radio-box mg-1"><input type="radio" name="msgRadio" title="'+v.name+'" value="'+v.click+'" '+checked+'/><label>'+v.name+'</label></li>';			
		});
		itemList += '</ul>';
		$('#contentDiv').html(itemList);
		self.onloadCss();
		$('#saveSelected').click(function(){
			var link = $('input[name="msgRadio"]:checked').val();
	    	if(link == null){
	    		layer.msg("请选择要执行的操作项目！",{icon:2});
	    		return false;
	    	}else{			
	    		parent.layer.msg("操作成功！",{icon:1});
	    		var title = $('input[name="msgRadio"]:checked').attr('title');
		    	window.parent.gWeiXin.fillOpt(obj,title,link,type);
		    	layer.closeAll();
		    	layer_close();
	    	}
		});		
		
	}
	// }}}
	// {{{ function menuTopicWeb()
	
	/**
	 * 选择专题页面
	 * */
	this.menuTopicWeb=function(type, obj, selected){
		var self = this;
		var checked = '';
		var itemList = '<ul class="normal_item col-12">';
		var protocol = location.protocol;
		var hostname = location.hostname;
		self.cmd(gHttp,{controller:'Topic',method:'getTopicUrls'},function(ret){
			if(ret.statu){
				$.each(ret.data,function(i,v){
					itemList +='<li class="info_item radio-box mg-1"><input type="radio" name="msgRadio" title="'+v.subject+'" value="'+protocol+'//'+hostname+'/topic/'+v.url+'/'+v.link+'" '+checked+'/><label>'+v.subject+'</label></li>';
				});				
			}
		});	
		itemList += '</ul>';
		$('#contentDiv').html(itemList);
		self.onloadCss();
		$('#saveSelected').click(function(){
			var link = $('input[name="msgRadio"]:checked').val();
	    	if(link == null){
	    		layer.msg("请选择要执行的操作项目！",{icon:2});
	    		return false;
	    	}else{			
	    		parent.layer.msg("操作成功！",{icon:1});
	    		var title = $('input[name="msgRadio"]:checked').attr('title');
		    	//var ch = $("[name=msgRadio]:checked").parent().text();
		    	window.parent.gWeiXin.fillOpt(obj,title,link,type);
		    	layer.closeAll();
		    	layer_close();
	    	}
		});		
	}
	/**
	 * 选择微投票页面
	 * */
	this.menuChooseVote=function(type, obj, selected){
		var self = this;
		var checked = '';
		var itemList = '<ul class="normal_item col-12">';
		var protocol = location.protocol;
		var hostname = location.hostname;
		self.cmd(gHttp,{controller:'Vote',method:'getVoteUrls'},function(ret){
			if(ret.statu){
				$.each(ret.data,function(i,v){
					itemList +='<li class="info_item radio-box mg-1"><input type="radio" name="msgRadio" title="'+v.title+'" value="'+protocol+'//'+hostname+v.url+'" '+checked+'/><label>'+v.title+'</label></li>';
				});				
			}
		});	
		itemList += '</ul>';
		$('#contentDiv').html(itemList);
		self.onloadCss();
		$('#saveSelected').click(function(){
			var link = $('input[name="msgRadio"]:checked').val();
	    	if(link == null){
	    		layer.msg("请选择要执行的操作项目！",{icon:2});
	    		return false;
	    	}else{			
	    		parent.layer.msg("操作成功！",{icon:1});
	    		var title = $('input[name="msgRadio"]:checked').attr('title');
		    	//var ch = $("[name=msgRadio]:checked").parent().text();
		    	window.parent.gWeiXin.fillOpt(obj,title,link,type);
		    	layer.closeAll();
		    	layer_close();
	    	}
		});		
	}
	// }}}
	// {{{ function fillOpt()
	
	/**
	 * 选择微服务
	 * */
	this.menuChooseServise=function(type, obj, selected){
		var self = this;		
		var itemList = '<ul class="normal_item col-12">';
		var protocol = location.protocol;
		var hostname = location.hostname;
		var checked = '';	
		array=[];array[0]=[];array[1]=[];array[2]=[];array[3]=[];array[4]=[];array[5]=[];array[6]=[];
		array[0]['name']='疾病自诊';
		array[0]['url']=protocol+'//'+hostname+'/plugin/weixin/jbzz/index.html';
		array[1]['name']='食疗养生';
		array[1]['url']=protocol+'//'+hostname+'/plugin/weixin/slys/index.html';
		array[2]['name']='饮食宜忌';
		array[2]['url']=protocol+'//'+hostname+'/plugin/weixin/ysyj/index.html';
		array[3]['name']='报告单';
		array[3]['url']=protocol+'//'+hostname+'/plugin/weixin/bgdjd/index.html';
		array[4]['name']='体重测试';
		array[4]['url']=protocol+'//'+hostname+'/plugin/weixin/bztz/index.html';
		array[5]['name']='微商城';
		array[5]['url']=protocol+'//'+hostname+'/addons/commodity.php?method=index&type=weixin';
		array[6]['name']='幸运抽奖';
		array[6]['url']=protocol+'//'+hostname+'/addons/draw.php?method=index&type=weixin';		
		$.each(array,function(k,v){
			itemList +='<li class="info_item radio-box mg-1"><input type="radio" name="msgRadio" title="'+v.name+'" value="'+v.url+'" '+checked+'/><label>'+v.name+'</label></li>';			
		});
		itemList += '</ul>';
		$('#contentDiv').html(itemList);
		self.onloadCss();
		$('#saveSelected').click(function(){
			var link = $('input[name="msgRadio"]:checked').val();
	    	if(link == null){
	    		layer.msg("请选择要执行的操作项目！",{icon:2});
	    		return false;
	    	}else{			
	    		parent.layer.msg("操作成功！",{icon:1});
	    		var title = $('input[name="msgRadio"]:checked').attr('title');
		    	//var ch = $("[name=msgRadio]:checked").parent().text();
		    	window.parent.gWeiXin.fillOpt(obj,title,link,type);
		    	layer.closeAll();
		    	layer_close();
	    	}
		});
	}
	
	
	/**
	 * 填充执行操作栏
	 * */
	this.fillOpt = function(obj,title,link,type){
			var name = $('#'+obj).attr('name');
			if(type =="menuClick"){
				var optname = name.replace("[opt]","[key]");			
			}else{
				var optname = name.replace("[opt]","[url]");			
			}

		var opthtml ='';
		var temp = '';
		if(type=='weiService'){
			opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+title+'</span><span class="r"><a href="javascript:;"  title="'+title+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+obj+'\',\'weiService\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
			var temp = '<input type="hidden" class="input-text" value="'+link+'" name="'+optname+'" />';
		}else if(type=='wechatWeb'){
			opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+title+'</span><span class="r"><a href="javascript:;"  title="'+title+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+obj+'\',\'wechatWeb\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
			var temp = '<input type="hidden" class="input-text" value="'+link+'" name="'+optname+'" />';
		}else if(type=='topicWeb'){
			opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+title+'</span><span class="r"><a href="javascript:;"  title="'+title+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+obj+'\',\'topicWeb\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
			var temp = '<input type="hidden" class="input-text" value="'+link+'" name="'+optname+'" />';
		}else if(type=='menuClick'){
			opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+title+'</span><span class="r"><a href="javascript:;"  title="'+title+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+obj+'\',\'menuClick\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
			var temp = '<input type="hidden" class="input-text" value="'+link+'" name="'+optname+'" />';
		}else if(type=='weiVote'){
			opthtml = '<span id="chooseMsg"><span class="l infomation_span" id="msgSend">'+title+'</span><span class="r"><a href="javascript:;"  title="'+title+'"   class="close_a thumb" onclick="gWeiXin.cancelSelect(\''+obj+'\',\'weiVote\');return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span></span>';
			var temp = '<input type="hidden" class="input-text" value="'+link+'" name="'+optname+'" />';
		}else{
			opthtml = '';
			temp = '';
		}
		$('#'+obj).html(opthtml+temp);
	}
	
	// }}}
	// {{{ function initAutoReply()
	
	/**
	 * 初始化自动回复
	 * */
	this.initAutoReply = function() {
		$(function(){
			self.fillAutoReplyTable();
			
			$(".tabBar span").click(function(){
				var index = $(this).index();
				if (index == '0') {
					self.fillAutoReplyTable();
				} else {
					$("div[id$='Sucai']").hide();
					//关注时回复
					self.cmd(gHttp,{controller:'Weixin',method:'isSetSub'},function(ret){
						if(ret.statu){
							$("div.iradio-blue").removeClass('checked');
							if(ret.data.msgtype == "text"){
								$('input[name="focusType"][value="0"]').attr("checked",true);
								$('input[name="focusType"][value="0"]').parent().addClass('checked');
								$("#viewEmo").html(ret.data.content);
								$("#reply_contain").val(ret.data.content);
							}else if(ret.data.msgtype == "news"){
								if (ret.data.Atitle != null && ret.data.Atitle != '') {
									$.each(ret.data.Atitle,function(i,v){
										 var html = '<span class="l infomation_span" id="msgSend">'+v+'</span> <span class="r"><a href="javascript:" class="close_a thumb" onclick="gWeiXin.selSucaiShwo();" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span>'; 
										$("#chooseMsg").html(html);
									});
								}
								$('input[name="focusType"][value="1"]').attr("checked",true);
								$('input[name="focusType"][value="1"]').parent().addClass('checked');
								$('#welSucai').show();
								
/* 								//图文点击
								$(document).on('click',".thumb",function(){
									var selected = $(this).parent().parent().attr('title');
									var tdId = $(this).parent().parent().parent().attr("id");
									self.goToChooseMsg('autoReply', tdId, selected);
								}); */
							}
						} else {
							//根据是否有素材显示不同的操作
							self.cmd(gHttp,{controller:'Weixin',method:'getMaterialList'},function(ret){
								if(ret.total_count==0){
									$('#addSucai').show();
								} else {
									$('#selSucai').show();
								}
							});
						}
					});
				}
			});
			
			//表情与编辑框切换
			self.emoChangeEvent();
			
			$("#qry").click(function(){
				self.getKeyByName();
			});
			
			//保存关注时回复
			$('#saveFocus').click(function(){
				self.saveFocusReply();
			});
			
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			$.Huifold("#Huifold1 .item h4","#Huifold1 .item .info","fast",2,"click"); /*5个参数顺序不可打乱，分别是：相应区,隐藏显示的内容,速度,类型,事件*/
			$('.skin-minimal input').iCheck({
				checkboxClass: 'icheckbox-blue',
				radioClass: 'iradio-blue',
				increaseArea: '20%'
			});
		});
		//获取回复图文内容
		$("#setimage").click(function(){
				//根据是否有素材显示不同的操作selSucai
				self.cmd(gHttp,{controller:'Weixin',method:'getMaterialList'},function(ret){
					if(ret.total_count==0){
						$('#addSucai').show();
					} else {
						$('#selSucai').show();
					}
						$('#setimage').attr("checked",true);
						$('#setimage').parent().addClass('checked');
						$('#chooseMsg').html('');
				});
		});		
	}

	// }}}
	// {{{ function fillAutoReplyTable()
	
	/**
	 * 自动回复列表
	 * */
	this.fillAutoReplyTable = function() {
		$('#dataTable').grid({
            size : 10,
            para : {controller:'Weixin',method:'issetKeysword'},
            createdRow : function(nRow, aData, iDataIndex){
            	$('td:eq(1)', nRow).html(iDataIndex + 1);
            	$('td:eq(0)', nRow).html('<input type="checkbox" name="tr_'+iDataIndex+'" id="'+aData.keyword+'" value="'+aData.id+'">');
            	if(aData.msgtype == 'text') {
            		$('td:eq(3)', nRow).html(self.replaceEm(aData.content));
            	} else {
            		var Atitle = aData.Atitle == null ? '' : aData.Atitle['1'];
            		$('td:eq(3)', nRow).html(Atitle);
            	}
            },
            order : false,
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}												
							],
            field : [
			    {data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+row.id+'">';
			            	}},
				{data:'id'},
			    {data:'keyword'},
                {data:'content'},
                {data:'msgtype'},
                {data:'id',render : function(id,type,row){
                	    var str = '';
	                	if(row.msgtype == 'text'){
	                		str += '<a style="text-decoration:none" onClick="gWeiXin.openEdit(\'编辑关键词回复信息\',\'add-keywords.html?keyword='+row.keyword+'&msgtype='+row.msgtype+'&content='+encodeURI(row.content)+'\',\'650\',\'500\')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe60c;</i></a>';
						}else{
							var Aurl = row.Aurl == null ? '' : row.Aurl['1'];
							var Apicurl = row.Apicurl == null ? '' : row.Apicurl['1'];
							var Atitle = row.Atitle == null ? '' : row.Atitle['1'];
							str = '<a style="text-decoration:none" onClick="gWeiXin.openEdit(\'编辑关键词回复信息\',\'add-keywords.html?keyword='+row.keyword+'&title='+Atitle+'&msgtype='+row.msgtype+'&aurl='+encodeURI(Aurl)+'&apicurl='+encodeURI(Apicurl)+'\',\'650\',\'500\')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe60c;</i></a>';
						}
                        str += ' <a style="text-decoration:none" class="ml-5" onClick="gWeiXin.delKeywordReply(\''+row.id+'\');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
                        return str;
                    }
                }
            ]
       });
	}
	
	// }}}
	// {{{ function getKeyByName()
	
	/**
	 * 通过关键字查找
	 * */
	this.getKeyByName = function() {
		var keywordname = $("#keywordname").val();
		self.cmd(gHttp,{controller:'Weixin',method:'getKeyByName',keyname:keywordname},function(ret){
			var h = '';				
			if(ret){
				if(ret.data.msgtype == 'text'){
					  h +=' <tr class="infotr">'
						+'<td class="numtd" align="center"><input type="checkbox" name="check_one" value="0"/></td>'
						+'<td align="center">'+ret.data.keyword+'</td>'
						+'<td align="left" name="content">'+ret.data.content+'</td>'
						+'<td align="center">'+ret.data.msgtype+'</td>'
						+'<td align="center"><a href="javascript::void(0)" onclick="gWeiXin.openEdit(\'编辑关键词回复信息\',\'add-keywords.html?id='+ret.data.id+'\',\'650\',\'500\')" msgtype="'+ret.data.msgtype+'" name="0">编辑</a><a href="javascript::void(0)" name="0" class="delKeywords">删除</a></td></tr>';					
				}else{
					 h +=' <tr class="infotr">'
					   +'<td class="numtd" align="center"><input type="checkbox" name="check_one" value="0"/></td>'
					   +'<td align="center">'+ret.data.keyword+'</td>'
					   +'<td align="left" name="content">'+ret.data.Atitle['1']+'</td>'
					   +'<td align="center">'+ret.data.msgtype+'</td>'
					   +'<td align="center"><a href="javascript::void(0)" onclick="gWeiXin.openEdit(\'编辑关键词回复信息\',\'add-keywords.html?id='+ret.data.id+'\',\'650\',\'500\')" msgtype="'+ret.data.msgtype+'"  aurl="'+ret.data.Aurl['1']+'" apicurl="'+ret.data.Apicurl['1']+'" class="editKeyWords" name="0">编辑</a><a href="javascript::void(0)" onclick="return false" name="0" class="delKeywords">删除</a></td></tr>';					
				}
			var temp = ' <tr class="titletr"><td width="30px;"><input type="checkbox" id="check_all" /></td>'
				 +'<td width="100px;">关键词</td>'
				 +'	<td>回复内容</td>'
				 +'<td width="80px;">回复格式</td>'
				 +'	<td width="90px;">操作</td></tr>';						
			$(".tablebox table tbody ").html(temp+h);
			
			}else{
				layer.alert('没有找到搜索的关键词');
				return false;
			}
			
		
		});
	}
	
	// }}}
    // {{{ function delKeywordReply()
	
	/**
	 * 删除关键字回复
	 * */
	this.delKeywordReply = function(id) {
		var obj = $("#dataTable").dataTable();
		self.openDel(obj,{'controller':'Weixin','method':'deleteKeyById','keyid':id});
	}
	
	// }}}
    // {{{ function delBatchKeywordReply()
	
	/**
	 * 批量删除关键字回复
	 * */
	this.delBatchKeywordReply = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj = $("#dataTable").dataTable();
		self.openDel(obj,{'controller':'Weixin','method':'deleteKeyById','keyid':ids});
	}
	
	// }}}
	// {{{ function initEditKeywordReply()
	
	/**
	 * 初始化关键词编辑
	 * */
	this.initEditKeywordReply = function() {
		$(function(){
			var para = self.parseUrl(window.location.href);
			var key = para.keyword;
			var type = para.msgtype;
			
			if(key!=''&& key!=undefined){
				key = decodeURI(para.keyword);
				$("div.iradio-blue").removeClass('checked');
				if(type == "text"){
					var reply = decodeURI(para.content);
					$('input[name="msgType1"][value="0"]').attr("checked",true);
					$('input[name="msgType1"][value="0"]').parent().addClass('checked');
					$("#keywords").val(key);
					$("#reply_contain1").val(reply);
					$("#viewEmo1").html(reply);
				}else{
					$('input[name="msgType1"][value="1"]').attr("checked",true);
					$('input[name="msgType1"][value="1"]').parent().addClass('checked');
					$("#keywords").val(key);
					var ch = decodeURI(para.title);
					var aurl = decodeURI(para.aurl);
					var apicurl = decodeURI(para.apicurl);
					var html = '<span class="l infomation_span" id="msgSend">'+ch+'</span> <span class="r"><a href="javascript:" url="'+aurl+'" apicurl="'+apicurl+'" title="'+ch+'" class="close_a thumb" onclick="return false;" ><i class="Hui-iconfont" style="font-size:18px;">&#xe60b;</i></a></span>';
					$("#chooseMsg").html(html);	
					$('#welSucai').show();
					
/* 					//图文点击
					$(document).on('click',".thumb",function(){
						var selected = $(this).parent().parent().attr('title');
						var tdId = $(this).parent().parent().parent().attr("id");
						self.goToChooseMsg('autoReply', tdId, selected);
					}); */
				}
				
				$('#keystatu').val('edit');
			} else {
				//根据是否有素材显示不同的操作
				self.cmd(gHttp,{controller:'Weixin',method:'getMaterialList'},function(ret){
					if(ret.total_count==0){
						$('#addSucai').show();
					} else {
						$('#selSucai').show();
					}
				});
			}
			
			//表情与编辑框切换
			self.emoChangeEvent(1);
			
			//保存关键词回复
			$('#save').click(function(){
				self.addKeywordAutoReply();
			});
			
			$('.skin-minimal input').iCheck({
				checkboxClass: 'icheckbox-blue',
				radioClass: 'iradio-blue',
				increaseArea: '20%'
			});
		});
	}
	
	// }}}
	// {{{ function emoChangeEvent()
	
	/**
	 * 表情输入切换
	 * */
	this.emoChangeEvent = function(type) {
		if (type == undefined) {
			type = '';
		}
		$("#emotion"+type).click(function(){
			$("#reply_contain"+type).show();
			$("#viewEmo"+type).hide();
			$('#emotion'+type).qqFace({
				id : 'facebox'+type, //表情盒子的ID
				assign:'reply_contain'+type, //给那个控件赋值
				path:'/hcc/plugin/plugins/weixin/css/face/' //表情存放的路径
			});
		});
	 	$('#reply_contain'+type).blur(function(){
			var str = $("#reply_contain"+type).val();
			$("#reply_contain"+type).html(self.replaceEm(str));
			$("#viewEmo"+type).html(self.replaceEm(str));
			$("#viewEmo"+type).toggle();
			$("#reply_contain"+type).toggle();
		});
		$("#viewEmo"+type).click(function(){
			$("#reply_contain"+type).show();
			$("#viewEmo"+type).hide();
		});
	}
	
	// }}}
	// {{{ function replaceEm()
	
	/**
	 * 表情替换
	 * */
	this.replaceEm = function(str){
		str = str.replace(/\</g,'&lt;');
		str = str.replace(/\>/g,'&gt;');
		str = str.replace(/\n/g,'<br/>');
		
		var r = /\[(.+?)\]/g;
		var list = str.match(r);
		for (var i in list) {
			var index = self.emotionList(list[i]);
			if (list[i] != undefined) {
				str = str.replace(list[i],'<img src="/hcc/plugin/plugins/weixin/css/face/'+index+'.gif" border="1" />');
			}
		}
		return str;
	}
	
	// }}}
	// {{{ function emotionList()
	
	/**
	 * 表情集
	 * */
	this.emotionList = function (flag) {
		var data = {"[微笑]":"1", "[撇嘴]":"2",  "[色]":"3",   "[发呆]":"4",  "[流泪]":"5",  "[害羞]":"6",  "[闭嘴]":"7",  "[睡]":"8",   "[大哭]":"9",  "[尴尬]":"10",
				    "[发怒]":"11","[调皮]":"12", "[呲牙]":"13", "[惊讶]":"14", "[难过]":"15", "[冷汗]":"16", "[抓狂]":"17", "[吐]":"18",  "[偷笑]":"19", "[愉快]":"20",
				    "[白眼]":"21","[傲慢]":"22", "[饥饿]":"23", "[困]":"24",  "[惊恐]":"25", "[流汗]":"26", "[憨笑]":"27", "[悠闲]":"28", "[奋斗]":"29", "[咒骂]":"30",
				    "[疑问]":"31","[嘘]" :"32", "[晕]":"33",   "[疯了]":"34", "[衰]":"35",  "[敲打]":"36", "[再见]":"37", "[擦汗]":"38", "[抠鼻]":"39", "[糗大了]":"40",
				    "[坏笑]":"41","[左哼哼]":"42","[右哼哼]":"43","[哈欠]":"44","[鄙视]":"45", "[委屈]":"46", "[快哭了]":"47","[阴险]":"48", "[亲亲]":"49", "[吓]":"50",
				    "[可怜]":"51","[拥抱]":"52", "[月亮]":"53",  "[太阳]":"54","[炸弹]":"55", "[骷髅]":"56", "[菜刀]":"57", "[猪头]":"58", "[西瓜]":"59", "[咖啡]":"60",
				    "[饭]" :"61","[爱心]":"62", "[强]":"63",    "[弱]":"64", "[握手]":"65", "[胜利]":"66", "[抱拳]":"67", "[勾引]":"68", "[OK]":"69",  "[NO]":"70",
				    "[玫瑰]":"71","[凋谢]":"72", "[嘴唇]":"73",  "[爱情]":"74","[爱你]":"75"
		};
		if (flag == undefined) return 1;
		return parseInt(data[flag]);
	}
	
	// }}}
	// {{{ function addKeywordAutoReply()
	
	/**
	 * 添加自动回复
	 * */
	this.addKeywordAutoReply = function(){
		var keywords = $('#keywords').val();
		var keystatu = $('#keystatu').val();
		var content = $("#reply_contain1").val();
		var msgType = $('input[name="msgType1"]:checked').val();
		
		if(keywords == ''){
			layer.alert('请输入关键词');
			return false;
		}
		
		if(msgType == 0){
			var data = {'controller':'Weixin','method':'saveKeys'};
			var formData = [{name:'keyword',value:keywords},{name:'msgtype',value:'text'},{name:'content',value:content},{name:'keystatu',value:keystatu}];
			$.each(formData,function(index,obj){
				data[obj.name] = obj.value;
			});
			self.cmd(gHttp,data,function(ret){
				if(ret.statu){
					layer.alert(ret.msg);
					window.parent.gWeiXin.fillAutoReplyTable();
					layer_close();
				}else{
					layer.alert(ret.msg);
				}
			});
			
		}else{
			var data = {'controller':'Weixin','method':'saveKeys'};
			var description = $("#chooseMsg").find("span.r a").attr('description');
			var title = $("#chooseMsg").find('#msgSend').html();
			var thumb_media_id = $("#chooseMsg").find("span.r a").attr('thumb_media_id');
			var url = $("#chooseMsg").find("span.r a").attr('url');
			
			var apicurl = $("#chooseMsg").find("span.r a").attr('apicurl');
			if (thumb_media_id != undefined) {
				//有id则重新获取url
				self.cmd(gHttp,{'controller':'Weixin','method':'getShowPic','thumb_media_id':thumb_media_id},function(ret){
					apicurl = ret;
				});
			}
			
			var formData = [{name:'keyword',value:keywords},{name:'msgtype',value:'news'},{name:'ArticleCount',value:'1'},{name:'Atitle[1]',value:title},{name:'Adescription[1]',value:description},{name:'Apicurl[1]',value:apicurl},{name:'Aurl[1]',value:url}];
			$.each(formData,function(index,obj){
				data[obj.name] = obj.value;
			});
			self.cmd(gHttp,data,function(ret){
				if(ret.statu){
					layer.alert(ret.msg);
					layer_close();
					window.parent.gWeiXin.fillAutoReplyTable();
					$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
				}else{
					layer.alert(ret.msg);
				}
			});
			
		}
	}
	
	// }}}
	// {{{ function saveFocusReply()
	
	/**
	 * 保存关注时回复
	 * */
	this.saveFocusReply = function(){
		var focusType = $('input[name="focusType"]:checked').val();
		if(focusType == 0){
			if($('#reply_contain').val() == ''){
				layer.alert('请输入自动回复文本内容');
				return false;
			}
			var data = {'controller':'Weixin','method':'setSub'};
			var reply_contain = $("#viewEmo").html();
			var formData = [{name:'keyword',value:''},{name:'msgtype',value:'text'},{name:'content',value:reply_contain}];
			$.each(formData,function(index,obj){
				data[obj.name] = obj.value;
			});
			self.cmd(gHttp,data,function(ret){
				if(ret.statu){
					layer.alert(ret.msg);
					self.fillAutoReplyTable();
					$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
				}else{
					layer.alert(ret.msg);
				}
			});
			
		}else{
			if($('#msgSend').text() == ''){
				layer.alert('请选则自动回复图文内容');
				return false;
			}
			var data = {'controller':'Weixin','method':'setSub'};
			var description = $("#chooseMsg").find('span.r a').attr('description');
			var title = $("#chooseMsg").find('span.r a').attr('title');
			var thumb_media_id = $("#chooseMsg").find('span.r a').attr('thumb_media_id');
			var url = $("#chooseMsg").find('span.r a').attr('url');
			var thumb_url = $("#chooseMsg").find('span.r a').attr('thumb_url');
			
			var formData = [{name:'keyword',value:''},{name:'msgtype',value:'news'},{name:'ArticleCount',value:'1'},{name:'Atitle[1]',value:title},{name:'Adescription[1]',value:description},{name:'Apicurl[1]',value:thumb_url},{name:'Aurl[1]',value:url}];
			$.each(formData,function(index,obj){
				data[obj.name] = obj.value;
			});
			self.cmd(gHttp,data,function(ret){
				if(ret.statu){
					layer.alert(ret.msg);
					self.fillAutoReplyTable();
					$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
				}else{
					layer.alert(ret.msg);
				}
			});
			
		}
	}
	
	// }}}
    // {{{ function fillClickTable()
	
	/**
	 * 菜单点击列表
	 * */
	this.fillClickTable = function() {
		var myDate = new Date();   //获取当前日期
		var startTime = new Date(myDate.getTime()-31*24*3600*1000);  //获取当前日期-1个月
		var start = startTime.toLocaleDateString(); 
		var end = myDate.toLocaleDateString();  
		$('#dataTable').grid({
            para : {'controller':'Weixin','method':'clickCount',isPage:1},
            createdRow : function(nRow, aData, iDataIndex){
            	$('td:eq(0)', nRow).html(iDataIndex + 1);
            },
            order : false,
            field : [
				{data : 'id'},
			    {data:'name'},
			    {data:'url'},
                {data:'time', render : function(time){
                    return start+'-'+end;
                }},
                {data:'num'}
            ]
       });
	}
	
	// }}}
	// {{{ function getNewsByType()
	
	/**
	 * 获取已有图文信息
	 * */
	this.getNewsByType = function() {
		var trhtml ='';
		//获取已有图文信息
		$('#dataTable').grid({
            para : {controller:'Weixin',method:'getByType',type:'news'},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}												
							],
            createdRow : function(nRow, aData, iDataIndex){
            	$('td:eq(1)', nRow).html(iDataIndex + 1);
            },
            field : [
				{
					data : 'media_id',
					render : function (id, type, row) {
						return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
					}
				},
				{data:'media_id'},
				{data : 'title'},
			    {data:'filename', render : function(filename,type,row) {
			    	if (filename == '') {
			    		return '<img src="'+row.thumb_url+'" width="90px" />';
			    	}
			    	return '<img src="'+filename+'" width="90px" />';
			    }},
                {data:'digest',render:function(value){return value.substr(0,16)+'...';}},
                {data:'update_time'},
                {data:'media_id',render : function(media_id,type,row){
                    var str = '<a style="text-decoration:none" onClick="gWeiXin.editSucai(\''+media_id+'\',\''+row.media_id+'\',\''+row.thumb_media_id+'\',\''+row.media_id+'\',\''+encodeURI(row.filename)+'\');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
                    str += ' <a style="text-decoration:none" class="ml-5" onClick="gWeiXin.delSucai(\''+media_id+'\', \''+row.media_id+'\');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
                    return str;
                  }
                }
            ]
       });
	}
	
	// }}}
	// {{{ function uploadMessage()
	
	/**
	 * 素材管理
	 * */
	this.uploadMessage = function(){
			self.cmd(gHttp,{controller:'Weixin',method:'getByType'},function(ret){
				if(ret.msg){
					layer.alert(ret.msg);
					layer_close();
				}
			});
		//获取已有图文信息			
		self.getNewsByType();
		
		//关键词搜索
		$("#search").click(function(){
			$('#dataTable').destroy();
			var msgname = $("#msgname").val();
			$('#dataTable').grid({
	            para : {controller:'Weixin',method:'getMessageByTitle',msgname:msgname},
	            createdRow : function(nRow, aData, iDataIndex){
	            	$('td:eq(0)', nRow).html(iDataIndex + 1);
	            },
	            field : [
					{
						data : 'id',
						render : function (id, type, row) {
							return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
						}
					},
					{data:'id'},
					{data : 'title'},
				    {data:'filename', render : function(filename) {
				    	return '<img src="'+filename+'" width="90px" />';
				    }},
				    {data:'digest'},
	                {data:'created_at'},
	                {data:'id',render : function(id,type,row){
	                    var str = '<a style="text-decoration:none" onClick="gWeiXin.editSucai('+id+','+row.media_id+','+row.thumb_media_id+','+row.flag+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
	                    str += ' <a style="text-decoration:none" class="ml-5" onClick="gWeiXin.delSucai('+media_id+', '+row.flag+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
	                    return str;
	                  }
	                }
	            ]
	       });
		});
	}
	
	//}}}
	// {{{ function editSucai()
	
	/**
	 * 编辑素材
	 * */
	this.editSucai = function(id,media_id,thumb_media_id,flag,filename){
		var query = 'id=' + id + '&media_id=' + media_id + '&thumb_media_id' + thumb_media_id + '&flag=' + flag + '&filename=' + filename;
		self.openEditWID('编辑素材','add-text.html?' + query,'1050','650');
	}
	
	// }}}
    // {{{ function delSucai()
	
	/**
	 * 删除素材
	 * */
	this.delSucai = function(id,flag) {
		if(flag == 0){
			var method= 'delMessageById';  //临时图文信息
		}else{
			var method= 'delMaterialById';  //永久图文信息
		}
		var obj = $("#dataTable").dataTable();
		self.openDel(obj,{controller:'Weixin',method:method,id:id});
	}
	
	// }}}
    // {{{ function delBatchSucai()
	
	/**
	 * 批量删除素材
	 * */
	this.delBatchSucai = function() {
		var ids = $("#dataTable").getSelectedAll();
		if (ids.toString() == '') {
			layer.alert('请选择您要删除的选项!');
			return false;
		}
		var obj = $("#dataTable").dataTable();
		self.openDel(obj,{controller:'Weixin',method:'delMessageById',id:ids});
	}
	// }}}
	// {{{ function initSendMessage()
	
	/**
	 * 初始化群发页面
	 * */
	this.initSendMessage = function() {
		$(function(){
			//根据窗口大小调整操作区域大小
			self.initColorEdit(1);
			//同步标题/作者/简介/图片
			$(document).on("propertychange input", "#tags", function(){
					var objvar = $('#tags').val();
					var appmsgItemId = $('#info_list').find('li.active').attr('id');
					if(appmsgItemId == 'appmsgItem1'){
						$('.active .tit').text(objvar);						
					}else{
						$('.active .pic_tit').text(objvar);							
					}
					$('.active div.tags').text(objvar);					
			  });
			$("#author").blur(function(){
					var objvar = $('#author').val();
					$('.active div.author').text(objvar);					
			  });
			$("#digest").blur(function(){
					var objvar = $('#digest').val();
					$('.active div.digest').text(objvar);					
			  });
				editor.addListener("blur", function () {
					var content = editor.getContent();
					$('.active div.content').text(content);				
				});
			$("#tags").blur(function(){
				var tags = $('#tags').val() ? $('#tags').val() : '标题';
				$('.active .tit').text(tags);
			});				
			//添加栏目
			$('#info_list .add').on('click',function(){
				self.addSendItem2();				
			});	
			
			//删除要群发的栏目
			$(document).on('click',".js_delete",function(){
				var id = $(this).parent().parent().attr('id');
				var len = $('#info_list li').length;
				var li = document.getElementById(id);
				if(li.classList.contains('active')==true){
					var activeId = parseInt(id.replace(/appmsgItem/,''))-1;
					$('#appmsgItem'+activeId).addClass('active');						
				}
				$('#'+id).remove();
				var itemLen = parseInt($('#itemIndex').val())-1;
				$('#itemIndex').val(itemLen);
				self.initItem();
				//数据处理
				var objId = id.replace(/appmsgItem/,'item_');
				if ("undefined" !== typeof articleItems[objId]) {
					articleItems[objId] = {};
		        }
				$('#tmid').val('');
			});
			//移动栏目 向下
			$(document).on('click',".js_down",function() {
				var id = $(this).parent().parent().attr('id');
				$(this).addClass('active').siblings('li').removeClass('active');
				var downId = parseInt(id.replace(/appmsgItem/,''))+1;
				var down = 'item_'+downId;
				var objId = id.replace(/appmsgItem/,'item_');
				if("undefined" === typeof articleItems[objId]){
        			layer.alert('请先完善并保存第'+(downId-1)+'条栏目!');
        			return false;					
				}
				if("undefined" === typeof articleItems[down]){
        			layer.alert('请先完善并保存第'+downId+'条栏目!');
        			return false;					
				}
				if(id=='appmsgItem1'){
					self.oneToTwo();
				}
				$('#'+id).insertAfter('#appmsgItem' + downId);
				self.initItem();
				self.editInfo(downId-1,downId,articleItems[objId],articleItems[down]);
				//数据处理

				if ("undefined" !== typeof articleItems[objId] && "undefined" !== typeof articleItems[down]) {
					var dataTemp = articleItems[objId];
					articleItems[objId] = {};
					articleItems[down] = articleItems[down];
					articleItems[down] = {};					
					articleItems[down] = dataTemp;					
		        }
					console.log(articleItems);
			});
			//移动栏目 向上
			$(document).on('click',".js_up",function() {
				var id = $(this).parent().parent().attr('id');
				$(this).addClass('active').siblings('li').removeClass('active');
				var upId = parseInt(id.replace(/appmsgItem/,''))-1;
				var up = 'item_'+upId;
				var objId = id.replace(/appmsgItem/,'item_');
				if("undefined" === typeof articleItems[up]){
        			layer.alert('请先完善并保存第'+upId+'条栏目!');
        			return false;					
				}
				if("undefined" === typeof articleItems[objId]){
        			layer.alert('请先完善并保存第'+(upId+1)+'条栏目!');
        			return false;					
				}
				if(id=='appmsgItem2'){
					self.oneToTwo();
				}
				$('#appmsgItem' + upId).insertAfter('#'+id);
				self.initItem();
				self.editInfo(upId+1,upId,articleItems[objId],articleItems[up]);
				//数据处理
				if ("undefined" !== typeof articleItems[objId] && "undefined" !== typeof articleItems[up]) {
					var dataTemp = articleItems[objId];
					articleItems[objId] = {};
					articleItems[objId] = articleItems[up];
					articleItems[up] = {};					
					articleItems[up] = dataTemp;
		        }	
			});
			//切换栏目
			$(document).on('click',"#info_list li",function(){
				//切换边框
				if($(this).index()!=(parseInt($('#info_list li').length)-1)){
					$(this).addClass('active').siblings('li').removeClass('active');						
				}
				var appmsgItemId = $('#info_list').find('li.active').attr('id');
				var objId = appmsgItemId.replace(/appmsgItem/,'item_');

				if ("undefined" === typeof articleItems[objId]) {
						$('#tags').val($('#'+appmsgItemId +' .tags').text());						
						$('#author').val($('#'+appmsgItemId +' .author').text());
						$('#digest').val($('#'+appmsgItemId +' .digest').text());
						var tmid = $('#'+appmsgItemId +' .tmid').text();
						$('#tmid').val(tmid);
						var pic = $('#'+appmsgItemId +' .pic').text();
						var arr = pic.split('upload');
						if(tmid=='' || tmid =="undefined"){
							$('#pic').val(arr[1]);						
						}
						pic = pic ? pic : '/hcc/images/boyicms/logo/thumbnail_auto.gif';
						$('#thumbnail').attr('src', pic);						
						editor.ready(function(){
							editor.setContent($('#'+appmsgItemId +' .content').text());
						});
				}  else {
					self.fillSendEdit(objId);
		        }
			});
			//其它素材
			$(document).on('click',"#info_list .js_other",function() {
				var appmsgItemId = $(this).parent().parent().attr('id');
				self.getthumblist('material',appmsgItemId,'mass');				
			});
			//删除缩略图
			$(document).on('click',"#delete-thisimg",function() {	
				$('#thumbnail').attr('src','/hcc/images/boyicms/logo/thumbnail_auto.gif');
				var objId = $('#info_list').find('li.active').attr('id');
				if(objId == 'appmsgItem1'){
					$('#'+objId+' .bg_pic').css({"background-image":"url('')","background-size":"100% 108px"});
				}else{
					$('#'+objId+' .bg_pic').css({"background-image":"url('')","background-size":"78px 78px"});
				}
				$('#'+objId+' .pic').html('');
				$('#'+objId+' .tmid').html('');
				$('#pic').val('');
				$('#tmid').val('');
			});
			//保存
			$('#save').on('click', function(){
				self.saveSendMsg();
			});
			
			//保存并发送
            $('#saveAndSend').on('click', function(){
				var flag = true;
            	$('#info_list').find('li').each(function(i){
					var objId = $(this).attr('id');
        			objId  = objId ? objId.replace(/appmsgItem/,'item_') : 'undefined';					
        			if ("undefined" === typeof articleItems[objId] && objId != "undefined" && i != $('#info_list li').length -1 ) {
        				//不存在，则检查并保存
        					layer.alert('请先完善并保存第'+(i+1)+'条栏目!');
        					flag = false;
        				}
			    });
				if(flag){
					var data1 = {'controller':'Weixin','method':'uploadMpnewses'};
					data1['articles'] = articleItems;
					data1['index'] = $('#itemIndex').val();
					self.cmd(gHttp,data1,function(ret){
						if(ret.statu){
							var media_id = ret.data.media_id;				
							self.cmd(gHttp,{controller:'Weixin',method:'sendAll',msgtype:'news',content:media_id},function(result){
								if(result.statu){
									parent.layer.alert(result.msg);							
								}else{
									parent.layer.alert(result.msg);									
								}
							});
						}else{
							parent.layer.alert(ret.msg);
						}
					});
				}
		    });
		//颜色编辑器
		$("#style-categories li").click(function(){
			if($(this).hasClass("allmenu_li")){
				$("#style-categories li.active").removeClass("active");
				$(this).addClass("active");
				var type = $(this).attr('flag');
				$('#info_group').html('');
				if (type == '11') {
					var data = {'controller':'Library','method':'query'};
					self.cmd(gHttp,data,function(ret){
						var html = '';
						var data = ret.rows;
						if (data == '') return false;
						for(var i in data) {
							html += '<div class="list_content">';
							if (data[i].wec_name != '') {
								html += '<p>' + data[i].name + '</p>';
							}
							if (data[i].content != '') {
								html += data[i].content;
							}
							html += '</div>';
						}
						$('#info_group').html(html);
					});
					return false;
				}
				self.initColorEdit(type);
			}							  
		});
		$(document).on('click','.list_content',function(){
			var c = $(this).html();
			editor.ready(function(){
				editor.setContent(c);
			});
		});	
		self.onloadCss();		
		});
	}
	/**
	 * 初始化颜色编辑器
	 * */	
	this.initColorEdit = function(type){
		var data = {'controller':'Weixin','method':'getWechatContent','type':type};
				self.cmd(gHttp,data,function(ret){
					if(!ret.statu){
						layer.alert(ret.msg);
					}
					var html = '';
					var data = ret.data;
					for(var i in data) {
						html += '<div class="list_content">';
						if (data[i].wec_name != '') {
							html += '<p>' + data[i].wec_name + '</p>';
						}
						if (data[i].content != '') {
							html += data[i].content;
						}
						html += '</div>';
					}
					$('#info_group').html(html);
				});
	}
	// }}}
	// {{{ function saveSendMsg()
	
	/**
	 * 保存当前群发内容
	 * */
	this.saveSendMsg = function() {
		var flag = true;
		var appmsgItemId = $('#info_list').find('li.active').attr('id');
		var objId = appmsgItemId.replace(/appmsgItem/,'item_');
		var formData = $('#wechateditor').serializeArray();
		var tmid = $('#'+appmsgItemId+' .tmid').text();
			tmid = tmid ? tmid : '';
		var data = {};
		$.each(formData,function(index,obj){
			data[obj.name] = obj.value;
		});
		if ("undefined" === typeof articleItems[objId] && tmid == '' && flag ==true) {
			//不存在，则检查并保存当前获取mid
			self.saveThumb(data,objId);
		} else if("undefined" !== typeof articleItems[objId] && articleItems[objId] != ''){
        	layer.alert('已经保存过这条栏目!');	
			flag = false;
		}else if(flag ==true){	
			//引入时保存articleItems
			self.saveThumb(data,objId,tmid);		
		}
	}
	
	// }}}
	// {{{ function saveThumb()
	
	/**
	 * 保存缩略图，获取thumb_media_id
	 * */
	this.saveThumb = function(data,objId,tmid) {
		if(tmid){
			layer.msg('保存成功 ');
			articleItems[objId] = data;
			articleItems[objId]['title'] = data.tags;
			articleItems[objId]['thumb_media_id'] = tmid;
			$('#tmid').val(tmid);
			return ;
		}else{
			var data1 = {'controller':'Weixin','method':'uploadMessage',from:'send'};
			data1['fileName'] = data.pic;
			data1['msgtype'] = 'thumb';
			data1['title'] = data.tags;
			$('#wechateditor').checkAndSubmit('save',data1,function(ret){	
				if(ret.statu){
					layer.msg('保存成功 ');
					articleItems[objId] = data;
					articleItems[objId]['title'] = data.tags;
					articleItems[objId]['thumb_media_id'] = ret.thumb_media_id;
					$('#tmid').val(ret.thumb_media_id);
				}else{
					layer.alert(ret.msg);
				}	
			});
			$('#wechateditor').submit();
		}
	}
	/**
	 * 初始化栏目列表
	 * */	
	this.initItem = function(){
		var num = $('#info_list li').length;
		var upHtml = '<a class="js_up"   title="上移"><i class="Hui-iconfont" style="font-size:24px;color:#FFFFFF;">&#xe679;</i></a>';
		var	downHtml = '<a class="js_down"  title="下移"><i class="Hui-iconfont" style="font-size:24px;color:#FFFFFF;">&#xe674;</i></a>';
		var	otherHtml = '<a class="js_other"  title="其它素材"><i class="Hui-iconfont" style="font-size:24px;color:#FFFFFF;">&#xe63e;</i></a>';
		var deleteHtml = '<a class="js_delete" style="float:right;"  title="删除"><i class="Hui-iconfont" style="font-size:24px;color:#FFFFFF;">&#xe6e2;</i></a>';
		for(var i=0;i<=num;i++){
			$('#info_list li:eq('+i+')').attr('id','appmsgItem'+(i+1));
			if(num>3){
				$('#appmsgItem'+(parseInt(i)-1)+' .appmsg_edit_mask').html(upHtml+downHtml+otherHtml+deleteHtml);			
			}
		}
		if(num>2){
			$('#appmsgItem1 .appmsg_edit_mask').html(downHtml+otherHtml);				
			$('#appmsgItem'+(parseInt(num)-1)+' .appmsg_edit_mask').html(upHtml+otherHtml+deleteHtml);			
			if(num<9){
				$('#appmsgItem'+num).show();	
			}
		}else{
			$('#appmsgItem1 .appmsg_edit_mask').html(otherHtml);			
		}		
	}
	/**
	 * 处理信息
	 * */
	this.editInfo =function(oId,rId,objInfo,toInfo){
		var objHtml = '<div style="display:none"><div class="tags">'+objInfo.tags+'</div><div class="author">'+objInfo.author+'</div><div class="digest">'+objInfo.digest+'</div><div class="content">'+objInfo.content+'</div><div class="pic">'+objInfo.pic+'</div><div class="tmid">'+objInfo.thumb_media_id+'</div></li>';
		var toHtml = '<div style="display:none"><div class="tags">'+toInfo.tags+'</div><div class="author">'+toInfo.author+'</div><div class="digest">'+toInfo.digest+'</div><div class="content">'+toInfo.content+'</div><div class="pic">'+toInfo.pic+'</div><div class="tmid">'+toInfo.thumb_media_id+'</div></li>';
		$('#appmsgItem'+oId).append(toHtml);
		$('#appmsgItem'+rId).append(objHtml);
		if(oId < rId){ //向下
			if(oId == 1){
				$('#appmsgItem'+oId+' .bg_pic').css({"background-image":"url("+toInfo.pic+")","background-size":"100% 108px"});
			}else{
				$('#appmsgItem'+oId+' .bg_pic').css({"background-image":"url("+toInfo.pic+")","background-size":"78px 78px"});
			}
			$('#appmsgItem'+rId+' .bg_pic').css({"background-image":"url("+objInfo.pic+")","background-size":"78px 78px"});			
		}else{		//向上
			if(rId == 1){
				$('#appmsgItem'+rId+' .bg_pic').css({"background-image":"url("+objInfo.pic+")","background-size":"100% 108px"});
			}else{
				$('#appmsgItem'+rId+' .bg_pic').css({"background-image":"url("+objInfo.pic+")","background-size":"78px 78px"});
			}
			$('#appmsgItem'+oId+' .bg_pic').css({"background-image":"url("+toInfo.pic+")","background-size":"78px 78px"});			
		}
		$('#tmid').val(toInfo.thumb_media_id);		
	}
	/**
	 * 增加群发栏目
	 * */
	this.addSendItem2 =function(){
			var num = $('#info_list li').length;
			if(num>8) return;
			$('#info_list .add').hide();
			var html = '<li class="maskWraper" id="appmsgItem'+num+'">';
		    html += '<span class="pic_tit">标题</span>';
		    html += '<div class="bg_pic"></div>';
		    html += '<div class="appmsg_edit_mask">';
		    html += '</div>';
			html += '<div style="display:none"><div class="tags"></div><div class="author"></div><div class="digest"></div><div class="content"></div><div class="pic"></div><div class="tmid"></div></li>';
			$('#info_list .add').before(html);
			if(num==8){
				$('#info_list .add').hide();
			}
			var len = parseInt($('#itemIndex').val())+1;
			$('#itemIndex').val(len);
			self.initItem();
	}
	/**
	 * 第一栏与第二栏目切换
	 * */
	 this.oneToTwo = function(){
		var title1 = $('#appmsgItem1 .tit').text();
		var title2 = $('#appmsgItem2 .pic_tit').text();
		var html1 = '<div class="bg_pic"><span class="tit">'+title2+'</span></div>';
		var html2 = '<span class="pic_tit">'+title1+'</span><div class="bg_pic"></div>';
		var edit = '<div class="appmsg_edit_mask"></div>';
		$('#appmsgItem1').html(html2+edit);
		$('#appmsgItem2').html(html1+edit);		
	 }
	/**
	 * 新增要群发的栏目(旧)
	 * */
	this.addSendItem = function(content) {
		//先处理之前的数据
		//清空数据
		$('#wechateditor input').val('');
		$('#wechateditor textarea').val('');
		$("#fileList").html('');
		$("#fileName").val('');
		editor.ready(function(){
			editor.setContent('');
		});
		
		if (content == '' || content == undefined) {
			content = '新建栏目';
		}
		
		$('div[id^="item_"]').removeClass('current');
		var len = parseInt($('#itemIndex').val())+1;
		var html = '<div class="list_content current" id="item_'+len+'">';
		    html += '<span id="msgSend">' + content + '</span>';
		    html += '<span class="r">';
		    html += '<a style="text-decoration:none" class="ml-5 delete" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe609;</i></a>';
		    html += '<a style="text-decoration:none" class="ml-5 thumb" href="javascript:;" title="选择图文信息"><i class="Hui-iconfont">&#xe665;</i></a>';
		    html += '</span>';
		    html += '</div>';
		$('#info_group').append(html);
		$('#itemIndex').val(len);
		
	}
	
	// }}}
	// {{{ function fillSendEdit()
	
	/**
	 * 填充群发编辑框
	 * */
	this.fillSendEdit = function(obj, mid, thumb_id) {
		if ("undefined" === typeof articleItems[obj]) {
			articleItems[obj] = {};
        } 
		
		if (mid == undefined) {
			//自定义添加
        	$.each(articleItems[obj],function(i,v){
				if ('pic' == i) {
					$('#thumbnail').attr('src',v);
					$("#pic").val(v);
				} else if ('content' == i) {
					editor.ready(function(){
						editor.setContent(v);
					});
				} else {
					$("[name="+i+"]").val(v);
				}
			});
		} else {
			//从素材库过来的
			var editdata = self.fillEditSucai(mid, mid, thumb_id, 1);
			if(editdata!=undefined && editdata!= null &&editdata !=""){	
				articleItems[obj] = editdata[0];
				articleItems[obj]['thumb_media_id'] = '';				
				$.each(editdata[0],function(i,v){
					if ('pic' == i) {
						$('#thumbnail').attr('src',v);
						$("#pic").val(v);
					} else if ('content' == i) {
						editor.ready(function(){
							editor.setContent(v);
						});
					} else {
						$("[name="+i+"]").val(v);
					}
				});
			}
		}
	}
	// }}}	
}

//{{{ function changeColor()

/**
 * 改变素材颜色
 * */
function changeColor(color) {
	$("#info_group").children().find('*').each(function(){
		var rgb = $(this).css('background-color');
		if (rgb != 'transparent') {
			$(this).css("backgroundColor",color);
			$(this).css("borderColor",color);
		}
	});
}

// }}}

/**===========================以下是不用的旧代码=============================*/
var result = $.extend({},{
	sendAll:function(){
		var _me = this;
		$('#center').getHtml('./plugin/plugins/weixin/sendAll',function(){
			//获取所有的分组
			$('#loading').addClass('loading');
			getData({'controller':'Weixin','method':'groupAll'},function(ret){
				$('#loading').removeClass('loading');
				if(ret.statu){
					var html = '<option value="">请选择...</option>';
					$.each(ret.data,function(index,obj){
						html += '<option value="'+obj.id+'">'+obj.name+'</option>';
					});
					$('#group').html(html);
				}else{
					layer.alert(ret.msg);
					$('#each').getHtml('./plugin/plugins/weixin/weixin',function(){
						_me.clickCount();
					});
					return false;
				}
			});
			$('#msgtype').change(function(){
				$('#show').hide();
				$('#showImg').html('');
				var me = $(this);
				var type = me.val();
				if(type != 'text' && type != ''){
					$('#loading').addClass('loading');
					getData({'controller':'Weixin','method':'getByType','type':type},function(ret){
						$('#loading').removeClass('loading');
						if(ret.statu){
							var img = '';
							html = '<option value="">请选择...</option>';
							$.each(ret.data,function(index,obj){
								if(obj.type == 'news'){
									html += '<option value="'+obj.media_id+'">'+obj.title+'</option>';
									img = '';
								}else if(obj.type == 'image'){
									html += '<option value="'+obj.media_id+'">'+obj.filename+'</option>';
									img += '<img src="'+obj.filename+'" width="100" height="100" id="'+obj.media_id+'" style="display:none" />';
								}else if(obj.type == 'video'){
									html += '<option value="'+obj.media_id+'">'+obj.filename+'</option>';
									img += '<video width="200" height="200" src="'+obj.filename+'" controls="controls" id="'+obj.media_id+'" style="display:none"></video>';
								}else{
									html += '<option value="'+obj.media_id+'">'+obj.filename+'</option>';
									img += '<a class="button" href="javascript:void(0);" style="display:none;margin-bottom:10px;" amr="'+obj.filename+'" id="'+obj.media_id+'" style="display:none"><span>点击收听</span></a>';
								}
							});
							$('[tag='+type+']').html(html);
							$('#showImg').html(img);
							$('[tag=image]').change(function(){
								var me = $(this);
								var val = me.val();
								if(val != ''){
									$('#show').show();
									$('#'+val).show();
									$('#'+val).siblings().hide();
								}else{
									$('#show').hide();
								}
							});
							$('[tag=video]').change(function(){
								var me = $(this);
								var val = me.val();
								if(val != ''){
									$('#show').show();
									$('#'+val).show();
									$('#'+val).siblings().hide();
								}else{
									$('#show').hide();
								}
							});
							$('[tag=voice]').change(function(){
								var me = $(this);
								var val = me.val();
								if(val != ''){
									$('#show').show();
									$('#'+val).show();
									var filename = $('#'+val).attr('amr');
									$('#'+val).click(function(){
										art.dialog({
											title: '收听语音消息',
										    content:'<object width="200" height="200" classid="clsid:F08DF954-8592-11D1-B16A-00C0F0283628" codebase="http://www.apple.com/qtactivex/qtplugin.cab"><param name="src" value="'+filename+'"><param name="controller" value="true"><param name="type" value="video/quicktime"><param name="autoplay" value="false"><param name="target" value="myself"><param name="bgcolor" value="black"><param name="pluginspage" value="http://www.apple.com/quicktime/download/index.html"><embed src="'+filename+'" width="250" height="200" controller="true" align="middle" bgcolor="black" target="myself" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/index.html"></embed></object>',
										    fixed:true,
										    id:"listen",
										    width:300,
										    height:150,
										    lock:true,
										    opacity: .1,
										    padding:0,
										    cancel:true
										});
									});
									$('#'+val).siblings().hide();
								}else{
									$('#show').hide();
								}
							});
						}else{
							layer.alert('还没有添加相关素材，<a style="color:red" id="addMsg" href="javascript:void(0)">点此前往添加</a>');
							$('#addMsg').click(function(){
								_me.uploadMessage();
								var list = art.dialog.list;
								for(var i in list){
									list[i].close();
								}
							});
							return false;
						}
					});
				}else if(type == 'text'){
					$('#editor').ckeditor({width:800,height:370},function(){
						
					});
				}
			});
			$('#send').click(function(){
				var val = $('[name=msgtype]').val();
				switch(val){
					case '':
						layer.alert('请选择要发送的素材类型');
						return false;
						break;
					case 'news':
						if($('#imageA').val() == ''){
							layer.alert('请选择要发送的图文');
							return false;
						}
						break;
					case 'text':
						if($('[name=content]').val() == ''){
							layer.alert('发送的内容不能为空');
							return false;
						}
						break;
					case 'voice':
						if($('[tag=voice]').val() == ''){
							layer.alert('请选择要发送的语音');
							return false;
						}
						break;
					case 'image':
						if($('[tag=image]').val() == ''){
							layer.alert('请选择要发送的图片');
							return false;
						}
						break;
					case 'video':
						if($('[tag=video]').val() == ''){
							layer.alert('请选择要发送的视频');
							return false;
						}
						break;
						
				}
				if($('#group').val() == '' && $('[name=users]').val() == ''){
					layer.alert('发送的分组与要发送的用户任意选一个');
					return false;
				}
				if($('#group').val() != '' && $('[name=users]').val() != ''){
					layer.alert('发送的分组与要发送的用户只能选一个');
					return false;
				}
				var data = {'controller':'Weixin','method':'sendAll'};
				var formData = $('#form1').serializeArray();
				$.each(formData,function(index,obj){
					data[obj.name] = obj.value;
				});
				$('#loading').addClass('loading');
				getData(data,function(ret){
					$('#loading').removeClass('loading');
					if(ret.statu){
						layer.alert(ret.msg);
						_me.sendAll();
					}else{
						layer.alert(ret.msg);
					}
				});
			});
		});
	},
	
	messages:function(){
		var self = this;
		$('#center').getHtml('./plugin/plugins/weixin/messages',function(){
			$('#loading').addClass('loading');
			getData({controller:'Weixin',method:'groupAll'},function(ret){
				$('#loading').removeClass('loading');
				if(!ret.statu){
					layer.alert(ret.msg);
					$('#each').getHtml('./plugin/plugins/weixin/weixin',function(){
						self.clickCount();
					});
					return false;
				}else{
					$('#listAll').grad({
						size : 10,
						para : {controller:'Weixin',method:'getListMsg'},
						check : true,
						order : true,
						page : true,
						field : [
							{text:'发送者昵称',name:'nikename',width:60},
							{text:'类型',name:'msgtype',width:66},
							{text:'内容',name:'',width:200},
							{text:'时间',name:'createtime',width:66},
							{text:'是否回复',name:'isreply',width:66},
							{text:'操作',name:'fromusername',width:240,
								render : function(value,rowData,rowIndex){
									var str='<a id="'+value+'" msgid="'+rowData.msgid+'" class="button btn_del" href="javascript:void(0)" style="margin-left:4px;"><span>回复</span></a>';
									return str;
								}
							}
						]
					}).on('click','.btn_del',function(){
						var me = $(this);
						var openId = me.attr('id');
						var msgid = me.attr('msgid');
						var para = {'openid':openId,'msgid':msgid};
						self.replyMessage(para);
					}).on('click','.btn_playVoice',function(){
						var me = $(this);
						var filename = me.attr('file');
						art.dialog({
							title: '收听语音消息',
						    content:'<object width="200" height="200" classid="clsid:F08DF954-8592-11D1-B16A-00C0F0283628" codebase="http://www.apple.com/qtactivex/qtplugin.cab"><param name="src" value="'+filename+'"><param name="controller" value="true"><param name="type" value="video/quicktime"><param name="autoplay" value="false"><param name="target" value="myself"><param name="bgcolor" value="black"><param name="pluginspage" value="http://www.apple.com/quicktime/download/index.html"><embed src="'+filename+'" width="250" height="200" controller="true" align="middle" bgcolor="black" target="myself" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/index.html"></embed></object>',
						    fixed:true,
						    width:300,
						    id:'listen3',
						    height:150,
						    lock:true,
						    opacity: .1,
						    padding:0,
						    cancel:true
						});
					});
				}
			});
			
		});
	},
	
	replyMessage:function(para){
		var self = this;
		$('#center').getHtml('./plugin/plugins/weixin/replyMessage',function(){
			$('#openid').val(para.openid);
			$('#msgtype').change(function(){
				$('#showImg').html('');
				$('#show').hide();
				var me = $(this);
				var msgtype = me.val();
				if(msgtype == 'news'){
					$('#ArticleCount').show();
					$('[name=ArticleCount]').change(function(){
						var _me = $(this);
						var count = _me.val();
						var html = '';
						for(var i=1;i<=count;i++){
							html += '<li><span class="span_one">标题：</span><span class="span_two"><input class="textInput titlelen" type="text" name="Atitle['+i+']" /></span><div style="clear:both;"></div></li>';
							html += '<li><span class="span_one">描述：</span><span class="span_two"><textarea rows="20" cols="30" name="Adescription['+i+']"></textarea></span><div style="clear:both;"></div></li>';
							html += '<li style="margin-top:10px"><span class="span_one">图片链接：</span><span class="span_two"><input class="textInput titlelen" type="text" name="Apicurl['+i+']" /></span><div style="clear:both;"></div></li>';
							html += '<li><span class="span_one">点击后的链接：</span><span class="span_two"><input class="textInput titlelen" type="text" name="Aurl['+i+']" /></span><div style="clear:both;"></div></li><br/></br/>';
						}
						$('#mpnews').html(html);
					});
				}else{
					$('#ArticleCount').hide();
					$('#ArticleCount').val('');
					$('#mpnews').html('');
				}
				if(msgtype == 'video' || msgtype == 'music'){
					$('#title').show();
					$('#description').show();
				}else{
					$('#title').hide();
					$('#description').hide();
				}
				if(msgtype == 'music'){
					msgtype = 'thumb';
					$('#musicurl').show();
					$('#hqmusicurl').show();
				}else{
					$('#musicurl').hide();
					$('#hqmusicurl').hide();
				}
				if(msgtype != 'text' && msgtype != 'news' && msgtype != ''){
					$('#loading').addClass('loading');
					getData({'controller':'Weixin','method':'getByType','type':msgtype},function(ret){
						$('#loading').removeClass('loading');
						if(ret.statu){
							var img = '';
							var html = '<option value="">请选择...</option>';
							$.each(ret.data,function(index,obj){
								if(obj.type == 'thumb'){
									html += '<option value="'+obj.thumb_media_id+'">'+obj.filename+'</option>';
									img +=  '<img src="'+obj.filename+'" width="100" height="100" id="'+obj.thumb_media_id+'" style="display:none" />';
								}else if(obj.type == 'video'){
									html += '<option value="'+obj.video_media_id+'">'+obj.filename+'</option>';
									img += '<video width="200" height="200" src="'+obj.filename+'" controls="controls" id="'+obj.video_media_id+'"></video>';
								}else if(obj.type == 'voice'){
									html += '<option value="'+obj.media_id+'">'+obj.filename+'</option>';
									img += '<a class="button" href="javascript:void(0);" style="display:none;margin-bottom:10px;" amr="'+obj.filename+'" id="'+obj.media_id+'" style="display:none"><span>点击收听</span></a>';
								}else{
									html += '<option value="'+obj.media_id+'">'+obj.filename+'</option>';
									img +=  '<img src="'+obj.filename+'" width="100" height="100" id="'+obj.media_id+'" style="display:none" />';
								}
							});
							$('#media_id').show();
							$('[name=media_id]').html(html);
							$('#showImg').html(img);
							$('[name=media_id]').change(function(){
								var me = $(this);
								var val = me.val();
								if(val != ''){
									$('#show').show();
									$('#'+val).show();
									if(msgtype == 'voice'){
										$('#'+val).click(function(){
											var filename = $(this).attr('amr');
											art.dialog({
												title: '收听语音消息',
											    content:'<object width="200" height="200" classid="clsid:F08DF954-8592-11D1-B16A-00C0F0283628" codebase="http://www.apple.com/qtactivex/qtplugin.cab"><param name="src" value="'+filename+'"><param name="controller" value="true"><param name="type" value="video/quicktime"><param name="autoplay" value="false"><param name="target" value="myself"><param name="bgcolor" value="black"><param name="pluginspage" value="http://www.apple.com/quicktime/download/index.html"><embed src="'+filename+'" width="250" height="200" controller="true" align="middle" bgcolor="black" target="myself" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/index.html"></embed></object>',
											    fixed:true,
											    width:300,
											    height:150,
											    id:'listen4',
											    lock:true,
											    opacity: .1,
											    padding:0,
											    cancel:true
											});
										});
									}else{
										$('#'+val).unbind();
									}
									$('#'+val).siblings().hide();
								}else{
									$('#show').hide();
								}
							});
						}else{
							$('[name=media_id]').html('');
							layer.alert('还没有添加相关素材，<a style="color:red" id="addMsg" href="javascript:void(0)">点此前往添加</a>');
							$('#addMsg').click(function(){
								self.uploadMessage();
								var list = art.dialog.list;
								for(var i in list){
									list[i].close();
								}
							});
						}
					});
				}else{
					$('#media_id').hide();
				}
				if(msgtype == 'text'){
					$('[name=content]').ckeditor({width:800,height:370},function(){
						
					});
					$('#content').show();
				}else{
					$('#content').hide();
				}
			});
			$('#sendMessage').click(function(){
				$('#loading').addClass('loading');
				var val = $('[name=msgtype]').val();
				switch(val){
					case '':
						layer.alert('请选择要发送的信息类型');
						return false;
						break;
					case 'news':
						if($('[name=ArticleCount]').val() == ''){
							layer.alert('请选择要发送的图文总数');
							return false;
						}
						break;
					case 'text':
						if($('[name=content]').val() == ''){
							layer.alert('发送的内容不能为空');
							return false;
						}
						break;
					case 'voice':
						if($('[name=media_id]').val() == ''){
							layer.alert('请选择要发送的语音');
							return false;
						}
						break;
					case 'image':
						if($('[name=media_id]').val() == ''){
							layer.alert('请选择要发送的图片');
							return false;
						}
						break;
					case 'video':
						if($('[name=media_id]').val() == ''){
							layer.alert('请选择要发送的视频');
							return false;
						}
						break;
					case 'music':
						if($('[name=media_id]').val() == ''){
							layer.alert('请选择要发送的缩略图');
							return false;
						}
						if($('[name=musicurl]').val() == ''){
							layer.alert('音乐链接不能为空');
							return false;
						}else{
							//正则验证
						}
						if($('[name=hqmusicurl]').val() == ''){
							layer.alert('高清音乐链接不能为空');
							return false;
						}else{
							//正则验证
						}
						break;	
						
				}
				var data = {'controller':'Weixin','method':'replyMessage','openid':para.openid,'msgid':para.msgid};
				var formData = $('#replyForm').serializeArray();
				$.each(formData,function(index,obj){
					data[obj.name] = obj.value;
				});
				$('#loading').addClass('loading');
				getData(data,function(ret){
					$('#loading').removeClass('loading');
					if(ret.statu){
						layer.alert(ret.msg);
						self.messages();
					}else{
						layer.alert(ret.msg);
					}
				});
				$('#loading').removeClass('loading');
			});
		});
	},
	
	addGroup : function(){
		var self = this;
		$('#center').getHtml('./plugin/plugins/weixin/addGroup',function(){
			$('#loading').addClass('loading');
			getData({controller:'Weixin',method:'groupAll'},function(ret){
				$('#loading').removeClass('loading');
				if(ret.statu){
					var arr = [];
					var str = '<option value="">改变分组名请选择</option>';
					$.each(ret.data,function(index,obj){
						str += '<option value="'+obj.id+'">'+obj.name+'</option>';
						arr[obj.id] = obj.name;
					});
					$('#haveGroup').html(str).change(function(){
						var me = $(this);
						var val = me.val();
						if(val != ''){
							$('#groupid').val(val);
							$('#groupname').val(arr[val]);
						}else{
							$('#groupid').val('');
							$('#groupname').val('');
						}
					});
					$('#save').click(function(){
						var flag = true;
						if($('#groupname').val() == ''){
							layer.alert('请输入分组名');
							return false;
						}else{
							$.each(ret.data,function(index,obj){
								if($('#groupname').val() == obj.name){
									layer.alert('分组名为《'+$('#groupname').val()+'》已经存在');
									flag = false;
									return false;
								}
							});
						}
						if(flag){
							var data = {controller:'Weixin',method:'addGroup'};
							var formData = $('#form1').serializeArray();
							$.each(formData,function(i,ob){
								data[ob.name] = ob.value;
							});
							$('#loading').addClass('loading');
							getData(data,function(ret){
								$('#loading').removeClass('loading');
								if(ret.statu){
									layer.alert(ret.msg);
									self.addGroup();
								}else{
									layer.alert(ret.msg);
								}
							});
						}
						
					});
				}else{
					layer.alert(ret.msg);
					$('#each').getHtml('./plugin/plugins/weixin/weixin',function(){
						self.clickCount();
					});
				}
			});
		});
	},
	
	users:function(){
		var self = this;
		$('#center').getHtml('./plugin/plugins/weixin/users',function(){
			$('#loading').addClass('loading');
			getData({controller:'Weixin',method:'groupAll'},function(ret){
				$('#loading').removeClass('loading');
				if(ret.statu){
					var allgroup = '';
					$.each(ret.data,function(index,obj){
						allgroup += '<option value="'+obj.id+'">'+obj.name+'</option>';
					});
					$('#allGroup').append(allgroup);
					$('#listAll').grad({
						size : 10,
						para : {controller:'Weixin',method:'userAll'},
						check : true,
						order : true,
						page : true,
						field : [
							{text:'openID',name:'username',width:60},
							{text:'所在分组',name:'groupid',width:66},
							{text:'操作',name:'openid',width:240,
								render : function(value,rowData,rowIndex){
									var str='<a id="'+value+'" class="button btn_del" href="javascript:void(0)" style="margin-left:4px;"><span>修改备注</span></a>';
									str+='<a class="button btn_edit" id="'+value+'" href="javascript:void(0)" style="margin-left:8px;"><span>修改分组</span></a>';
									str+='<a class="button btn_reply" id="'+value+'" href="javascript:void(0)" style="margin-left:8px;"><span>发送消息</span></a>';
									return str;
								}
							}
						]
					}).on('click','.btn_del',function(){
						var me = $(this);
						art.dialog({
							title: '修改备注',
						    content:'请输入备注名：<input type="text" id="remark" name="remark" />',
						    fixed:true,
						    icon: 'question',
						    width:300,
						    id:'edit1',
						    height:150,
						    lock:true,
						    opacity: .1,
						    padding:0,
						    okVal:'提交',
						    ok:function(){
						    	var remark = $('#remark').val();
						    	if(remark == ''){
						    		layer.alert('请输入备注名!');
						    		return false;
						    	}
						    	var openid = me.attr('id');
						    	var data = {};
						    	data.remark = remark;
						    	data.openid = openid;
						    	$('#loading').addClass('loading');
						    	getData({'controller':'Weixin','method':'updateRemark','data':data},function(ret){
						    		$('#loading').removeClass('loading');
						    		if(ret.statu){
						    			layer.alert(ret.msg);
						    		}else{
						    			layer.alert(ret.msg);
						    		}
						    		self.users();
						    	});
						    },
						    cancel:true
						});
					}).on('click','.btn_edit',function(){
						var me = $(this);
						var str = '<select name="groupid" id="groupid"><option id="first">添加到..</option>'+allgroup+'</select>';
						art.dialog({
							title: '修改分组',
						    content:'请选择分组：'+str,
						    fixed:true,
							icon: 'question',
							width:300,
							height:150,
							id:'edit2',
							lock:true,
							opacity: .1,
							padding:0,
							okVal:'提交',
							ok:function(){
								var groupid = $('#groupid').val();
								if(groupid == ''){
									layer.alert('请选择分组!');
								    return false;
								}
								var openid = me.attr('id');
								var data = {};
								var arr = [];
								arr[0] = openid;
								data.groupid = groupid;
								data.data = arr;
								$('#loading').addClass('loading');
								getData({'controller':'Weixin','method':'updateGroup','data':data},function(ret){
									$('#loading').removeClass('loading');
									if(ret.statu){
								    	layer.alert(ret.msg);
								    }else{
								    	layer.alert(ret.msg);
								    }
								    self.users();
								});
							},
							cancel:true
						});
					}).on('click','[type=checkbox]',function(){
						var userData = $('#listAll').grad('getRows');
						if(userData.length != 0){
							$('#groupShow').show();
						}else{
							$('#groupShow').hide();
						}
					}).on('click','.btn_reply',function(){
						var me = $(this);
						var openId = me.attr('id');
						var para = {'openid':openId,'msgid':0};
						self.replyMessage(para);
					});
					$('#allGroup').change(function(){
						var me = $(this);
						var val = me.val();
						var userData = $('#listAll').grad('getRows');
						if(userData.length != 0){
							var data = {};
							var arr = [];
							$.each(userData,function(i,obj){
								arr[i] = obj.openid;
							});
							data.data = arr;
							data.groupid = val;
							$('#loading').addClass('loading');
							getData({'controller':'Weixin','method':'updateGroup','data':data},function(ret){
								$('#loading').removeClass('loading');
								if(ret.statu){
							    	layer.alert(ret.msg);
							    }else{
							    	layer.alert(ret.msg);
							    }
							    self.users();
							});
						}else{
							layer.alert('请选择要改变分组的用户');
						}
					});
					$('#updateUsers').click(function(){
						$('#loading').addClass('loading');
						getData({controller:'Weixin',method:'updateUsers'},function(ret){
							$('#loading').removeClass('loading');
							if(ret.statu){
								layer.alert(ret.msg);
								self.users();
							}else{
								layer.alert(ret.msg);
							}
						});
					});
				}else{
					layer.alert(ret.msg);
					$('#each').getHtml('./plugin/plugins/weixin/weixin',function(){
						self.clickCount();
					});
				}
			});
		});
	},
	uploadMpnews : function(){
		var self = this;
		$('#center').getHtml('./plugin/plugins/weixin/uploadMpnews',function(){
			for(var i=1;i<=10;i++){
				var tag = i;
				$('#file_'+tag).uploadify({
					uploader : '../../controller/index.php?controller=Weixin&method=uploadFile&dir=weixin',
					swf : './public/js/uploadify.swf',
					fileTypeExts : '*.jpg;*.gif;*.png;*.jpeg',
					fileSizeLimit : '1MB',
					buttonText : '',
					width : 150,
					height : 30,
					onUploadSuccess : function(file,data,response){
						var obj = eval('['+data+']');
						if(obj[0].statu != undefined && !obj[0].statu){
							layer.alert(obj[0].msg);
							return false;
						}
						$('#filename_'+tag).val(obj[0].filename);
						$('#showImg_'+tag).attr('src',obj[0].showname).show();
					},
					overrideEvents : ['onSelectError','onDialogClose'],
					onSelectError : function(file,errorCode,errorMsg){
						switch(errorCode){
							case -110 :
								layer.alert('文件'+file.name+'大小超过1M,请上传小于1M的图片');
								break;
							case -120 :
								layer.alert('文件'+file.name+'大小异常');
								break;
						}
						return false;
					}
				});
			}
			$('#save').click(function(){
				var arr = {};
				for(var i=1;i<=10;i++){
					if($('#title_'+i).val() != ''){
						if($('#filename_'+i).val() == ''){
							layer.alert('标题为《'+$('#title_'+i).val()+'》的图片为空，请上传');
							return false;
						}
						if($('#content_'+i).val() == ''){
							layer.alert('标题为《'+$('#title_'+i).val()+'》的内容为空，请填写');
							return false;
						}
						if($('#content_source_url_'+i).val() != ''){
							//正则验证
						}
					}
					if($('#filename_'+i).val() != ''){
						if($('#title_'+i).val() == ''){
							layer.alert('有一篇图文消息标题为空，请检测');
							return false;
						}
						if($('#content_'+i).val() == ''){
							layer.alert('有一篇图文消息内容为空，请检测');
							return false;
						}
						if($('#content_source_url_'+i).val() != ''){
							//正则验证
						}
					}
					if($('#author_'+i).val() != ''){
						if($('#filename_'+i).val() == ''){
							layer.alert('作者为《'+$('#author_'+i).val()+'》的图片为空，请上传');
							return false;
						}
						if($('#title_'+i).val() == ''){
							layer.alert('作者为《'+$('#author_'+i).val()+'》的标题为空，请填写');
							return false;
						}
						if($('#content_'+i).val() == ''){
							layer.alert('作者为《'+$('#author_'+i).val()+'》的内容为空，请填写');
							return false;
						}
						if($('#content_source_url_'+i).val() != ''){
							//正则验证
						}
					}
					if($('#content_source_url_'+i).val() != ''){
						//正则验证
						
						//通过执行以下
						if($('#filename_'+i).val() == ''){
							layer.alert('有一篇消息已经填写了点击跳转的url但是图片没有上传，请上传');
							return false;
						}
						if($('#title_'+i).val() == ''){
							layer.alert('有一篇消息已经填写了点击跳转的url但是标题为空，请填写');
							return false;
						}
						if($('#content_'+i).val() == ''){
							layer.alert('有一篇消息已经填写了点击跳转的url但是内容为空，请填写');
							return false;
						}
					}
					if($('#digest_'+i).val() != ''){
						if($('#filename_'+i).val() == ''){
							layer.alert('有一篇消息已经填写了描述，但是图片没有上传，请上传');
							return false;
						}
						if($('#title_'+i).val() == ''){
							layer.alert('有一篇消息已经填写了描述，但是标题为空，请填写');
							return false;
						}
						if($('#content_'+i).val() == ''){
							layer.alert('有一篇消息已经填写了描述，但是内容为空，请填写');
							return false;
						}
						if($('#content_source_url_'+i).val() != ''){
							//正则验证
						}
					}
					if($('#content_'+i).val() != ''){
						if($('#filename_'+i).val() == ''){
							layer.alert('有一篇消息已经填写了 内容，但是图片没有上传，请上传');
							return false;
						}
						if($('#title_'+i).val() == ''){
							layer.alert('有一篇消息已经填写了内容，但是标题为空，请填写');
							return false;
						}
						if($('#content_source_url_'+i).val() != ''){
							//正则验证
						}
					}
					arr[i] = $('#title_'+i).val();
				}
				var n=0;
				$.each(arr,function(index,val){
					if(val != ''){
						n++;
					}
				});
				if(n<2){
					layer.alert('多图文上传至少要上传2个图文信息，请添加');
					return false;
				}
				var data = {'controller':'Weixin','method':'uploadMpnewses'};
				var formData = $('#form1').serializeArray();
				$.each(formData,function(index,obj){
					data[obj.name] = obj.value;
				});
				$('#loading').addClass('loading')
				getData(data,function(ret){
					$('#loading').removeClass('loading')
					if(ret.statu){
						layer.alert(ret.msg);
						self.uploadMpnews();
					}else{
						layer.alert(ret.msg);
					}
				});
			});
		});
	},
	jbzz : function(){
		window.open("/plugin/weixin/jbzz/index.html");
	},
	slys : function(){
		window.open("/plugin/weixin/slys/index.html");
	},
	ysyj : function(){
		window.open("/plugin/weixin/ysyj/index.html");
	},
	bztz : function(){
		window.open("/plugin/weixin/bztz/index.html");
	},	
	jcbgdjd : function(){
		window.open("/plugin/weixin/bgdjd/index.html");
	}
});
