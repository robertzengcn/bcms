<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选择相关文章</title>
<link href="/hcc/public/css/style.css" rel="stylesheet" type="text/css" />
<link href="/hcc/public/css/yxstyle.css" rel="stylesheet"
	type="text/css" />
<!--[if IE]>
<link href="./public/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->
<script src="/hcc/public/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="/hcc/public/js/now.js" type="text/javascript"></script>
</head>
<body>
	<div class="main">
		<div id="container" style="min-width: 100%;">
			<div id="navTab" class="tabsPage">
				<div class="navTab-panel tabsPageContent layoutBox" style="">
					<div class="page unitBox" id="article">
						<div class="pageContent" id="search">
							<div class="panel">
								<div class="panelContent">
									<div style="float:left;">
										&nbsp;&nbsp;&nbsp;&nbsp;资讯标题&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="subject" class="textInput titlesize" />
									</div>
									<img id="qry" src="/hcc/public/img/select.gif" onclick="javascript:add();" style="float:left;"/>
									<span class="clear"></span>
								</div>
								<div class="panelFooter">
									<div class="panelFooterContent"></div>
								</div>
							</div>
						</div>
						<div class="pageContent">
							<div id="grid"></div>
						</div>
						<div class="pageContent">
							<span id="save" style="cursor:pointer;width:60px;height:28px;background-color: #419FC3;line-height:28px;float:left;color:#fff;font-weight:bold;margin:5px;">
							保存关联
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
	<span class="clear"></span>
	<div id="message"></div>
	<div id="loading"></div>
	<style>
	.pages,.pagination{display:none;}
	</style>
</body>
</html>

<script>
function load(){
	var op = "<?php echo (isset($_REQUEST ['op']))?$_REQUEST ['op']:'';?>";
	if(op == 'edit'){
		edit();
		$('#search').hide();
	}else{
		add();
	}
	var ids = [];
	//相关文章
	$('#save').click(function(){
		var data = $('#grid').grid('getRows');
		var ids = [];
		if(data.length > 0){
			$.each(data,function(i,obj){
				ids[i] = obj.id;
			});	
		}
		var result = [true,ids];
		if(op == 'edit'){
			opener.result.editRelated( result );//选择关联文章
		}else{
			opener.result.selectArticle( result );//选择关联文章
		}
		window.close();
		return false;
	});
}
function add(){
	incldue_para = {};
	var department = "<?php echo (isset($_REQUEST ['department']))?$_REQUEST ['department']:'';?>";
	var disease    = "<?php echo (isset($_REQUEST ['disease']))?$_REQUEST ['disease']:'';?>";
	var doctor     = "<?php echo (isset($_REQUEST ['doctor']))?$_REQUEST ['doctor']:'';?>";
	var subject    = $('#subject').val();
	$('#grid').grid({
		size : 10,
		para : {controller:'Article',method:'query',department_id:department,disease_id:disease,doctor_id:doctor,subject:subject},
		check : true,
		field : [
			{text:'资讯标题',name:'subject'},
			{text:'关联科室',name:'department_name'},
			{text:'关联疾病',name:'disease_name'},
			{text:'关联医生',name:'doctor_name'},
			{text:'发布时间',name:'plushtime'}
		]
	});
}
function edit(){
	//选中id
	var idsStr = "<?php echo (isset($_REQUEST ['ids']))?$_REQUEST ['ids']:'';?>";
	if(idsStr != ''){
		var ids = [];
		ids = idsStr.split(",");
		$('#grid').grid({
			size : 10,
			para : {controller:'Article',method:'getByIds',ids:ids},
			check : true,
			checkAll : true,
			field : [
				{text:'资讯标题',name:'subject'},
				{text:'关联科室',name:'department'},
				{text:'关联疾病',name:'disease'},
				{text:'关联医生',name:'doctor'},
				{text:'发布时间',name:'plushtime'}
			]
		});
	}
}
load();
</script>


