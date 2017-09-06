/**
 * Stat全站流量统计
 * */
function Stat() {
	BaseFunc.call(this);
	var self = this;
	// {{{ function initSiteTraffic()
	
	/**
	 * 初始化综合统计列表
	 * */
	this.initSiteTraffic = function() {
		$(function(){
			$(".am-tab-panel li").click(function(){
				var index = $(this).index();
				window.open('flowlist.html?type=' + index ,'_self');
			});
		});
	}
	
    // }}}
    // {{{ function stat()
	
	/**
	 * 统计
	 * */
	this.stat = function() {
		$(function(){
			initTimeMonth('start_time', 'end_time');
			
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
						$("#start_time").val(str);
						$('#dataTable').find('tbody').empty();
						$('.dropload-down').remove();
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
			
	        self.statData();
		});
		
	}
	
	// }}}
	this.statData = function() {
		//获取参数
		var para = self.parseUrl(window.location.href);
        var type = para.type;
        $("#container, #container2, #dataTable").hide();
	    switch(type) {
		    case '0': //综合统计
		    	self.fillDataTable();
			    break;
		    case '1': //流量趋势
		    	self.iptrendStat();
		    	break;
		    case '2': //访客分析
		    	self.sync = true;
	            self.visitorsStat({controller:'StatisticsLog',method:'distributed'});
	            //新老访客时间曲线
	            self.visitorsLineStat({controller:'StatisticsLog',method:'lineDistributed'});
	            self.sync = false;
		    	break;
		    case '3': //来源统计
		    	self.visitorStat();
		    	break;
		    case '4': //受访统计
		    	self.visitortoStat();
		    	break;
		    case '5': //竞价统计
		    	self.biddingStat();
		    	break;
		    default:
		    	break;
		}
		
	}
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function(url) {
		$(" #dataTable").show();
		var start_time = $('#start_time').val();
		var end_time = $('#end_time').val();
		var page = 0;
		var header='<tr>';
		header += '<th>来源IP</th>';
		header += '<th>访问时间</th>';			
		header += '<th>访客标识</th>';
		header += '<th>来源链接</th>';
		header += '<th>受访链接</th>';
		header += '</tr>';
		$('#dataTable').find('thead').html(header);
		/*分页方法
			self.cmd(gHttp,url,function(ret) {
				var data = ret.rows;
				var total = ret.ttl;
				//console.log(data);
				var tbody='';
				
				$.each(data,function(i,v){
					tbody += '<tr class="am-primary">';
					tbody += '<td>'+v.ip+'</td>';
					tbody += '<td>'+v.visittime+'</td>';
					tbody += '<td>'+v.sessionid+'</td>';
					tbody += '<td>'+v.fromurl+'</td>';
					tbody += '<td>'+v.url+'</td>';
					tbody += '</tr>';
				});
				$('#dataTable').find('tbody').html(tbody);
				$("#total").html(total);
				$("#dataTable").DataTable().destroy();
				$("#dataTable").DataTable({
					bStateSave:true,
					data:data,
					bSort: false,
					filter: false,
					columns: [
					            { data: 'ip' },
					            { data: 'visittime'},
					            { data: 'sessionid'},
					            { data: 'fromurl'},
					            { data: 'url'}
					        ]
				});
		   });
		*/
		//上拉加载
			$('#dataTable').dropload({
			    scrollArea : window,
			    loadDownFn : function(me){
			    	page ++;
			    	var start_time = $('#start_time').val();
					var end_time = $('#end_time').val();
					if (url == undefined) {
						url = {controller:'StatisticsLog',method:'query',start_time:start_time,end_time:end_time,page:page,size:15};
					}
			    	self.cmd(gHttp,url,function(ret) {
			    		var data = ret.rows;
						var total = ret.ttl;
						var tbody='';
						$.each(data,function(i,v){
							tbody += '<tr class="am-primary">';
							tbody += '<td>'+v.ip+'</td>';
							tbody += '<td>'+v.visittime+'</td>';
							tbody += '<td>'+v.sessionid+'</td>';
							tbody += '<td>'+v.fromurl+'</td>';
							tbody += '<td>'+v.url+'</td>';
							tbody += '</tr>';
						});
						if(page >= Math.ceil(total/15)){
                            // 锁定
                            me.lock();
                            // 无数据
                            me.noData();
                            me.resetload();
                        }
						setTimeout(function(){
	                        $('#lists').append(tbody);
	                        // 每次数据加载完，必须重置
	                        me.resetload();
	                    },1000);
			    	});
		        }
			});	
		}
		
	
	// }}}

	//流量统计
	this.iptrendStat = function() {
		$('#container').show();
		var start = $('#start_time').val();
		var end = $('#end_time').val();
		var para = {controller:'StatisticsLog',method:'trend',star:start,end:end};
		self.cmd(gHttp,para,function(result1){
			if(result1.statu){	
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
		$('#container2').show();
		var start = $('#start_time').val();
		var end = $('#end_time').val();
		para['star'] = start;
		para['end'] = end;
		self.cmd(gHttp,para,function(result1){
			if(result1.statu){
				$('#container2').highcharts({
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
    	$("#container").show();
    	var start = $('#start_time').val();
		var end = $('#end_time').val();
		para['star'] = start;
		para['end'] = end;
    	self.cmd(gHttp,para,function(result1){
			if(result1.statu){
		    	$('#container').highcharts({
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
		$("#container").show();
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
			self.drawPie('container', '来源', formatData);
			
		});	
			
	}
	
	//来源统计列表
	this.fillVisitorTable = function(data) {
		$("#dataTable").show();
		var header='<tr>';
		header += '<th>排序</th>';
		header += '<th>来源</th>';			
		header += '<th>来访次数</th>';
		header += '</tr>';
		$('#dataTable').find('thead').html(header);
		$("#dataTable").DataTable().destroy();
		$("#dataTable").DataTable({
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
		$("#container").show();
		self.cmd(gHttp,{controller:'StatisticsLog',method:'selTo'},function(ret) {
			var data = ret.data;
			/*
			$.each(data,function(k,v) {
				v.url = self.formatUrl(v.url);
			});
			*/
			
			//填充表格
			self.fillVisitortoTable(data);
			
			//画出统计图
			var formatData = [];
			$.each(data,function(k,v) {
				formatData[k] = [v.url,parseInt(v.num)];
			});
			self.drawPie('container', '受访', formatData);
			
		});	
		
	}
	
	//受访统计列表
	this.fillVisitortoTable = function(data) {
		$("#dataTable").show();
		var header='<tr>';
		header += '<th>排序</th>';
		header += '<th>受访域</th>';			
		header += '<th>受访次数</th>';
		header += '</tr>';
		$('#dataTable').find('thead').html(header);
		$("#dataTable").DataTable().destroy();
		$("#dataTable").DataTable({
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
		$('#dataTable').show();
		var page = 0;
		var header='<tr>';
		header += '<th>文章标题</th>';
		header += '<th>简介</th>';			
		header += '<th>发布日期</th>';
		header += '</tr>';
		$('#dataTable').find('thead').html(header);
		
		//上拉加载
		$('#dataTable').dropload({
		    scrollArea : window,
		    loadDownFn : function(me){
		    	page ++;
		    	var start_time = $('#start_time').val();
				var end_time = $('#end_time').val();
		    	url = {controller:'Article',method:'query',start_time:start_time,end_time:end_time,page:page,size:15,isbidding:1};
		    	self.cmd(gHttp,url,function(ret) {
		    		var data = ret.rows;
					var total = ret.ttl;
					var tbody='';
					$.each(data,function(i,v){
						var descript = v.description;
						descript = descript.substr(0,60)+'...';
						tbody += '<tr class="am-primary">';
						tbody += '<td>'+v.subject+'</td>';
						tbody += '<td>'+descript+'</td>';
						tbody += '<td>'+v.plushtime+'</td>';
						tbody += '</tr>';
					});
					if(page >= Math.ceil(total/15)){
                        // 锁定
                        me.lock();
                        // 无数据
                        me.noData();
                        me.resetload();
                    }
					setTimeout(function(){
                        $('#lists').append(tbody);
                        // 每次数据加载完，必须重置
                        me.resetload();
                    },1000);
					me.resetload();
		    	});
	        }
		});	
		
		/*self.cmd(gHttp,{controller:'Article',method:'query',isbidding:1},function(ret) {
			var data = ret.rows;
			$("#dataTable").DataTable().destroy();
			$("#dataTable").DataTable({
				bStateSave:true,
				data:data,
				bSort: false,
				filter: false,
				columns: [
				            { data: 'subject' },
				            { data: 'description',render:function(value){return value.substr(0,60)+'...';}},
				            { data: 'plushtime' }
				        ]
			});
		});*/
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
	
	//获取url的相对路径
	this.formatUrl = function (url) {
	　　　　var arrUrl = url.split("//");

	　　　　var start = arrUrl[1].indexOf("/");
	　　　　var relUrl = arrUrl[1].substring(start);//stop省略，截取从start开始到结尾的所有字符

	　　　　if(relUrl.indexOf("?") != -1){
	　　　　　　relUrl = relUrl.split("?")[0];
	　　　　}
	
	     if (relUrl == '/') {
	    	 relUrl = '/index.html';
	     }
	　　　　return relUrl;
    }
}
