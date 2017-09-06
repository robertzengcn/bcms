/**
 * 积分商城
 * */

var oTable = null;
function Draw() {
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
					area: ['800px', '400px'],
					fix: false, //不固定
					maxmin: true,
					shade:0.4,
					title: '新增抽奖活动',
					content: '../../activities/luckdraw/luckdraw-add.html?id='+id,
					success:function(layero,index){},
					end:function(){
						self.fillDataTable();
					}
				});
			});
			$('body').on('click','.stop',function(){
				var id=$(this).attr('dataid');
				var statu=$(this).attr('datast');
				self.cmd(gHttp,{controller:'Draw',method:'setdrawstute',id:id,statu:statu},function(result3){
					if(result3.statu){
						if(status==0){
							layer.msg('成功停止活动!', {icon:1});
						}else{
							layer.msg('成功开启活动!', {icon:1});
						}
						self.fillDataTable();
					}else{
						layer.alert(result3.msg);
					}
					
				});
				
			});
			$('body').on('click','.del',function(){
				var id=$(this).attr('dataid');
				var obj=$("#dataTable").dataTable();
				self.openDel(obj,{controller:'Draw',method:'del',id:id});
			});
			
			
		});
	}
//加载数据表
	this.fillDataTable = function() {
		$(function(){		
			$("#dataTable").grid({
				para:{controller:'Draw',method:'query'},
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]},{sClass:'text-c',aTargets:[7]},{sClass:'text-c',aTargets:[8]}
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
							{ data: 'type',render:function(id, type, row){
								if(row.type==3){
									return '转盘模式';
								}else if(row.type==2){
									return '刮刮卡模式';
								}else{
									return '砸金蛋模式';
								}
							}},
							{ data: 'statu',
								render:function(id, type, row){
									if(row.statu==0){
										return '<span class="label label-default radius">已关闭</span>';
									}else if(row.statu==1){
										return '<span class="badge badge-success radius">已开启</span>';
									}else{
										return '<span class="label label-default radius">已结束</span>';									
									}
							}},
							{ data: 'num',
								render:function(id, type, row){
									if(row.num>0){
										return '<span class="label label-success radius">己上架</span>';
									}else{
										return '<span class="badge badge-default radius">未上架</span>';
									}
								}
								},		
							{ data: 'start_time'},
							{ data: 'end_time'},
							{
							  data: 'id',
							  orderable: false,
							  render : function(id, type, row){
								  var str = '';
									str += '<a title="编辑" href="javascript:;" dataid="'+row.id+'" class="edittable" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>';
								  if(row.statu==0){
									 str += '<a class="ml-5 stop" title="开启" dataid="'+row.id+'" datast="1" style="text-decoration:none"><i class="Hui-iconfont">&#xe601;</i></a>';
									}else{
									 str += '<a class="ml-5 stop" title="停用" dataid="'+row.id+'" datast="0" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>';								
									}
									str +='<a title="删除" href="javascript:;" dataid="'+row.id+'" class="ml-5 del" style="text-decoration:none"><i class="Hui-iconfont">&#xe609;</i></a>'; 				              
								  return str;
							  }
							 }
						]
			});
		});
	}
	this.ininprize=function(){
		var id=$('#id').val();
		var para={controller:'Draw',method:'prizequery',drawid:id};
		self.cmd(gHttp,para, function(result) {
			var ttl = result.ttl;
			var data = result.rows;	
			$("#dataTable").grid({
				ttl : ttl,
				data : data,				
				//datatable插件里设置列  				
				field : [
							{
								data : 'id',
								render : function (id, type, row) {
									return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
								}
							},
							{ data: 'prize_position'},
							{ data: 'name' },
							{ data: 'prize_count'},
							{ data: 'prize_every'},
							{ data: 'prize_percent'},
							{
							  data: 'id',
							  orderable: false,
							  render : function(id, type, row){
								  var str = '';
								  str += '<a title="编辑" href="javascript:;" dataid="'+row.id+'" type="'+row.type+'" style="text-decoration:none" class="editprize"><i class="Hui-iconfont"></i></a><a title="删除" href="javascript:;" onclick="Drawlist.delprize('+row.id+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont"></i></a>'; 				              
								  return str;
							  }
							 }
						]
				});
			$("#chance").text(result.total+'%');
		});
	}	

	
	/*
	 * 添加新的医疗服务
	 * 
	 * */
	this.addNewdraw=function(){
		var para = self.parseUrl(window.location.href);
		
		if(para.id!=undefined){
			self.cmd(gHttp,{controller:'Draw',method:'get',id:para.id},function(result2){
				if(result2.statu){
					$('#id').val(result2.data.id);
					$('#name').val(result2.data.name);
					$('#bonus').val(result2.data.bonus);
					$('#luckdraw_type').children("option").each(function(){  
			               var dotemp_value = $(this).val();
			              if(dotemp_value == result2.data.type){			            	
			                    $(this).attr("selected","selected");  
			              }  
			              
			         });
					if(result2.data.statu==1){
						$('#stutesy').iCheck('check');
					}else{
						$('#stutesn').iCheck('check');
					}
					$('#limit').children("option").each(function(){  
			            var dotemp_value = $(this).val();
						if(dotemp_value == result2.data.limit){			            	
							$(this).attr("selected","selected");  
						}  
			              
			         });
					var isrc=$('#luckdraw_type').find('option:selected').attr('flag');
					$('img#luckdraw-img').attr('src',isrc);	
					
					
					$('#logmin').val(result2.data.start_time);
					$('#logmax').val(result2.data.end_time);
					var editor = UE.getEditor('editor');
					 editor.ready(function() {
		    				editor.setContent(result2.data.descript);
						 });
                        if(result2.data.pic != ''){
							$('#thumbnail').attr('src',result2.data.src);							
						}
						$('#pic').val(result2.data.pic);
				}
				
			});
			self.ininprize();
		}
		$('#luckdraw_type').change(function(){
			var isrc=$(this).find('option:selected').attr('flag');
			$('img#luckdraw-img').attr('src',isrc);		
		})
		$('body').on('click','#save',function(){			
			self.save();
		});
		
		$('body').on('click','#addprize',function(){
			var id=$('#id').val();
			if(id==""){
				layer.msg('请先保存抽奖规则信息');
				$("#drawrule").trigger("click");
				
			}else{
				var index=layer.open({
					type: 2,
					area: ['600px', '370px'],
					fix: false, //不固定
					maxmin: true,
					shade:0.4,
					title: '添加奖品',
					content: 'commodity-add.html?id='+id,
					success:function(layero, index){},
					end:function(){						
						self.ininprize();
					}
					
				});
			}
		});
		
		$('body').on('click','.editprize',function(){
			var prizeid=$(this).attr('dataid');
			var type=$(this).attr('type');
			var url="";
			var title="";
			if(type=="1"){
				url="c-medicalservice.html?prizeid="+prizeid;
				title="编辑奖品";
			}else{
				url="c-selfbuy.html?prizeid="+prizeid;
				title="编辑奖品";
			}
			
			parent.layer.open({
				type: 2,
				area: ['840px', '400px'],
				fix: false, //不固定
				maxmin: true,
				shade:0.4,
				title: title,
				content: url,
				success:function(layero,index){},
				end:function(){
					self.ininprize();
				}
			});
			
		});
		
		$('body').on('click','#multidel',function(){			
			self.delprizeBatch();
		});
		

	}	

	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){
            self.onloadCss(); 
			//获取参数
			var para = self.parseUrl(window.location.href);
			
			self.getcatforedit(para.types);
			

			
			if (para.id != undefined) {
				//有id，则是编辑
				$("#id").val(para.id);
				self.cmd(gHttp,{controller:'Commodity',method:'get',id:para.id},function(result2){
					if(result2.statu){
						$('#formEdit').frmFill('',result2.data);		
						if(result2.data.pic != ''){
							$('#thumbnail').attr('src',result2.data.pic);

							
						}
						$('#quantity').val(result2.data.quantity);
						$('#price').val(result2.data.price);
						$('#score').val(result2.data.score);
						$('#discount').val(result2.data.discount);
						$('#start_time').val(result2.data.start_time);
						$('#end_time').val(result2.data.end_time);
						if(result2.data.status==1){
							$('#stutesy').iCheck('check');
						}else{
							$('#stutesn').iCheck('check');
						}
						
						if(result2.data.categories_id!=null){
							
						$('#catalogue').children("option").each(function(){  
							//console.log(result2.data.id);
				               var dotemp_value = $(this).val();
				              if(dotemp_value == result2.data.categories_id){
				            	  
				            	
				                    $(this).attr("selected","selected");  
				              }  
				              
				         });
						}
						if(result2.data.limit!=null){
							$('#limit').children("option").each(function(){  
								//console.log(result2.data.id);
					               var dotemp_value = $(this).val();
					              if(dotemp_value == result2.data.limit){
					            	  
					            	
					                    $(this).attr("selected","selected");  
					              }  
					              
					         });
						}
						
						if(result2.data.exchange==1){
							
							$('.disdiv').hide();
							$('#discount').removeAttr('datatype');
							$('#discount').removeAttr('nullmsg');
						}
						
						if(result2.data.exchange!=null){
							$('#exchange').children("option").each(function(){  
					               var dotemp_value = $(this).val();
					              if(dotemp_value == result2.data.exchange){
					            	 //console.log(retdts.data.doctor_id);
					                    $(this).attr("selected","selected");  
					              }  
					              
					         });
							}
						
					    var ue = UE.getEditor('editor');
	    				ue.ready(function() {
	    				ue.setContent(result2.data.descript);
	    				});
						

						
												
						self.cmd(gHttp,{controller:'Commodity',method:'get_commodity_link',id:para.id},function(result3){
							if(result3.stute){								
								jQuery('#qrcode').qrcode({
									render	: "image",
									width   : 100,
									height  : 100,
									size    : 100,
									text    : result3.data[0],
								});
							}
						});	
					}else{
						layer.alert(result2.msg);
					}
				});
				
				
			}else{				
				$('#qrcodepic').hide();
				$('.disdiv').hide();
				$('#discount').removeAttr('datatype');
				$('#discount').removeAttr('nullmsg');
				$('body').on('blur','#discount',function(){
					var price=parseInt($('#price').val());
					var discount=parseInt($('#discount').val());				
					if(price<=discount){
						layer.alert(
							   '折扣金额不能大于售价',
							   function(index){
								   $('#discount').focus();
								   layer.close(index);
							});
					}					
				});	
			}
			
			$('body').on('click','#catamaner',function(){
				var types=$('#types').val();
				layer.open({
					type: 2,
					area: ['640px', '450px'],
					fix: false, //不固定
					maxmin: true,
					shade:0.4,
					title: '目录管理',
					content: '../../activities/pointsmall/catelogue.html?types='+types,
					success:function(layero,index){},
					end:function(){					
						self.getcatforedit(types);
					}
		
				 });
					
			});
			
			//保存
			$('#save').click(function(){
				var theurl=$('#thumbnail').attr('src');
				$('#pic').val(theurl);
				self.save();
			});
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			
		});
	}
	
	this.getcatforedit=function(types){
		self.cmd(gHttp,{controller:'Commodity',method:'get_cat',type:types},function(result1){
			if(result1.statu){
				if(result1.data!=null){
					var html='<option value="">请选择</option>';
					$.each(result1.data,function(i,v){
					html+='<option value="'+v.id+'">'+v.name+'</option>';	
					});
					$('#catalogue').html(html);
					
				}
			}
		});
	}
	
    //按钮
	//单个删除
	this.del = function(obj, id) {
		self.openDel(obj,{controller:'Draw',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function(obj) {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			self.openDel(obj,{controller:'Draw',method:'del',id:ids});
		}
	}

	//动态编辑
	this.edit = function(id,types){
		if(types==1){
			self.open_newindows('编辑医疗服务类商品','activities/pointsmall/c-medicalservice.html?id=' + id+'&types='+types,'840','500');
		}else if(types==2){
			self.open_newindows('编辑医院自行购买的实体商品','activities/pointsmall/c-selfbuy.html?id='+ id+'&types='+types,'840','500');
		}else{
			self.open_newindows('编辑第三方电商提供的商品','activities/pointsmall/c-electronicmall.html?id=' + id+'&types='+types,'900','700');
		}
	}
	
	//详细页面
	this.detail = function(id,type){
		
		self.open_newindows('查看商品详细信息','activities/pointsmall/commodity-detail.html?id=' + id,'600','550');
	}
	
	this.getcatalogue=function(){
		

		var paras = self.parseUrl(window.location.href);
		$('#types').val(paras.types);
				var t=$("#commotidycat").DataTable({				
					bStateSave:false,
					serverSide: false,
					processing: true,
					ajax:{
						'url':'/controller/?controller=Commodity&method=get_cat',
						//'dataSrc': 'data',
						'type':'POST',
						'data': {												
							'types':paras.types,
								
						},
						'dataType':'json',
						'dataSrc': function(json){

							return json.data;
							
						}			
					},
					
					order: [[ 1, "desc" ]],
					columns: [
					            {
					            	data : 'id',
					            	render : function (id, type, row) {
					            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
					            	},
					            	name: 'xuanze',
					            	orderable:false
					            },
	                            { data: 'id',name:'id' },
					            { data: 'name',name:'name' },
					            { data: 'descript',name:'descript'},

					        ]

				
				});
				
				$('body').on('click','#trushmut',function(){
					var data = chooseall('#commotidycat');
					var ids = [];
					//console.log(data);
					if(data.length <= 0){
						layer.msg('请选择需要删除的选项!', function(){					
						}); 
					}else{
						
						layer.confirm('真的要删除么？', {icon: 3, title:'提示'}, function(index){
						  
							$.each(data,function(i,obj){
								ids[i] = obj.value;
							});	
						    layer.close(index);
						



							self.cmd(gHttp,{controller:'Commodity',method:'dele_cat',id:ids},function(ret){
								if(ret.statu){
									
									layer.msg('删除成功!', function(){					
									}); 
									troad('#commotidycat');
									$('.firstone').attr('checked', false);

								}else{
									
									layer.msg(ret.msg, function(){					
									}); 
									
								}
							});
						});
						
					}
					return false; 
					
					
				});
				
//				$('body').on('click','#save',function(){
//					alert('pppp');
//				});
				
				$("#form-member-add").Validform({
					btnSubmit:"#save", 				    
					tiptype:1, 
					label:".label",
					showAllError:false,
					url:'/controller/?controller=Commodity&method=add_cat',
					postonce:true,
					ajaxPost:true,
					datatype:{
						"*6-20": /^[^\s]{6,20}$/,
						"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
						"username":function(gets,obj,curform,regxp){
							//参数gets是获取到的表单元素值，obj为当前表单元素，curform为当前验证的表单，regxp为内置的一些正则表达式的引用;
							var reg1=/^[\w\.]{4,16}$/,
								reg2=/^[\u4E00-\u9FA5\uf900-\ufa2d]{2,8}$/;
				 
							if(reg1.test(gets)){return true;}
							if(reg2.test(gets)){return true;}
							return false;
				 
							//注意return可以返回true 或 false 或 字符串文字，true表示验证通过，返回字符串表示验证失败，字符串作为错误提示显示，返回false则用errmsg或默认的错误提示;
						},

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
						
						//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
						//这里明确return false的话表单将不会提交;	
					},
					callback:function(data){
						if(data.statu){
							$('#Validform_msg').hide();
							$('#catlist').trigger("click");
							troad('#commotidycat');
							$('#name').val('');
							$('#descript').val('');
							var types=$('#types').val();
							// var iframeWin = window[layero.find('iframe')[0]['name']];
							//window.parent.getcatforedit(types);
							// iframeWin.gCommodity.getcatforedit(types);
							window.parent.getcatforedit(types);
							
						}else{
							$('#Validform_msg').hide();
							layer.msg(data.msg);	
						}
					}
				});
				
				
				
				
				

				
				
				
				

	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();		
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Draw',method:'add'};
		} else {
			post = {controller:'Draw',method:'edit',id:id};
		}
		$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				if(id == ''){
					$('#id').val(result1.data.id);
				}
				parent.Drawlist.fillDataTable();
				parent.layer.msg('操作成功!',{icon:1});
				$("#setprize").trigger("click");
				$("#save").unbind()
				$('#save').attr('id','update');
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
			return false;
		});
		
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
				parent.layer.setTop(layero);
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
	
	this.delprizeBatch = function(obj) {
		var obj=$("#dataTable").dataTable();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var ids = $("#dataTable").getSelectedAll();
			self.openDel(obj,{controller:'Draw',method:'delprize',id:ids});
		}
	}
	
	this.delprize=function(id){			
		layer.confirm('确认要删除吗？', {
		  icon: 3, title:'提醒',	
		  btn: ['确定', '取消']
		}, function(index, layero){	
			self.cmd(gHttp,{controller:'Draw',method:'delprize',id:id},function(ret){
				if (ret.statu) {
					layer.msg('删除成功',{icon:1});
						self.ininprize();
					layer.close(index);
				} else {
					layer.msg('删除失败',{icon:2});
				}
			});
			  
		}, function(index){
			  layer.close(index);
		});	
		
	}
	
}