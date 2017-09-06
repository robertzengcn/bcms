$(document).ready(function(){
	var diseases = '';
        	$.ajax({
        		url:'./Controller/index.php?controller=disease&method=query',
        		dataType:'json',
        		async:false,
        		success:function(data){
        			diseases = data;
        			$('[name=departmentID]').change(function(){
                		var department_id = $(this).val();
                		if(department_id == false){
                			return false;
                		}
                		var str = '';
                		$.each(diseases.rows,function(index,obj){
                			if(obj.department_id == department_id){
                				str += '<option value="'+obj.id+'">'+obj.name+'</option>';
                			}
                		});
                		$('[name=diseaseID]').append(str);
                		$('#department_box').hide();
                		$('#disease_box').show();
                	});
        		}
        	});
        	$('#backtodepartment').click(function(){
        		$('[name=diseaseID]').html('<option value="">请选择...</option>');
        		$('#department_box').show();
        		$('#disease_box').hide();
        	});
        	$('#ask_submit').click(function(){
        		var data =	$('#ask_form').serialize();
        		data += '&name=匿名&age=18';
        		$.ajax({
        			url:'./Controller/index.php?controller=Ask&method=save',
        			data:data,
        			type:'post',
        			dataType:'json',
        			success:function(ret){
        				if(ret.statu){
        					alert('提问成功,等待专家的解答');
        					location.reload(true);
        				}
        			},
        			error:function(data,message){
        				switch(message){
        					case 'timeout':
        						alert('执行超时');
        					default:
        						alert('提问失败');
        				}
        			}
        		});
        	});
})