$.fn.getHtml = function(tpl,fun){
	var http = './';
	var me = $(this);
	$.ajax({
		url:http+tpl+'.html',
		type:'get',
		dateType:'html',
		cache:false,
		success:function(re){
			me.html(re);
			fun();
		}
	});
};

var getData = function(data,fun){
	var http = '../controller/index.php';
	$.ajax({
		url:http,
		type:'post',
		data:data,
		async : true,
		dataType:'json',
		success:function(re){
			fun(re);
		}
	});
};

var alert_message = function(message){
	art.dialog({
    	content: message,
        height:60,
        width:210,
        fixed: true,
        lock: true
    });
};

!function($){
	var grad = function(option){
		this.size = typeof(option.size) == 'undefined' ? 6 : option.size;
		this.nowPage = 1;
		//this.cmd = option.cmd;
		this.modal = option.modal;
		this.para = option.para;
		this.field = option.field;
		this.tmp = option.tmp = undefined ? false : option.tmp; //临时id，用于弹出层与外层一致时区别
		this.check = option.check = undefined ? false : option.check; //是否复选框
		this.order = option.order = undefined ? false : option.order; //是否显示序号
		this.ttl  = '';
		this.page = option.page == undefined ? false : option.page;
		this.data = {}; //储存当前grid页当前行的所有数据
		this.pageSize = 10;//页数最多显示10页
		this.test = option.test = undefined ? false : option.test;//是否进行数据库连接测试
		this.checkAll = option.checkAll = undefined ? false : option.checkAll;//是否默认复选框全选
	}

	grad.prototype = {
		constructor : grad
		,request : function(){
			var self = this;
			var html = '';
			html += '<table class="list" width="100%">';
			
			html += '<thead>';
			html += '<tr>';
			
			var tmpId = this.tmp ? "_" + this.tmp : "";
			
			//是否显示复选框
			if(this.check){
				html += '<th style="text-align:center;width:50px;line-height:25px"><input id="check_all'+ tmpId +'" type="checkbox"><label for="check_all'+ tmpId +'">全选</label></th>';
			}
			
			//是否显示序号
			if(this.order){
				html += '<th style="width:45px;text-align:center;">序号</th>';
			}
				
			$.each(this.field,function(n,v){
				var width = '';
				if(v.width != undefined){
					width = v.width+'px';
				}else{
					width = 'auto';
				}
				if(v.px){
					html += '<th class="px" name="'+v.name+'" flag=1 style="width:'+width+'"><a href="javascript:void(0)">'+v.text+'</a></th>';
				}else{
					html += '<th style="width:'+width+'">'+v.text+'</th>';
				}
				
			});
			html += '</tr>';
			html += '</thead>';
			html += '<tbody id="body'+tmpId+'">';

			this.para.page = this.nowPage;
			this.para.size = this.size;
			var ttl = '';
			var field = this.field;
			var order = this.order;
			var check = this.check;
			var page = this.page;
			var test = this.test;
			var temp = '';
			var data = {};
			$('#loading').addClass('loading');
			getData(this.para,function(result){
				$('#loading').removeClass('loading');
				ttl = result.ttl;
				data = result.rows;
				self.data = data;
				$.each(result.rows,function(n,v){
					var jishu = n+1;
					if(jishu%2 == 0){
						temp += '<tr class="hover">';
					}else{
						temp += '<tr>';
					}

					if(check){
						temp += '<td style="text-align:center;"><input index="'+n+'" type="checkbox" class="check_one" tag="check_one"></td>';
					}

					if(order){
						temp += '<td style="text-align:center;">'+(n+1)+'</td>';
					}
					
					$.each(field,function(i,va){
						var statusId = (va.name == 'link_status') ? ('status_'+v.id) : '';
						var showId = statusId ? 'id="' + statusId + '"' : '';
						temp += '<td style="text-align:center;" '+showId+'>';
						//操作
						if(va.render != undefined){
							var str = va.render(v[va.name],v,(n+1));
							temp += str;
						}else if(va.name == ''){
							switch(v.msgtype){
							case 'text':
								temp += v.content;
								break;
							case 'location':
								temp += v.label;
						    }
						}else if (va.name == 'link_status') {
							temp += test ? '正在检测...' : '未知';
						}else{
							if(va.type == 'time'){
								if (v[va.name] == 0) {
									temp += '';
								} else {
									var timestamp = new Date(parseInt(v[va.name])*1000);
									var timestr = self.getTimeStr(timestamp);
									temp += timestr;
								}
							} else if (va.type == 'select') {
								var selectArr = va.attr;
								temp += selectArr[v[va.name]];
							} else {
								temp += v[va.name];
							}
						}
						temp += '</td>';
					});
					temp += '</tr>';
				});
				html += temp;
				html += '</tbody>';
				html += '</table>';
				self.modal.html(html);
				
				if (test){
					$("td[id^='status_']").each(function(i){
						var id = $(this).attr('id');
						var website_id = id.split("_")[1];
						getData({controller:'Website',method:'testConn',website_id:website_id},function(ret){
							$("#status_" + website_id).html(ret.status);
							$("#status_" + website_id).attr("title", ret.msg);
						});
					});
				}
				
				if(page){
					var a = self.show(ttl);
					self.modal.next('div').remove();
					self.modal.after(a);
				}
		
				if(self.checkAll){
					$("input[id^='check_all']").attr('checked','checked');	
					$('.check_one').attr('checked','checked');
				}
					
			});
		},

		/**
		 * 将时间撮转换成时间串
		 * */
		getTimeStr : function(timestamp) {
			var year = timestamp.getFullYear();
			var month = timestamp.getMonth() + 1;
			var day = timestamp.getDate();
			var hour = timestamp.getHours();
			var minute = timestamp.getMinutes();
			var second = timestamp.getSeconds();
			var timestr =  year+'-'+month+'-'+day;
			//timestr += ' '+hour+':'+minute+':'+second;
			return timestr;
		},
		//排序 
		px : function(para){
			var self = this;
			temp = '';
			var length = self.data.length;
			if(para.flag == 1){
				for(var i=0;i<length-1;i++){
					for(var j=i+1;j<length;j++){
						if(self.data[i][para.name] > self.data[j][para.name]){
							temp = self.data[i];
							self.data[i] = self.data[j];
							self.data[j]= temp;
						}
					}
				}
			}else{
				for(var i=0;i<length-1;i++){
					for(var j=i+1;j<length;j++){
						if(self.data[i][para.name] < self.data[j][para.name]){
							temp = self.data[i];
							self.data[i] = self.data[j];
							self.data[j]= temp;
						}
					}
				}
			}

			var temp = '';
			var check = self.check;
			var field = self.field;
			var order = self.order;
			$.each(self.data,function(n,v){
				var jishu = n+1;
				if(jishu%2 == 0){
					temp += '<tr class="hover">';
				}else{
					temp += '<tr>';
				}
					
				if(check){
					temp += '<td style="text-align:center;"><input index="'+n+'" type="checkbox" class="check_one" tag="check_one"></td>';
				}
				if(order){
					temp += '<td>'+(n+1)+'</td>';
				}
				$.each(field,function(i,va){
					temp += '<td>';
						//操作
					if(va.render != undefined){
						var str = va.render(v[va.name],v,(n+1));
						temp += str;
					}else{
						temp += v[va.name];
					}
					temp += '</td>';
				});
					temp += '</tr>';
			});
			self.modal.find('tbody').html(temp);
		},

		//分页
		show : function(ttl){
			var self = this;
			var html = '<div class="panelBar">';
			var pageNum = Math.ceil(ttl/this.size);
			html += '<div class="pages">';
			html += '<span>显示</span>';
			html += '<select id="pageNum">';
			
			if(this.size == 5){
				html += '<option selected value=5>5</option>';
			}else{
				html += '<option value=5>5</option>';
			}

			if(this.size == 10){
                html += '<option selected value=10>10</option>';
            }else{
                html += '<option value=10>10</option>';
            }
            if(this.size == 50){
                html += '<option selected value=50>50</option>';
            }else{
                html += '<option value=50>50</option>';
            }

			html += '</select>';
			html += '<span>条,共'+ttl+'条</span>';
			html += '</div>';
			html += '<div class="pagination">';
			html += '<ul>';
			if(this.nowPage == 1){
				html += '<li class="j-first disabled">';
				html += '<a href="javascript:void(0)" style="display:none;" class="first"><span>首页</span></a>';
				html += '<span class="first"><span>首页</span></span>';
			}else{
				html += '<li  class="j-first">';
				html += '<a flag="1" class="first" href="javascript:void(0)"><span>首页</span></a>';
			}
			
			html += '</li>';
			if(this.nowPage == 1){
				html += '<li class="j-prev disabled">';
				html += '<a href="javascript:void(0)" style="display:none;" class="previous"><span>上一页</span></a>';
				html += '<span class="previous"><span>上一页</span></span>';
			}else{
				html += '<li  class="j-prev">';
				html += '<a flag='+(parseInt(this.nowPage)-1)+' class="previous" href="javascript:void(0)"><span>上一页</span></a>';
			}
			html += '</li>';
			
			var selected = '';
			//页数的控制
			var flag = this.nowPage - Math.ceil(self.pageSize/2);
			if(pageNum > self.pageSize){
				var pageFlag = self.pageSize;
			}else{
				var pageFlag = pageNum;
			}

			this.nowPage = parseInt(this.nowPage);
			
			if(flag <=0){
				for(var i=1;i<=pageFlag;i++){
					if(this.nowPage == i){
						selected = 'selected';
					}else{
						selected = '';
					}
					html += '<li flag="'+i+'" class="j-num '+selected+'">';
					html += '<a href="javascript:void(0)">'+i+'</a>';
					html += '</li>';
				}
			}else{
				var start = this.nowPage-Math.ceil(self.pageSize/2)+1;
				for(var j=start;j<=this.nowPage;j++){
					if(this.nowPage == j){
						selected = 'selected';
					}else{
						selected = '';
					}
					html += '<li flag="'+j+'" class="j-num '+selected+'">';
					html += '<a href="javascript:void(0)">'+j+'</a>';
					html += '</li>';
				}
				if(this.nowPage+Math.ceil(self.pageSize/2) > pageNum){
					var foot = pageNum;
				}else{
					var foot = this.nowPage+Math.ceil(self.pageSize/2);
				}
				for(var j=this.nowPage+1;j<=foot;j++){
					html += '<li flag="'+j+'" class="j-num">';
					html += '<a href="javascript:void(0)">'+j+'</a>';
					html += '</li>';
				}	
			}
			if(pageNum == 0 || this.nowPage == pageNum){
				html += '<li class="j-next disabled">';
				html += '<a href="javascript:void(0)" style="display:none;" class="next"><span>下一页</span></a>';
				html += '<span class="next"><span>下一页</span></span>';
			}else{
				html += '<li  class="j-next">';
				html += '<a flag="'+(parseInt(this.nowPage)+1)+'" class="next" href="javascript:void(0)"><span>下一页</span></a>';
			}
			html += '</li>';
			
			if( pageNum == 0 || this.nowPage == pageNum){
				html += '<li class="j-last disabled">';
				html += '<a href="javascript:void(0)" style="display:none;" class="last"><span>尾页</span></a>';
				html += '<span class="last"><span>尾页</span></span>';
			}else{
				html += '<li  class="j-last">';
				html += '<a flag="'+pageNum+'" class="last" href="javascript:void(0)"><span>尾页</span></a>';
			}
			html += '</li>';
			
			
			html += '</ul>';
			html += '</div>';
		 	html += '</div>';

			return html;
		}
	}

	var temp_grad = {}; //用来保存之前grid对象,方便reload以及其他搜索使用

	$.fn.grad = function(option){
		var _me = this;
		if(option == 'reload'){
			temp_grad.nowPage = 1;
			temp_grad.request();
			return false;
		}else if(option.qry_para != undefined){
			for(var pro in option.qry_para){
				temp_grad.para[pro] = option.qry_para[pro];
			}
			temp_grad.nowPage = 1;
			temp_grad.request();
			return false;
		}else if(option == 'getRows'){
			var data = [];
			var i = 0;
			$(this).children().find('input[tag=check_one]').each(function(n,ob){
				if($(this).attr('checked') != undefined){
					var order = $(this).attr('index');
					data[i] = temp_grad.data[order];
					i++;
				}
			});
			return data;
		}
		option.modal = _me;
	
		var _grad = new grad(option);
		temp_grad = _grad;
		_grad.request();
		
		//页数点击
		_me.parent('div').on('click','.j-num',function(){
			var page = $(this).attr('flag');
			_grad.nowPage = page;
			_grad.request();
		});

		//下一页点击
		_me.parent('div').on('click','a.next',function(){
			var page = $(this).attr('flag');
			_grad.nowPage = page;
			_grad.request();

		});

		//上一页点击
		_me.parent('div').on('click','a.previous',function(){
			var page = $(this).attr('flag');
			_grad.nowPage = page;
			_grad.request();

		});

		//首页点击
		_me.parent('div').on('click','a.first',function(){
			var page = $(this).attr('flag');
			_grad.nowPage = page;
			_grad.request();

		});

		//末页点击
		_me.parent('div').on('click','a.last',function(){
			var page = $(this).attr('flag');
			_grad.nowPage = page;
			_grad.request();

		});

		_me.parent().on('change','#pageNum',function(){
			_grad.cache_con = [];
			var size = $(this).val();
			if(size != ''){
				_grad.size = size;
				_grad.nowPage = 1;
				_grad.request();
			}
		});
		
		//全选
		_me.on('click',"input[id^='check_all']",function(){
			var tmpId = "";
			if (_grad.tmp != undefined) {
				tmpId = "_" + _grad.tmp;
				if($("#check_all_"+_grad.tmp).attr('checked') == undefined){
					$("#check_all_"+_grad.tmp).parent().parent().parent().next().children().find('.check_one').attr('checked','checked');
	            }else{
	            	$("#check_all_"+_grad.tmp).parent().parent().parent().next().children().find('.check_one').removeAttr('checked');
	            }
			} else {
				if($(this).attr('checked') != undefined){
	                $(this).parent().parent().parent().next().children().find('.check_one').attr('checked','checked');
	            }else{
	            	$(this).parent().parent().parent().next().children().find('.check_one').removeAttr('checked');
	            }
			}
        });
		
		//排序
		_me.on('click','.px',function(){
			var name = $(this).attr('name');
			var flag = $(this).attr('flag');
			if(flag == 1){
				$(this).attr('flag',2);
			}else{
				$(this).attr('flag',1);
			}
			_grad.px({name:name,flag:flag});
		});
		
		_me.on('click','.check_one',function(e){
			//阻止冒泡事件
			e.stopPropagation();
		});
		
		_me.on('click','tbody tr',function(){
			if($(this).find('input').attr('checked') == undefined){
				$(this).find('input').attr('checked','checked');
			}else{
				$(this).find('input').removeAttr('checked');
			}
		});

		_me.on('hover','tbody tr',function(){
			$(this).css('background','#9BE0C2');
		});

		_me.on('mouseout','tbody tr',function(){
			$(this).css('background','');
		});

		return $(this);
	}
}(window.jQuery);
