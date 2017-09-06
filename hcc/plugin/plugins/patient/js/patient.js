/**
 * 患者管理
 * */
function Patient() {
	BaseFunc.call(this);
	var self = this;
	
	// {{{ function init()
	
	/**
	 * 初始化页面
	 * */
	this.init = function() {
		$(function(){
			self.checkPwd();
			
			//填充疾病信息
			self.fillDiseases();
			
			//填充前台接待信息
			self.fillReceptionist();

			//填充医生信息
			self.fillDoctors();
			
			self.fillDiagnoseList();
			
			$("#qry").click(function(){
				self.fillDiagnoseList();
			});
			
			//统计校验功能说明
			$('.showmsg').mouseover(function(){
				var str=$(this).attr('info');
				layer.tips(str, $(this), {
					tips: [3,'#78BA32'],
					area:['400px','auto'],	
					time:6000
				});
				
			});
			
		});
	}
	
	// }}}
	// {{{ function fillDiseases()
	
	/**
	 * 填充疾病信息
	 * */
	this.fillDiseases = function(){
		self.cmd(gHttp,{controller:'Patient',method:'getDiseases'},function(res){
			if(res.statu){
				var diseases = res.data;
				var diseaseHtml = '<option value="" selected>病症</option>';
				if ( diseases!= null) {
					$.each(diseases,function(i,v) {
						diseaseHtml += '<option value="' + v.id + '">' + v.disease_name + '</option>';
					});
				}
				$("#disease_type").html(diseaseHtml);
				return true;
			}else{
				return false;
			}
		});
	}
	
	// }}}
	// {{{ function fillReceptionist()
	
	/**
	 *  填充前台接待信息
	 **/
	this.fillReceptionist = function() {
		self.cmd(gHttp,{controller:'Patient',method:'getReceptionist'},function(res){
			if(res.statu){
				var receptionist = res.data;
				var recHtml = '<option value="" selected>前台接待</option>';
				if ( receptionist!= null) {
					$.each(receptionist,function(i,v) {
						recHtml += '<option value="' + v.id + '">' + v.user_name + '</option>';
					});
				}
				$("#receptionist_id").html(recHtml);
				return true;
			}else{
				return false;
			}
		});
	}
	
	//}}}
	// {{{ function fillDoctors()
	
	/**
	 * 填充医生信息
	 * */
	this.fillDoctors = function(){
		self.cmd(gHttp,{controller:'Patient',method:'getDoctors'},function(res){
			if(res.statu){
				var doctors = res.data;
				var doctorHtml = '<option value="" selected>主治医生 </option>';
				if ( doctors!= null) {
					$.each(doctors,function(i,v) {
						doctorHtml += '<option value="' + v.id + '">' + v.doctor_name + '</option>';
					});
				}
				$("#doctor_id").html(doctorHtml);
				return true;
			}else{
				return false;
			}
		});
	}
	
	// }}}
	// {{{ function checkPwd()
	
	/**
	 * 检查密码
	 * */
	this.checkPwd = function() {
		//这里要先弹出一个框来输入管理密码，默认是admin的登录密码
		var flag = false;
		var content = '';
		content += '<div class="row cl">';
		content += '<label class="form-label col-2"><span class="c-red">*</span>密码：</label>';
		content += '<div class="formControls col-6">';
		content += '<input type="password" class="input-text" id="password" name="password"/>';
		content += '</div>';
		content += '<label style="color:red;padding-left:14px;" id="error"></label>';
		content += '</div>';
		layer.open({
			closeBtn: 0,
			content:content,
			area:['500px'],
			shade:[1,'#b3b3b3'],
			success:function(){
				$("#password").focus();
			},
			yes:function(index) {
				var password = $("#password").val();
				if (password == '') {
					$("#error").html("密码不能为空");
					return false;
				}
				self.cmd(gHttp,{controller:'Patient',method:'loginPatient',password:password},function(ret){
					if(ret.statu){
						flag = true;
					}else{
						$("#error").html(ret.msg);
						flag = false;
					}
				});
				
				if (!flag) {
					return false;
				}
				
				layer.close(index);
				//初始化数据列表
				self.fillDiagnoseList();
			}
		});
	}
	
	// }}}
	// {{{ function initPwd()
	
	/**
	 * 初始化修改管理密码
	 * */
	this.initPwd = function() {
		$(function(){
			self.cmd(gHttp,{controller : 'Login',method : 'isLogin'}, function(ret) {
	            if (!ret.statu || ret.data.group != 1) {
	                location.replace('login.html');
	            } else {
	                $('#username').html(ret.data.name);
	            }
			});
			
			$('#old_password').focus();
			
			//修改密码
			$("#save").click(function(){
				self.modifyPwd();
			});
		});
	}
	
	// }}}
	// {{{ function modifyPwd()
	
	/**
	 * 修改管理密码
	 * */
	this.modifyPwd = function(){
		var post = {controller:'Patient',method:'modifyPatientLoginPwd'};
		$('#formEdit').checkAndSubmit('save', post,function(result1){
			if(result1.statu){
				parent.layer.msg('修改成功!',{icon: 1});	
				layer_close();
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	// }}}
	// {{{ function fillDiagnoseList()
	
	/**
	 * 填充患者列表
	 * */
	this.fillDiagnoseList = function() {
		$("#dataTable").grid({
			para : {controller:'Patient',method:'getListPatientCase',is_first:'1'},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]},{sClass:'text-c',aTargets:[7]},{sClass:'text-c',aTargets:[8]},{sClass:'text-c',aTargets:[9]},{sClass:'text-c',aTargets:[10]},{sClass:'text-c',aTargets:[11]}
							],
			field : [
			            {
			            	data : 'case_id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
                        { data: 'visit_time_str' },
			            { data: 'username',},
			            { data: 'telphone'},
			            { data: 'case_number',render:function(case_number, type, row){
			            	//生成电子识别码图片
			    			var case_number_img = './barcode/code.php?codebar=BCGcode39&text=' + case_number;
			    			return '<img src="'+case_number_img+'"/>';
			            }},
			            { data: 'money',render:function(v){var str='';if(v.indexOf('-')!=-1){str='<span class="label label-danger radius">欠费：'+Math.abs(v)+'</span>'}else if(v==0){str='<span class="label label-success radius">结清</span>';}else{str='<span class="label label-primary radius">盈余：'+Math.abs(v)+'</span>';} return str;}},
			            { data: 'receptionist_user'},
			            { data: 'doctor_name'},
			            { data: 'disease_name'},
			            { data: 'return_time_str',render:function(v){var str=(v=='')?'<span class="label label-default radius">未预约</span>':v; return str;}},
			            { data: 'visit_num',render:function(v){var str=(v==0)?'<span class="label label-default radius">无回访记录</span>':v; return str;}},
			            {
						  data : 'case_id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" onclick="gPatient.openAdd(\'患者新增就诊记录\',\'addPatient.html?patient_id='+row.patient_id+'\',\'900\',\'420\');" href="javascript:;"  title="患者新增就诊记录"><i class="Hui-iconfont">&#xe604;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gPatient.openAdd(\'查看详细就诊记录\',\'detail-record.html?patient_id='+row.patient_id+'&case_id='+id+'&detail_id='+row.detail_id+'\',\'900\',\'420\');" href="javascript:;" title="查看详细就诊记录"><i class="Hui-iconfont">&#xe695;</i></a>';
					    	  return str;
						  }
						 }
			        ]
		});
	}
	
	// }}}
	// {{{ function addPatient()
	
	/**
	 * 新增患者
	 * */
	this.addPatient = function() {
		//新增患者，完全新增
		var url = 'addPatient.html';
		self.openAdd('新增患者', url, '870', '420');
	}
	
	// }}}
	// {{{ function delteBatch()
	
	/**
	 * 批量删除患者
	 * */
	this.deleteBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj = $("#dataTable").dataTable();
		self.openDel(obj,{controller:'Patient',method:'deletePatient',id:ids});
	}
	
	// }}}
	// {{{ function initStatDetail()
	
	/**
	 * 初始化统计详情
	 * */
	this.initStatDetail = function() {
		$(function(){
			//获取参数
			var para = self.parseUrl(window.location.href);
			var id = para.id;
			var type = para.type;
			var start = para.start;
			var end = para.end;
			switch(type) {
			    case '1'://就诊人数详情
			    	if (para.title == undefined) {
			    		self.statByPeopleDetail(id,start,end,para.ids);
			    	} else {
			    		self.statByPeopleType(id,start,end,para.title,para.showType);
			    	}
			        break;
			    case '3'://前台接诊详情
			    	self.statByReceptionistDetail(id,start,end);
				    break;
			    case '5': //医生接诊详情
			    	self.statByDoctorDetail(id,start,end);
			    	break;
				default:
					break;
			}
		});
	}
	
	// }}}
	// {{{ function statByPeopleType()
	
	/**
	 * 就诊人数详细统计图
	 * */
	this.statByPeopleType = function(type_id,start,end,title,showType){
		var header = '<tr class="text-c">';
		header += '<th width="140">病症</th>';								
		header += '<th width="100">0-10岁</th>';
		header += '<th width="100">11-20岁</th>';	
		header += '<th width="100">21-30岁</th>';
		header += '<th width="100">31-40岁</th>';
		header += '<th width="100">41-50岁</th>';
		header += '<th width="100">51-60岁</th>';
		header += '<th width="100">61-70岁</th>';
		header += '<th width="100">71-80岁</th>';
		header += '<th width="110">81岁以上</th>';
		header += '</tr>';
		$('#header').html(header);
		
		var url = {controller:'Patient',method:'getStatData',type_id:type_id,type:'1',start:start,end:end};
       

	   self.cmd(gHttp,url,function(ret){
        	var ttl = ret.ttl;
        	var data = ret.rows;
        	
        	$('#list').grid({
        		ttl:ttl,
				showPage : false,
				tableInfo : false,
				order : false,
				filter : false,
    			data : data,				
    			field : [
    				{data:'disease_name'},
    				{data:'10'},
    				{data:'20'},
    				{data:'30'},
    				{data:'40'},
    				{data:'50'},
    				{data:'60'},
    				{data:'70'},
    				{data:'80'},
    				{data:'90'}
    			]
    		});
        	//拼接统计标题
			var title_str=start+'至'+end+'总就诊人数科室分布统计';
            //格式化数据
    		var statData = self.formatStatData(data,'1','detail',showType);
    		//显示统计图
    		self.showStatImg(statData, 'statImg', '按诊量（人次）', title_str,'','bar');
			
        });
	}
	
	// }}}
	// {{{ function statByReceptionistDetail()
	
	/**
	 * 前台接待详情
	 * */
	
	this.statByReceptionistDetail = function(receptionist_id, start, end){
		var header = '<tr class="text-c">';
		header += '<th width="140">姓名</th>';								
		header += '<th width="80">就诊日期</th>';
		header += '<th width="80">成交</th>';	
		header += '<th width="80">原因</th>';
		header += '<th width="80">性别</th>';
		header += '<th width="80">年龄</th>';
		header += '</tr>';
		$('#header').html(header);		
        var url = {controller:'Patient',method:'getStatDetail',receptionist_id:receptionist_id,type:'3',start:start,end:end};
        $('#list').grid({
			para : url,
			field : [
				{data:'username'},
				{data:'visit_time'},
				{data:'is_finished',render:function(v){var str=(v==1)?'<span class="label label-success radius">是</span>':'<span class="label label-default radius">否</span>';return str;}},
				{data:'reason',render:function(value){return value.substr(0,16)+'...';}},
				{data:'gender',render:function(v){var str=(v==1)?'<span class="label label-success radius">女</span>':'<span class="label label-secondary radius">男</span>'; return str;}},
				{data:'age'}
			]
		});
	}
	
	// }}}
	// {{{ function statByDoctorDetail()
	
	/**
	 * 医生接待详情
	 * */
	this.statByDoctorDetail = function(doctor_id, start, end){
		var header = '<tr class="text-c">';
		header += '<th width="200">初诊日期</th>';
		header += '<th width="140">姓名</th>';								
		header += '<th width="80">性别</th>';
		header += '<th width="80">年龄</th>';
		header += '<th width="80">就诊次数</th>';
		header += '</tr>';
		$('#header').html(header);
		
		var url = {controller:'Patient',method:'getStatDetail',doctor_id:doctor_id,type:'5',start:start,end:end};
        $('#list').grid({
			para : url,
			field : [
				{data:'visit_time'},
				{data:'username'},
				{data:'gender',render:function(v){var str=(v==1)?'<span class="label label-success radius">女</span>':'<span class="label label-secondary radius">男</span>';return str;}},
				{data:'age'},
				{data:'visit_num'}
				
			]
		});
	}
	
	// }}}
	// {{{ function statByPeopleDetail()
	
	/**
	 * 就诊人数详情
	 * */
	this.statByPeopleDetail = function(type_id,start,end,ids){
		var header = '<tr class="text-c">';
		header += '<th width="140">姓名</th>';
		header += '<th width="120">病历号</th>';
		header += '<th width="80">性别</th>';
		header += '<th width="80">年龄</th>';
		header += '</tr>';
		$('#header').html(header);
		
		var url = {controller:'Patient',method:'getStatDetail',type_id:type_id,type:'1',start:start,end:end, ids:ids};
        $('#list').grid({
			para : url,
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]}
							],
			field : [
				{data:'username'},
				{data:'case_number'},
				{data:'gender',render:function(value){return value=='0'?'<span class="label label-secondary radius">男</span>':'<span class="label label-success  radius">女</span>';}},
				{data:'age'}
			]
		});
	}
	
	// }}}
	// {{{ function stat()
	
	/**
	 * 统计
	 * */
	this.stat = function() {
		initTimeMonth('start', 'end');
		
		self.statByPeople();
		$('#qry').click(function(){
			$("li[id^='li_stat_']").hide();
			//开始统计
			var type = $('#type').val();
			if (type == '') {
				layer.alert('请选择统计类型');
				return;
			}
			$("li[id^='li_stat_" + type + "']").show();
			$("#li_stat_" + type + " h4").addClass("selected");
			$("#li_stat_" + type + " .info").css("display","block");
			$("#li_stat_" + type + " b").text("-");
			switch (type) {
			    case '1': //就诊人数统计
			    	self.statByPeople();
				    break;
			    case '2': //周及就诊时间段统计
					self.statByWeek();
				    break;
			    case '3': //前台接诊统计
			    	self.statByReceptionist();
				    break;
			    case '4': //来源统计
			    	self.statBySource();
				    break;
			    case '5': //医生接诊统计
			    	self.statByDoctor();
				    break;
			    case '6': //科室疾病统计
			    	self.statByDepartmentAndDisease();
			    	break;
			    case '7': //财务统计
			    	self.statByFinancial();
			    	break;
			    case '8': //治疗方案
			    	self.statByExamineItems();
			    	break;
			    default:
				    break;
			}
		});
		
		$.Huifold("#Huifold1 .item h4","#Huifold1 .item .info","fast",2,"click"); /*菜单展开效果，5个参数顺序不可打乱，分别是：相应区,隐藏显示的内容,速度,类型,事件*/
	}
	
	// }}}
	// {{{ function statByPeople()
	
	/**
	 * 综合统计
	 array(
		['total_num'] =>	7
		['old'] =>	array(	
			['total_num'] =>	7	
			['female'] =>	array(	['num'] =>	5	)
			['ids'] =>	array(	[0] =>	1	[1] =>	2	)
			['male'] =>	array(	['num'] =>	2	)
		)
		['total_money'] =>	4600.00
	)
	 
	 * */
	this.statByPeople = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		var showType = $('#showType').val();
		
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'1',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;	
			var newdata=data.slice(0,2);
			$('#listAll1').grid({
				ttl : ttl,
				showPage : false,
				tableInfo : false,
				order : false,
				filter : false,
				paging:false,
				data : newdata,				
				field : [
				        {data:'title'},  
				        {data:'sex'},
				        {data:'num'},				        
				        {data:'type', render:function(value, type, rowData){
				        	var str = '';
							str += '<a title="查看详细" onClick="gPatient.openEditWID(\'详细人员列表\',\'stat-detail.html?type=1&id='+value+'&start='+start+'&end='+end+'&ids='+rowData.ids+'\',\'700\',\'460\')" href="javascript:void(0)" style="text-decoration:none;"><i class="Hui-iconfont">&#xe695;</i></a>';
							str += '<a title="人群组成统计" onClick="gPatient.openEditWID(\'人群组成统计\',\'stat-detail.html?type=1&id='+value+'&start='+start+'&end='+end+'&title='+rowData.title+'&showType='+showType+'\',\'1100\',\'460\')" class="ml-5" href="javascript:void(0)" style="text-decoration:none;"><i class="Hui-iconfont">&#xe61c;</i></a>';
							return str;
				        }}
				    ]
			});
			var str="<tr><td  colspan='4' class='text-r'>总到诊量：<span class='label label-success radius'>"+data[3]+"</span>（人次）     营收：<span class='label label-success radius'>"+data[2]+"</span>（元）     </td>";
			$('#listAll1 tbody').append(str);
			//拼接统计标题
			var title_str=start+'至'+end+'新老客户及初复诊人数统计';
			//格式化数据
			var statData = self.formatStatData(data,'1');
			//显示统计图
			self.showStatImg(statData, 'statImg1','按诊量（人次）', title_str,'','bar');
		});
		
		//按天统计人数
		self.cmd(gHttp,{controller:'Patient',method:'statByDate',action:'people',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					if (showType == 'pie') {
						var num = v['old'] + v['new'];
						statData.push({
							'name':k,
							'value':num
						});
					} else {						
						statData.push({
							'group':'老客户',
							'name':k,
							'value':v['old']
						});
						statData.push({
							'group':'新客户',
							'name':k,
							'value':v['new']
						});
						
					}
				});
				
				//拼接统计标题
				var title_str=start+'至'+end+'门诊每日接诊量统计';	
				//显示统计图
				self.showStatImg(statData, 'statImg1_2', '按诊量（人次）', title_str);
			}else{
				$("#statImg1_2").html('');
			}
		});
	}
	
	// }}}
	// {{{ function statByWeek()
	
	/**
	 * 周及就诊时间段统计
	 * */
	this.statByWeek = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		var showType = $('#showType').val();
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'2',start:start,end:end}, function(result) {
			var ttl = result.ttl;			
			var data = result.rows.reverse();
			$('#listAll2').grid({
				ttl : ttl,
				showPage : false,
				tableInfo : false,
				order : false,
				filter : false,
				data : data,
				field : [
				        {data:'title'},  
				        {data:'Monday'},
				        {data:'Tuesday'},
				        {data:'Wednesday'},
				        {data:'Thursday'},
				        {data:'Friday'},
				        {data:'Saturday'},
				        {data:'Sunday'}
				    ]
			});
			//拼接统计标题
			var title_str=start+'至'+end+'就诊人次周分布统计';	
			//格式化数据
			var statData = self.formatStatData(data,'2');
			//显示统计图
			self.showStatImg(statData, 'statImg2', '按诊量（人次）', title_str,'','bar');
		});
	}
	
	// }}}
	// {{{ function statByReceptionist()
	
	/**
	 * 前台接诊统计
	 * */
	this.statByReceptionist = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		var tdWidth=90;
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'3',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var header='<tr class="text-c"><th width="120">姓名</th>';
			var deal_str='<tr><td class="text-c">成交（人）</td>';
			var nodeal_str='<tr><td class="text-c">未成交（人）</td>';
			var control_str='<tr><td class="text-c">操作</td>';
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.user_name+'</th>';
				deal_str+='<td class="text-c">'+v.deal_num+'</td>';
				nodeal_str+='<td class="text-c">'+v.not_deal_num+'</td>';
				control_str+='<td class="text-c"><a title="查看详细情况" onClick="gPatient.openEditWID(\'前台接诊详情\',\'stat-detail.html?type=3&id='+v.receptionist_id+'&start='+start+'&end='+end+'\',\'800\',\'460\')" href="javascript:void(0)" style="text-decoration:none;"><i class="Hui-iconfont">&#xe695;</i></a></td>';
			});
			header+='</tr>';
			var tbodyer=deal_str+'</tr>'+nodeal_str+'</tr>'+control_str+'</tr>';
			$('#listAll3').find('thead').html(header);
			$('#listAll3').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info1'),tdWidth,120,$('#li_stat_3'));
			
			//拼接统计标题
			var title_str=start+'至'+end+'前台接诊量统计';	          
			//格式化数据
			var statData = self.formatStatData(data,'3');
			//显示统计图
			self.showStatImg(statData, 'statImg3', '按诊量（人次）', title_str,'','bar');
		});
		
		//按天统计
		self.cmd(gHttp,{controller:'Patient',method:'statByDate',action:'receptionist',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					if (showType == 'pie') {
						var num = 0;
						$.each(v, function(i, d){
							num += d;
						});
						statData.push({
							'name':k,
							'value':num
						});
					} else {
						$.each(v, function(i, d){
							statData.push({
								'group':i,
								'name':k,
								'value':d
							});
						});
					}
				});
				//拼接统计标题
				var title_str=start+'至'+end+'前台每日接诊量统计';				
				//显示统计图
				self.showStatImg(statData, 'statImg3_2', '按诊量（人次）', title_str);
			}else{
				$("#statImg3_2").html('');
			}
		});
	}
	
	// }}}
	// {{{ function statBySource()
	
	/**
	 * 来源统计
	 * */
	this.statBySource = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		var tdWidth=100;
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'4',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;			
			var header='<tr class="text-c"><th width="120">来源名称</th>';
			var person_str='<tr><td class="text-c">到诊（人）</td>';			
			var revenue_str='<tr><td class="text-c">营收（元）</td>';
			var percentage_str='<tr><td class="text-c">营收占比（%）</td>';
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.title+'</th>';
				person_str+='<td class="text-c">'+v.visit_num+'</td>';
				percentage_str+='<td class="text-c">'+v.percent+'</td>';
				revenue_str+='<td class="text-c">'+v.income+'</td>';				
			});
			header+='</tr>';
			var tbodyer=person_str+'</tr>'+revenue_str+'</tr>'+percentage_str+'</tr>';
			$('#listAll4').find('thead').html(header);
			$('#listAll4').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info2'),tdWidth,120,$('#li_stat_4'));
			//拼接统计标题
			var title_str=start+'至'+end+'各来源营收百分比';
			//格式化数据
			var statData = self.formatStatData(data,'4');
			//显示统计图
			self.showStatImg(statData, 'statImg4', '营收比例', title_str,'','pie');
		});
		
		//按天统计
		self.cmd(gHttp,{controller:'Patient',method:'statByDate',action:'source',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					if (showType == 'pie') {
						var num = 0;
						$.each(v, function(i, d){
							num += d;
						});
						statData.push({
							'name':k,
							'value':num
						});
					} else {
						$.each(v, function(i, d){
							statData.push({
								'group':i,
								'name':k,
								'value':d
							});
						});
					}
				});
				//拼接统计标题
				var title_str=start+'至'+end+'各来源每日引流统计';				
				//显示统计图
				self.showStatImg(statData, 'statImg4_2', '按诊量（人次）', title_str);
			}else{
				$("#statImg4_2").html('');
			}
		});
	}
	
	// }}}
	// {{{ function statByDoctor()
	
	/**
	 * 医生接诊统计
	 * */
	this.statByDoctor = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		var tdWidth=90;
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'5',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			
			var header='<tr class="text-c"><th width="120">医生名称</th>';
			var new_client='<tr><td class="text-c">新客户（人）</td>';			
			var old_client='<tr><td class="text-c">老客户（人）</td>';
			var Sub_visit_num='<tr><td class="text-c">复诊（人次）</td>';
			var operations='<tr><td class="text-c">操作</td>';
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.doctor_name+'</th>';
				new_client+='<td class="text-c">'+v.new_num+'</td>';
				old_client+='<td class="text-c">'+v.old_num+'</td>';
				Sub_visit_num+='<td class="text-c">'+v.re_visit+'</td>';
				operations+='<td class="text-c"><a title="查看详细病患列表" onClick="gPatient.openEditWID(\'详细病患列表\',\'stat-detail.html?type=5&id='+v.doctor_id+'&start='+start+'&end='+end+'\',\'800\',\'460\')" href="javascript:void(0)"><i class="Hui-iconfont">&#xe695;</i></a></td>';
				
			});
			header+='</tr>';
			var tbodyer=new_client+'</tr>'+old_client+'</tr>'+Sub_visit_num+'</tr>'+operations+'</tr>';
			
			$('#listAll5').find('thead').html(header);
			$('#listAll5').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info3'),tdWidth,120,$('#li_stat_5'));
			
			//拼接统计标题
			var title_str=start+'至'+end+'各医生接诊量统计';
			//格式化数据
			var statData = self.formatStatData(data,'5');
			//显示统计图
			self.showStatImg(statData, 'statImg5', '按诊量（人次）', title_str,'','bar');
		});
		
		//按天统计
		self.cmd(gHttp,{controller:'Patient',method:'statByDate',action:'doctor',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					if (showType == 'pie') {
						var num = 0;
						$.each(v, function(i, d){
							num += d;
						});
						statData.push({
							'name':k,
							'value':num
						});
					} else {
						$.each(v, function(i, d){
							statData.push({
								'group':i,
								'name':k,
								'value':d
							});
						});
					}
				});
				//拼接统计标题
				var title_str=start+'至'+end+'各医生接诊量日期分布曲线';				
				//显示统计图
				self.showStatImg(statData, 'statImg5_2', '按诊量（人次）', title_str);
			}else{
				$("#statImg5_2").html('');
			}
		});
	}
	
	// }}}
	// {{{ function statByDepartmentAndDisease()
	
	/**
	 * 疾病科室统计
	 * */
	this.statByDepartmentAndDisease = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'6',flag:'department',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var tdWidth=90;
			var header='<tr class="text-c"><th width="100">科室名称</th>';
			var new_client='<tr><td class="text-c">新客户（人）</td>';			
			var old_client='<tr><td class="text-c">老客户（人）</td>';
			var Sub_visit_num='<tr><td class="text-c">复诊（人次）</td>';
			var revenue_str='<tr><td class="text-c">营收（元）</td>';
			var percentage_str='<tr><td class="text-c">营收占比（%）</td>';
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.department_name+'</th>';
				new_client+='<td class="text-c">'+v.new_num+'</td>';
				old_client+='<td class="text-c">'+v.old_num+'</td>';
				Sub_visit_num+='<td class="text-c">'+v.re_visit+'</td>';
				revenue_str+='<td class="text-c">'+v.money+'</td>';
				percentage_str+='<td class="text-c">'+v.percent+'</td>';				
			});
			header+='</tr>';
			var tbodyer=new_client+'</tr>'+old_client+'</tr>'+Sub_visit_num+'</tr>'+revenue_str+'</tr>'+percentage_str+'</tr>';			
			$('#listAll6').find('thead').html(header);
			$('#listAll6').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info4'),tdWidth,100,$('#li_stat_6'));
			//拼接统计标题
			var title_str=start+'至'+end+'各科室接诊量统计';
			//格式化数据
			var statData = self.formatStatData(data,'6','department');
			//显示统计图
			self.showStatImg(statData, 'statImg6', '按诊量（人次）', title_str,'','bar');
		});
		
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'6',flag:'disease',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var tdWidth=100;
			var header='<tr class="text-c"><th width="100">病症名称</th>';
			var new_client='<tr><td class="text-c">新客户（人）</td>';			
			var old_client='<tr><td class="text-c">老客户（人）</td>';
			var Sub_visit_num='<tr><td class="text-c">复诊（人次）</td>';
			var revenue_str='<tr><td class="text-c">营收（元）</td>';	
			var percentage_str='<tr><td class="text-c">营收占比（%）</td>';
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.disease_name+'</th>';
				new_client+='<td class="text-c">'+v.new_num+'</td>';
				old_client+='<td class="text-c">'+v.old_num+'</td>';
				Sub_visit_num+='<td class="text-c">'+v.re_visit+'</td>';
				revenue_str+='<td class="text-c">'+v.money+'</td>';
				percentage_str+='<td class="text-c">'+v.percent+'</td>';				
			});
			header+='</tr>';
			var tbodyer=new_client+'</tr>'+old_client+'</tr>'+Sub_visit_num+'</tr>';	
			$('#listAll6_2').find('thead').html(header);
			$('#listAll6_2').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info5'),tdWidth,100,$('#li_stat_6_2'));
			//拼接统计标题
			var title_str=start+'至'+end+'就诊人次病症分布统计';
			//格式化数据
			var statData = self.formatStatData(data,'6','disease');
			//显示统计图
			self.showStatImg(statData, 'statImg6_2', '按诊量（人次）', title_str,'','bar');
		});
		
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'6',flag:'month',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			$('#listAll6_3').grid({
				ttl : ttl,
				showPage : false,
				tableInfo : false,
				order : false,
				filter : false,
				data : data,
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
				field : [
	         				{data:'disease_name'},
							{data:'January'},
							{data:'February'},
							{data:'March'},
							{data:'April'},
							{data:'May'},
							{data:'June'},
							{data:'July'},
							{data:'August'},
							{data:'September'},
							{data:'October'},
							{data:'November'},
							{data:'December'}
	        			]
			});
			//拼接统计标题
			var title_str=start+'至'+end+'各病症每月分布统计';
			//格式化数据
			var statData = self.formatStatData(data,'6','month');
			//显示统计图
			self.showStatImg(statData, 'statImg6_3', '人数', title_str,'','bar');
		});
		
	}
	
	// }}}
	// {{{ function statByFinancial()
	
	/**
	 * 财务统计
	 * */
	this.statByFinancial = function() {
		var start = $('#start').val();
		var end = $('#end').val();		
		//按科室统计
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'7',flag:'department',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var tdWidth=100;
			var header='<tr class="text-c"><th width="100">科室名称</th>';
			var new_client='<tr><td class="text-c">营收（元）</td>';			
			var old_client='<tr><td class="text-c">平均消费（元）</td>';
			var Sub_visit_num='<tr><td class="text-c">百分比（%）</td>';			
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.department_name+'</th>';
				new_client+='<td class="text-c">'+v.money+'</td>';
				old_client+='<td class="text-c">'+v.average+'</td>';
				Sub_visit_num+='<td class="text-c">'+v.percent+'</td>';								
			});
			header+='</tr>';
			var tbodyer=new_client+'</tr>'+old_client+'</tr>'+Sub_visit_num+'</tr>';	
			$('#listAll7_2').find('thead').html(header);
			$('#listAll7_2').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info7'),tdWidth,100,$('#li_stat_7_2'));
			//拼接统计标题
			var title_str=start+'至'+end+'各科室营收统计';
			//格式化数据
			var statData = self.formatStatData(data,'7','department');
			//显示统计图
			self.showStatImg(statData, 'statImg7_2', '营收（元）', title_str,'','bar');
		});
		//按病症统计
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'7',flag:'disease',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var tdWidth=120;
			var header='<tr class="text-c"><th width="100">病症名称</th>';
			var new_client='<tr><td class="text-c">营收（元）</td>';			
			var old_client='<tr><td class="text-c">平均消费（元）</td>';
			var Sub_visit_num='<tr><td class="text-c">百分比（%）</td>';			
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.disease_name+'</th>';
				new_client+='<td class="text-c">'+v.money+'</td>';
				old_client+='<td class="text-c">'+v.average+'</td>';
				Sub_visit_num+='<td class="text-c">'+v.percent+'</td>';								
			});
			header+='</tr>';
			var tbodyer=new_client+'</tr>'+old_client+'</tr>'+Sub_visit_num+'</tr>';	
			$('#listAll7_1').find('thead').html(header);
			$('#listAll7_1').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info9'),tdWidth,100,$('#li_stat_7_1'));
			//拼接统计标题
			var title_str=start+'至'+end+'各来源营收统计';
			//格式化数据
			var statData = self.formatStatData(data,'7','disease');
			//显示统计图
			self.showStatImg(statData, 'statImg7_1', '营收（元）', title_str,'','bar');
		});
		
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'7',flag:'doctor',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;	
			var tdWidth=100;		
			var header='<tr class="text-c"><th width="100">姓名</th>';
			var new_client='<tr><td class="text-c">营收（元）</td>';			
			var old_client='<tr><td class="text-c">平均消费（元）</td>';
			var Sub_visit_num='<tr><td class="text-c">百分比（%）</td>';			
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.doctor_name+'</th>';
				new_client+='<td class="text-c">'+v.money+'</td>';
				old_client+='<td class="text-c">'+v.average+'</td>';
				Sub_visit_num+='<td class="text-c">'+v.percent+'</td>';								
			});
			header+='</tr>';
			var tbodyer=new_client+'</tr>'+old_client+'</tr>'+Sub_visit_num+'</tr>';	
			$('#listAll7_3').find('thead').html(header);
			$('#listAll7_3').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info8'),tdWidth,100,$('#li_stat_7_3'));
			//拼接统计标题
			var title_str=start+'至'+end+'各医生营收统计';
			//格式化数据
			var statData = self.formatStatData(data,'7','doctor');
			//显示统计图
			self.showStatImg(statData, 'statImg7_3', '营收（元）', title_str,'','bar');
		});
		
		
		
		//按天统计
		self.cmd(gHttp,{controller:'Patient',method:'statByDate',action:'money',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					if (showType == 'pie') {
						var num = 0;
						$.each(v, function(i, d){
							num += d;
						});
						statData.push({
							'name':k,
							'value':num
						});
					} else {
						$.each(v, function(i, d){
							statData.push({
								'group':i,
								'name':k,
								'value':d
							});
						});
					}
				});
				//拼接统计标题
				var title_str=start+'至'+end+'每天营收统计';				
				//显示统计图
				self.showStatImg(statData, 'statImg7_4', '营收（元）', title_str);
			}else{
				$("#statImg7_4").html('');
			}
		});
	}
	
	// }}}
	// {{{ function statByExamineItems()
	
	/**
	 * 诊疗项目
	 * */
	this.statByExamineItems = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		var tdWidth=120;
		self.cmd(gHttp,{controller:'Patient',method:'getStatData',type:'8',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var header='<tr class="text-c"><th width="100">项目名称</th>';
			var new_client='<tr><td class="text-c">到诊量（人次）</td>';
			var Sub_visit_num='<tr><td class="text-c">总计（人次）</td>';
			var sum_money='<tr><td class="text-c">营收（元）</td>';			
			$.each(data,function(i,v){
				header+='<th width="'+tdWidth+'">'+v.item_name+'</th>';
				new_client+='<td class="text-c">男：'+v.male+'<b> / </b>女：'+v.female+'</td>';				
				Sub_visit_num+='<td class="text-c">'+v.num+'</td>';	
				sum_money+='<td class="text-c">'+v.money+'</td>';					
			});
			header+='</tr>';
			var tbodyer=new_client+'</tr></tr>'+Sub_visit_num+'</tr>'+sum_money+'</tr>';	
			$('#listAll8').find('thead').html(header);
			$('#listAll8').find('tbody').html(tbodyer);
			//表格滚动处理
			self.scrollTab($('#info10'),tdWidth,100,$('#li_stat_8'));
			//拼接统计标题
			var title_str=start+'至'+end+'接诊人次及营收在诊疗项目上的分布统计';	
			//格式化数据
			var statData = self.formatStatData(data,'8');
			//显示统计图
			self.showStatImg(statData, 'statImg8', '就诊人数', title_str,'','bar');
		});
		
	}
	
	// }}}
	// {{{ function formatStatData()
	
	/**
	 * 格式化统计数据
	 * */
	this.formatStatData = function(data,statType,field_flag,type) {
		if (type == undefined) {
			var type = $('#showType').val();
		}
		var statData = [];
		if (statType == '1') {
			$.each(data, function(k, v) {
				if (field_flag == 'detail') {
					var age_arr = [];
					age_arr['10'] = '0-10岁';
					age_arr['20'] = '11-20岁';
					age_arr['30'] = '21-30岁';
					age_arr['40'] = '31-40岁';
					age_arr['50'] = '41-50岁';
					age_arr['60'] = '51-60岁';
					age_arr['70'] = '61-70岁';
					age_arr['80'] = '71-80岁';
					age_arr['90'] = '81岁以上';
					var age_str = '';
					var title = v['disease_name'];
					var j = 0;
					for (var i in age_arr) {
						if (j>8) {
							continue;
						}
						
						age_str = age_arr[i];
						var str = v[i];
						var arr = str.match(/\d+/g);
						var num = parseInt(arr[0]) + parseInt(arr[1]);
						statData.push({
							'group':title,
							'name':age_str,
							'value':num
						});
						j++;
					}
				} else {
					if (type == 'pie') {
						if (k>0) {
							statData.push({
								'name':v['title'],
								'value':v['num']
							});
						}
					} else {
						statData.push({
							'group':'总人数',
							'name':v['title'],
							'value':v['num']
						});
						
						statData.push({
							'group':'男性',
							'name':v['title'],
							'value':v['male']
						});
						
						statData.push({
							'group':'女性',
							'name':v['title'],
							'value':v['female']
						});
					}
				}
			});
		} else if (statType == '2') {
			var weeks = [];
			weeks['Monday'] = '周一';
			weeks['Tuesday'] = '周二';
			weeks['Wednesday'] = '周三';
			weeks['Thursday'] = '周四';
			weeks['Friday'] = '周五';
			weeks['Saturday'] = '周六';
			weeks['Sunday'] = '周日';
			$.each(data, function(k, v) {
				var week_str = '';
				var title = v['title'];
				var j = 0;
				for (var i in weeks) {
					if (type == 'pie') {
						if (k<3) {
							continue;
						}
					}
					if (j>6) {
						continue;
					}
					week_str = weeks[i];
					var str = v[i];
					var arr = str.match(/\d/g);
					var num = parseInt(arr[0]) + parseInt(arr[1]);
					statData.push({
						'group':title,
						'name':week_str,
						'value':num
					});
					j++;
				}
			});
		} else if (statType == '3') {
			if (type == 'pie') {
				var deal_num = 0;
				var not_deal_num = 0;
				$.each(data, function(k, v) {
					deal_num += v['deal_num'];
					not_deal_num += v['not_deal_num'];
				});
				
				statData.push({
					'name':'成交',
					'value':deal_num
				});
				
				statData.push({
					'name':'未成交',
					'value':not_deal_num
				});
				
			} else {
			$.each(data, function(k, v) {
				statData.push({
					'name':v['user_name'],
					'group':'成交',
					'value':v['deal_num']
				});
				
				statData.push({
					'name':v['user_name'],
					'group':'未成交',
					'value':v['not_deal_num']
				});
			});
			}
		} else if (statType == '4') {
			$.each(data, function(k, v) {
				statData.push({
					'name':v['title'],
					'group':'营收',
					'value':v['income']
				});
			});
		} else if (statType == '5') {
			$.each(data, function(k, v) {
				if (type == 'pie') {
					var num = v['new_num'] + v['old_num'];
					statData.push({
						'name':v['doctor_name'],
						'value':num
					});
				} else {
					statData.push({
						'group':'新客户',
						'name':v['doctor_name'],
						'value':v['new_num']
					});
					statData.push({
						'group':'老客户',
						'name':v['doctor_name'],
						'value':v['old_num']
					});
					statData.push({
						'group':'复诊人数',
						'name':v['doctor_name'],
						'value':v['re_visit']
					});
				}
			});
		} else if (statType == '6') {
			if (field_flag == 'month') {
				var months = [];
				months['January'] = '1月';
				months['February'] = '2月';
				months['March'] = '3月';
				months['April'] = '4月';
				months['May'] = '5月';
				months['June'] = '6月';
				months['July'] = '7月';
				months['August'] = '8月';
				months['September'] = '9月';
				months['October'] = '10月';
				months['November'] = '11月';
				months['December'] = '12月';
				
				if (type == 'pie') {
					var numArr = [];
					numArr['January'] = 0;
					numArr['February'] = 0;
					numArr['March'] = 0;
					numArr['April'] = 0;
					numArr['May'] = 0;
					numArr['June'] = 0;
					numArr['July'] = 0;
					numArr['August'] = 0;
					numArr['October'] = 0;
					numArr['November'] = 0;
					numArr['December'] = 0;
					$.each(data, function(k, v) {
						for(var i in months) {
							if (i=='contains') {
								continue;
							}
							numArr[i] += v[i];
						}
					});
					
					for(var i in months) {
						if (i=='contains') {
							continue;
						}
						statData.push({
							'name':months[i],
							'value':numArr[i]
						});
					}
				} else {
					$.each(data, function(k, v) {
						for(var i in months) {
							if (i=='contains') {
								continue;
							}
							statData.push({
								'group':v['disease_name'],
								'name':months[i],
								'value':v[i]
							});
						}
					});
				}
				
				
			} else {
				field_flag = field_flag + '_name';
				if (type == 'pie') {
					$.each(data, function(k, v) {
						var num = v['new_num'] + v['old_num'];
						statData.push({
							'name':v[field_flag],
							'value':num
						});
					});
				} else {
					$.each(data, function(k, v) {
						statData.push({
							'group':'新客户',
							'name':v[field_flag],
							'value':v['new_num']
						});
						statData.push({
							'group':'老客户',
							'name':v[field_flag],
							'value':v['old_num']
						});
						statData.push({
							'group':'复诊人数',
							'name':v[field_flag],
							'value':v['re_visit']
						});
					});
				
				}
			}
		} else if (statType == '7') {
			field_flag = field_flag + '_name';
			$.each(data, function(k, v) {
				statData.push({
					'group':v[field_flag],
					'name':v[field_flag],
					'value':v['money']
				});
			});
		} else if (statType == '8') {
			if (type == 'pie') {
				$.each(data, function(k, v) {
					statData.push({
						'name':v['item_name'],
						'value':v['num']
					});
				});
			} else {
				$.each(data, function(k, v) {
					statData.push({
						'group':'男性',
						'name':v['item_name'],
						'value':v['male']
					});
					
					statData.push({
						'group':'女性',
						'name':v['item_name'],
						'value':v['female']
					});
					
					statData.push({
						'group':'总计',
						'name':v['item_name'],
						'value':v['num']
					});
				});
			}
		}
		
		return statData;
	}
	
	// }}}
	// {{{ function showStatImg()
	
	/**
	 * 显示统计图
	 * */
	this.showStatImg = function(statData, showId, des, title, field_flag,type){
		if (type == undefined) {
			var type = $("#showType").val();
		}
		
		if (statData.length>0) {
			if (type == 'pie') {
				var opt = HighChart.ChartOptionTemplates.Pie(statData,des,title);
			} else if (type == 'line') {
				var opt = HighChart.ChartOptionTemplates.Line(statData,des,title);
			} else if (type == 'bar') {
				//var statType = $("#type").val();
				//if (statType == '1'&&field_flag != 'detail') {}
				//var opt = HighChart.ChartOptionTemplates.Bar(statData,des,title);
					var opt = HighChart.ChartOptionTemplates.Bars(statData,true,true,des,title);	
				
			}
			
			var container = $("#" + showId);
		    HighChart.RenderChart(opt, container);
		}
		
	}
	
	// }}}
	
	
	// {{{ function scrollTab()
	
	/**
	 * 超长表格滚动处理
	 * */
	
	this.scrollTab=function(obj,thWidth,titWidth,liObj){				
		$(liObj).find('h4').addClass('selected');
		$(liObj).find('div.info').show();
		var sboxWidth=$(obj).find('div.scrollbox').width();
		var sboxHeight=$(obj).find('table').height();
		//var tabWidth=$(obj).find('table').width();
		var tabWidth = sboxWidth;
		$(obj).find('.scrollbox').width(sboxWidth).height(sboxHeight+5);		
		
		
		//表格实际能容纳的项目个数
		var num=parseInt((tabWidth-titWidth-16)/(thWidth+16));
		//var moveLen=
		//目前实际的项目个数
		realnum=$(obj).find('th').length-1;
		//如果实际的项目个数多于表格实际能容纳的个数则注册滚动功能
		if(num<realnum){
			var groupnum=parseInt(realnum/num);				
			//为了让表格美观，需要重先调整单元格大小，使在scrollbox中显示的表格单元数为整数
			var newtdWidth=(tabWidth-titWidth+16)/num;
			tabWidth=realnum*(newtdWidth+16)+titWidth+16;
			$(obj).find('table').width(tabWidth);
			$(obj).find('table th:gt(0)').width(newtdWidth);
			$(obj).find('div.left_scroll').attr('groupnum',groupnum).attr('scrollength',sboxWidth).attr('nowlist',0);
			$(obj).find('div.right_scroll').attr('groupnum',groupnum).attr('scrollength',sboxWidth);
		}else{
			$(obj).find('.left_scroll').hide();
			$(obj).find('.right_scroll').hide();
		}
	}
		
		
		
	// }}}
	// {{{ function scrollleft()
	
	/**
	 * 向左滚动
	 * */
	this.scrollleft=function(obj){		
		var nowlist=Number($(obj).attr('nowlist'));	//1		
		var flag=$(obj).attr('flag');
		var groupnum=Number($(obj).attr('groupnum'));//2
		var scrollength=$(obj).attr('scrollength');		
		if(nowlist<groupnum){
			//$(obj).next('table').css('border','red');
			nowlist++;
			$(obj).parent().find('table').animate({left:'-'+nowlist*scrollength+'px'});				
			$(obj).attr('nowlist',nowlist);	
			$(obj).parent().find('.left_scroll').attr('nowlist',nowlist);	
		}
		else{
			parent.layer.msg('己经是最后一组了',{icon:2});
		}
	}
	
	// }}}
	// {{{ function scrollright()
	
	/**
	 * 向右滚动
	 * */
	this.scrollright=function(obj){
		var nowlist=Number($(obj).attr('nowlist'));		
		var flag=$(obj).attr('flag');
		var groupnum=Number($(obj).attr('groupnum'));
		var scrollength=$(obj).attr('scrollength');
		if(nowlist>0){
			nowlist--;
			$(obj).parent().find('table').animate({left:'-'+nowlist*scrollength+'px'});				
			$(obj).attr('nowlist',nowlist);	
			$(obj).parent().find('.right_scroll').attr('nowlist',nowlist);
		}
		else{
			parent.layer.msg('己经是第一组了',{icon:2});
		}
	}
	
	// }}}
	// {{{ function updateStatData()
	
	/**
	 * 更新统计
	 * */
	this.updateStatData = function() {
		var start = $("#start").val();
		var end = $("#end").val();
		self.cmd(gHttp,{controller:'Patient',method:'updateStatData', start:start, end:end},function(ret){
			if(ret.statu){
				layer.msg('统计数据更新成功', {icon: 1});
			}else{
				layer.alert(ret.msg); 	
			}
		});
	}
	
	// }}}
}
