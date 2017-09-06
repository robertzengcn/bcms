/**
 * 积分规则
 * */

var oTable = null;
function Scorerule() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initList()
	
	/**
	 * 初始化列表
	 * */
	this.initList = function() {
		$(function(){
			//table加载数据
			self.fillDataTable();

			$('body').on('click','#addrule',function(){
				self.openEditWID('新增积分规则','../../activities/pointsmall/rule-add.html','700','400');
			});
			
			$('body').on('click','.edit',function(){
				var id=$(this).attr("dateid");
				self.openEditWID('修改积分规则','../../activities/pointsmall/rule-add.html?id='+id,'700','400');
			});
			
		});
	}
//加载数据表
	this.fillDataTable = function() {
		$("#dataTable").grid({
			para:{controller:'CommodityRule',method:'query'},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]},{sClass:'text-c',aTargets:[7]}
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
			            { data: 'descript'},
			            { data: 'status',
			            	render:function(id, type, row){
			            		if(row.status==0){
			            			return '<span class="label label-default radius">已关闭</span>';
			            		}else{
			            			return '<span class="badge badge-success radius">已开启</span>';
			            		}
			            	}
			            },
			            { data: 'score' },
			            { data: 'limit',
							render:function(id, type, row){
			            		if(row.limit==0){
			            			return '<span class="label label-default radius">无</span>';
			            		}else{
			            			return row.limit;									
								}
			            	}
						},
			            { data: 'id',
						  orderable: false,
						  render : function(id, type, row){
							  var str = '';
				              str += '<a style="text-decoration:none" class="ml-5 edit" dateid="'+id+'" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>&nbsp;&nbsp;';
							  if(row['status']==0){
								 str += '<a style="text-decoration:none" " onClick="scorerule.onOffRule('+row.id+',1);" href="javascript:;" title="开启"><i class="Hui-iconfont">&#xe601;</i></a>';
								}else{
								 str += '<a style="text-decoration:none" " onClick="scorerule.onOffRule('+row.id+',0);" href="javascript:;" title="关闭"><i class="Hui-iconfont">&#xe631;</i></a>';									
								}
					    	  return str;
						  }
						}
			        ]
		});
	}
	
	/*
	 * 添加新的医疗服务
	 * 
	 * */
	this.addrule=function(){
		var para = self.parseUrl(window.location.href);	
		var url='';		
		//加载规则类型
		//self.addRuleType();
		if(para.id==undefined){
		  url={controller:'CommodityRule',method:'add'};
		}else{
			self.cmd(gHttp,{controller:'CommodityRule',method:'get',id:para.id},function(result2){
				if(result2.statu){
					$('#scoretype').val(result2.data.name);
					$('#name').val(result2.data.name);
					$('#id').val(result2.data.id);
					$('#descript').html(result2.data.descript);
					$('#score').val(result2.data.score);
					$('#limit').val(result2.data.limit);
					$('#lastfield').append('<input type="hidden" id="id" name="id" value="'+result2.data.id+'">');
						if(result2.data.status == 1){
							$('#stutesy').attr('checked', true);						
						}else{
							$('#stutesn').attr('checked', true);						
						}					
				}
			});			
			url={controller:'CommodityRule',method:'edit'};
				
		}
		$('#save').click(function(){
			self.saveRule(url);
		});		
	}
	
	
	
	/***
	*保存积分规则
	*/
	this.saveRule=function(url){
		$('#scoreruleadd').checkAndSubmit('save', url,function(result){
			if(result.statu){
				parent.layer.msg('保存成功',{icon:1});	
				window.parent.scorerule.fillDataTable();
				var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
				parent.layer.close(index);
			}else{
				parent.layer.alert(result.msg,{icon:2});
			}
		});
		$('#scoreruleadd').submit();		
	}
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){
            self.onloadCss();    	
//			self.getImgSize('commoditysize');
			
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
					//console.log(discount);
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
			success:function(layero,index){
				
				
				
			},
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
	//开启
	this.onOffRule = function(id,status) {
		self.cmd(gHttp,{controller:'CommodityRule',method:'onOffRule',id:id,status:status},function(result1){
			if(result1.statu){
				if(result1.data==1){
					if(status==0){
						layer.msg('关闭成功!', {icon:1});
					}else{
						layer.msg('开启成功!', {icon:1});
					}
					troad('#dataTable');
				}else{
					layer.msg('已经开启!', {icon:1}); 					
				}
			}
		});
	}	
    //按钮
	//单个删除
	this.del = function(obj, id) {
		self.openDel(obj,{controller:'Commodity',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function(obj) {
		var ids = $("#dataTable").getSelectedAll();		
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			self.openDel(obj,{controller:'CommodityRule',method:'del',id:ids});
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

	
	this.getcatalogue=function(){
		

		var paras = self.parseUrl(window.location.href);
		$('#types').val(paras.types);

//		self.cmd(gHttp,{controller:'Commodity',method:'get_cat',types:para.types},function(result3){
//			if(result3.statu){
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
				
				var url={controller:'Commodity',method:'add_cat'};
				$('#CommodityRuleadd').checkAndSubmit('save', url,function(result1){
					if(result1.statu){				
						$('#Validform_msg').hide();
							$('#catlist').trigger("click");
							troad('#commotidycat');
							$('#name').val('');
							$('#descript').val('');
							var types=$('#types').val();
							window.parent.getcatforedit(types);
					}else{
						parent.layer.alert(result1.msg,{icon:2});
					}
				});
				$('#formEdit').submit();
	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Commodity',method:'add'};
			$('#formEdit').checkAndSubmit('save',post,function(result1){
				if(result1.statu){				
					var url=parent.location.href;
					parent.location.replace(url);
					parent.layer.msg('操作成功!');	
					layer_close();
					
					
				}else{
					parent.layer.alert(result1.msg,{icon:2});
				}
				return false;
			});
		} else {
			post = {controller:'Commodity',method:'edit',id:id};
			
			$('#formEdit').checkAndSubmit('save',post,function(result1){
				if(result1.statu){				
					var url=parent.location.href;
					parent.location.reload;
					 
					
					//flashtable=parent.document.getElementById("dataTable");
					//console.log(flashtable);
					//flashtable.api().ajax.reload();
					//troad('#dataTable');
					//parent.location.replace(url);
					$('#treeDemo_20_span', window.parent.document).trigger('click');
					parent.layer.msg('操作成功!');	
					//parent.layer.alert('操作成功!',{icon: 1});	
					layer_close();
					
					//window.top.frames[0].document.location.reload;
					
					
				}else{
					parent.layer.alert(result1.msg,{icon:2});
				}
				return false;
			});
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
	
	/**
	 * 详细页
	 * */
	this.initDetail = function() {
		$(function(){
            self.onloadCss();    	
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				$("#id").val(para.id);				
				self.cmd(gHttp,{controller:'Commodity',method:'get',id:para.id},function(result1){
					if(result1.statu){
						if(result1.data.pic != ''){
							$('#pic').attr('src',result1.data.src);
						}
//						if(result1.data.flag != ''){
//							$('#flag').attr('src',result1.data.flag);
//						}
						self.cmd(gHttp,{controller:'Commodity',method:'get_commodity_link',id:para.id},function(result2){
							if(result2.stute){
						    jQuery('#qrcode').qrcode({
				    	    render	: "image",
				    		width   : 100,
				    		height  : 100,
				    		size    : 100,
				    		text    : result2.data[0],
				    });
							
				    //var src=$('#qrcode img').src;
				    //$('#flag').attr('value',src);
							}
						});
						
						if(result1.data.subject != ''){
							$('#subject').append(result1.data.subject);
						}
						
							if(result1.data.status==1){
								$('#shelf').html("已上架");
							}else{
								$('#shelf').html("未上架");
							}
						
						
							if(result1.data.exchange==1){
								$('#pattern').append("纯积分");
							}else if(result1.data.exchange==2){
								$('#pattern').append("积分+现金");
							}
					   
						if(result1.data.quantity != ''){
							$('#counts').append(result1.data.quantity);
						}
						if(result1.data.price !=''){
							$('#price').append(result1.data.price);
						}
						if(result1.data.score !=''){
							$('#score').append(result1.data.score);
						}
						if(result1.data.exchange==2){
							
								$('#discount').html(result1.data.discount);
							
						}else{
							$('.zhekou').hide();
						}

						if(result1.data.get !=''){
							if(result1.data.get == 1){
								$('#get').html("医院领取");
							}else{
								$('#get').html("商城配送");
							}
						}
						if(result1.data.start_time !='' & result1.data.end_time !=''){
							$('#time').html(result1.data.start_time +'至'+ result1.data.end_time);
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			}else{
				self.cmd(gHttp,{controller:'Commodity',method:'make_coupon_card'},function(result1){
					    jQuery('#qrcode').qrcode({
					    	    render	: "image",
					    		width   : 100,
					    		height  : 100,
					    		size    : 100,
					    		text    : result1,
					    });
					    var src=$('#qrcode img')[0].src;
					    $('#flag').attr('value',src);
				});
			}
			
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			
		});
	}
	
}