/**
 * 根据科室ID获取对应的疾病子孙树
 * @param DepartMentID
 * @param DiseaseID 
 */
var base = new BaseFunc();
function getDepartSubTree( DepartMentID,DiseaseID,id1,id2,id3){	
	if( DepartMentID == '' || DepartMentID == 0 ){
		$('#'+id3).empty();
	}else{
		base.cmd(gHttp,{controller:'Disease',method:'getDepartSubTree',department_id:DepartMentID,disease_id:DiseaseID},function(ret){
			if( ret.statu ) {				
				$('#'+id3).empty().append('<select class="select" name="disease_ID" onchange="setvalue(this,\''+id1+'\',\''+id2+'\')">'+ret.data+'</select>');
				$('#'+id3).show();
			}else{
				return '';
			}
		});
	}
}
/**
 * 选择个性频道
 * @param value
 */
function mobileChannel( value ){
	var url = window.location.origin+'/'+ 'channel.php?method=query&channel_id='+value;
	$('#hurl_link').val(url);
	$('#link_box').val(url);
}

function setChannel( value ){
	if($.trim(value)==''||value=='undefined'){			
			$('#hurl_link,#hurl_link1').val('channel');
			$('#link_box,#link_box1').val('channel');
		}else{
			var url = window.location.origin+'/'+value+'/index.html';
			$('#hurl_link,#hurl_link1').val(url);
			$('#link_box,#link_box1').val(url);
			
			}
	
}
function setDoctorurl( value ){
	var url = window.location.origin+'/'+'doctor/'+value+'.html';
	$('#hurl_link').val(url);
	$('#link_box').val(url);
}


/*将值写入INPUT*/
function setvalue(obj,id1,id2){
	if($.trim(obj.value)==''||obj.value=='undefined'){
			var value=window.location.origin+'/'+$('#childUrlDiv,#childUrlDiv1').find('option:selected').attr('flag');
			$('#'+id1).val(value);
			$('#'+id2).val(value);
		}else{
			var value=window.location.origin+'/'+$(obj).find('option:selected').attr('flag');
			$('#'+id1).val(value);
			$('#'+id2).val(value);
		}
	
		
}