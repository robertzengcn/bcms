function Dedecopy(){
	BaseFunc.call(this);
	var self = this;
	
	this.dede_connect = function(para){
		var self = this;
		self.cmd(gHttp,{controller:'Zhimeng',method:'haveMsg'},function(ret){
				if(ret.statu){
					$('#IPAdress').val(ret.data.url);
					$('#name').val(ret.data.name);
					$('#username').val(ret.data.user);
					$('#password').val(ret.data.pwd);
					$('#isremmenber').attr('checked','checked');
				}else{
					$('#username').val('');
					$('#password').val('');
				}
			});
			
				$(".form").Validform({
				tiptype: 2,
				ajaxPost: true,
				url: '/controller/index.php?controller=Zhimeng&method=addDatabase',
				btnSubmit: '#savedata',
				tipSweep:false,
				//showAllError:false,
				beforeSubmit:function(curform){
					var url=$('#IPAdress').val();
					var username=$('#username').val();
					var password=$('#password').val();
					var valid=true;
					self.cmd(gHttp,{controller:'Zhimeng',method:'checkconnect',url:url,user:username,pwd:password}, function(ret){
						if(ret.stute==false){
							
							layer.msg('数据库连接测试失败');
							valid=false;
						}
					});
					//console.log(valid);
					return valid;
					
					
		
	              },
				callback: function(data){
					//alert(data);
					if (data.statu) {
						$("#Validform_msg").hide();
						layer.msg('设置成功');
						$("#startcopy").trigger("click");
						//self.dataList();

						
						
					}else {
						$("#Validform_msg").hide();
						layer.msg(data.msg, function(){
						});
					}
					
				}
			});
			
			$('body').on('click','#startcopy',function(){
				self.dataList();
			});

			
			
			
			
		
	}
	this.dataList=function(para){
		self.cmd(gHttp,{controller:'Zhimeng',method:'getTypenames'}, function(ret){
				var str = '';
				$.each(ret,function(index,obj){
					str += '<option value="'+obj.typename+'">'+obj.typename+'</option>';
				});
				$('#typename').append(str);
		});
		$('#checkall').attr("checked", false);
				
		var resertable=$("#dedetable").DataTable({						
			bStateSave:false,
			serverSide: true,
			processing: true,
			searching: true,
			//paging: false,
			searching: false,
			ajax:{
				'url':'/controller/?controller=Zhimeng&method=getZmDatas',				
				'type':'POST',				
				'data': {
					'page':function(){
						var info=$("#dedetable").DataTable().page.info();
						return info.page+1;
					},
					'size':function(){
						var info=$("#dedetable").DataTable().page.info();
						return info.length;
					},

					
				},
				'dataType':'json',
				'dataSrc': function(json){				
					return json.data;					
				}		
			},

			order: [[ 1, "desc" ]],		
			aoColumnDefs : [
				{sClass:'text-l',aTargets:[2]},{sClass:'text-l',aTargets:[3]}
							],
			columns: [
					{
						data : 'id',
						render : function (id, type, row) {
							return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
						},
						name: 'xuanze',
						orderable:false
					},
					{ data: 'id',
						orderable:false	
						},
					{ data: 'title',render:function(value){return value.substr(0,15)+'...';},name:'title',orderable:false},
					{ data: 'description',render:function(value){return value.substr(0,60)+'...';},name:'description',orderable:false},
				]


	
	});
					//resertable.destroy();

			
			$('#qry').on('click',function(){
				if($('#typename').val()==0){
					layer.alert('请先选择原站栏目');
					return false;
				}
				else{
					var index=layer.msg('加载中', {icon: 16});
					var count=$('#select_num').val();
					var keyword=$('#keywords').val();
					var typename=$('#typename').val();	
					self.cmd(gHttp,{controller:'Zhimeng',method:'getData',count:count,keyword:keyword,typename:typename}, function(ret){
						if(ret.statu){
							layer.msg('加载成功！',{icon:1});
							layer.close(index);
							troad('#dedetable');
						}
					});					
				}	
			});	
			
			$('body').on('click','#startconntect',function(){
				if (typeof resertable != "undefined") {
					
					resertable.destroy();
					
				}
				
			});
			
			
			
				$('body').on('click','#savedata',function(){
				
				var data = chooseall('#dedetable');
				

				if(data == ''){
					layer.msg('请选择要原站要拷贝的文章！',{icon:2});
					return false;
				}
				var ids = [];
				$.each(data,function(i,obj){
						ids[i] = obj.value;
					});				
				
					layer.open({
						type:1,	
						title:'选择迁移数据的着陆栏目',
					    content: '<form id="form1" class="form form-horizontal"><div class="row cl"><label class="form-label col-2">移动到：</label><div class="formControls col-6" id="thecontent"></div></div></form>',
					    area: ['270px', '140px'],
					    btn: ['确定'],
					    yes: function (index,layero) {

					    	var diseaseid=$('#disease_id option:selected').val();
							
					    	self.cmd(gHttp,{controller:'Zhimeng',method:'saveDataLocal',data:ids,disease_id:diseaseid},function(retts){
					    		if(retts.stute){
									layer.msg('数据己拷贝至本站，请在疾病资讯中查看',{icon:1});
									troad('#dedetable');
									
									layer.close(index);

					    		}else{
                                   layer.msg(retts.msg);					    			
					    		}
					    	});
					    },
					    success: function(layero, index){
						  	self.onloadCss();
						  	self.cmd(gHttp,{controller:'Disease',method:'query'},function(ret){
					var str1 = '<select id="disease_id" name="disease_id"><option value="">请选择...</option>';
					var str2 = '';
					$.each(ret.rows,function(index,obj){
						str1 += '<option value="'+obj.id+'">'+obj.name+'</option>';
						str2 += '<input type="hidden" name="department['+obj.id+']" value="'+obj.department_id+'" />';
					});
					str1 += '</select>';
					$('#thecontent').html(str1+str2);
					  	
                     });
                          }
					});
				
			});
			
			
			
			
			
	}
	

	
	
	
}
