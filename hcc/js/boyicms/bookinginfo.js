/**
 * 疾病资讯
 * */
function Bookinginfomation() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initList()
	
	//初始化预约信息列表
	this.initBooking=function(){
		$(function(){
			//加载预约科室列表
			self.getderpartmentlist('department_id');
			//加载预约患者信息
			self.getbookinginfo();	

			//查询
			$("#qry").click(function(){				
				self.getbookinginfo();	
			});	
			
			
		});	
		
	}//initBooking over
	
	this.getbookinginfo=function(){
		$("#bookinglisttab").grid({
			para:{controller:'ResBookingInfo',method:'getAllbookinginfos'},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[6]},{sClass:'text-c',aTargets:[7]},{sClass:'text-c',aTargets:[8]},{sClass:'text-c',aTargets:[9]},{sClass:'text-c',aTargets:[10]}
				],
			field : [
			            {data : 'id',render : function (id, type, row) {
						     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
						    },							
							orderable:false
						},
						{ data: 'id'},
						{ data: 'username'},
						{ data: 'telephone'},
						{ data: 'id_card'},
						{ data: 'department_name'},
						{ data: 'doctor_name'},
						{ data: 'date',orderable:false},
						{ data: 'times'},
						{ data: 'statu',render:function(value){return value=='已到诊'?'<span class="label label-success radius">已到诊</span>':'<span class="label label-default radius">未到诊</span>';}},
						{									  
						  render : function(data, type, row){
							  var str = '';
							   str += '<a title="删除" href="javascript:;" onclick="gBookinglist.delBookInfo('+row.id+');return false;"   style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>';			  
							  return str;
						  },
						  orderable:false
						 }
			        ]
				
		});	
		
	}//getbookinginfo over
	
	//单个删除
	this.delBookInfo = function(id) {
		var obj=$("#bookinglisttab").dataTable();
		self.openDel(obj,{controller:'ResBookingInfo',method:'del',id:id});		
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#bookinglisttab").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#bookinglisttab").dataTable();
			self.openDel(obj,{controller:'ResBookingInfo',method:'del',id:ids});
		}		
	}
	
	/**
	 * 医生名称联想搜索
	 * */
	this.findUserInfoByName = function(obj) {
		var request_val=obj.value;			
		var reg=new RegExp("^[\u4e00-\u9fa5]{1,}|[a-zA-Z]{1,}$"); 
		var result=reg.test(request_val);
		if(!result){				
				layer.msg('请输入正确的名称',{icon:2});
		}else{				
				var url='';
				var str='';				
				url = {controller:'ResDoctor',method:'getDoctorsByName',doctorname:request_val};
				self.cmd(gHttp,url,function(data){
					if(data['ttl']==0){
						str='没有该医生相关数据！';						
					}
					else{						
						str+='<ul class="doctorlist">';
						$.each(data['rows'],function(k,v){							
							str+='<li onclick="gBookinglist.putintoplace('+v.id+',\''+v.name+'\')">'+v.name+'</li>';
						});
						str+='</ul>';
					}	
						
				});
				layer.tips(str, $(obj), {
					tips: [1,'#78BA32'],
					area:['120px','auto'],	
					time:12000
				});	
				}
	}
	
	//将选中的医生姓名写入搜索框
	this.putintoplace=function(id,name){
		$('#doctorname').val(name);
		$('#docID').val(id);
		
	}
	
	//获取科室列表
	this.getderpartmentlist=function(pid){		
		self.cmd(gHttp,{controller:'ResDepartment',method:'getDepartments'},function(ret){			
			var html = '';
			if(ret.statu){				
				departments = ret.data;				
				html = '<option value="">选择科室</option>';
				if(departments!=''&&departments!=null){
					$.each(ret.data,function(i,obj){
						html += '<option value="'+obj.id+'">'+obj.name+'</option>';
					});
				}								
				$('#'+pid).html(html);				
			}else{
				layer.msg(ret.msg,{icon:2});
			}
			return false;
		});		
	}
	
	//导出数据
	this.exportdate=function(type){
		var post='';
		if(type=='booking'){
			post={controller:'ResBookingInfo',method:'exportdate'};
		}else if(type=='doctor'){
			post={controller:'ResDoctor',method:'exportdate'};			
		}		
		self.cmd(gHttp,post,function(ret){
			if(ret.stutes){
				var html='';
				html+='<div class="row cl text-c pd-10">数据己准备完毕...</div><div class="row cl"><div class="col-12 text-c"><a href="'+ret.url+'" class="btn btn-success radius"><i class="Hui-iconfont">&#xe641;</i> 开始下载</a></div></div>';
				layer.open({
					type:1,							
					content: html,
					title:'下载数据',
					area: ['252px', '120px'],
				});	
			}else{					
				layer.alert('导出数据失败!请重试',{icon:2}); 
			}
		});			
	}
	
}
