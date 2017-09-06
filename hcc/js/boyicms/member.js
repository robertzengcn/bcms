/**
 * 积分规则
 * */

var oTable = null;
function Member() {
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
			//self.checkmemberdate();
			
			$('body').on('change keyup click','#subject,#username,#qry,#logmin,#logmax,#searchbtn',function(){
				self.fillDataTable();
			});
			$('body').on('click','#export',function(){
				self.cmd(gHttp,{controller:'Member',method:'exportdate'},function(ret){
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
				
			});
			
			$('body').on('click','#deleteall',function(){
				layer.confirm('清空数据将会清空用户积分、消费记录、中奖记录、积分日记，清空前请做好备份工作。确定要清空数据吗?', {icon: 3, title:'清空数据'}, function(index){
					self.cmd(gHttp,{controller:'Member',method:'delall'},function(ret){
						if(ret.statu){
							layer.close(index); 
							layer.msg('清空数据成功');
							self.fillDataTable();
							//self.checkmemberdate();
						}
					});	
					layer.close(index);
				}); 
			});
			
			

			
		});
	}
//加载数据表
	this.fillDataTable = function() {
		$(function(){
		$("#dataTable").grid({
			para:{controller:'Member',method:'query'},
			//datatable插件里设置列              
			field : [                   

                        { data: 'id' },
			            { data: 'username' },
			            { data: 'telephone'},
			            { data: 'totalscore' },
			            { data: 'totalcash'},
			            { data: 'ownscore'},
			            { data: 'buytime'}
						
			        ]
		});
		});
	}
	
	this.checkmemberdate=function(){
		self.cmd(gHttp,{controller:'Member',method:'checkmemberdate'},function(result3){//检查数据是否存在，导出按钮是否显示
			if(result3.statu){
				$('#export').show();
			}else{
				$('#export').hide();
			}
		});
	}
	
	this.memberscorelog=function(){
		$(function(){
			self.cmd(gHttp,{controller:'CommodityRule',method:'get_type'},function(result2){
				if(result2.statu){
					var str='<option value="">请选择</option>';
					$.each(result2.data,function(i,v){
						str+='<option value="'+v.id+'">'+v.name+'</option>';
					});
					$('#scoretype').html(str);
				}
			});
			

			//self.checkscoredate();

			self.memberscoremakeDataTable();
		
		$('body').on('change keyup click','#scoretype,#username,#qry,#logmin,#logmax,#searchbtn',function(){
			self.memberscoremakeDataTable();
		});
		
		$('body').on('click','#delbatch',function(){
			self.delmemscoreBatch();
		});
		
		$('body').on('click','#exportdate',function(){
			self.cmd(gHttp,{controller:'Member',method:'exportmemberscoredate'},function(ret){
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
		});
		
		});
	}
	
	this.memberscoremakeDataTable=function(){
		//self.checkscoredate();
		$("#dataTable").grid({
			para:{controller:'Member',method:'get_memberscorelog'},
			//datatable插件里设置列  
            
			field : [
                    
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	},			            	
			            	orderable:false
			            },
                        { data: 'id' },
			            { data: 'username' },
			            { data: 'telephone'},
			            { data: 'name' },
			            { data: 'score'},
			            { data: 'date'},
			            
						
			        ]
		});
	}
	
	this.delmemscoreBatch = function(obj) {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			self.openDel(obj,{controller:'Member',method:'delmemberscorelog',id:ids});
		}
		
	}
	
	this.checkscoredate=function(){
		self.cmd(gHttp,{controller:'Member',method:'checkscoredate'},function(result3){//检查数据是否存在，导出按钮是否显示
			if(result3.statu){
				$('#exportdate').show();
			}else{
				$('#exportdate').hide();
			}
		});
	}
	this.ininlog=function(){
		$(function () {
		self.cmd(gHttp,{controller:'Member',method:'getlog'},function(result1){
			if(result1.statu){
				
				self.makehighcharts(result1.data);
				
			}else{
				layer.alert('没有用户数据无法统计',{icon:2}); 	
			}
		});
		});
	}
	
	this.makehighcharts=function(data){//初始化highchart视图表
	    $('#container').highcharts({
	        chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false
	        },
	        title: {
	            text: '用户积分日志统计'
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
	            name: 'Browser share',
	            data: data
	        }]
	    });
		
	}

}