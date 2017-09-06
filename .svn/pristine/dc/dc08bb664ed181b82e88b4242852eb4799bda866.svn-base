/**
 * 医院环境
 * */
var oTable = null;
function Download() {
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
			self.zipup();
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
		/*var subject=$('#subject').val();
		console.log(subject);*/
		$("#dataTable").grid({
			para:{controller:'Download',method:'query'},
			aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
							],
			field : [
			            {
			            	data : 'id',
			            	render : function (id, type, row) {
			            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
			            	}
			            },
                        { data: 'id' },
			            { data: 'name' },
			            { data: 'plushtime' },
			            { data: 'isshow' ,
			            	render: function(id, type, row){
				            	  var span = '';
				            	  if(row.isshow == 0){
				            		  span += '<span class="badge badge-success radius">显示</span>';
				            	  }else{
				            		  span += '<span class="badge badge-default radius">不显示</span>'; 
				            	  }
				            	  return span;
				           }
			            },
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" class="ml-5" onClick="gDownload.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					          str += '<a style="text-decoration:none" class="ml-5" onClick="gDownload.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						      return str;
						  }
						 }
			        ]
		});
	}
	
	// }}}
	
	//单个删除
	this.del = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Download',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Download',method:'del',id:ids});
		}
	}

	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Download',method:'add'};
		} else {
			post = {controller:'Download',method:'edit',id:id};
		}
		$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	 /**
     * 上传压缩包（文件）
     */
    this.zipup = function(){
    	var upfilezip = null;
    	var maxsize='';
        upfilezip = WebUploader.create({
    		auto: true,   //选择文件后自动上传
    		swf:'lib/webuploader/0.1.5/Uploader.swf',
    		server: '/controller/?controller=Download&method=fileupload',  //文件接收器
    		pick: {
    			id: '#picker',  //选择文件按钮
    			innerHTML: '<i class="Hui-iconfont">&#xe600;</i> 添加文件',
    			multiple: false
    		},
    		fileVal: 'Filedata',   //设置文件上传域的name
    		fileSingleSizeLimit:maxsize*1024*1024,   //检验单个文件最大值
    		resize:false,
    		accept: {
				title: '数据包',
				extensions: 'zip,xml,xmls,doc',
				mimeTypes: 'application/*'
			}
    	});
        $("#picker").unbind('click').bind('click',function(){
			self.uploadZip(upfilezip);
		});
    }
    
    this.uploadZip = function(upfilezip) {
		// 文件开始上传提示消息（只显示一次）
        upfilezip.on( 'startUpload', function() {			
        	layer.msg('正在努力上传，请等待...', {icon: 16, time: 30000});
		});
        //文件上传过程实时进度
		upfilezip.on( 'uploadProgress', function( file, percentage ) {			
			//console.log(percentage);
		});
		upfilezip.on( 'uploadError', function( file) {
			layer.alert('当前网络状况不佳，上传失败，请重试',{icon:2}); 
	    });
	    upfilezip.on( 'uploadComplete', function( file ) {
	       // layer.msg('安装包上传成功!');
	    });
		// 文件上传成功回调函数   
		upfilezip.on( 'uploadSuccess', function( file, response ) {		
	        //layer.msg('数据包上传成功!');				
			if(response.statu){
//				self.cmd(gHttp,{controller : 'Download', method : 'save', name : response.data.name}, function(ret){ //将文件信息存入数据库
//		    		if(ret.statu != true){
//		    			parent.layer.msg('文件同步失败！',{icon:2});
//		    		}
				 var filename = encodeURI(response.data);
		    		self.openEditWID('添加文件', 'detail.html?name=' + filename +'&type=upload','400','300');
			}else{
				layer.msg('上传失败!');
			}
	    });	    
	    // 文件大小
		upfilezip.on( 'error', function(type) {
			 if (type=="Q_TYPE_DENIED"){
		        layer.alert('请上传正确的数据包，数据包必须是zip格式',{icon:2});
		     }else if(type=="F_EXCEED_SIZE"){
		    	 layer.alert('上传文件大小超过了PHP的限制：'+maxsize,{icon:2});
	        }

			});
	}
    
    /**
     * 进入编辑页
     */
    this.edit = function(id){
    	self.openEditWID('编辑文件', 'detail.html?id=' + id,'400','300');
    }
    
    /**
     * 编辑信息
     */
    this.initEdit = function(){
		$(function(){
			//self.getImgSize('newssize');
			//获取参数
			var para = self.parseUrl(window.location.href);
			console.log(window.location.href);
			if(para.id == undefined){
				para.name = decodeURI(para.name);
				self.cmd(gHttp,{controller : 'Download', method : 'edit', name:para.name, types:para.type}, function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						$('#lastname').val('template.tmp');
					}else{
						$('#message').message(result1.msg);
					}
				});
			}else{
				self.cmd(gHttp,{controller : 'Download', method : 'edit', id: para.id}, function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);
						$('#lastname').val(result1.data.name);
					}else{
						$('#message').message(result1.msg);
					}
				});
			}
			
			self.onloadCss();
			//保存
			$('#save').click(function(){
				self.save();
			});
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			
		});
    }
    
  //保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Download',method:'save'};
		} else {
			post = {controller:'Download',method:'save',id:id};
		}
		$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon:1});	
				layer_close();
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
			return false;
		});
		
		$('#formEdit').submit();
	}
    
	
}
