/**
 * 客户管理
 * */
function Clients() {
	BaseFunc.call(this);
	var self = this;
	
	// {{{ function init()
	
	/**
	 * 初始化页面
	 * */
	this.init = function() {
		$(function(){
			//self.checkPwd();
			self.fillClientsList();
		});
	}
	/**
	 * 填充客户列表
	 * */
	this.fillClientsList = function() {
		self.cmd(gHttp,{controller:'Clients',method:'getAllPerson',is_first:'1'},function(ret){
			var html = '';
			if (ret.ttl != undefined && ret.ttl>0) {
				var data = ret.rows;
				$.each(data, function(k,v){
					html += '<tr onclick="window.open(\'detail.html?id='+v.id + '\',\'_self\')" style="cursor:hand;">';
					html += '<td>' + v.username + '</td>';
					html += '<td>' + v.disease_name + '</td>';
					html += '<td>' + v.visit_time_str + '</td>';
					html += '</tr>';
				});
			}
			$("#dataTable").html(html);
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
		content += '<div class="row cl" id="passbox" style="height:30px;">';		
		//content += '<div class="formControls am-u-sm-11">';
		content += '<input type="password" class="input-text" id="password" name="password" style="width:100%;height:30px;line-height:30px;"/>';
		content += '</div>';		
		//content += '</div>';
		layer.open({
			closeBtn:0,
			content:content,			
			area:['80%','160px'],
			title:'登入密码',
			shade:[1,'#b3b3b3'],
			success:function(){
				$("#password").focus();
				$('#passbox').parent('div').height('50px');
			},
			yes:function(index) {
				var password = $("#password").val();
				if (password == '') {
					$("#error").html("请输入密码");
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
				//self.fillDiagnoseList();
			},
//			cancel:function(index){
//		    	var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
//		    	parent.layer.close(index); //再执行关闭
//		    }
			cancel: function(index){ 
				    layer.close(index)
				}    
		});
	}
	


	
	// }}}
    // {{{ function initStatItems()
	
	/**
	 * 统计选项
	 * */
	this.initStatItems = function() {	
		if(self.checkAndroidOrIos()){
			$("#statItems li").click(function(){
				var type = $(this).attr("flag");
				window.open('clientlist.html?type=' + type ,'_self');
			});
		}else{
			return '';
		}
		
	}
	/**
	 * 移动终端判断
	 * */
	this.checkAndroidOrIos = function() {
		var browser = {
			versions: function() {
				var u = navigator.userAgent, app = navigator.appVersion;
				return {//移动终端浏览器版本信息 
				ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
				android: u.indexOf('Android') > -1  //android终端
				};
			}()
		}
		if (browser.versions.ios || browser.versions.android ) {
			return true;
		}else{
			return false;
			//self.checkPwd();
		}
	}	
	// }}}
	// {{{ function stat()
	
	/**
	 * 统计
	 * */
	this.stat = function() {
		initTimeMonth('start', 'end');
		
		$("#timeField a").click(function(){
			$("a.am-btn").removeClass('am-active');
			var time = $(this).attr('flag');
			$(this).addClass('am-active');
			if ('free' != $(this).attr("id")) {
				if (time != "") {
					var time = parseInt(time);
					var myDate = new Date();//当前时间
					var oneDay = 1000 * 60 * 60 * 24;
					var lastDate = new Date(myDate - oneDay * time);
				    var lastYear = lastDate.getFullYear();
				    var lastMonth = lastDate.getMonth() + 1;
				    var lastDay = lastDate.getDate();
				    var str = lastYear + '-' + lastMonth + '-' + lastDay;
					$("#start").val(str);
					self.statData();
				}
			}
			
		});
		//自定义时间
		$("#confirm").click(function(){
			var start = $('#start').val();
			//console.log(start.valueOf());
			var end = $('#end').val();
			$('#start_time').val(start);
			$('#end_time').val(end);
			if(start.valueOf() >= end.valueOf()){
				$('#doc-modal-1').find('p').eq(1).text('开始日期应小于结束日期！').end().show();
			}else{
				$('#doc-modal-1').modal('close');
				
				$('#dataTable').find('tbody').empty();
				$('.dropload-down').remove();
				self.statData();
			}
		});
		
		
		//获取参数
		var para = self.parseUrl(window.location.href);
        var type = para.type;
        
		$("span[id^='span_stat_']").hide();
		$("span[id^='span_stat_" + type + "']").show();
		
		switch (type) {
		    case '1': //来源统计
		    	self.statBySource();
			    break;
		    case '2': //咨询人员
				self.statByReceptionist();
			    break;
		    case '3': //
		    	self.statByDepartment();
			    break;
		    case '4': //所在地区
		    	self.statByRegion();
			    break;
		    default:
			    break;
		}
	}
	
	// }}}
	this.statData = function() {
		//获取参数
		var para = self.parseUrl(window.location.href);
        var type = para.type;
        
		$("span[id^='span_stat_']").hide();
		$("span[id^='span_stat_" + type + "']").show();
		
		switch (type) {
		    case '1': //来源统计
		    	self.statBySource();
			    break;
		    case '2': //咨询人员
				self.statByReceptionist();
			    break;
		    case '3': //
		    	self.statByDepartment();
			    break;
		    case '4': //所在地区
		    	self.statByRegion();
			    break;
		    default:
			    break;
		}
	}

	
	// {{{ function statBySource()
	
	/**
	 * 来源统计
	 * */
	this.statBySource = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'Client',method:'getStatData',type:'1',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
		    var tybody = '';
			$.each(data,function(i,v){
				tybody += '<tr class="text-c am-primary">';
				tybody +='<td width="90" class="text-c">'+v.title+'</td>';
				tybody +='<td class="text-c">'+v.yes+'</td>';
				tybody +='<td class="text-c">'+v.maybe+'</td>';
				tybody +='<td class="text-c">'+v.unsure+'</td>';
				tybody +='<td class="text-c">'+v.no+'</td>';
				tybody +='<td class="text-c">'+v.arrive+'</td>';
				tybody +='<td class="text-c">'+v.total_num+'</td>';
				tybody +='</tr>';
			});
			$('#listAll1').find('tbody').html(tybody);
			//格式化数据
			//var statData = self.formatStatData(data,'1');
			//显示统计图
			//self.showStatImg(statData, 'statImg1_1', '人数', '来源统计', '', 'bar');
		});
		
		//按天统计
		self.cmd(gHttp,{controller:'Client',method:'statByDate',action:'source',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					$.each(v, function(i, d){
						statData.push({
							'group':i,
							'name':k,
							'value':d
						});
					});
				});
				
				var title = '来源到诊量时间曲线 (默认统计最近30天的就诊情况)';
				//显示统计图
				self.showStatImg(statData, 'statImg1_2', '人数', title);
			}else{
				$("#statImg1_2").html('');
			}
		});
	}
	/**
	 * 咨询人员
	 * */
	this.statByReceptionist = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'Client',method:'getStatData',type:'2',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
		    var tybody = '';
			$.each(data,function(i,v){
				tybody += '<tr class="text-c am-primary">';
				tybody +='<td class="text-c">'+v.user_name+'</td>';
				tybody +='<td class="text-c">'+v.arrive+'</td>';
				tybody +='<td class="text-c">'+v.total_num+'</td>';
				tybody +='</tr>';
			});
			$('#listAll2').find('tbody').html(tybody);
			//格式化数据
			//var statData = self.formatStatData(data,'2');
			//显示统计图
			//self.showStatImg(statData, 'statImg2_1', '人数', '来源统计', '', 'bar');
		});
		
		//按天统计
		self.cmd(gHttp,{controller:'Client',method:'statByDate',action:'receptionist',start:start,end:end},function(ret){
			if(ret.statu){
				var statData = [];
				var data = ret.data;
				$.each(data, function(k, v) {
					$.each(v, function(i, d){
						statData.push({
							'group':i,
							'name':k,
							'value':d
						});
					});
				});
				
				var title = '前台接待工作时间曲线 (默认统计最近30天的接待情况)';
				//显示统计图
				self.showStatImg(statData, 'statImg2_2', '人数', title);
			}else{
				$("#statImg2_2").html('');
			}
		});
	}	

	/**
	 * 所在地区
	 * */
	this.statByRegion = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'Client',method:'getStatData',type:'4',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
		    var tybody = '';
			$.each(data,function(i,v){
				if(v.two != undefined){
					$.each(v.two,function(m,n){
						if(n.three != undefined){
							$.each(n.three,function(l,k){
								tybody += '<tr class="text-c am-primary">';
								tybody +='<td class="text-c">'+k.region_name+'</td>';
								tybody +='<td class="text-c">'+k.region_num+'</td>';
								tybody +='</tr>';							
							});						
						}else{
							tybody += '<tr class="text-c am-primary">';
							tybody +='<td class="text-c">'+n.region_name+'</td>';
							tybody +='<td class="text-c">'+n.region_num+'</td>';
							tybody +='</tr>';
						}
					});						
				}else{
					tybody += '<tr class="text-c am-primary">';
					tybody +='<td class="text-c">'+v.region_name+'</td>';
					tybody +='<td class="text-c">'+v.region_num+'</td>';
					tybody +='</tr>';					
				}
				if(v.other_num!=0){
					tybody += '<tr class="text-c am-primary">';
					tybody +='<td class="text-c">'+v.region_name+'-其它</td>';
					tybody +='<td class="text-c">'+v.other_num+'</td>';
					tybody +='</tr>';
				}
			});
			$('#listAll4').find('tbody').html(tybody);
			//格式化数据
			var statData = self.formatStatData(data,'4');
			//显示统计图
			self.showStatImg(statData, 'statImg4_2', '人数', '地区统计', '', 'bar');
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
				statData.push({
					'name':v['title'],
					'group':'一定到诊',
					'value':v['yes']
				});
				statData.push({
					'name':v['title'],
					'group':'可能到诊',
					'value':v['maybe']
				});
				statData.push({
					'name':v['title'],
					'group':'不确定到诊',
					'value':v['unsure']
				});
				statData.push({
					'name':v['title'],
					'group':'不会到诊',
					'value':v['no']
				});
				statData.push({
					'name':v['title'],
					'group':'已到诊',
					'value':v['arrive']
				});
				statData.push({
					'name':v['title'],
					'group':'总数',
					'value':v['total_num']
				});
			});
		} else if (statType == '2') {
			$.each(data, function(k, v) {
				statData.push({
					'name':v['user_name'],
					'group':'已到诊',
					'value':v['arrive']
				});
				statData.push({
					'name':v['user_name'],
					'group':'咨询总数',
					'value':v['total_num']
				});
			});			
		} else if (statType == '3') {

		} else if (statType == '4') {
			$.each(data, function(k, v) {
				if(v.two != undefined){
					$.each(v.two, function(m, n) {
						if(n.three != undefined){
							$.each(n.three, function(o, p){
								statData.push({
									'name':p['region_name'],
									'group':p['region_name'],
									'value':p['region_num']
								});								
							});	
						}else{
							statData.push({
								'name':n['region_name'],
								'group':n['region_name'],
								'value':n['region_num']
							});									
						}
					});							
				}else{
					statData.push({
						'name':v['region_name'],
						'group':v['region_name'],
						'value':v['region_num']
					});							
				}
				if(v.other_num!=0){
					statData.push({
						'name':v['region_name']+'-其它',
						'group':v['region_name']+'-其它',
						'value':v['other_num']
					});							
				}
			});
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
			var type = 'line';//$("#showType").val();
		}
		if (statData.length>0) {
			if (type == 'pie') {
				var opt = HighChart.ChartOptionTemplates.Pie(statData,des,title);
			} else if (type == 'line') {
				var opt = HighChart.ChartOptionTemplates.Line(statData,des,title);
			} else if (type == 'bar') {
				var opt = HighChart.ChartOptionTemplates.Bars(statData,true,true,des,title);				
			}
			
			var container = $("#" + showId);
		    HighChart.RenderChart(opt, container);
		}
		
	}
	
	// }}}
}
