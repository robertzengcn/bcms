//window.onerror = function(){return true}
//搜索
function Go_Search()
{
    var key = document.getElementById("key");
    if(key.value=="请输入关键词：如：前列腺炎" || key.value=="")
    {
        alert("请输入关键字！");
        key.focus();
        return false;
    }
    
    return true;
}
function addCookie()
{
    weburlpath=arguments[0];
    webkeywords=arguments[1];
    if(weburlpath==undefined || weburlpath=="")
    {
        weburlpath="http://www.63000111.com";
    }
    if(webkeywords==undefined || webkeywords=="")
    {
        webkeywords="吴江华夏门诊部";
    }
     if (document.all)
        {
           window.external.addFavorite(weburlpath,webkeywords);
        }
        else if (window.sidebar)
        {
           window.sidebar.addPanel(webkeywords,weburlpath, "");
     }
}


//设为首页
function setHomepage(url)
{
  if (document.all)
    {
        document.body.style.behavior='url(#default#homepage)';
        document.body.setHomePage(url); 
    }
    else if (window.sidebar)
    {
    if(window.netscape)
    {
         try
    {  
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  
         }  
         catch (e)  
         {  
            alert( "该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true" );  
         }
    } 
    var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);
    prefs.setCharPref('browser.startup.homepage',url);
 }
}
//验证答疑
function CheckDY()
{
    var txtName = $("#txtName");
    var txtKS = $("#txtKS");
    var txtJB = $("#txtJB");
    var txtTitle = $("#txtTitle");
    var txtContnt = $("#txtContnt");
    
    if($.trim(txtName.val())=="")
    {
        alert("请填写患者昵称");
        txtName.focus();
        return false;
    }
    
    if($.trim(txtTitle.val())=="")
    {
        alert("请填写问题标题");
        txtTitle.focus();
        return false;
    }

    if(txtKS.val()=="")
    {
        alert("请选择科室");
        txtKS.focus();
        return false;
    }
    
    if(txtJB.val()=="")
    {
        alert("请选择疾病");
        txtJB.focus();
        return false;
    }
    
    if($.trim(txtContnt.val())=="")
    {
        alert("请填写问题内容");
        txtContnt.focus();
        return false;
    }
    
    return true;
}
/*$(function(){GetType()})
//ajax取疾病分类
function GetType()
{
    var TypeThree = $("#txtJB");
        TypeThree.empty();
        
    if($("#txtKS").val()!="")
    {
        $.ajax({
            type: "POST",
            url: "/include/GetType.ashx",
            data: "",
            success: function(datas){
                var Result;
                eval('Result='+datas+';');
                $.each(Result, function(i, item){$("<option></option>").val(item["value"]).text(item["text"]).appendTo(TypeThree)});
                if($("#JBid").val()!="")setTimeout(function(){TypeThree.val($("#JBid").val());}, 1);
            }
        }); 
    }
}*/

jQuery.fn.extend({"followTC":function(){
	var _self = this;
	var _h = 250;
	var pos={"margin":"0 auto","top":_h+"px"}; //层的绝对定位位置
	
	/*FF和IE7可以通过position:fixed来定位，*/
	_self.css({"position":"fixed","z-index":"998"}).css(pos);
	/*ie6需要动态设置距顶端高度top.*/
	if($.browser.msie && $.browser.version == 6){
        _self.css({'position':'absolute',"top":_h+"px"});		
        $(window).scroll(function(){_self.css('top',$(window).scrollTop() + _h + "px")});	
	}
	return _self;  //返回this，使方法可链。
	}
});
jQuery.fn.extend({"followFD":function(){
	var _self = this;
	var _h = 150;
	var pos={"right":"0px","top":_h+"px"}; //层的绝对定位位置
	
	/*FF和IE7可以通过position:fixed来定位，*/
	_self.css({"position":"fixed","z-index":"998"}).css(pos);
	/*ie6需要动态设置距顶端高度top.*/
	if($.browser.msie && $.browser.version == 6){
        _self.css({'position':'absolute',"top":_h+"px"});		
        $(window).scroll(function(){_self.css('top',$(window).scrollTop() + _h + "px")});	
	}
	return _self;  //返回this，使方法可链。
	}
});

//关闭弹出窗口
function CloseFD(){$("#fdc2").fadeOut("slow");$("#LRdiv1").css("display","none");}
function Click_TC(){$("#fdc").hide();$("#fdc2").fadeIn("slow");$("#LRdiv1").css("display","none");}
$(function(){
 setTimeout("InviteBox()", 500);
 }
)
function InviteBox()
{
if($("#LRdiv1").css("display")=="block")
{
$("#fdc2").hide();
$("#fdc").fadeIn("slow");
}
setTimeout("InviteBox()", 500);
}

//获取时间
function GetTime()
{
 var day=new Array();
 day[0]="星期日";
 day[1]="星期一";
 day[2]="星期二";
 day[3]="星期三";
 day[4]="星期四";
 day[5]="星期五";
 day[6]="星期六";
 var now=new Date();
 document.getElementById("lblTime").innerHTML=now.getFullYear()+"-"+(now.getMonth()+1)+"-"+now.getDate()+" "+day[now.getDay()];
} 

