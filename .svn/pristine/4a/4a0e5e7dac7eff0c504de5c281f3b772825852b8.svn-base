var EDIT_ID = 0;
/**
 * 获取疾病列表，根据layer[层级ID]
 * @param Layer
 */
var base = new BaseFunc();
function GetDisease( attrID ){
	//获取当前被触发的layer层级
	var layerST  = attrID;
	var layerIN  = layerST.split('_');
	var layerID  = layerIN[1] * 1;
	//获取该疾病id
	var parentId = $('#'+layerST).val()*1;
	//添加下属之前,需清空当前层级后的所有附属
	var layerLN = $('.layer').length;
	var ID;
	for(var i = 0 ; i < layerLN ; i++){
		//如果循环layer层不等于当前层且大于当前层,则需要进行删除
		if( i > layerID ){
			$('#layer_'+i).remove();
		}
	}
	if(parentId > 0){
		//根据疾病ID获取对应的子集
		var boolean = false;
		base.cmd(gHttp,{controller:'Disease',method:'getSub',id:parentId},function(ret){
			if( ret.data.length >= 1 ){
				var html = '';
				html += '<select class="select layer" id="layer_'+(layerID+1)+'" onChange="GetDisease(\'layer_'+(layerID+1)+'\');">';
				html += '<option value="0">无父属疾病</option>';
				$.each(ret.data,function(i,obj){
					//如果当前修改id有值(处于修改状态,则不允许出现相同的子项,避免自己给自己做父)
					if(obj.id != EDIT_ID ) {
						html += '<option value="'+obj.id+'">'+obj.name+'</option>';
						boolean = true;
					}
				});
				html += '</select>';
				if(boolean){
					$('#'+ layerST).parent().after(html);
				}
			}
			return false;
		});
	}
}
/**
 * 获取当前最后层级
 * @info 实现思路,取所有select样式为layer的select框.并取val值,如果值不为0则为该疾病的最终层级
 */
function GetLayer() {
	//如果当前层级为最顶层，则直接返回0
	if( $('#layer_0').val()*1 == 0 ){
		return 0;
	}
	//否则返回当前最后一层layer+1
	var layerLN = $('.layer').length - 1;
	var v;
	for(var i = layerLN ; i >= 0 ; i-- ){
		v = $('#layer_'+i).val() * 1;
		if(v != 0){
			return i+1;
			break;
		}
	}
}
/**
 * 获取当前最后父id
 */
function GetFather(){
	//如果当前层级为最顶层，则直接返回0
	if( $('#layer_0').val()*1 == 0 ){
		return 0;
	}
	//否则返回当前最后一层layer+1
	var layerLN = $('.layer').length - 1;
	var v;
	for(var i = layerLN ; i >= 0 ; i-- ){
		v = $('#layer_'+i).val() * 1;
		if(v != 0){
			return v;
			break;
		}
	}
}
/**
 * 编辑时,通过疾病id动态取出它的所有族谱树
 * @param Disease_id
 */
function GetParList(Disease_id){
	//全局保存此次修改ID
	EDIT_ID = Disease_id;
	base.cmd(gHttp,{controller:'Disease',method:'getParList',id:Disease_id},function(ret){
		if( ret.data != null) {
			if( ret.data.length >= 1){
				var layer = '';
				$('span.disease').empty();
				$.each(ret.data,function(i,obj){
					if( obj.select.length >= 1 ) {
						var html = '';
						if( obj.select[0].layer == '' || obj.select[0].layer <= 0 ){layer='0';}else{layer=obj.select[0].layer;}
						html += '<select class="select layer" id="layer_'+layer+'" onChange="GetDisease(\'layer_'+layer+'\');">';
						html += '<option value="0">无父属疾病</option>';
						$.each(obj.select,function(x,d){
							if(obj.id == d.id){
								html += '<option value="'+d.id+'" selected="selected">'+d.name+'</option>';
							}else{
								html += '<option value="'+d.id+'">'+d.name+'</option>';
							}
						});
						html += '</select>';
						$('span.disease').html(html);
					}
				});
			}
		}
		//页面加载完毕
		PageInit();
		return false;
	});
}
/**
 * 设置表单,以便能够被动态提交
 */
function SetLayer(){
	var html = '';
	html += '<input type="hidden" value="'+GetLayer()+'" name="layer" />';
	html += '<input type="hidden" value="'+GetFather()+'" name="parentId" />';
	$("#layer_parentID").empty().append(html);
}
/**
 * 编辑或新增,页面加载完成后,进行下拉框初始化工作
 */
function PageInit(){
	//获取当前科室
	var department_id = $('select[name="department_id"]').val()*1;
	//获取首个layer的值
	var layer_0       = $('#layer_0').val()*1;
	//页面加载完毕的时候,layer_0需要根据当前的department_id进行重新加载
	LayerOne( department_id , layer_0 );
}
/**
 * 加载layer0下拉框
 * @param department_id 科室id
 * @param disease_id 疾病id(如果疾病id存在，则需要对其进行selected)
 */
function LayerOne( department_id , disease_id ){
	var selected = '';
	base.cmd(gHttp,{controller:'Disease',method:'getByDepartmentID',department_id:department_id},function(ret){
		var html = '';
		html = '<option value="0">无父属疾病</option>';
		$.each(ret.data,function(i,obj){
			//layer为0则代表为顶级且不能等于当前正在修改的ID
			if( obj.layer == 0 && EDIT_ID != obj.id ) {
				selected = '';
				if( disease_id == obj.id ){selected = "selected='selected'";}
				html += '<option value="'+obj.id+'" '+ selected +' >'+obj.name+'</option>';
			}
		});
		$('#layer_0').html(html);
		return false;
	});
}
//页面初始化
$(document).ready(function(){
	//科室下拉被改变[取顶级列表]
	$('#department_id').change(function(){
		//科室下拉被改变,则需要去除除layer_0之外的所有layer_select
		var layerLN = $('.layer').length;
		var ID;
		for(var i = 0 ; i < layerLN ; i++){
			if(i != 0){
				$('#layer_'+i).remove();
			}else{
				$('#layer_'+i).empty();
			}
		}
		var department_id = $('#department_id').val()*1;
		LayerOne(department_id);
	});
})