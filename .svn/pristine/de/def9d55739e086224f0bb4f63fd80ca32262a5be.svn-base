/**
 * 数据批量替换
 * */

function DataReplace() {
	BaseFunc.call(this);
	var self = this;
	
	this.first = '';
	
	// {{{ function init()
	
	/**
	 * 初始化
	 * */
	this.init = function() {
		$(function(){
            //加载数据库
			self.getData();
			
			//加载数据表
			self.getTable();
			
			//切换数据表，加载详细字段
			$("#ab_table").change(function(){
				var table = $(this).val();
				self.getField(table);
			});
			
			//保存
			$('#save').click(function(){
				self.save();
			});
			
		});
	}

	// }}}
	// {{{ function getData()
	
	/**
	 * 获取数据库信息
	 * */
	this.getData = function () {
		self.cmd(gHttp,{controller:'Library',method:'get_data'},function(ret){
			if( ret.statu ){
				$("#mysql_name").html(ret.data);
				$("#ab_data").val( ret.data );
			}else{
				$("#ab_data").val( '' );
			}
		});
	}
	
	// }}}
	// {{{ function getTable()
	
	/**
	 * 获取数据表
	 * */
	this.getTable = function() {
		self.cmd(gHttp, {controller:'Library',method:'get_table'},function(ret){
			self.first = ret.data.first;
			$("#ab_table").html( ret.data.list );
			self.getField( self.first );
		});
	}
	
	// }}}
	// {{{ function getField()
	
	/**
	 * 获取详细字段
	 * */
	this.getField = function(table) {
		self.cmd(gHttp, {controller:'Library',method:'get_field',table:table},function(ret){
			$("#ab_field").empty().html( ret.data );
		});
	}
	
	// }}}
	// {{{ function save()
	
	/**
	 * 保存
	 */
	this.save = function(){
		var ab_table   = $("#ab_table").val();
		var ab_field   = $("#ab_field").val();
		var ab_search  = $("#ab_search").val();
		var ab_replace = $("#ab_replace").val();
		if( ab_search == '' || ab_replace == '' ){
			layer.alert('请输入需要查找的值与需要被替换的值.');return false;
		}
		
		self.cmd(gHttp,{controller:'Library',method:'replace',ab_table:ab_table,ab_field:ab_field,ab_search:ab_search,ab_replace:ab_replace},function(ret){
			layer.alert('替换成功，本次成功替换数据：共' + ret.data+'条',function(){
				layer_close();
			});
		});
		
	}
	
	// }}}
}

