/**
 * Stat全站流量统计
 * */
function Stat() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initList()
	
	/**
	 * 初始化综合统计列表
	 * */
	this.initSiteTraffic = function() {
		$(function(){
			$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
			
			//table加载数据
			self.fillDataTable();
			
			$(".tabBar span").click(function(){
				var index = $(this).index();
				switch(index) {
				    case 0: //综合统计
				    	//self.fillDataTable();
				    	location.replace(location.href);
					    break;
				    case 1: //流量趋势
				    	self.iptrendStat();
				    	break;
				    case 2: //访客分析
				    	self.sync = true;
		                self.visitorsStat({controller:'StatisticsLog',method:'distributed'});
		                //新老访客时间曲线
		                self.visitorsLineStat({controller:'StatisticsLog',method:'lineDistributed'});
		                self.sync = false;
				    	break;
				    case 3: //来源统计
				    	self.visitorStat();
				    	break;
				    case 4: //受访统计
				    	self.visitortoStat();
				    	break;
				    case 5: //竞价统计
				    	self.biddingStat();
				    	break;
				}
			});
			
			//查询
			$("#qry").click(function(){
				var ip = $('#ip').val();
				var sessionid = $('#sessionid').val();
				var start_time = $('#start_time').val();
				var end_time = $('#end_time').val();
				
				var url = {controller:'StatisticsLog',method:'query',ip:ip,sessionid:sessionid,start_time:start_time,end_time:end_time};
				self.fillDataTable(url);
			});
			
			//按条件删除数据
			$('#del').click(function(){
				self.clearAll();
			});
			
			//流量趋势
			$('#iptrend_qry').click(function(){
                self.iptrendStat();
			});
			
			//访客分析
			$('#visitors_qry').click(function(){
				self.sync = true;
                self.visitorsStat({controller:'StatisticsLog',method:'distributed'});
                //新老访客时间曲线
                self.visitorsLineStat({controller:'StatisticsLog',method:'lineDistributed'});
                self.sync = false;
			});
			
			
		});
	}
	

	
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function(url) {
		var start_time = $('#start_time').val();
		var end_time = $('#end_time').val();
		if (url == undefined) {
			url = {controller:'StatisticsLog',method:'query',start_time:start_time,end_time:end_time};
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
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]}
							],
				columns: [
				            {
				            	data : 'id',
				            	render : function (id, type, row) {
				            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
				            	}
				            },
                            { data: 'id' },
				            { data: 'ip' },
				            { data: 'visittime'},
				            { data: 'sessionid'},
				            { data: 'fromurl'},
				            { data: 'url'}
				        ]
			});
		});
		
		
	}
	
	// }}}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'StatisticsLog',method:'del',id:ids});
	}

	//清空数据
	this.clearAll = function(){
		var ip = $('#ip').val();
		var sessionid = $('#sessionid').val();
		var start_time = $('#start_time').val();
		var end_time = $('#end_time').val();
		layer.confirm('真的要删除么当前条件下搜索得到的所有数据吗？删除后无法恢复！',function(index){
			self.cmd(gHttp,{controller:'StatisticsLog',method:'del',ip:ip,sessionid:sessionid,start_time:start_time,end_time:end_time},function(result1){
				if(result1.statu){
					location.replace(location.href);
				}else{
					layer.alert(result1.msg);
				}
			});
		});
	}
	
	//流量统计
	this.iptrendStat = function() {
		var start = $('#iptrend_start').val();
		var end = $('#iptrend_end').val();
		var para = {controller:'StatisticsLog',method:'trend',star:start,end:end};
		self.cmd(gHttp,para,function(result1){
			if(result1.statu){	
			//console.log(result1);
				$('#container').highcharts({ 
					chart: { zoomType: 'x', spacingRight: 20 }, 
					title: { text: start+'至'+end+'流量统计' }, 
					xAxis: { 
			            title: {
			                text: '日期'
			            },
						categories: result1.data.key
				   	}, 
					yAxis: { 
						title: { text: '流量' }, 
						labels: { formatter: function() { return this.value } } 
					}, 
					tooltip: { crosshairs: true, shared: true },
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
					series: [{ 
						type: 'area',
						name: '浏览次数(PV)',  
						marker: { symbol: 'square' }, 
						data: result1.data.pv 
					}, { 
						type: 'area',
						name: '独立访客(UV)', 
						marker: { symbol: 'diamond' }, 
						data: result1.data.uv
					}, { 
						type: 'area',
						name: 'IP', 
						marker: { symbol: 'circle' }, 
						data: result1.data.ip 
					}] 
				});
			}else{
				layer.alert(result1.msg);
			}
			return false;
		});
	}
	
	//访客分析
	this.visitorsStat = function(para) {
		var start = $('#visitors_start').val();
		var end = $('#visitors_end').val();
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
						text :'新老访客分布'
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
	
	//新老访客时间曲线
    this.visitorsLineStat = function(para) {
    	var start = $('#visitors_start').val();
		var end = $('#visitors_end').val();
		para['star'] = start;
		para['end'] = end;
    	self.cmd(gHttp,para,function(result1){
			//console.log(result1);						 
			if(result1.statu){
		    	$('#visitors_date').highcharts({
		            chart: {
		                zoomType: 'x',
		                spacingRight: 20
		            },
		            title: {
		                text: start+'至'+end+'用户回归曲线图'
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
		                    text: '日期'
		                }
		            },
		            yAxis: {
		                title: {
		                    text: '访问次数'
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
			                name: '新访客',
			                color: 'red',
			                data: result1.data.newnum
		                }
		                ,
		                {
			                type: 'area',
			                name: '老访客',
			                color: 'blue',
			                data: result1.data.oldnum
		                }
		                
		            ]
		        });
		    	
			}else{
				layer.alert(result1.msg);
			}
			return false;
		});
    }
    
    //来源统计
	this.visitorStat = function () {
		self.cmd(gHttp,{controller:'StatisticsLog',method:'selFrom'},function(ret) {
			var data = ret.data;
			//填充表格
			self.fillVisitorTable(data);
			
			//画出统计图
			var formatData = [];
			$.each(data,function(k,v) {
				v.fromurl = v.fromurl == '' ? '地址栏输入' : v.fromurl;
				formatData[k] = [v.fromurl,parseInt(v.num)];
			});
			self.drawPie('visitorfrom_ratio', '来源', formatData);
			
		});	
			
	}
	
	//来源统计列表
	this.fillVisitorTable = function(data) {
		$("#visitorData").DataTable().destroy();
		$("#visitorData").DataTable({
			bStateSave:true,
			data:data,
			bSort: false,
			bFilter: false,
			bInfo : false,
			bPaginate : false,
			aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[2]}
							],
			columns: [
			            { data: 'num'},
			            { data: 'fromurl'},
			            { data: 'num'}
			        ],
		   fnCreatedRow:function(nRow, aData, iDataIndex){
			   var indexHtml = '<span class="badge badge-default  radius">'+(iDataIndex + 1)+'</span>';
			   if (iDataIndex == '0') {
				   indexHtml = '<span class="badge badge-danger radius">' + (iDataIndex + 1) + '</span>';
			   } else if (iDataIndex == '1') {
				   indexHtml = '<span class="badge badge-warning radius">' + (iDataIndex + 1) + '</span>';
			   } else if (iDataIndex == '2') {
				   indexHtml = '<span class="badge badge-success radius">' + (iDataIndex + 1) + '</span>';
			   } 
			   
			   $('td:eq(0)', nRow).html(indexHtml);
			   
            }
		});

	}
	
	//受访统计
	this.visitortoStat = function() {
		self.cmd(gHttp,{controller:'StatisticsLog',method:'selTo'},function(ret) {
			var data = ret.data;
			//填充表格
			self.fillVisitortoTable(data);
			
			//画出统计图
			var formatData = [];
			$.each(data,function(k,v) {
				formatData[k] = [v.url,parseInt(v.num)];
			});
			self.drawPie('visitorto_ratio', '受访', formatData);
			
		});	
		
	}
	
	//受访统计列表
	this.fillVisitortoTable = function(data) {
		$("#visitortoDataTable").DataTable().destroy();
		$("#visitortoDataTable").DataTable({
			bStateSave:true,
			data:data,
			bSort: false,
			bFilter: false,
			bInfo : false,
			bPaginate : false,
			aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[2]}
							],
			columns: [
                        { data: 'num'},
			            { data: 'url'},
			            { data: 'num'}
			        ],
	        fnCreatedRow:function(nRow, aData, iDataIndex){
				   var indexHtml = '<span class="badge badge-default  radius">'+(iDataIndex + 1)+'</span>';
				   if (iDataIndex == '0') {
					   indexHtml = '<span class="badge badge-danger radius">' + (iDataIndex + 1) + '</span>';
				   } else if (iDataIndex == '1') {
					   indexHtml = '<span class="badge badge-warning radius">' + (iDataIndex + 1) + '</span>';
				   } else if (iDataIndex == '2') {
					   indexHtml = '<span class="badge badge-success radius">' + (iDataIndex + 1) + '</span>';
				   } 
				   
				   $('td:eq(0)', nRow).html(indexHtml);			
				   
	            }
		});

	}
	
	//画出统计图
	this.drawPie = function (id,title,data) {
		$('#' + id).highcharts({
	        chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false
	        },
	        title: {
	            text: title + '统计'
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
	        series: [{
	            type: 'pie',
	            name: title + '比例',
	            data: data
	        }]
	    });
	}
	
	//竞价统计
	this.biddingStat = function() {
		self.cmd(gHttp,{controller:'Article',method:'query',isbidding:1},function(ret) {
			var data = ret.rows;
			$("#biddingDataTable").DataTable().destroy();
			$("#biddingDataTable").DataTable({
				bStateSave:true,
				data:data,
				bSort: false,
				aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]}
							],
				columns: [
                            { data: 'id' },
				            { data: 'subject' },
				            { data: 'description',render:function(value){return value.substr(0,60)+'...';}},
				            { data: 'plushtime' },
				            {
							  data : 'id',
							  render : function(id, type, row){
								  var str = '';
					              str += '<a style="text-decoration:none" onClick="gStat.openAdd(\'查看详细流量统计\',\'bidding-stat.html?id='+id+'\',\'700\',\'500\')" href="javascript:;" title="查看流量统计"><i class="Hui-iconfont">&#xe61e;</i></a>';
						    	  return str;
							  }
							 }
				        ]
			});
		});
	}
	
	//初始化竞价统计
	this.initBiddingStat = function() {
		$(function(){
			$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
			
			var para = self.parseUrl(window.location.href);
			var id = para.id;
			
			var para = {controller:'StatisticsLog',method:'trend',dir:'Article',id:id};
			self.fillData(para);
			
			$("#bidding_qry").on('click', function() {
				var start_time = $("#start_time").val();
				var end_time = $("#end_time").val();
				var para = {controller:'StatisticsLog',
						method:'trend',
						dir:'Article',
						star:start_time,
						start_time:start_time,
						end:end_time,
						end_time:end_time,
						id:id
					};
				self.fillData(para);
			});
			
		});
	}
	
	//填充数据
	this.fillData = function(para) {
		self.cmd(gHttp,para,function(ret) {
			var data = ret.data;
			
			//画出统计图
			self.drawLine('bidding_ip', 'IP', data.ip, data.key);
			
			self.drawLine('bidding_uv', '独立访客', data.uv, data.key);
			
			self.drawLine('bidding_pv', '浏览次数', data.pv, data.key);
			
		});
	}
	
	//画出曲线统计图
	this.drawLine = function(id, title, data, x) {
		$('#' + id).highcharts({
	        chart: {
	            zoomType: 'x',
	            spacingRight: 20
	        },
	        title: {
	            text: title
	        },
	        subtitle: {
	            text: document.ontouchstart === undefined ?
	                'Click and drag in the plot area to zoom in' :
	                'Pinch the chart to zoom in'
	        },
	        xAxis: {
	        	type: 'datetime',
            	categories:x,
                dateTimeLabelFormats: {
                	day: '%Y-%m-%d',
                	month: '%Y-%m-%d',
                	year: '%Y-%m-%d'
                },
                title: {
                    text: '日期'
                }
	        },
	        yAxis: {
	        	title: { text: '访问流量' }, 
				labels: { formatter: function() { return this.value } }
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

	        series: [{
	            type: 'area',
	            name: title,
	            data: data
	        }]
	    });
	}
}
