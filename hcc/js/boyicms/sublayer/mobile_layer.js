/**
 * 根据科室ID获取对应的疾病子孙树
 * @param DepartMentID
 * @param DiseaseID 
 */
var base = new BaseFunc();
function getDepartSubTree( DepartMentID,DiseaseID,type,id1,id2,id3){	
	if( DepartMentID == '' || DepartMentID == 0 ){
		$('#'+id3).empty();
	}else{
		base.cmd(gHttp,{controller:'Disease',method:'getMobileDepartSubTree',department_id:DepartMentID,disease_id:DiseaseID},function(ret){
			if( ret.statu ) {					
				$('#'+id3).empty().append('<select class="select" name="disease_ID" onchange="setvalue(this,\''+type+'\',\''+id1+'\',\''+id2+'\')">'+ret.data+'</select>');
				$('#'+id3).show();
			}else{
				return '';
			}
		});
	}
}
/**
 * 选择个性频道
 * @param value */ 
 
function mobileChannel( value,type){
	if($.trim(value)==''||value==undefined){
			$('#hurl_link').val('channel');
			$('#link_box').val('channel');
		}else{
			var url = window.location.origin+'/'+type+'/'+ 'channel.php?method=query&channel_id='+value;
			$('#hurl_link').val(url);
			$('#link_box').val(url);		
			}
	
}

function setChannel( value ){
	var url = window.location.origin+'/'+value+'/index.html';
	$('#hurl_link').val(url);
	$('#link_box').val(url);
}
function setDoctorurl( value ){
	var url = window.location.origin+'/'+'doctor/'+value+'.html';
	$('#hurl_link').val(url);
	$('#link_box').val(url);
}


/*将值写入INPUT*/
function setvalue(obj,type,id1,id2){
	if(obj.value==''||obj.value=='undefined'){
		var value=window.location.origin+'/'+type+'/'+$('#childUrl').find('option:selected').attr('flag');
		$('#'+id1).val(value);
		$('#'+id2).val(value);
		}
		else{
			var value=window.location.origin+'/'+type+'/'+$(obj).find('option:selected').attr('flag');
			$('#'+id1).val(value);
			$('#'+id2).val(value);
			}
	
}