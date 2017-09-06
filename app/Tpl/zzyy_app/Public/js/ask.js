/**
 * 验证预约表单
 */
function check(){
    var name    = $('input[name="name"]').val();
    if(name == '' || name == '输入您的真实姓名'){
        alert('输入您的真实姓名');return false;
    }
    var age = $('input[name="age"]').val();
    if(age == '' || age == '请输入您的年龄'|| isNaN(age)){
        alert('请输入您的正确年龄');return false;
    }
    var subject     = $('select[name="subject"]').val();
    if(subject<=0){
        alert('请输入标题');return false;
    }
    var departmentID = $('select[name="departmentID"]').val() * 1;
    if(departmentID<=0){
        alert('请选择您要咨询的科室');return false;
    }
    var diseaseID     = $('select[name="diseaseID"]').val() * 1;
    if(diseaseID<=0){
        alert('请选择您要咨询的疾病');return false;
    }
    var description    = $('select[name="description"]').val();
    if(description<=0){
        alert('请输入详细内容');return false;
    }
    return true;
}
$(document).ready(function(){
    var id     = 0;
    var html   = '';

    //疾病选择
    $('select[name="departmentID"]').change(function(){
        id = $('select[name="departmentID"]').val() * 1;
        console.log(id);
        alert('aaa');
        if(id <= 0){return false;};
        $.ajax({
            url: '/controller/?controller=Ask&method=getByDepartmentID&department_id='+id,
            type:'post',
            dataType:'json',
            success:function(result){
                html = '';
                $.each(result.data,function(i,res){
                    html += '<option value="'+res.id+'">'+res.name+'</option>';
                });
                $('select[name="diseaseID"]').empty().append(html);
            }
        });
    });

});