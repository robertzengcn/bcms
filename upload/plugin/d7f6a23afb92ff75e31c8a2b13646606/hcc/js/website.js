

var result = $.extend({},{
  start : function(){
    var _me = this;
        $('#each').getHtml('./plugin/plugins/website/websiteList',function(){
          var html = '<li class=""><a href="javascript:void(0)" id="del" class="delete"><span>删除站点</span></a></li>';
            html += '<li class=""><a href="javascript:void(0)" id="save" class="stat"><span>添加站点</span></a></li>';
            html += '<li class=""><a href="javascript:void(0)" id="send" class="refresh"><span>推送文章</span></a></li>';
            html += '<li class=""><a href="javascript:void(0)" id="refresh" class="refresh"><span>刷新</span></a></li>';
            html += '<li class=""><a href="javascript:void(0)" class="reback" id="backUp"><span>返回</span></a></li>';
          $('#toolBar').html(html);
          $('#listAll').grad({
            size : 10,
            para : {controller:'Website',method:'query'},
            check : true,
            order : false,
            page : true,
            test : true,
            field : [
              {text:'医院名称',name:'hospital'},
              {text:'医院域名',name:'domain'},
              {text:'IP',name:'ip',width:180},
              {text:'端口',name:'port',width:100},
              {text:'连接状态',name:'link_status',width:100},
              {text:'操作',name:'id',width:250,
                render : function(value,rowData,rowIndex){
                  var str='<a id="'+value+'" class="button btn_edit" href="javascript:void(0)" style="margin-left:4px;"><span>编辑</span></a>';
                  str += '<a id="'+value+'" class="button btn_del" href="javascript:void(0)" style="margin-left:4px;"><span>删除</span></a>';
                  str += '<a id="'+value+'" class="button btn_content_list" data="'+rowData.hospital+'" href="javascript:void(0)" style="margin-left:4px;"><span>自定义头尾</span></a>';
                  return str;
                }
              }
            ]
          }).on('click','.btn_edit',function(){
            var me = $(this);
            var id = me.attr('id');
            _me.manageWebsite(id);
          }).on('click','.btn_del',function(){
            var me = $(this);
            var id= me.attr('id');
            if (confirm('确定要删除这个站点吗？')) {
              $('#loading').addClass('loading');
              getData({controller:'Website',method:'del',id:id},function(ret){
                $('#loading').removeClass('loading');
                if(ret.statu){
                  $('#message').message('删除成功!',function(){
                    $('#listAll').grad('reload');
                  });
                }else{
                  $('#message').message(ret.msg);
                }
              });
            }
          }).on('click','.btn_content_list',function(){
            var me = $(this);
            var website_id = me.attr('id');
            var hospital = me.attr('data');
            _me.getContentList(website_id, hospital);
          });

          $('#save').click(function(){
            _me.manageWebsite();
          });
          $('#del').click(function(){
            var data = $('#listAll').grad('getRows');
            var ids = [];
            if(data.length <= 0){
              $("#message").message('请选择您要删除的选项!');
            }else{
              if (confirm('确定要删除这些站点吗？')) {
                $.each(data,function(i,obj){
                  if(obj != undefined){
                    ids[i] = obj.id;
                  }
                });
                  $('#loading').addClass('loading');
                getData({controller:'Website',method:'del',id:ids},function(ret){
                  $('#loading').removeClass('loading');
                  if(ret.statu){
                    $('#message').message('删除成功!',function(){
                      $('#listAll').grad('reload');
                    });
                  }else{
                    $('#message').message(ret.msg);
                  }
                });
              }
            }
          });

          $('#refresh').click(function(){
            $('#listAll').grad('reload');
          });
          $('#backUp').click(function(){
            $.getScript('./public/js/plugin.js',function() {
              result.muchplug();
              });
          });
          $('#qry').click(function(){
            var data = $('#frm_post').frmVal({});
            $('#listAll').grad({qry_para:data});
          });

          //推送文章
          $('#send').click(function(){
            _me.getArticleList();
          });
        });
  },

  getContentList : function(website_id, hospital) {
    var _me = this;
    $('#loading').addClass('loading');
    var _data=$.get('./plugin/plugins/website/websiteList.html',function(data){
      $('#loading').removeClass('loading');
      var diaObj=art.dialog({
        title:'自定义头尾',
        content:data,
        id:'addnewdata',
        fixed:true,
          width:700,
          lock:true,
          opacity: .4,
          padding: 0,
          drag:false,
        init:function(){
          $("#frm_post").hide();
          $('#listAll2').grad({
            size : 10,
            para : {controller:'Website',method:'getContentList',website_id:website_id},
            check : true,
            order : false,
            page : true,
            tmp : 'content',
            field : [
              {text:'类型',name:'type',type:'select',attr:{'1':'自定义头','2':'自定义尾','3':'自定义标题'},width:58},
              {text:'内容',name:'content',width:400,render:function(value,rowData){var resstr='<div class="content_box">'+value+"</div>";return resstr;}},
              {text:'添加时间',name:'addtime',width:84,type:'time'},
              {text:'操作',name:'id',width:78,
                render : function(value,rowData,rowIndex){
                  var str='<a id="'+value+'" class="btn_edit" href="javascript:void(0)" style="padding:6px;">编辑</a>';
                  str += '<a id="'+value+'" class="btn_del" href="javascript:void(0)" style="padding:6px;">删除</a>';
                  return str;
                }
              }
            ]
          }).on('click','.btn_edit',function(){
            var me = $(this);
            var id= me.attr('id');
            _me.manageContent(website_id, hospital, id);
          }).on('click','.btn_del',function(){
            var me = $(this);
            var id= me.attr('id');
            if (confirm('确定要删除这个内容吗？')) {
              art.dialog({ id: 'addnewdata' }).close();
              $('#loading').addClass('loading');
              getData({controller:'Website',method:'delContent',id:id},function(ret){
                $('#loading').removeClass('loading');
                if(ret.statu){
                  art.dialog({title:'消息',content:"删除成功",width:210,height:60,
                    okVal:'确定',
                    ok:function(){
                      _me.getContentList(website_id,hospital);
                    }

                  });
                }else{
                  alert_message(ret.msg);
                }
              });
            }
          });

          $('#del').click(function(){
            var data = $('#listAll2').grad('getRows');
            var ids = [];
            if(data.length <= 0){
              alert_message('请选择您要删除的选项!');
            }else{
              $.each(data,function(i,obj){
                if(obj != undefined){
                  ids[i] = obj.id;
                }
              });
              if (confirm('确定要删除这些内容吗？')) {
                $.each(data,function(i,obj){
                  if(obj != undefined){
                    ids[i] = obj.id;
                  }
                });

                art.dialog({ id: 'addnewdata' }).close();
                  $('#loading').addClass('loading');
                getData({controller:'Website',method:'delContent',id:ids},function(ret){
                  $('#loading').removeClass('loading');
                  if(ret.statu){
                    art.dialog({title:'消息',content:"删除成功",width:210,height:60,
                      okVal:'确定',
                      ok:function(){
                        _me.getContentList(website_id,hospital);
                      }

                    });
                  }else{
                    alert_message(ret.msg);
                  }
                });
              }
            }
          });

          $('#add').click(function(){
            _me.manageContent(website_id, hospital);

          });
          $('#refresh').click(function(){
            $('#listAll2').grad('reload');
          });
        }
      });


    });
  },

  initSend : function(ids) {
    var _me = this;
    var ids = ids.toString();
    $("#ids").val(ids);
    _me.fillHospital();

    //bind hospital change event
    $("#hospital").change(function(){
      var id = $(this).val();
      $("#ul_headers").html("");
      $("#ul_footers").html("");

      if (id != '0') {
        $("#hospital_error").html("");

        //fill title
        _me.fillTitle();

        //fill header
        _me.fillHeader();

        //fill footer
        _me.fillFooter();
      }
    });
  },

  fillHospital : function() {
    var data = {controller:'Website',method:'query'};
    getData(data,function(re){
      var hospitals = re.rows;
      if(hospitals){
        //填充医院信息
        var hospitalHtml = '<option value="0" selected>请选择 </option>';
        hospitalHtml += '<option value="all">全部 </option>';
        if ( hospitals!= null) {
          $.each(hospitals,function(i,v) {
            hospitalHtml += '<option value="' + v.id + '">' + v.hospital + '</option>';
          });
        }
        $("#hospital").html(hospitalHtml);
      }else{
        return false;
      }
    });
  },

  fillTitle : function() {
    var website_id = $("#hospital").val();
    var url = {controller:'Website',method:'getContentList',website_id:website_id,type:3,onlycontent:true};
    getData(url,function(ret){
      if(ret.rows){
        var _me = this;
        var data = ret.rows;
        var li = '';
        $.each(data,function(i,v){
          if (v.content!='')
              li += '<li class="li-items"><input style="position: relative; top:2px;" type="radio" id="title_' + v.id + '" name="titles[]" value="' + v.id + '"/>' + v.content + '</li>';
        });
        $("#ul_titles").append(li);
      }
    });
  },

  fillHeader : function() {
    var website_id = $("#hospital").val();
    var url = {controller:'Website',method:'getContentList',website_id:website_id,type:1,onlycontent:true};
    getData(url,function(ret){
      if(ret.rows){
        var _me = this;
        var data = ret.rows;
        var li = '';
        $.each(data,function(i,v){
          if (v.content!='')
            var strhtml='';
            strhtml+='<div class="htmlbox"><div style="width:96%;overflow:auto;margin:8px auto;padding:10px 6px;">'+v.html+'</div></div>';
              li += '<li class="list_item showthisbox" style="position:relative;" ><input style="position: relative; top:2px;" type="radio" id="header_' + v.id + '" name="headers[]" value="' + v.id + '"/><span>' + v.content.substring(0,6) + '</span>'+strhtml+'</li>';
        });
        $("#ul_headers").append(li);		
		$("li.showthisbox").hover(function(){$(this).find('div.htmlbox').show();},function(){$(this).find('div.htmlbox').hide();});
      }
    });
  },

  fillFooter : function() {
    var website_id = $("#hospital").val();
    var url = {controller:'Website',method:'getContentList',website_id:website_id,type:2,onlycontent:true};
    getData(url,function(ret){
      if(ret.rows){
        var _me = this;
        var data = ret.rows;
        var li = '';
        $.each(data,function(i,v){
          if (v.content!='')
				var strhtml='';
				strhtml+='<div class="htmlbox"><div style="width:96%;overflow:auto;margin:8px auto;padding:10px 6px;">'+v.html+'</div></div>';
              li += '<li class="list_item showthisbox" style="position:relative;" ><input style="position: relative; top:2px;" type="radio" id="footer_' + v.id + '" name="headers[]" value="' + v.id + '"/><span>' + v.content.substring(0,6) + '</span>'+strhtml+'</li>';
        });
        $("#ul_footers").append(li);
		$("li.showthisbox").hover(function(){$(this).find('div.htmlbox').show();},function(){$(this).find('div.htmlbox').hide();});
      }
    });
  },
  getArticleList : function() {
    var _me = this;
    $('#each').getHtml('./plugin/plugins/website/articleList',function(){
      var html = '<li class=""><a href="javascript:void(0)" id="save" class="stat"><span>添加站点</span></a></li>';
      html += '<li class=""><a href="javascript:void(0)" id="send" class="refresh"><span>批量推送</span></a></li>';
      html += '<li class=""><a href="javascript:void(0)" class="reback" id="backUp"><span>返回</span></a></li>';
        $('#toolBar').html(html);

        //填充资讯查询
        _me.fillArticleQry();

      $('#listAll').grad({
        size : 10,
        para : {controller:'Article',method:'query'},
        check : true,
        order : false,
        field : [
          {text:'标题',name:'subject'},
          {text:'所属疾病',name:'disease_name',width:80},
          {text:'竞价',name:'isbidding',render:function(value,rowData,rowIndex){return (value==0)?'否':'是';},width:40},
          {text:'点击量',name:'click_count',width:60},
          {text:'作者',name:'doctor_name',width:100},
          {text:'更新时间',name:'plushtime',width:150},
          {text:'操作',name:'id',width:100,
            render : function(value,rowData,rowIndex){
              var str='<a id="'+value+'" class="button btn_send" href="javascript:void(0)" style="margin-left:3px;"><span>推送</span></a>';
              return str;
            }
          }
        ]
      }).on('click', '.btn_send', function(){
        var id = $(this).attr('id');
        _me.openSendDia(id);
      });

      $('#save').click(function(){
        _me.manageWebsite();
      });

      //批量推送
      $('#send').click(function(){
        var data = $('#listAll').grad('getRows');
        var ids = [];

        if(data.length <= 0){
          $("#message").message('请选择您要推送的选项!');
          return false;
        }else{
          $.each(data,function(i,obj){
            if(obj != undefined){
              ids[i] = obj.id;
            }
          });
        }

        _me.openSendDia(ids);
      });

      $('#refresh').unbind().click(function(){
        $('#listAll').grad('reload');
      });

      $('#backUp').unbind().click(function(){
        _me.start();
      });
    });
  },

  fillArticleQry : function() {
    getData({controller:'Article',method:'getAssociatedData'},function(ret){
      if(ret.statu){
        var department = '<option value="">===全部===</option>';
        //关联科室
        $.each(ret.data['departments'],function(i,obj){
          department += '<option value="'+obj.id+'">'+obj.name+'</option>';
        });
        $('#department_id').html(department);

        var disease = '<option value="">===全部===</option>';
        //关联疾病
        $.each(ret.data['disease'],function(i,obj){
          disease += '<option value="'+obj.id+'">'+obj.name+'</option>';
        });
        $('#disease_id').html(disease);

        var doctor = '<option value="">===全部===</option>';
        //关联医生
        $.each(ret.data['doctors'],function(i,obj){
          doctor += '<option value="'+obj.id+'">'+obj.name+'</option>';
        });
        $('#doctor_id').html(doctor);

      }else{
        $('#message').message(ret.msg);
      }
    });
    //查询
    $('#department_id').change(function(){
      var val=$(this).val();
      if(val==''){
        getData({controller:'Article',method:'getAssociatedData'},function(ret){
          if(ret.statu){
            var disease = '<option value="">===全部===</option>';
            //关联疾病
            $.each(ret.data['disease'],function(i,obj){
              disease += '<option value="'+obj.id+'">'+obj.name+'</option>';
            });
            $('#disease_id').html(disease);

            var doctor = '<option value="">===全部===</option>';
            //关联医生
            $.each(ret.data['doctors'],function(i,obj){
              doctor += '<option value="'+obj.id+'">'+obj.name+'</option>';
            });
            $('#doctor_id').html(doctor);

          }else{
            $('#message').message(ret.msg);
          }
        });
      }else{
        getData({controller:'Article',method:'getByDepartmentID',department_id:val},function(ret){
          if(ret.statu){
            var disease = '<option value="">===全部===</option>';
            //关联疾病
            $.each(ret.data['disease']['data'],function(i,obj){
              disease += '<option value="'+obj.id+'">'+obj.name+'</option>';
            });
            $('#disease_id').html(disease);

            var doctor = '<option value="">===全部===</option>';
            //关联医生
            $.each(ret.data['doctors']['data'],function(i,obj){
              doctor += '<option value="'+obj.id+'">'+obj.name+'</option>';
            });
            $('#doctor_id').html(doctor);

          }else{
            $('#message').message(ret.msg);
          }
        });
      }
    });

    //查询
    $('#disease_id').change(function(){
      var val=$(this).val();
      if(val==''){
        getData({controller:'Article',method:'getAssociatedData'},function(ret){
          if(ret.statu){
            var doctor = '<option value="">===全部===</option>';
            //关联医生
            $.each(ret.data['doctors'],function(i,obj){
              doctor += '<option value="'+obj.id+'">'+obj.name+'</option>';
            });
            $('#doctor_id').html(doctor);

          }else{
            $('#message').message(ret.msg);
          }
        });
      }else{
        getData({controller:'Doctor',method:'getByDiseaseId',disease_id:val},function(ret){
          if(ret.statu){
            var doctor = '<option value="">===全部===</option>';
            //关联医生
            $.each(ret.data['doctors'],function(i,obj){
              doctor += '<option value="'+obj.id+'">'+obj.name+'</option>';
            });
            $('#doctor_id').html(doctor);

          }else{
            $('#message').message(ret.msg);
          }
        });
      }
    });

    //查询
    $('#qry').click(function(){
      var data = $('#frm_post').frmVal({});
      $('#listAll').grad({qry_para:data});
    });
  },

  openSendDia : function(ids) {
    var content = "<div id='sendDiv'></div>";
    var diaObj = art.dialog({
      title: "推送文章",
        content:content,
        fixed:true,
        width:700,	
        padding:1,
        lock:true,
        opacity: .4,
        padding: 0,			
        okVal:'提交',
        ok:function(){
          var titles = [];
          var headers = [];
			var footers = [];
			$("input:checked[type='radio'][id^='title_']").each(function(){
			  if($(this).attr('checked') == 'checked'){
						titles.push($(this).val());
					}
			});

			$("input:checked[type='radio'][id^='header_']").each(function(){
			  if($(this).attr('checked') == 'checked'){
						headers.push($(this).val());
					}
			});

			$("input[type='radio'][id^='footer_']").each(function(){
			  if($(this).attr('checked') == 'checked'){
				footers.push($(this).val());
			  }
			});

			var hospital = $("#hospital").val();
			if (hospital == '0') {
			  $("#hospital_error").html('请选择医院');
			  return false;
			}

			if (hospital == 'all') {
			  var options = $("#hospital").find("option");
			  var h = [];
			  i = 0;
			  for (var i=0; i<options.length; i++) {
				if (options.eq(i).val() != '0' && options.eq(i).val() != 'all') {
				  h.push(options.eq(i).val());
				}
			  }
			  hospital = h.toString();
        }

        var data = {controller:'Website',method:'sendArticle'};
        data['titles'] = titles.toString();
        data['headers'] = headers.toString();
        data['footers'] = footers.toString();
        data['ids'] = $("#ids").val();
        data['hospital'] = hospital;
        getData(data,function(re){
          console.log(re);
          if (re.statu) {
            $("#message").message("推送成功",function(){
              diaObj.close();
            });
          } else {
            $("#message").message(re.msg);
          }
        });
        },
        cancel:true
    });
	
	
    $('#sendDiv').getHtml('./plugin/plugins/website/sendArticle',function(){
      result.initSend(ids);
    });

    //去掉图标icon
    $(".aui_icon").remove();

    //去掉弹出框跟随鼠标拖动
    $(document).unbind('mousedown');
  },

  manageWebsite : function(id){
    var _me = this;
    $('#each').getHtml('./plugin/plugins/website/manageWebsite',function(){
      if (id != undefined && id !='') {
        $('#loading').addClass('loading');
        getData({controller:'Website',method:'get', id:id},function(ret){
          $('#loading').removeClass('loading');
          if(ret.statu){
            //填充数据
            var data = ret.data;
            $.each(data, function(i,v){
              $("input[name='" + i + "']").val(v);
            });

            $("#id").val(data.id);
            $("#addtime").val(data.addtime);
          }else{
            $("#message").message(ret.msg);
            return false;
          }
        });

        $("#action").val("edit");
      }

      $('#chk_pwd').change(function(){
        $("input[id^='chk_']").each(function(){
          if ($(this).val() == '') {
            return false;
          }
        });

        //检测连接状态
        var formData = $('#information').serializeArray();
        var data = {controller:'Website',method:'testConn'};
        $.each(formData,function(i,obj){
          data[obj.name] = obj.value;
        });
        data['is_test'] = 1;
        getData(data,function(ret){
          if(ret.flag) {
            $("#error").html('<span style="color:green;">'+ret.msg+'</span>');
          } else {
            $("#error").html('<span style="color:red;">'+ret.msg+'</span>');
          }
        });
      });

      $('#save').click(function(){
        $("input[id^='chk_']").each(function(){
          var tip = $(this).attr('title');
          if ($(this).val() == '') {
            $("#message").message('请输入' + tip);
            return false;
          }
        });

        var formData = $('#information').serializeArray();
        var method = $("#action").val();
        var operation = method == 'add' ? '添加' : '编辑';
        var data = {controller:'Website',method:method};
        $.each(formData,function(i,obj){
          data[obj.name] = obj.value;
        });
        $('#loading').addClass('loading');
        getData(data,function(re){
          $('#loading').removeClass('loading');
          if(re.statu){
            $('#message').message('添加成功!',function(){
              _me.start();
            });
          }else{
            $('#message').message(re.msg);
          }
        });
      });
      $('#back').click(function(){
        _me.start();
      });
    });
  },

  manageContent : function(website_id, hospital, postid){
    var _me=this;
    $.get('./plugin/plugins/website/manageContent.html',function(data){
      var diaObj=art.dialog({
        title:'编辑头尾信息',
        content:data,
        id:'editmessage',
        fixed:true,
          width:800,
          lock:true,
          opacity: .4,
          padding: 0,
        drag:false,
        init:function(){
          $('#chk_content').ckeditor({width:680,height:115},function(){
            $('.cke_toolbox').append('<span class="cke_toolbar"><span class="cke_combo_button"><div style="margin-top:3px;"><a style="color:#666666" id="set" href="javascript:void(0)">网络相册</a></div></span</span>');
          });
          if (postid != undefined && postid !='') {
            $('#loading').addClass('loading');
            getData({controller:'Website',method:'getContent', id:postid},function(ret){
              $('#loading').removeClass('loading');
              if(ret.statu){
                //填充数据
                var data = ret.data;
                $.each(data, function(i,v){
                  $("#chk_" + i).val(v);
                });

                $("#id").val(data.id);
                $("#addtime").val(data.addtime);
              }else{
                $('#message').message(re.msg);
              }
            });

            $("#action").val("edit");
          }
          $("#span_hospital").html(hospital);
          $("#website_id").val(website_id);
        },
        okVal:'保存',
        ok:function(){
          if ($("#chk_content").val() == '') {
            alert_message('请输入内容');
            return false;
          }
          art.dialog({ id: 'addnewdata' }).close();
          var formData = $('#information').serializeArray();
          var action = $("#action").val();
          var operation = action == 'add' ? '添加' : '编辑';
          var data = {controller:'Website',method:'manageContent',action:action};
          $.each(formData,function(i,obj){
            data[obj.name] = obj.value;
          });
          $('#loading').addClass('loading');
          getData(data,function(re){
          $('#loading').removeClass('loading');
          if(re.statu){
              art.dialog({title:'消息',content:'信息保存成功！',width:210,height:60,
                okVal:'确定',
                ok:function(){

                  _me.getContentList(website_id,hospital);
                }

              });
            }else{
              art.dialog({title:'消息',content:'信息保存失败！',width:210,height:100});
            }
          });
        }//ok over

      });

    });
  },

  goback : function(){
    var _me = this;
    _me.start();
  }
});
