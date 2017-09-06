<?php
echo $content;
?>
<script src="../public/js/ckeditor/ckeditor.js"></script>
<style>
#content {
	margin-top: 32px;
}

.bar {
	border: 0 none;
	height: 32px;
	left: 0;
	overflow: visible;
	position: fixed;
	top: 0;
	width: 100%;
	z-index: 100001;
}

.bar input {
	cursor: pointer;
	font-size: 14px;
	height: 32px;
	margin: 0 2px 2px 0;
	width: 95px;
}
</style>
<div class="bar">
	<form action="<?php echo NETADDRESS.'/controller/index.php';?>" id="formSave" method="post">
		<input type="hidden" name="id" value="<?php echo $_REQUEST ['id'];?>" /> 
		<input type="hidden" name="c" value="Topic" /> 
		<input type="hidden" name="m" value="saveTpl" /> 
		<input type="hidden" name="html" id="html" value="" /> 
		<input type="hidden" name="op" value="save" />
	</form>
	<input type="button" onclick="save()" value="保存" />
</div>
<script>
function save(){
	var content=document.getElementById("content").innerHTML;
	document.getElementById("html").value=content;
	document.getElementById("formSave").submit();
}
</script>
</body>
</html>