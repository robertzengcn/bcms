/**
 * Created by Administrator on 14-12-5.
 */


/**
 *
 * 获取电话号码
 * @returns {*}
 */

var getTel = function(){
    var  res = '';
    var  Tel = 'tel';
    $(document).ready(function(){
            $.ajax({
                cache:false,
                async:false,
                url:'/mobile/getContact.php?funName=runContact&flag='+Tel,
                type:'post',
                dataType:'json',
                success:function(result){
                    res = result.data.val;
                }
            });
    });
    return  res;
};


/**
 * 直接弹出商务通窗口
 *
 */
var openSwt =function(){
    var src = '';
    var Swt ='swt';
    $(document).ready(function(){
            $.ajax({
                cache:false,
                async:false,
                url:'/mobile/getContact.php?funName=runContact&flag='+Swt,
                type:'post',
                dataType:'json',
                success:function(result){
                     src = result.data.val;
                }
            })
    });

    window.open(src);
};

/**
 * 弹出预约挂号窗口
 *
 */
var  openReservation = function(){

    window.open('/mobile/reservation.php?method=form');
};

/**
 * 在线问答
 * @param res
 */
var openAsks = function(){
   window.open('/mobile/ask.php');
};
/**
 *
 * 安卓端电话号码调用函数
 * @param res
 */
function phone(res)
{
    myphone.phone(res);//注意此处的myInterfaceName要和外部传入的名字一致，大小写正确
}

function myPhone()
{
     phone(getTel());
}
