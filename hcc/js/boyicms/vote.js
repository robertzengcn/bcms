/**
 * 投票
 * */

function Vote() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function ()
	
	/**
	 * 初始化列表
	 * */
	this.initList = function() {
		$(function(){
		
			//table加载数据
			self.fillDataTable();
			
			$('body').on('change keyup click','#subject,#exchange,#status,#qry,#logmin,#logmax',function(){
				self.fillDataTable();
			});
			
			$('body').on('click','#batdel',function(){
				self.delBatch();
				
			});
			
			$('body').on('click','.edittable',function(){
				id=$(this).attr('dataid');
				layer.open({
					type: 2,
					area: ['1000px', '550px'],
					fix: false, //不固定
					maxmin: true,
					shade:0.4,
					title: '新增投票活动',
					content: '../vote/vote-add.html?id='+id,
					success:function(layero,index){
						
					},
					end:function(){
						self.fillDataTable();
					}
				});
			});

			$('body').on('click','.del',function(){
				var id=$(this).attr('dataid');
				var obj=$("#dataTable").dataTable();
				self.openDel(obj,{controller:'Vote',method:'del',id:id});
			});
			$('body').on('click','.editsitetraffic',function(){
				id=$(this).attr('dataid');
				layer.open({
					type: 2,
					area: ['800px', '520px'],
					fix: false, //不固定
					maxmin: true,
					shade:0.4,
					title: '微信投票统计详情',
					content: '../vote/vote-sitetraffic-info.html?vid='+id,
					success:function(layero,index){
						var body = layer.getChildFrame('body', index);
						body.find('#vid').val(id);						
					}
				});
			});			
			
		});
	}
//加载数据表
	this.fillDataTable = function() {
		$(function(){		
			$("#dataTable").grid({
				para:{controller:'Vote',method:'query'},
				//datatable插件里设置列  
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[7]}
							],
				field : [
							{
								data : 'id',
								render : function (id, type, row) {
									return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
								}
							},
							{ data: 'id' },
							{ data: 'title' },
							{ data: 'vi_num'},
							{ data: 'bm_time'},
							{ data: 'tp_time'},
							{ data: 'hd_link',
								render : function (id, type, row) {
									return '<a href="'+row.hd_link+'" style="color:#1abc9c;" target="_blank">'+row.title+'</a>';
								}							
							},
							{
							  data: 'id',
							  orderable: false,
							  render : function(id, type, row){
								  var str = '';
									  str += '<a title="编辑" href="javascript:;" dataid="'+row.id+'" class="edittable" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a><a title="设置" href="javascript:;" onclick="gVote.open_newindows(\'微信投票设置列表\',\'/hcc/vote/vote-set.html?id='+row.id+'\',\'800\',\'420\')" style="text-decoration:none" class="ml-5"><i class="Hui-iconfont">&#xe61d;</i></a><a title="数据统计" href="javascript:;" dataid="'+row.id+'" class="editsitetraffic ml-5" style="text-decoration:none" class="ml-5"><i class="Hui-iconfont">&#xe635;</i></a><a title="删除" href="javascript:;" dataid="'+row.id+'" class="ml-5 del" style="text-decoration:none"><i class="Hui-iconfont">&#xe609;</i></a>'; 				              
								  return str;
							  }
							 }
						]
			});
		});
	}

	/*
	 * 选手设置
	 * 
	 * */	
	this.initEditPlayer = function(){
		var para = self.parseUrl(window.location.href);
       if(para.id!=undefined){
			self.cmd(gHttp,{controller:'VoteItem',method:'get',id:para.id},function(result2){
				if(result2.statu){
					$('#vid').val(result2.data.vid);
					$('#id').val(result2.data.id);
					$('#item').val(result2.data.item);
					$('#vcount').val(result2.data.vcount);
					$('#dcount').val(result2.data.dcount);
					$('#phone').val(result2.data.phone);
					$('#intro').val(result2.data.intro);
					if(result2.data.status!=''){
						$('#status').children("option").each(function(){  
							   var dotemp_value = $(this).val();
							  if(dotemp_value == result2.data.status){					            	 
									$(this).attr("selected","selected");  
							  }  
							  
						 });
					}
					if(result2.data.title!=null){
						var html='';
							html+='<option value="'+result2.data.vid+'">'+result2.data.title+'</option>';	
						$('#aname').html(html);
						
					}
					if(result2.data.piclist){
						var piclist = result2.data.piclist.split('|');
							$('#list1').remove();
							$.each(piclist,function(i,n){
								var num = i+1;
								var html = '<li class=\"maskWraper\" id=\"list'+num+'\">';
									html +=	'<div class=\"bg_pic\"><img src="'+piclist[i]+'" flag="../images/boyicms/logo/thumbnail_auto.gif\" /></div>';
									html +=	'<div class=\"appmsg_edit_mask\">';
									html +=	'<a class=\"js_other\"  title=\"上传图片\" onClick=\"layer_show(\'上传图片\',\'../js/boyicms/uploadimg.html?method=uploadPic&dir=vote&ipn=list&type=piclist\',\'700\',\'420\')\" href=\"javascript:;\"><i class=\"Hui-iconfont\" style=\"font-size:22px;color:#FFFFFF;\">&#xe642;</i></a>';
									html +=	'<a class=\"js_delete\"  title=\"删除\" style=\"float:right;\"><i class=\"Hui-iconfont\" style=\"font-size:22px;color:#FFFFFF;\">&#xe6e2;</i></a>';
									html +=	'</div><input type="hidden" id="piclist'+num+'" name=\"piclist[]\" value=\"'+piclist[i]+'\"></li>';
								$('#img_list .add').before(html);
								if(num==5){
									$('#img_list .add').hide();
								}
							});
					}
				}
				
			});
       }
		if(para.type==2){
			self.cmd(gHttp,{controller:'Vote',method:'getName'},function(result2){	
				if(result2.statu){
					if(result2.data!=null){
						var html='<option value="">---请选择活动名称---</option>';
							$.each(result2.data,function(i,v){
							html+='<option value="'+v.id+'">'+v.title+'</option>';	
						});
						$('#aname').html(html);
						
					}					
				}				
			});	
		}	   
		$('body').on('click','#save',function(){				
			var post = {};
			var id = $("#id").val();		
			var post = {};
			var id = $("#id").val();
			if (id == '') {
				post = {controller:'VoteItem',method:'add'};
			} else {
				post = {controller:'VoteItem',method:'edit',id:id};
			}
			$('#formEdit').checkAndSubmit('save',post,function(result1){
				if(result1.statu){				
					parent.layer.msg('操作成功!',{icon:1});
					layer_close();
					troad('#voteitem');
				}else{
					parent.layer.alert(result1.msg,{icon:2});
					return false;
				}
			});
			
			$('#formEdit').submit();
	
		});
		//轮播图 增加
		$('body').on('click','#img_list .add',function(){
			var len = $('#img_list li').length;
				num = parseInt(len)-1;
			var html = '<li class=\"maskWraper\" id=\"list'+num+'\">';
				html +=	'<div class=\"bg_pic\"><img src="../images/boyicms/logo/thumbnail_auto.gif" flag="../images/boyicms/logo/thumbnail_auto.gif\"/></div>';
				html +=	'<div class=\"appmsg_edit_mask\">';
				html +=	'<a class=\"js_upimg\"  title=\"上传图片\" onClick=\"layer_show(\'上传图片\',\'../js/boyicms/uploadimg.html?method=uploadPic&dir=vote&ipn=list&type=piclist\',\'700\',\'420\')\" href=\"javascript:;\"><i class=\"Hui-iconfont\" style=\"font-size:22px;color:#FFFFFF;\">&#xe642;</i></a>';
				html +=	'<a class=\"js_delete\"  title=\"删除\" style=\"float:right;\"><i class=\"Hui-iconfont\" style=\"font-size:22px;color:#FFFFFF;\">&#xe6e2;</i></a>';
				html +=	'</div><input type="hidden" id="piclist'+num+'" name=\"piclist[]\" value=\"\"></li>';
			$(this).before(html);
			self.initId(len);
			if(len==5){
				$('#img_list .add').hide();
			}
		});	
		//轮播图 删除
		$('body').on('click','.js_delete',function(){
			var id = $(this).parent().parent().attr('id');
			var len = $('#img_list li').length;				
			$('#'+id).remove();
			self.initId(len);
			if(len<7){
				$('#img_list .add').show();
			}
		});
	}
	
	/*
	 * 添加投票活动
	 * 
	 * */
	this.addVote=function(){
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");	
		var para = self.parseUrl(window.location.href);
		
       if(para.id!=undefined){
			self.cmd(gHttp,{controller:'Vote',method:'get',id:para.id},function(result2){
				if(result2.statu){
					//$('#formEdit').frmFill('',result2.data);
					$('#id').val(result2.data.id);
					$('#title').val(result2.data.title);
					$('#fxms').val(result2.data.fxms);
					$('#ktcs').val(result2.data.ktcs);
					$('#gztb').val(result2.data.gztb2);
					$('#bmksmin').val(result2.data.start_time);
					$('#bmjxmin').val(result2.data.over_time);
					$('#tpksmin').val(result2.data.statdate);
					$('#tpjxmin').val(result2.data.enddate);
					$('#gonggao').val(result2.data.gonggao);
					$('#xncheck').val(result2.data.xncheck);
					$('#xntps').val(result2.data.xntps);
					$('#xnbms').val(result2.data.xnbms);
					$('#wfbmbz').val(result2.data.wfbmbz);
					$('#shumat').val(result2.data.shumat);
					$('#shumbt').val(result2.data.shumbt);
					$('#shumct').val(result2.data.shumct);
					$('#fxtb').val(result2.data.fxtb);
					$('#appid').val(result2.data.appid);
					$('#appsecret').val(result2.data.appsecret);
					if(result2.data.is_sh!=''){
						$('#is_sh').children("option").each(function(){  
							   var dotemp_value = $(this).val();
							  if(dotemp_value == result2.data.is_sh){					            	 
									$(this).attr("selected","selected");  
							  }  
							  
						 });
					}
						$('input[name="moban"]').each(function(){  
							   var moban_value = $(this).val();
							  if(moban_value == result2.data.moban){					            	 
									$(this).iCheck('check');  
							  }  
							  
						 });					
					if(result2.data.is_sendsms==1){
						$('#is_sendsms').iCheck('check');
					}else{
						$('#is_sendsms').iCheck('check');
					}					
					var editor1 = UE.getEditor('editor1');
					 editor1.ready(function() {
		    				editor1.setContent(result2.data.shuma);
					});
					var editor2 = UE.getEditor('editor2');
					 editor2.ready(function() {
		    				editor2.setContent(result2.data.shumb);
					});
					var editor3 = UE.getEditor('editor3');
					 editor3.ready(function() {
		    				editor3.setContent(result2.data.shumc);
					});
                        if(result2.data.src != ''){
							$('#thumbnail_fxtb').attr('src',result2.data.src);							
						}

					if(result2.data.gztb != ''){
						$('#thumbnail_gztb').attr('src',result2.data.gztb);							
					}						
					var piclist = result2.data.wappicurl.split('|');
					var len = piclist.length;
					if(result2.data.wappicurl && len>0){
						$('#list1').remove();
						$.each(piclist,function(i,n){
							var num = i+1;
							var html = '<li class=\"maskWraper\" id=\"list'+num+'\">';
								html +=	'<div class=\"bg_pic\"><img src="'+piclist[i]+'" flag="../images/boyicms/logo/thumbnail_auto.gif\"  width=\"160px\" /></div>';
								html +=	'<div class=\"appmsg_edit_mask\">';
								html +=	'<a class=\"js_other\"  title=\"上传图片\" onClick=\"layer_show(\'上传图片\',\'../js/boyicms/uploadimg.html?method=uploadPic&dir=vote&ipn=list&type=piclist\',\'700\',\'420\')\" href=\"javascript:;\"><i class=\"Hui-iconfont\" style=\"font-size:22px;color:#FFFFFF;\">&#xe642;</i></a>';
								html +=	'<a class=\"js_delete\"  title=\"删除\" style=\"float:right;\"><i class=\"Hui-iconfont\" style=\"font-size:22px;color:#FFFFFF;\">&#xe6e2;</i></a>';
								html +=	'</div><input type="hidden" id="piclist'+num+'" name=\"piclist[]\" value=\"'+piclist[i]+'\"></li>';
							$('#img_list .add').before(html);
							if(num==5){
								$('#img_list .add').hide();
							}
						});
					}
				}
				
			});
		self.initEditVoteItem();
       }
		$('#luckdraw_type').change(function(){
			var isrc=$(this).find('option:selected').attr('flag');
			$('img#luckdraw-img').attr('src',isrc);		
		})
		
		$('body').on('click','#save',function(){
			self.save();
		});
		
		$('body').on('click','#fxms',function(){
			var msg='<img src="'+$(this).attr('info')+'" width="260px"/>';
			layer.tips(msg, $(this), {
				tips: [2,'#78BA32'],
				area:['280px','135px'],
				time:6000
			});
		});
		
		$('body').on('mouseover','#thumbnail_fxtb',function(){
			var msg='<img src="'+$(this).attr('info')+'" width="260px"/>';
			layer.tips(msg, $(this), {
				tips: [2,'#78BA32'],
				area:['280px','135px'],
				time:6000
			});
		});
		$('body').on('mouseover','#thumbnail_gztb',function(){
			var msg='<img src="'+$(this).attr('info')+'" width="260px"/>';
			layer.tips(msg, $(this), {
				tips: [2,'#78BA32'],
				area:['280px','193px'],
				time:6000
			});
		});
		$('body').on('click','#appid,#appsecret',function(){
			var msg='<img src="'+$(this).attr('info')+'" width="260px"/>';
			layer.tips(msg, $(this), {
				tips: [2,'#78BA32'],
				area:['280px','139px'],
				time:6000
			});
		});
		$('body').on('click','#gonggao,#wfbmbz',function(){				
			var msg='<img src="'+$(this).attr('info')+'" width="180px"/>';
			layer.tips(msg, $(this), {
				tips: [2,'#78BA32'],
				area:['200px','327px'],
				time:6000
			});
		});
		$('body').on('click','input.stylelist',function(){				
			var msg='<img src="'+$(this).attr('info')+'" width="180px"/>';
			layer.tips(msg, $(this), {
				tips: [3,'#78BA32'],
				area:['200px','327px'],
				time:6000
			});
		});
		$('body').on('click','#addplayer',function(){
			var id=$('#id').val();
			if(id==""){
				layer.msg('请先保存投票活动信息');
				$("#voteactive").trigger("click");
				
			}else{
				var index=layer.open({
					type: 2,
					area: ['730px', '500px'],
					fix: false, //不固定
					maxmin: true,
					shade:0.4,
					title: '添加选手-微信投票',
					content: 'player-add.html',
					success:function(layero, index){
						var body = layer.getChildFrame('body', index);
						 body.find('#vid').val(id);
					},
					end:function(){
						self.initEditVoteItem();					
					}
					
				});
			}
		});
		$('body').on('click','.editplayer',function(){
			id=$(this).attr('dataid');
			layer.open({
				type: 2,
				area: ['730px', '500px'],
				fix: false, //不固定
				maxmin: true,
				shade:0.4,
				title: '编辑选手-微信投票',
				content: 'player-add.html?id='+id,
				success:function(layero,index){
					var body = layer.getChildFrame('body', index);
					body.find('#id').val(id);					
				},
				end:function(){
					self.initEditVoteItem();
				}
			});
		});		
		//轮播图 增加
		$('body').on('click','#img_list .add',function(){
			var len = $('#img_list li').length;
				num = parseInt(len)-1;
			var html = '<li class=\"maskWraper\" id=\"list'+num+'\">';
				html +=	'<div class=\"bg_pic\"><img src="../images/boyicms/logo/thumbnail_auto.gif" flag="../images/boyicms/logo/thumbnail_auto.gif\"  width=\"150px\" height=\"90px\"/></div>';
				html +=	'<div class=\"appmsg_edit_mask\">';
				html +=	'<a class=\"js_upimg\"  title=\"上传图片\" onClick=\"layer_show(\'上传图片\',\'../js/boyicms/uploadimg.html?method=uploadPic&dir=vote&ipn=list&type=piclist\',\'700\',\'420\')\" href=\"javascript:;\"><i class=\"Hui-iconfont\" style=\"font-size:22px;color:#FFFFFF;\">&#xe642;</i></a>';
				html +=	'<a class=\"js_delete\"  title=\"删除\" style=\"float:right;\"><i class=\"Hui-iconfont\" style=\"font-size:22px;color:#FFFFFF;\">&#xe6e2;</i></a>';
				html +=	'</div><input type="hidden" id="piclist'+num+'" name=\"piclist[]\" value=\"\"></li>';
			$(this).before(html);
			self.initId(len);
			if(len==5){
				$('#img_list .add').hide();
			}
		});	
		//轮播图 删除
		$('body').on('click','.js_delete',function(){
			var id = $(this).parent().parent().attr('id');
			var len = $('#img_list li').length;				
			$('#'+id).remove();
			self.initId(len);
			if(len<7){
				$('#img_list .add').show();
			}
		});
		

		self.onloadIcheckboxCss();
	}
	
	//初始化图片id
	this.initId = function(len){
		for(var i=0;i<=len;i++){
			$('#img_list li:eq('+i+')').attr('id','list'+(i+1));
			$('#img_list li:eq('+i+')').find('input[type="hidden"]').attr('id','piclist'+(i+1));
		}
	}

	/**
	 * 初始化编辑
	 * */
	this.initEditVoteItem = function() {
			var vid=$('#id').val();				
			$("#voteitem").grid({
				para:{controller:'VoteItem',method:'query',vid:vid},
				//datatable插件里设置列  
				field : [
							{
								data : 'id',
								render : function (id, type, row) {
									return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
								}
							},
							{ data: 'id' },
							{ data: 'item' },
							{ data: 'vcount'},
							{ data: 'dcount'},							
							{ data: 'phone'},
							{ data: 'addtime'},
							{ data: 'status',
								render:function(id, type, row){
									if(row.status==1){
										return '<span class="badge badge-success radius">通过</span>';
									}else{
										return '<span class="label label-default radius">未通过</span>';										
									}
							}},	
							{
							  data: 'id',
							  orderable: false,
							  render : function(id, type, row){
								  var str = '';
								  str += '<a title="编辑" href="javascript:;" dataid="'+row.id+'" style="text-decoration:none" class="editplayer"><i class="Hui-iconfont">&#xe6df;</i></a>';
								  if(row['status']==0){
									 str += '<a style="text-decoration:none" onClick="gVote.auditSwitch('+row.id+',1);" href="javascript:;" title="审核通过" class="ml-5"><i class="Hui-iconfont">&#xe6e1;</i></a>';
									}else{
									 str += '<a style="text-decoration:none" onClick="gVote.auditSwitch('+row.id+',0);" href="javascript:;" title="审核不通过" class="ml-5"><i class="Hui-iconfont">&#xe6dd;</i></a>';									
									}
								 str +='<a title="删除" href="javascript:;" onclick="gVote.delPlayer('+row.id+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>';
								  return str;
							  }
							 }
						]
			});
	}
	
	
    //按钮
	//单个删除
	this.del = function(obj, id) {
		self.openDel(obj,{controller:'Vote',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function(obj) {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			self.openDel(obj,{controller:'Vote',method:'del',id:ids});
		}
	}

	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();		
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Vote',method:'add'};
		} else {
			post = {controller:'Vote',method:'edit',id:id};
		}
		var formObj=$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				if(id == ''){
					$('#id').val(result1.data.id);
				}				
				parent.layer.msg('操作成功!',{icon:1});	
				parent.gVote.fillDataTable();
				layer_close();
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
			return false;
		});
		if(!formObj.check('false','#fxms')||!formObj.check('false','#fxtb')||!formObj.check('false','#gztb')||!formObj.check('false','#appid')||!formObj.check('false','#appsecret')){			
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
		}
		if(!formObj.check('false','#title')||!formObj.check('false','#gonggao')||!formObj.check('false','#wfbmbz')||!formObj.check('false','#xncheck')||!formObj.check('false','#xntps')||!formObj.check('false','#xnbms')||!formObj.check('false','#ktcs')||!formObj.check('false','#bmksmin')||!formObj.check('false','#bmjxmin')||!formObj.check('false','#tpksmin')||!formObj.check('false','#tpjxmin')||!formObj.check('false','#shumat')||!formObj.check('false','#shumbt')||!formObj.check('false','#shumct')){				
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		}
		$('#formEdit').submit();

	}
	
	/*打开新窗口*/
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
			}
		});
//		layer.full(index);
	}
	
// {{{ function onloadCss()
	
	this.onloadCss = function() {
		
		/*缩略图操作*/
		$('div.thumbnailbox').on('mouseenter',function(){
			$(this).find('div.img-btn').stop().animate({height:"30px"});
		}).on('mouseleave', function() {
			$(this).find('div.img-btn').stop().animate({height:"0px"});
		});
		$('div.img-btn').find('span').on('mouseenter',function(){
			$(this).stop().css("background-position","-46px 0px");
		}).on('mouseleave',function(){
			$(this).stop().css("background-position","-46px -22px");
		});
		var defaultsrc=$('div.thumbnailbox img').attr('flag');
		$('span#delete-thisimg').on('click',function(){
			$thumbnail_img=$(this);
			layer.confirm('确认不再使用当前缩略图吗？',function(index){		
				$thumbnail_img.parent().parent().find('img').attr('src',defaultsrc);
				layer.msg('已删除!',1);
			});
		});
		/*缩略图操作完结*/
	}
	
	/*单选、复选框特效*/
	this.onloadIcheckboxCss = function() {
		$('.skin-minimal input').iCheck({
			checkboxClass: 'icheckbox-blue',
			radioClass: 'iradio-blue',
			increaseArea: '20%'
		});			
	}	
	this.delPlayerBatch = function(obj) {
		var ids=$("#voteitem").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj = $("#voteitem").getSelectedAll();
			self.openDel(obj,{controller:'VoteItem',method:'del',id:ids});
		}
	}
	
	this.delPlayer = function(id) {
		var obj=$("#voteitem").dataTable();
		self.openDel(obj,{controller:'VoteItem',method:'del',id:id});

	}
	//开启关闭按钮
	this.auditSwitch = function(id,status) {
		self.cmd(gHttp,{controller:'VoteItem',method:'auditSwitch',id:id,status:status},function(result1){
			if(result1.statu){
				if(result1.data==1){
					if(status==0){
						layer.msg('状态已更新为审核不通过!', {icon:1});
					}else{
						layer.msg('审核成功!', {icon:1});
					}
					troad('#voteitem');
				}else{
					layer.msg('已经开启!', {icon:1}); 					
				}
			}
		});
	}
	//开启设置
	this.setSwitch = function(id,vid,status) {
		self.cmd(gHttp,{controller:'Vote',method:'setSwitch',id:id,vid:vid,status:status},function(result1){
			if(result1.statu){
				if(result1.data==1){
					layer.msg('开启成功!', {icon:1});
				}else{
					layer.msg('关闭成功!', {icon:1}); 
				}
					troad('#dataTable');
			}
		});
	}	
	/**
	 * 初始化选手列表
	 * */
	this.initPlayerList = function() {
		$(function(){
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");	
			//table加载数据
			self.fillDataPlayerTable();
			
			$('body').on('click','#batdel',function(){
				self.delBatch();
				
			});

			$('body').on('click','.del',function(){
				var id=$(this).attr('dataid');
				var obj=$("#dataTable").dataTable();
				self.openDel(obj,{controller:'Vote',method:'del',id:id});
			});
			
			
		});

	}
	this.fillDataPlayerTable = function() {		
			$("#voteitem").grid({
				para:{controller:'VoteItem',method:'queryList',status:0},
				//datatable插件里设置列  
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}
							],
				field : [
							{
								data : 'id',
								render : function (id, type, row) {
									return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
								}
							},
							{ data: 'id' },
							{ data: 'item' },
							{ data: 'name' },							
							{ data: 'phone'},
							{ data: 'addtime'},
							{ data: 'status',
								render:function(id, type, row){
									if(row.status==1){
										return '<span class="badge badge-success radius">通过</span>';
									}else{
										return '<span class="label label-default radius">未通过</span>';										
									}
							}}
						]
			});
	}
	//加载微信信息数据

	this.fillWxDataTable = function() {		
			$("#dataTable").grid({
				para:{controller:'VoteWxsz',method:'query'},
				//datatable插件里设置列  
				field : [
							{
								data : 'id',
								render : function (id, type, row) {
									return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
								}
							},
							{ data: 'id' },
							{ data: 'appid' },
							{ data: 'appsecret'},
							{ data: 'name' },
							{
							  data: 'id',
							  orderable: false,
							  render : function(id, type, row){
								  var str = '';
								  str += '<input type="hidden" id="num" value="'+row.status+'"/><a title="编辑" href="javascript:;" dataid="'+row.id+'" style="text-decoration:none" class="editweixin"><i class="Hui-iconfont"></i></a>';
								  str +='<a title="删除" href="javascript:;" onclick="gVote.delWeixin('+row.id+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont"></i></a>';
								  return str;
							  }
							 }
						]
			});
	}
	this.initWeixin = function(){
		self.fillWxDataTable();
		$('body').on('click','#weixinadd',function(){
			var num = $('#num').val();
			if(num==''){
				layer.msg('请先添加活动内容!', {icon:2});
			}else{
				layer.open({
					type: 2,
					area: ['600px', '360px'],
					fix: false, //不固定
					maxmin: true,
					shade:0.4,
					title: '添加微信公众号信息',
					content: 'weixin-add.html?type=2',
					success:function(layero,index){				
					},
					end:function(){
						self.fillWxDataTable();							
					}
				});				
			}
		});
		$('body').on('click','.editweixin',function(){
			id=$(this).attr('dataid');
			layer.open({
				type: 2,
				area: ['600px', '360px'],
				fix: false, //不固定
				maxmin: true,
				shade:0.4,
				title: '编辑微信公众号信息',
				content: 'weixin-add.html?id='+id,
				success:function(layero,index){				
				},
				end:function(){
						self.fillWxDataTable();					
				}
			});
		});
	}
	/**
	 * 获取weixin公众号设置
	 * */
	this.setWeixin = function() {
		var para = self.parseUrl(window.location.href);		
       if(para.id!=undefined){
			self.cmd(gHttp,{controller:'VoteWxsz',method:'get',id:para.id},function(result2){
				if(result2.statu){
					if(result2.data.title!=null){
						var html='';
							html+='<option value="'+result2.data.vid+'">'+result2.data.title+'</option>';	
						$('#aname').html(html);
						
					}
					$('#id').val(result2.data.id);
					$('#vid').val(result2.data.vid);
					$('#appid').val(result2.data.appid);
					$('#appsecret').val(result2.data.appsecret);					
				}
			});
		}
		if(para.type==2){
			self.cmd(gHttp,{controller:'Vote',method:'getName'},function(result2){	
				if(result2.statu){
					var html='<option value="">---请选择活动名称---</option>';
						$.each(result2.data,function(i,v){
						html+='<option value="'+v.id+'">'+v.title+'</option>';	
						}); 
					$('#aname').html(html);								
				}				
			});	
			
		}

		$('body').on('click','#save',function(){				
			var post = {};
			var id = $("#id").val();		
			var post = {};
			var id = $("#id").val();
			if (id == '') {
				post = {controller:'VoteWxsz',method:'add'};
			} else {
				post = {controller:'VoteWxsz',method:'edit',id:id};
			}
			$('#formEdit').checkAndSubmit('save',post,function(result1){
				if(result1.statu){				
					parent.layer.msg('操作成功!',{icon:1});
					layer_close();
					troad('#dataTable');
				}else{
					parent.layer.alert(result1.msg,{icon:2});
					return false;
				}
			});
			
			$('#formEdit').submit();
	
		});
	}

	this.delWeixin = function(id) {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的选手！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'VoteWxsz',method:'del',id:ids});
		}
	}
	
	
	
	/**
	 * 初始化列表
	 * */
	this.initSetList = function() {
		$(function(){
			//table加载数据
			self.fillSetDataTable();
		});
	}
	/**
	 * 加载数据表
	 * */
	this.fillSetDataTable = function() {
		var para = self.parseUrl(window.location.href);	
		$("#dataTable").grid({
			para : {controller:'Vote',method:'getSetList',vid:para.id},
			showPage : false,
			tableInfo : false,
			order : false,
			aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
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
			            { data: 'content'},
			            { data: 'status',
			            	render:function(id, type, row){
			            		if(row.status==0){
			            			return '<span class="label label-default radius">未开启</span>';
			            		}else{
			            			return '<span class="badge badge-success radius">已开启</span>';									
								}
			            }},
						{
						  data: 'id',
						  orderable: false,
						  render : function(id, type, row){
							  var str = '';
							  if(row['status']==0){
								 str += '<a style="text-decoration:none" " onClick="gVote.setSwitch('+row.id+','+row.vid+',1);" href="javascript:;" title="开启"><i class="Hui-iconfont">&#xe615;</i></a>';
								}else{
								 str += '<a style="text-decoration:none" " onClick="gVote.setSwitch('+row.id+','+row.vid+',0);" href="javascript:;" title="关闭"><i class="Hui-iconfont">&#xe631;</i></a>';									
								}
							  return str;
						  }
						 }
			        ]
		});
		
	}
	/**
	 * 初始化综合统计列表
	 * */
	this.initVoteSiteTraffic = function() {
		$(function(){
			$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
			
			//table加载数据
			self.fillVoteDataTable();
			
			$(".tabBar span").click(function(){
				var index = $(this).index();
				switch(index) {
				    case 0: //综合统计
				    	//self.fillVoteDataTable();
				    	location.replace(location.href);
					    break;
				    case 1: //访客分析
				    	self.sync = true;
		                //self.visitorsStat({controller:'VoteStatisticsLog',method:'distributed'});
		                //所有投票曲线
		                self.voteDataLine({controller:'VoteStatisticsLog',method:'voteLineDistributed'});
		                self.sync = false;
				    	break;
				}
			});
			
			$('body').on('click','.edittable',function(){
				id=$(this).attr('dataid');
				layer.open({
					type: 2,
					area: ['800px', '520px'],
					fix: false, //不固定
					maxmin: true,
					shade:0.4,
					title: '微信投票统计详情',
					content: '../vote/vote-sitetraffic-info.html?vid='+id,
					success:function(layero,index){
						var body = layer.getChildFrame('body', index);
						body.find('#vid').val(id);						
					}
				});
			});			

			
			
		});
	}
	this.initVoteSiteTrafficInfo = function() {
		$(function(){
			$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
				//查询
			self.fillVoteLogDataTable();
			$(".tabBar span").click(function(){
				var index = $(this).index();
				switch(index) {
				    case 0: //综合统计
				    	//self.fillVoteLogDataTable();
				    	location.replace(location.href);
					    break;
				    case 1: //
				    	self.sync = true;
		                //self.visitorsStat({controller:'VoteStatisticsLog',method:'distributed'});
		                //所有投票曲线
						var vid = $('#vid').val();
		                self.visitorsLineStat({controller:'VoteStatisticsLog',method:'lineDistributed',vid:vid});
		                self.sync = false;
				    	break;
				}
			});
				$("#qry").click(function(){
					var start_time = $('#vote_info_start').val();
					var end_time = $('#vote_info_time').val();
					if(start_time==''||end_time=='')
					layer.msg('请选择日期',{icon:2});
					var url = {controller:'VoteStatisticsLog',method:'query',start_time:start_time,end_time:end_time};
					self.fillVoteLogDataTable(url);
				});
				
				//按条件删除数据
				$('#del').click(function(){
					self.clearAllVote();
				});
					
		});
	}
	/**
	 * 加载数据表
	 * */
	this.fillVoteDataTable = function(url) {
		if (url == undefined) {
			url = {controller:'VoteStatisticsLog',method:'getVoteData'};
		}
		self.cmd(gHttp,url,function(ret) {
			var data = ret.rows;
			var total = ret.ttl;
			$("#total").html(total);
			$("#dataTable").DataTable().destroy();
			$("#dataTable").DataTable({
				bStateSave:true,
				data:data,
				bSort: false,
				aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]}
							],
				columns: [
				            {
				            	data : 'id',
				            	render : function (id, type, row) {
				            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
				            	}
				            },
                            { data: 'id' },
                            { data: 'title' },
				            { data: 'total_votes' },
				            { data: 'total_check'},
				            { data: 'total_player'},
				            { data: 'time'}
				        ]
			});
		});
		
		
	}
	/**
	 * 加载数据表
	 * */
	this.fillVoteLogDataTable = function(url) {
			var start_time = $('#vote_info_start').val();
			var end_time = $('#vote_info_end').val();
			if (url == undefined) {
				url = {controller:'VoteStatisticsLog',method:'query',start_time:start_time,end_time:end_time};
			}
			self.cmd(gHttp,url,function(ret) {
				var data = ret.rows;
				var total = ret.ttl;
				$("#total").html(total);
				$("#dataTable").DataTable().destroy();
				$("#dataTable").DataTable({
					bStateSave:true,
					data:data,
					bSort: false,
					aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
								],
					columns: [
								{
									data : 'id',
									render : function (id, type, row) {
										return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
									}
								},
								{ data: 'id' },
								{ data: 'total_votes' },
								{ data: 'total_check'},
								{ data: 'total_player'},
								{ data: 'tj_time'}
							]
				});
			});
	
	}	
	//投票分析
	this.visitorsStat = function(para) {
		var start = $('#vote_start').val();
		var end = $('#vote_end').val();
		para['star'] = start;
		para['end'] = end;
		self.cmd(gHttp,para,function(result1){
			if(result1.statu){
				$('#visitors_ratio').highcharts({
					chart : {
						plotBackgroundColor: null,
			            plotBorderWidth: null,
			            plotShadow: false
					},
					title : {
						text :'用户投票分布'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					},
					plotOptions: {
						pie: { 
							allowPointSelect: true, 
							cursor: 'pointer', 
							dataLabels: { 
								enabled: true, 
								color: '#000000', 
								connectorColor: '#000000', 
								format: '<b>{point.name}</b>: {point.percentage:.1f} %'
							} 
						}
				    },
					series : [{
						type : 'pie',
						name : '比例',
						data : result1.data
					}]
				});
			}else{
				layer.alert(result1.msg);
			}
			return false;
		});
	}
    this.voteDataLine = function(para) {
		self.cmd(gHttp,para,function(result1){
				//console.log(result1);						 
				if(result1.statu){
					$('#visitors_date').highcharts({
						
						chart: {
							zoomType: 'x',
							spacingRight: 20,
							type: 'column'
						},
						title: {
							text: '用户综合投票曲线图'
						},
						subtitle: {
							text: document.ontouchstart === undefined ?
								'单击并在绘图区拖动放大' :
								'鼠标框住区域放大图片'
						},
						xAxis: {
							type: 'datetime',
							categories:result1.data.votename,

							title: {
								text: '活动名称'
							}
						},
						yAxis: {
							title: {
								text: '数量'
							}
						},
						legend: {
							enabled: false
						},
						tooltip: {
							shared: true
						},
						legend: {
							enabled: false
						},
						plotOptions: {
							column: {
								fillColor: {
									linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
									stops: [
										[0, Highcharts.getOptions().colors[0]],
										[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
									]
								},
								lineWidth: 1,
								marker: {
									enabled: false
								},
								shadow: false,
								states: {
									hover: {
										lineWidth: 1
									}
								},
								threshold: null
							}
						},
			
						series: [
							{
								type: 'column',
								name: '投票量',
								data: result1.data.tnum
							}
							,
							{
								type: 'column',
								name: '访问量',
								data: result1.data.fnum
							}		                
						]
					});
					
				}else{
					layer.alert(result1.msg);
				}
				return false;
			});		
	}
	//投票时间曲线
    this.visitorsLineStat = function(para) {
    	self.cmd(gHttp,para,function(result1){
			//console.log(result1);						 
			if(result1.statu){
		    	$('#visitors_date').highcharts({
		            chart: {
		                zoomType: 'x',
		                spacingRight: 20
		            },
		            title: {
		                text: result1.data.title+'---投票曲线图'
		            },
		            subtitle: {
		                text: document.ontouchstart === undefined ?
		                    '单击并在绘图区拖动放大' :
		                    '鼠标框住区域放大图片'
		            },
		            xAxis: {
		            	type: 'datetime',
		            	categories:result1.data.visittime,
                        dateTimeLabelFormats: {
                        	day: '%Y-%m-%d',
                        	month: '%Y-%m-%d',
                        	year: '%Y-%m-%d'
                        },
		                title: {
		                    text: '活动日期'
		                }
		            },
		            yAxis: {
		                title: {
		                    text: '数量'
		                }
		            },
		            tooltip: {
		                shared: true
		            },
		            legend: {
		                enabled: false
		            },
		            plotOptions: {
		                area: {
		                    fillColor: {
		                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
		                        stops: [
		                            [0, Highcharts.getOptions().colors[0]],
		                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
		                        ]
		                    },
		                    lineWidth: 1,
		                    marker: {
		                        enabled: false
		                    },
		                    shadow: false,
		                    states: {
		                        hover: {
		                            lineWidth: 1
		                        }
		                    },
		                    threshold: null
		                }
		            },
		
		            series: [
		                {
			                type: 'area',
			                name: '投票量',
			                color: 'red',
			                data: result1.data.tnum
		                }
		                ,
		                {
			                type: 'area',
			                name: '访问量',
			                color: 'blue',
			                data: result1.data.fnum
		                }
		                ,
		                {
			                type: 'area',
			                name: '报名人数',
			                color: 'green',
			                data: result1.data.bnum
		                }		                
		            ]
		        });
		    	
			}else{
				layer.alert(result1.msg);
			}
			return false;
		});
    }
	//批量删除
	this.delBatchVote = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'VoteStatisticsLog',method:'del',id:ids});
	}

	//清空数据
	this.clearAllVote = function(){
		var start_time = $('#vote_info_start').val();
		var end_time = $('#vote_info_end').val();
		layer.confirm('真的要删除么当前条件下搜索得到的所有数据吗？删除后无法恢复！',function(index){
			self.cmd(gHttp,{controller:'VoteStatisticsLog',method:'del',start_time:start_time,end_time:end_time},function(result1){
				if(result1.statu){
					location.replace(location.href);
				}else{
					layer.alert(result1.msg);
				}
			});
		});
	}

}