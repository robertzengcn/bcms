/**
 * 新增患者
 * */
function AddPatient() {
	BaseFunc.call(this);
	var self = this;
	
	// {{{ function init()
	
	/**
	 * 初始化页面
	 * */
	this.init = function() {
		$(function(){
			//获取参数
			var para = self.parseUrl(window.location.href);

			var id = para.id;
			var code = para.code;
			var patient_id = para.patient_id;
			var case_id=para.case_id;
			var isFirst = true;
			
			//病历号
			if(code != undefined && code != '') {
				$("#number").html(code);
				$("#case_number").val(code);
				isFirst = false;
			}
			
			self.fillSelectData(isFirst);
			
			//如果开启了积分规则，则显示积分规则
			self.showScoreRule();
			
			//新增患者
			if (patient_id == undefined && patient_id == '') {
				//初始化出生日期
				$('#birthday').val(self.getToday());
				$("#age").val(0);
				$('#source').val('0');
				
				
			} else {
				//老客户新增就诊，加载数据
				$("#before_left_money").show(); //显示上次余额
				self.fillUserInfoById(patient_id);
				
				//加载诊疗报告单数据
				
			}
			
			//生成电子识别码图片
			var case_number_img = './barcode/code.php?codebar=BCGcode39&text=' + $("#case_number").val();
			$("#case_number_img").attr('src', case_number_img);
			$("#number").html($("#case_number").val());
			
			//初始化就诊时间
			$('#visit_time').val(self.getToday());
			
			//初始化就诊时间段
			$("input:radio[name='visit_time_field'][value='1']").attr('checked', true);
			
			//事件注册
			$('#age').keyup(function(){								 
				var age = $('#age').val();
				var birthday = self.getBirthdayFromAge(age);
				$('#birthday').val(birthday);
			});
			
			$('#source').change(function(){
				var id = $(this).val();
				var text=$(this).find('option:selected').text();
				if (id == 0) {
					$("div[id^='source_']").hide();
				} else if (id == 1||text.indexOf('朋友')>-1||text.indexOf('推荐')>-1) {
					$("div[id^='source_recommend']").show();
					$("#sourceDetail").hide();
				} else {
					$("div[id^='source_recommend']").hide();
					$("#sourceDetail").show();
				}
			});
			$('input[name="is_finished"]').click(function(){
				$(this).attr('checked',true);
				if($(this).val()==1){						
						$("div.falsediv").hide();
						$("div.successdiv").show();						
						$('div.tabBar span').eq(2).show();
						$('div.tabCon').eq(2).hide();
					}
					else{
						$("div.falsediv").show();
						$("div.successdiv").hide();
						$('#real_price').val('');
						$('#current_price').val('');
						$('div.tabCon').eq(2).hide();
						$('div.tabBar span').eq(2).hide();						
						}
			});
			
			$('#real_price').keyup(function(){	
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $('#current_price').val() == '' ? 0 : Number($('#current_price').val());
				var real_price = $(this).val() == '' ? 0 : Number($(this).val());				
				var balance = Number((left_money + real_price) - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
			}).blur(function(){	
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $('#current_price').val() == '' ? 0 : Number($('#current_price').val());
				var real_price = $(this).val() == '' ? 0 : Number($(this).val());				
				var balance = Number((left_money + real_price) - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
			});
			
			$('#current_price').keyup(function(){
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $(this).val() == '' ? 0 : Number($(this).val());
				var real_price = $('#real_price').val() == '' ? 0 : Number($('#real_price').val());
				var balance = Number((left_money + real_price) - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
				
				var score = Number($("#score").val());
				$("#span_score_get").html(current_price*score);
				
			}).blur(function(){
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $(this).val() == '' ? 0 : Number($(this).val());
				var real_price = $('#real_price').val() == '' ? 0 : Number($('#real_price').val());
				var balance = Number((left_money + real_price) - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
				
				var score = Number($("#score").val());
				$("#span_score_get").html(current_price*score);
				
			});
			
	        
	        $('#is_finished').change(function(){
	        	if ($('#is_finished').val() == '1') {
	        		$("li[id^='is_finished']").show();
	        	} else {
	        		$("li[id^='is_finished']").hide();
	        	}
			});  
			
			$('#save').click(function(){				
				var data = {controller:'Patient',method:'savePatient'};
				$(".hidimg").remove();
				
				var i=0;
				var checknum=$('div.checklistdiv').length;
				$(".checkimgs").each(function(){//取上传的化验单图片地址					
					var imgurl=$(this).attr('src');						
					if(imgurl!=""&&imgurl.indexOf("thumbnail_auto")==-1){						
						i++;
						var chid=$(this).attr('id');						
						var strs= new Array();
						strs=chid.split("_");						
						var checkval=$(this).attr('src');	
						$('#formEdit').append('<input type="hidden" value="'+checkval+'" class="hidimg" name="checkimg['+strs[1]+']">');						
					}													
				});
				if(i==0&&checknum!=0){						
					parent.layer.msg('添加的检查报告数据不完整，请补充完整，若不需要报告请点击报告单右上的关闭按钮',{icon:2});
					$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
					jQuery('html,body').animate({scrollTop: jQuery("#checkthumbnaillist").offset().top-50}, 300); 
					return false;
				}
				
				//检查部分字段
				if ($('#is_finished').val() == '1') {
					if (ids == '') {
						layer.alert('请选择检查项目',{icon:2});
						return false;
					}
				}
				
				var formObj = $('#formEdit').checkAndSubmit('save', data,function(result1){					
					if(result1.statu){
						//父窗口刷新
						parent.gPatient.fillDiagnoseList();
						var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
						parent.layer.close(index);
					}else{
						parent.layer.alert(result1.msg,{icon:2});
					}
				});				
								
				
				formObj.unignore('#source,#recommend_name,#recommend_tel');
				if ($("#source").val() == '1') {
					//推荐，详细不验证
					formObj.ignore('#source');
				} else {
					//其它，推荐人和电话不验证
					formObj.ignore('#recommend_name,#recommend_tel');
				}
				
				formObj.unignore('#reason, #departmentSel, #disease_type, #real_price, #current_price');
				var is_finished = $('input[name="is_finished"]:checked').val();
				if (is_finished == '1') { //成交，不需要写原因
					formObj.ignore('#reason');
					if(!formObj.check('false','#current_price')||!formObj.check('false','#real_price')){					
						$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","2");					
					}
					if(!formObj.check('false','#receptionist_id')||!formObj.check('false','#doctor_id')||!formObj.check('false','#departmentSel')||!formObj.check('false','#disease_type')){						
						$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");						
					}					
					
				} else {
					//未成交，不需要科室，病症,金额
					formObj.ignore('#departmentSel, #disease_type, #real_price, #current_price');					
				}
				if($('#pid').val() == '0'){						
					if(!formObj.check('false','#username')||!formObj.check('false','#age')||!formObj.check('false','#source')){						
						$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");							
					}						
				}
				formObj.ignore('#check');
				$('#formEdit').submit();
			});
			
			self.onloadCss();
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		});
		
	}
	
	// }}}
	// {{{
	
	/**
	 * 初始化新增复诊
	 * */
	this.initRediagnosis = function(){
		$(function(){
			//获取参数
			var para = self.parseUrl(window.location.href);
			
			//客户复诊
			var type = para.type;
			var id = para.id;
			var code = para.code;
			var patient_id = para.patient_id;
			var case_id=para.case_id;
			var pid = para.pid;
			var isFirst = true;
			
			//病历号
			if(code != undefined && code != '') {
				$("#number").html(code);
				$("#case_number").val(code);
				isFirst = false;
			}
			
			//添加复诊	
			isFirst = false;				
			$("#case_id").val(id);
			$("#type").val(2);
			$("#pid").val(pid);
			$("#patient_id").val(patient_id);	
			$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			
			self.fillSelectData(isFirst);
			self.onloadCss();
			//显示积分规则
			self.showScoreRule();
			
			//老客户新增就诊，加载数据
			$("#before_left_money").show(); //显示上次余额
			self.fillUserInfoById(patient_id);
			
			//加载诊疗报告单数据
			
			//生成电子识别码图片
			var case_number_img = './barcode/code.php?codebar=BCGcode39&text=' + $("#case_number").val();
			$("#case_number_img").attr('src', case_number_img);
			
			//初始化就诊时间
			$('#visit_time').val(self.getToday());
			
			//初始化就诊时间段
			$("input:radio[name='visit_time_field'][value='1']").attr('checked', true);
			
			//事件注册
			$('#age').keyup(function(){								 
				var age = $('#age').val();
				var birthday = self.getBirthdayFromAge(age);
				$('#birthday').val(birthday);
			});
			
			$('#source').change(function(){
				var id = $(this).val();
				var text=$(this).find('option:selected').text();
				if (id == 0) {
					$("div[id^='source_']").hide();
				} else if (id == 1||text.indexOf('朋友')>-1||text.indexOf('推荐')>-1) {
					$("div[id^='source_recommend']").show();
					$("#sourceDetail").hide();
				} else {
					$("div[id^='source_recommend']").hide();
					$("#sourceDetail").show();
				}
			});
			$('input[name="is_finished"]').click(function(){
				$(this).attr('checked',true);
				if($(this).val()==1){						
						$("div.falsediv").hide();
						$("div.successdiv").show();						
						$('div.tabBar span').eq(2).show();
						$('div.tabCon').eq(2).hide();
					}
					else{
						$("div.falsediv").show();
						$("div.successdiv").hide();
						$('#real_price').val('');
						$('#current_price').val('');
						$('div.tabCon').eq(2).hide();
						$('div.tabBar span').eq(2).hide();						
						}
			});
			$('#real_price').keyup(function(){				
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $('#current_price').val() == '' ? 0 : Number($('#current_price').val());
				var real_price = $(this).val() == '' ? 0 : Number($(this).val());				
				var balance = Number((left_money + real_price) - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
			}).blur(function(){				
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $('#current_price').val() == '' ? 0 : Number($('#current_price').val());
				var real_price = $(this).val() == '' ? 0 : Number($(this).val());				
				var balance = Number((left_money + real_price) - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
			});
			
			$('#current_price').keyup(function(){
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $(this).val() == '' ? 0 : Number($(this).val());
				var real_price = $('#real_price').val() == '' ? 0 : Number($('#real_price').val());
				var balance = Number((left_money + real_price) - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
				
				var score = Number($("#score").val());
				$("#span_score_get").html(current_price*score);
				
			}).blur(function(){
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $(this).val() == '' ? 0 : Number($(this).val());
				var real_price = $('#real_price').val() == '' ? 0 : Number($('#real_price').val());
				var balance = Number((left_money + real_price) - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
				
				var score = Number($("#score").val());
				$("#span_score_get").html(current_price*score);
				
			});			
			
	        
	        $('#is_finished').change(function(){
	        	if ($('#is_finished').val() == '1') {
	        		$("li[id^='is_finished']").show();
	        	} else {
	        		$("li[id^='is_finished']").hide();
	        	}
			});  
			
			$('#save').click(function(){
				//复诊加一个参数，避免添加时间刷新
				var data = {controller:'Patient',method:'addReDiagnosis',vtype:1};
				$(".hidimg").remove();
				
				var i=0;
				var checknum=$('div.checklistdiv').length;
				$(".checkimgs").each(function(){//取上传的化验单图片地址					
					var imgurl=$(this).attr('src');						
					if(imgurl!=""&&imgurl.indexOf("thumbnail_auto")==-1){						
						i++;
						var chid=$(this).attr('id');						
						var strs= new Array();
						strs=chid.split("_");						
						var checkval=$(this).attr('src');	
						$('#formEdit').append('<input type="hidden" value="'+checkval+'" class="hidimg" name="checkimg['+strs[1]+']">');						
					}													
				});
				if(i==0&&checknum!=0){						
					parent.layer.msg('添加的检查报告数据不完整，请补充完整，若不需要报告请点击报告单右上的关闭按钮',{icon:2});
					$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
					jQuery('html,body').animate({scrollTop: jQuery("#checkthumbnaillist").offset().top-50}, 300); 
					return false;
				}
				
				//检查部分字段
				if ($('#is_finished').val() == '1') {
					if (ids == '') {
						layer.alert('请选择检查项目',{icon:2});
						return false;
					}
				}
				
				var formObj = $('#formEdit').checkAndSubmit('save', data,function(result1){					
					if(result1.statu){
						if ($('#pid').val() != '0') { //复诊页面
							var topdocument=$(window.parent.document).find("#sosobox");	
							var bData=$(topdocument).find('#record_start').val();
							var eDate=$(topdocument).find('#record_end').val();							
							parent.gAddPatient.returnDiagnosisList(id,code,pid,bData,eDate);
							//刷新总余额
							parent.gAddPatient.RefreshMoney(patient_id);
							$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","3");
						} else {							
							//父窗口刷新
							parent.gPatient.fillDiagnoseList();
						}
						var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
						parent.layer.close(index);
					}else{
						parent.layer.alert(result1.msg,{icon:2});
					}
				});				
								
				
				formObj.unignore('#source,#recommend_name,#recommend_tel');
				if ($("#source").val() == '1') {
					//推荐，详细不验证
					formObj.ignore('#source');
				} else {
					//其它，推荐人和电话不验证
					formObj.ignore('#recommend_name,#recommend_tel');
				}
				
				formObj.unignore('#reason, #departmentSel, #disease_type, #real_price, #current_price');
				var is_finished = $('input[name="is_finished"]:checked').val();
				if (is_finished == '1') { //成交，不需要写原因
					formObj.ignore('#reason');
					if(!formObj.check('false','#current_price')||!formObj.check('false','#real_price')){					
						$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");					
					}
					if(!formObj.check('false','#receptionist_id')||!formObj.check('false','#doctor_id')||!formObj.check('false','#departmentSel')||!formObj.check('false','#disease_type')){						
						$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");						
					}					
					
				} else {
					//未成交，不需要科室，病症,金额
					formObj.ignore('#departmentSel, #disease_type, #real_price, #current_price');					
				}
				if($('#pid').val() == '0'){						
					if(!formObj.check('false','#username')||!formObj.check('false','#age')||!formObj.check('false','#source')){						
						$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");							
					}						
				}
				formObj.ignore('#check');
				$('#formEdit').submit();
			});
			

			
			
			
		});
		
	}
	
	// }}}
	
	/***添加或修改复诊信息后刷新总余额***/
	this.RefreshMoney=function(id){		
		self.cmd(gHttp,{controller:'Patient',method:'getPatientById',id:id},function(ret){			
			if(ret.statu){
				$('#left_money').val(ret.data['money']);
				$('#left_money_str').html(ret.data['money']);
			}
			
		});
	}
	/**
	 * 诊疗报告单列表模块---新增报告单
	 * */
	this.addInspectionReport=function(){
		var checklength=$('.checklistdiv').length;				
		var htmls='<div class="row cl successdiv checklistdiv" id="checkllist_'+checklength+'"><label class="form-label col-2">化验单'+(checklength+1)+'：</label><div class="thumbnailbox"><img src="../../../images/boyicms/logo/thumbnail_auto.gif" flag="../../../images/boyicms/logo/thumbnail_auto.gif" width="150px" height="100px" id="img_'+checklength+'" class="checkimgs" style="float:left;"/><div class="img-btn"><span class="cancel" id="delete-thisimg">删除</span><span class="uploadimg" style="background-position: -68px -22px;" onclick="gAddPatient.uploadthisimg('+checklength+')">上传图片</span></div></div><div class="formControls col-73 ml-10"><textarea name="checkcontent['+checklength+']"  class="textarea reportbox" placeholder="若有检查，请输入医生给出的检查报告，并将检查单拍照上传..." dragonfly="true" onkeyup="textarealength(this,1000)" style="height:110px;"></textarea><p class="textarea-numberbar"><em class="textarea-length">0</em>/1000</p><div class="closebtn"><a style="font-size:22px;" title="删除“化验单'+(checklength+1)+'”"  onclick="gAddPatient.deletethisexam('+checklength+',\'\')"><i class="Hui-iconfont">&#xe60b;</i> </a></div></div></div>';
		$('#followpage').append(htmls);				
		$('#followpage').show();
		self.onloadCss();
		 
	}
	
	//删除单个检查报告记录
	this.deletethisexam=function(id,exid){
		layer.confirm('确定要删除“化验单'+(id+1)+'”吗？',{icon: 3, title:'提醒'},function(index){			
			$('#checkllist_'+id).remove();
			if(exid!=''&&exid!=undefined){
				self.cmd(gHttp,{controller:'Patient',method:'deletecheckitem',id:exid},function(ret){
					if(!ret.statu){
						parent.layer.msg('删除失败，请刷新重试',{icon:1});
					}
				});
			}
			layer.close(index);
		});		
	}
	
	//上传检查报告单图片
	this.uploadthisimg=function(id){
		self.uploadImg('上传报告单','/hcc/js/boyicms/uploadimg.html?method=uploadPic&dir=medicalreport&ipn=img_'+id,'720','420');
	}
	
	// {{{ function fillUserInfoById()	
	
	/**
	 * 填充用户基本信息
	 * */
	this.fillUserInfoById = function(patient_id) {
		layer.closeAll('tips'); 
		self.cmd(gHttp,{controller:'Patient',method:'getPatientById',id:patient_id},function(ret){
			if(ret.statu){
				var patient = ret.data;	
				$.each(patient,function(i,v) {
					if (i == 'gender') {
						$("input:radio[name='"+i+"']").each(function(){
							if($(this).val() == v) {
								$(this).attr("checked", true);
							}
						});
					} else if ( i == 'vip_level' || i == 'source') {
						$("#"+i+" option[value='"+v+"']").attr("selected", true);
						//如果不是推荐，则收起推荐人
						
						if (v != 1) {
							$("div[id^='source_recommend']").hide();
							$("#sourceDetail").show();
						}
					} else if (i == 'money') {
						$("#left_money").val(v);
						$('#left_money_str').html(v);
					} else if (i == 'birthday') {
						if (v == '') {
							$('#birthday').val(self.getToday());
							$("#age").val(0);
						}
						else{
							$('#birthday').val(v);									
						}
					} else if (i == 'age') {
						$('#'+i).val(v);
						if (v&&patient['birthday']=='') {
							var birthday = self.getBirthdayFromAge(v);
							$('#birthday').val(birthday);
						}
					}else if(i=='pic'){
						//$('#img').prep('src','upload/'+v);
						if (v != ''&&v!=0) {
							$('#img').attr('src', '/upload/' + v);
						}
						else{
							$('#img').attr('src', '../../../images/boyicms/logo/thumbnail_auto.gif');								
						}
						
					}else if (i == 'case_number') {
						$('#'+i).val(v);
						var case_number_img = './barcode/code.php?codebar=BCGcode39&text=' + v;
						$("#case_number_img").attr('src', case_number_img);
					} else if (i == 'id') {
						$('#case_id').val(v);
					}else {
						if (v == '0') {
							v = '';
						}
						$('#'+i).val(v);
					}
				});
				$("#patient_id").val(patient.id);
			}
		});
		
	}
	
	// }}}
	// {{{ function findUserInfoByName()
	
	this.showpatientcheck=function(id){//显示患者检查报告单		
		self.cmd(gHttp,{controller:'Patient',method:'getchecklist',pid:id},function(ret){			
			if(ret.statu){				
				var mohtml="";				
				$.each(ret.data,function(i,v){
					mohtml+='<div class="row cl successdiv checklistdiv" id="checkllist_'+i+'"><label class="form-label col-2">化验单'+(i+1)+'：</label><div class="thumbnailbox"><img src="'+v.pic+'" flag="../../../images/boyicms/logo/thumbnail_auto.gif" width="150px" height="100px" id="img_'+i+'" class="checkimgs" style="float:left;"/><div class="img-btn"><span class="cancel" id="delete-thisimg">删除</span><span class="uploadimg" style="background-position: -68px -22px;" onclick="gAddPatient.uploadthisimg('+i+')">上传图片</span></div></div><div class="formControls col-73 ml-10"><textarea name="checkcontent['+i+']"  class="textarea reportbox" placeholder="若有检查，请输入医生给出的检查报告，并将检查单拍照上传..." dragonfly="true" onkeyup="textarealength(this,1000)" style="height:110px;">'+v.content+'</textarea><p class="textarea-numberbar"><em class="textarea-length">0</em>/1000</p><div class="closebtn"><a style="font-size:22px;" title="删除“化验单'+(i+1)+'”"  onclick="gAddPatient.deletethisexam('+i+','+v.id+')"><i class="Hui-iconfont">&#xe60b;</i> </a></div></div></div>';					
				});	
				$('#addlistpage').html(mohtml);
			}
		});
		
		
	}
	
	/**
	 * 通过用户名查找病历号
	 * */
	this.findUserInfoByName = function(obj) {
		var request_val=obj.value;			
		var reg=new RegExp("^[\u4e00-\u9fa5]{1,}|[a-zA-Z]{1,}$"); 
		var result=reg.test(request_val);
		if(!result){
				$('div.Namecheckdiv').html('<span class="Validform_checktip Validform_wrong">请输入正确的名称</span>');
		}else{
				$('div.Namecheckdiv').html('');
				var url='';
				var str='';
				str='<table class="table table-border table-bordered table-bg table-hover table-sort">';
				str+='<thead><tr class="text-c"><th width="80">姓名</th><th width="110">电话号码</th><th width="100">病历号</th><th width="50">操作</th></tr></thead>';
				url = {controller:'Patient',method:'getAllPatients',recommend_name:request_val};
				self.cmd(gHttp,url,function(data){
					if(data['ttl']==0){
						str='没有查到该姓名相关的历史记录';						
					}
					else{						
						str+='<tbody>';
						$.each(data['rows'],function(k,v){							
							str+='<tr><td>'+v.username+'</td><td class="text-c">'+v.telphone+'</td><td class="text-c">'+v.case_number+'</td><td class="text-c">';	
							str+='<a style="text-decoration:none" onClick="gAddPatient.fillUserInfoById('+v.id+');" href="javascript:;" title="导入该患者信息"><i class="Hui-iconfont">&#xe645;</i></a></td></tr>';
						});
						str+='</tbody></table>';
					}	
						
				});
				setTimeout(function () { 
					layer.tips(str, $(obj), {
						tips: [2,'#78BA32'],
						area:['360px','auto'],	
						time:12000
					});
				
				}, 500); 
				
			}
	}
	
	// }}}
	/**
	 * 通过用户手机号查找病历号
	 * */
	this.findUserInfoBytelephone = function(obj) {
		var request_val=obj.value;
		if(request_val.length<5){
			return false;
		}else{
			var reg=new RegExp("^1[0-9]{1,}$"); 
			var result=reg.test(request_val);
			if(!result){
					$('div.Phonecheckdiv').html('<span class="Validform_checktip Validform_wrong">请输入正确的手机号</span>');
			}else{
				$('div.Phonecheckdiv').html('');
				var url='';
				var str='';
				str='<table class="table table-border table-bordered table-bg table-hover table-sort">';
				str+='<thead><tr class="text-c"><th width="80">姓名</th><th width="110">电话号码</th><th width="100">病历号</th><th width="50">操作</th></tr></thead>';
				url = {controller:'Patient',method:'getAllPatients',recommend_tel:request_val};
				self.cmd(gHttp,url,function(data){
					if(data['ttl']==0){
						str='没有查到该手机号相关的历史记录';						
					}
					else{						
						str+='<tbody>';
						$.each(data['rows'],function(k,v){							
							str+='<tr><td>'+v.username+'</td><td class="text-c">'+v.telphone+'</td><td class="text-c">'+v.case_number+'</td><td class="text-c">';	
							str+='<a style="text-decoration:none" onClick="gAddPatient.fillUserInfoById('+v.id+');" href="javascript:;" title="导入该患者信息"><i class="Hui-iconfont">&#xe645;</i></a></td></tr>';
						});
						str+='</tbody></table>';
					}	
						
				});
				setTimeout(function () { 
					layer.tips(str, $(obj), {
						tips: [2,'#78BA32'],
						area:['360px','auto'],	
						time:12000
					});
				
				}, 500); 

			}
		}
	}
	
	// }}}
	
	
	
    // {{{ function patientDetail()	
	
	
	/**
	 * 初始化详情
	 * */
	this.initPatientDetail = function(){
		//为复诊纪录和回访纪录注册事件
		$('.tabBar span').click(function(){
			var index = $(this).index();
			var case_id = $('#case_id').val();
			var patient_id = $('#patient_id').val();
			var code = $('#code').val();
			switch(index) {
				case 3://复诊纪录，通过detail_id查找子级复诊记录
					$('#subBtn').hide();
					var pid = $('#detail_id').val();
					self.returnDiagnosisList(case_id,code,pid,$('#record_start').val(),$('#record_end').val());
					break;
				case 4://回访纪录
					$('#subBtn').hide();
					var data = $('#data').val();
					self.returnVisitList(data,code,patient_id);
					break;
				default:
					$('#subBtn').show();
					break;
			}
			$('#record_seach').click(function(){
				var val1=$('#record_start').val();
				var val2=$('#record_end').val();
				var regx=/^2[0-9]{3}-[0-9]{1,2}-[0-9]{1,2}/;
				if(val1==''||val2==''){
					layer.msg('请输入您要搜索的日期',{icon:2});
				}
				else if(!regx.test(val1)||!regx.test(val2)){
					layer.msg('请输入正确的日期格式',{icon:2});
				}else{
					self.returnDiagnosisList(case_id,code,pid,val1,val2);					
				}
				
			});
		});
		
		//获取参数
		var para = self.parseUrl(window.location.href);
		var id = para.detail_id;
		var balance_static=0;
		
		if (id != undefined) {
			$("#before_left_money").show();
			self.cmd(gHttp,{controller:'Patient',method:'patientDetail',id:id},function(ret){
				if(ret.statu){
					var data = ret.data;					
					$('#case_id').val(data.case_id);
					$('#patient_id').val(data.patient_id);
					var dataStr = data.detail_id + ':' + data.username;
					$('#data').val(dataStr);
					$('#code').val(data.case_number);
					$('#number').html(data.case_number);
					
					//生成电子识别码图片
					var case_number_img = './barcode/code.php?codebar=BCGcode39&text=' + data.case_number;
					$("#case_number_img").attr('src', case_number_img);					
					
                    $.each(data,function(i,v) {
						if (i == 'gender') {
    						$("input:radio[name='"+i+"']").each(function(){
    							if($(this).val() == v) {
    								$(this).attr("checked", true);
    							}
    						});
						} else if ( i == 'source') {
							self.fillSource();
							
							$("#source").val(v);
							
							//给默认选择值后就不需要这个了
							//如果不是推荐，则收起推荐人
							if (data['recommend_name']!=''&&data['recommend_name']!=undefined) {
								$("div[id^='source_recommend']").show();
								$('input#referrer').val(data['recommend_name']+'  电话：'+data['recommend_tel']);
								$("#sourceDetail").hide();
							} else if (v=='') {
								$("div[id^='source_recommend']").hide();
								$("#sourceDetail").hide();
							} else {
								$("div[id^='source_recommend']").hide();
								$("#sourceDetail").show();
							}
						} else if ( i == 'vip_level') {
							self.fillLevels();
							$('#vip_level').val(v);
						} else if ( i == 'receptionist_id') {
							self.fillReceptionist();
							$('#receptionist_id').val(v);
						} else if ( i == 'doctor_id') {
							self.fillDoctors();
							$('#doctor_id').val(v);
						} else if ( i == 'is_finished') {
							$("input:radio[name='is_finished'][value='"+v+"']").attr("checked", true);	
								if(v==0){
									$('div.falsediv').show();
									$('div.successdiv').hide();
									$('div.tabCon').eq(2).hide();
									$('div.tabBar span').eq(2).hide();									
								}								
						} else if ( i == 'disease_type') {
							self.fillDiseases();
							$('#disease_type').val(v);
						}else if ( i == 'department') {
							self.fillDepartments();
							$('#departmentSel').val(v);
						} else if (i == 'money') {
							$("#left_money").val(v);
							$("#left_money_str").html(v);
						} else if (i == 'balance') {
							$("#balance").val(v);							
							$("#balance_str").html(v);
							balance_static=v;
						} else if (i == 'birthday') {							
							if (v == '') {
								$('#birthday').val(self.getToday());
								$("#age").val(0);
							}else{
								$('#birthday').val(v);
								}
							
						} else if (i == 'age') {
							$('#'+i).val(v);
							if (v&&data['birthday']=='') {
								var birthday = self.getBirthdayFromAge(v);
								$('#birthday').val(birthday);
							}
						} else if (i == 'visit_time') {
							$('#'+i).val(self.getTimeStr(v));
						} else if (i == 'return_time') {
							if (v != '0' && v!='') {
								$('#'+i).val(self.getTimeStr(v));
							}
						}else if (i == 'return_time_field') {
							$("input:radio[name='return_time_field'][value='"+v+"']").attr("checked", true);
						} else if (i == 'visit_time_field') {
							$("input:radio[name='visit_time_field'][value='"+v+"']").attr("checked", true);
						} else if (i == 'examine_items') { 
							var item_html = '';
							var arr = v.split(',');
							var arrNames = data['examine_items_name'];
							$.each(arr,function(k,vv){
								if (vv != "")
								    item_html += '<div class="check-box col-95" style="overflow:hidden;height:25px;line-height:25px;" info="'+arrNames[vv]+'"><input type="checkbox" id="examine_items_' + vv + '" name="examine_items[]" value="' + vv + '" checked/><label>' + arrNames[vv] + '</label></div>';
							});
							$("#span_examine_items").html(item_html);
						} else if (i == 'real_price' || i == 'current_price' || i == 'balance') {
							$('#'+i).val(v);
						} else if (i == 'pic') {
							$('#' + i).val(v);
							if (v != ''&&v!=0) {
								$('#img').attr('src', '../../../../upload/' + v);
							}
							else{
								$('#img').attr('src', '../../../images/boyicms/logo/thumbnail_auto.gif');								
							}
						} else {
							if (v == '0') {
								v = '';
							}
							
							if (i=='sourceDetail' || i=='reception_records' || i=='therapeutic' ||
								i=='advice' || i=='return_items' || i=='advise' || i=='untoward_effect' || i=='remark') {
								$('#'+i).html(v);
							} else {
								$('#'+i).val(v);
							}
						}
					});
					$("#span_examine_items").find('div.check-box').on('mouseover',function(){
						var msg=$(this).attr('info');
						layer.tips(msg, $(this), {
							tips: [3,'#78BA32'],
							time:3000
						});															   
																					   
					});
                    $("#dialog").click(function(){
                    	var formData = [];
    					formData['message'] = '';
    					var labels = [];
    					labels['message'] = '消息内容';
    					var content = _me.getFormHtml(formData, labels);
    					var firstRow = '<div class="pageFormContent">接收人：'+data.username+'&nbsp;&nbsp;&nbsp;&nbsp;发送时间：' + getToday() + '</div>';
    					content = firstRow + content;
    					_me.visitdialog('add', content, data.detail_id); //添加
                    });
				}else{
					layer.alert(ret.msg);
				}
				self.onloadCss();				
				/*显示检查报告单
				 * */				
				self.showpatientcheck(id);
				
			});
            
			//填充处方
			self.cmd(gHttp,{controller:'Patient',method:'getPrescriptionsByDetailId',id:id}, function(result) {
				if (result.statu) {
					self.fillPrescriptions(result.data);
				}
			});
			
			//事件注册
			$('#age').keyup(function(){
				var age = $('#age').val();
				var birthday = self.getBirthdayFromAge(age);
				$('#birthday').val(birthday);
			});
			
			$('#source').change(function(){
				var id = $(this).val();
				var text=$(this).find('option:selected').text();				
				if (id == 0||text.indexOf('推荐')!=-1||text.indexOf('朋友')!=-1) {
					$("div#source_recommend_name").show();
					$("div#sourceDetail").hide();
				} else if (text.indexOf('推荐')==-1) {
					$("div#source_recommend_name").hide();
					$("div#sourceDetail").show();
				} else {
					$("div#source_recommend_name").hide();
					$("div#sourceDetail").show();
				}
			});
			
			$('#real_price').keyup(function(){
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $('#current_price').val() == '' ? 0 : Number($('#current_price').val());
				var real_price = $(this).val() == '' ? 0 : Number($(this).val());
				var balance = Number(real_price - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
				/*
				if (balance < 0) {
					layer.alert('余额不足，请输入本次缴费金额');
					return false;
				}
				*/
			});
			
			$('#current_price').keyup(function(){
				var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $(this).val() == '' ? 0 : Number($(this).val());
				var real_price = $('#real_price').val() == '' ? 0 : Number($('#real_price').val());
				
				//可以欠费，故不用提示
				/*
				if (left_money == 0) {
					if ($('#real_price').val() == '') {
						layer.alert('请输入本次缴费金额');
						return false;
					}
				}
				*/				
				var balance = Number( real_price - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
				
				var score = Number($("#score").val());
				$("#span_score_get").html(current_price*score);
				/*
				if (balance < 0) {
					layer.alert('余额不足，请输入本次缴费金额');
					return false;
				}
				*/
			});
			
			$('#save').click(function(){
				$('.hidimg').remove();
				var i=0;
				var checknum=$('div.checklistdiv').length;
				$(".checkimgs").each(function(){//取上传的化验单图片地址					
					var imgurl=$(this).attr('src');						
					if(imgurl!=""&&imgurl.indexOf("thumbnail_auto")==-1){						
						i++;
						var chid=$(this).attr('id');						
						var strs= new Array();
						strs=chid.split("_");						
						var checkval=$(this).attr('src');	
						$('#formEdit').append('<input type="hidden" value="'+checkval+'" class="hidimg" name="checkimg['+strs[1]+']">');						
					}													
				});
				if(i==0&&checknum!=0){						
					parent.layer.msg('添加的检查报告数据不完整，请补充完整，若不需要报告请点击报告单右上的关闭按钮',{icon:2});
					$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
					jQuery('html,body').animate({scrollTop: jQuery("#checkthumbnaillist").offset().top-50}, 300); 
					return false;
				}
				if($('#balance').val()!=balance_static){
					layer.confirm('您修改了之前保存的收费项，更改此项会重先计算该患者所有的相关收费，是否继续？',{icon: 3, title:'提醒',btn:['确定','取消']}, function(index, layero){
						var data = {controller:'Patient',method:'savePatient',Ptype:3};
						
						if($('input#return_time').val()==''){
							data['return_time']=0;
						}
						//检查部分字段	
						

						
						var formObj = $('#formEdit').checkAndSubmit('save', data,function(result1){
							if(result1.statu){
								//父窗口刷新
								parent.gPatient.fillDiagnoseList();
								var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
								parent.layer.close(index);
							}else{
								parent.layer.alert(result1.msg,{icon:2});
							}
						});
						
						formObj.unignore('#source,#recommend_name,#recommend_tel,#reason');
						if ($("#source").val() == '1') {
							//推荐，详细不验证
							formObj.ignore('#source');
						} else {
							//其它，推荐人和电话不验证
							formObj.ignore('#recommend_name,#recommend_tel');
						}
						
						var is_finished = $('input[name="is_finished"]:checked').val();
						if (is_finished == '1') { //成交，不需要写原因
							formObj.ignore('#reason');
						}
						else{
							formObj.ignore('#real_price');
							formObj.ignore('#current_price');
							formObj.ignore('#departmentSel');
							formObj.ignore('#disease_type');
							formObj.ignore('#departmentSel');
							formObj.ignore('#disease_type');
						}
						
						formObj.ignore('#check');
						$('#formEdit').submit();				
						
						//layer.close(index);
					},function(index){					
						layer.close(index);
						return false;
					});	
					
				}
				else{
					var data = {controller:'Patient',method:'savePatient'};
					
					if($('input#return_time').val()==''){
						data['return_time']=0;
					}
					//检查部分字段				
					
					var formObj = $('#formEdit').checkAndSubmit('save', data,function(result1){
						if(result1.statu){
							//父窗口刷新
							parent.gPatient.fillDiagnoseList();
							var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
							parent.layer.close(index);
						}else{
							parent.layer.alert(result1.msg,{icon:2});
						}
					});
					
					formObj.unignore('#source,#recommend_name,#recommend_tel,#reason');
					if ($("#source").val() == '1') {
						//推荐，详细不验证
						formObj.ignore('#source');
					} else {
						//其它，推荐人和电话不验证
						formObj.ignore('#recommend_name,#recommend_tel');
					}
					
					var is_finished = $('input[name="is_finished"]:checked').val();
					if (is_finished == '1') { //成交，不需要写原因
						formObj.ignore('#reason');
					}
					else{
						formObj.ignore('#real_price');
						formObj.ignore('#current_price');
						formObj.ignore('#departmentSel');
						formObj.ignore('#disease_type');
						formObj.ignore('#departmentSel');
						formObj.ignore('#disease_type');
					}
					
					formObj.ignore('#check');
					$('#formEdit').submit();
					}
			});
			self.onloadCss();
			$('input[name="is_finished"]').click(function(){
				$(this).attr('checked',true);
				if($(this).val()==1){						
						$("div.falsediv").hide();
						$("div.successdiv").show();
						$('div.tabCon').eq(2).hide();
						$('div.tabBar span').eq(2).show();
					}
					else{                                                                                                                                                 						
						$("div.falsediv").show();
						$("div.successdiv").hide();
						$('#real_price').val('');
						$('#current_price').val('');
						$('div.tabCon').eq(2).hide();
						$('div.tabBar span').eq(2).hide();						
						}
			});			
	    }
	
	    $.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
	}//initPatientDetail over
	
	// }}}
	// {{{ function returnDiagnosisList()
	
	
	
	
	
	/**
	 * 复诊记录页面
	 * */
	this.returnDiagnosisList = function(case_id, code, pid,bData,eDate) {
		if(bData=='undefined'||bData==''){
			bData=$('#record_start').val();				
		}
		if(eDate=='undefined'||bData==''){
			eDate=$('#record_end').val();	
		}
		$("#reDiagnoseList").grid({			
			para : {controller:'Patient',method:'getReturnDiagnosisList',id:case_id,case_number:code,pid:pid,bData:bData,eDate:eDate},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[5]},{sClass:'text-c',aTargets:[6]},{sClass:'text-c',aTargets:[7]}
							],
			field : [
						{
							data : 'id',
							render : function (id, type, row) {
								return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
							}
						},
						{data:'visit_time'},
						{data:'current_price'},
						{data:'user_name'}, //receptionist_name
						{data:'doctor_name'},
						{data:'disease_name'},
						{data:'return_time',render:function(v){var str=(v=='')?'<span class="label label-default radius">未预约</span>':v; return str;}},
						{data:'detail_id',render : function(value,rowData,rowIndex){
								var str = '';
								str += '<a style="text-decoration:none" onClick="gAddPatient.openAdd(\'查看详细复诊记录\',\'detail-referral.html?id='+value+'\',\'870\',\'390\');"   href="javascript:;" title="查看详细复诊记录"><i class="Hui-iconfont">&#xe695;</i></a>';
								str += '<a style="text-decoration:none" onClick="gAddPatient.delReDiagnosis('+value+');" class="ml-5" href="javascript:;" title="删除记录"><i class="Hui-iconfont">&#xe6e2;</i></a>';
								return str;
							}
						}
					]
		});
	}
	
	// }}}
	// {{{ function addReDiagnosis()
	
	/**
	 * 新增复诊
	 * */
	this.addReDiagnosis = function() {
		var id = $("#case_id").val();
		var code = $("#code").val();
		var patient_id = $("#patient_id").val();
		var case_id = $("#case_id").val();
		var pid = $("#detail_id").val();
		self.openAdd('新增复诊信息','addRediagnosis.html?pid='+pid+'&id='+id+'&code='+code+'&patient_id='+patient_id+'&case_id='+case_id,'870','400');
	}
	
	// }}}
	// {{{ function delReDiagnosis()
	
	/**
	 * 单个删除复诊
	 * */
	this.delReDiagnosis = function(id) {
		var obj = $(window.document).find("#reDiagnoseList").dataTable();
		var cnum=$('#case_number').val();
		var pid=$('#patient_id').val();	
		self.openDel(obj,{controller:'Patient',method:'delReturnDiagnosisDetail',id:id,pid:pid,cnum:cnum},function(data){
			if(data.statu){				
				$('#left_money_str').html(data.data);
				$('#left_money').val(data.data);
				
			}	
			
		});
		
	}
	
	// }}}
	// {{{ function delBatchReDiagnosis()
	
	/**
	 * 批量删除复诊
	 * */
	this.delBatchReDiagnosis = function() {
		var ids = $("#reDiagnoseList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var cnum=$('#case_number').val();
				var pid=$('#patient_id').val();	
				var obj = $("#reDiagnoseList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delReturnDiagnosisDetail',id:ids,pid:pid,cnum:cnum},function(data){					
					if(data.statu){
						$('#left_money_str').html(data.data);
						$('#left_money').val(data.data);
						
					}
				});
				}
		
	}
	
	// }}}
	// {{{ function diagnosisDetail()
	
	/**
	 * 复诊详情
	 * */
	this.diagnosisDetail = function(){
		//获取参数
		var para = self.parseUrl(window.location.href);
		var id = para.id;
		var Base_real_price=0;
		var Base_current_price=0;
		self.fillSelectData();
		self.showScoreRule();
		
		self.cmd(gHttp,{controller:'Patient',method:'diagnosisDetail',id:id},function(ret){
			if(ret.statu){
				var data = ret.data;				
                $("div.formControls").each(function(){
                	var field = $(this).attr("field");
                	if (field) {
                		if ('return_time' == field) {
                			if (data[field] != '0') {
                    			$(this).html(self.getTimeStr(data[field]));
                    		}
                		} else if ('gender' == field) {
    						var gender = data[field] == '0' ? '男' : '女';
    						$(this).html(gender);
    					} else {
                			if (data[field] == '0') {
                				data[field] = '';
                    		}
                			$(this).html(data[field]);
                		}
                	}
                });
				if(data['pic']!=''&&data['pic']!=0){
					$('#img').attr('src','../../../../upload/'+data['pic']);
				}
                if(data['balance']!='0'){
					$('#balance').val(data['balance']);
					$('#balance_str').html(data['balance']);
				}
                if (data['is_finished'] != '1') {
                	$("div[id^='is_finished']").hide();
                } 
				if(data['real_price']!='0'){
					Base_real_price=Number(data['real_price']);
				}
				if(data['current_price']!='0'){
					Base_current_price=Number(data['current_price']);
				}
                var html = '';				
                $.each(data,function(k,v) {
                	if ($("#"+k).length>0) {
                		if (v != '0') {
                			$("#"+k).val(v);
                		}
                	} else if ('visit_time_field' == k) {						
						$("input[name='visit_time_field'][value='"+v+"']").attr('checked', true);
					}else if ('examine_items'==k) {
						var item_html = '';
						var arr = data['examine_items'].split(',');
						var arrNames = data['examine_items_name'];
						$.each(arr,function(k,vv){	
							if (vv != '')
							    item_html += '<div class="check-box col-95" style="overflow:hidden;height:25px;line-height:25px;" info="'+arrNames[vv]+'"><input type="checkbox" id="examine_items_' + vv + '" name="examine_items[]" value="' + vv + '" checked/><label>' + arrNames[vv] + '</label></div>';
						});
						$("#span_examine_items").html(item_html);
					} else if('department'==k){
						$("#departmentSel").val(v);
						//$('#departmentSel').find('option[value="'+v+'"]').attr('select',true);
					}else if ('is_finished' == k) {
						$("input[name='is_finished'][value='"+v+"']").attr('checked', true);
						if(v==0){
							$('#falsediv').show();
							$('#successdiv').hide();
							$('div.tabCon').eq(1).hide();
							$('div.tabBar span').eq(1).hide();
						}
						else{
							$('#falsediv').hide();
							$('#successdiv').show();
							$('div.tabCon').eq(1).show();
							$('div.tabBar span').eq(1).show();
						}
					} else if ('return_time_field' == k) {
						$("input[name='return_time_field'][value='"+v+"']").attr('checked', true);
					} else if ('case_number' == k) {
						html += '<input type="hidden" name="'+k+'" value="'+v+'">';					
						
					} else {
						html += '<input type="hidden" name="'+k+'" value="'+v+'">';
					}
				});
				html += '<input type="hidden" name="action" value="modify">';
				$('#formFields').html(html);
				//填充处方
				self.cmd(gHttp,{controller:'Patient',method:'getPrescriptionsByDetailId',id:id}, function(result) {
				  if (result.statu) {
					self.fillPrescriptions(result.data);
				  }
				});
				self.onloadCss();			
				/*
				*填充报告单
				*/
				self.showpatientcheck(id);
			}else{
				layer.alert(ret.msg);
			}
		});
		
		$('#real_price').keyup(function(){
				//var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
				var current_price = $('#current_price').val() == '' ? 0 : Number($('#current_price').val());
				var real_price = $(this).val() == '' ? 0 : Number($(this).val());
				var balance = Number(real_price - current_price).toFixed(2);
				$('#balance').val(balance);
				$('#balance_str').html(balance);
				/*
				if (balance < 0) {
					layer.alert('余额不足，请输入本次缴费金额');
					return false;
				}
				*/
		});
		
		$('#current_price').keyup(function(){
			//var left_money = $('#left_money').val() == '' ? 0 : Number($('#left_money').val());
			var current_price = $(this).val() == '' ? 0 : Number($(this).val());
			var real_price = $('#real_price').val() == '' ? 0 : Number($('#real_price').val());
			
			//可以欠费，故不用提示
			/*
			if (left_money == 0) {
				if ($('#real_price').val() == '') {
					layer.alert('请输入本次缴费金额');
					return false;
				}
			}
			*/				
			var balance = Number(real_price - current_price).toFixed(2);
			$('#balance').val(balance);
			$('#balance_str').html(balance);
			
			var score = Number($("#score").val());
			$("#span_score_get").html(current_price*score);
			/*
			if (balance < 0) {
				layer.alert('余额不足，请输入本次缴费金额');
				return false;
			}
			*/
		});
		
		
		
		$('#modify').click(function(){
			var data = {controller:'Patient',method:'addReDiagnosis'};
			var patient_id=$('#patient_id').val();	
			var i=0;
			var checknum=$('div.checklistdiv').length;
			$(".checkimgs").each(function(){//取上传的化验单图片地址					
				var imgurl=$(this).attr('src');						
				if(imgurl!=""&&imgurl.indexOf("thumbnail_auto")==-1){						
					i++;
					var chid=$(this).attr('id');						
					var strs= new Array();
					strs=chid.split("_");						
					var checkval=$(this).attr('src');	
					$('#formEdit').append('<input type="hidden" value="'+checkval+'" class="hidimg" name="checkimg['+strs[1]+']">');						
				}													
			});
			if(i==0&&checknum!=0){						
				parent.layer.msg('添加的检查报告数据不完整，请补充完整，若不需要报告请点击报告单右上的关闭按钮',{icon:2});
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
				jQuery('html,body').animate({scrollTop: jQuery("#checkthumbnaillist").offset().top-50}, 300); 
				return false;
			}
			//Base_real_price,Base_current_price的值被改变说明用户改动了以往输入的收费结果，需要重新计算总余额
			if(Base_real_price!=$('#real_price').val()||Base_current_price!=$('#current_price').val()){
				layer.confirm('您修改了之前保存的收费项，更改此项会重先计算该患者所有的相关收费，是否继续？',{icon: 3, title:'提醒',btn:['确定','取消']}, function(index, layero){
					data = {controller:'Patient',method:'savePatient',Ptype:3};	
					
					//检查部分字段
					if ($('#is_finished').val() == '1') {
						if (ids == '') {
							layer.alert('请选择检查项目');
							return false;
						}
					}
					var code = $("#case_number").val();
					var pid=$("#pid").val();
					var formObj = $('#formEdit').checkAndSubmit('save', data,function(result1){
						if(result1.statu){
							//父窗口刷新
							parent.gAddPatient.returnDiagnosisList(id, code, pid);
							parent.gAddPatient.RefreshMoney(patient_id);
							parent.layer.msg('记录更新成功',{icon:1});					
							var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
							parent.layer.close(index);
							
						}else{
							parent.layer.alert(result1.msg,{icon:2});
						}
					});
					
					formObj.unignore('#source,#recommend_name,#recommend_tel');
					if ($("#source").val() == '1') {
						//推荐，详细不验证
						formObj.ignore('#source');
					} else {
						//其它，推荐人和电话不验证
						formObj.ignore('#recommend_name,#recommend_tel');
					}
					
					formObj.unignore('#reason, #departmentSel, #disease_type, #real_price, #current_price');
					var is_finished = $('input[name="is_finished"]:checked').val();
					if (is_finished == '1') { //成交，不需要写原因
						formObj.ignore('#reason');
					} else {
						//未成交，不需要科室，病症,金额
						formObj.ignore('#departmentSel, #disease_type, #real_price, #current_price');
					}
					
					formObj.ignore('#check');
					$('#formEdit').submit();				
					
					//layer.close(index);
				},function(index){					
					layer.close(index);
					return false;
				});								
			}
			else{
				//不涉及到费用相关修改则直接保存即可
				data = {controller:'Patient',method:'addReDiagnosis'};	
				
				//检查部分字段
				if ($('#is_finished').val() == '1') {
					if (ids == '') {
						layer.alert('请选择检查项目');
						return false;
					}
				}
				var code = $("#case_number").val();
				var pid=$("#pid").val();
				var formObj = $('#formEdit').checkAndSubmit('save', data,function(result1){
					if(result1.statu){
						//父窗口刷新
						parent.gAddPatient.returnDiagnosisList(id, code, pid);
						parent.gAddPatient.RefreshMoney(patient_id);
						parent.layer.msg('记录更新成功',{icon:1});					
						var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
						parent.layer.close(index);
						
					}else{
						parent.layer.alert(result1.msg,{icon:2});
					}
				});
				
				formObj.unignore('#source,#recommend_name,#recommend_tel');
				if ($("#source").val() == '1') {
					//推荐，详细不验证
					formObj.ignore('#source');
				} else {
					//其它，推荐人和电话不验证
					formObj.ignore('#recommend_name,#recommend_tel');
				}
				
				formObj.unignore('#reason, #departmentSel, #disease_type, #real_price, #current_price');
				var is_finished = $('input[name="is_finished"]:checked').val();
				if (is_finished == '1') { //成交，不需要写原因
					formObj.ignore('#reason');
				} else {
					//未成交，不需要科室，病症,金额
					formObj.ignore('#departmentSel, #disease_type, #real_price, #current_price');
				}
				
				formObj.ignore('#check');
				$('#formEdit').submit();
			}
				
			
			
		});
		$('input[name="is_finished"]').click(function(){
			$(this).attr('checked',true);
				if($(this).val()==1){						
					$("div.falsediv").hide();
					$("div.successdiv").show();
					$('div.tabCon').eq(1).hide();
					$('div.tabBar span').eq(1).show();
				}
				else{						
					$("div.falsediv").show();
					$("div.successdiv").hide();
					$('#real_price').val('');
					$('#current_price').val('');
					$('div.tabCon').eq(1).hide();
					$('div.tabBar span').eq(1).hide();						
					}
		});
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		
	}
	
	// }}}
	// {{{ function returnVisitList()
	
	/**
	 * 回访记录页面
	 * */
	this.returnVisitList = function(data, case_number,patient_id) {
		var arr = data.split(':');
		var detail_id = arr[0];
		var username = arr[1];		
		$("#returnVisitList").grid({
			para : {controller:'Patient',method:'getReturnVisitList',detail_id:detail_id},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[5]}
							],
			field : [
						{
							data : 'id',
							render : function (id, type, row) {
								return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
							}
						},						
						{data:'return_time'},
						{data:'reply_name'},
						{data:'visit_method',render:function(value){ var str=value=='不明渠道'?'<span class="label label-default radius">不明渠道</span>':'<span class="label label-success radius">'+value+'</span>'; return str;}},
						{data:'message',render:function(value){return value.substr(0,20)+'...';}},
						{data:'id',render : function(value,type,row){
							    var str = '';
								//str += '<a style="text-decoration:none" onClick="gAddPatient.openAdd(\'回访详细内容\',\'detail-visit.html\',\'820\',\'500\');" class="ml-5" href="javascript:;" title="查看回访的详细内容"><i class="Hui-iconfont">&#xe695;</i></a>';
								str += '<a style="text-decoration:none" class="ml-5" onClick="gAddPatient.openAdd(\'回复消息\',\'add-visit.html?id='+value+'&&type=mod&&reply='+row.reply+'\',\'820\',\'500\');" href="javascript:;" title="回复"><i class="Hui-iconfont">&#xe6df;</i></a>';
								str += '<a style="text-decoration:none" onClick="gAddPatient.delReturnVisit('+value+');" class="ml-5" href="javascript:;" title="删除记录"><i class="Hui-iconfont">&#xe6e2;</i></a>';
								return str;
							}
						}
					]
		});
		
		$('#add').click(function(){
			//('新增回访记录','add-visit.html','800','500')
			var params = 'type=add&id=' + detail_id+'&pid='+patient_id;
			self.openAdd('新增回访记录','add-visit.html?' + params,'800','380');
		});
	}
	
	// }}}
	// {{{ function reply()
	
	/**
	 * 回复
	 * */
	this.initVisit = function() {
		//获取参数
		var para = self.parseUrl(window.location.href);		
		var id = para.id;
		var pid = para.pid;
		var type = para.type;
		//填充回访人信息，与前台接待共用
		self.fillReceptionist();
		//获取患者的基础信息
		self.cmd(gHttp,{controller:'Patient',method:'getPatientInfoById',id:pid},function(ret){			
			if(ret.statu){					
				var data=ret.data;
				//不同的回访方式绑定不同的渠道操作
				$('#visit_method').change(function(){
					var val=$(this).val();	
					$('#channel_info').val('');		
					switch (val){
						case '1':self.tel_reply(data['telphone']);break;
						case '2':self.msg_reply(data['telphone']);break;
						case '3':self.email_reply(data['email']);break;
						case '4':self.wechat_reply(data['telphone']);break;
						case '5':self.qq_reply(data['qq']);break;
						case '6':self.apk_reply(data['telphone']);break;	
						case '0':$('#info_box').html('<input type="text" class="input-text" id="channel_info"/>');break;	
					}
					if(val=='3'){
						$('#emailsubject').show();
					}else{
						$('#emailsubject').hide();
					}
				});				
			}else{
				parent.layer.alert(ret.msg,{icon:2});				
			}	
		});
		
		$('body').on('click','#openemailsetting',function(){//打开邮件设置页面
			
			self.emailsetting();
		});
		
		$('body').on('click','#sendemail',function(){
			var name=$('#reply_id').find("option:selected").text();
			var receiver=$('#channel_info').val();
			var content=$('#message').val();
			var subject=$('#subject').val();
			if(content==""){
				layer.alert('邮件内容为空'); 
				return false;
			}
			self.cmd(gHttp,{controller:'Email',method:'sendemail',name:name,content:content,receiver:receiver,subject:subject},function(ret){	
				if(ret.stute){
					layer.msg('邮件发送成功', {icon: 1});
				}else{
					layer.alert(ret.msg); 	
				}
			});
		});
		
		
		$("#save").on('mouseover',function(){
			var msg=$(this).attr('info');
			layer.tips(msg, $(this), {
				tips: [3,'#78BA32'],
				time:5000
			});	
		});
		
		
		if (para.reply != undefined) {
			$("#message").val(para.reply);
		}
    	$("#save").click(function(){
    		var url = {controller:'Patient',method:'addReturnVisit',detail_id:id};
        	if ('mod' == type) {
        		$("#message").attr('name', 'reply');
        		url = {controller:'Patient',method:'modReturnVisit',id:id};
        	}
        	var data = $(window.parent.document).find('#data').val();
			var code = $(window.parent.document).find('#code').val();
        	$('#formEdit').checkAndSubmit('save',url,function(result1){											   
    			if(result1.statu){
    				parent.gAddPatient.returnVisitList(data,code);
    				parent.layer.msg('操作成功!',{icon: 1});	
    				layer_close();
    				
    			}else{
    				parent.layer.alert(result1.msg,{icon: 2});
    			}
    		});
        	
        	$('#formEdit').submit();
    	});
		
	}
	
	// }}}
	
	//{{{
	 /**
	 * 电话回访
	 * */
	this.tel_reply=function(value){		
		/***type用于获取第三方合作渠道的开通状态，比如如果公司
		有买400电话并有拔号坐席，则给直接拔号的按钮
		0表示没有接口，1表示有接口并己接通
		***/
		var type=0;		
		if($.trim(value)!=''){
			$('#channel_info').val(value);
			if(type==0){
				$('#msg_box').html('（您没有购买拔号服务，请手动拔打该电话回访！）').addClass('c-red');
			}
			else{
				$('#msg_box').removeClass('c-red').html('<a class="btn btn-success radius" onClick="" href="javascript:;"><i class="Hui-iconfont">&#xe6a3;</i> 拔打电话</a>');				
			}
		}else{
			$('#msg_box').html('（该用户没有留电话，请偿试其它方式！）').addClass('c-red');
		}
		
	}
	//}}}
	
	//{{{
	 /**
	 * 短信回访
	 * */
	this.msg_reply=function(value){		
		/***type用于获取第三方合作渠道的开通状态
		0表示没有接口，1表示有接口并己接通
		***/
		var type=1;	
		var reg=/^1[0-9]{10}/;		
		if($.trim(value)!=''&&reg.test(value)){
			$('#channel_info').val(value);	
			if(type==0){
				$('#msg_box').html('（您没有购买短信发送服务，请手动发送短信回访！）').addClass('c-red');
			}
			else{
				$('#msg_box').removeClass('c-red').html('<a class="btn btn-success radius setbtn" id="openmsgsetting" href="javascript:;" onclick="gAddPatient.msgsetting();"><i class="Hui-iconfont">&#xe60e;</i> 绑定短信接口</a><a class="btn btn-success radius ml-5" onClick="gAddPatient.sendmsg()" href="javascript:;"><i class="Hui-iconfont">&#xe68a;</i> 发送信息</a>');				
			}
		}else if($.trim(value)==''){
			$('#msg_box').html('（该用户没有留电话，请偿试其它方式！）').addClass('c-red');			
		}else if($.trim(value)!=''&&!reg.test(value)){
			$('#channel_info').val(value);	
			$('#msg_box').html('（该用户的联系电话不是手机号，无法发送短信！）').addClass('c-red');	
		}		
	}
	//}}}
	
	//{{{
	 /**
	 * 邮件回访
	 * */
	this.email_reply=function(value){		
		/***type用于获取第三方合作渠道的开通状态
		0表示没有接口，1表示有接口并己接通
		***/
		var type=1;	
		var reg=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;			
		if($.trim(value)!=''&&reg.test(value)){
			$('#channel_info').val(value);
			if(type==0){
				$('#msg_box').html('（您没有购买邮件发送服务，请手动发送邮件回访！）').addClass('c-red');
			}
			else{
				$('#msg_box').removeClass('c-red').html('<a class="btn btn-success radius setbtn" id="openemailsetting" href="javascript:;"><i class="Hui-iconfont">&#xe60e;</i> 绑定邮件接口</a><a class="btn btn-success radius ml-5" id="sendemail" href="javascript:;"><i class="Hui-iconfont">&#xe634;</i> 发送邮件</a>');				
			}
		}else if($.trim(value)==''){
			$('#msg_box').html('（该用户没有留邮箱地址，请偿试其它方式！）').addClass('c-red');			
		}else if($.trim(value)!=''&&!reg.test(value)){
			$('#msg_box').html('（该用户的邮箱格式不合法无法使用，请偿试其它方式！）').addClass('c-red');
		}
		
		
	}
	//}}}
	
	//{{{
	 /**
	 * 微信回访
	 * */
	this.wechat_reply=function(value){		
		/***type用于获取第三方合作渠道的开通状态
		0表示没有接口，1表示有接口并己接通
		***/
		var type=0;	
		var reg=/^1[0-9]{10}/;			
		if($.trim(value)!=''&&reg.test(value)){
			$('#channel_info').val(value);
			if(type==0){
				$('#msg_box').html('（您没有购买微信第三方服务，请手动回访！）').addClass('c-red');
			}
			else{
				$('#msg_box').removeClass('c-red').html('<a class="btn btn-success radius" onClick="" href="javascript:;"><i class="Hui-iconfont">&#xe694;</i> 发送微信</a>');				
			}
		}else if($.trim(value)==''){
			$('#msg_box').html('（该用户没有留电话，请偿试其它方式！）').addClass('c-red');			
		}else if($.trim(value)!=''&&!reg.test(value)){
			$('#msg_box').html('（该用户的电话不是手机号，无法用于微信发送！）').addClass('c-red');
		}
		
	}
	//}}}
	
	//{{{
	 /**
	 * QQ回访
	 * */
	this.qq_reply=function(value){		
		/***type用于获取第三方合作渠道的开通状态
		0表示没有接口，1表示有接口并己接通
		***/		
		var type=0;
		var reg=/^[1-9]{1}[0-9]{5,}/;		
		if($.trim(value)!=''&&reg.test(value)&&value!=0){
			$('#channel_info').val(value);
			if(type==0){
				$('#msg_box').html('（您没有购买QQ第三方服务，请手动发送回访！）').addClass('c-red');
			}
			else{
				$('#msg_box').removeClass('c-red').html('<a class="btn btn-success radius" onClick="" href="javascript:;"><i class="Hui-iconfont">&#xe67b;</i> QQ联系</a>');				
			}
		}else if($.trim(value)==''||value==0){
			$('#msg_box').html('（该用户没有留QQ，请偿试其它方式！）').addClass('c-red');			
		}else if($.trim(value)!=''&&!reg.test(value)){
			$('#msg_box').html('（该用户QQ格式错误，无法使用，请偿试其它方式！）').addClass('c-red');
		}
		
	}
	//}}}
	
	//{{{
	 /**
	 * APK消息
	 * */
	this.apk_reply=function(value){		
		/***type用于获取第三方合作渠道的开通状态
		0表示没有接口，1表示有接口并己接通
		***/
		var type=0;	
		var reg=/^1[0-9]{10}/;			
		if($.trim(value)!=''&&reg.test(value)){
			$('#channel_info').val(value);
			if(type==0){
				$('#msg_box').html('（您没有购买QQ第三方服务，请手动发送回访！）').addClass('c-red');
			}
			else{
				$('#msg_box').removeClass('c-red').html('<a class="btn btn-success radius" onClick="" href="javascript:;"><i class="Hui-iconfont">&#xe64a;</i> 发送消息</a>');				
			}
		}else if($.trim(value)==''){
			$('#msg_box').html('（该用户没有本医院手机应用账号，请偿试其它方式！）').addClass('c-red');			
		}else if($.trim(value)!=''&&!reg.test(value)){
			$('#msg_box').html('（该用户的账号不正确，请偿试其它方式！）').addClass('c-red');
		}
		
	}
	//}}}
	
	// {{{ function delReturnVisit()
	/**
	 * 验证回访接口是否可用@rType
	  回访类型  phone 电话，msg 短信，qq 腾讯QQ，email 邮件，wechat  微信
	 * */
	 /*
	this.checkReportAPI=function(rType){
		
	}
	*/
	
	//}}}
    // {{{ function delReturnVisit()
	
	/**
	 * 单个删除回访
	 * */
	this.delReturnVisit = function(id) {
		var obj=$(window.document).find("#returnVisitList").dataTable();
		self.openDel(obj,{controller:'Patient',method:'delReturnVisit',id:id});
	}
	
	// }}}
	// {{{ function delBatchReturnVisit()
	
	/**
	 * 批量删除回访
	 * */
	this.delBatchReturnVisit = function() {
		var ids = $("#returnVisitList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#returnVisitList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delReturnVisit',id:ids});
				}
	}
	
	// }}}
	// {{{ function getTimeStr()
	
	/**
	 * 将时间撮转换成时间串
	 * */
	this.getTimeStr = function(timestamp, isAll) {
		var timestamp = new Date(parseInt(timestamp)*1000);
		var year = timestamp.getFullYear();
		var month = timestamp.getMonth() + 1;
		var day = timestamp.getDate();
		var hour = timestamp.getHours();
		var minute = timestamp.getMinutes();
		var second = timestamp.getSeconds();
		if (isAll) {
			return year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;
		}
		return year+'-'+month+'-'+day;
	};
	// }}}
	// {{{ function changeAge()
	
	/**
	 * 年龄与生日联动
	 * */
	this.changeAge = function (){
		var timestamp = new Date();
		var year = timestamp.getFullYear();
		var birthday = $('#birthday').val();
		var arr = birthday.split('-');
		var age = year - parseInt(arr[0]);
		$("#age").val(age);
	}
	
	// }}}
	// {{{ function getBirthdayFromAge()
	
	/**
	 * 通过年龄计算出生年份
	 * */
	this.getBirthdayFromAge = function(age) {
		age = (age == '') ? 0 : parseInt(age);
		var timestamp = new Date();
		var year = timestamp.getFullYear();
		var month = timestamp.getMonth() + 1;
		var day = timestamp.getDate();
		var birthday = $('#birthday').val();
		var str = (year-age) + '-' . month + '-' . day;
		if (birthday == '') {
			birthday = self.getToday();
		}
		var arr = birthday.split('-');
		str = (year-age) + '-' + arr[1] + '-' + arr[2];
		return str;
	}
	
	// }}}
	// {{{ function fillSelectData()
	
	/**
	 * 填充select数据
	 * */
	this.fillSelectData = function(isFirst) {
		var self = this;
		self.cmd(gHttp,{controller:'Patient',method:'getFillData'},function(ret){
			if(ret.statu){
				var data = ret.data;
				if (isFirst) {
					$("#number").html(data.case_number);
					$("#case_number").val(data.case_number);
				}
				
				//填充会员级别
				self.fillLevels();
				
				//填充来源信息
				self.fillSource();
				
				//填充前台接待信息
				self.fillReceptionist();

				//填充医生信息
				self.fillDoctors();

				//填充科室信息
				self.fillDepartments();

				//填充疾病信息
				self.fillDiseases();
				
				//诊疗项目信息
				self.fillItems();
				
			}else{
				alertselfssage(ret.msg);
			}
		});
		
	}
	
	// }}}
	// {{{ function fillLevels()
	
	/**
	 * 填充会员级别
	 * */
	this.fillLevels = function(){		
		self.cmd(gHttp,{controller:'Patient',method:'getVipLevels'},function(res){
			if(res.statu){
				var levels = res.data;			
				var levelHtml = '<option value="0" selected>否 </option>';
				if ( levels!= null) {
					$.each(levels,function(i,v) {
						levelHtml += '<option value="' + v.id + '">' + v.level_name + '</option>';
					});
				}
				$("#vip_level").html(levelHtml);
			}else{
				return false;
			}
		});
	}
	
	// }}}
	// {{{ function fillReceptionist()
	
	/**
	 * 填充前台接待信息
	 * */
	this.fillReceptionist = function() {
		self.cmd(gHttp,{controller:'Patient',method:'getReceptionist'},function(res){
			if(res.statu){
				var receptionist = res.data;
				var recHtml = '<option value="" selected>请选择 </option>';
				if ( receptionist!= null) {
					$.each(receptionist,function(i,v) {
						recHtml += '<option value="' + v.id + '">' + v.user_name + '</option>';
					});
				}
				$("#receptionist_id,#reply_id").html(recHtml);
			}else{
				return false;
			}
		});
	}
	
	// }}}
	// {{{ function fillSource()
	
	/**
	 * 填充来源信息
	 * */
	this.fillSource = function(){
		self.cmd(gHttp,{controller:'Patient',method:'getDataSource'},function(res){
			if(res.statu){
				var sourceList = res.data;
				var sourceHtml = '<option value="" selected="selected">请选择 </option>';
				if ( sourceList!= null) {
					$.each(sourceList,function(i,v) {
						sourceHtml += '<option value="' + v.id + '">' + v.title + '</option>';
					});
				}
				$("#source").html(sourceHtml);
				if ($("#source").val() == 0) {
					$("div[id^='source_']").hide();
				}
			}else{
				return false;
			}
		});
	}
	
	// }}}
	// {{{ function fillDoctors()
	
	/**
	 * 填充医生信息
	 * */
	this.fillDoctors = function(){
		self.cmd(gHttp,{controller:'Patient',method:'getDoctors'},function(res){
			if(res.statu){
				var doctors = res.data;
				var doctorHtml = '<option value="" selected>请选择 </option>';
				if ( doctors!= null) {
					$.each(doctors,function(i,v) {
						doctorHtml += '<option value="' + v.id + '">' + v.doctor_name + '</option>';
					});
				}
				$("#doctor_id").html(doctorHtml);
			}else{
				return false;
			}
		});
	}
	
	// }}}
	// {{{ function fillDepartments()
	
	/**
	 * 填充科室信息
	 * */
	this.fillDepartments = function(){
		self.cmd(gHttp,{controller:'Patient',method:'getDepartments'},function(res){
			if(res.statu){
				var departments = res.data;
				var departmentHtml = '<option value="" selected>请选择 </option>';
				if ( departments!= null) {
					$.each(departments,function(i,v) {
						departmentHtml += '<option value="' + v.id + '">' + v.department_name + '</option>';
					});
				}
				$("#departmentSel").html(departmentHtml);
			}else{
				return false;
			}
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
				var diseaseHtml = '<option value="" selected>请选择 </option>';
				if ( diseases!= null) {
					$.each(diseases,function(i,v) {
						diseaseHtml += '<option value="' + v.id + '">' + v.disease_name + '</option>';
					});
				}
				$("#disease_type").html(diseaseHtml);
			}else{
				return false;
			}
		});
	}
	
	// }}}
	// {{{ function fillItems()
	
	/**
	 * 填充诊疗项目信息
	 * */
	this.fillItems = function(){
		self.cmd(gHttp,{controller:'Patient',method:'getExamineItems',is_usual:1},function(res){
			if(res.statu){				
				var items = res.data;
				var itemsHtml = '';
				if ( items != null) {
					$.each(items,function(i,v) {
						itemsHtml += '<div class="check-box col-95" style="overflow:hidden;height:25px;line-height:25px;" info="'+v.item_name+'"><input type="checkbox" id="examine_items_' + v.id + '" name="examine_items[]" value="' + v.id + '" /><label>' + v.item_name + '</label></div>';
					});
				}
				$("#span_examine_items").html(itemsHtml);
				$("#span_examine_items").find('div.check-box').on('mouseover',function(){
						var msg=$(this).attr('info');
						layer.tips(msg, $(this), {
							tips: [3,'#78BA32'],
							time:3000
						});															   
																					   
				});
			}else{
				return false;
			}
		});
	}
	
	// }}}
	// {{{ function manageInitHtml()
	
	/**
	 * 管理初始化
	 * */
	this.manageInitHtml = function(type, title) {
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
		$('.tabBar span').click(function(){
			var index = $(this).index();
			if (type == 'prescription' && index == 2) {
				$("#id").val('');
				$("#formEdit input[type='text']").val('');
			} else if (type != 'prescription' && index == 1) {
				$("#id").val('');
				$("#formEdit input[type='text']").val('');
			}
		});
		switch(type) {
			case 'level':
				self.getManageLevelTable();
				break;
			case 'examineItem':
				self.getManageExamineTable();
				break;
			case 'source':
				self.getManageSourceTable();
				break;
			case 'receptionist':
				self.getManageReceptionistTable();
				break;
			case 'doctor':
				self.getManageDoctorTable();
				break;
			case 'department':
				self.getManageDepartmentTable();
				break;
			case 'disease':
				self.getManageDiseaseTable();
				break;
			case 'prescription': //处方管理
				self.getManagePrescriptionTable();
				break;
			default:
				//获取参数
				var para = self.parseUrl(window.location.href);
			    if (para.type != undefined && para.type == 1) {
			    	//patientByName
			    	self.getPatientTable(true);
			    } else {
			    	//patientByTel
			    	self.getPatientTable(false);
			    }
				break;
		}
		
		return false;
	}
	
	// }}}
    // {{{ function getManagePrescriptionTable()
	
	/**
	 * 处方管理
	 * */
	this.getManagePrescriptionTable = function(){		
		var para = self.parseUrl(window.location.href);		
		if (para.prescriptionIds != undefined && para.prescriptionIds != '') {
			
			//填充处方
			self.cmd(gHttp,{controller:'Patient',method:'getPrescriptionByIds',detail_id:para.detail_id,id:para.prescriptionIds}, function(result) {
				if (result.statu) {					
					var str_html = '';
					$.each(result.data, function(i,v) {
						str_html+='<tr id="tr_'+v.code+'" class="text-c"><td><input type="checkbox" value="'+v.prescription_id+'" name="" checked></td><td><input type="text" name="" id="" class="input-text col-11 drug_code" value="'+v.code+'"/></td>';
						str_html+='<td id="p_name">'+v.name+'</td><td id="p_specs">'+v.specification+'</td><td><input type="text" name="" id="" class="input-text col-11" value="'+v.quantity+'"/></td><td  id="p_unit">'+v.unit+'</td>';
						str_html+='<td><input type="text" name="" id="" class="input-text col-11" value="'+v.usage+'"/></td>';
						str_html+='<td><a style="text-decoration:none" onClick="gAddPatient.delPrescriptionItem(this);" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>';
						str_html+='</tr>';
					});
					$("tbody#had_prescription").append(str_html);
					self.bindCodeEvent();
				}
			});
		}
		
		//从父窗口取处方
		var oldprescription=$('#prescription', parent.document).val(); 
		
		var strs= new Array();
		strs=oldprescription.split("@");
		for (i=0;i<strs.length ;i++ )
		{
			var prescridetail=new Array();
			prescridetail=strs[i].split(":");
			if(prescridetail.length>0){//如果存在处方数据
				self.cmd(gHttp,{controller:'Patient',method:'getPrescriptionByIds',id:prescridetail[0]}, function(result) {//取处方详情
					if(result.statu){
						console.log(result.data);
						var str_html = '';
						$.each(result.data, function(i,v) {
						str_html+='<tr id="tr_'+v.code+'" class="text-c"><td><input type="checkbox" value="'+prescridetail[0]+'" name="" checked></td><td><input type="text" name="" id="" class="input-text col-11 drug_code" value="'+v.code+'"/></td>';
						str_html+='<td id="p_name">'+v.name+'</td><td id="p_specs">'+v.specification+'</td><td><input type="text" name="" id="" class="input-text col-11" value="'+prescridetail[1]+'"/></td><td  id="p_unit">'+v.unit+'</td>';
						str_html+='<td><input type="text" name="" id="" class="input-text col-11" value="'+prescridetail[2]+'"/></td>';
						str_html+='<td><a style="text-decoration:none" onClick="gAddPatient.delPrescriptionItem(this);" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>';
						str_html+='</tr>';
						});
						$("tbody#had_prescription").append(str_html);
					}
				});
			}
			
		
		} 
		
		
		self.fillPrescriptionTable();
		
		//剂型数据填充
		self.fillDosageForm();
		
		$('#qry').click(function(){
			self.fillPrescriptionTable();
		});
		
		$('#save').click(function(){
			self.subPrescription();
		});
		
		self.bindCodeEvent();
		
	}
	
	// }}}
	// {{{ function fillPrescriptionTable()
	
	/**
	 * 填充仓库管理列表
	 * */
	this.fillPrescriptionTable = function() {
		var name = $.trim($("#name").val());
		var code = $.trim($("#code").val());		
		$('#prescriptionList').grid({
			para :  {controller:'Patient',method:'getPrescriptions',isPage:1,name:name,code:code},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[3]},{sClass:'text-c',aTargets:[4]}
							],
			field : [
				         {data : 'id',render : function (id, type, row) {
			                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
		                     }
	                     },	                    
	                     {data: 'code' },
	                     {data: 'name' ,render:function(value){return value.substr(0,10)+'...';}},
	                     {data: 'specification' },	                     
					     {data: 'id', render : function(id, type, row){
					    	 gData[id] = row;
					    	 var str = '';
					    	 str += '<a style="text-decoration:none" href="javascript:;" onClick="gAddPatient.editPrescription('+id+');" title="编辑"><i class="Hui-iconfont">&#xe60c;</i></a>';
					    	 str += '<a style="text-decoration:none" class="ml-5" onClick="gAddPatient.delPrescription('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
					    	 return str;
						}
				}
			]
		});
	}
	
	// }}}
	// {{{ function fillDosageForm()
	
	/**
	 * 剂型数据填充
	 * */
	this.fillDosageForm = function(parentId) {
		parentId = parentId == undefined ? '' : parentId;
		self.cmd(gHttp,{controller:'Patient',method:'getDosageForm',parentId:parentId},function(result) {
			if (result.statu) {
				var data = result.data;
				var html = '<option value="">请选择</option>';
				$.each(data, function(i,v) {
					html += '<option value="'+i+'">'+v+'</option>'
				});
				if (parentId == '') {
					$("#dosage_form").html(html);
				} else {
					$("#dosage_form_detail").html(html);
				}
			}
		});
	}
	
	// }}}
	// {{{ function bindCodeEvent()
	
	/**
	 * 绑定代码查询
	 * */
	this.bindCodeEvent = function() {
		$('input.drug_code').unbind('keyup');
		$('input.drug_code').on('keyup',function(){											 
			//根据当前的VALUE实时查询己存在的药品库，返回药品数据
			var res='<table id="prescriptionList" class="table table-border table-bordered table-bg table-hover table-sort">';
			res+='<thead><tr class="text-c"><th width="180px">药品名称</th><th width="90px">规格</th></tr></thead><tbody>';
			var obj=$(this).parent().parent();
			var code = $(this).val();
			if (code == '') {
				return false;
			}
			
			obj.attr('id','tr_' + code);
			//根据code查询数据
			var listobj=$(this);
			self.cmd(gHttp,{controller:'Patient',method:'getPrescriptionByCode',code:code},function(result){
				if (result.statu) {
					var data = result.data;
					gData = {};
					var hasData = false;	
					$.each(data, function(i,v){
						if ($('#tr_' + v.code).length<1) {
							gData[i] = v;
							hasData = true;
							res+='<tr class="text-c" onClick="gAddPatient.dataToTr(\''+code+'\','+i+');"><td width="180px" height="30px" class="text-c" style="cursor:pointer;">'+v.name+'</td><td width="90px" height="30px" class="text-c" style="cursor:pointer;">'+v.specification+'</td></tr>';
						}
					});
					res+='</tbody></table>';
					if (hasData) {						
						layer.tips(res,listobj, {
						  tips: [4, '#78BA32'],
						  time:9000,
						  area: ['360px', 'auto']
						  
						});
						
						
					}
				} 
			});
		});
	}
	
	/**
	 * 打开处方管理窗口
	 * */
	this.managerPrescription=function(){
		var index = layer.open({type:2,
			title:'处方管理',
			content:'manage/prescriptions.html'});
	}
	
	// }}}
	// {{{ function dataToTr()
	
	/**
	 * 将数据写入到tr中
	 * */
	this.dataToTr = function(code, i) {
		var trObj = $('#tr_' + code);
		var data = gData[i];
		
		$(trObj).find('td').each(function(index){
			if (index == 0) {$(this).find('input').val(data.id);$(this).find('input').attr('checked',true);}
			if (index == 1) $(this).html('<input class="input-text col-11 drug_code" type="text" value="'+data.code+'" name="" />');
			if (index == 2) $(this).html(data.name);
			if (index == 3) $(this).html(data.specification);
			if (index == 4) $(this).html('<input class="input-text col-11 drug_code" type="text" value="'+data.quantity+'" name="" />');
			if (index == 5) $(this).html(data.unit);
			if (index == 6) $(this).html('<input class="input-text col-11 drug_code" type="text" value="'+data.usage+'" name="" />');
			
			$(trObj).attr('id', 'tr_' + data.code);
		});
		
		layer.closeAll('tips');
	} 
	
	// }}}
	// {{{ function saveSelectedPrescription()
	
	/**
	 * 保存已选处方
	 * */
	this.saveSelectedPrescription = function () {
		var datas = [];
		var tbodyObj = $("#selectedPrescriptionList").find('tbody');
		var i = 0;
		var hadval=true;
		tbodyObj.find('input[type="text"]').each(function(){
			if($.trim($(this).val())==''){
				hadval=false;
				layer.msg('所开处方中有空项，请处理！');
				$(this).focus();
				return false;
			}			
		});
		if(hadval){
			tbodyObj.find('input[type="checkbox"]').each(function(){
			var trObj = $(this).parent().parent();
			if ($(this).val() != '') {
				var obj = {};
				$(trObj).find('td').each(function(index){
					if (index == 0) obj['prescription_id'] = $(this).find('input').val();
					if (index == 1) obj['code'] = $(this).find('input').val();
					if (index == 2) obj['name'] = $(this).html();
					if (index == 3) obj['specification'] = $(this).html();
					if (index == 4) obj['quantity'] = $(this).find('input').val();
					if (index == 5) obj['unit'] = $(this).html();
					if (index == 6) obj['usage'] = $(this).find('input').val();
				});
				
				datas[i] = obj;
				i++;
			}
			});
			//将信息写入到父窗口处方列表
			parent.gAddPatient.fillPrescriptions(datas);
			
			layer_close();
			
		}
		
		
		
		
	}
	
	// }}}
	// {{{ function fillPrescriptions()
	
	/**
	 * 填充已选择处方信息
	 * */
	this.fillPrescriptions = function(datas) {
		if (datas != undefined) {
			$('#prescriptionList').grid({
				ttl:datas.length,
				showPage : false,
				tableInfo : false,
				order : false,
				filter : false,
    			data : datas,
				aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[3]}
							],
    			field : [					
    				{data:'name'},
    				{data:'specification'},
    				{data:'quantity'},
    				{data:'unit'},
    				{data:'usage'}
    			]
			});
			var prescriptionStr = '';
			var prescriptionIds = '';
			for(var i in datas) {
				var row=datas[i];
				prescriptionStr += row.prescription_id+':'+row.quantity+':'+row.usage+'@';
				prescriptionIds += row.prescription_id + ',';
			}
			prescriptionStr = prescriptionStr.substr(0, prescriptionStr.length-1);
			prescriptionIds = prescriptionIds.substr(0, prescriptionIds.length-1);
			$('#prescription').val(prescriptionStr);
			$('#prescriptionIds').val(prescriptionIds);
			$('#prescriptionList').find('th').attr('style','');

		}	
	}
	
	// }}}
	// {{{ function managePrescriptions()
	
	this.managePrescriptions = function() {
		var prescriptionIds = $("#prescriptionIds").val();
		var detail_id = $("#detail_id").val();
		self.openAdd('处方管理','manage/prescriptions.html?prescriptionIds=' + prescriptionIds + '&detail_id=' + detail_id ,'840','460');
		}
	
	// }}}
    // {{{ function delBatchPrescription()
	
	/**
	 * 批量删除药品
	 * */
	this.delBatchPrescription = function() {
		var ids = $("#prescriptionList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#prescriptionList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delPrescription',id:ids},function(){
					//更新select
					parent.gAddPatient.fillPrescriptions();																			 				
					});
				
				}
	}
	
	// }}}
	// {{{ function delPrescription()
	
	/**
	 * 批量删除药品
	 * */
	this.delPrescription = function(id) {
		self.openDel(obj,{controller:'Patient',method:'delPrescription',id:id});
		//更新select
		parent.gAddPatient.fillPrescriptions();
	}
	
	// }}}
	// {{{ function delPrescriptionItem()
	
	/**
	 * 删除处方已选择项
	 * */
	this.delPrescriptionItem = function(obj) {
		if (obj == undefined) {
			//批量删除
			var tbodyObj = $(this).find('tbody');
			$("#selectedPrescriptionList").find('tbody input[type="checkbox"]:checked').each(function(){
				$(this).parent().parent().remove();
			});
		} else {
			$(obj).parent().parent().remove();
		}
	}
	
	// }}}
	// {{{ function addNewItem()
	
	/**
	 * 新增已选处方
	 * */
	this.addNewItem = function (){
		var str_html='<tr class="text-c"><td><input type="checkbox" value=""></td><td><input type="text" class="input-text col-11 drug_code" value=""/></td>';
		str_html+='<td id="p_name"></td><td id="p_specs"></td><td><input type="text" class="input-text col-11" value=""/></td><td  id="p_unit"></td>';
		str_html+='<td><input type="text" class="input-text col-11" value=""/></td>';
		str_html+='<td><a style="text-decoration:none" onClick="gAddPatient.delPrescriptionItem(this);" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>';
		$("tbody#had_prescription").append(str_html);
		
		self.bindCodeEvent();
	}
	
	// }}}
	// {{{ function editPrescription()
	
	/**
	 * 修改处方
	 * */
	this.editPrescription = function(id) {
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","2");
		self.cmd(gHttp,{controller:'Patient',method:'getPrescriptionById',id:id},function(result1){
			if(result1.statu){
				$('#formEdit').frmFill('',result1.data);
			}else{
				layer.alert(result1.msg);
			}
		});
	}
	
	// }}}
	// {{{ function subPrescription()
	
	/**
	 * 处方药品提交
	 * */
	this.subPrescription = function(){
		var id = $('#id').val();
		var url = {controller:'Patient',method:'addPrescription'};
    	if (id != '') {
			var url = {controller:'Patient',method:'modPrescription'};
		}
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#prescriptionList').dataTable().api().ajax.reload();
				//更新select
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
		
	}
	
	// }}}
	// {{{ function checkName()
	
	/**
	 * 在患者数据中查询推荐人
	 * */
	/* 
	this.checkName = function(isByName) {
		var recommend_name = $('#recommend_name').val();
		var recommend_tel = $('#recommend_tel').val();
		if (isByName) {
			if (recommend_name == '') {
				layer.msg("请输入推荐者姓名");
				return false;
			}
			self.openAdd('根据名称查找推荐人','manage/patient.html?type=1','800','450')
		} else {
			if (recommend_tel == '') {
				layer.msg("请输入推荐者电话");
				return false;
			}
			self.openAdd('根据电话查找推荐人','manage/patient.html','800','450')
		}
	}
	*/
	this.checkName=function(obj){		
		var request_val=obj.value;	
		var reg1=new RegExp("[0-9]+");
		var reg2=new RegExp("^[\u4e00-\u9fa5]{1,}|[a-zA-Z]{1,}$"); 
		var result1=reg1.test(request_val);
		var result2=reg2.test(request_val);
		if(!result1&&!result2){
				$('div.checkdiv').html('<span class="Validform_checktip Validform_wrong">请输入正确的电话或名称</span>');
			}
			else{
				$('div.checkdiv').html('');
				var url='';
				var str='';
				str='<table id="prescriptionList" class="table table-border table-bordered table-bg table-hover table-sort">';
				str+='<thead><tr class="text-c"><th width="80">姓名</th><th width="140">电话号码</th><th width="50">操作</th></tr></thead>';
				if(result1){					
					 url = {controller:'Patient',method:'getAllPatients',recommend_tel:request_val};
					}
					else if(result2){						
						 url = {controller:'Patient',method:'getAllPatients',recommend_name:request_val};
						}
				self.cmd(gHttp,url,function(data){
					if(data['ttl']==0){
						str='无数据';						
					}
					else{
						str+='<tbody>';
						$.each(data['rows'],function(k,v){							
							str+='<tr><td>'+v.username+'</td><td class="text-c">'+v.telphone+'</td><td class="text-c">';	
							str+='<a style="text-decoration:none" onClick="gAddPatient.selectPatient(\''+v.username+':'+v.telphone+'\');" href="javascript:;" title="关联推荐"><i class="Hui-iconfont">&#xe60e;</i></a></td></tr>';	
						});
						str+='</tbody></table>';
					}	
						
				});
				//var msg=$(this).attr('info');
				layer.tips(str, $(obj), {
					tips: [1,'#78BA32'],
					area:['280px','auto'],	
					time:12000
				});	
				}
		/**/
		}
	
	// }}}
	// {{{ function getPatientTable()
	
	/**
	 * 患者列表
	 * */
	this.getPatientTable = function(isByName){
		var self = this;
		var recommend_name = $('#recommend_name').val();
		var recommend_tel = $('#recommend_tel').val();
		if (isByName) {
			var url = {controller:'Patient',method:'getAllPatients',recommend_name:recommend_name};
		} else {
			var url = {controller:'Patient',method:'getAllPatients',recommend_tel:recommend_tel};
		}
		
		$('#patientList').grid({
			para :  url,
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [{data : 'id',render : function (id, type, row) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'username'},
				     {data:'telphone'},
				     {data:'id',render : function(id, type, row){				    	
				    	 var str = '';				    	 
				    	 str += '<a style="text-decoration:none" onClick="gAddPatient.selectPatient(\"' + row.username + ':' + row.telphone+ '\");" href="javascript:;" title="关联推荐"><i class="Hui-iconfont">&#xe6df;</i></a>';
				    	 return str;
					}
				}
			]
		});
	}
	
	// }}}
	// {{{ function selectPatient()
	
	/**
	 * 关联推荐
	 * */
	this.selectPatient = function(data) {
		var arr = data.split(":");		
		$('#recommend_name').val(arr[0]);
		$('#recommend_tel').val(arr[1]);
		layer.closeAll('tips');
		$('#referrer').val(arr[0]+"  电话："+arr[1]);
	}
	
	
	// }}}
	// {{{ function delPatients()
	
	/**
	 * 删除患者
	 * */
	this.delPatients = function() {
		var ids = $("#patientList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#patientList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'deletePatient',id:ids});
				}
	}
	
	// }}}
	// {{{ function getManageLevelTable()
	
	/**
	 * 等级管理
	 * */
	this.getManageLevelTable = function(){
		$('#levelList').grid({
			para :  {controller:'Patient',method:'getVipLevels',isPage:1},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [{data : 'id',render : function (id, type, row) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'level_name',render:function(value,type,rowData){return '<a href="javascript:;" title="选用该项" onclick="gAddPatient.choseresult(\'vip_level\','+rowData.id+')">'+value+'</a>';}},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'id',render : function(id, type, row){
				    	 gData[id] = row;
				    	 return '<a style="text-decoration:none" class="ml-5" onClick="gAddPatient.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					}
				}
			]
		});
		$('#save').click(function(){
			self.subVipLevel();
		});
	}
	
	// }}}
    // {{{ function edit()
	
	/**
	 * 初始化会员修改
	 * */
	this.edit = function(id) {
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
		
		$.each(gData[id],function(i,v){
			$("#" + i).val(v);
		});
	}
	
	// }}}
	// {{{ function delLevels()
	
	/**
	 * 删除会员
	 * */
	this.delLevels = function() {
		var ids = $("#levelList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#levelList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delVipLevel',id:ids},function(){
					//更新select
					parent.gAddPatient.fillLevels();																		 
				});
				
				}
	}
	
	// }}}
	// function subVipLevel()
	
	/**
	 * 会员等级提交
	 * */
	this.subVipLevel = function(){
		var id = $('#id').val();
    	var url = {controller:'Patient',method:'addVipLevel',};
    	if (id != '') {
			var url = {controller:'Patient',method:'modVipLevel',id:id};
		}
    	
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#levelList').dataTable().api().ajax.reload();
				//更新select
				parent.gAddPatient.fillLevels();
				
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	// }}}
	// {{{ function getManageExamineTable()
	
	/**
	 * 检查项管理
	 * */
	this.getManageExamineTable = function(){
		var keyword = $("#keyword").val();
		$('#itemList').grid({
			para : {controller:'Patient',method:'getExamineItems',isPage:1,keyword:keyword},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [
				{data : 'id',render : function (id, type, row) {
				    	return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
					}
				},
				{data:'item_name'},
				{data:'is_usual',render:function(value){value=(value==1)?'<span class="label label-success radius">是</span>':'<span class="label label-default radius">否</span>'; return value;}},
				{data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				{data:'id',render : function(value,type,row){
						var str = '';
						gData[value] = row;
						str += '<a style="text-decoration:none" onClick="gAddPatient.edit('+value+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
						str += '<a style="text-decoration:none" class="ml-5" id=' + value + ' onClick="gAddPatient.selectItem('+value+', \''+row.item_name+'\');" href="javascript:void(0)"><i class="Hui-iconfont" title="选用该项">&#xe676;</i></a>';
						return str;
					}
				}
			]
		});
		$('#is_usual1').on('click',function(){										 
			var msg=$(this).attr('info');
			layer.tips(msg, $(this), {
				tips: [3,'#78BA32'],
				time:9000
			});
		});
		$('#save').click(function(){
			self.subExamineItems();
		});
		
		$('#qry').click(function(){
			self.getManageExamineTable();
		});
		self.onloadCss();
	}
	
	// }}}
	// {{{ function selectItem()
	
	/**
	 * 选择该项目
	 * */
	this.selectItem = function(id,item_name) {
		var topdocument=$(window.parent.document).find("#span_examine_items");			
		if ($(window.parent.document).find("#examine_items_" + id ).length<1) {
			$(topdocument).append('<div class="check-box col-95" style="overflow:hidden;height:25px;line-height:25px;" info="'+item_name+'"><input type="checkbox" id="examine_items_' + id + '" name="examine_items[]" value="' + id + '" checked/><label>' + item_name + '</label></div>');
			
		}else{			
			parent.gAddPatient.checkItems(id);			
		}
		$("#tr_" + id).prop('checked', true);			
		parent.layer.msg('选用该项成功!',{icon:1});					
		parent.gAddPatient.onloadCss();	
	}
	
	// }}}
	// {{{ function checkItems()
	
	/**
	 * 选中item
	 * */
	this.checkItems = function(id) {
		$("#examine_items_" + id ).prop('checked', true);
	}
	
	// }}}
	// {{{ function delItems()
	
	/**
	 * 删除项目
	 * */
	this.delItems = function() {
		var ids = $("#itemList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#itemList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delExamineItem',id:ids},function(){
					//更新select
					parent.gAddPatient.fillItems();																			
				});		
				
				}
	}
	
	// }}}
	// {{{ function subExamineItems()
	
	/**
	 * 提交检查项
	 * */
	this.subExamineItems = function(){
		var id = $('#id').val();
		var url = {controller:'Patient',method:'addExamineItem'};
    	if (id != '') {
			var url = {controller:'Patient',method:'modExamineItem',id:id};
		}
    	
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#itemList').dataTable().api().ajax.reload();				
				//添加时，更新select
				parent.gAddPatient.fillItems();
				//if (id == '' && result1.data.is_usual == '1') {					
					//
				//}				
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	// }}}
	// {{{ function getManageSourceTable()
	
	/**
	 * 来源管理
	 * */
	this.getManageSourceTable = function(diaObj){
		$('#sourceList').grid({
			para :  {controller:'Patient',method:'getDataSource',list:true},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c namelist',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [{data : 'id',render : function (id, type, rowData) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'" info="'+rowData.title+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'title',render:function(value,type,rowData){return '<a href="javascript:;" title="选用该项" onclick="gAddPatient.choseresult(\'source\','+rowData.id+',\''+value+'\')">'+value+'</a>';}},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'id',render : function(id, type, row){
				    	 gData[id] = row;
				    	 return '<a style="text-decoration:none" class="ml-5" onClick="gAddPatient.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					}
				}
			]
		});
		$('#save').click(function(){
			self.subSource();
		});
	}
	
	// }}}
	// {{{ function delSource()
	//删除来源
	this.delSource = function() {
		var ids = $("#sourceList").getSelectedAll();
		var checkstr=false;		
		$.each(ids,function(k,v){			
			if($('input#tr_'+v).attr('info')=='熟人推荐'){
				checkstr=true;					
			}
			else if($('input#tr_'+v).attr('info')=='不明来源'){
				checkstr=true;
			}
		});
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else if(checkstr){
				layer.msg('“熟人推荐/不明来源”是默认项，不可删除！',{icon:2});
			}
			
			else{
				var obj = $("#sourceList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delSource',id:ids},function(){
					//更新select
					parent.gAddPatient.fillSource();																	   
				
				});
				
				}
	}
	
	// }}}
	// {{{ function subSource()
	
	/**
	 * 来源提交
	 * */
	this.subSource = function(content){
		var id = $('#id').val();
    	var url = {controller:'Patient',method:'addSource'};
    	if (id != '') {
			var url = {controller:'Patient',method:'modSource'};
		}
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#sourceList').dataTable().api().ajax.reload();
				//更新select
				parent.gAddPatient.fillSource();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	// }}}
    // {{{ function getManageRecptionistTable()
	
	/**
	 * 前台接待列表
	 * */
	this.getManageReceptionistTable = function(diaObj){
		$('#receptList').grid({
			para :  {controller:'Patient',method:'getReceptionist',isPage:1},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [{data : 'id',render : function (id, type, rowData) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'" info="'+rowData.user_name+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'user_name',render:function(value,type,rowData){return '<a href="javascript:;" title="选用该项" onclick="gAddPatient.choseresult(\'receptionist_id\','+rowData.id+')">'+value+'</a>';}},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'id',render : function(id, type, row){
				    	 gData[id] = row;
				    	 return '<a style="text-decoration:none" class="ml-5" onClick="gAddPatient.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					}
				}
			]
		});
		$('#save').click(function(){
			self.subReceptionist();
		});
		
	}
	
	// }}}
	// {{{ function delRecept()
	//删除前台接待
	this.delRecept = function() {
		var ids = $("#receptList").getSelectedAll();
		var checkstr=false;	
		$.each(ids,function(k,v){			
			if($('input#tr_'+v).attr('info')=='人员不明'){
				checkstr=true;					
			}			
		});
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}else if(checkstr){
				layer.msg('“人员不明”是默认项，不可删除！',{icon:2});
			}
			else{
				var obj = $("#receptList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delReceptionist',id:ids},function(){
					//更新select
					parent.gAddPatient.fillReceptionist();															 
																								 
				});		
		}
	}
	
	// }}}
	// {{{ function subRecptionist()
	
	/**
	 * 前台接待提交
	 * */
	this.subReceptionist = function(){		
		var id = $('#id').val();
			
    	var url = {controller:'Patient',method:'addReceptionist'};
    	if (id != '') {
			var url = {controller:'Patient',method:'modReceptionist',id:id};
		}
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#receptList').dataTable().api().ajax.reload();
				//更新select
				parent.gAddPatient.fillReceptionist();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});				
		$('#formEdit').submit();
			
	}
	
	// }}}
	// {{{ function getManageDoctorTable()
	
	/**
	 * 医生管理
	 * */
	this.getManageDoctorTable = function(){
		$('#doctorList').grid({
			para :  {controller:'Patient',method:'getDoctors',isPage:1},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [{data : 'id',render : function (id, type, row) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'doctor_name',render:function(value,type,rowData){return '<a href="javascript:;" title="选用该项" onclick="gAddPatient.choseresult(\'doctor_id\','+rowData.id+')">'+value+'</a>';}},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'id',render : function(id, type, row){
				    	 gData[id] = row;
				    	 return '<a style="text-decoration:none" onClick="gAddPatient.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					}
				}
			]
		});
		$('#save').click(function(){
			self.subDoctor();
		});
		
	}
	
	// }}}
	// {{{ function delDoctor()
	//删除医生
	this.delDoctor = function() {
		var ids = $("#doctorList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#doctorList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delDoctor',id:ids},function(){
					//更新select
					parent.gAddPatient.fillDoctors();																	   
				});
				
				}
		
	}
	
	// }}}
	// {{{ function subDoctor()
	
	/**
	 * 医生提交
	 * */
	this.subDoctor = function(){
		var id = $('#id').val();			
		var url = {controller:'Patient',method:'addDoctor'};
    	if (id != '') {
			var url = {controller:'Patient',method:'modDoctor',id:id};
		}		
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#doctorList').dataTable().api().ajax.reload();
				//更新select
				parent.gAddPatient.fillDoctors();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
		
	}
	
	// }}}
	// {{{ function getManageDepartmentTable()
	
	/**
	 * 科室管理
	 * */
	this.getManageDepartmentTable = function(){
		$('#departmentList').grid({
			para :  {controller:'Patient',method:'getDepartments',isPage:1},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			field : [{data : 'id',render : function (id, type, row) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'department_name',render:function(value,type,rowData){return '<a href="javascript:;" title="选用该项" onclick="gAddPatient.choseresult(\'departmentSel\','+rowData.id+')">'+value+'</a>';}},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'id',render : function(id, type, row){
				    	 gData[id] = row;
				    	 return '<a style="text-decoration:none" class="ml-5" onClick="gAddPatient.edit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					}
				}
			]
		});
		$('#save').click(function(){
			self.subDepartment();
		});
		
	}
	
	// }}}
	// {{{ function delDepartment()
	//删除科室
	this.delDepartment = function() {
		var ids = $("#departmentList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#departmentList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delDepartment',id:ids},function(){
					//更新select
					parent.gAddPatient.fillDepartments();								   
																							   
				});
				
				}
		
	}
	
	// }}}
	// {{{ function subDepartment()
	
	/**
	 * 科室提交
	 * */
	this.subDepartment = function(){
		var id = $('#id').val();
		var url = {controller:'Patient',method:'addDepartment'};
    	if (id != '') {
			var url = {controller:'Patient',method:'modDepartment',id:id};
		}
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){
				$('#departmentList').dataTable().api().ajax.reload();
				//更新select
				parent.gAddPatient.fillDepartments();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	// }}}
	// {{{ function getManageDiseaseTable()
	
	/**
	 * 疾病管理
	 * */
	this.getManageDiseaseTable = function(){
				
		$('#diseaseList').grid({
			para :  {controller:'Patient',method:'getDiseases',isPage:1},
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}										
							],
			field : [{data : 'id',render : function (id, type, row) {
		                     return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
	                     }
                     },
                     {data: 'id' },
				     {data:'disease_name',render:function(value,type,rowData){return '<a href="javascript:;" title="选用该项" onclick="gAddPatient.choseresult(\'disease_type\','+rowData.id+')">'+value+'</a>';}},
				     {data:'remark',render:function(value){return value.substr(0,16)+'...';}},
				     {data:'id',render : function(id, type, row){				    	 
				    	 return '<a style="text-decoration:none" onClick="gAddPatient.editDisease('+id+', \''+row.disease_name+'\', \''+row.remark+'\');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					 }
				}
			]
		});
		
		$('#save').click(function(){
			self.subDisease();
		});
	}
	
	// }}}
    // {{{ function editDisease()
	
	/**
	 * 初始化疾病修改
	 * */
	this.editDisease = function(id, disease_name, remark) {
		$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","1");
		$("#id").val(id);
		$("#disease_name").val(disease_name);
		$("#remark").val(remark);
	}
	
	// }}}
	// {{{ function delDisease()
	//删除病症
	this.delDisease = function() {
		var ids = $("#diseaseList").getSelectedAll();
		if(ids==''){
			layer.msg('请选择要删除的项目',{icon:2});
			}
			else{
				var obj = $("#diseaseList").dataTable();
				self.openDel(obj,{controller:'Patient',method:'delDisease',id:ids},function(){
					//更新select
					parent.gAddPatient.fillDiseases();																		
				});
				
				}
		
	}
	
	// }}}
	// {{{ function subDisease()
	
	/**
	 * 疾病提交
	 * */
	this.subDisease = function(){
		var id = $('#id').val();
		var url = {controller:'Patient',method:'addDisease'};
    	if (id != '') {
			var url = {controller:'Patient',method:'modDisease',id:id};
		}
		$('#formEdit').checkAndSubmit('save', url,function(result1){
			if(result1.statu){				
				//更新select
				$('#diseaseList').dataTable().api().ajax.reload();
				parent.gAddPatient.fillDiseases();
				$.Huitab("#tab-category .tabBar span","#tab-category .tabCon","current","click","0");
				//self.getManageDiseaseTable();
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
		$('#formEdit').submit();
	}
	
	// }}}
	// {{{ function closeWin()
	
	/**
	 * 关闭窗口
	 * */
	this.closeWin = function(){
		var win = top.window;
		try{
			if(win.opener) win.opener.focus();
			win.opener = null;
		}catch(ex){}finally{
			win.close();
		}
	}

	// }}}
	// {{{ function refreshOpener()
	
	/**
	 * 刷新父窗口
	 * */
	
	this.refreshOpener = function(){
		var win = top.window;
		try{
			if(win.opener) {
				//win.opener.location.reload();
				win.opener.openObj.init();
			}
			win.opener = null;
		}catch(ex){}finally{
			win.close();
		}
	}
	
	// }}}
	// {{{ function changeAge()
	
	/**
	 * 当年龄改变时
	 * */
	
	this.changeAge = function (){
		var timestamp = new Date();
		var year = timestamp.getFullYear();
		var birthday = $('#birthday').val();
		if (birthday != '') {
			//有日期数据时计算，解决为空时age=NaN的情况
			var arr = birthday.split('-');
			var age = year - parseInt(arr[0]);
			$("#age").val(age);
		}
	}
	
	// }}}
	// {{{ function getToday()
	
	/**
	 * 获取当天日期
	 * */
	this.getToday = function() {
		var timestamp = new Date();
		var year = timestamp.getFullYear();
		var month = timestamp.getMonth() + 1;
		var day = timestamp.getDate();		
		month = month<10 ? '0' + month : month;
		day = day<10 ? '0' + day : day;		
		return year + '-' + month + '-' + day;
	}
	
	// }}}
	// {{{ function getToday()
	
	/**
	 * 选中项目
	 * */
	
	this.choseresult=function(id,val,title){		
		var topWindow=$(window.parent.document);		
		topWindow.find('#'+id).val(val);
		if(id=='source'){			
			if(title=='熟人推荐'){
				topWindow.find("div#source_recommend_name").show();
				topWindow.find("div#sourceDetail").hide();
			}else{
				topWindow.find("div#source_recommend_name").hide();
				topWindow.find("div#sourceDetail").show();
			}
		}
		var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
		parent.layer.close(index);		
	}
	
	//查重名
	this.getsamelist=function(obj,val,type){		
		if(val!=''&&val!=undefined){
			url = {controller:'Patient',method:'getDataByName',keywords:$.trim(val),type:type};
			self.cmd(gHttp,url,function(data){							
				if(data.statu){					
					layer.tips('存在同名称的项目，请修改名称！', $(obj), {
						tips: [3,'#f37b1d'],
						time:3000
					});						
				}				
			});
		}
		
	}
	//打开邮件接口配置页面
	this.emailsetting=function(){
		layer.open({
			  type: 2, 
			  title:'修个邮件配置参数',
			  content: '../../../email/config.html',
			  area: ['660px', '320px'],
			  
			
		});
		
	}
	//打开短信接口配置页面
	this.msgsetting=function(){
		layer.open({
			  type: 2, 
			  title:'修个短信配置参数',
			  content: '../../../duanxin/config.html',
			  area: ['660px', '320px'],
			  
			
		});
		
	}
	
	//发送短信
	this.sendmsg=function(){
		
		var receiver=$('#channel_info').val();
		var content=$('#message').val();
	
		if(content==""){
			layer.alert('邮件内容为空'); 
			return false;
		}
		self.cmd(gHttp,{controller:'Wuxian',method:'sendmessage',mobile:receiver,content:content},function(ret){	
			if(ret.statu){
				layer.msg('短信发送成功', {icon: 1});
			}else{
				layer.alert(ret.msg); 	
			}
		});
		
	}
	
	//如果开启了积分规则，则显示积分规则
	this.showScoreRule = function(){
		self.cmd(gHttp,{controller:'CommodityRule',method:'get',id:7},function(ret){	
			if(ret.statu){
				var data = ret.data;
				if (data.status == 1) {
					var score = $("#current_price")=='' ? 0 : Number($("#current_price"));
					$("#span_score_rule").html('1/' + data.score + '，即每1元可获得积分' + data.score + '个');
					$("#span_score_get").html(score*data.score);
					$("#score").val(data.score);
					$("#div_score_rule,#div_score_get").show();
				} else {
					$("#div_score_rule,#div_score_get").hide();
					$("#span_score_rule").html('');
					$("#span_score_get").html('');
					$("#score").val(0);
				}
			}else{
				layer.alert(ret.msg); 	
			}
		});
	}

	
}

