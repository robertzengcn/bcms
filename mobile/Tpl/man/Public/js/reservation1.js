/**
 * 验证预约表单
 */
function check(){
	var name    = $('input[name="name"]').val();
	if(name == '' || name == '输入您的真实姓名'){
		alert('输入您的真实姓名');return false;
	}
	var hometel = $('input[name="hometel"]').val();
	if(hometel == '' || hometel == '输入您的常用手机及固定电话号码'){
		alert('输入您的常用手机及固定电话号码');return false;
	}
	var department_id = $('select[name="department_id"]').val() * 1;
	if(department_id<=0){
		alert('请选择您要预约的科室');return false;
	}
	var doctor_id     = $('select[name="doctor_id"]').val() * 1;
	if(doctor_id<=0){
		alert('请选择您要预约的医生');return false;
	}
	var date          = $('select[name="date"]').val();
	if(date=='0'){
		alert('请选择您要预约的日期');return false;
	}
	var time          = $('select[name="time"]').val();
	if(time=='0'){
		alert('请选择您要预约的时间');return false;
	}
	return true;
}
$(function() {
	var id     = 0;
	var doctor = null;
	var html   = '';
	//数据提交
	$('.submitBtn').click(function(){
		var form_check = check();
		if(form_check){
			$.ajax({
				url      : '/mobile/reservation.php?method=reserUser',
				data     : {
					name:$('input[name="name"]').val(),
					hometel:$('input[name="hometel"]').val(),
					department_id:$('select[name="department_id"]').val() * 1,
					doctor_id:$('select[name="doctor_id"]').val() * 1,
					date:$('select[name="date"]').val(),
					time:$('select[name="time"]').val()
				},
				type     : 'get',
				dataType : 'json',
				error    : function(data,message){
				},
				success  : function(data){
					if(data.statu){
						alert('恭喜你,预约成功!');
						$('select[name="department_id"]').empty().append('<option value="0">请选择科室</option>');
						$('select[name="doctor_id"]').empty().append('<option value="0">请选择医生</option>');
						$('select[name="date"]').empty().append('<option value="0">请选择就诊日期</option>');
						$('select[name="time"]').empty().append('<option value="0">请选择就诊时间</option>');
					}else{
						alert('对不起,预约失败,请刷新页面重试!');location.reload();
					}
				}
			});
		}
	});
	//医生选择
	$('select[name="department_id"]').change(function(){
		id = $('select[name="department_id"]').val() * 1;
        $.ajax({
            type:'GET',
            url:"/controller?controller=Doctor&method=getByDepartmentID&department_id="+id,
            dataType:'json',
            error    : function(data,message){
                alert('获取医生失败！');
            },
            success:function(ret){
                if(ret.statu){
                  doctor = ret.data;
                }
                html = '<option value="0">请选择医生</option>';
                $('select[name="doctor_id"]').empty().append(html);
                //清空日期与时间
                $('select[name="date"]').empty().append('<option value="0">请选择就诊日期</option>');
                $('select[name="time"]').empty().append('<option value="0">请选择就诊时间</option>');
                html = '';
                $.each(doctor,function(i,data){
                    html += '<option value="'+data.id+'">'+data.name+'</option>';
                });
                if(html != ''){
                    $('select[name="doctor_id"]').append(html);
                }
            }
        });

	});
	//日期选择
	$('select[name="doctor_id"]').change(function(){
		var department_id = $('select[name="department_id"]').val() * 1;
		var doctor_id     = $('select[name="doctor_id"]').val() * 1;

		if(department_id <= 0 || doctor_id <= 0){return false;};
		$.ajax({
			url      : '/mobile/reservation.php?method=getDate&department_id='+department_id+"&doctor_id="+doctor_id,
			data     : {},
			type     : 'get',
			dataType : 'json',
			error    : function(data,message){
			},
			success  : function(data){
				if(data.statu){
					var html = '';
					html = '<option value="0">请选择就诊日期</option>';
					$('select[name="date"]').empty().append(html);
					//清空时间
					$('select[name="time"]').empty().append('<option value="0">请选择就诊时间</option>');
					html = '';
					$.each(data.data,function(n,value){
						html += '<option value="'+value.date+'">'+value.date+'</option>';
					});
					if(html != ''){
						$('select[name="date"]').append(html);
					}
				}
			}
		});
	});
	//时间选择
	$('select[name="date"]').change(function(){
		var department_id = $('select[name="department_id"]').val() * 1;
		var doctor_id     = $('select[name="doctor_id"]').val() * 1;
		var date          = $('select[name="date"]').val();
		if(department_id <= 0 || doctor_id <= 0){return false;};
		if(date == '0'){return false;};
		$.ajax({
			url      : '/mobile/reservation.php?method=getDate&department_id='+department_id+"&doctor_id="+doctor_id+"&date="+date,
			data     : {},
			type     : 'get',
			dataType : 'json',
			error    : function(data,message){
			},
			success  : function(data){
				if(data.statu){
					var html = '';
					html = '<option value="0">请选择就诊时间</option>';
					$('select[name="time"]').empty().append(html);
					html = '';
					$.each(data.data,function(n,value){
						html += '<option value="'+value.times+'">'+value.times+'</option>';
					});
					if(html != ''){
						$('select[name="time"]').append(html);
					}
				}
			}
		});
	});
});