/**
 * 网站图片管理
 * */
function PicManager() {
	BaseFunc.call(this);
	var self = this;
	this.setChildUrl = function(obj,id1,id2) {		
		if($.trim(obj.value)==''||obj.value=='undefined'){				
			$('#'+id1).val('departments');
			$('#'+id2).val('departments');			
			$('#childDiseaseDiv,#childDiseaseDiv1').hide();			
		}
		else{			
			var value=window.location.origin+'/'+$(obj).find('option:selected').attr('flag');
			$('#'+id1).val(value);
			$('#'+id2).val(value);
			}
	   
    }
	// {{{ function initPopList()
	
	/**
	 * 初始化弹窗列表
	 * */
	this.initPopList = function() {
		$(function(){
			$.Huihover(".portfolio-area li");  			
			self.cmd(gHttp,{controller:'PicManager',method:'getAd'},function(result1){
				if(result1.statu){
					$.each(result1.data,function(i,obj){
						 var kind = obj.kind;
                         $('#show_top'+kind).html(obj.name);
						 $('#show_img'+kind).attr('src',obj.img);
						 $('#show_img'+kind).attr('kid',obj.id);
					});
				}else{
					layer.alert(result1.msg,{icon:2});
				}

				$('.page_attr').click(function(){				
					var kind = $(this).attr('attr');
					var id = $('#show_img'+kind).attr('kid');
					if(id == ''){
						id = 0;
					}
					var flag = $(this).attr('flag');
					var url = 'pop_edit.html?kind=' + kind + '&flag=' + flag + '&id=' + id;
					self.openEdit('编辑弹窗信息', url);
				});
				
			});
		})
	}
	
	// }}}
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
	// {{{ function initPopEdit()
	
	/**
	 * 初始化弹窗编辑
	 * */
	this.initPopEdit = function() {
		$(function(){
			//获取参数 
			var para = self.parseUrl(window.location.href);			
			var k = 5;
			var zb = {zb1:'',zb2:'',zb3:'',zb4:''};
			var zb_defined = {};
			if (para.id != undefined) {
				//有id，则是编辑
				self.cmd(gHttp,{controller:'PicManager',method:'get',id:para.id},function(result1){
					if(result1.statu){
						//console.log(result1.data);
						$('#formEdit').frmFill('',result1.data);						
						$('#img').attr('src',result1.data.src);
						$('#unique_flag').val(para.flag);
						if(result1.data.link!=''){
							$('#hurl1').val(result1.data.link);
						}
						if(result1.data.config){
							$.each(result1.data.config,function(i,obj){
								var divPre = '';
								if (i != 'zb1' && i!= 'zb2' && i!= 'zb3' && i!= 'zb4') {
									//自定义
									var str = '';
									var currentIndex = k;
									
									if (obj[5] == undefined) {
										obj[5] = 'red';
									}
									str += '<div url="'+obj[4]+'" flag="'+k+'" class="move_div" id="move_div'+k+'" style="position:absolute;z-index:2;cursor:move;border:2px solid '+obj[5]+';left:'+obj[0]+'px;top:'+obj[1]+'px;width:'+obj[2]+'px;height:'+obj[3]+'px;"></div>';
									zb['zb'+k] = [obj[0],obj[1],obj[2],obj[3],obj[4],obj[5]];
									
									//初始化自定义按钮数据
									zb_defined[k] = zb['zb'+k];
									
									k++;
									$('#div_new').append(str);
									//注册事件
									self.addEventToDiv('four', currentIndex);
								} else {
									if(obj != ''){
										if (obj[4] == undefined) {
											obj[4] = 'red';
										}
										
										var divPre = '';
										if (i=='zb1') divPre = 'one';
										if (i=='zb2') divPre = 'two';
										if (i=='zb3') divPre = 'three';
										if (i=='zb4') divPre = 'six';
										
										$('#' + divPre + '_left').val(obj[0]);
										$('#' + divPre + '_top').val(obj[1]);
										$('#' + divPre + '_width').val(obj[2]);
										$('#' + divPre + '_height').val(obj[3]);
										$("#" + divPre + "_color option[value='"+obj[4]+"']").attr('selected', true);
										$('#' + divPre + '_div').show();
										$('#' + divPre + '_div').css({left:obj[0]+'px',top:obj[1]+'px',width:obj[2]+'px',height:obj[3]+'px',border:'1px solid ' + obj[4],cursor:'move'});
										
										zb[i] = [obj[0],obj[1],obj[2],obj[3],obj[4]];	
									}
								}
							});	
						}
					}else{
						layer.alert(result1.msg,{icon:2});
					}
					$('.confirm').eq(0).click();
					$('#kind').val(para.kind);
				});
			}
			
			//初始化自定义按钮数据
			self.fillDiyBtn(zb_defined);
			
			//初始化科室链接数据
			
			//全图链接***链接参数绑定
			//链接方式切换
			$('input[name="radio_link1"]').click(function(){
				$(this).attr('checked',true);
				var value=$("#hurl_link1").val();
				if($(this).val()==1){
					$("#hurl1").val(value);						
				}
				else{
					$("#link_box1").val(value);
				}											
				$("#childUrlDiv1").hide();
				$("#childUrlDiv1").html('');
				$("#childDiseaseDiv1").html('');
				$('#htmlUrl1').val('');
				
				var id = $(this).attr('id');
				$("div[id^='div_link']").hide();
				$("#div_" + id).show();
			});
			//初始化科室链接数据
			$("#htmlUrl1").bindDepartment();
			$('#htmlUrl1').change(function(){
				$('span[id^="child"]').hide();
				$('span[id^="child"]').html('');
				var sel = $(this).val();
				$('#childDiseaseDiv1').empty();
				$('#hurl_link1').val(window.location.origin+'/'+sel);
				$('#link_box1').val(window.location.origin+'/'+sel);
				
				if(sel=='departments'){
					$('#hurl_link1').val('');
					$('#link_box1').val(sel);
					self.cmd(gHttp,{controller:'Navigation',method:'getHtmlUrlByPara',op:'departments'},function(result1){
						if(result1.statu){
							var isDisease = '';	
							//var idlist={inputid1:'hurl_link1',inputid2:'link_box1',selid1:'childDiseaseDiv'};
							isDisease = 'onChange="gPicManager.setChildUrl(this,\'hurl_link1\',\'link_box1\');getDepartSubTree(this.value,\' \',\'hurl_link1\',\'link_box1\',\'childDiseaseDiv1\')"';
							var str='<select class="select" name="childUrl1" id="childUrl1" '+isDisease+'>';
							str+='<option value="">&nbsp;请选择科室&nbsp;</option>';					
							for (var i=0;i<result1.data.length;i++){
								if(isDisease == ''){
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].url+'">'+result1.data[i].name+'</option>';
								}else{
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].id+'">'+result1.data[i].name+'</option>';
								}
							}
							str+="</select>";
							$('#childUrlDiv1').html(str);
							$('#childUrlDiv1').show();							
						}else{
							layer.alert(result1.msg);
						}
					
						return false;
					});
				}else if(sel == "channel"){
					self.cmd(gHttp,{controller:'Channel',method:'query'},function(result1){
						var str='<select class="select" name="channelList" onChange="setChannel(this.value)" id="channelList">';
						str += '<option value="">&nbsp;请选择&nbsp;</option>';
						for (var i=0;i<result1.rows.length;i++){
							str +='<option value="'+result1.rows[i].shortname+'">'+result1.rows[i].name+'</option>';
						}
						$('#childUrlDiv1').show();
						$('#childUrlDiv1').html(str);
						$('#hurl_link1').val('');
						$('#link_box1').val(sel);
					});
				}else{
					$('#childUrlDiv1').hide();
					$('#childUrlDiv1').html('');
				}
			});
			
			
			//hurl 改变时把值写入hurl_link
			$('input#hurl1').change(function(){
				$('input#hurl_link1').val($(this).val());								
			});
			/**全图链接over*/
			
			//自定义链接
			//链接方式切换
			$('input[name="radio_link"]').click(function(){
				$(this).attr('checked',true);
				var value=$("#four_url").val();
				if($(this).val()==1){
					$("#hurl").val(value);						
				}
				else{
					$("#link_box").val(value);
				}											
				$("#childUrlDiv").hide();
				$("#childUrlDiv").html('');
				$("#childDiseaseDiv").html('');
				$('#htmlUrl').val('');
				
				var id = $(this).attr('id');
				$("div[id^='div_link']").hide();
				$("#div_" + id).show();
			});
			//初始化科室链接数据
			$("#htmlUrl").bindDepartment();
			$('#htmlUrl').change(function(){
				$('span[id^="child"]').hide();
				$('span[id^="child"]').html('');
				var sel = $(this).val();
				$('#childDiseaseDiv').empty();
				$('#four_url').val(window.location.origin+'/'+sel);
				$('#link_box').val(window.location.origin+'/'+sel);
				
				if(sel=='departments'){
					$('#four_url').val('');
					$('#link_box').val(sel);
					self.cmd(gHttp,{controller:'Navigation',method:'getHtmlUrlByPara',op:'departments'},function(result1){
						if(result1.statu){
							var isDisease = '';							
							isDisease = 'onChange="gPicManager.setChildUrl(this,\'four_url\',\'link_box\');getDepartSubTree(this.value,\' \',\'four_url\',\'link_box\',\'childDiseaseDiv\')"';
							var str='<select class="select" name="childUrl" id="childUrl" '+isDisease+'>';
							str+='<option value="">&nbsp;请选择科室&nbsp;</option>';					
							for (var i=0;i<result1.data.length;i++){
								if(isDisease == ''){
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].url+'">'+result1.data[i].name+'</option>';
								}else{
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].id+'">'+result1.data[i].name+'</option>';
								}
							}
							str+="</select>";
							$('#childUrlDiv').html(str);
							$('#childUrlDiv').show();
							
						}else{
							layer.alert(result1.msg);
						}
					
						return false;
					});
				}else if(sel == "channel"){
					self.cmd(gHttp,{controller:'Channel',method:'query'},function(result1){
						var str='<select class="select" name="channelList" onChange="setChannel(this.value)" id="channelList">';
						str += '<option value="">&nbsp;请选择&nbsp;</option>';
						for (var i=0;i<result1.rows.length;i++){
							str +='<option value="'+result1.rows[i].shortname+'">'+result1.rows[i].name+'</option>';
						}
						$('#childUrlDiv').show();
						$('#childUrlDiv').html(str);
						$('#four_url').val('');
						$('#link_box').val(sel);
					});
				}else{
					$('#childUrlDiv').hide();
					$('#childUrlDiv').html('');
				}
			});	
			
			
			
			//hurl 改变时把值写入hurl_link
			$('input#hurl').change(function(){
				$('input#four_url').val($(this).val());								
			});
			/**自定义链接over**/
			
			self.onloadCss();
			//保存
			$('#save').click(function(){				
				self.savePop(zb,para);
			});
			
			//弹出提示
			$('#link_box1').on('mouseenter',function(){
				var msg=$(this).attr('info');
				layer.tips(msg, $(this), {
					tips: [3, '#78BA32'],
					area: ['500px', 'auto'],
					time:12000
				});											  
														  
			});
			
			// 注册拖动对象，独立对象统一注册
			self.addEventToDiv('one');
			self.addEventToDiv('two');
			self.addEventToDiv('three');
			self.addEventToDiv('six');
			
			//注册点击事件
			$("#one_div").click(function(){
				$("#add_div").val('1');
				$("#add_div").change();
			});
			$("#two_div").click(function(){
				$("#add_div").val('2');
				$("#add_div").change();
			});
			$("#three_div").click(function(){
				$("#add_div").val('3');
				$("#add_div").change();
			});
			$("#six_div").click(function(){
				$("#add_div").val('6');
				$("#add_div").change();
			});
			
			//自定义添加，默认为空白
			$('.confirm').click(function(){
				var attr = $(this).attr('attr');
				$('#'+attr+'_width').val(0);
				$('#'+attr+'_height').val(0)
				$('#'+attr+'_top').val(0)
				$('#'+attr+'_left').val(0)
				$("#three_color option[value='red']").attr('selected', true); //默认红色
				$('#four_url').val("");
				$('#'+attr+'_div').css({height:'0px',width:'0px',top:'0px',left:'0px',border:'2px solid red'});
				$('#'+attr+'_div').show();

				var html = '<div flag="'+k+'" class="move_div" id="move_div'+k+'" style="position:absolute;z-index:2;border:2px solid red;top:0px;left:0px;width:0px;height:0px;"></div>';
				$('#div_new').append(html);
				$('#edit_confirm').attr('flag',k);
				
				//注册事件
				self.addEventToDiv(attr, k);
				zb['zb'+k] = [0,0,0,0,'','red'];
				zb_defined[k] = zb['zb'+k];
				self.fillDiyBtn(zb_defined, k);
				
				k++;
			});
			
			//自定义按钮操作
			$('#diy_choise').click(function(){
				if($(this).find('option').length<2){
					layer.tips('您还未添加任何自定义按钮，请点击右侧按钮新增',$(this),{tips:[4,'#dd514c'],time:3000});
					
				}
				
				
			});
			$('#diy_choise').change(function(){
				var this_val=$(this).val();
				var $obj=$('#move_div'+this_val);
				var data = zb['zb'+this_val];
				
				$('#four_left').val(data[0]);
				$('#four_top').val(data[1]);
				$('#four_width').val(data[2]);
				$('#four_height').val(data[3]);
				$("#four_color option[value='"+data[4]+"']").attr('selected', true);
				$obj.css({left:data[0]+'px',top:data[1]+'px',width:data[2]+'px',height:data[3]+'px',border:'1px solid ' + data[4],cursor:'move'});
				
				layer.tips($(this).find("option:selected").text(), $obj, {tips: [2, '#78BA32'],time:6000});
											 
			});
			
			//保存当前的按钮配置
			$('#edit_confirm').click(function(){
				var flag = $(this).attr('flag');
				var width = $.trim($('#four_width').val());
				var height = $.trim($('#four_height').val());
				var top = $.trim($('#four_top').val());
				var left = $.trim($('#four_left').val());
				var co = $('#four_color').val();
				if($('#diy_choise').val()==''){
					var msg='您还没有添加或选择要编辑的按钮项，请选择一个按钮，如果没有按钮请点击“添加新项”新建一个';
					layer.tips(msg,'#four_confirm', {
						tips: [3, '#78BA32'],
						area: ['300px', 'auto'],
						time:6000
					});	
					return false;
					}
				if(isNaN(width) || isNaN(height) || isNaN(top) || isNaN(left)){
					layer.msg('您还未配置该按钮的参数!如果您不需要添加该项，请点击删除当前',{icon:2});
					return false;
				}
				if(width == 0 && height == 0){
					layer.msg('宽度和高度不能为零!如果您不需要添加该项，请点击删除当前',{icon:2});
					return false;
				}
				var checkval=$('input[name="radio_link"]:checked').val();				
				if(checkval==0){
					$("#link_msg").html('');
					var strRegex = "(.)*((\.html){1}|(\.php){1}(.)*)$";
					var re = new RegExp(strRegex);
					var lkval=$('#link_box').val();	
					if($.trim(lkval)==''){
						$("#link_msg").html('<span class="Validform_checktip Validform_wrong">请从上面选择链接</span>');
						return false;
					}
					
					if(re.test(lkval)){
						$("#link_msg").html('<span class="Validform_checktip Validform_right"></span>');
					} else {
						$("#link_msg").html('<span class="Validform_checktip Validform_wrong">请选择子项</span>');
						return false;
					}
					
				}
				if(checkval==1){
					$("#input_msg").html('');
					//var strRegex = "/^((https|http)://)+[a-z0-9A-Z]?/$";
					var strRegex = "http:\/\/|https:\/\/(.)*";
					var re = new RegExp(strRegex);
					var inval=$('#hurl').val();	
					if($.trim(inval)==''){
						$("#input_msg").html('<span class="Validform_checktip Validform_wrong">链接不能为空</span>');
						return false;
					}
					
					if(re.test(inval)){
						$("#input_msg").html('<span class="Validform_checktip Validform_right"></span>');
					} else {
						$("#input_msg").html('<span class="Validform_checktip Validform_wrong">请输入以http/https开头的绝对地址，并确保该地址能在IE中正常访问</span>');
						return false;
					}
					
				}
				
				
				$('#move_div'+flag).css({height:height+'px',width:width+'px',top:top+'px',left:left+'px',border:'1px solid '+co});
				var url = $('#four_url').val();
				zb['zb'+flag] = [left,top,width,height,url,co];
				zb_defined[flag] = [left,top,width,height,url,co];
				layer.msg('按钮设置成功！',{icon:1});
			});
			
			//删除
			$('#delete_confirm').click(function(){
				var width = '0';
				var height = '0';
				var top = '0';
				var left = '0';
				var co = '';
				var flag = $(this).attr('flag');
				$('#move_div'+flag).css({height:height+'px',width:width+'px',top:top+'px',left:left+'px',border:'1px solid '+co});
				var url = '';
				zb['zb'+flag] = [left,top,width,height,url];
				$('#four_width').val('0');
				$('#four_height').val('0');
				$('#four_top').val('0');
				$('#four_left').val('0');
			});
				
			$('#div_new').on('click','.move_div',function(){
				//自定义的
				var flag = $(this).attr('flag');
				var height = parseInt($(this).css('height'));
				var width = parseInt($(this).css('width'));
				var top = parseInt($(this).css('top'));
				var left = parseInt($(this).css('left'));
				var url = $(this).attr('url');
				if(url != ''){
					$('#four_url').val(url);
					$('#hurl').val(url);
				}else{
					$('#four_url').val('');
					$('#hurl').val('');
				}
				$('#edit_confirm').attr('flag',flag);
				$('#delete_confiem').attr('flag',flag);
				$('#four_width').val(width);
				$('#four_height').val(height);
				$('#four_left').val(left);
				$('#four_top').val(top);
				
				$("#add_div").val('4');
				$("#add_div").change();
				
				$("#diy_choise").val(flag)
			});
			
			
		
			//图片操作
			$('#add_div').change(function(){
				var flag = $(this).val();
				$('.div_show').hide();
				$('#html'+flag).show();
				var parameters=parseInt($('#html'+flag).find('.input-text').eq(0).val())+parseInt($('#html'+flag).find('.input-text').eq(1).val());				
				var state=parameters<=20?'未启用':'己启用';
				switch(flag){
					case '1':layer.tips('关闭按钮一，'+state, '#one_div', {tips: [2, '#78BA32'],time:6000});break;
					case '6':layer.tips('关闭按钮二，'+state, '#six_div', {tips: [2, '#78BA32'],time:6000});break;
					case '2':layer.tips('在线咨询按钮，'+state, '#two_div', {tips: [2, '#78BA32'],time:6000});break;
					case '3':layer.tips('在线问答按钮，'+state, '#three_div', {tips: [2, '#78BA32'],time:6000});break;					
					}
			});
			
			//返回
			$('#back').click(function(){
				var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
				parent.layer.close(index);
			});
			
		});
	}//popjs
	
	// }}}
	// {{{ function fillDiyBtn()
	/**
	 * 填充自定义按钮
	 * */
	this.fillDiyBtn = function(definedBtn, selectedIndex) {
		var diybt='<option value="">--请选择--</option>';
		$.each(definedBtn, function(i,v){
			//i从5开始，1-4为其它按钮，从5开始为自定义按钮
			var btn_index = i-4;
			var selected = '';
			if (selectedIndex != undefined && selectedIndex == i) {
				selected = 'selected';
			}
			diybt+='<option value="'+i+'" '+selected+'>自定义按钮'+btn_index+'</option>';
		});
		$('#diy_choise').html(diybt);
	}
	
	// }}}
	// {{{ function deleteImg()
	this.deleteImg = function(){
		$('#img').removeAttr('src');
		$('#pic').val('');
		$(this).remove();
	}
	
	// }}}
	// {{{ function savePop()
	
	/**
	 * 保存弹窗设置
	 * */
	this.savePop = function(zb, para) {
		var idPre = ['one', 'two', 'three', 'four', 'six'];
		var dataFormat = self.formatZBData(idPre, zb, para);
		zb = dataFormat[0];
		var i = 5;
		var new_zb = {};
		for(var key in zb ) {
			if (key == 'zb1'){ new_zb['zb1'] = zb[key];}
			else if (key == 'zb2'){ new_zb['zb2'] = zb[key];}
			else if (key == 'zb3'){ new_zb['zb3'] = zb[key];}
			else if (key == 'zb4'){ new_zb['zb4'] = zb[key];}
			else {
				if (zb[key] != '') {
					if (zb[key][0] == '0' && zb[key][1] == '0') {
					} else {
						new_zb['zb' + i] = zb[key];
						i++;
					}
				}
			}
			
		}

        zb = new_zb;       
		var area = dataFormat[1];	
		switch($('#unique_flag').val()){
			case 'special_one':name="前端所有页面中心弹窗";break;
			case 'special_two':name="前端所有页面右下角弹窗";break;
			case 'special_three':name="前端所有页面左侧弹窗";break;
			case 'special_four':name="所有页面弹窗";break;
			case 'special_five':name="所有页面弹窗";break;
		}
		
		var img = $("#img").attr('src');
		if (img == '') {
			$('.leftpic').find('div.col-3').html('<span class="Validform_checktip Validform_wrong">图片不能为空！</span>');
			return false;
		} else {
			$('.leftpic').find('div.col-3').html('<span class="Validform_checktip Validform_right"></span>');
		}
		
		var radioget=$('input[name="radio_link1"]:checked').val();
		var linkval=$('#link_box1').val();
		var hurlval=$('#hurl1').val();
		var checkurl = /http:\/\/|https:\/\/(.)*/;
		var checklink=/(.)*((\.html){1}|(\.php){1}(.)*)$/;
		
		if(radioget==1&&hurlval!=''&&!checkurl.test(hurlval)){
			$('#add_div').val(5);
			$('#html5').show();
			$('#errormsg2').html('<span class="Validform_checktip Validform_wrong">请输入以http/https开头的地址，并保证该链接能单独在IE中正常访问，而非404！</span>');
			return false;
			}
			else if(radioget==0&&linkval==''){
				$('#add_div').val(5);
				$('#html5').show();				
				$('#errormsg1').html('<span class="Validform_checktip Validform_wrong">请从上面选择链接</span>');
				return false;				
				}
				else if(radioget==0&&linkval!=''&&!checklink.test(linkval)){
					$('#add_div').val(5);
					$('#html5').show();				
					$('#errormsg1').html('<span class="Validform_checktip Validform_wrong">请选择子项</span>');
					return false;
					}
		
		//验证图片是否存在
		$('#formEdit').frmPost({controller:'PicManager',method:'adEdit',kind:para.kind,area:area,zb:zb,name:name},function(result1){
			if(result1.statu){				
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});
	}
	
	// }}}
	// {{{ function initEdit()
	/**
	 * 初始化编辑   //pop_edit.html?kind=3&flag=special_one&id=46
	 * */
	this.initEdit = function() {
		$(function(){	
			//获取参数
			var para = self.parseUrl(window.location.href);
			if (para.id != undefined) {
				//有id，则是编辑
				self.cmd(gHttp,{controller:'PicManager',method:'get',id:para.id},function(result1){
					if(result1.statu){						
						$('#formEdit').frmFill('',result1.data);						
						$('#hurl_link').val(result1.data.link);	
						$('#hurl').val(result1.data.link);
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);
							picflag = result1.data.flag;
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			}
			self.onloadCss();
			//初始化科室链接数据
			$("#htmlUrl").bindDepartment();
			
			$('#htmlUrl').change(function(){
				$('span[id^="child"]').hide();
				$('span[id^="child"]').html('');
				var sel = $(this).val();
				$('#childDiseaseDiv').empty();
				$('#hurl_link').val(window.location.origin+'/'+sel);
				$('#link_box').val(window.location.origin+'/'+sel);
				
				if(sel=='departments'){
					$('#hurl_link').val('');
					$('#link_box').val(sel);
					self.cmd(gHttp,{controller:'Navigation',method:'getHtmlUrlByPara',op:'departments'},function(result1){
						if(result1.statu){
							var isDisease = '';							
							isDisease = 'onChange="gPicManager.setChildUrl(this,\'hurl_link\',\'link_box\');getDepartSubTree(this.value,\' \',\'hurl_link\',\'link_box\',\'childDiseaseDiv\')"';
							var str='<select class="select" name="childUrl" id="childUrl" '+isDisease+'>';
							str+='<option value="">&nbsp;请选择科室&nbsp;</option>';					
							for (var i=0;i<result1.data.length;i++){
								if(isDisease == ''){
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].url+'">'+result1.data[i].name+'</option>';
								}else{
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].id+'">'+result1.data[i].name+'</option>';
								}
							}
							str+="</select>";
							$('#childUrlDiv').html(str);
							$('#childUrlDiv').show();
							
						}else{
							layer.alert(result1.msg);
						}
					
						return false;
					});
				}else if(sel == "channel"){
					self.cmd(gHttp,{controller:'Channel',method:'query'},function(result1){
						var str='<select class="select" name="channelList" onChange="setChannel(this.value)" id="channelList">';
						str += '<option value="">&nbsp;请选择&nbsp;</option>';
						for (var i=0;i<result1.rows.length;i++){
							str +='<option value="'+result1.rows[i].shortname+'">'+result1.rows[i].name+'</option>';
						}
						$('#childUrlDiv').show();
						$('#childUrlDiv').html(str);
						$('#hurl_link').val('');
						$('#link_box').val(sel);
					});
				}else{
					$('#childUrlDiv').hide();
					$('#childUrlDiv').html('');
				}
			});			
			
			
			//hurl 改变时把值写入hurl_link
			$('input#hurl').change(function(){
				$('input#hurl_link').val($(this).val());								
			});
			
			//链接方式切换
			$('input[name="radio_link"]').click(function(){
				$(this).attr('checked',true);
				var value=$("#hurl_link").val();
				if($(this).val()==1){
					$("#hurl").val(value);						
				}
				else{
					$("#link_box").val(value);
				}
											
				$("#childUrlDiv").hide();
				$("#childUrlDiv").html('');
				$("#childDiseaseDiv").html('');
				$('#htmlUrl').val('');
				
				var id = $(this).attr('id');
				$("div[id^='div_link']").hide();
				$("#div_" + id).show();
			});
			
			//链接提示
			$('#link_box').on('mouseenter',function(){
				var msg=$(this).attr('info');
				layer.tips(msg, $(this), {
					tips: [3, '#78BA32'],
					area: ['500px', 'auto'],
					time:9000
				});											  
														  
			});
			
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
    
	// {{{ function fillDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillDataTable = function() {
		if (gKind == 1) {
			//单张图片管理 kind=1
			var columns = [
					            {
					            	data : 'id',
					            	render : function (id, type, row) {
					            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
					            	}
					            },
	                            { data: 'id' },
					            { data: 'name' },
					            { data: 'flag',},
					            { data: 'img',render : function(value, type, row){
									  return '<img src="/upload/' + value + '" width="300px" height="80px"/>';
								  }	},
					            { data: 'link' },
					            {
								  data : 'id',
								  render : function(id, type, row){
									  var str = '';
						              str += '<a style="text-decoration:none" onClick="gPicManager.wdedit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gPicManager.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
							    	  return str;
								  }
								 }
					        ];
			$("#dataTable").grid({
				para:{controller:'PicManager',method:'query',kind:gKind},
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]},{sClass:'text-c',aTargets:[6]}
								],
				field : columns
			});
		} else {
			//轮播图管理 kind=2
			var columns = [
					            {
					            	data : 'id',
					            	render : function (id, type, row) {
					            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
					            	}
					            },
	                            { data: 'id' },
					            { data: 'name' },
					            { data: 'flag',},
					            {
								  data : 'id',
								  render : function(id, type, row){
									  var str = '';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gPicManager.wdscedit('+id+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gPicManager.detail('+id+');" href="javascript:;" title="查看详细"><i class="Hui-iconfont">&#xe613;</i></a>';
						              str += '<a style="text-decoration:none" class="ml-5" onClick="gPicManager.del('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
							    	  return str;
								  }
								 }
					        ];
			$("#dataTable").grid({
				para:{controller:'PicManager',method:'query',kind:gKind},
				aoColumnDefs : [
					{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[4]}
					],
				field : columns
			});
		}
	}
	
	// }}}
	
	//单个删除
	this.del = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'PicManager',method:'del',id:id});
	}
	
	//批量删除
	this.delBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'PicManager',method:'del',id:ids});
		}
		
	}

	//动态编辑
	this.edit = function(id){
		var url = gKind == 1 ? 'picAdd.html' : 'pic_scroll_info.html';
		var type = gKind == 1 ? '单张' : '轮播';
		self.openEdit('编辑'+type+'图片', url + '?id=' + id);
	}
	this.wdedit = function(id){
		var url = gKind == 1 ? 'picAdd.html' : 'pic_scroll_info.html';
		var type = gKind == 1 ? '单张' : '轮播';
		self.openEditWID('编辑'+type+'图片', url + '?id=' + id,'760','500');
	}
	this.wdscedit = function(id){
		var url = gKind == 1 ? 'picAdd.html' : 'pic_scroll_info.html';
		var type = gKind == 1 ? '单张' : '轮播';
		self.openEditWID('编辑'+type+'图片', url + '?id=' + id,'540','224');
	}
	//查看轮播详细
	this.detail = function(id) {
		self.openAdd('本轮播组图片列表','scroll_pic.html?pid=' + id);
	}
	
	//保存
	this.save = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'PicManager',method:'add'};
		} else {
			post = {controller:'PicManager',method:'edit',id:id};
		}		
		var obj=$('#formEdit').checkAndSubmit('save',post,function(result1){
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();
				
				
			}else{
				parent.layer.alert(result1.msg,{icon:2});
			}
		});	
		$('#formEdit').Validform().unignore('#link_box');
		$('#formEdit').Validform().unignore('#hurl');
		$('#formEdit').Validform().unignore('#pic');
		var linkType = $("input[name='radio_link']:checked").val();
		if (linkType == '1') {
			obj.ignore('#link_box');			
		} else {
			obj.ignore('#hurl');
		}
		
		$('#formEdit').submit();
	}
	
	// {{{ function addEventToDiv()
	
	/**
	 * 注册拖动事件
	 * */
	this.addEventToDiv = function(sort, k){
		var self = this;
		//注册拖动框,four为自定义
		var showDivId = (sort == 'four') ? ('move_div' + k) : (sort + '_div');
		dragDrop.initElement(showDivId);
		//注册位置事件
		var att = ['width', 'height', 'left', 'top'];
		$.each(att, function(i,v){
			$("#" + sort + "_" + v).keydown(function(e){
				var val = $(this).val();
				val = self.formatIndex(val);
				if (e.which == 38) { val = val+1;} //上
	            if (e.which == 40) { val = val-1;} //下
	            $(this).val(val);
	            var currentDiv = (sort == 'four') ? ('move_div' + $("#edit_confirm").attr('flag')) : (sort + '_div');
	            var obj = document.getElementById(currentDiv);
	            self.showDivPosition(obj, v, val);
			});
			
			$("#" + sort + "_" + v).keyup(function(){
				var val = $(this).val();
				val = self.formatIndex(val);
				var currentDiv = (sort == 'four') ? ('move_div' + $("#edit_confirm").attr('flag')) : (sort + '_div');
	            var obj = document.getElementById(currentDiv);
				self.showDivPosition(obj, v, val);
			});
			
		});
		
		//注册颜色事件
		$("#" + sort + "_color").change(function(){
			var currentDiv = (sort == 'four') ? ('move_div' + $("#edit_confirm").attr('flag')) : (sort + '_div');
            var obj = document.getElementById(currentDiv);
			obj.style.borderColor = $(this).val();
		});
	}
	
	// }}}
	// {{{ function showDivPosition()
	
	/**
	 * 定位div
	 * */
	this.showDivPosition = function(obj, type, val){
		if (type == 'width') {
        	obj.style.width = val + 'px';
        } else if (type == 'height') {
        	obj.style.height = val + 'px';
        } else if (type == 'left') {
        	obj.style.left = val + 'px';
        } else if (type == 'top') {
        	obj.style.top = val + 'px';
        }
	}
	
	// }}}
	// {{{ function formatIndex()
	
	/**
	 * 数字转换
	 * */
	this.formatIndex = function(val){
		if (val == '') {
			val = 0;
		} else if (val == 0) {
			val = parseInt(val, 10);
		} else {
			val = parseInt(val);
		}
		
		return val;
	}
	
	// }}}
	// {{{ function formatZBData()
	
	/**
	 * 封装对象信息
	 * */
	this.formatZBData = function(idPre, zb, para) {
		var area1 = '';
		var area2 = '';
		var area3 = '';
		var area4 = '';
		
		$.each(idPre, function(i, attr){
			var width = $.trim($('#'+attr+'_width').val());
			var height = $.trim($('#'+attr+'_height').val());
			var top = $.trim($('#'+attr+'_top').val());
			var left = $.trim($('#'+attr+'_left').val());
			var allow = true;
			if(isNaN(width) || isNaN(height) || isNaN(top) || isNaN(left)){
				allow = false;
			}
			
			if(width == 0 && height == 0){
				allow = false;
			}
			var co = $('#'+attr+'_color').val();
			
			if(attr == 'one' && allow){
				area1 = '<area shape="rect" coords="'+left+','+top+','+(parseInt(left)+parseInt(width))+','+(parseInt(top)+parseInt(height))+'" onclick="Layout.close(\''+para.flag+'\')">';
				zb['zb1'] = [left,top,width,height,co];
			}else if(attr == 'six' && allow){
				area4 = '<area shape="rect" coords="'+left+','+top+','+(parseInt(left)+parseInt(width))+','+(parseInt(top)+parseInt(height))+'" onclick="Layout.close(\''+para.flag+'\')">';
				zb['zb4'] = [left,top,width,height,co];
			}else if(attr == 'two' && allow){
				area2 = '<area shape="rect" coords="'+left+','+top+','+(parseInt(left)+parseInt(width))+','+(parseInt(top)+parseInt(height))+'" href="javascript:Layout.openWindow(\'chat\')" target="_blank">';
				zb['zb2'] = [left,top,width,height,co];
			}else if(attr == 'three' && allow){
				area3 = '<area shape="rect" coords="'+left+','+top+','+(parseInt(left)+parseInt(width))+','+(parseInt(top)+parseInt(height))+'" href="javascript:Layout.openWindow(\'reservation\')" target="_blank">';
				zb['zb3'] = [left,top,width,height,co];
			}
		});
		
		var area = area1+area2+area3+area4;
		return [zb, area];
	}
	
	// }}}
	
	/**********************轮播组图片管理**************************/
	// {{{ function initScollList()
	
	/**
	 * 初始化轮播组列表
	 * */
	this.initScollList = function() {
		$(function(){
			//table加载数据
			self.fillScollDataTable();
		});
	}
	
	// }}}
    // {{{ function fillScollDataTable()
	
	/**
	 * 加载数据表
	 * */
	this.fillScollDataTable = function() {
		//获取参数
		var para = self.parseUrl(window.location.href);
		$("#pid").val(para.pid);
		if (para.pid == undefined) {
			var data = {controller:'Pic',method:'query'};
		} else {
			var data = {controller:'Pic',method:'query',pid:para.pid};
		}
		var columns = [
				            {
				            	data : 'id',
				            	render : function (id, type, row) {
				            		return '<input type="checkbox" name="tr_'+id+'" id="tr_'+id+'" value="'+id+'">';
				            	}
				            },
	                        { data: 'id' },
				            { data: 'pic' , render : function(value, type, row){return '<img src="'+value+'" width="300px" height="80px"/>';}},
				            { data: 'url' },
				            {
							  data : 'id',
							  render : function(id, type, row){
								  var str = '';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gPicManager.editScroll('+id+', '+row.pid+');" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>';
					              str += '<a style="text-decoration:none" class="ml-5" onClick="gPicManager.delScroll('+id+');" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>';
						    	  return str;
							  }
							 }
				        ];
		
		$("#dataTable").grid({
			para:data,
			aoColumnDefs : [
				{sClass:'text-c',aTargets:[0]},{sClass:'text-c',aTargets:[1]},{sClass:'text-c',aTargets:[2]},{sClass:'text-c',aTargets:[4]}
							],
			initSort:[[0, "asc"]],
			field : columns
		});
		
	}
	
	// }}}
	
	/**为轮播组新增图片**/
	this.Addnewpic=function(url){
		self.openEditWID('新增图片', 'scroll_pic_info.html?pid='+$('#pid').val(),'740','460');
		};		
	//单个删除
	this.delScroll = function(id) {
		var obj=$("#dataTable").dataTable();
		self.openDel(obj,{controller:'Pic',method:'del',id:id});
	}
	
	
	//批量删除
	this.delScrollBatch = function() {
		var ids = $("#dataTable").getSelectedAll();
		if(ids.length<=0){
			layer.msg('请选择要删除的项目！',{icon:2});
		}else{
			var obj=$("#dataTable").dataTable();
			self.openDel(obj,{controller:'Pic',method:'del',id:ids});
		}
	}

	//动态编辑
	this.editScroll = function(id,pid){
		self.openEditWID('编辑轮播组图片信息', 'scroll_pic_info.html?pid='+pid+'&id=' + id,'740','460');
	}
	
	// {{{ function initScollEdit()
	/**
	 * 初始化轮播编辑
	 * */
	this.initScollEdit = function() {
		$(function(){	
			
			//获取参数
			var para = self.parseUrl(window.location.href);				
			if (para.pid != undefined)$("#pid").val(para.pid);
			if (para.id != undefined) {
				//有id，则是编辑
				self.cmd(gHttp,{controller:'Pic',method:'get',id:para.id},function(result1){
					if(result1.statu){
						//console.log(result1.data);
						$('#formEdit').frmFill('',result1.data);
						$('#hurl').val(result1.data.url);
						if(result1.data.pic != ''){
							$('#thumbnail').attr('src',result1.data.src);
							picflag = result1.data.flag;
						}
					}else{
						layer.alert(result1.msg);
					}
				});
			}
			
			//链接方式切换
			$('input[name="radio_link"]').click(function(){
				$(this).attr('checked',true);
				var value=$("#hurl_link").val();
				if($(this).val()==1){
					$("#hurl").val(value);						
				}
				else{
					$("#link_box").val(value);
				}											
				$("#childUrlDiv").hide();
				$("#childUrlDiv").html('');
				$("#childDiseaseDiv").html('');
				$('#htmlUrl').val('');
				
				var id = $(this).attr('id');
				$("div[id^='div_link']").hide();
				$("#div_" + id).show();
			});
			self.onloadCss();
			//保存
			$('#save').click(function(){
				self.saveScroll();
			});
			
			//返回
			$('#back').click(function(){
				layer_close();
			});
			//初始化科室链接数据
			$("#htmlUrl").bindDepartment();
			$('#htmlUrl').change(function(){
				$('span[id^="child"]').hide();
				$('span[id^="child"]').html('');
				var sel = $(this).val();
				$('#childDiseaseDiv').empty();
				$('#hurl_link').val(window.location.origin+'/'+sel);
				$('#link_box').val(window.location.origin+'/'+sel);
				
				if(sel=='departments'){
					$('#hurl_link').val('');
					$('#link_box').val(sel);
					self.cmd(gHttp,{controller:'Navigation',method:'getHtmlUrlByPara',op:'departments'},function(result1){
						if(result1.statu){
							var isDisease = '';							
							isDisease = 'onChange="gPicManager.setChildUrl(this,\'hurl_link\',\'link_box\');getDepartSubTree(this.value,\' \',\'hurl_link\',\'link_box\',\'childDiseaseDiv\')"';
							var str='<select class="select" name="childUrl" id="childUrl" '+isDisease+'>';
							str+='<option value="">&nbsp;请选择科室&nbsp;</option>';					
							for (var i=0;i<result1.data.length;i++){
								if(isDisease == ''){
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].url+'">'+result1.data[i].name+'</option>';
								}else{
									str +='<option flag="'+result1.data[i].url+'" value="'+result1.data[i].id+'">'+result1.data[i].name+'</option>';
								}
							}
							str+="</select>";
							$('#childUrlDiv').html(str);
							$('#childUrlDiv').show();
							
						}else{
							layer.alert(result1.msg);
						}
					
						return false;
					});
				}else if(sel == "channel"){
					self.cmd(gHttp,{controller:'Channel',method:'query'},function(result1){
						var str='<select class="select" name="channelList" onChange="setChannel(this.value)" id="channelList">';
						str += '<option value="">&nbsp;请选择&nbsp;</option>';
						for (var i=0;i<result1.rows.length;i++){
							str +='<option value="'+result1.rows[i].shortname+'">'+result1.rows[i].name+'</option>';
						}
						$('#childUrlDiv').show();
						$('#childUrlDiv').html(str);
						$('#hurl_link').val('');
						$('#link_box').val(sel);
					});
				}else{
					$('#childUrlDiv').hide();
					$('#childUrlDiv').html('');
				}
			});
			
			
			//hurl 改变时把值写入hurl_link
			$('input#hurl').change(function(){
				$('input#hurl_link').val($(this).val());								
			});
			
			//链接提示
			$('#link_box').on('mouseenter',function(){
				var msg=$(this).attr('info');
				layer.tips(msg, $(this), {
					tips: [3, '#78BA32'],
					area: ['500px', 'auto'],
					time:9000
				});											  
														  
			});
			
		});
		
	}
	
	// }}}
	// {{{ function saveScroll()
	
	
	/**
	 * 保存轮播图
	 * */
	this.saveScroll = function(){
		var post = {};
		var id = $("#id").val();
		if (id == '') {
			post = {controller:'Pic',method:'add'};
		} else {
			post = {controller:'Pic',method:'edit',id:id};
		}
		
		var obj=$('#formEdit').checkAndSubmit('save',post,function(result1){											   
			if(result1.statu){
				var url=parent.location.href;
				parent.location.replace(url);
				parent.layer.msg('操作成功!',{icon: 1});	
				layer_close();
				
			}else{
				parent.layer.alert(result1.msg,{icon: 2});
			}
		});
		
		$('#formEdit').Validform().unignore('#link_box');
		$('#formEdit').Validform().unignore('#hurl');
		$('#formEdit').Validform().unignore('#link_box1');
		$('#formEdit').Validform().unignore('#hurl1');
		var linkType = $("input[name='radio_link']:checked").val();
		if (linkType == '1') {
			obj.ignore('#link_box');			
		} else {
			obj.ignore('#hurl');
		}
		var linkType1 = $("input[name='radio_link1']:checked").val();
		if (linkType1 == '1') {
			obj.ignore('#link_box1');
		} else {
			obj.ignore('#hurl1');
		}
		$('#formEdit').submit();
	}
	
	// }}}
}
