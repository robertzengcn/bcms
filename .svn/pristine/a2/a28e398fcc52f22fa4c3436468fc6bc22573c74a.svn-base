/**
 * 预约挂号
 * */
function Reservation() {
	BaseFunc.call(this);
	var self = this;

	
	// }}}
    // {{{ function initStatItems()
	
	/**
	 * 统计选项
	 * */
	this.initStatItems = function() {	
		if(self.checkAndroidOrIos()){
			$("#statItems li").click(function(){
				var type = $(this).attr("flag");
				window.open('reservelist.html?type=' + type ,'_self');
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
		    case '1': //排班统计
		    	self.statBySchedule();
			    break;
		    case '2': //到诊统计
				self.statByArrive();
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
		    case '1': //排班统计
		    	self.statBySchedule();
			    break;
		    case '2': //到诊统计
				self.statByArrive();
			    break;
		    default:
			    break;
		}
	}

	
	// {{{ function statBySource()
	
	/**
	 * 排班统计
	 * */
	this.statBySchedule = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'ResVation',method:'getStatData',type:'1',start:start,end:end}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var total = result.total;
			var html = '';
			var arrs = ['星期一','星期二','星期三','星期四','星期五','星期六','星期日'];
			var arr = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
			$.each(arrs, function(k,b){
				html += '<tr class="am-primary">';
				html += '<td>'+b+'</td>';
				for(var i=0;i<4;i++){
					var day = data[i][arr[k]].replace(/<b>\/<\/b>/,'').replace(/&nbsp;&nbsp;/,'<br/>');
					html += '<td>' + day + '</td>';					
				}
				html += '</tr>';
			});
			$("#listAll1 tbody").html(html);
			var str="<tr class='text-c am-primary'><td  colspan='5'>已约号源："+total.about+"（个）<br/>未约号源："+total.no+"</span>（个）<br/>总号源："+total.total+"（个）</td></tr>";
			$('#listAll1 tbody').append(str);
			var title_str=start+'至'+end+'排班号源(已约/未约)周分布统计';			
			//格式化数据
			var statData = self.formatStatData(data,'1');
			//显示统计图
			self.showStatImg(statData, 'statImg1', '号源(个)', title_str,'','bar');
		});
	}
	/**
	 * 到诊统计
	 * */
	this.statByArrive = function() {
		var start = $('#start').val();
		var end = $('#end').val();
		self.cmd(gHttp,{controller:'ResVation',method:'getStatData',type:'2',start:start,end:end,flag:'department'}, function(result) {
			var ttl = result.ttl;
			var data = result.rows;
			var total = result.total;
		    var tybody = '';
			$.each(data,function(i,v){
				tybody += '<tr class="text-c am-primary">';
				tybody +='<td class="text-c">'+v.department_name+'</td>';
				tybody +='<td class="text-c">'+v.arrive_num+'</td>';
				tybody +='<td class="text-c">'+v.about_num+'</td>';
				tybody +='<td class="text-c">'+v.percent+'</td>';
				tybody +='</tr>';
			});
			$('#listAll2').find('tbody').html(tybody);
			var str="<tr class='text-c am-primary'><td colspan='4'>已到诊总人数："+total.arrive+"（人）<br/>已约总人数："+total.about+"</span>（人）<br/>到诊率："+total.percent+"（%）</td></tr>";
			$('#listAll2 tbody').append(str);
			var title_str=start+'至'+end+'到诊统计';
			//格式化数据
			var statData = self.formatStatData(data,'2');
			//显示统计图
			self.showStatImg(statData, 'statImg2_2', '人数', title_str, '', 'bar');
		});
		
/* 		//按天统计
		self.cmd(gHttp,{controller:'ResVation',method:'statByDate',action:'receptionist',start:start,end:end},function(ret){
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
		}); */
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
			var weeks = [];
			weeks['Sunday'] = '周日';
			weeks['Monday'] = '周一';
			weeks['Tuesday'] = '周二';
			weeks['Wednesday'] = '周三';
			weeks['Thursday'] = '周四';
			weeks['Friday'] = '周五';
			weeks['Saturday'] = '周六';
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
		} else if (statType == '2') {
			var arrive = about = 0;
			$.each(data, function(k, v) {
				arrive += v['arrive_num'];
				about += v['about_num'];					
			});
				statData.push({
					'group':'到诊统计',
					'name':'到诊',
					'value':arrive
				});
				statData.push({
					'group':'到诊统计',
					'name':'已约',
					'value':about
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
