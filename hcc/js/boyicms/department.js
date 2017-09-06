/**
 * 医院科室设置
 * */
var tplUploader = null;
function Department() {
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
	
	/**
	 * 初始化编辑
	 * */
	this.initEdit = function() {
		$(function(){	
			
			//导航切换
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				//有id，则是编辑
				$("#id").val(para.id);				
				self.cmd(gHttp,{controller:'Department',method:'get',id:para.id},function(result1){
					if(result1.statu){
						$('#formEdit').frmFill('',result1.data);						
						editor.ready(function(){
							editor.setContent(result1.data.content);
						});						
						var tplurl = $.trim(result1.data.tplurl);
                        if(tplurl != ''){
                            $('#span_fileupload').html('已上传模版文件,模版路径：'+tplurl);
                            $('#fileupload').val(tplurl);
                            
                        }
                        
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			}
			
			$('[name=name]').change(function(){
				var me = $(this);
				var val = me.val();
				self.cmd(gHttp,{controller:'Pingyin',method:'conversion',data:val}, function(ret){
					$('#url').val(ret.data);
				});
			});
			
			self.initCheckTplDir();
			
			$('.tabBar span').click(function(){
				var tabIndex = $(this).index();
				if (tabIndex == '1') {
					var url = document.getElementById('url').value;
					if(url === '') {
			        	self.initCheckTplDir();
			        } else {
			        	self.initUploader();
			        }
				}
			});
			
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

	
	// }}}
    // {{{ function checkTplDir()
	
	/**
	 * 检查模板上传目录
	 * */
	this.initCheckTplDir = function() {
		$('.btns').html('<div id="picker" class="webuploader-pick"><i class="Hui-iconfont">&#xe626;</i>&nbsp;选择模版</div>');
		$('#picker').click(function() {
			var url = document.getElementById('url').value;
	        if(url===''){
	            layer.alert('请先输入文件保存目录!', function(index){
	            	$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
	            	layer.close(index);
	            });
	        }
		});
	}
	
	// }}}
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function() {
		$("#dataTable").grid({
			para : {controller:'Department',method:'query'},
			initSort : [[0, "asc"]],
			aoColumnDefs : [
							{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]}
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
			            { data: 'description',render:function(value){return value.substr(0,60)+'...';}},
			            { data: 'url' },
			            {
						  data : 'id',
						  render : function(id, type, row){
							  var str = '';
							  str += '<a style="text-decoration:none" target="_blank" href="/controller/?controller=ViewHtml&method=department&op=department&id='+id+'" title="预览"><i class="Hui-iconfont">&#xe695;</i></a>'; 
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gDepartment.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
				              str += '<a style="text-decoration:none" class="ml-5" onClick="gDepartment.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
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
		self.openDel(obj,{controller:'Department',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Department',method:'del',id:ids});
		}	
	}

	//动态编辑
	this.edit = function(id){
		self.openEditWID('编辑科室信息','edit.html?id=' + id,'800','600');
	}
	
	//保存
	this.save = function(){		
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Department',method:'add'};
		} else {
			post = {controller:'Department',method:'edit',id:id};
		}
		var formObj=$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
			return false;
		});
		if(!formObj.check('false','#seo_title')||!formObj.check('false','#seo_desc')){			
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","2");
		}
		if(!formObj.check('false','#name')||!formObj.check('false','#url')){			
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		}
		$('#formEdit').submit();
	}
	

	
	//删除模版
    this.filedelete = function (){
    	$('#fileupload').val('');//清空表单
        $('#a_filedelete').hide();//隐藏删除按钮
        $('#span_fileupload').html('');//清空提示
        self.initUploader();
        layer.alert('删除成功!',{icon:1});
        return false;
    }
	
    // {{{ function initUploader()
	
	/**
	 * 初始化上传插件
	 * */
	this.initUploader = function() {
		$('.btns').html('<div id="picker"></div>');	
		tplUploader = null;	
		tplUploader = WebUploader.create({
			auto:true,
			swf:'/hcc/lib/webuploader/0.1.5/Uploader.swf',
			pick:{id: '#picker',innerHTML : '<i class="Hui-iconfont">&#xe626;</i>&nbsp;选择模版'},
			fileVal: 'Filedata',
			resize:false,
			accept: {
				title: '模版文件',
				extensions: 'htpl',
				mimeTypes: 'application/htpl'
			}
		});
		
		$("#picker").unbind('click').bind('click',function(){
			var url = document.getElementById('url').value;
	        var fileupload = document.getElementById('fileupload').value;
	        self.uploadFile(url, fileupload);
		});
	}
	
	// }}}
    // {{{ function uploadFile()
	
	/**
	 * 上传模版
	 * */
	this.uploadFile = function(url, fileupload) {
        tplUploader.option('server','/controller/?controller=Upload&method=uploadHtpl&flag=department&fileurl='+url+"&fileupload="+fileupload);        
		
		
		// 文件上传过程中创建进度条实时显示。
		tplUploader.on( 'uploadSuccess', function( file, response ) {
			if (response.statu) {
				$("#fileupload").val(response.data);
				$("#span_fileupload").html('已上传模版文件,模版路径：' + response.data);
				$("#a_filedelete").show();
				$("#picker").hide();
			} else {
				layer.alert(response.msg);
			}
	    });	    
	    
		tplUploader.on( 'error', function(type) {
			 if (type=="Q_TYPE_DENIED"){
		        layer.alert("文件格式不对，请上传.htpl文件",{icon:2});
		     }
		});
	}
	
	// }}}
}
