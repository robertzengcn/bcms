/**
 * 用户帮助中心-系统日志
 * */
function Log() {
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
			
			//查询
			$("#qry").click(function(){
				self.fillDataTable();
			});
		});
	}
	
	// }}}
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function() {
		$("#dataTable").grid({
			para:{controller:'WorkerLogHistory',method:'query'},
			initSort : [[4, "desc"]],
			field : [
                     { data: 'id' },
			            { data: 'group',render : function(value,type,row){return value==1?'管理员':'工作人员';}},
			            { data: 'op' },
			            { data: 'name' },
			            { data: 'logtime' }
			        ]
		});
	}
	
	// }}}
	
	//单个删除
	this.del = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'WorkerLogHistory',method:'del',id:id});
	}
	
	//清空日志
	this.clearSys = function() {
		self.cmd(gHttp,{controller:'WorkerLogHistory',method:'clearSys'},function(result1){
			if(result1.statu){
				layer.alert('清空成功!',function(index){
					self.fillDataTable();
					layer.close(index);
				});
			}else{
				layer.alert(result1.msg);
			}
		});
	}
	
	//开启
	this.openSys = function(){
		self.cmd(gHttp,{controller:'WorkerLogHistory',method:'openSys'},function(result1){
			layer.alert(result1.msg,function(index){
				self.fillDataTable();
				layer.close(index);
			});
		});
	}
	
	//关闭
	this.closeSys = function(){
		self.cmd(gHttp,{controller:'WorkerLogHistory',method:'closeSys'},function(result1){
			layer.alert(result1.msg,function(index){
				self.fillDataTable();
				layer.close(index);
			});
		});
	}

	//导出csv
	this.exportCSV = function(){
		var start_time = $('#start_time').val();
		var end_time = $('#end_time').val();
		self.cmd(gHttp,{controller:'WorkerLogHistory',method:'csvSys',start_time:start_time,end_time:end_time},function(result){
			if (result.statu) {
				window.open( result.data );
			} else {
				layer.alert(result.msg);
			}
		});
	}

}
