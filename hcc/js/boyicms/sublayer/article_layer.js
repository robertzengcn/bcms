/**
 * 根据科室ID获取对应的疾病子孙树
 * @param DepartMentID
 * @param DiseaseID
 */
var base = new BaseFunc();
function getDepartSubTree( DepartMentID , DiseaseID ){
	base.cmd(gHttp,{controller:'Disease',method:'getDepartSubTree',department_id:DepartMentID,disease_id:DiseaseID},function(ret){
		if( ret.statu ) {
			$('#disease_id').html( ret.data );
		}else{
			return '';
		}
	});
}