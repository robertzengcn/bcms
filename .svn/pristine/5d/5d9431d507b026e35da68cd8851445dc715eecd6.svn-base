<?php
	$htmLPath = ABSPATH . '/' . $_GET['url'] . '/' . $_GET['link'];
	if( ! file_exists( $htmLPath ) ) {
		$htmlData = file_get_contents("http://127.0.0.1/".$_GET['tpl']);
	}else{
		$htmlData = file_get_contents($htmLPath);
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>预览编辑</title>
	<link rel="stylesheet" href="<?php echo NETADDRESS;?>/public/js/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="<?php echo NETADDRESS;?>/public/js/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="<?php echo NETADDRESS;?>/public/js/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="<?php echo NETADDRESS;?>/public/js/kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="<?php echo NETADDRESS;?>/public/js/kindeditor/plugins/code/prettify.js"></script>
	<script src="<?php echo NETADDRESS;?>/public/js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content1"]', {
				cssPath : '<?=NETADDRESS?>/public/js/kindeditor/plugins/code/prettify.css',
				uploadJson : '<?=NETADDRESS?>/public/js/kindeditor/php/upload_json.php',
				fileManagerJson : '<?=NETADDRESS?>/public/js/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				filterMode:false,
				items : [
							'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
							'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
							'insertunorderedlist', '|', 'emoticons', 'image', 'link'],
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
			K('input[name=button]').click(function(e) {
				var parsData = {
					controller:'Topic',method:'saveTplTest',id:<?php echo $_REQUEST ['id'];?>,html:editor1.html()
				};
				$.ajax({
					url      : '/controller/index.php',
					data     : parsData,
					async 	 : false,
					cache    : false,
					type     : 'post',
					dataType : 'json',
					timeout  : 10000,
					error    : function(data,message){
						switch(message){
						case 'timeout':
							alert('数据提交超时,请重新提交!');
							break;
						default:
							alert('数据提交失败,请重新提交!');
							break;
						}
					},
					success  : function(data){
						switch(data.statu){
							case true:
								alert('文件编辑成功!');window.close();
								break;
							default:
								alert('数据提交失败,请重新提交!');
								break;
						}
					}
				});
			});
		});
	</script>
</head>
<body>
	<form name="example" method="post" action="demo.php" id="submit_form">
		<textarea name="content1" style="width:100%;height:850px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
		<br />
		<input type="button" name="button" value="保存内容" id="submit" />
	</form>
</body>
</html>

