
/**
 * 功能：在线问答数据初始化工作
 * json格式：{"statu":true,"code":0,"msg":"","data":{}}
 * 关于json：statu为boolean,只能为true|false,code为状态码,msg为输出信息,data为数据源
 * author:ask.item
 */
var Ask           = {};//Ask模型
var AjaxData      = null;//临时对象,保存科室信息
var DiseaseArrays = [];//缓存数组,保存疾病类型

var Setting  = {
		Async:true,
		Cache:false,
		Method:'get',
		BaseUrl:'/controller?',
		DataType:'json',
		TimeOut:10000,
		Select:{

			Department:{
				Label:'departmentID',
				Html:'请选择科室',
				Def:0,
				Key:"id",
				Val:"name",
				HtmlData:[],
				Empty:true
			},

			Disease:{
				Label:'diseaseID',
				Html:'请选择疾病',
				Def:0,
				Key:"id",
				Val:"name",
				HtmlData:[],
				Empty:true
			}
		}
}
var Msg 	 = {
		Timeout:			'数据获取超时,请重试!',
		AjaxOther:			'数据拉取失败,请重试!',
		selectError:		'数据初始化失败,请重试!',
		saveSuccess:        '问题提交成功,请等待专家为您解答'
}
var Url      = {
		'getDepart':{'c':'Ask','m':'getDepartments'},
		'getDisease':{'c':'Ask','m':'getByDepartmentID'}
}
var validate = {
		'name':{c:true,m:'请正确填写姓名',l:{min:1,max:10},v:{min:0,max:0},p:""},
		'age' :{c:true,m:'请正确填写年龄',l:{min:1,max:3},v:{min:1,max:120},p:""},
		'gender':{c:true,m:'请正确选择性别',l:{min:1,max:1},v:{min:0,max:1},p:""},
		'subject':{c:true,m:'请正确填写标题',l:{min:1,max:50},v:{min:0,max:0},p:""},
		'description':{c:true,m:'请正确填写病情描述信息',l:{min:1,max:200},v:{min:0,max:0},p:""},
		'phone':{c:false,m:'请正确填写联系方式',l:{min:7,max:15},v:{min:0,max:0},p:""},
		'history':{c:false,m:'请正确输入疾病历史',l:{min:1,max:200},v:{min:0,max:0},p:""},
		'condtion':{c:false,m:'请正确输入目前治疗情况',l:{min:1,max:200},v:{min:0,max:0},p:""},

}
/**
 * 页面初始化工作,获取化验单项目,科室,以及疾病类型等
 */
Ask.init     = function() {
	//Ask.script();
	Ask.getDepartment('getDepart');//初始化科室数据
	Ask.Disease('getDisease',0);//初始化疾病类型
}
/**
 * Ajax数据初始化,将Ajax提交过后的数据设置到AjaxData变量中供后续使用
 * @param object data
 */
Ask.dataInit = function(data) {
	AjaxData = data;
}
/**
 * 错误信息提示::后期可载入其他的开源项目,进行对接
 * @param string message
 */
Ask.fail     = function(message) {
	alert(message);
}
/**
 * 正确信息提示::后期可载入其他的开源项目,进行对接
 * @param string message
 */
Ask.success  = function(message) {
	alert(message);
}
/**
 * Ajax地址提交功能,负责全局的ajax信息提交以及获取
 * @param string method
 * @param object setting
 * @param object parsData
 */
Ask.ajax     = function(setting,parsData,selSetting) {
	if(typeof Url[setting] !== 'object'){
		return null;
	}
	$.ajax({
		url      : Setting.BaseUrl+'controller='+Url[setting]['c']+'&method='+Url[setting]['m'],
		data     : parsData,
		async 	 : Setting.Async,
		cache    : Setting.Cache,
		type     : Setting.Method,
		dataType : Setting.DataType,
		timeout  : Setting.TimeOut,
		error    : function(data,message){
			switch(message){
			case 'timeout':
				Ask.fail(Msg.Timeout);
				break;
			default:
				Ask.fail(message);
				break;
			}
		},
		success  : function(data){
			Ask.dataInit(data);
			Setting.Select[selSetting].HtmlData = AjaxData;
			Ask.selectInit(Setting.Select[selSetting]);
		}
	});
}


/**
 * 获取所有科室信息
 */
Ask.getDepartment = function(urlOption) {
	if(Setting.Select.Department.HtmlData.length >= 1){
		return Ask.selectInit(Setting.Select.Department);
	}else{
		Ask.ajax(urlOption,null,'Department');
	}
}
/**
 * 初始化疾病信息,通过departmentid进行缓存
 */
Ask.Disease = function(urlOption,department_id) {
	department_id = parseInt(department_id);
	switch( typeof DiseaseArrays[department_id] ){
		case '':
			Setting.Select.Disease.HtmlData = DiseaseArrays[department_id];
			return Ask.selectInit(Setting.Select.Disease);
		break;
		default:
			Ask.ajax(urlOption,{department_id:department_id},'Disease');
			DiseaseArrays[department_id] 	= AjaxData;
		break;
	}
}
/**
 * select下拉列表数据重置,根据传入的参数进行动态设置
 * @param object paramData 数据
 * @param object Object    配置内容
 * @return boolean
 */
Ask.selectInit = function(Object) {
	var temp = false;
	var tempHtml = '';
	if(Object.Html !== ''){
		tempHtml = '<option value="'+Object.Def+'">'+Object.Html+'</option>';
	}
	if(Object.HtmlData.data.length >= 1){
		$.each(Object.HtmlData.data,function( i , data ){
			temp = true;
			tempHtml += '<option value="'+data[Object.Key]+'">'+data[Object.Val]+'</option>';
		});
	}else{
		temp = true;
	}
	if(temp){
		if(Object.Empty){
			$("select[name='"+Object.Label+"']").empty().append(tempHtml);
		}else{
			$("select[name='"+Object.Label+"']").append(tempHtml);
		}
	}else{
		Ask.fail(Msg.selectError);
	}
	return true;
}
/**
 * 下拉列表改变事件操作[select下拉选择触发操作]
 * @param object thisobject
 * @return boolean
 */
Ask.selectChange = function(handler) {
	var LabelName  = $(handler).attr("name");
	var ThisId     = $(handler).val();
	switch(LabelName){
	//科室下拉::动态获取疾病信息
	case Setting.Select.Department.Label:
		Ask.Disease('getDisease',ThisId);
		break;
	//其他下拉::
	default:
		break;
	}
	return true;
}
/**
 * 表单验证
 * @param string labelID 传入fromid即可
 * @return boolean || string 返回真或者错误信息
 */
Ask.fromValidate = function(labelID) {
	var tempVal = '';
	var error   = '';
	var partten = '';
	//遍历validate检测对象
	$.each(validate,function(key,data){
		tempVal = $("#"+labelID+" [name='"+key+"']");
		switch(key){
		case "item[]":
			//化验单表单检测
			break;
		default:
			//var check = value.c;
			var check = tempVal.attr('check');
			if (tempVal.attr('check') == undefined || tempVal.attr('check') != 'true') {
				check = 'false';
			}
			switch(check){
			case 'true':
				boolean = Ask.validate(tempVal,data);
				if(!boolean){error += data.m + "\r\n"};
				break;
			case 'false':
				if($.trim(tempVal.val()) != ''){
					boolean = Ask.validate(tempVal,data);
					if(!boolean){error += data.m + "\r\n"};
				}
				break;
			default:
				break;
			}
			break;
		}
	});
	return $.trim(error) == '' ? true : error;
}
/**
 * 表单通用验证
 * @param object tempVal 验证对象
 * @param object data 条件对象
 * @return boolean
 */
Ask.validate = function(tempVal,data){
	boolean = true;
	if(tempVal.length <= 0){
		boolean = false;
	}else{
		if(data.l.min !== 0 || data.l.max !== 0){
			if(tempVal.val() == '' || tempVal.val().length < data.l.min || tempVal.val().length > data.l.max){
				boolean = false;
			}
		}
		if(data.v.min !== 0 || data.v.max !== 0){
			if(tempVal.val() < data.v.min || tempVal.val() > data.v.max){
				boolean = false;
			}
		}
		if(data.p !== ''){
			partten = new RegExp(data.p);
			if(partten.test(tempVal.val()) === false){
				boolean = false;
			}
		}
	}
	return boolean;
}
/**
 * 在线问题新增方法,以get方式发送表单信息
 * @param string labelID 传入fromid即可
 * @param string resetBtn 传入需要被重置表单btn的标签
 */
Ask.save = function(labelID) {
	$.ajax({
		url      : Setting.BaseUrl+'controller=Ask&method=save',
		data     : $("#"+labelID).serialize(),
		type     : 'get',
		dataType : Setting.DataType,
		error    : function(data,message){
			switch(message){
			case 'timeout':
				Ask.fail(Msg.Timeout);
				break;
			default:
				Ask.fail(message);
				break;
			}
		},
		success  : function(data){
			switch(data.statu){
				case true:
					$('[type=reset]').click();
					Ask.success(Msg.saveSuccess);
				break;
				default:Ask.fail(data.msg);break;
			}
		}
	});
}

/**
 * 验证是否登录,如果没有登录则弹出登录框让其登录
 * @return boolean
 */
Ask.isLogin = function() {
	var isLogin = true;
	return isLogin;
}
///**
// * 动态加载js\css文件,autocomplete
// */
//Ask.script = function(url) {
//	$("head").append('<link href="/public/js/jquery.autocomplete.css" rel="stylesheet" type="text/css" />');
//	$.getScript('/public/js/jquery.autocomplete.js',function(){
//		
//	});
//	return true;
//}
/**
 * Jquery动态数据操作
 */
$(document).ready(function(){
	//初始化
	Ask.init();
	//select下拉选择触发操作
	$("select").change(function(){
		Ask.selectChange(this);
	});


});